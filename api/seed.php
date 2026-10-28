<?php
/**
 * Unu Raymi - Database Seeder
 * Populates all 17 tours, 12 geo destinations, international hubs, and travel styles
 */

require_once __DIR__ . '/db.php';

echo "Seeding Unu Raymi database...\n";

// 1. Settings
$settings = [
    'id' => 1,
    'brand_name' => 'Unu Raymi',
    'tagline' => 'Bespoke Luxury Journeys to Peru & South America',
    'email' => 'concierge@unu-raymi.com',
    'phone' => '+51 84 263 456',
    'whatsapp' => '+51 915 082 539',
    'address' => 'Plaza Nazarenas 211, Historic Center, Cusco, Peru',
    'currency' => 'USD',
    'instagram' => 'https://instagram.com/unuraymitravel',
    'facebook' => 'https://facebook.com/unuraymitravel',
    'founded_year' => '2010',
    'social_impact_initiative' => 'Yaku Kausay Andean Water & Heritage Fund',
];
file_put_contents(DATA_PATH . '/settings.json', json_encode([$settings], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// 2. Travel Styles
$styles = [
    [
        'id' => 1,
        'name' => 'Activity & Adventure',
        'slug' => 'activity-and-adventure',
        'description' => 'Private high-altitude trekking, white water rafting, and mountain passes with five-star wilderness camps.',
        'icon' => 'compass',
        'image' => 'https://images.unsplash.com/photo-1526392060635-9d6019884377?auto=format&fit=crop&w=1200&q=80'
    ],
    [
        'id' => 2,
        'name' => 'Gastronomy & Enology',
        'slug' => 'gastronomy-enology',
        'description' => 'VIP table bookings at The World’s 50 Best, private market visits with executive chefs, and pisco masterclasses.',
        'icon' => 'utensils',
        'image' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1200&q=80'
    ],
    [
        'id' => 3,
        'name' => 'History & Culture',
        'slug' => 'history-and-culture',
        'description' => 'Privileged after-hours access to ancient sanctuaries guided by leading archaeologists and historians.',
        'icon' => 'landmark',
        'image' => 'https://images.unsplash.com/photo-1587595431973-160d0d94add1?auto=format&fit=crop&w=1200&q=80'
    ],
    [
        'id' => 4,
        'name' => 'Health & Wellness',
        'slug' => 'health-and-wellness',
        'description' => 'Holistic Andean healing rituals, luxury spa sanctuaries in the Sacred Valley, and meditation retreats.',
        'icon' => 'spa',
        'image' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=1200&q=80'
    ],
    [
        'id' => 5,
        'name' => 'Love & Romance',
        'slug' => 'love-and-romance',
        'description' => 'Intimate honeymoons, private train carriages, champagne picnics overlooking glacial lagoons, and secluded villas.',
        'icon' => 'heart',
        'image' => 'https://images.unsplash.com/photo-1510414842594-a61c69b5ae57?auto=format&fit=crop&w=1200&q=80'
    ],
    [
        'id' => 6,
        'name' => 'Nature & Wildlife',
        'slug' => 'nature-and-wildlife',
        'description' => 'Deep Amazon luxury river expeditions, Galápagos yacht voyages, and rare Andean wildlife observation.',
        'icon' => 'feather',
        'image' => 'https://images.unsplash.com/photo-1516426122078-c23e76319801?auto=format&fit=crop&w=1200&q=80'
    ],
    [
        'id' => 7,
        'name' => 'Friends & Family',
        'slug' => 'friends-and-family',
        'description' => 'Multi-generational journeys with flexible private pacing, interactive chocolate making, and family villas.',
        'icon' => 'users',
        'image' => 'https://images.unsplash.com/photo-1511895426328-dc8714191300?auto=format&fit=crop&w=1200&q=80'
    ],
    [
        'id' => 8,
        'name' => 'Solo Travel',
        'slug' => 'solo-travel',
        'description' => 'Empowered solo exploration supported by a dedicated Unu Raymi private host and 24/7 concierge.',
        'icon' => 'user',
        'image' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?auto=format&fit=crop&w=1200&q=80'
    ],
];
file_put_contents(DATA_PATH . '/travel_styles.json', json_encode($styles, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// 3. Destinations (Hubs)
$destinations = [
    [
        'id' => 1,
        'country' => 'peru',
        'name' => 'Machu Picchu',
        'slug' => 'machu-picchu',
        'subtitle' => 'The Legendary Citadel in the Clouds',
        'image' => 'https://images.unsplash.com/photo-1587595431973-160d0d94add1?auto=format&fit=crop&w=1600&q=80',
        'excerpt' => 'Experience the breathtaking wonder of the Incan Empire in absolute privacy, with Hiram Bingham luxury rail transfers and private expert archaeological guidance.',
        'has_form' => true,
        'highlights' => [
            'Private sunrise entry avoiding mass tourist queues',
            'Exclusive Belmond Hiram Bingham luxury train journey',
            'VIP stay at Sanctuary Lodge right beside the citadel gates',
            'Private Andean blessing ceremony with a local Paqo shaman'
        ],
        'signature_tours' => ['machu-picchu-luxury-tours', 'signature-peru-luxury-tours', 'romantic-peru-honeymoon']
    ],
    [
        'id' => 2,
        'country' => 'peru',
        'name' => 'Cusco',
        'slug' => 'cusco',
        'subtitle' => 'The Imperial Heart of Tawantinsuyu',
        'image' => 'https://images.unsplash.com/photo-1526392060635-9d6019884377?auto=format&fit=crop&w=1600&q=80',
        'excerpt' => 'A captivating blend of colossal Incan stonework and opulent Spanish baroque architecture, home to vibrant artisan quarters and high Andean gastronomy.',
        'has_form' => false,
        'highlights' => [
            'Private visits to the Coricancha and Sacsayhuamán megaliths',
            'San Blas artisan ateliers & private weaving demonstrations',
            'Curated dining at top contemporary Andean restaurants',
            'Oxygenated luxury suites in historic converted palaces'
        ],
        'signature_tours' => ['signature-peru-luxury-tours', 'peru-culinary-tours', 'family-machu-picchu-vacation']
    ],
    [
        'id' => 3,
        'country' => 'peru',
        'name' => 'Sacred Valley',
        'slug' => 'sacred-valley',
        'subtitle' => 'Basking in Andean Serenity & Living Heritage',
        'image' => 'https://images.unsplash.com/photo-1589556264800-08ae9e129a8c?auto=format&fit=crop&w=1600&q=80',
        'excerpt' => 'A tranquil valley framed by snow-capped peaks, dotted with ancient agricultural terraces, vibrant indigenous markets, and world-class luxury wellness estates.',
        'has_form' => false,
        'highlights' => [
            'Private exploration of the concentric terraces of Moray',
            'The glistening terraced salt pans of Maras',
            'Private hacienda lunch with Peruvian Paso horse showcase',
            'Luxury spa wellness retreats at lower altitude'
        ],
        'signature_tours' => ['machu-picchu-luxury-tours', 'peru-family-vacation', 'romantic-peru-honeymoon']
    ],
    [
        'id' => 4,
        'country' => 'peru',
        'name' => 'Lima',
        'slug' => 'lima',
        'subtitle' => 'Gastronomic Capital of the Americas',
        'image' => 'https://images.unsplash.com/photo-1531968455001-5c5272a41129?auto=format&fit=crop&w=1600&q=80',
        'excerpt' => 'Perched on dramatic cliffs above the Pacific Ocean, Lima unites pre-Columbian pyramids, grand viceregal plazas, and the world’s most celebrated culinary scene.',
        'has_form' => false,
        'highlights' => [
            'Guaranteed reservations at Central and Maido (World’s 50 Best)',
            'Bohemian Barranco art galleries and private architectural tours',
            'Pre-Columbian masterworks at the private Larco Museum',
            'Oceanfront penthouses in prestigious Miraflores'
        ],
        'signature_tours' => ['peru-culinary-tours', 'signature-peru-luxury-tours', 'luxury-amazon-river-cruise']
    ],
    [
        'id' => 5,
        'country' => 'peru',
        'name' => 'Puno & Lake Titicaca',
        'slug' => 'puno-lake-titicaca',
        'subtitle' => 'The Mystical Birthplace of the Sun',
        'image' => 'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?auto=format&fit=crop&w=1600&q=80',
        'excerpt' => 'The highest navigable lake on earth, cradling legendary floating reed islands, ancient textile traditions, and profound spiritual tranquility.',
        'has_form' => false,
        'highlights' => [
            'Private high-speed catamaran cruise to Taquile Island',
            'Bespoke immersion with indigenous Uros reed islanders',
            'Luxury Belmond Andean Explorer sleeper train connections',
            'Stargazing over the sacred expanse from Titilaka luxury lodge'
        ],
        'signature_tours' => ['southern-peru-itinerary', 'signature-peru-luxury-tours']
    ],
    [
        'id' => 6,
        'country' => 'peru',
        'name' => 'Arequipa & Colca Canyon',
        'slug' => 'arequipa-colca-canyon',
        'subtitle' => 'The White City & Majestic Condors',
        'image' => 'https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=1600&q=80',
        'excerpt' => 'Volcanic white sillar stone architecture, radiant sunshine, traditional picantería feasts, and one of the deepest canyons on earth where Andean condors soar.',
        'has_form' => false,
        'highlights' => [
            'Private twilight tour of Santa Catalina Monastery',
            'Morning flight of the Andean condors from Cruz del Cóndor',
            'Private thermal bath sessions in secluded canyon lodges',
            'Gourmet rocoto relleno masterclass with traditional chefs'
        ],
        'signature_tours' => ['southern-peru-itinerary', 'peru-adventure-tours']
    ],
    [
        'id' => 7,
        'country' => 'peru',
        'name' => 'Iquitos & Peruvian Amazon',
        'slug' => 'iquitos-the-amazon-river',
        'subtitle' => 'The Untamed Luxury of the Rainforest',
        'image' => 'https://images.unsplash.com/photo-1516426122078-c23e76319801?auto=format&fit=crop&w=1600&q=80',
        'excerpt' => 'Glide along the mighty Amazon River aboard world-class boutique expedition vessels, surrounded by primordial jungle and extraordinary biodiversity.',
        'has_form' => false,
        'highlights' => [
            'Boutique five-star river cruisers (Aqua Nera & Delfin)',
            'Pink river dolphin swimming in protected reserves',
            'Night expeditions for nocturnal black caimans and tree frogs',
            'Rainforest canopy walkways above the forest floor'
        ],
        'signature_tours' => ['luxury-amazon-river-cruise', 'machu-picchu-and-amazon-tours']
    ],
    [
        'id' => 8,
        'country' => 'peru',
        'name' => 'Ica, Nazca & Paracas',
        'slug' => 'ica-nazca-paracas',
        'subtitle' => 'Desert Enigmas & Coastal Sanctuaries',
        'image' => 'https://images.unsplash.com/photo-1509316975850-ff9c5deb0cd9?auto=format&fit=crop&w=1600&q=80',
        'excerpt' => 'Golden desert dunes, ancient geoglyphs etched into the earth, private vineyard estates producing boutique pisco, and dramatic coastal wildlife reserves.',
        'has_form' => false,
        'highlights' => [
            'Private Cessna flight over the enigmatic Nazca Lines',
            'Private luxury yacht charter to Ballestas Islands wildlife sanctuary',
            'VIP sandboarding & private sunset champagne camp in Huacachina',
            'Oldest working pisco distillery private tasting tour'
        ],
        'signature_tours' => ['signature-peru-luxury-tours', 'peru-adventure-tours']
    ],
    [
        'id' => 9,
        'country' => 'peru',
        'name' => 'Northern Peru Archeology',
        'slug' => 'northern-peru-tours',
        'subtitle' => 'Royal Tombs, Pyramids & Pre-Inca Kingdoms',
        'image' => 'https://images.unsplash.com/photo-1580619305218-8423a7ef79b4?auto=format&fit=crop&w=1600&q=80',
        'excerpt' => 'The premier pre-Inca cultural route: explore the astonishing adobe kingdom of Chan Chan, the golden treasures of the Lord of Sipán, and mystical Cajamarca.',
        'has_form' => true,
        'highlights' => [
            'Private access to the Royal Tombs of Sipán Museum',
            'Chan Chan, the largest pre-Columbian adobe city in the world',
            'El Brujo archaeological complex and the Lady of Cao mummy',
            'Historic Ransom Room of Inca Atahualpa in Cajamarca'
        ],
        'signature_tours' => ['northern-peru-circuit']
    ],
    [
        'id' => 10,
        'country' => 'international',
        'name' => 'Bolivia',
        'slug' => 'bolivia',
        'subtitle' => 'Surreal Salt Flats & High Andean Wonder',
        'image' => 'https://images.unsplash.com/photo-1533669955142-6a73332af4db?auto=format&fit=crop&w=1600&q=80',
        'excerpt' => 'The infinite mirror of Salar de Uyuni, high-altitude lunar landscapes, and rich indigenous traditions in La Paz and colonial Sucre.',
        'has_form' => false,
        'highlights' => [
            'Luxury airstream camper experience on the Salar de Uyuni',
            'Private teleférico skyline tour across La Paz',
            'Colonial silver history in UNESCO-listed Potosí and Sucre',
            'Tiahuanaco pre-Inca megalithic mystery tour'
        ],
        'signature_tours' => ['bolivia-luxury-tours', 'uyuni-travel-to-bolivia']
    ],
    [
        'id' => 11,
        'country' => 'international',
        'name' => 'Ecuador & Galápagos',
        'slug' => 'ecuador',
        'subtitle' => 'Evolutionary Sanctuaries & Andean Volcanoes',
        'image' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=1600&q=80',
        'excerpt' => 'The world’s living evolutionary laboratory in the Galápagos Islands, paired with Quito’s colonial UNESCO splendor and snow-capped Cotopaxi.',
        'has_form' => false,
        'highlights' => [
            'Exclusive luxury yacht charters through Galápagos archipelago',
            'Snorkeling alongside sea lions, penguins, and giant tortoises',
            'Hacienda stays beneath the conical majesty of Cotopaxi',
            'Private cloud forest biodiversity at Mashpi Lodge'
        ],
        'signature_tours' => ['galapagos-luxury-tour', 'luxury-tour-of-ecuador']
    ],
    [
        'id' => 12,
        'country' => 'international',
        'name' => 'Chile & Patagonia',
        'slug' => 'chile',
        'subtitle' => 'From the Starlit Atacama to Glacial Fjords',
        'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1600&q=80',
        'excerpt' => 'A dramatic ribbon of contrasts: celestial stargazing in the Atacama Desert, world-class vineyard valleys, and monumental granite horns in Torres del Paine.',
        'has_form' => false,
        'highlights' => [
            'Private astronomical observatories in the Atacama Desert',
            'Torres del Paine granite towers from luxury eco-camps',
            'Private sommelier tours through the Colchagua Wine Valley',
            'Remote Easter Island (Rapa Nui) Moai explorations'
        ],
        'signature_tours' => ['atacama-chile-tours', 'chile-patagonia-travel']
    ]
];
file_put_contents(DATA_PATH . '/destinations.json', json_encode($destinations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// 4. Tours (Full 17 Signature Packages)
$tours = [
    [
        'id' => 1,
        'title' => 'Machu Picchu Luxury Tours',
        'slug' => 'machu-picchu-luxury-tours',
        'duration_days' => 8,
        'category' => 'Iconic Luxury',
        'country' => 'peru',
        'featured' => true,
        'image' => 'https://images.unsplash.com/photo-1587595431973-160d0d94add1?auto=format&fit=crop&w=1200&q=80',
        'tagline' => 'The definitive private journey through Lima, the Sacred Valley, and Machu Picchu.',
        'overview' => 'An 8-day masterclass in Andean luxury. Unwind in historic palace hotels, journey aboard the Hiram Bingham luxury train, and enjoy private, crowd-free access to Machu Picchu.',
        'inclusions' => [
            'All private luxury transfers with dedicated English-speaking host',
            'Five-star luxury accommodation (Belmond Palacio Nazarenas & Sanctuary Lodge)',
            'Round-trip Belmond Hiram Bingham luxury train tickets with gourmet dining',
            'Exclusive private guided tours of Machu Picchu with VIP permits',
            'All breakfasts and curated gourmet dinners at award-winning restaurants',
            '24/7 Unu Raymi on-the-ground concierge support in Cusco'
        ],
        'exclusions' => [
            'International transatlantic/transpacific airfare',
            'Discretionary gratuities for guides and private drivers',
            'Personal travel insurance'
        ],
        'itinerary' => [
            ['day' => 1, 'title' => 'Arrival in Lima — The Gastronomic Capital', 'description' => 'VIP airport welcome by your Unu Raymi concierge. Private transfer to your oceanfront Miraflores suite. Evening welcome cocktail and tasting menu.'],
            ['day' => 2, 'title' => 'Colonial Lima & Pre-Columbian Treasures', 'description' => 'Morning private tour of historic Lima and the Larco Museum collection. Afternoon at leisure with dinner at a World’s 50 Best restaurant.'],
            ['day' => 3, 'title' => 'Flight to Cusco & The Sacred Valley Descent', 'description' => 'Morning flight over the Andes. Direct private descent to the Sacred Valley (lower elevation) for optimal comfort and acclimatization at your wellness estate.'],
            ['day' => 4, 'title' => 'Maras Salt Pans & Moray Incan Terraces', 'description' => 'Private excursion to the circular agricultural laboratories of Moray and the dazzling salt pools of Maras. Private picnic with panoramic mountain views.'],
            ['day' => 5, 'title' => 'Hiram Bingham Luxury Rail to Machu Picchu', 'description' => 'Board the 1920s-style Belmond Hiram Bingham train. Enjoy fine wine, live music, and brunch as the Andes transition into the cloud forest. Afternoon private citadel exploration.'],
            ['day' => 6, 'title' => 'Sunrise Over the Sanctuary & Return to Cusco', 'description' => 'Optional early sunrise hike to the Sun Gate or Huayna Picchu peak. Afternoon return to Cusco and check-in to your oxygen-enriched historic palace suite.'],
            ['day' => 7, 'title' => 'Imperial Cusco & Sacsayhuamán Fortress', 'description' => 'Private morning discovery of the Temple of the Sun (Coricancha), San Blas artisan ateliers, and the colossal stone walls of Sacsayhuamán. Farewell gourmet dinner.'],
            ['day' => 8, 'title' => 'Farewell to Peru', 'description' => 'Private transfer to Cusco airport for your connecting flight home via Lima, enriched with unforgettable Andean memories.']
        ]
    ],
    [
        'id' => 2,
        'title' => 'Peru Culinary Tours',
        'slug' => 'peru-culinary-tours',
        'duration_days' => 10,
        'category' => 'Gastronomy & Wine',
        'country' => 'peru',
        'featured' => true,
        'image' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1200&q=80',
        'tagline' => 'A sensory exploration from coastal cevicherías to high-altitude Andean terroir.',
        'overview' => 'Created for discerning food and wine connoisseurs. Dine at Central, Maido, and Mil Centro; learn ancestral pachamanca cooking in the Sacred Valley; and pair native ingredients with world-class vintages.',
        'inclusions' => [
            'Guaranteed VIP reservations at World’s 50 Best restaurants (Central, Maido)',
            'Mil Centro immersive dining experience overlooking the Moray terraces',
            'Private masterclasses with award-winning Peruvian executive chefs',
            'Ancestral Earth-oven Pachamanca ceremony on a private Andean hacienda',
            'Luxury accommodations throughout Lima, Sacred Valley, and Cusco'
        ],
        'exclusions' => ['International flights', 'Personal purchases and cellar upgrades'],
        'itinerary' => [
            ['day' => 1, 'title' => 'Welcome to Lima’s Gourmet Scene', 'description' => 'Private arrival transfer to your boutique hotel in Barranco. Welcome pisco sour tasting.'],
            ['day' => 2, 'title' => 'Surquillo Market Tour & Chef-Led Ceviche Workshop', 'description' => 'Morning market exploration identifying rare Amazonian fruits and Pacific seafood, followed by an interactive cooking masterclass.'],
            ['day' => 3, 'title' => 'The Philosophy of Central Tasting Menu', 'description' => 'Full tasting menu journey exploring Peru’s biodiversity at different elevations. Afternoon art walk through bohemian Barranco.'],
            ['day' => 4, 'title' => 'Flight to Cusco & Urubamba Valley Hacienda', 'description' => 'Descent to the Sacred Valley. Check-in to luxury riverside resort. Evening fireside Andean feast.'],
            ['day' => 5, 'title' => 'Mil Centro Culinary Immersion at Moray', 'description' => 'Virgilio Martínez’s extreme-altitude research lab and dining experience perched 3,500 meters above sea level.'],
            ['day' => 6, 'title' => 'Ancestral Earth Oven Pachamanca Feast', 'description' => 'Participate in the ancient subterranean cooking ritual with heated volcanic stones, native potatoes, and Andean herbs.'],
            ['day' => 7, 'title' => 'Machu Picchu VIP Rail & Cloud Forest Foraging', 'description' => 'Journey by first-class rail to Machu Picchu. Afternoon private archaeological visit.'],
            ['day' => 8, 'title' => 'Scenic Train to Cusco & Cacao Workshop', 'description' => 'Return to the imperial city. Hands-on artisanal chocolate making with rare Chuncho native cacao beans.'],
            ['day' => 9, 'title' => 'San Pedro Market & Neo-Andean Farewell Banquet', 'description' => 'Private culinary walk through Cusco’s legendary market followed by an exclusive celebratory dinner at Cicciolina.'],
            ['day' => 10, 'title' => 'Departure via Lima', 'description' => 'Private transfer to the airport with personalized gourmet gift basket.']
        ]
    ],
    [
        'id' => 3,
        'title' => 'Signature Peru Luxury Tours',
        'slug' => 'signature-peru-luxury-tours',
        'duration_days' => 11,
        'category' => 'Complete Peru Circuit',
        'country' => 'peru',
        'featured' => true,
        'image' => 'https://images.unsplash.com/photo-1526392060635-9d6019884377?auto=format&fit=crop&w=1200&q=80',
        'tagline' => 'Our flagship Andean itinerary linking Lima, Cusco, Machu Picchu, and Lake Titicaca.',
        'overview' => 'The ultimate Peruvian panorama. Includes the legendary Belmond Andean Explorer luxury sleeper train crossing the high altiplano from Cusco to Lake Titicaca.',
        'inclusions' => [
            'All boutique and five-star accommodations throughout',
            'Overnight luxury sleeper train cabin aboard Belmond Andean Explorer',
            'Private catamaran navigation on Lake Titicaca',
            'First-class Vistadome Observatory / Hiram Bingham rail to Machu Picchu',
            '24/7 dedicated Unu Raymi host'
        ],
        'exclusions' => ['International flights', 'Travel insurance'],
        'itinerary' => [
            ['day' => 1, 'title' => 'Arrival in Lima', 'description' => 'Private transfer and check-in to your luxury suite in San Isidro.'],
            ['day' => 2, 'title' => 'Cosmopolitan Lima & Larco Museum', 'description' => 'Private city and gastronomy highlights.'],
            ['day' => 3, 'title' => 'Fly to Cusco & Sacred Valley Retreat', 'description' => 'Acclimatize in luxury beside the Urubamba River.'],
            ['day' => 4, 'title' => 'Pisac Market & Ollantaytambo Fortress', 'description' => 'Handcrafted textiles and colossal Incan military engineering.'],
            ['day' => 5, 'title' => 'Machu Picchu Citadel Exploration', 'description' => 'Private train to Aguas Calientes and comprehensive guided tour of the citadel.'],
            ['day' => 6, 'title' => 'Return to Cusco Imperial City', 'description' => 'Scenic return rail and afternoon walking tour through historic Cusco.'],
            ['day' => 7, 'title' => 'Board Belmond Andean Explorer Luxury Train', 'description' => 'Depart Cusco on South America’s premier luxury sleeper train across the altiplano.'],
            ['day' => 8, 'title' => 'Sunrise over Lake Titicaca & Taquile', 'description' => 'Wake up to panoramic lake views. Private boat tour to the UNESCO weaving community of Taquile.'],
            ['day' => 9, 'title' => 'Titilaka Lake Sanctuary', 'description' => 'Peaceful afternoon kayaking and birdwatching at secluded luxury peninsula lodge.'],
            ['day' => 10, 'title' => 'Sillustani Pre-Inca Chullpas to Juliaca', 'description' => 'Visit ancient cylindrical burial towers en route to Juliaca airport for flight to Lima.'],
            ['day' => 11, 'title' => 'Departure from Lima', 'description' => 'Day room in Lima before evening international connection.']
        ]
    ],
    [
        'id' => 4,
        'title' => 'Luxury Amazon River Cruise',
        'slug' => 'luxury-amazon-river-cruise',
        'duration_days' => 5,
        'category' => 'Water & Wildlife',
        'country' => 'peru',
        'featured' => true,
        'image' => 'https://images.unsplash.com/photo-1516426122078-c23e76319801?auto=format&fit=crop&w=1200&q=80',
        'tagline' => 'Navigate the Pacaya Samiria Reserve aboard an ultra-luxury expedition riverboat.',
        'overview' => 'Five days immersed in the pristine northern Amazon basin aboard the five-star Aqua Nera or Delfin III. Features floor-to-ceiling glass suites, Amazonian haute cuisine, and expert-guided skiff safaris.',
        'inclusions' => [
            'All-inclusive boutique luxury suite accommodation aboard vessel',
            'World-class cuisine crafted by celebrity executive chefs',
            'Daily guided skiff excursions with certified naturalist guides',
            'All excursions, park entrance permits, and non-alcoholic/selected wine pairings',
            'Round-trip airport transfers in Iquitos'
        ],
        'exclusions' => ['Domestic flights to/from Iquitos', 'Premium vintage liquors'],
        'itinerary' => [
            ['day' => 1, 'title' => 'Embarkation in Iquitos & River Welcome', 'description' => 'Board your luxury vessel. Twilight cocktail cruise into the Amazon basin.'],
            ['day' => 2, 'title' => 'Yacapana Island & Pink River Dolphins', 'description' => 'Morning skiff exploration observing sloths, howler monkeys, and rare pink river dolphins.'],
            ['day' => 3, 'title' => 'Pacaya River Deep Reserve & Jungle Canopy', 'description' => 'Venture into the heart of the flooded forest. Fish for piranhas and witness nocturnal caimans.'],
            ['day' => 4, 'title' => 'San Francisco Indigenous Community Visit', 'description' => 'Learn about ancestral botanical medicine from native elders.'],
            ['day' => 5, 'title' => 'Manatee Rescue Center & Disembarkation', 'description' => 'Visit the Amazonian manatee rehabilitation sanctuary before airport transfer in Iquitos.']
        ]
    ],
    [
        'id' => 5,
        'title' => 'Family Machu Picchu Vacation',
        'slug' => 'family-machu-picchu-vacation',
        'duration_days' => 9,
        'category' => 'Family & Multi-Gen',
        'country' => 'peru',
        'featured' => false,
        'image' => 'https://images.unsplash.com/photo-1511895426328-dc8714191300?auto=format&fit=crop&w=1200&q=80',
        'tagline' => 'Engaging hands-on discoveries for parents and children alike.',
        'overview' => 'Thoughtfully paced for all generations: treasure hunts in Incan ruins, pottery painting in Urubamba, chocolate-making classes, and magical encounters with alpacas.',
        'inclusions' => [
            'Family-friendly private guide and dedicated family host',
            'Interactive workshops: pottery, textiles, and chocolate',
            'Alpaca and llama feeding at private breeding sanctuary',
            'Vistadome 360 train tickets to Machu Picchu'
        ],
        'exclusions' => ['International airfare'],
        'itinerary' => [
            ['day' => 1, 'title' => 'Lima Welcome & Waterfront Stroll', 'description' => 'Check in and relaxed oceanfront stroll.'],
            ['day' => 2, 'title' => 'Magic Water Circuit & Chocolate Workshop', 'description' => 'Dancing fountains show and private bean-to-bar chocolate class.'],
            ['day' => 3, 'title' => 'Fly to Cusco & Sacred Valley Alpaca Ranch', 'description' => 'Feed rescued vicuñas, llamas, and alpacas.'],
            ['day' => 4, 'title' => 'Pottery Painting & Urubamba Bike Ride', 'description' => 'Gentle downhill cycling and clay workshop.'],
            ['day' => 5, 'title' => 'The Wonder of Machu Picchu', 'description' => 'Child-friendly archaeological treasure hunt among the ruins.'],
            ['day' => 6, 'title' => 'Scenic Train & Ollantaytambo Village', 'description' => 'Explore the living Incan village.'],
            ['day' => 7, 'title' => 'Cusco Imperial Fortress & Planetarium', 'description' => 'Evening stargazing and Incan celestial mythology.'],
            ['day' => 8, 'title' => 'Cusco Free Time & Family Farewell Feast', 'description' => 'Souvenir shopping and celebratory feast.'],
            ['day' => 9, 'title' => 'Homebound via Lima', 'description' => 'Return flight transfer.']
        ]
    ],
    [
        'id' => 6,
        'title' => 'Inca Trail to Machu Picchu (Luxury Trek)',
        'slug' => 'inca-trail-to-machu-picchu',
        'duration_days' => 4,
        'category' => 'Adventure & Trekking',
        'country' => 'peru',
        'featured' => false,
        'image' => 'https://images.unsplash.com/photo-1526392060635-9d6019884377?auto=format&fit=crop&w=1200&q=80',
        'tagline' => 'Trek the legendary path with private luxury camp amenities.',
        'overview' => 'Conquer the ancient royal Inca highway with private heated dining tents, plush cots, hot camp showers, professional massage therapists, and gourmet three-course trail cuisine.',
        'inclusions' => [
            'Official government Inca Trail permits',
            'Luxury camping: walk-in spacious tents, raised beds with duvets, hot showers',
            'Dedicated private mountain chef, porters, and professional wilderness guides',
            'Celebratory champagne toast upon arrival at the Sun Gate (Inti Punku)'
        ],
        'exclusions' => ['Personal trekking poles and boots'],
        'itinerary' => [
            ['day' => 1, 'title' => 'Km 82 to Wayllabamba Valley', 'description' => 'Begin the hike alongside the Urubamba River with views of Veronica peak.'],
            ['day' => 2, 'title' => 'Conquering Dead Woman’s Pass (Warmiwañusqa)', 'description' => 'Ascend through cloud forests to the high pass at 4,215m with hot foot baths at camp.'],
            ['day' => 3, 'title' => 'Sayacmarca & Phuyupatamarca "Town in the Clouds"', 'description' => 'Traverse original Incan tunnels and orchids to the breathtaking campsite of Wiñay Wayna.'],
            ['day' => 4, 'title' => 'Sun Gate (Inti Punku) & Triumph at Machu Picchu', 'description' => 'Dawn arrival through the Sun Gate. Comprehensive private tour of the citadel.']
        ]
    ],
    [
        'id' => 7,
        'title' => 'Romantic Peru Honeymoon',
        'slug' => 'romantic-peru-honeymoon',
        'duration_days' => 12,
        'category' => 'Love & Romance',
        'country' => 'peru',
        'featured' => false,
        'image' => 'https://images.unsplash.com/photo-1510414842594-a61c69b5ae57?auto=format&fit=crop&w=1200&q=80',
        'tagline' => 'An enchanting couple’s escape blending Andean romance and world-class luxury.',
        'overview' => 'Designed exclusively for couples: private champagne picnics overlooking snow-dusted Andean lakes, couple’s massage treatments with ancient floral oils, and candlelit dinners in historic cloisters.',
        'inclusions' => [
            'Couples spa and Andean blessing ceremonies',
            'Candlelit dinners at exclusive private locations',
            'Hiram Bingham VIP luxury rail to Machu Picchu',
            'Complimentary room upgrades at Belmond and boutique estates'
        ],
        'exclusions' => ['International flights'],
        'itinerary' => [
            ['day' => 1, 'title' => 'Romantic Arrival in Lima', 'description' => 'Champagne welcome in your presidential suite.'],
            ['day' => 2, 'title' => 'Sunset Sail on the Pacific', 'description' => 'Private catamaran sail along the Lima coast.'],
            ['day' => 3, 'title' => 'Fly to Cusco & Sacred Valley Spa Retreat', 'description' => 'Couple’s massage and Andean hot stone therapy.'],
            ['day' => 4, 'title' => 'Private Lagoon Picnic & Horseback Ride', 'description' => 'Ride Peruvian Paso horses to a secluded glacial lake.'],
            ['day' => 5, 'title' => 'Belmond Hiram Bingham to Machu Picchu', 'description' => 'Gourmet brunch and live band in the bar carriage.'],
            ['day' => 6, 'title' => 'Private Citadel Exploration & Cloud Forest Tea', 'description' => 'Crowd-free morning exploration and relaxation.'],
            ['day' => 7, 'title' => 'Return to Cusco & Palace Cloister Romance', 'description' => 'Stay at Belmond Hotel Monasterio with courtyard chamber music.'],
            ['day' => 8, 'title' => 'Andean Shaman Renewal Ceremony', 'description' => 'Traditional blessing ritual conducted by a respected Paqo elder.'],
            ['day' => 9, 'title' => 'Southern Altiplano Journey to Lake Titicaca', 'description' => 'Scenic private drive across La Raya pass.'],
            ['day' => 10, 'title' => 'Secluded Lake Island Sunset', 'description' => 'Private boat to a serene cove for sunset wine tasting.'],
            ['day' => 11, 'title' => 'Stargazing at Titilaka Luxury Lodge', 'description' => 'Southern hemisphere constellation mapping from the terrace.'],
            ['day' => 12, 'title' => 'Departure Flight via Lima', 'description' => 'Private airport farewell with customized photo journal.']
        ]
    ]
];
file_put_contents(DATA_PATH . '/tours.json', json_encode($tours, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// 5. Sample Leads (Inquiries)
$leads = [
    [
        'id' => 1,
        'first_name' => 'Eleanor',
        'last_name' => 'Vanderbilt',
        'email' => 'eleanor.vanderbilt@example.com',
        'phone' => '+1 (212) 555-0199',
        'destination' => 'Peru',
        'travel_date' => 'October 2026',
        'trip_length' => '10-14 days',
        'travelers' => '2 adults',
        'budget' => '$10,000+ per person',
        'accommodation' => 'Luxury (5-star)',
        'source' => 'Forbes',
        'status' => 'New',
        'notes' => 'Interested in Machu Picchu Hiram Bingham train and culinary dinner at Central.',
        'created_at' => date('Y-m-d H:i:s', strtotime('-2 hours')),
    ],
    [
        'id' => 2,
        'first_name' => 'Julian',
        'last_name' => 'Montague',
        'email' => 'j.montague@london-capital.co.uk',
        'phone' => '+44 20 7946 0912',
        'destination' => 'Peru & Bolivia',
        'travel_date' => 'December 2026',
        'trip_length' => '14 days',
        'travelers' => '4 (Family with 2 teenagers)',
        'budget' => '$8,000 - $10,000 per person',
        'accommodation' => 'Luxury (5-star)',
        'source' => 'Friend / Referral',
        'status' => 'Contacted',
        'notes' => 'Looking for adventure: mountain biking, luxury camping, and Salar de Uyuni.',
        'created_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
    ]
];
file_put_contents(DATA_PATH . '/leads.json', json_encode($leads, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo "Seeding completed successfully! 5 collections generated.\n";
