<?
//============================================
// Author: FSI
// Date-written = March 20, 2007
// Filename: enquiryClass.php
// Maintains the class for Contract Enquiry
// Revision: v1.0  OMS
//============================================

include_once('classes/loginClass.php');

class enquiry {
    var
    $recnum,
    $refno,
    $date,
    $name,
    $project,
    $enqmode,
    $enqrefnum,
    $enqisfor,
    $diffspecify,
    $numofparts,
    $attachment1,
    $attachment2,
    $rawmaterial,
    $source,
    $parts_class,
    $resources,
    $qualityreq,
    $saliant,
    $aditional_resources,
    $investment,
    $subcontract,
    $special_process,
    $delivery_req,
    $person,
    $enq_answeredby,
    $quotation,
    $data_for_quote,
    $data_store,
    $path,
    $quote_path,
    $enquiry_path,
    $quotation_det_store,
    $data_for_enquiry,
    $risk_factors,
    $requirements,
    $quote_date,
    $quote_sentby,
    $due_date;

    // Constructor definition
    function enquiry() {
        $this->recnum = '';
        $this->refno = '';
        $this->enqdate = '';
        $this->name = '';
        $this->project = '';
        $this->enqmode = '';
        $this->enqrefnum = '';
        $this->enqisfor = '';
        $this->diffspecify = '';
        $this->numofparts = '';
        $this->attachment1 = '';
        $this->attachment2 = '';
        $this->rawmaterial = '';
        $this->source = '';
        $this->parts_class= '';
        $this->resources= '';
        $this->qualityreq = '';
        $this->saliant = '';
        $this->aditional_resources = '';
        $this->investment = '';
        $this->subcontract = '';
        $this->special_process = '';
        $this->delivery_req = '';
        $this->person = '';
        $this->enq_answeredby = '';
        $this->quotation = '';
        $this->data_for_quote = '';
        $this->data_store = '';
        $this->path = '';
        $this->quotation_det_store= '';
        $this->risk_factors= '';
        $this->requirements= '';
        $this->explain_risk_factors = '';
        $this->quote_sentby = '';
        $this->due_date = '';
        $this->quote_date = '';
        $this->data_for_enquiry;
        $this->quote_path = '';
        $this->enquiry_path = '';
    }


    function getrecnum() {
           return $this->recnum;
    }
    function setrecnum ($e_recnum) {
           $this->recnum = $e_recnum;
    }

    function getrefno() {
           return $this->refno;
    }
    function setrefno($e_refno) {
           $this->refno = $e_refno;
    }

    function getenqdate() {
           return $this->enqdate;
    }
    function setenqdate ($e_enqdate) {
           $this->enqdate = $e_enqdate;
    }

    function getname() {
           return $this->name;
    }
    function setname($e_name) {
           $this->name = $e_name;
    }

    function getproject() {
           return $this->project;
    }
    function setproject($e_project) {
           $this->project = $e_project;
    }

    function getenqmode() {
           return $this->enqmode;
    }
    function setenqmode($e_enqmode) {
           $this->enqmode = $e_enqmode;
    }

    function getenqrefnum() {
           return $this->enqrefnum;
    }
    function setenqrefnum($e_enqrefnum) {
           $this->enqrefnum = $e_enqrefnum;
    }

    function getenqisfor() {
           return $this->enqisfor;
    }
    function setenqisfor($e_enqisfor) {
           $this->enqisfor = $e_enqisfor;
    }

    function getdiffspecify() {
           return $this->diffspecify;
    }
    function setdiffspecify($e_diffspecify) {
           $this->diffspecify= $e_diffspecify;
    }

    function getnumofparts() {
           return $this->numofparts;
    }
    function setnumofparts($e_numofparts) {
           $this->numofparts= $e_numofparts;
    }

    function getattachment1() {
           return $this->attachment1;
    }
    function setattachment1($e_attachment1) {
           $this->attachment1= $e_attachment1;
    }

    function getattachment2() {
           return $this->attachment2;
    }
    function setattachment2($e_attachment2) {
           $this->attachment2 = $e_attachment2;
    }

    function getrawmaterial() {
           return $this->rawmaterial;
    }
    function setrawmaterial($e_rawmaterial) {
           $this->rawmaterial = $e_rawmaterial;
    }

    function getsource() {
           return $this->source;
    }
    function setsource($e_source) {
           $this->source = $e_source;
    }

    function getparts_class() {
           return $this->parts_class;
    }
    function setparts_class($e_parts_class) {
           $this->parts_class = $e_parts_class;
    }

    function getresources() {
           return $this->resources;
    }
    function setresources ($e_resources) {
           $this->resources = $e_resources;
    }

    function getqualityreq() {
           return $this->qualityreq;
    }
    function setqualityreq($e_qualityreq) {
           $this->qualityreq = $e_qualityreq;
    }

