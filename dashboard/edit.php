<?php
  include '../lib/db.php';


  if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $query = mysqli_query($connection, "SELECT * FROM events WHERE id_event='$id'");
    $data = mysqli_fetch_array($query);

    if (isset($_POST['edit_event'])) {
    $event_name = mysqli_real_escape_string($connection, $_POST['event_name']);
    $event_description = mysqli_real_escape_string($connection, $_POST['event_description']);
    $event_date = mysqli_real_escape_string($connection, $_POST['event_date']);

    $query = mysqli_query($connection, "UPDATE events SET event_name='$event_name',
                                                          event_description='$event_description',
                                                          event_date='$event_date'
                                                          WHERE id_event='$id' ");
      if ($query) {
        header('Location: dashboard.php');
      } else {
          $notif = '<div class="alert alert-danger">Gagal Tambah Data</div>';
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

  <div class="container">
    <div class="text-center">
      <h1>Dashboard Events</h1>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
      <div class="card border-0 shadow-lg">
          <div class="card-body">
            <a href="dashboard.php" class="btn btn-success">Kembali Ke Dashboard</a>
            <a href="../index.php" class="btn btn-dark">Lihat Website</a>
            <br><br>
            <h1 class="text-center">Form Edit Event</h1>
            <form method="post">
            <div class="form-group">
              <label for="">Nama Event</label>
              <input type="text" name="event_name" class="form-control" value="<?php echo $data["event_name"]?>">
            </div>
            <div class="form-group">
            <label for="">Deskripsi Event</label>
            <textarea name="event_description" class="form-control" rows="10" cols="30" ><?php echo $data["event_description"]?></textarea>
            </div>
            <div class="form-group">
              <label for="">Tanggal Event</label>
              <input type="date" name="event_date" class="form-control" value="<?php echo $data["event_date"]?>">
            </div>
            <br>
            <button type="submit" class="btn btn-warning" name="edit_event">Update</button>
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
