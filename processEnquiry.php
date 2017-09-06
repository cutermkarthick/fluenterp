<?php
//==============================================
// Author: FSI                                 =
// Date-written = Mar 20, 2007                 =
// Filename: processEnquiry.php                =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Process of Contract Enquiry                 =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: ../login.php" );

}
$userid = $_SESSION['user'];

$pagename = $_SESSION['pagename'];

include('classes/enquiryClass.php');

// Next, create an instance of the classes required
$newenquiry = new enquiry;

if ($pagename == 'editenquiry')
 {
    $delete = $_REQUEST['deleteflag'];
    if ($delete == 'y')
      {
       $enquiryrecnum = $_REQUEST['enquiryrecnum'];
       $newenquiry->deleteenquiry($enquiryrecnum);
       header("Location:enquirySummary.php");
      }
 }

// Get all fields related to invoice
if ($pagename == 'newenquiry') {
   
    $refno = $_REQUEST["refno"];
    $enqdate = $_REQUEST["enqdate"];
    $name = $_REQUEST["name"];
    $project = $_REQUEST["project"];
    $enqmode = $_REQUEST["enqmode"];
    $enqrefnum = $_REQUEST["enqrefnum"];
    $enqisfor = $_REQUEST["enqisfor"];
//    $diffspecify = $_REQUEST["diffspecify"];
    $numofparts = $_REQUEST["numofparts"];
    $attachment1 = $_REQUEST["attachment1"];
//    $attachment2 = $_REQUEST["attachment2"];
    $rawmaterial = $_REQUEST["rawmaterial"];
    $source = $_REQUEST["source"];
    $parts_class = $_REQUEST["parts_class"];
    $resources = $_REQUEST["resources"];
    $qualityreq = $_REQUEST["qualityreq"];
    $saliant = $_REQUEST["saliant"];
    $aditional_resources = $_REQUEST["aditional_resources"];
//    $investment = $_REQUEST["investment"];
    $subcontract = $_REQUEST["subcontract"];
    $special_process = $_REQUEST["special_process"];
    $delivery_req = $_REQUEST["delivery_req"];
    $person = $_REQUEST["person"];
    $enq_answeredby = $_REQUEST["enq_answeredby"];
    $quotation = $_REQUEST["quotation"];
    $data_for_quote = $_REQUEST["data_for_quote"];
    $data_store = $_REQUEST["data_store"];
    $path = $_REQUEST["path"];
    $quotation_det_store = $_REQUEST["quotation_det_store"];
    $risk_factors = $_REQUEST["risk_factors"];
    $requirements = $_REQUEST["requirements"];
    $due_date = $_REQUEST["due_date"];
    $explain_risk_factors = $_REQUEST["explain_risk_factors"];
    $quote_sentby = $_REQUEST["quote_sentby"];
    $quote_path = $_REQUEST["quote_path"];
    $enquiry_path = $_REQUEST["enquiry_path"];
    $data_for_enquiry = $_REQUEST["data_for_enquiry"];
    $quotedate = $_REQUEST["quotedate"];
   

	$newenquiry->setrefno($refno);
	$newenquiry->setenqdate($enqdate);
	$newenquiry->setname($name);
   	$newenquiry->setproject($project);
	$newenquiry->setenqmode($enqmode);
	$newenquiry->setenqrefnum($enqrefnum);
	$newenquiry->setenqisfor($enqisfor);
//        $newenquiry->setdiffspecify($diffspecify);
        $newenquiry->setnumofparts($numofparts);
        $newenquiry->setattachment1($attachment1);
//        $newenquiry->setattachment2($attachment2);
        $newenquiry->setrawmaterial($rawmaterial);
        $newenquiry->setsource($source);
        $newenquiry->setparts_class($parts_class);
        $newenquiry->setresources($resources);
	$newenquiry->setqualityreq($qualityreq);
	$newenquiry->setsaliant($saliant);
   	$newenquiry->setaditional_resources($aditional_resources);
//	$newenquiry->setinvestment($investment);
	$newenquiry->setsubcontract($subcontract);
	$newenquiry->setspecial_process($special_process);
        $newenquiry->setdelivery_req($delivery_req);
        $newenquiry->setperson($person);
        $newenquiry->setenq_answeredby($enq_answeredby);
        $newenquiry->setquotation($quotation);
        $newenquiry->setdata_for_quote($data_for_quote);
        $newenquiry->setdata_store($data_store);
        $newenquiry->setpath($path);
        $newenquiry->setquotation_det_store($quotation_det_store);
        $newenquiry->setrisk_factors($risk_factors);
        $newenquiry->setrequirements($requirements);
        $newenquiry->setexplainrisk_factors($explain_risk_factors);
        $newenquiry->setquote_sentby($quote_sentby);
        $newenquiry->setdue_date($due_date);
        $newenquiry->setquote_date($quote_date);
        $newenquiry->setquote_path($quote_path);
        $newenquiry->setenquiry_path($enquiry_path);
        $newenquiry->setdata_for_enquiry($data_for_enquiry);

	$enquiryrecnum = $newenquiry->addenquiry();
}


