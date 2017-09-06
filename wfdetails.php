<?php
//
//==============================================
// Author: FSI                                 =
// Date-written: June 20, 2004                 =
// Filename: workflow                          =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Workflow details                            =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
if ( !isset ( $_REQUEST['wftype'] ) )
{
     header ( "Location: login.php" );
}
$wftype = $_REQUEST['wftype'];

// Includes
include_once('classes/loginClass.php');
include('classes/displayClass.php');
include('classes/workflowClass.php');


$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'wfdetails';
$page ="Work Flow";
//////session_register('pagename');
$newlogin = new userlogin;
$newlogin->dbconnect();
$newdisplay = new display;
$newWF = new workflow;

?>
<script language="javascript" src="scripts/mouseover.js"></script>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title>List of Workflows</title>
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
<?php    $newdisplay->dispLinks('');
?>
</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >



			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/spacer.gif " width="6"></td>
				<td bgcolor="#FFFFFF"> -->

<table width=100% border=0 cellspacing="1" cellpadding="6">
    <tr>
        <td align="left"><span class="pageheading"><b>Workflow for <?php echo $wftype ?></b></td>
        <td width="70%">&nbsp;</td>
	<td><a href ="addwfstage.php"><img name="Image8" border="0" src="images/bu-newwf.gif"></a></td>
    </tr>

    </tr>
    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="stdtable">

      <tr>
	<td bgcolor="#EEEFEE"><span class="heading"><b>Stage</b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b>Type</b></td>
	<td bgcolor="#EEEFEE"><span class="heading"><b>Doc Type</b></td>
	<td bgcolor="#EEEFEE"><span class="heading"><b>Dept</b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b>Status</b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b>Est Time</b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b>Est Cost</b></td>
	<td bgcolor="#EEEFEE"><span class="heading"><b>Approval Type</b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b>Customer</b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b>Print</b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b>Report</b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b>Approval By</b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b>Email List</b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b>Customer Status</b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b>Dependency</b></td>
      </tr>
<?php
      $result = $newWF->getWFdetails($wftype);

      while ($myrow = mysql_fetch_row($result)) {
?>
      <tr>

        <td bgcolor="#FFFFFF"><span class="heading"><a href="editwf.php?wftype=<?php echo $wftype ?>&wfrecnum=<?php echo $myrow[4] ?>"><?php echo $myrow[1] ?></td>
 	<td bgcolor="#FFFFFF"><span class="heading"><?php echo $myrow[0] ?></td>
        <td bgcolor="#FFFFFF"><span class="heading"><?php echo $myrow[7] ?></td>
        <td bgcolor="#FFFFFF"><span class="heading"><?php echo $myrow[2] ?></td>
 	<td bgcolor="#FFFFFF"><span class="heading"><?php echo $myrow[3] ?></td>
        <td bgcolor="#FFFFFF"><span class="heading"><?php echo $myrow[13] ?></td>
        <td bgcolor="#FFFFFF"><span class="heading"><?php echo $myrow[15] ?></td>
        <td bgcolor="#FFFFFF"><span class="heading"><?php echo $myrow[5] ?></td>
        <td bgcolor="#FFFFFF"><span class="heading"><?php echo $myrow[9] ?></td>
        <td bgcolor="#FFFFFF"><span class="heading"><?php echo $myrow[10] ?></td>
        <td bgcolor="#FFFFFF"><span class="heading"><?php echo $myrow[11] ?></td>
 	<td bgcolor="#FFFFFF"><span class="heading"><?php echo $myrow[6] ?></td>
 	<td bgcolor="#FFFFFF"><span class="heading"><?php echo $myrow[8] ?></td>
 	<td bgcolor="#FFFFFF"><span class="heading"><?php echo $myrow[12] ?></td>
 	<td bgcolor="#FFFFFF"><span class="heading"><?php echo $myrow[16] ?></td>
 	
      </tr>
<?php
      }
?>
        </table>
</td>
		<!-- 		<td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>
 -->
		</table>

      </FORM>


</table>



</body>
</html>
