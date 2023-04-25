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
  
$UserListLevel=CheckLevelByLicense($junsonlicense,"UserList",1);
$UserID=GetAccountByLicense($junsonlicense);
$UserGROUP=GetAccountGroupByLicense($junsonlicense);
$GroupPower=array(); GetGroupPower($GroupPower);
$UserList=array(); $UserList=GetDataList("USERLIST",$UserID,$UserListLevel);

echo "<br><br><br>";
echo "<table cellspacing='1' cellpadding='1' border='1' width='800'>";  
echo " <caption><font color='black' size='3'>User List</font></caption>";
echo "<thead>";
if($GroupPower[$UserGROUP] >= $GroupPower[$JUNSON_ACCOUNTLIST_STR001]) {
	$keyA="NEW~viewer";
  $randsnA=insRandKey($keyA,'NEW',$junsonlicense);
	echo "  <tr>";
	echo "      <td colspan='8'><a href='accountedit.php?param=".$randsnA."'><font size='2'>New Account</font></a></td>";
  echo "  </tr>";
}
echo "  <tr bgcolor='#e2f5cf' valign='center' align='center'>";
echo "      <th><font size='2'>Modify</font></th>";
echo "      <th><font size='2'>Account</font></th>";
echo "      <th><font size='2'>Username</font></th>";
echo "      <th><font size='2'>Group</font></th>";
echo "      <th><font size='2'>Cell</font></th>";
echo "      <th><font size='2'>Email</font></th>";
echo "      <th><font size='2'>Language</font></th>";
echo "      <th><font size='2'>Active</font></th>";
echo "  </tr>";
echo "</thead>";

echo "<tbody>";
$n=count($UserList);
for($i=0;$i < $n;$i++) {
	$showflag=0;
	$tmpData=$UserList[$i];
	$tmpGroupA=$tmpData[$JUNSON_ACCOUNTLIST_STR003];
	$tmpGroupB=$UserGROUP;
  if($tmpData[$JUNSON_ACCOUNTLIST_STR002]==$UserID) { $showflag=1; }
  elseif($tmpGroupB==$JUNSON_ROOT) { $showflag=1; }
  elseif($GroupPower[$tmpGroupB] > $GroupPower[$tmpGroupA]) { $showflag=1; }
  else { $showflag=0; }
  if($showflag==1) {
    echo "<tr>";
    $fcol="black";
    $keyA=$tmpData[$JUNSON_ACCOUNTLIST_STR002]."~".$tmpData[$JUNSON_ACCOUNTLIST_STR003];
    $randsnA=insRandKey($keyA,$tmpData[$JUNSON_ACCOUNTLIST_STR002],$junsonlicense);
    echo "<td width='200' align='center'><a href='accountedit.php?param=".$randsnA."'><img src=pencil.png width='24'></img></a></td>";
    echo "<td width='200'><font size='2' color='".$fcol."'>".$tmpData[$JUNSON_ACCOUNTLIST_STR002]."</font></td>"; 
    echo "<td width='200'><font size='2' color='".$fcol."'>".$tmpData[$JUNSON_ACCOUNTLIST_STR004]."</font></td>";
    echo "<td width='200'><font size='2' color='".$fcol."'>".$tmpData[$JUNSON_ACCOUNTLIST_STR003]."</font></td>";
    echo "<td width='200'><font size='2' color='".$fcol."'>".$tmpData[$JUNSON_ACCOUNTLIST_STR005]."</font></td>";
    echo "<td width='200'><font size='2' color='".$fcol."'>".$tmpData[$JUNSON_ACCOUNTLIST_STR006]."</font></td>";
    echo "<td width='200'><font size='2' color='".$fcol."'>".$tmpData[$JUNSON_ACCOUNTLIST_STR007]."</font></td>";
    echo "<td width='200'><font size='2' color='".$fcol."'>".$tmpData[$JUNSON_STOPYN]."</font></td>";
    echo "</tr>";
  }
}

echo "</tbody>";
echo "</table>";

?>
</body>
</HTML>
