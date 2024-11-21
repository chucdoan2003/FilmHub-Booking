import { Tabs } from 'antd';
import React, { useState } from 'react';
import "./thongtin.css"



function ThongTinNguoiDung() {
    const [selectedImage, setSelectedImage] = useState(null);
  
    const handleImageChange = (e) => {
      if (e.target.files && e.target.files[0]) {
        const file = e.target.files[0];
        setSelectedImage(URL.createObjectURL(file));
      }
    };
  
    return (
<div class="main-container">
    <div class="image-column">
        <div class="image-preview">
          
            <p>Chưa có ảnh. Tải ảnh lên.</p>
        </div>
        <input type="file" accept="image/*" />
    </div>

    <div class="form-container">
        <form>
           
            <div class="form-group">
                <div class="form-item">
                    <label for="name">* Họ tên</label>
                    <input type="text" id="name" defaultValue="Sỹ Phạm" required />
                </div>
                <div class="form-item">
                    <label for="email">* Email</label>
                    <input type="email" id="email" defaultValue="sypham9876543210@gmail.com" disabled />
                </div>
            </div>

     
            <div class="form-group">
                <div class="form-item">
                    <label for="phone">* Số điện thoại</label>
                    <input type="tel" id="phone" placeholder="Số điện thoại" required />
                </div>
                <div class="form-item">
                    <label for="dob">* Ngày sinh</label>
                    <input type="date" id="dob" required />
                </div>
            </div>

            <div class="form-group">
                <div class="form-item">
                    <label for="id">* CMND/Hộ chiếu</label>
                    <input type="text" id="id" placeholder="CMND/Hộ chiếu" required />
                </div>
                <div class="form-item">
                    <label for="gender">Giới tính</label>
                    <select id="gender">
                        <option>Giới tính</option>
                        <option>Nam</option>
                        <option>Nữ</option>
                    </select>
                </div>
            </div>

           
            <div class="form-group">
                <div class="form-item">
                    <label for="city">Tỉnh/Thành phố</label>
                    <select id="city">
                        <option>Tỉnh/Thành phố</option>
                    </select>
                </div>
                <div class="form-item">
                    <label for="district">Quận/Huyện</label>
                    <select id="district">
                        <option>Quận/Huyện</option>
                        <option>Hà Nội</option>
                        <option>HCM</option>
                    </select>
                </div>
            </div>

          
            <div class="form-item full-width">
                <label for="address">Địa chỉ</label>
                <input type="text" id="address" placeholder="Địa chỉ" />
            </div>

            <input type="submit" value="ĐĂNG NHẬP BẰNG TÀI KHOẢN" class="button-primary" />
        </form>
    </div>
</div>

    );
  }

function TheThanhVien() {
  return (
      <div className="member-info">
          <table>
              <thead>
                  <tr>
                      <th>Số thẻ</th>
                      <th>Hạng thẻ</th>
                      <th>Ngày kích hoạt</th>
                      <th>Tổng chi tiêu</th>
                      <th>Điểm tích lũy</th>
                      <th>Điểm đã tiêu</th>
                      <th>Điểm khả dụng</th>
                      <th>Điểm sắp hết hạn</th>
                      <th>Ngày hết hạn</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>9002000002783306 (Đang dùng)</td>
                      <td>Khách hàng STANDARD</td>
                      <td>26/10/2024</td>
                      <td>00 đ</td>
                      <td>00</td>
                      <td>00</td>
                      <td>00</td>
                      <td>00</td>
                      <td></td>
                  </tr>
              </tbody>
          </table>
          <div className="points-info">
              Bạn cần tích lũy thêm 3.000.000 đ để nâng hạng Khách hàng VIP
          </div>
      </div>
  );
}

