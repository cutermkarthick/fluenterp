<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Feb 23, 2010                 =
// Filename: assywoEdit.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Allows entry of Assembly Po's               =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
    header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'assyWoEdit';
$page="WO: Assy WO";
//////session_register('pagename');
$dept=$_SESSION['department'];
$assyworecnum = $_REQUEST['assyworecnum'];  

// First include the class definition
//include('classes/assyWoClass.php');
include('classes/displayClass.php');
include('classes/companyClass.php');
include('classes/assywoClass.php');
include('classes/assywoliClass.php');
include('classes/assywoli_operClass.php');
include('classes/bomClass.php');
include('classes/inassyClass.php');
include('classes/assyProcessDetailsClass.php');
//$newassyWo = new assyWo;
$newdisp = new display;
$company = new company;
$assywo = new assywo;
$assywo_li = new assywo_li;
$assywo_oper = new assywo_oper;
$assywo_pdet = new assywoprocessdetails;
$bom = new bom;
$newinassy = new inassy;

$result_assywo = $assywo->getAssyWos($assyworecnum);
$result_assywoprdet = $assywo_pdet->getAssyWoprdet($assyworecnum);

$myrow = mysql_fetch_assoc($result_assywo);
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/assywo.js"></script>

<html>
<head>
<title>Edit Assembly WO</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processAssywo.php' method='post' enctype='multipart/form-data'>
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
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td></td></tr>
<tr>
<td>
<?php
			 $newdisp->dispLinks('');
?>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0>
<tr><td>
<table width=100% border=0>
<tr>
<td><span class="pageheading"><b>Edit Assembly WO</b></td>
</tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFFFFF">
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td>
</tr> </table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Assy WO #</p></font></td>
<td><span class="tabletext"><input type="text"  name="assy_wonum" id="assy_wonum"
style="background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow["assy_wonum"] ?>"></td>
<td><span class="labeltext"><p align="left">WO Date</p></font></td>
<td><span class="tabletext"><input size=10 type="text"  name="wo_date" id="wo_date"
 value="<?php echo $myrow["assydate"] ?>" style="background-color:#DDDDDD;" readonly="readonly">
<?php

if($dept !='QA' && $dept !='PPC5')
{
?>
    <img src="images/bu-getdateicon.gif" onclick="javascript:NewCssCal('wo_date','yyyyMMdd')" style="cursor:pointer"/>
    <?php
}
    ?></td>
	</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Assy WO Qty</p></font></td>
<td><span class="tabletext"><input type="text"  name="assy_woqty" id="assy_woqty" size=8
style="background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow["assyqty"] ?>"></td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Assy Type</p></font></td>
            <td><span class="tabletext"><input type="text" name="assy_type" id="assy_type"
                         readonly="readonly"  style=";background-color:#DDDDDD;" value="<?php echo $myrow["assy_type"] ?>" size="10">
	            <span class="tabletext"><select name="assytype" size="1" width="10" onchange="onSelectType(this)">
 	                 <option value='Select'>Please Specify</option>
	            <option value='Kit'>Kit</option>
	            <option value='Assembly'>Assembly</option>
				<option value='Rework'>Rework</option>
        <option value='Manufacture'>Manufacture</option>
	            </select>
            </td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">PRN</p></font></td>
<td><input type="text" id="crn" name="crn" size=15 value="<?php echo $myrow["crn"] ?>" style="background-color:#DDDDDD;" readonly="readonly">
<?php

if($dept !='QA' && $dept !='PPC5')
{
?>
<img src="images/bu-get.gif" alt="Get CIM" onclick="Getcim()">
<?php
 }
