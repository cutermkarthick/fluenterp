<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = April 26,2010                =
// Filename: new_bom.php                       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of new BOMs                    =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}

$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'new_bom';
$page="BOM";
//////session_register('pagename');
$userrole = $_SESSION['userrole'];
$dept = $_SESSION['department'];
// First include the class definition
include('classes/displayClass.php');
/*include('classes/bomClass.php');
include('classes/displayClass.php');
include('classes/bomliClass.php');
$newbom = new bom;
$newBOMLI = new bomli; */
$newdisplay = new display;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/bom.js"></script>
<script language="javascript" src="scripts/jquery.js"></script>

<html>
<head>
<title>New BOM</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processBOM.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
$userrole = $_SESSION['userrole'];
$userid = $_SESSION['user'];
$usertype = $_SESSION['usertype'];

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

<?php $newdisplay->dispLinks(''); ?>

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">
<table style="width:1305px" border=0 cellpadding=6 cellspacing=0>
<tr><td><span class="heading"><b>New BOM</b></td></tr>
<tr>
<script type="text/javascript">

</script>

<tr><td bgcolor="#DDDDD"  colspan=5 align="center"><span class="heading"><b>General Information</b></td></tr>
<table border=0 bgcolor="#DFDEDF" style="width:1305px" cellspacing=1 cellpadding=3 class="stdtable1">
<tr bgcolor="#FFFFFF" width=100%>
<input type="hidden" id="bomnum" name="bomnum"  size=15 value="">

<input type="hidden" name ="companyrecnum" value="0">
<td><span class="labeltext"><p align="left">PRN</p></font></td>
<td><input type="text" name="crn"  id="crn"  size=15 value="" style="background-color:#DDDDDD;" readonly="readonly">
<img src="images/bu-get.gif" alt="Get CIM" onclick="Getcim_bom()"></td>
</td>
<td><span class="labeltext"><p align="left">BOM Rev #</p></td>
<td ><input type="text" size=15  name="bomrevnum" id="bomrevnum"></td>
</tr>
<tr bgcolor="#FFFFFF">

<td><span class="labeltext"><p align="left">Assy Part No.</p></font></td>
<td ><input type="text" size=20 id="assy_part" name="assy_part" style="background-color:#DDDDDD;" readonly="readonly"></td>
<td><span class="labeltext"><p align="left">DRG No</p></font></td>
<td><input type="text" size=15 id="drg_no" name="drg_no" value="" style="background-color:#DDDDDD;" readonly="readonly"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">DRG Issue</p></font></td>
<td><input type="text" size=15 id="issue" name="issue" value="" style="background-color:#DDDDDD;" readonly="readonly"></td>
<td><span class="labeltext"><p align="left">COS Iss</p></font></td>
<td><input type="text" size=25 id="cos_no" name="cos_no" value="" style="background-color:#DDDDDD;" readonly="readonly"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Title</p></font></td>
<td><input type="text" name="title" id="title"></td>
<td><span class="labeltext"><p align="left">Part Issue/Attachments</p></font></td>
<td><input type="text" size=25 id="partiss" name="partiss" value="" style="background-color:#DDDDDD;" readonly="readonly"></td>
</tr>

</table>

<table border=0 bgcolor="#DFDEDF" style="width:1305px" cellspacing=1 cellpadding=3 class="stdtable">
<tr bgcolor="#DDDDD"><td><a href="javascript:addRow4subassy('myTable_subassy',document.forms[0].index_assy.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a>
</td>
<td><span class="heading"><b>Type= Assembly</b></td>
<td colspan=11 align="left"><span class="heading"><b>Sub Assembly</b></td></tr>
<tr bgcolor="#FFFFFF">
<table id="myTable_subassy" style="width:100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr>
    <thead>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Line</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Item No</b></th>
