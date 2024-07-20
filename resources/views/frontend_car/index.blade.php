<!DOCTYPE html>

    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ App::getLocale() == 'ar' ? 'rtl' : 'ltr' }}">


<head>
    @include('frontend_car.layouts.head')
</head>

<body>

        @include('frontend_car.layouts.topbar')

        @include('frontend_car.layouts.navbar')

    <!-- Search Start -->
        @include('frontend_car.layouts.search')
    <!-- Search End -->

    <!-- Carousel Start -->
        @include('frontend_car.layouts.carousel')
    <!-- Carousel End -->

    <!-- About Start -->
         @include('frontend_car.layouts.about')
    <!-- About End -->

    <!-- Services Start -->
        @include('frontend_car.layouts.services')
    <!-- Services End -->

    <!-- Banner Start -->
        @include('frontend_car.layouts.banner')
    <!-- Banner End -->

    <!-- Rent A Car Start -->
        @include('frontend_car.layouts.rent_car')
    <!-- Rent A Car End -->


    <!-- Team Start -->
        @include('frontend_car.layouts.team')
    <!-- Team End -->




    <!-- Contact Start -->
        @include('frontend_car.layouts.contact')
    <!-- Contact End -->




        @include('frontend_car.layouts.footer')


    <!-- Back to Top
         <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
 -->
        @include('frontend_car.layouts.javascript')


</body>

</html>