?>
</td>
<td><span class="labeltext"><p align="left">Rework GRN</p></font></td>
<td><span class="tabletext"><input type="text" name="rework_grn" id="rework_grn" size=10 value="<?php echo $myrow["rework_grn"] ?>" style="background-color:#DDDDDD;" readonly="readonly">
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">BOM #</p></font></td>
<td><span class="tabletext"><input type="text" name="bomnum" id="bomnum" size=15 value="<?php echo $myrow["bomnum"] ?>" style="background-color:#DDDDDD;" readonly="readonly">
<td><span class="labeltext"><p align="left">BOM Rev</p></font></td>
<td><span class="tabletext"><input type="text" name="bomiss" id="bomiss" size=10 value="<?php echo $myrow["bomiss"] ?>" style="background-color:#DDDDDD;" readonly="readonly">
</td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Assy Part #</p></font></td>
<td><span class="tabletext"><input type="text"  name="assy_partno" id="assy_partno" size=20 value="<?php echo $myrow["assypartnum"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
<td><span class="labeltext"><p align="left">Assy Part Iss</p></font></td>
<td><span class="tabletext"><input type="text" name="assy_partiss" id="assy_partiss"  size=20 value="<?php echo $myrow["assypartiss"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Dwg No</p></font></td>
<td><span class="tabletext"><input type="text"  name="drg_no" id="drg_no" size=12 value="<?php echo $myrow["drgno"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
<td><span class="labeltext"><p align="left">Drg Iss</p></font></td>
<td><input type="text" name="drg_iss" id="drg_iss"   size=10 value="<?php echo $myrow["drgiss"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">COS #</p></font></td>
<td colspan=3><span class="tabletext"><input type="text"  name="cos_num" id="cos_num" size=12 value="<?php echo $myrow["cosno"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">MPS/APS #</p></font></td>
<td><span class="tabletext"><input type="text"  name="mpsnumber" id="mpsnumber" size=12 value="<?php echo $myrow["mpsnumber"] ?>" style="background-color:#DDDDDD;" readonly="readonly"></td>
<td><span class="labeltext"><p align="left">MPS/APS Rev</p></font></td>
<td><input type="text" name="mpsrev" id="mpsrev"   size=10 value="<?php echo $myrow["mps_rev"] ?>"
style="background-color:#DDDDDD;" readonly="readonly">
<input type="hidden" name="link2mps" id="link2mps" value="<?php echo $myrow["link2mps"] ?>">
<input type="hidden" name="bomrevnum" id="bomrevnum" value="<?php echo $myrow["bomrevnum"] ?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Cust PO#</p></font></td>
<td><span class="tabletext">
<?php

if($dept !='QA' && $dept !='PPC5')
{
?>
<input type="text" size=15 name="cust_ponum" id="cust_ponum" value="<?php echo $myrow["ponum"] ?>" >
<img src="images/bu-getpo.gif" onClick="Getpo('ponum')" id='poimg'>
<?php
}else
{
?>
<input type="text" size=15 name="cust_ponum" id="cust_ponum" style="background-color:#DDDDDD;"
readonly="readonly" value="<?php echo $myrow["ponum"] ?>" >
<?php
}
?>
</td>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PO Qty</p></font></td>
<td><span class="tabletext">
<?php
if($dept !='QA' && $dept !='PPC5')
{
?>
<input type="text"  size=5 name="po_qty" id="po_qty"value="<?php echo $myrow["poqty"] ?>">
<?php
}else
{
?>
<input type="text"  size=5 name="po_qty" id="po_qty" style="background-color:#DDDDDD;"
readonly="readonly" value="<?php echo $myrow["poqty"] ?>">
<?php
}
?>
</td>
</tr>
<input type="hidden" name="page"  id="page" value="edit">

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Customer</p></font></td>
<td width="30%"><input type="hidden"  name="customer" id="customer" size="30" style="background-color:#DDDDDD;"
readonly="readonly" value="<?php echo $myrow['crec']?>" >
<input type="text" name="companyname" id="companyname" size="50" style="background-color:#DDDDDD;"
readonly="readonly" value="<?php echo $myrow['name']?>">
<?php

if($dept !='QA' && $dept !='PPC5')
{
?>
<img src="images/bu-getcustomer.gif" alt="Get Customer" onClick="GetAllCustomers()">
<?php
}
?>
</td>
<td><span class="labeltext"><p align="left">Cust PO Line#</p></font></td>
<td><input type="text" size=5 name="cust_po_line_num" id="cust_po_line_num" style="background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow["cust_po_line_num"] ?>"></td>

</tr>
<tr bgcolor="#FFFFFF">
<?php
if($dept =='QA')
{?>
<td><span class="labeltext"><p align="left">Description</p></font></td>
<td><span class="tabletext"><input type="text" name="descr" id="descr"  size=25 style="background-color:#DDDDDD;"
readonly="readonly" value="<?php echo $myrow["descr"] ?>"></td>
<?php
}
else
{?>
<td><span class="labeltext"><p align="left">Description</p></font></td>
<td><span class="tabletext"><input type="text" name="descr" id="descr"  style="background-color:#DDDDDD;" readonly="readonly" size=25  value="<?php echo $myrow["descr"] ?>"></td>
<?php
}
if($dept =='PPC5')
{?>
<td><span class="labeltext"><p align="left">WO Status</p></font></td>
         <td><input type="text" name="status" id="status" size=8
                        style="background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow["status"]?>">
            <span class="tabletext"><select name="condtype" size="1" width="100" onchange="onSelectcond()">
            <option selected value="Cancelled">Cancelled
			<option value="Closed">Closed
			<option value="Open">Open
           	</select></td>
<?php
}
else
{?>
<td><span class="labeltext"><p align="left">WO Status</p></font></td>
         <td><input type="text" name="status" id="status" size=8
                        style="background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow["status"]?>">
            <span class="tabletext"><select name="condtype" size="1" width="100" onchange="onSelectcond()">
            <option selected value="Open">Open
            <option value="Closed">Closed
            <option value="Cancelled">Cancelled
           	</select></td>
<?php
}
?>
</tr>
<input type="hidden"  name="aps_num" id="aps_num" size=15 style="background-color:#DDDDDD;"
readonly="readonly" value="<?php echo $myrow["apsnum"] ?>">
<input type="hidden" id="aps_iss" name="aps_iss" size=15  style="background-color:#DDDDDD;"
readonly="readonly" value="<?php echo $myrow["apsiss"] ?>">
</tr>

