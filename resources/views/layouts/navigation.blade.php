<head>
    <!-- إضافة Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        /* تنسيق إشعارات التنقل */
        .navbar .dropdown-menu {
            left: auto;
            right: 0;
        }

        .notification-icon {
            position: relative;
            cursor: pointer;
        }

        .notification-icon .badge {
            position: absolute;
            top: -5px;
            right: -10px;
            background-color: red;
            color: white;
            font-size: 12px;
            padding: 4px 6px;
            border-radius: 50%;
        }

        /* تنسيق البطاقات */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-size: 1.2rem;
        }

        .card-text {
            font-size: 2.5rem;
        }

        /* تنسيق الإشعارات */
        .notifications-dropdown {
            max-height: 300px;
            overflow-y: auto;
        }
    </style>




</head>






<nav x-data="{ open: false }" class="bg-white border-b border-gray-100" style="direction: rtl;text-align:right">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboardcar')" :active="request()->routeIs('dashboardcar')">
                        {{ __('لوحة التحكم') }}
                    </x-nav-link>
                </div>

                @if (Auth::user()->can('isEmployee') || Auth::user()->can('isAdmin'))
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('car.index')" :active="request()->routeIs('car.index')">
                            {{ __('إدارة السيارات') }}
                        </x-nav-link>
                    </div>

                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.index')">
                            {{ __('إدارة الحجوزات للسيارات') }}
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('maintenances.index')" :active="request()->routeIs('maintenances.index')">
                            {{ __('إدارة صيانة السيارات') }}
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('fleets.index')" :active="request()->routeIs('fleets.index')">
                            {{ __('إدارة أسطول السيارات') }}
                        </x-nav-link>
                    </div>
                    @if (Auth::user()->can('isAdmin'))
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('garages.index')" :active="request()->routeIs('garages.index')">
                                {{ __('إدارة الكراجات ') }}
                            </x-nav-link>
                        </div>
                    @endif
                @elseif (Auth::user()->can('isCustomer'))
                    <!-- روابط العملاء -->
                @else
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('car.index')" :active="request()->routeIs('car.index')">
                            {{ __('استعراض السيارات والحجز') }}
                        </x-nav-link>
                    </div>


                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('ratings2.index')" :active="request()->routeIs('ratings2.index')">
                            {{ __(' التقييمات ') }}
                        </x-nav-link>
                    </div>





                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('customers.showByUserId', ['userId' => Auth::user()->id])" :active="request()->routeIs('customers.showByUserId', ['userId' => Auth::user()->id])">
                            {{ __('معلوماتي') }}
                        </x-nav-link>
                    </div>
                @endif

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="url('/')">
                        {{ __('الموقع الرئيسي') }}
                    </x-nav-link>
                </div>
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                            @if(!(Auth::user()->can('isEmployee') || Auth::user()->can('isAdmin')))

                            <!-- شريط التنقل -->
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav mr-auto"> <!-- استخدم mr-auto لجعل العناصر في أقصى اليسار -->
                                    <!-- أيقونة الإشعارات -->
                                    @auth
                                        <li class="nav-item dropdown notification-icon">
                                            <a class="nav-link" href="#" id="notificationsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-bell"></i>
                                                @if(Auth::user()->unreadNotifications->count())
                                                    <span class="badge badge-danger">{{ Auth::user()->unreadNotifications->count() }}</span>
                                                @endif
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right notifications-dropdown" aria-labelledby="notificationsDropdown">
                                                <h6 class="dropdown-header">الإشعارات</h6>
                                                @forelse(Auth::user()->notifications as $notification)
                                                    <a href="#" class="dropdown-item">
                                                        {{ $notification->data['message'] }}
                                                        <br><small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                                    </a>
                                                @empty
                                                    <p class="text-center">لا توجد إشعارات جديدة</p>
                                                @endforelse
                                            </div>
                                        </li>
                                    @endauth
                                </ul>
                            </div>
                        </nav>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>