<!-- <th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Type</b></th> -->
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>PRN</b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Part #</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Part Name</b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Part Issue/Attachments</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>COS</b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>DRG Iss</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Mps#</b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Mps Rev</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>QPA</b></th>
</tr>
</thead>
<?php
 $z=1;
      while ($z<=3)
      {
	    printf('<tr bgcolor="#FFFFFF">');
        $as_linenumber="as_linenum" . $z;
        $as_itemno="as_itemno" . $z;
        $as_partno="as_partno" . $z;
        $as_crn="as_crn" . $z;
        $as_partname="as_partname" . $z;

        $as_partiss="as_partiss" . $z;
        $as_drgiss="as_drgiss" . $z;
		$as_cos="as_cos" . $z;

        $as_mpsnum="as_mpsnum" . $z;
        $as_mpsrev="as_mpsrev" . $z;
        $as_attach="as_attach" . $z;
        $as_qpa="as_qpa" . $z;
        $as_crn_type="as_crn_type" . $z;
         // $as_crn_treat="as_crn_treat" . $z;
		

		$master_partiss="master_partiss" . $z;
		$master_drgiss="master_drgiss" . $z;
		$master_cos="master_cos" . $z;


        echo "<td><span class=\"tabletext\"><input type=\"text\"  id=\"$as_linenumber\" name=\"$as_linenumber\"  value=\"\" size=\"2%\"></td>";
        echo "<td><input type=\"text\" id=\"$as_itemno\" name=\"$as_itemno\" size=\"5%\" value=\"\"></td>";
       
        echo "<td><span class=\"labeltext\"><input type=\"text\" id=\"$as_crn\" name=\"$as_crn\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"\" ><img src=\"images/bu-get.gif\" alt=\"Get CIM\" onclick=\"GetCIM_sassy('$z')\" ></td>";
        echo "<td><input type=\"text\" id=\"$as_partno\" name=\"$as_partno\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"18%\" value=\"\"></td>";
        echo "<td><input type=\"text\" name=\"$as_partname\" id=\"$as_partname\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"18%\" value=\"\">";

        echo "<td><input type=\"text\" id=\"$as_partiss\"name=\"$as_partiss\" size=\"15%\"    value=\"\"></td>";
		echo "<td><input type=\"text\" id=\"$as_cos\" name=\"$as_cos\" size=\"12%\"  value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$as_drgiss\" name=\"$as_drgiss\" size=\"12%\"  value=\"\"></td>";


        echo "<td><input type=\"text\" id=\"$as_mpsnum\" name=\"$as_mpsnum\" size=\"9%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$as_mpsrev\" name=\"$as_mpsrev\" size=\"9%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";   
        echo "<td><input type=\"text\" id=\"$as_qpa\" name=\"$as_qpa\" size=\"3%\" value=\"\"></td>";
        printf('</tr>');

		echo "<input type='hidden' name='$master_partiss' id='$master_partiss' value=\"\">";
		echo "<input type='hidden' name='$master_drgiss' id='$master_drgiss' value=\"\">";
		echo "<input type='hidden' name='$master_cos' id='$master_cos' value=\"\">";
		echo"<input type=\"hidden\" id=\"$as_crn_type\"  size=\"8%\" name=\"$as_crn_type\" value=\"Assembly\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\">";
      /*  echo"<input type=\"hidden\" id=\"$as_crn_treat\"  size=\"8%\" name=\"$as_crn_treat\" value=\"Assembly\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\">";*/
    	$z++;
      }
       
echo "<input type=\"hidden\" id=\"index_assy\" name=\"index_assy\" value=$z>";
echo "<input type=\"hidden\" id=\"curindex_assy\" name=\"curindex_assy\" value=$z>";

?>
</tr>
</table>
<table border=0 bgcolor="#DFDEDF" style="width:1305px" cellspacing=1 cellpadding=3 class="stdtable">
<tr bgcolor="#DDDDD"><td><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a>
</td>
<td><span class="heading"><b>Type= Non Assembly</b></td>
<td colspan=11 align="left"><span class="heading"><b>Untreated Items</b></td></tr>
<tr bgcolor="#FFFFFF">
<table id="myTable" style="width:1305px" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable" >
<tr>
    <thead>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Line</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Item No</b></td>
