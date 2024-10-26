import { BrowserRouter as Router, Route, Routes } from 'react-router-dom'; // Sửa ở đây
import About from './interface/about-2';
import Footer from './footer/Footer';
import Header from './header/Header';
import Home2 from './layout/Layout';

const App = () => {
  return (
    <Router>
        <Header/>
      <Routes>
      <Route path="/" element={<Home2 />} />
        <Route path="/about" element={<About />} />
        {/* Các route khác */}
      </Routes>
      <Footer />
    </Router>
  );
}

export default App;
