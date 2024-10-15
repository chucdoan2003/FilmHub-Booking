import React, { useEffect } from 'react'
import { useDispatch, useSelector } from 'react-redux'
import { useParams } from 'react-router-dom';
import { layChiTietPhongVeAction } from '../../redux/actions/QuanLyDatVeAction';


const Bill = () => {
  const { chiTietPhongVe } = useSelector(state => state.QuanLyDatVeReducer);
  const dispatch = useDispatch();
  const { id } = useParams();
  // let {id} = props.match.params;
  useEffect(() => {
    dispatch(layChiTietPhongVeAction(id));
  })
  const { thongTinPhim } = chiTietPhongVe;
  return (
    <div className='container m-auto p-0 mt-6'>
      <div className='grid grid-cols-12'>
        <div className='col-span-8'>
          <h2 className='text-3xl font-bold'>Thông Tin Phim</h2>
          <h3 className='text-xl my-4'>Tên Phim:{thongTinPhim?.tenPhim}</h3>
          <p className='my-2'>Địa điểm:{thongTinPhim?.diaChi}</p>
          <p className='my-2'>Ngày chiếu: {thongTinPhim?.ngayChieu} - {thongTinPhim?.gioChieu} </p>

          <div className='flex flex-row'>
            <div className='mr-28'>
              <p>Ghế: </p>  
            </div>
            <div>{thongTinPhim?.tenRap}</div>
          </div>

          <div className='my-5'>
            <i>Email</i>
            <p>abc@gmail.com</p>
          </div>

          <div className='my-5'>
            <i>Phone</i><br />
            <p>0133456789</p>
          </div>
          <div>
            <h2 className='text-3xl font-bold'>Thông Tin Thanh Toán</h2>
            <div className='mt-5'>
              <table className='divide-y divide-gray-200 w-2/3'>
                <thead className='bg-gray-50 p-5'>
                  <tr>
                    <th>Danh mục</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                  </tr>
                </thead>

                <tbody className='bg-white divide-y divide-gray-200 text-center'>
                  <tr>
                    <td><button>Ghế</button></td>
                    <td><button>0</button></td>
                    <td><button>0Đ</button></td>
                  </tr>
                </tbody>

              </table>

            </div>
          </div>
          
        </div>

        

        <div className='col-span-4'>
          <h2 className='text-3xl font-bold mb-4'>Phương Thức Thanh Toán</h2>
          <div>
            <form>
            <p className='text-xl mb-3'>Chọn phương thức thanh toán:</p>
            <input className='mb-3' type="radio" id="ttd" name="fav_language" value="TheTD" />
            <label for="ttd">Thẻ tín dụng</label><br />
            <input className='mb-3' type="radio" id="ck" name="fav_language" value="Ck" />
            <label for="ck">Chuyển khoản</label><br />
            <input className='mb-3' type="radio" id="tm" name="fav_language" value="Tm" />
            <label for="tm">Tiền mặt</label><br />
          </form>
          </div>

          <div className='my-3'>
            <h3 className='text-xl'>Chi phí</h3>
            <div className='flex justify-between my-3'>
              <p>Thanh Toán</p>
              <span>0đ</span>
            </div>
            <div className='flex justify-between my-3'>
              <p>Phí</p>
              <span>0đ</span>
            </div>
            <div className='flex justify-between my-3'>
              <p>Tổng tiền</p>
              <span>0đ</span>
            </div>
          </div>
          
          <div className='mb-0 h-full flex flex-col items-center'>
            <div className='bg-red-400 text-white w-full text-center py-3 font-bold text-2xl cursor-pointer'>Thanh Toán</div>
          </div>
        </div>
      </div>
    </div>
  )
}

export default Bill
