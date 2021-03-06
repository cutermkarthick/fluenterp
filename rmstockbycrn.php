<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 19, 2008                =
// Filename: crn_status.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Displays WO Status report                   =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'reports';
$page= "Reports";
//////session_register('pagename');


include_once('classes/loginClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

date_default_timezone_set('Asia/Calcutta');
 $todate1 = date("Y-m-d");
 $today = split('-',$todate1);
$days = $today[2]-1;
$fromdate1 = date("Y-m-d",strtotime("-$days days"));

// For paging - Added on Dec 6,04

// how many rows to show per page
$rowsPerPage = 500000;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if (isset($_REQUEST['page']))
{
	//echo "i am set";
    $pageNum = $_REQUEST['page'];
}
if (isset($_REQUEST['totpages']))
{
    $totpages = $_REQUEST['totpages'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

$crn=$_REQUEST['crn'];
$fdate=$_REQUEST['fdate'];
$tdate=$_REQUEST['tdate'];

if($tdate=='')
{

   if($crn !='')
{
 $cond5 = "(grn.crn like '".$crn."%')";
 $cim_match=$crn;
}else
{

 $cond5 = "(grn.crn like '%' || grn.crn is NULL)";
 $cim_match='';
}
 $cond31 = "to_days(grn.recieved_date) " . ">= to_days('" . $fromdate1 . "')";
 $cond32 = "to_days(grn.recieved_date) " . "<= to_days('" . $todate1 . "')";
 $cond3= $cond31 . ' and ' . $cond32;
 
 $condw1 = "to_days(w.book_date) " . ">= to_days('" . $fromdate1 . "')";
 $condw2 = "to_days(w.book_date) " . "<= to_days('" . $todate1 . "')";
 $condw= $condw1 . ' and ' . $condw2;
}else
{

   if($crn !='')
{
 $cond5 = "(grn.crn like '".$crn."%')";
 $cim_match=$crn;
}else
{

 $cond5 = "(grn.crn like '%' || grn.crn is NULL)";
 $cim_match='';
}

  //echo $fdate."*--*-*".$tdate;
  if($tdate=='')
  {   //echo"----8888here";
   $cond3 = "(to_days(grn.recieved_date)-to_days('1582-01-01') > 0 ||
                    grn.recieved_date = '0000-00-00' ||
                    grn.recieved_date = 'NULL' ) and
           (to_days(grn.recieved_date)-to_days('2050-12-31') < 0 ||
                    grn.recieved_date = '0000-00-00' ||
                    grn.recieved_date = 'NULL')";
   $condw = "(to_days(w.book_date)-to_days('1582-01-01') > 0 ||
                    w.book_date = '0000-00-00' ||
                    w.book_date = 'NULL' ) and
           (to_days(w.book_date)-to_days('2050-12-31') < 0 ||
                    w.book_date = '0000-00-00' ||
                    w.book_date = 'NULL')";
  } else
  {
    //echo"-----9999here<br>";
     $cond31 = "to_days(grn.recieved_date) " . ">= to_days('" . $fdate . "')";
     $cond32 = "to_days(grn.recieved_date) " . "<= to_days('" . $tdate . "')";
     $condw1 = "to_days(w.book_date) " . ">= to_days('" . $fdate . "')";
     $condw2 = "to_days(w.book_date) " . "<= to_days('" . $tdate . "')";
     $cond3=$cond32;
     $condw=$condw2;
     $fromdate1 = $fdate;
     $todate1= $tdate;
     //echo $cond3."*--*-*".$tdate."--------".$fromdate1."-*-*".$todate1;
  }
  //echo $finalref_match."****in***";
}
//$cond0 = "w.actual_ship_date like %";
//$cond0 = "w.condition like " . "'%'";

$cond1 = "grn.raw_mat_spec like '%'";
$cond2 = "grn.raw_mat_type like '%'";


$cond4 = "grn.grnnum like '%'";

if($crn !='')
{
 $cond5 = "(grn.crn like '".$crn."%')";
 $cim_match=$crn;
}else
{

 $cond5 = "(grn.crn like '%' || grn.crn is NULL)";
}

//$cond5 = "m.CIM_refnum like '%'";
$cond = $cond2 . ' and ' . $cond3 . ' and ' . $cond5;

$oper1='like';
$oper2='like';
$oper3='like';
$oper4='like';

$sess=session_id();
if ( isset ( $_REQUEST['flag'] ) )
{
     $flag = 1;
}
else
{
     $flag = 0;
}
if ( isset ( $_REQUEST['tcd'] ) )
{
     $total_cost_dollar = $_REQUEST['tcd'];
}
else
{
     $total_cost_dollar = 0;
}

if ( isset ( $_REQUEST['tcr'] ) )
{
     $total_cost_rupee = $_REQUEST['tcr'];
}
else
{
     $total_cost_rupee = 0;
}
if ( isset ( $_REQUEST['tcn'] ) )
{
     $total_cost_null = $_REQUEST['tcn'];
}
else
{
     $total_cost_null = 0;
}

if ( isset ( $_REQUEST['scomp'] ) )
{
     $company_match = $_REQUEST['scomp'];
     $scomp = "'" . $_REQUEST['scomp'] . "%'";
     $cond1 = "grn.raw_mat_spec like " . $scomp;

}
else {
     $company_match = '';
}

if ( isset ( $_REQUEST['swonum'] ) )
{
     $wonum_match = $_REQUEST['swonum'];
     if ( isset ( $_REQUEST['wonum_oper'] ) ) {
          $oper2 = $_REQUEST['wonum_oper'];
     }
     else {
         $oper2 = 'like';
     }
     if ($oper2 == 'like') {
         $swonum = "'" . $_REQUEST['swonum'] . "%" . "'";
     }
     else {
         $swonum = "'" . $_REQUEST['swonum'] . "'";
     }

     $cond2 = "grn.raw_mat_type " . $oper2 . " " . $swonum;

}
else {
     $wonum_match = '';
}

if ( isset ( $_REQUEST['sdate1'] ) || isset ( $_REQUEST['sdate2'] ) )
{
     $fromdate1 = $_REQUEST['sdate1'];
     $todate1 = $_REQUEST['sdate2'];
     if ( isset ( $_REQUEST['sdate1']) &&  $_REQUEST['sdate1'] != '' )
     {
          $date1 = $_REQUEST['sdate1'];
          $cond31 = "to_days(grn.recieved_date) " . ">= to_days('" . $date1 . "')";
          $condw1 = "to_days(w.book_date) " . ">= to_days('" . $date1 . "')";
     }
     else
     {
          $cond31 = "(to_days(grn.recieved_date)-to_days('1582-01-01') > 0 || grn.recieved_date = 'NULL' || grn.recieved_date = '0000-00-00')";
          $condw1 = "(to_days(w.book_date)-to_days('1582-01-01') > 0 || w.book_date = 'NULL' ||w.book_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['sdate2'] )  &&  $_REQUEST['sdate2'] != '')
     {
          $date2 = $_REQUEST['sdate2'];
          $cond32 = "to_days(grn.recieved_date) " . "<= to_days('" . $date2 . "')";
          $condw2 = "to_days(w.book_date) " . "<= to_days('" . $date2 . "')";
     }
     else
     {
          $cond32 = "(to_days(grn.recieved_date)-to_days('2050-12-31') < 0 || grn.recieved_date = 'NULL'
                       || grn.recieved_date = '0000-00-00')";
                        $condw2 = "(to_days(w.book_date)-to_days('2050-12-31') < 0 || w.book_date = 'NULL'
                       || w.book_date = '0000-00-00')";
     }
     $cond3 = $cond31 . ' and ' . $cond32;
     $condw = $condw1 . ' and ' . $condw2;
   //echo $cond3."-------";
}
else
{
      if($tdate!='')
     {
       $fromdate1 = $fdate;
       $todate1 = $tdate;
     }else
     { //echo"----here";
       $fromdate1 = $fromdate1;
       $todate1 = $todate1;
     }


}

