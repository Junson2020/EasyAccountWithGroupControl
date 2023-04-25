<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

session_start();
if(isset($_SESSION['junsonlicense'])) { $junsonlicense=$_SESSION['junsonlicense']; } else { $junsonlicense=""; } //echo $junsonlicense;
include_once('globalJunson.inc.php');
include_once($JUNSON_COMMON_INC);
CheckTimeoutByLicense($junsonlicense);

?>
<HTML><HEAD>
<meta charset="utf-8">
</HEAD>
<body>
<?php

$today=getdate(); $starttime=mktime($today["hours"],$today["minutes"],$today["seconds"],$today["mon"],$today["mday"],$today["year"]);
  
$LevelListLevel=CheckLevelByLicense($junsonlicense,"LevelList",0);
$LevelList=array(); $LevelList=GetDataList("GETLEVELITEMALL",'',$LevelListLevel); 

echo "<br><br><br>";
echo "<table cellspacing='1' cellpadding='1' border='1' width='800'>";  
echo " <caption><font color='black' size='3'>Level List</font></caption>";
echo "<thead>";
	$keyA="NEW";
  $randsnA=insRandKey($keyA,'NEW',$junsonlicense);
	echo "  <tr>";
	echo "      <td colspan='8'><a href='leveledit.php?param=".$randsnA."'><font size='2'>New Level</font></a></td>";
  echo "  </tr>";
echo "  <tr bgcolor='#e2f5cf' valign='center' align='center'>";
echo "      <th><font size='2'>Modify</font></th>";
echo "      <th><font size='2'>LevelName</font></th>";
echo "      <th><font size='2'>Description</font></th>";
echo "      <th><font size='2'>Active</font></th>";
echo "  </tr>";
echo "</thead>";

echo "<tbody>";
$n=count($LevelList);
for($i=0;$i < $n;$i++) {
	$tmpData=$LevelList[$i];
    echo "<tr>";
    $fcol="black";
    $keyA=$tmpData[$JUNSON_LEVELLIST_STR001];
    $randsnA=insRandKey($keyA,$tmpData[$JUNSON_LEVELLIST_STR001],$junsonlicense);
    echo "<td width='200' align='center'><a href='leveledit.php?param=".$randsnA."'><img src=pencil.png width='24'></img></a></td>";
    echo "<td width='200'><font size='2' color='".$fcol."'>".$tmpData[$JUNSON_LEVELLIST_STR001]."</font></td>"; 
    echo "<td width='200'><font size='2' color='".$fcol."'>".$tmpData[$JUNSON_DESCR]."</font></td>"; 
    echo "<td width='200'><font size='2' color='".$fcol."'>".$tmpData[$JUNSON_STOPYN]."</font></td>";
    echo "</tr>";
}

echo "</tbody>";
echo "</table>";

?>
</body>
</HTML>
