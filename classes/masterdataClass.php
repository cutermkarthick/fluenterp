<?
//====================================
// Author: FSI
// Date-written = April 04, 2007
// Filename: masterdataClass.php
// Maintains the class for CRN
// Revision: v1.0  OWT
//====================================

$pagename = $_SESSION['pagename'];

include_once('classes/loginClass.php');


class masterdata {
    var
        $partname,
        $wonum,
        $customer,
        $partnum,
        $RM_by_CIM,
        $project,
        $attachments,
        $RM_by_customer,
        $CIM_refnum,
        $drg_issue,
        $rm_type,
        $rm_spec,
        $rm_dim1,
        $rm_dim2,
        $rm_dim3,
        $mps_rev,
        $mps_num,
        $drawing_num,
        $cos,
        $mps_revision,
        $control,
        $remarks,
        $link2master_data,
        $condition,
        $maxruling,
        $grainflow,
        $machine_name,
        $rev_status,
        $master_rev_status,
        $secondary_part,
        $type,
        $rev_date,
        $crnremarks,
        $crnstatus,
        $create_date,
        $eng_app,
        $eng_app_by,
        $eng_app_date;
    

    // Constructor definition
    function masterdata() {
        $this->partname = '';
        $this->wonum = '';
        $this->customer = '';
        $this->partnum = '';
        $this->RM_by_CIM = '';
        $this->project = '';
        $this->attachments = '';
        $this->RM_by_customer = '';
        $this->CIM_refnum = '';
        $this->drg_issue = '';
        $this->rm_type = '';
        $this->rm_spec = '';
        $this->rm_dim1 = '';
        $this->rm_dim2 = '';
        $this->rm_dim3 = '';
        $this->mps_rev = '';
        $this->mps_num = '';
        $this->drawing_num = '';
        $this->cos = '';
        $this->line_num = '';
        $this->mps_revision = '';
        $this->control = '';
        $this->remarks = '';
        $this->link2master_data = '';
        $this->condition = '';
        $this->maxruling = '';
        $this->grainflow = '';
        $this->machine_name = '';
        $this->rev_status = '';
        $this->master_rev_status = '';
        $this->secondary_part = '';
        $this->type = '';
        $this->rev_date = '';
        $this->crnremarks = '';
        $this->crnstatus = '';
        $this->create_date = '';
        $this->eng_app = '';
        $this->eng_app_by = '';
        $this->eng_app_date='';
     }

    function getpartname() {
           return $this->partname;
    }
    function setpartname ($partname) {
           $this->partname = $partname;
    }

    function getwonum() {
           return $this->wonum;
    }
    function setwonum($wonum) {
           $this->wonum = $wonum;
    }

    function getcustomer() {
           return $this->customer;
    }
    function setcustomer($customer) {
           $this->customer = $customer;
    }

    function getpartnum() {
           return $this->partnum;
    }
    function setpartnum($partnum) {
           $this->partnum = $partnum;
    }

    function getRM_by_CIM() {
           return $this->RM_by_CIM;
    }
    function setRM_by_CIM($RM_by_CIM) {
           $this->RM_by_CIM = $RM_by_CIM;
    }

    function getproject() {
           return $this->project;
    }
    function setproject($project) {
           $this->project = $project;
    }

    function getattachments() {
           return $this->attachments;
    }
    function setattachments($attachments) {
           $this->attachments = $attachments;
    }

    function getRM_by_customer() {
           return $this->RM_by_customer;
    }
    function setRM_by_customer($RM_by_customer) {
           $this->RM_by_customer = $RM_by_customer;
    }

    function getCIM_refnum() {
           return $this->CIM_refnum;
    }
    function setCIM_refnum($CIM_refnum) {
           $this->CIM_refnum= $CIM_refnum;
    }

    function getdrg_issue() {
           return $this->drg_issue;
    }
    function setdrg_issue($drg_issue) {
           $this->drg_issue= $drg_issue;
    }

