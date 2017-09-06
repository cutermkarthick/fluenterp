<?php
//==============================================
// Author: FSI                                 =
// Date-written = July 20, 2006                =
// Filename: edit_so.php                       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Allows editing of SalesOrders               =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'editso';
$page = 'CRM: Sales Order';
//session_register('pagename');

// First include the class definition
include_once('classes/loginClass.php');
include('classes/displayClass.php');
include('classes/pageClass.php');
include('classes/soliClass.php');
include('classes/salesorderClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisp = new display;
$newsalesorder = new salesorder;
$soli = new soli;

$salesorderrecnum = $_REQUEST['salesorderrecnum'];
$myQI = $soli->getQI($salesorderrecnum);
$result = $newsalesorder->getSalesorder($salesorderrecnum);
$myrow = mysql_fetch_row($result);

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/salesorder.js"></script>

<html>
<head>
<title>Edit Sales Order</title>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" rightmargin="0">
<form action='processSalesorder.php' method='post'>

<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
  <tr>
      <td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
            <td align="right">&nbsp;
            <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a>
      </td>
  </tr>
</table>
      <table width=100% border=0 cellpadding=0 cellspacing=0  >
       <tr><td>
         </td></tr>
        <tr>
         <td>
        <?php $newdisp->dispLinks(''); ?>
        </td></tr>
      </table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
 --><table width=100% border=0 cellspacing="1" cellpadding="6">
<tr>
<td><span class="pageheading"><b>Edit Sales Order</b></td>
<td colspan=20>&nbsp;</td>
  <td bgcolor="#FFFFFF" align="right">
  <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="javascript: return ConfirmDelete()" value="Delete" >
  <!-- <input type= "image" name="Delete" src="images/bu-delete.gif" value="Get" onclick="javascript: return ConfirmDelete()">
   --></td>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="stdtable1">
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>General Information</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span> Our Sales Order #</p></font></td>
            <td><span class="tabletext"><input type="text" name="sales_order" size=20 value="<?php echo $myrow[4]?>" style="background-color:#DDDDDD;"
                    readonly="readonly"></td>
              <td><span class="tabletext"><p align="left"><b>Order Date</b></p></font></td>
            <td><input type="text" name="order_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="<?php echo $myrow[5]?>">
             <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('order_date')">
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span> Customer</p></font></td>

            <td><input type="text" name="company"
                    style=";background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="<?php echo $myrow[1]?>">

             <img src="images/bu-getcustomer.gif" alt="Get Customer"
                 onclick="GetAllCustomers()">
            </td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span> Sales Person</p></font></td>
            <td><input type="text" name="so2employee"
                    style=";background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="<?php echo $myrow[22].' '.$myrow[23]?>">
             <img src="images/bu-getemployee.gif" alt="Get Employee" onclick="GetAllEmps()">

            </td>
        </tr>
    <input type="hidden" name="salespersonrecnum" value="<?php echo $myrow[25]?>">
    <input type="hidden" name="companyrecnum" value="<?php echo $myrow[24]?>"></td>
    
    
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Description</p></font></td>
            <td><input type="text" name="description" size=36 value="<?php echo $myrow[3]?>"></td>
             <td><span class="tabletext"><p align="left"><span class='asterisk'>*</span> <b>Due Date</b></p></font></td>
            <td><input type="text" name="due_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="<?php echo $myrow[6]?>">
             <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('due_date')">
            </td>

           </tr>


        <tr bgcolor="#FFFFFF">
          <input type="hidden" name="quoterecnum" value="<?php echo $myrow[26]?>">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span> Quote #</p></font></td>
            <td><input type="text" name="quote_num" style="background-color:#DDDDDD;" readonly="readonly" size=20 value="<?php echo $myrow[15]?>">
          <img src="images/bu-getquote.gif" alt="Get Quote No" onclick="GetQuoteNo()">
          <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span> PO #</p></font></td>
           <td><input type="text" name="po_num" style="background-color:#DDDDDD;" readonly="readonly" size=20 value="<?php echo $myrow[16] ?>">
          <img src="images/bu-getpo.gif" alt="Get PO No" onclick="GetPONo()">
           <input type="hidden" name="porecnum" value="<?php echo $myrow[31]?>">

          </tr>
          
          <tr bgcolor="#FFFFFF"  >
            <td><span class="labeltext">Special Instruction</font></td>
            <td><textarea name="special_instruction" rows="1" cols=45% value=""><?php echo  "$myrow[7]";?></textarea></td>
            <td><span class="labeltext"><p align="left">Resell #</p></font></td>
            <td ><input type="text" name="resellnum" size=20 value="<?php echo $myrow[33]?>"></td>
          </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>*Contact Information</b></center></td>
        </tr>
      <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Contact</p></font></td>

            <td colspan=3><input type="text" name="contact"
                           style="background-color:#DDDDDD;"
                    readonly="readonly" size=25 value="<?php echo $myrow[27].' '.$myrow[28]?>">
              <img src="images/bu-getcontact.gif" alt="Get COntact"  onclick="GetContact()">
              <input type="hidden" name="contactrecnum" value="<?php echo $myrow[32]?>">
            </td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Phone</p></font></td>
            <td><input type="text" name="phone" style="background-color:#DDDDDD;"
                              readonly="readonly" size=25 value="<?php echo $myrow[8]?>"></td>

            <td><span class="labeltext"><p align="left">Email</p></font></td>
            <td><input type="text" name="email" style="background-color:#DDDDDD;"
                         readonly="readonly" size=30 value="<?php echo $myrow[29]?>"></td>
        </tr>
            <input type="hidden" name="deleteflag" value="">
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Sales Order Line Items</b></center></td>
</tr>
<input type="hidden" name="caserecnum" value="<?php echo $caserecnum ?>">
<tr bgcolor="#FFFFFF"><td><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a>
<td colspan=4 bgcolor="#FFFFFF"><span class="tabletext">To delete line items - blankout line number</td></tr>
<tr bgcolor="#FFFFFF">

<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable" >
<thead><tr>
<td class="head0"><span class="heading"><b><center>Item number</center></b></td>
<td class="head1" width=10%><span class="heading"><b><center>Partnum</center></b></td>
<td class="head0" width=10%><span class="heading"><b><center>Dim1</center></b></td>
<td class="head1" width=10%><span class="heading"><b><center>Dim2</center></b></td>
<td class="head0" width=10%><span class="heading"><b><center>Dim3</center></b></td>
<td class="head1"><span class="heading"><b><center>Description</center></b></td>
<td class="head0"><span class="heading"><b><center>Quantity</center></b></td>
<td class="head1"><span class="heading"><b><center>Unit Price</center></b></td>
<td class="head0"><span class="heading"><b><center>Amount</center></b></td>
</tr></thead>
</tr>
<?php
   $i=1;$flag=0;
   while($i<=5)
  {
    if($flag==0)
    {
     while ($QI = mysql_fetch_row($myQI))
        {

      //echo "i am inside inner while loop";
      printf('<tr bgcolor="#FFFFFF">');
      $linenumber="line_num" . $i;
      $itemdesc="item_desc" . $i;
      $qty="qty" . $i;
      $price="price" . $i;
      $amount="amount" . $i;
          $prevlinenum="prev_line_num" . $i;
      $lirecnum="lirecnum" . $i;
              $partnum="partnum" . $i;
    $dim1="dim1" . $i;
    $dim2="dim2" . $i;
    $dim3="dim3" . $i;  
      //echo "prevlinenum  : " . $prevlinenum . "    " . $QI[0];
      //echo "<br>$linenumber<br>$itemname<br>$itemdesc<br>$qty<br>$rate<br>$duedate<br>";
      echo "<td ><span class=\"tabletext\"><input type=\"text\"  name=\"$linenumber\" id=\"$linenumber\"  value=\"$QI[0]\" size=\"5\"></td>";
        echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$QI[0]\">";
      echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$QI[5]\">";

        echo "<td ><input type=\"text\" name=\"$partnum\" id=\"$partnum\" size=\"15\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$QI[6]\">";?><img src="images/get.gif" alt="Get CIM"  size=3 onclick="GetCIM('<?php echo "$i";?>')" style='white-space:nowrap'></td>
    <?
    echo "<td ><input type=\"text\" name=\"$dim1\" id=\"$dim1\" size=\"5\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$QI[28]\"></td>";
    echo "<td ><input type=\"text\" name=\"$dim2\" id=\"$dim2\" size=\"5\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$QI[29]\"></td>";
    echo "<td ><input type=\"text\" name=\"$dim3\" id=\"$dim3\"size=\"5\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"$QI[30]\"></td>";


      echo "<td ><input type=\"text\" name=\"$itemdesc\" id=\"$itemdesc\" size=\"25\" value=\"$QI[1]\"></td>";
      echo "<td ><input type=\"text\" name=\"$qty\" id=\"$qty\" size=\"5\" value=\"$QI[2]\"></td>";
            echo "<td ><input type=\"text\" name=\"$price\" id=\"$price\" size=\"5\" value=\"$QI[3]\"></td>";
            echo "<td><input type=\"text\" name=\"$amount\" id=\"$amount\" style=\"background-color:#DDDDDD;\"
              readonly=\"readonly\" size=\"10\" value=\"$QI[4]\">";
      printf('</tr>');
   $i++;
            }
    $flag=1;
         }
  //echo "i am in outside while loop";
    printf('<tr bgcolor="#FFFFFF">');
      $linenumber="line_num" . $i;
    $itemdesc="item_desc" . $i;
    $qty="qty" . $i;
    $duedate="due_date" . $i;
    $price="price" . $i;
    $amount="amount" . $i;
    $prevlinenum="prev_line_num" . $i;
    $lirecnum="lirecnum" . $i;
        $partnum="partnum" . $i;
    $dim1="dim1" . $i;
    $dim2="dim2" . $i;
    $dim3="dim3" . $i;  
    //echo "<br>$linenumber<br>$itemname<br>$itemdesc<br>$qty<br>$rate<br>$duedate<br>";
    echo "<td ><span class=\"tabletext\"><input type=\"text\"  name=\"$linenumber\" id=\"$linenumber\"  value=\"\" size=\"5\"></td>";
    echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"\">";
    echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$QI[4]\">";

       echo "<td ><input type=\"text\" name=\"$partnum\" id=\"$partnum\" size=\"15\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\">";?><img src="images/get.gif" alt="Get CIM"  size=3 onclick="GetCIM('<?php echo "$i";?>')" style='white-space:nowrap'></td>
    <?
    echo "<td ><input type=\"text\" name=\"$dim1\" id=\"$dim1\" size=\"5\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$dim2\" id=\"$dim2\" size=\"5\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$dim3\" id=\"$dim3\"size=\"5\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";

       echo "<td ><input type=\"text\" name=\"$itemdesc\" id=\"$itemdesc\" size=\"25\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$qty\" id=\"$qty\" size=\"5\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$price\" id=\"$price\" size=\"5\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$amount\" id=\"$amount\" style=\"background-color:#DDDDDD;\"
          readonly=\"readonly\" size=\"10\" value=\"\">";
    printf('</tr>');
    $i++;
   }
   echo "<input type=\"hidden\" name=\"index\" id=\"index\" value=$i>";

 ?>

       <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
          <td align="right"><span class="pageheading"><b></b></td><td width="12.3%"></td></tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Gross Total</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
              printf('$%.2f',$myrow[17]);
            // echo  "$myrow[21]"?>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Tax</p></font></td>
            <td><input type="text" name="tax" size=10 value="<?php echo $myrow[18]?>"></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Shipping</p></font></td>
            <td><input type="text" name="labor" size=10 value="<?php echo $myrow[19]?>"></td>
        </tr>

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Labor</p></font></td>
            <td><input type="text" name="shipping" size=10 value="<?php echo $myrow[20]?>"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Total Due</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
              printf('$%.2f',$myrow[21]);
            // echo  "$myrow[21]"?>
        </tr>
        <tr></tr>

 </table>

 <!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
      </tr>
      <tr bgcolor="DEDFDE">
          <td width="6"><img src="images/box-left-bottom.gif"></td>
        <td><img src="images/spacer.gif " height="6"></td>
        <td width="6"><img src="images/box-right-bottom.gif"></td>
    </tr>
 -->
    </table>
     <input type="hidden" name="salesorderrecnum" value="<?php echo $salesorderrecnum; ?>">
               <span class="labeltext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields1()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">
         </table>

</FORM>
</body>
</html>