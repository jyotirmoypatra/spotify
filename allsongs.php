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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
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
                        <a class="nav-link " href="index.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="allsongs.php">All Songs</a>
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

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-10">
                <h2>All Songs</h2>
            </div>
            <div class="col-lg-2">
                <div class="addsongbtn"><a href="addsong.php">+ Add Song</a></div>
            </div>
        </div>
    </div>
    <div class="container-fluid  mt-3">
      
    <?php
    require_once "db.php";
$uname=$_SESSION['username'];
$user_select_query="select userid from users where username='$uname'";
$userquery=mysqli_query($con,$user_select_query);
$count_user=mysqli_num_rows($userquery);
if($count_user)
{
 $fetch_user= mysqli_fetch_assoc($userquery);
 $user_id=$fetch_user['userid'];
 //echo $user_id;
}
    ?>

        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Artwork</th>
                    <th scope="col">Song</th>
                    <th scope="col">Date of Release</th>
                    <th scope="col">Artists</th>
                    <th scope="col">Rate</th>
                </tr>
            </thead>
            <tbody>
                <!-- fetch all songs -->
                <?php
                include 'db.php';
                $songquery="select * from songs ORDER BY songid DESC";
                $song_fetch_query = mysqli_query($con,$songquery);
                while( $result= mysqli_fetch_assoc($song_fetch_query)){
                ?>
                <tr>
                    <td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($result['artwork']).'"/>' ?></td>
                    <td><?php  echo $result['songname'];  ?></td>
                    <td><?php  echo $result['releasedate'];  ?></td>
                    <td><?php  echo $result['artists'];  ?></td>
                    <td>
                        <!-- <div class='starrr'></div> -->
                        <!-- <div id="rateYo"></div>
                        <div class="counter"></div> -->
                    <div>
                    <div class="rateyo" data-user="<?php echo $user_id; ?>" data-value="<?php  echo $result['songid'];  ?>"
                    data-rateyo-rating="<?php  echo $result['avgrating'];  ?>"
                    data-rateyo-num-stars="5"
                    ></div>
                    <!-- <span class='score'>0</span> -->
                   <span>rating</span> <span class='result'><?php  echo $result['avgrating'];  ?></span>
                    </div>
                    </td>
                </tr>
                <?php  } ?>
               

            </tbody>
        </table>
    </div>

    



    <script>
    // $(function() {
    //     $(".starrr").starrr();
    // });


    $(function () {
 
 $("#rateYo").rateYo({

   onChange: function (rating, rateYoInstance) {

     $(this).next().text(rating);
   }
 });
});

$(function () {
  $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
    var rating = data.rating;
   // $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
    $(this).parent().find('.result').text( rating);

    var songid= $(this).data("value");
    console.log("ratng="+rating,"songid="+songid);
   var uid=$(this).data("user");
    //ajax to add rating

    $.ajax({
                type: "POST",
                url: "rating.php",
                data: {
                  songid:songid,
                  rating:rating,
                  current_user:uid
                    
                },
                
                success: function(data) {
                   console.log(data);
                    //$('#checkBoxes').html(data);
                   

                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });
    //ajax to add rating end



   });
});
    </script>

  


</body>

</html>