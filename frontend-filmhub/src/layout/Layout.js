import React, { useEffect, useState } from 'react';

const Home2 = () => {
  




    const divStyle1 = {
        backgroundImage: 'url(assets/images/slider/slider-hm4-1.jpg)',
        backgroundSize: 'cover',
        backgroundPosition: 'center',
        height: '400px',
        width: '100%',
    };
    const divStyle2 = {
        backgroundImage: 'url(assets/images/slider/slider-hm4-2.jpg)',
        backgroundSize: 'cover',
        backgroundPosition: 'center',
        height: '400px',
        width: '100%',
    };

    const [currentSlide, setCurrentSlide] = useState(0);
    const slides = [divStyle1, divStyle2];

    const nextSlide = () => {
        const nextSlideIndex = (currentSlide + 1) % slides.length;
        setCurrentSlide(nextSlideIndex);
    };

    useEffect(() => {
        const interval = setInterval(() => {
            nextSlide();
        }, 3000);
        return () => clearInterval(interval);
    }, [currentSlide]);

    return (
        <div className="main-wrapper">
            <div className="slider-area bg-black">
                <div className="container-fluid p-0">
                    <div className="hero-slider-four dot-style-1 nav-style-1">
                        {slides.map((style, index) => (
                            <div key={index} className={`single-hero-slider-wrap single-animation-wrap slider-height-hm4 bg-image-hm4 slider-bg-color-black d-flex align-items-center slider-bg-position-1 bg-black ${currentSlide === index ? 'active' : ''}`}
                                style={style}>
                                <div className="slider-content-hm4 slider-animated">
                                    <h1 className="title animated">{index === 0 ? 'Out Of Network' : 'The Love of Mind'}</h1>
                                </div>
                            </div>
                        ))}
                    </div>
           
                </div>
            </div>
        



        
            <div className="movie-list section-padding-lr section-pt-50 bg-black">
                <div className="container-fluid">
                    <div className="section-title-4 st-border-bottom">
                        <h2>Latest Movies</h2>  
                    </div>
                    
                    <div className="movie-slider-active nav-style-2">
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-17.jpg" alt="" /></a>

                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html">Top Of The World</a></h3>

                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Teaser</a>
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Đặt vé</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-02.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html"> Land And Sea</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-03.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html">The Walk</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-04.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html">Never Stop Looking</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-01.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html">The Lost Girl</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-06.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html">The Lost Girl</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-05.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html"> Silkovettes In The Attic</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div className="series-list section-padding-lr section-pt-50 bg-black">
                <div className="container-fluid">
                    <div className="section-title-4 st-border-bottom">
                        <h2>Horror Series</h2>
                    </div>
                    <div className="movie-slider-active nav-style-2">
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="series-details.html"><img src="assets/images/product/horror-1.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="series-details.html">The Love Of Mine</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="series-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="series-details.html"><img src="assets/images/product/horror-2.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="series-details.html">The Adrift</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="series-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="series-details.html"><img src="assets/images/product/horror-3.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="series-details.html">She Film</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="series-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="series-details.html"><img src="assets/images/product/horror-4.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="series-details.html">Top Of The World</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="series-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="series-details.html"><img src="assets/images/product/horror-5.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="series-details.html"> Travel To Secrets</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="series-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="series-details.html"><img src="assets/images/product/horror-6.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="series-details.html">Wall Flower</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="series-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="series-details.html"><img src="assets/images/product/horror-3.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="series-details.html">Warm And Cozy</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="series-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div className="movie-list section-padding-lr section-ptb-50 bg-black">
                <div className="container-fluid">
                    <div className="section-title-4 st-border-bottom">
                        <h2>Old Movies</h2>
                    </div>
                    <div className="movie-slider-active nav-style-2">
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-07.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html">Love Africa</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-08.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html"> Charging To Victory</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-09.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html">Train To Hell</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-10.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html">Into The Darkness</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-11.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html"> Way We Get Bye</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-12.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html"> Blood Bone & Beasts</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-13.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html">The Locked</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {/* <div className="slider-area bg-black">
                                                            <div className="container-fluid p-0">
                                                                <div className="hero-slider-four dot-style-1 nav-style-1">
                                                                    <div className="single-hero-slider-wrap single-animation-wrap slider-height-hm4 bg-image-hm4 slider-bg-color-black d-flex align-items-center hero-overly slider-bg-position-2 bg-black"
                                                                        style="background-image:url(assets/images/slider/slider-hm4-3.png);">
                                                                        <div className="slider-content-hm4 slider-animated">
                                                                            <h1 className="title animated">3 in 1 Combo Pack</h1>
                                                                            <div className="combo-pack-price">
                                                                                <span className="new-price animated">200TK</span>
                                                                                <span className="old-price animated">350TK</span>
                                                                            </div>
                                                                            <div className="slider-button">
                                                                                <a href="movie-details.html" className="btn-style-hm4 animated">Watch Now</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div className="single-hero-slider-wrap single-animation-wrap slider-height-hm4 bg-image-hm4 slider-bg-color-black d-flex align-items-center hero-overly slider-bg-position-2 bg-black"
                                                                        style="background-image:url(assets/images/slider/slider-hm4-4.png);">
                                                                        <div className="slider-content-hm4 slider-animated">
                                                                            <h1 className="title animated">5 in 1 Combo Pack</h1>
                                                                            <div className="combo-pack-price">
                                                                                <span className="new-price animated">450TK</span>
                                                                                <span className="old-price animated">500TK</span>
                                                                            </div>
                                                                            <div className="slider-button">
                                                                                <a href="movie-details.html" className="btn-style-hm4 animated">Watch Now</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> */}
            <div className="movie-list section-padding-lr section-ptb-50 bg-black">
                <div className="container-fluid">
                    <div className="section-title-4 st-border-bottom">
                        <h2>Watch With Family</h2>
                    </div>
                    <div className="movie-slider-active nav-style-2">
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-14.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html">The Love Of Mine</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-15.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html">The Adrift</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-16.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html">She Film</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-17.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html">Top Of The World</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-18.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html"> Travel To Secrets</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-19.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html">Wall Flower</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-20.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html">Warm And Cozy</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div className="banner-area bg-black">
                <div className="series-banner-img">
                    <a href="series-details.html"><img src="assets/images/slider/series-2.png" alt="" /></a>
                </div>
            </div>
            <div className="movie-list section-padding-lr section-ptb-50 bg-black">
                <div className="container-fluid">
                    <div className="section-title-4 st-border-bottom">
                        <h2>Award Winning Movie</h2>
                    </div>
                    <div className="movie-slider-active nav-style-2">
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-21.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html">The Backwoods Mist</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-22.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html">The Secrets</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-23.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html">Dark Side & Winter</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-01.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html">The Lost Girl</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-02.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html"> Land And Sea</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-03.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html">The Walk</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="movie-wrap-plr">
                            <div className="movie-wrap text-center">
                                <div className="movie-img">
                                    <a href="movie-details.html"><img src="assets/images/product/movie-04.jpg" alt="" /></a>
                                    <button title="Watchlist" className="Watch-list-btn" type="button"><i
                                        className="zmdi zmdi-plus"></i></button>
                                </div>
                                <div className="movie-content">
                                    <h3 className="title"><a href="movie-details.html">Never Stop Looking</a></h3>
                                    <span>Quality : HD</span>
                                    <div className="movie-btn">
                                        <a href="movie-details.html" className="btn-style-hm4-2 animated">Watch Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div className="modal fade" id="exampleModal">
                <div className="modal-dialog modal-dialog-centered">
                    <div className="modal-content">
                        <div className="modal-header">
                            <button type="button" className="subscribe-btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                className="zmdi zmdi-close s-close"></i></button>
                        </div>
                        <div className="modal-body">
                            <h5 id="exampleModalLabel">Ready to watch? Enter your email to create or restart your
                                membership.</h5>
                            <div className="create-membership-wrap modify">
                                <input placeholder="Email Address" />
                                <button className="landing-btn-style" type="button">Get Started</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



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

export default Home2
