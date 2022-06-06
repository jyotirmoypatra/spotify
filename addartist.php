<?php
    require_once "db.php";
 
    $name = mysqli_real_escape_string($con, $_POST['artistname']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);
    $bio = mysqli_real_escape_string($con, $_POST['bio']);
 
    $insertartist = "insert into artist (name,dob,bio) 
    values('$name','$dob','$bio')";

    $artistquery=mysqli_query($con,$insertartist);

    if($artistquery) {
     echo 'Successfully added';
     
    } else {
       echo "Error: " . $sql . "" . mysqli_error($con);
    }
 
    mysqli_close($con);
 
?>