<!-- <th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Type</b></td> -->
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>PRN</b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Part #</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Part Name</b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Part Issue/Attachments</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>COS</b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>DRG Iss</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Mps#</b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Mps Rev</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>QPA</b></td>
</tr>
</thead>

<?php

 $i=1;
      while ($i<=3)
      {
	    printf('<tr bgcolor="#FFFFFF">');
        $linenumber="linenum" . $i;
        $itemno="itemno" . $i;
        $partno="partno" . $i;
        $crn="crn" . $i;
        $partname="partname" . $i;
        $partiss="partiss" . $i;
        $drgiss="drgiss" . $i;
		$cos="cos".$i;
        $mpsnum="mpsnum" . $i;
        $mpsrev="mpsrev" . $i;
        $attach="attach" . $i;
        $qpa="qpa" . $i;
        $crn_type="crn_type" . $i;
        // $crn_treat="crn_treat" . $i;

        $maf_partiss="maf_partiss" . $i;
		$maf_drgiss="maf_drgiss" . $i;
		$maf_cos="maf_cos" . $i;

        echo "<td><span class=\"tabletext\"><input type=\"text\"  id=\"$linenumber\" name=\"$linenumber\"  value=\"\" size=\"2%\"></td>";
        echo "<td><input type=\"text\" id=\"$itemno\" name=\"$itemno\" size=\"5%\" value=\"\"></td>";
       
        echo "<td width=\"5%\"><input type=\"text\" id=\"$crn\" name=\"$crn\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"\" width=\"50%\">";
        echo "<img src=\"images/bu-get.gif\" alt=\"Get CIM\" onclick=\"GetCIM('$i')\"></td>";
        echo "<td><input type=\"text\" id=\"$partno\" name=\"$partno\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"18%\" value=\"\"></td>";
        echo "<td><input type=\"text\" name=\"$partname\" id=\"$partname\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"18%\" value=\"\">";


        echo "<td><input type=\"text\" id=\"$partiss\"name=\"$partiss\" size=\"15%\"  value=\"\"></td>";
		echo "<td><input type=\"text\" id=\"$cos\"name=\"$cos\" size=\"15%\"  value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$drgiss\" name=\"$drgiss\" size=\"12%\" value=\"\"></td>";


        echo "<td><input type=\"text\" id=\"$mpsnum\" name=\"$mpsnum\" size=\"9%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$mpsrev\" name=\"$mpsrev\" size=\"9%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";      
        echo "<td><input type=\"text\" id=\"$qpa\" name=\"$qpa\" size=\"3%\" value=\"\"></td>";

		echo "<input type='hidden' name='$maf_partiss' id='$maf_partiss' value=\"\">";
		echo "<input type='hidden' name='$maf_drgiss' id='$maf_drgiss' value=\"\">";
		echo "<input type='hidden' name='$maf_cos' id='$maf_cos' value=\"\">";
        echo"<input type=\"hidden\" size=\"10%\" id=\"$crn_type\" name=\"$crn_type\" value=\"Untreated\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\">";
       /* echo"<input type=\"hidden\" size=\"10%\" id=\"$crn_type\" name=\"$crn_type\" value=\"Non Assembly\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\">";*/
        printf('</tr>');

    	$i++;
      }
      
echo "<input type=\"hidden\" id=\"index\" name=\"index\" value=$i>";
echo "<input type=\"hidden\" id=\"curindex\" name=\"curindex\" value=$i>";

?>
</tr>
</table>

<table border=0 bgcolor="#DFDEDF" style="width:1305px" cellspacing=1 cellpadding=3 class="stdtable">
<tr bgcolor="#DDDDD"><td><a href="javascript:addRow_treated('myTable_Treated',document.forms[0].index_treated.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a>
</td>
<td><span class="heading"><b>Type= Non Assembly</b></td>
<td colspan=11 align="left"><span class="heading"><b>Treated Items</b></td></tr>
<tr bgcolor="#FFFFFF">
<table id="myTable_Treated" style="width:1305px" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable" >
<tr>
    <thead>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Line</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Item No</b></td>
