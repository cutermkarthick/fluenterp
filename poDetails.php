<?php
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: poDetails.php                     =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Displays PO                                 =
//==============================================
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
if ( !isset ( $_REQUEST['porecnum']) )
{
//echo "i am not set in podetails";
header( "Location: login.php" );
}
$cond = "c.name like '%'";
$rowsPerPage = 6;
$pageNum = 1;
$offset = ($pageNum - 1) * $rowsPerPage;
$porecnum = $_REQUEST['porecnum'];


//echo "$porecnum";
$_SESSION['pagename'] = 'podetails';
$page = "Purchasing: PO";
$dept = $_SESSION['department'];
//////session_register('pagename');

// First include the class definition
include('classes/poClass.php');
include('classes/liClass.php');
include('classes/displayClass.php');
include('classes/purchasing_allocClass.php');
$newPO = new po;
$newdisplay = new display;
$newLI = new po_line_items;
$newpurch = new purchasing_alloc;
$result = $newPO->getPODetails($porecnum);
$myrow = mysql_fetch_assoc($result);
/* echo "i am 12 :$myrow[12]";
echo "i am 11 :$myrow[11]";
echo "i am 10 :$myrow[10]";*/
$remarks=wordwrap($myrow["remarks"],105,"\n",true);
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/po.js"></script>
<script language="javascript" type="text/javascript">
function readOnlyCheckBox()
{
return false;
}
</script>
<html>
<head>
<title>PO Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;
<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td></td></tr>
<tr>
<td>
<?php
$newdisplay->dispLinks('');
?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td> -->
<!-- <td bgcolor="#FFFFFF"> -->
<table width=100% border=0 cellpadding=6 cellspacing=0>
<tr><td>
<table width=100% border=0>

<tr>

            <td align="left"><span class="pageheading"><b>PO Details</b></td>

                <td rowspan=2 align="right">
  <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='poupdate.php?porecnum=<?php echo $porecnum ?>'" value="Edit" >              	
<!-- <a href ="poupdate.php?porecnum=<?php echo $porecnum ?>"><img name="Image8" border="0" src="images/bu-edit.gif" ></a> -->
<?php
if($myrow['status']=="Open" && $myrow['approval']=="yes"){
?>
                <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick='javascript: printPO("<?php echo $porecnum ?>")' value="Print" >
                 <!-- <input type= "image" name="Print" src="images/bu-print.gif" value="Get" onclick='javascript: printPO("<?php echo $porecnum ?>")'> -->
                 <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='export_po.php?porecnum=<?echo $_REQUEST['porecnum']?>'" value="Export" >
                 <!-- <a href="export_po.php?porecnum=<?echo $_REQUEST['porecnum']?>"><img name="Image8" border="0" src="images/export.gif" ></a> -->
<?php
}
?>
                    </td>
</tr>
</table>
</td></tr>

