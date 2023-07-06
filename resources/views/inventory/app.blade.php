<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>
    <!-- Style Sheets -->
    @include('auth.includes.styles')
</head>

<body class="navbar-fixed sidebar-fixed" id="body">

    <!-- ====================================
    ——— WRAPPER
    ===================================== -->
    <div class="wrapper">

        <!-- ====================================
          ——— LEFT SIDEBAR WITH OUT FOOTER
        ===================================== -->
        <aside class="left-sidebar sidebar-dark" id="left-sidebar">
            <div id="sidebar" class="sidebar sidebar-with-footer">
                <!-- Aplication Brand -->
                <div class="app-brand">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('assets/auth/images/logo.png') }}" alt="Mono">
                        <span class="brand-name">Clean-LG</span>
                    </a>
                </div>
                <!-- begin sidebar scrollbar -->
                <div class="sidebar-left" data-simplebar style="height: 100%;">
                    <!-- sidebar menu -->
                    <ul class="nav sidebar-inner" id="sidebar-menu">

                        <li class="active">
                            <a class="sidenav-item-link" href="index.html">
                                <i class="mdi mdi-briefcase-account-outline"></i>
                                <span class="nav-text">Modulos Lavadería</span>
                            </a>
                        </li>

                        <li class="section-title">
                            Apps
                        </li>

                        <li>
                            <a class="sidenav-item-link" href="calendar.html">
                                <i class="mdi mdi-calendar-check"></i>
                                <span class="nav-text">Calendar</span>
                            </a>
                        </li>

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#email" aria-expanded="false" aria-controls="email">
                                <i class="mdi mdi-email"></i>
                                <span class="nav-text">email</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="email" data-parent="#sidebar-menu">
                                <div class="sub-menu">

                                    <li>
                                        <a class="sidenav-item-link" href="email-inbox.html">
                                            <span class="nav-text">Email Inbox</span>

                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="email-details.html">
                                            <span class="nav-text">Email Details</span>

                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="email-compose.html">
                                            <span class="nav-text">Email Compose</span>

                                        </a>
                                    </li>

                                </div>
                            </ul>
                        </li>

                        <li class="section-title">
                            UI Elements
                        </li>

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#ui-elements" aria-expanded="false" aria-controls="ui-elements">
                                <i class="mdi mdi-folder-outline"></i>
                                <span class="nav-text">UI Components</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="ui-elements" data-parent="#sidebar-menu">
                                <div class="sub-menu">

                                    <li>
                                        <a class="sidenav-item-link" href="alert.html">
                                            <span class="nav-text">Alert</span>

                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="badge.html">
                                            <span class="nav-text">Badge</span>

                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="breadcrumb.html">
                                            <span class="nav-text">Breadcrumb</span>

                                        </a>
                                    </li>

                                    <li class="has-sub">
                                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                            data-target="#buttons" aria-expanded="false" aria-controls="buttons">
                                            <span class="nav-text">Buttons</span> <b class="caret"></b>
                                        </a>
                                        <ul class="collapse" id="buttons">
                                            <div class="sub-menu">

                                                <li>
                                                    <a href="button-default.html">Button Default</a>
                                                </li>

                                                <li>
                                                    <a href="button-dropdown.html">Button Dropdown</a>
                                                </li>

                                                <li>
                                                    <a href="button-group.html">Button Group</a>
                                                </li>

                                                <li>
                                                    <a href="button-social.html">Button Social</a>
                                                </li>

                                                <li>
                                                    <a href="button-loading.html">Button Loading</a>
                                                </li>

                                            </div>
                                        </ul>
                                    </li>


                                    <li>
                                        <a class="sidenav-item-link" href="card.html">
                                            <span class="nav-text">Card</span>

                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="carousel.html">
                                            <span class="nav-text">Carousel</span>

                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="collapse.html">
                                            <span class="nav-text">Collapse</span>

                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="editor.html">
                                            <span class="nav-text">Editor</span>

                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="list-group.html">
                                            <span class="nav-text">List Group</span>

                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="modal.html">
                                            <span class="nav-text">Modal</span>

                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="pagination.html">
                                            <span class="nav-text">Pagination</span>

                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="popover-tooltip.html">
                                            <span class="nav-text">Popover & Tooltip</span>

                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="progress-bar.html">
                                            <span class="nav-text">Progress Bar</span>

                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="spinner.html">
                                            <span class="nav-text">Spinner</span>

                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="switches.html">
                                            <span class="nav-text">Switches</span>

                                        </a>
                                    </li>

                                    <li class="has-sub">
                                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                            data-target="#tables" aria-expanded="false" aria-controls="tables">
                                            <span class="nav-text">Tables</span> <b class="caret"></b>
                                        </a>
                                        <ul class="collapse" id="tables">
                                            <div class="sub-menu">

                                                <li>
                                                    <a href="bootstarp-tables.html">Bootstrap Tables</a>
                                                </li>

                                                <li>
                                                    <a href="data-tables.html">Data Tables</a>
                                                </li>

                                            </div>
                                        </ul>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="tab.html">
                                            <span class="nav-text">Tab</span>

                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="toaster.html">
                                            <span class="nav-text">Toaster</span>

                                        </a>
                                    </li>

                                    <li class="has-sub">
                                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                            data-target="#icons" aria-expanded="false" aria-controls="icons">
                                            <span class="nav-text">Icons</span> <b class="caret"></b>
                                        </a>
                                        <ul class="collapse" id="icons">
                                            <div class="sub-menu">

                                                <li>
                                                    <a href="material-icons.html">Material Icon</a>
                                                </li>

                                                <li>
                                                    <a href="flag-icons.html">Flag Icon</a>
                                                </li>

                                            </div>
                                        </ul>
                                    </li>

                                    <li class="has-sub">
                                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                            data-target="#forms" aria-expanded="false" aria-controls="forms">
                                            <span class="nav-text">Forms</span> <b class="caret"></b>
                                        </a>
                                        <ul class="collapse" id="forms">
                                            <div class="sub-menu">

                                                <li>
                                                    <a href="basic-input.html">Basic Input</a>
                                                </li>

                                                <li>
                                                    <a href="input-group.html">Input Group</a>
                                                </li>

                                                <li>
                                                    <a href="checkbox-radio.html">Checkbox & Radio</a>
                                                </li>

                                                <li>
                                                    <a href="form-validation.html">Form Validation</a>
                                                </li>

                                                <li>
                                                    <a href="form-advance.html">Form Advance</a>
                                                </li>

                                            </div>
                                        </ul>
                                    </li>

                                    <li class="has-sub">
                                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                            data-target="#maps" aria-expanded="false" aria-controls="maps">
                                            <span class="nav-text">Maps</span> <b class="caret"></b>
                                        </a>
                                        <ul class="collapse" id="maps">
                                            <div class="sub-menu">

                                                <li>
                                                    <a href="google-maps.html">Google Map</a>
                                                </li>

                                                <li>
                                                    <a href="vector-maps.html">Vector Map</a>
                                                </li>

                                            </div>
                                        </ul>
                                    </li>

                                    <li class="has-sub">
                                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                            data-target="#widgets" aria-expanded="false" aria-controls="widgets">
                                            <span class="nav-text">Widgets</span> <b class="caret"></b>
                                        </a>
                                        <ul class="collapse" id="widgets">
                                            <div class="sub-menu">

                                                <li>
                                                    <a href="widgets-general.html">General Widget</a>
                                                </li>

                                                <li>
                                                    <a href="widgets-chart.html">Chart Widget</a>
                                                </li>

                                            </div>
                                        </ul>
                                    </li>

                                </div>
                            </ul>
                        </li>

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#charts" aria-expanded="false" aria-controls="charts">
                                <i class="mdi mdi-chart-pie"></i>
                                <span class="nav-text">Charts</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="charts" data-parent="#sidebar-menu">
                                <div class="sub-menu">

                                    <li>
                                        <a class="sidenav-item-link" href="apex-charts.html">
                                            <span class="nav-text">Apex Charts</span>

                                        </a>
                                    </li>

                                </div>
                            </ul>
                        </li>

                        <li class="section-title">
                            Pages
                        </li>

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#users" aria-expanded="false" aria-controls="users">
                                <i class="mdi mdi-image-filter-none"></i>
                                <span class="nav-text">User</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="users" data-parent="#sidebar-menu">
                                <div class="sub-menu">

                                    <li>
                                        <a class="sidenav-item-link" href="user-profile.html">
                                            <span class="nav-text">User Profile</span>

                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="user-activities.html">
                                            <span class="nav-text">User Activities</span>

                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="user-profile-settings.html">
                                            <span class="nav-text">User Profile Settings</span>

                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="user-account-settings.html">
                                            <span class="nav-text">User Account Settings</span>

                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="user-planing-settings.html">
                                            <span class="nav-text">User Planing Settings</span>

                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="user-billing.html">
                                            <span class="nav-text">User billing</span>

                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="user-notify-settings.html">
                                            <span class="nav-text">User Notify Settings</span>

                                        </a>
                                    </li>

                                </div>
                            </ul>
                        </li>

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#authentication" aria-expanded="false" aria-controls="authentication">
                                <i class="mdi mdi-account"></i>
                                <span class="nav-text">Authentication</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="authentication" data-parent="#sidebar-menu">
                                <div class="sub-menu">

                                    <li>
                                        <a class="sidenav-item-link" href="sign-in.html">
                                            <span class="nav-text">Sign In</span>

                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="sign-up.html">
                                            <span class="nav-text">Sign Up</span>

                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="reset-password.html">
                                            <span class="nav-text">Reset Password</span>

                                        </a>
                                    </li>

                                </div>
                            </ul>
                        </li>

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#customization" aria-expanded="false" aria-controls="customization">
                                <i class="mdi mdi-square-edit-outline"></i>
                                <span class="nav-text">Customization</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="customization" data-parent="#sidebar-menu">
                                <div class="sub-menu">

                                    <li>
                                        <a class="sidenav-item-link" href="navbar-customization.html">
                                            <span class="nav-text">Navbar</span>

                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="sidebar-customization.html">
                                            <span class="nav-text">Sidebar</span>

                                        </a>
                                    </li>

                                    <li>
                                        <a class="sidenav-item-link" href="styling.html">
                                            <span class="nav-text">Styling</span>

                                        </a>
                                    </li>

                                </div>
                            </ul>
                        </li>

                    </ul>

                </div>

                <div class="sidebar-footer">
                    <div class="sidebar-footer-content">
                        <ul class="d-flex">
                            {{-- <li>
                                <a href="user-account-settings.html" data-toggle="tooltip"
                                    title="Profile settings"><i class="mdi mdi-settings"></i></a>
                            </li>
                            <li>
                                <a href="#" data-toggle="tooltip" title="No chat messages"><i
                                        class="mdi mdi-chat-processing"></i></a>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </aside>

        <!-- ====================================
      ——— PAGE WRAPPER
      ===================================== -->
        <div class="page-wrapper">

            <!-- Header -->
            <header class="main-header" id="header">
                <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
                    
                    <span class="page-title" style="margin-left: 20px">dashboard</span>

                    <div class="navbar-right ">

                        <ul class="nav navbar-nav">

                            <li class="custom-dropdown">
                                <button class="notify-toggler custom-dropdown-toggler">
                                    <i class="mdi mdi-bell-outline icon"></i>
                                    <span class="badge badge-xs rounded-circle">21</span>
                                </button>
                                <div class="dropdown-notify">

                                    <div class="" data-simplebar style="height: 325px;">
                                        <div class="tab-content" id="myTabContent">

                                            <div class="tab-pane fade show active" id="all" role="tabpanel"
                                                aria-labelledby="all-tabs">

                                                <div class="media media-sm bg-warning-10 p-4 mb-0">
                                                    <div class="media-sm-wrapper">
                                                        <a href="user-profile.html">
                                                            <img src="{{ asset('assets/auth/images/user/user-sm-02.jpg') }}"
                                                                alt="User Image">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <a href="user-profile.html">
                                                            <span class="title mb-0">John Doe</span>
                                                            <span class="discribe">Extremity sweetness difficult
                                                                behaviour he of. On disposal of as landlord horrible.
                                                                Afraid at highly months do things on at.</span>
                                                            <span class="time">
                                                                <time>Just now</time>...
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <footer class="border-top dropdown-notify-footer">
                                        <div class="d-flex justify-content-between align-items-center py-2 px-4">
                                            <span>Last updated 3 min ago</span>
                                            <a id="refress-button" href="javascript:"
                                                class="btn mdi mdi-cached btn-refress"></a>
                                        </div>
                                    </footer>
                                </div>
                            </li>
                            <!-- User Account -->
                            <li class="dropdown user-menu">
                                <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <img src="{{ asset('assets/auth/images/user/user-xs-01.jpg') }}"
                                        class="user-image rounded-circle" alt="User Image" />
                                    <span class="d-none d-lg-inline-block">John Doe</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a class="dropdown-link-item" href="user-profile.html">
                                            <i class="mdi mdi-account-outline"></i>
                                            <span class="nav-text">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-link-item" href="email-inbox.html">
                                            <i class="mdi mdi-email-outline"></i>
                                            <span class="nav-text">Message</span>
                                            <span class="badge badge-pill badge-primary">24</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-link-item" href="user-activities.html">
                                            <i class="mdi mdi-diamond-stone"></i>
                                            <span class="nav-text">Activitise</span></a>
                                    </li>
                                    <li>
                                        <a class="dropdown-link-item" href="user-account-settings.html">
                                            <i class="mdi mdi-settings"></i>
                                            <span class="nav-text">Account Setting</span>
                                        </a>
                                    </li>

                                    <li class="dropdown-footer">
                                        <a class="dropdown-link-item" href="sign-in.html"> <i
                                                class="mdi mdi-logout"></i> Log Out </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>

            </header>

            <!-- ====================================
        ——— CONTENT WRAPPER
        ===================================== -->
            @yield('content')

            <!-- Footer -->
            <footer class="footer mt-auto">
                <div class="copyright bg-white">
                    <p>
                        &copy; <span id="copy-year"></span> Copyright by <a class="text-primary"
                            href="http://biztechsols.com" target="_blank">BizTechSols</a>.
                    </p>
                </div>
                <script>
                    var d = new Date();
                    var year = d.getFullYear();
                    document.getElementById("copy-year").innerHTML = year;
                </script>
            </footer>

        </div>
    </div>

    @include('auth.includes.scripts')
    @yield('scripts')

</body>

</html>
