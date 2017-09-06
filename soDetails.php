<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = July 20, 2006                =
// Filename: soDetails.php                     =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Salesorder Details                          =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'soDetails';
$page = 'CRM: Sales Order';
//session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/salesorderClass.php');
include('classes/soliClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$newsalesorder = new salesorder;
$soli = new soli;
$newdisplay = new display;

$salesorderrecnum = $_REQUEST['salesorderrecnum'];
$userid = $_SESSION['user'];

$myQI = $soli->getQI($salesorderrecnum);
$result = $newsalesorder->getSalesorder($salesorderrecnum);
$myrow = mysql_fetch_array($result);
//print_r($myrow); 
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/salesorder.js"></script>

<html>
<head>
<title>Sales Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
       <tr>
          <td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
          <td align="right">&nbsp;
          <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
       </tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>

<?php  $newdisplay->dispLinks(''); ?>

</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
 --><table width=100% border=0 cellspacing="1" cellpadding="6">
<tr>
<td><span class="pageheading"><b>Sales Order Details</b><td colspan=350></td>
          <td bgcolor="#FFFFFF" rowspan=2 align="right"><input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="javascript: printsoDetails(<?php echo $salesorderrecnum ?>)" value="Print" ><!-- <input type= "image" name="Delete" src="images/bu-print.gif" value="Print" onclick="javascript: printsoDetails(<?php echo $salesorderrecnum ?>)"> -->
          <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px" onClick="location.href='edit_so.php?salesorderrecnum=<?php echo $salesorderrecnum ?>'" value="Edit Salesorder" >
          <!-- <a href ="edit_so.php?salesorderrecnum=<?php echo $salesorderrecnum ?>" ><img name="Image8" border="0" src="images/eso.gif" ></a> -->
</td>
  </tr>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<?php
?>
 <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="stdtable1">
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Sales Order Details</b></center></td></tr>
</td>
    <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Our Sales Order #</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[4]?></td>
             <td><span class="labeltext"><p align="left">Order Date</p></font></td>
            <td ><span class="tabletext">
            <?php
            $d=substr($myrow[5],8,2);
            $m=substr($myrow[5],5,2);
            $y=substr($myrow[5],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
            //$date=date("F jS Y",$x);
            echo "$date";
            ?>
            </td>
        </tr>

     <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Customer</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[1]?></td>
             <td><span class="labeltext"><p align="left">Sales Person</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[22].' '.$myrow[23]?></td>
      </tr>

    <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Description</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[3]?></td>
             <td><span class="labeltext"><p align="left">Due Date</p></font></td>
            <td ><span class="tabletext">
            <?php
            $d=substr($myrow[6],8,2);
            $m=substr($myrow[6],5,2);
            $y=substr($myrow[6],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
            echo "$date";
            ?>
            </td>
        </tr>
   <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Quote #</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[15] ?></td>
             <td><span class="labeltext"><p align="left">PO #</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[16]?></td>
    </tr>

    <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Special Instruction</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo  "$myrow[7]"?></p></font>
<input type="hidden" name="special_instruction" value="<?php echo  $myrow[6]?>">

            <td><span class="labeltext"><p align="left">Resell #</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo  "$myrow[33]"?></p></font>

        </tr>
 <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Contact Information</b></center></td>
        </tr>
      <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Contact</p></font></td>
            <td colspan=3><span class="tabletext"><p align="left"><?php echo $myrow[27].' '.$myrow[28]?>
            <input type="hidden" name="contactrecnum" value="<?php echo $myrow[27].' '.$myrow[28]?>">
            </td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Email</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo $myrow[29]?></td>
            <td><span class="labeltext"><p align="left">Phone</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo $myrow[8]?></td>
        </tr>
</table>
    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="stdtable">
    <thead>
<tr bgcolor="#DDDEDD">
<td colspan=9><span class="heading"><center><b> Line Items</b></center></td>
</tr>

<tr bgcolor="#FFFFFF">
<td class="head0" width=10%><span class="heading"><b><center>Item Number</center></b></td>
<td class="head1" width=10%><span class="heading"><b><center>Partnum</center></b></td>
<td class="head0" width=10%><span class="heading"><b><center>Dim1</center></b></td>
<td class="head1" width=10%><span class="heading"><b><center>Dim2</center></b></td>
<td class="head0" width=10%><span class="heading"><b><center>Dim3</center></b></td>
<td class="head1" width=30%><span class="heading"><b><center>Description</center></b></td>
<td class="head0" width=10%><span class="heading"><b><center>Quantity</center></b></td>
<td class="head1" width=10%><span class="heading"><b><center>Unit Price</center></b></td>
<td class="head0" width=10%><span class="heading"><b><center>Amount</center></b></td>
</tr>
</thead>
<?php
 $i = 1;
      while ($QI = mysql_fetch_row($myQI))
      {
  printf('<tr bgcolor="#FFFFFF">');
  $line_num = $QI[0];
  $qty = $QI[1];
  $item_desc = $QI[2];
  $price = $QI[3];
  $amount = $QI[4];
  $partnum = $QI[6];
  $dim1 = $QI[28];
  $dim2 = $QI[29];
  $dim3 = $QI[30];
  echo "<td align=\"center\"><span class=\"tabletext\">$line_num</td>";
  echo "<td align=\"center\"><span class=\"tabletext\">$partnum</td>";
  echo "<td align=\"center\"><span class=\"tabletext\">$dim1</td>";
  echo "<td align=\"center\"><span class=\"tabletext\">$dim2</td>";
  echo "<td align=\"center\"><span class=\"tabletext\">$dim3</td>";
  echo "<td align=\"center\"><span class=\"tabletext\">$qty</td>";
  echo "<td align=\"center\"><span class=\"tabletext\">$item_desc</td>";

  printf('<td align="right"><span class="tabletext">%s%.2f</td>',$myrow[30],$price);
  printf('<td align="right"><span class="tabletext">%s%.2f</td>',$myrow[30],$amount);
  printf('</tr>');

  printf('</tr>');
  $i++;
  ?>
 <?php
    }

?>
</table>
    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="stdtable1">
      
         <tr bgcolor="#FFFFFF">
          <td align="right"><span class="pageheading"><b></b></td><td width="14.5%"></td></tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Gross Total</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
              //printf('$%.2f',$myrow[17]);
              printf('%s%.2f</td>',$myrow[30],$myrow[17]);
            // echo  "$myrow[21]"?>
        </tr>

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Tax</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
              //printf('$%.2f',$myrow[18]);
            printf('%s%.2f</td>',$myrow[30],$myrow[18]);
            // echo  "$myrow[21]"?>
        </tr>

       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Shipping</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
              //printf('$%.2f',$myrow[19]);
           printf('%s%.2f</td>',$myrow[30],$myrow[19]);
           // echo  "$myrow[21]"?>
        </tr>

      <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Labor</p></font></td>

           <td align="right"><span class="tabletext">
            <?php
            //  printf('$%.2f',$myrow[20]);
           printf('%s%.2f</td>',$myrow[30],$myrow[20]);
           // echo  "$myrow[21]"?>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Total Due</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
            //  printf('$%.2f',$myrow[21]);
            printf('%s%.2f</td>',$myrow[30],$myrow[21]); ?>
        </tr>

        </tr>
    </table>
 </td>
    <!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
      </tr>
      <tr bgcolor="DEDFDE">
          <td width="6"><img src="images/box-left-bottom.gif"></td>
        <td><img src="images/spacer.gif " height="6"></td>
        <td width="6"><img src="images/box-right-bottom.gif"></td>
      </tr>
     --></table>
      </FORM>
</table>
</body>
</html>
