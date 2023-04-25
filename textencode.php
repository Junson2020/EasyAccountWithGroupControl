<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

session_start();
if(isset($_SESSION['junsonlicense'])) { $junsonlicense=$_SESSION['junsonlicense']; } else { $junsonlicense=""; } //echo $junsonlicense;
include_once('globalJunson.inc.php');
include_once($JUNSON_COMMON_INC);
CheckTimeoutByLicense($junsonlicense);

$UserListLevel=CheckLevelByLicense($junsonlicense,"ENcode",1);

$today=getdate(); $starttime=mktime($today["hours"],$today["minutes"],$today["seconds"],$today["mon"],$today["mday"],$today["year"]);

$data = GetInput();
if(isset($data['randkey'])) { $param = $data['randkey']; } else { $param=""; }
if(isset($data['keyword'])) { $keyword = $data['keyword']; } else { $keyword=""; }

if($keyword!='') {
  $keyitem=GetKeyByRand($param);
  if(empty($keyitem) or $keyitem=="") {	
	  echo "ERROR: Item Empty ~"; exit; 
  }else {
	  if($keyitem!="ENCODE") { echo "Function Error~"; exit; }
    echobr("Keyword => ".$keyword);
    echobr("Code => ".enCodeText($keyword));
    exit;
  }
}else {  
}

?>
<HTML><HEAD>
<meta charset="utf-8">
</HEAD>
<body>
<?php

echo "<br><br><br>";
echo "<form method='post' action='textencode.php' name='textencode'>";
echo "<table cellspacing='1' cellpadding='1' border='1' width='500'>";  
echo " <caption><font color='black' size='3'>Encode Text</font></caption>";
echo "<thead>";
echo "  <tr bgcolor='#e2f5cf' valign='center' align='center'>";
echo "    <th><font size='2'>Item</font></th>";
echo "    <th><font size='2'>Value</font></th>";
echo "  </tr>";
echo "</thead>";

echo "<tbody>";

echo " <tr>";
echo "  <td>Keyword</td>";
echo "  <td><input type='text' name='keyword' id='keyword' size='20' maxlength='30'></td>";
echo " </tr>";

$keyA="ENCODE";
$randsnA=insRandKey($keyA,$keyA,$junsonlicense);
echo "<input type='hidden' id='randkey' name='randkey' value='".$randsnA."'>";

echo " <tr>";
echo "  <td>Action</td>";
$action='GO';
echo "  <td><input name='edit' id='edit' type='submit' value='".$action."' >";
echo " </tr>";

echo "</tbody>";
echo "</table>"; 
echo "</form>";
?>
</body>
</HTML>