    function getsaliant() {
           return $this->saliant;
    }
    function setsaliant($e_saliant) {
           $this->saliant = $e_saliant;
    }

    function getaditional_resources() {
           return $this->aditional_resources;
    }
    function setaditional_resources($e_aditional_resources) {
           $this->aditional_resources = $e_aditional_resources;
    }

    function getinvestment() {
           return $this->investment;
    }
    function setinvestment($e_investment) {
           $this->investment = $e_investment;
    }

    function getsubcontract() {
           return $this->subcontract;
    }
    function setsubcontract($e_subcontract) {
           $this->subcontract = $e_subcontract;
    }

    function getspecial_process() {
           return $this->special_process;
    }
    function setspecial_process($e_special_process) {
           $this->special_process = $e_special_process;
    }

    function getdelivery_req() {
           return $this->delivery_req;
    }
    function setdelivery_req($e_delivery_req) {
           $this->delivery_req = $e_delivery_req;
    }

    function getperson() {
           return $this->person;
    }
    function setperson($e_person) {
           $this->person= $e_person;
    }

    function getenq_answeredby() {
           return $this->enq_answeredby;
    }
    function setenq_answeredby($e_enq_answeredby) {
           $this->enq_answeredby= $e_enq_answeredby;
    }

    function getquotation() {
           return $this->quotation;
    }
    function setquotation($e_quotation) {
           $this->quotation= $e_quotation;
    }

    function getdata_for_quote() {
           return $this->data_for_quote;
    }
    function setdata_for_quote($e_data_for_quote) {
           $this->data_for_quote = $e_data_for_quote;
    }

    function getdata_store() {
           return $this->data_store;
    }
    function setdata_store($e_data_store) {
           $this->data_store = $e_data_store;
    }

    function getpath() {
           return $this->path;
    }
    function setpath($e_path) {
           $this->path = $e_path;
    }

    function getquotation_det_store() {
           return $this->quotation_det_store;
    }
    function setquotation_det_store($e_quotation_det_store) {
           $this->quotation_det_store = $e_quotation_det_store;
    }
    
    
    function getrisk_factors() {
           return $this->risk_factors;
    }
    function setrisk_factors($e_risk_factors) {
           $this->risk_factors = $e_risk_factors;
    }

    function getrequirements() {
           return $this->requirements;
    }
    function setrequirements($e_requirements) {
           $this->requirements = $e_requirements;
    }

    function getexplainrisk_factors() {
           return $this->explainrisk_factors;
    }
    function setexplainrisk_factors($e_explain_risk_factors) {
           $this->explain_risk_factors = $e_explain_risk_factors;
    }

    function getquote_sentby() {
           return $this->quote_sentby;
    }
    function setquote_sentby($e_quote_sentby) {
           $this->quote_sentby = $e_quote_sentby;
    }

    function getdue_date() {
           return $this->due_date;
    }
    function setdue_date($e_due_date) {
           $this->due_date = $e_due_date;
    }

    function getquote_date() {
           return $this->quote_date;
    }
    function setquote_date($e_quote_date) {
           $this->quote_date = $e_quote_date;
    }

    function getquote_path() {
           return $this->quote_path;
    }
    function setquote_path($e_quote_path) {
           $this->quote_path = $e_quote_path;
    }
    function getenquiry_path() {
           return $this->enquiry_path;
    }
    function setenquiry_path($e_enquiry_path) {
           $this->enquiry_path = $e_enquiry_path;
    }
    function getdata_for_enquiry() {
           return $this->data_for_enquiry;
    }
    function setdata_for_enquiry($e_data_for_enquiry) {
           $this->data_for_enquiry = $e_data_for_enquiry;
    }


