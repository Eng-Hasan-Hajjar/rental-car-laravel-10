
<!-- Navbar Start -->
<div class="container-fluid position-relative nav-bar p-0"  style="direction:rtl">
    <div class="position-relative px-lg-5" style="z-index: 9;">
        <nav class="navbar navbar-expand-lg bg-secondary navbar-dark py-3 py-lg-0 pl-3 pl-lg-5">
            <a href="" class="navbar-brand">
                <h1 class="text-uppercase text-primary mb-1">يلا سيارة</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                <div class="navbar-nav ml-auto py-0">
                    <a href="index.html" class="nav-item nav-link active">الرئيسية</a>
                    <a href="about.html" class="nav-item nav-link">حول</a>
                    <a href="service.html" class="nav-item nav-link">الخدمة</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">السيارات</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="car.html" class="dropdown-item">قائمة السيارات</a>
                            <a href="detail.html" class="dropdown-item">تفاصيل السيارة</a>
                            <a href="booking.html" class="dropdown-item">حجز السيارات</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">الصفحات</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="team.html" class="dropdown-item">الفريق</a>
                            <a href="testimonial.html" class="dropdown-item">شهادة</a>
                        </div>
                    </div>
                    <a href="contact.html" class="nav-item nav-link">اتصال</a>
                </div>
                <div class="navbar-nav">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">الحساب</a>
                        <div class="dropdown-menu rounded-0 m-0">
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
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->
