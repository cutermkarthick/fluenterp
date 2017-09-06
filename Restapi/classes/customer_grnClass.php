<?
//====================================
// Author: FSI
// Date-written = July 04, 2007
// Filename: grnClass.php
// Maintains the class for GRN
//====================================
// Modifications History
//
//====================================

include_once('classes/loginClass.php');
class customer_grn {
    var
       $grnnum,
       $link2customer,
       $cust_dn,
       $cust_part_no,
       $book_date,
       $cust_po_num,
       $cust_po_date,
       $qty,
       $deliver_to,
       $contact_email,
       $status,
       $drg_iss,
       $part_issue,
       $cos,       
       $qty_recd,
       $qty_disp,
       $qty_corr,
       $approved_by,
       $approved_date,
       $rmtype,
       $rmspec,
       $model_iss,
       $po_line_item,
       $approved,
       $pin_no,
       $remarks,
       $type,
       $notes,
       $worefnum,
       $worefnum_rewqty,
       $cust_amnd_ponum,
       $cust_po_amnd_no,
       $source ;

    // Constructor definition
    function customer_grn() {
        $this->grnnum = '';
        $this->link2customer = '';
        $this->cust_dn = '';
        $this->cust_part_no = '';
        $this->book_date = '';
        $this->cust_po_num;
	      $this->cust_po_date;
		    $this->qty = '';
        $this->deliver_to = '';
        $this->contact_email = '';
        $this->status = '';
        $this->drg_iss = '';
        $this->part_issue = '';
        $this->cos = '';
        $this->qty_recd = '';
        $this->qty_disp = '';
        $this->qty_corr = '';
        $this->approved_by = '';
        $this->approved_date = '';        
        $this->rmtype = '';
        $this->rmspec = '';
        $this->model_iss = '';        
        $this->po_line_item = '';                
        $this->approved = '';    
        $this->pin_no='';
        $this->remarks='';
        $this->type='';
        $this->notes='';
        $this->worefnum='';
        $this->worefnum_rewqty='';
        $this->cust_amnd_ponum='';
        $this->cust_po_amnd_no='';
        $this->source='';

     }


    function getpin_no() {
           return $this->pin_no;
    }
    function setpin_no($pin_no) {
           $this->pin_no = $pin_no;
    }


    
    function getgrnnum() {
           return $this->grnnum;
    }
    function setgrnnum ($grnnum) {
           $this->grnnum = $grnnum;
    }

    function getlink2customer() {
           return $this->link2vendor;
    }
    function setlink2customer ($custrecnum) {
           $this->link2customer = $custrecnum;
    }
    function getcust_dn() {
           return $this->cust_dn;
    }
    function setcust_dn ($cust_dn) {
           $this->cust_dn = $cust_dn;
    }
    function getcust_part_no() {
           return $this->cust_part_no;
    }
    function setcust_part_no ($cust_part_no) {
           $this->cust_part_no = $cust_part_no;
    }
    function getbook_date() {
           return $this->book_date;
    }
    function setbook_date ($book_date) {
           $this->book_date = $book_date;
    }
    function getcust_po_num() {
           return $this->cust_po_num;
    }
    function setcust_po_num ($cust_po_num) {
           $this->cust_po_num = $cust_po_num;
    }
    function getcust_po_date() {
           return $this->cust_po_date;
    }
    function setcust_po_date ($cust_po_date) {
           $this->cust_po_date = $cust_po_date;
    }
    function getqty() {
           return $this->qty;
    }
    function setqty ($qty) {
           $this->qty = $qty;
    }
    function getdeliver_to() {
           return $this->deliver_to;
    }
    function setdeliver_to ($deliver_to) {
           $this->deliver_to = $deliver_to;
    }

    function getcontact_email() {
           return $this->contact_email;
    }
    function setcontact_email ($contact_email) {
           $this->contact_email = $contact_email;
    }

    function getstatus()
    {
        return $this->status;
    }
    function setstatus($status)
    {
        $this->status = $status;
    }

    function getdrg_iss()
    {
        return $this->drg_iss;
    }
    function setdrg_iss($drg_iss)
    {
        $this->drg_iss = $drg_iss;
    }


