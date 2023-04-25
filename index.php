<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

session_start();
if(isset($_SESSION['junsonlicense'])) { 
	$junsonlicense=$_SESSION['junsonlicense']; 
} else { $junsonlicense=""; }
include_once('globalJunson.inc.php');
include_once($JUNSON_COMMON_INC);

?>
<HTML><HEAD>
<meta charset="utf-8">
</HEAD>
<body class="background">
<?php
if(empty($junsonlicense) or $junsonlicense=="") {
	header("Location: login.php");
  exit;
}else {
	echo "<table border=\"1\">";
	echo " <tr>";
	echo "  <td><a href='accountlist.php' target='_blank'>Account</a></td>";
	echo "  <td><a href='levelmenu.php' target='_blank'>Level</a></td>";
	echo "  <td><a href='grouplist.php' target='_blank'>Group</a></td>";
	echo "  <td><a href='textencode.php' target='_blank'>TextEnCode</a></td>";
	echo "  <td><a href='logout.php' target='_self'>Logout</a></td>";
	echo " </tr>";
	echo "</table>";
}

?>
</body>
</HTML>
