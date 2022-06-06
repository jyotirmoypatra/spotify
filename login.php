<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
   
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/script.js"></script>
    <link rel="stylesheet" type="text/css" href="style/style.css">

</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light ">
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">HOME</a>
                    </li>

                </ul>
                <div class="formdiv container-fluid col-lg-4">
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
                <?php
                 if(isset($_SESSION['username'])){
                    ?>
                 <div class="loginbtn"><a href="myaccount.php"><?php echo "Welcome ".$_SESSION['username']; ?></a></div>
                 <div class="loginbtn"><a href="logout.php">Logout</a></div>
                <?php } else{
                     ?>
                    <div class="loginbtn"><a href="login.php">Login</a></div>
                     <?php
                 }
                ?>

            </div>
        </div>
    </nav>
    <div class="container mt-5 p-5">
        <div class="Login">
        <?php 
            if(isset($_SESSION['msg'])){
                ?>
                <p class="bg-success text-white p-2 "> <?php echo $_SESSION['msg']; ?> </p> <?php
            }
            ?> 
            <h1 class="">Login</h1>
             
           
            <form action="login.php" method="POST"> 
                <div class="form-group">
                    <i class="fa fa-user icon"></i>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter email"
                         required>
                        
                </div>
                <div class="form-group">
                    <i class="fa fa-key icon"></i>
                    
                     <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Enter Password" 
                       required>
                </div>
                <div class="form-check">
                   <input class="form-check-input" type="checkbox" name="remember" id="gridCheck" >
                   <label class="form-check-label text-warning" for="gridCheck">  Remember me </label>
                </div>

                <div class="loginbtn">
                    <button type="submit" name="login" class="btn ">Login account</button>
                </div>
                

                <div class="link">
                <a  class="user font-weight-bold" href="forget.php">forget password?</a> <br>
                <a id="btn1" class="user font-weight-bold" href="registration.php">New User? Create a account </a>
            
             </div>

            </form>
        </div>
     

    </div>

   
</body>

</html>


<!-- login php code -->
<?php

include "db.php";

if(isset($_SESSION["username"]))
{
 header("location:index.php");
}
if(isset($_POST['login'])){
  
  
    $email =$_POST['email'];
    $password =$_POST['password'];

    $login="select * from users where email='$email'";
    $loginquery=mysqli_query($con,$login);
    $email_count=mysqli_num_rows($loginquery);

    if($email_count)
    {
      $email_pass= mysqli_fetch_assoc($loginquery);
      $db_pass=$email_pass['password'];
      

      if($db_pass === md5($password) )
      {
        $_SESSION['username']=$email_pass['username'];
        if(isset($_POST["remember"]))   
        {  
         setcookie ("email",$email,time()+ (10 * 365 * 24 * 60 * 60));  
         setcookie ("password",$password,time()+ (10 * 365 * 24 * 60 * 60));
         $_SESSION["username"] = $email_pass['username'];
         
        }else  
        {  
         if(isset($_COOKIE["email"]))   
         {  
          setcookie ("email","");  
         }  
         if(isset($_COOKIE["password"]))   
         {  
          setcookie ("password","");  
         }  
        }
        $_SESSION["username"] = $email_pass['username'];
        header("Location: index.php");
      }else{
        ?>
        <script>
        alert("Wrong  Password !!");
        </script>
        <?php
      }
            
    }else{
        ?>
        <script>
        alert("Email Not Exists !!");
        </script>
        <?php
    }

}