<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
 <tr bgcolor="#FFFFFF">

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
<form>
<td  bgcolor="#F5F6F5" width=50%><span class="heading"><center><b>Supplier</b></center></td>
<td bgcolor="#F5F6F5" width=50%><span class="heading"><b><center>Ship To</center></b></td>
</tr>
<tr bgcolor="#FFFFFF">

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<td width=50%><span class="tabletext"><?php echo $myrow["name"]?></td>
<td width=50%><span class="tabletext">Fluent Technologies</td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=50%><span class="tabletext"><?php echo $myrow["addr1"] . " " . $myrow["addr2"]; ?></td>
<td width=50%><span class="tabletext">#472, 2ND FLOOR,KEER PLAZA,</td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=50%><span class="tabletext"><?php echo $myrow["city"] . " " . $myrow["state"]. " " . $myrow["zipcode"]; ?></td>
<td width=50%><span class="tabletext">ABOVE AXIS BANK, 80 FEET MAIN ROAD</td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=50%><span class="tabletext"><?php echo $myrow["country"]; ?></td>
<td width=50%><span class="tabletext">Bangalore 560 079, Karnataka- INDIA.</td>
</tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
<tr bgcolor="#FFFFFF">
<td width=20%><span class="labeltext"><p align="left">PO Date</p></font></td>
<?php
// echo"to--- ".$myrow["podate"];
$datearr = split('-', $myrow["podate"]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$date=date("M j, Y",$x);
// echo "$date";
?>
<td width=20%><span class="tabletext"><?php echo $date ?></td>
<td width=20%><span class="labeltext"><p align="left">PO #</p></font></td>
<td width=20%><span class="tabletext"><?php echo $myrow["ponum"] ?></td>

</tr>
<?php
//echo"++++".$myrow["status"];
if($myrow["status"]=="Pending")
{
$color = '"#FF0000"';
}
else if(($myrow["status"]=="Open")||($myrow["status"]=="open"))
{
$color = '"#00FF00"';
}
else if ($myrow["status"]=="Cancelled")
{
$color = '"#FFEABD"';
}
else if ($myrow["status"]=="Issued")
{
$color = '"#FFDADA"';
}
else
{
$color = '"#FFC89F"';
}
?>
<tr bgcolor="#FFFFFF">
<td width=20%><span class="labeltext"><p align="left">PO Desc</p></font></td>
<td width=20%><span class="tabletext"><?php echo $myrow["podescr"] ?></td>
<td width=20%><span class="labeltext"><p align="left">Status</p></font></td>
<td bgcolor=<?php echo $color ?> width=20%><span class="tabletext"><b><?php echo $myrow["status"] ?></b></td>

</tr>
<tr bgcolor="#FFFFFF">
<?php
$checked="checked";
?>
<td width=20%><span class="labeltext"><p align="left">Approval</p></font></td>
<td width=20%><span class="tabletext"><input type="checkbox" <?php echo $myrow["approval"] == 'yes'?$checked:"" ?> onClick="return readOnlyCheckBox()"/></td>
<td width=20%><span class="labeltext"><p align="left">Approval Date</p></font></td>
<?php
// echo"to--- ".$myrow["approvaldate"];
if($myrow["approvaldate"] !='' && $myrow["approvaldate"] !='0000-00-00' && $myrow["approvaldate"] != 'null'){
$datearr = split('-', $myrow["approvaldate"]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$date1=date("M j, Y",$x);
}
else
$date1='';
//echo "$date1";
?>
<td width=20%><span class="tabletext"><?php echo $date1 ?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td width=20%><span class="labeltext"><p align="left">Amendment No.</p></font></td>
<td width=20%><span class="tabletext"><?php echo $myrow["amendment_num"] ?></td>
<td width=20%><span class="labeltext"><p align="left">Amendment Date</p></font></td>
<?php
// echo"to--- ".$myrow["podate"];
if($myrow["amendmentdate"] !='' && $myrow["amendmentdate"] !='0000-00-00' && $myrow["amendmentdate"] != 'null'){
$datearr = split('-', $myrow["amendmentdate"]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$date2=date("M j, Y",$x);
}
else{
$date2='';
}
// echo "$date";
?>
<td width=20%><span class="tabletext"><?php echo $date2 ?></td>

</tr>
<?
$amend_notes=wordwrap($myrow["amendment_notes"],100,"\n",true);
?>
<tr bgcolor="#FFFFFF">
<td width=20%><span class="labeltext"><p align="left">Amendment Notes</p></font></td>
<td width=20% colspan=5><span class="tabletext"><textarea  name="amendment_notes" id="amendment_notes" rows="3"
style="background-color:#DDDDDD;" readonly="readonly"
cols="110" value=""><?php echo $amend_notes." \n"?></textarea></td>
</tr>

<?
$terms=wordwrap($myrow["terms"],100,"\n",true);
?>
<tr bgcolor="#FFFFFF">
<td width=20%><span class="labeltext"><p align="left">Header</p></font></td>
<td width=20% colspan=5><span class="tabletext"><textarea  name="terms" rows="2"
style="background-color:#DDDDDD;" readonly="readonly"
cols="110" value=""><?php echo $terms." \n"?></textarea></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Remarks</p></font></td>
<td colspan=5><span class=\"tabletext\"><textarea  name="remarks" rows="3"
style="background-color:#DDDDDD;" readonly="readonly"
cols="110" value=""><?php echo $remarks." \n" ?></textarea></td>
</tr>
<tr bgcolor="#FFFFFF">
<td ><span class="labeltext"><p align="left">Type</p></font></td>
<td colspan=8><span class="tabletext">
<?php echo $myrow["type"] ?>
</td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan=1><span class="labeltext"><p align="left">Communication</p></font></td>
<?php
$comm = $myrow["communication"];
($comm == 10)?$checked='checked':$checked='';
echo "<td colspan=8><span class=\"tabletext\"><input type=\"radio\" name=\"communication\" value=\"10\" $checked onclick=\"return readOnlyCheckBox()\">10";
($comm == 20)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;
&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp<input type=\"radio\" name=\"communication\" value=\"20\" $checked onclick=\"return readOnlyCheckBox()\">20";
($comm == 30)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;
&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" name=\"communication\" value=\"30\" $checked onclick=\"return readOnlyCheckBox()\">30";
($comm == 40)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;
&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp<input type=\"radio\" name=\"communication\" value=\"40\" $checked onclick=\"return readOnlyCheckBox()\">40";
($comm == 50)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;
&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp<input type=\"radio\" name=\"communication\" value=\"50\" $checked onclick=\"return readOnlyCheckBox()\">50";
($comm == 60)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;
&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp<input type=\"radio\" name=\"communication\" value=\"60\" $checked onclick=\"return readOnlyCheckBox()\">60";
($comm == 70)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;
&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp<input type=\"radio\" name=\"communication\" value=\"70\" $checked onclick=\"return readOnlyCheckBox()\">70";
($comm == 80)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;
&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp<input type=\"radio\" name=\"communication\" value=\"80\" $checked onclick=\"return readOnlyCheckBox()\">80";
($comm == 90)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;
&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp<input type=\"radio\" name=\"communication\" value=\"90\" $checked onclick=\"readOnlyCheckBox()\">90";
($comm == 100)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;
&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp<input type=\"radio\" name=\"communication\" value=\"100\" $checked onclick=\"return readOnlyCheckBox()\">100</td>";
?>
</table>
<br>
<table border = 1 cellpadding=0 cellspacing=0 width=100%>
<tr><td align="center"><span class="tabletext"><b>
Please quote each line item of the purchase order in invoice and CofC and dispatch as per line item only.
</b></td>
</tr></table>
<table  border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable" >
<tr bgcolor='#FFFFFF'>
<thead>
<td colspan=27></td>
<td bgcolor="#A0C544" colspan=3 align='center'><span class="heading"><b>Compliance</b></td>
<td bgcolor="#659EC7" align='center' colspan=3><span class="heading"><b>Rating</b></td>
<td colspan=7></td>
</tr>
<tr>

<th class="head0"  width="5px"><span class="heading"><b>Ln</b></td>
<th class="head1"  width="50px" ><span class="heading"><b>Layout<br>Ref#</b></td>
<th class="head0"  width="5px"><span class="heading"><b>Delivery<br>Time</b></td>
<th class="head1"  width="5px"><span class="heading"><b>Qty<br>Rej</b></td>
<th class="head0"  width="60px" ><span class="heading"><b>Spec Type</b></td>
<th class="head1"  width="90px"><span class="heading"><b>PRN</b></td>
<th class="head0"  width="100px"><span class="heading"><b>Order<br>Qty</b></td>
<th class="head1"  width="100px"><span class="heading"><b>Mtl Type</b></td>
<th class="head0"  width="100px"><span class="heading"><b>Mtl Spec</b></td>
<th class="head1"  width="80px"><span class="heading"><b>Con</b></td>
<th class="head0"  width="100px"><span class="heading"><b>UOM</b></td>
<th class="head1" width="100px"><span class="heading"><b>Dia</b></td>
<th class="head0"  width="100px"><span class="heading"><b>Length</b></td>
<th class="head1"  width="100px"><span class="heading"><b>Width</b></td>
<th class="head0"  width="100px"><span class="heading"><b>Thick</b></td>
<th class="head1"  width="100px"><span class="heading"><b>GF</b></td>
<th class="head0"  width="100px"><span class="heading"><b>Max</b></td>
<th class="head1"  width="100px"><span class="heading"><b>No of<br>Units</b></td>

<th class="head0"  width="100px"><span class="heading"><b>Measuring<br>Unit</b></td>


<th class="head1"  width="100px" ><span class="heading"><b>No of<br>Len req</b></th>
<th class="head0"  width="100px"><span class="heading"><b>Due</b></th>
<th class="head1"  width="100px" colspan=1><span class="heading"><b>Due1</b></th>
<th class="head0"  width="50px" colspan=1><span class="heading"><b>Due2</b></th>
<th class="head1" width="50px"><span class="heading"><b>GRN#</b></th>
<th class="head0"  width="50px"><span class="heading"><b>Qty Recd</b></th>
<th class="head1"  width="50px"><span class="heading"><b>Acc</b></th>
<th class="head0"  width="50px"><span class="heading"><b>Delv Mode</b></th>
<td bgcolor="#A0C544"  width="50px"><span class="heading"><b>Qual<br/>ity</b></th>
<td bgcolor="#A0C544"  width="50px"><span class="heading"><b>Del<br/>ivery</b></th>
<td bgcolor="#A0C544"  width="50px"><span class="heading"><b>Comm</b></th>
<td bgcolor="#659EC7"  width="50px"><span class="heading"><b>Qual<br/>ity</b></th>
<td bgcolor="#659EC7"  width="50px"><span class="heading"><b>Deli<br/>very</b></th>
<td bgcolor="#659EC7"  width="50px"><span class="heading"><b>Comm</b></th>

<th class="head1"  colspan=2 width="200px"><span class="heading"><b>Rate</b></th>
<th class="head0"  colspan=2 width="200px"><span class="heading"><b>Amt</b></th>
<th class="head1"  width="50px"><span class="heading"><b>Status</b></th>
<th class="head0"  width="100px" colspan=2><span class="heading"><b>Remarks</b></th>
</tr>
<!--</table>
<div style="width:1920px;height:200; overflow:auto;border:" id="dataList">

<table style="table-layout: fixed" width=1900px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">-->
<?php
$recnum_arr = array();
$i = 0;
$netqus=0;
$netdels=0;
$netcomms=0;
$result = $newLI->getLI($porecnum);
$num_rows=mysql_num_rows($result);
while ($myLI = mysql_fetch_assoc($result)) {
$orderQty=$var = number_format($myLI["order_qty"],2);
$orderQty=wordwrap($orderQty,"6","<br>\n",true);

if($myLI["duedate"] != '0000-00-00' && $myLI["duedate"] != '' && $myLI["duedate"] != 'NULL')
{
$datearr = split('-', $myLI["duedate"]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$date=wordwrap(date("M j, Y",$x),"9","<br>\n",true);
}
else
{
$date = '';
}
if($myLI["due_date1"] != '0000-00-00' && $myLI["due_date1"] != '' && $myLI["due_date1"] != 'NULL')
{
$datearr = split('-', $myLI["due_date1"]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$datef=wordwrap(date("M j, Y",$x),"9","<br>\n",true);
}
else
{
$datef = '';
}
if($myLI["due_date2"] != '0000-00-00' && $myLI["due_date2"] != '' && $myLI["due_date2"] != 'NULL')
{
$datearr = split('-', $myLI["due_date2"]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$dates=wordwrap(date("M j, Y",$x),"9","<br>\n",true);
}
else
{
$dates = '';
}
if($myLI["accepted_date"] != '0000-00-00' && $myLI["accepted_date"] != '' && $myLI["accepted_date"] != 'NULL')
{
$datearr = split('-', $myLI["accepted_date"]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$accdate=wordwrap(date("M j, Y",$x),"9","<br>\n",true);
}
else
{
$accdate = '';
}
$qty_ordered = 0;
//echo "$date";
$recnum_arr[] = $myLI["recnum"];
$line_num = $myLI["line_num"];
$item_name = $myLI["item_name"];
$item_desc = $myLI["item_desc"];
$qty = $myLI["qty"];
$delvby = $myLI["delv_by"];
$uom = $myLI["uom"];

if(strtoupper($uom) == 'MM')
$no_units_req='Mts';
else if(strtoupper($uom) == 'INCHES')
$no_units_req='Ft';
else
$no_units_req='';


$grainflow = $myLI["grainflow"];
$material_ref = wordwrap($myLI["material_ref"],"7","<br>\n",true);
$material_spec = wordwrap($myLI["material_spec"],"7","<br>\n",true);
$dia ="";
$thick="";
$width = $myLI["width"];
$length = $myLI["length"];
$layoutrefnum=$myLI["layoutrefnum"];
if (trim($length) == "")
{
$dia = $myLI['thick'];
}
else
{
$thick = $myLI['thick'];
}
$qty_per_meter = $myLI["qty_per_meter"];
$no_of_meterages = number_format($myLI["no_of_meterages"],2);
$no_of_lengths = number_format($myLI["no_of_lengths"],2);


$crn = $myLI["crn"];
$crn = wordwrap($crn,"7","<br>\n",true);
$maxruling = $myLI["maxruling"];
$condition = wordwrap($myLI["condition"],4,"<br/>\n",true);
$qtyrej = ($myLI["qty_rej"] != 'NULL')?$myLI["qty_rej"]:0;
if($myLI["delivery_time"] == 1)
{
$del = 'On Time';
$del_rating = '100%';
}
else if($myLI["delivery_time"] == 2)
{
$del = '<<br>7 days late';
$del_rating = '66.67%';
}
else if($myLI["delivery_time"] == 3)
{
$del = '><br>7 days late';
$del_rating = '33.33%';
}
else
{
$del = '';
}
$qty_ordered = ($no_of_meterages+$no_of_lengths);
if($qty_ordered > 0)
$quality = ((($qty_ordered - $qtyrej)/$qty_ordered)*100);
else
$quality=0;
$order_qty=$myLI["order_qty"];
$alt_spec=$myLI["alt_spec_rm"];
$spec_type=$myLI["spec_type"];
$qty_recd=$myLI["qty_recd"];
$li_status=$myLI["status"];
$li_remarks=$myLI["remarks"];
$grn_num=$myLI["grn_num"];

$i = $i + 1;
$lnarr=split('-',$line_num);
if( $lnarr[1]!='')
{
$color="#306EFF";
}else
{
$color="#000000";
}
$no_of_lengths = wordwrap($no_of_lengths,"7","<br>\n",true);
$spectype=wordwrap($spec_type,"7","<br>\n",true);
echo"<tr><td bgcolor=\"#FFFFFF\" ><span class=\"tabletext\"><font  color=$color>$line_num</font></td>";
echo"<td bgcolor=\"#FFFFFF\" ><span class=\"tabletext\"><font  color=$color>$layoutrefnum</font></td>";
echo"<td bgcolor=\"#FFFFFF\"  ><span class=\"tabletext\"><font  color=$color>$del</font></td>";
echo"<td bgcolor=\"#FFFFFF\"  ><span class=\"tabletext\"><font  color=$color>$qtyrej</font></td>";
echo"<td bgcolor=\"#FFFFFF\" ><span class=\"tabletext\"><font  color=$color>$spectype</font></td>";
echo"<td bgcolor=\"#FFFFFF\" ><span class=\"tabletext\"><font  color=$color>$crn</font></td>";
echo"<td bgcolor=\"#FFFFFF\"   ><span class=\"tabletext\"><font  color=$color>$orderQty</font></td>";
//                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty</td>";
echo"<td bgcolor=\"#FFFFFF\"  ><span class=\"tabletext\"><font color= $color>$material_ref</font></td>";
echo"<td bgcolor=\"#FFFFFF\" ><span class=\"tabletext\"><font color= $color>$material_spec</font></td>";
echo"<td bgcolor=\"#FFFFFF\" ><span class=\"tabletext\"><font color= $color>$condition</font></td>";
echo"<td bgcolor=\"#FFFFFF\" ><span class=\"tabletext\"><font  color=$color>$uom</font></td>";
echo"<td bgcolor=\"#FFFFFF\" ><span class=\"tabletext\"><font  color=$color>$dia</font></td>";
echo"<td bgcolor=\"#FFFFFF\" ><span class=\"tabletext\"><font color= $color>$width</font></td>";
echo"<td bgcolor=\"#FFFFFF\"  ><span class=\"tabletext\"><font  color=$color>$length</font></td>";
echo"<td bgcolor=\"#FFFFFF\"  ><span class=\"tabletext\"><font color=$color>$thick</font></td>";
echo"<td bgcolor=\"#FFFFFF\"  ><span class=\"tabletext\"><font color=$color>$grainflow</font></td>";
echo"<td bgcolor=\"#FFFFFF\"  ><span class=\"tabletext\"><font color=$color>$maxruling</font></td>";
echo"<td bgcolor=\"#FFFFFF\"  ><span class=\"tabletext\"><font color=$color>$no_of_meterages</font></td>";

echo"<td bgcolor=\"#FFFFFF\"  ><span class=\"tabletext\"><font color=$color>$no_units_req</font></td>";


echo"<td bgcolor=\"#FFFFFF\" ><span class=\"tabletext\"><font color=$color>$no_of_lengths</font></td>";
echo"<td bgcolor=\"#FFFFFF\"  ><span class=\"tabletext\"><font color=$color>$date</font></td>";
echo"<td bgcolor=\"#FFFFFF\"  colspan=1><span class=\"tabletext\"><font color=$color>$datef</font></td>";
echo"<td bgcolor=\"#FFFFFF\"  colspan=1><span class=\"tabletext\"><font color=$color>$dates</font></td>";
echo"<td bgcolor=\"#FFFFFF\" ><span class=\"tabletext\"><font color=$color>$grn_num</font></td>";
echo"<td bgcolor=\"#FFFFFF\"  ><span class=\"tabletext\"><font color=$color>$qty_recd</font></td>";
echo"<td bgcolor=\"#FFFFFF\" ><span class=\"tabletext\"><font color=$color>$accdate</font></td>";
echo"<td bgcolor=\"#FFFFFF\"  ><span class=\"tabletext\"><font color= $color>$delvby</font></td>";
printf('<td bgcolor="#FFFFFF" align="right"><span class="tabletext">%.2f%s</td>',$quality,'%');
printf('<td bgcolor="#FFFFFF" align="right" ><span class="tabletext">%.2f%s</td>',$del_rating,'%');
printf('<td bgcolor="#FFFFFF" align="right" ><span class="tabletext">%.2f%s</td>',$comm,'%');

$netqu=($quality*0.6);
$netdel=($del_rating*0.3);
$netcomm=($comm*0.1);
printf('<td bgcolor="#FFFFFF" align="right"  ><span class="tabletext">%.2f</td>',$netqu);
printf('<td bgcolor="#FFFFFF" align="right"  ><span class="tabletext">%.2f</td>',$netdel);
printf('<td bgcolor="#FFFFFF" align="right"   ><span class="tabletext">%.2f</td>',$netcomm);
printf('<td bgcolor="#FFFFFF" colspan=2><span class="tabletext">%s %.2f</td>',$myrow["currency"],$myLI["rate"]);
printf('<td align="right" bgcolor="#FFFFFF"   colspan=2><span class="tabletext">%s %.2f</td>',$myrow["currency"],$myLI["amount"]);
echo"<td bgcolor=\"#FFFFFF\"   ><span class=\"tabletext\">$li_status</td>";
$remarksli=wordwrap($li_remarks,15,"<br>\n",true);
echo"<td bgcolor=\"#FFFFFF\"  colspan=2><span class=\"tabletext\">$remarksli</td>";
unset($condition);
$netqus = $netqus+$netqu;
$netdels =$netdels+ $netdel;
$netcomms =$netcomms+ $netcomm;
}     //print_r($recnum_arr);
?>
</tr>

<tr bgcolor='#FFFFFF'>
<td colspan=30 align="right"><span class="tabletext"><b>Average</b></td>
<?
$netquality=$netqus/$num_rows;
$netdelivery=$netdels/$num_rows;
$netcommunication=$netcomms/$num_rows;
$nettotal = ($netquality+$netdelivery+$comm);
?>
<td align=right><span class="tabletext" ><?php printf('%.2f',$netquality); ?></td>
<td align=right><span class="tabletext"><?php printf('%.2f',$netdelivery); ?></td>
<td align=right><span class="tabletext"><?php printf('%.2f',$netcommunication); ?></td>
<td colspan=7></td>
</tr>
<tr bgcolor='#FFFFFF'>
<td colspan=28 align="right"><span class="tabletext"><b>Total,pts</b></td>
<td colspan=3 align="right"><span class="tabletext" ><?php printf('%.2f',$nettotal); ?></td>
<td colspan=9></td>
</tr>

<tr bgcolor='#FFFFFF'>
<td bgcolor="#FFFFFF"  align="right" colspan=35><span class="tabletext"><b>Total</b></td>
<td align="right" bgcolor="#FFFFFF" colspan=2><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["poamount"]); ?></td>
<td colspan=3 bgcolor="#FFFFFF">&nbsp;</td></tr>

<tr bgcolor='#FFFFFF'>
<td bgcolor="#FFFFFF" align="right" colspan=35><span class="tabletext"><b>Tax</b></td>
<td align="right" bgcolor="#FFFFFF" colspan=2><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["tax"]);  ?></td>
<td colspan=3 bgcolor="#FFFFFF">&nbsp;</td></tr>
<tr>
<td bgcolor="#FFFFFF" colspan=35 align="right"><span class="tabletext"><b>Shipping</b></td>
<td align="right" bgcolor="#FFFFFF" colspan=2><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["shipping"]); ?></td>
<td colspan=3 bgcolor="#FFFFFF">&nbsp;</td>
</tr>
<tr>
<td bgcolor="#FFFFFF" colspan=35 align="right"><span class="tabletext"><b>Labor</b></td>
<td align="right" bgcolor="#FFFFFF" colspan=2><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["labor"]); ?></td>
<td colspan=3 bgcolor="#FFFFFF">&nbsp;</td>
</tr>
<tr>
<td bgcolor="#FFFFFF" colspan=35 align="right"><span class="tabletext"><b>Total Due</b></td>
<td align="right" bgcolor="#FFFFFF" colspan=2><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["total_due"]); ?></td>
<td colspan=3 bgcolor="#FFFFFF">&nbsp;</td>
</tr>
</table>
</div>
<!--<tr>
<td bgcolor="#FFFFFF" colspan=36 align="left">
<!-- <a href ="purchasingUpdate.php?porecnum=<?php //echo $porecnum ?>"><img name="Image8" border="0" src="images/bu-edit.gif"></a>--></td>
<!--</tr> -->

<!--<table style="width:190%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr>
<td bgcolor="#E0FFFF" colspan=16 align="center" ><span class="heading"><b>Purchasing Allocation</b></td>
</tr>
<tr>
<td bgcolor="#FFFFFF" colspan=36 align="left">
<a href ="purchasingUpdate.php?porecnum=<?php echo $porecnum ?>"><img name="Image8" border="0" src="images/bu-edit.gif"></a></td>
</tr>
<tr>
<td bgcolor="#E0FFFF"><span class="heading"><b>Line Num</b></td>
<td bgcolor="#E0FFFF"><span class="heading"><b>PO Num</b></td>
<td bgcolor="#E0FFFF"><span class="heading"><b>Material Spec</b></td>
<td bgcolor="#E0FFFF"><span class="heading"><b>PRN</b></td>
<td bgcolor="#E0FFFF"><span class="heading"><b>Qty Allocated</b></td>
</tr>

<?

$poNum = $myrow["ponum"];
//echo 'ponum='.$poNum;
foreach($recnum_arr as $link2poli)
{
$result4pur = $newpurch->getpurchDetails($link2poli,$poNum);
while ($mypur = mysql_fetch_assoc($result4pur))
{
//echo "$date";
$line_Num =  $mypur["linenum"];
$ponum = $mypur["ponum"];
$qty_alloc = $mypur["qty_allocated"];
$crn = $mypur["crn"];
$mat_spec = $mypur["mat_spec"];

echo"<tr><td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$line_Num</td>" ;
echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$ponum</td>";
echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$mat_spec</td>";
echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$crn</td>";
echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty_alloc</td>";
}
}
?>

</td>
</tr>
</table>
</td>-->
<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr> -->
</table>

<br/>
<table id="myTable" style="width:190%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#DFDFDF">
<td  width=20% colspan=4 ><span class="pageheading"><b>MODIFICATION DETAILS</b></td>
</tr>
<?
if($myrow['create_date'] != '0000-00-00' && $myrow['create_date'] != '' && $myrow['create_date'] != 'NULL')
{
$datearr = split('-', $myrow['create_date']);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$cr_date=date("M j, Y",$x);
}
else
{
$cr_date = '';
}

if($myrow['modified_date'] != '0000-00-00' && $myrow['modified_date'] != '' && $myrow['modified_date'] != 'NULL')
{
$datearr = split('-', $myrow['modified_date']);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$md_date=date("M j, Y",$x);
}
else
{
$md_date = '';
}?>
<tr bgcolor='#FFFFFF'>
<td bgcolor="#FFFFFF"  width=20%><span class="labeltext">Create Date</td>
<td><span class="tabletext"><?php echo $cr_date; ?></td>
<td bgcolor="#FFFFFF"  width=20%><span class="labeltext">Created By</td>
<td><span class="tabletext"><?php echo $myrow['created_by'] ?></td>
</tr>
<tr bgcolor='#FFFFFF'>
<td bgcolor="#FFFFFF"  width=20%><span class="labeltext">Modified Date</td>
<td><span class="tabletext"><?php echo $md_date?></td>

<td bgcolor="#FFFFFF"  width=20%><span class="labeltext">Modified By</td>
<td><span class="tabletext"><?php echo $myrow['modified_by'] ?></td>
</tr>
</table>


<table border = 1 cellpadding=0 cellspacing=0 style="width:190%" class="stdtable1">
<tr><td align="center"><span class="tabletext"><b>
If Material is ordered in Meters, the same
can be supplied in random lengths but each
length not exceeding 3 meters
</b></td>
</tr>
<table border=3 bgcolor="#DFDEDF" style="width:190%" cellspacing=1 cellpadding=3 class="stdtable1">
<tr bgcolor="#FFFFFF">
<td colspan=4><span class="labeltext"><?php printf('%s',$myrow["formatnum"]); ?></td>
<td colspan=2><span class="labeltext"><?php printf('%s',$myrow["formatrev"]); ?></td>
<td colspan=2>&nbsp;</td>
</tr>

</table>
</table>
</FORM>
</body>
</html>