<!-- <th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Type</b></td> -->
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>PRN</b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Part #</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Part Name</b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Part Issue/Attachments</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>COS</b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>DRG Iss</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Mps#</b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Mps Rev</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>QPA</b></td>
</tr>
</thead>

<?php

 $m=1;
      while ($m<=3)
      {
        printf('<tr bgcolor="#FFFFFF">');
        $tr_linenumber="tr_linenum" . $m;
        $tr_itemno="tr_itemno" . $m;
        $tr_partno="tr_partno" . $m;
        $tr_crn="tr_crn" . $m;
        $tr_partname="tr_partname" . $m;
        $tr_partiss="tr_partiss" . $m;
        $tr_drgiss="tr_drgiss" . $m;
        $tr_cos="tr_cos".$m;
        $tr_mpsnum="tr_mpsnum" . $m;
        $tr_mpsrev="tr_mpsrev" . $m;
        $tr_attach="tr_attach" . $m;
        $tr_qpa="tr_qpa" . $m;
        $tr_crn_type="tr_crn_type" . $m;
        // $tr_crn_treat="tr_crn_treat" . $m;

        $partiss_tr="partiss_tr" . $m;
        $drgiss_tr="drgiss_tr" . $m;
        $cos_tr="cos_tr" . $m;

        echo "<td><span class=\"tabletext\"><input type=\"text\"  id=\"$tr_linenumber\" name=\"$tr_linenumber\"  value=\"\" size=\"2%\"></td>";
        echo "<td><input type=\"text\" id=\"$tr_itemno\" name=\"$tr_itemno\" size=\"5%\" value=\"\"></td>";
       
        echo "<td width=\"5%\"><input type=\"text\" id=\"$tr_crn\" name=\"$tr_crn\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"\" width=\"50%\">";
        echo "<img src=\"images/bu-get.gif\" alt=\"Get CIM\" onclick=\"GetCIM_treated('$m')\"></td>";
        echo "<td><input type=\"text\" id=\"$tr_partno\" name=\"$tr_partno\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"18%\" value=\"\"></td>";
        echo "<td><input type=\"text\" name=\"$tr_partname\" id=\"$tr_partname\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"18%\" value=\"\">";


        echo "<td><input type=\"text\" id=\"$tr_partiss\"name=\"$tr_partiss\" size=\"15%\"  value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$tr_cos\"name=\"$tr_cos\" size=\"15%\"  value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$tr_drgiss\" name=\"$tr_drgiss\" size=\"12%\" value=\"\"></td>";


        echo "<td><input type=\"text\" id=\"$tr_mpsnum\" name=\"$tr_mpsnum\" size=\"9%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$tr_mpsrev\" name=\"$tr_mpsrev\" size=\"9%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";      
        echo "<td><input type=\"text\" id=\"$tr_qpa\" name=\"$tr_qpa\" size=\"3%\" value=\"\"></td>";

        echo "<input type='hidden' name='$partiss_tr' id='$partiss_tr' value=\"\">";
        echo "<input type='hidden' name='$drgiss_tr' id='$drgiss_tr' value=\"\">";
        echo "<input type='hidden' name='$cos_tr' id='$cos_tr' value=\"\">";
        echo"<input type=\"hidden\" size=\"10%\" id=\"$tr_crn_type\" name=\"$tr_crn_type\" value=\"Treated\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\">";
        /* echo"<input type=\"hidden\" size=\"10%\" id=\"$tr_crn_type\" name=\"$tr_crn_type\" value=\"Non Assembly\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\">";*/
        printf('</tr>');

        $m++;
      }
      
echo "<input type=\"hidden\" id=\"index_treated\" name=\"index_treated\" value=$m>";
echo "<input type=\"hidden\" id=\"curindex_treated\" name=\"curindex_treated\" value=$m>";

