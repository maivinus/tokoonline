<?php 
    session_start();

    if(isset($_SESSION['user_email'])){
        switch($_SESSION['user_level']){
            case 'Admin': header('location:home.php?p=dashboard'); break;
            case 'User': echo "User"; break;
        }
    }

    if(isset($_POST['email'])){
        $email = $_POST['email'];
        $passwd = md5($_POST['password']);
        
        include('../config/koneksi.php');
        $query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email' AND password='$passwd'");
        $data = mysqli_fetch_array($query);
        
        if(! empty($data['email'])){
            $_SESSION['user_email'] = $email;
            $_SESSION['user_level'] = $data['level'];

            header('location:home.php?p=dashboard');
        }else{
            echo "<script>alert('Email/Password Anda salah !')</script>";
        }
        
    }

?>
<!doctype html>
<html lang="en">
  <head >
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title>Login Admin Toko</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/signin.css" rel="stylesheet">
    <style>
        html,
        body {
        height: 100%;
        }

        body {
        display: flex;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color : #FF7F00;
        }
    </style>
  </head>
  <body class="text-center justify-content-center">
    <main class="form-signin " >
      <form action="#" method="POST">
        <h1 class="h3 mb-3 fw-normal">Please Sign In</h1>

        <div class="form-floating">
          <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
          <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
          <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
          <label for="floatingPassword">Password</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p class="mt-3 mb-3 text-dark">&copy; 2023</p>
      </form>
    </main>
  </body>
</html>