</tr>
</tr>
</table>
<input type="hidden" name="assyworecnum" id="assyworecnum" value=<?php echo $assyworecnum?>>
<br>

</table>
<div id="bomli">

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#DDDEDD">
<td bgcolor="#DDDEDD" colspan=13><span class="heading"><center><b>Part Details</b></center></td>
</tr>
</table>
<div style="width:100%;overflow-x:scroll">
<table id="tablemm" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<td colspan=20><span class="heading"><a href="javascript:addRow4intassy('tablemm',document.forms[0].index.value)">
<img src="images/bu-addrow.gif" border="0"></a></td></tr>

<tr bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE" width=3%><span class="heading"><b>Line#</b></td>
<td bgcolor="#EEEFEE" width=13%><span class="heading"><b>Type</b></td>
<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Item No</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>PRN</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>PRN Type</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Part#</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Part Issue</b></td>
<td bgcolor="#EEEFEE" width=12%><span class="heading"><b>Description</b></td>
<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Qty/Assy</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>UOM</b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b>Qty<br>For WO</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Acc</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Rew</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Ret</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Rej</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>GRN/WO</b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b>Expiry Date</b></td>
<td bgcolor="#EEEFEE" width=15%><span class="heading"><b>Remarks</b></td>
</tr>
<?php

$i=1;
$flag=0;
$result_assyli = $assywo_li->get_assy_Li($assyworecnum);