    function getrm_type() {
           return $this->rm_type;
    }
    function setrm_type($rm_type) {
           $this->rm_type= $rm_type;
    }

    function getrm_spec() {
           return $this->rm_spec;
    }
    function setrm_spec($rm_spec) {
           $this->rm_spec = $rm_spec;
    }

    function getrm_dim1() {
           return $this->rm_dim1;
    }
    function setrm_dim1($rm_dim1) {
           $this->rm_dim1 = $rm_dim1;
    }

    function getrm_dim2() {
           return $this->rm_dim2;
    }
    function setrm_dim2($rm_dim2) {
           $this->rm_dim2 = $rm_dim2;
    }

    function getrm_dim3() {
           return $this->rm_dim3;
    }
    function setrm_dim3($rm_dim3) {
           $this->rm_dim3 = $rm_dim3;
    }
    
    function getmps_rev() {
           return $this->mps_rev;
    }
    function setmps_rev($mps_rev) {
           $this->mps_rev = $mps_rev;
    }
    
    function getmps_num() {
           return $this->mps_num;
    }
    function setmps_num($mps_num) {
           $this->mps_num = $mps_num;
    }
    
    function getdrawing_num() {
           return $this->drawing_num;
    }
    function setdrawing_num($drawing_num) {
           $this->drawing_num = $drawing_num;
    }
    function getcos() {
           return $this->cos;
    }
    function setcos($cos) {
           $this->cos = $cos;
    }
    function setlinenum($linenum) {
           $this->line_num = $linenum;
    }
    function setmps_revition($mpsrev) {
           $this->mps_revision = $mpsrev;
    }
    function setcontrol($control) {
           $this->control = $control;
    }
    function setremarks($rem) {
           $this->remarks = $rem;
    }
    
    function getcondition() {
           return $this->condition;
    }
    function setcondition($cond) {
           $this->condition = $cond;
    }
    function settreat($treat) {
           $this->treat = $treat;
    }

    function getmaxruling() {
           return $this->maxruling;
    }
    function setmaxruling($maxrul) {
           $this->maxruling = $maxrul;
    }
    function getgrainflow() {
           return $this->grainflow;
    }
    function setgrainflow($grainflow)
    {
           $this->grainflow = $grainflow;
    }
    function getmachine_name() {
           return $this->machine_name;
    }
    function setmachine_name($machine_name)
    {
           $this->machine_name = $machine_name;
    }

    function setrev_status($rev_status)
    {
           $this->rev_status = $rev_status;
    }
    
     function getmaster_rev_status() {
           return $this->master_rev_status;
    }
    function setmaster_rev_status($master_rev_status)
    {
           $this->master_rev_status = $master_rev_status;
    }
    function getSecPart() {
           return $this->secondary_part;
    }
    function setSecPart($secPart)
    {
           $this->secondary_part = $secPart;
    }
    function gettype() {
           return $this->type;
    }
    function settype($ty)
    {
           $this->type = $ty;
    }
    function getrev_date() {
           return $this->rev_date;
    }
    function setrev_date($rev_date)
    {
           $this->rev_date = $rev_date;
    }
    
     function getcrnremarks() {
           return $this->crnremarks;
    }
    function setcrnremarks($crnremarks)
    {
           $this->crnremarks = $crnremarks;
    }
     function getcrnstatus() {
           return $this->crnstatus;
    }
    function setcrnstatus($crnstatus)
    {
           $this->crnstatus = $crnstatus;
    }
    
     function getcreate_date() {
           return $this->create_date;
    }
    function setcreate_date($create_date)
    {
           $this->create_date = $create_date;
    }

     function geteng_app() {
           return $this->eng_app;
    }
    function seteng_app($eng_app)
    {
           $this->eng_app = $eng_app;
    }
     function geteng_app_by() {
           return $this->eng_app_by;
    }
    function seteng_app_by($eng_app_by)
    {
           $this->eng_app_by = $eng_app_by;
    }
    
