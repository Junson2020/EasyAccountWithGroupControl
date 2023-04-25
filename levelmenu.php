<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

session_start();
if(isset($_SESSION['junsonlicense'])) { 
	$junsonlicense=$_SESSION['junsonlicense']; 
} else { $junsonlicense=""; }
include_once('globalJunson.inc.php');
include_once($JUNSON_COMMON_INC);
CheckTimeoutByLicense($junsonlicense);

?>
<HTML><HEAD>
<meta charset="utf-8">
</HEAD>
<body class="background">
<?php
	echo "<table border=\"1\">";
	echo " <tr>";
	echo "  <td><a href='levellist.php' target='_blank'>Level List</a></td>";
	echo "  <td><a href='userlevel.php' target='_blank'>Mapping User Level</a></td>";
	echo "  <td><a href='grouplevel.php' target='_blank'>Mapping Group Level</a></td>";
	echo "  <td><a href='logout.php' target='_self'>Logout</a></td>";
	echo " </tr>";
	echo "</table>";

?>
</body>
</HTML>
