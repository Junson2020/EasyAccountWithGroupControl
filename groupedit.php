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

$UserListGroup=CheckLevelByLicense($junsonlicense,"GroupSave",1);

?>
<HTML><HEAD>
<meta charset="utf-8">
<script src='//code.jquery.com/jquery-2.1.3.min.js'></script>
<script> 
$(document).ready ( function() {
  $('#edit').click(function() {
    $.ajax (
            {
              url:'groupupt.php',
              data:
              {
                groupname: $('#groupname').val(),
                descr:$('#descr').val(),
                power: $('#power').val(),
                chkdel: $('#chkdel:checked').val(),
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
                }else if(response=='POWER') { 
                	alert('Not Modify ~ Power is Number form 11111 to 88888 ~');
                	document.getElementById('AfterEditMessage').innerHTML="MESSAGE: Not Modify ~ Function Error~";
                }else if(response=='OK') { 
                	alert('OK');
                	location.href='grouplist.php';
                }else if(response.indexOf('Deleted') > -1) {
                	alert(response); 
                	location.href='grouplist.php';
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
$GroupData=array();
if($keyitem=="NEW") {
	
}else {
  $GroupData=GetDataList("GETGROUPITEMBYNAME",$keyitem,0);
}

echo "<br><br><br>";
echo "<table cellspacing='1' cellpadding='1' border='1' width='600'>";  
echo " <caption><font color='black' size='3'>Group Edit</font></caption>";
echo "<thead>";
echo "  <tr bgcolor='#e2f5cf' valign='center' align='center'>";
echo "    <th><font size='2'>Item</font></th>";
echo "    <th><font size='2'>Value</font></th>";
echo "  </tr>";
echo "</thead>";

echo "<tbody>";

echo " <tr>";
echo "  <td>Group Name</td>";
if($keyitem=='NEW') {
	$GroupData[0][$JUNSON_DESCR]="";
	$GroupData[0][$JUNSON_GROUPLIST_STR001]="";	
	echo "  <td><input type='text' id='groupname' size='20' maxlength='20'></td>";
} else {
  echo "  <td>".$keyitem."<input type='hidden' id='groupname' value='".$keyitem."'></td>";
}
echo " </tr>";

echo " <tr>";
echo "  <td>Description</td>";
echo "  <td><input type='text' id='descr' value='".$GroupData[0][$JUNSON_DESCR]."' size='100' maxlength='150'></td>";
echo " </tr>";

echo " <tr>";
echo "  <td>Power</td>";
echo "  <td><input type='text' id='power' value='".$GroupData[0][$JUNSON_GROUPLIST_STR001]."' size='5' maxlength='5'></td>";
echo " </tr>";

echo " <tr>";
echo "  <td>DeleteGroup</td>";
echo "  <td><input type='checkbox' id='chkdel' value='1'><font color='red'>Will Delete This Group</font></td>";
echo " </tr>";

$keyA="GROUPEDIT";
$randsnA=insRandKey($keyA,$keyitem,$junsonlicense);
echo "<input type='hidden' id='randkey' name='randkey' value='".$randsnA."'>";

echo " <tr>";
echo "  <td>Action</td>";
if($keyitem=='NEW') { $action='Add'; } else { $action='Modify'; }
echo "  <td><input name='edit' id='edit' type='submit' value='".$action."' >";
echo " </tr>";

echo " <tr><td colspan='2'>";
echo "  <font color='red'><span id=\"AfterEditMessage\"></span></font>";
echo " </td></tr>";

echo "</tbody>";
echo "</table>"; 

?>
</body>
</HTML>
