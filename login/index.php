<?php
session_start();
require_once '../config/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
  <title>GBI GOD'S GRACE</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/login.css">
  <link rel="icon" href="img/Logo/gbi.png" />
</head>

<body>
  <!-- navBar -->
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark" aria-label="Ninth navbar example">
      <div class="container-xl d-flex justify-content-center align-items-center">
        <a class="navbar-brand fw-bolder" href="#">
          <img src="img/Logo/gbi.png" width="50" height="50" alt="GBI">
          <img src="img/Logo/ggm.png" width="50" height="50" alt="GGM">
        </a>
        <a class="navbar-brand fw-bolder">
          GOD'S GRACE <span class="lighttext">MINISTRY </span>
        </a>
      </div>
    </nav>
  </header>
  <!-- navBar -->

  <!-- isi -->
  <div class="container">
    <div class="login-page">
      <div class="form">
        <!-- Form Registrasi -->
        <!-- <form class="register-form" action="user_simpan.php" method="POST">
          <h2><i class="bi bi-lock-fill"></i> Register</h2>
          <div class="form-group">
            <input type="text" name="username" placeholder="Username*" required="" autocomplete="off">
            <input type="text" name="full_name" placeholder="Full Name*" required="" autocomplete="off">
            <input type="password" name="password" placeholder="Password*" required="" autocomplete="off">
            <button type="submit" class="btn btn-primary">Create</button>
            <p class="message">Already registered?<a href="#">Sign In</a></p>
          </div>
        </form> -->
        <!-- Form Login -->
        <form class="login-form" method="POST">
          <h2><i class="bi bi-lock-fill"></i> ADMIN LOGIN </h2><br>
          <div class="form-group">
            <input type="username" name="username" placeholder="Username" required="" autocomplete="off"><br>
            <input type="password" name="password" placeholder="Password" required="" autocomplete="off"><br><br>
            <!-- <a href="../admin/password.php" class="forgetpass">Forget Password?</a> -->
            <button type="submit" name="login" class="btn btn-primary">Login</button>
            <!-- <p class="message">
              Not registered?<a href="../admin/">Create an account</a>
            </p> -->
          </div>
        </form>
      </div>
    </div>

    <?php

    if (isset($_POST['login'])) {
      $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
      $password = $_POST['password'];

      if (empty($username) || empty($password)) {
        echo "<script>
            alert('Akun tidak ada!!');
            window.history.back();
          </script>";
      } else {
        // Cek username
        $cek = $con->prepare("SELECT * FROM user WHERE username = :username");
        $cek->bindParam(':username', $username);
        $cek->execute();
        $jml = $cek->rowCount();
        $data = $cek->fetch();

        if ($jml > 0) {
          // Username ada, cek password
          if (password_verify($password, $data['password'])) {
            // Password benar, buat session
            $_SESSION['user-websitegereja'] = $data['username'];
            $_SESSION['role-websitegereja'] = $data['role'];
            $_SESSION['full_name-websitegereja'] = $data['full_name'];

            // Jika role adalah admin, tampilkan pesan selamat datang admin
            if ($data['role'] == 'ADMIN') {
              echo "<script>
                  alert('Selamat Datang, Admin!!!');
                  window.location.href = 'admin/index.php';
                </script>";
            } else {
              // Jika role bukan admin, tampilkan pesan selamat datang pengguna biasa
              echo "<script>
                  alert('Maaf, anda bukan admin');
                  window.history.back();
                </script>";
            }
          } else {
            // Password salah
            echo "<script>
              alert('Password salah');
              window.history.back();
            </script>";
          }
        } else {
          // Username tidak ada
          echo "<script>
            alert('Username salah');
            window.history.back();
          </script>";
        }
      }
    }
    ?>

  </div>
  <!-- isi -->

  <!-- footer -->
  <div>
    <footer class="link-light bg-dark fixed-bottom">
      <div class="mx-0 p-3 row justify-content-between">
        <div class="col-auto">
          <small>
            &copy; <script>
              document.write(new Date().getFullYear());
            </script> GOD'S GRACE
          </small>
        </div>
        <div class="col-auto">
          <div>
            <a target="_blank" class="socialfooter" href="https://www.facebook.com/church.grace.940" title="Facebook GBI">
              <img draggable="false" src="img/Logo/facebook.png" width="30" height="30" alt="FB">
            </a>
            <a target="_blank" class="socialfooter" href="https://www.instagram.com/gbigodsgrace" title="Instagram GBI">
              <img draggable="false" src="img/Logo/instagram.png" width="30" height="30" alt="IG">
            </a>
          </div>
        </div>
      </div>
    </footer>
  </div>
  <!-- footer -->

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://kit.fontawesome.com/08f3c3a570.js" crossorigin="anonymous"></script>
  <script src="../assets/js/login.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
  </script>
</body>

</html>