<form enctype="multipart/form-data" action="update_image.php" method="post" name="changer">
   Change Profile Photo: <input name="image" accept="image/jpeg" type="file">
  <input value="Submit" type="submit">
  <br><br>
  <!-- <input type="text" value="<?php echo $row['user_image']; ?>" style="width: 100%;" readonly> -->
</form>


=================

//update_image.php

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['id'])) {
  header("location:../login.php?q=<p style='color:red;text-align:center;margin-top:10px;font-size:18px;'>Login to Access</p>");
}

include "db.php";
$id = $_SESSION['id'];

if ($_FILES["image"]["error"] > 0) {
  //  echo "<font size = '5'><font color=\"#e31919\">Error: NO CHOSEN FILE <br />";
  //  echo"<p><font size = '5'><font color=\"#e31919\">INSERT TO DATABASE FAILED";
  header("location:my-profile.php");
} else {
  move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $_FILES["image"]["name"]);
  echo "<font size = '5'><font color=\"#0CF44A\">SAVED<br>";

  $file = "uploads/" . $_FILES["image"]["name"];
  $sql = "update users SET user_image = '$file' WHERE id='$id'";

  $result = $connect->query($sql);

  if ($result) {
    header("location:my-profile.php");
  }
}
