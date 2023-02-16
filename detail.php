<?php
include 'lib/db.php';

if (isset($_GET['detail'])) {
  $id = $_GET['detail'];

  $query = mysqli_query($connection, "SELECT * FROM events WHERE id_event='$id'");
  $data = mysqli_fetch_array($query);

  if (isset($_POST['daftar'])) {
    $fullname = mysqli_real_escape_string($connection, $_POST['fullname']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);

    $query = mysqli_query($connection, "INSERT INTO user_event(id_event, fullname, phone, email)
                                        VALUES ('$id', '$fullname', '$phone', '$email')");
    if ($query) {
      header('Location: index.php');
    }
  }
}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="index.php">Event Apps</a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="dashboard/dashboard.php">Dashboard</a>
          </li>

        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-dark" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <div class="container">

    <div class="row mt-3">
      <div class="col-md-12">
      <div class="card border-0 shadow-lg">
          <div class="card-body">
            <div class="card-title"><h3 class="text-center"><?= $data['event_name'] ?></h3>
              <p class="card-text">
              <?= $data['event_description'] ?>
              </p>
              <span>Tanggal Event : <?= $data['event_date'] ?></span>
            </div>
            <h3 class="text-center">Form Pendaftaran</h3>
            <form  method="post" autocomplete="off">
              <div class="form-group">
                <label for="">Nama Lengkap</label>
                <input class="form-control" type="text" name="fullname" required>
              </div>
              <div class="form-group">
                <label for="">No Telephone</label>
                <input class="form-control" type="number" name="phone" required>
              </div>
              <div class="form-group">
                <label for="">Email</label>
                <input class="form-control" type="email" name="email" required>
              </div>
              <br>
              <div class="col md-12">
                <div class="form-group">
                  <button class="btn btn-primary btn-block" type="submit" name="daftar" >Kirim</button>
                </div>
              </div>
          </form>

          </div>
        </div>
      </div>


        </div>
      </div>
    </div>
  </div>







    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
  </body>
</html>