if ( isset ( $_REQUEST['crn'] ) )
{
     $cim_match = $_REQUEST['crn'];
     $crn_match = $_REQUEST['crn'];
     if ( isset ( $_REQUEST['crn_oper'] ) ) {
          $oper4 = $_REQUEST['crn_oper'];
     }
     else {
         $oper4 = 'like';
     }
     if ($oper4 == 'like') {
         $crn = "'" . $_REQUEST['crn'] . "%" . "'";
     }
     else {
         $crn = "'" . $_REQUEST['crn'] . "'";
     }
     if($crn_match=='')
         $cond5 = "(grn.crn " . $oper4 . " " . $crn ." || grn.crn is null)" ;
     else
         $cond5 = "grn.crn " . $oper4 . " " . $crn ;

}
else {

 if($crn=='')
{
      $cim_match = '';
}else
{

  $cim_match = $crn;
}


}
if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];
}
if ( isset ( $_REQUEST['sortfld2'] ) ) {
    $sort2 = $_REQUEST['sortfld2'];
}

//$cond1 = "c.name like '%'";
$cond = $cond2 . ' and ' . $cond3 . ' and ' . $cond5;
//echo $cond;
// First include the class definition

include('classes/reportClass.php');
include('classes/displayClass.php');
$newreport = new report;
$newdisplay = new display;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
<html>
<head>
<title>Stock(GRN) Status Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');

