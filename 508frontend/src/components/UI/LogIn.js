import * as React from 'react';
import Avatar from '@mui/material/Avatar';
import Button from '@mui/material/Button';
import CssBaseline from '@mui/material/CssBaseline';
import TextField from '@mui/material/TextField';
import FormControlLabel from '@mui/material/FormControlLabel';
import Checkbox from '@mui/material/Checkbox';
import { BrowserRouter, Routes, Route, Link as RouterLink } from 'react-router-dom';
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

const useStyles = makeStyles(() =>({
    

}));


function LogIn() {


    const theme = createTheme({
      palette: {
        primary: {
          main: "#11cb5f",
        },
        secondary: {
          main: '#9031AA',
        },
      },
    });


    const classes = useStyles();


    const handleSubmit = (event) => {
        event.preventDefault();
        const data = new FormData(event.currentTarget);
        console.log({
        email: data.get('email'),
        password: data.get('password'),
        });
    };

    

  return (
    <ThemeProvider theme={theme}>

      <div className='con'>

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
          <Avatar sx={{ m: 1, bgcolor: 'primary.main' }}>
            <LockOutlinedIcon />
          </Avatar>
          <Typography component="h1" variant="h5" color="white">
            LogIn
          </Typography>
          <Box component="form" noValidate onSubmit={handleSubmit} sx={{ mt: 3 }}>
            <Grid container spacing={2}>
              <Grid item xs={12}>
                <OutlinedInput
                  sx={{
                        bgcolor: 'background.paper',
                        boxShadow: 1,
                        color: 'green',
                        borderRadius: 20,
                        minWidth: 300,
                        outlineColor: 'green',
                  }}
                  placeholder="Username "
                  required
                  fullWidth
                  id="email"
                  name="username"
                  color='primary'
                />
              </Grid>
              <Grid 
               borderRadius={20}
               item xs={12}>
                <OutlinedInput
                  className={classes.input}
                  sx={{
                        bgcolor: 'background.paper',
                        boxShadow: 1,
                        borderRadius: 20,
                        minWidth: 300,
                        outlineColor: 'green',
                        color: 'green',
                  }}
                  required
                  fullWidth
                  name='password'
                  placeholder='password'
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
              sx={{ 
                mt: 2, 
                mb: 3, 
                borderRadius: "20px",
                color: "green"
              }}
              component={RouterLink}
              to={{
              pathname: `user/home`,
              }}
            >
              LogIn
            </Button>
            </Grid>
            <Grid container justifyContent="center" fullWidth>
              <Grid  justifyContent="center" flexDirection={'row'} xs={6} >
                <Link href="#"  variant="body2" color='primary' fullWidth maxWidth={'xs'} sx={{
                    fontSize: '12px'

                }}>
                  forgot password?
                </Link>
                
                </Grid>
                <Grid xs={6} fullWidth >
                <Link href="user/create" variant="body2" fullWidth color='primary' sx={{
                    fontSize: '12px',
                    
                }}>
                  Don't have an account? Register
                </Link>
              </Grid>
            </Grid>
          </Box>
        </Box>
      </Container>
      </div>
      </ThemeProvider>

      );
    }

export default LogIn;