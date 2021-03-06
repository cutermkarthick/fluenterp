<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: poClass.php
// Application: WMS
// Revision: v1.0
//====================================

include_once('loginClass.php');

class po {

    var $ponum,
        $wonum,
        $podate,
        $vendor,
        $duedate,
        $descr,
        $postatus,
        $poamount,
        $currency,
        $tax,
        $shipping,
        $labor,
        $total_due,
		$remarks,
		$terms,
        $approval,
        $approvaldate,
        $amendment_num,
        $amendmentdate,
        $amendment_notes,
        $communication,
        $potype;

    // Constructor definition
    function po() {
        $this->ponum = '';
        $this->wonum = '';
        $this->descr = '';
        $this->podate = '';
        $this->duedate = '';
        $this->vendor = '';
        $this->postatus = '';
        $this->poamount = '';
        $this->currency='';
        $this->tax = '';
        $this->shipping = '';
        $this->labor = '';
        $this->total_due = '';
		$this->remarks = '';
		$this->terms = '';
		$this->approval = '';
        $this->approvaldate = '';
		$this->amendment_num = '';
		$this->amendmentdate = '';
		$this->amendment_notes = '';
		$this->communication = '';
		$this->potype = '';
    }

    // Property get and set
    function getponum() {
           return $this->ponum;
    }

    function setponum ($reqponum) {
           $this->ponum = $reqponum;
    }
    function getwonum() {
           return $this->wonum;
    }

    function setwonum ($reqwonum) {
           $this->wonum = $reqwonum;
    }
    function getpodate() {
           return $this->podate;
    }

    function setpodate ($reqpodate) {
           $this->podate = $reqpodate;
    }

    function getduedate() {
           return $this->duedate;
    }
    function setduedate ($reqduedate) {
           $this->duedate = $reqduedate;
    }
    function getdescr() {
           return $this->getdescr;
    }
    function setdescr ($reqdescr) {
           $this->descr = $reqdescr;
    }

    function getpoamount() {
           return $this->poamount;
    }
    function setpoamount ($reqpoamount) {
           $this->poamount = $reqpoamount;
    }
    function getvendor() {
           return $this->vendor;
    }
    
    function setvendor ($reqvendor) {
           $this->vendor = $reqvendor;
    }

    function settax ($reqtax) {
           $this->tax = $reqtax;
    }
    function gettax() {
             return $this->tax;
    }

    function setshipping ($reqshipping) {
           $this->shipping = $reqshipping;
    }
    function getshipping() {
             return $this->shipping;
    }

    function setlabor ($reqlabor) {
           $this->labor = $reqlabor;
    }
    function getlabor() {
             return $this->labor;
    }

    function settotaldue ($reqtotaldue) {
           $this->total_due = $reqtotaldue;
    }

    function gettotaldue() {
             return $this->total_due;
    }

    function getpostatus() {
           return $this->postatus;
    }

    function setpostatus ($reqpostatus) {
           $this->postatus = $reqpostatus;
    }
    
    function getcurrency() {
           return $this->currency;
    }

    function setcurrency ($reqcurrency) {
           $this->currency = $reqcurrency;
    }

	function getremarks() {
           return $this->remarks;
    }

    function setremarks($reqremarks) {
           $this->remarks = $reqremarks;
    }
	function getterms() {
           return $this->terms;
    }

    function setterms ($reqterms) {
           $this->terms = $reqterms;
    }
    
    	function getapproval() {
           return $this->approval;
    }

    function setapproval ($approval) {
           $this->approval = $approval;
    }

    
    	function getapprovaldate() {
           return $this->approvaldate;
    }

      function setapprovaldate ($approvaldate) {
           $this->approvaldate = $approvaldate;
    }

    	function getamendment_num() {
           return $this->amendment_num;
    }

        function setamendment_num ($amendment_num) {
           $this->amendment_num = $amendment_num;
    }

    
   	function getamendmentdate() {
           return $this->amendmentdate;
    }

      function setamendmentdate ($amendmentdate) {
           $this->amendmentdate = $amendmentdate;
    }
    
    	function getamendment_notes() {
           return $this->amendment_notes;
    }

      function setamendment_notes ($amendment_notes) {
           $this->amendment_notes = $amendment_notes;
    }
    
    function getcomm() {
           return $this->communication;
    }

      function setcomm($comm) {
           $this->communication = $comm;
    }
     function setpotype($potype) {
           $this->potype = $potype;
    }
    
