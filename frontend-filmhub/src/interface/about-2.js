import React from 'react';
import { Link } from 'react-router-dom';

const About = () => {
  
  return (
    <div>
      <div className="main-wrapper">
   
        
        <div className="breadcrumb-area breadcrumb-modify-padding bg-black-2">
          <div className="container">
            <div className="in-breadcrumb">
              <div className="row">
                <div className="col">
                  <div className="breadcrumb-style-2 center">
                    <h2>About Us</h2>
                    <ul className="breadcrumb-list-2 black">
                      <li><Link to="/">Home</Link></li>
                      <li>About Us</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> 

        <main className="page-content">
          <div className="about-us-cont-area section-ptb bg-black">
            <div className="container">
              <div className="row align-items-center">
                <div className="col-lg-6">
                  <div className="about-cont text-white-style">
                    <div className="about-us-title">
                      <h2>Why Choose Us</h2>
                      <p>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut laqua. Ut enim ad minim veniam, quis</p>
                    </div>
                    <p>Lorem ipsut amet, consectetur adipisicing elit, sed do irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis</p>
                  </div>
                </div>
                <div className="col-lg-6">
                  <div className="about-images s--mt--30">
                    <img src="../assets/images/about/01.jpg" alt=""/>
                  </div>
                </div>
              </div>
              
              <div className="row about-list-content">
                <div className="col-lg-4">
                  <div className="single-about-area text-white-style">
                    <h4>Our Mission</h4>
                    <p>Lorem ipsut amet, consectetur adipisicing elit, sed do irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.</p>
                    <ul className="about-feature-list">
                      <li><i className="zmdi zmdi-check"></i> Mod tempor incididunt ut laqua.</li>
                      <li><i className="zmdi zmdi-check"></i> Ut enim ad minim quis nostr.</li>
                      <li><i className="zmdi zmdi-check"></i> Nostrud exercitation ullamco.</li>
                    </ul>
                  </div>
                </div>
                
                <div className="col-lg-4">
                  <div className="single-about-area text-white-style">
                    <h4>Our Objective</h4>
                    <p>Lorem ipsut amet, consectetur adipisicing elit, sed do irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.</p>
                    <p>reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.</p>
                  </div>
                </div>
                
                <div className="col-lg-4">
                  <div className="single-about-area text-white-style">
                    <h4>Our Achievement</h4>
                    <p>Lorem ipsut amet, consectetur adipisicing elit, sed do irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.</p>
                    <p>sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis Lorem ipsum dolor sit amet, consectetur adipisicin, sed do eiusmod tempor incididunt ut labore et dolor.</p>
                  </div>
                </div>  
              </div>
            </div>
          </div>

          <div className="video-area section-pt section-pb-b bg-black-2">
            <div className="container">
              <div className="row">
                <div className="col-lg-7 m-auto">
                  <div className="section-title text-center">
                    <h2 className="text-white">See Videos How It Works</h2>
                    <p className="text-white">Adminim veniam, quis nostrud exercitation ullamco laboris nisi ut pariatur. Excepteur t labore et dolore magnam aliquam quaerat.</p>
                  </div>
                </div>
              </div>

              <div className="row">
                <div className="col-lg-12 text-center">
                  <div className="video-inner-wrap">
                    <img src="../assets/images/other/mokup-06.png" alt=""/>
                    <Link to="#Video-three" className="afterglow video-btn red"><i className="zmdi zmdi-play"></i></Link>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div className="counterup_area section-pb section-pt-120 bg-black">
            <div className="container">
              <div className="row">
                <div className="col-lg-3 col-sm-6 single_counter white text-center mt--30">
                  <div className="counter_image">
                    <img src="../assets/images/icon/cout-01.png" alt=""/>
                  </div>
                  <span className="count odometer" data-count-to="240"></span>
                  <h5>Satisfied Customer</h5>
                </div>

                <div className="col-lg-3 col-sm-6 single_counter white text-center mt--30">
                  <div className="counter_image">
                    <img src="../assets/images/icon/cout-02.png" alt=""/>
                  </div>
                  <span className="count odometer" data-count-to="546"></span>
                  <h5>Project Completed</h5>
                </div>

                <div className="col-lg-3 col-sm-6 single_counter white text-center mt--30">
                  <div className="counter_image">
                    <img src="../assets/images/icon/cout-03.png" alt=""/>
                  </div>
                  <span className="count odometer" data-count-to="350"></span>
                  <h5>Cup of Coffee</h5>
                </div>

                <div className="col-lg-3 col-sm-6 single_counter white text-center mt--30">
                  <div className="counter_image">
                    <img src="../assets/images/icon/cout-04.png" alt=""/>
                  </div>
                  <span className="count odometer" data-count-to="156"></span>
                  <h5>Award Winning</h5>
                </div>
              </div>
            </div>
          </div>

          <div className="our-best-team-area section-ptb bg-black-2">
            <div className="container">
              <div className="row">
                <div className="col-lg-8 m-auto">
                  <div className="section-title mb-70 text-center">
                    <h2 className="text-white">Best Team</h2>
                    <p className="text-white">Adminim veniam, quis nostrud exercitation ullamco laboris nisi ut pariatur. Excepteur t labore et dolore magnam aliquam quaerat.</p>
                  </div>
                </div>
              </div>
              
              <div className="row">
                <div className="col-lg-3 col-md-6">
                  <div className="single-team text-center">
                    <div className="team-image">
                      <img src="../assets/images/team/team-01.png" alt=""/>
                      <div className="team-socail red">
                        <ul>
                          <li><Link to="#1"><i className="zmdi zmdi-facebook"></i></Link></li>
                          <li><Link to="#2"><i className="zmdi zmdi-twitter"></i></Link></li>
                          <li><Link to="#3"><i className="zmdi zmdi-linkedin"></i></Link></li>
                          <li><Link to="#4"><i className="zmdi zmdi-instagram"></i></Link></li>
                        </ul>
                      </div>
                    </div>
                    <div className="team-info white">
                      <h4>Marl Joni</h4>
                      <h5>Designer</h5>
                    </div>
                  </div>
                </div>
                
                <div className="col-lg-3 col-md-6">
                  <div className="single-team text-center">
                    <div className="team-image">
                      <img src="../assets/images/team/team-02.png" alt=""/>
                      <div className="team-socail red">
                        <ul>
                          <li><Link to="#1"><i className="zmdi zmdi-facebook"></i></Link></li>
                          <li><Link to="#2"><i className="zmdi zmdi-twitter"></i></Link></li>
                          <li><Link to="#3"><i className="zmdi zmdi-linkedin"></i></Link></li>
                          <li><Link to="4"><i className="zmdi zmdi-instagram"></i></Link></li>
                        </ul>
                      </div>
                    </div>
                    <div className="team-info white">
                      <h4>Shan Morbel</h4>
                      <h5>Designation</h5>
                    </div>
                  </div>
                </div>
                
                <div className="col-lg-3 col-md-6">
                  <div className="single-team text-center">
                    <div className="team-image">
                      <img src="../assets/images/team/team-03.png" alt=""/>
                      <div className="team-socail red">
                        <ul>
                          <li><Link to="#1"><i className="zmdi zmdi-facebook"></i></Link></li>
                          <li><Link to="#2"><i className="zmdi zmdi-twitter"></i></Link></li>
                          <li><Link to="#3"><i className="zmdi zmdi-linkedin"></i></Link></li>
                          <li><Link to="#4"><i className="zmdi zmdi-instagram"></i></Link></li>
                        </ul>
                      </div>
                    </div>
                    <div className="team-info white">
                      <h4>Marland Lorem</h4>
                      <h5>Designation</h5>
                    </div>
                  </div>
                </div>
                
                <div className="col-lg-3 col-md-6">
                  <div className="single-team text-center">
                    <div className="team-image">
                      <img src="../assets/images/team/team-04.png" alt=""/>
                      <div className="team-socail red">
                        <ul>
                          <li><Link to="#1"><i className="zmdi zmdi-facebook"></i></Link></li>
                          <li><Link to="#2"><i className="zmdi zmdi-twitter"></i></Link></li>
                          <li><Link to="#3"><i className="zmdi zmdi-linkedin"></i></Link></li>
                          <li><Link to="#4"><i className="zmdi zmdi-instagram"></i></Link></li>
                        </ul>
                      </div>
                    </div>
                    <div className="team-info white">
                      <h4>Jack Marland</h4>
                      <h5>Designation</h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>

      <script src="../assets/js/vendor/jquery-3.5.1.min.js"></script>
      <script src="../assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
      <script src="../assets/js/popper.min.js"></script>
      <script src="../assets/js/bootstrap.min.js"></script>
      <script src="../assets/js/plugins.js"></script>
      <script src="../assets/js/ajax-mail.js"></script>
      <script src="../assets/js/main.js"></script>
    </div>
  );
}

export default About;
