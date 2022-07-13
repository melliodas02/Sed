<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="icon" href="{{ url('images') }}/logo-icon.png">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/select2/select2.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/select2/select2.js') }}"></script>

    <link href="https://cdn.jsdelivr.net/npm/suggestions-jquery@21.12.0/dist/css/suggestions.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/suggestions-jquery@21.12.0/dist/js/jquery.suggestions.min.js"></script>
</head>
<body>
<div id="app" class="">
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-navbar">
                <div class="d-flex flex-column align-items-center align-items-start px-3 pt-2 text-wh min-vh-100">
                    <a href="{{ route('home') }}"
                       class="d-flex align-items-center pb-3 mb-md-0 text-white text-decoration-none">
                        <span class="d-none d-sm-inline"><img class="logo-img" src="{{ url('images') }}/logo.png"></span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link align-middle px-0">
                                <ion-icon name="home"></ion-icon>
                                <span class="ms-1 d-none d-sm-inline">Главная</span>
                            </a>
                        </li>
                        <li>
                            <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <ion-icon name="document"></ion-icon>
                                <span class="ms-1 d-none d-sm-inline">Входящие документы</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="{{ route('docFromHiherLevel.index') }}" class="nav-link px-0"> <span
                                            class="d-none d-sm-inline">Документы от вышестоящей организации</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('CorrespondeceWithStateAuthorities.index') }}"
                                       class="nav-link px-0"> <span class="d-none d-sm-inline">Переписка с органами государственной власти</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('CorrespondenceWithOrganizationsAndEnterprises.index') }}"
                                       class="nav-link px-0"> <span class="d-none d-sm-inline">Переписка с организациями, предприятиями</span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <ion-icon name="document"></ion-icon>
                                <span class="ms-1 d-none d-sm-inline">Исходящие документы</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="{{ route('documents_from_a_higher_level_organizations.index') }}"
                                       class="nav-link px-0"> <span class="d-none d-sm-inline">Документы в адресс вышестоящих организаций</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('correspondence_with_state_authorities.index') }}"
                                       class="nav-link px-0"> <span class="d-none d-sm-inline">Переписка с органами государственной власти</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('correspondence_with_organizations_and_enterprises.index') }}"
                                       class="nav-link px-0"> <span class="d-none d-sm-inline">Переписка с организациями, предприятиями</span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <ion-icon name="document-text"></ion-icon>
                                <span class="ms-1 d-none d-sm-inline">Приказы</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="{{ route('orders.OrdersOnTheBasicsOfActivity') }}" class="nav-link px-0">
                                        <span class="d-none d-sm-inline">Приказы по основам деятельности</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('orders.OrdersOnAdministrativeAndEconomicIssues') }}"
                                       class="nav-link px-0"> <span class="d-none d-sm-inline">Приказы по административно-хозяейственным вопросам</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('orders.TravelOrders') }}" class="nav-link px-0"> <span
                                            class="d-none d-sm-inline">Приказы по командировкам</span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#submenu4" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <ion-icon name="document-text"></ion-icon>
                                <span class="ms-1 d-none d-sm-inline">Служебные записки</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu4" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="{{ route('memos.AboutEmployeeBusinessTrips') }}" class="nav-link px-0">
                                        <span class="d-none d-sm-inline">О командировках сотрудников</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('memos.AboutTheDevelopmentAndChangeOfStaffSchedules') }}"
                                       class="nav-link px-0"> <span class="d-none d-sm-inline">О разработке и изменении штатных расписаний</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('memos.ForPurchase') }}" class="nav-link px-0"> <span
                                            class="d-none d-sm-inline">На закупку</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('memos.AboutReimbursementOfExpenses') }}" class="nav-link px-0">
                                        <span class="d-none d-sm-inline">О возмещении расходов</span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#submenu5" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <ion-icon name="document-text"></ion-icon>
                                <span class="ms-1 d-none d-sm-inline">Договоры</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu5" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="{{ route('contracts.PurchaseAndSaleAgreement') }}" class="nav-link px-0">
                                        <span class="d-none d-sm-inline">Договор купли-продажи</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('contracts.LeaseAgreement') }}" class="nav-link px-0"> <span
                                            class="d-none d-sm-inline">Договор аренды</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('contracts.DeliveryContract') }}" class="nav-link px-0"> <span
                                            class="d-none d-sm-inline">Договор поставки</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('contracts.ContractAgreement') }}" class="nav-link px-0"> <span
                                            class="d-none d-sm-inline">Договор подряда</span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('organization.index') }}" class="nav-link align-middle px-0">
                                <ion-icon name="briefcase"></ion-icon>
                                <span class="ms-1 d-none d-sm-inline">Организации</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('mails.index') }}" class="nav-link align-middle px-0">
                                <ion-icon name="mail"></ion-icon>
                                <span class="ms-1 d-none d-sm-inline">Почта</span>
                            </a>
                        </li>
                        @hasrole('Admin')
                        <li>
                            <a href="{{ route('roles.index') }}" class="nav-link align-middle px-0">
                                <ion-icon name="mail"></ion-icon>
                                <span class="ms-1 d-none d-sm-inline">Управление ролями</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users.index') }}" class="nav-link align-middle px-0">
                                <ion-icon name="people"></ion-icon>
                                <span class="ms-1 d-none d-sm-inline">Пользователи</span>
                            </a>
                        </li>
                        @endhasrole
                    </ul>
                </div>
            </div>
            <div class="col p-0">
                <nav class="navbar navbar-dark bg-navbar">
                    <div class="container-fluid">
                        <form class="w-auto input-group">
                            <input
                                class="form-control form-control-sm rounded"
                                placeholder="Search"
                                aria-label="Search"
                                aria-describedby="search-addon"
                                name="search-input"
                            />
                            <a class="ms-2 btn btn-secondary btn-sm" name="search-btn" onclick="search_func()">Поиск</a>
                        </form>

                        <script>
                            function search_func()
                            {
                                var el = document.getElementsByName('search-input')[0].value;
                                el = el.replace(' ', '-');
                                window.location.href = '/search/'+el;
                            }
                        </script>

                        <div class="d-flex align-items-center">
                            <div class="dropdown pb-4 col-5 me-auto">
                                <a href="#"
                                   class="d-flex align-items-center text-white text-decoration-none dropdown-toggle pt-3"
                                   id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30"
                                         class="rounded-circle">
                                    <span class="d-none d-sm-inline mx-1">{{ auth()->user()->LastName }}</span> </a>
                                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                                    <li><a class="dropdown-item" href="">Настройки</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('logout') }}">Выход</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
                <div class="py-3 px-3">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Скрипты -->


<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