    function addPO()
	{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'po' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $crdate = "'" . date("y-m-d") . "'";
        $ponum = "'" . $this->ponum . "'";
        $wonum = "'" . $this->wonum . "'";
        $desc = "'" . $this->descr . "'";
        $podate = "'" . $this->podate . "'";
        $duedate = "'" . $this->duedate . "'";
        $link2vendor = "'" . $this->vendor . "'";
        $poamount = $this->poamount;
        $currency = "'" . $this->currency . "'";
		$remarks = "'" . $this->remarks . "'";
        $terms = "'" . $this->terms . "'";
        $tax=($this->tax == '')? 0:$this->tax;
        $shipping=($this->shipping == '')? 0:$this->shipping;
        $labor=($this->labor == '')? 0:$this->labor;
        $total_due=($this->total_due == '')? 0:$this->total_due;
       	$amendment_num = "'" . $this->amendment_num . "'";
        $amendmentdate = $this->amendmentdate ? "'" . $this->amendmentdate  . "'" : '0000-00-00';
       	$amendment_notes = "'" . $this->amendment_notes . "'";
       	$comm = $this->communication? $this->communication:0;
       	$potype = "'" . $this->potype . "'";
        $siteid= "'" . $_SESSION['siteid'] . "'";

        $status = "'Pending'";

           $sql = "select * from po where ponum = $ponum";
           $result = mysql_query($sql);
           if (!(mysql_fetch_row($result))) {
              $sql = "INSERT INTO po (recnum, ponum, wonum, podate, podescr, poamount, link2vendor, status, creation_date, 
                                      tax, shipping, labor, total_due, currency,remarks,
                                      formatnum,formatrev,terms,amendment_num,amendmentdate,amendment_notes,communication,type,siteid)
                  VALUES ($objid, $ponum, $wonum, $podate, $desc, $poamount, $link2vendor, $status, curdate(), 
                          $tax, $shipping, $labor, $total_due, $currency,$remarks,
                          'F7003-S','Rev 0',$terms,$amendment_num, $amendmentdate,$amendment_notes,$comm,$potype,$siteid)";
             // echo "$sql";
              $result = mysql_query($sql);
           // Test to make sure query worked
              if(!$result) die("Insert to PO didn't work..Please report to Sysadmin. " . mysql_error());

            }
           else {
                echo "<table border=1><tr><td><font color=#FF0000>";
               die("PO ID " . $ponum . " already exists. ");
               echo "</td></tr></table>";
            }



        $sql = "update seqnum set nxtnum = $objid where tablename = 'po'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work for PO..Please report to Sysadmin. " . mysql_error());
        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) die("Commit failed for PO Insert..Please report to Sysadmin. " . mysql_error());
        return $objid;
     }

    function updatePO($inpporecnum) {

        $porecnum = "'" . $inpporecnum . "'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $wonum = "'" . $this->wonum . "'";
        $ponum = "'" . $this->ponum . "'";
        $desc = "'" . $this->descr . "'";
        
        $podate = $this->podate ? "'" . $this->podate  . "'" : '0000-00-00';
        $duedate = $this->duedate ? "'" . $this->duedate  . "'" : '0000-00-00';

        $vendor = "'" . $this->vendor . "'";
        $status = "'" . $this->postatus . "'";
        $poamount = $this->poamount;
        $tax = $this->tax ? $this->tax : 0.0;
        $shipping = $this->shipping ? $this->shipping : 0.0;
        $labor = $this->labor ? $this->labor : 0.0;
        $total_due = $this->total_due;
        $currency = "'" . $this->currency . "'";
	    $remarks = "'" . $this->remarks . "'";
	    $terms = "'" . $this->terms . "'";
	    $approval = "'" . $this->approval . "'";
        $approvaldate = $this->approvaldate ? "'" . $this->approvaldate  . "'" : '0000-00-00';
	    $amendment_num = "'" . $this->amendment_num . "'";
        $amendmentdate = $this->amendmentdate ? "'" . $this->amendmentdate  . "'" : '0000-00-00';
       	$amendment_notes = "'" . $this->amendment_notes . "'";
       	$comm = $this->communication? $this->communication:0;
       	$potype = "'" . $this->potype . "'";

        $sql = "update po set podate = $podate,
                              podescr = $desc,
                              wonum = $wonum,
                              link2vendor = $vendor,
                              status = $status,
                              poamount = $poamount,
                              ponum = $ponum,
                              tax = $tax,
                              shipping = $shipping,
                              labor = $labor,
                              total_due = $total_due,
                              currency = $currency,
			                  remarks = $remarks,
			                  terms=$terms,
			                  approval=$approval,
		                      approvaldate=$approvaldate,
		                      amendment_num=$amendment_num,
		                      amendmentdate=$amendmentdate,
                              amendment_notes=$amendment_notes,
                              communication=$comm,
                              type=$potype
                        where recnum = $porecnum";

		   //echo "$sql";
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to PO didn't work..Please report to Sysadmin. " . mysql_error());

     }


     function getPOs() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select p.ponum, p.podate, p.podescr, c.name,
                       p.wonum, p.duedate,p.poamount, p.status, 
                       wo.recnum, wo.wotype, wo.wo2type, p.recnum,
                       p.tax, p.shipping, p.labor, p.total_due, p.currency,p.communication,p.type
                      from company c,po p
                      left join work_order wo on p.wonum = wo.wonum
                      where c.recnum = p.link2vendor
                      order by p.recnum";
		// echo "<br>$sql";
        $result = mysql_query($sql);
        if(!$result) die("Access to PO failed...Please report to SysAdmin. " . mysql_error());
        return $result;
     }


     function getwo($wo)
     {
       $won = $wo;
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql= "select w.wo2type, w.wotype, w.recnum, w.wonum from work_order w
              where w.wonum = $won";
       $result1 = mysql_query($sql);
       return $result1;
    }