//while ($i<=5)
//{
   //if($flag == 0)
    //{
      while ($myLI_assy = mysql_fetch_row($result_assyli))
      {

        if($myLI_assy[16] == 'Treated')
        {
          $resultdn = $assywo_li->getdnrecnum4assyli($myLI_assy[8]);
          $myrow = mysql_fetch_row($resultdn);
          
        }
        printf('<tr bgcolor="#FFFFFF">');
        $linenumber="line_num" . $i;
        $itemno="itemno" . $i;
        $partnum="partnum" . $i;
        $issue="issue" . $i;
        $descr="descr" . $i;
        $partiss="partiss" . $i;
        $qty="qty" . $i;
        $uom="uom" . $i;
        $qty_wo="qty_wo" . $i;
        $grn="grn" . $i;
        $exp_date="exp_date" . $i;
        $remarks="remarks_li" . $i;
        $type="type".$i;
        $qty_rew="qty_rew" . $i;
        $qty_rej="qty_rej" . $i;
        $qty_acc="qty_acc" . $i;
        $crn_num4li = "crn_num4li" . $i;
        $prevlinenum="prev_line_num" . $i;
        $lirecnum="lirecnum" . $i;
        $type="type".$i;
        $qty_ret = "qty_ret" . $i;
        $pcrn_num = "pcrn_num" . $i;
        $crn_type = "crn_type" . $i;
        $prev_qty_wo="prev_qty_wo" . $i;
        $dnrecnum="dnrecnum" . $i;

        $avail_qty = "avail_qty" . $i;



   
    echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI_assy[1]\">";
    echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI_assy[0]\">";
     echo "<input type=\"hidden\" name=\"$dnrecnum\" id=\"$dnrecnum\" value=\"$myrow[0]\">";
     echo "<input type=\"hidden\" name=\"$avail_qty\"  id=\"$avail_qty\" value=\"$qty_wo_val\">";
    if($dept !='QA')
    {
     if($myLI_assy[19] =='')
        {
          echo "<td width=3%><span class=\"tabletext\"><input type=\"text\"  name=\"$linenumber\" id=\"$linenumber\" value=\"$myLI_assy[1]\" size=\"3%\"></td>";
        }
        else
        {
          echo "<td width=3%><span class=\"tabletext\"><input type=\"text\"  name=\"$linenumber\" id=\"$linenumber\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  value=\"$myLI_assy[1]\" size=\"3%\"></td>";
        }
   //echo "<td width=3%><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"$myLI_assy[1]\" size=\"3%\" ></td>";
   echo "<td width=13%><span class=\"tabletext\"><input type=\"text\" id=\"$type\"  name=\"$type\"  value=\"$myLI_assy[16]\" size=\"13%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<td width=4%><input type=\"text\" id=\"$itemno\" name=\"$itemno\"  size=\"6%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[2]\">";
   echo "<td width=10%><input type=\"text\" id=\"$crn_num4li\" name=\"$crn_num4li\"  size=\"6%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[15]\">
   <input type=\"hidden\" name=\"$pcrn_num\" size=\"20%\" value=\"$myLI_assy[19]\"></td>";
   echo "<td width=13%><span class=\"tabletext\"><input type=\"text\" id=\"$crn_type\"  name=\"$crn_type\"  value=\"$myLI_assy[20]\" size=\"13%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<td width=10%><input type=\"text\" id=\"$partnum\" name=\"$partnum\"  size=\"20%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[3]\"></td>";
   echo "<td width=10%><input type=\"text\" id=\"$issue\" name=\"$issue\"  size=\"15%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[4]\"></td>";
   echo "<td width=12%><input type=\"text\" id=\"$descr\" name=\"$descr\"  size=\"23%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[12]\"></td>";
   echo "<td width=4%><input type=\"text\" id=\"$qty\" name=\"$qty\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"$myLI_assy[5]\"></td>";
   echo "<td width=6%><input type=\"text\" id=\"$uom\" name=\"$uom\"  size=\"8%\" value=\"$myLI_assy[7]\"></td>";
   echo "<td width=8%><input type=\"text\" id=\"$qty_wo\" name=\"$qty_wo\"  size=\"5%\" value=\"$myLI_assy[6]\">
   <input type=\"hidden\" id=\"$prev_qty_wo\" name=\"$prev_qty_wo\"  size=\"5%\" value=\"$myLI_assy[6]\"></td>";
   echo "<td width=5%><input type=\"text\" id=\"$qty_acc\" name=\"$qty_acc\"  size=\"4%\" value=\"$myLI_assy[18]\"></td>";
   echo "<td width=5%><input type=\"text\" id=\"$qty_rew\" name=\"$qty_rew\"  size=\"4%\" value=\"$myLI_assy[13]\"></td>";
   echo "<td width=5%><input type=\"text\" id=\"$qty_ret\" name=\"$qty_ret\"  size=\"4%\" value=\"$myLI_assy[17]\"></td>";
   echo "<td width=5%><input type=\"text\" id=\"$qty_rej\" name=\"$qty_rej\"  size=\"4%\" value=\"$myLI_assy[14]\"></td>";
   echo "<td width=6%><input type=\"text\" id=\"$grn\" name=\"$grn\"  size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[8]\"><img src=\"images/bu-get.gif\" alt=\"Get CIM\" onclick=\"getgrn_wo($i)\"></td>";
   echo "<td width=8%><input type=\"text\" id=\"$exp_date\" name=\"$exp_date\"  size=\"8%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  value=\"$myLI_assy[10]\">";
   
   ?>

<img src="images/bu-getdateicon.gif" onclick="javascript:NewCssCal('<?php echo "$exp_date";?>','yyyyMMdd')" style="cursor:pointer"/></td>
<?php
   echo "<td width=15%><input type=\"text\" id=\"$remarks\" name=\"$remarks\"  size=\"27%\" value=\"$myLI_assy[11]\"></td>";
 }
 else
 {
   echo "<td width=3%><span class=\"tabletext\"><input type=\"text\"  name=\"$linenumber\" id=\"$linenumber\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  value=\"$myLI_assy[1]\" size=\"3%\"></td>";
   //echo "<td width=3%><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"$myLI_assy[1]\" size=\"3%\" ></td>";
   echo "<td width=13%><span class=\"tabletext\"><input type=\"text\" id=\"$type\"  name=\"$type\"  value=\"$myLI_assy[16]\" size=\"13%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<td width=4%><input type=\"text\" id=\"$itemno\" name=\"$itemno\"  size=\"6%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[2]\">";
   echo "<td width=10%><input type=\"text\" id=\"$crn_num4li\" name=\"$crn_num4li\"  size=\"6%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[15]\">
   <input type=\"hidden\" name=\"$pcrn_num\" size=\"20%\" value=\"$myLI_assy[19]\"></td>";
   echo "<td width=13%><span class=\"tabletext\"><input type=\"text\" id=\"$crn_type\"  name=\"$crn_type\"  value=\"$myLI_assy[20]\" size=\"13%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<td width=10%><input type=\"text\" id=\"$partnum\" name=\"$partnum\"  size=\"20%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[3]\"></td>";
   echo "<td width=10%><input type=\"text\" id=\"$issue\" name=\"$issue\"  size=\"15%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[4]\"></td>";
   echo "<td width=12%><input type=\"text\" id=\"$descr\" name=\"$descr\"  size=\"23%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[12]\"></td>";
   echo "<td width=4%><input type=\"text\" id=\"$qty\" name=\"$qty\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"$myLI_assy[5]\"></td>";
   echo "<td width=6%><input type=\"text\" id=\"$uom\" name=\"$uom\"  size=\"8%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[7]\"></td>";
   echo "<td width=8%><input type=\"text\" id=\"$qty_wo\" name=\"$qty_wo\"  size=\"5%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[6]\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\">
   <input type=\"hidden\" id=\"$prev_qty_wo\" name=\"$prev_qty_wo\"  size=\"5%\" value=\"$myLI_assy[6]\"></td>";
   echo "<td width=5%><input type=\"text\" id=\"$qty_acc\" name=\"$qty_acc\"  size=\"4%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[18]\"></td>";
   echo "<td width=5%><input type=\"text\" id=\"$qty_rew\" name=\"$qty_rew\"  size=\"4%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[13]\"></td>";
   echo "<td width=5%><input type=\"text\" id=\"$qty_ret\" name=\"$qty_ret\"  size=\"4%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[17]\"></td>";
   echo "<td width=5%><input type=\"text\" id=\"$qty_rej\" name=\"$qty_rej\"  size=\"4%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[14]\"></td>";
   echo "<td width=6%><input type=\"text\" id=\"$grn\" name=\"$grn\"  size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[8]\"></td>";
   echo "<td width=8%><input type=\"text\" id=\"$exp_date\" name=\"$exp_date\"  size=\"8%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  value=\"$myLI_assy[10]\">";
   ?>
</td>
<?php
   echo "<td width=15%><input type=\"text\" id=\"$remarks\" name=\"$remarks\"  size=\"27%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[11]\"></td>";
 }
   printf('</tr>');

   $i++;
}

       //echo "<input type=\"hidden\" name=\"oper_flag\" value=1>";
 /*      $flag=1;
  }

 if($dept !='QA')
 {
  printf('<tr bgcolor="#FFFFFF">');
   $linenumber="line_num" . $i;
        $itemno="itemno" . $i;
        $partnum="partnum" . $i;
        $issue="issue" . $i;
        $descr="descr" . $i;
        $partiss="partiss" . $i;
        $qty="qty" . $i;
        $uom="uom" . $i;
        $qty_wo="qty_wo" . $i;
        $grn="grn" . $i;
        $exp_date="exp_date" . $i;
        $remarks="remarks_li" . $i;
        $type="type".$i;
        $qty_rew="qty_rew" . $i;
        $qty_rej="qty_rej" . $i;
        $qty_acc="qty_acc" . $i;
        $crn_num4li = "crn_num4li" . $i;
        $prevlinenum="prev_line_num" . $i;
        $lirecnum="lirecnum" . $i;
        $type="type".$i;
        $qty_ret = "qty_ret" . $i;
        $pcrn_num = "pcrn_num" . $i;
        $crn_type = "crntype" . $i;
 echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI_assy[1]\">";
    echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI_assy[0]\">";
    if($myLI_assy[19] =='')
        {
          echo "<td width=3%><span class=\"tabletext\"><input type=\"text\"  name=\"$linenumber\"  value=\"$myLI_assy[1]\" size=\"3%\"></td>";
        }
        else
        {
          echo "<td width=3%><span class=\"tabletext\"><input type=\"text\"  name=\"$linenumber\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  value=\"$myLI_assy[1]\" size=\"3%\"></td>";
        }
  // echo "<td width=3%><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"$myLI_assy[1]\" size=\"3%\" ></td>";
   echo "<td width=13%><span class=\"tabletext\"><input type=\"text\" id=\"$type\"  name=\"$type\"  value=\"$myLI_assy[16]\" size=\"13%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<td width=4%><input type=\"text\" id=\"$itemno\" name=\"$itemno\"  size=\"6%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[2]\">";
   echo "<td width=10%><input type=\"text\" id=\"$crn_num4li\" name=\"$crn_num4li\"  size=\"6%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[15]\">
         <input type=\"hidden\" name=\"$pcrn_num\" size=\"20%\" value=\"$myLI_assy[19]\"></td>";
    echo "<td width=13%><span class=\"tabletext\"><input type=\"text\" id=\"$crn_type\"  name=\"$crn_type\"  value=\"$myLI_assy[20]\" size=\"13%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<td width=10%><input type=\"text\" id=\"$partnum\" name=\"$partnum\"  size=\"20%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[3]\"></td>";
   echo "<td width=10%><input type=\"text\" id=\"$issue\" name=\"$issue\"  size=\"15%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[4]\"></td>";
   echo "<td width=12%><input type=\"text\" id=\"$descr\" name=\"$descr\"  size=\"23%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[12]\"></td>";
   echo "<td width=4%><input type=\"text\" id=\"$qty\" name=\"$qty\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"5%\" value=\"$myLI_assy[5]\"></td>";
   echo "<td width=6%><input type=\"text\" id=\"$uom\" name=\"$uom\"  size=\"8%\" value=\"$myLI_assy[7]\"></td>";
   echo "<td width=8%><input type=\"text\" id=\"$qty_wo\" name=\"$qty_wo\"  size=\"5%\" value=\"$myLI_assy[6]\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
   echo "<td width=5%><input type=\"text\" id=\"$qty_acc\" name=\"$qty_acc\"  size=\"4%\" value=\"$myLI_assy[18]\"></td>";
   echo "<td width=5%><input type=\"text\" id=\"$qty_rew\" name=\"$qty_rew\"  size=\"4%\" value=\"$myLI_assy[13]\"></td>";
   echo "<td width=5%><input type=\"text\" id=\"$qty_ret\" name=\"$qty_ret\"  size=\"4%\" value=\"$myLI_assy[17]\"></td>";
   echo "<td width=5%><input type=\"text\" id=\"$qty_rej\" name=\"$qty_rej\"  size=\"4%\" value=\"$myLI_assy[14]\"></td>";
   echo "<td width=6%><input type=\"text\" id=\"$grn\" name=\"$grn\"  size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assy[8]\"><img src=\"images/bu-get.gif\" alt=\"Get CIM\" onclick=\"getgrn_wo($i)\"></td>";
   echo "<td width=8%><input type=\"text\" id=\"$exp_date\" name=\"$exp_date\"  size=\"8%\" value=\"$myLI_assy[10]\">";
   ?>
<img src="images/bu-getdateicon.gif" alt="Get Expiry Date"  onclick="GetDate('<?php //echo "$exp_date";?>')"></td>
<?php
 //  echo "<td width=15%><input type=\"text\" id=\"$remarks\" name=\"$remarks\"  size=\"27%\" value=\"$myLI_assy[11]\"></td>";
 //printf('</tr>');
 // }
  // $i++;  */
  //}

   echo "<input type=\"hidden\" name=\"index\" value=$i>";
