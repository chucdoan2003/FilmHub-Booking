import React, { useState } from 'react';
import { useDispatch } from 'react-redux';
import { registerUser } from '../redux/login/api';
import { Link, useNavigate } from 'react-router-dom';
; // Import tệp CSS

const Register = () => {
    const [email, setEmail] = useState("");
    const [name, setName] = useState("");
    const [password, setPassword] = useState("");
    const [password_confirmation, setPasswordConfirmation] = useState("");
    const [errorMessage, setErrorMessage] = useState({});

    const dispatch = useDispatch();
    const navigate = useNavigate();
    const [isLoginVisible, setIsLoginVisible] = useState(true);

    const handleClose = () => {
        setIsLoginVisible(false);
        window.location.reload();
        navigate("/");
    };

    const handleRegister = (e) => {
        e.preventDefault();
        const errors = {};

        if (name.length < 3) {
            errors.name = "Tên phải có ít nhất 3 ký tự.";
        }

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            errors.email = "Vui lòng nhập địa chỉ email hợp lệ.";
        }

        if (password.length < 6) {
            errors.password = "Mật khẩu phải có ít nhất 6 ký tự.";
        }

        if (password !== password_confirmation) {
            errors.password_confirmation = "Mật khẩu xác nhận phải giống với mật khẩu.";
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
            password_confirmation
        };

        registerUser(newUser, dispatch, navigate);
    };

    return (
        <div className="login-wrapper">
            {isLoginVisible && (
                <div className="login-content">
                    <Link to="/" className="close" onClick={handleClose}>x</Link>
                    <h3>Sign Up</h3>
                    <form onSubmit={handleRegister}>
                        <div className="row">
                            <label htmlFor="username-2">
                                Username:
                                <input
                                    type="text"
                                    name="username"
                                    id="username-2"
                                    placeholder="Hugh Jackman"
                                    value={name}
                                    onChange={(e) => setName(e.target.value)}
                                    required
                                />
                            </label>
                            {errorMessage.name && <p className="error-message">{errorMessage.name}</p>}
                        </div>

                        <div className="row">
                            <label htmlFor="email-2">
                                Your email:
                                <input
                                    type="email"
                                    name="email"
                                    id="email-2"
                                    placeholder="example@example.com"
                                    value={email}
                                    onChange={(e) => setEmail(e.target.value)}
                                    required
                                />
                            </label>
                            {errorMessage.email && <p className="error-message">{errorMessage.email}</p>}
                        </div>

                        <div className="row">
                            <label htmlFor="password-2">
                                Password:
                                <input
                                    type="password"
                                    name="password"
                                    id="password-2"
                                    placeholder="******"
                                    value={password}
                                    onChange={(e) => setPassword(e.target.value)}
                                    required
                                />
                            </label>
                            {errorMessage.password && <p className="error-message">{errorMessage.password}</p>}
                        </div>

                        <div className="row">
                            <label htmlFor="repassword-2">
                                Re-type Password:
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    id="repassword-2"
                                    placeholder="******"
                                    value={password_confirmation}
                                    onChange={(e) => setPasswordConfirmation(e.target.value)}
                                    required
                                />
                            </label>
                            {errorMessage.password_confirmation && <p className="error-message">{errorMessage.password_confirmation}</p>}
                        </div>

                        <div className="row">
                            <button type="submit">Sign Up</button>
                        </div>
                    </form>
                </div>
            )}
        </div>
    );
};

export default Register;
