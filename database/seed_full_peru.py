import json

tours = [
    {
        "id": 1,
        "title": "Machu Picchu Luxury Tours",
        "slug": "machu-picchu-luxury-tours",
        "duration_days": 8,
        "category": "Lujo Icónico",
        "country": "peru",
        "featured": True,
        "image": "https://images.unsplash.com/photo-1587595431973-160d0d94add1?auto=format&fit=crop&w=1200&q=80",
        "tagline": "La travesía definitiva en Lima, Cusco, Valle Sagrado y Machu Picchu con servicio 5 estrellas.",
        "overview": "Una travesía inolvidable de 8 días diseñada para experimentar la cumbre del confort andino. Disfrute del tren Belmond Hiram Bingham, suites históricas oxigenadas y acceso arqueológico privado exclusivo.",
        "inclusions": [
            "Traslados privados de lujo con anfitrión bilingüe Unu Raymi 24/7",
            "Alojamiento 5 estrellas (Belmond Palacio Nazarenas & Sanctuary Lodge)",
            "Boletos ida y vuelta en tren Belmond Hiram Bingham con almuerzo y cena gourmet",
            "Entradas preferenciales y guiado privado exclusivo en la ciudadela de Machu Picchu",
            "Todos los desayunos y cenas gourmet seleccionadas en restaurantes galardonados",
            "Ceremonia andina privada de bendición con chamán Paqo"
        ],
        "exclusions": [
            "Vuelos internacionales de llegada y salida",
            "Propinas discrecionales para guías y choferes privados",
            "Seguro de viaje internacional"
        ],
        "itinerary": [
            {"day": 1, "title": "Llegada a Lima — La Capital Gastronómica", "description": "Recepción VIP en el aeropuerto internacional Jorge Chávez. Traslado privado a su suite frente al océano en Miraflores. Cóctel de bienvenida."},
            {"day": 2, "title": "Lima Colonial & Tesoros Precolombinos", "description": "Visita privada matutina al centro histórico virreinal y a la colección privada del Museo Larco. Almuerzo degustación de ceviches."},
            {"day": 3, "title": "Vuelo a Cusco y Descenso al Valle Sagrado", "description": "Vuelo sobre los picos andinos. Descenso inmediato al Valle Sagrado de los Incas (menor altitud) para una aclimatación placentera en un resort spa."},
            {"day": 4, "title": "Salineras de Maras, Moray & Banquete Pachamanca", "description": "Exploración de los laboratorios agrícolas circulares de Moray y las pozas de sal de Maras. Celebración del festín ancestral de Pachamanca."},
            {"day": 5, "title": "Tren Belmond Hiram Bingham a Machu Picchu", "description": "Aborde el tren de estilo años 20 con coctelería libre, música en vivo y almuerzo gourmet mientras desciende hacia la ceja de selva. Visita privada vespertina a la ciudadela."},
            {"day": 6, "title": "Amanecer en el Santuario & Retorno a Cusco", "description": "Acceso matutino al amanecer en Machu Picchu o caminata hacia la Puerta del Sol (Inti Punku). Retorno en tren de primera clase a la ciudad imperial de Cusco."},
            {"day": 7, "title": "Cusco Imperial & Fortaleza de Sacsayhuamán", "description": "Recorrido privado por el Templo del Sol (Coricancha), el barrio de artesanos de San Blas y los megalitos ciclópeos de Sacsayhuamán. Cena de gala."},
            {"day": 8, "title": "Despedida del Perú", "description": "Traslado privado al aeropuerto de Cusco para su vuelo de conexión internacional vía Lima, llevando consigo recuerdos imborrables."}
        ]
    },
    {
        "id": 2,
        "title": "Machu Picchu & Amazon Tours",
        "slug": "machu-picchu-and-amazon-tours",
        "duration_days": 12,
        "category": "Naturaleza & Lujo",
        "country": "peru",
        "featured": True,
        "image": "https://images.unsplash.com/photo-1516426122078-c23e76319801?auto=format&fit=crop&w=1200&q=80",
        "tagline": "La perfecta unión entre la mística ciudadela inca y la biodiversidad indómita de la selva.",
        "overview": "Combine dos de las maravillas naturales y culturales más extraordinarias de la Tierra en un viaje de 12 días con ecolodges de ultralujo y trenes panorámicos.",
        "inclusions": [
            "Todos los vuelos internos en Perú (Lima - Cusco - Puerto Maldonado - Lima)",
            "Estadía de 4 noches en exclusivo ecolodge de lujo en la Reserva Nacional Tambopata",
            "Excursiones fluviales privadas en bote con guías naturalistas certificados",
            "Tren Hiram Bingham o Vistadome 360 hacia Machu Picchu",
            "Todas las comidas en la Amazonía preparadas con insumos autóctonos"
        ],
        "exclusions": ["Vuelos internacionales", "Seguro de viaje"],
        "itinerary": [
            {"day": 1, "title": "Bienvenida en Lima, la Ciudad de los Reyes", "description": "Llegada internacional y descanso en suite de lujo en el distrito de San Isidro."},
            {"day": 2, "title": "Vuelo a la Amazonía & Navegación Fluvial", "description": "Vuelo hacia Puerto Maldonado. Embarque en bote privado para adentrarse en la selva virgen. Caminata nocturna guiada."},
            {"day": 3, "title": "Lago Sandoval & Observación de Lobos de Río", "description": "Remo silencioso por el lago Sandoval avistando nutrias gigantes de río, guacamayos y monos aulladores."},
            {"day": 4, "title": "Puente Colgante de Dosel (Canopy Walkway)", "description": "Paseo a 30 metros de altura sobre la copa de los árboles para admirar tucanes y fauna del dosel selvático."},
            {"day": 5, "title": "De la Selva a los Andes: Vuelo a Cusco", "description": "Despedida de la selva y vuelo a Cusco. Traslado al Valle Sagrado para iniciar la etapa andina."},
            {"day": 6, "title": "Mercado Textil de Pisac y Fortificación de Ollantaytambo", "description": "Tradiciones vivas de tejido quechua y ascenso a la imponente fortaleza de piedra labrada."},
            {"day": 7, "title": "Tren Panorámico a Machu Picchu", "description": "Viaje a lo largo del cañón del río Urubamba. Tarde de exploración guiada por la ciudadela perdida."},
            {"day": 8, "title": "Segunda Entrada a la Maravilla & Aguas Calientes", "description": "Mañana libre para fotografía y ascenso a Huayna Picchu. Retorno a Cusco."},
            {"day": 9, "title": "Calles de Piedra y Templos de Cusco", "description": "Paseo por la Plaza de Armas, la Catedral y talleres de platería cusqueña."},
            {"day": 10, "title": "Día Libre en Cusco para Compras & Spa", "description": "Día a su propio ritmo con masajes andinos y compras de vicuña y alpaca de alta costura."},
            {"day": 11, "title": "Vuelo a Lima & Ruta Culinaria", "description": "Retorno a la capital para disfrutar de un tour gastronómico privado por Barranco."},
            {"day": 12, "title": "Retorno Internacional", "description": "Traslado al aeropuerto internacional con asistencia personalizada."}
        ]
    },
    {
        "id": 3,
        "title": "Inca Trail to Machu Picchu",
        "slug": "inca-trail-to-machu-picchu",
        "duration_days": 10,
        "category": "Aventura & Trekking",
        "country": "peru",
        "featured": False,
        "image": "https://images.unsplash.com/photo-1526392060635-9d6019884377?auto=format&fit=crop&w=1200&q=80",
        "tagline": "El sendero más legendario del planeta vivido con campamentos VIP y comodidades cinco estrellas.",
        "overview": "Recorra los 43 kilómetros de la calzada real incaica sin sacrificar el lujo: carpas espaciosas con camas elevadas, masajistas, duchas calientes y cocina gourmet de montaña.",
        "inclusions": [
            "Permisos oficiales del Camino Inca emitidos por el Ministerio de Cultura",
            "Campamento VIP: carpas amplias de altura completa, camas con edredones de plumas y calefacción",
            "Chef privado de expedición preparando menús gourmet de 3 tiempos",
            "Portadores experimentados encargados de todo el equipaje",
            "Brindis con champagne al cruzar la Puerta del Sol (Inti Punku)"
        ],
        "exclusions": ["Botas y bastones de trekking", "Vuelos internacionales"],
        "itinerary": [
            {"day": 1, "title": "Llegada a Lima", "description": "Recepción privada y traslado al hotel boutique."},
            {"day": 2, "title": "Vuelo a Cusco & Aclimatación en el Valle Sagrado", "description": "Día suave de aclimatación respirando aire puro en Urubamba."},
            {"day": 3, "title": "Inicio del Camino Inca — Km 82 a Wayllabamba", "description": "Encuentro con el equipo de porteadores y primeros pasos a lo largo del río Vilcanota."},
            {"day": 4, "title": "El Paso de la Mujer Muerta (Warmiwañusqa, 4,215 m)", "description": "Jornada cumbre de ascenso a través del bosque de queñuales. Al llegar al campamento, baño de pies calientes y masaje revitalizante."},
            {"day": 5, "title": "Túneles Incas & Campamento de Wiñay Wayna", "description": "Paso por Sayacmarca y Phuyupatamarca, 'El pueblo sobre las nubes'. Noche rodeada de orquídeas."},
            {"day": 6, "title": "Puerta del Sol & Entrada Triunfal a Machu Picchu", "description": "Amanecer en Inti Punku con la primera vista panorámica de la ciudadela. Noche en hotel de lujo en Aguas Calientes."},
            {"day": 7, "title": "Recorrido Profundo por Machu Picchu", "description": "Visita detallada a los sectores agrícolas y religiosos. Retorno en tren de primera clase a Cusco."},
            {"day": 8, "title": "Descanso y Celebración en Cusco", "description": "Día libre en la ciudad imperial con cena gourmet de celebración."},
            {"day": 9, "title": "Vuelo a Lima", "description": "Traslado a Lima y noche de descanso en Miraflores."},
            {"day": 10, "title": "Regreso Internacional", "description": "Conexión con su vuelo de retorno a casa."}
        ]
    },
    {
        "id": 4,
        "title": "Salkantay Trek to Machu Picchu",
        "slug": "salkantay-trek-to-machu-picchu",
        "duration_days": 13,
        "category": "Aventura de Alta Montaña",
        "country": "peru",
        "featured": False,
        "image": "https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=1200&q=80",
        "tagline": "Ruta de expedición virgen bajo la mirada del Apu Salkantay (6,271 m).",
        "overview": "Considerada por National Geographic entre las mejores caminatas del mundo. Cruce pasos glaciares y descienda a plantaciones de café orgánico y ceja de selva hacia Machu Picchu.",
        "inclusions": [
            "Alojamientos en lodges de montaña con hidromasaje o domos geodésicos de cristal",
            "Guías profesionales de alta montaña bilingües con certificación wilderness",
            "Mulas y caballos de apoyo para equipaje y emergencias",
            "Degustación privada en hacienda cafetalera de Santa Teresa",
            "Entrada VIP a Machu Picchu y tren panorámico"
        ],
        "exclusions": ["Vuelos internacionales", "Bolsa de dormir técnica (disponible en alquiler)"],
        "itinerary": [
            {"day": 1, "title": "Llegada a Lima", "description": "Recepción en el aeropuerto y descanso."},
            {"day": 2, "title": "Vuelo a Cusco", "description": "Llegada a la capital imperial y chequeo médico de aclimatación."},
            {"day": 3, "title": "Valle Sagrado & Terrazas de Pisac", "description": "Caminata suave de preparación entre ruinas incas."},
            {"day": 4, "title": "Fortaleza de Ollantaytambo", "description": "Aclimatación activa en el valle."},
            {"day": 5, "title": "Inicio del Trek: De Challacancha a Soraypampa", "description": "Ascenso hacia el campamento base con vistas al pico nevado Humantay."},
            {"day": 6, "title": "Laguna Turquesa de Humantay", "description": "Excursión a la mágica laguna glaciar esmeralda a 4,200 metros."},
            {"day": 7, "title": "El Paso Salkantay (4,630 m)", "description": "El punto más alto de la expedición frente al coloso de hielo. Descenso hacia Huayracmachay."},
            {"day": 8, "title": "Descenso al Bosque Nuboso de Collpapampa", "description": "Transición climática de la tundra andina a la exuberante selva alta."},
            {"day": 9, "title": "Ruta del Café Orgánico & Lucmabamba", "description": "Cosecha y tostado artesanal de granos de café arábica de exportación."},
            {"day": 10, "title": "Llactapata con Vista a Distancia de Machu Picchu", "description": "Llegada a las ruinas de Llactapata, observando la ciudadela inca desde la ladera opuesta."},
            {"day": 11, "title": "Hidroeléctrica a Aguas Calientes", "description": "Caminata llana al pie de la montaña sagrada hasta el hotel."},
            {"day": 12, "title": "La Maravilla de Machu Picchu", "description": "Visita completa de la ciudadela y tren panorámico de retorno a Cusco."},
            {"day": 13, "title": "Retorno a Lima y Vuelo a Casa", "description": "Fin de una expedición inolvidable."}
        ]
    },
    {
        "id": 5,
        "title": "The Lares Trek",
        "slug": "the-lares-trek",
        "duration_days": 7,
        "category": "Cultura Andina Viva",
        "country": "peru",
        "featured": False,
        "image": "https://images.unsplash.com/photo-1589556264800-08ae9e129a8c?auto=format&fit=crop&w=1200&q=80",
        "tagline": "Inmersión íntima en comunidades tejedoras andinas y senderos solitarios.",
        "overview": "El trekking ideal para quienes buscan autenticidad cultural: sin aglomeraciones, pernoctando en valles remotos donde el quechua es el idioma principal, con baños termales medicinales.",
        "inclusions": [
            "Acceso privado a comunidades indígenas quechuas de Huacahuasi y Patacancha",
            "Sesión privada en los baños termales volcánicos de Lares",
            "Campamentos confortables con calefacción portátil y carpa comedor alfombrada",
            "Tren Vistadome hacia Machu Picchu y estadía en Aguas Calientes"
        ],
        "exclusions": ["Vuelos internacionales"],
        "itinerary": [
            {"day": 1, "title": "Llegada a Cusco y Valle Sagrado", "description": "Traslado directo a hotel en Urubamba para reposo."},
            {"day": 2, "title": "Baños Termales de Lares & Inicio del Sendero", "description": "Baño relajante en aguas sulfurosas calientes antes de emprender la caminata hacia Kiswarani."},
            {"day": 3, "title": "Paso Condorpass & Lagunas Glaciares", "description": "Cruce del paso alto con vistas a manadas de alpacas y lagunas azules."},
            {"day": 4, "title": "Comunidad Textil de Huacahuasi", "description": "Intercambio cultural con maestras tejedoras y sus técnicas de teñido natural."},
            {"day": 5, "title": "Ollantaytambo & Tren hacia Machu Picchu", "description": "Descenso al Valle Sagrado y viaje en tren al pie del santuario."},
            {"day": 6, "title": "Exploración Privada de Machu Picchu", "description": "Guiado matutino en el santuario y retorno a Cusco en la tarde."},
            {"day": 7, "title": "Despedida en Cusco", "description": "Traslado al aeropuerto para su vuelo de salida."}
        ]
    },
    {
        "id": 6,
        "title": "Luxury Huayhuash Trek",
        "slug": "luxury-huayhuash-trek",
        "duration_days": 13,
        "category": "Expedición Extrema VIP",
        "country": "peru",
        "featured": False,
        "image": "https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80",
        "tagline": "La cordillera más sobrecogedora de los Andes peruanos recorrida con máximo confort.",
        "overview": "La Cordillera Huayhuash es la meca del montañismo mundial. 13 días atravesando pasos sobre los 4,800 metros, lagos color turquesa intenso y murallas de hielo verticales como el Siula Grande.",
        "inclusions": [
            "Logística integral de expedición: carpas domo dobles con camas de campaña, carpa ducha con agua caliente",
            "Mulas de carga y arrieros experimentados locales",
            "Guía de alta montaña certificado UIAGM",
            "Alimentación hipernutritiva diseñada por chef especialista en expediciones",
            "Oxígeno medicinal y teléfono satelital de emergencia Iridium"
        ],
        "exclusions": ["Equipo personal de alta montaña", "Vuelos internacionales"],
        "itinerary": [
            {"day": 1, "title": "Llegada a Lima", "description": "Descanso en hotel de San Isidro."},
            {"day": 2, "title": "Viaje Panorámico a Huaraz (3,050 m)", "description": "Traslado privado a través del Callejón de Huaylas con vistas a la Cordillera Blanca."},
            {"day": 3, "title": "Aclimatación en Laguna Churup (4,450 m)", "description": "Caminata de aclimatación junto a los picachos de roca de Huaraz."},
            {"day": 4, "title": "Huaraz a Cuartelwain — Puerta de Huayhuash", "description": "Ingreso al circuito de la cordillera e instalación del primer campamento de lujo."},
            {"day": 5, "title": "Paso Cacananpunta (4,700 m) & Laguna Mitucocha", "description": "Vistas frontales al imponente pico Jirishanca."},
            {"day": 6, "title": "Paso Carhuac (4,650 m) hacia Laguna Carhuacocha", "description": "El campamento con el reflejo más famoso del mundo: Yerupajá y Siula Grande."},
            {"day": 7, "title": "Paso Siula (4,830 m) & Las Tres Lagunas", "description": "Panorámica legendaria sobre las lagunas azuladas Siula, Quesillococha y Cangrajanca."},
            {"day": 8, "title": "Campamento Huayhuash a Viconga", "description": "Aguas termales naturales al aire libre al pie de glaciares andinos."},
            {"day": 9, "title": "Paso Cuyoc (5,000 m)", "description": "El punto más alto de la travesía con vista panorámica de 360 grados a la cordillera."},
            {"day": 10, "title": "Quebrada Calinca a Huayllapa", "description": "Descenso hacia el pintoresco pueblo tradicional de Huayllapa."},
            {"day": 11, "title": "Paso Tapush a Laguna Jahuacocha", "description": "Último campamento frente a la pared oeste del Yerupajá."},
            {"day": 12, "title": "Salida por Llamac y Retorno a Huaraz", "description": "Culminación del trekking y cena de celebración en Huaraz."},
            {"day": 13, "title": "Retorno a Lima & Vuelo Internacional", "description": "Traslado VIP a Lima para su vuelo internacional."}
        ]
    },
    {
        "id": 7,
        "title": "Luxury Amazon River Cruise",
        "slug": "luxury-amazon-river-cruise",
        "duration_days": 11,
        "category": "Crucero Fluvial de Lujo",
        "country": "peru",
        "featured": True,
        "image": "https://images.unsplash.com/photo-1516426122078-c23e76319801?auto=format&fit=crop&w=1200&q=80",
        "tagline": "Navegue el Amazonas y la Reserva Pacaya Samiria en embarcaciones boutique de 5 estrellas.",
        "overview": "Una travesía fluvial de ensueño a bordo del Aqua Nera o Delfin III. Suites con ventanales de suelo a techo, cocina de autor amazónica y lanchas privadas para avistar delfines rosados y fauna exótica.",
        "inclusions": [
            "4 noches de crucero todo incluido a bordo de embarcación de ultralujo",
            "Menú de alta cocina diseñado por renombrados chefs peruanos",
            "Excursiones diarias en botes skiff motorizados y kayaks",
            "Combinación con Cusco y Machu Picchu en hoteles Belmond",
            "Todos los vuelos internos en Perú incluidos"
        ],
        "exclusions": ["Licores premium de reserva", "Vuelos internacionales"],
        "itinerary": [
            {"day": 1, "title": "Llegada a Lima", "description": "Bienvenida personalizada y hospedaje en suite de lujo."},
            {"day": 2, "title": "Vuelo a Iquitos & Embarque en el Crucero", "description": "Traslado al puerto de Nauta y abordaje. Cóctel de bienvenida con pisco de frutas amazónicas mientras el barco se adentra en el río Amazonas."},
            {"day": 3, "title": "Reserva Pacaya Samiria & Delfines Rosados", "description": "Navegación al amanecer para avistar los fascinantes delfines rosados de agua dulce."},
            {"day": 4, "title": "Selva Inundada & Pesca de Pirañas", "description": "Expedición en lanchas auxiliares por caños angostos y pesca deportiva de pirañas con liberación."},
            {"day": 5, "title": "Comunidad Nativa & Centro de Rescate Amazónico", "description": "Encuentro con chamanes botánicos locales y visita al centro de manatíes en Iquitos."},
            {"day": 6, "title": "Vuelo de la Selva a Cusco", "description": "Conexión aérea hacia la cordillera andina y traslado al Valle Sagrado."},
            {"day": 7, "title": "Valle Sagrado & Alfarería Ancestral", "description": "Descanso y visitas privadas en Urubamba."},
            {"day": 8, "title": "Tren de Lujo a Machu Picchu", "description": "Viaje panorámico a Aguas Calientes y recorrido guiado por el santuario."},
            {"day": 9, "title": "Machu Picchu a Cusco Imperial", "description": "Mañana en el santuario y retorno a Cusco."},
            {"day": 10, "title": "Cusco Colonial y Mercado de San Pedro", "description": "Visita artística y de diseño andino contemporáneo."},
            {"day": 11, "title": "Retorno a Lima y Vuelo a Casa", "description": "Despedida del Perú con concierge en aeropuerto."}
        ]
    },
    {
        "id": 8,
        "title": "Peru Amazon Tours",
        "slug": "peru-amazon-tours",
        "duration_days": 12,
        "category": "Multidestino & Selva",
        "country": "peru",
        "featured": False,
        "image": "https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=1200&q=80",
        "tagline": "La trilogía peruana: Selva Amazónica, Santuario de Machu Picchu y Lago Titicaca.",
        "overview": "El itinerario más completo de maravillas naturales y arqueológicas. Desde el manto verde del río Madre de Dios hasta las aguas místicas del Titicaca y las cumbres de los Incas.",
        "inclusions": [
            "Ecolodge de lujo en Tambopata con pensión completa",
            "Tren Hiram Bingham a Machu Picchu",
            "Catamarán privado a las islas de Taquile y Uros en el Lago Titicaca",
            "Vuelos domésticos en Perú incluidos",
            "Guías privados en todos los destinos"
        ],
        "exclusions": ["Vuelos internacionales", "Seguro de viaje"],
        "itinerary": [
            {"day": 1, "title": "Llegada a Lima", "description": "Recepción y traslado a Miraflores."},
            {"day": 2, "title": "Vuelo a Tambopata", "description": "Ingreso a la selva en bote por el río Tambopata."},
            {"day": 3, "title": "Colpa de Guacamayos & Lago Sandoval", "description": "Espectáculo natural de cientos de guacamayos alimentándose de arcilla mineral."},
            {"day": 4, "title": "Vuelo a Cusco & Valle Sagrado", "description": "Paso de la Amazonía al valle interandino."},
            {"day": 5, "title": "Mercados Andinos & Ollantaytambo", "description": "Artesanía textil y fortalezas de piedra."},
            {"day": 6, "title": "Machu Picchu en Primera Clase", "description": "Exploración de la maravilla del mundo."},
            {"day": 7, "title": "Cusco Imperial", "description": "Templos incas y arquitectura barroca."},
            {"day": 8, "title": "Ruta del Sol hacia Puno", "description": "Viaje panorámico cruzando el paso de La Raya (4,335 m) con visitas guiadas a iglesias andinas."},
            {"day": 9, "title": "Lago Titicaca: Islas Flotantes de los Uros", "description": "Navegación privada por el lago navegable más alto del mundo."},
            {"day": 10, "title": "Isla de Taquile & Titilaka Lodge", "description": "Tradición textil protegida por la UNESCO y descanso de lujo frente al lago."},
            {"day": 11, "title": "Chullpas de Sillustani & Vuelo a Lima", "description": "Torres funerarias preincas y retorno a la capital."},
            {"day": 12, "title": "Retorno Internacional", "description": "Conexión internacional."}
        ]
    },
    {
        "id": 9,
        "title": "Peru Adventure Tours",
        "slug": "peru-adventure-tours",
        "duration_days": 12,
        "category": "Aventura Activa & Adrenalina",
        "country": "peru",
        "featured": False,
        "image": "https://images.unsplash.com/photo-1526392060635-9d6019884377?auto=format&fit=crop&w=1200&q=80",
        "tagline": "Rafting de aguas bravas, ciclismo de montaña y escalada con hoteles boutique de descanso.",
        "overview": "Diseñado para espíritus intrépidos que buscan superar sus límites deportivos de día y relajarse en spas 5 estrellas de noche.",
        "inclusions": [
            "Rafting privado clase III-IV en el cañón del río Urubamba",
            "Descenso en bicicleta de montaña por el abra Málaga",
            "Vía ferrata y tirolesa sobre el Valle Sagrado",
            "Vehículo privado 4x4 de asistencia constante",
            "Entradas a Machu Picchu y tren panorámico"
        ],
        "exclusions": ["Seguro de deportes de aventura", "Vuelos internacionales"],
        "itinerary": [
            {"day": 1, "title": "Lima", "description": "Arribo y preparación técnica."},
            {"day": 2, "title": "Vuelo a Cusco & Valle Sagrado", "description": "Chequeo de equipos de montaña."},
            {"day": 3, "title": "Rafting en el Río Vilcanota", "description": "Descenso en balsa neumática con rápidos emocionantes."},
            {"day": 4, "title": "Vía Ferrata & Noche en Domos Colgantes", "description": "Escalada vertical en roca y pernocte en cápsulas de cristal colgantes en la montaña."},
            {"day": 5, "title": "Bicicleta de Montaña en Maras & Moray", "description": "Ruta off-road a través de senderos agrícolas incas."},
            {"day": 6, "title": "Trekking Corto a Machu Picchu", "description": "Caminata de 1 día por el Camino Inca entrando por Wiñay Wayna."},
            {"day": 7, "title": "Amanecer en Machu Picchu & Escalada Huayna Picchu", "description": "Ascenso a la cima escarpada de Huayna Picchu."},
            {"day": 8, "title": "Retorno a Cusco & Downhill", "description": "Ruta de descenso en bicicleta en las colinas de Sacsayhuamán."},
            {"day": 9, "title": "Cañón del Colca: En Busca del Cóndor", "description": "Rumbo a Arequipa para realizar trekking en uno de los cañones más profundos de la Tierra."},
            {"day": 10, "title": "Cruz del Cóndor & Termas La Calera", "description": "Vuelo majestuoso del cóndor andino a pocos metros."},
            {"day": 11, "title": "Arequipa Colonial 'La Ciudad Blanca'", "description": "Monasterio de Santa Catalina y picanterías."},
            {"day": 12, "title": "Vuelo a Lima & Retorno a Casa", "description": "Fin del viaje de aventura."}
        ]
    },
    {
        "id": 10,
        "title": "Peru Culinary Tours",
        "slug": "peru-culinary-tours",
        "duration_days": 10,
        "category": "Gastronomía & Vinos",
        "country": "peru",
        "featured": True,
        "image": "https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1200&q=80",
        "tagline": "Un viaje sensorial desde los 50 Best Restaurants en Lima hasta la cocina ancestral andina.",
        "overview": "Mesa reservada en Central, Maido y Astrid & Gastón. Talleres privados de ceviche con chefs galardonados, recolección de tubérculos a 3,800 msnm y maridaje con destilados de pisco y vinos peruanos.",
        "inclusions": [
            "Reservas VIP garantizadas en los restaurantes The World's 50 Best (Central y Maido)",
            "Experiencia gastronómica inmersiva Mil Centro en Moray de Virgilio Martínez",
            "Clase privada de ceviche y tiraditos con insumos del mar de Grau",
            "Pachamanca tradicional en hacienda privada con cata de pisco artesanal",
            "Hoteles 5 estrellas en Lima, Valle Sagrado y Cusco"
        ],
        "exclusions": ["Botellas de vino fuera de maridaje acordado", "Vuelos internacionales"],
        "itinerary": [
            {"day": 1, "title": "Llegada a Lima — Coctelería de Autor", "description": "Recepción privada y brindis con cócteles de pisco premium en Barranco."},
            {"day": 2, "title": "Mercado de Surquillo & Taller de Ceviche", "description": "Descubrimiento de frutas amazónicas, ajíes nativos y mariscos frescos."},
            {"day": 3, "title": "Menú Degustación en Central", "description": "Experiencia cumbre recorriendo las altitudes del Perú en el mejor restaurante del mundo."},
            {"day": 4, "title": "Vuelo a Cusco y Hacienda en Urubamba", "description": "Llegada al Valle Sagrado. Cena campestre junto a la fogata."},
            {"day": 5, "title": "Mil Centro en Moray: Ecosistemas de Altura", "description": "Almuerzo conceptual en el laboratorio gastronómico de altura de Mater Iniciativa."},
            {"day": 6, "title": "Pachamanca Ancestral & Destilería de Pisco", "description": "Cocción milenaria bajo tierra con piedras volcánicas calientes."},
            {"day": 7, "title": "Tren Panorámico a Machu Picchu", "description": "Almuerzo en restaurante frente al río y visita guiada a la ciudadela."},
            {"day": 8, "title": "Retorno a Cusco & Taller de Cacao Nativo Chuncho", "description": "Elaboración de barras de chocolate fino con cacao cusqueño de aroma."},
            {"day": 9, "title": "Mercado de San Pedro & Banquete de Clausura en Cicciolina", "description": "Última noche con cena neomaridada en Cusco."},
            {"day": 10, "title": "Despedida en Lima", "description": "Retorno a casa con canasta gourmet de obsequio."}
        ]
    },
    {
        "id": 11,
        "title": "Peru Family Travel",
        "slug": "peru-family-travel",
        "duration_days": 10,
        "category": "Familias & Cultura",
        "country": "peru",
        "featured": False,
        "image": "https://images.unsplash.com/photo-1511895426328-dc8714191300?auto=format&fit=crop&w=1200&q=80",
        "tagline": "Aventuras enriquecedoras y flexibles para unir generaciones a través de los Andes.",
        "overview": "Diseñado para familias con niños de todas las edades. Ritmo relajado, hoteles con jardines y actividades interactivas para aprender sobre el imperio inca jugando.",
        "inclusions": [
            "Guía privado especializado en pedagogía y dinámicas infantiles",
            "Visita a granja privada de alpacas y vicuñas en el Valle Sagrado",
            "Tren Vistadome 360 con shows de danzas a bordo",
            "Habitaciones familiares comunicadas garantizadas"
        ],
        "exclusions": ["Vuelos internacionales"],
        "itinerary": [
            {"day": 1, "title": "Lima", "description": "Llegada y bienvenida familiar."},
            {"day": 2, "title": "Circuito Mágico del Agua en Lima", "description": "Espectáculo nocturno de fuentes de agua láser y música interactiva."},
            {"day": 3, "title": "Vuelo a Cusco & Finca de Camélidos", "description": "Contacto directo con llamas y alpacas bebitas."},
            {"day": 4, "title": "Ciclismo Fácil & Pic-nic Andino", "description": "Paseo en bicicleta suave por senderos planos del valle."},
            {"day": 5, "title": "Machu Picchu: Búsqueda del Tesoro Inca", "description": "Descubrimiento de la ciudadela con mapa lúdico para niños."},
            {"day": 6, "title": "Regreso a Cusco en Tren Panorámico", "description": "Tarde libre en la piscina temperada del hotel."},
            {"day": 7, "title": "Planetarium Cusco: Leyendas de las Estrellas", "description": "Observación de constelaciones incas en telescopios profesionales."},
            {"day": 8, "title": "Día en Familia en Cusco", "description": "Compras de recuerdos y artesanías."},
            {"day": 9, "title": "Vuelo a Lima", "description": "Tarde de helados artesanales en Barranco."},
            {"day": 10, "title": "Vuelo de Retorno", "description": "Despedida del Perú."}
        ]
    },
    {
        "id": 12,
        "title": "Peru Family Vacation",
        "slug": "peru-family-vacation",
        "duration_days": 8,
        "category": "Familias & Talleres",
        "country": "peru",
        "featured": False,
        "image": "https://images.unsplash.com/photo-1511895426328-dc8714191300?auto=format&fit=crop&w=1200&q=80",
        "tagline": "Taller de cerámica en Urubamba, fábrica de chocolate en Cusco y la magia de Machu Picchu.",
        "overview": "Una semana inolvidable de talleres artesanales prácticos: moldee su propia vasija de arcilla, temple su tableta de chocolate y descubra Machu Picchu en familia.",
        "inclusions": [
            "Taller privado de alfarería en el taller de Pablo Seminario en Urubamba",
            "Taller de chocolatería artesanal con granos de cacao virgen",
            "Tren Vistadome ida y vuelta con merienda andina",
            "Todas las entradas y traslados privados"
        ],
        "exclusions": ["Vuelos internacionales"],
        "itinerary": [
            {"day": 1, "title": "Llegada a Lima", "description": "Hotel en Miraflores."},
            {"day": 2, "title": "Vuelo a Cusco y Descenso al Valle Sagrado", "description": "Tarde de aclimatación."},
            {"day": 3, "title": "Taller de Cerámica en Urubamba", "description": "Creación de piezas de arte en arcilla inspiradas en culturas precolombinas."},
            {"day": 4, "title": "Ollantaytambo & Tren a Machu Picchu", "description": "Paseo por las callejuelas incas vivas y viaje en tren."},
            {"day": 5, "title": "La Maravilla de Machu Picchu", "description": "Visita completa de la ciudadela y retorno a Cusco."},
            {"day": 6, "title": "Taller de Chocolate en Cusco", "description": "Tostado, pelado, molienda y moldeado de chocolate propio."},
            {"day": 7, "title": "Fortaleza de Sacsayhuamán", "description": "Los bloques de piedra más grandes del imperio incaico."},
            {"day": 8, "title": "Vuelo de Salida vía Lima", "description": "Retorno a casa."}
        ]
    },
    {
        "id": 13,
        "title": "Family Machu Picchu Vacation",
        "slug": "family-machu-picchu-vacation",
        "duration_days": 14,
        "category": "Familias Gran Tour",
        "country": "peru",
        "featured": False,
        "image": "https://images.unsplash.com/photo-1511895426328-dc8714191300?auto=format&fit=crop&w=1200&q=80",
        "tagline": "El viaje familiar más completo: Costa, Selva Amazónica, Andes y Machu Picchu.",
        "overview": "14 días diseñados para familias que no quieren perderse nada. Reúne la aventura amazónica, el descanso en haciendas andinas y el misterio arqueológico inca.",
        "inclusions": [
            "3 noches en Ecolodge de lujo en la Reserva Tambopata",
            "Hacienda andina privada en el Valle Sagrado",
            "Tren Belmond Hiram Bingham o Vistadome para toda la familia",
            "Todas las actividades guiadas privadas adaptadas para niños y adultos"
        ],
        "exclusions": ["Vuelos internacionales"],
        "itinerary": [
            {"day": 1, "title": "Lima", "description": "Llegada familiar."},
            {"day": 2, "title": "Lima de Niños & Museo Larco", "description": "Jardines y tesoros de oro."},
            {"day": 3, "title": "Vuelo a Puerto Maldonado (Amazonas)", "description": "Llegada al ecolodge en bote."},
            {"day": 4, "title": "Selva Viva & Caimaneo Nocturno", "description": "Búsqueda de caimanes y ranas arborícolas."},
            {"day": 5, "title": "Canopy Walkway & Jardín Botánico", "description": "Plantas medicinales y puentes colgantes."},
            {"day": 6, "title": "Vuelo a Cusco & Valle Sagrado", "description": "Descanso andino."},
            {"day": 7, "title": "Pisac y Granja de Alpacas", "description": "Mercado artesanal y animales andinos."},
            {"day": 8, "title": "Maras y Moray", "description": "Salineras blancas y círculos agrícolas."},
            {"day": 9, "title": "Machu Picchu Primera Entrada", "description": "Llegada en tren panorámico."},
            {"day": 10, "title": "Machu Picchu Segunda Visita & Retorno", "description": "Retorno a Cusco."},
            {"day": 11, "title": "San Blas y Templos de Cusco", "description": "Historia y arte cusqueño."},
            {"day": 12, "title": "Paseo a Caballo Paso Peruano", "description": "Paseo ecuestre por hacienda andina."},
            {"day": 13, "title": "Vuelo a Lima & Cena de Despedida", "description": "Celebración final de viaje."},
            {"day": 14, "title": "Vuelo Internacional", "description": "Retorno a casa."}
        ]
    },
    {
        "id": 14,
        "title": "Romantic Peru Honeymoon",
        "slug": "romantic-peru-honeymoon",
        "duration_days": 13,
        "category": "Romance & Luna de Miel",
        "country": "peru",
        "featured": True,
        "image": "https://images.unsplash.com/photo-1510414842594-a61c69b5ae57?auto=format&fit=crop&w=1200&q=80",
        "tagline": "Una escapada íntima y exclusiva entre suites palaciegas, trenes de lujo y lagos sagrados.",
        "overview": "Diseñado para parejas que celebran su unión: picnics privados con champagne frente a lagunas glaciares, masajes en pareja con aceites florales autóctonos y cenas a la luz de las velas en claustros coloniales.",
        "inclusions": [
            "Upgrades de habitación garantizados en hoteles Belmond y suites presidenciales",
            "Tren de ultra-lujo Belmond Hiram Bingham con música en vivo y cena gourmet",
            "Sesión privada de spa andino con flores y piedras calientes",
            "Ceremonia mística de bendición de pareja guiada por un Paqo andino",
            "Picnic privado con champagne en laguna glaciar secreta"
        ],
        "exclusions": ["Vuelos internacionales"],
        "itinerary": [
            {"day": 1, "title": "Llegada Romántica a Lima", "description": "Bienvenida con champagne en su suite de Miraflores."},
            {"day": 2, "title": "Atardecer en Velero Privado por la Costa", "description": "Navegación al atardecer frente a los acantilados de Lima."},
            {"day": 3, "title": "Vuelo a Cusco & Retiro Spa en el Valle Sagrado", "description": "Masaje andino para dos en resort de lujo."},
            {"day": 4, "title": "Caballos de Paso & Picnic en Laguna Glaciar", "description": "Paseo ecuestre hacia un lago aislado con almuerzo servido por mozo privado."},
            {"day": 5, "title": "Hiram Bingham a Machu Picchu", "description": "El tren más romántico de América del Sur."},
            {"day": 6, "title": "Santuario de Machu Picchu & Té en el Bosque Nuboso", "description": "Visita sin prisas de la ciudadela."},
            {"day": 7, "title": "Cusco & Claustro Monasterio", "description": "Estadía en el legendario Belmond Hotel Monasterio con música barroca en el patio."},
            {"day": 8, "title": "Ceremonia Andina de Renovación de Votos", "description": "Ritual sagrado de unión con la Pachamama."},
            {"day": 9, "title": "Tren Belmond Andean Explorer hacia Puno", "description": "Camarote de lujo en el tren dormitorio más exclusivo de Sudamérica."},
            {"day": 10, "title": "Amanecer en el Lago Titicaca", "description": "Vistas infinitas desde su cabina ferroviaria."},
            {"day": 11, "title": "Atardecer Privado en Titilaka Lodge", "description": "Cata de vinos al caer el sol sobre las aguas del lago sagrado."},
            {"day": 12, "title": "Retorno a Lima & Cena Romántica", "description": "Última noche en restaurante íntimo frente al mar."},
            {"day": 13, "title": "Despedida del Perú", "description": "Traslado VIP al aeropuerto internacional."}
        ]
    },
    {
        "id": 15,
        "title": "Signature Peru Luxury Tours",
        "slug": "signature-peru-luxury-tours",
        "duration_days": 9,
        "category": "Lujo Signature",
        "country": "peru",
        "featured": True,
        "image": "https://images.unsplash.com/photo-1526392060635-9d6019884377?auto=format&fit=crop&w=1200&q=80",
        "tagline": "El circuito insignia de Unu Raymi que reúne lo más excelso del Perú en 9 días.",
        "overview": "El resumen perfecto de sofisticación, arqueología andina y servicio de guante blanco. Ideal para viajeros exigentes con tiempo acotado que buscan la máxima calidad en cada escala.",
        "inclusions": [
            "Todos los hoteles de categoría Luxury 5 estrellas (Lima, Urubamba, Machu Picchu, Cusco)",
            "Vuelos domésticos en clase preferencial",
            "Tren Hiram Bingham a Machu Picchu",
            "Guía privado máster bilingüe y anfitrión dedicado en cada ciudad"
        ],
        "exclusions": ["Vuelos internacionales"],
        "itinerary": [
            {"day": 1, "title": "Lima de Lujo", "description": "Recepción VIP y cena en restaurante de alta cocina marina."},
            {"day": 2, "title": "Tesoros Artísticos de Lima", "description": "Colecciones de arte virreinal y precolombino."},
            {"day": 3, "title": "Vuelo a Cusco y Valle Sagrado", "description": "Aclimatación en el valle entre jardines andinos."},
            {"day": 4, "title": "Maras, Moray & Almuerzo Privado", "description": "Las joyas arqueológicas del Valle Sagrado."},
            {"day": 5, "title": "Hiram Bingham a Machu Picchu", "description": "Llegada estelar al santuario histórico."},
            {"day": 6, "title": "Amanecer en Machu Picchu & Cusco", "description": "Segunda visita a la ciudadela y tren a Cusco."},
            {"day": 7, "title": "Cusco: La Capital del Imperio del Sol", "description": "Coricancha, Catedral y Sacsayhuamán."},
            {"day": 8, "title": "Día Exclusivo en Cusco & Spa", "description": "Compras privadas de vicuña y cena de gala."},
            {"day": 9, "title": "Vuelo a Lima y Conexión Internacional", "description": "Fin de los servicios Unu Raymi."}
        ]
    },
    {
        "id": 16,
        "title": "Southern Peru Itinerary",
        "slug": "southern-peru-itinerary",
        "duration_days": 13,
        "category": "Gran Circuito del Sur",
        "country": "peru",
        "featured": False,
        "image": "https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?auto=format&fit=crop&w=1200&q=80",
        "tagline": "La gran ruta del sur: Lima, Arequipa, Cañón del Colca, Lago Titicaca, Cusco y Machu Picchu.",
        "overview": "Un recorrido monumental a través de los diversos pisos ecológicos del sur peruano: desiertos volcánicos, cañones abisales, el altiplano titicaqueño y los valles sagrados de los Incas.",
        "inclusions": [
            "Hoteles de lujo y lodges boutique en Arequipa, Colca, Puno, Urubamba y Cusco",
            "Observación guiada del cóndor andino en el Cañón del Colca",
            "Navegación privada en el Lago Titicaca",
            "Tren panorámico a Machu Picchu",
            "Vehículos privados con chofer durante toda la travesía terrestre"
        ],
        "exclusions": ["Vuelos internacionales"],
        "itinerary": [
            {"day": 1, "title": "Lima", "description": "Llegada y hotel en San Isidro."},
            {"day": 2, "title": "Vuelo a Arequipa 'La Ciudad Blanca'", "description": "Arquitectura de sillar volcánico y claustros de Santa Catalina."},
            {"day": 3, "title": "Hacia el Cañón del Colca", "description": "Viaje a través de la Reserva Nacional de Salinas y Aguada Blanca viendo vicuñas salvajes."},
            {"day": 4, "title": "Cruz del Cóndor & Termas Naturales", "description": "Avistamiento del vuelo del cóndor sobre el cañón."},
            {"day": 5, "title": "Travesía del Altiplano hacia el Lago Titicaca", "description": "Paisajes lunares andinos hasta Puno."},
            {"day": 6, "title": "Islas Flotantes de los Uros & Taquile", "description": "Cultura milenaria en las aguas del lago sagrado."},
            {"day": 7, "title": "Ruta de los Virreyes hacia Cusco", "description": "Ruta en auto privado pasando por la capilla sixtina andina de Andahuaylillas."},
            {"day": 8, "title": "Valle Sagrado de los Incas", "description": "Mercado de Pisac y fortaleza de Ollantaytambo."},
            {"day": 9, "title": "Machu Picchu", "description": "Tren panorámico y visita al santuario inca."},
            {"day": 10, "title": "Aguas Calientes a Cusco", "description": "Retorno a la ciudad imperial."},
            {"day": 11, "title": "Sacsayhuamán y Calles de Cusco", "description": "Tarde histórica privada."},
            {"day": 12, "title": "Vuelo a Lima", "description": "Tarde de compras y gastronomía."},
            {"day": 13, "title": "Regreso Internacional", "description": "Vuelo a casa."}
        ]
    },
    {
        "id": 17,
        "title": "Tambopata Peruvian Amazon",
        "slug": "tambopata-peruvian-amazon",
        "duration_days": 6,
        "category": "Ecoturismo & Selva",
        "country": "peru",
        "featured": False,
        "image": "https://images.unsplash.com/photo-1516426122078-c23e76319801?auto=format&fit=crop&w=1200&q=80",
        "tagline": "Inmersión profunda en la Reserva Nacional Tambopata con ecolodges galardonados.",
        "overview": "Una aventura ecológica sin igual en el corazón de la cuenca amazónica del río Madre de Dios. Diseñado para amantes de la naturaleza que buscan conectar con la selva primaria con máximo respeto ambiental y confort.",
        "inclusions": [
            "Estadía en ecolodge de lujo galardonado en Tambopata",
            "Todas las comidas amazónicas gourmet con ingredientes orgánicos de la selva",
            "Excursiones diurnas y nocturnas con guías biólogos y naturalistas nativos",
            "Botes fluviales privados y equipamiento de seguridad de selva",
            "Traslados desde y hacia el aeropuerto de Puerto Maldonado"
        ],
        "exclusions": ["Vuelos hacia/desde Puerto Maldonado", "Gastos personales"],
        "itinerary": [
            {"day": 1, "title": "Llegada a Puerto Maldonado & Navegación Fluvial", "description": "Bienvenida en el aeropuerto y embarque en lancha techada por el río Madre de Dios hasta el lodge. Caminata introductoria por el bosque."},
            {"day": 2, "title": "Expedición al Lago Sandoval & Lobos de Río", "description": "Navegación silenciosa en canoa a remo para observar nutrias gigantes de río y garzas tigre."},
            {"day": 3, "title": "Canopy Walkway & Tirolesa en la Selva", "description": "Paseo por puentes colgantes suspendidos entre las copas de los castaños gigantes."},
            {"day": 4, "title": "Collpa de Loros & Chacra Nativa", "description": "Avistamiento de loros y pericos comiendo arcilla mineral, seguido de degustación de frutas exóticas en huerto tradicional."},
            {"day": 5, "title": "Etnobotánica & Safari Nocturno de Caimanes", "description": "Aprenda sobre las plantas medicinales que la ciencia moderna estudia y busque caimanes blancos en las orillas del río."},
            {"day": 6, "title": "Despedida de la Amazonía", "description": "Amanecer con el canto de las aves, desayuno selvático y traslado al aeropuerto de Puerto Maldonado."}
        ]
    }
]

with open('database/data/tours.json', 'w', encoding='utf-8') as f:
    json.dump(tours, f, ensure_ascii=False, indent=2)

print(f"✓ Guardados exitosamente {len(tours)} tours completos de Perú en database/data/tours.json")
