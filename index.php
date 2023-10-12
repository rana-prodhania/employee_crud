<?php
include_once './classes/employee.php';

$employee = new Employee();
if (isset($_POST['add'])) {
  $result = $employee->insert($_POST);
}
if (isset($_POST['edit'])) {
  $result = $employee->update($_POST);
}
$readData = $employee->select();

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <!-- Bootstrap css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- Datatables css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>

<body>
  <div class="container py-5">
    <div class="row">
      <!-- Error Alert -->
      <?php
      if (isset($result)) {
        ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <?php echo $result; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php } ?>
      <!-- / Error Alert -->
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <h5>Employee Data</h5>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
            Add Employee
          </button>
        </div>
        <div class="card-body">
          <table id="example" class="table table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($row = $readData->fetch_assoc()) {

                ?>
                <tr>
                  <td>
                    <?php echo $row['name']; ?>
                  </td>
                  <td>
                    <?php echo $row['email']; ?>
                  </td>
                  <td>
                    <?php echo $row['phone']; ?>
                  </td>
                  <td class="text-center">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                      data-bs-target="#editEmployeeModal-<?php echo $row['id']; ?>">Edit</button>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- Add Employee Modal -->
  <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" method="post">
            <div><input name="id" type="hidden">
              <?php echo $row['id']; ?>
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Name</label>
              <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email</label>
              <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Phone</label>
              <input type="text" name="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <button type="submit" name="add" class="btn btn-primary">Add</button>
          </form>
        </div>

      </div>
    </div>
  </div>

  <?php
  foreach ($readData as $row) {

    ?>

    <!-- Edit Employee Modal -->
    <div class="modal fade" id="editEmployeeModal-<?php echo $row['id']; ?>" tabindex="-1"
      aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" method="post">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input value="<?php echo $row['name']; ?>" type="text" class="form-control" id="exampleInputEmail1"
                  name="name" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input value="<?php echo $row['email']; ?>" type="email" class="form-control" id="exampleInputEmail1"
                  name="email" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Phone</label>
                <input value="<?php echo $row['phone']; ?>" type="text" name="phone" class="form-control"
                  id="exampleInputEmail1" aria-describedby="emailHelp">
              </div>
              <button type="submit" name="edit" class="btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>


  <!-- =============JavaScript==============-->
  <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <!-- Datatables Js-->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <!-- Bootstrap Js-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
  <!-- Custom Js -->
  <script>
    $(document).ready(function () {
      $('#example').DataTable();
    })
  </script>
</body>

</html>