// PrivateRoute.js

import { useSelector } from 'react-redux';

import Login from '../../register/Login';
import ThongTin from '../../thongtin/thongtin';
import Home2 from '../../layout/Layout';

const PrivateRoute = () => {
    const user = useSelector((state) => state.auth.login?.currentUser?.user);

    // Nếu người dùng đã đăng nhập, hiển thị trang Home
    if (user) {
        return <ThongTin />;
    }

    // Nếu chưa đăng nhập, hiển thị cả trang Login và Home
    return (
        <div style={{ display: 'flex' }}>
            <div style={{ flex: 1 }}>
                <Login />
            </div>
            <div style={{ flex: 1 }}>
                <Home2 />
            </div>
        </div>
    );
};

export default PrivateRoute;
