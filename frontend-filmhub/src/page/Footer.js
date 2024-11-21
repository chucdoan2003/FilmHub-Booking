import React from 'react';
import { Link } from 'react-router-dom'; // Import Link from react-router-dom

const Footer = () => {
  return (
    <div>
      <footer className="footer-area bg-black-2 section-padding-lr">
        <div className="footer-hm4-ptb">
          <div className="container-fluid">
            <div className="row">
              <div className="col-lg-3">
                <div className="footer-widget footer-about">
                  <div className="footer-logo">
                    <Link to="/"><img src="assets/images/logo/logo.png" alt="" /></Link>
                  </div>
                  <p>Eiusmod tempor incididunt ut la abore et minim ven exerc itation ulla mco lboris naliquip comm.</p>
                  <div className="social-style-1">
                    <Link className="facebook" to="#1"><i className="zmdi zmdi-facebook"></i></Link>
                    <Link className="twitter" to="#"><i className="zmdi zmdi-twitter"></i></Link>
                    <Link className="linkedin" to="#"><i className="zmdi zmdi-linkedin"></i></Link>
                    <Link className="instagram" to="#"><i className="zmdi zmdi-instagram"></i></Link>
                  </div>
                </div>
              </div>
              <div className="col-lg-9">
                <div className="footer-top-right">
                  <div className="footer-quicklink">
                    <ul>
                      <li><Link to="/">Home</Link></li>
                      <li><Link to="/about">About US</Link></li>
                      <li><Link to="/series">Series</Link></li>
                      <li><Link to="/contact-2">Contact Us</Link></li>
                      <li><Link to="/">Tv Series</Link></li>
                      <li><Link to="/">Tech</Link></li>
                      <li><Link to="/movie">Movie</Link></li>
                      <li><Link to="/">Video</Link></li>
                      <li><Link to="/">Live</Link></li>
                      <li><Link to="/">Tv Series</Link></li>
                    </ul>
                  </div>
                  <div className="brand-logo-active brand-logo-wrap">
                    <div className="row">
                      <div className="col-6 col-md-4 col-lg-2 brand-logo-plr">
                        <div className="brand-logo">
                          <Link to="#"><img src="../assets/images/brand/1.png" alt="Brand 1" className="img-fluid" /></Link>
                        </div>
                      </div>
                      <div className="col-6 col-md-4 col-lg-2 brand-logo-plr">
                        <div className="brand-logo">
                          <Link to="#"><img src="../assets/images/brand/2.png" alt="Brand 2" className="img-fluid" /></Link>
                        </div>
                      </div>
                      <div className="col-6 col-md-4 col-lg-2 brand-logo-plr">
                        <div className="brand-logo">
                          <Link to="#"><img src="../assets/images/brand/3.png" alt="Brand 3" className="img-fluid" /></Link>
                        </div>
                      </div>
                      <div className="col-6 col-md-4 col-lg-2 brand-logo-plr">
                        <div className="brand-logo">
                          <Link to="#"><img src="../assets/images/brand/4.png" alt="Brand 4" className="img-fluid" /></Link>
                        </div>
                      </div>
                      <div className="col-6 col-md-4 col-lg-2 brand-logo-plr">
                        <div className="brand-logo">
                          <Link to="#"><img src="../assets/images/brand/5.png" alt="Brand 5" className="img-fluid" /></Link>
                        </div>
                      </div>
                      <div className="col-6 col-md-4 col-lg-2 brand-logo-plr">
                        <div className="brand-logo">
                          <Link to="#"><img src="../assets/images/brand/6.png" alt="Brand 6" className="img-fluid" /></Link>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div className="footer-quicklink-2">
                    <ul>
                      <li><Link to="/contact-2">Report a Bug</Link></li>
                      <li><Link to="/contact-2">Request a Feature</Link></li>
                      <li><Link to="/about.js">Content Grievance</Link></li>
                      <li><Link to="/contact-2">Movie Request</Link></li>
                      <li><Link to="/contact-2">Submit Your Story</Link></li>
                      <li><Link to="/contact-2">Privacy Policy</Link></li>
                      <li><Link to="/contact-2">Terms of Services</Link></li>
                      <li><Link to="/contact-2">Support</Link></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div className="footer-bottom footer-bottom-ptb footer-black-hm4">
          <div className="container-fluid">
            <div className="row align-items-center">
              <div className="col-lg-6">
                <div className="copyright">
                  <p className="copyright-text">
                    Copyright ©2022 All rights reserved | Made with <i className="zmdi zmdi-favorite"></i> by <a href="https://themeforest.net/user/codecarnival/portfolio"> HasThemes</a>.
                  </p>
                </div>
              </div>
              <div className="col-lg-6">
                <div className="login-alert">
                  <p>Already have an Account? <Link to="/login-and-register-2">LOGIN</Link></p>
                  <div className="member-btn">
                    <Link className="member-btn-style" to="/pricing-plan-2">Become a Member</Link>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </footer>

      <div className="modal fade" id="exampleModal">
        <div className="modal-dialog modal-dialog-centered">
          <div className="modal-content">
            <div className="modal-header">
              <button type="button" className="subscribe-btn-close" data-bs-dismiss="modal" aria-label="Close"><i className="zmdi zmdi-close s-close"></i></button>
            </div>
            <div className="modal-body">
              <h5 id="exampleModalLabel">Ready to watch? Enter your email to create or restart your membership.</h5>
              <div className="create-membership-wrap modify">
                <input placeholder="Email Address" />
                <button className="landing-btn-style" type="button">Get Started</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Footer;
