<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        {{-- <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
        </a> --}}
        {{-- <a class="navbar-brand pt-0" href="{{ route('home') }}">
           <p></p> 
        </a> --}}
        <!-- User -->
        {{-- <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul> --}}
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                
                @can('admin-access')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-btn-validation">
                            <i class="ni ni-folder-17 text-blue"></i>
                            <span class="nav-link-text">{{ __('Validation List') }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <div class="dropdown-container-validation">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('validatedSubject') }}">
                                        {{ __('Tutor Subject') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('validatedOrganisation') }}">
                                        {{ __('Organisation') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('validatedSchool') }}">
                                        {{ __('School') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('promoList') }}">
                            <i class="ni ni-tag text-blue"></i> {{ __('Promo List') }}
                        </a>
                    </li>
                @endcan
                {{-- user --}}
                {{-- tutor --}}
                {{-- @can('tutor-access')
                    <!-- Content visible to users with the 'admin' role -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tutorGet') }}">
                            <i class="ni ni-single-02 text-blue"></i> {{ __('Manage Tutor') }}
                        </a>
                    </li>                
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tutorExperience') }}">
                            <i class="ni ni-paper-diploma text-blue"></i> {{ __('Experience List') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tutorAcademicHistories') }}">
                            <i class="ni ni-briefcase-24 text-blue"></i> {{ __('Academic Histories') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('scheduleList') }}">
                            <i class="ni ni-calendar-grid-58 text-blue"></i> {{ __('Schedule') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tutoringList') }}">
                            <i class="ni ni-ruler-pencil text-blue"></i> {{ __('Tutoring') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('subjectList') }}">
                            <i class="ni ni-collection text-blue"></i> {{ __('Subjects') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-btn-seeking">
                            <i class="ni ni-badge text-blue"></i>
                            <span class="nav-link-text">{{ __('Seeking Tutor') }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <div class="dropdown-container-seeking">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('seekingMarket') }}">
                                        {{ __('Seeking Market') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('seekingListTutor') }}">
                                        {{ __('My List') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @else
                @endcan --}}
                {{-- institution --}}
                @can('institution-access')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('institution.dashboard') }}">
                            <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('institutionGet') }}">
                            <i class="ni ni-building text-blue"></i> {{ __('Manage Institution') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('institutionAward') }}">
                            <i class="ni ni-trophy text-blue"></i> {{ __('Awards List') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('scheduleList') }}">
                            <i class="ni ni-calendar-grid-58 text-blue"></i> {{ __('Schedule') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tutoringList') }}">
                            <i class="ni ni-ruler-pencil text-blue"></i> {{ __('Tutoring') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('subjectList') }}">
                            <i class="ni ni-collection text-blue"></i> {{ __('Subjects') }}
                        </a>
                    </li>
                @else
                    @can('tutor-access')
                        <!-- Content visible to users with the 'admin' role -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tutor.dashboard') }}">
                                <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tutorGet') }}">
                                <i class="ni ni-single-02 text-blue"></i> {{ __('Manage Tutor') }}
                            </a>
                        </li>                
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tutorExperience') }}">
                                <i class="ni ni-paper-diploma text-blue"></i> {{ __('Experience List') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tutorAcademicHistories') }}">
                                <i class="ni ni-briefcase-24 text-blue"></i> {{ __('Academic Histories') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('scheduleList') }}">
                                <i class="ni ni-calendar-grid-58 text-blue"></i> {{ __('Schedule') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tutoringList') }}">
                                <i class="ni ni-ruler-pencil text-blue"></i> {{ __('Tutoring') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('subjectList') }}">
                                <i class="ni ni-collection text-blue"></i> {{ __('Subjects') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link dropdown-btn-seeking">
                                <i class="ni ni-badge text-blue"></i>
                                <span class="nav-link-text">{{ __('Seeking Tutor') }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                                <i class="fa fa-caret-down"></i>
                            </a>
                            <div class="dropdown-container-seeking">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('seekingMarket') }}">
                                            {{ __('Seeking Market') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('seekingListTutor') }}">
                                            {{ __('My List') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @else
                    @endcan
                @endcan
                {{-- school --}}
                @can('school-access')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('welcome') }}">
                            <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('schoolGet') }}">
                            <i class="ni ni-building text-blue"></i> {{ __('Manage School') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('enrollmentPrice') }}">
                            <i class="ni ni-tag text-blue"></i> {{ __('Enrollment Type') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('facilityGet') }}">
                            <i class="ni ni-collection text-blue"></i> {{ __('School Facility') }}
                        </a>
                    </li>
                @endcan
                {{-- shuttle --}}
                @can('shuttle-access')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('welcome') }}">
                            <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shuttleGet') }}">
                            <i class="ni ni-bus-front-12 text-blue"></i> {{ __('Manage Shuttle') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('destinationGet') }}">
                            <i class="ni ni-pin-3 text-blue"></i> {{ __('Shuttle Destination') }}
                        </a>
                    </li>
                @endcan
                {{-- organiser --}}
                @can('organiser-access')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('orgDashboard') }}">
                            <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('organiserGet') }}">
                            <i class="ni ni-building text-blue"></i> {{ __('Manage Organisation') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('competitionGet') }}">
                            <i class="ni ni-trophy text-blue"></i> {{ __('Competition List') }}
                        </a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('/') }}">
                        <i class="ni ni-planet text-blue"></i> {{ __('To Marketplace') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run text-blue"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </li>
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        var dropdownBtn = document.querySelector(".dropdown-btn-seeking");
                        var dropdownContainer = document.querySelector(".dropdown-container-seeking");
                
                        dropdownBtn.addEventListener("click", function () {
                            dropdownContainer.style.display = (dropdownContainer.style.display === "none") ? "block" : "none";
                        });
                    });
                    document.addEventListener("DOMContentLoaded", function () {
                        var dropdownBtn = document.querySelector(".dropdown-btn-validation");
                        var dropdownContainer = document.querySelector(".dropdown-container-validation");
                
                        dropdownBtn.addEventListener("click", function () {
                            dropdownContainer.style.display = (dropdownContainer.style.display === "none") ? "block" : "none";
                        });
                    });
                </script>
                
                 {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('icons') }}">
                        <i class="ni ni-planet text-blue"></i> {{ __('Icons') }}
                    </a>
                </li> --}}
                {{-- <li class="nav-item ">
                    <a class="nav-link" href="{{ route('map') }}">
                        <i class="ni ni-pin-3 text-orange"></i> {{ __('Maps') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('table') }}">
                      <i class="ni ni-bullet-list-67 text-default"></i>
                      <span class="nav-link-text">Tables</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-circle-08 text-pink"></i> {{ __('Register') }}
                    </a>
                </li> --}}
                
            </ul>
        </div>
    </div>
</nav>
