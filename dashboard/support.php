<?php 
require_once '../universal/includes/header.php';
require_once '../universal/includes/sidebar.php';
?>

<h2><b>Support</b></h2>
<span>Need our help?</span>
<br><br><b></b>

<form>
  <div class="mb-3">
    <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Full Name">
  </div>

  <div class="mb-3">
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">
  </div>

  <div class="mb-3">
    <input type="text" class="form-control" id="subject" aria-describedby="emailHelp" placeholder="Subject">
  </div>
 
  <div class="mb-3">
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Message"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Send Message</button>
</form>


<?php require_once '../universal/includes/footer.html'; ?>