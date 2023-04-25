<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

session_start();
if(isset($_SESSION['junsonlicense'])) { $junsonlicense=$_SESSION['junsonlicense']; } else { $junsonlicense=""; } //echo $junsonlicense;
include_once('globalJunson.inc.php');
include_once($JUNSON_COMMON_INC);
CheckTimeoutByLicense($junsonlicense);

$today=getdate(); $starttime=mktime($today["hours"],$today["minutes"],$today["seconds"],$today["mon"],$today["mday"],$today["year"]);

$data = GetInput();
if(isset($data['param'])) { $param = $data['param']; } else { $param=""; }

if(empty($param) or $param=="") {	echo "ERROR: Parameter Empty ~"; exit; }

$keyitem=GetKeyByRand($param);
if(empty($keyitem) or $keyitem=="") {	echo "ERROR: Item Empty ~"; exit; }

$UserListLevel=CheckLevelByLicense($junsonlicense,"UserLevel",1);

?>
<HTML><HEAD>
<meta charset="utf-8">
<link href="multi-select.css" media="screen" rel="stylesheet" type="text/css">
<script src='//code.jquery.com/jquery-2.1.3.min.js'></script>
<script src='jquery.multi-select.js'></script>
<script> 
$(document).ready ( function() {
	$('#userlevel').multiSelect({
    	selectableHeader: "<div class='custom-header'>Selectable items</div>",
      selectionHeader: "<div class='custom-header'>Selection items</div>"
  });
  $('#edit').click(function() {
    $.ajax (
            {
              url:'userlevelupt.php',
              data:
              {
                userlevel: $('#userlevel').val(),
                account:$('#account').val(),
                randkey: $('#randkey').val()
              },
              error: function(xhr)
              {
                alert('Ajax request Fail~');
              },
              success:function(response)
              { 
                if(response=='EPARA') {
                	alert('Not Modify ~ Parameter Empty~');
                	document.getElementById('AfterEditMessage').innerHTML="MESSAGE: Not Modify ~ Parameter Empty~";
                }else if(response=='EFUNC') { 
                	alert('Not Modify ~ Function Error~');
                	document.getElementById('AfterEditMessage').innerHTML="MESSAGE: Not Modify ~ Function Error~";
                }else if(response=='EFUNC') { 
                	alert('Not Modify ~ Function Error~');
                	document.getElementById('AfterEditMessage').innerHTML="MESSAGE: Not Modify ~ Function Error~";
                }else if(response=='EDENY') { 
                	alert('Not Modify ~ Level Deny Error~');
                	document.getElementById('AfterEditMessage').innerHTML="MESSAGE: Not Modify ~ Level Deny Error~";
                }else if(response=='EDOUB') { 
                	alert('Not Modify ~ USER Level Duplicate Error~');
                	document.getElementById('AfterEditMessage').innerHTML="MESSAGE: Not Modify ~ USER Level Duplicate Error~";
                }else if(response=='OK') { 
                	alert('OK');
                  document.getElementById('#AfterEditMessage').innerHTML=response;
                }else {
                	alert(response);
                	document.getElementById('#AfterEditMessage').innerHTML=response;
                }
              }
    });
  });
});
</script>
</HEAD>
<body>
<?php
$LevelData=array();
$LevelData=GetDataList("GETLEVELITEMALL",$keyitem,0);
$userLevelData=array();
$userLevelData=GetDataList("GETUSERLEVEL",$keyitem,0);

$userLevelStr="";
$n=count($userLevelData);
for($i=0;$i < $n;$i++) {
	if($i==0) { $sp=""; } else { $sp=",";}
	$tmpAry=$userLevelData[$i];
	$userLevelStr=$userLevelStr.$sp.$tmpAry[$JUNSON_LEVELLIST_STR001];
}
echo "<br><br><br>";
echo "<table cellspacing='1' cellpadding='1' border='1' width='800'>";  
echo " <caption><font color='black' size='3'>User Level Edit</font></caption>";
echo "<thead>";
echo "  <tr bgcolor='#e2f5cf' valign='center' align='center'>";
echo "    <th><font size='2'>Item</font></th>";
echo "    <th><font size='2'>Value</font></th>";
echo "  </tr>";
echo "</thead>";

echo "<tbody>";

echo " <tr>";
echo "  <td>Account</td>";
echo "  <td>".$keyitem."<input type='hidden' id='account' value='".$keyitem."'></td>";
echo " </tr>";

echo "  <td>Level</td>";
echo "  <td>";
echo "   <select id='userlevel' multiple='multiple'>";
$n=count($LevelData);
for($i=0; $i < $n;$i++) {
	$tmpData=$LevelData[$i];
	if(strpos($userLevelStr,$tmpData[$JUNSON_LEVELLIST_STR001]) >-1) { $sel="selected"; } else { $sel=""; }
	echo "<option value='".$tmpData[$JUNSON_LEVELLIST_STR001]."' ".$sel.">".$tmpData[$JUNSON_LEVELLIST_STR001]."(".$tmpData[$JUNSON_DESCR].")</option>";
}
echo "   </select>";
echo "  </td>";
echo " </tr>";

echo " <tr>";
echo "  <td>Action</td>";
$action='Modify';
echo "  <td><input name='edit' id='edit' type='submit' value='".$action."' >";
echo " </tr>";

$keyA="USERLEVELEDIT";
$randsnA=insRandKey($keyA,$keyitem,$junsonlicense);
echo "<input type='hidden' id='randkey' name='randkey' value='".$randsnA."'>";

echo " <tr><td colspan='2'>";
echo "  <font color='red'><span id=\"AfterEditMessage\"></span></font>";
echo " </td></tr>";

echo "</tbody>";
echo "</table>"; 

?>
</body>
</HTML>
