<?php
    require_once "db.php";
 
    $songid = mysqli_real_escape_string($con, $_POST['songid']);
    $rating = mysqli_real_escape_string($con, $_POST['rating']);
    $user_id = mysqli_real_escape_string($con, $_POST['current_user']);
    
  
 
  
   $check_rating="select * from rating where userid='$user_id' and songid=' $songid' ";
   $check_rating_db=mysqli_query($con,$check_rating);
   $count_rating=mysqli_num_rows($check_rating_db);
   if($count_rating){
       //update rating in db
        $update_rate = "update rating set ratingvalue='$rating' where songid='$songid' and userid='$user_id' ";
        $rating_update_query=mysqli_query($con,$update_rate);
        $count_update_rating=mysqli_num_rows($rating_update_query);
        if($count_update_rating){
            echo 'update';
        }
   }else{
       //insert new rating
    $insert_rating="insert into rating(ratingvalue,songid,userid) values('$rating','$songid','$user_id')";
    $insert_rating_query=mysqli_query($con,$insert_rating);
    $count_insert_rating=mysqli_num_rows($insert_rating_query);
    if($count_insert_rating){
        echo 'new rate add';
    }else{
        echo "Error: " . $sql . "" . mysqli_error($con);
    }
   }


  //avg rating
  $avg_rating="SELECT AVG(ratingvalue) as avgrate FROM rating WHERE songid='$songid' ";
    $avg_rating_query= mysqli_query($con,$avg_rating);
    $fetchAverage = mysqli_fetch_array($avg_rating_query);
    $numAvgRating = $fetchAverage['avgrate'];
    echo "avgrate=".$numAvgRating;

    
   $update_avgrate="update songs set avgrating='$numAvgRating' where songid='$songid'";
   $update_avgrate_query=mysqli_query($con,$update_avgrate);
   $count_update_avgrate=mysqli_num_rows($update_avgrate_query);
   if($count_update_avgrate){
       echo "avg updated";
   }


 
    mysqli_close($con);
 
?>