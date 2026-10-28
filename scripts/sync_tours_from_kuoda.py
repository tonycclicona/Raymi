#!/usr/bin/env python3
"""
Sync Tour Data from Kuoda Travel
Extracts detailed day-by-day itineraries, highlights, inclusions, exclusions,
accommodations, and high-res imagery for all homologous tours.
"""

import urllib.request
import re
import json
import os
import sys

HEADERS = {
    "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36"
}

def clean_html(text):
    if not text:
        return ""
    text = re.sub(r"<[^>]+>", " ", text)
    text = re.sub(r"&nbsp;", " ", text)
    text = re.sub(r"&#8211;", "–", text)
    text = re.sub(r"&#8217;", "'", text)
    text = re.sub(r"&#038;", "&", text)
    text = re.sub(r"&amp;", "&", text)
    text = re.sub(r"\s+", " ", text)
    return text.strip()

def scrape_kuoda_tour(url):
    print(f"Fetching: {url} ...")
    try:
        req = urllib.request.Request(url, headers=HEADERS)
        html = urllib.request.urlopen(req, timeout=15).read().decode("utf-8", errors="ignore")
    except Exception as e:
        print(f"Error fetching {url}: {e}")
        return None

    data = {}

    # 1. Title
    title_m = re.search(r"<h1[^>]*>(.*?)</h1>", html, re.DOTALL)
    data["title"] = clean_html(title_m.group(1)) if title_m else ""

    # 2. Hero Background Image
    hero_bgs = re.findall(r"url\(([^)]+\.(?:jpg|png|webp|jpeg)[^)]*)\)", html)
    data["hero_image"] = hero_bgs[0] if hero_bgs else ""

    # 3. Overview Headline & Route
    # Look for the section after H1 and before Highlights
    hl_pos = html.find("Highlights</h2>")
    if hl_pos == -1:
        hl_pos = html.find("Itinerary</h2>")
    intro_chunk = html[:hl_pos] if hl_pos != -1 else html[:10000]

    h2_after_h1 = re.findall(r"<h2[^>]*>(.*?)</h2>", intro_chunk, re.DOTALL)
    data["overview_headline"] = clean_html(h2_after_h1[0]) if h2_after_h1 else "Unveiling Peru’s Timeless Wonders"

    # Destinations / route
    # Often in <p style="...">Lima, Cusco, Machu Picchu...</p>
    route_candidates = re.findall(r"<p[^>]*class=\"[^\"]*destin[^\"]*\"[^>]*>(.*?)</p>", intro_chunk, re.DOTALL)
    if not route_candidates:
        # Search for comma separated regions
        for p in re.findall(r"<p[^>]*>(.*?)</p>", intro_chunk, re.DOTALL):
            cp = clean_html(p)
            if any(k in cp for k in ["Cusco", "Lima", "Machu Picchu", "Sacred Valley", "Atacama", "Santiago", "Galapagos", "Quito", "Bogota", "Buenos Aires", "La Paz"]):
                if len(cp) < 100 and "," in cp:
                    data["route"] = [x.strip() for x in cp.split(",") if x.strip()]
                    break
    if "route" not in data:
        data["route"] = ["Lima", "Sacred Valley", "Machu Picchu", "Cusco"]

    # Overview lead and body
    h3_m = re.search(r"<h3[^>]*>(.*?)</h3>", intro_chunk, re.DOTALL)
    lead_text = clean_html(h3_m.group(1)) if h3_m else ""

    body_paras = []
    for p in re.findall(r"<p[^>]*>(.*?)</p>", intro_chunk, re.DOTALL):
        cp = clean_html(p)
        if len(cp) > 80 and not cp.startswith("DAY") and not "By submitting this form" in cp:
            body_paras.append(cp)

    data["overview_lead"] = lead_text
    data["overview"] = lead_text + ("\n\n" + "\n\n".join(body_paras) if body_paras else "")

    # 4. Highlights
    data["highlights"] = []
    if hl_pos != -1:
        it_pos = html.find("Itinerary</h2>", hl_pos)
        hl_chunk = html[hl_pos:it_pos] if it_pos != -1 else html[hl_pos:hl_pos+5000]
        for m in re.finditer(r"<li>(.*?)</li>", hl_chunk, re.DOTALL):
            c = clean_html(m.group(1))
            if c and len(c) > 10 and not "By submitting" in c:
                data["highlights"].append(c)

    # 5. Itinerary Days
    data["itinerary"] = []
    it_start = html.find("Itinerary</h2>")
    it_end = html.find("Your Trip Begins Here", it_start)
    if it_end == -1:
        it_end = html.find("Price &amp; Inclusions", it_start)
    if it_end == -1:
        it_end = len(html)

    it_chunk = html[it_start:it_end]

    # Search for all panels matching day-X: <div class="vc_tta-panel..." id="day-..."
    panels = re.findall(r"<div class=\"vc_tta-panel[^\"]*\"[^>]*id=\"(day-[0-9]+)\"[^>]*>(.*?)(?=<div class=\"vc_tta-panel[^\"]*\"[^>]*id=\"day-|\Z)", it_chunk, re.DOTALL)
    for idx, (day_id, panel) in enumerate(panels):
        # Day title
        title_m = re.search(r"<span class=\"vc_tta-title-text\">(.*?)</span>", panel, re.DOTALL)
        day_title = clean_html(title_m.group(1)) if title_m else f"DAY {idx+1}"

        # Subtitle
        sub_m = re.search(r"<h4>(.*?)</h4>", panel, re.DOTALL)
        subtitle = clean_html(sub_m.group(1)) if sub_m else ""

        # Image
        img_m = re.search(r"<img[^>]+src=\"([^\"]+)\"", panel)
        img_url = img_m.group(1) if img_m else ""

        # Description paragraphs
        desc_paras = []
        for p in re.findall(r"<p>(.*?)</p>", panel, re.DOTALL):
            cp = clean_html(p)
            if cp and not cp.startswith("DAY") and len(cp) > 20:
                desc_paras.append(cp)

        desc = "\n\n".join(desc_paras)

        data["itinerary"].append({
            "day": idx + 1,
            "title": day_title,
            "subtitle": subtitle,
            "image": img_url,
            "description": desc
        })

    # Duration days
    data["duration_days"] = len(data["itinerary"]) if data["itinerary"] else 8

    # 6. Price & Inclusions
    data["inclusions"] = []
    data["exclusions"] = []
    data["accommodations_text"] = "From luxury properties to boutique hotels, our staff handpicks your ideal stay to ensure you get the ultimate comfort during your travels."

    pi_start = html.find("Price &amp; Inclusions")
    if pi_start != -1:
        pi_end = html.find("Check Our Reviews", pi_start)
        if pi_end == -1:
            pi_end = html.find("Sustainable Travel", pi_start)
        if pi_end == -1:
            pi_end = pi_start + 10000

        pi_chunk = html[pi_start:pi_end]

        inc_m = re.search(r"PRICE INCLUDES</h3>(.*?)((?=<h3>)|$)", pi_chunk, re.DOTALL | re.IGNORECASE)
        if inc_m:
            for li in re.finditer(r"<li>(.*?)</li>", inc_m.group(1), re.DOTALL):
                c = clean_html(li.group(1))
                if c:
                    data["inclusions"].append(c)

        exc_m = re.search(r"NOT INCLUDED</h3>(.*?)((?=<h3>)|$)", pi_chunk, re.DOTALL | re.IGNORECASE)
        if exc_m:
            for li in re.finditer(r"<li>(.*?)</li>", exc_m.group(1), re.DOTALL):
                c = clean_html(li.group(1))
                if c:
                    data["exclusions"].append(c)

        acc_m = re.search(r"ACCOMMODATIONS</h3>\s*<p>(.*?)</p>", pi_chunk, re.DOTALL | re.IGNORECASE)
        if acc_m:
            data["accommodations_text"] = clean_html(acc_m.group(1))

    # Fallbacks if scraping couldn't find items
    if not data["inclusions"]:
        data["inclusions"] = [
            "Personalized itinerary planning & dedicated private designer",
            "An Unu Raymi host to assist you in every location 24/7",
            "The majority of meals in the itinerary (gourmet & farm-to-table)",
            "Daily activities, luxury rail transfers, and private excursions as indicated"
        ]
    if not data["exclusions"]:
        data["exclusions"] = [
            "International flights to and from your home country",
            "Travel and medical insurance (recommended)",
            "Discretionary gratuities for guides and drivers",
            "Meals and premium beverages not specified in the itinerary"
        ]

    # 7. Reviews
    data["reviews"] = []
    rev_start = html.find("Check Our Reviews")
    if rev_start != -1:
        rev_chunk = html[rev_start:rev_start+8000]
        # Look for review quotes: “ ... ” or " ... "
        quotes = re.findall(r"[\"“](.*?)[\"”]\s*(?:<[^>]+>\s*)*([^<\n|]+?)\s*\|\s*([^<\n]+)", rev_chunk, re.DOTALL)
        for q, author, date in quotes:
            cq = clean_html(q)
            ca = clean_html(author)
            cd = clean_html(date)
            if len(cq) > 30:
                data["reviews"].append({
                    "quote": cq,
                    "author": ca,
                    "date": cd,
                    "rating": 5
                })

    return data

