<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cementerio General</title>
    <link rel="shortcut icon" href="{{ asset('inicio/./images/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('inicio/./css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('inicio/./css/estilos.css') }}">

    <meta name="theme-color" content="#2091F9">

    <meta name="title" content="Aprende CSS desde cero">
    <meta name="description"
        content="Hola, soy una descripción que verás cuando busques algo de mi temática en Google.">


    <meta property="og:type" content="website">
    <meta property="og:url" content="https://alexcgdesign.github.io">
    <meta property="og:title" content="Aprende CSS desde cero">
    <meta property="og:description"
        content="Hola, soy una descripción que verás cuando busques algo de mi temática en Google.">
    <meta property="og:image" content="https://alexcgdesign.github.io/images/css.jpg">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://www.jordanalex.com/">
    <meta property="twitter:title" content="Aprende CSS desde cero">
    <meta property="twitter:description"
        content="Hola, soy una descripción que verás cuando busques algo de mi temática en Google.">
    <meta property="twitter:image" content="https://alexcgdesign.github.io/images/css.jpg">
</head>

<body>

    <header class="hero">
        <nav class="nav container">
            <div class="nav__logo">
                <h2 class="nav__title">Cementerio General</h2>
            </div>

            <ul class="nav__link nav__link--menu">
                <li class="nav__items">
                    <a href="#" class="nav__links">Inicio</a>
                </li>
                <li class="nav__items">
                    <a href="#" class="nav__links">Acerca de</a>
                </li>
                <li class="nav__items">
                    <a href="#" class="nav__links">Contacto</a>
                </li>
                <li class="nav__items">
                    <a href="{{ route('login') }}" class="nav__links">Login</a>
                </li>

                <img src="{{ asset('inicio/./images/close.svg') }}" class="nav__close">
            </ul>

            <div class="nav__menu">
                <img src="{{ asset('inicio/./images/menu.svg') }}" class="nav__img">
            </div>
        </nav>

        <section class="hero__container container">
            <h1 class="hero__title">Cementerio General de La Paz</h1>
            <p class="hero__paragraph">Siempre dando el mejor servicio posible, cuidando al prójimo, con respeto y cariño</a>
        </section>
    </header>

    <main>
        <section class="container about">
            <h2 class="subtitle">¿Quiénes somos?</h2>
            <p class="about__paragraph">Cementerio público ubicado en la zona noroeste de la ciudad de La Paz, macro distrito Max Paredes del Municipio de La Paz, y tiene una superficie de 92.000 metros cuadrados.</p>

            <div class="about__main">
                <article class="about__icons">
                    <img src="{{ asset('inicio/./images/shapes.svg') }}" class="about__icon">
                    <h3 class="about__title">Misión</h3>
                    <p class="about__paragrah">Honrar la memoria de los seres queridos garantizando un servicio de excelencia de manera empática y eficiente, comprometidos con el cuidado del medio ambiente y la responsabilidad social. Asimismo, tenemos como objetivo el crecimiento sostenido de la organización y el desarrollo profesional de nuestros colaboradores.</p>
                </article>

                <article class="about__icons">
                    <img src="{{ asset('inicio/./images/paint.svg') }}" class="about__icon">
                    <h3 class="about__title">Visión</h3>
                    <p class="about__paragrah">Ser la primera opción funeraria para la familia peruana y la mejor organización para nuestros colaboradores.</p>
                </article>

                <article class="about__icons">
                    <img src="{{ asset('inicio/./images/code.svg') }}" class="about__icon">
                    <h3 class="about__title">Características</h3>
                    <p class="about__paragrah">El cementerio presenta un ingreso principal para la entrada de los cortejos fúnebres, esta entrada presenta un arco que marca el acceso desde la Avenida Baptista, el ingreso conduce directamente a la capilla principal, un templo católico diseñado por el arquitecto urbanista paceño Julio Mariaca Pando.</p>
                </article>
            </div>
        </section>

        <section class="knowledge">
            <div class="knowledge__container container">
                <div class="knowledege__texts">
                    <h2 class="subtitle">Tours por el cementerio </h2>
                    <p class="knowledge__paragraph">Ven y conoce los lugares, mausoleos famosos. Se parte de nuestro recorrido turístico, donde aprenderás sobre la historia de Bolivia y de las personas que fueron parte de nuestro crecimiento como país</p>
                    <a href="#" class="cta">Entra al recorrido</a>
                </div>

                <figure class="knowledge__picture">
                    <img src="{{ asset('inicio/./images/12.png') }}" class="knowledge__img">
                </figure>
            </div>
        </section>

        <section class="price container">
            <h2 class="subtitle">Obtén alguno de nuestros servicios</h2>

            <div class="price__table">
                <div class="price__element">
                    <p class="price__name">Básico</p>
                    <h3 class="price__price">desde 20Bs/mes</h3>

                    <div class="price__items">
                        <p class="price__features">Nicho de 1ra a 6ta fila</p>
                        <p class="price__features">Limpieza</p>
                        <p class="price__features">Mantenimiento</p>
                    </div>

                    <a href="#" class="price__cta">reserva ahora</a>
                </div>


                <div class="price__element price__element--best">
                    <p class="price__name">Premiun</p>
                    <h3 class="price__price">Bs700 /mes</h3>

                    <div class="price__items">
                        <p class="price__features">Mausoleo</p>
                        <p class="price__features">Limpieza</p>
                        <p class="price__features">Sepultura</p>
                        <p class="price__features">Flores</p>
                    </div>

                    <a href="#" class="price__cta">reserva ahora</a>
                </div>


                <div class="price__element">
                    <p class="price__name">Medio</p>
                    <h3 class="price__price">Bs200/mes</h3>

                    <div class="price__items">
                        <p class="price__features">Lapida</p>
                        <p class="price__features">Limpieza</p>
                        <p class="price__features">Sepultura</p>
                    </div>

                    <a href="#" class="price__cta">reserva ahora</a>
                </div>


            </div>
        </section>

        <section class="testimony">
            <div class="testimony__container container">
                <img src="{{ asset('inicio/./images/leftarrow.svg') }}" class="testimony__arrow" id="before">

                <section class="testimony__body testimony__body--show" data-id="1">
                    <div class="testimony__texts">
                        <h2 class="subtitle">Franz Tamayo <span class="testimony__course">(1879 - 1956)</span></h2>
                        <p class="testimony__review">fue un poeta, político e intelectual boliviano, considerado una de las figuras centrales de la literatura boliviana del siglo XX. Su pensamiento ha sido catalogado como «indigenismo no marxista</p>
                    </div>

                    <figure class="testimony__picture">
                        <img src="{{ asset('inicio/./images/1.png') }}" class="testimony__img">
                    </figure>
                </section>

                <section class="testimony__body" data-id="2">
                    <div class="testimony__texts">
                        <h2 class="subtitle">Carlos Palenque <span class="testimony__course">(1944 - 1997)</span></h2>
                        <p class="testimony__review">más conocido como El Compadre, fue un cantante, músico, empresario, presentador de televisión y político boliviano. Su carrera en los medios de comunicación comenzó en Radio Chuquisaca de La Paz, en el programa “La hora del chairo”.  En 1973, llegó a la televisión con un programa famoso “El Hippershow”.</p>
                    </div>

                    <figure class="testimony__picture">
                        <img src="{{ asset('inicio/./images/2.png') }}" class="testimony__img">
                    </figure>
                </section>

                <section class="testimony__body" data-id="3">
                    <div class="testimony__texts">
                        <h2 class="subtitle">Óscar Alfaro. <span class="testimony__course">(1921 - 1963)</span></h2>
                        <p class="testimony__review">fue un poeta, cuentista, profesor y periodista tarijeño, que se distinguió por su dedicación a la literatura infantil y juvenil.</p>
                    </div>

                    <figure class="testimony__picture">
                        <img src="{{ asset('inicio/./images/3.png') }}" class="testimony__img">
                    </figure>
                </section>

                <section class="testimony__body" data-id="4">
                    <div class="testimony__texts">
                        <h2 class="subtitle">Jaime Sáenz <span class="testimony__course">(1921 - 1986)</span></h2>
                        <p class="testimony__review">fue escritor, poeta, novelista, periodista, ensayista, dibujante, dramaturgo y docente boliviano, más conocido por su obra como narrador y poeta. tanto su vida como su obra marcaron profundamente el espacio cultural boliviano del siglo xx. Existen numerosos estudios académicos sobre su obra, así como traducciones de la misma al inglés, italiano y alemán.</p>
                    </div>

                    <figure class="testimony__picture">
                        <img src="{{ asset('inicio/./images/4.png') }}" class="testimony__img">
                    </figure>
                </section>


                <img src="{{ asset('inicio/./images/rightarrow.svg') }}" class="testimony__arrow" id="next">
            </div>
        </section>

        <section class="questions container">
            <h2 class="subtitle">Preguntas frecuentes</h2>
            <p class="questions__paragraph">Porque nos preocupa, sus preguntas son importante para nosotros.</p>

            <section class="questions__container">
                <article class="questions__padding">
                    <div class="questions__answer">
                        <h3 class="questions__title">¿Dónde se ubica el cementerio?
                            <span class="questions__arrow">
                                <img src="{{ asset('inicio/./images/arrow.svg') }}" class="questions__img">
                            </span>
                        </h3>

                        <p class="questions__show">El Cementerio General de La Paz es un cementerio público ubicado en la zona noroeste de la ciudad de La Paz, macro distrito Max Paredes del Municipio de La Paz.</p>
                    </div>
                </article>

                <article class="questions__padding">
                    <div class="questions__answer">
                        <h3 class="questions__title">¿Horarios de atención?
                            <span class="questions__arrow">
                                <img src="{{ asset('inicio/./images/arrow.svg') }}" class="questions__img">
                            </span>
                        </h3>

                        <p class="questions__show">Se informa que debido a la contingencia que nos afecta, nuestro horario de atención es de lunes a viernes de 8:30 a 18:00 horas, mientras que fines de semana y festivos es de 8:30 a 15:00 horas.</p>
                    </div>
                </article>

                <article class="questions__padding">
                    <div class="questions__answer">
                        <h3 class="questions__title">¿qué promociones tenemos?
                            <span class="questions__arrow">
                                <img src="{{ asset('inicio/./images/arrow.svg') }}" class="questions__img">
                            </span>
                        </h3>

                        <p class="questions__show">La Entidad Descentralizada Municipal de Cementerios de La Paz comunica a la población en general que a consecuencia del incremento de contagios de Covid-19 en la ciudad, el Cementerio General se encuentra con el 70% de sus funcionarios activos. Por lo cual la atención en administración será sólo para tramites urgentes</p>
                    </div>
                </article>
            </section>

            <section class="questions__offer">
                <h2 class="subtitle">¿Desea adquirir nuestro servicio?</h2>
                <p class="questions__copy">La muerte de un familiar o de un ser querido nos llena de mucho pesar y de una tristeza que nos hace sentir que no vamos a poder recomponernos nunca de este dolor. Cuando tienes que dar el pésame por una defunción, lo mejor es saber una serie de frases de condolencias y pésame con tal de quedar bien, sin sonar demasiado forzado ni tampoco que pueda hacer que la otra persona se sienta violentada.</p>
                <a href="#" class="cta">reserve ahora</a>
            </section>
        </section>
    </main>

    <footer class="footer">
        <section class="footer__container container">
            <nav class="nav nav--footer">
                <h2 class="footer__title">Cementerio general La Paz</h2>

                <ul class="nav__link nav__link--footer">
                    <li class="nav__items">
                        <a href="#" class="nav__links">Inicio</a>
                    </li>
                    <li class="nav__items">
                        <a href="#" class="nav__links">Acerca de</a>
                    </li>
                    <li class="nav__items">
                        <a href="#" class="nav__links">Contacto</a>
                    </li>
                    <li class="nav__items">
                        <a href="#" class="nav__links">Login</a>
                    </li>
                </ul>
            </nav>

            <form class="footer__form" action="https://formspree.io/f/mknkkrkj" method="POST">
                <h2 class="footer__newsletter">Solicita una cotización</h2>
                <div class="footer__inputs">
                    <input type="email" placeholder="Email:" class="footer__input" name="_replyto">
                    <input type="submit" value="Registrate" class="footer__submit">
                </div>
            </form>
        </section>

        <section class="footer__copy container">
            <div class="footer__social">
                <a href="#" class="footer__icons"><img src="{{ asset('inicio/./images/facebook.svg') }}" class="footer__img"></a>
                <a href="#" class="footer__icons"><img src="{{ asset('inicio/./images/twitter.svg') }}" class="footer__img"></a>
                <a href="#" class="footer__icons"><img src="{{ asset('inicio/./images/youtube.svg') }}" class="footer__img"></a>
            </div>

            <h3 class="footer__copyright">Derechos reservados &copy; Unifranz La Paz</h3>
        </section>
    </footer>

    <script src="{{ asset('inicio/./js/slider.js') }}"></script>
    <script src="{{ asset('inicio/./js/questions.js') }}"></script>
    <script src="{{ asset('inicio/./js/menu.js') }}"></script>
</body>

</html>