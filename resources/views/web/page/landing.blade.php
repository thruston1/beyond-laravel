<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="{{ asset('assets/web/global/css/bootstrap-4.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('assets/web/global/css/swiper.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/web/custom/css/style.css') }}">
    </head>
    <body>
        <!-- Navigation Start -->
        <header>
            <section>
                <nav class="navbar navbar-expand-lg navbar-light bg-color-main round-bot-lef-rig">
                    <div class="container">
                        <a class="navbar-brand" href="#"><img src="{{ asset('assets/web/img/Ai-CHA CHARACTER LANDSCAPE transparan 1.png') }}" width="160px" alt="Logo"></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item active">
                                    <a class="nav-link text-color-white" href="#">ABOUT US<span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-color-white" href="#">MENU</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-color-white" href="#">PROMO</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-color-white" href="#">NEWS</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-color-white" href="#">STORE LOCATION</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </section>
        </header>
        <!-- Navigation End -->

        <!-- Banner Start -->
        <section>
            <div class="container-fluid p-0">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="height-30px rounded-circle active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1" class="height-30px rounded-circle"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2" class="height-30px rounded-circle"></li>
                    </ol>
                    <div class="carousel-inner position-relative">
                        <div class="carousel-item active">
                            <div class="position-absolute absolute-top w-100 h-100">
                                <div class="row m-0 h-100">
                                    <div class="col text-center">
                                        <h1>WANT MILK TEA?</h1>
                                        <h2 class="h3 mb-5">FOR THE TEA LOVERS</h2>
                                        <h2 class="h3">Celebrate the bubble <br> tea for you</h2>
                                    </div>
                                </div>
                            </div>
                            <img class="d-block carousel-img w-100" src="{{ asset('assets/web/img/carosel1.png') }}" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <div class="position-absolute absolute-top w-100 h-100">
                                <div class="row m-0 h-100">
                                    <div class="col text-center">
                                        <h1>WANT MILK TEA?</h1>
                                        <h2 class="h3 mb-5">FOR THE TEA LOVERS</h2>
                                        <h2 class="h3">Celebrate the bubble <br> tea for you</h2>
                                    </div>
                                </div>
                            </div>
                            <img class="d-block carousel-img w-100" src="{{ asset('assets/web/img/Ai-CHA CHARACTER LANDSCAPE transparan 1.png') }}" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <div class="position-absolute absolute-top w-100 h-100">
                                <div class="row m-0 h-100">
                                    <div class="col text-center">
                                        <h1>WANT MILK TEA?</h1>
                                        <h2 class="h3 mb-5">FOR THE TEA LOVERS</h2>
                                        <h2 class="h3">Celebrate the bubble <br> tea for you</h2>
                                    </div>
                                </div>
                            </div>
                            <img class="d-block carousel-img w-100" src="..." alt="Third slide">
                        </div>
                    </div>
                    <!-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a> -->
                </div>
            </div>
        </section>
        <!-- Banner End -->

        <!-- Popular Product Start -->
        <section>
            <div class="container-fluid mt-4">
                <div class="row" style="margin-bottom: 196px;">
                    <div class="col">
                        <h2 class="text-color-main">Popular <span class="text-dark">Product</span></h2>
                    </div>
                    <div class="col align-self-center text-right">
                        <button class="btn bg-color-secondary border-radius-all text-color-white">
                            See more
                        </button>
                    </div>
                </div>
                <div class="swiper mySwiper overflow-visible">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide mr-4">
                            <div class="card bg-danger position-relative px-5 border-radius-all">
                                <img src="{{ asset('assets/web/img/Ai-MILK TEA BROWN SUGAR PEARL.png') }}" class="popular-img mx-auto img-fluid" width="" alt="Logo Ai-CHA">
                                <p class="text-center font-weight-bold text-color-white-no-bold">Ai-MILK TEA BROWN SUGAR PEARL</p>
                                <p class="text-center text-color-white-no-bold"> 29.000</p>
                            </div>
                        </div>
                        <div class="swiper-slide mr-4">
                            <div class="card bg-danger px-5 border-radius-all">
                                <img src="{{ asset('assets/web/img/Ai-CHA BLUEBERRY FRUIT.png') }}" class="popular-img mx-auto img-fluid" width="" alt="Logo Ai-CHA">
                                <p class="text-center font-weight-bold text-color-white-no-bold">Ai-CHA BLUEBERRY FRUIT</p>
                                <p class="text-center text-color-white-no-bold"> 29.000</p>
                            </div>
                        </div>
                        <div class="swiper-slide mr-4">
                            <div class="card bg-danger px-5 border-radius-all">
                                <img src="{{ asset('assets/web/img/SUND-Ai PEACH JAM.png') }}" class="popular-img mx-auto img-fluid" width="" alt="Logo Ai-CHA">
                                <p class="text-center font-weight-bold text-color-white-no-bold">SUND-Ai PEACH JAM</p>
                                <p class="text-center text-color-white-no-bold"> 29.000</p>
                            </div>
                        </div>
                        <div class="swiper-slide mr-4">
                            <div class="card bg-danger px-5 border-radius-all">
                                <img src="{{ asset('assets/web/img/Ai-SMOOTHIES STRAWBERRY.png') }}" class="popular-img mx-auto img-fluid" width="" alt="Logo Ai-CHA">
                                <p class="text-center font-weight-bold text-color-white-no-bold">Ai-SMOOTHIES STRAWBERRY</p>
                                <p class="text-center text-color-white-no-bold"> 29.000</p>
                            </div>
                        </div>
                        <div class="swiper-slide mr-4">
                            <div class="card bg-danger px-5 border-radius-all">
                                <img src="{{ asset('assets/web/img/Ai-CHA ORIGINAL JASMINE.png') }}" class="popular-img mx-auto img-fluid" width="" alt="Logo Ai-CHA">
                                <p class="text-center font-weight-bold text-color-white-no-bold">Ai-CHA ORIGINAL JASMINE</p>
                                <p class="text-center text-color-white-no-bold"> 29.000</p>
                            </div>
                        </div>
                        <div class="swiper-slide mr-4">
                            <div class="card bg-danger px-5 border-radius-all">
                                <img src="{{ asset('assets/web/img/Ai-MILK TEA BROWN SUGAR PEARL.png') }}" class="popular-img mx-auto img-fluid" width="" alt="Logo Ai-CHA">
                                <p class="text-center font-weight-bold text-color-white-no-bold">Ai-MILK TEA BROWN SUGAR PEARL</p>
                                <p class="text-center text-color-white-no-bold"> 29.000</p>
                            </div>
                        </div>
                        <div class="swiper-slide mr-4">
                            <div class="card bg-danger px-5 border-radius-all">
                                <img src="{{ asset('assets/web/img/Ai-MILK TEA BROWN SUGAR PEARL.png') }}" class="popular-img mx-auto img-fluid" width="" alt="Logo Ai-CHA">
                                <p class="text-center font-weight-bold text-color-white-no-bold">Ai-MILK TEA BROWN SUGAR PEARL</p>
                                <p class="text-center text-color-white-no-bold"> 29.000</p>
                            </div>
                        </div>
                        <div class="swiper-slide mr-4">
                            <div class="card bg-danger px-5 border-radius-all">
                                <img src="{{ asset('assets/web/img/Ai-MILK TEA BROWN SUGAR PEARL.png') }}" class="popular-img mx-auto img-fluid" width="" alt="Logo Ai-CHA">
                                <p class="text-center font-weight-bold text-color-white-no-bold">Ai-MILK TEA BROWN SUGAR PEARL</p>
                                <p class="text-center text-color-white-no-bold"> 29.000</p>
                            </div>
                        </div>
                        <div class="swiper-slide mr-4">
                            <div class="card bg-danger px-5 border-radius-all">
                                <img src="{{ asset('assets/web/img/Ai-MILK TEA BROWN SUGAR PEARL.png') }}" class="popular-img mx-auto img-fluid" width="" alt="Logo Ai-CHA">
                                <p class="text-center font-weight-bold text-color-white-no-bold">Ai-MILK TEA BROWN SUGAR PEARL</p>
                                <p class="text-center text-color-white-no-bold"> 29.000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Popular Product End -->

        <!-- Spesial News Find Start -->
        <section class="mt-5 pt-5">
            <div class="container-fluid p-0 bg-success" style="height: 190px;">
                <div class="container position-relative">
                    <div class="container position-absolute" style="top: -40px; left: 0px;">
                        <div class="row" style="height: 140px;">
                            <div class="col-4 bg-info position-relative">
                                <div class="position-absolute bg-secondary" style="top:0px; left:0px;">
                                    <h6>Special</h6>
                                    <h6>Promo</h6>
                                </div>
                            </div>
                            <div class="col-4 bg-secondary position-relative">
                                <div class="position-absolute bg-light" style="top:0px; left:0px;">
                                    <h6>News</h6>
                                    <h6>And Event</h6>
                                </div>
                            </div>
                            <div class="col-4 bg-light position-relative">
                                <div class="position-absolute bg-info" style="top:0px; left:0px;">
                                    <h6>Find</h6>
                                    <h6>Our Outlet</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Spesial News Find End -->

        <!-- Big Order Start -->
        <section>
            <div class="container-fluid p-0 bg-danger">
                <div class="container">
                    <div class="row">
                        <div class="col-7">
                            <h1 class="">Big Order?</h1>
                            <div class="d-flex">
                                <h2>Find out how</h2>
                                <button>Click Here</button>
                            </div>
                        </div>
                        <div class="col-5 bg-primary">
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Big Order End -->

        <!-- Best Quality Ingredients Start -->
        <section>
            <div class="container-fluid">
                <h2 class="text-danger">Best Quality <span class="text-dark">Ingredients</span></h2>
            </div>
            <div>

            </div>
        </section>
        <!-- Best Quality Ingredients End -->

        <!-- Grid Fresh Fun Happines Start -->
        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4">
                        <div class="col bg-success mb-2" style="height: 200px;">

                        </div>
                        <div class="col bg-danger d-flex justify-content-center mb-0 pb-0 text-center" style="height: 130px;">
                            <h2 class="align-self-center">Fresh.</h2>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="col bg-danger mb-2 d-flex justify-content-center mb-0 pb-0 text-center" style="height: 130px;">
                            <h2 class="align-self-center">Fun.</h2>
                        </div>
                        <div class="col bg-success" style="height: 200px;">

                        </div>
                    </div>
                    <div class="col-4">
                        <div class="col bg-success mb-2" style="height: 200px;">

                        </div>
                        <div class="col bg-danger d-flex justify-content-center mb-0 pb-0 text-center" style="height: 130px;">
                            <h2 class="align-self-center">Happines.</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Grid Fresh Fun Happines End -->

        <!-- Subscribe Start -->
        <section>
            <div class="container bg-primary" >
                <div class="row">
                    <div class="col-3 bg-warning" style="height: 100px;">
                        
                    </div>
                    <div class="col-3 bg-secondary" style="height: 100px;">
                        <h2>Subscribe</h2>
                        <h2>To News</h2>
                    </div>
                    <div class="col-6 bg-info d-flex" style="height: 100px;">
                        <input type="text" name="" class="align-self-center">
                    </div>
                </div>
            </div>
        </section>
        <!-- Subscribe End -->

        <!-- Footer Start -->
        <!-- <footer>
            <section class="bg-color-main round-top-left-right">
                <div class="row m-0 py-5">
                    <div class="col-3 p-0">
                        <div class="bg-color-primariy-3 round-right-top-bot">
                            <img src="assets/img/logo.png" class="pl-5 py-3 mr-0" width="250px" alt="Logo Ai-CHA">
                        </div>
                    </div>
                    <div class="col text-right mr-2">
                        <div>
                            <a href="#" class="text-decoration-none text-color-white-no-bold px-2">Privacy Policy</a>
                            <a href="#" class="text-decoration-none text-color-white-no-bold px-2">Career</a>
                            <a href="#" class="text-decoration-none text-color-white-no-bold px-2">Contact Us</a>
                            <a href="#" class="text-decoration-none text-color-white-no-bold pl-2">FAQ</a>
                        </div>
                        <div class="bg-success" style="height: 20px;">

                        </div>
                    </div>
                </div>
                <div class="row m-0 justify-content-center">
                    <p>@copy 2022 all rights reserved</p>
                </div>
            </section>
        </footer> -->
        <!-- Footer End -->

        <!-- Footer Start -->
        <footer>
            <section class="bg-color-main round-top-left-right">
                <div class="position-relative px-auto" style="top:30px">
                    <div class="bg-color-primariy-3 round-right-top-bot">
                    </div>
                    <div class="container position-relative" style="top: -90px">
                        <div class="position-absolute w-100" style="top:0px; left: 0px;">
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <img src="{{ asset('assets/web/img/Ai-CHA CHARACTER LANDSCAPE transparan 1.png') }}" class="img-fluid" width="250px" alt="Logo Ai-CHA">
                                </div>
                                <div class="col text-right">
                                    <div>
                                        <a href="#" class="text-decoration-none text-color-white-no-bold px-2">Privacy Policy</a>
                                        {{-- <a href="#" class="text-decoration-none text-color-white-no-bold px-2">Career</a> --}}
                                        <a href="#" class="text-decoration-none text-color-white-no-bold pl-2">Contact Us</a>
                                        {{-- <a href="#" class="text-decoration-none text-color-white-no-bold pl-2">FAQ</a> --}}
                                    </div>
                                    <div class="d-flex justify-content-end mt-3" style="height: 20px;">
                                        <div class="px-2">
                                            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.88002 0.197266H14.28C17.48 0.197266 20.08 2.79727 20.08 5.99727V14.3973C20.08 15.9355 19.4689 17.4108 18.3812 18.4985C17.2935 19.5862 15.8183 20.1973 14.28 20.1973H5.88002C2.68002 20.1973 0.0800171 17.5973 0.0800171 14.3973V5.99727C0.0800171 4.45901 0.691087 2.98376 1.7788 1.89605C2.86651 0.808335 4.34176 0.197266 5.88002 0.197266ZM5.68002 2.19727C4.72524 2.19727 3.80956 2.57655 3.13443 3.25168C2.4593 3.92681 2.08002 4.84249 2.08002 5.79727V14.5973C2.08002 16.5873 3.69002 18.1973 5.68002 18.1973H14.48C15.4348 18.1973 16.3505 17.818 17.0256 17.1429C17.7007 16.4677 18.08 15.552 18.08 14.5973V5.79727C18.08 3.80727 16.47 2.19727 14.48 2.19727H5.68002ZM15.33 3.69727C15.6615 3.69727 15.9795 3.82896 16.2139 4.06338C16.4483 4.2978 16.58 4.61575 16.58 4.94727C16.58 5.27879 16.4483 5.59673 16.2139 5.83115C15.9795 6.06557 15.6615 6.19727 15.33 6.19727C14.9985 6.19727 14.6806 6.06557 14.4461 5.83115C14.2117 5.59673 14.08 5.27879 14.08 4.94727C14.08 4.61575 14.2117 4.2978 14.4461 4.06338C14.6806 3.82896 14.9985 3.69727 15.33 3.69727ZM10.08 5.19727C11.4061 5.19727 12.6779 5.72405 13.6156 6.66173C14.5532 7.59941 15.08 8.87118 15.08 10.1973C15.08 11.5233 14.5532 12.7951 13.6156 13.7328C12.6779 14.6705 11.4061 15.1973 10.08 15.1973C8.75393 15.1973 7.48217 14.6705 6.54448 13.7328C5.6068 12.7951 5.08002 11.5233 5.08002 10.1973C5.08002 8.87118 5.6068 7.59941 6.54448 6.66173C7.48217 5.72405 8.75393 5.19727 10.08 5.19727ZM10.08 7.19727C9.28437 7.19727 8.52131 7.51334 7.9587 8.07594C7.39609 8.63855 7.08002 9.40162 7.08002 10.1973C7.08002 10.9929 7.39609 11.756 7.9587 12.3186C8.52131 12.8812 9.28437 13.1973 10.08 13.1973C10.8757 13.1973 11.6387 12.8812 12.2013 12.3186C12.7639 11.756 13.08 10.9929 13.08 10.1973C13.08 9.40162 12.7639 8.63855 12.2013 8.07594C11.6387 7.51334 10.8757 7.19727 10.08 7.19727Z" fill="white"/>
                                            </svg>
                                        </div>
                                        <div class="px-2">
                                            <svg width="21" height="18" viewBox="0 0 21 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M21 2.69727C20.23 3.04727 19.4 3.27727 18.54 3.38727C19.42 2.85727 20.1 2.01727 20.42 1.00727C19.59 1.50727 18.67 1.85727 17.7 2.05727C16.91 1.19727 15.8 0.697266 14.54 0.697266C12.19 0.697266 10.27 2.61727 10.27 4.98727C10.27 5.32727 10.31 5.65727 10.38 5.96727C6.82002 5.78727 3.65002 4.07727 1.54002 1.48727C1.17002 2.11727 0.960017 2.85727 0.960017 3.63727C0.960017 5.12727 1.71002 6.44727 2.87002 7.19727C2.16002 7.19727 1.50002 6.99727 0.920017 6.69727V6.72727C0.920017 8.80727 2.40002 10.5473 4.36002 10.9373C3.73074 11.1095 3.07011 11.1334 2.43002 11.0073C2.70162 11.8597 3.23355 12.6057 3.95103 13.1402C4.66851 13.6747 5.53546 13.971 6.43002 13.9873C4.91365 15.1877 3.03401 15.8366 1.10002 15.8273C0.760017 15.8273 0.420017 15.8073 0.0800171 15.7673C1.98002 16.9873 4.24002 17.6973 6.66002 17.6973C14.54 17.6973 18.87 11.1573 18.87 5.48727C18.87 5.29727 18.87 5.11727 18.86 4.92727C19.7 4.32727 20.42 3.56727 21 2.69727Z" fill="white"/>
                                            </svg>
                                        </div>
                                        <div class="pl-2">
                                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20 10.2222C20 4.70217 15.52 0.222168 10 0.222168C4.48 0.222168 0 4.70217 0 10.2222C0 15.0622 3.44 19.0922 8 20.0222V13.2222H6V10.2222H8V7.72217C8 5.79217 9.57 4.22217 11.5 4.22217H14V7.22217H12C11.45 7.22217 11 7.67217 11 8.22217V10.2222H14V13.2222H11V20.1722C16.05 19.6722 20 15.4122 20 10.2222Z" fill="white"/>
                                            </svg>
                                        </div>                          
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid mt-5">
                    <div class="row border-top-footer">
                        <div class="col mt-2">
                            <p class="text-center text-color-white-no-bold">&copy; 2022 all rights reserved</p>
                        </div>
                    </div>
                </div>
            </section>
        </footer>
        <!-- Footer End -->
        

        <!-- JS Start -->
        <script src="{{ asset('assets/web/global/js/jquery3.2.1.js') }}"></script>
        <script src="{{ asset('assets/web/global/js/popper.js') }}"></script>
        <script src="{{ asset('assets/web/global/js/bootstrap4.js') }}"></script>
        <script src="{{ asset('assets/web/global/js/swiperjs.js') }}"></script>
        <!-- JS End -->

        <!-- Initialize Swiper -->
        <script>
            var swiper = new Swiper(".mySwiper", {
                slidesPerView: 1,
                centeredSlides: false,
                slidesPerGroupSkip: 1,
                grabCursor: true,
                keyboard: {
                    enabled: true,
                },
                breakpoints: {
                769: {
                    slidesPerView: 5,
                    slidesPerGroup: 1,
                },
                },
                scrollbar: {
                    el: ".swiper-scrollbar",
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });
        </script>
    </body>
</html>
