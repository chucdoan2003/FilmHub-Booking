import { BrowserRouter as Router, Route, Routes } from 'react-router-dom'; // Sửa ở đây
import About from './interface/about-2';

import Header from './header/Header';
import Home2 from './layout/Layout';
import ThongTin from './thongtin/thongtin';

import PrivateRoute from './redux/login/PrivateRoute';

import Login from './register/Login'
import Register from './register/register';
import Footer from './page/Footer';
import DescriptionsItem from 'antd/es/descriptions/Item';
import DemoDetail from './Detail/DemoDetail';
import Checkout from './Checkout/Checkout';
import Bill from './Checkout/Bill';

const App = () => {
  return (
    <Router>


      <Header />
     
      <Routes>

        <Route path="/" element={<Home2 />} />
        <Route path="/about" element={<About />} />
        <Route path="/check" element={<Checkout />} />
        <Route path="/Bill" element={<Bill />} />

        <Route path="/thongtin" element={<PrivateRoute><ThongTin /></PrivateRoute>} />
      

        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />





        {/* Các route khác */}
      </Routes>
      <Footer />
    </Router>
  );
}

export default App;
