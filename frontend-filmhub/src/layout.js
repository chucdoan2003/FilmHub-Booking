import React from 'react';

const Layout = () => {
    return (
        <div id="wrapper">
            <div className="navbar-custom">
                <ul className="list-unstyled topnav-menu float-right mb-0">

                    <li className="dropdown notification-list">
                        <a className="nav-link dropdown-toggle waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i className="mdi mdi-bell noti-icon"></i>
                            <span className="badge badge-success rounded-circle noti-icon-badge">4</span>
                        </a>
                        <div className="dropdown-menu dropdown-menu-right dropdown-lg">
                            <div className="dropdown-item noti-title">
                                <h5 className="font-16 m-0">
                                    <span className="float-right">
                                        <a href="" className="text-dark">
                                            <small>Clear All</small>
                                        </a>
                                    </span>Notification
                                </h5>
                            </div>

                            <div className="slimscroll noti-scroll">
                                <a href="javascript:void(0);" className="dropdown-item notify-item">
                                    <div className="notify-icon bg-success">
                                        <i className="mdi mdi-settings-outline"></i>
                                    </div>
                                    <p className="notify-details">New settings
                                        <small className="text-muted">There are new settings available</small>
                                    </p>
                                </a>
                                <a href="javascript:void(0);" className="dropdown-item notify-item">
                                    <div className="notify-icon bg-info">
                                        <i className="mdi mdi-bell-outline"></i>
                                    </div>
                                    <p className="notify-details">Updates
                                        <small className="text-muted">There are 2 new updates available</small>
                                    </p>
                                </a>
                                <a href="javascript:void(0);" className="dropdown-item notify-item">
                                    <div className="notify-icon bg-danger">
                                        <i className="mdi mdi-account-plus"></i>
                                    </div>
                                    <p className="notify-details">New user
                                        <small className="text-muted">You have 10 unread messages</small>
                                    </p>
                                </a>
                                <a href="javascript:void(0);" className="dropdown-item notify-item">
                                    <div className="notify-icon bg-info">
                                        <i className="mdi mdi-comment-account-outline"></i>
                                    </div>
                                    <p className="notify-details">Caleb Flakelar commented on Admin
                                        <small className="text-muted">4 days ago</small>
                                    </p>
                                </a>
                                <a href="javascript:void(0);" className="dropdown-item notify-item">
                                    <div className="notify-icon bg-secondary">
                                        <i className="mdi mdi-heart"></i>
                                    </div>
                                    <p className="notify-details">Carlos Crouch liked
                                        <b>Admin</b>
                                        <small className="text-muted">13 days ago</small>
                                    </p>
                                </a>
                            </div>

                            <a href="javascript:void(0);" className="dropdown-item text-center text-primary notify-item notify-all">
                                See all Notifications
                                <i className="fi-arrow-right"></i>
                            </a>
                        </div>
                    </li>

                    <li className="dropdown notification-list">
                        <a className="nav-link dropdown-toggle waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i className="mdi mdi-email noti-icon"></i>
                            <span className="badge badge-danger rounded-circle noti-icon-badge">8</span>
                        </a>
                        <div className="dropdown-menu dropdown-menu-right dropdown-lg">
                            <div className="dropdown-item noti-title">
                                <h5 className="font-16 m-0">
                                    <span className="float-right">
                                        <a href="" className="text-dark">
                                            <small>Clear All</small>
                                        </a>
                                    </span>Messages
                                </h5>
                            </div>
                            <div className="slimscroll noti-scroll">
                                <div className="inbox-widget">
                                    <a href="#">
                                        <div className="inbox-item">
                                            <div className="inbox-item-img"><img src="assets/images/users/avatar-1.jpg" className="rounded-circle" alt="" /></div>
                                            <p className="inbox-item-author">Chadengle</p>
                                            <p className="inbox-item-text text-truncate">Hey! there I'm available...</p>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div className="inbox-item">
                                            <div className="inbox-item-img"><img src="assets/images/users/avatar-2.jpg" className="rounded-circle" alt="" /></div>
                                            <p className="inbox-item-author">Tomaslau</p>
                                            <p className="inbox-item-text text-truncate">I've finished it! See you so...</p>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div className="inbox-item">
                                            <div className="inbox-item-img"><img src="assets/images/users/avatar-3.jpg" className="rounded-circle" alt="" /></div>
                                            <p className="inbox-item-author">Stillnotdavid</p>
                                            <p className="inbox-item-text text-truncate">This theme is awesome!</p>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div className="inbox-item">
                                            <div className="inbox-item-img"><img src="assets/images/users/avatar-4.jpg" className="rounded-circle" alt="" /></div>
                                            <p className="inbox-item-author">Kurafire</p>
                                            <p className="inbox-item-text text-truncate">Nice to meet you</p>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div className="inbox-item">
                                            <div className="inbox-item-img"><img src="assets/images/users/avatar-5.jpg" className="rounded-circle" alt="" /></div>
                                            <p className="inbox-item-author">Shahedk</p>
                                            <p className="inbox-item-text text-truncate">Hey! there I'm available...</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <a href="javascript:void(0);" className="dropdown-item text-center text-primary notify-item notify-all">
                                See all Messages
                                <i className="fi-arrow-right"></i>
                            </a>
                        </div>
                    </li>

                    <li className="dropdown notification-list">
                        <a className="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="assets/images/users/avatar-1.jpg" alt="user-image" className="rounded-circle" />
                            <span className="d-none d-sm-inline-block ml-1">Alex M.</span>
                        </a>
                        <div className="dropdown-menu dropdown-menu-right profile-dropdown">
                            <div className="dropdown-header noti-title">
                                <h6 className="text-overflow m-0">Welcome!</h6>
                            </div>
                            <a href="javascript:void(0);" className="dropdown-item notify-item">
                                <i className="mdi mdi-account-outline"></i>
                                <span>Profile</span>
                            </a>
                            <a href="javascript:void(0);" className="dropdown-item notify-item">
                                <i className="mdi mdi-settings-outline"></i>
                                <span>Settings</span>
                            </a>
                            <a href="javascript:void(0);" className="dropdown-item notify-item">
                                <i className="mdi mdi-lock-outline"></i>
                                <span>Lock Screen</span>
                            </a>
                            <div className="dropdown-divider"></div>
                            <a href="javascript:void(0);" className="dropdown-item notify-item">
                                <i className="mdi mdi-logout-variant"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>

                    <li className="dropdown notification-list">
                        <a href="javascript:void(0);" className="nav-link right-bar-toggle waves-effect">
                            <i className="mdi mdi-settings noti-icon"></i>
                        </a>
                    </li>

                </ul>

                <div className="logo-box">
                    <a href="index.html" className="logo text-center">
                        <span className="logo-lg">
                            <img src="assets/images/logo-light.png" alt="" height="18" />
                        </span>
                        <span className="logo-sm">
                            <img src="assets/images/logo-sm.png" alt="" height="24" />
                        </span>
                    </a>
                </div>

                <ul className="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button className="button-menu-mobile waves-effect">
                            <i className="mdi mdi-menu"></i>
                        </button>
                    </li>

                    <li className="d-none d-sm-block">
                        <form className="app-search">
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

                    <li className="d-none d-lg-block">
                        <a href="#" className="nav-link">New</a>
                    </li>

                    <li className="dropdown d-none d-lg-block">
                        <a className="nav-link dropdown-toggle mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="assets/images/flags/us.jpg" alt="user-image" className="mr-1" height="12" /> <span className="align-middle">English <i className="mdi mdi-chevron-down"></i> </span>
                        </a>
                        <div className="dropdown-menu">
                            <a href="javascript:void(0);" className="dropdown-item notify-item">
                                <img src="assets/images/flags/germany.jpg" alt="user-image" className="mr-1" height="12" /> <span className="align-middle">German</span>
                            </a>
                            <a href="javascript:void(0);" className="dropdown-item notify-item">
                                <img src="assets/images/flags/italy.jpg" alt="user-image" className="mr-1" height="12" /> <span className="align-middle">Italian</span>
                            </a>
                            <a href="javascript:void(0);" className="dropdown-item notify-item">
                                <img src="assets/images/flags/spain.jpg" alt="user-image" className="mr-1" height="12" /> <span className="align-middle">Spanish</span>
                            </a>
                            <a href="javascript:void(0);" className="dropdown-item notify-item">
                                <img src="assets/images/flags/russia.jpg" alt="user-image" className="mr-1" height="12" /> <span className="align-middle">Russian</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>

            <div className="left-side-menu">
                <div className="slimscroll-menu">
                    <div id="sidebar-menu">
                        <ul className="metismenu" id="side-menu">
                            <li className="menu-title">Navigation</li>
                            <li>
                                <a href="javascript: void(0);" className="waves-effect waves-light">
                                    <i className="mdi mdi-view-dashboard"></i>
                                    <span className="badge badge-success badge-pill float-right">2</span>
                                    <span> Dashboard </span>
                                </a>
                                <ul className="nav-second-level" aria-expanded="false">
                                    <li><a href="dashboard_2.html">Dashboard 2</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="calendar.html" className="waves-effect waves-light">
                                    <i className="mdi mdi-calendar"></i>
                                    <span> Calendar </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <script src="assets/js/vendor.min.js"></script>
            <script src="assets/libs/morris-js/morris.min.js"></script>
            <script src="assets/libs/raphael/raphael.min.js"></script>
            <script src="assets/js/pages/dashboard.init.js"></script>
            <script src="assets/js/app.min.js"></script>
        </div>
    );
}

export default Layout;