function getPosort($cond,$argsort1,$argoffset,$arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder=$argsort1;
        $siteid = $_SESSION['siteid'];
        $usertype = $_SESSION['usertype'];
        $userid = $_SESSION['user'];
        $siteval = "p.siteid ='".$siteid."'";
        if($sortorder=='')
          $sortorder="ponum desc";
       
       if($usertype != 'VEND')
       {
          $sql = "select wo.recnum,p.ponum, p.podate, p.podescr, c.name,
                       p.wonum, p.duedate,p.poamount, p.status,wo.wotype,
                       wo.wo2type, p.recnum, p.tax, p.shipping, p.labor,
                       p.total_due, p.currency,pl.crn,pl.no_of_meterages,
                       pl.no_of_lengths,pl.duedate,pl.accepted_date ,pl.amount,
                       pl.material_spec,pl.material_ref,pl.qty_recd,pl.order_qty,pl.due_date1,pl.due_date2
                       from company c,po_line_items pl, po p
                             left join work_order wo on p.wonum = wo.wonum
                                  where $wcond and
                                        c.recnum = p.link2vendor and
                                        pl.link2po=p.recnum and $siteval
                                        ORDER by p.recnum limit $offset, $limit";
      }
      else
      {
          $sql = "select wo.recnum,p.ponum, p.podate, p.podescr, c.name,
                       p.wonum, p.duedate,p.poamount, p.status,wo.wotype,
                       wo.wo2type, p.recnum, p.tax, p.shipping, p.labor,
                       p.total_due, p.currency,pl.crn,pl.no_of_meterages,
                       pl.no_of_lengths,pl.duedate,pl.accepted_date ,pl.amount,
                       pl.material_spec,pl.material_ref,pl.qty_recd,pl.order_qty,pl.due_date1,pl.due_date2
                       from company c,po_line_items pl,user u,contact
                            cont,po p
                             left join work_order wo on p.wonum = wo.wonum
                                  where $wcond and
                                        c.recnum = p.link2vendor and
                                        pl.link2po=p.recnum 
                                        and cont.recnum = u.user2contact 
                                        and u.userid = '$userid' and
                                        cont.contact2company = c.recnum
                                        ORDER by p.recnum limit $offset, $limit";
      }
// echo $sql;exit;
       $result = mysql_query($sql);
       return $result;
}

