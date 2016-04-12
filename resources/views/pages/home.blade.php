@extends('layouts.marketing')

@section('content')
    <div id="top" class="landing-intro" role="main" style="background: url({{ asset('img/intro-cover.jpg') }})">
        <div class="container">
            <header class="header row">
                <div class="col-md-6 col-sm-12 text-center">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <p class="slogan hidden-sm hidden-xs">
                                Front desks <br> Made Easy
                            </p>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <nav>
                        <ul>
                            <li>
                                <a href="#" class="btn btn-white btn-alt">Pricing</a>
                            </li>
                            <li>
                                <a href="#" class="btn btn-white btn-alt">Request a demo</a>
                            </li>
                            <li>
                                <a href="{{ route('login') }}" class="btn btn-white btn-alt">Sign In</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </header>
            <div class="intro-slogan text-center animated fadeInDown">
                <h1>Get your front desk security done <strong>right!</strong>
                </h1>
                <p>
                    A Great <strong>Front Desk App</strong> Designed for Simplicity
                    <br class="hidden-xs">Very Powerful. User friendly.<strong>Fast integration.</strong>
                </p>
                <!-- todo add image from the dashboard -->
                <img class="img-responsive center-block center-block" src="#" alt="Securify">
            </div>
        </div>
        <div class="description-bar">
            <div class="container text-center">
                <p>Perfect Solution for Factories, Hotels, Industrial parks and companies with a front desk</p>
            </div>
        </div>
        <a href="#build-with-love" class="scrollTo">
            <p class="sroll-down">
                <img src="{{ asset('img/scroll_down.png') }}" alt="scrolldown">
            </p>
        </a>
    </div>
    <div id="features" class="section-features">
        <section id="clean-code" class="clean-code features-row">
            <div class="container">
                <div class="text-center">
                    <h3 class="section-header-1">What do you need to get your project,
                        <br class="hidden-sm hidden-xs">up and running fast?</h3>
                </div>
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <img class="img-responsive center-block" src="assets/img/landing/features/cleancode.png" alt="Clean code">
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <h3 class="section-header">Clean code</h3>
                        <p>All code blocks are property commented and seperated for easy management and integration</p>
                        <p>Tab indent 4 is used for good visual understanding</p>
                        <p>Directories , images and all other assets is placed in intuitive named directories</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="charts" class="charts gray-bg features-row">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <h3 class="section-header">Awesome Charts</h3>
                        <p>Securify is powered by Flot charts</p>
                        <p>With custom styling and warm colors</p>
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <img class="img-responsive center-block" src="assets/img/landing/features/charts.png" alt="Charts">
                    </div>
                </div>
            </div>
        </section>
        <section id="email-app" class="email-app features-row">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <img class="img-responsive center-block" src="assets/img/landing/features/email.png" alt="Clean code">
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <h3 class="section-header">Email app</h3>
                        <p>Check out your emails directly in app.</p>
                        <p>Securify has intuitive designed email app - inbox page, send mail page and write email page.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div id="testimonials" class="testimonials gray-bg">
        <div class="container">
            <div class="text-center">
                <h3 class="section-header-1">What our customers said</h3>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="testimonials-block">
                        <div class="testimonials-text">One of the best admin template ever. The number of customization options is pretty damn high</div>
                        <div class="testimonials-client">
                            <img src="assets/img/avatars/131.jpg" alt="Tina Dowsen">
                            <p>
                                <strong>Tina Dowsen</strong>
                                <br>CEO of <a href="#">Dowsen Inc</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="testimonials-block">
                        <div class="testimonials-text">Simply awesome. I managed to integrate this template in my system for one week. Very good job. Recommend it.</div>
                        <div class="testimonials-client">
                            <img src="assets/img/avatars/130.jpg" alt="Felix Jones">
                            <p>
                                <strong>Felix Jones</strong>
                                <br>Founder of <a href="#">Startapp</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 pt25 pb25 mt25">
                    <a href="#give-a-try" class="scrollTo">
                        <p class="sroll-down">
                            <img src="assets/img/landing/scroll_down.png" alt="scrolldown">
                        </p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div id="give-a-try" class="give-a-try">
        <div class="container">
            <div class="text-center">
                <h1>Have You Seen Enough?</h1>
                <p>Give it a <strong>try</strong>. It’s time to get your project <strong>done</strong>
                </p>
            </div>
            <div class="row mt50 mb50">
                <div class="col-md-12 text-center">
                    <a href="https://wrapbootstrap.com/theme/sprflat-responsive-admin-template-WB098M36S?ref=jorolino" class="btn btn-lg btn-danger uppercase" target="_blank"> Purchase</a>
                </div>
            </div>
            <div class="text-center">
                <p>Not convinced yet ? Explore demo.</p>
            </div>
            <div class="row mt50 mb50">
                <div class="col-md-12 text-center">
                    <a href="#" class="btn btn-lg btn-danger uppercase"> Demo</a>
                </div>
            </div>
        </div>
    </div>
    <footer id="footer">
        <div class="container">
            <div class="row mt50 mb50">
                <!-- Start .row -->
                <div class="col-md-12 footer-links">
                    <a href="#features" class="goTo">Features</a>
                    <a href="#testimonials" class="goTo">Testomonials</a>
                    <a href="#" target="_blank">Pricing</a>
                    <a href="#" target="_blank">Request a demo</a>
                    <a href="#top" class="back-to-top">Back to Top</a>
                    <p>&copy; 2016 Securify. All Rights Reserved</p>
                </div>
            </div>
            <!-- End .row -->
        </div>
    </footer>
@stop