?>

</table>
</div>
<table id="myTable_oper" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#DDDEDD">
<td bgcolor="#DDDEDD" colspan=12><span class="heading"><center><b>Operation Description</b></center></td>
</tr>
<tr>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Opn #</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Stn</b></td>
<td bgcolor="#EEEFEE" width=20%><span class="heading"><b>Operation Desc</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Sign Off</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Remarks</b></td>

</tr>
<?php
$j=1;
 $flag=0;
 $result_assyoper = $assywo_oper->get_assy_oper($assyworecnum);
   while ($j<=5)
   {
    if($flag == 0)
    {
      while ($myLI_assyoper = mysql_fetch_row($result_assyoper))
      {
	    printf('<tr bgcolor="#FFFFFF">');
        $oppn_num="oppn_num" . $j;
        $stn_num="stn_num" . $j;
        $operation_descr="operation_descr" . $j;
        $sign="sign" . $j;
        $remarks="remarks_oper" . $j;

        $prevlinenum_oper="prev_line_num_oper" . $j;
        $lirecnum_oper="lirecnum_oper" . $j;

        echo "<input type=\"hidden\" name=\"$prevlinenum_oper\" value=\"$myLI_assyoper[1]\">";
        echo "<input type=\"hidden\" name=\"$lirecnum_oper\" value=\"$myLI_assyoper[0]\">";
        if($dept!='QA'&& $dept !='PPC5')
        {
        echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$oppn_num\"  name=\"$oppn_num\"  value=\"$myLI_assyoper[1]\" size=\"6%\"></td>";
        echo "<td><input type=\"text\" id=\"$stn_num\" name=\"$stn_num\"  size=\"16%\" value=\"$myLI_assyoper[2]\">";
        echo "<td><input type=\"text\" id=\"$operation_descr\" name=\"$operation_descr\"  size=\"40%\" value=\"$myLI_assyoper[3]\"></td>";
        echo "<td><input type=\"text\" id=\"$sign\" name=\"$sign\"  size=\"15%\" value=\"$myLI_assyoper[4]\"></td>";
        echo "<td><input type=\"text\" id=\"$remarks\" name=\"$remarks\"  size=\"28%\" value=\"$myLI_assyoper[5]\"></td>";
        }
        else
        {
           echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$oppn_num\"  name=\"$oppn_num\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assyoper[1]\" size=\"6%\"></td>";
        echo "<td><input type=\"text\" id=\"$stn_num\" name=\"$stn_num\"  size=\"16%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assyoper[2]\">";
        echo "<td><input type=\"text\" id=\"$operation_descr\" name=\"$operation_descr\"  size=\"40%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assyoper[3]\"></td>";
        echo "<td><input type=\"text\" id=\"$sign\" name=\"$sign\"  size=\"15%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assyoper[4]\"></td>";
        echo "<td><input type=\"text\" id=\"$remarks\" name=\"$remarks\"  size=\"28%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assyoper[5]\"></td>";

        }
        printf('</tr>');
        $j++;
      }
      $flag=1;
    }
    if($dept !='QA'&& $dept !='PPC5')
    
      {
      printf('<tr bgcolor="#FFFFFF">');
        $oppn_num="oppn_num" . $j;
        $stn_num="stn_num" . $j;
        $operation_descr="operation_descr" . $j;
        $sign="sign" . $j;
        $remarks="remarks_oper" . $j;

        $prevlinenum_oper="prev_line_num_oper" . $j;
        $lirecnum_oper="lirecnum_oper" . $j;

        echo "<input type=\"hidden\" name=\"$prevlinenum_oper\" value=\"\">";
        echo "<input type=\"hidden\" name=\"$lirecnum_oper\" value=\"\">";

        echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$oppn_num\"  name=\"$oppn_num\"  value=\"\" size=\"6%\"></td>";
        echo "<td><input type=\"text\" id=\"$stn_num\" name=\"$stn_num\"  size=\"16%\" value=\"$myLI_assyoper[2]\">";
        echo "<td><input type=\"text\" id=\"$operation_descr\" name=\"$operation_descr\"  size=\"40%\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$sign\" name=\"$sign\"  size=\"15%\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$remarks\" name=\"$remarks\"  size=\"28%\" value=\"\"></td>";
       }
        printf('</tr>');
        $j++;

      
   }
       echo "<input type=\"hidden\" name=\"index_oper\" value=$j>";
       echo "<input type=\"hidden\" name=\"delete_flag\" value=0>";
