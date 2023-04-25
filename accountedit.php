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

$keytmp=explode("~",$keyitem);
if(count($keytmp)!=2) { echo "ERROR: Parameter Fail ~"; exit; }
if(isset($keytmp[0])) { $modifiedAccount=$keytmp[0]; } else { $modifiedAccount=""; }
if(isset($keytmp[1])) { $modifiedGroup=$keytmp[1]; } else { $modifiedGroup=""; }

$UserListLevel=CheckLevelByLicense($junsonlicense,"UserEdit",1);
$UserID=GetAccountByLicense($junsonlicense);
$UserGROUP=GetAccountGroupByLicense($junsonlicense);

$GroupPower=array();
GetGroupPower($GroupPower);
$GroupItem=array();
$GroupItem=GetDataList("GETGROUPITEM",'','');

$tg=array();
$nGroup=count($GroupItem);
$n=0;
for($i=0;$i < $nGroup;$i++) {
	$tgroup=$GroupItem[$i][$JUNSON_ACCOUNTEDIT_STR001];
	$getflag=0;
	if($UserID==$modifiedAccount) {
		if($GroupPower[$tgroup] <= $GroupPower[$UserGROUP]) { $getflag=1; }
	}elseif($UserGROUP=='root') {  
		if($GroupPower[$tgroup] <= $GroupPower[$UserGROUP]) { $getflag=1; }
	}else {
    if($GroupPower[$tgroup] < $GroupPower[$UserGROUP]) { $getflag=1; }
  }
  if($getflag==1) { $tg[$n]=$tgroup; $n++;}
}

