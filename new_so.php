<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = July 20, 2006                =
// Filename: new_so.php                        =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows salesorder entry.                    =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'newso';
$page = 'CRM: Sales Order';
//session_register('pagename');
// First include the class definition
include('classes/userClass.php');
include_once('classes/loginClass.php');
include('classes/workorderClass.php');
include('classes/empClass.php');
include('classes/companyClass.php');
include('classes/workflowClass.php');
include('classes/displayClass.php');
include('classes/pageClass.php');
include('classes/salesorderClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newPages = new page;
$newCustomer = new company;
$newdisp = new display;
$result = $newCustomer->getAllCustomers();
$newEmp = new emp;
$employees = $newEmp->getAllEmps();

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/salesorder.js"></script>

<html>
<head>
<title>New SO Entry</title>
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
    <a href="exit.php" onMouseOut="MM_swapImgRestore()"
    onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0"
     src="images/logout.gif"></a>
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
                <td><span class="pageheading"><b>New Sales Order</b></td>
</tr>

</tr>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="stdtable1">
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>General Information</b></center></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span> Customer</p></font></td>

            <td><input type="text" name="company"
                    style=";background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="">

             <img src="images/bu-getcustomer.gif" alt="Get Customer"
                 onclick="GetAllCustomers()">
            </td>
    <input type="hidden" name="companyrecnum"></td>
    
            <td><span class="labeltext"><p align="left">Resell #</p></font></td>
            <td ><input type="text" name="resellnum" size=20 value=""></td>
</tr>


<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Description</p></font></td>
            <td><input type="text" name="description" size=36 value=""></td>
             <td><span class="labeltext"><p align="left">Currency</p></font></td>
             <td><span class="labeltext"><select name="currency" size="1" width="100">
             <option selected>$ </option>
             <option value>Rs </option>
             </select>
</tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span> Our Sales Order #</p></font></td>
            <td><span class="tabletext"><input type="text" name="sales_order" size=20 value=""></td>
            <td><span class="tabletext"><p align="left"><b>Order Date</b></p></font></td>
            <td><input type="text" name="order_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="">
             <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('order_date')">
            </td>
        </tr>

        <tr bgcolor="#FFFFFF">
   <input type="hidden" name="quoterecnum">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span> Quote #</p></font></td>
            <td><input type="text" name="quote_num" style="background-color:#DDDDDD;" readonly="readonly" size=20 value="">
             <img src="images/bu-getquote.gif" alt="Get Quote No" onclick="GetQuoteNo()">

            <td><span class="tabletext"><p align="left"><span class='asterisk'>*</span> <b>Due Date</b></p></font></td>
            <td><input type="text" name="due_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="">
                    <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('due_date')">
            </td>
        </tr>

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span> PO #</p></font></td>
            <td colspan=3><input type="text" name="po_num" style="background-color:#DDDDDD;" readonly="readonly" size=20 value="">
              <img src="images/bu-getpo.gif" alt="Get PO No" onclick="GetPONo()">

              <input type="hidden" name="porecnum">
          </tr>
            <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span> Sales Person</p></font></td>
            <td  colspan=3><input type="text" name="so2employee"
                    style=";background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="">
             <img src="images/bu-getemployee.gif" alt="Get Employee" onclick="GetAllEmps()">

            </td>
            <input type="hidden" name="salespersonrecnum">
            </tr>




        <tr bgcolor="#FFFFFF"  >
            <td><span class="labeltext">Special Instruction</font></td>
             <td colspan=4><textarea name="special_instruction" rows="4" cols="45" value=""></textarea></td>
        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b><span class='asterisk'>*</span>Contact Information</b></center></td>
        </tr>
      <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Contact</p></font></td>

            <td colspan=3><input type="text" name="contact"
                           style="background-color:#DDDDDD;"
                    readonly="readonly" size=25 value="">
              <img src="images/bu-getcontact.gif" alt="Get COntact"  onclick="GetContact()">
              <input type="hidden" name="contactrecnum">
            </td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Phone</p></font></td>
            <td><input type="text" name="phone" style="background-color:#DDDDDD;"
                              readonly="readonly" size=25 value=""></td>

            <td><span class="labeltext"><p align="left">Email</p></font></td>
            <td><input type="text" name="email" style="background-color:#DDDDDD;"
                         readonly="readonly" size=30 value=""></td>
        </tr>

<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Sales Order Line Items</b></center></td>
</tr>
<input type="hidden" name="caserecnum" value="<?php echo $caserecnum ?>">
<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>
<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable" >
<thead><tr>
<td class="head0"><span class="heading"><b><center>Item number</center></b></td>
<td class="head1"><span class="heading"><b><center>Partnum</center></b></td>
<td class="head1"><span class="heading"><b><center>Dim1</center></b></td>
<td class="head1"><span class="heading"><b><center>Dim2</center></b></td>
<td class="head1"><span class="heading"><b><center>Dim3</center></b></td>

<td class="head1"><span class="heading"><b><center>Description</center></b></td>
<td class="head0"><span class="heading"><b><center>Quantity</center></b></td>
<td class="head1"><span class="heading"><b><center>Unit Price</center></b></td>
<td class="head0"><span class="heading"><b><center>Amount</center></b></td>
</tr>
</thead>
<?php
      $i=1;
      while ($i<=5)
     {
    printf('<tr bgcolor="#FFFFFF">');
    $line_num="line_num" . $i;
    $item_desc="item_desc" . $i;
    $qty="qty" . $i;
    $price="price" . $i;
    $amount="amount" . $i;
    $partnum="partnum" . $i;
    $dim1="dim1" . $i;
    $dim2="dim2" . $i;
    $dim3="dim3" . $i;  
    
    echo "<td  ><span class=\"tabletext\"><input type=\"text\"  name=\"$line_num\" id=\"$line_num\"  value=\"\" size=\"5\"></td>";
    echo "<td ><input type=\"text\" name=\"$partnum\" id=\"$partnum\" size=\"15\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\">";?><img src="images/get.gif" alt="Get CIM"  size=3 onclick="GetCIM('<?php echo "$i";?>')" style='white-space:nowrap'></td>
    <?
    echo "<td ><input type=\"text\" name=\"$dim1\" id=\"$dim1\" size=\"5\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$dim2\" id=\"$dim2\" size=\"5\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$dim3\" id=\"$dim3\"size=\"5\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\"></td>";

    echo "<td ><input type=\"text\" name=\"$item_desc\" id=\"$item_desc\" size=\"25\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$qty\" id=\"$qty\" size=\"5\" value=\"\"></td>";
    echo "<td ><input type=\"text\" name=\"$price\" id=\"$price\" size=\"5\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$amount\" id=\"$amount\" style=\"background-color:#DDDDDD;\"
                readonly=\"readonly\" size=\"10\" value=\"\"></td>";
    printf('</tr>');
    $i++;
    }
echo "<input type=\"hidden\" name=\"index\" id=\"index\" value=$i>";
     // $tax='10%' ;
     // $shipping='10%' ;
     // $labour='10%' ;
?>
</table></tr>

     <tr bgcolor="#FFFFFF">
       <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
          <td align="right"><span class="pageheading"><b></b></td><td width="12%"></td></tr>


         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Tax</p></font></td>
            <td colspan=3><input type="text" name="tax" size=10 value=""></td>
        </tr>

       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Shipping</p></font></td>
            <td colspan=3><input type="text" name="shipping" size=10 value=""></td>
        </tr>

      <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Labor</p></font></td>
            <td colspan=3><input type="text" name="labor" size=10 value=""></td>
        </tr>


 </tr>
 </table>

 
    </table>
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