?>
<form action='rmstockbycrn.php' method='post' enctype='multipart/form-data'>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
 </tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td></td></tr>
<tr>
<td>
<?php $newdisplay ->dispLinks(''); ?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr>
	<td>
  <table width=100% border=0 > -->
   <tr><td><span class="heading"><b>RM Stock Report by PRN</b></td>

   <!--  <td align="right"><a href="stock_costReport.php?crn=<?php echo $cim_match ?>&fdate=<?php echo $fromdate1 ?>&tdate=<?php echo $todate1 ?>"><b><img src="images/arrow_left.png" alt="CRN Stock Report"></b></a></td>


<tr><td> -->
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr>
<td bgcolor="#F5F6F5" colspan="7"><span class="heading"><b><center>Search Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=3 colspan=4 align="center"><span class="tabletext">
<input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: return searchsort_stockgrn()">

<input type="hidden" name="company_oper">
<input type="hidden" name="wonum_oper">
</td>
</tr>

<tr>
<td  bgcolor="#FFFFFF"><span class="labeltext"><b>Recd Date:  From &nbsp&nbsp</b>
        <input type="text" name="sdate1" id="sdate1" size=10 value="<?php echo $fromdate1 ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate1")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="sdate2" id="sdate2" size=10 value="<?php echo $todate1 ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("sdate2")'>
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>PRN</b></td>
<td bgcolor="#FFFFFF">
       <select name="crn_oper" size="1" width="100">
<?php
      if ($oper4 == 'like')
      {
?>
	<option selected>like
	<option value>=
<?php
      }
      else
      {
?>
	<option selected>=
	<option value>like
<?php
      }
?>
</select>
        <input type="text" name="crn" id="crn" size=12 value="<?php echo $crn_match ?>"
         onkeypress="javascript: return checkenter(event)">
</td>
</tr>
<tr>
<td colspan=6 bgcolor="#FFFFFF"><span class="labeltext"><b>Raw Matl Type&nbsp&nbsp</b><span class="tabletext">
   <select name="wonum_oper" size="1" width="100">
<?php
      if ($oper2 == 'like')
      {
?>
	<option selected>like
	<option value>=
<?php
      }
      else
      {
?>
	<option selected>=
	<option value>like
<?php
      }
?>
</select>
<input type="text" name="swonum" id="swonum" size=20 value="<?php echo $wonum_match ?>" onKeyPress="javascript: return checkenter(event)">
</td>
</tr>

</table>

</td></tr>
    </tr>
   </table>
<tr>
 <td align="right"><a href="rmstockbycrn_export.php?crnnum=<?php echo $crn_match ?>&fdate=<?php echo $fromdate1 ?>
 &tdate=<?php echo $todate1 ?>&grnnum=<?php echo $grn_match ?>&raw_mat_spec=<?php echo $company_match ?>
 &raw_mat_type=<?php echo $wonum_match ?>"><b><img src="images/export.gif" alt="CRN Stock Report"></b></a></td>
 </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
        <tr>
        <thead>
            <!--<td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>GRN #</b></td>
            <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Received Date</b></td>
                        <td width="5%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>Unit<br>RM Price</b></td>
                                    <td width="7%" bgcolor="#EEEFEE" align="center"><span class="heading"><b>RM Spec</b></td>-->
            <th width="5%" class="head0" align="center"><span class="heading"><b>PRN</b></th>
            <th width="7%" class="head1" align="center"><span class="heading"><b>RM Type</b></th>
            <th width="5%" class="head0" align="center"><span class="heading"><b>QTM</b></th>
            <th width="5%" class="head1" align="center"><span class="heading"><b>Qty <br>Iss</b></th>
            <th width="5%" class="head0" align="center"><span class="heading"><b>Qty <br>Ret</b></th>
            <th width="5%" class="head1" align="center"><span class="heading"><b>Balance<br>(qtm+ret-woqty)</b></th>
            <th width="5%" class="head0" align="center"><span class="heading"><b>Balance<br>Cost</b></th>
            <th width="5%" class="head1" align="center"><span class="heading"><b>Conversion Cost<br>(In Rs.)</b></th>
        </tr>

