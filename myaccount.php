<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
   
    <script src="js/rating.js"></script>
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

  <div class="container text-center mt-5 bg-light">
      <h2 style="background-color: yellow;padding:10px;">My Account</h2>
      <h3>Welcome <?php  echo $_SESSION['username']; ?></h3>
      <a href="logout.php">Logout</a>
  </div>





    <script>
    $(function() {
        $(".starrr").starrr();
    });
    </script>

</body>

</html>