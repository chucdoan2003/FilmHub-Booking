import { BrowserRouter as Router, Route, Routes } from "react-router-dom"; // Thay Router bằng BrowserRouter
import "./App.css";
import Layout from "./layout"; // Đảm bảo đường dẫn đến Layout là chính xác

function App() {
    return (
        <>
            <Router>
                <Routes> {/* Thay Route bên trong Router bằng Routes */}
                    <Route path="/" element={<Layout />}>
                        <Route index element={<h1>Home</h1>} />
                    </Route>
                </Routes>
            </Router>
        </>
    );
}

export default App;
