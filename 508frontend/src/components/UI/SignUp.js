import { React, useState} from 'react';
import Avatar from '@mui/material/Avatar';
import Button from '@mui/material/Button';
import CssBaseline from '@mui/material/CssBaseline';
import TextField from '@mui/material/TextField';
import FormControlLabel from '@mui/material/FormControlLabel';
import Checkbox from '@mui/material/Checkbox';
import Link from '@mui/material/Link';
import Grid from '@mui/material/Grid';
import Box from '@mui/material/Box';
import LockOutlinedIcon from '@mui/icons-material/LockOutlined';
import Typography from '@mui/material/Typography';
import Container from '@mui/material/Container';
import { createTheme, ThemeProvider } from '@mui/material/styles';
import { makeStyles } from '@mui/styles';
import { OutlinedInput } from '@mui/material';
import "./SignUp.css";
import axios from 'axios';



const useStyles = makeStyles(() =>({
    

}));


function SignUp() {
    const  [input, setInput] = useState({});

    const classes = useStyles();

    const handleChange = (event) => {
        const name = event.target.name;
        const value = event.target.value;
        setInput(values => ({...values, [name]: value}));
    }
 
   
    const handleSubmit = (event) =>{
        event.preventDefault();

        axios.post('http://localhost:8888/api/user/save', input)
        console.log(input)

    }

  return (
      <div className='con' id="signup">

      <Container component="main" maxWidth="xs" borderRadius={20} sx={{

      }}>
          <h1 className='header'>QUICK 'N EASY</h1>

        <CssBaseline />
        <Box
          sx={{
            marginTop: 8,
            display: 'flex',
            flexDirection: 'column',
            alignItems: 'center',
          }}
        >
          <Avatar sx={{ m: 1, bgcolor: 'secondary.main' }}>
            <LockOutlinedIcon />
          </Avatar>
          <Typography component="h1" variant="h5" color="white">
            Register An Account
          </Typography>
          <Box component="form" noValidate onSubmit={handleSubmit} sx={{ mt: 3 }}>
            <Grid container spacing={2}>
              <Grid item xs={12} sm={12}>
                <OutlinedInput
                onChange={handleChange}
                 sx={{
                        bgcolor: 'background.paper',
                        boxShadow: 1,
                        borderRadius: 20,
                        minWidth: 150,
                        outlineColor: 'purple',
                        color: 'purple',
                  }}
                  autoComplete="given-name"
                  name="user_name"
                  fullWidth
                  color='secondary'
                  required
                  placeholder='User Name'
                  id="userName"
                  autoFocus
                />
              </Grid>
              <Grid item xs={12}>
                <OutlinedInput
                  onChange={handleChange}
                  sx={{
                        bgcolor: 'background.paper',
                        boxShadow: 1,
                        color: 'purple',
                        borderRadius: 20,
                        minWidth: 300,
                        outlineColor: 'purple',
                  }}
                  placeholder="Password"
                  required
                  fullWidth
                  color='secondary'
                  id="password"
                  name="password"
                  type='password'
                />
              </Grid>
              <Grid 
               borderRadius={20}
               item xs={12}>
                <OutlinedInput
                  onChange={handleChange}
                  className={classes.input}
                  sx={{
                        bgcolor: 'background.paper',
                        boxShadow: 1,
                        borderRadius: 20,
                        minWidth: 300,
                        outlineColor: 'purple',
                        color: 'purple',
                  }}
                  required
                  fullWidth
                  color='secondary'
                  name='confirm_password'
                  placeholder='Confirm Password'
                  type="password"
                  id="password"
                />
              </Grid>
            
            </Grid>
            <Grid
            sx={{
                        display: 'flex',
                        justifyContent: 'center',
                  }} 
            
            >
            <Button
              type="submit"
              variant="outlined"
              color="secondary"
              sx={{ mt: 2, mb: 3, borderRadius: "20px",}}
            >
              Sign Up
            </Button>
            </Grid>
            <Grid container justifyContent="center">
              <Grid  justifyContent="center">
                <Link href="#" variant="body2" color='secondary'>
                  Already have an account? Sign in
                </Link>
              </Grid>
            </Grid>
          </Box>
        </Box>
      </Container>
      </div>
      );
    }

export default SignUp;