     function geteng_app_date() {
           return $this->eng_app_date;
    }
    function seteng_app_date($eng_app_date)
    {
           $this->eng_app_date = $eng_app_date;
    }

   function addmaster_data() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'master_data' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        
        $partname  = "'" . $this->partname . "'";
       // $wonum = "'" . $this->wonum . "'";
        $customer = "'" . $this->customer . "'";
        $partnum = "'" . $this->partnum . "'";
        $RM_by_CIM = "'" . $this->RM_by_CIM . "'";
        $project = "'" . $this->project . "'";
        $attachments = "'" . $this->attachments . "'";
        $RM_by_customer = "'" . $this->RM_by_customer . "'";
        $CIM_refnum = "'" . $this->CIM_refnum . "'";
        $drg_issue = "'" . $this->drg_issue . "'";
        $rm_type = "'" . $this->rm_type . "'";
        $rm_spec = "'" . $this->rm_spec . "'";
        $mps_rev = "'" . $this->mps_rev . "'";
        $mps_num = "'" . $this->mps_num . "'";
        $drawing_num = "'" . $this->drawing_num . "'";
        $rm_dim1 = "'" .$this->rm_dim1. "'";
        $rm_dim2 = "'" .$this->rm_dim2. "'";
        $rm_dim3 = "'" .$this->rm_dim3. "'";
        $cos = "'" .$this->cos. "'";
        $maxrul = "'" .$this->maxruling. "'";
        $grainflow = "'" .$this->grainflow. "'";
        $condition = "'" .$this->condition. "'";
        $treat = "'" .$this->treat. "'";
        $machine_name = "'" .$this->machine_name. "'";
        $master_rev_status = "'" .$this->master_rev_status. "'";
        $sec_part = "'" .$this->secondary_part. "'";
        $type = "'" .$this->type. "'";
        $crnremarks =  "'" .$this->crnremarks. "'";
        $eng_app = "'" .$this->eng_app. "'";
        $eng_app_by =  "'" .$this->eng_app_by. "'";
        $eng_app_date = $this->eng_app_date ? "'" . $this->eng_app_date  . "'" : '0000-00-00';
        
