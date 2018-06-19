<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  //  echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
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
    <link href="https://fonts.googleapis.com/css?family=Orbitron|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
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
        <div class="col-lg-8 offset-lg-2">HOME</div>
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
      <div class="col-lg-8 offset-lg-2">
      <div class="popularPeople">My Searches</div>
      <div class="card card-container">
        <div class="card-body">
          <div class="loadingSpin"></div>
          <div class="row idolsToInspect">
            <div class="col-sm-4 template">
              <div class="card card text-center">
                <div class="card-body">
                  <img src="" class="img-fluid col-md-7 rounded-circle" alt="">
                  <p class="card-text">maorbuzaglo</p>
                  <p class="card-text">Maor Buzaglo</p>
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="" class="btn btn-secondary btn-sm">Inspect</a>
                    <button type="button" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
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
      $(document).ready(function(){getMyIdols();autoComplete();});
    </script>
  </body>
</html>