<?php
   $conversionrate=0;

   $convert_array=array(55,54,54,53,56,56,55,56,56,56,56,55);

   $total_issued_cost = 0;
   $total_balance_cost = 0;
   $total_balance_cost_rupee = 0;
   $total_balance_cost_dollar = 0;
   $total_balance_cost_null = 0;
   $total_conversion=0;
   $crn_issued_cost = 0;
   $crn_balance = 0;
   $crn_balance_cost = 0;
   $crn_balance_cost_rupee = 0;
   $crn_balance_cost_dollar = 0;       
   $crn_conversion=0;
   $qtm = 0;
   $qtyiss = 0;
   $qtyret = 0;
   $ft = 0;
   $prevcrn = '';
   $result = $newreport->get_rmstockbycrn($cond,$offset,$rowsPerPage);
   $rm_type='';
   
   while ($myrow = mysql_fetch_row($result)) 
   {
      $rm_type=$myrow[2];
	  if ($ft == 0)
	  {
		  $prevcrn = $myrow[5];
	  }
	  
      if ($myrow[5] != $prevcrn && $ft == 1)
      {
		
         if ($crn_balance > 0) 
	     {
              printf('<tr>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%d</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%d</td>
                     <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%d</td>',
                      $prevcrn,
                      $myrow[2],
                      $qtm,
		              $qtyiss,
		              $qtyret);
             printf('<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%d</td>',$crn_balance);
             //printf('<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s %.2f</td>',$currency,$rmprice);
             printf('<td bgcolor="#FFFFFF" align="right"><span class="tabletext">%s %s</td>',$currency, number_format(($crn_balance_cost_dollar),2,'.',','));
             printf('<td bgcolor="#FFFFFF" align="right"><span class="tabletext">%s</td>',number_format(($crn_conversion),2,'.',','));
	      }
		  $prevcrn = $myrow[5];
          $crn_balance_cost = 0;
          $crn_balance_cost_rupee = 0;
          $crn_balance_cost_dollar = 0;       
          $crn_balance = 0;
		  $crn_conversion=0;
		  $qtm = 0;
          $qtyiss = 0;
          $qtyret = 0;
      }
	        if($myrow[1] != '0000-00-00' && $myrow[1] != '' && $myrow[1] != 'NULL')
		    {
                $datearr = split('-', $myrow[1]);
                $d=$datearr[2];
                $m=$datearr[1];
                $y=$datearr[0];
                $x=mktime(0,0,0,$m,$d,$y);
                $recddate=date("M j, Y",$x);
            }
            else
            {
               $recddate = '';
            }
            
            $datecheck=split('-',$myrow[1]);
            $d=$datecheck[2];
            $m=$datecheck[1];
            $y=$datecheck[0];
            //echo "HERE1----$m---$y---<br>";
            if(($m>='04' && $y=='2012')||(($m>='01'&&$m<='03') && $y=='2013'))
            {
               $ind=$m;
               //echo "HERE----$ind---$y---<br>";
               $conversionrate=$convert_array[$ind-1];
               //echo "HERE44---$conversionrate----$m---$y---<br>";

            }
			else if(($m>='04' && $y=='2011')||(($m>='01' && $m<='03') && $y=='2012'))
            {
               $conversionrate=48.3;
               //echo "HERE48---$conversionrate----$m---$y---<br>";
            }
			else if(($m>='04' && $y=='2010')||(($m>='01' && $m<='03') && $y=='2011'))
           {
               $conversionrate=46.25;
           }
           else if(($m>='04' && $y=='2009')||(($m>='01' && $m<='03') && $y=='2010'))
           {
             $conversionrate=48.38;
           }
		   else
           {
            $conversionrate=45;
           }
        
            $balance = 0;

            $woqtyres = $newreport->get_woqty_new($myrow[0],$condw);
            $woqtyrow = mysql_fetch_row($woqtyres);
            $woqty = $woqtyrow[1];
            $woretqtyres = $newreport->get_woretqty_new($myrow[0],$condw);
            $woretqtyrow = mysql_fetch_row($woretqtyres);
            $woretqty = $woretqtyrow[1];

            $balance = 0;
            $qtm += $myrow[4];
			$qtyiss += $myrow[7];
			$qtyret += $woretqty;
            $balance = $myrow[4] - $woqty + $woretqty ;
			$crn_balance += $balance;
            $currency = array("$");
            $rm_price = str_replace($currency, "", $myrow[9]);
            if($myrow[11]!=0 && $myrow[11] !="")
            {
              $rmprice = ($rm_price/$myrow[11]);
            } 
			else
            {
             $rmprice = ($rm_price);
            }

            //echo $rm_price."---***----".$myrow[11]."<br>";
            $currency = $myrow[10];
			//echo "<br>currency is $currency";
            if($currency == '$' || $currency == '')
            {
              $total_balance_cost_dollar += ($balance*$rmprice);
			  $crn_balance_cost_dollar += ($balance*$rmprice);
			  //echo "<br>crn balance cost is $crn_balance_cost_dollar";
             $total_conversion+=($balance*$rmprice*$conversionrate);
             $crn_conversion+=($balance*$rmprice*$conversionrate);

            }
            else if($currency == 'Rs')
            {
              $total_balance_cost_rupee += ($balance*$rmprice);
			  $crn_balance_cost_rupee += ($balance*$rmprice);
            }
   
	   $ft = 1;
   }
         if ($crn_balance > 0) 
	     {
              printf('<tr>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%d</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%d</td>
                    <td bgcolor="#FFFFFF" align="center"><span class="tabletext">%d</td>',
                      $prevcrn,
                      $rm_type,
                      $qtm,
		              $qtyiss,
		              $qtyret);
             printf('<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%d</td>',$crn_balance);
             //printf('<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%s %.2f</td>',$currency,$rmprice);
             printf('<td bgcolor="#FFFFFF" align="right"><span class="tabletext">%s %s</td>',$currency, number_format(($crn_balance_cost_dollar),2,'.',','));
             printf('<td bgcolor="#FFFFFF" align="right"><span class="tabletext">%s</td>',number_format(($crn_conversion),2,'.',','));
	      }