    function getpart_issue()
    {
        return $this->part_issue;
    }
    function setpart_issue($part_issue)
    {
        $this->part_issue = $part_issue;
    }



    function getcos()
    {
        return $this->cos;
    }
    function setcos($cos)
    {
        $this->cos = $cos;
    }



    function getqty_corr() {
           return $this->qty_corr;
    }
    function setqty_corr($qty_corr) {
           $this->qty_corr = $qty_corr;
    }


    function getqty_disp() {
           return $this->qty_disp;
    }
    function setqty_disp($qty_disp) {
           $this->qty_disp = $qty_disp;
    }    


    function getapproved_by() {
           return $this->approved_by;
    }
    function setapproved_by($approved_by) {
           $this->approved_by = $approved_by;
    }   

    function getapproved() {
         return $this->approved;
    }
    function setapproved($approved) {
           $this->approved = $approved;
    } 



    function getapproved_date() {
           return $this->approved_date;
    }
    function setapproved_date($approved_date) {
           $this->approved_date = $approved_date;
    }    


    function getrmtype() {
           return $this->rmtype;
    }
    function setrmtype($rmtype) {
           $this->rmtype = $rmtype;
    }    



    function getrmspec() {
           return $this->rmspec;
    }
    function setrmspec($rmspec) {
           $this->rmspec = $rmspec;
    }  


    function getmodel_iss() {
           return $this->model_iss;
    }
    function setmodel_iss($model_iss) {
           $this->model_iss = $model_iss;
    }  


    function getpo_line_item() {
           return $this->po_line_item;
    }
    function setpo_line_item($po_line_item) {
           $this->po_line_item = $po_line_item;
    }      


    function getremarks() {
           return $this->remarks;
    }
    function setremarks($remarks) {
           $this->remarks = $remarks;
    }       


    function gettype()
    {
        return $this->type;
    }
    function settype($type)
    {
        $this->type = $type;
    }

    function getnotes()
    {
        return $this->notes;
    }
    function setnotes($notes)
    {
        $this->notes = $notes;
    }
    function getworefnum()
    {
        return $this->worefnum;
    }
    function setworefnum($worefnum)
    {
        $this->worefnum = $worefnum;
    }

    function getworefnum_rewqty()
    {
        return $this->worefnum_rewqty;
    }

    function setworefnum_rewqty($worefnum_rewqty)
    {
        $this->worefnum_rewqty = $worefnum_rewqty;
    }

    function setcust_amnd_ponum($cust_amnd_ponum)
    {
        $this->cust_amnd_ponum = $cust_amnd_ponum;
    }

    function setcust_po_amnd_no($cust_po_amnd_no)
    {
        $this->cust_po_amnd_no = $cust_po_amnd_no;
    }

    function setsource($source)
    {
        $this->source = $source;
    }

