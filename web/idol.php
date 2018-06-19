<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    //echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
} else {
    header("Location: /true_story/client/index.html", true, 301);
    exit();
}
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>TRUE STORY</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Orbitron|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/echarts.min.js"></script>
    <script src="js/fontawesome-all.min.js"></script>
    <script src="js/scripts.js"></script>
  </head>
  <body>
    <header>
      <div class="col-md-2">
            <a href="home.php"><img src="img/TS-logo-white.png" class="col-lg-10 img-fluid" alt=""></a>
      </div>
    </header>
    <nav>
      <div class="row">
        <div class="col-lg-8 offset-lg-2 siteLocation">HOME</div>
        <div class="userIsLogedIn navbar-expand-lg navbar">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown ">
              <a class="nav-link dropdown-toggle userIsLogedIn" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php
                  echo $_SESSION['username'];
                ?>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" onclick="logout()" href="#">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>



    <main>
      <form action="javascript:moveToIdolPage();">
        <div class="input-group mb-3 col-md-8 offset-md-2 col-lg-4 offset-lg-4 xxx">
          <input type="text" class="form-control" id="searchIdol" placeholder="Search...">
          <div class="input-group-append">
            <button class="btn btn-secondary" type="button" onclick="moveToIdolPage()">GO</button>
          </div>
        </div>
      </form>
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <img src="img/checked.png" class="col-lg-4 offset-lg-4 col-sm-3 offset-sm-4" id="exampleModalCenterTitle" alt="">
        </button>
      </div>
      <div class="modal-body text-center">
        <h5>Your request has been received</h5>
        <h5>Final results will be received in 3 days</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
      </div>
    </div>
  </div>
</div>
      <div class="col-md-8 offset-md-2">
        <div class="popularPeople">Instagram profile</div>
      <div class="card card-container">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-3">
              <div class="card card text-center">
                <div class="card-body">
                  <img src="img/laddar.png" class="img-fluid  rounded-circle idolProfilePicture" alt="">
                </div>
              </div>
            </div>
            <div class="col-lg-9">
              <div class="card">
                <div class="card-body">
                  <div class="row text-center">
                    <h1 class="col-lg-7" id="idolName"></h1>
                    <div class="btn-group exploreGroupBtn" role="group" aria-label="Basic example">
                      <button type="button" id="exploreButton" onclick="exploreIdol()" class="btn btn-outline-dark">Explore</button>
                      <button type="button" id="isRobotButton" class="btn btn-secondary" onclick="CheckIfRobot(true)">Is Robot?</button>
                    </div>
                  </div>
                  <div class="row relations text-center">
                    <div class="col-lg-4">
                      <h1 class="followers"></h1>
                      <p>followers</p>
                    </div>
                    <div class="col-lg-4">
                        <h1 class="following"></h1>
                        <p>following</p>
                    </div>
                    <div class="col-lg-4">
                      <h1 class="posts"></h1>
                      <p>posts</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
    </main>
    <footer class="text-center">
      <small>TRUE STORY | ALL RIGHTS RESERVED</small>
    </footer>
    <script>
      $(document).ready(function(){getIdol();autoComplete();});
    </script>
  </body>
</html>