function HanhTrinh(){
  return(
    
    <div class="table-container">
    <h3>BẢNG ĐẶT VÉ</h3>
    <table class="custom-table">
        <thead>
            <tr>
                <th>MÃ HÓA ĐƠN</th>
                <th>PHIM</th>
                <th>RẠP CHIẾU</th>
                <th>SUẤT CHIẾU</th>
                <th>GHẾ ĐÃ ĐẶT</th>
                <th>COMBO/PACKAGE</th>
                <th>NGÀY ĐẶT</th>
                <th>ĐIỂM</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>HD001</td>
                <td>Avengers: Endgame</td>
                <td>Rạp CGV</td>
                <td>19:00</td>
                <td>Hàng A, Ghế 5</td>
                <td>Combo 1 (Popcorn + Drink)</td>
                <td>2024-11-05</td>
                <td>100</td>
            </tr>
            <tr>
                <td>HD002</td>
                <td>Inception</td>
                <td>Rạp Lotte</td>
                <td>21:00</td>
                <td>Hàng B, Ghế 8</td>
                <td>Combo 2 (Popcorn Large)</td>
                <td>2024-11-06</td>
                <td>150</td>
            </tr>
            <tr>
                <td>HD003</td>
                <td>The Matrix</td>
                <td>Rạp Galaxy</td>
                <td>18:30</td>
                <td>Hàng C, Ghế 10</td>
                <td>Combo 3 (Drink Large)</td>
                <td>2024-11-07</td>
                <td>120</td>
            </tr>
        </tbody>
    </table>
</div>

  
  
   )}

   function VouCher(){
    
    return(
      <div class="table-container">
   
      <h3>VOUCHER CỦA TÔI</h3>
      <table class="custom-table">
          <thead>
              <tr>
                  <th>MÃ VOUCHER</th>
                  <th>NỘI DUNG VOUCHER</th>
                  <th>LOẠI VOUCHER</th>
                  <th>NGÀY HẾT HẠN</th>
                  <th>THAO TÁC</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>VCH001</td>
                  <td>Giảm giá 20% cho phim bất kỳ</td>
                  <td>Khuyến mãi</td>
                  <td>2024-12-31</td>
                  <td><button>Sử dụng</button></td>
              </tr>
              <tr>
                  <td>VCH002</td>
                  <td>Mua 1 tặng 1 vé xem phim</td>
                  <td>Khuyến mãi</td>
                  <td>2024-11-30</td>
                  <td><button>Sử dụng</button></td>
              </tr>
              <tr>
                  <td>VCH003</td>
                  <td>Giảm giá 10% combo đồ ăn</td>
                  <td>Combo</td>
                  <td>2024-10-15</td>
                  <td><button>Hết hạn</button></td>
              </tr>
          </tbody>
      </table>
  
  
      <h3>LỊCH SỬ VOUCHER</h3>
      <table class="custom-table">
          <thead>
              <tr>
                  <th>THỜI GIAN</th>
                  <th>MÃ VOUCHER</th>
                  <th>NỘI DUNG VOUCHER</th>
                  <th>TRẠNG THÁI</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>2024-09-12</td>
                  <td>VCH001</td>
                  <td>Giảm giá 20% cho phim bất kỳ</td>
                  <td>Đã sử dụng</td>
              </tr>
              <tr>
                  <td>2024-08-05</td>
                  <td>VCH002</td>
                  <td>Mua 1 tặng 1 vé xem phim</td>
                  <td>Đã sử dụng</td>
              </tr>
              <tr>
                  <td>2024-07-25</td>
                  <td>VCH003</td>
                  <td>Giảm giá 10% combo đồ ăn</td>
                  <td>Hết hạn</td>
              </tr>
          </tbody>
      </table>
      
  </div>
  )
   }
    


const onChange = (key) => {
    console.log(key);
};

const items = [
    { key: '1', label: 'THÔNG TIN NGƯỜI DÙNG', children: <ThongTinNguoiDung /> },
    { key: '2', label: 'THẺ THÀNH VIÊN ', children: <TheThanhVien /> },
    { key: '3', label: 'HÀNG TRÌNH ĐIỆN ẢNH', children: <HanhTrinh /> },
    { key: '4', label: 'VOUCHER', children: <VouCher /> },
];

const ThongTin = () => {
    const [activeTab, setActiveTab] = useState(items[0].key);
<Tabs defaultActiveKey="1" items={items} onChange={onChange} />
    return (
        <div className="tab-container">
            <div className="tabs-nav">
                {items.map((item) => (
                    <div
                        key={item.key}
                        className={`tab-item ${activeTab === item.key ? 'active' : ''}`}
                        onClick={() => setActiveTab(item.key)}
                    >
                        {item.label}
                    </div>
                ))}
            </div>
            <div className="">
                {items.find((item) => item.key === activeTab)?.children}
            </div>
        </div>
    );
};

export default ThongTin;
