import { Tabs } from 'antd';
import React, { useState } from 'react';
import { Link } from 'react-router-dom'; // Import Link
import './dangki.css';
import { loginUser, registerUser } from '../redux/login/api';
import { useDispatch } from 'react-redux';
import { useNavigate } from 'react-router-dom';

const Login = () => {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const dispatch = useDispatch();
    const navigate = useNavigate();

    const handleLogin = (e) => {
        e.preventDefault();
        const newUser = {
            email: email,
            password: password
        };
        loginUser(newUser, dispatch, navigate);
    };

    return (
        <div className="login-wrapper" id="login-content">
            <div className="login-content">
                <Link to="/" className="close">
                    x
                </Link>
                <h3>Login</h3>
                <form onSubmit={handleLogin}>
                    <div className="row">
                        <label htmlFor="email">
                            Email:
                            <input
                                type="email"
                                name="email"
                                id="email"
                                placeholder="email@example.com"
                                value={email}
                                onChange={(e) => setEmail(e.target.value)}
                                required
                            />
                        </label>
                    </div>
                    <div className="row">
                        <label htmlFor="password">
                            Password:
                            <input
                                type="password"
                                name="password"
                                id="password"
                                placeholder="******"
                                value={password}
                                onChange={(e) => setPassword(e.target.value)}
                                required
                            />
                        </label>
                    </div>
                    <div className="row">
                        <div className="remember">
                            <div>
                                <input type="checkbox" name="remember" id="remember" />
                                <span>Remember me</span>
                            </div>
                            <Link to="#">Forgot password?</Link>
                        </div>
                    </div>
                    <div className="row">
                        <button type="submit">Login</button>
                    </div>
                </form>
                <div className="row">
                    <p>Or via social</p>
                    <div className="social-btn-2">
                        <a className="fb" href="https://www.facebook.com" target="_blank" rel="noopener noreferrer">
                            <i className="ion-social-facebook"></i>Facebook
                        </a>
                        <a className="tw" href="https://www.twitter.com" target="_blank" rel="noopener noreferrer">
                            <i className="ion-social-twitter"></i>Twitter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    );
};

const Register = () => {
    const [email, setEmail] = useState('');
    const [name, setName] = useState('');
    const [password, setPassword] = useState('');
    const [passwordConfirmation, setPasswordConfirmation] = useState('');
    const [errorMessage, setErrorMessage] = useState({});
    const dispatch = useDispatch();
    const navigate = useNavigate();

    const handleRegister = (e) => {
        e.preventDefault();

        const errors = {};

        if (name.length < 3) {
            errors.name = 'Tên phải có ít nhất 3 ký tự.';
        }

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            errors.email = 'Vui lòng nhập địa chỉ email hợp lệ.';
        }

        if (password.length < 6) {
            errors.password = 'Mật khẩu phải có ít nhất 6 ký tự.';
        }

        if (password !== passwordConfirmation) {
            errors.password_confirmation = 'Mật khẩu xác nhận phải giống với mật khẩu.';
        }

        if (Object.keys(errors).length > 0) {
            setErrorMessage(errors);
            return;
        }

        setErrorMessage({});

        const newUser = {
            email,
            name,
            password,
            password_confirmation: passwordConfirmation
        };

        registerUser(newUser, dispatch, navigate);
    };

    return (
        <div className="main-wrapper">
            <form onSubmit={handleRegister}>
                <div className="form-1">
                    <label htmlFor="login-name">Name</label>
                    <input
                        type="text"
                        id="login-name"
                        placeholder="Your Name"
                        value={name}
                        onChange={(e) => setName(e.target.value)}
                    />
                    {errorMessage.name && <span style={{ color: 'red' }}>{errorMessage.name}</span>}

                    <label htmlFor="login-email">Email</label>
                    <input
                        type="email"
                        id="login-email"
                        placeholder="email@example.com"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                    />
                    {errorMessage.email && <span style={{ color: 'red' }}>{errorMessage.email}</span>}

                    <label htmlFor="login-password">Password</label>
                    <input
                        type="password"
                        id="login-password"
                        placeholder="******"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                    />
                    {errorMessage.password && <span style={{ color: 'red' }}>{errorMessage.password}</span>}

                    <label htmlFor="login-password-confirmation">Confirm Password</label>
                    <input
                        type="password"
                        id="login-password-confirmation"
                        placeholder="******"
                        value={passwordConfirmation}
                        onChange={(e) => setPasswordConfirmation(e.target.value)}
                    />
                    {errorMessage.password_confirmation && (
                        <span style={{ color: 'red' }}>{errorMessage.password_confirmation}</span>
                    )}

                    <input type="submit" value="REGISTER" className="button-primary" />
                    <div className="social-login">
                        <button type="button">Continue with Facebook</button>
                    </div>
                </div>
            </form>
        </div>
    );
};

const onChange = (key) => {
    console.log(key);
};

const items = [
    { key: '1', label: 'Login', children: <Login /> },
    { key: '2', label: 'Register', children: <Register /> }
];

const Nav = () => {
    return (
        <div className="tab-container">
            <Tabs defaultActiveKey="1" items={items} onChange={onChange} />
        </div>
    );
};

export default Nav;