if __name__ == "__main__":
    tours_path = os.path.join(os.path.dirname(__file__), "..", "database", "data", "tours.json")
    with open(tours_path, "r", encoding="utf-8") as f:
        existing_tours = json.load(f)

    print(f"Loaded {len(existing_tours)} existing tours.")

    # Kuoda URL mappings for our existing tours
    KUODA_URLS = {
        "machu-picchu-luxury-tours": "https://www.kuodatravel.com/destinations/peru/machu-picchu-luxury-tours/",
        "machu-picchu-and-amazon-tours": "https://www.kuodatravel.com/destinations/peru/machu-picchu-and-amazon-tours/",
        "inca-trail-to-machu-picchu": "https://www.kuodatravel.com/destinations/peru/inca-trail-to-machu-picchu/",
        "salkantay-trek-to-machu-picchu": "https://www.kuodatravel.com/destinations/peru/salkantay-trek-to-machu-picchu/",
        "the-lares-trek": "https://www.kuodatravel.com/destinations/peru/the-lares-trek/",
        "luxury-huayhuash-trek": "https://www.kuodatravel.com/destinations/peru/luxury-huayhuash-trek/",
        "luxury-amazon-river-cruise": "https://www.kuodatravel.com/destinations/peru/luxury-amazon-river-cruise/",
        "peru-amazon-tours": "https://www.kuodatravel.com/destinations/peru/peru-amazon-tours/",
        "peru-adventure-tours": "https://www.kuodatravel.com/destinations/peru/peru-adventure-tours/",
        "peru-culinary-tours": "https://www.kuodatravel.com/destinations/peru/peru-culinary-tours/",
        "peru-family-travel": "https://www.kuodatravel.com/destinations/peru/peru-family-travel/",
        "peru-family-vacation": "https://www.kuodatravel.com/destinations/peru/peru-family-vacation/",
        "family-machu-picchu-vacation": "https://www.kuodatravel.com/destinations/peru/family-machu-picchu-vacation/",
        "romantic-peru-honeymoon": "https://www.kuodatravel.com/destinations/peru/romantic-peru-honeymoon/",
        "signature-peru-luxury-tours": "https://www.kuodatravel.com/destinations/peru/signature-peru-luxury-tours/",
        "southern-peru-itinerary": "https://www.kuodatravel.com/destinations/peru/southern-peru-itinerary/",
        "tambopata-peruvian-amazon": "https://www.kuodatravel.com/destinations/peru/tambopata-peruvian-amazon/",
        "atacama-chile-tours": "https://www.kuodatravel.com/destinations/chile/atacama-chile-tours/",
        "chile-patagonia-travel": "https://www.kuodatravel.com/destinations/chile/chile-patagonia-travel/"
    }

    updated_count = 0
    for tour in existing_tours:
        slug = tour.get("slug")
        if slug in KUODA_URLS:
            k_url = KUODA_URLS[slug]
            scraped = scrape_kuoda_tour(k_url)
            if scraped and scraped.get("itinerary"):
                # Merge into tour record while keeping Unu Raymi identifiers
                tour["title"] = scraped["title"] or tour["title"]
                if scraped["hero_image"]:
                    tour["hero_image"] = scraped["hero_image"]
                tour["duration_days"] = scraped["duration_days"]
                tour["duration_nights"] = max(1, scraped["duration_days"] - 1)
                tour["overview_headline"] = scraped["overview_headline"]
                tour["route"] = scraped["route"]
                tour["overview"] = scraped["overview"] or tour["overview"]
                tour["overview_lead"] = scraped["overview_lead"]
                tour["highlights"] = scraped["highlights"] or tour.get("highlights", [])
                tour["itinerary"] = scraped["itinerary"]
                tour["inclusions"] = scraped["inclusions"]
                tour["exclusions"] = scraped["exclusions"]
                tour["accommodations_text"] = scraped["accommodations_text"]
                if scraped.get("reviews"):
                    tour["reviews"] = scraped["reviews"]
                updated_count += 1
                print(f" -> Successfully synced {slug}: {len(scraped['itinerary'])} days, {len(scraped['highlights'])} highlights.")

    with open(tours_path, "w", encoding="utf-8") as f:
        json.dump(existing_tours, f, indent=2, ensure_ascii=False)

    print(f"\nAll done! Updated {updated_count} tours with authentic Kuoda content in {tours_path}")
