<?php

//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2007                =
// Filename: new_grn.php                       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Allows entry of new GRN                     =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];

$_SESSION['pagename'] = 'new_grn';
$page="Stores: GRN";
//////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/grnclass.php');
include('classes/displayClass.php');


$newlogin = new userlogin;
$newlogin->dbconnect();


$newdisplay = new display;

$newgrn = new grn;

$approved =  $dept . ' ' . $userid . ' ' . date('M d, m');
$validate = '0';
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/grn.js"></script>

<script src="http://www.javascriptoo.com/application/html/js/josscrowcroft/accounting.js/accounting.min.js" type="text/javascript"></script>


<html>
<head>
<title>New GRN</title>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0">

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
				<table style="width:80%" border=0 cellpadding=6 cellspacing=0  >
    <tr>
        <td><span class="pageheading"><b>New GRN</b></td>
    </tr>


<form action='processgrn.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table style="width:80%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
      <tr bgcolor="#DDDEDD">
            <td height="10" colspan=4><span class="heading">
              <center><b>GRN Header</b></center></td>
        </tr>
<table style="width:80%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">

		 <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>GRN Classification</p></font>
			<td><span class="tabletext"><input type="text" name="wotype" id="wotype"
                style="background-color:#DDDDDD;" readonly="readonly"  value="">
	             <span class="tabletext"><select name="wotype1" id="wotype1" size="1" width="20" onchange="onSelectWOType('new_grn')">
 	             <option selected>Please Specify
	             <option value="Regular">Regular
	             <option value="Assy">Assy
				 </select>
				 </td>
				 <td><span class="labeltext"><p align="left">GRN Type</p></font>
      <td><span class="tabletext"><input type="text" name="grntype" id="grntype"
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow[35] ?>">
               <span class="tabletext"><select name="grntype1" size="1" width="20" onchange="onSelectGRNType('new_grn')">
               <option selected>Please Specify
               <option value="Regular">Regular
               <option value="Rework">Rework
               <option value="Semifinish">Semifinish
                 <option value="Subcontracted">Subcontracted
         <option value="Consummables">Consummables
         <option value="Quarantined">Quarantined
         <option value="Boughtout">Boughtout
           </select>
           <input type="hidden" name="prevgrntype" id="prevgrntype" value="<?php echo $myrow[35] ?>">
      
            </td>   
      </tr>
        <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>GRN No.</p></font></td>
            <td width=25%><input type="text" name="grnnum" id="grnnum" size=20 value="">
            <input type="hidden" name="parentgrnnum" id="parentgrnnum"  value=""></td>
             <td bgcolor="#FFFFFF"><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Supplier Name</p></font></td>
	         <td colspan=1><span class="tabletext"><input type="text" name="vendor" id="vendor"
		     style=";background-color:#DDDDDD;"
		     readonly="readonly" size=20 value="">
   		     <img src="images/bu-getvendor.gif" id="supplier" alt="Get Vendor" onClick="GetAllVendors()">
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Raw Material Spec</p></font></td>
            <td><input type="text" name="raw_mat_spec" id="raw_mat_spec"  size=20 value=""></td>

            <td><span class="labeltext"><p align="left">Raw Material Type</p></font></td>
            <td><input type="text" name="raw_mat_type" id="raw_mat_type" size=20 value="">
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Raw Material Code</p></font></td>
            <td><input type="text" name="raw_mat_code" id="raw_mat_code" size=20 value=""></td>
            <td><span class="labeltext"><p align="left">COC Ref#</p></font></td>
            <td><input type="text" id="coc_refnum" name="coc_refnum" size=20 value=""></td>

        </tr>

         <tr bgcolor="#FFFFFF">

            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Invoice No.</p></font></td>
            <td><input type="text" name="invoice_num"  id="invoice_num" size=20 value=""></td>
            <td><span class="labeltext"><p align="left"> <span class='asterisk'>*</span>Invoice Date</p></font></td>
            <td><input type="text" name="invoice_date" id="invoice_date" size=20 value="" style="background-color:#DDDDDD;" readonly="readonly">
            <img src="images/bu-getdateicon.gif" alt="Get BookDate" onClick="GetDate('invoice_date')" id="invoice_date1"></td>
        </tr>

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Test Reports & COC</p></font></td>
            <td><input type="text" name="test_report" id="test_report" size=20 value=""></td>
            <td><span class="labeltext"><p align="left"> <span class='asterisk'>*</span>Received Date</p></font></td>
            <td><input type="text" name="recieved_date" id="recieved_date" size=20 value="" style="background-color:#DDDDDD;" readonly="readonly">
                <img src="images/bu-getdateicon.gif" id="recieved_date1" alt="Get BookDate" onClick="GetDate('recieved_date')"></td>

        </tr>
        
        
        <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left">MGP/DC No.</p></font></td>
             <td><input type="text" name="mgp_num" id="mgp_num" size=20 value=""></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Batch No.</p></font></td>
            <td><input type="text" id="batch_num" name="batch_num" size=20 value=""></td>

        </tr>   

        <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RM by Host</p></font></td>
             <td><input type="text"  id="rmbycim" name="rmbycim" size=20 value=""></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RM by Cust</p></font></td>
            <td><input type="text" id="rmbycust"name="rmbycust" size=20 value=""></td>
        </tr>        

        <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Host PO Num</p></font></td>
             <td><input type="text" id="cimponum" name="cimponum" onClick="Getcimponum()" size=20 value=""></td>
             <td><span class="labeltext"><p align="left">RMPO Line#</p></b></td>
            <td><input type="text" id="rmpoline_num"  name="rmpoline_num" value="" size="2%"></td>

       </tr>

       <tr bgcolor="#FFFFFF">
      
            <td><span class="labeltext"><p align="left">QA NC Ref#</p></font></td>
            <td><input type="text" name="nc_refnum" id="nc_refnum" size=20 value="<?php echo $myrow[34] ?>"></td>
            <td><span class="labeltext"><p align="left">Conversion Rate</p></font></td>
  <td colspan=1><input type="text" id="conversion_rate" name="conversion_rate" size=20 value="" onkeyup='getconversion_rate()'></td>

        </tr>

       <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left">PO PRN</p></font></td>
            <td><input type="text" id="pocrn" name="pocrn" size=20 value="" style=";background-color:#DDDDDD;" readonly = 'readonly'>
             <img src='images/bu-get.gif' id="pocrn1" name='cim' onclick='GetCIM4pocrn("<?php echo 'pocrn' ?>")'></td>
             <td><span class="labeltext"><p align="left">PRN</p></font></td>
             <td><input type="text" id="crn" name="crn" size=20 value="" style=";background-color:#DDDDDD;" readonly = 'readonly' >
             <img src='images/bu-get.gif'  id="cim" name='cim' onclick='GetCIM("<?php echo 'crn' ?>")'></td>

        </tr>
         <tr bgcolor="#FFFFFF">
	     <td><span class="labeltext"><p align="left">RM Checked By</p></font></td>
             <td><input type="text" name="rmempcode" id ="rmempcode" size=20 value=""></td>
			 <td><span class="labeltext"><p align="left">RM Checked Date</p></font></td>
	        <td><input type="text" name="rmcheckdate" id="rmcheckdate" size=20
			style=";background-color:#DDDDDD;" readonly="readonly">
            <img  src="images/bu-getdateicon.gif" id="rmcheckdate1" alt="Get RmCheckDate" onClick="GetDate('rmcheckdate')"></td>
         </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Unit RM Cost</p></td>
            <td><input type="text" id="rm_cost" name="rm_cost" size=20 value="">
			<span class="labeltext"><select name="currency" id="currency" size="1" width="100">
                   <option selected>$</option>
                   <option value>Rs</option>
				   </select>
			</td>
   <td><span class="labeltext"><p align="left">Remarks</p></font></td>
            <td><textarea name="remarks" size=20 id="remarks" value=""></textarea></td>
			</tr>
			 <tr bgcolor="#FFFFFF">
	     <td><span class="labeltext"><p align="left">GRN Entered By</p></font></td>
             <td><input type="text" name="grnempcode" id ="grnempcode" size=20 value=""></td>
			 <td><span class="labeltext"><p align="left">GRN Entered Date</p></font></td>
	        <td><input type="text" name="grncheckdate" id="grncheckdate" size=20
			style=";background-color:#DDDDDD;" readonly="readonly">
            <img  src="images/bu-getdateicon.gif" alt="Get GrnCheckDate" id="grncheckdate1" onClick="GetDate('grncheckdate')"></td>
         </tr>

          <tr bgcolor="#FFFFFF">
     <td><span class="labeltext"><p align="left"> Quarantined Date</p></font></td>
            <td><input type="text" name="Quarantined_date" id="Quarantined_date" size=20 value="" style="background-color:#DDDDDD;" >
            <img src="images/bu-getdateicon.gif"  alt="Get BookDate" id="Quarantined_date1" onClick="GetDate('Quarantined_date')"></td>
    <td width=20%><span class="labeltext"><p align="left">Status</p></font></td>
    <td ><span class="tabletext"><input type="text" name="status" id="status"
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow[37] ?>"
	<span class="tabletext"><select name="grnstat" id="grnstat" size="1" width="20" onchange="onSelectStatus()">
 	<option selected>Please Specify
	<option value>Open
	<option value>Closed
	<option value>Cancelled
       	<option value>All
	</select>
 <input type="hidden" name="validate_flag" id="validate_flag" value="0">
 </td>
 </tr>

         
          <tr bgcolor="#FFFFFF">
	     <td><span class="labeltext"><p align="left">Quarantine Remarks</p></font></td>
             <td><textarea name="quarremarks" id ="quarremarks" size=20></textarea></td>
			 <td><span class="labeltext"><p align="left">Conversion(to Regular) Date</p></font></td>
	        <td><input type="text" name="conversion_date" id="conversion_date" size=20
			style=";background-color:#DDDDDD;" readonly="readonly">
            <img  src="images/bu-getdateicon.gif" alt="Get ShippingDate" id="conversion_date1" onClick="GetDate('conversion_date')"></td>
         </tr>
  <tr bgcolor="#FFFFFF">
 <td><span class="labeltext"><p align="left">WO Ref.</p></font></td>
  <td><input type="text" id="wo_ref" name="wo_ref" size=20 value="" style=";background-color:#DDDDDD;">
             <img src='images/getwo.gif' name='WO' onclick='Get_all_wo()'></td>
