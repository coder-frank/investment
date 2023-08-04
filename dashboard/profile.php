<?php 
require_once '../universal/includes/header.php';
require_once '../universal/includes/sidebar.php';
?>

<h3>Bank Details</h3>
<?php
if (isset($_SESSION['message']))
{
        echo '<div class="alert alert-success">'.$_SESSION['message'].'</div>';
        unset($_SESSION['message']);
}
?>

<?php include_once '../inc/bank.php'; ?>

<br>

<?php require_once '../universal/includes/footer.html'; ?>