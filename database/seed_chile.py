import json

# 1. Load existing collections
with open('database/data/tours.json', 'r', encoding='utf-8') as f:
    tours = json.load(f)

with open('database/data/destinations.json', 'r', encoding='utf-8') as f:
    destinations = json.load(f)

# Find max IDs
max_tour_id = max([t['id'] for t in tours]) if tours else 0
max_dest_id = max([d['id'] for d in destinations]) if destinations else 0

# Check if Chile tours already added
existing_tour_slugs = {t['slug'] for t in tours}
existing_dest_slugs = {d['slug'] for d in destinations}

# Chile Destinations
chile_dests = [
    {
        "country": "chile",
        "name": "San Pedro de Atacama",
        "slug": "san-pedro-de-atacama",
        "subtitle": "El desierto más árido del mundo y cielos estelares",
        "image": "https://images.unsplash.com/photo-1509316975850-ff9c5deb0cd9?auto=format&fit=crop&w=1600&q=80",
        "excerpt": "Paisajes lunares surrealistas, salares infinitos habitados por flamencos andinos, géiseres humeantes al amanecer y las observaciones astronómicas privadas más nítidas del planeta.",
        "has_form": False,
        "highlights": [
            "Observación astronómica privada con telescopios de alta gama y astrónomo residente",
            "Atardecer con champagne en el Valle de la Luna y Valle de la Muerte",
            "Amanecer termal en los Géiseres del Tatio a 4,320 metros de altitud",
            "Estadía en lodges eco-boutique de ultralujo (Tierra Atacama / Explora)"
        ],
        "signature_tours": ["atacama-chile-tours", "exploring-chile-in-style", "desert-landscapes-and-amazing-lakes-of-chile"]
    },
    {
        "country": "chile",
        "name": "Torres del Paine",
        "slug": "torres-de-paine",
        "subtitle": "El santuario de granito de la Patagonia Austral",
        "image": "https://images.unsplash.com/photo-1527004013197-933c4bb611b3?auto=format&fit=crop&w=1600&q=80",
        "excerpt": "Monolitos de piedra de proporciones colosales, lagos de color turquesa glaciar, bosques de lengas y una fauna patagónica intacta donde el guanaco y el puma habitan en libertad.",
        "has_form": True,
        "highlights": [
            "Trekking privado hacia la base de las tres Torres de Granito",
            "Navegación exclusiva en zodiac frente al imponente Glaciar Grey",
            "Safari fotográfico en busca del puma patagónico con rastreadores expertos",
            "Estadía en yurtas o domos de lujo frente al Macizo del Paine"
        ],
        "signature_tours": ["chile-patagonia-travel", "exploring-chile-in-style", "towering-peaks-chilean-patagonia"]
    },
    {
        "country": "chile",
        "name": "Santiago de Chile & Valles Centrales",
        "slug": "santiago",
        "subtitle": "Metrópolis elegante enmarcada por los Andes",
        "image": "https://images.unsplash.com/photo-1578894381163-e72c17f2d45f?auto=format&fit=crop&w=1600&q=80",
        "excerpt": "Una vibrante capital que marida rascacielos vanguardistas y palacios neoclásicos con un acceso inmediato a bodegas vinícolas centenarias en el Valle del Maipo.",
        "has_form": False,
        "highlights": [
            "Recorrido arquitectónico por los barrios El Golf, Lastarria y Bellavista",
            "Cata privada de vinos iconos (Cabernet Sauvignon) en bodegas históricas",
            "Cena de autor en Boragó (The World's 50 Best) de Rodolfo Guzmán",
            "Vuelo panorámico en helicóptero sobre los viñedos y la cordillera"
        ],
        "signature_tours": ["exploring-chile-in-style", "desert-landscapes-and-amazing-lakes-of-chile"]
    },
    {
        "country": "chile",
        "name": "Isla de Pascua (Rapa Nui)",
        "slug": "easter-island",
        "subtitle": "El misterio ancestral de los Moáis en medio del Pacífico",
        "image": "https://images.unsplash.com/photo-1510414842594-a61c69b5ae57?auto=format&fit=crop&w=1600&q=80",
        "excerpt": "El lugar habitado más aislado del planeta. Cuna de una civilización polinesia enigmática que erigió casi un millar de monumentales estatuas de piedra frente al océano.",
        "has_form": False,
        "highlights": [
            "Amanecer ceremonial en los 15 Moáis de Ahu Tongariki",
            "Cantera de piedra volcánica de Rano Raraku donde nacieron las esculturas",
            "Cráter volcánico de Rano Kau y aldea ceremonial de Orongo",
            "Atardecer en la playa de arena rosada de Anakena rodeada de palmeras"
        ],
        "signature_tours": ["easter-island-wonders"]
    },
    {
        "country": "chile",
        "name": "Valparaíso",
        "slug": "valparaiso",
        "subtitle": "La joya bohemia y colorida del Pacífico",
        "image": "https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=1600&q=80",
        "excerpt": "Cerros salpicados de casonas victorianas de colores, ascensores de madera centenarios, murales de street art reconocidos internacionalmente y la casa museo de Pablo Neruda.",
        "has_form": False,
        "highlights": [
            "Paseo guiado privado por los cerros Alegre y Concepción",
            "Viaje en los históricos funiculares patrimonio de la humanidad",
            "Visita a La Sebastiana, la célebre residencia de Pablo Neruda",
            "Almuerzo de mariscos y pescados de roca frente a la bahía"
        ],
        "signature_tours": ["exploring-chile-in-style"]
    },
    {
        "country": "chile",
        "name": "Puerto Varas & Distrito de los Lagos",
        "slug": "puerto-varas",
        "subtitle": "La ciudad de las rosas frente al Volcán Osorno",
        "image": "https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1600&q=80",
        "excerpt": "Rodeada de bosques lluviosos templados, lagos de color esmeralda y el cono perfecto del Volcán Osorno, fusiona herencia colonizadora germana y tradiciones del sur de Chile.",
        "has_form": False,
        "highlights": [
            "Navegación por el Lago Todos los Santos y Saltos del Petrohué",
            "Ascenso al refugio del Volcán Osorno con vistas a los fiordos",
            "Pesca con mosca privada en ríos de aguas cristalinas",
            "Gastronomía sureña con cordero al palo y repostería artesanal"
        ],
        "signature_tours": ["desert-landscapes-and-amazing-lakes-of-chile"]
    },
    {
        "country": "chile",
        "name": "Ruta del Vino: Valles de Colchagua & Casablanca",
        "slug": "wine-country",
        "subtitle": "El terroir dorado de los mejores vinos de Sudamérica",
        "image": "https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1600&q=80",
        "excerpt": "Hectáreas interminables de viñedos que producen los mejores Carménère, Cabernet y Syrah de América Latina, con bodegas de arquitectura vanguardista y hoteles boutique.",
        "has_form": False,
        "highlights": [
            "Paseo a caballo privado entre parras centenarias en Colchagua",
            "Catas verticales dirigidas por enólogos jefes en bodegas de renombre",
            "Almuerzos maridados de 5 tiempos en restaurantes de viñas",
            "Hospedaje en casonas coloniales con barricas de roble privado"
        ],
        "signature_tours": ["exploring-chile-in-style"]
    },
    {
        "country": "chile",
        "name": "Archipiélago de Chiloé",
        "slug": "chiloe",
        "subtitle": "Tierra de palafitos multicolores y mitología marina",
        "image": "https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=1600&q=80",
        "excerpt": "Una isla mística de pescadores, iglesias de tejuela de alerce declaradas Patrimonio de la Humanidad, leyendas de brujos y curantos tradicionales cocinados en hoyo de tierra.",
        "has_form": False,
        "highlights": [
            "Navegación privada por los canales interiores entre islas menores",
            "Ruta de las iglesias jesuitas de madera únicas en el mundo",
            "Preparación del tradicional curanto al hoyo en una comunidad chilota",
            "Descanso en hotel de arquitectura bioclimática sobre el fiordo"
        ],
        "signature_tours": ["desert-landscapes-and-amazing-lakes-of-chile"]
    }
]