?>
<table border=0 bgcolor="#DFDEDF" style="width:1305px" cellspacing=1 cellpadding=3 class="stdtable">
<tr bgcolor="#DDDDD"><td><a href="javascript:addRow_bo('myTable_bo',document.forms[0].boindex.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td>
<td colspan=11 align="left"><span class="heading"><b>Bought Out Items&nbsp;&nbsp;&nbsp;</b></td></tr>
<tr bgcolor="#FFFFFF">
<table id="myTable_bo" style="width:1305px" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr>
    <thead>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Line</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Item No</b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Part #</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Description</b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Part Issue/Attachments</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>DRG #</b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>DRG Issue</b></td>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Make/Supplier</b></td>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>QPA</b></td>
</tr>
</thead>
<?php

 $j=1;
      while ($j<=3)
      {
	    printf('<tr bgcolor="#FFFFFF">');
        $bo_linenumber="bo_linenum" . $j;
        $bo_itemno="bo_itemno" . $j;
        $bo_desc="bo_desc" . $j;
        $bo_partnum="bo_partnum" . $j;
        $bo_partiss="bo_partiss" . $j;
        $bo_drgno="bo_drgno" . $j;
        $bo_issue="bo_issue" . $j;
        $bo_supp="bo_supp" . $j;
        $bo_qpa="bo_qpa" . $j;

        echo "<td ><span class=\"tabletext\"><input type=\"text\" id=\"$bo_linenumber\" name=\"$bo_linenumber\"  value=\"\" size=\"3%\"></td>";
        echo "<td><input type=\"text\" id=\"$bo_itemno\" name=\"$bo_itemno\" size=\"5%\" value=\"\"></td>";
        echo "<td width=\"5%\"><input type=\"text\" id=\"$bo_partnum\" name=\"$bo_partnum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"12%\" value=\"\">";
        echo "<img src=\"images/bu-get.gif\" alt=\"Get Part\" onclick=\"GetPart('$j','Bought Out')\"></td>";
        echo "<td><input type=\"text\" id=\"$bo_desc\" name=\"$bo_desc\" size=\"18%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$bo_partiss\" name=\"$bo_partiss\" size=\"12%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\">";
        echo "<td><input type=\"text\" id=\"$bo_drgno\" name=\"$bo_drgno\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$bo_issue\" name=\"$bo_issue\" size=\"10%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$bo_supp\" name=\"$bo_supp\" size=\"15%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$bo_qpa\" name=\"$bo_qpa\" size=\"5%\" value=\"\"></td>";
        printf('</tr>');
	   $j++;
      }
        echo "<input type=\"hidden\" id=\"boindex\" name=\"boindex\" value=$j>";
        echo "<input type=\"hidden\" id=\"bocurindex\" name=\"bocurindex\" value=$j>";

