<?
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: dispatchliClass.php               =
// Maintains the class for Dispatch Line items =
// Revision: v1.0                              =
//==============================================

include_once('loginClass.php');

class dispatch_line_items {

    var
     $linenum,
     $wonum,
      $dnnum,
     $partnum,
     $grnnum,
     $custpo_qty,
     $wo_qty,
     $comp_qty,
     $custpo_num,

	 $disp_custpo_no,
	 $disp_custpo_item,

     $custpo_date,
     $delvby,
     $disp_qty,
     $partiss,
     $drgiss,
     $cos,
     $itemnum,
     $partname,
     $rmspec,
     $link2dispatch,
	 $supplier_wonum,
	 $batchnum,
	 $psn;

    // Constructor definition
    function dispatch_line_items() {
        $this->linenum = '';
        $this->wonum = '';
        $this->dnnum = '';
        $this->partnum = '';
        $this->wo_qty = '';
        $this->comp_qty = '';
        $this->grnnum = '';
        $this->custpo_qty= '';
        $this->custpo_num = '';
        $this->custpo_date = '';
        $this->disp_qty = '';
        //$this->delvby = '';
        $this->link2dispatch = '';
        $this->partiss = '';
        $this->drgiss = '';
        $this->cos = '';
        $this->partname = '';
        $this->rmspec = '';
		$this->supplier_wonum = '';
		$this->batchnum = '';
		$this->psn = '';

		$this->disp_custpo_no = '';
		$this->disp_custpo_item = '';
     }

    // Property get and set
    function getlinenum() {
           return $this->linenum;
    }

    function setlinenum ($reqlinenum) {

           $this->linenum = $reqlinenum;
    }

    function getwonum() {
           return $this->wonum;
    }

    function setwonum ($reqwonum) {
           $this->wonum = $reqwonum;
    }

    function getdnnum() {
           return $this->dnnum;
    }

    function setdnnum ($reqdnnum) {
           $this->dnnum = $reqdnnum;
    }


    function getpartnum() {
           return $this->partnum;
    }
    function setpartnum ($reqpartnum) {
           $this->partnum = $reqpartnum;
    }

    function getwoqty() {
           return $this->wo_qty;
    }
    function setwoqty ($reqwoqty) {
           $this->wo_qty = $reqwoqty;
    }
    
    function getcompqty() {
           return $this->comp_qty;
    }
    function setcompqty ($reqcompqty) {
           $this->comp_qty = $reqcompqty;
    }
    
    function getgrnnum() {
           return $this->grnnum;
    }

    function setgrnnum ($reqgrnnum) {
           $this->grnnum = $reqgrnnum;
    }

    function getcustpo_qty() {
           return $this->custpo_qty;
    }

    function setcustpo_qty ($reqcustpo_qty) {
           $this->custpo_qty = $reqcustpo_qty;
    }

    function getcustpo_date() {
           return $this->custpo_date;
    }

    function setcustpo_date ($reqcustpo_date) {
           $this->custpo_date = $reqcustpo_date;
    }
    function getcustpo_num() {
           return $this->custpo_num;
    }

    function setcustpo_num ($reqcustpo_num) {
           $this->custpo_num = $reqcustpo_num;
    }

    function getdisp_qty() {
           return $this->disp_qty;
    }

    function setdisp_qty ($reqdisp_qty) {
           $this->disp_qty = $reqdisp_qty;
    }
    function getpartname() {
           return $this->partname;
    }

    function setpartname($reqpartname) {
           $this->partname = $reqpartname;
    }
    function getlink2dispatch() {
           return $this->link2dispatch;
    }

    function setlink2dispatch ($reqlink2dispatch) {
           $this->link2dispatch = $reqlink2dispatch;
    }
    function getrmspec() {
           return $this->rmspec;
    }

    function setrmspec($reqrmspec) {
           $this->rmspec = $reqrmspec;
    }
    function getdrgiss() {
           return $this->drgiss;
    }

    function setdrgiss($reqdrgiss) {
           $this->drgiss = $reqdrgiss;
    }	  
    function getpartiss() {
           return $this->partiss;
    }

    function setpartiss($reqpartiss) {
           $this->partiss = $reqpartiss;
    }	  
    function getitemnum() {
           return $this->itemnum;
    }

    function setitemnum($reqitemnum) {
           $this->itemnum = $reqitemnum;
    }	  
    function getcos() {
           return $this->cos;
    }

    function setcos($reqcos) {
           $this->cos = $reqcos;
    }	
	function getsupplier_wonum() {
           return $this->supplier_wonum;
    }
    function setsupplier_wonum ($reqsupplier_wonum) {
           $this->supplier_wonum = $reqsupplier_wonum;
    }
    function getBatchnum() {
           return $this->batchnum;
    }
    function setBatchnum($reqbatchnum) {
           $this->batchnum = $reqbatchnum;
    }
    
    function getpsn() {
           return $this->psn;
    }
    function setpsn ($reqpsn) {
           $this->psn = $reqpsn;
    }



  function getdisp_custpo_no() {
           return $this->disp_custpo_no;
    }

    function setdisp_custpo_no ($reqdisp_custpo_no) {
           $this->disp_custpo_no = $reqdisp_custpo_no;
    }


	  function getdisp_custpo_item() {
           return $this->disp_custpo_item;
    }