# Add or update destinations
for d in chile_dests:
    if d['slug'] not in existing_dest_slugs:
        max_dest_id += 1
        d['id'] = max_dest_id
        destinations.append(d)
        print(f" + Agregado destino Chile: {d['name']}")
    else:
        # Update existing
        for idx, existing in enumerate(destinations):
            if existing['slug'] == d['slug']:
                d['id'] = existing['id']
                destinations[idx] = d
                print(f" * Actualizado destino Chile: {d['name']}")
                break

# Chile Signature Tours
chile_tours = [
    {
        "title": "Exploring Chile in Style",
        "slug": "exploring-chile-in-style",
        "duration_days": 12,
        "category": "Lujo & Paisajes Extremos",
        "country": "chile",
        "featured": True,
        "image": "https://images.unsplash.com/photo-1527004013197-933c4bb611b3?auto=format&fit=crop&w=1200&q=80",
        "tagline": "La gran travesía chilena: Santiago cosmopolita, el Desierto de Atacama y los confines de la Patagonia.",
        "overview": "El itinerario insignia de Chile que conjuga tres universos geográficos distintos: la sofisticación urbana y vinícola de la capital, el misticismo del desierto más estrellado del mundo y la sobrecogedora belleza de las Torres del Paine en lodges 5 estrellas todo incluido.",
        "inclusions": [
            "Todos los vuelos internos en Chile (Santiago - Calama - Punta Arenas - Santiago)",
            "3 noches en Santiago en The Singular o Mandarin Oriental",
            "4 noches de expedición de lujo con todo incluido en Tierra Atacama / Explora",
            "4 noches en lodge de ultralujo en Torres del Paine (Tierra Patagonia / Explora)",
            "Todas las comidas gourmet y barra libre de vinos reserva chilenos",
            "Guías privados bilingües y traslados ejecutivos 24/7"
        ],
        "exclusions": ["Vuelos internacionales", "Seguro de viaje"],
        "itinerary": [
            {"day": 1, "title": "Bienvenida en Santiago de Chile", "description": "Recepción VIP en el aeropuerto Arturo Merino Benítez. Traslado privado a su suite en el barrio El Golf. Cóctel de bienvenida con vinos premium."},
            {"day": 2, "title": "Santiago Histórico & Alta Gastronomía", "description": "Paseo matutino por el centro histórico, cerro Santa Lucía y Palacio de La Moneda. Cena de autor en el galardonado restaurante Boragó."},
            {"day": 3, "title": "Costa del Pacífico: Valparaíso & Viña del Mar", "description": "Excursión privada hacia los cerros de Valparaíso, funiculares y cata de blancos en el Valle de Casablanca."},
            {"day": 4, "title": "Vuelo al Desierto de Atacama", "description": "Vuelo al norte hacia Calama y traslado privado al oasis de San Pedro de Atacama. Atardecer en el Valle de la Luna con champagne."},
            {"day": 5, "title": "Salar de Atacama & Lagunas Altiplánicas", "description": "Descubrimiento de las lagunas Miscanti y Miñiques a 4,200 metros, rodeadas de volcanes y flamencos."},
            {"day": 6, "title": "Géiseres del Tatio & Termas de Puritama", "description": "Salida antes del alba para presenciar las fumarolas geotérmicas del Tatio. En la tarde, relajación en las pozas termales privadas de Puritama."},
            {"day": 7, "title": "Astronomía de Clase Mundial en Atacama", "description": "Día libre de spa en el lodge. Por la noche, sesión privada de observación astronómica guiada por astrónomo profesional."},
            {"day": 8, "title": "Rumbo al Fin del Mundo: Vuelo a la Patagonia", "description": "Vuelo de retorno vía Santiago hacia Punta Arenas. Traslado panorámico al Parque Nacional Torres del Paine."},
            {"day": 9, "title": "El Macizo del Paine & Lago Pehoé", "description": "Exploración en vehículo 4x4 y caminatas por los miradores del Cuerno Principal y Salto Grande."},
            {"day": 10, "title": "Navegación al Glaciar Grey", "description": "Embarque en catamarán para navegar entre témpanos de hielo flotantes frente a la imponente pared azul del Glaciar Grey."},
            {"day": 11, "title": "Trekking a la Base de las Torres", "description": "Caminata de día completo hacia el anfiteatro natural de granito más famoso de los Andes australes."},
            {"day": 12, "title": "Retorno a Santiago y Vuelo Internacional", "description": "Traslado al aeropuerto de Punta Arenas para conectar con su vuelo internacional en Santiago."}
        ]
    },
    {
        "title": "Atacama Chile Luxury Tours",
        "slug": "atacama-chile-tours",
        "duration_days": 7,
        "category": "Desierto & Astronomía VIP",
        "country": "chile",
        "featured": True,
        "image": "https://images.unsplash.com/photo-1509316975850-ff9c5deb0cd9?auto=format&fit=crop&w=1200&q=80",
        "tagline": "Una inmersión sublime en el desierto más puro del planeta con observación estelar privada.",
        "overview": "Siete días dedicados a explorar la belleza mineral del norte chileno: campos de géiseres activos, salares deslumbrantes, cañones de adobe y los cielos nocturnos más limpios de la Tierra.",
        "inclusions": [
            "Estadía de 5 noches en lodge todo incluido de ultralujo en San Pedro de Atacama",
            "Excursiones privadas diarias a la carta con guías expertos en geomorfología",
            "Sesión privada en observatorio astronómico con telescopio motorizado",
            "Acceso exclusivo y traslados privados desde y hacia el aeropuerto de Calama",
            "Pensión completa con coctelería y vinos chilenos premium"
        ],
        "exclusions": ["Vuelos internacionales y domésticos"],
        "itinerary": [
            {"day": 1, "title": "Llegada a Santiago", "description": "Recepción y estancia en hotel boutique de Lastarria."},
            {"day": 2, "title": "Vuelo a Calama & Traslado a San Pedro", "description": "Arribo al desierto y bienvenida en el lodge. Tarde de relajación en piscina frente a los volcanes."},
            {"day": 3, "title": "Valle de la Muerte & Dunas de Sal", "description": "Caminata entre formaciones de roca arcillosa y arena fina dorada. Brindis al atardecer."},
            {"day": 4, "title": "Laguna Chaxa & Flamencos Andinos", "description": "Observación de aves migratorias en medio del Salar de Atacama y visita al poblado tradicional de Toconao."},
            {"day": 5, "title": "Géiseres del Tatio al Alba", "description": "El campo geotérmico más alto del hemisferio sur en plena actividad matutina. Desayuno campestre humeante."},
            {"day": 6, "title": "Baños Termales de Puritama & Noche de Estrellas", "description": "Aguas termales en un cañón de cactus gigantes. En la noche, tour de constelaciones y vía láctea."},
            {"day": 7, "title": "Despedida del Desierto", "description": "Traslado a Calama para conectar con vuelo internacional vía Santiago."}
        ]
    },
    {
        "title": "Chile Patagonia Travel & Glaciers",
        "slug": "chile-patagonia-travel",
        "duration_days": 9,
        "category": "Glaciares & Naturaleza Virgen",
        "country": "chile",
        "featured": True,
        "image": "https://images.unsplash.com/photo-1527004013197-933c4bb611b3?auto=format&fit=crop&w=1200&q=80",
        "tagline": "Expedición privada al Parque Nacional Torres del Paine en lodges galardonados.",
        "overview": "Viva la Patagonia con el estándar de servicio más exigente. Alojamientos de arquitectura vanguardista integrados en el paisaje patagónico, navegaciones frente a glaciares y senderismo guiado exclusivo.",
        "inclusions": [
            "Estadía de 6 noches en lodge todo incluido en Torres del Paine (Tierra Patagonia o Explora)",
            "Excursiones privadas de trekking, cabalgatas con gauchos y navegación",
            "Guías naturalistas certificados y equipo técnico de travesía",
            "Todas las comidas y barra abierta de vinos chilenos finos",
            "Traslados desde y hacia el aeropuerto de Punta Arenas o Puerto Natales"
        ],
        "exclusions": ["Vuelos internacionales", "Propinas de lodge"],
        "itinerary": [
            {"day": 1, "title": "Llegada a Santiago de Chile", "description": "Descanso y cena en la capital."},
            {"day": 2, "title": "Vuelo a Punta Arenas & Ruta a Torres del Paine", "description": "Viaje a través de la estepa patagónica avistando ñandúes y guanacos."},
            {"day": 3, "title": "Mirador Cuernos del Paine & Lago Nordenskjöld", "description": "Caminata panorámica junto a las aguas turquesas del lago con vista a los cuernos bicolores."},
            {"day": 4, "title": "Glaciar Grey & Hielos Milenarios", "description": "Navegación en catamarán bordeando témpanos azulados flotantes desprendidos del campo de hielo sur."},
            {"day": 5, "title": "Cabalgata con Gauchos en Estancia Patagónica", "description": "Día ecuestre aprendiendo las tradiciones del hombre de campo patagónico y asado de cordero al palo."},
            {"day": 6, "title": "Trekking Base Torres", "description": "La caminata reina hacia la laguna glacial al pie de los tres monolitos de granito."},
            {"day": 7, "title": "Valle Francés & Cascada del Paine", "description": "Impresionante anfiteatro rodeado de glaciares colgantes y bosque andino patagónico."},
            {"day": 8, "title": "Laguna Azul & Cueva del Milodón", "description": "Vistas serenas donde la fauna patagónica se congrega en calma."},
            {"day": 9, "title": "Retorno a Santiago y Salida", "description": "Traslado a Punta Arenas para su vuelo de regreso a casa."}
        ]
    },
    {
        "title": "Desert Landscapes and Amazing Lakes of Chile",
        "slug": "desert-landscapes-and-amazing-lakes-of-chile",
        "duration_days": 11,
        "category": "Contrastes de Chile",
        "country": "chile",
        "featured": False,
        "image": "https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80",
        "tagline": "De la aridez lunar de Atacama a los bosques templados y lagos de Puerto Varas.",
        "overview": "Un itinerario de contrastes asombrosos que revela la diversidad geográfica de Chile: desde los volcanes del norte desértico hasta las aguas esmeralda del sur y la mística Isla de Chiloé.",
        "inclusions": [
            "Hoteles boutique 5 estrellas en Santiago, San Pedro de Atacama y Puerto Varas",
            "Excursiones privadas con chofer y guía en todas las regiones",
            "Navegación por el Lago Todos los Santos y cruce a Chiloé en ferry privado",
            "Todos los desayunos y cenas de especialidad incluidas"
        ],
        "exclusions": ["Vuelos internacionales", "Bebidas fuera de menú"],
        "itinerary": [
            {"day": 1, "title": "Santiago", "description": "Arribo a la capital y descanso."},
            {"day": 2, "title": "Vuelo a Calama & Atacama", "description": "Llegada al desierto y atardecer en Valle de la Luna."},
            {"day": 3, "title": "Salar de Atacama y Lagunas Altiplánicas", "description": "Exploración de la meseta andina."},
            {"day": 4, "title": "Géiseres del Tatio y Vuelo al Sur", "description": "Amanecer en los géiseres y vuelo hacia Puerto Montt / Puerto Varas."},
            {"day": 5, "title": "Puerto Varas & Lago Llanquihue", "description": "Paseo costero y vistas al Volcán Osorno."},
            {"day": 6, "title": "Saltos del Petrohué & Volcán Osorno", "description": "Cataratas sobre lava basáltica y ascenso al centro de esquí del volcán."},
            {"day": 7, "title": "Excursión a la Isla Grande de Chiloé", "description": "Cruce del Canal de Chacao, visita a los palafitos de Castro e iglesias de madera."},
            {"day": 8, "title": "Tradición del Curanto en Chiloé", "description": "Almuerzo ancestral preparado con piedras calientes bajo tierra."},
            {"day": 9, "title": "Parque Nacional Vicente Pérez Rosales", "description": "Caminatas por el bosque lluvioso templado valdiviano."},
            {"day": 10, "title": "Retorno a Santiago & Valle del Maipo", "description": "Vuelo a Santiago y tarde de cata en viñedo histórico."},
            {"day": 11, "title": "Vuelo Internacional de Regreso", "description": "Fin de los servicios en Chile."}
        ]
    },
    {
        "title": "Easter Island Wonders & Moais",
        "slug": "easter-island",
        "duration_days": 5,
        "category": "Arqueología & Misterio Polinesio",
        "country": "chile",
        "featured": False,
        "image": "https://images.unsplash.com/photo-1510414842594-a61c69b5ae57?auto=format&fit=crop&w=1200&q=80",
        "tagline": "Descubra el mayor misterio de la Polinesia en el punto más remoto del océano.",
        "overview": "Cinco días exclusivos en Rapa Nui (Isla de Pascua) alojándose en el icónico hotel Explora Rapa Nui o Nayara Hangaroa, descifrando el enigma de cómo una cultura aislada esculpió y transportó gigantes de piedra.",
        "inclusions": [
            "Vuelos ida y vuelta Santiago - Isla de Pascua (Mataveri) en cabina preferencial",
            "4 noches de alojamiento de ultralujo con vista al océano",
            "Permisos del Parque Nacional Rapa Nui",
            "Todas las expediciones privadas con guías arqueólogos nativos rapanui",
            "Pensión completa gourmet con pescados de roca y frutos tropicales"
        ],
        "exclusions": ["Gastos personales y suvenires"],
        "itinerary": [
            {"day": 1, "title": "Vuelo a Rapa Nui & Bienvenida Polinesia", "description": "Vuelo sobre el Pacífico azul profundo. Recepción con collares de flores autóctonas y traslado al lodge."},
            {"day": 2, "title": "La Cantera de Rano Raraku & Tongariki", "description": "Visita al volcán donde se esculpieron cientos de Moáis inconclusos y contemplación de los 15 colosos erguidos en Ahu Tongariki."},
            {"day": 3, "title": "Cráter de Rano Kau & Aldea de Orongo", "description": "El sobrecogedor cráter con laguna interior y la aldea ceremonial del Hombre Pájaro (Tangata Manu)."},
            {"day": 4, "title": "Ahu Akivi & Playa Tropical de Anakena", "description": "Los siete Moáis que miran hacia el océano y tarde de descanso en la playa de arena coralina rosada de Anakena."},
            {"day": 5, "title": "Vuelo de Regreso a Santiago", "description": "Despedida tradicional polinesia y vuelo de regreso a Santiago de Chile."}
        ]
    },
    {
        "title": "Towering Peaks: Chilean Patagonia W-Trek Luxury",
        "slug": "towering-peaks-chilean-patagonia",
        "duration_days": 8,
        "category": "Trekking VIP & Aventura",
        "country": "chile",
        "featured": False,
        "image": "https://images.unsplash.com/photo-1527004013197-933c4bb611b3?auto=format&fit=crop&w=1200&q=80",
        "tagline": "El mítico Circuito W de Torres del Paine recorrido con el máximo confort de la Patagonia.",
        "overview": "Conquiste los hitos más legendarios del trekking mundial: el Valle del Francés, el Glaciar Grey y la Base de las Torres, regresando cada tarde a cálidos refugios de montaña y lodges con gastronomía gourmet y masajes.",
        "inclusions": [
            "Logística integral del Circuito W con traslados privados y catamaranes lacustres",
            "Hospedajes en lodges de montaña exclusivos y refugios privados",
            "Guía de montaña profesional bilingüe con certificación WFR",
            "Porteador para equipaje principal durante las jornadas de travesía",
            "Alimentación completa diseñada para senderismo de alto rendimiento"
        ],
        "exclusions": ["Equipo técnico personal de trekking", "Vuelos internacionales"],
        "itinerary": [
            {"day": 1, "title": "Punta Arenas a Puerto Natales", "description": "Llegada al extremo sur de Chile y traslado hacia la puerta de entrada de Torres del Paine."},
            {"day": 2, "title": "Ingreso al Parque & Navegación a Refugio Grey", "description": "Navegación por el Lago Grey y aproximación a la primera pared de hielo."},
            {"day": 3, "title": "Los Puentes Colgantes del Glaciar Grey", "description": "Caminata sobre las pasarelas que dominan los desprendimientos de hielo."},
            {"day": 4, "title": "Trekking al Valle del Francés", "description": "Cruce del corazón del circuito entre glaciares colgantes con estruendosas avalanchas a la distancia."},
            {"day": 5, "title": "Sendero a Los Cuernos del Paine", "description": "Caminata a orillas del Lago Nordenskjöld con vistas a las formaciones de granito negro y blanco."},
            {"day": 6, "title": "Ascenso a la Base de las Torres del Paine", "description": "La jornada cumbre subiendo la morrena glaciar hasta la laguna a los pies de las tres agujas de roca."},
            {"day": 7, "title": "Descanso y Celebración en Puerto Natales", "description": "Retorno a la civilización y cena de celebración patagónica."},
            {"day": 8, "title": "Traslado a Punta Arenas y Vuelo", "description": "Fin de la expedición patagónica."}
        ]
    }
]

# Add or update tours
for t in chile_tours:
    if t['slug'] not in existing_tour_slugs:
        max_tour_id += 1
        t['id'] = max_tour_id
        tours.append(t)
        print(f" + Agregado tour Chile: {t['title']} ({t['duration_days']} días)")
    else:
        for idx, existing in enumerate(tours):
            if existing['slug'] == t['slug']:
                t['id'] = existing['id']
                tours[idx] = t
                print(f" * Actualizado tour Chile: {t['title']}")
                break

# Save collections
with open('database/data/tours.json', 'w', encoding='utf-8') as f:
    json.dump(tours, f, ensure_ascii=False, indent=2)

with open('database/data/destinations.json', 'w', encoding='utf-8') as f:
    json.dump(destinations, f, ensure_ascii=False, indent=2)

print("\n✓ Proceso completado exitosamente:")
print(f"  - Total Tours en BD: {len(tours)}")
print(f"  - Total Destinos en BD: {len(destinations)}")