?>
<table border=0 bgcolor="#DFDEDF" style="width:1305px" cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDDD"><td><a href="javascript:addRow_co('myTable_co',document.forms[0].coindex.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td>
<td colspan=11 align="left"><span class="heading"><b>Consummables&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td></tr>
<tr bgcolor="#FFFFFF">
<table id="myTable_co" style="width:1305px" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr>
    <thead>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Line</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Item No</b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Part #</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Description</b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>DRG Issue</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>Make/Suppler</b></th>
<th class="head0" bgcolor="#EEEFEE"><span class="heading"><b>Specification</b></th>
<th class="head1" bgcolor="#EEEFEE"><span class="heading"><b>QPA</b></th>
</tr>
<thead>
<?php
 $k=1;
      while ($k<=3)
      {
	    printf('<tr bgcolor="#FFFFFF">');
        $co_linenumber="co_linenum" . $k;
        $co_itemno="co_itemno" . $k;
        $co_desc="co_desc" . $k;
        $co_spec="co_spec" . $k;
        $co_issue="co_issue" . $k;
        $co_supp="co_supp" . $k;
        $co_qpa="co_qpa" . $k;
		$co_partnum="co_partnum" . $k;

        echo "<td><span class=\"tabletext\"><input type=\"text\"  id=\"$co_linenumber\" name=\"$co_linenumber\"  value=\"\" size=\"3%\"></td>";
        echo "<td width=\"5%\"><input type=\"text\" id=\"$co_itemno\" name=\"$co_itemno\" size=\"11%\" value=\"\"></td>";
		echo "<td width=\"5%\"><input type=\"text\" id=\"$co_partnum\" name=\"$co_partnum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"12%\" value=\"\">";
        echo "<img src=\"images/bu-get.gif\" alt=\"Get Part\" onclick=\"GetPart('$k','Consummables')\"></td>";
        echo "<td><input type=\"text\" id=\"$co_desc\" name=\"$co_desc\" size=\"25%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  value=\"\"></td>";     
        echo "<td><input type=\"text\" id=\"$co_issue\" name=\"$co_issue\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  size=\"8%\" value=\"\">";
        echo "<td><input type=\"text\" id=\"$co_supp\" name=\"$co_supp\" size=\"17%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  value=\"\"></td>";
		echo "<td><input type=\"text\" id=\"$co_spec\" name=\"$co_spec\" size=\"13%\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$co_qpa\" name=\"$co_qpa\" size=\"6%\" value=\"\"></td>";

        printf('</tr>');

	   $k++;
      }
echo "<input type=\"hidden\" id=\"coindex\" name=\"coindex\" value=$k>";
echo "<input type=\"hidden\" id=\"cocurindex\" name=\"cocurindex\" value=$k>";
?>
<table border=0 bgcolor="#DFDEDF" style="width:1305px" cellspacing=1 cellpadding=3 class="stdtable">
<tr bgcolor="#DDDDD"><td><a href="javascript:addRow_op('myTable_op',document.forms[0].opindex.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td>
<td colspan=11 align="left"><span class="heading"><b>Operation Details</b></td></tr>
<tr bgcolor="#FFFFFF">
<table id="myTable_op" style="width:1305px" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<tr>
<thead>
<th class="head0" width="6%" bgcolor="#EEEFEE"><span class="heading"><b>Opn#</b></th>
<th class="head1" width="12%" bgcolor="#EEEFEE"><span class="heading"><b>Stn</b></th>
<th class="head0" width="20%" bgcolor="#EEEFEE"><span class="heading"><b>Operation Description</b></th>
<th class="head1" width="12%" bgcolor="#EEEFEE"><span class="heading"><b>Signoff</b></th>
<th class="head0" width="18%" bgcolor="#EEEFEE"><span class="heading"><b>Remarks</b></th>
</tr>
</thead>
<?php

 $l=1;
      while ($l<=3)
      {
	    printf('<tr bgcolor="#FFFFFF">');
        $opn="opn" . $l;
        $stn="stn" . $l;
        $desc="desc" . $l;
        $signoff="signoff" . $l;
        $remarks="remarks" . $l;

        echo "<td><span class=\"tabletext\"><input type=\"text\"  id=\"$opn\" name=\"$opn\"  value=\"\" size=\"3%\"></td>";
        echo "<td width=\"5%\"><input type=\"text\" id=\"$stn\" name=\"$stn\" size=\"15%\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$desc\" name=\"$desc\" size=\"48%\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$signoff\" name=\"$signoff\" size=\"16%\" value=\"\"></td>";
        echo "<td><input type=\"text\" id=\"$remarks\" name=\"$remarks\" size=\"42%\" value=\"\">";
        printf('</tr>');
	   $l++;
      }
echo "<input type=\"hidden\" id=\"opindex\" name=\"opindex\" value=$l>";
echo "<input type=\"hidden\" id=\"opcurindex\" name=\"opcurindex\" value=$l>";
?>
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
<table border = 0 cellpadding=0 cellspacing=0 width=100%>
<tr>
<td align=left>
</td>
</tr>
</table>
<input type="hidden" name ="pagename" value="newbompage">
          <span class="tabletext"><input type="submit"
            style="color=#0066CC;background-color:#DDDDDD;width=130;"
            value="Submit" name="submit" onclick="javascript: return check_req_fields()">
             <INPUT TYPE="RESET"
                 style="color=#0066CC;background-color:#DDDDDD;width=130;"
                VALUE="Reset" onclick="javascript: putfocus()">
</FORM>
</body>
</html>
