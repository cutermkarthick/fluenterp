<?php
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

if (!isset( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'new_nc4qa';
$page = "QA: NC";
//////session_register('pagename');
$dept = $_SESSION['department'];
// First include the class definition
include('classes/userClass.php');
include('classes/companyClass.php');
include('classes/nc4qaclass.php');
include('classes/displayClass.php');
include('classes/pageClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newnc = new nc4qa;
$newdisplay = new display;
$result = $newnc->geSupnOperNames();
$result_emp = $newnc->getEmployeeName();
//$result = $newnc->getcofcs();
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/nc4qa.js"></script>

<html>
<head>
<script language="javascript" type="text/javascript">
function Disable(form) 
{
 if (document.getElementById) 
 {
 for (var i = 0; i < form.length; i++) 
 {
 if (form.elements[i].type.toLowerCase() == "submit")
 form.elements[i].disabled = true;
 }
 }
return true;
}


function readOnlyRadio() {
   return false;
}

function setvalues()
{
document.getElementById("op_name").value="";
}


</script>
<title>New NC</title>
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
				<table width=100% border=0 cellpadding=6 cellspacing=0  >
    <tr>
        <td><span class="pageheading"><b>New NC</b></td>
    </tr>


     <form action='processnc4qa.php' method='get' enctype='multipart/form-data' onSubmit='Disable(this);'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>NC Header</b></center></td>
        </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">

        <tr bgcolor="#FFFFFF">
         <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PRN</p></font></td>
            <td width=25%><span class="tabletext"><input type="text" id="refnum" name="refnum" size=20 value="" onblur="resetWO()"></td>
            <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Stage #</p></font></td>
            <td width=25%><span class="tabletext"><input type="text" id="stagenum" name="stagenum" size=10 value="" onblur="resetWO()"></td>
</tr>

 <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>WO No.</p></font></td>
            <td colspan=4><input type="text" id="wonum" name="wonum" size=20 value="" style=";background-color:#DDDDDD;" readonly="readonly">
                <img src="images/getwo.gif" alt="Get wo" onclick="Getwo_qa()">
               <div id="nc_wocheck"></div></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left">WO Type</p></font></td>
            <td width=25%><input type="text" id="wotype" name="wotype" size=20 value="" style=";background-color:#DDDDDD;" readonly="readonly"></td>
            <td><span class="labeltext"><p align="left">DN #</p></font></td>
            <td><input type="text" id="dnnum" name="dnnum" size=20 value="">
            </td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
            <td width=25%><input type="text" id="customer" name="customer" size=20 value="" style=";background-color:#DDDDDD;" readonly="readonly">
            <input type="hidden" name="custrecnum"></td>
             <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PO No.</p></font></td>
            <td><input type="text" id="ponum" name="ponum" size=20 value=""  style=";background-color:#DDDDDD;" readonly="readonly">
            <input type="hidden" name="porecnum">
            <input type="hidden" name="wo_status" id="wo_status" value="">
             </td>
        </tr>

        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part No.</p></font></td>
            <td><input type="text" id="partnum" name="partnum" size=20 value="" style=";background-color:#DDDDDD;" readonly="readonly"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part Name</p></font></td>
            <td><input type="text" id="partname" name="partname" size=20 value="" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Batch No.</p></font></td>
            <td><input type="text" id="bachnum" name="bachnum" size=20 value="" style=";background-color:#DDDDDD;" readonly="readonly">
            </td>
            <td><span class="labeltext"><p align="left">Matl. Spec</p></font></td>
            <td><input type="text" id="matl_spec" name="matl_spec" size=20 value="" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Issue & PS</p></font></td>
            <td><input type="text" id="issues_ps" name="issues_ps" size=20 value="" style=";background-color:#DDDDDD;" readonly="readonly"></td>
            <td><span class="labeltext"><p align="left">Qty</p></font></td>
            <td><input type="text" name="qty" id="qty" size=20 value="">
            </td>
        </tr>

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Sl No.</p></font></td>
            <td><input type="text" name="part_sl_num" size=20 value=""></td>
            <td><span class="labeltext"><p align="left">DC No.</p></font></td>
            <td><input type="text" name="dcnum" size=20 value=""></td>
        </tr>
        
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">DC Date</p></font></td>
            <td><input type="text" name="dcdate" size=20 value="" style=";background-color:#DDDDDD;" readonly="readonly">
                <img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('dcdate')"></td>
            <td><span class="labeltext"><p align="left"><span class='asteriskblue'>*</span>C of C No.</p></font></td>
           <td><input type="text" id="cofcnum" name="cofcnum" size=20 value="" style=";background-color:#DDDDDD;" readonly="readonly">
                <img src="images/bu-get.gif" alt="Get Cofc" onclick="Getcofc('cofcnum')"></td>
        </tr>

          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Supervisor Name</p></font></td>
            <td>
         <select name="sup_name" id="sup_name">
		 <option value="select">Select</option>
		 <?php
		 while ($myrow = mysql_fetch_row($result)){?>	    
		<option value="<? echo $myrow[0]?>">
		<?echo $myrow[0]; ?> </option>
		<?}?>
</select>
</td>
<?$result = $newnc->geSupnOperNames();?>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Operator Name</p></font></td>

<td><div id="wo_opnames"><textarea name="op_name" id="op_name" rows=3 cols=35 style=";background-color:#DDDDDD;" readonly="readonly"></textarea>
        </div>
</td>
</tr>   
 <input type='hidden' name='op_name1' id='op_name1' value=''>
  <tr bgcolor="#FFFFFF"> 
<td><span class="labeltext"><p align="left">Machine Name</p></td>
 <td>
 <div id="machine_name">
 <input type="text" id="mc_name" name="mc_name" size=20 value="" style=";background-color:#DDDDDD;" readonly="readonly">
 </div>
 </td>
 <input type='hidden' name='mc_name1' id='mc_name1' value=''>

			
            <td><span class="labeltext"><p align="left"><span class='asteriskblue'>*</span>Cust NC#</p></font></td>
            <td><input type="text" id="cust_ncno" name="cust_ncno" size=20 value=""></td>
			</tr>
			 <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asteriskblue'>*</span>Cust NC Date</p></font></td>
            <td><input type="text" id="cust_ncdate" name="cust_ncdate" size=20 value="" style=";background-color:#DDDDDD;" readonly="readonly">
             <img src="images/bu-getdateicon.gif" alt="Get NCDate" onclick="GetDate('cust_ncdate')"></td>
                  <td><span class="labeltext"><p align="left"><span class='asteriskblue'>*</span>RM Cost</p></font></td>
            <td><input type="text" id="rm_cost" name="rm_cost" size=20 value="">
			<span class="labeltext"><select name="currency" size="1" width="100">
                   <option selected>$</option>
                   <option value>Rs</option>
				   </select>
				     </tr>

		 <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Status</p></font></td>
            <td><span class="tabletext"><input type="text" name="status" id="status"
                         readonly="readonly"  style=";background-color:#DDDDDD;" value="">
	            <span class="tabletext"><select name="ncstate" size="1" width="20" onchange="onSelectStatus(this)">
 	                 <option value='Select'>Please Specify</option>
	            <option value='Open'>Open</option>
	            <option value='Closed'>Closed</option>
	            <option value='Pending'>Pending</option>
	            </select>
            </td>
			<td><span class="labeltext"><p align="left">
			<span class='asterisk'>*</span>Created by</p></font></td>
            <td>
         <select name="created_by" id="created_by">
		 <option value="select">Select</option>
		 <?php
		 while ($myrow_e = mysql_fetch_row($result_emp))
		 {?>	    
				<option value="<? echo $myrow_e[0]?>">
				<?echo $myrow_e[0]; ?> </option>
		<?}?>
        </select>
        </td>
		</tr>
        
       <tr bgcolor="#FFFFFF">
       <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b>Remarks/Attachments:</b><br>
       <textarea id="remarks" name="remarks" rows=6 cols=60></textarea>
       </td>
       </tr>


<input type="hidden" name="action" value="new">
<!--<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>-->
<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
    <tr>
    <tr bgcolor="#DDDEDD">
    <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">ERROR TYPE</td>
    <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">CAUSE</td>
    <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">STAGE</td>
    <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">DISPOSITION</td>
    </tr>
    
   <tr>
   <td bgcolor="#FFFFFF" width=20%><span class="labeltext">DIMENSIONAL DEVIATION</td>
   <td bgcolor="#FFFFFF"><input type="radio" name="chk1" id="chk1" onclick="JavaScript:toggleValue('dim_deviation',this);">
                         <input type="hidden" name="dim_deviation" value="no" id="dim_deviation"></td>
   <td bgcolor="#FFFFFF" width=20%><span class="labeltext">MAN</td>
   <td bgcolor="#FFFFFF"><input type="radio" name="chk2" id="chk2" onclick="JavaScript:toggleValue('man',this);">
                         <input type="hidden" name="man"  value="no" id="man"></td>
<?php
if($dept=='QA')
{
?>
   <td bgcolor="#FFFFFF"  width=20%><span class="labeltext">IN PROCESS</td>
   <td bgcolor="#FFFFFF"><input type="radio" name="chk3" id="chk3" onclick="return readOnlyRadio()" disabled="disabled">
                         <input type="hidden" name="inprocess" value="no"  id="inprocess"></td>
<?php
}
else
{
?>
   <td bgcolor="#FFFFFF"  width=20%><span class="labeltext">IN PROCESS</td>
   <td bgcolor="#FFFFFF"><input type="radio" name="chk3" id="chk3" onclick="JavaScript:toggleValue('inprocess',this);">
                         <input type="hidden" name="inprocess" value="no"  id="inprocess"></td>
<?php
}
?>
                         <td bgcolor="#FFFFFF"><span class="labeltext">ACCEPTED</td>
   <td bgcolor="#FFFFFF"><input type="radio" name="chk10" id="chk10" onclick="JavaScript:toggleValue('accepted',this);">
                         <input type="hidden" name="accepted" value="no"  id="accepted"></td>
</tr>

<tr>
  <td bgcolor="#FFFFFF"><span class="labeltext">MATERIAL DEVIATION</td>
   <td bgcolor="#FFFFFF"><input type="radio" name="chk4" id="chk4" onclick="JavaScript:toggleValue('mat_deviation',this);"   >
                         <input type="hidden" name="mat_deviation" value="no" id="mat_deviation"></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">MACHINE</td>
   <td bgcolor="#FFFFFF"><input type="radio" name="chk5" id="chk5" onclick="JavaScript:toggleValue('machine',this);">
                         <input type="hidden" name="machine" value="no"  id="machine"></td>
<?php
if($dept=='Production')
{
?>
<td bgcolor="#FFFFFF"><span class="labeltext">FINAL INSPECTION</td>
   <td bgcolor="#FFFFFF"><input type="radio" name="chk6" id="chk6" onclick="return readOnlyRadio()" disabled="disabled">
                         <input type="hidden" name="final_insp" value="no"  id="final_insp"></td>
<?php
}else
{
?>
<td bgcolor="#FFFFFF"><span class="labeltext">FINAL INSPECTION</td>
   <td bgcolor="#FFFFFF"><input type="radio" name="chk6" id="chk6" onclick="JavaScript:toggleValue('final_insp',this);">
                         <input type="hidden" name="final_insp" value="no"  id="final_insp"></td>
<?php
}
?>
   <td bgcolor="#FFFFFF"><span class="labeltext">REJECTED</td>
   <td bgcolor="#FFFFFF"><input type="radio" name="chk11" id="chk11" onclick="JavaScript:toggleValue('rejected',this);">
                         <input type="hidden" name="rejected" value="no" id="rejected"></td>
</tr>

<tr>
  <td bgcolor="#FFFFFF"><span class="labeltext">OTHER DEVIATION</td>
   <td bgcolor="#FFFFFF"><input type="radio" name="chk7" id="chk7" onclick="JavaScript:toggleValue('other_deviation',this);">
                         <input type="hidden" name="other_deviation" value="no"  id="other_deviation"></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">METHOD</td>
   <td bgcolor="#FFFFFF"><input type="radio" name="chk8" id="chk8" onclick="JavaScript:toggleValue('method',this);">
                         <input type="hidden" name="method" value="no" id="method"></td>
<?php
if($dept == 'Production')
{
?>
 <td bgcolor="#FFFFFF"><span class="labeltext">CUSTOMER END</td>
   <td bgcolor="#FFFFFF"><input type="radio" name="chk9" id="chk9" onclick="return readOnlyRadio()" disabled="disabled">
                         <input type="hidden" name="cust_end" value="no" id="cust_end"></td>
<?php
}
else
{
?>
 <td bgcolor="#FFFFFF"><span class="labeltext">CUSTOMER END</td>
   <td bgcolor="#FFFFFF"><input type="radio" name="chk9" id="chk9" onclick="JavaScript:toggleValue('cust_end',this);">
                         <input type="hidden" name="cust_end" value="no" id="cust_end"></td>
<?php
}
?>

    <td bgcolor="#FFFFFF"><span class="labeltext">QUARANTINED</td>
   <td bgcolor="#FFFFFF"><input type="radio" name="chk12" id="chk12" onclick="JavaScript:toggleValue('quarantined',this);">
                         <input type="hidden" name="quarantined" value="no" id="quarantined"></td>
</tr>
<tr>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>

<td bgcolor="#FFFFFF"><span class="labeltext">REWORK</td>
<td bgcolor="#FFFFFF"><input type="radio" name="chk13" id="chk13" onclick="JavaScript:toggleValue('rework',this);">
                         <input type="hidden" name="rework" value="no" id="rework"></td>
</tr>

<div id="remarks4nc">
<?php
if($dept == 'Production')
{
?>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Breif Description of Non Conformance:</b><br>
    <textarea name="description" rows=6 cols=60></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Root Cause:</b><br>
    <textarea name="root_cause" rows=6 cols=60></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Corrective Action:</b><br>
    <textarea name="corrective_action" rows=6 cols=60></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Preventive Action:</b><br>
    <textarea name="preventive_action" rows=6 cols=60></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Effectiveness:</b><br>
    <textarea name="effectiveness" rows=6 cols=60 style=";background-color:#DDDDDD;" readonly="readonly"></textarea>
    </td>
</tr>
<?
}
if($dept == 'QA')
{
?>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Breif Description of Non Conformance:</b><br>
    <textarea name="description" rows=6 cols=60></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Root Cause:</b><br>
    <textarea name="root_cause" rows=6 cols=60 style=";background-color:#DDDDDD;" readonly="readonly"></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Corrective Action:</b><br>
    <textarea name="corrective_action" rows=6 cols=60 style=";background-color:#DDDDDD;" readonly="readonly"></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Preventive Action:</b><br>
    <textarea name="preventive_action" rows=6 cols=60 style=";background-color:#DDDDDD;" readonly="readonly"></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Effectiveness:</b><br>
    <textarea name="effectiveness" rows=6 cols=60></textarea>
    </td>
</tr>
<?php
}
else if($dept != 'Production' &&  $dept != 'QA')
{
?>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Breif Description of Non Conformance:</b><br>
    <textarea name="description" rows=6 cols=60></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Root Cause:</b><br>
    <textarea name="root_cause" rows=6 cols=60></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Corrective Action:</b><br>
    <textarea name="corrective_action" rows=6 cols=60></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Preventive Action:</b><br>
    <textarea name="preventive_action" rows=6 cols=60></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Effectiveness:</b><br>
    <textarea name="effectiveness" rows=6 cols=60></textarea>
    </td>
</tr>
<?php
}
?>
</table>
	</td>
    </tr>


    </td>

     <tr bgcolor="#FFFFFF">
       <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

         <tr bgcolor="#FFFFFF">

          <input type="hidden" id="department" name="department" size=20 value="<?php echo $dept ?>" >
        </tr>


</table>

</td>
<!-- 		<td width="6"><img src="images/spacer.gif " width="6"></td>
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
