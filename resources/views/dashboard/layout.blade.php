<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Sistema Archivo</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('dashboard/img/icon.ico') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="{{ asset('dashboard/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['{{ asset('dashboard/css/fonts.min.css') }}']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/atlantis.min.css') }}">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/modificado.css') }}">
</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header bg-logo">

                <a href="{{ route('dashboard') }}" class="logo"
                    style="color: #d6d6d6; font-size:18px; font-family:Verdana, Geneva, Tahoma, sans-serif;">
                    <img src="{{ asset('dashboard/img/img-02.png') }}" alt="navbar brand" class="navbar-brand"
                        width="50" height="50"> &nbsp; UNIFRANZ
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="icon-menu"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-expand-lg  bg-header">

                <div class="container-fluid">

                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">


                        <!--ACCESOS RAPIDOS-->
                        @can('backup')
                            <li class="nav-item dropdown hidden-caret">
                                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                                    <i class="fas fa-layer-group"></i>
                                </a>
                                <div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
                                    <div class="quick-actions-header bg-logo">
                                        <span class="title mb-1">Acciones rapidas</span>
                                        <span class="subtitle op-8">Atajos</span>
                                    </div>
                                    <div class="quick-actions-scroll scrollbar-outer">
                                        <div class="quick-actions-items">
                                            <div class="row m-0 justify-content-center">
                                                <a class="col-6 col-md-6 p-0" href="#"
                                                    onclick="backup('{{ route('backup') }}')">
                                                    <div class="quick-actions-item">
                                                        <i class="flaticon-database"></i>
                                                        <span class="text">Generar respaldo</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endcan
                        <li class="nav-item dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
                                aria-expanded="false">
                                <div class="avatar-sm">
                                    @if (auth()->user()->imagen !== '')
                                        <img src="{{ asset('storage/' . auth()->user()->imagen) }}" alt="image profile"
                                            class="avatar-img rounded">
                                    @else
                                        <img src="{{ asset('dashboard/img/defecto.png') }}" alt="imagen por defecto"
                                            class="avatar-img rounded">
                                    @endif
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg">
                                                <div class="avatar-lg">
                                                    @if (auth()->user()->imagen !== '')
                                                        <img src="{{ asset('storage/' . auth()->user()->imagen) }}"
                                                            alt="image profile" class="avatar-img rounded">
                                                    @else
                                                        <img src="{{ asset('storage/PERFILES/defecto.png') }}"
                                                            alt="imagen por defecto" class="avatar-img rounded">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="u-text">
                                                <h4>{{ auth()->user()->name . ' ' . auth()->user()->paterno }}</h4>
                                                <p class="text-muted">{{ auth()->user()->email }}</p><a
                                                    href="{{ route('perfil') }}" class="btn btn-xs btn-info btn-sm">Ver
                                                    perfil</a>
                                                <a href="/logout" class="btn btn-xs btn-danger btn-sm">Salir</a>
                                            </div>
                                        </div>
                                    </li>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>

        <!-- Sidebar -->
        <div class="sidebar sidebar-style-2">
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <div class="user">
                        <div class="avatar-sm float-left mr-2">
                            @if (auth()->user()->imagen !== '')
                                <img src="{{ asset('storage/' . auth()->user()->imagen) }}" alt="image profile"
                                    class="avatar-img rounded">
                            @else
                                <img src="{{ asset('dashboard/img/defecto.png') }}" alt="imagen por defecto"
                                    class="avatar-img rounded">
                            @endif
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                                <span>
                                    {{ auth()->user()->name . ' ' . auth()->user()->paterno }}
                                    <span class="user-level">{{ auth()->user()->getRoleNames()->first() }}
                                    </span>
                                    <span class="caret"></span>
                                </span>
                            </a>
                            <div class="clearfix"></div>

                            <div class="collapse in" id="collapseExample">
                                <ul class="nav">
                                    <li>
                                        <a href="{{ route('perfil') }}">
                                            <span class="link-collapse">Mi perfil</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('editar') }}">
                                            <span class="link-collapse">Editar datos</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-primary">
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Modulos</h4>
                        </li>
                        @can('usuario')
                            <li class="nav-item">
                                <a data-toggle="collapse" href="#base2">
                                    <i class="fas fa-user"></i>
                                    <p>Usuarios</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="base2">
                                    <ul class="nav nav-collapse">
                                        <li>
                                            <a href="{{ route('usuario') }}">
                                                <span class="sub-item">Registrar usuario</span>
                                            </a>
                                        </li>


                                    </ul>
                                </div>
                            </li>
                        @endcan
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#base">
                                <i class="fas fa-user-tie"></i>
                                <p>Docentes</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="base">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{ route('docente') }}">
                                            <span class="sub-item">Registrar docente</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('banco') }}">
                                            <span class="sub-item">Numeros de cuenta</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('formacion') }}">
                                            <span class="sub-item">Formacion academica</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('titulo') }}">
                                            <span class="sub-item">Titulos complementarios</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('experiencia') }}">
                                            <span class="sub-item">Experiencia laboral</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('clase_modelo') }}">
                                            <span class="sub-item">Clase modelo</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('documento_complementario') }}">
                                            <span class="sub-item">Documentos complementarios</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('contrato') }}">
                                            <span class="sub-item">Contratos</span>
                                        </a>
                                    </li>



                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    @yield('content')
                </div>

            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Manual
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Contactos
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright ml-auto">
                        2023, Comunidad de desarrollo de softwware <a href="https://unifranz.edu.bo/">Unifranz</a>
                    </div>
                </div>
            </footer>
        </div>

    </div>


    <!-- End Custom template -->
    </div>



    <!--   Core JS Files   -->
    <script src="{{ asset('dashboard/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('dashboard/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('dashboard/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>


    <!-- Chart JS -->
    <script src="{{ asset('dashboard/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('dashboard/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('dashboard/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('dashboard/js/plugin/datatables/datatables.min.js') }}"></script>

    <!-- Bootstrap Notify -->


    <!-- jQuery Vector Maps -->
    <script src="{{ asset('dashboard/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('dashboard/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Atlantis JS -->
    <script src="{{ asset('dashboard/js/atlantis.min.js') }}"></script>

    <!-- Atlantis DEMO methods, don't include it in your project! -->
    <script src="{{ asset('dashboard/js/setting-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('propio/Backup.js') }}"></script>

</body>

</html>