function getPocount($cond,$argoffset, $arglimit)
{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $siteid = $_SESSION['siteid'];
        $usertype = $_SESSION['usertype'];
        $userid = $_SESSION['user'];
        $siteval = "p.siteid ='".$siteid."'";
if($usertype != 'VEND')
{
   $sql = "select count(*) as numrows from company c,po_line_items pl,po p
                      left join work_order wo on p.wonum = wo.wonum
                      where $wcond and c.recnum = p.link2vendor and
                      pl.link2po=p.recnum and $siteval
                      limit $offset, $limit";
}
else
{
     $sql = "select count(*) as numrows from company c,po_line_items pl,contact cont ,user u,po p
                      left join work_order wo on p.wonum = wo.wonum
                      where $wcond and c.recnum = p.link2vendor and
                      pl.link2po=p.recnum 
                      and cont.recnum = u.user2contact 
                      and u.userid = '$userid' and
                      cont.contact2company = c.recnum
                      limit $offset, $limit";
}        

        $result  = mysql_query($sql) or die('Po count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows;

}

// function to find out Purchase orders related to specific work Order coded by Jerry George

    function getpo4Wo($argworec) {
        $worecnum=$argworec;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select p.ponum, p.podate, p.podescr, c.name,
                       p.wonum, p.duedate,p.poamount, p.status,
                       wo.recnum, wo.wotype, wo.wo2type, p.recnum
                  from work_order wo, company c,po p,mtm_po_wo m,
                       user u,employee emp
                  where
	               wo.recnum=$worecnum and
	               p.recnum=m.po_recnum and
	               m.wo_recnum=wo.recnum and
                       wo.wo2customer = c.recnum and
                       wo.wo2employee = emp.recnum and
                       wo.condition = 'Open' and
                       u.user2employee = emp.recnum
                  ORDER by p.ponum";
        $result = mysql_query($sql);
        return $result;
     }


     function getVendPOs($userid) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select distinct p.ponum, p.podate, p.podescr, c.name,
                       p.wonum, p.duedate,p.poamount, p.status, p.recnum
                      from po p, company c, contact co, user u
                      where    co.contact2company = p.link2vendor and
                               u.user2contact = co.recnum and
                               u.userid = '$userid' and
                           c.recnum = p.link2vendor";
                           
        $result = mysql_query($sql);
        if(!$result) die("Access to PO failed...Please report to SysAdmin. " . mysql_error());
        return $result;
     }

    function getPODetails($inpporecnum) {
        $porecnum = "'" . $inpporecnum . "'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select p.ponum, p.podate, p.podescr, c.name,
                       p.duedate, p.wonum,p.poamount, p.status,
                       p.link2vendor,p.recnum,
                       wo.recnum, wo.wotype, wo.wo2type, p.tax, p.shipping, p.labor, 
                       p.total_due,
                       c.addr1, c.addr2, c.city, c.state, c.zipcode, 
                       c.country, p.currency,formatnum,formatrev,
                       c.phone, c.fax,p.remarks,p.terms,p.approval,p.approvaldate,p.amendment_num,
                       p.amendmentdate,p.amendment_notes,p.communication,p.type
                      from company c, po p
                      left join work_order wo on p.wonum = wo.wonum
                      where c.recnum = p.link2vendor
                      and   p.recnum = $porecnum";

       // echo "$sql";exit;
        $result = mysql_query($sql);
        if(!$result) die("Access to PO details failed...Please report to SysAdmin. " . mysql_error());
        return $result;

     }

     function deletePO($inpporecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $porecnum = "'" . $inpporecnum . "'";
        $sql = "delete from po where recnum = $porecnum";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Po failed...Please report to SysAdmin. " . mysql_error());
      }


// function to add and delete links in mtm_po_wo table coded by Jerry George

function modifyMtm($argmodify,$argporecnum,$argworecnum)
{
	$modify=$argmodify;
	$porecnum=$argporecnum;
	$worecnum=$argworecnum;
	if($modify=="LinkWO")
	{
	           $sql = "INSERT INTO mtm_po_wo VALUES ($porecnum,$worecnum)";
	}
	else
	{
	           $sql = "DELETE FROM mtm_po_wo WHERE  po_recnum=$porecnum AND wo_recnum=$worecnum";
	}
//echo "$sql";
      	$result = mysql_query($sql);
	if(!$result) die("Update of Work Order failed..Please report to Sysadmin " . mysql_error());

}

    function getwo4Po($cond,$argporecnum,$argoffset,$arglimit) {
        $wcond=$cond;
        $limit=$arglimit;
        $offset=$argoffset;
        $porecnum=$argporecnum;
            $sql = "select w.wonum, w.wotype, c.name, w.po_num,w.quote_num,
                           w.status,w.condition, w.wo2type, emp.fname, emp.lname,
                           w.create_date, w.recnum, w.descr, u.initials,
                           date_format(w.sch_due_date,'%y-%m-%d'),
                           date_format(w.actual_ship_date,'%y-%m-%d')
                           from work_order w, company c, user u, employee emp,po o,mtm_po_wo m
                           where $wcond and
	                      o.recnum=$porecnum and
	                      w.recnum=m.wo_recnum and
	                      m.po_recnum=o.recnum and
                              w.wo2customer = c.recnum and
                              w.wo2employee = emp.recnum and
                              w.condition = 'Open' and
                              u.user2employee = emp.recnum
                           ORDER by w.wonum";
        $result = mysql_query($sql) or die('Get wo for PO failed');
        return $result;
     }
     
     function getwo4printPo($argporecnum) {

        $porecnum=$argporecnum;
            $sql = "select w.wonum, w.wotype, c.name, w.po_num,w.quote_num,
                           w.status,w.condition, w.wo2type, emp.fname, emp.lname,
                           w.create_date, w.recnum, w.descr, u.initials,
                           date_format(w.sch_due_date,'%y-%m-%d'),
                           date_format(w.actual_ship_date,'%y-%m-%d')
                           from work_order w, company c, user u, employee emp,po o,mtm_po_wo m
                           where
	                      o.recnum=$porecnum and
	                      w.recnum=m.wo_recnum and
	                      m.po_recnum=o.recnum and
                              w.wo2customer = c.recnum and
                              w.wo2employee = emp.recnum and
                              w.condition = 'Open' and
                              u.user2employee = emp.recnum
                           ORDER by w.wonum";
        $result = mysql_query($sql) or die('Get wo for PO failed');
        return $result;
     }

     function getlinkedwocount4Po($cond,$argporecnum,$argoffset,$arglimit) {
        $wcond=$cond;
        $limit=$arglimit;
        $offset=$argoffset;
        $porecnum=$argporecnum;
               $sql = "select max(w.recnum) as maxrecno
                           from work_order w, company c, user u, employee emp,po o,mtm_po_wo m
                           where $wcond and
	                      o.recnum=$porecnum and
	                      w.recnum=m.wo_recnum and
	                      m.po_recnum=o.recnum and
                              w.wo2customer = c.recnum and
                              w.wo2employee = emp.recnum and
                              w.condition = 'Open' and
                              u.user2employee = emp.recnum
                           ORDER by w.wonum";
//echo "$sql</br>";
        $result  = mysql_query($sql) or die('WO count query failed');
        return $result;

     }




