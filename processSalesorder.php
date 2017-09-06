<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 2, 2006                 =
// Filename: processSalesorder.php             =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Processes Sales Order                       =
//==============================================

session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$pagename= $_SESSION['pagename'];
// First include the class definition

include('classes/salesorderClass.php');
include('classes/soliClass.php');
include('classes/quoteClass.php');
include('classes/quoteliClass.php');

$userid = $_SESSION['user'];
//$companyrecnum = $_SESSION['companyrecnum'];
$salespersonrecnum = $_REQUEST['salespersonrecnum'];
$companyrecnum = $_REQUEST['companyrecnum'];
// Next, create an instance of the class
$newsalesorder= new salesorder;
$soli = new soli;
$newQuote = new quote;
$quoteli = new quoteli;


if($pagename=='newso')
{
  // echo"<pre>";
  // print_r($_REQUEST);
  // exit;
    $so2customer = $_REQUEST['companyrecnum'];
    $so2contact = $_REQUEST['contactrecnum'];
    $so2employee = $_REQUEST['salespersonrecnum'];
    $description = $_REQUEST['description'];
    $sales_order = $_REQUEST['sales_order'];
    $order_date = $_REQUEST['order_date'];
    $due_date = $_REQUEST['due_date'];
    $special_instruction = $_REQUEST['special_instruction'];
    $quote_num = $_REQUEST['quoterecnum'];
    $po_num = $_REQUEST['porecnum'];
    $currency=$_REQUEST['currency'];
    $resellnum = $_REQUEST['resellnum'];
    $tax = $_REQUEST['tax'];
    $labor = $_REQUEST['labor'];
    $shipping=$_REQUEST['shipping'];
    
    $tax = $tax;
    $labor = $labor;
    $shipping = $shipping;
// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();
$newsalesorder->setso2customer($so2customer);
$newsalesorder->setso2contact($so2contact);
$newsalesorder->setso2employee($so2employee);
$newsalesorder->setdescription($description);
$newsalesorder->setsales_order($sales_order);
$newsalesorder->setorder_date($order_date);
$newsalesorder->setdue_date($due_date);
$newsalesorder->setspecial_instruction($special_instruction);
$newsalesorder->setquote_num($quote_num);
$newsalesorder->setresellnum($resellnum);
$newsalesorder->setpo_num($po_num);
$newsalesorder->settax($tax);
$newsalesorder->setlabor($labor);
$newsalesorder->setshipping($shipping);
$newsalesorder->setgrosstotal($grosstotal);
$newsalesorder->setcurrency($currency);
$crdate = date("d-M-y");
$i=1;
$soamount=0;
$totaldue=0;
$flag=0;
$sorecnum='';

while($i<15)
{
//echo "inside while";
    $line_num="line_num" . $i;
    $item_desc="item_desc" . $i;
    $qty="qty" . $i;
    $price="price" . $i;
    $amount="amount" . $i;
    $partnum="partnum" . $i;
    $dim1="dim1" . $i;
    $dim2="dim2" . $i;
    $dim3="dim3" . $i;
    if ( isset ( $_REQUEST[$line_num] ) ) {
    $linenumber1= $_REQUEST[$line_num];
    $itemdesc1 = $_REQUEST[$item_desc];
    $qty1 = $_REQUEST[$qty];
    $price1 = $_REQUEST[$price];
    $amount1 = $_REQUEST[$amount];
    $partnum1 = $_REQUEST[$partnum];
    $dim_1 = $_REQUEST[$dim1];
    $dim_2 = $_REQUEST[$dim2];
    $dim_3 = $_REQUEST[$dim3];

//echo "\nI am linenumber1  :  " . $price1;
    if ($linenumber1 != '')
    {
    $amount1=0;
        $amount1 = $price1 * $qty1;
   if($flag==0)
      {  //echo "\nI am linenumber1  :  " . $price1;
            
                $j=1;
                while($j<15)
                {
                    $linetot="line_num" . $j;
                    $qtytot="qty" . $j;
                    $pricetot="price" . $j;
                    if ( isset ( $_REQUEST[$linetot] ) ) {
                    $linenumber2= $_REQUEST[$linetot];
                    $qty2 = $_REQUEST[$qtytot];
                    $price2 = $_REQUEST[$pricetot];
                    if ($linenumber2 != '')
                    {
                        $amount2=0;
                        $amount2 = $price2 * $qty2;
                        $soamount= $soamount+$amount2;
                        $tax1=$tax;
                        $labor1=$labor;
                        $shipping1=$shipping;
                        $totaldue =$tax1+$labor1+$shipping1+$soamount;

                    }
                 }
                    $j++;
                }
                $newlogin = new userlogin;
                $newlogin->dbconnect();
                $newsalesorder->setgrosstotal($soamount);
                $newsalesorder->settax($tax1);
                $newsalesorder->setlabor($labor1);
                $newsalesorder->setshipping($shipping1);
                $newsalesorder->settotal_due($totaldue);
                $sql = "start transaction";
                $result = mysql_query($sql);
                // $sorecnum = $newsalesorder->addSalesorder();
                $flag=1;
              }
              $sorecnum = 7;
             $soli->setlink2so($sorecnum);
             $soli->setitem_num($linenumber1);
             $soli->setitem_desc($itemdesc1);
             $soli->setqty($qty1);
             $soli->setprice($price1);
             $soli->setamount($amount1);
             $soli->setpartnum($partnum1);
             $soli->setdim1($dim_1);
             $soli->setdim2($dim_2);
             $soli->setdim3($dim_3);

             $soli->addQI();
             $sql = "commit";
             $result = mysql_query($sql);

             if(!$result)
            {
                 $sql = "rollback";
                 $result = mysql_query($sql);
                 die("Commit failed Sales Oreder Insert..Please report to Sysadmin. " . mysql_errno());
             }
        
    }
    }
    $i++;
}
}
if($pagename=='quoteDetails')
{

 $quoterecnum=$_REQUEST['quoterecnum'];
 $myQI = $quoteli->getQI($quoterecnum);
 $result = $newQuote->getQuote($quoterecnum);
 $myrow = mysql_fetch_assoc($result);
 //print_r($myrow); exit;
    $so2contact = $myrow['quote2company'];
    $so2employee = $myrow['quote2employee'];
    $description = $myrow['descr'];
    $sales_order = 'so-' .  $myrow['id'];
    $order_date = $myrow['quote_date'];
    $due_date = $myrow['delivarydate'];
    $quote_num = $myrow['id'];
    $currency=$myrow['currency'];
    $resellnum = $myrow['resellnum'];
    $tax = $myrow['tax'];
    $labor = $myrow['labor'];
    $shipping=$myrow['shipping'];
    $grosstotal=$myrow['quote_grosstotal'];

    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $newsalesorder->setso2contact($so2contact);
    $newsalesorder->setso2employee($so2employee);
    $newsalesorder->setdescription($description);
    $newsalesorder->setsales_order($sales_order);
    $newsalesorder->setorder_date($order_date);
    $newsalesorder->setdue_date($due_date);
    $newsalesorder->setquote_num($quote_num);
    
    $newsalesorder->setresellnum($resellnum);
    $newsalesorder->settax($tax);
    $newsalesorder->setlabor($labor);
    $newsalesorder->setshipping($shipping);
    //$newsalesorder->setgrosstotal($grosstotal);
    $newsalesorder->setcurrency($currency);
    $crdate = date("d-M-y");
    $i=1;
    $soamount=0;
    $totaldue=0;
    $flag=0;
    $sorecnum='';
    $i=1;
    while($myLI=mysql_fetch_assoc($myQI))
{
//print_r($myLI); exit;
    $line_num="line_num" . $i;
    $item_desc="item_desc" . $i;
    $qty="qty" . $i;
    $price="price" . $i;
    $amount="amount" . $i;
    if (  $myLI['recnum']!=''  ) {
    $line_num= $myLI['item'];
    $item_desc = $myLI['item_desc'];
    $qty = $myLI['quantity'];
    $price = $myLI['rate'];
    $amount = $myLI['amount'];
  }
  if($flag==0)
      {  //echo "\nI am linenumber1  :  " . $price1;
            
                
                
                $totaldue =$tax+$labor+$shipping+$grosstotal;
                //echo $totaldue; exit;
                
                $newsalesorder->setgrosstotal($grosstotal);
                $newsalesorder->settax($tax);
                $newsalesorder->setlabor($labor);
                $newsalesorder->setshipping($shipping);
                $newsalesorder->settotal_due($totaldue);
                $sql = "start transaction";
                $result = mysql_query($sql);
                // $sorecnum = $newsalesorder->addSalesorder();
                $flag=1;
              }
            $sorecnum = 7;
             $soli->setlink2so($sorecnum);
             $soli->setitem_num($line_num);
             $soli->setitem_desc($item_desc);
             $soli->setqty($qty);
             $soli->setprice($price);
             $soli->setamount($amount);
             $soli->addQI();
             $sql = "commit";
             $result = mysql_query($sql);

             if(!$result)
            {
                 $sql = "rollback";
                 $result = mysql_query($sql);
                 die("Commit failed Sales Oreder Insert..Please report to Sysadmin. " . mysql_errno());
             }
        
    
    
    $i++;



}
}

