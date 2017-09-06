<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = May 24,2005                  =
// Filename: bom.php                           =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Displays BOMs                               =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'bom';
$page="BOM";
// $_SESSION['pageval'] = "BOM";
//////session_register('pagename');
$userrole = $_SESSION['userrole'];
$dept=$_SESSION['department'];
$cond0 = "b.bomnum like '%'";
$cond1 = "b.crn like '%'";
$cond2 = "b.crn like '%'";
$cond3 = "b.`status` = 'Active'";

$oper2='like';
$oper3='like';
$oper4='like';

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 ;
if ( isset ( $_REQUEST['final_bom'] ) )
{
$finalbom_match = $_REQUEST['final_bom'];
if ( isset ( $_REQUEST['bom_oper'] ) ) {
$oper2 = $_REQUEST['bom_oper'];
}
else {
$oper2 = 'like';
}
if ($oper2 == 'like') {
$final_bom = "'" . $_REQUEST['final_bom'] . "%" . "'";
}
else {
$final_bom = "'" . $_REQUEST['final_bom'] . "'";
}

$cond0 = "b.bomnum " . $oper2 . " " . $final_bom;

}
else {
$finalbom_match = '';
}
if ( isset ( $_REQUEST['final_crn'] ) )
{
$finalcrn_match = $_REQUEST['final_crn'];
if ( isset ( $_REQUEST['crn_oper'] ) ) {
$oper3 = $_REQUEST['crn_oper'];
}
else {
$oper3 = 'like';
}
if ($oper3 == 'like') {
$final_crn = "'" . $_REQUEST['final_crn'] . "%" . "'";
}
else {
$final_crn = "'" . $_REQUEST['final_crn'] . "'";
}

$cond1 = "b.crn " . $oper3 . " " . $final_crn;

}
else {
$finalcrn_match = '';
}

if ( isset ( $_REQUEST['final_assypart'] ) )
{
$finalassypart_match = $_REQUEST['final_assypart'];
if ( isset ( $_REQUEST['part_oper'] ) ) {
$oper4 = $_REQUEST['part_oper'];
}
else {
$oper4 = 'like';
}
if ($oper4 == 'like') {
$final_assypart = "'" . $_REQUEST['final_assypart'] . "%" . "'";
}
else {
$final_assypart = "'" . $_REQUEST['final_assypart'] . "'";
}

$cond2 = "b.assy_partnum " . $oper4 . " " . $final_assypart;

}
else {
$finalassypart_match = '';
}


if(isset ($_REQUEST['status_val'] ) )
{
$sval = $_REQUEST['status_val'];

if ($sval== 'Active')
{
$cond3 = "(b.`status` = '" . $sval . "' || b.`status` is NULL || b.`status` = '')";
}
else if ($sval == 'Inactive')
{
$cond3 = "b.`status` = '" . $sval . "'" ;
}
else if ($sval == 'All')
{
$cond3 = "(b.`status` like '%' || b.`status` is NULL)";
}
else if ($sval == 'Pending')
{
$cond3 = "b.`status` = '" . $sval . "'" ;
}
}
else
{
$sval = 'Active';
$cond3 = "(b.`status` = '" . $sval . "' || b.`status` is NULL || b.`status` = '')";
}

$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3 ;

$sort11='';
if ( isset ( $_REQUEST['sortfld1'] ) )
{
$sort1 = $_REQUEST['sortfld1'];
if ($sort1=='BOM')
$sort11= "b.bomnum" ;
}

