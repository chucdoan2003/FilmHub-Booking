import { applyMiddleware, combineReducers, createStore } from "redux"
import { QuanLyDatVeReducer } from "../QuanLyDatVeReducer"
import { thunk } from "redux-thunk";


const rootReducer = combineReducers({
    QuanLyDatVeReducer:QuanLyDatVeReducer
});

export const store = createStore(rootReducer, applyMiddleware(thunk));