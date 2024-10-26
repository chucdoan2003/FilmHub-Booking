import React from 'react'

const Header = () => {
    return (

        <div class="main-wrapper">

            <header class="header-area bg-black section-padding-lr">
                <div class="container-fluid">
                    <div class="header-wrap header-netflix-style">
                        <div class="logo-menu-wrap">

                            <div class="logo">
                                <a href="index-4.html"><img src="assets/images/logo/logo.png" alt="" /></a>
                            </div>

                            <div class="main-menu main-theme-color-four">
                                <nav class="main-navigation">
                                    <ul>
                                        <li class="active"><a href="index-4.html">Home</a></li>
                                        <li><a href="series.html">Series </a>
                                            <ul class="sub-menu">
                                                <li><a href="horror-series.html">Horror Series</a></li>
                                                <li><a href="romantic-series.html">Romantic Series</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="movie.html">Movies</a>
                                            <ul class="sub-menu">
                                                <li><a href="horror-movie.html">Horror Movies</a></li>
                                                <li><a href="romantic-movie.html">Romantic Movies</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Pages</a>
                                            <ul class="sub-menu">
                                                <li><a href="about-2.html">About Us</a></li>
                                                <li><a href="pricing-plan-2.html">Pricing</a></li>
                                                <li><a href="watchlist.html">Watchlist</a></li>
                                                <li><a href="history.html">History</a></li>
                                                <li><a href="movie-details.html">Movie details</a></li>
                                                <li><a href="series-details.html">Series details</a></li>
                                                <li><a href="faq-2.html">FAQ</a></li>
                                                <li><a href="my-account-2.html">My Account</a></li>
                                                <li><a href="landing-page.html">Landing Page</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="pricing-plan-2.html">Pricing</a></li>
                                        <li><a href="contact-2.html">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="right-side d-flex">

                            <div class="header-search-2">
                                <a class="search-toggle" href="#">
                                    <i class="zmdi zmdi-search s-open"></i>
                                    <i class="zmdi zmdi-close s-close"></i>
                                </a>
                                <div class="search-wrap-2">
                                    <form action="#">
                                        <input placeholder="Search" type="text" />
                                        <button class="button-search"><i class="zmdi zmdi-search"></i></button>
                                    </form>
                                </div>
                            </div>

                            <div class="notifications-bar btn-group">
                                <a href="#" class="notifications-iocn white" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="zmdi zmdi-notifications"></i> <span>5</span>
                                </a>
                                <div class="dropdown-menu netflix-notifications-style red">
                                    <h5>Notifications</h5>
                                    <ul>
                                        <li class="single-notifications">
                                            <a href="#">
                                                <span class="image"><img src="assets/images/review/author-01.png"
                                                    alt="" /></span>
                                                <span class="notific-contents">
                                                    <span>Lorem ipsum dolor sit amet consectetur.</span>
                                                    <span class="time">21 hours ago</span>
                                                </span>

                                            </a>
                                        </li>
                                        <li class="single-notifications">
                                            <a href="#">
                                                <span class="image"><img src="assets/images/review/author-01.png"
                                                    alt="" /></span>
                                                <span class="notific-contents">
                                                    <span>Lorem ipsum dolor sit amet consectetur.</span>
                                                    <span class="time">21 hours ago</span>
                                                </span>

                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="our-profile-area ">
                                <a href="#" class="our-profile-pc" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <img src="assets/images/review/author-01.png" alt="" />
                                </a>
                                <div class="dropdown-menu netflix-profile-style red">
                                    <ul>
                                        <li class="single-list"><a href="history.html">History</a></li>
                                        <li class="single-list"><a href="watchlist.html">Watchlist</a></li>
                                        <li class="single-list"><a href="my-account-2.html">My Account</a></li>
                                        <li class="single-list"><a href="login-and-register-2.html">Log Out</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="subscribe-btn-wrap">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    class="subscribe-btn">Subscribe Now</button>
                            </div>

                            <div class="mobile-menu d-block d-lg-none"></div>

                        </div>
                    </div>
                </div>
            </header>





            <script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
            <script src="assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>

            <script src="assets/js/popper.min.js"></script>

            <script src="assets/js/bootstrap.min.js"></script>

            <script src="assets/js/plugins.js"></script>

            <script src="assets/js/ajax-mail.js"></script>

            <script src="assets/js/main.js"></script>
        </div>
    )
}

export default Header
