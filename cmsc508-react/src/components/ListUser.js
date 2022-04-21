import React, {useState} from 'react'
import axios from 'axios';
import SignUp from './UI/SignUp';
import { Login } from '@mui/icons-material';
import { BrowserRouter, Routes, Route, Link } from 'react-router-dom';
import LogIn from './UI/LogIn';


function ListUser() {

    const  [input, setInput] = useState({});

    const handleChange = (event) => {
        const name = event.target.name;
        const value = event.target.value;
        setInput(values => ({...values, [name]: value}))
    }
 
    const handleSubmit = (event) =>{
        event.preventDefault();

        axios.post('http://localhost:8888/api/user/save', input)
        console.log(input)

    }


  return (
    <div>
      <nav>
        <ul>
          <li>
            <Link to="/"> List user</Link>
          </li>
          <li>
            <Link to="user/create">Create User</Link>
          </li>
        </ul>
      </nav> 

    <LogIn />

    
      <h1 style={{color: 'white'}}>List Users </h1>
      <form onSubmit={handleSubmit}>

      <label>Name :   </label>
      <input type="text" name="name" onChange={handleChange}/>
      <br />

      <label>Email :   </label>
      <input type="text" name="email" onChange={handleChange}/>
      <br />


      <label>Mobile :   </label>
      <input type="text" name="mobile" onChange={handleChange}/>
      <br />

      <button>Save</button>

      </form>
      </div>
  );
}

export default ListUser