if ($pagename == 'editenquiry')
 {
//echo "i am inside editenquiry";

    $enquiryrecnum = $_REQUEST["enquiryrecnum"];
    $refno = $_REQUEST["refno"];
    $enqdate = $_REQUEST["enqdate"];
    $name = $_REQUEST["name"];
    $project = $_REQUEST["project"];
    $enqmode = $_REQUEST["enqmode"];
    $enqrefnum = $_REQUEST["enqrefnum"];
    $enqisfor = $_REQUEST["enqisfor"];
//    $diffspecify = $_REQUEST["diffspecify"];
    $numofparts = $_REQUEST["numofparts"];
    $attachment1 = $_REQUEST["attachment1"];
//    $attachment2 = $_REQUEST["attachment2"];
    $rawmaterial = $_REQUEST["rawmaterial"];
    $source = $_REQUEST["source"];
    $parts_class = $_REQUEST["parts_class"];
    $resources = $_REQUEST["resources"];
    $qualityreq = $_REQUEST["qualityreq"];
    $saliant = $_REQUEST["saliant"];
    $aditional_resources = $_REQUEST["aditional_resources"];
//    $investment = $_REQUEST["investment"];
    $subcontract = $_REQUEST["subcontract"];
    $special_process = $_REQUEST["special_process"];
    $delivery_req = $_REQUEST["delivery_req"];
    $person = $_REQUEST["person"];
    $enq_answeredby = $_REQUEST["enq_answeredby"];
    $quotation = $_REQUEST["quotation"];
    $data_for_quote = $_REQUEST["data_for_quote"];
    $data_store = $_REQUEST["data_store"];
    $path = $_REQUEST["path"];
    $quotation_det_store = $_REQUEST["quotation_det_store"];
    $risk_factors = $_REQUEST["risk_factors"];
    $requirements = $_REQUEST["requirements"];
    $due_date = $_REQUEST["due_date"];
    $explain_risk_factors = $_REQUEST["explain_risk_factors"];
    $quote_sentby = $_REQUEST["quote_sentby"];
    $quote_path = $_REQUEST["quote_path"];
    $enquiry_path = $_REQUEST["enquiry_path"];
    $data_for_enquiry = $_REQUEST["data_for_enquiry"];
    $quote_date = $_REQUEST["quotedate"];

   	$newlogin = new userlogin;
	$newlogin->dbconnect();
	$newenquiry->setrefno($refno);
	$newenquiry->setenqdate($enqdate);
   	$newenquiry->setname($name);
	$newenquiry->setproject($project);
	$newenquiry->setenqmode($enqmode);
	$newenquiry->setenqrefnum($enqrefnum);
	$newenquiry->setenqisfor($enqisfor);
//        $newenquiry->setdiffspecify($diffspecify);
        $newenquiry->setnumofparts($numofparts);
        $newenquiry->setattachment1($attachment1);
//        $newenquiry->setattachment2($attachment2);
        $newenquiry->setrawmaterial($rawmaterial);
        $newenquiry->setsource($source);
        $newenquiry->setparts_class($parts_class);
        $newenquiry->setresources($resources);
	$newenquiry->setqualityreq($qualityreq);
	$newenquiry->setsaliant($saliant);
   	$newenquiry->setaditional_resources($aditional_resources);
//	$newenquiry->setinvestment($investment);
	$newenquiry->setsubcontract($subcontract);
	$newenquiry->setspecial_process($special_process);
        $newenquiry->setdelivery_req($delivery_req);
        $newenquiry->setperson($person);
        $newenquiry->setenq_answeredby($enq_answeredby);
        $newenquiry->setquotation($quotation);
        $newenquiry->setdata_for_quote($data_for_quote);
        $newenquiry->setdata_store($data_store);
        $newenquiry->setpath($path);
        $newenquiry->setquotation_det_store($quotation_det_store);
        $newenquiry->setrisk_factors($risk_factors);
        $newenquiry->setexplainrisk_factors($explain_risk_factors);
        $newenquiry->setquote_sentby($quote_sentby);
        $newenquiry->setdue_date($due_date);
        $newenquiry->setrequirements($requirements);
        $newenquiry->setquote_path($quote_path);
        $newenquiry->setenquiry_path($enquiry_path);
        $newenquiry->setquote_date($quote_date);
        $newenquiry->setdata_for_enquiry($data_for_enquiry);

        $newenquiry->updateenquiry($enquiryrecnum);
}
        header("Location:enquiryDetails.php?enquiryrecnum=$enquiryrecnum" );

?>