    function add_customer_grn() {
        
      

        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select nxtnum from seqnum where tablename = 'customer_grn' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $link2customer = $this->link2customer;
        $cust_dn = "'" . $this->cust_dn . "'";
        $cust_part_no = "'" . $this->cust_part_no . "'";
        $book_date = "'" . $this->book_date . "'";
        $cust_po_num = "'" . $this->cust_po_num . "'";
        $cust_po_date = "'" . $this->cust_po_date . "'";
        $qty = $this->qty ;
        $deliver_to = $this->deliver_to ;
        $contact_email = "'" . $this->contact_email . "'";
        $drg_iss = "'" . $this->drg_iss . "'";
        $part_issue = "'" . $this->part_issue . "'";
        $cos = "'" . $this->cos . "'";
        $qty_corr = "'" . $this->qty_corr . "'";
        $qty_disp = "'" . $this->qty_disp . "'";
        $model_iss = "'" . $this->model_iss . "'";
        $rmtype = "'" . $this->rmtype . "'";
        $rmspec = "'" . $this->rmspec . "'";
        $po_line_item = "'" . $this->po_line_item. "'";
        $status = "'" . $this->status. "'";
        $pin_no = "'" . $this->pin_no. "'";
        $remarks = "'" . $this->remarks. "'";

        $type = "'" . $this->type. "'";
        $worefnum = "'" . $this->worefnum. "'";
        $worefnum_rewqty = "'" . $this->worefnum_rewqty. "'";

        $grnnumval = $objid;
        $grnnum = str_pad($grnnumval, 5, '0', STR_PAD_LEFT);
        $this->grnnum = "J" . $grnnum;
        $grnnum="'".'J'.$grnnum."'";

        $cust_amnd_ponum = "'" . $this->cust_amnd_ponum. "'";
        $cust_po_amnd_no = "'" . $this->cust_po_amnd_no. "'";
        $source = "'" . $this->source. "'";

        // print_r($deliver_to); exit;

       $sql = "select * from customer_grn where cust_dn = $cust_dn and type != 'Rework' and status != 'Cancelled' ";
        // echo "$sql "; exit;
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) 
        {

           $sql = "INSERT INTO
                        customer_grn
                           (
                            grnnum,
                            link2customer,
                            cust_dn,
                            cust_part_no,
                            book_date,
                            cust_po_num,
                            cust_po_date,
                            qty,
                            deliver_to,
                            contact_email,
                            created_date,
                            status,
                            drg_issue,
                            part_issue,
                            cos,
                            qty_corr,
                            qty_disp,
                            model_iss,
                            rmtype,
                            rmspec,
                            po_line_item,
                            pin_no,
                            remarks,
                            type,
                            worefnum,
                            worefnum_rewqty,
                            cust_amnd_ponum,
                            cust_po_amnd_no,
                            source
                           )
                     VALUES
                           (
                            $grnnum,
                            $link2customer,
                            $cust_dn,
                            $cust_part_no,
                            $book_date,
                            $cust_po_num,
                            $cust_po_date,
                            $qty,
                            $deliver_to,
                            $contact_email,
                            NOW(),
                            $status,
                            $drg_iss,
                            $part_issue,
                            $cos,                            
                            $qty_corr,
                            $qty_disp,
                            $model_iss,
                            $rmtype,
                            $rmspec,
                            $po_line_item,
                            $pin_no,
                            $remarks,
                            $type,
                            $worefnum,
                            $worefnum_rewqty,
                            $cust_amnd_ponum,
                            $cust_po_amnd_no,
                            $source

                            )";
          
            // echo "$sql <br>";     exit;
            
           $result = mysql_query($sql);
           if(!$result)
           {
	         //$sql = "rollback";
             $result = mysql_query($sql);
	         die("Insert to Customer Grn didn't work..Please report to Sysadmin. " . mysql_error());
           }
           
           
        $sql = "update seqnum set nxtnum = $objid where tablename = 'customer_grn'";
        //echo $sql . '<br>';
        $result = mysql_query($sql);
        if(!$result) die("Seqnum update for Customer Grn failed..Please report to Sysadmin. " . mysql_error());
           
         return $objid;
      }