</td>
<td colspan=2></td>
  </tr>

<!--<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr> -->
<input type="hidden" name="action" value="new">
<input type="hidden" name="vendrecnum" id="vendrecnum">
<?php
 //echo "quotetype:$quotetype";
//$wotype="test2";
// $ctrls=$newpage->createjs4quote("Quote",$quotetype) ;
 //$ctrls=$newpage->createctrls("Quote",$quotetype) ;
//echo "$ctrls";
?>
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>GRN Line Items</b></center></td>
</tr>

<input type="hidden" name="rm_qty_perbill" id="rm_qty_perbill" value=''>
<input type="hidden" name="rm_length" id="rm_length" value=''>
<input type="hidden" name="rm_dia" id="rm_dia" value=''>
<input type="hidden" name="rm_uom" id="rm_uom" value=''>
<input type="hidden" name="rm_width" id="rm_width" value=''>
<input type="hidden" name="rm_thickness" id="rm_thickness" value=''>

<tr bgcolor="#FFFFFF">
</table>
<div style="width:80%; overflow-x: scroll;">
<table id="myTable" class="stdtable1" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Line</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Amend Line</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Layout Ref#</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Partnum</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Part Desc</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Batch</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>UOM</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Exp Date<br>(yyyy-mm-dd)</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>No. Of <br>Peices</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim1(L)</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim2(W/ID)</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim3(T/OD)</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty/Billet</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty Rej</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>QTM</center></b></td>
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>Amend Stat</center></b></td>-->
</tr>
<?php
      $i=1;
      while ($i<=10)
     {

      	   printf('<tr bgcolor="#FFFFFF">');
	   $line_num="line_num" . $i;
	   $amend_line_num="amend_line_num" . $i;
	   $partnum="partnum" . $i;
       $qty="qty" . $i;
       $dim1="dim1" . $i;
       $dim2="dim2" . $i;
       $dim3="dim3" . $i;
       $qty_rej="qty_rej" . $i;
       $qty_to_make="qty_to_make" . $i;
       $qty4billet="qty4billet".$i;
       $partdesc="partdesc" . $i;
	   $batchnum="batchnum" . $i;
	   $uom="uom" . $i;
	   $expdate="expdate" . $i;
	   $rmpoline_num="rmpoline_num" . $i;
	   $layout_ref="layout_ref" . $i;
	   $amendstatus="amendstatus" . $i;
	   $noofpieces="noofpieces" . $i;

       echo "<td><center><span class=\"tabletext\"><input type=\"text\" id=\"$line_num\"  name=\"$line_num\" value=\"\" size=\"2%\"><center></td>";
       echo "<td><center><span class=\"tabletext\"><input type=\"text\" id=\"$amend_line_num\"  name=\"$amend_line_num\" value=\"\" size=\"2%\" onblur=\"javascript:getstat(this,$i);\"><center></td>";
       echo "<td><center><span class=\"tabletext\"><input type=\"text\" id=\"$layout_ref\"  name=\"$layout_ref\" value=\"\" size=\"8%\"><center></td>";
       echo "<td><center><input type=\"text\" id=\"$partnum\" name=\"$partnum\" size=\"6%\" value=\"\"><center></td>";
       echo "<td><center><input type=\"text\" id=\"$partdesc\" name=\"$partdesc\" size=\"25%\" value=\"\"><center></td>";
       echo "<td><center><input type=\"text\" id=\"$batchnum\" name=\"$batchnum\" size=\"6%\" value=\"\"><center></td>";
       echo "<td><center><input type=\"text\" id=\"$uom\" name=\"$uom\" size=\"5%\" value=\"\" onkeyup=\"javascript:getuom(this);\"><center></td>";
       echo "<td><center><input type=\"text\" id=\"$expdate\" name=\"$expdate\" size=\"10%\" value=\"\"><center></td>";
       echo "<td><center><input type=\"text\" id=\"$noofpieces\" name=\"$noofpieces\" size=\"3%\" value=\"\" onkeyup=\"javascript:getQty(this);\"><center></td>";
       echo "<td><center><input type=\"text\" id=\"$dim1\" name=\"$dim1\" size=\"5%\" value=\"\" onkeyup=\"javascript:getQty(this);\"><center></td>";
       echo "<td><center><input type=\"text\" id=\"$dim2\" name=\"$dim2\" size=\"5%\" value=\"\"><center></td>";
       echo "<td><center><input type=\"text\" id=\"$dim3\" name=\"$dim3\" size=\"5%\" value=\"\"><center></td>";
       echo "<td><center><input type=\"text\" id=\"$qty\" name=\"$qty\" size=\"3%\" value=\"\" onkeyup=\"javascript:getqtm_value($i);\" ><center></td>";
       echo "<td><center><input type=\"text\" id=\"$qty4billet\" name=\"$qty4billet\"  size=\"5%\" value=\"\" style=\";background-color:#DDDDDD;\" readonly=\"readonly\"><center></td>";
       echo "<td><center><input type=\"text\" id=\"$qty_rej\" name=\"$qty_rej\"  size=\"5%\" value=\"\"><center></td>";
       echo "<td><center><input type=\"text\" id=\"$qty_to_make\" name=\"$qty_to_make\" size=\"5%\" value=\"\" onblur=\"javascript:get_total(this);\"><center></td>";


      /* echo"<td align=\"center\"><select id=\"$amendstatus\" name=\"$amendstatus\" >
                   <option value=\"Active\">Active</option>
                   <option value=\"Inactive\">Inactive</option>
                </select>
                 </td>"; */
       printf('</tr>');
	   $i++;
     }
