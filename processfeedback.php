<?php
//==============================================
// Author: FSI                                 =
// Date-written =Mar 22, 2007                  =
// Filename: processfeedback.php               =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Processes feedback                          =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$userrecnum = $_SESSION['userrecnum'];
$pagename= $_SESSION['pagename'];
if (isset($_REQUEST['feedbackrecnum']))
{
	$feedbackrecnum =$_REQUEST['feedbackrecnum'];
}


// First include the class definition
include('classes/feedbackClass.php');
// Get all fields related to work order general info

// Next, create an instance of the class
$newfeedback = new feedback;

$crn = $_REQUEST['crn'];
$refno = $_REQUEST['refno'];
$partnumber = $_REQUEST['partnumber'];
$requestedby = $_REQUEST['requestedby'];
$partname = $_REQUEST['partname'];
$docdate = $_REQUEST['docdate'];
$program = $_REQUEST['program'];
$process = $_REQUEST['process'];
$fixture = $_REQUEST['fixture'];
$tools = $_REQUEST['tools'];
$description = $_REQUEST['description'];

// Database Connect
$newlogin = new userlogin;
$newlogin->dbconnect();
// Set the fields
$newfeedback->setcrn($crn);
$newfeedback->setrefno($refno);
$newfeedback->setpartnumber($partnumber);
$newfeedback->setrequestedby($requestedby);
$newfeedback->setpartname($partname);
$newfeedback->setdocdate($docdate);
$newfeedback->setprogram($program);
$newfeedback->setprocess($process);
$newfeedback->setfixture($fixture);
$newfeedback->settools($tools);
$newfeedback->setdescription($description);


if ($pagename == 'newfeedback') {
//echo    $sql;
   $sql = "start transaction";
   $result = mysql_query($sql);
   $newfeedback->addFeedback();
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for New Feedback..Please report to Sysadmin. " . mysql_error());
}

if ($pagename == 'editfeedback') {
   $feedbackrecnum =$_REQUEST['feedbackrecnum'];
   $sql = "start transaction";
   $result = mysql_query($sql);
   $newfeedback->updateFeedback($feedbackrecnum);
   $sql = "commit";
   $result = mysql_query($sql);
   if(!$result) die("Commit failed for Feedback update..Please report to Sysadmin. " . mysql_error());
}

if ($_SESSION['pagename'] == 'editfeedback') {
$feedbackrecnum =$_REQUEST['feedbackrecnum'];
    $delete = $_REQUEST['deleteflag'];
}
if ($pagename == 'editfeedback' && $delete == 'y') {
  $newfeedback->deleteFeedback($feedbackrecnum);
}
header("Location:feedbacksummary.php");
?>