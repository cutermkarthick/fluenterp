<?php 
  
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'attendancesummary';
$page="ELM: Attendance";


$month_names = array('01' => 'Jan',
                      '02' => 'Feb',
                      '03' => 'Mar',
                      '04' => 'Apr',
                      '05' => 'May',
                      '06' => 'June',
                      '07' => 'July',
                      '08' => 'Aug',
                      '09' => 'Sep',
                      '10' => 'Oct',
                      '11' => 'Nov',
                      '12' => 'Dec');


$rowsPerPage = 100;

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

include_once('classes/empClass.php');
$newEmp = new emp;

if(isset($_REQUEST['name']))
{
   $name = $_REQUEST['name'];
   $cond1 = "pms.name like'" . $name . "%'";
}
else
{
   $name = "";
   $cond1 = "pms.name like'%'";
}

$today = date("Y-m-d");

if(isset($_REQUEST['pl_month'])){

$frm = $_REQUEST['pl_month'];
}else{
// $frm = "";
$date_split = explode('-', $today);
$frm = $date_split[1];
}

if(isset($_REQUEST['pl_year'])){
$to = $_REQUEST['pl_year'];
}else{
// $to = "";
$date_split = explode('-', $today);
$to = $date_split[0];
}

$cond = $cond1;

?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title>Attendance</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0">
<form action='payrollmonthly_Summary.php' method='post' enctype='multipart/form-data'>
<?php

 include('header.html');

?>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
  <td><span class="labeltext"><p align="left">Name</p></span></td>
<td><span class="tabletext"><input type="text" name="name" id='name' size=10 value=""></span></td>

<td  bgcolor="#FFFFFF" width='40%'><span class="labeltext"><b>Month &nbsp&nbsp</b></span>
    <select name="pl_month" id="pl_month"> 
      <option value="select" disabled="disabled" >Select</option>
      <?php 
      for ($m=1; $m < 13 ; $m++) 
      { 
      if ($m < 10) 
      {
        $m = "0".$m;
      }
      ?>
        <option <?php echo (($frm==$m)?"selected":"")?> value="<?php echo $m; ?>"><?php echo $month_names[$m]; ?></option>  
      <?php
      }
      ?>
      
  </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    


<span class="heading"><b>Year</b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<select name="pl_year" id="pl_year" >
  <option value="select" disabled="disabled" >Select</option>
  <?php 
  for ($y=2010; $y < 2021 ; $y++) 
  {?>
    <option <?php echo (($to==$y)?"selected":"")?> value="<?php echo $y; ?>"><?php echo $y; ?></option>  
  <?php
  }
  ?>
  </select>
&nbsp;&nbsp;&nbsp;&nbsp;
</td>
<td bgcolor="#FFFFFF"><span class="labeltext">
<input type="submit" name="Submit"  value="Get" onclick="javascript: return searchsort_fields()">
<!-- <button class="stdbtn btn_blue" style="background-color:#2d3e50" onClick="javascript: return searchsort_fields()"  name = "Submit" value = 'Get'>Get</button> -->
</td>
<table width=100% border=0>
  <div class="contenttitle radiusbottom0">
    <h2><span>List Of Attendance Monthly
  
      <!-- <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='newpayroll_monthly.php'" value="New Payroll Monthly " >  --> 
  </div>
</span>
</h2>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable" >
  <thead>
        <tr>
            <th  class="head0"><b>Eid</b></th>
            <th  class="head1"><b>Fname</b></th>
            <th  class="head0"><b>Lname</b></th>
            <th  class="head1"><b>Company</b></th>
            <th  class="head0"><b>Shift</b></th>
            <th  class="head1"><b>Shift Start Time</b></th>
            <th  class="head0"><b>Shift End Time</b></th>
            
        </tr>
    </thead>

    <tbody>
      <?php 
       $previd = '';

       $result = $newEmp->getAllEmps4Ams();  

        while ($myrow = mysql_fetch_assoc($result)) 
        {
          if ($myrow['start_hour'] < 10) {
            $start_hour = "0".$myrow['start_hour'];
          }
          else{
            $start_hour = $myrow['start_hour'];
          }
          if ($myrow['start_min'] < 10) {
            $start_min = "0".$myrow['start_min'];
          }else{
            $start_min = $myrow['start_min'];
          }
          if ($myrow['end_hour'] < 10) {
            $end_hour = "0".$myrow['end_hour'];
          }else{
            $end_hour = $myrow['end_hour'];
          }
          if ($myrow['end_min'] < 10) {
            $end_min = "0".$myrow['end_min'];
          }else{
            $end_min = $myrow['end_min'];
          }

          $start_time = $start_hour.":".$start_min;
          $end_time = $end_hour.":".$end_min;
        ?>

          <tr>
          <td align="center"><span class="tabletext"><a href="attendancemonthly_Details.php?empid=<?php echo $myrow['empid'];?>&month=<?php echo $frm?>&year=<?php echo $to;?>"><?php echo $myrow['empid'];  ?></a></span></td>
          <td align="center"><span class="tabletext"><?php echo $myrow['fname'];  ?></span></td>
          <td align="center"><span class="tabletext"><?php echo $myrow['lname'];  ?></span></td>
          <td align="center"><span class="tabletext"><?php echo $myrow['name'];  ?></span></td>
          <td align="center"><span class="tabletext"><?php echo $myrow['shift_group'];  ?></span></td>
          <td align="center"><span class="tabletext"><?php echo $start_time;  ?></span></td>
          <td align="center"><span class="tabletext"><?php echo $end_time;  ?></span></td>
          
          </tr>

        <?php

        }


      ?>
    </tbody>

</span>