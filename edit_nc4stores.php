<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2008                =
// Filename: new_nc4qa.php                     =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of new quotes                  =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'edit_nc4stores';
$page="Stores: NC";
//////session_register('pagename');
$dept = $_SESSION['department'];
// First include the class definition
include('classes/userClass.php');
include('classes/companyClass.php');
include('classes/nc4storesClass.php');
include('classes/displayClass.php');
include('classes/pageClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newnc4stores = new nc4stores;
$newdisplay = new display;
$recnum=$_REQUEST['recnum'];

$result = $newnc4stores->getnc4storesDetails($recnum);
$myrow = mysql_fetch_row($result);
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/nc4stores.js"></script>


<html>
<head>
<title>Edit NC Stores</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">

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
        <td><span class="pageheading"><b>Edit NC Stores</b></td>
    </tr>


     <form action='processnc4stores.php' method='post' enctype='multipart/form-data'>
	 <input type='hidden' name='recnum' value=<?echo $recnum;?>>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>NC For Stores Header</b></center></td>
        </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">

          <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Id No.</p></font></td>
          <td width=25%><span class="tabletext"><?php printf("%05d", $myrow[0]) ?></td>
           <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>REF No.</p></font></td>
           <td width=25%><span class="tabletext"><?php printf("%s", $myrow[1]) ?></td>
		</tr>
        <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Date</p></font></td>
            <td><input type="text" name="cdate" size=20 value="<?php echo $myrow[2] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
                <img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('cdate')"></td>

        
              <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Supplier.</p></font></td>
            <td><input type="text" name="supplier" size=20 value="<?php echo $myrow[3] ?>"></td>
			</tr>
        <tr bgcolor="#FFFFFF">
              <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RM PO No.</p></font></td>
            <td><input type="text" name="rm_po_num" size=20 value="<?php echo $myrow[4] ?>"></td>
             </td>        
          <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Receipt Date</p></font></td>
            <td><input type="text" name="receipt_date" size=20 value="<?php echo $myrow[5] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
                <img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('receipt_date')"></td>
</tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Invoice No.</p></font></td>
            <td><input type="text" name="invoice_num" size=20 value="<?php echo $myrow[6] ?>"></td>
       
              <td><span class="labeltext"><p align="left">BOL/BOE No.</p></font></td>
            <td><input type="text" name="bol_num" size=20 value="<?php echo $myrow[7] ?>"></td>
</tr>

        <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left">C of C No.</p></font></td>
            <td colspan=3><input type="text" name="cofcnum" size=20 value="<?php echo $myrow[8] ?>"></td>
        </tr>
		<tr bgcolor="#FFFFFF"><td colspan='6' height='20px'>
		</td></tr>

<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
    <tr bgcolor="#DDDEDD">
     <td bgcolor="#FFFFF" width=30%  align="center"><span class="labeltext">Description</td>
    <td bgcolor="#FFFFF" width=10%  align="center"><span class="labeltext">Yes</td>
     <td bgcolor="#FFFFF" width=10%  align="center"><span class="labeltext">No</td>
	   <td bgcolor="#FFFFF" width=30%  align="center"><span class="labeltext">Description</td>
    <td bgcolor="#FFFFF" width=10%  align="center"><span class="labeltext">Yes</td>
     <td bgcolor="#FFFFF" width=10%  align="center"><span class="labeltext">No</td>
   </tr>

    <tr bgcolor="#FFFFFF.">
   <td bgcolor="#FFFFFF" width=20%><span class="labeltext"><span class='asterisk'>*</span>Dimensional Deviation</td>
   <?
   if($myrow[9] == 'Yes')
   {
   $dim_deviation="checked";
   ?>
   <td bgcolor="#FFFFFF" align='center'><input type="radio" <?php echo $dim_deviation ?> name="dim_deviation" id="dim1" value="Yes"></td> 
   <td bgcolor="#FFFFFF" align='center'><input type="radio" name="dim_deviation" id="dim2" value="No"></td> 
   <?}
   else
   {
	 $dim_deviation="checked";?>
  <td bgcolor="#FFFFFF" align='center'><input type="radio" name="dim_deviation" id="dim1" value="Yes"></td> 
  <td bgcolor="#FFFFFF" align='center'><input type="radio" <?php echo $dim_deviation ?> name="dim_deviation" id="dim2" value="No"></td> 
   <?} ?>

   <td bgcolor="#FFFFFF" width=20%><span class="labeltext"><span class='asterisk'>*</span>Raw Material Docs/Test Certificates received</td>
  <? 
  if($myrow[12] == 'Yes')
  {
   $raw_material_docs="checked";?>
   <td bgcolor="#FFFFFF" align='center'><input type="radio" <?php echo $raw_material_docs ?> name="raw_material_docs"  id="raw1" value="Yes"></td> 
   <td bgcolor="#FFFFFF" align='center'><input type="radio" name="raw_material_docs" id="raw2" value="No"></td> 
   <?}
   else
   {
  $raw_material_docs="checked";  
  ?>
  <td bgcolor="#FFFFFF" align='center'><input type="radio" name="raw_material_docs" id="raw1" value="Yes"></td> 
  <td bgcolor="#FFFFFF" align='center'><input type="radio" <?php echo $raw_material_docs ?> name="raw_material_docs" id="raw2" value="No"></td> 
  <?}?> 
 
</tr>
<tr>

  <td bgcolor="#FFFFFF"><span class="labeltext"><span class='asterisk'>*</span>Material Spec. Deviation</td>
   <?php
   if($myrow[10] == 'Yes')
   {
   $mat_deviation="checked";
   ?>
   <td bgcolor="#FFFFFF" align='center'><input type="radio" <?php echo $mat_deviation ?> name="mat_deviation" id="mat1" value="Yes"></td> 
   <td bgcolor="#FFFFFF" align='center'><input type="radio" name="mat_deviation" id="mat2" value="No"></td>
   <?
   }
   else
   {
	$mat_deviation="checked";
	?>
  <td bgcolor="#FFFFFF" align='center'><input type="radio" name="mat_deviation" id="mat1" value="Yes"></td> 
  <td bgcolor="#FFFFFF" align='center'><input type="radio" <?php echo $mat_deviation ?> name="mat_deviation" id="mat2" value="No"></td> 
   <?}?>

   <td bgcolor="#FFFFFF"><span class="labeltext"><span class='asterisk'>*</span>Specific Marking/Gain Flow Marking Correct</td>
<?php
   if($myrow[13] == 'Yes'){
   $specific_marking="checked";
   ?>
    <td bgcolor="#FFFFFF" align='center'><input type="radio" <?php echo $specific_marking ?> name="specific_marking"  id="spec1" value="Yes"></td> 
   <td bgcolor="#FFFFFF" align='center'><input type="radio" name="specific_marking" id="spec2" value="No" ></td>
   <?
   }else
   {
	$specific_marking="checked";?>
   <td bgcolor="#FFFFFF" align='center'><input type="radio" name="specific_marking"  id="spec1" value="Yes"></td> 
   <td bgcolor="#FFFFFF" align='center'><input type="radio" <?php echo $specific_marking ?> 
   name="specific_marking" id="spec2" value="No"></td> 
   <?}?>	
  </tr>

  <tr>
  <td bgcolor="#FFFFFF"><span class="labeltext"><span class='asterisk'>*</span>Discrepancy in Quantity</td>
<?php
   if($myrow[11] == 'Yes'){
   $descrepency_quantity="checked";
   ?>
   <td bgcolor="#FFFFFF" align='center'><input type="radio" <?php echo $descrepency_quantity ?> name="descrepancy_quantity"  id="desc1"  value="Yes"></td> 
   <td bgcolor="#FFFFFF" align='center'><input type="radio" name="descrepancy_quantity" id="desc2"  value="No"></td>
   <?}
   else
   {
   $descrepency_quantity="checked";?>
   <td bgcolor="#FFFFFF" align='center'><input type="radio" name="descrepancy_quantity"  id="desc1"   value="Yes"></td> 
  <td bgcolor="#FFFFFF" align='center'><input type="radio" <?php echo $descrepency_quantity ?> name="descrepancy_quantity" id="desc2" value="No"></td> 
   <?}?> 		

   <td bgcolor="#FFFFFF"><span class="labeltext">Other Deviation/Discrepancy</td>
<?php
  if($myrow[14] == 'Yes'){
   $other_deviation="checked";
   ?>
   <td bgcolor="#FFFFFF" align='center'><input type="radio" <?php echo $other_deviation ?> name="other_deviation" value="Yes"></td> 
   <td bgcolor="#FFFFFF" align='center'><input type="radio" name="other_deviation" value="No"></td>
   <?}
   else
   {
   $other_deviation="checked";?>
  <td bgcolor="#FFFFFF" align='center'><input type="radio" name="other_deviation"  value="Yes"></td> 
  <td bgcolor="#FFFFFF" align='center'><input type="radio" <?php echo $other_deviation ?> name="other_deviation" value="No"></td> 
   <?}?>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b>BRIEF DESCRIPTION OF NON CONFORMANCE:</b><br>
    <textarea name="description" rows=6 cols=60><?php echo $myrow[15] ?></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b>Root Cause:</b><br>
    <textarea name="root_cause" rows=6 cols=60><?php echo $myrow[16] ?></textarea>
    </td>
</tr>

<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b>Corrective Action:</b><br>
    <textarea name="corrective_action" rows=6 cols=60><?php echo $myrow[17] ?></textarea>
    </td>
</tr>

<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b>Preventive Action:</b><br>
    <textarea name="preventive_action" rows=6 cols=60><?php echo $myrow[18] ?></textarea>
    </td>
</tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFFFFF">
 <td><span class="labeltext"><p align="left"><span class='asteriskblue'>*</span>NC Raised By</p></font></td>
 <td><input type="text" id="cust_ncno" name="nc_created_by" size=20 value="<?php echo $myrow[19] ?>"></td>
 <td><span class="labeltext"><p align="left"><span class='asteriskblue'>*</span>NC Accepted By</p></font></td>
 <td><input type="text" id="cust_ncno" name="nc_supplied_by" size=20 value="<?php echo $myrow[20] ?>"></td>
 <td><span class="labeltext"><p align="left">Due On</p></font></td>
<td><input type="text" name="due_date" size=20 value="<?php echo $myrow[21] ?>" style=";background-color:#DDDDDD;" readonly="readonly"><img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('due_date')"></td>
 </tr>

<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b>Effectiveness:</b><br>
    <textarea name="effectiveness" rows=6 cols=60 ><?php echo $myrow[22] ?></textarea>
    </td>
</tr>
</table>
	</td>
    </tr>


    </td>

     <tr bgcolor="#FFFFFF">
       <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

         <tr bgcolor="#FFFFFF">


        </tr>


</table>

</td>
	<!-- 	<td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>
 -->
		</table>
<span class="labeltext"><input type="submit"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                VALUE="Reset" onclick="javascript: putfocus()">

      </FORM>
</table>
</body>
</html>
