<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2006                =
// Filename: grn_details.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Displays GRN along with line items          =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
header ( "Location: login.php" );
}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'grn_details';
//////session_register('pagename');
$dept =  $_SESSION['department'];
$page="Stores: GRN";

// First include the class definition
include('classes/userClass.php');
include('classes/grnclass.php');
include('classes/displayClass.php');
include('classes/grncofcclass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;
$newgrn = new grn;
$newcofc=new cofc;
$grnrecnum = $_REQUEST['grnrecnum'];
$result = $newgrn->getgrn($grnrecnum);
$myrow = mysql_fetch_row($result);
$grnli = $newgrn->getgrnli($grnrecnum);
$grnli_det = $newgrn->getgrnli($grnrecnum);
$grnli_det_copy = $newgrn->getgrnli($grnrecnum);
$cofc= $newcofc->getcofc($grnrecnum);

$result2 = $newgrn->getgrn($grnrecnum);
$myrow2 = mysql_fetch_row($result2);

$result3 = $newgrn->get_MI_details($myrow[25]);

$result_grn = $newgrn->getgrn($grnrecnum);
$myrowgrn = mysql_fetch_row($result_grn);

$result_grncopy = $newgrn->getgrn($grnrecnum);
$myrowgrncopy = mysql_fetch_row($result_grncopy);
$po_num=$myrow[30];
$amendstatus="0";
$myphp="PHP";
$myphp1=&$myphp;
$myphp1="MYSQL" ;
$stat_purch='';
//echo$dept."------------".$myphp1;
while ($myrow_copy = mysql_fetch_row($grnli_det_copy))
{
if($myrow_copy[17] !='')
{
$amendstatus="1";

}
}
$pattern="/[$&*\"\'\/\-\s\;\,\:#!.,+]/";
$pattern2="/[$&*\"\'\/\-\s\;\,\:#!,+]/";
$thick_pattern=array('to','-','<');
$powidth='0.0';  $pothickness='0.0';
?>
<style>
textarea.t1 {font-family:arial;font-weight:bold;font-size:14pt;background-color:#ffff00;}
</style>

<link rel="stylesheet" href="style.css">

<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/grn.js">

</script>


<html>
<head>
<title>GRN Details</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0" onload="javascript:get_total(this)">

<?php
include('header.html');
?>
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
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr>
<td><span class="pageheading"><b>GRN Details</b></td>
<?php
if(($dept == 'Sales') || ($myrow[37] =='Pending' && ($dept == 'Purchasing' ||  $dept == 'CAD'))

|| ($dept == 'Stores'))
{
?>
<td bgcolor="#FFFFFF"  align="right">
<?php
//echo"$amendstatus----------------------";
//if($amendstatus=='1' && $myrow[37] !='Cancelled')
if($myrow[37] !='Cancelled')

{
?>
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='copy_grn.php?grnrecnum=<?php echo $grnrecnum?>'" value="Copy GRN" >
<!-- <a href ="copy_grn.php?grnrecnum=<?php echo $grnrecnum?>" ><img name="Image8"  border="0" src="images/copygrn.gif" ></a> -->
<?php

}
if(($dept == 'Sales') || ($myrow[37] =='Pending' && 
($dept == 'Purchasing' ||  $dept == 'CAD')))
{
?>
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='edit_grn.php?grnrecnum=<?php echo $grnrecnum ?>'" value="Edit GRN" >
<!-- <a href ="edit_grn.php?grnrecnum=<?php echo $grnrecnum ?>" ><img name="Image8" border="0" src="images/edit_grn.gif" ></a> -->
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="javascript: printgrn(<?php echo $grnrecnum ?>)" value="Print" >
<!-- <input type= "image" name="Print" src="images/bu-print.gif" value="Print" onClick="javascript: printgrn(<?php echo $grnrecnum ?>)"> -->
<?
}
?>
</td>
</tr>

<?php
}
elseif($dept !='PPC1')
{
?>
<td bgcolor="#FFFFFF" align="right">
<input type= "image" name="Print" src="images/bu-print.gif" value="Print" onClick="javascript: printgrn(<?php echo $grnrecnum ?>)">
</td>
</tr>
<?php
}
?>



<tr>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>GRN Header</b></center></td>
</tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<?php  //echo$myrow[51]."iiiiiiiiiiii" ;
$status=$myrow[37];
if($myrow[51] !='')
{?>
<tr bgcolor="#FFFFFF">
<td width="25%"><span class="labeltext"><p align="left">Parent GRN No.</p></font></td>
<td width="25%"><span class="tabletext"><b><?php echo $myrow[51] ?></b>
<input type="hidden" name="grnrecnum" id="grnrecnum" value="<?php echo $grnrecnum ?>"></td>
<td width="25%"><span class="labeltext"><p align="left">QTM Req.</p></font></td>
<td width="25%"><span class="tabletext"><?php echo $myrow[62] ?>
</tr>
<?php
}
?>
<tr bgcolor="#FFFFFF">
<td width="25%"><span class="labeltext"><p align="left">GRN No.</p></font></td>
<td width="25%"><span class="tabletext"><?php echo $myrow[25] ?>
<input type="hidden" name="grnrecnum" id="grnrecnum" value="<?php echo $grnrecnum ?>"></td>
<td width="25%"><span class="labeltext">Supplier</td>
<td width="25%"><span class="tabletext"><?php echo "$myrow[23]";?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Raw Material Spec</p></font></td>
<td><span class="tabletext"><?php echo $myrow[5] ?></td>
<td><span class="labeltext"><p align="left">Raw Material Code</p></font></td>
<td><span class="tabletext"><?php echo $myrow[12] ?></td>
</tr>

<tr bgcolor="#FFFFFF">

<td><span class="labeltext"><p align="left">Raw Material Type</p></font></td>
<td><span class="tabletext"><?php echo $myrow[4] ?>
<td><span class="labeltext"><p align="left">MGP/DC No.</p></font></td>
<td><span class="tabletext"><?php echo $myrow[18] ?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Invoice No.</p></font></td>
<td><span class="tabletext"><?php echo $myrow[13] ?></td>
<?php
if($myrow[14] != '0000-00-00' && $myrow[14] != '' && $myrow[14] != 'NULL')
{
$datearr = split('-', $myrow[14]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$date=date("M j, Y",$x);
}
else
{
$date = '';
}
?>

<td><span class="labeltext"><p align="left">Invoice Date</p></font></td>
<td><span class="tabletext"><?php echo $date ?></td>
</tr>

<tr bgcolor="#FFFFFF">
<?php
if($myrow[15] != '0000-00-00' && $myrow[15] != '' && $myrow[15] != 'NULL')
{
$datearr = split('-', $myrow[15]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$date1=date("M j, Y",$x);
}
else
{
$date1 = '';
}
?>
<td><span class="labeltext"><p align="left">Test Reports & COC</p></font></td>
<td><span class="tabletext"><?php echo $myrow[16] ?></td>
<td><span class="labeltext"><p align="left">Recieved Date</p></font></td>
<td><span class="tabletext"><?php echo $date1 ?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Batch No.</p></font></td>
<td><span class="tabletext"><?php echo $myrow[17] ?></td>
<td><span class="labeltext"><p align="left">Remarks</p></font></td>
<td><span class="tabletext"><?php echo wordwrap($myrow[33] , 30, "<br />\n");?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">COC Ref#</p></font></td>
<td><span class="tabletext"><?php echo $myrow[26] ?></td>
<td colspan=2></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">RM by Host</p></font></td>
<td><span class="tabletext"><?php echo $myrow[28] ?></td>
<td><span class="labeltext"><p align="left">RM by Cust</p></font></td>
<td><span class="tabletext"><?php echo $myrow[29] ?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Host PO Num</p></font></td>
<td><span class="tabletext"><?php echo $myrow[30] ?></td>
<td><span class="labeltext"><p align="left">Host PO Line#</p></font></td>
<td><span class="tabletext"><?php echo $myrow[49] ?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">GRN Type</p></font></td>
<td><span class="tabletext"><?php echo $myrow[35] ?></td>
<td><span class="labeltext"><p align="left">QA NC Ref#</p></font></td>
<td><span class="tabletext"><?php echo $myrow[34] ?></td>
</tr>
<?php
if($myrow[38] != '0000-00-00' && $myrow[38] != '' && $myrow[38] != 'NULL')
{
$datearr = split('-', $myrow[38]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$date2=date("M j, Y",$x);
}
else
{
$date2 = '';
}
if($myrow[39] != '0000-00-00' && $myrow[39] != '' && $myrow[39] != 'NULL')
{
$datearr = split('-', $myrow[39]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$convertdate=date("M j, Y",$x);
}
else
{
$convertdate = '';
}
if($myrow[41] != '0000-00-00' && $myrow[41] != '' && $myrow[41] != 'NULL')
{
$datearr = split('-', $myrow[41]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$dategrn=date("M j, Y",$x);
}
else
{
$dategrn = '';
}
if($myrow[43] != '0000-00-00' && $myrow[43] != '' && $myrow[43] != 'NULL')
{
$datearr = split('-', $myrow[43]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$rm_date=date("M j, Y",$x);
}
else
{
$rm_date = '';
}
if($myrow[45] != '0000-00-00' && $myrow[45] != '' && $myrow[45] != 'NULL'&& $myrow[45] != 0)
{
$datearr = split('-', $myrow[45]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$dategrn_check=date("M j, Y",$x);
}
else
{
$dategrn_check = '';
}
//echo $myrow[45]."date-------------";
if($myrow[51] !='')
{


?>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">PRN</p></font></td>
<td><span class="tabletext"><?php echo $myrow[36] ?></td>
<td><span class="labeltext"><p align="left">Alternate PRN</p></font></td>
<td><span class="tabletext"><?php echo $myrow[50] ?></td>
</tr>
<?php
}
else
{
?>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">PRN</p></font></td>
<td><span class="tabletext"><?php echo $myrow[36] ?></td>
<td><span class="labeltext"><p align="left">PO PRN</p></font></td>
<td><span class="tabletext"><?php echo $myrow[52] ?></td>
</tr>
<?php
}
?>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">RM Checked By</p></font></td>
<td><span class="tabletext"><?php echo $myrow[42] ?></td>
<td><span class="labeltext"><p align="left">RM Checked Date</p></font></td>
<td><span class="tabletext"><?php echo $rm_date ?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">GRN Checked By</p></font></td>
<td><span class="tabletext"><?php echo $myrow[44] ?></td>
<td><span class="labeltext"><p align="left">GRN Checked Date</p></font></td>
<td><span class="tabletext"><?php echo $dategrn_check ?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">RM Cost</p></font></td>
<td><span class="tabletext"><?php echo $myrow[47] .' '. $myrow[46] ?></td>    
<td><span class="labeltext"><p align="left">WO Ref</p></font></td>
<td><span class="tabletext"><?php echo $myrow[57]?></td>

</tr>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Quarantine Remarks</p></font></td>
<td><textarea style=";background-color:#DDDDDD;" readonly="readonly"
name="quarremarks" id ="quarremarks" size=20><?php echo $myrow[40] ?></textarea></td>
<td><span class="labeltext"><p align="left">Conversion(to Regular) Date</p></font></td>
<td><span class="tabletext"><?php echo $convertdate ?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Quarantined Date</p></font></td>
<td><span class="tabletext"><?php echo $dategrn ?></td>
<td width=20%><span class="labeltext"><p align="left">Status</p></font></td>
<td bgcolor="#00FF00" width=20%><span class="tabletext"><b><?php echo $status ?></b></td>
</tr>
<?php
if($myrow[54] !='0000-00-00' && $myrow[54] !='')
{             
$datearr=split('-',$myrow[54]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$app_date=date("M j,Y",$x);
$pur_app=$myrow[55] . " , " .  $app_date ;
}
else
{
$app_date="";
$pur_app='';
}			
if($myrow[61] !='0000-00-00' && $myrow[61] !='')
{             
$datearr=split('-',$myrow[61]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$cad_app_date=date("M j,Y",$x);
$cad_app=$myrow[60] . " , " .  $cad_app_date ;

}
else
{
$cad_app_date="";
$cad_app='';
}
?>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Purchasing Approved </p></font></td>
<td><span class="tabletext"><?php echo $myrow[48]  ?></td>
<td><span class="labeltext"><p align="left">Approved By & Date </p></font></td>
<td><span class="tabletext"><?php echo $pur_app  ?></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">CAD Approved </p></font></td>
<td><span class="tabletext"><?php echo $myrow[59]  ?></td>
<td><span class="labeltext"><p align="left">Approved By & Date </p></font></td>
<td><span class="tabletext"><?php echo $cad_app   ?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Approval Remarks</p></font></td>
<td colspan=3><textarea name="approval_remarks" id="approval_remarks" rows=3 cols=40 style="background-color:#DDDDDD;" readonly="readonly" ><?php echo trim($myrow[53]) ?></textarea>
</td>
</tr> 


<?
$remain_qty='';
$qty_res='';
while($myrowgrnli_det = mysql_fetch_row($grnli_det))
{
if($myrowgrn[52] !="")
{
$crn4po=$myrowgrn[52];
}
else
{
$crn4po=$myrowgrn[36];
}
$remarks='';
$result_rmpo=$newgrn->getrmpoDetails($crn4po,$myrowgrn[30],$myrowgrn[49]);
$myrowpo = mysql_fetch_assoc($result_rmpo);
if($myrowpo["no_of_meterages"] != '0.00' && $myrowpo["no_of_meterages"] != '0' && $myrowpo["no_of_meterages"] != '' )
{
$rmpo_qty= $myrowpo["no_of_meterages"];                     
}else
{
$rmpo_qty= $myrowpo["no_of_lengths"];                  
}
$qty_res +=$myrowgrnli_det[1];

} 
if($rmpo_qty !='')
{
$calc=$qty_res-$rmpo_qty;
//echo $qty_res.'===='.$rmpo_qty.'<br/>';
$remain_qty = ($calc*100)/$rmpo_qty;
//echo $remain_qty.'---------';
}

//echo $remain_qty.'---------';
if($remain_qty >= 1 && $remain_qty <=10)
{
$remarks='The quantity received is more to purchase order and it  is within the 10%,  it is acceptable';
}
//echo $remain_qty;
if($remarks !='')
{?>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Remarks </p></font></td>
<td><textarea readonly="readonly" name="remarks" id ="remarks" size=30 cols=25 rows=5  class="t1"><?= $remarks ?></textarea></td>
<td colspan=2></td>
</tr>
<?}	
printf('<tr  bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Notes for %s</b></center></td></tr>',$myrow[25]);
$grn_notes = $newgrn->getNotes($grnrecnum);
printf('<tr bgcolor="#FFFFFF"><td colspan=8><textarea name="notes1" rows="6" cols="100"  readonly="readonly" >');
while ($mynotes = mysql_fetch_row($grn_notes))
{         
print("\n");
print("********Added by $mynotes[2] *********** on $mynotes[1] ");
print("\n");
print(" $mynotes[0]");
print("   \n");
}
?>
</textarea></td>
</tr>
<table width=100% border=0 cellpadding=3 cellspacing=1  class="stdtable">
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Unit RM Size</b></center></td>
</tr>

<tr bgcolor="#FFFFFF">


<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr>
<thead>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b><center>Seq No.</center></b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b><center>Amend <br>Line#</center></b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b><center>Layout <br>Ref#</center></b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b><center>PartNo.</center></b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b><center>Part Desc</center></b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b><center>Batchnum</center></b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b><center>UOM</center></b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b><center>Exp Dt</center></b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b><center>No Of<br>Pieces</center></b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b><center>Dim1<br>L</center></b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b><center>Dim2<br>W/ID</center></b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b><center>Dim3<br>T/OD</center></b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b><center>Qty</center></b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b><center>Qty/Billet</center></b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b><center>Qty Rej</center></b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b><center>QTM</center></b></td>
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>Amend Stat</center></b></td>-->
</tr>
</thead>

<?php
$total=0; $i=0;
while ($myrow = mysql_fetch_row($grnli))
{
?>
<tr>
<td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[0] ? $myrow[0] : ' ' ?></td>
<td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[17] ? $myrow[17] : ' ' ?></td>
<td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[18] ? $myrow[18] : ' ' ?></td>
<td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[11] ? $myrow[11] : ' ' ?></td>
<td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[12] ? $myrow[12] : ' ' ?></td>
<td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[13] ? $myrow[13] : ' ' ?></td>
<td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[14] ? $myrow[14] : ' ' ?></td>
<td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[15] ? $myrow[15] : ' ' ?></td>
<td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[20] ? $myrow[20] : ' ' ?></td>
<td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[2] ? $myrow[2] : ' ' ?></td>
<td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[3] ? $myrow[3] : ' ' ?></td>
<td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[4] ? $myrow[4] : ' ' ?></td>
<td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[1] ? $myrow[1] : ' ' ?></td>
<td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[10] ? $myrow[10] : ' ' ?></td>
<td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[8] ? $myrow[8] : ' ' ?></td>
<td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[9] ? $myrow[9] : ' ' ?></td>
<input type="hidden" id="qty_to_make<?php echo $i?>" name="qty_to_make<?php echo $i?>" value="<?php echo $myrow[9] ?>" size=5 >
<input type="hidden" id="line_num<?php echo $i?>" name="line_num<?php echo $i?>" value="<?php echo $myrow[0] ?>" size=2>
<input type="hidden" id="amend_line_num<?php echo $i?>" name="amend_line_num<?php echo $i?>" value="<?php echo $myrow[17] ?>" size=2></td>
<!--<td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[19] ? $myrow[19] : ' ' ?></td> -->
</tr>
<?php
// echo$myrow[17]."S".$total;
if($myrow[17] =='')
{
$total = $total + $myrow[9];
}
//echo$total."T";

}
$i++;
echo "<input type=\"hidden\" name=\"index\" id=\"index\" value=$i>";

?>
<tr bgcolor="#FFFFFF">
<td colspan=15 align=right class=labeltext>Total Qty</td>
<td align=center class=tabletext><?php echo $total ?>
<input type=hidden name=total_qty_make id=total_qty_make value='<?php echo $total?>'</td>


</tr>


<?php

$row=mysql_fetch_object($cofc);
$dimenssion=$row->dimensional;
$ndt=$row->ndt;
$visual=$row->visual;
$grain=$row->grain;
$mech=$row->mech;
$conductivity=$row->conductivity;
$chemical=$row->chemical;
$hardness=$row->hardness;
$quantity=$row->quantity;
$temper=$row->temper;
$cus=$row->cusserial;
$from=$row->frmserial;
$to=$row->toserial;
$noncon=$row->noncon;
$ncref=$row->ncref;
$ncdate=$row->ncdate;
$comm=$row->comm;
$dcomm=$row->dcomm;
$remarks=$row->remarks;
$approval=$row->approval;

if($ncdate != '0000-00-00' && $ncdate != '' && $ncdate != 'NULL')
{
$datearr = split('-', $ncdate);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$date1=date("M j, Y",$x);
}
else
{
$date1 = '';
}
?>
<!-- <table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">

<tr bgcolor="#DDDEDD">
<td align="center" colspan=8><span class="heading"><b>Validation of Certificate of Compliance by RM Supplier</b></span></td>

</tr>
<tr bgcolor="#FFFFFF">
<td  width=30%> <span class="heading"><b><left>Standard for Verification</left></b></td>
<td width=70% colspan=7> <span class="heading"><b><left></left></b></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=35%><span class="labeltext"><p align="left">Description</p></td>

<td width=5%> <span class="labeltext"><p align="left">Yes</p></td>
<td width=5%> <span class="labeltext"><p align="left">No</p></td>
<td width=5%> <span class="labeltext"><p align="left">N/A</p></td>
<td width=35%> <span class="labeltext"><p align="left">Description</p></td>
<td width=5%> <span class="labeltext"><p align="left">Yes</p></td>
<td width=5%> <span class="labeltext"><p align="left">No</p></td>
<td width=5%> <span class="labeltext"><p align="left">N/A</p></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=35%><span class="tabletext"><p align="left">Dimensional Inspection</p></td>
<td width=5%> <b><?php if($dimenssion==1){?><input name="dimensional" type="radio" value="1" checked="checked"><? }?></b></td>
<td width=5%> <b><?php if($dimenssion==2){?><input name="dimensional" type="radio" value="1" checked="checked"><? }?></b></td>
<td width=5%> <b><?php if($dimenssion==3){?><input name="dimensional" type="radio" value="1" checked="checked"><? }?></b></td>
<td width=35%> <span class="tabletext"><p align="left">NDT Procedures correct,where applicable</p></td>
<td width=5%> <b><?php if($ndt==1){?><input name="ndt" type="radio" value="1" checked="checked"><? }?></b></td>
<td width=5%> <b><?php if($ndt==2){?><input name="ndt" type="radio" value="1" checked="checked"><? }?></b></td>
<td width=5%> <b><?php if($ndt==3){?><input name="ndt" type="radio" value="1" checked="checked"><? }?></b></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=35%><span class="tabletext"><p align="left">Visual Examination for Omission of Damages</p></td>
<td width=5%> <b><?php if($visual==1){?><input name="visual" type="radio" value="1" checked="checked"><? }?></b></td>
<td width=5%> <b><?php if($visual==2){?><input name="visual" type="radio" value="1" checked="checked"><? }?></b></td>
<td width=5%> <b><?php if($visual==3){?><input name="visual" type="radio" value="1" checked="checked"><? }?></b></td>
<td width=35%> <span class="tabletext"><p align="left">Is Grain Flow Mentioned</p></td>
<td width=5%> <b><?php if($grain==1){?><input name="grain" type="radio" value="1" checked="checked"><? }?></b></td>
<td width=5%> <b><?php if($grain==2){?><input name="grain" type="radio" value="1" checked="checked"><? }?></b></td>
<td width=5%> <b><?php if($grain==3){?><input name="grain" type="radio" value="1" checked="checked"><? }?></b></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=30%><span class="tabletext"><p align="left">Mechanical Properties verified against Standered</p></td>
<td width=5%> <b><?php if($mech==1){?><input name="mechanical" type="radio" value="1" checked="checked"><? }?></b></td>
<td width=5%> <b><?php if($mech==2){?><input name="mechanical" type="radio" value="1" checked="checked"><? }?></b></td>
<td width=5%> <b><?php if($mech==3){?><input name="mechanical" type="radio" value="1" checked="checked"><? }?></b></td>
<td width=30%> <span class="tabletext"><p align="left">Conductivity</p></td>
<td width=5%> <b><?php if($conductivity==1){?><input name="conductivity" type="radio" value="1" checked="checked"><? }?></b></td>
<td width=5%> <b><?php if($conductivity==2){?><input name="conductivity" type="radio" value="1" checked="checked"><? }?></b></td>
<td width=5%> <b><?php if($conductivity==3){?><input name="conductivity" type="radio" value="1" checked="checked"><? }?></b></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=30%><span class="tabletext"><p align="left">Chemical Properties verified against Standered</p></td>
<td width=5%> <b><?php if($chemical==1){?><input name="chemical" type="radio" value="1" checked="checked"></b><? }?></td>
<td width=5%> <b><?php if($chemical==2){?><input name="chemical" type="radio" value="1" checked="checked"></b><? }?></b></td>
<td width=5%> <b><?php if($chemical==3){?><input name="chemical" type="radio" value="1" checked="checked"></b><? }?></b></td>
<td width=30%> <span class="tabletext"><p align="left">Hardness</p></td>
<td width=5%> <b><?php if($hardness==1){?><input name="hardness" type="radio" value="1" checked="checked"><? }?></b></td>
<td width=5%> <b><?php if($hardness==2){?><input name="hardness" type="radio" value="1" checked="checked"><? }?></b></td>
<td width=5%> <b><?php if($hardness==3){?><input name="hardness" type="radio" value="1" checked="checked"><? }?></b></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=30%><span class="tabletext"><p align="left">Quantity received agrees with Certification</p></td>
<td width=5%> <b><?php if($quantity==1){?><input name="quantity" type="radio" value="1" checked="checked"></b><? }?></td>
<td width=5%> <b><?php if($quantity==2){?><input name="quantity" type="radio" value="1" checked="checked"></b><? }?></b></td>
<td width=5%> <b><?php if($quantity==3){?><input name="quantity" type="radio" value="1" checked="checked"></b><? }?></b></td>
<td width=30%> <span class="tabletext"><p align="left">Temper</p></td>
<td width=5%> <b><?php if($temper==1){?><input name="temper" type="radio" value="1" checked="checked"><? }?></b></td>
<td width=5%> <b><?php if($temper==2){?><input name="temper" type="radio" value="1" checked="checked"><? }?></b></td>
<td width=5%> <b><?php if($temper==3){?><input name="temper" type="radio" value="1" checked="checked"><? }?></b></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=30%><span class="tabletext"><p align="left">Serialization Requirements?</p></td>
<td width=10% colspan="2"><span class="tabletext"><p align="left">Customer Serialization</p></td>

<td  width="%"><span class="tabletext"><?php if($cus==1){?>Yes<input name="cus" type="radio" value="1" checked="checked" ><? }?><br>
<span class="labeltext"><?php if($cus==2){?>No &nbsp;<input name="cus" type="radio" value="1" checked="checked" ><? }?></td>

<td width=30%><span class="tabletext"><p align="left">CIM Serialization
<span class="tabletext">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if($cus==3){?>Yes<input name="cus" type="radio" value="1" checked="checked" ><? }?>
<span class="tabletext"><?php if($cus==4){?>No<input name="cim" type="hidden" value="2" checked="checked"><input name="cus" type="radio" value="1" checked="checked" ><? }?>
</p></td>
<td width=8% colspan="2"> <span class="tabletext"><p align="left">Serialization not Required</p></td>
<td width=3%> <b><?php if($cus==5){?><input name="cus" type="radio" value="1" checked="checked" ><? }?></b></td>
</tr><input name="not" type="hidden" value="5" >
<tr bgcolor="#FFFFFF">
<td width=30%><span class="tabletext"><p align="left">If yes Mention Serial No. </p></td>
<td width=5% colspan=2> <span class="tabletext"><p align="left">From </p></td>
<td width=5%> <span class="tabletext"><p align="left"><? echo $from?>  </p></td>
<td width=20% colspan=1> <span class="tabletext"><p align="left">To</p></td>
<td width=20% colspan=3> <span class="tabletext"><p align="left"><span class="tabletext"><? echo $to?>  </p></td>

</tr>
<tr bgcolor="#DDDEDD">
<td align="center" colspan=8><span class="heading"><b>Non-Conformance</b></span></td>
<tr bgcolor="#DDDEDD">
<td><span class="tabletext">
<a href="grndownloadxls.php?grnrecnum=<?php echo $grnrecnum ?>">Export To Excel</td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=30%><span class="labeltext"><p align="left">Are any Non Conformance Observed</p></td>
<td width=6%> <span class="labeltext"><b><?php if($noncon==1){?>Yes</b></span>
<input name="conformance" type="radio" value="1" checked="checked"><? }?></td>
<td width=5% colspan=2> <b><span class="labeltext"><b><?php if($noncon==2){?>No</b></span>
<input name="conformance" type="radio" value="1" checked="checked"><? }?></b></span>

</b></td>

<td width=5% align=top><b><span class="labeltext">NCR Ref No.</b> </td>
<td width=5% align=top><b><span class="tabletext"><?  echo $ncref?></span><br></td>
<td width=5% align=top><b><span class="labeltext">NCR Date</b> </td>
<td width=5% align=top><b><span class="tabletext"><?  echo $date1?>  </span></td>
&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=30% colspan=4><span class="labeltext"><p align="left">Is the Observed Non-Conformance communicated to the respective authorities</p></td>
<td colspan=6> <b><span class="labeltext"><?php if($comm==1){?>Yes<input name="comm" type="radio" value="1" checked="checked"><? }?></b>
<span class="labeltext"><?php if($comm==2){?>No<input name="comm" type="radio" value="1" checked="checked"><? }?> <b></b></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=30%><span class="labeltext"><p align="left">Details of Communication</p></td>
<td width=5% colspan=12> <span class="tabletext"><?  echo $dcomm?>  </span></td>

</tr>
<tr bgcolor="#FFFFFF">
<td width=30%><span class="labeltext"><p align="left">Additional Notes/Remarks</p></td>
<td width=5% colspan=7> <span class="tabletext"><?  echo $remarks?>  </span></td>

</tr>
<tr bgcolor="#FFFFFF">
<td width=30%><span class="labeltext"><p align="left">Authorised Signatory With Date<br>
(Store Department)</p></td>
<td width=5% colspan=7 class=tabletext><?echo $approval?></td>

</tr>

</table>
</td>
</tr> -->


<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">

<tr bgcolor="#DDDEDD">
<td height="34" colspan=8><span class="heading">
<center><b>Material Issue</b></center></td>
</tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">

<tr>
<thead>
<th class="head0" align=center><span class="labeltext">Line Num</font></th>
<th class="head1" bgcolor="#FFFFFF" align=center><span class="labeltext">WO Num</font></th>
<th class="head0" align=center><span class="labeltext">WO Date</font></th>
<th class="head1" bgcolor="#FFFFFF" align=center><span class="labeltext">QTY Issued</font></th>
<!-- <th class="head0" bgcolor="#FFFFFF" align=center><span class="labeltext">QTY Accepted</font></th> -->
<th class="head1" bgcolor="#FFFFFF" align=center><span class="labeltext">Rework</font></th>
<th class="head0" bgcolor="#FFFFFF" align=center><span class="labeltext">QTY Rejected</font></th>
<th class="head1" bgcolor="#FFFFFF" align=center><span class="labeltext">QTY Returned</font></th>
<th class="head0" bgcolor="#FFFFFF" align=center><span class="labeltext">Balance</font></th>
</tr>
</thead>
<?php
$i=1;
while($myrow3 = mysql_fetch_row($result3))
{

if($myrow3[1] != '0000-00-00' && $myrow3[1] != '' && $myrow3[1] != 'NULL')
{
$datearr = split('-', $myrow3[1]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$date1=date("M j, Y",$x);
}
else
{
$date1 = '';
}

?>
<tr bgcolor="#FFFFFF">
<td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $i ?></td>
<td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow3[0] ?></td>
<td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $date1 ?></td>
<td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow3[6] ?></td>
<!-- <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow3[2] ?></td> -->
<td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow3[3] ?></td>
<td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow3[4] ?></td>
<td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow3[5] ?></td>
<td align=center><span class="tabletext"><?php echo ($total-$myrow3[6]+$myrow3[5]) ?></td>
</tr>
<?php

$total = $total-$myrow3[6]+$myrow3[5];
$i++;
}


?>

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
<table>
<?php
//echo $myrowgrn[51]."6555665".$myrowgrn[37];
if($myrowgrn[28] != "" && $myrowgrn[51]=='')
{
$grnli_det = $newgrn->getgrnli($grnrecnum);
while($myrowgrnli_det = mysql_fetch_row($grnli_det))
{ 
$crn4po="";
//echo $myrowgrn[36]."--------------".$myrowgrn[52];
if($myrowgrn[52] !="")
{
$crn4po=$myrowgrn[52];
}
else
{
$crn4po=$myrowgrn[36];
}
$result_po=$newgrn->getpo_details($myrowgrn[30]);
$grn_qty=$newgrn->getpogrndetails($myrowgrn[30],$crn4po,$myrowgrn[25]);
//echo $grn_qty."*------------";
if($result_po == '')
{
echo "<table border=1><tr><td><font color=#FF0000>";
echo "PO Number Does Not Exist" ;
echo "</td></tr></table>";
}
else
{
$result_crn_line=$newgrn->getcrn_line_num($crn4po,$myrowgrn[30],$myrowgrn[49]);
if(mysql_num_rows($result_crn_line) > 0)
{
?>


<tr bgcolor="#DDDDDD"><td><span class="pageheading"><b>RM PO Comparison</b></td></tr>
<tr><td>

<table style="width:1000px" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr>
<thead>
<th class="head0" width=60px bgcolor="#EEEFEE"><span class="tabletext"><b>PO#</b></th>
<th class="head1" width=40px bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></th>
<?php
if($myrowgrn[35]=='Consummables')
{
?>
<th class="head0" width=80px bgcolor="#EEEFEE"><span class="tabletext"><b>Supplier</b></th>
<?php
}
?>
<th class="head1" width=120px bgcolor="#EEEFEE"><span class="tabletext"><b>Supplier</b></th>
<th class="head0" width=180px bgcolor="#EEEFEE"><span class="tabletext"><b>RM Spec</b></th>
<th class="head1" width=180px bgcolor="#EEEFEE"><span class="tabletext"><b>RM Type</b></th>
<th class="head0" width=20px bgcolor="#EEEFEE"><span class="tabletext"><b></b></th>
<th class="head1" width=30px bgcolor="#EEEFEE"><span class="tabletext"><b>UOM</b></th>
<th class="head0" width=30px bgcolor="#EEEFEE"><span class="tabletext"><b>Length</b></th>
<th class="head1" width=30px bgcolor="#EEEFEE"><span class="tabletext"><b>Width</b></th>
<th class="head0" width=50px bgcolor="#EEEFEE"><span class="tabletext"><b>Thickness</b></th>
<th class="head1" width=45px bgcolor="#EEEFEE"><span class="tabletext"><b>PO(unit) <br>Price</b></th>
<th class="head0" width=20px bgcolor="#EEEFEE"><span class="tabletext"><b>Qty</b></th>
</tr>
</thead>
<?php

$result_rmpo=$newgrn->getrmpoDetails($crn4po,$myrowgrn[30],$myrowgrn[49]);
$resultprtnum=$newgrn->getcrnpartnum($crn4po);
$myrowpo = mysql_fetch_assoc($result_rmpo);
if($myrowpo["no_of_meterages"] != '0.00' && $myrowpo["no_of_meterages"] != '0' && $myrowpo["no_of_meterages"] != '' )
{
$rmpo_qty= $myrowpo["no_of_meterages"];
//echo $rmpo_qty."11111";
}else
{
$rmpo_qty= $myrowpo["no_of_lengths"];
//echo $rmpo_qty."22222";
}
$currency = array("$");
$po_price = str_replace($currency, "", $myrowpo["rate"]);
$cname=wordwrap($myrowpo["name"],25,"<br>\n",true);
$pormspec=wordwrap($myrowpo["material_spec"],50,"<br>\n",true);

?>
<tr bgcolor="#FFFFFF">
<td width=60px ><span class="tabletext"><?php echo $myrowpo["ponum"] ?></td>
<td width=40px ><span class="tabletext"><?php echo $myrowpo["crn"]?></td>
<?php
if($myrowgrn[35]=='Consummables')
{

?>
<td width=80px bgcolor="#EEEFEE"><span class="tabletext"><?php echo $resultprtnum ?></td>
<?php
}
?>
<td width=120px ><span class="tabletext"><?php echo $cname ?></td>
<td width=180px><span class="tabletext"><?php echo $pormspec ?></td>
<td width=100px><span class="tabletext"><?php echo $myrowpo["material_ref"] ?></td>
<td width=20px><span class="tabletext"></td>
<td width=30px><span class="tabletext"><?php echo $myrowpo["uom"] ?></td>
<td width=30px><span class="tabletext"><?php echo $myrowpo["width"] ?></td>
<td width=30px><span class="tabletext"><?php echo $myrowpo["length"] ?></td>
<td width=50px><span class="tabletext"><?php echo $myrowpo["thick"] ?></td>
<td width=45px><span class="tabletext"><?php echo $po_price?></td>
<td width=20px><span class="tabletext"><?php echo $rmpo_qty ?></td>


</tr>

<tr>
<th class="head0" width=60px bgcolor="#EEEFEE"><span class="tabletext"><b>CIM PO#</b></th>
<th class="head1" width=40px bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></th>
<?php
if($myrowgrn[35]=='Consummables')
{
?>
<th class="head0" width=80px bgcolor="#EEEFEE"><span class="tabletext"><b>Supplier</b></th>
<?php
}
?>
<th class="head1" width=120px bgcolor="#EEEFEE"><span class="tabletext"><b>Supplier</b></th>
<th class="head0" width=180px bgcolor="#EEEFEE"><span class="tabletext"><b>RM Spec</b></th>
<th class="head1" width=100px bgcolor="#EEEFEE"><span class="tabletext"><b>RM Type</b></th>
<th class="head0" width=20px bgcolor="#EEEFEE"><span class="tabletext"><b>Seq</b></th>
<th class="head1" width=30px bgcolor="#EEEFEE"><span class="tabletext"><b>UOM</b></th>
<th class="head0" width=30px bgcolor="#EEEFEE"><span class="tabletext"><b>Length</b></th>
<th class="head1" width=30px bgcolor="#EEEFEE"><span class="tabletext"><b>Width</b></th>
<th class="head0" width=50px bgcolor="#EEEFEE"><span class="tabletext"><b>Thickness</b></th>
<th class="head1" width=45px bgcolor="#EEEFEE"><span class="tabletext"><b>GRN(unit) <br>Price</b></th>
<th class="head0" width=20px bgcolor="#EEEFEE"><span class="tabletext"><b>Qty</b></th>
</tr>
</thead>
<?php

$count1 =10/100;
$count2 = $count1 * $rmpo_qty;
//echo $count2;
$count = round($count2, 0);
//echo $count."<br>".$rmpo_qty."///////////";
$final_rmpoqty= $count+$rmpo_qty;
//echo $final_rmpoqty."************".$grn_qty;
//echo ($myrowgrnli_det[11]."-----------");

$cname_grn=wordwrap($myrowgrn[23],25,"<br>\n",true);
echo "<td bgcolor=\"#FFFFFF\" width=60px><span class=\"tabletext\">$myrowgrn[30] </td>";
echo "<td bgcolor=\"#FFFFFF\" width=40px><span class=\"tabletext\">$myrowgrn[36]</td>";
if($myrowgrn[35]=='Consummables')
{
if((trim(strtoupper((preg_replace($pattern,"", $resultprtnum)))) != trim(strtoupper((preg_replace($pattern,"", $myrowgrnli_det[11]))))))
{
//echo "<table border=1><tr><td><font color=#FF0000>";
echo "<td bgcolor=\"#FF0000\" width=30px><span class=\"tabletext\">$myrowgrnli_det[11]</td>";
//$match_flag = 1;
}
else{

echo "<td bgcolor=\"#FFFFFF\" width=20px><span class=\"tabletext\">$myrowgrnli_det[11]</td>";
}
}
if((trim(strtoupper($myrowpo['link2vendor'])) != trim(strtoupper($myrowgrn[24]))))
{
echo "<td bgcolor=\"#FF0000\" width=120px><span class=\"tabletext\">$cname_grn</td>";
//$match_flag = 1;
}
else{

echo "<td bgcolor=\"#FFFFFF\" width=120px><span class=\"tabletext\">$cname_grn</td>";
}

$grnrmspec=wordwrap($myrowgrn[5],50,"<br>\n",true);
if((trim(strtoupper((preg_replace($pattern,"", $myrowpo['material_spec'])))) != trim(strtoupper((preg_replace($pattern,"", $myrowgrn[5]))))))
{
//echo "<table border=1><tr><td><font color=#FF0000>";
echo "<td bgcolor=\"#FF0000\" width=80px><span class=\"tabletext\">$grnrmspec</td>";
//$match_flag = 1;
}
else{

echo "<td bgcolor=\"#FFFFFF\" width=80px><span class=\"tabletext\">$grnrmspec</td>";
}
if((trim(strtoupper((preg_replace($pattern,"", $myrowpo['material_ref'])))) != trim(strtoupper((preg_replace($pattern,"", $myrowgrn[4]))))))
{
echo "<td bgcolor=\"#FF0000\" width=80px><span class=\"tabletext\">$myrowgrn[4]</td>";
//$match_flag = 1;
}
else{

echo "<td bgcolor=\"#FFFFFF\" width=80px><span class=\"tabletext\">$myrowgrn[4]</td>";
}
echo "<td bgcolor=\"#FFFFFF\" width=20px><span class=\"tabletext\">$myrowgrnli_det[0]</td>";
if((trim(strtoupper((preg_replace($pattern,"", $myrowpo['uom'])))) != trim(strtoupper((preg_replace($pattern,"", $myrowgrnli_det[14]))))))
{
//echo "<table border=1><tr><td><font color=#FF0000>";
echo "<td bgcolor=\"#FF0000\" width=30px><span class=\"tabletext\">$myrowgrnli_det[14]</td>";
//$match_flag = 1;
}
else{

echo "<td bgcolor=\"#FFFFFF\" width=20px><span class=\"tabletext\">$myrowgrnli_det[14]</td>";
}
if($myrowpo['length'] == 'STD' || $myrowpo['length'] == 'std')
{
$powidth='0.01'  ;
//echo $powidth."--1--if--loop---".$myrmpo['length']."<br>";
}
else
{
$powidth=$myrowpo['length'];
//echo $powidth."--2--else--loop---".$myrowpo['length'];
}
if($myrowpo['thick'] == 'STD' || $myrowpo['thick'] == 'std')
{
$pothickness='0.01'  ;
//echo $powidth."--1--if--loop---".$myrmpo['length']."<br>";
}
else
{
$pothickness=$myrowpo['thick'];
//echo $powidth."--2--else--loop---".$myrmpo['length'];
}

$finalwidth= ereg_replace("[^0-9 .]", "", $powidth);
$finallength= ereg_replace("[^0-9 .]", "", $myrowpo['width']);
$final_thickness= ereg_replace("[^0-9 .]", "", $pothickness);
//echo $finalwidth."*-*-*-*".$myrowgrnli_det[3];
$min_width=$finalwidth-1;
$max_width=$finalwidth+3;
$min_length=$finallength-1;
$max_length=$finallength+3;
$min_thickness=$final_thickness-1;
$max_thickness=$final_thickness+3;
$mxup=0;
$mxdw=0;

if($myrowpo['length'] != "-" && $myrowpo['length']!="" && $myrowpo['length']!=0)
{
if((trim(strtoupper((preg_replace($pattern2,"", $finallength)))) != trim(strtoupper((preg_replace($pattern2,"", $myrowgrnli_det[2]))))))
{
if((trim(strtoupper((preg_replace($pattern2,"", $min_length))))<= trim(strtoupper((preg_replace($pattern2,"",$myrowgrnli_det[2] )))))
&& (trim(strtoupper((preg_replace($pattern2,"", $max_length)))) >= trim(strtoupper((preg_replace($pattern2,"", $myrowgrnli_det[2]))))))
{
echo "<td bgcolor=\"#FFEBCD\" width=30px><span class=\"tabletext\">$myrowgrnli_det[2]</td>";
}
else
{
echo "<td bgcolor=\"#FF0000\" width=30px><span class=\"tabletext\">$myrowgrnli_det[2]</td>";
}

//$match_flag = 1;
}
else{

echo "<td bgcolor=\"#FFFFFF\" width=30px><span class=\"tabletext\">$myrowgrnli_det[2]</td>";
}
if((trim(strtoupper((preg_replace($pattern2,"", $finalwidth)))) != trim(strtoupper((preg_replace($pattern2,"", $myrowgrnli_det[3]))))))
{//echo"$min_length-------------$max_length-----------$myrowgrnli_det[3]";
if((trim(strtoupper((preg_replace($pattern2,"", $min_width))))<=trim(strtoupper((preg_replace($pattern2,"",$myrowgrnli_det[3] )))))
&& (trim(strtoupper((preg_replace($pattern2,"", $max_width)))) >= trim(strtoupper((preg_replace($pattern2,"", $myrowgrnli_det[3]))))))
{//echo"999999999999999";
echo "<td bgcolor=\"#FFEBCD\" width=30px><span class=\"tabletext\">$myrowgrnli_det[3]</td>";
}
else
{
echo "<td bgcolor=\"#FF0000\" width=30px><span class=\"tabletext\">$myrowgrnli_det[3]</td>";
}

//$match_flag = 1;
}
else{

echo "<td bgcolor=\"#FFFFFF\" width=30px><span class=\"tabletext\">$myrowgrnli_det[3]</td>";
}

if($myrowpo['maxruling'] !="" && $myrowpo['maxruling']!="-")
{
for($th=0;$th<count($thick_pattern);$th++)
{           //echo $myrmpo['maxruling']."-----------".$thick_pattern[$th]."<br>";
$pos = strpos($myrowpo['maxruling'],$thick_pattern[$th]);
if($pos === false) {

}
else
{
//echo $myrmpo['maxruling']."------------";
$thicknessarr = split($thick_pattern[$th], $myrowpo['maxruling']);
$mxup=preg_replace("/[^0-9 .]/", '', $thicknessarr[1]);
$mxdw=preg_replace("/[^0-9 .]/", '', $thicknessarr[0]);
}

}
//echo $mxup."a----n-----s".$minThick."-------".$thickness;
if($mxup==0)
{   $finalmaxruling = preg_replace("/[^0-9 .]/", '', $myrowpo['maxruling']);

if($myrowgrnli_det[4] != $finalmaxruling)
{
if(($myrowgrnli_det[4] < $final_thickness)
|| ($finalmaxruling < $myrowgrnli_det[4]))
{
echo "<td bgcolor=\"#FF0000\" width=50px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
else
{
echo "<td bgcolor=\"#FFEBCD\" width=30px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
}
else
{
echo "<td bgcolor=\"#FFFFFF\" width=30px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
}else
{
//$minThick=preg_replace("/[^0-9 .]/", '', $mxdw);
//echo $mxup."a----n-----s".$minThick."-------".$thickness;
if(($myrowgrnli_det[4] < $mxdw)
|| ($mxup < $myrowgrnli_det[4]))
{
echo "<td bgcolor=\"#FF0000\" width=50px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
else if(($myrowgrnli_det[4] == $mxdw)
|| ($mxup == $myrowgrnli_det[4]))
{
echo "<td bgcolor=\"#FFFFFF\" width=30px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}

else
{
echo "<td bgcolor=\"#FFEBCD\" width=30px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
}
}

else
{
if($myrowgrnli_det[4]!= $final_thickness)
{
if(($min_thickness <= $myrowgrnli_det[4])
&& ($max_thickness >= $myrowgrnli_det[4]))
{
echo "<td bgcolor=\"#FFEBCD\" width=30px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
else
{
echo "<td bgcolor=\"#FF0000\" width=30px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
//$match_flag = 1;
}
else{

echo "<td bgcolor=\"#FFFFFF\" width=50px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
}

}

else
{
if($myrowpo['thick'] == 'STD' || $myrowpo['thick'] == 'std')
{
$pothickness='0.01'  ;
//echo $powidth."--1--if--loop---".$myrmpo['length']."<br>";
}
else
{
$pothickness=$myrowpo['thick'];
//echo $powidth."--2--else--loop---".$myrmpo['length'];
}
$final_thickness= ereg_replace("[^0-9 .]", "", $pothickness);
// echo $final_thickness."2*-*-*-*";
echo "<td bgcolor=\"#FFFFFF\" width=30px><span class=\"tabletext\">$myrowgrnli_det[2]</td>";
echo "<td bgcolor=\"#FFFFFF\" width=30px><span class=\"tabletext\">$myrowgrnli_det[3]</td>";
if($myrowpo['maxruling'] !="" && $myrowpo['maxruling']!="-")
{
for($th=0;$th<count($thick_pattern);$th++)
{           //echo $myrmpo['maxruling']."-----------".$thick_pattern[$th]."<br>";
$pos = strpos($myrowpo['maxruling'],$thick_pattern[$th]);
if($pos === false) {

}
else
{
//echo $myrmpo['maxruling']."------------";
$thicknessarr = split($thick_pattern[$th], $myrowpo['maxruling']);
$mxup=ereg_replace("[^0-9 .]", "", $thicknessarr[1]);
$mxdw=ereg_replace("[^0-9 .]", "", $thicknessarr[0]);
}

}
if($mxup==0)
{   $finalmaxruling = ereg_replace("[^0-9 .]", "", $myrowpo['maxruling']);
// echo $myrowgrnli_det[4].'*-*-*--*-*'. $finalmaxruling;
if($myrowgrnli_det[4] != $finalmaxruling)
{
if(($myrowgrnli_det[4] < $final_thickness)
|| ($finalmaxruling < $myrowgrnli_det[4]))
{
echo "<td bgcolor=\"#FF0000\" width=50px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
else
{
echo "<td bgcolor=\"#FFEBCD\" width=30px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
}
else
{
echo "<td bgcolor=\"#FFFFFF\" width=30px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
}else
{
//$minThick=preg_replace("/[^0-9 .]/", '', $mxdw);
//echo $mxup."a----n-----s".$minThick."-------".$thickness;
if(($myrowgrnli_det[4] < $mxdw)
|| ($mxup < $myrowgrnli_det[4]))
{
echo "<td bgcolor=\"#FF0000\" width=50px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
else if(($myrowgrnli_det[4] == $mxdw)
|| ($mxup == $myrowgrnli_det[4]))
{
echo "<td bgcolor=\"#FFFFFF\" width=30px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
else
{
echo "<td bgcolor=\"#FFEBCD\" width=30px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
}
}
/*  $final_maxruling= ereg_replace("[^0-9 .]", "", $myrowpo['maxruling']);
if(($myrowgrnli_det[4] < $final_thickness)
|| ($final_maxruling < $thickness))
{
echo "<td bgcolor=\"#FF0000\" width=50px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
//$match_flag = 1;
}
else{

echo "<td bgcolor=\"#FFFFFF\" width=50px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
}
else
{ //echo $final_thickness."-----"; */
else
{
if($myrowgrnli_det[4]!= $final_thickness)
{
if(($min_thickness <= $myrowgrnli_det[4])
&& ($max_thickness >= $myrowgrnli_det[4]))
{
echo "<td bgcolor=\"#FFEBCD\" width=30px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
else
{
echo "<td bgcolor=\"#FF0000\" width=30px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
//$match_flag = 1;
}
else{

echo "<td bgcolor=\"#FFFFFF\" width=50px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
}


}
$qty_tot +=$myrowgrnli_det[1];


if((trim(strtoupper((preg_replace($pattern2,"", $myrowpo['rate'])))) != trim(strtoupper((preg_replace($pattern2,"", $myrowgrn[46]))))))
{
//echo "<table border=1><tr><td><font color=#FF0000>";
echo "<td bgcolor=\"#FF0000\" width=45px><span class=\"tabletext\">$myrowgrn[46]</td>";
//$match_flag = 1;
}
else{

echo "<td bgcolor=\"#FFFFFF\" width=45px><span class=\"tabletext\">$myrowgrn[46]</td>";
}				  

if(($grn_qty+$myrowgrnli_det[1]) > $final_rmpoqty )
{           
echo "<td bgcolor=\"#FF0000\" width=20px><span class=\"tabletext\">$qty_tot </td>";              
}
else{

echo "<td bgcolor=\"#FFFFFF\" width=20px><span class=\"tabletext\">$qty_tot</td>";

}



?>
</table>
<?php

}
else
{
echo "<table border=1><tr><td><font color=#FF0000>";
echo"The PRN : $myrowgrn[36] with Line Number: $myrowgrnli_det[16] Does Not Exist For Ponum: $myrowgrn[30]";
echo "</td></tr></table>";
}
}

}
}
else if($myrowgrn[51]!='')
{
//echo"HERE----";
while($myrowgrnli_det = mysql_fetch_row($grnli_det))
{ //echo $po_num."*******";
$resultcrndet=$newgrn->getcrnmasterdetails($myrowgrn[36]);
$resultprtnum=$newgrn->getcrnpartnum($myrowgrn[36]);
$mycrmd=mysql_fetch_assoc($resultcrndet);
//$resultrmdet=$newgrn->getrmdcrnetails($myrowgrn[36]);
$resultrmdet=$newgrn->getrmdetails($myrowgrn[36]);
// $myrmdet=mysql_fetch_assoc($resultrmdet);

?>
<tr><td><span class="pageheading"><b>RM Master/PRN Master Details</b></td></tr>
<tr><td>

<table style="table-layout: fixed" width=1200px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">

<tr  bgcolor="#FFCC00">
<td width=40px bgcolor="#EEEFEE"><span class="heading"><b>PRN</b></td>
<td width=180px bgcolor="#EEEFEE"><span class="tabletext"><b>RM Spec</b></td>
<td width=100px bgcolor="#EEEFEE"><span class="tabletext"><b>RM Type</b></td>
<?php
if($myrowgrn[35]=='Consummables')
{
?>
<td width=80px bgcolor="#EEEFEE"><span class="tabletext"><b>Partnum</b></td>
<?php
}
?>
<td width=30px bgcolor="#EEEFEE"><span class="tabletext"><b>Length</b></td>
<td width=30px bgcolor="#EEEFEE"><span class="tabletext"><b>Width</b></td>
<td width=50px bgcolor="#EEEFEE"><span class="tabletext"><b>Thickness</b></td>
</tr>
</table>

<div style="width:1200px; height:150; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=1200px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<?php

?>
<tr bgcolor="#FFFFFF">
<td width=40px ><span class="tabletext"><?php echo $myrowgrn[36]?></td>
<?php
while($myrmdet=mysql_fetch_assoc($resultrmdet))
{  //echo $myrmdet["rm_type"]."****". $myrmdet["rm_spec"]."----------".$myrowgrn[4]."********".$myrowgrn[5];
$detrmspec=wordwrap($myrmdet["rm_spec"],50,"<br>\n",true);
if((trim(strtoupper((preg_replace($pattern,"", $myrmdet["rm_type"])))) == trim(strtoupper((preg_replace($pattern,"", $myrowgrn[4])))))
&&(trim(strtoupper((preg_replace($pattern,"", $myrmdet["rm_spec"])))) == trim(strtoupper((preg_replace($pattern,"", $myrowgrn[5]))))))

{
?>
<td width=180px><span class="tabletext"><?php echo $detrmspec ?></td>
<td width=100px><span class="tabletext"><?php echo $myrmdet["rm_type"] ?></td>
<?php
}
else
{
?>
<td width=180px><span class="tabletext"></td>
<td width=100px><span class="tabletext"></td>
<?php
}
}
if($myrowgrn[35]=='Consummables')
{

?>
<td width=80px bgcolor="#EEEFEE"><span class="tabletext"><?php echo $resultprtnum ?></td>
<?php
}
?>
<td width=30px><span class="tabletext"><?php echo $mycrmd["rm_dim1"] ?></td>
<td width=30px><span class="tabletext"><?php echo $mycrmd["rm_dim2"] ?></td>
<td width=50px><span class="tabletext"><?php echo $mycrmd["rm_dim3"] ?></td>

</tr>


<tr  bgcolor="#FFCC00">
<td width=40px bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
<td width=180px bgcolor="#EEEFEE"><span class="tabletext"><b>RM Spec</b></td>
<td width=100px bgcolor="#EEEFEE"><span class="tabletext"><b>RM Type</b></td>
<?php
if($myrowgrn[35]=='Consummables')
{
?>
<td width=80px bgcolor="#EEEFEE"><span class="tabletext"><b>Partnum</b></td>
<?php
}
?>
<td width=30px bgcolor="#EEEFEE"><span class="tabletext"><b>Length</b></td>
<td width=30px bgcolor="#EEEFEE"><span class="tabletext"><b>Width</b></td>
<td width=50px bgcolor="#EEEFEE"><span class="tabletext"><b>Thickness</b></td>
</tr>

<?php
echo "<td bgcolor=\"#FFFFFF\" width=40px><span class=\"tabletext\">$myrowgrn[36]</td>";

$final_width= ereg_replace("[^0-9 .]", "", $mycrmd['rm_dim2']);
$final_length= ereg_replace("[^0-9 .]", "", $mycrmd['rm_dim1']);
$final_thickness= ereg_replace("[^0-9 .]", "", $mycrmd['rm_dim3']);
$min_width=$final_width-1;
$max_width=$final_width+3;
$min_length=$final_length-1;
$max_length=$final_length+3;
$min_thickness=$final_thickness-1;
$max_thickness=$final_thickness+3;
$mxup=0;
$mxdw=0;
//echo $myrowgrn[5].'*-*---*';
$grnsmspec=wordwrap($myrowgrn[5],50,"<br>\n",true);
if((trim(strtoupper((preg_replace($pattern,"", $myrmdet["rm_spec"] )))) != trim(strtoupper((preg_replace($pattern,"", $myrowgrn[5]))))))
{
//echo "<table border=1><tr><td><font color=#FF0000>";
echo "<td bgcolor=\"#FF0000\" width=180px><span class=\"tabletext\">$myrowgrn[5]</td>";
//$match_flag = 1;
}
else{

echo "<td bgcolor=\"#FFFFFF\" width=180px><span class=\"tabletext\">$myrowgrn[5]</td>";
}
if((trim(strtoupper((preg_replace($pattern,"", $myrmdet["rm_type"] )))) != trim(strtoupper((preg_replace($pattern,"", $myrowgrn[4]))))))
{
echo "<td bgcolor=\"#FF0000\" width=180px><span class=\"tabletext\">$myrowgrn[4]</td>";
//$match_flag = 1;
}
else{

echo "<td bgcolor=\"#FFFFFF\" width=100px><span class=\"tabletext\">$myrowgrn[4]</td>";
}
if($myrowgrn[35]=='Consummables')
{
if((trim(strtoupper((preg_replace($pattern,"", $resultprtnum)))) != trim(strtoupper((preg_replace($pattern,"", $myrowgrnli_det[11]))))))
{
//echo "<table border=1><tr><td><font color=#FF0000>";
echo "<td bgcolor=\"#FF0000\" width=30px><span class=\"tabletext\">$myrowgrnli_det[11]</td>";
//$match_flag = 1;
}
else{

echo "<td bgcolor=\"#FFFFFF\" width=20px><span class=\"tabletext\">$myrowgrnli_det[11]</td>";
}
}             
if($myrowgrnli_det[3] !=0 && $myrowgrnli_det[3]!="" && $myrowgrnli_det[3] !="-")
{//echo $final_width."*-*-*-*-*".$myrowgrnli_det[2];
if($final_length != $myrowgrnli_det[2])
{
if(( $min_length <= $myrowgrnli_det[2])
&& ($max_length >= $myrowgrnli_det[2]))
//if((trim(strtoupper((preg_replace("/[$&*\"\'\/\ ,+]/","", $mycrmd["rm_dim1"])))) != trim(strtoupper((preg_replace("/[$&*\"\'\/\ ,+]/","", $myrowgrnli_det[2]))))))
{
echo "<td bgcolor=\"#FFEBCD\" width=30px><span class=\"tabletext\">$myrowgrnli_det[2]</td>";
//$match_flag = 1;
}
else{

echo "<td bgcolor=\"#FF0000\" width=30px><span class=\"tabletext\">$myrowgrnli_det[2]</td>";
}
}
else{

echo "<td bgcolor=\"#FFFFFF\" width=30px><span class=\"tabletext\">$myrowgrnli_det[2]</td>";
}
if($final_width != $myrowgrnli_det[3])
{

if(($min_width <= $myrowgrnli_det[3])
&& ($max_width >= $myrowgrnli_det[3]))
//if((trim(strtoupper((preg_replace("/[$&*\"\'\/\ ,+]/","", $mycrmd["rm_dim1"])))) != trim(strtoupper((preg_replace("/[$&*\"\'\/\ ,+]/","", $myrowgrnli_det[2]))))))
{
echo "<td bgcolor=\"#FFEBCD\" width=30px><span class=\"tabletext\">$myrowgrnli_det[3]</td>";
//$match_flag = 1;
}
else{

echo "<td bgcolor=\"#FF0000\" width=30px><span class=\"tabletext\">$myrowgrnli_det[3]</td>";
}
//$match_flag = 1;
}
else{

echo "<td bgcolor=\"#FFFFFF\" width=30px><span class=\"tabletext\">$myrowgrnli_det[3]</td>";
}
//echo$mycrmd['maxruling']."----+++<br>".$myrowgrnli_det[4];
if($mycrmd['maxruling'] !="" && $mycrmd['maxruling'] !="-")
{
for($th=0;$th<count($thick_pattern);$th++)
{           //echo count($thick_ness)."-----------".$thick_ness[$th];
$pos = strpos($mycrmd['maxruling'],$thick_pattern[$th]);
if($pos === false) {

}
else
{
$thicknessarr = split($thick_pattern[$th], $mycrmd['maxruling']);
$mxup=ereg_replace("[^0-9 .]", "", $thicknessarr[1]);
$mxdw=ereg_replace("[^0-9 .]", "", $thicknessarr[0]);
}

}

if($mxup==0)
{
$final_maxruling= ereg_replace("[^0-9 .]", "", $mycrmd['maxruling']);
//echo $final_maxruling."1111*****".$myrowgrnli_det[4];
if($myrowgrnli_det[4] !=$final_maxruling )
{
if(($myrowgrnli_det[4]< $final_thickness)
|| ($final_maxruling < $myrowgrnli_det[4]))
{
echo "<td bgcolor=\"#FF0000\" width=30px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
else
{
"<td bgcolor=\"#FFEBCD\" width=30px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
}
else
{
"<td bgcolor=\"#FFFFFF\" width=30px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}

}
else
{

//echo $mxdw."2222----".$mxup."*****".$myrowgrnli_det[4];
if(($myrowgrnli_det[4] < $mxdw)
|| ($mxup < $myrowgrnli_det[4]))
{
echo "<td bgcolor=\"#FF0000\" width=50px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
else  if(($mxdw < $myrowgrnli_det[4])
&& ($mxup > $myrowgrnli_det[4]))
{
echo "<td bgcolor=\"#FFEBCD\" width=30px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
else
{
echo "<td bgcolor=\"#FFFFFF\" width=30px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}

}
}
else
{
if($myrowgrnli_det[4]!= $final_thickness)
{  //echo$max_thickness."-----------------".$min_thickness."-----------------".$myrowgrnli_det[4] ;
if(($min_thickness <= $myrowgrnli_det[4])
&& ($myrowgrnli_det[4] <= $max_thickness))
//if((trim(strtoupper((preg_replace("/[$&*\"\'\/\ ,+]/","", $mycrmd["rm_dim1"])))) != trim(strtoupper((preg_replace("/[$&*\"\'\/\ ,+]/","", $myrowgrnli_det[2]))))))
{
echo "<td bgcolor=\"#FFEBCD\" width=30px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
//$match_flag = 1;
}
else{

echo "<td bgcolor=\"#FF0000\" width=30px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
//$match_flag = 1;
}
else{

echo "<td bgcolor=\"#FFFFFF\" width=50px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";

}
}
}
else
{
echo "<td bgcolor=\"#FFFFFF\" width=50px><span class=\"tabletext\">$myrowgrnli_det[2]</td>";
echo "<td bgcolor=\"#FFFFFF\" width=50px><span class=\"tabletext\">$myrowgrnli_det[3]</td>";
//echo$mycrmd['maxruling']."----+++<br>";
if($mycrmd['maxruling'] !="" && $mycrmd['maxruling'] !="-")
{
for($th=0;$th<count($thick_pattern);$th++)
{           //echo count($thick_ness)."-----------".$thick_ness[$th];
$pos = strpos($mycrmd['maxruling'],$thick_pattern[$th]);
if($pos === false) {

}
else
{
$thicknessarr = split($thick_pattern[$th], $mycrmd['maxruling']);
$mxup=ereg_replace("[^0-9 .]", "", $thicknessarr[1]);
$mxdw=ereg_replace("[^0-9 .]", "", $thicknessarr[0]);
}

}
if($mxup==0)
{ // echo $mxdw."1111----".$mxup."*****".$myrowgrnli_det[4];
$final_maxruling= ereg_replace("[^0-9 .]", "", $mycrmd['maxruling']);
if($myrowgrnli_det[4] !=$final_maxruling )
{
if(($myrowgrnli_det[4]< $final_thickness)
|| ($final_maxruling < $myrowgrnli_det[4]))
{
echo "<td bgcolor=\"#FF0000\" width=30px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
else if(($myrowgrnli_det[4]<= $final_thickness)
&& ($final_maxruling >= $myrowgrnli_det[4]))
{
"<td bgcolor=\"#FFEBCD\" width=30px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
}
else
{
"<td bgcolor=\"#FFFFFF\" width=30px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}

}
else
{
//echo $mxdw."222----".$mxup."*****".$myrowgrnli_det[4];
if(($myrowgrnli_det[4] < $mxdw)
|| ($mxup < $myrowgrnli_det[4]))
{
echo "<td bgcolor=\"#FF0000\" width=50px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
else  if(($mxdw < $myrowgrnli_det[4])
&& ($mxup > $myrowgrnli_det[4]))
{
echo "<td bgcolor=\"#FFEBCD\" width=30px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
else
{
echo "<td bgcolor=\"#FFFFFF\" width=30px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
}
}
else
{
if($myrowgrnli_det[4]!= $mycrmd["rm_dim3"])
{ // echo"$min_thickness --1111----------------$max_thickness-------------$myrowgrnli_det[4]";
if(($min_thickness <= $myrowgrnli_det[4])
&& ($myrowgrnli_det[4] <= $max_thickness))
{
echo "<td bgcolor=\"#FFEBCD\" width=30px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
//$match_flag = 1;
}
else{

echo "<td bgcolor=\"#FF0000\" width=30px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
//$match_flag = 1;
}
else{

echo "<td bgcolor=\"#FFFFFF\" width=50px><span class=\"tabletext\">$myrowgrnli_det[4]</td>";
}
}
}
?>
</table>
<?php
}
}
?>

</table>
<tr bgcolor="#FFFFFF">
<td width=100% colspan=9>
<table width=88% border=3 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<td colspan=2><span class="labeltext"><?php echo $myrow2[31] ?></td>
<td><span class="labeltext">Rev No : <?php echo $myrow2[32] ?></td>
<td align=center colspan=2><span class="labeltext"></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</table>
</form>
</body>
</html>
