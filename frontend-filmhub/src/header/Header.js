import React, { useState } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { Link, useNavigate } from 'react-router-dom';  // Dùng useNavigate để điều hướng
import "./header.css";
import { logout } from '../redux/login/autSlie';
import Login from '../register/Login';
import Register from '../register/register';

const Header = () => {
    const user = useSelector((state) => state.auth.login?.currentUser?.user);
    const dispatch = useDispatch();
    const navigate = useNavigate();
    const [showLogin, setShowLogin] = useState(false); // State để quản lý hiển thị form login

    const toggleLogin = () => {
        setShowLogin(!showLogin); // Đảo ngược trạng thái hiển thị form login
    };
    const [showregister, setShowRegister] = useState(false); // State để quản lý hiển thị form login

    const toggleregister = () => {
        setShowRegister(!showregister); // Đảo ngược trạng thái hiển thị form login
    };
    const handleLogout = () => {
        dispatch(logout());  // Gọi action logout để xóa thông tin người dùng khỏi Redux và localStorage
        navigate('/');  // Điều hướng người dùng về trang đăng nhập
    };

    return (
        <div className="main-wrapper">
            <header className="header-area bg-black section-padding-lr">
                <div className="container-fluid">
                    <div className="header-wrap header-netflix-style">
                        <div className="logo-menu-wrap">
                            <div className="logo">
                                <Link to="/"><img src="assets/images/logo/logo.png" alt="" /></Link>
                            </div>

                            <div className="main-menu main-theme-color-four">
                                <nav className="main-navigation">
                                    <ul>
                                        <li className="active"><Link to="/">Home</Link></li>
                                        <li><Link to="/series">Series</Link>
                                            <ul className="sub-menu">
                                                <li><Link to="/horror-series">Horror Series</Link></li>
                                                <li><Link to="/romantic-series">Romantic Series</Link></li>
                                            </ul>
                                        </li>
                                        <li><Link to="/movies">Movies</Link>
                                            <ul className="sub-menu">
                                                <li><Link to="/horror-movie">Horror Movies</Link></li>
                                                <li><Link to="/romantic-movie">Romantic Movies</Link></li>
                                            </ul>
                                        </li>
                                        <li><Link to="#">Pages</Link>
                                            <ul className="sub-menu">
                                                <li><Link to="/about">About Us</Link></li>
                                                <li><Link to="/pricing">Pricing</Link></li>
                                                <li><Link to="/watchlist">Watchlist</Link></li>
                                                <li><Link to="/history">History</Link></li>
                                                <li><Link to="/movie-details">Movie Details</Link></li>
                                                <li><Link to="/series-details">Series Details</Link></li>
                                                <li><Link to="/faq">FAQ</Link></li>
                                                <li><Link to="/my-account">My Account</Link></li>
                                                <li><Link to="/landing-page">Landing Page</Link></li>
                                            </ul>
                                        </li>
                                        <li><Link to="/pricing">Pricing</Link></li>
                                        <li><Link to={"/thongtin"}>Thành Viên</Link></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                        <div className="right-side d-flex">
                            <div className="header-search-2">
                                <Link className="search-toggle" to="#">
                                    <i className="zmdi zmdi-search s-open"></i>
                                    <i className="zmdi zmdi-close s-close"></i>
                                </Link>
                                <div className="search-wrap-2">
                                    <form action="#">
                                        <input placeholder="Search" type="text" />
                                        <button className="button-search"><i className="zmdi zmdi-search"></i></button>
                                    </form>
                                </div>
                            </div>

                            <div className="notifications-bar btn-group">
                                <Link href="#" className="notifications-iocn white" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i className="zmdi zmdi-notifications"></i> <span>5</span>
                                </Link>
                                <div className="dropdown-menu netflix-notifications-style red">
                                    <h5>Notifications</h5>
                                    <ul>
                                        <li className="single-notifications">
                                            <Link to="/#">
                                                <span className="image"><img src="assets/images/review/author-01.png" alt="" /></span>
                                                <span className="notific-contents">
                                                    <span>Lorem ipsum dolor sit amet consectetur.</span>
                                                    <span className="time">21 hours ago</span>
                                                </span>
                                            </Link>
                                        </li>
                                        <li className="single-notifications">
                                            <Link to="">
                                                <span className="image"><img src="assets/images/review/author-01.png" alt="" /></span>
                                                <span className="notific-contents">
                                                    <span>Lorem ipsum dolor sit amet consectetur.</span>
                                                    <span className="time">21 hours ago</span>
                                                </span>
                                            </Link>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div className="our-profile-area">
                                {user ? (
                                    <div className="navbar">
                                        <span>Hi, {user.name}</span>
                                        <div className="dropdown">
                                            <button className="dropbtn">▼</button>
                                            <div className="dropdown-content">
                                                <Link to="#">Thông tin tài khoản</Link>
                                                <Link to="#">Thẻ thành viên</Link>
                                                <Link to="#">Hành trình điện ảnh</Link>
                                                <Link to="#">Điểm Beta</Link>
                                                <Link to="#">Voucher của tôi</Link>
                                                <Link to="#" onClick={handleLogout}>Đăng xuất</Link> {/* Thêm onClick để gọi handleLogout */}
                                                {user.user_id === 1 && <Link to="http://127.0.0.1:8000/admin">Admin</Link>}
                                            </div>
                                        </div>
                                    </div>
                                ) : (
                                    <>
                                    <button onClick={toggleLogin}>Login</button>
                                    <button onClick={toggleregister}>Register</button>
                                    </>
                                )}
                            </div>
                            {showLogin && (
                <div className="login-wrapper"> {/* Sử dụng CSS từ dangki.css */}
                    <Login />
                </div>
            )}
             {showregister && (
                <div className="login-wrapper"> {/* Sử dụng CSS từ dangki.css */}
                    <Register />
                </div>
            )}

                            <div className="subscribe-btn-wrap">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" className="subscribe-btn">Subscribe Now</button>
                            </div>

                            <div className="mobile-menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </header>
        </div>
    )
}

export default Header;
