<!DOCTYPE html>

    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ App::getLocale() == 'ar' ? 'rtl' : 'ltr' }}">


<head>
    @include('frontend.layouts.head')
</head>

<body>

        @include('frontend.layouts.topbar')

        @include('frontend.layouts.navbar')

    <!-- Search Start -->
        @include('frontend.layouts.search')
    <!-- Search End -->

    <!-- Carousel Start -->
        @include('frontend.layouts.carousel')
    <!-- Carousel End -->

    <!-- About Start -->
         @include('frontend.layouts.about')
    <!-- About End -->

    <!-- Services Start -->
        @include('frontend.layouts.services')
    <!-- Services End -->

    <!-- Banner Start -->
        @include('frontend.layouts.banner')
    <!-- Banner End -->

    <!-- Rent A Car Start -->
        @include('frontend.layouts.rent_car')
    <!-- Rent A Car End -->


    <!-- Team Start -->
        @include('frontend.layouts.team')
    <!-- Team End -->




    <!-- Contact Start -->
        @include('frontend.layouts.contact')
    <!-- Contact End -->




        @include('frontend.layouts.footer')


    <!-- Back to Top
         <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
 -->
        @include('frontend.layouts.javascript')


</body>

</html>