?>
<HTML><HEAD>
<meta charset="utf-8">
<script src='//code.jquery.com/jquery-2.1.3.min.js'></script>
<script> 
$(document).ready ( function() {
  $('#edit').click(function() {
    $.ajax (
            {
              url:'accountupt.php',
              data:
              { userid: $('#userid').val(),
                account: $('#account').val(),
                pswd:$('#pswd').val(),
                pswd2: $('#pswd2').val(),
                uname: $('#uname').val(),
                ucell: $('#ucell').val(),
                uemail: $('#uemail').val(),
                ugroup: $('#ugroup').val(),
                ulang: $('#ulang').val(),
                stopyn: $('#stopyn').val(),
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
                }else if(response=='VPSWD') { 
                	alert('Not Modify ~ Password Verify Not Match~');
                	document.getElementById('AfterEditMessage').innerHTML="MESSAGE: Not Modify ~ Password Verify Not Match~";
                }else if(response=='EPSWD') { 
                	alert('Not Modify ~ Password Empty~');
                	document.getElementById('AfterEditMessage').innerHTML="MESSAGE: Not Modify ~ Password Empty~";
                }else if(response=='NODEL') { 
                	alert('Not Modify ~ Delete Not Permit~');
                	document.getElementById('AfterEditMessage').innerHTML="MESSAGE: Not Modify ~ Delete Not Permit~";
                }else if(response=='NOEDIT') { 
                	alert('Not Modify ~ Modify Not Permit~');
                	document.getElementById('AfterEditMessage').innerHTML="MESSAGE: Not Modify ~ Modify Not Permit~";
                }else if(response=='OK') { 
                	alert('OK');
                	location.href='accountlist.php';
                }else if(response.indexOf('Deleted') > -1) {
                	alert(response); 
                	location.href='accountlist.php';
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
$UserData=array();
if($modifiedAccount=="NEW") {
	
}else {
  $UserData=GetDataList("USERLIST",$modifiedAccount,0);
}

echo "<br><br><br>";
echo "<table cellspacing='1' cellpadding='1' border='1' width='600'>";  
echo " <caption><font color='black' size='3'>Account Edit</font></caption>";
echo "<thead>";
echo "  <tr bgcolor='#e2f5cf' valign='center' align='center'>";
echo "    <th><font size='2'>Item</font></th>";
echo "    <th><font size='2'>Value</font></th>";
echo "  </tr>";
echo "</thead>";

echo "<tbody>";

echo " <tr>";
echo "  <td>Account</td>";
if($modifiedAccount=='NEW') {
	$UserData[0][$JUNSON_ACCOUNTEDIT_STR002]="";
	$UserData[0][$JUNSON_ACCOUNTLIST_STR004]="";
	$UserData[0][$JUNSON_ACCOUNTLIST_STR005]="";
	$UserData[0][$JUNSON_ACCOUNTLIST_STR006]="";
	$UserData[0][$JUNSON_ACCOUNTLIST_STR003]="";
	$UserData[0][$JUNSON_ACCOUNTLIST_STR007]="";
	$UserData[0][$JUNSON_STOPYN]="";
	echo "  <td><input type='text' id='account' size='20' maxlength='20'></td>";
} else {
  echo "  <td>".$modifiedAccount."<input type='hidden' id='account' value='".$modifiedAccount."' ></td>";
}
echo " </tr>";

echo " <tr>";
echo "  <td>Password</td>";
echo "  <td><input type='password' id='pswd' value='".$UserData[0][$JUNSON_ACCOUNTEDIT_STR002]."' size='20' maxlength='20'></td>";
echo " </tr>";

echo " <tr>";
echo "  <td>Password Verify</td>";
echo "  <td><input type='text' id='pswd2' size='20' maxlength='20'></td>";
echo " </tr>";

echo " <tr>";
echo "  <td>Name</td>";
echo "  <td><input type='text' id='uname' value='".$UserData[0][$JUNSON_ACCOUNTLIST_STR004]."' size='20' maxlength='20'></td>";
echo " </tr>";

echo " <tr>";
echo "  <td>Cell Phone</td>";
echo "  <td><input type='text' id='ucell' value='".$UserData[0][$JUNSON_ACCOUNTLIST_STR005]."' size='30' maxlength='30'></td>";
echo " </tr>";

echo " <tr>";
echo "  <td>Email</td>";
echo "  <td><input type='text' id='uemail' value='".$UserData[0][$JUNSON_ACCOUNTLIST_STR006]."' size='50' maxlength='30'></td>";
echo " </tr>";

echo " <tr>";
echo "  <td>Group</td>";
echo "  <td>";
echo "   <select id='ugroup'>";
$n=count($tg);
for($i=0; $i < $n;$i++) {
	if($UserData[0][$JUNSON_ACCOUNTLIST_STR003]==$tg[$i]) { $sel="selected"; } else { $sel=""; }
	echo "<option value='".$tg[$i]."' ".$sel.">".$tg[$i]."</option>";
}
echo "   </select>";
echo "  </td>";
echo " </tr>";

$langtmp[0]="en";

echo "  <td>Language</td>";
echo "  <td>";
echo "   <select id='ulang'>";
$n=count($langtmp);
for($i=0; $i < $n;$i++) {
	if($UserData[0][$JUNSON_ACCOUNTLIST_STR007]==$langtmp[$i]) { $sel="selected"; } else { $sel=""; }
	echo "<option value='".$langtmp[$i]."' ".$sel.">".$langtmp[$i]."</option>";
}
echo "   </select>";
echo "  </td>";
echo " </tr>";

$stoptmp[0]="N";
$stoptmp[1]="Y";
echo "  <td>Active</td>";
echo "  <td>";
echo "   <select id='stopyn'>";
$n=count($stoptmp);
for($i=0; $i < $n;$i++) {
	if($UserData[0][$JUNSON_STOPYN]==$stoptmp[$i]) { $sel="selected"; } else { $sel=""; }
	echo "<option value='".$stoptmp[$i]."' ".$sel.">".$stoptmp[$i]."</option>";
}
echo "   </select>";
echo "  </td>";
echo " </tr>";

echo " <tr>";
echo "  <td>DeleteAccount</td>";
echo "  <td><input type='checkbox' id='chkdel' value='1'><font color='red'>Will Delete This Account</font></td>";
echo " </tr>";

$keyA="ACCOUNTEDIT";
$randsnA=insRandKey($keyA,$modifiedAccount,$junsonlicense);
echo "<input type='hidden' id='randkey' name='randkey' value='".$randsnA."'>";
echo "<input type='hidden' id='userid' name='userid' value='".$UserID."'>";

echo " <tr>";
echo "  <td>Action</td>";
if($modifiedAccount=='NEW') { $action='Add'; } else { $action='Modify'; }
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