// function to add work orders related to specific Purchse Order coded by Jerry George Jan-05

   function addwo4Po($cond,$argporecnum,$argoffset,$arglimit) {
        $wcond=$cond;
        $limit=$arglimit;
        $offset=$argoffset;
        $porecnum=$argporecnum;
        $sql= "select wo_recnum  from mtm_po_wo where  po_recnum=$porecnum";
        $result = mysql_query($sql);

        $list ="(";
        if ($myrow=mysql_fetch_row($result))
		$list=$list . $myrow[0] ;
        else
        $list= $list . 0;
        while ($myrow= mysql_fetch_row($result))
        {
		$list= $list . "," . $myrow[0];

        }
        $list =$list . ")";


        $sql1 = "select DISTINCT w.wonum, w.wotype, c.name, w.po_num,w.quote_num,
                           w.status,w.condition, w.wo2type, emp.fname, emp.lname,
                           w.create_date, w.recnum, w.descr, u.initials,
                           date_format(w.sch_due_date,'%y-%m-%d'),
                           date_format(w.actual_ship_date,'%y-%m-%d')
                           from work_order w, company c, user u, employee emp
                           where $wcond and
	                   w.recnum not in $list and
                           w.wo2customer = c.recnum and
                           w.wo2employee = emp.recnum and
                           w.condition = 'Open' and
                           (w.actual_ship_date is NULL || w.actual_ship_date = '0000-00-00' || w.actual_ship_date = '') and
                           u.user2employee = emp.recnum
                           ORDER by w.wonum";

        $result1 = mysql_query($sql1);
        return $result1;
     }

     function getAddwocount4Po($cond,$argporecnum,$argoffset,$arglimit) {
        $wcond=$cond;
        $limit=$arglimit;
        $offset=$argoffset;
        $porecnum=$argporecnum;
        $sql= "select wo_recnum  from mtm_po_wo where  po_recnum=$porecnum";
        $result = mysql_query($sql);

        $list ="(";
        if ($myrow=mysql_fetch_row($result))
		$list=$list . $myrow[0] ;
        else
        $list= $list . 0;
        while ($myrow= mysql_fetch_row($result))
        {
		$list= $list . "," . $myrow[0];

        }
        $list =$list . ")";

        $sql = "select max(w.recnum) as maxrecno
                           from work_order w, company c, user u, employee emp
                           where $wcond and
	                      w.recnum not in $list and
                              w.wo2customer = c.recnum and
                              w.wo2employee = emp.recnum and
                              w.condition = 'Open' and
                              (w.actual_ship_date is NULL || w.actual_ship_date = '0000-00-00' || w.actual_ship_date = '') and
                              u.user2employee = emp.recnum
                           ORDER by w.wonum limit  $offset,$limit";
        $result  = mysql_query($sql) or die('WO count query failed');
        return $result;

     }


     function getWocount4Po($argporecnum) {
        $porecnum = $argporecnum;
               $sql = "select count(*) as numrows
                       from mtm_po_wo where  po_recnum=$porecnum";
//echo "$sql</br>";
        $result  = mysql_query($sql) or die('WO count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows;

     }




} // End po class definition
