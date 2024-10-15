import React, { Fragment, useEffect } from 'react'
import style from "./Checkout.module.css";
import "./Checkout.css";
import { DAT_VE } from '../../redux/actions/types/QuanLyDatVeType';
import { CloseOutlined } from '@ant-design/icons';
import { useDispatch, useSelector } from 'react-redux';
import { layChiTietPhongVeAction } from '../../redux/actions/QuanLyDatVeAction';
import { useParams } from 'react-router-dom';
import { Tabs } from 'antd';

function Checkout(props)  {

    const {chiTietPhongVe, danhSachGheDangDat} = useSelector(state => state.QuanLyDatVeReducer)

    const dispatch = useDispatch();
    const {id} = useParams();
    // let {id} = props.match.params;
    useEffect(()=>{
        dispatch(layChiTietPhongVeAction(id));
    })

    const {thongTinPhim, danhSachGhe} = chiTietPhongVe;
    const renderSeats = () => {
        return danhSachGhe.map((ghe, index) => {

            let classGheVip = ghe.loaiGhe === 'Vip' ? 'gheVip' : '';
            let classGheDaDat = ghe.daDat === true ? 'gheDaDat' : '';
            let classGheDangDat = '';
            let indexGheDD = danhSachGheDangDat.findIndex(gheDD => gheDD.maGhe === ghe.maGhe);
            if(indexGheDD!==-1) {
                classGheDaDat = 'gheDangDat';
            }
            return <Fragment key = {index}>
              <button onClick={() => {
                dispatch({
                  type: DAT_VE,
                  gheDuocChon: ghe
                })
              }}
              disabled={ghe.daDat} className={`ghe ${classGheVip} ${classGheDaDat}`} key={index}>{ghe.daDat ? < CloseOutlined /> : ghe.stt}</button>
                {(index + 1) % 14 === 0 ? <br/> : ""}
            </Fragment>
        })
    }
  return (
    <div className='container min-h-secreen'>
      <div className='grid grid-cols-12'>
            <div className='col-span-9'>
          <div className='mt-5 flex justify-center'>
            <table className='divide-y divide-gray-200 w-2/3'>
              <thead className='bg-gray-50 p-5'>
                <tr>
                  <th>Ghế thường</th>
                  <th>Ghế đang đặt</th>
                  <th>Ghế Vip</th>
                  <th>Ghế đã đặt</th>
                </tr>
              </thead>

              <tbody className='bg-white divide-y divide-gray-200 text-center'>
                <tr>
                  <td><button className='ghe text-center'>0</button></td>
                  <td><button className='ghe gheDangDat text-center'>0</button></td>
                  <td><button className='ghe gheVip text-center'>0</button></td>
                  <td><button className='ghe gheDaDat text-center'>< CloseOutlined /></button></td>
                </tr>
              </tbody>

            </table>
            
          </div>
          <div className='text-center'>{renderSeats()}</div>
            </div>

            <div className='col-span-3'>
                <h3 className='text-red-500 text-center text-2xl mt-2'>
            {danhSachGheDangDat.reduce((tongTien, ghe, index) => {
              return tongTien += ghe.giaVe
            }, 0)}đ
                </h3>
                <hr/>
                <h3 className='text-xl'>{thongTinPhim?.tenPhim}</h3>
                  <p>Địa điểm: {thongTinPhim?.diaChi}</p>
                  <p>Ngày chiếu: {thongTinPhim?.ngayChieu} - {thongTinPhim?.gioChieu} {thongTinPhim?.tenRap}</p>
                  <hr/>

                  <div className='flex flex-row'>
                    <div className='w-4/5'>
                    <span className='text-red-400'>
                        Ghế
                        </span>
                          {danhSachGheDangDat.map((gheDD, index) =>{
                          return <span key={index} className='text-green-500 text-xl'> {gheDD.stt}</span>
                    })}
                    
                    </div>
                    

                    <div className='text-right cols-span-1'>
                        <span className='text-red-500 text-lg'>
                          {danhSachGheDangDat.reduce((tongTien,ghe,index) =>{
                            return tongTien += ghe.giaVe
                          },0)}đ
                        </span>
                    </div>
                  </div>
                  <hr/>

                  <div className='my-5'>
                    <i>Email</i>
                    <p>abc@gmail.com</p>
                  </div>
                  <hr/>
                  <div className='my-5'>
                    <i>Phone</i><br/>
                    <p>0133456789</p>
                  </div>
                  <hr/>
                  <div className='mb-0 h-full flex flex-col items-center'>
                      <div className='bg-red-400 text-white w-full text-center py-3 font-bold text-2xl cursor-pointer'><a href='/bill'>ĐẶT VÉ</a></div>
                  </div>
            </div>
      </div>
    </div>
  )
}
function KetQuaDatVe(props) {
  return <div>
    Kết quả đặt vé
  </div>
}

const onChange = (key) => {
  console.log(key);
};
const items = [
  {
    key: '1',
    label: '01 CHỌN GHẾ & THANH TOÁN',
    children: <Checkout />,
  },
  {
    key: '2',
    label: '02 KẾT QUẢ ĐẶT VÉ',
    children: <KetQuaDatVe/>,
  },
];
const Nav = () => <Tabs defaultActiveKey="1" items={items} onChange={onChange} />;
export default Nav;




