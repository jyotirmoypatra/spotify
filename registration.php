<?php 
 session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>


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
                    <li class="nav-item">
                        <a class="nav-link " href="allsongs.php">All Songs</a>
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
    <div class="container mt-5 p-5 ">
        <div class="Login">

            <h1 class="">Create New User Account</h1>

           
            <form action="registration.php" method="POST">
                <div class="form-group">
                    <i class="fa fa-user icon"></i>
                    <input type="username" class="form-control" name="username" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="Enter User Name" required>

                </div>
                <div class="form-group">
                    <i class="fa fa-envelope icon"></i>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="Enter email" required>

                </div>
                <div class="form-group">
                    <i class="fa fa-key icon"></i>

                    <input type="password" class="form-control" name="password" id="exampleInputPassword1"
                        placeholder="Enter Password" required>
                </div>


                <div class="loginbtn">
                    <button type="submit" name="submit" class="btn ">Create account</button>
                </div>


                <div class="link">
                    <a id="btn1" class="user font-weight-bold" href="login.php">Existing User? Login Account</a>
                </div>

            </form>
        </div>


    </div>


</body>

</html>


<!-- registration php  code -->

<?php

include "db.php";

if(isset($_POST['submit'])){
  
    $name =mysqli_real_escape_string($con, $_POST['username']);
    $email =mysqli_real_escape_string( $con,$_POST['email']);
   $password =md5(mysqli_real_escape_string( $con,$_POST['password']));
       
   $duplicate="select * from users where  Email='$email' ";
   $duplicatequery=mysqli_query($con,$duplicate);
   if(mysqli_num_rows($duplicatequery)>0)
   {
     
     ?>
     <script>
     alert("Same email exist in database!!!")
     </script>
     <?php
   } else {
        $insertquery = "insert into users (username,email,password) 
        values('$name','$email','$password')";

        $query=mysqli_query($con,$insertquery);
        if($query){
            $_SESSION['msg']="Your Account is Successsfully Created,Now You Can login!";
            header('location:login.php');
            
        }else{
            ?>
             <script>
              alert("Error!! account not created !!")
              
          </script>
            <?php
        }


   }


}

?>