    function addenquiry() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'contract_enquiry' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        
        $refno = "'" . $this->refno . "'";
        $enqdate = "'" . ($this->enqdate ? $this->enqdate : '0000-00-00') . "'";
        $name = "'" . $this->name . "'";
        $project= "'" . $this->project . "'";
        $enqmode = "'" . $this->enqmode. "'";
        $enqrefnum = "'" . $this->enqrefnum . "'";
        $enqisfor = "'" . $this->enqisfor . "'";
        $diffspecify = "'" . $this->diffspecify . "'";
        $numofparts = "'" . $this->numofparts . "'";
        $attachment1 = "'" . $this->attachment1 . "'";
        $attachment2 = "'" . $this->attachment2 . "'";
        $rawmaterial = "'" . $this->rawmaterial . "'";
        $source="'" . $this->source . "'";
        $parts_class = "'" . $this->parts_class . "'";
        $resources = "'" . $this->resources . "'";
        $qualityreq = "'" . $this->qualityreq . "'";
        $saliant = "'" . $this->saliant . "'";
        $aditional_resources = "'" . $this->aditional_resources . "'";
        $investment = "'" . $this->investment . "'";
        $subcontract = "'" . $this->subcontract . "'";
        $special_process= "'" . $this->special_process . "'";
        $delivery_req = "'" . $this->delivery_req. "'";
        $person = "'" . $this->person . "'";
        $enq_answeredby = "'" . $this->enq_answeredby . "'";
        $quotation = "'" . $this->quotation . "'";
        $data_for_quote = "'" . $this->data_for_quote . "'";
        $data_store = "'" . $this->data_store . "'";
        $path = "'" . $this->path . "'";
        $quotation_det_store = "'" . $this->quotation_det_store . "'";
        $risk_factors = "'" . $this->risk_factors . "'";
        $requirements="'" . $this->requirements . "'";
        $quote_sentby = "'" . $this->quote_sentby . "'";
        $explain_risk_factors ="'" . $this->explain_risk_factors . "'";
        $due_date = ($this->due_date ? $this->due_date : '0000-00-00');
        $quote_date = ($this->quote_date ? $this->quote_date : '0000-00-00');
        $quote_path = "'" . $this->quote_path . "'";
        $data_for_enquiry = "'" . $this->data_for_enquiry . "'";
        $enquiry_path = "'" . $this->enquiry_path . "'";

        $sql = "select * from contract_enquiry where recnum = $objid";
           $result = mysql_query($sql);
           if (!(mysql_fetch_row($result)))
           {
             $sql = "INSERT INTO
                        contract_enquiry
                            (
                            recnum,refno,enqdate,name,project,enqmode,enqrefnum,enqisfor,
                            diffspecify,numofparts,attachment1,attachment2,
                            rawmaterial,source,class,resources,qualityreq,saliant,
                            aditional_resources,investment,subcontract,
                            special_process,delivery_req,person,enq_answeredby,quotation,
                            data_for_quote,data_store,path,
                            quotation_det_store,risk_factors,requirements, quote_sentby,
                            explain_risk_factors, due_date, quote_date,
                            quote_path, enquiry_path,data_for_enquiry, formrev
                            )
                    VALUES
                            (
                            $objid,$objid,$enqdate,$name,$project,$enqmode,$enqrefnum,$enqisfor,
                            $diffspecify,$numofparts,$attachment1,$attachment2,
                            $rawmaterial,$source,$parts_class,$resources,$qualityreq,$saliant,
                            $aditional_resources,$investment,$subcontract,
                            $special_process,$delivery_req,$person,$enq_answeredby,$quotation,
                            $data_for_quote,$data_store,$path,
                            $quotation_det_store,$risk_factors,$requirements,$quote_sentby,
                            $explain_risk_factors, $due_date, $quote_date,
                            $quote_path, $enquiry_path, $data_for_enquiry, 'F3002 Rev No.:1'
                            )";

           //echo $sql;
            $result = mysql_query($sql);

           // Test to make sure query worked
              if(!$result) die("Insert to enquiry didn't work..Please report to Sysadmin. " . mysql_error());
            }
            else
            {
                echo "<table border=1><tr><td><font color=#FF0000>";
               die("Enquiry ID " . $objid . " already exists. ");
               echo "</td></tr></table>";
            }
            $sql = "update seqnum set nxtnum = $objid where tablename = 'contract_enquiry'";
            $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work for BOM..Please report to Sysadmin. " . mysql_error());

        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) die("Commit failed for BOM Insert..Please report to Sysadmin. " . mysql_error());
        return $objid;
     }
        


     function getenquirys() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,refno,name,project,enqmode,enqrefnum,enqisfor,attachment1,attachment2
                  FROM contract_enquiry";
        $result = mysql_query($sql);
