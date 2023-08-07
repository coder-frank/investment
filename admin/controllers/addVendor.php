<?php
session_start();
if (isset($_SESSION['adminId']) && isset($_POST['addV']))
{
	require_once './core.php';

	// GET POSTED DATA AND SANITIZE
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$message = $_POST['message'];
	$image = $_FILES['image'];

	$targetDirectory = "../../universal/custom/image/"; // Change this to your desired directory path
        $originalFileName = basename($_FILES["image"]["name"]);
        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);

        // Create a unique name based on the current timestamp
        $uniqueName = uniqid() . "." . $extension;

	$add = $admin->addVendor($name, $phone, $message, $uniqueName);
	if ($add == true)
	{
		$targetFilePath = $targetDirectory . $uniqueName;

		// Move the uploaded file to the target directory with the unique name
		if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
			$_SESSION['message'] = "Vendor added successfully";
		} else {
			$_SESSION['message'] = "Error uploading file.";
		}
	} else {
		$_SESSION['message'] = "Something went wrong";
	}
	header("location:../vendors.php");

}