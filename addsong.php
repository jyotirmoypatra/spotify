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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


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

    <?php
    if(isset($_SESSION['username'])){ ?>
    <div class="container-fluid mt-3">
        <h2>Adding a new song</h2>
        <form id="addsongform" method="POST" action="" enctype="multipart/form-data">
            <div class="songinput">
                <label for="">Song Name</label>
                <input type="text" name="songname"> </br>
            </div>
            <div class="songinput">
                <label for="">Date Released</label>
                <input type="DATE" name="daterelease"></br>
            </div>
            <div class="songinput">
                <label for="">Artwork</label>
                <input type="file" name="artimage"></br>
            </div>
            <div class="songinput" style="float: left;">
                <!-- <label for="cars">Artists</label>
                <select name="cars" id="artistselect">
                    <option value="kk">Select Artists</option>
                    <option value="abc">abc</option>
                    <option value="nbn">nbn</option>
                    <option value="audi">Audi</option>
                </select> -->
                
            </div>
            <div class="multipleSelection" style="float: left;margin-top:12px;">
                <div class="selectBox" onclick="showCheckboxes()">
                    <select>
                        <option>Select options</option>
                    </select>
                    <div class="overSelect"></div>

                </div>

                <div id="checkBoxes">
                    
                </div>
            </div>
            <button style="margin-top: 5px;margin-left:12px;" type="button" class="btn btn-secondary"
                data-bs-toggle="modal" data-bs-target="#exampleModal">
                + Add Artists
            </button>
            <div class="btns mt-4" style="clear: both;">

                <button onclick="clearsong();">Cancel</button>
                <button type="submit" name="savesong">Save</button>
            </div>

        </form>
    </div>

    <?php }else{?>

    <div class="container text-center mt-5">
        <h2 style="color:#fc9803;">Please Login your Account before add any songs !!</h2>
        <a href="login.php">Login</a>
    </div>

    <?php } ?>

<!--artist Modal start-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Artist</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="songinput">
                            <label for="">Artist Name</label>
                            <input type="text" id="artistname" name="artistname"> </br>
                        </div>
                        <div class="songinput">
                            <label for="">Date of Birth</label>
                            <input type="date" id="dob" name="dob"></br>
                        </div>

                        <div class="songinput">
                            <label for="">Bio</label>
                            <textarea name="bio" id="bio" rows="5" cols="50"></textarea>
                        </div>
                        <div class="songinput text-center">
                            <button id="createartist" type="submit" style="background-color: #7bfd8b;font-weight:bold;" name="createartist" class="btn ">Save</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

<!--artist Modal end-->


    <script>
    var show = true;

    function showCheckboxes() {
      
        var checkboxes =
            document.getElementById("checkBoxes");

        if (show) {
            checkboxes.style.display = "block";
            show = false;
        } else {
            checkboxes.style.display = "none";
            show = true;
        }
        
        




    }

    
    </script>
    <script>
    $(document).ready(function() {
      //fetch artist in dropdown ajax
        jQuery(".selectBox").on('click',function(e) {
           e.preventDefault();
           $.ajax({
                type: "POST",
                url: "artistdropdown.php",
                data: {
                  
                    
                },
                
                success: function(data) {
                   // alert(data);
                    $('#checkBoxes').html(data);
                   
                    

                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });

        });
        //fetch artist in dropdown ajax end



        //add artist ajax start

        jQuery("#createartist").on('click',function(e) {
           e.preventDefault();
            var artistname = jQuery("#artistname").val();
            var dob = jQuery("#dob").val();
            var bio = jQuery("#bio").val();
          

            if (artistname == '' || dob == '' || bio == '' ) {
                alert("Please fill all the Artist Details.");
                return false;
            }

            $.ajax({
                type: "POST",
                url: "addartist.php",
                data: {
                    artistname: artistname,
                    dob: dob,
                    bio: bio
                    
                },
                
                success: function(data) {
                    alert(data);
                    $('#artistname').val('');
                    $('#dob').val('');
                    $('#bio').val('');
                    

                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });

        });
        //add artist ajax end

    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
    </script>
</body>

</html>




<?php

include "db.php";

if(isset($_POST['savesong'])  ){

    if(isset($_POST['daterelease']) && isset($_POST['selectartist'])) 
    {
    
    $songname =mysqli_real_escape_string($con, $_POST['songname']);
    $daterelease =mysqli_real_escape_string( $con,$_POST['daterelease']);
    $imageName =mysqli_real_escape_string( $con,$_FILES["artimage"]["name"]);
    $imageData =mysqli_real_escape_string($con,file_get_contents($_FILES["artimage"]["tmp_name"]));

    $artist = $_POST['selectartist'];
    $artist_srt=implode(",",$artist);

  //  echo $artist_srt;

   $current_user=$_SESSION['username'];
  // echo $current_user;
     $current_user_query="select userid from users where username='$current_user'";
     $user_query=mysqli_query($con,$current_user_query);
     $user_count=mysqli_num_rows($user_query);
     if($user_count)
    {
      $user_fetch= mysqli_fetch_assoc($user_query);
      $current_user_id=$user_fetch['userid'];
      $avgrating=0;
    
     $song_insert_query= "insert into songs (songname,releasedate,artwork,artists,userid,avgrating,artworkname) 
    values('$songname','$daterelease','$imageData','$artist_srt','$current_user_id','$avgrating','$imageName')";
   // $song_query=mysqli_query($con,$song_insert_query);
    //$song_count=mysqli_num_rows($song_query);
    if(mysqli_query($con,$song_insert_query)){  
        ?>

     <script>alert("Song added successfully");</script>
      <?php
        
    }else{
        ?>

        <script>alert("Song added Failed!!!!!!!");</script>
         <?php

    }

    }
 }else{ ?>
 <script>alert("Please add all song details!!");</script>
<?php }
}
  