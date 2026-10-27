import json

destinations = [
    {
        "id": 1,
        "country": "peru",
        "name": "Machu Picchu",
        "slug": "machu-picchu",
        "subtitle": "La legendaria ciudadela en las nubes",
        "image": "https://images.unsplash.com/photo-1587595431973-160d0d94add1?auto=format&fit=crop&w=1600&q=80",
        "excerpt": "Experimente el sobrecogedor esplendor del Imperio Incaico con privacidad total, acceso al amanecer, tren Belmond Hiram Bingham y guiado arqueológico privado exclusivo.",
        "has_form": True,
        "highlights": [
            "Acceso exclusivo al amanecer evitando las multitudes de turistas",
            "Viaje en el mítico tren de lujo Belmond Hiram Bingham con gastronomía de autor",
            "Estadía VIP en el Belmond Sanctuary Lodge junto a la entrada del santuario",
            "Ceremonia andina privada de bendición con chamán Paqo de las alturas"
        ],
        "signature_tours": ["machu-picchu-luxury-tours", "signature-peru-luxury-tours", "romantic-peru-honeymoon", "inca-trail-to-machu-picchu"]
    },
    {
        "id": 2,
        "country": "peru",
        "name": "Cusco",
        "slug": "cusco",
        "subtitle": "La capital imperial del Tawantinsuyu",
        "image": "https://images.unsplash.com/photo-1526392060635-9d6019884377?auto=format&fit=crop&w=1600&q=80",
        "excerpt": "Una cautivadora fusión de ciclópea cantería incaica y suntuosa arquitectura virreinal barroca, epicentro de galerías de arte, talleres de alta costura andina y gastronomía contemporánea.",
        "has_form": False,
        "highlights": [
            "Visita privada al Coricancha (Templo del Sol) y a la fortaleza de Sacsayhuamán",
            "Ateliers de San Blas y demostraciones privadas de hilado de vicuña",
            "Cenas de gala en restaurantes neorregionales galardonados (Cicciolina)",
            "Suites palaciegas oxigenadas en conventos históricos restaurados"
        ],
        "signature_tours": ["signature-peru-luxury-tours", "peru-culinary-tours", "family-machu-picchu-vacation", "romantic-peru-honeymoon"]
    },
    {
        "id": 3,
        "country": "peru",
        "name": "Valle Sagrado de los Incas",
        "slug": "sacred-valley",
        "subtitle": "Serenidad andina y herencia viva",
        "image": "https://images.unsplash.com/photo-1589556264800-08ae9e129a8c?auto=format&fit=crop&w=1600&q=80",
        "excerpt": "Un valle fecundo flanqueado por colosos nevados, salpicado de terrazas agrícolas milenarias, mercados indígenas multicolores y resorts de descanso a menor altitud.",
        "has_form": False,
        "highlights": [
            "Laboratorios agrícolas concéntricos de Moray y laboratorio gastronómico Mil Centro",
            "Las impresionantes salineras aterrazadas de Maras",
            "Almuerzo en hacienda privada con exhibición de Caballos de Paso Peruanos",
            "Spas andinos con tratamientos a base de hierbas autóctonas y piedras calientes"
        ],
        "signature_tours": ["machu-picchu-luxury-tours", "peru-family-vacation", "romantic-peru-honeymoon", "peru-culinary-tours"]
    },
    {
        "id": 4,
        "country": "peru",
        "name": "Lima",
        "slug": "lima",
        "subtitle": "Capital gastronómica de las Américas",
        "image": "https://images.unsplash.com/photo-1531968455001-5c5272a41129?auto=format&fit=crop&w=1600&q=80",
        "excerpt": "Encaramada sobre espectaculares acantilados frente al Océano Pacífico, Lima conjuga pirámides de barro preincas, mansiones virreinales y el movimiento culinario más premiado del mundo.",
        "has_form": False,
        "highlights": [
            "Mesas reservadas en Central y Maido (The World's 50 Best)",
            "Paseo arquitectónico y bohemio por casonas del siglo XIX en Barranco",
            "Obras maestras de arte mochica y chimú en la colección privada del Museo Larco",
            "Penthouses y suites con vista panorámica a la bahía de Miraflores"
        ],
        "signature_tours": ["peru-culinary-tours", "signature-peru-luxury-tours", "luxury-amazon-river-cruise"]
    },
    {
        "id": 5,
        "country": "peru",
        "name": "Puno & Lago Titicaca",
        "slug": "puno-lake-titicaca",
        "subtitle": "Cuna mitológica del Imperio del Sol",
        "image": "https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?auto=format&fit=crop&w=1600&q=80",
        "excerpt": "El lago navegable más alto del mundo, cuna de leyendas sagradas, islas flotantes de totora tejidas a mano y una serenidad celestial a 3,812 metros de altitud.",
        "has_form": False,
        "highlights": [
            "Navegación privada en catamarán de alta velocidad hacia la isla de Taquile",
            "Encuentro auténtico con familias tradicionales de las islas de los Uros",
            "Arribo a bordo del tren dormitorio Belmond Andean Explorer",
            "Observación de constelaciones australes desde la terraza de Titilaka Lodge"
        ],
        "signature_tours": ["southern-peru-itinerary", "signature-peru-luxury-tours", "peru-amazon-tours"]
    },
    {
        "id": 6,
        "country": "peru",
        "name": "Arequipa & Cañón del Colca",
        "slug": "arequipa-colca-canyon",
        "subtitle": "La Ciudad Blanca y el reino de los cóndores",
        "image": "https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=1600&q=80",
        "excerpt": "Arquitectura colonial tallada en sillar volcánico blanco, cielos zafiro impecables, picanterías centenarias y uno de los cañones más profundos del planeta.",
        "has_form": False,
        "highlights": [
            "Visita nocturna privada al Monasterio de Santa Catalina de Siena",
            "Vuelo a pocos metros de los cóndores andinos en la Cruz del Cóndor",
            "Pozas termales privadas en lodges ribereños del Colca",
            "Clase de cocina arequipeña con maestros de picanterías tradicionales"
        ],
        "signature_tours": ["southern-peru-itinerary", "peru-adventure-tours"]
    },
    {
        "id": 7,
        "country": "peru",
        "name": "Iquitos & Río Amazonas",
        "slug": "iquitos-the-amazon-river",
        "subtitle": "El lujo indómito de la gran selva virgen",
        "image": "https://images.unsplash.com/photo-1516426122078-c23e76319801?auto=format&fit=crop&w=1600&q=80",
        "excerpt": "Navegue las aguas del mítico río Amazonas a bordo de exclusivos cruceros boutique de expedición, rodeado de selva primaria impenetrable y una biodiversidad insuperable.",
        "has_form": False,
        "highlights": [
            "Embarcaciones boutique de 5 estrellas (Aqua Nera y Delfin III)",
            "Nado con delfines rosados en las aguas calmas de Pacaya Samiria",
            "Expediciones nocturnas en skiffs buscando caimanes negros y ranas de cristal",
            "Puentes de dosel suspendidos en la copa de los árboles centenarios"
        ],
        "signature_tours": ["luxury-amazon-river-cruise", "machu-picchu-and-amazon-tours"]
    },
    {
        "id": 8,
        "country": "peru",
        "name": "Ica, Nazca & Paracas",
        "slug": "ica-nazca-paracas",
        "subtitle": "Enigmas en el desierto y santuarios marinos",
        "image": "https://images.unsplash.com/photo-1509316975850-ff9c5deb0cd9?auto=format&fit=crop&w=1600&q=80",
        "excerpt": "Dunas doradas que caen al mar, misteriosos geoglifos milenarios grabados en la arena, viñedos de pisco artesanal y las Islas Ballestas repletas de fauna marina.",
        "has_form": False,
        "highlights": [
            "Sobrevuelo en avioneta privada Cessna sobre las enigmáticas Líneas de Nazca",
            "Yate privado a las Islas Ballestas para ver pingüinos de Humboldt y lobos marinos",
            "Campamento privado de lujo con champagne al atardecer en el desierto de Huacachina",
            "Cata privada en las bodegas de pisco más antiguas de América"
        ],
        "signature_tours": ["signature-peru-luxury-tours", "peru-adventure-tours"]
    },
    {
        "id": 9,
        "country": "peru",
        "name": "Trujillo & Chiclayo",
        "slug": "trujillo-chiclayo",
        "subtitle": "Tesoros mochicas, chimúes y el Señor de Sipán",
        "image": "https://images.unsplash.com/photo-1580619305218-8423a7ef79b4?auto=format&fit=crop&w=1600&q=80",
        "excerpt": "La ruta de los reinos dorados de la costa norte: la colosal ciudadela de barro de Chan Chan, las pirámides del Sol y la Luna, y la impresionante tumba real del Señor de Sipán.",
        "has_form": False,
        "highlights": [
            "Acceso privado al Museo Tumbas Reales de Sipán con arqueólogo curador",
            "Chan Chan, la ciudad de barro prehispánica más extensa del mundo",
            "Complejo El Brujo y la momia tatuada de la Señora de Cao",
            "Paseo en caballitos de totora tradicionales en la playa de Huanchaco"
        ],
        "signature_tours": ["northern-peru-tours"]
    },
    {
        "id": 10,
        "country": "peru",
        "name": "Chachapoyas & Kuélap",
        "slug": "chachapoyas-kuelap",
        "subtitle": "La fortaleza en las nubes y bosques de neblina",
        "image": "https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1600&q=80",
        "excerpt": "En el límite entre los Andes y la selva amazónica se alzan las ciclópeas murallas de Kuélap y la gigantesca catarata de Gocta, cuna de los indómitos Guerreros de las Nubes.",
        "has_form": False,
        "highlights": [
            "Ascenso en teleférico panorámico hacia la ciudadela amurallada de Kuélap",
            "Caminata privada hacia la caída de agua de Gocta (771 metros)",
            "Sarcófagos antropomorfos de Karajía en riscos verticales",
            "Lodges boutique inmersos en bosques de orquídeas y colibríes cola de espátula"
        ],
        "signature_tours": ["northern-peru-tours"]
    },
    {
        "id": 11,
        "country": "peru",
        "name": "Ruta Arqueológica del Norte",
        "slug": "northern-peru-tours",
        "subtitle": "Circuito integral de reinos preincas",
        "image": "https://images.unsplash.com/photo-1580619305218-8423a7ef79b4?auto=format&fit=crop&w=1600&q=80",
        "excerpt": "La gran travesía cultural de 11 días que une Trujillo, Chiclayo y Cajamarca. Un viaje a través de milenios de civilizaciones con landing de captación directa.",
        "has_form": True,
        "highlights": [
            "Visita al Cuarto del Rescate del Inca Atahualpa en Cajamarca",
            "Necrópolis de Otuzco y Baños del Inca",
            "Pirámides de Túcume y Museo de Sitio",
            "Gastronomía marina norteña de élite (mero, pato con arroz, chicha de jora)"
        ],
        "signature_tours": ["northern-peru-tours"]
    },
    {
        "id": 12,
        "country": "peru",
        "name": "Playas del Norte (Máncora & Punta Sal)",
        "slug": "peru-northern-beaches",
        "subtitle": "Sol perpetuo, descanso tropical y ballenas jorobadas",
        "image": "https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1600&q=80",
        "excerpt": "El paraíso costero donde la corriente cálida de El Niño baña playas de arena blanca. El cierre idóneo post-Andes con villas privadas frente al mar, surf y avistamiento marino.",
        "has_form": False,
        "highlights": [
            "Villas privadas frente al mar con chef dedicado y piscina infinita",
            "Avistamiento en yate privado de ballenas jorobadas y tortugas verdes",
            "Banquete de langostas frescas y ceviche de conchas negras",
            "Retiros de yoga y spa con el sonido de las olas del Pacífico"
        ],
        "signature_tours": ["romantic-peru-honeymoon", "signature-peru-luxury-tours"]
    },
    {
        "id": 13,
        "country": "international",
        "name": "Bolivia",
        "slug": "bolivia",
        "subtitle": "Espejo infinito del Salar de Uyuni y cumbres andinas",
        "image": "https://images.unsplash.com/photo-1533669955142-6a73332af4db?auto=format&fit=crop&w=1600&q=80",
        "excerpt": "El desierto de sal más grande del planeta, lagunas de colores encendidos pobladas de flamencos, la vibrante La Paz y la historia colonial de Potosí y Sucre.",
        "has_form": False,
        "highlights": [
            "Campamento de lujo en Airstream campers en medio del Salar de Uyuni",
            "Teleférico urbano de La Paz y Valle de la Luna",
            "Misterios megalíticos de Tiahuanaco",
            "Lagunas Colorada y Verde al pie de volcanes activos"
        ],
        "signature_tours": []
    },
    {
        "id": 14,
        "country": "international",
        "name": "Ecuador & Galápagos",
        "slug": "ecuador",
        "subtitle": "El laboratorio viviente de la evolución",
        "image": "https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=1600&q=80",
        "excerpt": "Yates de expedición privada recorriendo el archipiélago de Galápagos, combinados con las calles virreinales de Quito y las faldas del volcán Cotopaxi.",
        "has_form": False,
        "highlights": [
            "Snorkel privado con lobos marinos, pingüinos y tortugas gigantes",
            "Hospedaje en Mashpi Lodge dentro de la reserva de bosque nuboso",
            "Haciendas coloniales al pie del Cotopaxi",
            "Centro histórico de Quito declarado Patrimonio Mundial"
        ],
        "signature_tours": []
    },
    {
        "id": 15,
        "country": "international",
        "name": "Chile & Patagonia",
        "slug": "chile",
        "subtitle": "Del cielo estrellado de Atacama a los glaciares australes",
        "image": "https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1600&q=80",
        "excerpt": "El desierto más árido del mundo bajo las estrellas más limpias de la Tierra, valles vinícolas de renombre internacional y los imponentes cuernos de Torres del Paine.",
        "has_form": False,
        "highlights": [
            "Observación astronómica privada en San Pedro de Atacama",
            "Navegación entre glaciares y témpanos en la Patagonia",
            "Catas exclusivas en bodegas del Valle de Colchagua",
            "Misterio arqueológico de los Moáis en Isla de Pascua (Rapa Nui)"
        ],
        "signature_tours": []
    },
    {
        "id": 16,
        "country": "international",
        "name": "Colombia",
        "slug": "colombia",
        "subtitle": "Magia colonial, aroma de café y playas caribeñas",
        "image": "https://images.unsplash.com/photo-1580619305218-8423a7ef79b4?auto=format&fit=crop&w=1600&q=80",
        "excerpt": "Las murallas doradas de Cartagena de Indias, las fincas cafetaleras del Eje Cafetero, las aguas cristalinas del Parque Tayrona y el río de siete colores Caño Cristales.",
        "has_form": False,
        "highlights": [
            "Hospedaje en casonas coloniales privadas en Cartagena",
            "Cata de cafés especiales en haciendas del Quindío",
            "Sobrevuelo en helicóptero a Caño Cristales",
            "Playas exclusivas en las Islas del Rosario"
        ],
        "signature_tours": []
    },
    {
        "id": 17,
        "country": "international",
        "name": "Argentina",
        "slug": "argentina",
        "subtitle": "Pasión de tango, vinos de altura y el fin del mundo",
        "image": "https://images.unsplash.com/photo-1589556264800-08ae9e129a8c?auto=format&fit=crop&w=1600&q=80",
        "excerpt": "La elegancia europea de Buenos Aires, los viñedos de Malbec al pie de los Andes en Mendoza, la fuerza atronadora de las Cataratas de Iguazú y el Glaciar Perito Moreno.",
        "has_form": False,
        "highlights": [
            "Paseo en pasarelas privadas frente al Glaciar Perito Moreno",
            "Estadía en estancias vinícolas exclusivas en el Valle de Uco, Mendoza",
            "Navegación al pie de las Cataratas de Iguazú",
            "Tours gastronómicos y espectáculos privados de tango en San Telmo"
        ],
        "signature_tours": []
    }
]

with open('database/data/destinations.json', 'w', encoding='utf-8') as f:
    json.dump(destinations, f, ensure_ascii=False, indent=2)

print(f"✓ Guardados exitosamente {len(destinations)} destinos (12 de Perú + 5 internacionales) en database/data/destinations.json")
