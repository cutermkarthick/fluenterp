<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Oct 23, 2005                 =
// Filename: getbom.php                        =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
//            Coded By  Suresh Devadiga        =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
// First include the class definition

include('classes/userClass.php');
include('classes/bomClass.php');
include('classes/displayClass.php');
$newBOM = new bom;
$newdisplink = new display;

?>

<link rel="stylesheet" href="style.css">


<html>
<head>
<title>BOM</title>

</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='getbom.php' method='post' enctype='multipart/form-data'>
<table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >

<table>
<tr><td><span class="pageheading"><b>List of BOM</b></td></tr>
<tr><td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<tr  bgcolor="#FFCC00">
     <td bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
     <td  bgcolor="#EEEFEE"><span class="tabletext"><b>BOM #</b></td>
     <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Date</b></td>
     <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Customer Name</b></td>
     <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Description</b></td>
     <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Amount</b></td>
     <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Status</b></td>
</tr>
</table>
   <!-- <div style="overflow-y: scroll; width: 100%; height: 50%;"> -->
   <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
   <tr> 
	   <input type="hidden" name="bomnum">
	   <input type="hidden" name="bomrecnum">

<?php
       $result = $newBOM->getAllBOMs();
	   // echo "<br>here $result";
	   // echo '<br>---'.mysql_num_rows($result).'<br/>';

       while ($myrow = mysql_fetch_array($result)) {
			// echo "<br>inside while";
?>            
          <tr bgcolor="#FFFFFF">
          <td bgcolor="#FFFFFF"><input type="radio" name="solutions"
             value="<?php echo $myrow[0] ;?>" 
			 onclick="javascript :setvalues(<?php echo  "$myrow[7],'$myrow[0]'";?>)"></td>
	      <td><span class="tabletext"><?php echo $myrow[1] ?></td>
		  <td><span class="tabletext"><?php echo $myrow[15] ?></td>
		  <td><span class="tabletext"><?php echo $myrow[3] ?></td>
		  <td><span class="tabletext"><?php echo $myrow[5] ?></td>
		  <td><span class="tabletext"><?php echo $myrow[6] ?></td>
          </td></tr>
<?php
        }
?>

</table>
 </div>
<script langauge="javascript">
function setvalues(inpbomrecnum,inpbomnum)
{
var bomrecnum=inpbomrecnum;
var bomnum=inpbomnum;
document.forms[0].bomrecnum.value=bomrecnum;
document.forms[0].bomnum.value=bomnum;
}

function SubmitReason(ctype) {

window.opener.SetBOMNo(document.forms[0].bomrecnum.value,document.forms[0].bomnum.value);
self.close();}

</script>
<input type=button value="Submit" onclick=" javascript: return SubmitReason(window.name)">
      </FORM>
</td></tr>
</table>
</table>
<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
<td align=left>
</td>
</tr></table>
</body>
</html>
