<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    //echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
} else {
    header("Location: /index.php", true, 301);
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
    <link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/echarts.min.js"></script>
    <script src="js/fontawesome-all.min.js"></script>
    <script src="js/scripts.js"></script>
  </head>
  <body>
    <header>
      <div class="col-lg-2">
            <a href="home.php"><img src="img/TS-logo-white.png" class="img-fluid col-lg-10" alt=""></a>
      </div>
    </header>
    <nav>
      <div class="row">
        <div class="col-lg-8 offset-lg-2 siteLocation">HOME > RESULT </div>
        <div class="userIsLogedIn navbar-expand-lg navbar">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown ">
              <a class="nav-link dropdown-toggle userIsLogedIn" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php
                  echo $_SESSION['username'];
                ?>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" onclick="logout()" href="#">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="search">
      <div class="card col-md-4 offset-md-4">
        <div class="card-body text-center robotsPercentage">
          <p id="botsDetails"></p>
        </div>
      </div>
    </div>
    <div class="floatingDiv text-center">
    <img src="img/laddar.png" id="profileImg" alt="" class="img-fluid rounded-circle floatingImg">
    <p id="ResultUsername"></p>
  </div>
    <main class="resultMain">
      <div class="col-md-9 offset-md-3 card chartCard">
        <div class="card-body chartCard">
          <div class="row">
            <div id="main"></div>
            <div class="">
              <h5 id="isFinalResult" class="resultInfo"></h5>
              <p id="profilesDetect" class="resultInfo"></p>
              <p id="certainty" class="resultInfo"></p>
              <p id="idolFollowers" class="resultInfo"></p>
              <p id="idolFollowing" class="resultInfo"></p>
              <p id="idolMedia" class="resultInfo"></p>
            </div>
          </div>
        </div>
      </div>
    </main>
    <footer class="text-center">
      <small>TRUE STORY | ALL RIGHTS RESERVED</small>
    </footer>
    <script>
      $(document).ready(function(){ showResult('followers')});
    </script>
  </body>
</html>