echo "<input type=\"hidden\" name=\"index\" id=\"index\" value=$i>";
?>
</div>
</table>

 	<tr bgcolor="#FFFFFF">
  <table style="width:80%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
  <tr bgcolor="#FFFFFF" width=100%>
  <td colspan=6 align=right class=labeltext>Total Qty</td>
  <td colspan=2 align=right><input type=text name=total_qty_make id=total_qty_make size=6%></td>
  </tr>
  <tr bgcolor="#DDDEDD">
  <td align="center" colspan=8><span class="heading"><b>Validation of Certificate of Compliance by RM Supplier</b></span></td>
  </tr>
	<tr bgcolor="#FFFFFF">
	<td  width=30%> <span class="heading"><b><left>Standard for Verification</left></b></td>
	<td width=70% colspan=7> <span class="heading"><b><left></left></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		<td width=35%><span class="tabletext"><p align="left">Description</p></td>

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
	<td width=5%> <b><input name="dimensional" type="radio" value="1" <?php if ($dimenssion==1){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="dimensional" type="radio" value="2" <?php if ($dimenssion==2){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="dimensional" type="radio" value="3" <?php if ($dimenssion==3){?>checked="checked" <?php }?>></b></td>
	<td width=35%> <span class="tabletext"><p align="left">NDT Procedures correct,where applicable</p></td>
	<td width=5%> <b><input name="ndt" type="radio" value="1" <?php if ($ndt==1){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="ndt" type="radio" value="2" <?php if ($ndt==2){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="ndt" type="radio" value="3" <?php if ($ndt==3){?>checked="checked" <?php }?>></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=35%><span class="tabletext"><p align="left">Visual Examination for Omission of Damages</p></td>
	<td width=5%> <b><input name="visual" type="radio" value="1" <?php if ($visual==1){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="visual" type="radio" value="2" <?php if ($visual==2){?>checked="checked" <?php }?> ></b></td>
	<td width=5%> <b><input name="visual" type="radio" value="3" <?php if ($visual==3){?>checked="checked" <?php }?>></b></td>
	<td width=35%> <span class="tabletext"><p align="left">Is Grain Flow Mentioned</p></td>
	<td width=5%> <b><input name="grain" type="radio" value="1" <?php if ($grain==1){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="grain" type="radio" value="2" <?php if ($grain==2){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="grain" type="radio" value="3" <?php if ($grain==3){?>checked="checked" <?php }?>></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">Mechanical Properties verified against Standered</p></td>
	<td width=5%> <b><input name="mechanical" type="radio" value="1" <?php if ($mech==1){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="mechanical" type="radio" value="2" <?php if ($mech==2){?>checked="checked" <?php }?> ></b></td>
	<td width=5%> <b><input name="mechanical" type="radio" value="3" <?php if ($mech==3){?>checked="checked" <?php }?>></b></td>
	<td width=30%> <span class="tabletext"><p align="left">Conductivity</p></td>
	<td width=5%> <b><input name="conductivity" type="radio" value="1" <?php if ($conductivity==1){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="conductivity" type="radio" value="2" <?php if ($conductivity==2){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="conductivity" type="radio" value="3" <?php if ($conductivity==3){?>checked="checked" <?php }?>></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">Chemical Properties verified against Standered</p></td>
	<td width=5%> <b><input name="chemical" type="radio" value="1"  <?php if ($chemical==1){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="chemical" type="radio" value="2" <?php if ($chemical==2){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="chemical" type="radio" value="3" <?php if ($chemical==3){?>checked="checked" <?php }?>></b></td>
	<td width=30%> <span class="tabletext"><p align="left">Hardness</p></td>
	<td width=5%> <b><input name="hardness" type="radio" value="1" <?php if ($hardness==1){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="hardness" type="radio" value="2" <?php if ($hardness==2){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="hardness" type="radio" value="3" <?php if ($hardness==3){?>checked="checked" <?php }?>></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">Quantity received agrees with Certification</p></td>
	<td width=5%> <b><input name="quantity" type="radio" value="1"  <?php if ($quantity==1){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="quantity" type="radio" value="2"  <?php if ($quantity==2){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="quantity" type="radio" value="3"  <?php if ($quantity==3){?>checked="checked" <?php }?>></b></td>
	<td width=30%> <span class="tabletext"><p align="left">Temper</p></td>
	<td width=5%> <b><input name="temper" type="radio" value="1" <?php if ($temper==1){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="temper" type="radio" value="2"  <?php if ($temper==2){?>checked="checked" <?php }?>></b></td>
	<td width=5%> <b><input name="temper" type="radio" value="3"  <?php if ($temper==3){?>checked="checked" <?php }?>></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">Serialization Requirements?</p></td>
<td width=10% colspan="2"><span class="tabletext"><p align="left">Customer Serialization</p></td>

	 <td  width="%"><span class="tabletext">Yes<input name="cus" type="radio" value="1" <?php if ($cus==1){?>checked="checked" <?php }?> >
  <span class="tabletext">No &nbsp;<input name="cus" type="radio" value="2" <?php if ($cus==2){?>checked="checked" <?php }?>></td>

	<td width=30%><span class="tabletext"><p align="left">Serialization
	<span class="tabletext">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yes<input name="cus" type="radio" value="3" <?php if ($cus==3){?>checked="checked" <?php }?>>
	<span class="tabletext">No<input name="cim" type="hidden" value="2" checked="checked">
	<input name="cus" type="radio" value="4" <?php if ($cus==4){?>checked="checked" <?php }?> ></p></td>
	<td width=8% colspan="2"> <span class="tabletext"><p align="left">Serialization not Required</p></td>
	<td width=3%> <b><input name="cus" type="radio" value="5" <?php if ($cus==5){?>checked="checked" <?php }?>></b></td>
		</tr><input name="not" type="hidden" value="5" >
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">If yes Mention Serial No. </p></td>
	<td width=5% colspan=2> <span class="tabletext"><p align="left">From </p></td>
	<td width=5%> <input name="frmserial" type="text" value="<?php echo $from?>"></td>
	<td width=5% colspan=4> <span class="tabletext"><p align="left">To     <input name="toserial" type="text" value="<?php echo $to?>"></p></b></td>


		</tr>
		<tr bgcolor="#DDDEDD">
<td align="center" colspan=8><span class="heading"><b>Non-Conformance</b></span></td>

        </tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="labeltext"><p align="left">Are any Non Conformance Observed</p></td>
	<td width=6%> <span class="labeltext"><b>Yes</b></span>
	<input name="conformance" type="radio" value="1"  <?php if ($noncon==1){?>checked="checked" <?php }?>></td>
	<td width=5% colspan=2> <b><span class="labeltext"><b>No</b></span>

	<input name="conformance" type="radio" value="2"  <?php if ($noncon==2){?>checked="checked" <?php }?> ></b></td>

	<td width=5% colspan=4 align=top><b><span class="labeltext">NCR Ref No.</b></span> <input name="ncref" id="ncref" type="text" value="<?php echo $ncref?>"><br>
	<span class="labeltext">NCR Date</b></span>
     &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="ncrdate" id="ncrdate" size=20 value="<?php echo $ncdate?>" style="background-color:#DDDDDD;" readonly="readonly">
                <img src="images/bu-getdateicon.gif" alt="Get BookDate" onClick="GetDate('ncrdate')"></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30% colspan=4><span class="labeltext"><p align="left">Is the Observed Non-Conformance communicated to the respective authorities</p></td>
	<td colspan=6> <b><span class="labeltext">Yes<input name="comm" type="radio" value="1"<?php if ($comm==1){?>checked="checked" <?php }?> ></b>
	<span class="labeltext">No <b><input name="comm" type="radio" value="2" <?php if ($comm==2){?>checked="checked" <?php }?> ></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="labeltext"><p align="left">Details of Communication</p></td>
	<td width=5% colspan=12><textarea name="dcomm" cols="70" rows=""><?php echo $dcomm?></textarea></td>

		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="labeltext"><p align="left">Additional Notes/Remarks</p></td>
	<td width=5% colspan=7><textarea name="anotes" cols="70" rows=""><?php echo $remarks?></textarea></td>

		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="labeltext"><p align="left">Authorised Signatory With Date<br>
         (Store Department)</p></td>
	<td width=5% colspan=8><span class="labeltext"><b>Yes</b><input name="approval" type="radio" value="<?php echo $approved; ?>" >
    <span class="labeltext"><b>No</b><input name="approval" type="radio" value=" "></td>
    	</tr>

	</td>
   </tr>
  <!-- <tr bgcolor="#DDDEDD">
            <td height="34" colspan=8><span class="heading">
            <center><b>Material Issue</b></center></td>
   </tr>
   <tr bgcolor="#FFFFFF"><td colspan=8><a href="javascript:addRow4grn_issue('grn_issue',document.forms[0].grniss_index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>
    <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" id='grn_issue'>

        <tr bgcolor="#FFFFFF">
             <td align=center><span class="labeltext">Line Num</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">Wo Num</font></td>
             <td align=center><span class="labeltext">Wo Date</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">Wo QTY</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">Qty Accepted</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">Qty Rejected</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">Qty Returned</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">Balance</font></td>
        </tr>
  <!--
        <?php
            /*
             $i=0;
             $line_num = 'line_num' . $i;
             $iss_date = 'iss_date' . $i;
             $iss_qty = 'iss_qty' . $i;
             $iss4wo = 'iss4wo' . $i;
             $iss4wo = 'accqty' . $i;
             $rejqty = 'rejqty' . $i;
             $retqty = 'retqty' . $i;
             $balance = 'balance' . $i;
            */
        ?>
        
        <tr bgcolor="#FFFFFF">
             <td bgcolor="#FFFFFF" align=center><input type='text' name='line_num' size=8>
             <td bgcolor="#FFFFFF" align=center><input type='text' name='iss_date' size=8>
                <img src="images/bu-getdateicon.gif" alt="Get BookDate" onClick="GetDate('iss_date')"></td>
             <td bgcolor="#FFFFFF" align=center><input type='text' name='iss_qty' size=8></td>
             <td bgcolor="#FFFFFF" align=center><input type='text' name='iss4wo' size=8></td>
             <td bgcolor="#FFFFFF" align=center><input type='text' name='accqty' size=8></td>
             <td bgcolor="#FFFFFF" align=center><input type='text' name='rejqty' size=8></td>
             <td bgcolor="#FFFFFF" align=center><input type='text' name='retqty' size=8 style="background-color:#DDDDDD;" readonly="readonly"></td>
             <td align=center><input type='text' name='balance' size=8></td>
         </tr>
           <input type=hidden name='grniss_index' value='<?php// echo $i;?>'>    -->

      <?php
     /*  $i=1;
       while ($i<=2)
       {
             $line_no = 'line_no' . $i;
             $iss_date = 'issdate' . $i;
             $iss_qty = 'issqty' . $i;
             $iss4wo = 'iss4wo' . $i;
             $accqty = 'accqty' . $i;
             $rejqty = 'rejqty' . $i;
             $retqty = 'retqty' . $i;
             $balance = 'balance' . $i;

             $fields = $iss4wo . '_' . $iss_date . '_' . $iss_qty;

          printf('<tr bgcolor=#FFFFFF>');
          echo "<td bgcolor=\"#FFFFFF\" align=center><input type=text name=\"$line_no\" size=8>";
          echo "<td bgcolor=\"#FFFFFF\" align=center><input type=text name=\"$iss4wo\" id=\"$iss4wo\" style=\"background-color:#DDDDDD;\" size=8>
               <img src=\"images/getwo.gif\" onClick=\"GetWo('$fields')\"></td>";
          echo "<td bgcolor=\"#FFFFFF\" align=center><input type=\"text\" name=\"$iss_date\" id=\"$iss_date\" style=\"background-color:#DDDDDD;\" size=8></td>";
          echo "<td bgcolor=\"#FFFFFF\" align=center><input type=\"text\" name=\"$iss_qty\" id=\"$iss_qty\" style=\"background-color:#DDDDDD;\" size=8></td>";
          echo "<td bgcolor=\"#FFFFFF\" align=center><input type=\"text\" name=\"$accqty\" size=8 onblur=\"javascript:getbalance(this,$i);\"></td>";
          echo "<td bgcolor=\"#FFFFFF\" align=center><input type=\"text\" name=\"$rejqty\" size=8></td>";
          echo "<td bgcolor=\"#FFFFFF\" align=center><input type=\"text\" name=\"$retqty\" size=8 onblur=\"javascript:getbalance1(this,$i);\"></td>";
          echo "<td align=center><input type=\"text\" name=\"$balance\"  style=\"background-color:#DDDDDD;\" size=8></td>";
          printf('</tr>');
	      $i++;
       }
         echo "<input type=\"hidden\" name=\"grniss_index\" value=$i>";     */
      ?>

   <!--
    </td>
     <tr bgcolor="#FFFFFF">
       <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

         <tr bgcolor="#FFFFFF">


        </tr>
           -->


</td>
		<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr> -->
		</table>
<span class="labeltext">
<?php

?>
<img  src="images/validate.gif" alt="Get validate" onClick="validate_grn()">
<input type="hidden" name="pagename" id="pagename" value="new_grn">
<input type="hidden" name="balance" id="balance" value="">
<input type="hidden" name="department" id="department" value="<?php echo $dept ?>">
 <input type="hidden" name="userid_app_cad" id="userid_app_cad" value="">
               <input type="submit"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                value="Submit" name="submit" onClick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                VALUE="Reset" onClick="javascript: putfocus()">

      </FORM>
</table>
</body>
</html>