      else
      {

        if(!$result) die("DN already exists");
        return "failed";
      }
    }
         
    
  function getgrns($cond,$argoffset,$arglimit) {    
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $offset = $argoffset;
       $limit = $arglimit;

       // echo "cond $cond";

       $sql = "select cg.recnum,
                      cg.grnnum,
                      c.name,
                      cg.cust_part_no,
                      cg.cust_po_num,
                      cg.book_date,
                      cg.status,
                      cg.qty,
                      cg.qty_corr,
                      cg.qty_disp,
                      cg.pin_no,
                      cg.approved,
                      qty_used
                FROM customer_grn cg, company c
                 $cond
                      cg.link2customer = c.recnum
                order by cg.grnnum
                limit $offset, $limit";
       // echo "$sql";
      $result = mysql_query($sql);
      if(!$result) die("getgrns query failed..Please report to Sysadmin. " . mysql_error());   
      return $result;

     }
    
      function getgrncount($cond,$argoffset,$arglimit) {
        $userid = "'" . $_SESSION['user'] . "'";
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;

             $sql = "select count(*) as numrows
                       FROM customer_grn cg, company c
                  $wcond
                 cg.link2customer = c.recnum
                 limit $offset, $limit";

        // echo "<br>$sql<br>";
        $result  = mysql_query($sql) or die('grn count query failed ' . mysql_error());
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
     //echo "<br>$numrows<br>";
        return $numrows;
     }

      function getgrn_details($grnrecnum) {
     //echo "$grnrecnum";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = " select cg.recnum,
                        cg.grnnum,
                        c.name,
                        cg.cust_dn,
                        cg.cust_part_no,
                        cg.book_date,
                        cg.cust_po_num,
                        cg.cust_po_date,
                        cg.qty,
                        cg.contact_email,
                        cg.status,
                        cg.deliver_to,
                        cg.link2customer,
                        cg.qty_corr,
                        cg.qty_disp,
                        cg.drg_issue,
                        cg.part_issue,
                        cg.cos,
                        cg.model_iss,
                        cg.rmtype,
                        cg.rmspec,
                        cg.po_line_item,
                        cg.approved_by,
                        cg.approved_date,
                        cg.approved,
                        cg.pin_no,
                        cg.remarks,
                        cg.type,
                        cg.worefnum,
                        cg.woref_rewqty,
                        cg.cust_amnd_ponum,
                        cg.cust_po_amnd_no

            FROM customer_grn cg, company c
            where cg.recnum = $grnrecnum and
                  cg.link2customer = c.recnum ";

         //echo $sql;
        $result = mysql_query($sql);
        if(!$result) die("Getgrn query failed..Please report to Sysadmin. " . mysql_error());   
        return $result;
     }

     function update_customer_grn($grnrecnum) {
        
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $grnnum = "'" . $this->grnnum . "'";
        $link2customer = $this->link2customer;
        $cust_dn = "'" . $this->cust_dn . "'";
        $cust_part_no = "'" . $this->cust_part_no . "'";
        $book_date = "'" . $this->book_date . "'";
        $cust_po_num = "'" . $this->cust_po_num . "'";
        $cust_po_date = "'" . $this->cust_po_date . "'";
        $qty = $this->qty ;
        $deliver_to = $this->deliver_to ;
        $contact_email = "'" . $this->contact_email . "'";
        $status = "'" . $this->status . "'";
        $drg_iss = "'" . $this->drg_iss . "'";
        $part_issue = "'" . $this->part_issue . "'";
        $cos = "'" . $this->cos . "'";
        $model_iss = "'" . $this->model_iss . "'";                                
        $rmtype = "'" . $this->rmtype . "'";                                
        $rmspec = "'" . $this->rmspec . "'";   
        $qty_corr = "'" .$this->qty_corr . "'";   
        $qty_disp ="'" . $this->qty_disp . "'";                                                                
        $po_line_item = "'" . $this->po_line_item . "'";          
        $approved_by = "'" . $this->approved_by . "'"; 
        $approved_date = "'" . $this->approved_date . "'";                 
        $approved = "'" . $this->approved . "'";   
        $pin_no = "'" . $this->pin_no . "'";   
        $remarks = "'" . $this->remarks . "'";   
        $type = "'" . $this->type . "'";   
        $worefnum = "'" . $this->worefnum . "'";   
        $cust_amnd_ponum = "'" . $this->cust_amnd_ponum. "'";
        $cust_po_amnd_no = "'" . $this->cust_po_amnd_no. "'";


         $sql = "UPDATE customer_grn SET
                    grnnum = $grnnum,
                    link2customer = $link2customer,
                    cust_dn = $cust_dn,
                    cust_part_no = $cust_part_no,
                    book_date = $book_date,
                    cust_po_num = $cust_po_num,
                    cust_po_date = $cust_po_date,
                    qty = $qty,
                    deliver_to = $deliver_to,
                    contact_email = $contact_email,
                    status = $status,
                    drg_issue =$drg_iss,
                    part_issue =$part_issue,
                    cos =$cos,
                    model_iss =$model_iss,
                    rmtype = $rmtype,
                    rmspec =$rmspec,
                    qty_corr =$qty_corr,
                    qty_disp =$qty_disp,
                    po_line_item= $po_line_item,
                    approved_by=$approved_by,
                    approved_date=$approved_date,
                    approved=$approved,
                    pin_no=$pin_no,
                    remarks=$remarks,
                    type=$type,
                    worefnum=$worefnum,
                    cust_amnd_ponum = $cust_amnd_ponum,
                    cust_po_amnd_no = $cust_po_amnd_no
                WHERE
                    recnum = $grnrecnum";
        // echo $sql;
        $result = mysql_query($sql);
          if(!$result)
           {
        //$sql = "rollback";
        $result = mysql_query($sql);
        die("Update to grn failed ..Please report to Sysadmin. " . mysql_error());
           }
        // $sql = "commit";
         $result = mysql_query($sql);
         if(!$result)
         {
         //$sql = "rollback";
         $result = mysql_query($sql);
         die("Commit Failed for GRN..Please report to Sysadmin. " . mysql_errno());
         }
    }

    function getdeliverto4_custgrn($cid){
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select recnum,
                       name
                from company
                where recnum = $cid";

        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        return $myrow;
    }

    function get_pindetails($pinno,$custponum,$linenum)
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select drgiss, partiss, rmtype, rmspec, model_iss,cos_iss,
                soli.qty_for_grn, soli.qty
                from sales_order so,  so_line_items soli
                where so.recnum = soli.link2so and
                      so.po_num ='$custponum' and
                      soli.line_num  = '$linenum' and 
                      soli.pin_num ='$pinno' and so.qa_approved='yes' and so.approved='yes'
                      and so.status ='Open'";
       // echo $sql; exit;
        $result = mysql_query($sql);
        $myrow = mysql_fetch_assoc($result);
        return $myrow;

    }


  function get_MI_details($inpgrnnum)
  {
             $newlogin = new userlogin;
             $newlogin->dbconnect();
             $grnnum = trim($inpgrnnum);

             $sql = "select wo.wonum,wo.book_date,sum(wps.acc),sum(wps.rework),
                          sum(wps.rej),sum(wps.ret),wo.qty
                         from work_order wo
                         left join wo_part_status wps on ((wps.link2wo = wo.recnum) and (wps.stage = 'final' or wps.stage = 'Final' or
                         wps.stage = 'FINAL' or wps.stage = 'fi' or
                         wps.stage = 'FI' or wps.stage = 'Fi'))
                         where
                         wo.grnnum = '$grnnum' and
                         wo.`condition` !='WO Cancelled' and
                         wo.`condition` !='Cancelled'
                    group by wo.wonum
                    order by wo.wonum ";
            //echo "$sql";
            $result = mysql_query($sql);
            if(!$result) die("Get MI details query failed..Please report to Sysadmin. " . mysql_error());
            return $result;
  }


      function get_woqty($grnnum)
      {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $inpgrnnum = trim($grnnum);
         $sql = "select wo.grnnum,sum(wo.qty)
                 from work_order wo
                 where
                      wo.grnnum = '$inpgrnnum' and
                       wo.`condition` !='WO Cancelled' and
                       wo.`condition` !='Cancelled' 
                 group by wo.grnnum";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Get MI details query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }


  function get_woretqty($grnnum)
  {
           $newlogin = new userlogin;
           $newlogin->dbconnect();
         $inpgrnnum = trim($grnnum);
           $sql = "select wo.grnnum,sum(wps.ret)
                         from work_order wo
                         left join wo_part_status wps on ((wps.link2wo = wo.recnum) and (wps.stage = 'final' or wps.stage = 'Final' or
                         wps.stage = 'FINAL' or wps.stage = 'fi' or
                         wps.stage = 'FI' or wps.stage = 'Fi'))
                         where
                             wo.grnnum = '$inpgrnnum' and
                         wo.`condition` !='WO Cancelled'
                   group by wo.grnnum";
          // echo "$sql";
          $result = mysql_query($sql);
          if(!$result) die("Get woretqty query failed..Please report to Sysadmin. " . mysql_error());
          return $result;
  }

  function get_pin_details($pinno)
  {
          $newlogin = new userlogin;
          $newlogin->dbconnect();
           $sql = "select rm_type, rm_spec, drg_issue, cos, part_issue, attachments from 
                    master_data where CIM_refnum ='$pinno' and status = 'Active'";
         //echo "<br>$sql ";
          $result = mysql_query($sql);
          if(!$result) die("Could not get the PIn Details..Please report to Sysadmin. " . mysql_error());
          return $result;
  }


  function addNotes4custgrn($recnum,$notes) {
      $newlogin = new userlogin;
      $newlogin->dbconnect();

      $userid = $_SESSION['user'];
      $userrecnum = $_SESSION['userrecnum'];

      $notes = "'" . $notes . "'";
      $sql = "INSERT INTO cust_grn_notes (custgrn_notes,link2custgrn, link2user,create_date )
             VALUES ($notes, $recnum, $userrecnum, curdate())";
       // echo "$sql"; exit;
      $result = mysql_query($sql);
      if(!$result) die("Insert of Notes didn't work. " . mysql_error());

  }

  function getNotes4custgrn($recnum)
  {
     $newlogin = new userlogin;
      $newlogin->dbconnect();

      $sql = "select cgn.create_date, cgn.custgrn_notes, u.userid
                   from cust_grn_notes cgn, user u, customer_grn cg
                   where cgn.link2custgrn = cg.recnum and
                         cgn.link2user = u.recnum and
                         cg.recnum = $recnum order by cg.recnum";
      // echo "$sql";
      $result = mysql_query($sql);
      return $result;
  }

  
  public function getpodetails4custgrn($pin_no)
  {
    $newlogin = new userlogin;
    $newlogin->dbconnect();

    $sql = "select so.recnum,
                   so.po_num,
                   so.status,
                   so.order_date,
                   soli.pin_num,
                   soli.qty,
                   soli.line_num,
                   soli.recnum as lirecnum,
                   soli.qty_for_grn,
                   so.amendment_num
            from sales_order so, so_line_items soli
            where so.recnum = soli.link2so and
                  so.status = 'Open' and 
                  soli.pin_num = '$pin_no' and
		              soli.qty - soli.qty_for_grn > 0";
    mysql_query('SET SQL_BIG_SELECTS=1');
     // echo "$sql";
    $result = mysql_query($sql);
    return $result;
  }



    function update_qtygrn()
    {
         
      $newlogin = new userlogin;
      $newlogin->dbconnect();

      $cust_po_num = "'" . $this->cust_po_num . "'";
      $qty_corr = "'" .$this->qty_corr . "'"; 
      $po_line_item = "'" . $this->po_line_item . "'";
      $pin_no = "'" . $this->pin_no . "'";

      if ($this->cust_po_amnd_no != "" || $this->cust_po_amnd_no != null) 
      {
        $cust_po_num = "'" . $this->cust_amnd_ponum . "'";
      }
      

      $sql1 ="Update so_line_items set 
                     qty_for_grn = qty_for_grn + $qty_corr 
              where po_num = $cust_po_num and 
                    line_num = $po_line_item and
                    pin_num = $pin_no" ;

      $result1 = mysql_query($sql1);
      if(!$result1) die("Could not update qty for grn" . mysql_error());
          
    }

    public function grncancel_update_qtygrn()
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $cust_po_num = "'" . $this->cust_po_num . "'";
        $qty_corr = "'" .$this->qty_corr . "'"; 
        $po_line_item = "'" . $this->po_line_item . "'";
        $pin_no = "'" . $this->pin_no . "'";

        if ($this->cust_po_amnd_no != "" || $this->cust_po_amnd_no != null) 
        {
          $cust_po_num = "'" . $this->cust_amnd_ponum . "'";
        }

        $sql1 ="Update so_line_items set 
                       qty_for_grn = qty_for_grn - $qty_corr 
                where po_num = $cust_po_num and 
                      line_num = $po_line_item and
                      pin_num = $pin_no" ;

        $result1 = mysql_query($sql1);
        if(!$result1) die("Could not update qty for grn" . mysql_error());
    }

      public function grn_cancel_checkwo($grnnum)
  {
      $newlogin = new userlogin;
      $newlogin->dbconnect();

      $sql = "select w.recnum,
                     w.wonum,
                     g.grnnum
              from work_order w, customer_grn g
              where w.grnnum = '$grnnum' and
                    w.grnnum = g.grnnum and
                    (w.`condition` = 'Open' or w.`condition` = 'Closed') ";
      // echo "$sql";
      $result = mysql_query($sql);
      return $result;
  }


} // End grn class definition 
