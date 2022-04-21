import './App.css';
import { BrowserRouter, Routes, Route, Link } from 'react-router-dom';
import ListUser from './components/ListUser';
import CreateUser from './components/CreateUser';
import EditUser from './components/EditUser';
import HomePage from './components/HomePage';

function App() {
  return (
    <div className="App">
    <BrowserRouter>
      <Routes>
        <Route index element={<ListUser />} />
        <Route path="user/create" element={<CreateUser />} />
        <Route path="user/:id/edit" element={<EditUser />} />
        <Route path="user/home" element={<HomePage />} />
      </Routes>
    </BrowserRouter>
    </div>
  );
}

export default App;