?>

<input type="hidden" name="page" value="edit">

</table>

<table id="processDets" width=100% border=0 cellpadding=3 cellspacing=2 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#DDDEDD">
<td bgcolor="#DDDEDD" colspan=12><span class="heading"><center><b>Process Details</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan=20><span class="heading"><a href="javascript:addRowprodets('processDets',document.forms[0].index_pdets.value)">
<img src="images/bu-addrow.gif" border="0"></a></td>
</tr>
<tr>
<td bgcolor="#EEEFEE" width=15%><span class="heading"><b>Line</b></td>
<td bgcolor="#EEEFEE" width=15%><span class="heading"><b>Process</b></td>
<td bgcolor="#EEEFEE" width=20%><span class="heading"><b>Start Date & Time</b></td>
<td bgcolor="#EEEFEE" width=20%><span class="heading"><b>End Date & Time</b></td>
<td bgcolor="#EEEFEE" width=42%><span class="heading"><b>Other Details</b></td>
</tr>
<?php
$m=1;
 $flag=0;
   while ($m<=5)
   {
    if($flag == 0)
    {
      while ($myLI_assyprdet = mysql_fetch_row($result_assywoprdet))
      {
	    printf('<tr bgcolor="#FFFFFF">');
        $seqnumber="seqnumber" . $m;
        $process="process" . $m;
        $st_date_time="st_date_time" . $m;
        $end_date_time="end_date_time" . $m;
        $remarks_pdets="remarks_pdets" . $m;

        $prevlinenum_prdet="prevlinenum_prdet" . $m;
        $linerecnum_prdet="linerecnum_prdet" . $m;

        echo "<input type=\"hidden\" name=\"$prevlinenum_prdet\" value=\"$myLI_assyprdet[1]\">";
        echo "<input type=\"hidden\" name=\"$linerecnum_prdet\" value=\"$myLI_assyprdet[0]\">";
        if($dept!='QA' && $dept !='PPC5')
        {
        echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$seqnumber\"  name=\"$seqnumber\"  value=\"$myLI_assyprdet[1]\" size=\"3%\"></td>";
        echo "<td><input type=\"text\" id=\"$process\" name=\"$process\"  size=\"15%\" value=\"$myLI_assyprdet[2]\">";
        echo "<td><input type=\"text\" id=\"$st_date_time\" name=\"$st_date_time\"  size=\"30%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assyprdet[3]\">
         <img src=\"images/bu-getdateicon.gif\" onclick=\"javascript:NewCssCal('$st_date_time','yyyyMMdd','dropdown',true,'24',true)\" style=\"cursor:pointer\"/></td>";
        echo "<td><input type=\"text\" id=\"$end_date_time\" name=\"$end_date_time\"  size=\"30%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assyprdet[4]\">
         <img src=\"images/bu-getdateicon.gif\" onclick=\"javascript:NewCssCal('$end_date_time','yyyyMMdd','dropdown',true,'24',true)\" style=\"cursor:pointer\"/></td>";
        echo "<td><textarea id=\"$remarks_pdets\" name=\"$remarks_pdets\"  rows=2 cols=30>$myLI_assyprdet[5]</textarea></td>";
        }
        else
        {
        echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$seqnumber\"  name=\"$seqnumber\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assyprdet[1]\" size=\"3%\"></td>";
        echo "<td><input type=\"text\" id=\"$process\" name=\"$process\"  size=\"15%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assyprdet[2]\">";
        echo "<td><input type=\"text\" id=\"$st_date_time\" name=\"$st_date_time\"  size=\"30%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assyprdet[3]\"></td>";
        echo "<td><input type=\"text\" id=\"$end_date_time\" name=\"$end_date_time\"  size=\"30%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$myLI_assyprdet[4]\"></td>";
        echo "<td><textarea id=\"$remarks_pdets\" name=\"$remarks_pdets\"  style=\"background-color:#DDDDDD;\"  readonly=\"readonly\" rows=2 cols=30>$myLI_assyprdet[5]</textarea></td>";
        }
        printf('</tr>');
        $m++;
      }
      $flag=1;
    }
    if($dept !='QA' && $dept !='PPC5')

      {
      printf('<tr bgcolor="#FFFFFF">');
         $seqnumber="seqnumber" . $m;
           $process="process" . $m;
   $st_date_time="st_date_time" . $m;
   $end_date_time="end_date_time" . $m;
   $remarks_pdets="remarks_pdets" . $m;

        $prevlinenum_prdet="prevlinenum_prdet" . $m;
        $linerecnum_prdet="linerecnum_prdet" . $m;
        
        echo "<input type=\"hidden\" name=\"$prevlinenum_prdet\" value=\"\">";
        echo "<input type=\"hidden\" name=\"$prevlinenum_prdet\" value=\"\">";

        echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$seqnumber\"  name=\"$seqnumber\"  value=\"\" size=\"3%\"></td>";
        echo "<td><input type=\"text\" id=\"$process\" name=\"$process\"  size=\"15%\" value=\"\">";
        echo "<td><input type=\"text\" id=\"$st_date_time\" name=\"$st_date_time\"  size=\"30%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\">
        <img src=\"images/bu-getdateicon.gif\" onclick=\"javascript:NewCssCal('$st_date_time','yyyyMMdd','dropdown',true,'24',true)\" style=\"cursor:pointer\"/></td>";
        echo "<td><input type=\"text\" id=\"$end_date_time\" name=\"$end_date_time\"  size=\"30%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\">
        <img src=\"images/bu-getdateicon.gif\" onclick=\"javascript:NewCssCal('$end_date_time','yyyyMMdd','dropdown',true,'24',true)\" style=\"cursor:pointer\"/></td>";
        echo "<td><textarea id=\"$remarks_pdets\" name=\"$remarks_pdets\"  rows=2 cols=30></textarea></td>";
       }
        printf('</tr>');
        $m++;


   }
       echo "<input type=\"hidden\" name=\"index_pdets\" value=$m>";
       echo "<input type=\"hidden\" name=\"cur_index_pdets\" value=$m>";
       echo "<input type=\"hidden\" name=\"delete_flag_prodet\" value=0>";
