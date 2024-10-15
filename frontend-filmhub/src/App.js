import { createBrowserHistory } from 'history';
import './App.css';

import { BrowserRouter, Route, Router, Routes, Switch } from 'react-router-dom';
import CheckOutTemplate from './template/CheckOutTemplate';
import Checkout from './pages/Checkout/Checkout';
import { Provider } from 'react-redux';
import { store } from './redux/reducers/types/configStore';
import Bill from './pages/Checkout/Bill';



function App() {
  return (
    <Provider store={store}>
      <BrowserRouter>
        <Routes>
          <Route path='/checkout/:id' element={<Checkout />} />
          <Route path='/bill' element={<Bill />} />
        </Routes>
      </BrowserRouter>
    </Provider>


  )
}

export default App;