//echo "$sql";
        return $result;

     }


     function getenquiry($enquiryrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

       $sql = " select recnum,refno,enqdate,name,project,enqmode,enqrefnum,
                       enqisfor,diffspecify,numofparts,attachment1,attachment2,
                            rawmaterial,source,class,resources,qualityreq,saliant,
                            aditional_resources,investment,subcontract,
                            special_process,delivery_req,person,enq_answeredby,quotation,
                            data_for_quote,data_store,path,quotation_det_store,risk_factors,
                            requirements, quote_sentby, explain_risk_factors, 
                            due_date, quote_date, quote_path, enquiry_path,data_for_enquiry,formrev
            FROM contract_enquiry
            where  contract_enquiry.recnum = $enquiryrecnum";
// echo $sql;
        $result = mysql_query($sql);

        return $result;
     }

     function updateenquiry($enquiryrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        
        $refno = "'" . $this->refno . "'";
        $enqdate = "'" . $this->enqdate . "'";
        $name = "'" . $this->name . "'";
        $project= "'" . $this->project . "'";
        $enqmode = "'" . $this->enqmode. "'";
        $enqrefnum = "'" . $this->enqrefnum . "'";
        $enqisfor = "'" . $this->enqisfor . "'";
        $diffspecify = "'" . $this->diffspecify . "'";
        $numofparts = "'" . $this->numofparts . "'";
        $attachment1 = "'" . $this->attachment1 . "'";
        $attachment2 = "'" . $this->attachment2 . "'";
        $rawmaterial = "'" . $this->rawmaterial . "'";
        $source="'" . $this->source . "'";
        $parts_class = "'" . $this->parts_class . "'";
        $resources = "'" . $this->resources . "'";
        $qualityreq = "'" . $this->qualityreq . "'";
        $saliant = "'" . $this->saliant . "'";
        $aditional_resources = "'" . $this->aditional_resources . "'";
        $investment = "'" . $this->investment . "'";
        $subcontract = "'" . $this->subcontract . "'";
        $special_process= "'" . $this->special_process . "'";
        $delivery_req = "'" . $this->delivery_req. "'";
        $person = "'" . $this->person . "'";
        $enq_answeredby = "'" . $this->enq_answeredby . "'";
        $quotation = "'" . $this->quotation . "'";
        $data_for_quote = "'" . $this->data_for_quote . "'";
        $data_store = "'" . $this->data_store . "'";
        $path = "'" . $this->path . "'";
        $quotation_det_store = "'" . $this->quotation_det_store . "'";
        $risk_factors = "'" . $this->risk_factors . "'";
        $requirements="'" . $this->requirements . "'";
        $quote_sentby = "'" . $this->quote_sentby . "'";
        $explain_risk_factors ="'" . $this->explain_risk_factors . "'";
        $due_date = "'" . ($this->due_date ? $this->due_date : '0000-00-00') . "'";
        $quote_date = "'" . ($this->quote_date ? $this->quote_date : '0000-00-00') . "'";
        $quote_path = "'" . $this->quote_path . "'";
        $data_for_enquiry = "'" . $this->data_for_enquiry . "'";
        $enquiry_path = "'" . $this->enquiry_path . "'";

       $sql = "UPDATE contract_enquiry SET
                    refno = $refno,
                    enqdate = $enqdate,
                    name = $name,
            	    project = $project,
            	    enqmode =$enqmode ,
            	    enqrefnum =$enqrefnum,
            	    enqisfor=$enqisfor,
                    diffspecify = $diffspecify ,
                    numofparts = $numofparts,
                    attachment1 = $attachment1,
                    attachment2= $attachment2,
                    rawmaterial=$rawmaterial,
                    source=$source,
                    class=$parts_class,
                    resources=$resources,
                    qualityreq = $qualityreq,
                    saliant = $saliant,
                    aditional_resources = $aditional_resources,
            	    investment = $investment,
            	    subcontract =$subcontract ,
            	    special_process =$special_process,
            	    delivery_req=$delivery_req,
                    person = $person ,
                    enq_answeredby = $enq_answeredby,
                    quotation = $quotation,
                    data_for_quote= $data_for_quote ,
                    data_store=$data_store,
                    path=$path,
                    quotation_det_store=$quotation_det_store,
                    risk_factors=$risk_factors,
                    requirements=$requirements,
                    quote_date=$quote_date,
                    explain_risk_factors=$explain_risk_factors,
                    due_date=$due_date,
                    quote_path=$quote_path,
                    enquiry_path=$enquiry_path,
                    quote_sentby=$quote_sentby,
                    data_for_enquiry = $data_for_enquiry
        	WHERE
                    recnum = $enquiryrecnum";
 //echo $sql;
        $result = mysql_query($sql);

        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv5");
                     die("enquiry update failed...Please report to SysAdmin. " . mysql_error());
                     }
        }


    function deleteenquiry($enquiryrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from contract_enquiry where recnum = $enquiryrecnum";
        $result = mysql_query($sql);
        if(!$result)
                     {
                      //header("Location:errorMessage.php?validate=Inv6");
                      die("Delete for enquiry failed...Please report to SysAdmin. " . mysql_error());
                     }
      }

 function ftp_copy($source_file,$destination_file)
     {
	$ftp_server='ftp.fluentsoft.com';
	$ftp_user='bmandyam@fluentsoft.com';
	$ftp_password='dci1034';
	$conn_id=ftp_connect($ftp_server);
	$login_result=ftp_login($conn_id,$ftp_user,$ftp_password);
	if (( !$conn_id ) || ( !$login_result ))
	{
		die("FTP connection Failed");
	}
	$upload=ftp_put($conn_id,$destination_file,$source_file,FTP_BINARY);
	ftp_close($conn_id);
	if(!$upload)
	{
		die("FTP copy has failed");
	}
   }
} // End invoice class definition

