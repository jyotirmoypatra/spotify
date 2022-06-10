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

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-10">
                <h2>Top 10 Songs</h2>
            </div>
            <div class="col-lg-2">
               
               <div class="addsongbtn"><a href="addsong.php">+ Add Song</a></div>

            </div>
        </div>
    </div>
    <div class="container-fluid  mt-3">
    <?php
    if(isset($_SESSION['username'])){
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
            <?php
                include 'db.php';
                $songquery="select * from songs ORDER BY avgrating DESC LIMIT 10";
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
<?php
 require_once "db.php";
 $top_artist="select artists from songs ORDER BY avgrating DESC LIMIT 10 ";
 $fetch_top_artist_query = mysqli_query($con,$top_artist);
 $full_artist_array=[];
                while( $artist_result= mysqli_fetch_assoc($fetch_top_artist_query)){
      $comma=", ";
                    if(strpos($artist_result['artists'],$comma)!==false){
                       
                        $artist_array=explode(', ',$artist_result['artists']);
                        foreach($artist_array as $arts){
                            $full_artist_array[]=$arts;
                        }
                      
                    }else{
                        $full_artist_array[]=$artist_result['artists'];
                    }

    ?>

    <?php  }   
    $unique=array_unique($full_artist_array);
    //print_r($unique);
    
    ?>
    <div class="container-fluid topartist mt-5">
        <h2>Top 10 Artists</h2>

        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Artists</th>
                    <th scope="col">Date of Birth</th>
                    <th scope="col">Songs</th>
                </tr>
            </thead>
            <tbody>
                <?php
               require_once "db.php";
                 foreach($unique as $unq){
                     $trim=ltrim($unq);
                     $artist_dtls="select * from artist where name='$trim'";
                     $fetch_uuq_artist=mysqli_query($con,$artist_dtls);
                     while( $artist_unq_result= mysqli_fetch_assoc($fetch_uuq_artist)){
                 
               ?>
                <tr>
                    <td><?php  echo $artist_unq_result['name'];  ?></td>
                    <td><?php  echo $artist_unq_result['dob'];  ?></td>
                    <td>
                   <?php
                     $song_query="select * from songs where artists like '%$trim%'";
                     $song_fetch_query=mysqli_query($con,$song_query);
                     while( $song_result= mysqli_fetch_assoc($song_fetch_query)){
                     echo $song_result['songname'].',';
                     }
                     ?>
                    </td>

                </tr>
                <?php }} ?>
            

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
    


    <!-- <script>
    $(function() {
        $(".starrr").starrr();
    });
    </script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
    </script> -->
</body>

</html>