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
    <link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/echarts.min.js"></script>
    <script src="js/fontawesome-all.min.js"></script>
    <script src="js/scripts.js"></script>
  </head>
  <body>
    <header>
      <div class="col-md-2">
          <a href="home.php"><img src="img/TS-logo.png" class="img-fluid" alt=""></a>
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
    <div class="search">
      <form action="javascript:moveToIdolPage();">
        <div class="form-group col-md-8 offset-md-2 col-lg-4 offset-lg-4">
          <input type="text" class="form-control" id="searchIdol" placeholder="search...">
        </div>
      </form>
    </div>
    <main>
      <div class="col-lg-8 offset-lg-2">
      <div class="popularPeople">POPULAR PEOPLE</div>
      <div class="card card-container">
        <div class="card-body">
          <div class="row col-md-10 offset-md-1">
            <div class="col-sm-4">
              <div class="card card text-center">
                <div class="card-body">
                  <img src="img/maor.png" class="img-fluid col-md-11" alt="">
                  <p class="card-text">maorbuzaglo</p>
                  <p class="card-text">Maor Buzaglo</p>
                  <a href="#" class="btn btn-dark btn-sm">Inspect</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card card text-center">
                <div class="card-body">
                  <img src="img/static.png" class="img-fluid col-md-11" alt="">
                  <p class="card-text">static</p>
                  <p class="card-text">Static</p>
                  <a href="#" class="btn btn-dark btn-sm">Inspect</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card card text-center">
                <div class="card-body">
                  <img src="img/bar.png" class="img-fluid col-md-11" alt="">
                  <p class="card-text">barrefaeli</p>
                  <p class="card-text">Bar Refaeli</p>
                  <a href="#" class="btn btn-dark btn-sm">Inspect</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card card text-center">
                <div class="card-body">
                  <img src="img/bar.png" class="img-fluid col-md-11" alt="">
                  <p class="card-text">barrefaeli</p>
                  <p class="card-text">Bar Refaeli</p>
                  <a href="#" class="btn btn-dark btn-sm">Inspect</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </main>
    <footer>

    </footer>
    <script>
      $(document).ready(function(){getMyIdols()});
    </script>
  </body>
</html>
