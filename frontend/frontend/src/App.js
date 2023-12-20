import 'bootstrap/dist/css/bootstrap.min.css';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Login from './views/login/Login';
import Menu from './views/menu/Menu';
function App() {
  return (
      <BrowserRouter>
          <Routes>
                <Route path='/login' element={<Login />} />
                <Route path='/menu' element={<Menu/>} />
          </Routes>
      </BrowserRouter>
  );
}

export default App;
