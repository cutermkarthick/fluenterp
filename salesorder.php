<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = July 10, 2006                =
// Filename: salesorder.php                    =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Displays list of Salesorder.                =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'salesorder';
$page = 'CRM: Sales Order';

//session_register('pagename');
 $userrole = $_SESSION['userrole'];
 $usertype = $_SESSION['usertype'];
 //echo   $userrole;
//Following code added to implement search,sort  and Pagination on Dec 29-04 by Jerry George

$cond = "name like '%'";
$sort1='name';
$select='name';
$worec='';
$where1='';
$oper='like';
if ( isset ( $_REQUEST['salesorder'] ))
{
     $salesorder_match = $_REQUEST['salesorder'];
   if ($salesorder_match!='')
{

     if ( isset ( $_REQUEST['salesorder_oper'] ) )
    {
      $oper = $_REQUEST['salesorder_oper'];
    }
    else
    {
       $oper = 'like';
    }
    if ($oper == 'like')
    {
      $salesorder = "'" . $_REQUEST['salesorder'] . "%" . "'";
     }
     else
     {
   $salesorder = "'" . $_REQUEST['salesorder'] . "'";
     }
     $where1 =$_REQUEST['salesorderfl'];
     $select=$_REQUEST['salesorderfl'];
     $cond = $where1 . " " . $oper . " " . $salesorder;
}
else
$cond="name like '%'";
}
 else
{
  $salesorder_match = '';
 }

if ( isset ( $_REQUEST['sortfld1'] ) )
{
   $sort1 = $_REQUEST['sortfld1'];
}

