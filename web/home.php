<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  //  echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
} else {
    header("Location: /index.html", true, 301);
    exit();
}
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRUE STORY</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Orbitron|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/echarts.min.js"></script>
    <script src="js/fontawesome-all.min.js"></script>
    <script src="js/scripts.js"></script>
  </head>
  <body>
    <header>
        <div class="col-lg-2">
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
                <a class="dropdown-item" onclick="logout()" href="#">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <main>
      <form action="javascript:searchResult();">
        <div class="input-group mb-3 col-md-8 offset-md-2 col-lg-4 offset-lg-4 xxx">
          <input type="text" autocomplete="off" class="form-control" id="searchIdol" placeholder="Search...">
          <div class="input-group-append">
            <button class="btn btn-secondary" type="button" onclick="searchResult()">GO</button>
          </div>
        </div>
      </form>
      <div class="input-group mb-3 col-md-8 offset-md-2 col-lg-4 offset-lg-4 sResultContainer">
        <div class="card col-lg-12">
          <div class="card-body searchResultContainer">
            <a class="dropdown-item searchResultTemplate" href="#">
              <div class="row">
                <div class="col-lg-9">
                  <p></p>
                  <small></small>
                </div>
                <div class="col-lg-3">
                  <img src="img/laddar.png" class=" img-fluid rounded-circle" alt="">
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-8 offset-lg-2">
      <div class="popularPeople">My Searches</div>
      <div class="card card-container">
        <div class="card-body">
          <div class="loadingSpin"></div>
          <div class="row idolsToInspect">
            <div class="col-sm-10 col-lg-4 template">
              <div class="card card text-center">
                <div class="card-body">
                  <img src="" class="img-fluid col-lg-7 rounded-circle" alt="">
                  <p class="card-text"></p>
                  <p class="card-text"></p>
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="" class="btn btn-secondary btn-sm">Show result</a>
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
