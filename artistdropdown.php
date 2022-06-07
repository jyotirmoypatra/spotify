<?php
    require_once "db.php";
 
   
    $fetch_artist = "select * from artist";

    $fetch_artist_query=mysqli_query($con,$fetch_artist);

    if($fetch_artist_query) {

    while( $result= mysqli_fetch_assoc($fetch_artist_query)){
     ?>
        <label for="first">
            <input type="checkbox" id="first" value=" <?php  echo $result['name'];  ?>" />
            <?php  echo $result['name'];  ?>
        </label>
      <?php

    }

   
     
     
    } else {
       echo "Error: " . $sql . "" . mysqli_error($con);
    }
 
    mysqli_close($con);
 
?>




