<?php
  include '../lib/db.php';

  if (isset($_POST['add_event'])) {
    $event_name = mysqli_real_escape_string($connection, $_POST['event_name']);
    $event_description = mysqli_real_escape_string($connection, $_POST['event_description']);
    $event_date = mysqli_real_escape_string($connection, $_POST['event_date']);

    $query = mysqli_query($connection, "INSERT INTO events(event_name, event_description, event_date)
                          VALUES('$event_name','$event_description','$event_date')");
      if ($query) {
        $notif = '<div class="alert alert-success">Berhasil Tambah Data</div>';
      } else {
          $notif = '<div class="alert alert-danger">Gagal Tambah Data</div>';
      }
  }

  if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = mysqli_query($connection, "DELETE FROM events WHERE id_event='$id'");
    if ($query) {
      $notifDelete = '<div class="alert alert-success">Berhasil Hapus Data</div>';
    } else{
      $notifDelete = '<div class="alert alert-danger">Gagal Hapus Data</div>';
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
      <div class="col-md-7">
      <div class="card border-0 shadow-lg">
        <?php
        if (isset($notif)) {
          echo $notif;
        }else if(isset($notifDelete)){
          echo $notifDelete;
        }

        ?>
          <div class="card-body">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEvent">Tambah Event</button>
            <a href="../index.php" class="btn btn-dark">Lihat Website</a>
            <br><br>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Nama Event</th>
                <th>Deskripsi Event</th>
                <th>Tanggal Event</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = mysqli_query($connection, "SELECT * FROM events");
              while($data = mysqli_fetch_array($query)){
               ?>
              <tr>
                <td><?php echo $data['event_name'] ?></td>
                <td><?php echo $data['event_description'] ?></td>
                <td><?php echo $data['event_date'] ?></td>
                <td>
                  <div class="btn-group">
                    <button id="actionbtn" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-hashpopup="true" aria-expanded="false">
                      Action Button
                    </button>
                    <div class="dropdown-menu" aria-labelledby="actionbtn">
                      <a href="edit.php?edit=<?php echo $data['id_event'] ?>" class="dropdown-item">Edit</a>
                      <a href="dashboard.php?delete=<?php echo $data['id_event'] ?>" class="dropdown-item">Hapus</a>
                    </div>
                  </div>
                </td>
              </tr>
            <?php } ?>
            </tbody>

          </table>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="card border-0 shadow-lg">
          <div class="card-body">
            <div class="card-title"><h3>List User Events</h3>
              <ul class="list-group">
                <?php
                $query = mysqli_query($connection, "SELECT * FROM user_event INNER JOIN events ON events.id_event=user_event.id_event");
                while($data = mysqli_fetch_array($query)){
                 ?>
                <li class="list-group-item"><span class="badge text-bg-primary"><?= $data['event_name'] ?></span> / <?= $data['fullname'] ?> / <?= $data['email'] ?></li>
              <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>

        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="modalEvent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Form Tambah Event</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form method="post">
      <div class="modal-body">
        <div class="form-group">
          <label for="">Nama Event</label>
          <input type="text" name="event_name" class="form-control" required>
        </div>
        <div class="form-group">
        <label for="">Deskripsi Event</label>
        <textarea name="event_description" class="form-control" rows="10" cols="30" required></textarea>
        </div>
        <div class="form-group">
          <label for="">Tanggal Event</label>
          <input type="date" name="event_date" class="form-control" required>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="add_event">Simpan</button>
      </div>
        </form>
    </div>
  </div>
</div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
  </body>
</html>
