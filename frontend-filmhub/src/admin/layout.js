import React from 'react';
import { Link } from 'react-router-dom';

const Layout = () => {
    return (
        <div id="wrapper">
            <div className="navbar-custom">
                <ul className="list-unstyled topnav-menu float-right mb-0">
                    <li className="dropdown notification-list">
                        <Link className="nav-link dropdown-toggle waves-effect" data-toggle="dropdown" to="#" role="button" aria-haspopup="false" aria-expanded="false" aria-label="Notifications">
                            <i className="mdi mdi-bell noti-icon"></i>
                            <span className="badge badge-success rounded-circle noti-icon-badge">4</span>
                        </Link>
                        <div className="dropdown-menu dropdown-menu-right dropdown-lg">
                            <div className="dropdown-item noti-title">
                                <h5 className="font-16 m-0">
                                    <span className="float-right">
                                        <Link to="#" className="text-dark">
                                            <small>Clear All</small>
                                        </Link>
                                    </span>Notification
                                </h5>
                            </div>
                            <div className="slimscroll noti-scroll">
                               
                            </div>
                            <Link to="#" className="dropdown-item text-center text-primary notify-item notify-all">
                                See all Notifications
                                <i className="fi-arrow-right"></i>
                            </Link>
                        </div>
                    </li>
                    {/* Other dropdowns and menu items */}
                </ul>

                <div className="logo-box">
                    <Link to="/" className="logo text-center">
                        <span className="logo-lg">
                            <img src="assets/images/logo-light.png" alt="Logo" height="18" />
                        </span>
                        <span className="logo-sm">
                            <img src="assets/images/logo-sm.png" alt="Logo" height="24" />
                        </span>
                    </Link>
                </div>

                <ul className="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button className="button-menu-mobile waves-effect" aria-label="Toggle menu">
                            <i className="mdi mdi-menu"></i>
                        </button>
                    </li>
                    <li className="d-none d-sm-block">
                        <form className="app-search" onSubmit={(e) => e.preventDefault()}>
                            <div className="app-search-box">
                                <div className="input-group">
                                    <input type="text" className="form-control" placeholder="Search..." />
                                    <div className="input-group-append">
                                        <button className="btn" type="submit">
                                            <i className="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </li>
                    {/* Language dropdown and other items */}
                </ul>
            </div>

            <div className="left-side-menu">
                <div className="slimscroll-menu">
                    <div id="sidebar-menu">
                        <ul className="metismenu" id="side-menu">
                            <li className="menu-title">Navigation</li>
                            <li>
                                <Link to="#" className="waves-effect waves-light">
                                    <i className="mdi mdi-view-dashboard"></i>
                                    <span className="badge badge-success badge-pill float-right">2</span>
                                    <span> Dashboard </span>
                                </Link>
                                <ul className="nav-second-level" aria-expanded="false">
                                    <li><Link to="">Dashboard 2</Link></li>
                                </ul>
                            </li>
                            <li>
                                <Link to="/calendar" className="waves-effect waves-light">
                                    <i className="mdi mdi-calendar"></i>
                                    <span> Calendar </span>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {/* Script imports should be handled appropriately */}
        </div>
    );
}

export default Layout;
