<?php
declare(strict_types=1);

// Contenido editorial local. No se genera ni se sobrescribe automáticamente.
return [
    'categories' => [
        'perito' => [
            'number' => '01',
            'name' => 'DRO / PERITO',
            'description' => 'Responsiva, dictámenes y valuación',
            'services' => ['dro-y-corresponsable', 'dictamen-estructural', 'revisiones-electricas', 'valuacion-inmobiliaria', 'valuacion-de-arte'],
        ],
        'proyecto' => [
            'number' => '02',
            'name' => 'Proyecto arquitectónico',
            'description' => 'Diseño y proyecto ejecutivo',
            'services' => ['estaciones-de-servicio', 'diseno-residencial', 'diseno-remodelaciones', 'diseno-comercial', 'centros-escolares', 'casas-ecologicas', 'diseno-industrial'],
        ],
        'construccion' => [
            'number' => '03',
            'name' => 'Construcción',
            'description' => 'Ejecución y supervisión de obra',
            'services' => ['obra-nueva', 'construccion-remodelaciones', 'ampliaciones', 'murales-pintura-escultura'],
        ],
        'complementarios' => [
            'number' => '04',
            'name' => 'Servicios complementarios',
            'description' => 'Presupuestos, planos y topografía',
            'services' => ['presupuesto-de-obra', 'maquila-de-planos', 'levantamientos-topograficos'],
        ],
    ],
    'services' => [
        'dro-y-corresponsable' => [
            'legacy' => '24_dro-y-corresponsable-en-seguridad-estructural-queretaro.php',
            'path' => '/servicios/dro-y-corresponsable',
            'category' => 'perito',
            'number' => '1.1',
            'name' => 'DRO',
            'title' => 'DRO y corresponsable en seguridad estructural | Arquitectos Trabajando C+S Estudio',
            'description' => 'Director Responsable de Obra avalado por el CAEQ Colegio de Arquitectos del Estado de Querétaro. DRO para obra nueva, ampliación, remodelación, fusión o subdivisión de predios, regularización de obras.',
            'heading' => 'DRO y corresponsable en seguridad estructural',
            'image' => 'assets/img/cat-perito.jpg',
            'alt' => 'Fachada de bodega industrial construida por el estudio',
            'body' => '<p><strong>Director Responsable de Obra</strong> avalado por el CAEQ Colegio de Arquitectos del Estado de Querétaro.</p>
        <p>DRO para obra nueva, ampliación, remodelación, fusión o subdivisión de predios, regularización de obras.</p>',
        ],
        'dictamen-estructural' => [
            'legacy' => '23_Dictamen-estructural-en-Queretaro.php',
            'path' => '/servicios/dictamen-estructural',
            'category' => 'perito',
            'number' => '1.2',
            'name' => 'Perito Dictamen Estructural y Eléctrico',
            'title' => 'Perito dictamen estructural y eléctrico en Querétaro | Arquitectos Trabajando C+S Estudio',
            'description' => 'Estamos avalados ante el Colegio de Arquitectos para realizar los dictámenes estructurales requeridos por Protección Civil.',
            'heading' => 'Dictamen estructural',
            'image' => 'assets/img/cat-perito.jpg',
            'alt' => 'Fachada de bodega industrial construida por el estudio',
            'body' => '<p>Estamos avalados ante el Colegio de Arquitectos para realizar los dictámenes estructurales requeridos por Protección Civil para: Escuelas, Industrias, Restaurantes con licencia de alcohol, Centros comerciales, que por su giro lo requieran.</p>',
        ],
        'revisiones-electricas' => [
            'legacy' => '27_Revisiones-electricas-Queretaro.php',
            'path' => '/servicios/revisiones-electricas',
            'category' => 'perito',
            'number' => '1.3',
            'name' => 'Corresponsable en Seguridad Estructural e Instalaciones',
            'title' => 'Revisiones eléctricas en Querétaro | Arquitectos Trabajando C+S Estudio',
            'description' => 'Estamos avalados ante el Colegio de Arquitectos para realizar Revisiones Eléctricas para alto y medio riesgo.',
            'heading' => 'Revisiones eléctricas',
            'image' => 'assets/img/cat-perito.jpg',
            'alt' => 'Fachada de bodega industrial construida por el estudio',
            'body' => '<p>Estamos avalados ante el Colegio de Arquitectos para realizar Revisiones Eléctricas para alto y medio riesgo.</p>',
        ],
        'valuacion-inmobiliaria' => [
            'legacy' => '22_Valuacion-Inmobiliaria-Queretaro.php',
            'path' => '/servicios/valuacion-inmobiliaria',
            'category' => 'perito',
            'number' => '1.4',
            'name' => 'Valuación Comercial',
            'title' => 'Valuación inmobiliaria e industrial en Querétaro | Arquitectos Trabajando C+S Estudio',
            'description' => 'Soporte técnico y asesoría para conocer el avalúo comercial o de mercado de inmuebles, maquinaria y equipo industrial o de oficina.',
            'heading' => 'Valuación inmobiliaria e industrial',
            'image' => 'assets/img/cat-perito.jpg',
            'alt' => 'Fachada de bodega industrial construida por el estudio',
            'body' => '<p>Brindamos a nuestro cliente soporte técnico y asesoría para que conozca el avalúo comercial o de mercado de los activos:</p>
        <ul>
          <li>Inmuebles como: Terrenos, Casas Habitacionales, Plantas industriales, Oficinas, Hoteles o Construcciones Especializadas.</li>
          <li>Maquinaria y Equipo industrial o de oficina.</li>
        </ul>',
        ],
        'valuacion-de-arte' => [
            'legacy' => '28_Valuacion-de-arte-Queretaro.php',
            'path' => '/servicios/valuacion-de-arte',
            'category' => 'perito',
            'number' => '1.5',
            'name' => 'Valuación de arte',
            'title' => 'Valuación de arte en Querétaro | Arquitectos Trabajando C+S Estudio',
            'description' => 'Asesoría para la valuación de pintura, escultura y otras obras de arte en Querétaro, a partir de sus características, documentación y referencias de mercado.',
            'heading' => 'Valuación de arte en Querétaro',
            'image' => 'assets/img/cat-perito.jpg',
            'alt' => 'Fachada de bodega industrial construida por el estudio',
            'body' => '<p>Conocer el valor de una obra de arte requiere estudiar tanto la pieza como su contexto. Te orientamos para definir el alcance de una valuación de pintura, escultura u otras manifestaciones artísticas, de acuerdo con el propósito de la consulta y la información disponible.</p>
        <h2>Información para evaluar una obra</h2>
        <p>Se consideran aspectos como autoría documentada, técnica, materiales, dimensiones, fecha, procedencia y estado de conservación. Las referencias de obras comparables permiten analizar su relación con el mercado a una fecha determinada.</p>
        <ul>
          <li>Identificación y registro fotográfico de la pieza.</li>
          <li>Revisión de facturas, certificados y antecedentes disponibles.</li>
          <li>Descripción del estado de conservación y características relevantes.</li>
          <li>Definición del objetivo, alcance y fecha de referencia de la valoración.</li>
        </ul>
        <p>Una estimación de valor no equivale a un certificado de autenticidad ni garantiza un precio de venta. Cuando la autoría o los materiales requieren un estudio especializado, este se plantea como una revisión adicional.</p>
        <p>Para iniciar la consulta, envíanos fotografías del frente, reverso y firma, las medidas y la documentación con la que cuentes. Indícanos también para qué necesitas la valuación.</p>',
        ],
        'estaciones-de-servicio' => [
            'legacy' => '1_Diseno-Arquitectonico-estaciones-de-servicio-Queretaro.php',
            'path' => '/servicios/estaciones-de-servicio',
            'category' => 'proyecto',
            'number' => '2.1',
            'name' => 'Estaciones de Servicios',
            'title' => 'Diseño de estaciones de servicio en Querétaro | Arquitectos Trabajando C+S Estudio',
            'description' => 'Diseño arquitectónico y proyecto ejecutivo de estaciones de servicio en Querétaro.',
            'heading' => 'Diseño Arquitectónico de Estaciones de Servicio',
            'image' => 'assets/img/cat-proyecto.jpg',
            'alt' => 'Residencia de dos niveles con pórtico y ventanales',
            'body' => '',
        ],
        'diseno-residencial' => [
            'legacy' => '2_Diseno-Arquitectonico-Residencial-Queretaro.php',
            'path' => '/servicios/diseno-residencial',
            'category' => 'proyecto',
            'number' => '2.2',
            'name' => 'Residencial',
            'title' => 'Diseño arquitectónico residencial en Querétaro | Arquitectos Trabajando C+S Estudio',
            'description' => 'Conocemos las características, gustos y especificaciones del cliente para su hogar y lo asesoramos en distribución, tendencias y tecnologías para el desarrollo de su proyecto.',
            'heading' => 'Diseño Arquitectónico Residencial',
            'image' => 'assets/img/cat-proyecto.jpg',
            'alt' => 'Residencia de dos niveles con pórtico y ventanales',
            'body' => '<p>A través de entrevistas se conocen las características, gustos y especificaciones que el cliente requiere para su hogar y junto con nuestra experiencia brindamos y asesoramos al cliente con la distribución del espacio, tendencias y tecnologías para el desarrollo de su proyecto. Nuestro compromiso es desarrollar un proyecto que cumpla con sus expectativas de funcionamiento, diseño y presupuesto destinado.</p>',
        ],
        'diseno-remodelaciones' => [
            'legacy' => '3_Diseno-Arquitectonico-Remodelaciones-Queretaro.php',
            'path' => '/servicios/diseno-remodelaciones',
            'category' => 'proyecto',
            'number' => '2.3',
            'name' => 'Remodelaciones',
            'title' => 'Diseño de remodelaciones en Querétaro | Arquitectos Trabajando C+S Estudio',
            'description' => 'Diseño arquitectónico para renovar viviendas, oficinas y locales en Querétaro: distribución, iluminación, materiales y planeación del proyecto.',
            'heading' => 'Diseño arquitectónico para remodelaciones',
            'image' => 'assets/img/cat-proyecto.jpg',
            'alt' => 'Residencia de dos niveles con pórtico y ventanales',
            'body' => '<p>Una remodelación comienza por entender cómo utilizas tu espacio y qué necesitas mejorar. Te asesoramos en el diseño de una nueva distribución para tu vivienda, oficina o local, buscando aprovechar las áreas existentes y mejorar su iluminación, ventilación y funcionamiento.</p>
        <h2>Un proyecto a partir de tu espacio actual</h2>
        <p>Partimos de la revisión del inmueble y de tus prioridades para definir una propuesta acorde con el presupuesto y el uso previsto. Consideramos la relación entre los ambientes, las circulaciones, los acabados y las instalaciones que puedan requerir adecuaciones.</p>
        <ul>
          <li>Revisión de necesidades y levantamiento del estado actual.</li>
          <li>Propuesta de distribución y selección de materiales y acabados.</li>
          <li>Planos y detalles de intervención según el alcance acordado.</li>
          <li>Planeación de etapas para organizar la ejecución de los trabajos.</li>
        </ul>
        <p>Las intervenciones en muros, losas o elementos de carga requieren una revisión estructural antes de definir su ejecución. El diseño permite identificar estas necesidades desde el inicio.</p>
        <p>Si ya cuentas con un proyecto y necesitas llevarlo a obra, consulta nuestro servicio de <a href="/servicios/construccion-remodelaciones">construcción de remodelaciones</a>.</p>',
        ],
        'diseno-comercial' => [
            'legacy' => '4_Diseno-Arquitectonico-Comercial-Queretaro.php',
            'path' => '/servicios/diseno-comercial',
            'category' => 'proyecto',
            'number' => '2.4',
            'name' => 'Comercial',
            'title' => 'Diseño arquitectónico comercial en Querétaro | Arquitectos Trabajando C+S Estudio',
            'description' => 'Proyectos constructivos con destino comercial que consideran funcionalidad, seguridad y costo, además de la normativa que dicta la autoridad.',
            'heading' => 'Diseño Arquitectónico Comercial',
            'image' => 'assets/img/cat-proyecto.jpg',
            'alt' => 'Residencia de dos niveles con pórtico y ventanales',
            'body' => '<p>Para el desarrollo de proyectos constructivos con un destino comercial se deben tomar en cuenta aspectos como la funcionalidad, seguridad y costo, además de que debe cumplir con la normativa que dicta la autoridad.</p>',
        ],
        'centros-escolares' => [
            'legacy' => '6_Diseno-Arquitectonico-Centros-Escolares-Queretaro.php',
            'path' => '/servicios/centros-escolares',
            'category' => 'proyecto',
            'number' => '2.5',
            'name' => 'Centros escolares',
            'title' => 'Diseño de centros escolares en Querétaro | Arquitectos Trabajando C+S Estudio',
            'description' => 'Asesoría en la definición de espacios para la educación de acuerdo al nivel educativo y sistema de aprendizaje, con experiencia en normativa de infraestructura educativa.',
            'heading' => 'Diseño Arquitectónico Centros Escolares',
            'image' => 'assets/img/cat-proyecto.jpg',
            'alt' => 'Residencia de dos niveles con pórtico y ventanales',
            'body' => '<p>Asesoramos en la definición del desarrollo de espacios para la educación de acuerdo al nivel educativo y sistema de aprendizaje que utilicen; se cuenta con una amplia experiencia en la normativa de infraestructura para la educación.</p>',
        ],
        'casas-ecologicas' => [
            'legacy' => '5_Diseno-Arquitectonico-Casas-Ecologicas-Queretaro.php',
            'path' => '/servicios/casas-ecologicas',
            'category' => 'proyecto',
            'number' => '2.6',
            'name' => 'Casas ecológicas',
            'title' => 'Diseño arquitectónico de casas ecológicas en Querétaro | Arquitectos Trabajando C+S Estudio',
            'description' => 'Proyectos de casas ecológicas que cuidan orientación, captación de aguas pluviales y manejo de aguas grises y negras, con tecnologías de confort pasivo.',
            'heading' => 'Diseño Arquitectónico Casas Ecológicas',
            'image' => 'assets/img/cat-proyecto.jpg',
            'alt' => 'Residencia de dos niveles con pórtico y ventanales',
            'body' => '<p>Para el desarrollo de proyectos de casas ecológicas, además de cuidar los aspectos de orientación, captación de aguas pluviales y manejo de las grises y negras, incluimos tecnologías que ayudan a tener espacios confortables sin utilizar climas, además de aprovechar al máximo la iluminación natural y la energía del sol.</p>',
        ],
        'diseno-industrial' => [
            'legacy' => '3_Diseno-Arquitectonico-Industrial-Queretaro.php',
            'path' => '/servicios/diseno-industrial',
            'category' => 'proyecto',
            'number' => '2.7',
            'name' => 'Industrial',
            'title' => 'Diseño arquitectónico industrial en Querétaro | Arquitectos Trabajando C+S Estudio',
            'description' => 'Proyectos que cumplen las especificaciones para el desarrollo de funciones comerciales o industriales, respetando el presupuesto autorizado.',
            'heading' => 'Diseño Arquitectónico Industrial',
            'image' => 'assets/img/cat-proyecto.jpg',
            'alt' => 'Residencia de dos niveles con pórtico y ventanales',
            'body' => '<p>Nuestro compromiso es desarrollar un proyecto que cumpla con las especificaciones para el desarrollo de sus funciones comerciales o industriales, respetando en el desarrollo del proyecto el presupuesto autorizado. El proyecto se desarrollará de tal forma que resuelva aspectos de distribución, funcionalidad, diseño y normativa que le aplique.</p>',
        ],
        'obra-nueva' => [
            'legacy' => '11_Construccion-Obra-Nueva-Queretaro.php',
            'path' => '/servicios/obra-nueva',
            'category' => 'construccion',
            'number' => '3.1',
            'name' => 'Obra nueva',
            'title' => 'Construcción de obra nueva en Querétaro | Arquitectos Trabajando C+S Estudio',
            'description' => 'Construcción respetando el diseño arquitectónico autorizado, con programa de obra, materiales de primera, mano de obra calificada y normas de seguridad e higiene.',
            'heading' => 'Construcción de Obra Nueva',
            'image' => 'assets/img/cat-construccion.jpg',
            'alt' => 'Estructura metálica de cubierta en obra',
            'body' => '<p>Se construye respetando el diseño arquitectónico autorizado, apoyado de un programa de obra en el que se establecen los plazos de ejecución; se utilizan materiales de primera, mano de obra calificada, se respetan las normas de seguridad e higiene y se optimizan los costos.</p>',
        ],
        'construccion-remodelaciones' => [
            'legacy' => '12_Construccion-Remodelaciones-Queretaro.php',
            'path' => '/servicios/construccion-remodelaciones',
            'category' => 'construccion',
            'number' => '3.2',
            'name' => 'Remodelaciones',
            'title' => 'Remodelaciones en Querétaro | Arquitectos Trabajando C+S Estudio',
            'description' => 'Asesoría para las modificaciones que se puedan realizar en oficina o vivienda, cuidando no afectar estructuralmente lo ya existente.',
            'heading' => 'Remodelación de Obra',
            'image' => 'assets/img/cat-construccion.jpg',
            'alt' => 'Estructura metálica de cubierta en obra',
            'body' => '<p>Si cuentas con un espacio para oficina o vivienda y no se adapta a tus requerimientos, te asesoramos para las modificaciones que se puedan realizar, cuidando no afectar estructuralmente lo ya existente.</p>',
        ],
        'ampliaciones' => [
            'legacy' => '13_Construccion-Ampliaciones-Queretaro.php',
            'path' => '/servicios/ampliaciones',
            'category' => 'construccion',
            'number' => '3.3',
            'name' => 'Ampliaciones',
            'title' => 'Ampliaciones de construcciones en Querétaro | Arquitectos Trabajando C+S Estudio',
            'description' => 'Asesoría para ampliar tu casa, hacer un piso más o techar tu patio con la seguridad de no afectar estructuralmente lo ya existente.',
            'heading' => 'Ampliación de Construcciones',
            'image' => 'assets/img/cat-construccion.jpg',
            'alt' => 'Estructura metálica de cubierta en obra',
            'body' => '<p>¿Creció la familia, deseas hacer un piso más en tu casa o techar tu patio?</p>
        <p>Nosotros te asesoramos para que tengas la seguridad de que las modificaciones se pueden realizar sin afectar estructuralmente lo ya existente.</p>',
        ],
        'murales-pintura-escultura' => [
            'legacy' => '14_Construccion-Murales-Pintura-Escultura-Queretaro.php',
            'path' => '/servicios/murales-pintura-escultura',
            'category' => 'construccion',
            'number' => '3.4',
            'name' => 'Murales, Pintura, Escultura',
            'title' => 'Murales, pintura y escultura en Querétaro | Arquitectos Trabajando C+S Estudio',
            'description' => 'Asesoría para integrar murales, pintura y escultura en espacios arquitectónicos en Querétaro, considerando materiales, ubicación y conservación.',
            'heading' => 'Murales, pintura y escultura en Querétaro',
            'image' => 'assets/img/cat-construccion.jpg',
            'alt' => 'Estructura metálica de cubierta en obra',
            'body' => '<p>El arte puede transformar la experiencia de un espacio y expresar su identidad. Te asesoramos para integrar murales, pintura y escultura en proyectos residenciales, comerciales y espacios de uso colectivo, en armonía con su arquitectura.</p>
        <h2>Integración de arte y arquitectura</h2>
        <p>La propuesta parte del tema, las dimensiones y el ambiente que se desea crear. Revisamos la ubicación de la pieza, su relación con la luz y los recorridos, así como las características del soporte y su exposición al interior o al exterior.</p>
        <ul>
          <li>Definición del concepto y del lugar de intervención.</li>
          <li>Selección de técnicas, materiales y acabados según el entorno.</li>
          <li>Planeación de la preparación de superficies y de la instalación.</li>
          <li>Consideraciones de mantenimiento y cuidado de las piezas.</li>
        </ul>
        <h2>Intervenciones en obras existentes</h2>
        <p>Cuando se busca conservar o restaurar una obra, primero se revisan su estado, materiales y antecedentes para definir el alcance con los especialistas correspondientes. Cada pieza requiere una evaluación particular antes de proponer limpieza, reparación o reintegración.</p>
        <p>Compártenos fotografías del espacio, medidas aproximadas y referencias de tu idea para conversar sobre las posibilidades del proyecto.</p>',
        ],
        'presupuesto-de-obra' => [
            'legacy' => '21_Presupuestos-Construccion-Queretaro.php',
            'path' => '/servicios/presupuesto-de-obra',
            'category' => 'complementarios',
            'number' => '4.1',
            'name' => 'Presupuesto de obra',
            'title' => 'Presupuesto de obra en Querétaro | Arquitectos Trabajando C+S Estudio',
            'description' => 'Presupuestos de obra para construcción nueva, remodelación o ampliación, con catálogo de conceptos cotizado de acuerdo al proyecto ejecutivo.',
            'heading' => 'Presupuesto de obra',
            'image' => 'assets/img/cat-complementarios.jpg',
            'alt' => 'Edificio de departamentos en Querétaro',
            'body' => '<p>Se elaboran presupuestos de obra ya sea para construcción nueva, remodelación o ampliación de casa, oficina o industria. Con este servicio el cliente puede darse una idea muy aproximada de la inversión que requiere para la ejecución de su proyecto, ya que se genera un catálogo de conceptos correspondiente cotizando este de acuerdo a lo especificado en el proyecto ejecutivo, contribuyendo con el cliente a una planeación de la construcción de su proyecto.</p>',
        ],
        'maquila-de-planos' => [
            'legacy' => '25_Planos-Construccion-Queretaro.php',
            'path' => '/servicios/maquila-de-planos',
            'category' => 'complementarios',
            'number' => '4.2',
            'name' => 'Maquila de planos',
            'title' => 'Maquila de planos en Querétaro | Arquitectos Trabajando C+S Estudio',
            'description' => 'Digitalización de planos de proyectos arquitectónicos o detalles de obra para la construcción, con el software Autocad.',
            'heading' => 'Maquila de planos',
            'image' => 'assets/img/cat-complementarios.jpg',
            'alt' => 'Edificio de departamentos en Querétaro',
            'body' => '<p>Ofrecemos la digitalización de planos de proyectos arquitectónicos o detalles de obra para la construcción, con el software <strong>Autocad</strong>.</p>',
        ],
        'levantamientos-topograficos' => [
            'legacy' => '26_Adminstracion-Construccion-Queretaro.php',
            'path' => '/servicios/levantamientos-topograficos',
            'category' => 'complementarios',
            'number' => '4.3',
            'name' => 'Levantamientos topográficos',
            'title' => 'Levantamientos topográficos en Querétaro | Arquitectos Trabajando C+S Estudio',
            'description' => 'Personal y equipo especializado para realizar la planimetría y altimetría necesaria para cualquier proceso constructivo.',
            'heading' => 'Levantamientos topográficos',
            'image' => 'assets/img/cat-complementarios.jpg',
            'alt' => 'Edificio de departamentos en Querétaro',
            'body' => '<p>Contamos con personal y equipo especializado para realizar la planimetría y altimetría necesaria para cualquier proceso constructivo.</p>',
        ],
    ],
    'home' => [[
            'category' => 'perito',
            'title' => 'DRO / PERITO',
            'image' => 'assets/img/cat-perito.jpg',
            'alt' => 'Fachada de bodega industrial construida por el estudio',
            'services' => ['dro-y-corresponsable', 'dictamen-estructural', 'revisiones-electricas', 'valuacion-inmobiliaria', 'valuacion-de-arte'],
        ], [
            'category' => 'proyecto',
            'title' => 'Proyecto Arquitectónico y Construcción',
            'image' => 'assets/img/cat-proyecto.jpg',
            'alt' => 'Residencia de dos niveles con pórtico y ventanales',
            'services' => ['estaciones-de-servicio', 'diseno-residencial', 'diseno-remodelaciones', 'diseno-comercial', 'centros-escolares'],
        ], [
            'category' => 'construccion',
            'title' => 'Construcción y restauración',
            'image' => 'assets/img/cat-construccion.jpg',
            'alt' => 'Estructura metálica de cubierta en obra',
            'services' => ['obra-nueva', 'construccion-remodelaciones', 'ampliaciones', 'murales-pintura-escultura'],
        ]],
];