    function setdisp_custpo_item ($reqdisp_custpo_item) {
           $this->disp_custpo_item = $reqdisp_custpo_item;
    }
    function addLi() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'dispatch_line_items' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for LI..Please report to Sysadmin. " . mysql_error());
        }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        //$crdate = "'" . date("y-m-d") . "'";
        $line_num = "'" . $this->linenum . "'";
        $wonum = "'" . $this->wonum . "'";
          $dnnum = "'" . $this->dnnum . "'";
		$supplier_wonum = "'" . $this->supplier_wonum . "'";
        $partnum = "'" . $this->partnum . "'";
        $grnnum = "'" . $this->grnnum  . "'";

        if($this->custpo_qty != '' && $this->custpo_qty != 'NULL')
        {
          $custpo_qty = "'" . $this->custpo_qty . "'";
        }
        else
        {
          $custpo_qty = 'NULL';
        }
        if($this->disp_qty != '' && $this->disp_qty != 'NULL')
        {
          $disp_qty = "'" . $this->disp_qty . "'";
        }
        else
        {
          $disp_qty = 'NULL';
        }
        if($this->wo_qty != '' && $this->wo_qty != 'NULL')
        {
          $wo_qty = "'" . $this->wo_qty . "'";
        }
        else
        {
          $wo_qty = 'NULL';
        }
        if($this->comp_qty != '' && $this->comp_qty != 'NULL')
        {
          $comp_qty = "'" . $this->comp_qty . "'";
        }
        else
        {
          $comp_qty = 'NULL';
        }


        //till$duedate = $this->duedate ? $this->duedate : "0000-00-00";
        $custpo_date = "'" . $this->custpo_date . "'";
        $custpo_num = "'" . $this->custpo_num. "'";

		 $disp_custpo_no = "'" . $this->disp_custpo_no. "'";
		  $disp_custpo_item = "'" . $this->disp_custpo_item. "'";


        $partname = "'" . $this->partname . "'";
        $drgiss = "'" . $this->drgiss . "'";
        $partiss = "'" . $this->partiss . "'";
        $cos = "'" . $this->cos . "'";
        $partname = "'" . $this->partname . "'";
        $itemnum = "'" . $this->itemnum . "'";
        $datecode = "'NA'";
        $rmspec = "'" . $this->rmspec . "'";
        $link2dispatch = $this->link2dispatch;
        $batchno = "'" . $this->batchnum . "'";
        $psn = "'" . $this->psn . "'";
        //$delvby = "'" . $this->delvby . "'";

        $sql = "INSERT INTO dispatch_line_items (recnum, line_num, 
                            wonum, partnum, grnnum, custpo_num,
                            custpo_qty, custpo_date,
                            dispatch_qty, link2dispatch,wo_qty,comp_qty,
                            partname, drgiss, partiss,itemnum, datecode, rmspec,cos,supplier_wonum,batchNo,psn,disp_custpo_no,disp_custpo_item,dnnum )
                      VALUES ($objid, $line_num, $wonum, $partnum, $grnnum, 
                              $custpo_num, $custpo_qty, $custpo_date,
                              $disp_qty, $link2dispatch, $wo_qty, $comp_qty,
                              $partname, $drgiss, $partiss, $itemnum, $datecode,
                              $rmspec, $cos,$supplier_wonum,$batchno,$psn,$disp_custpo_no,$disp_custpo_item,$dnnum)";
       // echo "$sql";
        $result = mysql_query($sql) or die("Insert to Dispatch LI didn't work..Please report to Sysadmin. " . mysql_error()); ;
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to LI didn't work..Please report to Sysadmin. " . mysql_error());
        }
        
        /*$sql = "update work_order set dispqty=$disp_qty where wonum=$wonum";
        $result = mysql_query($sql) or die("update to work_order didn't work..Please report to Sysadmin. " . mysql_error()); ;
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to WO didn't work..Please report to Sysadmin. " . mysql_error());
        }*/
        
        $sql = "update seqnum set nxtnum = $objid where tablename = 'dispatch_line_items'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for Dispatch LI..Please report to Sysadmin. " . mysql_error());
        }
        
        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Commit failed for Dispatch LI Insert..Please report to Sysadmin. " . mysql_error());
        }

     }

    function updateLI($recnum) {
        $lirecnum = $recnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";

        $line_num = "'" . $this->linenum . "'";
        $wonum = "'" . $this->wonum . "'";
        $dnnum = "'" . $this->dnnum . "'";
		    $supplier_wonum = "'" . $this->supplier_wonum . "'";
        $partnum = "'" . $this->partnum . "'";
        $grnnum = "'" . $this->grnnum . "'";
        if($this->disp_qty != '' && $this->disp_qty != 'NULL')
        {
          $disp_qty = "'" . $this->disp_qty . "'";
        }
        else
        {
          $disp_qty = 'NULL';
        }
        if($this->custpo_qty != '' && $this->custpo_qty != 'NULL')
        {
          $custpo_qty = "'" . $this->custpo_qty . "'";
        }
        else
        {
          $custpo_qty = 'NULL';
        }
        if($this->wo_qty != '' && $this->wo_qty != 'NULL')
        {
          $wo_qty = "'" . $this->wo_qty . "'";
        }
        else
        {
          $wo_qty = 'NULL';
        }
        if($this->comp_qty != '' && $this->comp_qty != 'NULL')
        {
          $comp_qty = "'" . $this->comp_qty . "'";
        }
        else
        {
          $comp_qty = 'NULL';
        }

        $custpo_date = "'" . $this->custpo_date . "'";
        $custpo_num = "'" . $this->custpo_num. "'";
        $custpo_date = "'" . $this->custpo_date . "'";
        $custpo_num = "'" . $this->custpo_num. "'";
        $partname = "'" . $this->partname . "'";
        $drgiss = "'" . $this->drgiss . "'";
        $partiss = "'" . $this->partiss . "'";
        $cos = "'" . $this->cos . "'";
        $itemnum = "'" . $this->itemnum . "'";
        $datecode = '';
        $rmspec = "'" . $this->rmspec . "'";
        $batchno = "'" . $this->batchnum . "'";
        $psn = "'" . $this->psn . "'";

        //$link2dispatch = $this->link2dispatch;
        //$delvby = "'" . $this->delvby . "'";

		 $disp_custpo_no = "'" . $this->disp_custpo_no. "'";
		  $disp_custpo_item = "'" . $this->disp_custpo_item. "'";

       $sql = "update dispatch_line_items
                          set line_num = $line_num,
                              wonum = $wonum,
                              partnum = $partnum,
                              grnnum = $grnnum,
                              custpo_num = $custpo_num,
                              custpo_qty = $custpo_qty,
                              custpo_date = $custpo_date,
                              dispatch_qty = $disp_qty,
                              wo_qty = $wo_qty,
                              comp_qty = $comp_qty,
                              partname = $partname,
                              drgiss = $drgiss,
                              partiss = $partiss,
                              cos = $cos,
                              itemnum = $itemnum,
                              rmspec = $rmspec,
							  supplier_wonum = $supplier_wonum,
							  batchNo = $batchno,
							  psn = $psn,
							  disp_custpo_no=$disp_custpo_no,
							  disp_custpo_item=$disp_custpo_item,
                dnnum=$dnnum
                        where recnum = $lirecnum";
           // echo $sql;

           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to Dispatch LI didn't work..Please report to Sysadmin. " . mysql_error());
     }

     function getLI($indisprecnum,$inptype) {
        $disprecnum = "'" . $indisprecnum . "'";
		$newlogin = new userlogin;
        $newlogin->dbconnect();
		if ($inptype == 'Assembly') 
		{
			$sql = "select dli.line_num,
						dli.wonum,
						dli.partnum,
                       dli.grnnum, 
					   dli.custpo_num,
					   dli.custpo_qty,
                       dli.custpo_date,
					   dli.wo_qty,
                       dli.comp_qty,
					   dli.recnum,
                       dli.dispatch_qty, 
					   dli.partname,
                       dli.drgiss,
					   dli.partiss, 
					   dli.itemnum,
                       dli.datecode,
					   dli.rmspec,
					   '',
                       dli.cos,
					   dli.supplier_wonum,
					   dli.batchNo,
					   dli.psn,
					   dli.disp_custpo_no,
					   dli.disp_custpo_item
                 from dispatch_line_items dli, assy_wo w
                 where dli.link2dispatch = $disprecnum and
                       w.assy_wonum = dli.wonum
                group by dli.wonum
                order by dli.line_num";
		 }
 	else if ($inptype == 'Kit')
		{
			$sql = "select dli.line_num, dli.wonum,dli.partnum,
                       dli.grnnum, dli.custpo_num,dli.custpo_qty,
                       dli.custpo_date,dli.wo_qty,
                       dli.comp_qty, dli.recnum,
                       dli.dispatch_qty, dli.partname,
                       dli.drgiss, dli.partiss, dli.itemnum,
                       dli.datecode, dli.rmspec,'',
                       dli.cos,dli.supplier_wonum,dli.batchNo,dli.psn,
					     dli.disp_custpo_no,
					   dli.disp_custpo_item
                 from dispatch_line_items dli, assy_wo w
                 where dli.link2dispatch = $disprecnum and
                       w.assy_wonum = dli.wonum
                group by dli.wonum
                order by dli.line_num";
		 }
		 else 
		 {

			 	$sql = "select dli.line_num, dli.wonum,dli.partnum,
                       dli.grnnum, dli.custpo_num,dli.custpo_qty,
                       dli.custpo_date,dli.wo_qty,
                       dli.comp_qty, dli.recnum,
                       dli.dispatch_qty, dli.partname,
                       dli.drgiss, dli.partiss, dli.itemnum,
                       dli.datecode, dli.rmspec,w.batchnum,
                       dli.cos,dli.supplier_wonum,dli.batchNo,dli.psn,
					     dli.disp_custpo_no,
					   dli.disp_custpo_item,dli.dnnum
                 from dispatch_line_items dli, work_order w
                 where dli.link2dispatch = $disprecnum 
                       
                group by dli.wonum
                order by dli.line_num";
              
		 }

       // echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
     
     

 function getwos4dispatch($crn,$companyrecnum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $siteid = $_SESSION['siteid'];
       $siteval = "w.siteid = '".$siteid."'";

       $sql = "select w.recnum,w.wonum,soli.partnum,w.grnnum,w.po_num,
                      w.po_qty, w.actual_ship_date,w.qty,w.comp_qty,
                      w.dispatch_qty,c.name,
                      m.partname, w.rm_spec, m.drg_issue,
                      m.attachments,m.CIM_refnum,
                      soli.line_num, m.cos,w.treatment,w.batchnum
                 from sales_order so,
                      so_line_items soli,
                      company c,
                      master_data m,
                      work_order w
                 where (w.wo2customer = c.recnum || w.wo2customer = c.alt_recnum) and
                       w.po_num = so.po_num and
                       soli.link2so = so.recnum and
                       soli.crn_num = m.CIM_refnum and
                       (CASE WHEN (w.cust_po_line_num != '' &&
                        w.cust_po_line_num is not null)
                            THEN w.cust_po_line_num = soli.line_num
                            ELSE TRUE END) and
                       m.recnum = w.link2masterdata and
                       (c.recnum = $companyrecnum || c.alt_recnum = $companyrecnum) and
                       (so.so2customer = $companyrecnum || so.so2customer = c.alt_recnum) and
                       (so.status = 'Open' || so.status = 'Closed') and
                       m.CIM_refnum = '$crn' and
                       (w.treatment = 'Untreated' || w.treatment is NULL || w.treatment = '') and
                       (CASE WHEN (w.woclassif = 'Rework')
                            THEN w.approval = 'yes'
                            ELSE TRUE END) and (w.comp_qty-(w.dispatch_qty+w.assy_qty))>0 and $siteval";
         // echo $sql;
          $result = mysql_query($sql);
          return $result;
      }
 

 function getassymfrwos4dispatch($crn,$companyrecnum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();

       $sql = "select w.recnum,w.wonum,arli.part_num,w.grnnum,w.po_num, 
                  w.po_qty, w.actual_ship_date,w.qty,w.comp_qty, w.dispatch_qty,
                  c.name, m.partname, w.rm_spec, m.drg_issue, m.attachments,m.CIM_refnum,
				  arli.line_num, m.cos,w.treatment,w.batchnum 
                from  company c, master_data m, work_order w, assy_review ar, assy_review_li arli
                where (w.wo2customer = c.recnum || w.wo2customer = c.alt_recnum) and 
                        (w.po_num = ar.cust_ponum and 
                         arli.link2assyreview = ar.recnum and 
                         arli.crn = m.CIM_refnum and 
                         CASE WHEN (w.cust_po_line_num != '' && w.cust_po_line_num is not null) THEN 
                         w.cust_po_line_num = arli.line_num ELSE TRUE END and
	                      ar.customer = '$companyrecnum')
                 and 
	                 m.recnum = w.link2masterdata and 
	                 (c.recnum = '$companyrecnum' || c.alt_recnum = '$companyrecnum') and 
					  m.CIM_refnum = '$crn' and 
	                 (w.treatment = 'Manufacture Only' || w.treatment is NULL) and 
					  w.`condition` = 'Closed' and
	                 (CASE WHEN (w.woclassif = 'Rework') THEN w.approval = 'yes' ELSE TRUE END)
					 and (w.comp_qty-w.dispatch_qty)>0";
          // echo $sql;
          $result = mysql_query($sql);
          return $result;
      }


 function getwos4dispatch_old2($crn,$companyrecnum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();

       $sql = "select w.recnum,w.wonum,soli.partnum,w.grnnum,w.po_num,
                      w.po_qty, w.actual_ship_date,w.qty,w.comp_qty,
                      w.dispatch_qty,c.name,
                      m.partname, w.rm_spec, m.drg_issue,
                      m.attachments,m.CIM_refnum,
                      soli.line_num, m.cos,w.treatment,w.batchnum
                 from sales_order so,
                      so_line_items soli,
                      company c,
                      master_data m,
                      work_order w
                 where (w.wo2customer = c.recnum || w.wo2customer = c.alt_recnum) and
                       w.po_num = so.po_num and
                       soli.link2so = so.recnum and
                       soli.crn_num = m.CIM_refnum and
                       (CASE WHEN (w.cust_po_line_num != '' &&
                        w.cust_po_line_num is not null)
                            THEN w.cust_po_line_num = soli.line_num
                            ELSE TRUE END) and
                       m.recnum = w.link2masterdata and
                       (c.recnum = $companyrecnum || c.alt_recnum = $companyrecnum) and
                       (so.so2customer = $companyrecnum || so.so2customer = c.alt_recnum) and
                       (so.status = 'Open' || so.status = 'Closed') and
                       m.CIM_refnum = '$crn' and
                       (w.treatment = 'Manufacture Only' || w.treatment is NULL) 
                            ";
          //echo $sql;
          $result = mysql_query($sql);
          return $result;

}


    function getwos4dispatch_old($crn,$companyrecnum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select w.recnum,w.wonum,m.partnum,w.grnnum,w.po_num,
                      w.po_qty, w.actual_ship_date,w.qty,w.comp_qty,
                      sum(dli.dispatch_qty),c.name,
                      m.partname, m.rm_spec, m.drg_issue,
                      m.attachments,m.CIM_refnum,
                      soli.line_num, m.cos
                      from sales_order so,
                      so_line_items soli,
                      company c, 
                      master_data m,
                      work_order w
                      left join dispatch_line_items dli on 
                      w.wonum = dli.wonum 
                      where w.wo2customer = c.recnum and
                       w.po_num = so.po_num and
                       soli.link2so = so.recnum and
                       ((soli.partnum = w.partnum) ||
                        (replace(soli.partnum,'-','') = replace(w.partnum,' ',''))) and
                       m.recnum = w.link2masterdata and
                       c.recnum = $companyrecnum and 
                       so.so2customer = $companyrecnum and
                       (so.status = 'Open' || so.status = 'Closed') and
                       m.CIM_refnum = '$crn'
                       group by w.wonum";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }

    function getdispqty($wonum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select w.recnum,w.wonum,w.partnum,w.grnnum,w.po_num,
                      w.po_qty, w.po_date,w.qty,w.comp_qty,
                      sum(dli.dispatch_qty) as dispqty,c.name
                 from work_order w, company c,dispatch_line_items dli ,dispatch d
                 where w.wo2customer = c.recnum and
                       w.wonum = dli.wonum and
                       w.wonum = '$wonum'  and
                       dli.link2dispatch=d.recnum and
                       d.`status` !='Cancelled'
                 group by w.wonum";
       //echo $sql;
       $result = mysql_query($sql);
       //$row     = mysql_fetch_array($result, MYSQL_ASSOC);
      //$dispqty = $row['dispqty'];
       return $result;
    }

    function deleteLI($inprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $recnum = $inprecnum;
        $sql = "delete from dispatch_line_items where recnum = $recnum";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Line Items failed...Please report to SysAdmin. " . mysql_error());
      }
      

// Renamed the existing getwos4treat to _new and changed _prev to getwos4treat
//  Addition of rework was causing problems....need tro check
    function getwos4treat_new($crn,$companyrecnum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();

       $sql = "select w.recnum,w.wonum,soli.partnum,
                      w.grnnum,w.po_num, w.po_qty,
					  dnli.datecode,w.qty,w.comp_qty,
                      NULL,c.name,
					  m.partname, w.rm_spec, m.drg_issue,
                      m.attachments,m.CIM_refnum,
					  soli.line_num,m.cos,dnli.supplier_wo,
                     dnli.qty_acc,w.batchnum,w.assy_qty
			   from sales_order so, so_line_items soli,
                    company c, master_data m,
                    delivery_note_li dnli,
                    dispatch d,work_order w,delivery_note dn
			   left join dispatch_line_items dli on (dn.wonum = dli.wonum)
			   where (w.wo2customer = c.recnum || w.wo2customer = c.alt_recnum)
                     and w.po_num = so.po_num and
					soli.link2so = so.recnum
					and soli.crn_num = m.CIM_refnum and
                    (CASE WHEN (w.cust_po_line_num != ''
					&& w.cust_po_line_num is not null) THEN w.cust_po_line_num = soli.line_num
					ELSE TRUE END) and
                    m.recnum = w.link2masterdata and 
                    (c.recnum = $companyrecnum || c.alt_recnum = $companyrecnum) and
                    (so.so2customer = $companyrecnum || so.so2customer = c.alt_recnum) and  (so.status = 'Open' || so.status = 'Closed') and
					m.CIM_refnum = '$crn' and dn.recnum = dnli.link2delivery
					and w.treatment='With Treatment'
					and dn.crn='$crn'
					and (dn.wonum=w.wonum || dn.wonum = w.worefnum) 
					and dnli.cofc_num is not NULL
					and dnli.cofc_num != ''
					and dnli.cofc_num != '0'
					and dnli.supplier_wo is not NULL
					and dnli.supplier_wo != ''
					and dnli.supplier_wo != '0' and
                       (CASE WHEN (w.woclassif = 'Rework')
                            THEN w.approval = 'yes'
                            ELSE TRUE END)
				    group by w.wonum,dnli.cofc_num,dnli.supplier_wo
                    order by w.wonum";
       //echo $sql;
       //and w.wonum not in(select distinct ali.grn from assywo_li ali,assy_wo asy where ali.link2assywo=asy.recnum)
       $result = mysql_query($sql);
       return $result;
    }

   function getwos4treat($crn,$companyrecnum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $siteid = $_SESSION['siteid'];
       $siteval = "w.siteid = '".$siteid."'";

       $sql = "select w.recnum,w.wonum,soli.partnum,
                      w.grnnum,w.po_num, w.po_qty,
					  dnli.datecode,w.qty,w.comp_qty,
                      NULL,c.name,
					  m.partname, w.rm_spec, m.drg_issue,
                      m.attachments,m.CIM_refnum,
					  soli.line_num,m.cos,dnli.supplier_wo,
                      dnli.qty_acc,w.batchnum
			   from sales_order so, so_line_items soli,
                    company c, master_data m,
                    delivery_note_li dnli,
                    dispatch d,work_order w,delivery_note dn
			   left join dispatch_line_items dli on (dn.wonum = dli.wonum)
			   where (w.wo2customer = c.recnum || w.wo2customer = c.alt_recnum)
                     and w.po_num = so.po_num and
					soli.link2so = so.recnum
					and soli.crn_num = m.CIM_refnum and
                    (CASE WHEN (w.cust_po_line_num != ''
					&& w.cust_po_line_num is not null) THEN w.cust_po_line_num = soli.line_num
					ELSE TRUE END) and
                    m.recnum = w.link2masterdata and 
                    (c.recnum = $companyrecnum || c.alt_recnum = $companyrecnum) and
                    (so.so2customer = $companyrecnum || so.so2customer = c.alt_recnum) and  (so.status = 'Open' || so.status = 'Closed') and
					m.CIM_refnum = '$crn' and dn.recnum = dnli.link2delivery
					and w.treatment='With Treatment'
					and dn.crn='$crn'
					and dn.wonum=w.wonum
					and dnli.cofc_num is not NULL
					and dnli.cofc_num != ''
					and dnli.cofc_num != '0'
					and dnli.supplier_wo is not NULL
					and dnli.supplier_wo != ''
					and dnli.supplier_wo != '0'
                    and w.wonum not in(select distinct ali.grn from assywo_li ali,assy_wo asy where ali.link2assywo=asy.recnum) and $siteval
				    group by w.wonum,dnli.cofc_num,dnli.supplier_wo
                    order by w.wonum";
      // echo $sql;
       $result = mysql_query($sql);
       return $result;
    }
        
    function getdisputd4treat($wonum,$supwo)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select w.recnum,w.wonum,w.partnum,w.grnnum,w.po_num,
                      w.po_qty, w.po_date,w.qty,w.comp_qty,
                      sum(dli.dispatch_qty),c.name
                 from work_order w, company c,dispatch_line_items dli
                 where w.wo2customer = c.recnum and
                       w.wonum = dli.wonum and
                       w.wonum = '$wonum' and
                       dli.supplier_wonum = '$supwo'
                 group by w.wonum";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }
 // Added on Nov 3, 2010 for Assembly Dispatch
	function getdisputd4assy($wonum,$supwo)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select w.recnum,w.assy_wonum,w.assypartnum,'',w.ponum,
                      w.poqty, '',w.assyqty,w.comp_qty,
                      sum(dli.dispatch_qty),c.name
                 from assy_wo w, company c,dispatch_line_items dli
                 where w.link2cust = c.recnum and
                       w.assy_wonum = dli.wonum and
                       w.assy_wonum = '$wonum'
                 group by w.assy_wonum";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }

    


    function getLI_print_label($recnum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select dli.custpo_num,dli.partnum,dli.dispatch_qty,
                      dli.batchNo,dli.psn
               from dispatch_line_items dli
               where dli.recnum='$recnum'";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }

	//dispatchliClass
    function getWoforassy_reverted2old($crn,$companyrecnum){
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select asy.recnum,asy.assy_wonum,asy.assypartnum, '-',asy.ponum,
	                  asy.poqty, asy.actual_ship_date, asy.assyqty,asy.comp_qty,
					  sum(dli.dispatch_qty), c.name, 
					  asy.descr, 'NA',asy.drgiss,asy.assypartiss, 
					  asy.crn, '',asy.cos,'Assembly','NA'
              from company c,work_order w,assywo_li asy_li,dispatch d,assy_wo asy
                   left join dispatch_line_items dli on asy.assy_wonum = dli.wonum
                   where(asy.link2cust = c.recnum || asy.link2cust= c.alt_recnum)
                   and (c.recnum = '$companyrecnum' || c.alt_recnum = '$companyrecnum')
                   and asy.crn = '$crn'
                   and asy_li.link2assywo=asy.recnum
                   and asy_li.grn=w.wonum  and  dli.link2dispatch=d.recnum and d.`status` != 'Cancelled' and
                   (w.comp_qty !=0 ||w.comp_qty !='' ||w.comp_qty !='null') and
                   (w.comp_qty >= asy.comp_qty)
                   group by asy.assy_wonum";
       //echo "Here:$sql";
       $result = mysql_query($sql);
       return $result;
     }

    function getWoforassy($crn,$companyrecnum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $siteid = $_SESSION['siteid'];
       $siteval = "asy.siteid = '".$siteid."'";
       $sql = "select asy.recnum,asy.assy_wonum,asy.assypartnum, '-',asy.ponum,
	                  asy.poqty, asy.actual_ship_date, asy.assyqty,asy.comp_qty,
					  sum(dli.dispatch_qty), c.name, 
					  asy.descr, 'NA',asy.drgiss,asy.assypartiss, 
					  asy.crn, '',asy.cos,'Assembly','NA'
                      from company c,assy_wo asy
                           left join dispatch_line_items dli on asy.assy_wonum = dli.wonum
                           left join assywo_li ali on ali.grn = dli.wonum
                           where (asy.link2cust = c.recnum || asy.link2cust= c.alt_recnum)
                                  and (c.recnum = '$companyrecnum' || c.alt_recnum = '$companyrecnum')
                                  and asy.crn = '$crn'
                                  and asy.assy_wonum not in(select distinct ali.grn from assywo_li ali,assy_wo asy where ali.link2assywo=asy.recnum)
				  and (asy.comp_qty-asy.dispatch_qty) >0 and $siteval
                                  group by asy.assy_wonum";
       // echo "Here:$sql";
       $result = mysql_query($sql);
       return $result;
     }
     
    function getgrninfo4cons($grnnum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select g.invoice_num,g.invoice_date,sum(gli.qty_to_make),
                      g.grnnum,g.recieved_date,g.cimponum,g.raw_mat_spec,c.name,g.raw_mat_type,gli.uom ,
                      sum(gli.qty),g.crn,gli.dim1,gli.dim2,gli.dim3,g.grntype
                      from grn_li gli,grn g,company c
                           where g.grnnum='$grnnum' and
                                 gli.link2grn=g.recnum and
                                 g.link2vendor=c.recnum and
                                (gli.amendlinenum = ''  or gli.amendlinenum is null or gli.amendlinenum = 0 ) and
                                 (g.parentgrnnum ='' || g.parentgrnnum is null)
				                 group by g.grnnum";
      // echo "Here:$sql";
        $result  = mysql_query($sql) or die('getgrninfo4cons query failed');
        return $result;
    }
    
    function getgrnmcofcdet4cons($grnnum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select recnum as rec, cofc_num as cofcnum
	                         from consumption 
	                           where 	grnnum = '$grnnum' order by cofc_num";
       // echo "Here:$sql";
        $result  = mysql_query($sql) or die('getgrnmcofcdet4cons query failed');
        //$row     = mysql_fetch_array($result, MYSQL_ASSOC);
        //$rec = $row['rec'];

       return $result;
    }
   function addtoconsumption($grnnum,$invnum,$invdate,$qtyrecd,$qtycons,$cofcnum,$crn,$gdate,$ponum,$rmspec,$company,$rmtype,$uom,$qty,$qtyrej,$bond_num,$bonddate,$be_num,$bedate,$assessval,$cifval,$dutyamt,$invamt,$currency,$expinvnum)
   {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       //$invdate = $invdate?"'" . $invdate . "'":'0000-00-00';
        $sql = "select nxtnum from seqnum where tablename = 'consumption' for update";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result)
                     {
                      $sql = "rollback";
                      $result = mysql_query($sql);
                      die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
                     }


        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $qty = $qty?$qty:0.0;
        $qtyrej =  $qtyrej? $qtyrej:0.0;
        $closingbal=$qtyrecd-$qtycons;
       $sql = "insert into consumption
                           (recnum,
                            crn,
                            invoice_num,
                            grnnum,
                            grn_date,
                            ponum,
                            description,
                            qty_recd,
                            qty_cons,
                            create_date,
                             closingbal,
                            invoice_date,
                            cofc_num,company,rmtype,uom,qty,qty_rej,
                            bond_num,
                            be_num,
                            bonddate,
                            bedate,
                            assessval,
                            cifval,
                            dutyamt,
                            invamt,
                            currency,expinvnum)
                            values($objid,'$crn','$invnum','$grnnum','$gdate','$ponum','$rmspec',$qtyrecd,
                            $qtycons,now(),$closingbal,'$invdate','$cofcnum','$company','$rmtype','$uom',$qty,
                            $qtyrej,'$bond_num',
                            '$be_num',
                            '$bonddate',
                            '$bedate',
                            '$assessval',
                            '$cifval',
                            '$dutyamt',
                            '$invamt',
                            '$currency','$expinvnum')";
       //echo "Here:$sql";
       $result = mysql_query($sql);
        if(!$result)
                        {
                        //header("Location:errorMessage.php?validate=Inv2");
                        die("Insert to consumption didn't work..Please report to Sysadmin. " . mysql_error());
                        }

                         $sql = "update seqnum set nxtnum = $objid where tablename = 'consumption'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv4");
                     die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
                     }
   }

   
    function updatetoconsumption($qty_recd,$qty_total,$relnotenum,$crn,$recnum,$bond_num,$bonddate,$be_num,$bedate,$assessval,$cifval,$dutyamt,$invamt,$currency,$expinvnum)
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $closingbal=$qty_recd-$qty_total;
        $qty_total=$qty_total?$qty_total:0.0;
        $invamt=$invamt?$invamt:0.0;
        $assessval=$assessval?$assessval:0.0;
       // echo $assessval."<br>";
         $cifval=$cifval?$cifval:0.0;
        $dutyamt=$dutyamt?$dutyamt:0.0;
        $bonddate=$bonddate?$bonddate:'0000-00-00';
        $bedate=$bedate?$bedate:'0000-00-00';
       // $qty_rej=$qty_rej?$qty_rej:0.0;
        $sql = "update consumption set
                            qty_cons=$qty_total,
                            modified_date=now(),
                            closingbal=$closingbal ,
                            cofc_num='$relnotenum',
                            bond_num='$bond_num',
                            be_num='$be_num',
                            bonddate='$bonddate',
                            bedate='$bedate',
                            assessval='$assessval',
                            cifval='$cifval',
                            dutyamt='$dutyamt',
                            invamt='$invamt',
                            currency='$currency',
                            expinvnum='$expinvnum'
                            where recnum=$recnum
                            ";
                         // echo $sql;
               $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
           {
               //header("Location:errorMessage.php?validate=Inv2");
           die("Update to consumption for dispatchli didn't work..Please report to Sysadmin. " . mysql_error());
           }
   }

   function updatetoconsumptionrej($grnnum,$qty_rej)
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        //$closingbal=$qty_recd-$qty_total;
        //$qty_total=$qty_total?$qty_total:0.0;
        $qty_rej=$qty_rej?$qty_rej:0.0;
        $sql = "update consumption set
                             qty_rej=$qty_rej
                             where grnnum='$grnnum'
                            ";
            //echo $sql;
               $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
                        {
                        //header("Location:errorMessage.php?validate=Inv2");
                        die("Update to consumption for dispatchli didn't work..Please report to Sysadmin. " . mysql_error());
                        }
   }
   
   function getdispqty4grn($grnnum,$cofcnum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select sum(dli.dispatch_qty) as qty
                      from dispatch_line_items dli,dispatch d
	                           where dli.grnnum = '$grnnum' and
                                     d.relnotenum='$cofcnum' and
                                     dli.link2dispatch=d.recnum";
        //echo "Here:$sql";
        $result  = mysql_query($sql) or die('getgrnmcofcdet4cons query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $qty = $row['qty'];
        return $qty;
    }
    
     function getcofc4cons($grnnum,$cofcnum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select recnum as rec, cofc_num as cofcnum
	                         from consumption
	                           where 	cofc_num = '$cofcnum'";
        //echo "Here----:$sql";
        $result  = mysql_query($sql) or die('getgrnmcofcdet4cons query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $cofcnum = $row['cofcnum'];

       return $cofcnum;
    }

      function getWoforassy4kit($crn,$companyrecnum)
      {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $siteid = $_SESSION['siteid'];
         $siteval = "asy.siteid = '".$siteid."'";
         $sql = "select asy.recnum,asy.assy_wonum,asy.assypartnum, '-',asy.ponum,
	                  asy.poqty, asy.actual_ship_date, asy.assyqty,asy.comp_qty,
					  sum(dli.dispatch_qty), c.name,
					  asy.descr, 'NA',asy.drgiss,asy.assypartiss,
					  asy.crn, '',asy.cos,'Assembly','NA'
              from company c,assy_wo asy
                   left join dispatch_line_items dli on asy.assy_wonum = dli.wonum
                   left join assywo_li ali on ali.grn = dli.wonum
                   where (asy.link2cust = c.recnum || asy.link2cust= c.alt_recnum)
                   and (c.recnum = '$companyrecnum' || c.alt_recnum = '$companyrecnum')
                   and asy.crn = '$crn' and
                   asy.assy_type='Kit' and
                   asy.assy_wonum not in(select distinct ali.grn from assywo_li ali,assy_wo asy where ali.link2assywo=asy.recnum)
				   and (asy.comp_qty-sum(dli.dispatch_qty))>0 and $siteval
                   group by asy.assy_wonum ";
       //echo "Here--2---:$sql";
       $result = mysql_query($sql);
       return $result;
     }
     
     function getcofcnuminfo($grnnum,$cofcnum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select recnum as rec, cofc_num as cofcnum
	                         from consumption
	                           where 	grnnum = '$grnnum' and
                                        cofc_num='$cofcnum'";
        //echo "Here:$sql";
        $result  = mysql_query($sql) or die('getcofcnuminfo query failed');
        //$row     = mysql_fetch_array($result, MYSQL_ASSOC);
        //$rec = $row['rec'];

       return $result;
    }
    

    function getworej4cofc($grnnum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select sum(wo_p.rej) as reject
                      from wo_part_status wo_p,work_order w
                      where
                      wo_p.link2wo=w.recnum and
                      w.grnnum='$grnnum' and
                      w.`condition` !='Cancelled' and
                      w.`condition` !='Hold' and
                     ((w.treatment = 'Manufacture Only' and
					   (wo_p.stage='FINAL' || wo_p.stage='FI' || wo_p.stage='final' || wo_p.stage='Fi')) || 
                      (w.treatment = 'With Treatment' and (wo_p.stage='PostDN' || wo_p.stage='DN')))";
        //echo "Here rej in displi:$sql";
        $result  = mysql_query($sql) or die('getworej4cofc query failed');
        return $result;
    }
	
     function getallgrn4consupdate($grnnum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select g.grnnum,gli.qty as qty,g.crn,gli.qty_to_make,gli.dim1,gli.dim2,gli.dim3,
                       g.grntype,g.raw_mat_spec
                      from grn_li gli,grn g
                           where gli.link2grn=g.recnum and
								 g.status != 'Cancelled' and
                                 g.grnnum='$grnnum' and
                                (gli.amendlinenum = ''  or gli.amendlinenum is null or gli.amendlinenum = 0 ) and
                                 (g.parentgrnnum ='' || g.parentgrnnum is null)";
        //echo "$sql <br>";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("getallgrn4consupdate didn't work. " . mysql_error());
        return $result;

     }
     
     
     function getdispqty4wo($wonum,$cofcnum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select sum(dli.dispatch_qty) as qty
                      from dispatch_line_items dli,dispatch d
	                           where dli.wonum = '$wonum' and
                                     d.relnotenum='$cofcnum' and
                                     dli.link2dispatch=d.recnum";
        //echo "Here:$sql";
        $result  = mysql_query($sql) or die('getgrnmcofcdet4cons query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $qty = $row['qty'];
        return $qty;
    }
 
     function upddelsch($crn,$schdate,$totdispqty,$disp_update,$pagename)
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        //echo $disp_update."----";
        $schdate =$schdate? "'" . $schdate . "'"  : "0000-00-00";
        $sql="select schedule_qty as qty,disp_qty as disp
                    from delivery_sch
                         where crnnum='$crn' and
                               schedule_date =$schdate";
        //echo $sql;
        $result  = mysql_query($sql) or die('get qty from delivery_sch query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $qty = $row['qty'];
		$disp=$row['disp'];
       // echo $disp_update."---in class--<br>";
        /*if($pagename=='dispatchupdate')
        { 		
		if($qty!=0 && $qty !='')
        {
			$remain_qty=($qty-$disp);
			if($remain_qty == 0)
				$qty4delivery= ($qty-$disp)+ $totdispqty;
			else
                $qty4delivery= ($qty-$disp)+ $totdispqty-1;
		  echo $qty.'---'.$disp.'+++'.$totdispqty;
        }
		else
        {
          $qty4delivery= $disp+ $totdispqty;
        }
         //echo $disp_update."---in class-1111----";
        }else
        {
          $qty4delivery= $disp+ $totdispqty;
          //echo $disp_update."---in class-222----";
		  //echo $disp.'+++++'.$totdispqty;
        }*/
		
		if($pagename=='dispatchupdate')
        { 		
		if($qty!=0 && $qty !='')
        {
			$remain_qty=($qty-$disp);
			if($remain_qty == 0)
				//$qty4delivery= ($qty-$disp)+ $totdispqty;
                            $qty4delivery= $totdispqty;
			else
                //$qty4delivery= ($qty-$disp)+ $totdispqty-1;
                               $qty4delivery= $totdispqty;		 
          //echo $qty.'---'.$disp.'++++'.$totdispqty;
        }
		else
        {
          $qty4delivery= $disp+ $totdispqty;
        }
         //echo $disp_update."---in class-1111----";
        }else
        {
          $qty4delivery= $disp+ $totdispqty;
          //echo $disp_update."---in class-222----";
		  //echo $disp.'+++++'.$totdispqty;
        }

        $sql = "update delivery_sch
		                         set disp_qty = $qty4delivery
                                     where crnnum='$crn' and
							               schedule_date = $schdate";
          //echo $sql;
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
           {
              die("Update to delivery sch didn't work..Please report to Sysadmin. " . mysql_error());
           }
   }
   
    function getwo4kitassyliwo($assywonum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
        $sql = "select ali.grn as wo4kit,ali.bom_type,ali.qty
                        from assywo_li ali,assy_wo a
                             where ali.link2assywo=a.recnum and a.assy_wonum='$assywonum'
                                   and ali.bom_type='Sub Assembly'";
       // echo "$sql1<br>";
        $result  = mysql_query($sql) or die('getwo4kitassyliwo in dispacth li query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $wo4kit = $row['wo4kit'];
        return $wo4kit;
      }

  function getdispqty4update($wonum)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select w.dispatch_qty as wqty from work_order w where w.wonum='$wonum'";
       // echo "$sql<br>";
        $result  = mysql_query($sql) or die('getdispqty4update in dispacth li query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $wqty = $row['wqty'];
        return $wqty;
  }
  
   function updateWo4dispqty($fdispqty)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $wonum = "'" . $this->wonum . "'";
        
        $sql = "update work_order set dispatch_qty=$fdispqty where wonum=$wonum";
        // echo "$sql<br>";exit;
        $result  = mysql_query($sql) or die('updateWo4dispqty in dispacth li query failed');

  }
  function getdispqty4assyupdate($wonum)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select w.dispatch_qty as wqty from assy_wo w where w.assy_wonum='$wonum'";
       // echo "$sql<br>";
        $result  = mysql_query($sql) or die('getdispqty4assyupdate in dispacth li query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $wqty = $row['wqty'];
       // echo $wqty."===in class===";
        return $wqty;
  }

   function updateassyWo4dispqty($fdispqty)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $wonum = "'" . $this->wonum . "'";

        $sql = "update assy_wo set dispatch_qty=$fdispqty where assy_wonum=$wonum";
       // echo "$sql<br>";
        $result  = mysql_query($sql) or die('updateassyWo4dispqty in dispacth li query failed');

  }
function getdispatch4wo($crn,$companyrecnum,$wonum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();

       $sql = "select w.recnum,w.wonum,soli.partnum,w.grnnum,w.po_num,
                      w.po_qty, w.actual_ship_date,w.qty,w.comp_qty,
                      w.dispatch_qty,c.name,
                      m.partname, w.rm_spec, m.drg_issue,
                      m.attachments,m.CIM_refnum,
                      soli.line_num, m.cos,w.treatment,w.batchnum
                 from sales_order so,
                      so_line_items soli,
                      company c,
                      master_data m,
                      work_order w
                 where (w.wo2customer = c.recnum || w.wo2customer = c.alt_recnum) and
                       w.po_num = so.po_num and
                       soli.link2so = so.recnum and
                       soli.crn_num = m.CIM_refnum and
                       (CASE WHEN (w.cust_po_line_num != '' &&
                        w.cust_po_line_num is not null)
                            THEN w.cust_po_line_num = soli.line_num
                            ELSE TRUE END) and
                       m.recnum = w.link2masterdata and
                       (c.recnum = $companyrecnum || c.alt_recnum = $companyrecnum) and
                       (so.so2customer = $companyrecnum || so.so2customer = c.alt_recnum) and

                       (so.status = 'Open' || so.status = 'Closed') and
                       m.CIM_refnum = '$crn' and
                       (w.treatment = 'Manufacture Only' || w.treatment is NULL) and
                       (CASE WHEN (w.woclassif = 'Rework')
                            THEN w.approval = 'yes'
                            ELSE TRUE END) and w.wonum='$wonum'";
          //echo $sql;
          $result = mysql_query($sql);
          return $result;
      }
function gettreat4wo($crn,$companyrecnum,$wonum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();

       $sql = "select w.recnum,w.wonum,soli.partnum,

                      w.grnnum,w.po_num, w.po_qty,
					  dnli.datecode,w.qty,w.comp_qty,
                      NULL,c.name,
					  m.partname, w.rm_spec, m.drg_issue,
                      m.attachments,m.CIM_refnum,
					  soli.line_num,m.cos,dnli.supplier_wo,
                     dnli.qty_acc,w.batchnum,w.assy_qty
			   from sales_order so, so_line_items soli,
                    company c, master_data m,
                    delivery_note_li dnli,
                    dispatch d,work_order w,delivery_note dn
			   left join dispatch_line_items dli on (dn.wonum = dli.wonum)
			   where (w.wo2customer = c.recnum || w.wo2customer = c.alt_recnum)
                     and w.po_num = so.po_num and
					soli.link2so = so.recnum
					and soli.crn_num = m.CIM_refnum and
                    (CASE WHEN (w.cust_po_line_num != ''
					&& w.cust_po_line_num is not null) THEN w.cust_po_line_num = soli.line_num
					ELSE TRUE END) and
                    m.recnum = w.link2masterdata and 
                    (c.recnum = $companyrecnum || c.alt_recnum = $companyrecnum) and
                    (so.so2customer = $companyrecnum || so.so2customer = c.alt_recnum) and  (so.status = 'Open' || so.status = 'Closed') and
					m.CIM_refnum = '$crn' and dn.recnum = dnli.link2delivery
					and w.treatment='With Treatment'
					and dn.crn='$crn'
					and (dn.wonum=w.wonum || dn.wonum = w.worefnum) 
					and dnli.cofc_num is not NULL
					and dnli.cofc_num != ''
					and dnli.cofc_num != '0'
					and dnli.supplier_wo is not NULL
					and dnli.supplier_wo != ''
					and dnli.supplier_wo != '0' and
                       (CASE WHEN (w.woclassif = 'Rework')
                            THEN w.approval = 'yes'
                            ELSE TRUE END) and w.wonum='$wonum'
				    group by w.wonum,dnli.cofc_num,dnli.supplier_wo
                    order by w.wonum";
     //  echo $sql;
       //and w.wonum not in(select distinct ali.grn from assywo_li ali,assy_wo asy where ali.link2assywo=asy.recnum)
       $result = mysql_query($sql);
       return $result;
    }
function getcofc_lineitems($wonum)
{
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select * from dispatch_line_items dl,dispatch d  
                where dl.wonum='$wonum' and d.recnum=dl.link2dispatch";
        //echo "$sql<br>";
        $result  = mysql_query($sql) or die('getcofc_lineitems in dispacth li query failed');       
        return $result;
}
 
   function getWo4post($crn,$companyrecnum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $siteid = $_SESSION['siteid'];
       $siteval = "w.siteid = '".$siteid."'";

        $sql = "select  dn.recnum,dn.wonum,soli.partnum,dn.grn_num,so.po_num, dn.poqty, w.actual_ship_date,dn.qty,dn.comp_qty, dnl.disp_qty
                ,c.name, m.partname, dn.mtl_spec, dn.drg_iss, m.attachments, dn.crn,soli.line_num,
                 m.cos,w.treatment,dn.batch_num,dn.dnnum,dnl.supplier_wo from delivery_note dn,sales_order so,
                so_line_items soli, company c, master_data m, work_order w, delivery_note_li dnl where  w.po_num = so.po_num and
                soli.link2so = so.recnum and dn.recnum = dnl.link2delivery and
                dn.wonum = w.wonum and m.recnum = w.link2masterdata and  (w.wo2customer = c.recnum || w.wo2customer = c.alt_recnum) and dn.comp_qty-(dnl.disp_qty+dnl.assy_qty)>0 and  dn.crn = '$crn' and $siteval";
                // echo $sql;
          $result = mysql_query($sql);
          return $result;
      }



function updatedispqty4dnli($suppwo,$dispqty)
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        //$closingbal=$qty_recd-$qty_total;
        //$qty_total=$qty_total?$qty_total:0.0;
        // $qty_rej=$qty_rej?$qty_rej:0.0;
        $sql = "update delivery_note_li set
                             disp_qty=$dispqty
                             where supplier_wo=$suppwo";
            // echo $sql;exit;
               $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
                        {
                        //header("Location:errorMessage.php?validate=Inv2");
                        die("Update to delivery_note_li for dispatchqty didn't work..Please report to Sysadmin. " . mysql_error());
                        }
   }
   

     /*function deleteLI($inplirecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $lirecnum = "'" . $inplirecnum . "'";0  
        $sql = "delete from po_line_items where recnum = $lirecnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Line Items failed...Please report to SysAdmin. " . mysql_error());
      }*/

} // End dispatch_line_items class definition
