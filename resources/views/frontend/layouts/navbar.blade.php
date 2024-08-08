<!-- Navbar Start -->
<div class="container-fluid position-relative nav-bar p-0" style="direction:rtl">
    <div class="position-relative px-lg-5" style="z-index: 9;">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 py-lg-0 pl-3 pl-lg-5">
            <a href="#" class="navbar-brand">
                <h1 class="text-uppercase text-primary mb-1">يلا سيارة</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                <ul class="navbar-nav ml-auto py-0">
                    <li class="nav-item">
                        <a href="index.html" class="nav-link active">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a href="about.html" class="nav-link">حول</a>
                    </li>
                    <li class="nav-item">
                        <a href="service.html" class="nav-link">الخدمة</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">السيارات</a>
                        <div class="dropdown-menu rounded-0 bg-secondary">
                            <a href="car.html" class="dropdown-item">قائمة السيارات</a>
                            <a href="detail.html" class="dropdown-item">تفاصيل السيارة</a>
                            <a href="booking.html" class="dropdown-item">حجز السيارات</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">الصفحات</a>
                        <div class="dropdown-menu rounded-0 bg-secondary">
                            <a href="team.html" class="dropdown-item">الفريق</a>
                            <a href="testimonial.html" class="dropdown-item">شهادة</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="contact.html" class="nav-link">اتصال</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">الحساب</a>
                        <div class="dropdown-menu rounded-0 bg-secondary">
                            @guest
                                <a href="{{ route('login') }}" class="dropdown-item">تسجيل دخول</a>
                                <a href="{{ route('register') }}" class="dropdown-item">إنشاء حساب</a>
                            @else
                                <a href="{{ route('dashboard') }}" class="dropdown-item">لوحة التحكم</a>
                                <a href="{{ route('logout') }}" class="dropdown-item"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    تسجيل خروج
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @endguest
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->

<style>
    /* تحسينات على شريط التنقل */
    .navbar-nav .nav-link {
        color: #fff;
        transition: color 0.3s;
    }
    .navbar-nav .nav-link:hover {
        color: #f0ad4e;
    }
    .dropdown-menu {
        background-color: #343a40;
        border: none;
    }
    .dropdown-item {
        color: #fff;
        transition: background-color 0.3s;
    }
    .dropdown-item:hover {
        background-color: #495057;
    }
    .navbar-toggler {
        border: none;
    }
    .navbar-toggler-icon {
        background-image: url('data:image/svg+xml;utf8,<svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><path stroke="rgba(255, 255, 255, 0.5)" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"/></svg>');
    }
</style>


