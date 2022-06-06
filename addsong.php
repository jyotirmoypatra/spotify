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
        <h2>Adding a new song</h2>
        <form id="addsongform" action="">
            <div class="songinput">
                <label for="">Song Name</label>
                <input type="text" name="songname"> </br>
            </div>
            <div class="songinput">
                <label for="">Date Released</label>
                <input type="text" name="daterelease"></br>
            </div>
            <div class="songinput">
                <label for="">Artwork</label>
                <input type="file" name="artimage"></br>
            </div>
            <div class="songinput" style="float: left;">
                <label for="cars">Artists</label>
                <!-- <select name="cars" id="artistselect">
                    <option value="kk">Select Artists</option>
                    <option value="abc">abc</option>
                    <option value="nbn">nbn</option>
                    <option value="audi">Audi</option>
                </select>
                 -->
            </div>
            <div class="multipleSelection" style="float: left;margin-top:12px;">
                <div class="selectBox" onclick="showCheckboxes()">
                    <select>
                        <option>Select options</option>
                    </select>
                    <div class="overSelect"></div>

                </div>

                <div id="checkBoxes">
                    <label for="first">
                        <input type="checkbox" id="first" />
                        checkBox1
                    </label>

                    <label for="second">
                        <input type="checkbox" id="second" />
                        checkBox2
                    </label>
                    <label for="third">
                        <input type="checkbox" id="third" />
                        checkBox3
                    </label>
                    <label for="fourth">
                        <input type="checkbox" id="fourth" />
                        checkBox4
                    </label>
                </div>
            </div>
            <button style="margin-top: 5px;margin-left:12px;" type="button" class="btn btn-secondary"
                data-bs-toggle="modal" data-bs-target="#exampleModal">
                + Add Artists
            </button>
            <div class="btns mt-4" style="clear: both;">

                <button onclick="clearsong();">Cancel</button>
                <button type="submit">Save</button>
            </div>

        </form>
    </div>



    <!-- Modal -->
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
                            <input type="text" name="artistname"> </br>
                        </div>
                        <div class="songinput">
                            <label for="">Date of Birth</label>
                            <input type="date" name="dob"></br>
                        </div>
                        
                        <div class="songinput">
                            <label for="">Bio</label>
                            <textarea name="bio" rows="5" cols="50"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>




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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
    </script>
</body>

</html>