?>
</td></tr>
<tr>
<td bgcolor="#FFFFFF" colspan=7 align="right"><span class="heading"><b>Total(Rs)</b></td>
<?php

printf('<td bgcolor="#FFFFFF" colspan=1 align="right"><span class="tabletext">%s %s</td>','Rs',number_format(($total_balance_cost_rupee),2,'.',','));
?>
<tr>
<td bgcolor="#FFFFFF" colspan=7 align="right"><span class="heading"><b>Total($)</b></td>
<?php
printf('<td bgcolor="#FFFFFF" colspan=1 align="right"><span class="tabletext">%s %s</td>','$',number_format(($total_balance_cost_dollar),2,'.',','));
?>
<tr>
<td bgcolor="#FFFFFF" colspan=7 align="right"><span class="heading"><b>Total(Null)</b></td>
<?php
printf('<td bgcolor="#FFFFFF" colspan=1 align="right"><span class="tabletext">%s %s</td>','',number_format(($total_balance_cost_null),2,'.',','));
?>
</td></tr>
<tr>
<td bgcolor="#FFFFFF" colspan=7 align="right"><span class="heading"><b>Total(Conversion)</b></td>
<?php
printf('<td bgcolor="#FFFFFF" colspan=1 align="right"><span class="tabletext">%s %s</td>','Rs.',number_format(($total_conversion),2,'.',','));
?>
</td></tr>
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


<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
	<td align=left>
  <?php
//  Added on Dec 6,04 for paging

$numrows = $newreport->getstockgrn_count($cond,$offset,$rowsPerPage);
//$numrows = 3000;
// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage);

if (!isset($_REQUEST['page']))
{
    $totpages = $maxPage;
}

$self = $_SERVER['PHP_SELF'];


?>
</td>
</tr></table>
</form>
</body>
</html>