?>

<input type="hidden" name="page" value="edit">

</table>
<?
include("inassyedit.php");
?>
 <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

        <tr bgcolor="#DDDEDD">
            <td colspan=13><span class="heading"><center><b>Timeline</b></center></td>
        </tr>

<?php
$result

?>
      <tr bgcolor="#FFFFFF">
            <td><span class="tabletext"><p align="left"><b>Sch Due Date</b></p></font></td>
            <td><input type="text" id="sch_due_date" name="sch_due_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="<?php echo $myrow['sch_due_date']?>">
              <?php
            if($dept != 'Purchasing' && $dept != 'QA' && $dept !='PPC5')
            {
            ?>
            <img src="images/bu-getdateicon.gif" onclick="javascript:NewCssCal('sch_due_date','yyyyMMdd')" style="cursor:pointer"/>
             <?php
            }
            else
            {
            ?>
             </td>
            <?php
            }
            ?>
             <input type="hidden" name="prev_rev_ship_date" value="<?php echo $myrow['sch_due_date'] ?>">
            <td><span class="tabletext"><p align="left"><b>Revised Completed Date</b></p></font></td>
            <td><input type="text" id="rev_ship_date" name="rev_ship_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="<?php echo $myrow['revised_ship_date']?>">
            <?php
            if($dept != 'Purchasing' && $dept != 'QA' && $dept !='PPC5')
            {
            ?>
             <img src="images/bu-getdateicon.gif" onclick="javascript:NewCssCal('rev_ship_date','yyyyMMdd')" style="cursor:pointer"/>
              <?php
            }
            else
            {
            ?>
             </td>
            <?php
             }
            ?>
            <td><span class="tabletext"><p align="left"><b>Date Code</b></p></font></td>
            <td><input type="text" id="act_ship_date" name="act_ship_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="<?php echo $myrow['actual_ship_date']?>">
                     <?php
            if($dept != 'Purchasing' && $dept != 'QA')
            {
            ?>
             <img src="images/bu-getdateicon.gif" onclick="javascript:NewCssCal('act_ship_date','yyyyMMdd')" style="cursor:pointer"/>
               <?php
            }
            ?>
             </td>
      </tr>
     </table>
</td>
<!-- <td width="6"><img src="images/spacer.gif " width="6"> -->
<input type="hidden" id="pagename" name="pagename"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="edit_assywo">
                    <input type="hidden" id="dept" name="dept"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="<?php echo $dept ?>"></td>
</tr>
<!-- <tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr> -->
</table>
<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr>
<td align=left>
</td>
</tr>
</table>
<span class="tabletext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">

</FORM>
</body>
</html>

