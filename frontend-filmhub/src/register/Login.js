import { useState } from 'react';
import { useDispatch } from 'react-redux';
import { useNavigate, Link } from 'react-router-dom'; // Added Link import
import { loginUser } from '../redux/login/api';
import './dangki.css';

const Login = () => {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [error, setError] = useState(null); // State for storing error messages
    const [isLoading, setIsLoading] = useState(false); // State for loading indicator
    const [rememberMe, setRememberMe] = useState(false); // For Remember me checkbox

    const dispatch = useDispatch();
    const navigate = useNavigate(); // Initialize navigate for redirecting
    const [isLoginVisible, setIsLoginVisible] = useState(true); // State to manage the visibility of the login form

    const handleClose = () => {
        setIsLoginVisible(false);
        navigate("/")
        window.location.reload() // Hide the login form when "X" is clicked
   // Use navigate to redirect to homepage (replace with your actual homepage route)
    };

    const handleLogin = async (e) => {
        e.preventDefault();

        // Simple validation
        if (!email || !password) {
            setError("Vui lòng nhập email và mật khẩu!");
            return;
        }

        setError(null); // Clear any previous errors
        setIsLoading(true); // Set loading state to true

        const newUser = {
            email,
            password,
            rememberMe // Add rememberMe state to the request
        };

        try {
            await loginUser(newUser, dispatch, navigate);
        } catch (error) {
            setError("Đăng nhập không thành công. Vui lòng kiểm tra lại email và mật khẩu.");
        } finally {
            setIsLoading(false); // Reset loading state after request
        }
    };

    return (
        <div className="login-wrapper">
            {isLoginVisible && (
                <div className="login-content">
                    <Link to="/" className="close" onClick={handleClose}>x</Link>
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
                                    <input
                                        type="checkbox"
                                        name="remember"
                                        id="remember"
                                        checked={rememberMe}
                                        onChange={() => setRememberMe(!rememberMe)} // Toggle rememberMe state
                                    />
                                    <span>Remember me</span>
                                </div>
                                <Link to="#">Forgot password?</Link>
                            </div>
                        </div>
                        {error && <div className="error-message">{error}</div>} {/* Show error message */}
                        <div className="row">
                            <button type="submit" disabled={isLoading}>
                                {isLoading ? "Đang Đăng Nhập..." : "Login"}
                            </button>
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
            )}
        </div>
    );
};

export default Login;