       /* if($this->rm_dim1 != '')
        {
          $rm_dim1 = $this->rm_dim1;
        }
        else
        {
          $rm_dim1 = 'NULL';
        }
        if($this->rm_dim2 != '')
        {
          $rm_dim2 = $this->rm_dim2;
        }
        else
        {
          $rm_dim2 = 'NULL';
        }
        if($this->rm_dim3 != '')
        {
          $rm_dim3 = $this->rm_dim3;
        }
        else
        {
          $rm_dim3 = 'NULL';
        }   */
         $siteid=  "'" .$_SESSION['siteid']. "'";
        $sql = "select * from master_data where CIM_refnum = $CIM_refnum and status !='Inactive'";
           $result = mysql_query($sql);
           if (!(mysql_fetch_row($result)))
           {
            $sql = "INSERT INTO
                        master_data
                            (
                            recnum,partname,customer,partnum,RM_by_CIM,project,attachments,RM_by_customer,
                            CIM_refnum,drg_issue,rm_type,rm_spec,rm_dim1,rm_dim2,rm_dim3,mps_rev,mps_num,drawing_num,cos,
                            maxruling,grainflow,`condition`,machine_name,revstat,secondary_partname,type,modified_date,status,
                            treat,create_date,remarks,eng_app,eng_app_by,eng_app_date,siteid
                            )
                    VALUES
                            (
                            $objid,$partname,$customer,$partnum,$RM_by_CIM,$project,$attachments,$RM_by_customer,
                            $CIM_refnum,$drg_issue,$rm_type,$rm_spec,$rm_dim1,$rm_dim2,$rm_dim3,$mps_rev,$mps_num,
                            $drawing_num,$cos,$maxrul,$grainflow,$condition,$machine_name,$master_rev_status,$sec_part,
                            $type,'0000-00-00','Active',$treat,curdate(),$crnremarks,$eng_app,$eng_app_by,$eng_app_date,$siteid
                            )";
              $result = mysql_query($sql);
           // echo $sql;
           // Test to make sure query worked
              if(!$result) die("Insert to master_data didn't work..Please report to Sysadmin. " . mysql_error());
            }
            else
            {
               echo "<table border=1><tr><td><font color=#FF0000>";
               die("CIM Ref Num " . $CIM_refnum . " already exists. ");
               echo "</td></tr></table>";
            }
            $sql = "update seqnum set nxtnum = $objid where tablename = 'master_data'";
            $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work for master_data..Please report to Sysadmin. " . mysql_error());

        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) die("Commit failed for master_data Insert..Please report to Sysadmin. " . mysql_error());
        return $objid;
     }
     
     function addmps($masterrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select nxtnum from seqnum where tablename = 'mps' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $linenum1 = "'" . $this->line_num . "'";
        $mps_revision1 = "'" . $this->mps_revision . "'";
        $control1 = "'" . $this->control . "'";
        $remarks1 = "'" . $this->remarks . "'";
        $rev_status1 = "'" . $this->rev_status . "'";
        $link2master =  $masterrecnum ;
        $rev_date1  ="'". $this->rev_date . "'";

         $sql = "INSERT INTO
                        mps
                           (recnum,
                            linenum,
                            mps_revision,
                            control,
                            remarks,
                            link2master_data,
                            revstat,
                            rev_date
                           )
                     VALUES
                           ($objid,
                            $linenum1,
                            $mps_revision1,
                            $control1,
                            $remarks1,
                            $link2master,
                            $rev_status1,
                            $rev_date1
                            )";
        //echo $sql;
          $result = mysql_query($sql);
	//  echo "=======" . mysql_error();
          if(!$result)
         {
	       $sql = "rollback";
	       $result = mysql_query($sql);
	       die("Insert to mps for $linenum1 failed ..Please report to Sysadmin. " . mysql_error());
         }
        $sql = "update seqnum set nxtnum = $objid where tablename = 'mps'";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum update for mps failed..Please report to Sysadmin. " . mysql_error());
     }



     function getmasterdatas($cond,$argsort1,$argoffset,$arglimit) {
     
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder=$argsort1;
        $siteid = $_SESSION['siteid'];
        $siteval = "m.siteid = '".$siteid."'";

        if($sortorder=='')
          $sortorder="CIM_refnum desc";
          
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,CIM_refnum,partname,
		                         wonum,customer,
		                        rm_type,partnum,
								secondary_partname,
								status,
                                type,
								treat
                       FROM master_data m
                       where $wcond  and $siteval
					   ORDER by m.$sortorder
                        limit $offset, $limit";
                 
        $result = mysql_query($sql);
        // echo "$sql";
        return $result;
     }
     
     
     function getcrncount($cond,$argoffset, $arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $siteid = $_SESSION['siteid'];
        $siteval = "m.siteid = '".$siteid."'";

             $sql = "select count(*) as numrows from master_data m
                      where $wcond and $siteval limit $offset, $limit";
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $result  = mysql_query($sql) or die('Po count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows;

}


     function getmasterdata($masterdatarecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

       $sql = "select recnum,partname,wonum,customer,partnum,RM_by_CIM,project,attachments,RM_by_customer,
                            CIM_refnum,drg_issue,rm_type,rm_spec,rm_dim1,rm_dim2,rm_dim3,mps_rev,mps_num,drawing_num,cos,
                            maxruling,grainflow,`condition`,machine_name,revstat,secondary_partname,type,status,remarks,treat,create_date,eng_app,
                            eng_app_by,eng_app_date
            FROM master_data
            where  master_data.recnum = $masterdatarecnum";
// echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
     
    function getmasterdata4wo($masterdatarecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

       $sql = " select recnum,partname,wonum,customer,partnum,RM_by_CIM,project,attachments,RM_by_customer,
               CIM_refnum,drg_issue,rm_type,rm_spec,rm_dim1,rm_dim2,rm_dim3,mps_rev,mps_num,drawing_num,cos,grainflow,maxruling,type
            FROM master_data
            where  master_data.recnum = $masterdatarecnum";
// echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
     
     function getMasterDetails4po($crn) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

       $sql = " select recnum,rm_type,rm_spec,grainflow,maxruling,`condition`,rm_dim1,rm_dim2,rm_dim3
            FROM master_data
            where CIM_refnum = '$crn'";
//echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
     
   /* function getAllCIMs()
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select m.recnum,m.partname,m.wonum,m.customer,m.partnum,
                      m.RM_by_CIM,m.project,m.attachments,
                      m.RM_by_customer,m.CIM_refnum as cim,m.drg_issue,
                      m.rm_type,m.rm_spec,m.rm_dim1,m.rm_dim2,
                      m.rm_dim3,NULL,m.mps_num,
                      m.drawing_num,m.cos,m.machine_name,
                      NULL,NULL,m.mps_rev as masterrev,m.treat as treatment
                 from master_data m
                 where m.revstat = 'Active'  and m.status = 'Active'
                 UNION
              select m.recnum,m.partname,m.wonum,m.customer,m.partnum,
                      m.RM_by_CIM,m.project,m.attachments,
                      m.RM_by_customer,m.CIM_refnum as cim,m.drg_issue,
                      m.rm_type,m.rm_spec,m.rm_dim1,m.rm_dim2,
                      m.rm_dim3,mp.mps_revision as rev,m.mps_num,
                      m.drawing_num,m.cos,mp.control,
                      mp.remarks,mp.recnum as mpslink,NULL ,m.treat as treatment
                 from master_data m,mps mp
                 where m.recnum = mp.link2master_data
                 and mp.revstat = 'Active' and m.status = 'Active'
                order by cim ";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    } */
    
function getAllCIMs()
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $siteid = $_SESSION['siteid'];
       $siteval = "m.siteid = '".$siteid."'";
       $sql = "select m.recnum,m.partname,m.wonum,m.customer,m.partnum,
                      m.RM_by_CIM,m.project,m.attachments,
                      m.RM_by_customer,m.CIM_refnum as cim,m.drg_issue,
                      m.rm_type,m.rm_spec,m.rm_dim1,m.rm_dim2,
                      m.rm_dim3,mp.mps_revision as rev,m.mps_num,
                      m.drawing_num,m.cos,mp.control,
                      mp.remarks,mp.recnum as mpslink,NULL ,m.treat as treatment
                 from master_data m,mps mp
                 where m.recnum = mp.link2master_data
                 and mp.revstat = 'Active' and m.status = 'Active' and
				       m.eng_app = 'yes' and
					   m.treat != 'Assembly' and $siteval
                order by cim ";
       // echo $sql;exit;
       $result = mysql_query($sql);
       return $result;
    }

	function getmasterdata_mps($masterrecnum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select recnum,linenum,mps_revision,control,remarks,revstat,rev_date,link2master_data
                     from mps
                     where link2master_data=$masterrecnum";
     // echo $sql;
       $result = mysql_query($sql);
       return $result;

    }

  function updatemaster_data($masterdatarecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        
        $partname  = "'" . $this->partname . "'";
       // $wonum = "'" . $this->wonum . "'";
        $customer = "'" . $this->customer . "'";
        $partnum = "'" . $this->partnum . "'";
        $RM_by_CIM = "'" . $this->RM_by_CIM . "'";
        $project = "'" . $this->project . "'";
        $attachments = "'" . $this->attachments . "'";
        $RM_by_customer = "'" . $this->RM_by_customer . "'";
        $CIM_refnum = "'" . $this->CIM_refnum . "'";
        $drg_issue = "'" . $this->drg_issue . "'";
        $rm_type = "'" . $this->rm_type . "'";
        $rm_spec = "'" . $this->rm_spec . "'";
        $mps_rev = "'" . $this->mps_rev . "'";
        $mps_num = "'" . $this->mps_num . "'";
        $drawing_num = "'" . $this->drawing_num . "'";
        $rm_dim1 = "'" . $this->rm_dim1 . "'";
        $rm_dim2 = "'" . $this->rm_dim2 . "'";
        $rm_dim3 = "'" . $this->rm_dim3 . "'";
        $cos = "'" . $this->cos . "'";
        $maxrul = "'" .$this->maxruling. "'";
        $grainflow = "'" .$this->grainflow. "'";
        $condition = "'" .$this->condition. "'";
        $treat = "'" .$this->treat. "'";
        $machine_name = "'" .$this->machine_name. "'";
        $master_rev_status = "'" .$this->master_rev_status. "'";
        $secondaryPart =  "'" .$this->secondary_part. "'";
        $type =  "'" .$this->type. "'";
        $crnremarks =  "'" .$this->crnremarks. "'";
        $crnstatus =  "'" .$this->crnstatus. "'";
        $create_date = $this->create_date ? "'" . $this->create_date  . "'" : '0000-00-00';
        $eng_app = "'" .$this->eng_app. "'";
        $eng_app_by =  "'" .$this->eng_app_by. "'";
        $eng_app_date = $this->eng_app_date ? "'" . $this->eng_app_date  . "'" : '0000-00-00';

        $sql = "UPDATE master_data SET
                       partname = $partname,
                       customer = $customer,
                       partnum = $partnum,
                       RM_by_CIM = $RM_by_CIM,
                       project = $project,
                       attachments = $attachments,
                       RM_by_customer = $RM_by_customer,
                       CIM_refnum = $CIM_refnum,
                       drg_issue = $drg_issue,
                       rm_type = $rm_type,
                       rm_spec = $rm_spec,
                       rm_dim1 = $rm_dim1,
                       rm_dim2 = $rm_dim2,
                       rm_dim3 = $rm_dim3,
                       mps_rev = $mps_rev,
                       mps_num = $mps_num,
                       drawing_num = $drawing_num,
                       cos = $cos,
                       maxruling = $maxrul,
                       grainflow = $grainflow,
                       `condition` = $condition,
                       machine_name = $machine_name,
                       revstat = $master_rev_status,
                       secondary_partname = $secondaryPart,
                       type = $type,
                       status=$crnstatus,
                       remarks=$crnremarks,
		               treat=$treat,
                       modified_date=now(),
                       create_date=$create_date,
                       eng_app =$eng_app,
                       eng_app_by =$eng_app_by,
                       eng_app_date=$eng_app_date
        	    WHERE
                       recnum = $masterdatarecnum";
//echo $sql;
        $result = mysql_query($sql);

        $sql ='commit';
        $result = mysql_query($sql);
        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv5");
                     die("masterdata update failed...Please report to SysAdmin. " . mysql_error());
                     }
        }
        
        function updatemps($recnum) {
        $lirecnum = $recnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $linenum1 = "'" . $this->line_num . "'";
        $mps_revision1 = "'" . $this->mps_revision . "'";
        $control1 = "'" . $this->control . "'";
        $remarks1 = "'" . $this->remarks . "'";
        $rev_status1 = "'" . $this->rev_status . "'";
	$rev_date1 = "'" . $this->rev_date . "'";
//echo $rev_date1;
	


        $sql = "update mps
                          set linenum = $linenum1,
                              mps_revision = $mps_revision1,
                              control = $control1,
                              remarks = $remarks1,
                              revstat = $rev_status1,
				rev_date=$rev_date1
                        where recnum = $lirecnum";
        //echo $sql;
 
        $result = mysql_query($sql);
	$err = mysql_error();
        // Test to make sure query worked
         if(!$result)
         {
	       $sql = "rollback";
	       $result = mysql_query($sql);
	       die("Update to mps for $linenum1 failed ..Please report to Sysadmin. " . $err);
         }

     }


    function deletereview($reviewrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from contract_review where recnum = $reviewrecnum";
        $result = mysql_query($sql);
        if(!$result)
                     {
                      //header("Location:errorMessage.php?validate=Inv6");
                      die("Delete for review failed...Please report to SysAdmin. " . mysql_error());
                     }
      }
      
      function deletemps($recnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from mps where recnum = $recnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for mps failed...Please report to SysAdmin. " . mysql_error());
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
 
  function getrmmasterdata_md($crn_num) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

       $sql = "select r.recnum,
       		r.rmcode,
       		r.partnum,
       		r.rm_type,
       		r.rm_spec,
       		r.length,
       		r.width,
       		r.thickness,
       		r.rm_dia,
       		r.rm_ruling_dim,
       		r.crnnum,
       		r.rm_condition,
       		r.rm_uom,
       		r.rm_grainflow,
       		r.rm_lt,
       		r.rm_st,
       		r.rm_qty_perbill,
       		r.rm_mrs,
       		r.rm_unitprize,
       		r.rm_supplier,
       		r.rm_altrm,
       		r.link2vendor,
       		r.rm_status,
       		c.name,
       		r.rm_remarks,
            r.enggapproved,
       		r.directorsapproved,
       		r.directorsapprovedby ,
       		r.engapprovedby,
       		r.rm_remarks,
       		r.createdate
            FROM rmmaster r, company c
            where  r.crnnum = '$crn_num' and c.recnum=r.link2vendor and rm_status='Active'
            order by r.recnum";
       // echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
      function getNotes_md($recnum)
     {
     	 $newlogin = new userlogin;
         $newlogin->dbconnect();
     	 $sql = "select create_date,notes from rmm_notes where notes2rmm='$recnum'";
     	// echo $sql;
     	  $result =mysql_query($sql);
     	  return $result;
     }
     
     function getgrndet4wo($grn_num)
     {
     	 $newlogin = new userlogin;
         $newlogin->dbconnect();
     	 $sql = "select gli.dim1,gli.dim2,gli.dim3,g.grnnum from grn_li gli,grn g where g.grnnum='$grn_num' and gli.link2grn=g.recnum";
     	 //echo $sql;
     	  $result =mysql_query($sql);
     	  return $result;
     }
     
     function updatemaster_data4eng($masterdatarecnum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        
        $eng_app = "'" .$this->eng_app. "'";
        $eng_app_by =  "'" .$this->eng_app_by. "'";
        $eng_app_date = $this->eng_app_date ? "'" . $this->eng_app_date  . "'" : '0000-00-00';
        
        $sql = "UPDATE master_data SET
                       modified_date=now(),
                       eng_app =$eng_app,
                       eng_app_by =$eng_app_by,
                       eng_app_date=$eng_app_date
        	    WHERE
                       recnum = $masterdatarecnum";
//echo $sql;
        $result = mysql_query($sql);
        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv5");
                     die("updatemaster_data4eng failed...Please report to SysAdmin. " . mysql_error());
                     }
     
     }
     
      function getmasterdetails4wo($mstrecnum)
     {

             $sql = "select count(*) as numrows from work_order w,master_data m
                      where w.crn_num=m.CIM_refnum and m.recnum=$mstrecnum";

                      // echo $sql;exit;
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $result  = mysql_query($sql) or die('Po count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows ;
     }
     
      function getmasterdetails4assywo($mstrecnum)
     {

             $sql = "select count(*) as numrows from assy_wo w,master_data m
                      where w.crn=m.CIM_refnum and m.recnum=$mstrecnum";
                      // echo $sql;exit; 
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $result  = mysql_query($sql) or die('Po count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows ;
     }
} // End invoice class definition