if ($pagename== 'editso')
{
   $salesorderrecnum  =$_REQUEST['salesorderrecnum'] ;
//echo "I am inside editso";
   $so2customer = $_REQUEST['companyrecnum'];
   $so2contact = $_REQUEST['contactrecnum'];
   $so2employee = $_REQUEST['salespersonrecnum'];
   $description = $_REQUEST['description'];
   $sales_order = $_REQUEST['sales_order'];
   $order_date = $_REQUEST['order_date'];
   $due_date = $_REQUEST['due_date'];
//   $currency = $_REQUEST['currency'];
   $special_instruction = $_REQUEST['special_instruction'];
   $quote_num = $_REQUEST['quoterecnum'];
   $resellnum = $_REQUEST['resellnum'];
   $po_num = $_REQUEST['porecnum'];
   
    $tax = $_REQUEST['tax'];
    $labor = $_REQUEST['labor'];
    $shipping=$_REQUEST['shipping'];
    $tax = $tax;
    $labor = $labor;
    $shipping = $shipping;
   
   $sql = "start transaction";
   $result = mysql_query($sql);
   $newsalesorder->setso2customer($so2customer);
   $newsalesorder->setso2contact($so2contact);
   $newsalesorder->setso2employee($so2employee);
   $newsalesorder->setdescription($description);
   $newsalesorder->setsales_order($sales_order);
   $newsalesorder->setorder_date($order_date);
   $newsalesorder->setdue_date($due_date);
   $newsalesorder->setcurrency($currency);
   $newsalesorder->setspecial_instruction($special_instruction);
   $newsalesorder->setquote_num($quote_num);
   $newsalesorder->setresellnum($resellnum);
   $newsalesorder->setpo_num($po_num);

   $newsalesorder->updateSalesorder($salesorderrecnum);
   $soamount=0;
   $flag=0;
   $sorecnum='';
   $i=1;
$max=$_REQUEST['index'];
while($i<$max)
{
    $linenumber="line_num" . $i;
    $itemdesc="item_desc" . $i;
    $qty="qty" . $i;
    $rate="rate" . $i;
    $amount="amount" . $i;
    $prevlinenum="prev_line_num" . $i;
    $lirecnum="lirecnum" . $i;
    $partnum="partnum" . $i;
    $dim1="dim1" . $i;
    $dim2="dim2" . $i;
    $dim3="dim3" . $i;

    $lirecnum1=$_REQUEST[$lirecnum];
    $prevlinenum1=$_REQUEST[$prevlinenum];
    $linenumber1= $_REQUEST[$linenumber];
    $itemdesc1 = $_REQUEST[$itemdesc];
    $qty1 = $_REQUEST[$qty];
    $rate1 = $_REQUEST[$rate];
    $partnum1 = $_REQUEST[$partnum];
    $dim_1 = $_REQUEST[$dim1];
    $dim_2 = $_REQUEST[$dim2];
    $dim_3 = $_REQUEST[$dim3];

    $newlogin = new userlogin;
    $newlogin->dbconnect();

    if ($linenumber1 != '')
    {
//  echo "\nIam inside linenumber1  : " . $linenumber1 ;
        $amount1=0;
        $amount1 = $rate1 * $qty1;
            if($flag==0)
            {
                $j=1;
                while($j<$max)
                {
                    $linetot="line_num" . $j;
                    $qtytot="qty" . $j;
                    $ratetot="rate" . $j;
                    $linenumber2= $_REQUEST[$linetot];
                    $qty2 = $_REQUEST[$qtytot];
                    $rate2 = $_REQUEST[$ratetot];
                 if ($linenumber2 != '')
                    {
                        $amount2=0;
                        $amount2 = $rate2 * $qty2;
                        $soamount=$soamount+$amount2;
                                                $tax1= $tax;
                        $labor1=$labor;
                        $shipping1=$shipping;
                        $totaldue =$tax1+$labor1+$shipping1+$soamount;

                    }
                    $j++;
                }
                $sql = "start transaction";
                $result = mysql_query($sql);
                $newsalesorder->setgrosstotal($soamount);
                $newsalesorder->settax($tax1);
                $newsalesorder->setlabor($labor1);
                $newsalesorder->setshipping($shipping1);
                $newsalesorder->settotal_due($totaldue);
                $sql = "start transaction";
                $result = mysql_query($sql);
                $newsalesorder->updateSalesorder($salesorderrecnum);
                $flag=1;
            }
             $soli->setlink2so($salesorderrecnum);
             $soli->setitem_num($linenumber1);
             $soli->setitem_desc($itemdesc1);
             $soli->setqty($qty1);
             $soli->setprice($rate1);
             $soli->setamount($amount1);
             $soli->setpartnum($partnum1);
             $soli->setdim1($dim_1);
             $soli->setdim2($dim_2);
             $soli->setdim3($dim_3);
            // echo "prevlinenum1  :  " . $prevlinenum1;
         if($prevlinenum1!='')
            {
                $soli->updateQI($lirecnum1);

            }
            else
            {
                $soli->addQI();
            }
    }
    else
    {
         if ($prevlinenum1 != '')
         {
                $soli->deleteLI($lirecnum1);
          }
    }
     $sql = "commit";
     $result = mysql_query($sql);
     if(!$result)
    {
         $sql = "rollback";
         $result = mysql_query($sql);
         die("Commit failed SO Insert..Please report to Sysadmin. " . mysql_errno());
     }
$i++;
}
$salesorderrecnum = $_REQUEST['salesorderrecnum'];
if ($_SESSION['pagename'] == 'editso') {
    $delete = $_REQUEST['deleteflag'];
}
if ($pagename == 'editso' && $delete == 'y') {
           $newsalesorder->deleteSalesorder($salesorderrecnum);

}

}

if ($pagename == 'editso') {
    header("Location:soDetails.php?salesorderrecnum=$salesorderrecnum");
}
else {
    header("Location:salesorder.php");
}

?>