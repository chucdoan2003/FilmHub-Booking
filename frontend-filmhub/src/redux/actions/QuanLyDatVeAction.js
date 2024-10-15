import { quanLyDatVeService } from "../../services/QuanLyDatVeServiece"
import { SET_CHI_TIET_PHONG_VE } from "./types/QuanLyDatVeType";

export const layChiTietPhongVeAction = (maLichChieu) =>{
    return async dispatch => {
        try {
            const result = await quanLyDatVeService.layChiTietPhongVe(maLichChieu);

            if(result.status === 200){
                dispatch({
                    type:SET_CHI_TIET_PHONG_VE,
                    chiTietPhongVe:result.data.content
                })
            }
        } catch (error) {
            console.log(error)
        }
    }
}