// how many rows to show per page
$rowsPerPage = 10;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if (isset($_REQUEST['page']))
{
    $pageNum = $_REQUEST['page'];
}
if (isset($_REQUEST['totpages']))
{
    $totpages = $_REQUEST['totpages'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;


// First include the class definition
include_once('classes/userClass.php');
include_once('classes/salesorderClass.php');
include_once('classes/displayClass.php');
include('classes/quoteClass.php');
include('classes/quoteliClass.php');
$newsalesorder = new salesorder;
$newdisplay = new display;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/salesorder.js"></script>
<html>
<head>
<title>Sales Order</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='salesorder.php?salesorder=$salesorder_match&salesorder_oper=$oper&sortfld1=$sort1&salesorderfl=$where1' method='post' enctype='multipart/form-data'>
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
  <tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
      <td bgcolor="#FFFFFF">
 -->   <table width=100% border=0 cellpadding=6 cellspacing=0  >
      <td><span class="heading"><i>Please click on Sales Order to Edit/Delete</i></td></tr>
      <tr> <td>
      <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
                    <tr>
                      <td bgcolor="#F5F6F5" colspan="3"><span class="heading"><b><center>Search Criteria</center></b></td>
                      <td bgcolor="#F5F6F5"  colspan="4"><span class="heading"><b><center>Sort Criteria</center></b></td>
                      <td bgcolor="#FFFFFF" rowspan=2 align="center">
                        <button class="stdbtn btn_blue" style="background-color:#2d3e50" onclick="javascript: return searchsort_fields()">Get</button>

                      </td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFFFFF"><span class="tabletext"><select name="salesorder" size="1" width="50">
                        <?php if($select=='id'){?>
                                    <option selected>id
                                    <option value>name<?php }else {?>
                                    <option selected>name
                                    <option value>id<?php }?>
                                    </select>
                              </td>
                              <td bgcolor="#FFFFFF"><span class="tabletext"><select name="salesorder_oper" size="1" width="50">
                                    <?php if($oper=='like'){?>
                                    <option selected>like
                        <option value>=<?php }else {?>
                                    <option selected>=
                        <option value>like<?php }?>
                              </td>
                      <td bgcolor="#FFFFFF"><input type="text" name="salesorder" size=20 value="<?php echo $salesorder_match ?>" onkeypress="javascript: return checkenter(event)"></td>
                      <td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort by</b></td>
                      <td bgcolor="#FFFFFF" colspan=3><span class="tabletext"><select name="sort1" size="1" width="100">
                                    <option selected>name
                                    </select>
                        <input type="hidden" name="sortfld1">
                        <input type="hidden" name="salesorderfl">
                        <input type="hidden" name="salesorder_oper">
                </td>
            </tr>
            </table>
            </td></tr>
            <tr><td>
<table width=100% border=0>
<div class="contenttitle radiusbottom0">
<h2><span>List of Sales Order
<? if($usertype != 'CUST')
{
?>
   <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px" onClick="location.href='new_so.php'" value="New Salesorder" >
<?
}
?>
</h2>
</span>
</td>
</tr>

</td></tr>
</table>
 <!-- <table width=100% border=0>
  <tr>
  <td><span class="pageheading"><b>List of Sales Order</b></td>
  <td colspan=180>&nbsp;</td>
  <td><a href ="new_so.php"><img name="Image8" border="0" src="images/nso.gif" ></a>
  </td>
  </tr>
</table>
 -->
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable" >
<thead>
<tr  bgcolor="#FFCC00">
<td align="center" class="head0" width=5%><span class="tabletext"><b>Sl.#</b></td>
<td align="center" class="head1" width=6%><span class="tabletext"><b>Sales Order #</b></td>
<td align="center" class="head0" width=6%><span class="tabletext"><b>Quote #</b></td>
<td align="center" class="head1" width=6%><span class="tabletext"><b>Resell #</b></td>
<td align="center" class="head0" width=20%><span class="tabletext"><b>Description</b></td>
<td align="center" class="head1" width=10%><span class="tabletext"><b>Customer Name</b></td>
<td align="center" class="head0" width=15%><span class="tabletext"><b>Sales Person</b></td>
<td align="center" class="head1" width=8%><span class="tabletext"><b>Order Date</b></td>
<td align="center" class="head0" width=8%><span class="tabletext"><b>Due Date</b></td>
<td align="center" class="head1" width=8%><span class="tabletext"><b>Total Amount</b></td>
</tr>
</thead>
<?php


        /* if( $userrole == 'SALES PERSON'){
            $result = $newsalesorder->getSalesorders1();
         }else{
              $result = $newsalesorder->getSalesorders();
         }  */
            $result = $newsalesorder->getSalesorders();
            //$result = $newsalesorder-> getso($cond,$sort1,$offset,$rowsPerPage);
           while ($myrow = mysql_fetch_row($result)) {
              $d=substr($myrow[6],8,2);
              $m=substr($myrow[6],5,2);
              $y=substr($myrow[6],0,4);
              $x=mktime(0,0,0,$m,$d,$y);
              $date=date("M j, Y",$x);

              $d=substr($myrow[7],8,2);
              $m=substr($myrow[7],5,2);
              $y=substr($myrow[7],0,4);
              $x=mktime(0,0,0,$m,$d,$y);
              $date1=date("M j, Y",$x);
                printf('<tr bgcolor="#FFFFFF">
                          <td align="center"><span class="tabletext"><a href="soDetails.php?salesorderrecnum=%s">%s</td>
                          <td align="center"><span class="tabletext">%s</td>
                          <td align="center"><span class="tabletext"><a href="quoteDetails.php?quoterecnum=%s">%s</td>
                          <td align="left"><span class="tabletext">%s</td>
                          <td align="left"><span class="tabletext">%s</td>
                          <td align="center"><span class="tabletext">%s</td>
                          <td align="center"><span class="tabletext">%s</td>
                          <td align="left"><span class="tabletext">%s</td>
                          <td align="left"><span class="tabletext">%s</td>
                          <td align="right"><span class="tabletext">%s%.2f</td>',

              $myrow[0],$myrow[0],
                          $myrow[5],
                          $myrow[26],$myrow[16],
                          $myrow[27],
                          $myrow[4],
                          $myrow[1],
                          $myrow[23].' '.$myrow[24],
                          $date,
                          $date1,
                          $myrow[25],$myrow[22]);
              printf('</td></tr>');
        }

?>

</table>
      </table>
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

//Additions on Dec 29 04 by Jerry George to implement pagination

//$numrows = $newsalesorder->getsoCount($cond,$offset,$rowsPerPage);
// how many pages we have when using paging?
$numrows=10;
$maxPage = ceil($numrows/$rowsPerPage);
//echo "$maxPage</br>";
if (!isset($_REQUEST['page']))
{
//   echo "page is set";
    $totpages = $maxPage;
}

//echo "total pages :$totpages</br>";
$self = $_SERVER['PHP_SELF'];

// creating 'previous' and 'next' link
// plus 'first page' and 'last page' link

// print 'previous' link only if we're not
// on page one
if ($pageNum > 1)
{
    $page = $pageNum - 1;
    $prev = " <a href=\"salesorder.php?page=$page&totpages=$totpages&salesorder=$salesorder_match&salesorderfl=$where1&salesorder_oper=$oper\">[Prev]</a> ";

    $first = " <a href=\"salesorder.php?page=1&totpages=$totpages&salesorder=$salesorder_match&salesorderfl=$where1&salesorder_oper=$oper\">[First Page]</a> ";
}
else
{
    $prev  = ' [Prev] ';       // we're on page one, don't enable 'previous' link
    $first = ' [First Page] '; // nor 'first page' link
}

// print 'next' link only if we're not
// on the last page
if ($pageNum < $totpages)
{
    $page = $pageNum + 1;
    $next = " <a href=\"salesorder.php?page=$page&totpages=$totpages&salesorder=$salesorder_match&salesorderfl=$where1&salesorder_oper=$oper\">[Next]</a> ";

    $last = " <a href=\"salesorder.php?page=$totpages&totpages=$totpages&salesorder=$salesorder_match&salesorderfl=$where1&salesorder_oper=$oper\">[Last Page]</a> ";
}
else
{
    $next = ' [Next] ';      // we're on the last page, don't enable 'next' link
    $last = ' [Last Page] '; // nor 'last page' link
}
if($totpages!=0)
{
//$pageNum=0;
// print the page navigation link
echo "<span class=\"labeltext\">" . $first . $prev . " Showing page <strong>$pageNum</strong> of <strong>$totpages</strong> pages " . $next . $last;
}
else
echo "<span class=\"labeltext\"><align=\"center\">No matching records found";
// End additions on Dec 29,04

?>
                </td>
              </tr>
            </table>
      </FORM>
</body>
</html>