include_once('classes/loginClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

// For paging - Added on Dec 6,04

// how many rows to show per page
$rowsPerPage =20;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if (isset($_REQUEST['page']))
{
//echo "i am set";
$pageNum = $_REQUEST['page'];
}
if (isset($_REQUEST['totpages']))
{
$totpages = $_REQUEST['totpages'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

// First include the class definition
include('classes/userClass.php');
include('classes/bomClass.php');
include('classes/displayClass.php');
$newBOM = new bom;
$newdisplink = new display;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/bom.js"></script>

<html>
<head>
<title>BOM</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='bom.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td></td></tr>
<tr>
<td>
<?php $newdisplink->dispLinks(''); ?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF"> -->
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr><td><span class="heading"><i>Please click on the BOM link for details or to Edit/Delete</i></td></tr>
<tr>
<td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
<tr>
<td bgcolor="#F5F6F5" colspan="3"><span class="heading"><b><center>Search Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=3 align="center"><span class="tabletext">
<button class="stdbtn btn_blue" style="background-color:#2d3e50" onClick="javascript: return searchsort_fields()" >Get</button>
	<!-- <input type= "image" name="Get" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()"> -->
</td>
</tr>
<tr>
<td  bgcolor="#FFFFFF"><span class="labeltext"><b>BOM #</b>
<span class="tabletext"><select name="bom_oper" size="1" width="20">
<?php
if ( isset ( $_REQUEST['bom_oper'] ) ){
$check2 = $_REQUEST['bom_oper'];

if ($check2 =='like'){
?>
<option value>=
<option selected>like
<?php
}else{
?>
<option selected>=
<option value >like

<?php
}
}else{
?>
<option selected>like
<option value>=
<?PHP
}
?>
</select>
<input type="text" name="final_bom" size=10 value="<?php echo $finalbom_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>PRN #</b>
<span class="tabletext"><select name="crn_oper" size="1" width="20">
<?php
if ( isset ( $_REQUEST['crn_oper'] ) ){
$check3 = $_REQUEST['crn_oper'];

if ($check3 =='like'){
?>
<option value>=
<option selected>like
<?php
}else{
?>
<option selected>=
<option value >like

<?php
}
}else{
?>
<option selected>like
<option value>=
<?PHP
}
?>
</select>
<input type="text" name="final_crn" size=10 value="<?php echo $finalcrn_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
<td  bgcolor="#FFFFFF"><span class="labeltext"><b>Part #</b>
<span class="tabletext"><select name="part_oper" size="1" width="20">
<?php
if ( isset ( $_REQUEST['part_oper'] ) ){
$check4 = $_REQUEST['part_oper'];

if ($check4 =='like'){
?>
<option value>=
<option selected>like
<?php
}else{
?>
<option selected>=
<option value >like

<?php
}
}else{
?>
<option selected>like
<option value>=
<?PHP
}
?>
</select>
<input type="text" name="final_assypart" size=15 value="<?php echo $finalassypart_match ?>" onkeypress="javascript: return checkenter(event)">
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF" colspan=3><span class="labeltext"><b>Status =</b>&nbsp;&nbsp;&nbsp;&nbsp;
<span class="tabletext"><select name="status_val" size="1" width="50">
<?php
if ($sval == 'Active')
{
?>
<option selected value="Active">Active
<option value="Inactive">Inactive
<option value="Pending">Pending
<option value="All">All
<?php
}
else if ($sval == 'Inactive')
{
?>
<option selected value="Inactive">Inactive
<option value="Active">Active
<option value="Pending">Pending
<option value="All">All
<?php
}
else if ($sval == 'Pending')
{
?>
<option selected value="Pending">Pending
<option value="Active">Active
<option value="Inactive">Inactive
<option value="All">All
<?php
}
else if ($sval == 'All')
{
?>
<option selected value="All">All
<option value="Active">Active
<option value="Inactive">Inactive
<option value="Pending">Pending

<?php
}
?>
</select>
</td>
<tr>
</table>
<table width=100% border=0>
<div class="contenttitle radiusbottom0">
<h2><span>List of BOMs
<?php
if($dept=='Sales' || $dept=='CAD')
{
?>
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='new_bom.php'" value="New" >
<!-- <a href ="new_bom.php"><img name="Image8" style="float:right" border="0" src="images/new.gif"></a> -->
<?php
}
?>
</h2>
</span>
<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable">
<thead>
<tr>
<th class="head0"><b>BOM #</b></th>
<!--<td bgcolor="#EEEFEE"><span class="heading"><b>BOM Issue</b></td>   -->
<th class="head1"><b>PRN</b></th>
<th class="head0"><b>Assy Part #</b></th>
<th class="head1"><b>Manufactured Items</b></th>
<th class="head0"><b>Status</b></th>
</tr>
</thead>
<?php
$prevcrn_num='#';
$result = $newBOM->getBOM_summary($cond,$offset,$rowsPerPage);
while ($myrow = mysql_fetch_row($result)) {
//if($prevcrn_num != $myrow[3])
//{ $prevcrn_num=$myrow[3];
printf('<td bgcolor="#FFFFFF" align="center"><span class="tabletext"><a href="bom_details.php?bomrecnum=%s">%s</a></td>
<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>',
$myrow[0],$myrow[1],$myrow[3],$myrow[4],$myrow[5],$myrow[7]);
printf('</td>');
// }
/*  else
{
printf('<td bgcolor="#FFFFFF"><span class="tabletext">&nbsp;</td>
<td bgcolor="#FFFFFF"><span class="tabletext">&nbsp;</td>
<td bgcolor="#FFFFFF"><span class="tabletext">&nbsp;</td>
<td bgcolor="#FFFFFF"><span class="tabletext">&nbsp;</td>
<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
<td bgcolor="#FFFFFF"><span class="tabletext">&nbsp;</td>',
$myrow[5]);
printf('</td>');

} */
printf('</tr>');
}
?>
</table>
</td></tr>
</table>
</td>
<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr> -->
</table>


<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr>
<td align=left>
<?php
//  Added on Dec 6,04 for paging

$numrows = $newBOM->getBOMcount($cond,$offset,$rowsPerPage);
// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage);

if (!isset($_REQUEST['page']))
{
$totpages = $maxPage;
}

$self = $_SERVER['PHP_SELF'];

// creating 'previous' and 'next' link
// plus 'first page' and 'last page' link

// print 'previous' link only if we're not
// on page one
if ($pageNum > 1)
{
$page = $pageNum - 1;
$prev = " <a href=\"bom.php?page=$page&totpages=$totpages&final_bom=$finalbom_match&final_crn=$finalcrn_match&final_assypart=$finalassypart_match&status_val=$sval\">[Prev]</a> ";

$first = " <a href=\"bom.php?page=1&totpages=$totpages&final_bom=$finalbom_match&final_crn=$finalcrn_match&final_assypart=$finalassypart_match&status_val=$sval\">[First Page]</a> ";
}
else
{
$prev  = ' [Prev] ';       // we're on page one, don't enable 'previous' link
$first = ' [First Page] '; // nor 'first page' link
}

// print 'next' link only if we're not
// on the last page
if ($pageNum < $totpages)
{
$page = $pageNum + 1;
$next = " <a href=\"bom.php?page=$page&totpages=$totpages&bom=$finalbom_match&final_crn=$finalcrn_match&final_assypart=$finalassypart_match&status_val=$sval\">[Next]</a> ";

$last = " <a href=\"bom.php?page=$totpages&totpages=$totpages&bom=$finalbom_match&final_crn=$finalcrn_match&final_assypart=$finalassypart_match&status_val=$sval\">[Last Page]</a> ";
}
else
{
$next = ' [Next] ';      // we're on the last page, don't enable 'next' link
$last = ' [Last Page] '; // nor 'last page' link
}

if($totpages!=0)
{
//$pageNum=0;
// print the page navigation link
echo "<span class=\"labeltext\">" . $first . $prev . " Showing page <strong>$pageNum</strong> of <strong>$totpages</strong> pages " . $next . $last;
}
else
echo "<span class=\"labeltext\"><align=\"center\">No matching records found";
// End additions on Dec 6,04

?>
</td>
</tr>
</table>
</form>
</body>
</html>
