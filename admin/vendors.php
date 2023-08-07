<?php
require_once './includes/header.php';
require_once './includes/sidebar.php';
?>
    <?php
    if (isset($_SESSION['message']))
    {
     echo '<div class="alert alert-success">'.$_SESSION['message'].'</div>';
     unset($_SESSION['message']);
    }
    ?>

<h3>Add Recharge code vendors</h3>
<br><br>

<form action="./controllers/addVendor.php" method="post" enctype="multipart/form-data">
<div class="mb-3">
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Fullname" name="name">
</div>
<div class="mb-3">
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Phone number (+234 9066775687)" name="phone">
</div>
<div class="mb-3">
  <input type="file" class="form-control" id="exampleFormControlInput1" placeholder="Image" name="image">
</div>
<div class="mb-3">
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message" placeholder="Message"></textarea>
</div>
<button class="btn btn-primary" type="submit" name="addV">Add Vendor</button>
</form>
<br><br>

<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>S/N</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Message</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php include_once './includes/getV.php'; ?>
    </tbody>
  </table>
</div>
<?php require_once './includes/footer.html'; ?>