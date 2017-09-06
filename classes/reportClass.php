<?
//====================================
// Author: FSI
// Date-written = March 15, 2005
// Filename: reportClass.php
// Maintains the class for all reports
// Revision: v1.0
// Modifications History
//====================================

include_once('loginClass.php');

class report {

     function getWFstages ($inptype) {
        $userid = "'" . $_SESSION['user'] . "'";
        $type = "'" . $inptype . "'";
        if ($_SESSION['usertype'] == 'EMPL')
        {
           if ($_SESSION['userrole'] == 'SU' || $_SESSION['userrole'] == 'SALES')
           {

              $sql = "select status
                       from work_flow_config
                       where type = $type and
                             allow_report_disp = 'Y'
                       order by stage asc
                     ";


           }
        }
        $result = mysql_query($sql);
        return $result;
     }


     function getdates4WO($inpworecnum)
     {
        $worecnum = $inpworecnum;
        $userid = "'" . $_SESSION['user'] . "'";

        if ($_SESSION['usertype'] == 'EMPL')
        {
           if ($_SESSION['userrole'] == 'SU' || $_SESSION['userrole'] == 'SALES')
           {

             $sql = "select date_format(d.completed,'%d %b %y')
                        from dates d, work_flow_config wf
                       where
                            d.link2wo = $worecnum and
                            d.link2wfconfig = wf.recnum and
                            wf.allow_report_disp = 'Y'
                       order by wf.stage asc";
           }
        }
        $result = mysql_query($sql);
        return $result;

     }

     function getWOs ($inptype,$argcond,$argoffset,$arglimit) {
        $userid = "'" . $_SESSION['user'] . "'";
        $offset = $argoffset;
        $limit = $arglimit;
        $cond=$argcond;
        $type = "'" . $inptype . "'";

        if ($_SESSION['usertype'] == 'EMPL')
        {
           if ($_SESSION['userrole'] == 'SU' || $_SESSION['userrole'] == 'SALES')
           {

               $sql = "select w.wonum,c.name, date_format(w.sch_due_date,'%d %b %y'),w.recnum
                        from work_order w, company c
                        where $cond and
		                w.wotype = $type and
                              w.`condition` = 'Open' and
                              w.wo2customer = c.recnum and
                             (w.actual_ship_date is NULL || w.actual_ship_date = '0000-00-00' || w.actual_ship_date = '')
                       order by w.wonum asc limit $offset, $limit";
           }
        }
//echo "$sql";
        $result  = mysql_query($sql) or die('WO query for report failed');
        return $result;

     }

     function getWOs4print ($inptype,$argcond) {
        $userid = "'" . $_SESSION['user'] . "'";
        $cond=$argcond;
        $type = "'" . $inptype . "'";

        if ($_SESSION['usertype'] == 'EMPL')
        {
           if ($_SESSION['userrole'] == 'SU' || $_SESSION['userrole'] == 'SALES')
           {

               $sql = "select w.wonum,c.name, date_format(w.sch_due_date,'%d %b %y'),w.recnum
                        from work_order w, company c
                        where $cond and
		                    w.wotype = $type and
                              w.`condition` = 'Open' and
                              w.wo2customer = c.recnum and
                             (w.actual_ship_date is NULL || w.actual_ship_date = '0000-00-00' || w.actual_ship_date = '')
                       order by w.wonum asc";
           }
        }
//echo "$sql";
        $result  = mysql_query($sql) or die('WO query for report failed');
        return $result;

     }

     function getWOcount ($argoffset,$arglimit,$inptype) {
        $userid = "'" . $_SESSION['user'] . "'";
        $offset = $argoffset;
        $limit = $arglimit;
        $type = "'" . $inptype . "'";

        if ($_SESSION['usertype'] == 'EMPL')
        {
           if ($_SESSION['userrole'] == 'SU' || $_SESSION['userrole'] == 'SALES')
           {

               $sql = "select count(*) as numrows
                        from work_order
                        where wotype = $type and
                              `condition` = 'Open' and
                             (actual_ship_date is NULL || actual_ship_date = '0000-00-00' || actual_ship_date = '')
                       limit $offset, $limit";
           }
        }

        $result  = mysql_query($sql) or die('WO count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];

        return $numrows;

     }

function getbookdates($argmonth,$argyear)
{
	//echo "argmonth:$argmonth<br>";
        $sql="select count(book_date),date_format(book_date,'%b %Y') from work_order where date_format(book_date,'%b') = '$argmonth' && date_format(book_date,'%Y') = '$argyear' group by date_format(book_date,'%b')";
     // echo "<br>$sql<br>";
        $result = mysql_query($sql);
        if(!$result) die("Selet of book date Failed. " . mysql_error());
        return $result;
}


function getbookdates4year($argyears)
{
	//echo "argyears:$argyears<br>";
        $sql="select count(book_date),date_format(book_date,'%Y') from work_order where date_format(book_date,'%Y') = '$argyears' group by date_format(book_date,'%Y')";
       //echo "<br>$sql<br>";
        $result = mysql_query($sql);
        if(!$result) die("Selet of book date Failed. " . mysql_error());
        return $result;
}



 function getCountbookdates()
{
    // $sql="select count(*) as numrows from work_order group by date_format(book_date,'%b')";
    // $sql="select recnum,wonum,book_date from work_order ";

         $sql="select count(*) as numrows from work_order group by date_format(book_date,'%b')";
       // echo "<br>$sql<br>";
       $result  = mysql_query($sql) or die('sbookdates count query failed');
       $row     = mysql_fetch_array($result, MYSQL_ASSOC);
       $numrows = $row['numrows'];
       return $numrows;
}
 function getsheduledates($argmonth,$argyear)
{
        $sql="select count(actual_ship_date),date_format(actual_ship_date,'%b %Y') from work_order where date_format(actual_ship_date,'%b') = '$argmonth' && date_format(actual_ship_date,'%Y') = '$argyear' group by date_format(actual_ship_date,'%b')";
       // echo "<br>$sql<br>";
        $result = mysql_query($sql);
        if(!$result) die("Selet of book date Failed. " . mysql_error());
        return $result;
}
 function getCountsheduledates()
{
        $sql="select count(*) as numrows from work_order group by date_format(book_date,'%b')";
        //echo "<br>$sql<br>";
       $result  = mysql_query($sql) or die('sheduledates count query failed');
       $row     = mysql_fetch_array($result, MYSQL_ASSOC);
       $numrows = $row['numrows'];
       return $numrows;
}

 function getmonths()
{
        $sql="select distinct date_format(book_date,'%b') from work_order group by date_format(book_date,'%b')";
       //echo "<br>$sql<br>";
        $result = mysql_query($sql);
        if(!$result) die("Selet of book date Failed. " . mysql_error());
        return $result;
}

function getyear()
{
        $sql="select distinct date_format(book_date,'%Y') from work_order group by date_format(book_date,'%Y')";
        //$sql="select count(*) as numrows from work_order group by date_format(book_date,'%Y')";
       // $sql="select distinct date_format(book_date,'%Y') from work_order group by date_format(book_date,'%Y')";
       //echo "<br>$sql<br>";
        $result = mysql_query($sql);
        if(!$result) die("Selet of book date Failed. " . mysql_error());
        return $result;
}

function getopenBoards($argmonth)
{
        $sql="select count(wotype),date_format(book_date,'%b') from work_order where wotype='Board' and date_format(book_date,'%b') = '$argmonth' group by date_format(book_date,'%b')";
     //echo "<br>$sql<br>";
        $result = mysql_query($sql);
        if(!$result) die("Selet of book date Failed. " . mysql_error());
        return $result;
}
function getopenSockets($argmonth)
{
        $sql="select count(wotype),date_format(book_date,'%b') from work_order where wotype='Socket' and date_format(book_date,'%b') = '$argmonth' group by date_format(book_date,'%b')";
       // echo "<br>$sql<br>";
        $result = mysql_query($sql);
        if(!$result) die("Selet of book date Failed. " . mysql_error());
        return $result;
}

function getop_crns() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select mc_name,crn,oper_name
                  FROM operator order by oper_name";
        $result = mysql_query($sql);
   //echo "$sql";
        return $result;
     }

     function getops($cond)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select fname,lname,empcode
                  FROM employee where
					   $cond and
					   role='op'";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }

function getcrns($op) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select mc_name,crn,oper_name,wo_num
                  FROM operator op
				where op.oper_name = '$op'";
        $result = mysql_query($sql);
       // echo "$sql";
        return $result;
     }


function getmcmins($mc,$op,$crn,$cond)
    {
    //echo $mc;
    // echo $op;
      $newlogin = new userlogin;
        $newlogin->dbconnect();
       $sql="select recnum from operator where oper_name='$op' and crn='$crn'";
       $result=mysql_query($sql);
       $operrecnum=mysql_fetch_row($result);

       $sql="select recnum from mc_master where crn_num='$crn'";
       $result1=mysql_query($sql);
       $mcrecnum=mysql_fetch_row($result1);
      // echo 'hii ' . $operrecnum[0];

    $sql = "select wo.wonum,oper_mc_usage.oper_name as oper_name,
                      sum(oper_mc_usage.running_time),
                      sum(mc_stage_master.running_time*oper_mc_usage.qty),
                      sum(oper_mc_usage.setting_time),
                      sum(mc_stage_master.setting_time*oper_mc_usage.qty),
                      sum(oper_mc_usage.running_time_mins),
                      sum(mc_stage_master.running_time_mins*oper_mc_usage.qty),
                      sum(oper_mc_usage.setting_time_mins),
                      sum(mc_stage_master.setting_time_mins*oper_mc_usage.qty)
               from work_order wo,master_data md,operator op,mc_master,mc_stage_master
                      left outer join oper_mc_usage on oper_mc_usage.stage_num=mc_stage_master.stage_num
               where  $cond and
		      oper_mc_usage.link2operator=op.recnum and
                      op.crn = md.CIM_refnum
                      and mc_stage_master.link2mc_master=mc_master.recnum
                      and wo.link2masterdata = md.recnum
                      and op.wo_num = wo.wonum
                      and op.crn = mc_master.crn_num
		      and op.oper_name = '$op'
                group by op.oper_name";


     //echo $sql;

        $result = mysql_query($sql);
//echo "$sql";

        return $result;
    }

   function getcrn_details()
    {

  //  echo $mc;
  //  echo $op;
      $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select crn,wo_num
                from operator
                group by wo_num";

       //echo $sql;

        $result = mysql_query($sql);

        return $result;
    }

     function getact_time()
    {

  //  echo $mc;
  //  echo $op;
      $newlogin = new userlogin;
        $newlogin->dbconnect();

       /* $sql = "select op.crn,sum(running_time) as time,op.recnum
                from operator op,oper_mc_usage mc
                where op.recnum=mc.link2operator
                group by op.crn"; */

        $sql=  "select op.crn,sum(mc.running_time) as time,sum(mc_stage_master.running_time * mc.qty) as time1,
                        mc.mc_name,op.wo_num,
                        sum(mc.running_time_mins) as mins1,sum(mc_stage_master.running_time_mins * mc.qty) as mins2
                from operator op,mc_master m, oper_mc_usage mc
                left outer join mc_stage_master on mc_stage_master.stage_num=mc.stage_num
                where op.recnum=mc.link2operator and
                      m.recnum=mc_stage_master.link2mc_master and
                      op.crn = m.crn_num
                group by op.wo_num";
       //echo $sql;

        $result = mysql_query($sql);

        return $result;
    }


    function get_qtys($wonum)
    {

  //  echo $mc;
  //  echo $op;
      $newlogin = new userlogin;
        $newlogin->dbconnect();

       /* $sql = "select op.crn,sum(running_time) as time,op.recnum
                from operator op,oper_mc_usage mc
                where op.recnum=mc.link2operator
                group by op.crn"; */

        $sql=  "select sum(wps.rework) as rework_qty,sum(wps.rej) as rej_qty
                from wo_part_status wps,work_order w, operator op
                where w.wonum='$wonum' and
                      op.wo_num=w.wonum and
                      wps.link2wo = w.recnum
                group by op.wo_num";
       //echo $sql;

        $result = mysql_query($sql);

        return $result;
    }

    function calc_mins($ideal,$actual,$ideal_mins,$actual_mins)
    {
        $ideal = ($ideal * 60) + $ideal_mins;
        $actual = ($actual * 60) + $actual_mins;
        $mins = $actual - $ideal;
        return $mins;
    }

    function calc_efficiency($ideal,$actual,$ideal_mins,$actual_mins)
    {

        $totideal = ($ideal * 60) + $ideal_mins;
        $totactual = ($actual * 60) + $actual_mins;
        $eff = ($totideal/$totactual)*100;
        return $eff;
    }
/*
// Modofied on Aug 26, 08;
// Query modified to user op.oper_name in where clause instead of
//  oper_mc_usage.oper_name
    function getopdrilldown($op,$cond)
    {
      //echo '$cond'.$cond;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select
                     op.crn,
                     op.st_date,
                     op.shift,
                     sum((oper_mc_usage.running_time*60)+oper_mc_usage.running_time_mins),
                     sum((mc_stage_master.running_time*oper_mc_usage.qty*60)+(mc_stage_master.running_time_mins*oper_mc_usage.qty)),
                     sum((mc_stage_master.running_time*oper_mc_usage.qty*60)+(mc_stage_master.running_time_mins*oper_mc_usage.qty))-sum((oper_mc_usage.running_time*60)+oper_mc_usage.running_time_mins),
                     op.wo_num,
                     sum((oper_mc_usage.setting_time*60)+oper_mc_usage.setting_time_mins),
                     sum((mc_stage_master.setting_time*oper_mc_usage.qty*60)+(mc_stage_master.setting_time_mins*oper_mc_usage.qty)),
                     sum((mc_stage_master.setting_time*oper_mc_usage.qty*60)+(mc_stage_master.setting_time_mins*oper_mc_usage.qty))-sum((oper_mc_usage.setting_time*60)+oper_mc_usage.setting_time_mins),
                     sum(oper_mc_usage.running_time_mins),
                     sum(mc_stage_master.running_time_mins*oper_mc_usage.qty),
                     sum(oper_mc_usage.running_time_mins)-sum(mc_stage_master.running_time_mins*oper_mc_usage.qty),
                     sum(oper_mc_usage.setting_time_mins),
                     sum(mc_stage_master.setting_time_mins*oper_mc_usage.qty),
                     sum(oper_mc_usage.setting_time_mins)-sum(mc_stage_master.setting_time_mins*oper_mc_usage.qty),
                     oper_mc_usage.stage_num,oper_mc_usage.qty, op.mc_name,
                     (oper_mc_usage.idle_time*60+oper_mc_usage.idle_time_mins),
                     oper_mc_usage.qty_rej,
                     sum((oper_mc_usage.markup_time*60)+oper_mc_usage.markup_time_mins),
                     sum((oper_mc_usage.markdown_time*60)+oper_mc_usage.markdown_time_mins)
               from operator op,  mc_master,work_order wo,mc_stage_master
               left outer join oper_mc_usage on oper_mc_usage.stage_num=mc_stage_master.stage_num
               where $cond and
                    op.oper_name='$op' and
                    mc_master.crn_num = op.crn and
                    mc_stage_master.link2mc_master=mc_master.recnum and
                    op.recnum = oper_mc_usage.link2operator and
                    op.wo_num = wo.wonum
               group by op.st_date,op.shift,oper_mc_usage.stage_num,op.crn,wo.wonum
               order by op.st_date,op.shift,oper_mc_usage.stage_num";
             // echo $sql;
             // echo'-----';
               $result = mysql_query($sql);
       if(!$result) die("Query failed for Drilldown Operator eff. " . mysql_error());
       return $result;
     }
*/

// Developed by BM on July 1,2008
// Used by WO Status report
// March 30, 2010 - Stored wopartstatus as prev because temporarily we
// had to remove the Cust PO match for wopartstatus so that CIM can get
// their stock correctly...will have to revert back to this after correction.
function wopartstatus_prev ($cond,$argoffset,$arglimit)
     {
         $wcond = $cond;
         $offset= $argoffset;
         $limit= $arglimit;
         $sql = "select c.name,
                        s.po_num, s.order_date,
                        s.order_date,s.order_date,
                        m.CIM_refnum,
                        w.wonum,
                        w.qty,
			w.comp_qty,
			w.actual_ship_date,
			w.book_date,
                        sum(wps.acc),
                        sum(wps.rework),
                        sum(wps.rej),
                        sum(wps.ret)
                   from company c,
                       sales_order s,
                       master_data m,
                       work_order w,
                       wo_part_status wps
                  where wps.link2wo = w.recnum and
                       (wps.stage = 'final' or wps.stage = 'Final' or
                       wps.stage = 'FINAL' or wps.stage = 'fi' or
                       wps.stage = 'FI' or wps.stage = 'Fi') and
                       $wcond and
                       c.recnum = s.so2customer and
                       w.po_num = s.po_num and
                       w.recnum = wps.link2wo and
                       w.link2masterdata = m.recnum and
					   w.`condition` != 'Cancelled'
                  group by w.wonum
                  order by (w.wonum+0) limit $offset,$limit";
		//echo $sql;
        $result = mysql_query($sql);
       if(!$result) die("Query failed for wopartstatus . " . mysql_error());
       return $result;

     }

function wopartstatus ($cond,$argoffset,$arglimit)
     {
         $wcond = $cond;
         $offset= $argoffset;
         $limit= $arglimit;
         $siteid = $_SESSION['siteid'];
         $userid ="'". $_SESSION['user']."'";
         $usertype = $_SESSION['usertype'];
         $siteval = "w.siteid = '".$siteid."'";
         if($usertype == "EMPL")
         {
             $sql = "select c.name,
                           m.CIM_refnum,
              					   m.CIM_refnum,
              					   m.CIM_refnum,
              					   m.CIM_refnum,
                            m.CIM_refnum,
                            w.wonum,
                            w.qty,
                      			w.comp_qty,
                      			w.actual_ship_date,
                      			w.book_date,
                            sum(wps.acc),
                            sum(wps.rework),
                            sum(wps.rej),
                            sum(wps.ret)
                       from company c,
                           master_data m,
                           work_order w,
                           wo_part_status wps
                      where wps.link2wo = w.recnum and
                           (wps.stage = 'final' or wps.stage = 'Final' or
                           wps.stage = 'FINAL' or wps.stage = 'fi' or
                           wps.stage = 'FI' or wps.stage = 'Fi') and
                           $wcond and
                           w.recnum = wps.link2wo and
    					   w.wo2customer = c.recnum and
                           w.link2masterdata = m.recnum  and
    					   w.`condition` != 'Cancelled' and $siteval
                      group by w.wonum
                      order by (w.wonum+0) limit $offset,$limit";
        }else
        {

               $sql = "select c.name,
                           m.CIM_refnum,
                           m.CIM_refnum,
                           m.CIM_refnum,
                           m.CIM_refnum,
                            m.CIM_refnum,
                            w.wonum,
                            w.qty,
                            w.comp_qty,
                            w.actual_ship_date,
                            w.book_date,
                            sum(wps.acc),
                            sum(wps.rework),
                            sum(wps.rej),
                            sum(wps.ret)
                       from company c,
                           master_data m,
                           work_order w,
                           wo_part_status wps,
                           contact cont,
                           user u 
                      where wps.link2wo = w.recnum and
                           (wps.stage = 'final' or wps.stage = 'Final' or
                           wps.stage = 'FINAL' or wps.stage = 'fi' or
                           wps.stage = 'FI' or wps.stage = 'Fi') and
                           $wcond and
                            w.wo2customer = c.recnum and
                           w.link2masterdata = m.recnum  and
                 w.`condition` != 'Cancelled' and cont.contact2company = c.recnum and u.user2contact = cont.recnum
                 and u.userid = $userid
                      group by w.wonum
                      order by (w.wonum+0) limit $offset,$limit";

        }
		// echo $sql;
        $result = mysql_query($sql);
       if(!$result) die("Query failed for wopartstatus . " . mysql_error());
       return $result;

     }
function wopartstatuscount ($cond)
     {
         $wcond = $cond;
         $siteid = $_SESSION['siteid'];
         $uertype= $_SESSION['usertype'];
         $siteval = "w.siteid = '".$siteid."'";
         if($uertype == 'EMPL')
         {
                $sql = "select c.name,
                            s.po_num, s.order_date,
                            s.order_date,s.order_date,
                            m.CIM_refnum,
                            w.wonum,
                            w.qty,
                      			w.comp_qty,
                      			w.actual_ship_date,
                      			w.book_date,
                            sum(wps.acc),
                            sum(wps.rework),
                            sum(wps.rej),
                            sum(wps.ret)
                       from company c,
                           sales_order s,
                           master_data m,
                           work_order w,
                           wo_part_status wps
                       where wps.link2wo = w.recnum and
                           (wps.stage = 'final' or wps.stage = 'Final' or
                           wps.stage = 'FINAL' or wps.stage = 'fi' or
                           wps.stage = 'FI' or wps.stage = 'Fi') and
                           $wcond and
                           c.recnum = s.so2customer and
                           w.po_num = s.po_num and
                           w.recnum = wps.link2wo and
                           w.link2masterdata = m.recnum
                           and $siteval
                           group by w.wonum
                      order by w.wonum";
                }
                else
                {
                     $sql = "select c.name,
                           m.CIM_refnum,
                           m.CIM_refnum,
                           m.CIM_refnum,
                           m.CIM_refnum,
                            m.CIM_refnum,
                            w.wonum,
                            w.qty,
                            w.comp_qty,
                            w.actual_ship_date,
                            w.book_date,
                            sum(wps.acc),
                            sum(wps.rework),
                            sum(wps.rej),
                            sum(wps.ret)
                       from company c,
                           master_data m,
                           work_order w,
                           wo_part_status wps,
                           contact cont,
                           user u 
                      where wps.link2wo = w.recnum and
                           (wps.stage = 'final' or wps.stage = 'Final' or
                           wps.stage = 'FINAL' or wps.stage = 'fi' or
                           wps.stage = 'FI' or wps.stage = 'Fi') and
                           $wcond and
                            w.wo2customer = c.recnum and
                           w.link2masterdata = m.recnum  and
                 w.`condition` != 'Cancelled' and cont.contact2company = c.recnum and u.user2contact = cont.recnum
                      group by w.wonum
                      order by (w.wonum+0) ";


                }
		// echo $sql;
        $result = mysql_query($sql);
        $numrows = mysql_num_rows($result);
       if(!$result) die("Query failed for count . " . mysql_error());
       //echo $numrows;
       return $numrows;

     }



// Developed by BM on Sep 16,2008
// Used by WO Status Report
     function get_disp4worep($inpwo)
     {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select d.relnotenum, dli.dispatch_qty
               from dispatch d, dispatch_line_items dli
               where  d.recnum = dli.link2dispatch and
                      dli.wonum = '$inpwo' and d.`status` !='Cancelled'";
      // echo $sql;
       $result = mysql_query($sql);
       return $result;
    }

// Developed by BM on July 7,2008
// Used by Product Performance report
     function get_closed_wos($cond)
     {
      $wcond= $cond;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $siteid = $_SESSION['siteid'];
      $siteval = "w.siteid = '".$siteid."'";
      $sql=  "select w.wonum, crn.CIM_refnum, w.comp_qty,
	                 sum(wps.rework) as rework_qty,
	                 sum(wps.rej) as rej_qty
                from wo_part_status wps,work_order w,
                     master_data crn, company c
                where $wcond and
                      w.link2masterdata = crn.recnum and
                      c.recnum = w.wo2customer and
                      wps.link2wo = w.recnum and
		      (wps.stage = 'final' or wps.stage = 'Final' or
                       wps.stage = 'FINAL' or wps.stage = 'fi' or
                       wps.stage = 'FI' or wps.stage = 'Fi')
                       and $siteval
                group by w.wonum";
       // echo $sql;
       $result = mysql_query($sql);
       return $result;
    }

// Developed by BM on July 7,2008
// Used by Product Performance report
     function get_est_time($inpcrn,$inpqty)
     {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
	  $qty = (int)$inpqty;
	  $sql=  "select
	            sum(msm.running_time*60*$qty + msm.running_time_mins*$qty + msm.setting_time*60 + msm.setting_time_mins)
               from mc_master m, mc_stage_master msm
               where  msm.link2mc_master = m.recnum and
                      m.crn_num = '$inpcrn'";
      // echo $sql;
       $result = mysql_query($sql);
       return $result;
    }

// Developed by BM on July 7,2008
// Used by Product Performance report
   function get_act_time($inpwo)
   {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
	  $sql=  "select sum(opmc.running_time*60 + opmc.running_time_mins +
                         opmc.setting_time*60 + opmc.setting_time_mins +
						 opmc.idle_time*60 + opmc.idle_time_mins)
                from operator op, oper_mc_usage opmc
                where op.recnum=opmc.link2operator and
                      op.wo_num = '$inpwo'";
      // echo $sql;
       $result = mysql_query($sql);
       return $result;
   }
/*
// Developed by BM on July 7,2008
// Used by Stock GRN Status report
     function get_stockbygrn($cond,$argoffset,$arglimit)
     {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select grn.grnnum, grn.recieved_date,
                     grn.raw_mat_type, grn.raw_mat_spec,
                     sum(grnli.qty_to_make), grn.crn ,grn.rmbycim
               from grn_li grnli, grn grn
               where $wcond and
                     grn.recnum = grnli.link2grn and
                     grn.rmbycim != '' and
                     grn.rmbycust = ''
               group by grn.grnnum
               order by grn.grnnum
               limit $offset,$limit ";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }
    function getstockgrn_count($cond,$argoffset,$arglimit)
    {
     $wcond = $cond;
     $offset = $argoffset;
     $limit = $arglimit;
      $sql=  "select count(grn.recnum) as
               numrows from grn grn
              where $wcond
              and grn.rmbycim != '' and grn.rmbycust = '' and grn.status = 'Approved'";
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     // echo $sql;
     $result  = mysql_query($sql) or die('stockgrn count query failed');
     $row     = mysql_fetch_array($result, MYSQL_ASSOC);
     $numrows = $row['numrows'];
    // echo $numrows;
     return $numrows;
   }
*/
    function getrmprice($crnnum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select soli.partnum,soli.rmprice,soli.rmprice,soli.rmprice,so.currency
                      from sales_order so, so_line_items soli
                       where
                        so.recnum = soli.link2so and
                        soli.crn_num = '$crnnum'
			limit 1";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
   }


 function get_woqty4stock_grn($grnnum)
 {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "select w.wonum,(w.qty),sum(wps.ret) from work_order w
                       left join wo_part_status wps on ((wps.link2wo = w.recnum) and (wps.stage = 'final' or wps.stage = 'Final' or
                       wps.stage = 'FINAL' or wps.stage = 'fi' or
                       wps.stage = 'FI' or wps.stage = 'Fi'))
                 where w.grnnum='$grnnum' and w.`condition` !='WO Cancelled'
                 group by wps.link2wo
                 order by w.wonum";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Get woqty4stock grn query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
 }

     function get_stockbygrn4totalcost($cond)
     {
      $wcond = $cond;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select grn.grnnum, grn.recieved_date,
                     grn.raw_mat_type, grn.raw_mat_spec,
                     sum(grnli.qty_to_make), grn.crn ,grn.rmbycim
               from grn_li grnli, grn grn
               where $wcond and
                     grn.recnum = grnli.link2grn and
                     (grnli.amendlinenum = ''  or grnli.amendlinenum is null or grnli.amendlinenum = 0 ) and
                     grn.rmbycim != '' and
                     grn.rmbycust = '' and
                     grn.status = 'Approved' and
                     grn.`status` !='Cancelled'
               group by grn.grnnum";
      // echo $sql;
       $result = mysql_query($sql);
       return $result;
     }


     function get_stockbygrn4totalcost_bak($cond)
     {
      $wcond = $cond;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select grn.grnnum, grn.recieved_date, grn.raw_mat_type, grn.raw_mat_spec,
                    sum(gli.qty_to_make),grn.crn,grn.rmbycim,sum(wo.qty),sum(wps.ret)
                 from grn_li gli,
                 grn grn left join work_order wo on grn.grnnum = wo.grnnum
                 left join wo_part_status wps on wps.link2wo = wo.recnum
                   and (wps.stage = 'final' or wps.stage = 'Final' or
                       wps.stage = 'FINAL' or wps.stage = 'fi' or
                       wps.stage = 'FI' or wps.stage = 'Fi')
                 where $wcond and
                       gli.link2grn = grn.recnum and
                       grn.rmbycim != '' and
                       grn.rmbycust = ''
                 group by grn.grnnum";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }


// Developed by BM on Aug 21,2008
// Used by Stock GRN Status report
    function get_woqty($grnnum) {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "select wo.grnnum,sum(wo.qty)
                 from work_order wo
                 where
                      wo.grnnum = '$grnnum' and wo.`condition` !='WO Cancelled'
                 group by wo.grnnum";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Get MI details query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }
// Developed by BM on Aug 21,2008
// Used by Stock GRN Status report
function get_woretqty($grnnum)
{
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "select wo.grnnum,sum(wps.ret)
                       from work_order wo
                       left join wo_part_status wps on ((wps.link2wo = wo.recnum) and (wps.stage = 'final' or wps.stage = 'Final' or
                       wps.stage = 'FINAL' or wps.stage = 'fi' or
                       wps.stage = 'FI' or wps.stage = 'Fi'))
                       where
                           wo.grnnum = '$grnnum'  and wo.`condition` !='WO Cancelled'
                 group by wo.grnnum";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Get MI details query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
}

// Developed by BM on Aug 26,2008
// Used by CRN Cost report
     function get_mccost($mc,$cond)
     {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "select op.mc_name,op.crn,op.st_date,op.shift,
                     sum((mc_stage_master.cost * mc.qty)),
                      mc_stage_master.cost, sum(mc.qty)
                 from operator op,mc_master m, oper_mc_usage mc
                 left outer join mc_stage_master on mc_stage_master.stage_num=mc.stage_num
                 where  $cond and
                      op.recnum=mc.link2operator and
                      m.recnum=mc_stage_master.link2mc_master and
                      op.crn = m.crn_num and
                      op.mc_name = '$mc'
                group by op.mc_name, op.st_date,op.crn,op.shift
                order by op.mc_name, op.st_date, op.shift";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Get MC Cost query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }

// Developed by BM on Sep 5,2008
// Used by Production Shiftwise Record
     function get_prodrecord($mc,$cond)
     {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $siteid = $_SESSION['siteid'];
         $siteval = "op.siteid = '".$siteid."'";
         $sql = "select op.mc_name,
                        op.st_date,
                        op.shift,
                        op.oper_name,
                        op.crn,
                        op.wo_num,
                        op_mc.qty,
                        op_mc.stage_num,
                        op_mc.setting_time,
                        op_mc.setting_time_mins,
                        op_mc.running_time,
                        op_mc.running_time_mins,
                        op_mc.idle_time,
                        op_mc.idle_time_mins,
			                  op.remarks,
                        op_mc.qty_rej

                  FROM operator op, oper_mc_usage op_mc
                  where $cond and
                        op.mc_name = '$mc' and
                        op_mc.link2operator=op.recnum
                        and $siteval
                  order by op.st_date,op.shift,op.oper_name,op_mc.stage_num";
       // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Get Production Record query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }

     function getqasummary4status($cond,$argsort1,$argoffset,$arglimit) {

        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder=$argsort1;

        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,crn,relase_note,qa_date,qty_disp,inspected_by,qty_accp,wonum
                 FROM accp_rating
                 where $wcond order by crn,wonum  limit $offset, $limit";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;

     }


     function getqacount4status($cond,$argoffset, $arglimit)
     {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;

             $sql = "select count(*) as numrows from accp_rating
                      where $wcond limit $offset, $limit";
		//echo $sql;
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $result  = mysql_query($sql) or die('accp_rating count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows;

     }
     function getcrn4effncy($cond) {
    // echo "----".$cond;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select wo.create_date,wo.wonum,(wo.qty),m.CIM_refnum,sum(wps.acc),
                 sum(wps.rej),sum(wps.ret),wo.recnum,sum(wps.rework)
          from work_order wo,master_data m,wo_part_status wps
          where  wo.link2masterdata = m.recnum and wo.recnum = wps.link2wo
          and (wps.stage = 'final' or wps.stage = 'Final' or wps.stage = 'FINAL'
          or wps.stage = 'fi' or  wps.stage = 'FI' or wps.stage = 'Fi')
          and (wo.wo2customer != 0 or wo.wo2customer is not NULL)
          and wo.grnnum != '' and wo.`condition`='Closed' and $cond
          group by m.CIM_refnum";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }

function getwoqty4crneff($crn,$cond) {
        // echo "----".$cond;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select sum(wo.qty),wo.wonum
                from work_order wo,
                     master_data md
                where wo.link2masterdata=md.recnum and
                      md.CIM_refnum='$crn' and
                      wo.`condition`='Closed' and
                      $cond
                 group by md.CIM_refnum;";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }


    function getwodetails4crn_eff($crnnum,$cond) {
        // echo "----".$cond;
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "select wo.wonum,wo.qty,sum(wps.acc),sum(wps.rej),sum(wps.ret),
                        wo.`condition`,wo.book_date,sum(wps.rework)
                   from master_data md,
                        work_order wo
                   left join wo_part_status wps on (wo.recnum=wps.link2wo  and
                        (wps.stage = 'final' or wps.stage = 'Final' or wps.stage = 'FINAL'
                         or wps.stage = 'fi' or  wps.stage = 'FI' or wps.stage = 'Fi'))
                   where wo.link2masterdata = md.recnum and
                       md.CIM_refnum like '$crnnum' and
                       wo.`condition` = 'Closed' and
                       $cond
                 group by wo.wonum
                 order by wo.wonum";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }
/*
     function getsettime4eff($operator,$cond) {
    // echo "----".$cond;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select sum(mcsm.setting_time*60 + mcsm.setting_time_mins),
                        sum(opmc.setting_time*60 + opmc.setting_time_mins)
       from operator op,oper_mc_usage opmc,mc_stage_master mcsm,mc_master mcm
             where $cond
             and op.crn=mcm.crn_num
             and opmc.stage_num=mcsm.stage_num
             and op.recnum = opmc.link2operator
             and (opmc.setting_time >0 or opmc.setting_time_mins>0)
             and mcm.recnum=mcsm.link2mc_master
             and op.oper_name='$operator'
             group by op.oper_name
             order by op.oper_name ";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }
*/
/*
     function geteffdetails($operator,$cond)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select op.crn,opmc.stage_num,opmc.qty,
       sum((opmc.setting_time * 60)+opmc.setting_time_mins),
       sum((((mcsm.setting_time * 60) + mcsm.setting_time_mins)) * opmc.qty),
       sum(((opmc.running_time * 60)+opmc.running_time_mins)+((opmc.markup_time * 60)+opmc.markup_time_mins)-((opmc.markdown_time * 60)+opmc.markdown_time_mins)),
       sum((((mcsm.running_time * 60) + mcsm.running_time_mins)) * opmc.qty)
           from operator op,oper_mc_usage opmc,
       mc_master mc,mc_stage_master mcsm
    where  $cond and op.crn = mc.crn_num and
          opmc.link2operator = op.recnum and
          mcsm.link2mc_master = mc.recnum and
          op.oper_name = '$operator' and
          opmc.stage_num = mcsm.stage_num and
          op.crn = mc.crn_num
    group by op.crn,opmc.stage_num";
        $result = mysql_query($sql);
     //echo "$sql";
        return $result;
     }
*/
     function getstagenum($oper_name,$cond) {
    // echo "----".$cond;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select op.oper_name,op.crn,opmc.stage_num,opmc.qty_rej
             from oper_mc_usage opmc,operator op
             where $cond and
             opmc.qty_rej != 0 and
             op.recnum=opmc.link2operator and
             op.oper_name='$oper_name'";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }

	 /*
      function getmaster_rejtime($crn,$stagenum,$qty_rej) {
    // echo "----".$cond;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select mc.crn_num,mcsm.stage_num,sum((mcsm.running_time*60) + mcsm.running_time_mins )*$qty_rej
             from mc_master mc,mc_stage_master mcsm
             where mc.crn_num ='$crn'
             and mc.recnum=mcsm.link2mc_master
             and mcsm.stage_num <= $stagenum
             and (mcsm.stage_num % 2 != 0)
             group by mc.crn_num";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }
*/
 /*    function getmaster_rejtime4prodn_eff_tab($crn,$stagenum,$qty_rej) {
    // echo "----".$cond;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select mc.crn_num,mcsm.stage_num,sum(((mcsm.running_time*60) + mcsm.running_time_mins )*$qty_rej)
             from mc_master mc,mc_stage_master mcsm
             where mc.crn_num ='$crn'
             and $qty_rej != 0
             and mc.recnum=mcsm.link2mc_master
             and mcsm.stage_num = $stagenum
             group by mc.crn_num,mcsm.stage_num";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }
 */
     function getmaster_rejtime4prodn_eff($crn,$stagenum,$qty_rej) {
    // echo "----".$cond;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select mc.crn_num,mcsm.stage_num,(((mcsm.running_time*60) + mcsm.running_time_mins )*$qty_rej)
             from mc_master mc,mc_stage_master mcsm
             where mc.crn_num ='$crn'
             and mc.recnum=mcsm.link2mc_master
             and mcsm.stage_num = $stagenum
             group by mc.crn_num";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }
/*
      function getsettime4row($op,$cond)
      {
        //echo $cond;

      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select op.st_date,
                     op.crn,
                     op.wo_num,
                     op.shift,
                     sum(mcsm.setting_time*60 + mcsm.setting_time_mins),
                     sum(opmc.setting_time*60 + opmc.setting_time_mins),
                     opmc.stage_num
                from operator op,oper_mc_usage opmc,mc_stage_master mcsm,mc_master mcm
                where $cond
                      and op.crn=mcm.crn_num
                      and opmc.stage_num=mcsm.stage_num
                      and op.recnum = opmc.link2operator
                      and (opmc.setting_time >0 or opmc.setting_time_mins>0)
                      and mcm.recnum=mcsm.link2mc_master
                      and op.oper_name='$op'
               group by op.oper_name,op.st_date, op.shift,opmc.stage_num,op.crn,op.wo_num
               order by op.st_date";
              //echo $sql;
               $result = mysql_query($sql);
       if(!$result) die("Query failed for operator row settime. " . mysql_error());
       return $result;
     }
*/
     function gettime4prodn_eff_tab($mc_name,$cond)
     {
       // echo "----".$cond;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select op.mc_name,op.crn,opmc.stage_num,sum(opmc.qty),
                sum((mcsm.setting_time*60+mcsm.setting_time_mins)*
                    ((opmc.setting_time+opmc.setting_time_mins)/(opmc.setting_time+opmc.setting_time_mins))) as master_settime,
                sum(opmc.setting_time*60 + opmc.setting_time_mins) as oper_settime,
                sum(((opmc.running_time * 60)+opmc.running_time_mins)+((opmc.markup_time * 60)+opmc.markup_time_mins)-((opmc.markdown_time * 60)+opmc.markdown_time_mins)) as oper_runtime,
                sum((((mcsm.running_time * 60) + mcsm.running_time_mins)) * (opmc.qty)) as master_runtime,
                sum(opmc.qty_rej)
                from operator op,oper_mc_usage opmc,
                     mc_master mc,mc_stage_master mcsm
                     where $cond and
                           op.crn = mc.crn_num and
                           opmc.link2operator = op.recnum and
                           mcsm.link2mc_master = mc.recnum and
                           op.mc_name = '$mc_name' and
                           opmc.stage_num = mcsm.stage_num
                           group by op.crn,opmc.stage_num";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }

     function gettime4prodn_eff($mc_name,$cond) {
    // echo "----".$cond;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select op.mc_name,op.crn,opmc.stage_num,opmc.qty,
                ((mcsm.setting_time*60+mcsm.setting_time_mins)*
                ((opmc.setting_time+opmc.setting_time_mins)/(opmc.setting_time+opmc.setting_time_mins))) as master_settime,
                (opmc.setting_time*60 + opmc.setting_time_mins) as oper_settime,
                (((opmc.running_time * 60)+opmc.running_time_mins)+((opmc.markup_time * 60)+opmc.markup_time_mins)-((opmc.markdown_time * 60)+opmc.markdown_time_mins)) as oper_runtime,
                ((((mcsm.running_time * 60) + mcsm.running_time_mins)) * opmc.qty) as master_runtime,
                opmc.qty_rej
                from operator op,oper_mc_usage opmc,
                     mc_master mc,mc_stage_master mcsm
                     where $cond and op.crn = mc.crn_num and
                           opmc.link2operator = op.recnum and
                           mcsm.link2mc_master = mc.recnum and
                           op.mc_name = '$mc_name' and
                           opmc.stage_num = mcsm.stage_num and
                           op.crn = mc.crn_num
                           order by op.crn,opmc.stage_num";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }


 function get_fggoods($cond,$crn)
     {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $assy_crn = substr($crn,2,2);
      if($assy_crn!='A-' && $assy_crn!='')
      {
       $sql=  "select wo.crn_num,wo.po_num,(sum(wo.comp_qty)-sum(wo.dispatch_qty)-sum(wo.assy_qty)) as FG
                     from work_order wo
                     where $wcond  and
                           wo.`condition` !='Hold' and wo.`condition` !='Cancelled'
                     group by wo.crn_num having FG>0
                     order by wo.crn_num ";
            // echo $sql."----1---";
      } else if($assy_crn=='')
      {
        $sql=  "select wo.crn_num as CRN,wo.po_num,(sum(wo.comp_qty)-sum(wo.dispatch_qty)-sum(wo.assy_qty)) as FG
                     from work_order wo
                     where $wcond
                     and wo.`condition` !='Hold' and wo.`condition` !='Cancelled'
                     group by wo.crn_num having FG>0
                     UNION
                     select wo.crn as CRN,wo.ponum,(sum(wo.comp_qty)-sum(wo.dispatch_qty)) as FG
                     from assy_wo wo
                     left join assywo_li a on a.grn=wo.assy_wonum
                     where wo.crn like '$crn%'
                     and  wo.`status` !='Cancelled'
                     and a.grn is null
                     group by wo.crn having FG>0
                     order by CRN";
                     //echo $sql."---in U---";
      }else if($assy_crn=='A-' && $assy_crn!='')
      {
        $sql=  "select wo.crn,wo.ponum,(sum(wo.comp_qty)-sum(wo.dispatch_qty)) as FG
                     from assy_wo wo
                     left join assywo_li a on a.grn=wo.assy_wonum
                     where wo.crn like '$crn%'
                     and  wo.`status` !='Cancelled' and
                     a.grn is null
                     group by wo.crn having FG>0
             order by wo.crn ";
            // echo $sql."---in A---";

      }

      // echo $sql;
       $result = mysql_query($sql);
       return $result;
    }



function get_fggoods_totalcost($cond,$crn)
     {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $assy_crn = substr($crn,2,2);
     if($assy_crn!='A-' && $assy_crn!='')
      {
       $sql=  "select wo.crn_num,wo.po_num,(sum(wo.comp_qty)-sum(wo.dispatch_qty)-sum(wo.assy_qty)) as FG
                     from work_order wo
                     where $wcond
                     and wo.`condition` !='Hold' and wo.`condition` !='Cancelled'
                     group by wo.crn_num having FG>0
             order by wo.crn_num ";
             //echo $sql;
      } else if($assy_crn=='')
      {
        $sql=  "select wo.crn_num as CRN,wo.po_num,(sum(wo.comp_qty)-sum(wo.dispatch_qty)-sum(wo.assy_qty)) as FG
                     from work_order wo
                     where $wcond
                     and wo.`condition` !='Hold' and wo.`condition` !='Cancelled'
                     group by wo.crn_num having FG>0
                     UNION
                     select wo.crn as CRN,wo.ponum,(sum(wo.comp_qty)-sum(wo.dispatch_qty)) as FG
                     from assy_wo wo
                     left join assywo_li a on a.grn=wo.assy_wonum
                     where wo.crn like '$crn%'
                     and  wo.`status` !='Cancelled'
                     and a.grn is null
                     group by wo.crn having FG>0
                     order by CRN";
                     //echo $sql."---in U---";
      }else if($assy_crn=='A-' && $assy_crn!='')
      {
        $sql=  "select wo.crn,wo.ponum,(sum(wo.comp_qty)-sum(wo.dispatch_qty)) as FG
                     from assy_wo wo
                     left join assywo_li a on a.grn=wo.assy_wonum
                     where wo.crn like '$crn%'
                     and  wo.`status` !='Cancelled' and
                     a.grn is null
                     group by wo.crn having FG>0
             order by wo.crn ";
            // echo $sql."---in A---";

      }
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }


function getunit_price($ponum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select soli.price,so.currency from so_line_items soli,sales_order so
                        where so.recnum=soli.link2so
                        and so.po_num = '$ponum'
                        and soli.price != 0
                        limit 1;";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
   }
   
   function getunit_price4fg($crnnum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select (replace(rm.rm_unitprize,'$','')/rm.rm_qty_perbill) as Rate,rm.currency
                        from rmmaster rm
                        where
                        rm.crnnum = '$crnnum'
                        and (rm.rm_status = 'Active' || rm.rm_status = 'Inactive') and
                        (rm.rm_altrm='Primary Spec' || rm.rm_altrm='Alt Spec1' || rm.rm_altrm='Alt Spec2')
						limit 1";
        $result = mysql_query($sql);
       // echo "$sql";
        return $result;
   }

function get_fggoods_count($cond,$argoffset,$arglimit)
  {
     $wcond = $cond;
     $offset = $argoffset;
     $limit = $arglimit;
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     $sql = "select m.CIM_refnum,wo.po_num,sum(wps.acc),(dli.dispatch_qty)
                     from master_data m,wo_part_status wps,work_order wo
             left join dispatch_line_items dli on (dli.wonum=wo.wonum)
                      where $wcond
                      and m.recnum=wo.link2masterdata
                      and wo.recnum=wps.link2wo
                      and (wps.stage = 'final' or wps.stage = 'Final' or
                      wps.stage = 'FINAL' or wps.stage = 'fi' or
                      wps.stage = 'FI' or wps.stage = 'Fi')
                      and wo.`condition`='Closed'
                      group by m.CIM_refnum
             order by m.CIM_refnum";

      //echo $sql;
     $result  = mysql_query($sql);
     $numrows = mysql_num_rows($result);
     return $numrows;
 }

// Added on April2,09 as per CIM requirements
 function getworkinprogress($cond,$argoffset,$arglimit) {
        $wcond = $cond;
        $offset = $argoffset;
        $limit =  $arglimit;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select w.grnnum,
		        m.CIM_refnum,
			w.wonum,
			w.qty,
			sl.price,
			(w.qty*sl.price),
            sl.rmprice,
			(sl.rmprice*w.qty),
			s.currency

                 from work_order w,sales_order s,so_line_items sl,master_data m
                 where w.po_num=s.po_num and sl.link2so=s.recnum and
                        replace(replace(sl.partnum,'-',''),' ','')like replace(replace(w.partnum,'-',''),' ','')
                        and w.`condition`='Open' and m.recnum=w.link2masterdata $wcond
                 group by w.wonum,w.grnnum
				 order by w.crn_num
				 limit $offset,$limit";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
}

function getworkinprogress_exp($cond) {
        $wcond = $cond;
        $offset = $argoffset;
        $limit =  $arglimit;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select w.grnnum,
		        m.CIM_refnum,
			w.wonum,
			w.qty,
			sl.price,
			(w.qty*sl.price),
                        sl.rmprice,
			(sl.rmprice*w.qty),
			s.currency

                 from work_order w,sales_order s,so_line_items sl,master_data m
                 where w.po_num=s.po_num and sl.link2so=s.recnum and
                        replace(replace(sl.partnum,'-',''),' ','')like replace(replace(w.partnum,'-',''),' ','')
                        and w.`condition`='Open' and m.recnum=w.link2masterdata and $wcond
                 group by w.wonum,w.grnnum 
                 order by w.crn_num";
        // echo $sql;
        $result = mysql_query($sql);
        return $result;
}

// Added on Apri2,09 as per CIM requirements
function getworkinprogress_count($cond,$offset,$rowsPerPage)
  {
	$wcond = $cond;
    $offset = $argoffset;
    $limit =  $arglimit;

     $sql = "select count(wonum) as numrows
                  FROM work_order $wcond ";
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     //echo $sql;
     $result  = mysql_query($sql) or die('WorkOrder count query failed');
     $row     = mysql_fetch_array($result, MYSQL_ASSOC);
     $numrows = $row['numrows'];
     return $numrows;
 }
// Added on Apri 3,09 as per CIM requirements
function getcrn_details4report() {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select pal.crn,
                        po.ponum,
                        poli.material_spec,
                       case when (poli.no_of_lengths) = 0 then (poli.no_of_meterages) else (poli.no_of_lengths) end as poqty,
                       grn.grnnum,
                       sum(grn_li.qty_to_make)
               from purchasing_alloc pal,
               po_line_items poli,
              (po left join grn on grn.cimponum=po.ponum and grn.crn = pal.crn)
              left join grn_li on grn_li.link2grn=grn.recnum
               where po.recnum=poli.link2po
               and pal.link2poli=poli.recnum
               group by poli.material_spec
               order by po.ponum";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
   }
function getwo4crn_details($crnnum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select wo.wonum,
                        sum(wps.acc),
                        dli.dispatch_qty
                        from work_order wo,wo_part_status wps,master_data m
                        left join dispatch_line_items dli on (dli.wonum=wo.wonum)
                        where m.CIM_refnum = '$crnnum'
                        and wo.link2masterdata=m.recnum
                        and wo.recnum=wps.link2wo
                        and (wps.stage = 'final' or wps.stage = 'Final' or
                       wps.stage = 'FINAL' or wps.stage = 'fi' or
                       wps.stage = 'FI' or wps.stage = 'Fi')
                       and wo.`condition`='Closed'
                       group by wo.wonum";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
   }



function getqanc4report($cond,$argoffset,$arglimit)
   {
        $offset = $argoffset;
        $limit =  $arglimit;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select  
		                nc.recnum,
                        nc.wonum,
                        nc.refnum,
                        nc.customer,
                        nc.partnum,
                        nc.create_date,
                        nc.dcdate,
                        nc.description,
                        nc.qty,
                        nc.effectiveness,
                        nc.root_cause,
                        nc.corrective_action,
                        nc.preventive_action,
                        nc.inprocess,
                        nc.final_insp,
                        nc.cust_end,
						nc.status,
						nc.accepted,
						nc.rejected,
						nc.quarantined,
						nc.man,
						nc.machine,
						nc.method,
						nc.dim_deviation,
						nc.mat_deviation,
						nc.other_deviation,
                        nc.oper_name,
						GROUP_CONCAT(distinct o.mc_name),
                        nc.rework,
						nc.wotype,
						nc.dn_num,
						nc.oper_name,
						nc.super_name,
						nc.rm_cost,
						nc.cust_ncdate,
						nc.dcnum,
						nc.dcdate,
						nc.cofcnum,
						nc.customer,
						nc.ponum,
						nc.partname,
						nc.bachnum,
						nc.partnum,
						nc.matl_spec,
						nc.part_sl_num,
						nc.issues_ps,
						nc.remarks,
						w.qty
				from work_order w,nc4qa nc
				left join  operator o on nc.wonum = o.wo_num
                 where
                 $cond and w.wonum=nc.wonum
				 group by nc.recnum
                order by nc.recnum
                limit $offset,$limit;";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Query failed for operator row settime. " . mysql_error());
        return $result;
   }

  function getqanc_count($cond,$argoffset,$arglimit)
  {
	$wcond = $cond;
    $offset = $argoffset;
    $limit =  $arglimit;

         $sql = "select 
		                nc.recnum,
                        nc.wonum,
                        nc.refnum,
                        nc.customer,
                        nc.partnum,
                        nc.create_date,
                        nc.dcdate,
                        nc.description,
                        nc.qty,
                        nc.effectiveness,
                        nc.root_cause,
                        nc.corrective_action,
                        nc.preventive_action,
                        nc.inprocess,
                        nc.final_insp,
                        nc.cust_end,
						nc.status,
						nc.accepted,
						nc.rejected,
						nc.quarantined,
						nc.man,
						nc.machine,
						nc.method,
						nc.dim_deviation,
						nc.mat_deviation,
						nc.other_deviation,
                        nc.oper_name,
						GROUP_CONCAT(distinct o.mc_name)
				from nc4qa nc
				left join  operator o on nc.wonum = o.wo_num
                 where
                 $cond
				 group by nc.recnum
                order by nc.recnum";
				$newlogin = new userlogin;
     $newlogin->dbconnect();
     //echo $sql;
     $result  = mysql_query($sql) or die('nc4qa count query failed');
     $numrows = mysql_num_rows($result);
	 //echo "<br>Num rows is $numrows";
     return $numrows;
 }


 function getnc4qa_graph($cond)
 {
         $offset = $argoffset;
         $limit = $arglimit;
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select recnum,refnum,wonum,dim_deviation,man,inprocess,mat_deviation,machine,final_insp,method,cust_end,create_date,other_deviation
                  FROM nc4qa where (status != 'Pending' || status is NULL) and $cond";
         $result = mysql_query($sql);
         //echo $sql;
        if(!$result) die("get QA NC for Chart ..Please report to Sysadmin. " . mysql_error());
        return $result;

 }

 function getnc4qa_chart($cond,$argoffset,$arglimit)
 {
         $offset = $argoffset;
         $limit = $arglimit;
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select recnum,refnum,wonum,dim_deviation,man,inprocess,mat_deviation,machine,final_insp,method,cust_end,create_date,other_deviation,super_name,oper_name
                  FROM nc4qa where (status != 'Pending' || status is NULL) and $cond limit $offset,$limit";
         $result = mysql_query($sql);
         //echo $sql;
        if(!$result) die("get QA NC for Chart ..Please report to Sysadmin. " . mysql_error());
        return $result;

 }

 function nc_chartCount($cond,$argoffset,$arglimit)
  {
     $wcond = $cond;
     $offset = $argoffset;
     $limit = $arglimit;
     $sql=  "select count(recnum) as numrows from nc4qa
                    where (status != 'Pending' || status is NULL) and $wcond  limit $offset,$limit";
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     // echo $sql;
     $result  = mysql_query($sql) or die('nc chart count query failed');
     $row     = mysql_fetch_array($result, MYSQL_ASSOC);
     $numrows = $row['numrows'];
    // echo $numrows;
     return $numrows;
 }

function getcrr_report($cond,$argoffset,$arglimit)
 {
         $offset = $argoffset;
         $limit = $arglimit;
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "SELECT d.crn,d.relnotenum,d.disp_date,dli.dispatch_qty,dli.wonum,dli.recnum
                        from dispatch d,dispatch_line_items dli
                where $cond and d.status !='cancelled'
                      and d.recnum=dli.link2dispatch
                  order by d.relnotenum,dli.recnum
                 limit $offset,$limit";
         $result = mysql_query($sql);
        //echo $sql;
        if(!$result) die("get CRR report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
 }

 function getcrr_report4chart($cond)
 {
         $offset = $argoffset;
         $limit = $arglimit;
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "SELECT d.crn,d.relnotenum,d.disp_date,sum(dli.dispatch_qty),dli.wonum,dli.recnum
                        from dispatch d,dispatch_line_items dli
                where $cond and d.status !='cancelled'
                      and d.recnum=dli.link2dispatch
                group by d.crn
                order by d.crn";
        $result = mysql_query($sql);
        //echo $sql;
        if(!$result) die("get CRR report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
 }


 function getnc4dispatch($cofcnum,$dliwonum)
 {

         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select nc.recnum,nc.qty,nc.wonum,nc.cust_end,nc.cust_ncno
                        from dispatch d
                        left join nc4qa nc on nc.cofcnum=d.relnotenum
                        WHERE nc.wonum='$dliwonum' and
                         nc.cofcnum='$cofcnum' and
                         nc.cust_end='yes'";

         $result = mysql_query($sql);
        //echo $sql;
        if(!$result) die("get NC for dispatch for report Failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
 }



 function getnc4dispatch4chart($crn)
 {

         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select d.crn,nc.recnum,sum(nc.qty),nc.wonum,nc.cust_end,nc.cust_ncno
                        from dispatch d
                        left join nc4qa nc on nc.cofcnum=d.relnotenum
                 WHERE  d.crn='$crn' and
                        nc.cust_end='yes'
                 group by d.crn
                 order by d.crn       ";
    // /echo $sql;

         $result = mysql_query($sql);
            if(!$result) die("get NC for dispatch for chart failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
 }

/*
 function getcrr_report($cond,$argoffset,$arglimit)
 {
         $offset = $argoffset;
         $limit = $arglimit;
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select d.crn,d.relnotenum,dli.dispatch_qty,
                        nc.qty,nc.cust_ncno,
                        d.disp_date,nc.recnum
                        from  dispatch_line_items dli,dispatch d
                        left join nc4qa nc on nc.cofcnum = d.relnotenum and
                                    nc.cust_end = 'yes' and dli.wonum = nc.wonum
                        where $cond and
                              d.recnum=dli.link2dispatch and
                              d.status != 'Cancelled'
                 order by d.relnotenum,d.crn
                 limit $offset,$limit";
         $result = mysql_query($sql);
         //echo $sql;
        if(!$result) die("get CRR report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
 }

 function getcrr_report4chart($cond)
 {
         $offset = $argoffset;
         $limit = $arglimit;
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select d.crn,d.relnotenum,sum(dli.dispatch_qty),
                        sum(nc.qty),nc.cust_ncno,
                        d.disp_date
                        from dispatch d, dispatch_line_items dli
                        left join nc4qa nc on (nc.cofcnum = d.relnotenum and dli.wonum = nc.wonum and
                                    nc.cust_end = 'yes')
                        where $cond and
                              d.recnum=dli.link2dispatch and
                              d.status != 'Cancelled'
                 group by d.crn
                 order by d.crn";
         $result = mysql_query($sql);
         //echo $sql;
        if(!$result) die("Get CRR report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
 }
*/
 function getcrr_Count($cond,$argoffset,$arglimit)
  {
     $wcond = $cond;
     $offset = $argoffset;
     $limit = $arglimit;
     $sql=  "select count(nc.refnum) as numrows from nc4qa nc,
                    dispatch d,dispatch_line_items dli
             where $cond and d.recnum=dli.link2dispatch and nc.cofcnum=d.relnotenum
             limit $offset,$limit";
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     // echo $sql;
     $result  = mysql_query($sql) or die('nc chart count query failed');
     $row     = mysql_fetch_array($result, MYSQL_ASSOC);
     $numrows = $row['numrows'];
    // echo $numrows;
     return $numrows;
 }

 function getcrn_ontime($cond)
 {
         $offset = $argoffset;
         $limit = $arglimit;
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select d.crn,d.disp_date,d.schdate,d.schqty,sum(dli.dispatch_qty)
		         from dispatch d,dispatch_line_items dli
				 where $cond
                 and d.recnum=dli.link2dispatch
                 and (d.schdate != '0000-00-00')
                 group by dli.link2dispatch
                 order by d.crn,d.disp_date";
         $result = mysql_query($sql);
         //echo $sql;
        if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
 }

 function getontime_report4chart($cond)
 {
         $offset = $argoffset;
         $limit = $arglimit;
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select d.crn,d.disp_date,d.schdate,d.schqty,sum(dli.dispatch_qty) from dispatch d,dispatch_line_items dli
                 where d.recnum=dli.link2dispatch
                 and $cond
                 and (d.schdate != '0000-00-00')
                 group by dli.link2dispatch
                 order by d.disp_date";
         $result = mysql_query($sql);
         //echo $sql;
        if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
 }
 function getcofc_report4chart($cond)
 {
         $offset = $argoffset;
         $limit = $arglimit;
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select d.relnotenum,d.disp_date,d.schdate,d.schqty,sum(dli.dispatch_qty) from dispatch d,dispatch_line_items dli
                 where d.recnum=dli.link2dispatch
                 and $cond
                 and d.schdate != '0000-00-00'
                 group by dli.link2dispatch
                 order by d.relnotenum,d.disp_date";
         $result = mysql_query($sql);
         //echo $sql;
        if(!$result) die("get Cofc for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
 }

 function getmachine_summary()
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select mcid,mcname,mcmake,recnum from machine_master";
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
   function getmachinename()
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select mcname from machine_master order by mcname";
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
  function getmachineDetails($recnum)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select mm.date,mm.category,mm.details,mm.link2machine_master,m.mcname,mm.recnum
		        from machine_master m,machine_maintenence mm
				where m.recnum=mm.link2machine_master and m.recnum=$recnum";
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
   function editMainteneceDetails($recnum)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select date,category,details,link2machine_master,recnum
		        from machine_maintenence
				where recnum=$recnum";
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }

   function updatemachine_metainenence($date,$category,$details,$link2master,$recnum)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "update machine_maintenence mm,machine_master m
		        set mm.date='$date',
				mm.category='$category',
				mm.details='$details'
				where link2machine_master='$link2master' and
				     mm.link2machine_master=m.recnum and mm.recnum=$recnum";
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
   function selectmachine_masterdata($id,$name,$make,$cdate)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select recnum
		        from machine_master
				where mcid='$id' and mcname='$name' and mcmake='$make' and create_date='$cdate'";
	//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }

  function insertmachine_masterdata($id,$name,$make,$cdate)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "insert into machine_master(mcid,mcname,mcmake,create_date)
		        values('$id','$name','$make','$cdate')";
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }

   function insertmachine_maintenenece($masterrecnum,$mdate,$category,$details)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "insert into machine_maintenence(date,category,details,link2machine_master)
		        values('$mdate','$category','$details','$masterrecnum')";
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }


function getallCRN4open($crn,$proc)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        //echo $proc."++++";
	    $sql = "select w.recnum,w.crn_num,sum(w.qty)
			      from work_order w
				  where
				   w.crn_num like '$crn%' and
				  (w.actual_ship_date is NULL || 
				    w.actual_ship_date = '0000-00-00' || 
					w.actual_ship_date = '')
				 group by w.crn_num";
	        // echo "----$sql****-----";
	    
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("getallcrn4open report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }


// Replaced the following method on Sep12, 2012 to accomodated for showing CRN in drilldown for "for Assy"
 function getallCRN4closed($crn,$proc)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
       	$assycrn = substr($crn,2,2);
        //echo $proc;
        $treatment=$proc;
         //echo $crn."in query";  left join assywo_li a on a.grn=w.wonum a.grn is null  and
        // echo $treatment;exit;
		$cond=" where m.CIM_refnum ='".$crn."'";
		 		  if ($treatment == 'Treated')
	      {
           $proc = 'and w.treatment = "Treated"';
            $sql = "select m.CIM_refnum,w.wonum,sum(w.comp_qty)
				   from master_data m, work_order w

				   $cond
				   $proc and
				   m.recnum= w.link2masterdata and
		           w.`condition` != 'Cancelled' and w.`condition` != 'Hold' and
                   (w.woclassif = 'Regular' ||w.woclassif = 'Split'||w.woclassif = 'TR'||w.woclassif = 'Rework' || w.woclassif is null || w.woclassif='')
				group by m.CIM_refnum";
//echo $sql;
		  }
		  else if($treatment=='Assembly')
		  {
          
		     $sql="select w1.crn,sum(w1.assyqty), sum(ali.qty_wo)
		     from assy_wo a, assywo_li ali, assy_wo w1
             where
             a.recnum = ali.link2assywo and
             w1.crn like '$crn%' and
	         (w1.actual_ship_date is not NULL && w1.actual_ship_date != '0000-00-00')
             group by w1.crn";
		  /*else
		  {
		    $sql="select w1.crn_num,sum(w1.comp_qty),(select sum(a.qty_wo)
             from assywo_li a,work_order w2,assy_wo aw where w2.wonum = a.grn and a.crn_num4li ='$crn' and
             a.link2assywo=aw.recnum) as assyqty
             from work_order w1 where (w1.woclassif = 'Assembly' ||w1.woclassif = 'Split Assembly'||w1.woclassif = 'TR Assembly')
             and w1.crn_num like '$crn%' and w1.`condition` ='Closed'
             group by w1.crn_num";
             //echo $sql;
		  }*/
      // echo $sql;

		  }
		  else if($treatment=='Untreated')
	      {
           $proc = 'and (w.treatment = "Untreated")';
            $sql = "select m.CIM_refnum,w.wonum,sum(w.comp_qty)
				   from master_data m, work_order w
 				   $cond
				   $proc and
				   m.recnum= w.link2masterdata and
		           w.`condition` != 'Cancelled' and w.`condition` != 'Hold' and
                  (w.comp_qty != '' and w.comp_qty is not NULL and w.comp_qty != 0) and
                  (w.woclassif = 'Regular' ||w.woclassif = 'Split'||w.woclassif = 'TR'||w.woclassif = 'Rework' || w.woclassif is null || w.woclassif='')
				group by m.CIM_refnum";
				//echo $sql."mfr";
          }
		
		/*else
	    {
           if($assycrn !='K-')
           {
             $sql = "select w.crn,w.assy_wonum,sum(w.comp_qty)
				from assy_wo w
				left join assywo_li a on a.grn=w.assy_wonum
                where
 				   w.crn like '$crn%' and
				   (w.actual_ship_date is not NULL && w.actual_ship_date != '0000-00-00' && w.actual_ship_date != '') and
				   a.grn is null
   				   group by w.crn";
           }else
           {
             $sql =
   				   "select w.crn,w.assy_wonum,sum(w.comp_qty)
				from assy_wo w
                where
				   w.crn like '$crn%' and
				   (w.actual_ship_date is not NULL && w.actual_ship_date != '0000-00-00' && w.actual_ship_date != '')
   				   group by  w.crn";
           }

        // echo "here111 $crn".$sql;
        }*/

        // echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("getallCRN4closed report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }






 function getallCRN4closed_old($crn,$proc)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
       	$assycrn = substr($crn,2,2);
        //echo $proc;
        $treatment=$proc;
         //echo $crn."in query";
		$cond=" where m.CIM_refnum ='".$crn."'";
		if ($proc != 'Assembly')
	    {
 		  if ($treatment == 'With Treatment')
	      {
           $proc = 'and w.treatment = "With Treatment"';
            $sql = "select m.CIM_refnum,w.wonum,sum(w.comp_qty)
				   from master_data m, work_order w
				   left join assywo_li a on a.grn=w.wonum
				   $cond
				   $proc and
				   m.recnum= w.link2masterdata and
		           w.`condition` != 'Cancelled' and w.`condition` != 'Hold' and
                  (w.dn_qty_recd != '' and w.dn_qty_recd is not NULL and w.dn_qty_recd != 0) and
                  a.grn is null
				group by m.CIM_refnum";
		  }
		  else if($treatment=='For Assembly')
		  {  if($assycrn =='A-')
		  {
		     $sql="select w1.crn,sum(w1.assyqty), sum(ali.qty_wo)
		     from assy_wo a, assywo_li ali, assy_wo w1
             where
             a.recnum = ali.link2assywo and
             w1.assy_wonum = ali.grn and
             w1.crn like '$crn%' and
	         (w1.actual_ship_date is not NULL && w1.actual_ship_date != '0000-00-00')
             group by w1.crn";
		  }else
		  {
		    $sql="select w1.crn_num,sum(w1.comp_qty),(select sum(a.qty_wo)
             from assywo_li a,work_order w2 where w2.wonum = a.grn and a.crn_num4li ='$crn') as assyqty
             from work_order w1 where (w1.woclassif = 'Assembly' ||w1.woclassif = 'Split Assembly'||w1.woclassif = 'TR Assembly')
             and w1.crn_num like '$crn%' group by w1.crn_num";
		  }

		  }
		  else
	      {
           $proc = 'and (w.treatment = "" or w.treatment = "Manufacture Only" or w.treatment is null)';
            $sql = "select m.CIM_refnum,w.wonum,sum(w.comp_qty)
				   from master_data m, work_order w
				   left join assywo_li a on a.grn=w.wonum
				   $cond
				   $proc and
				   m.recnum= w.link2masterdata and
		           w.`condition` != 'Cancelled' and w.`condition` != 'Hold' and
                  (w.comp_qty != '' and w.comp_qty is not NULL and w.comp_qty != 0) and
                  a.grn is null
				group by m.CIM_refnum";
          }
		}
		else
	    {
           if($assycrn !='K-')
           {
             $sql = "select m.CIM_refnum,w.assy_wonum,sum(w.comp_qty)
				from master_data m, assy_wo w
				left join assywo_li a on a.grn=w.assy_wonum
                where
				   m.CIM_refnum = w.crn and
                   m.CIM_refnum=w.crn  and
				   w.crn like '$crn%' and
				   (w.actual_ship_date is not NULL && w.actual_ship_date != '0000-00-00' && w.actual_ship_date != '') and
				   a.grn is null
   				   group by m.CIM_refnum";
           }else
           {
             $sql =
   				   "select m.CIM_refnum,w.assy_wonum,sum(w.comp_qty)
				from master_data m, assy_wo w
                where
				   m.CIM_refnum = w.crn and
                   m.CIM_refnum=w.crn  and
				   w.crn like '$crn%' and
				   (w.actual_ship_date is not NULL && w.actual_ship_date != '0000-00-00' && w.actual_ship_date != '')
   				   group by m.CIM_refnum";
           }

        // echo "here111 $crn".$sql;
        }

        //echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("getallCRN4closed report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
/*  function getallCRN4all($cond)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select m.recnum,m.CIM_refnum,sum(w.qty)
				from master_data m
				left join work_order w on m.recnum=w.link2masterdata
				$cond
				group by m.CIM_refnum";
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("getallCRN4all report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }  */

   function getallCRN4all($cond,$crn)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
		$assycrn = substr($crn,2,2);
		//echo "assycrn is $assycrn<br>";
		if ($assycrn != 'A-' && $assycrn != 'K-')
	    {
            $sql = "select w.recnum,w.crn_num,sum(w.qty),m.partnum
				from work_order w,master_data m
				$cond and
				m.CIM_refnum = w.crn_num
				group by w.crn_num";
		}
 	    else
	    {
            $sql = "select w.recnum,w.crn,sum(w.assyqty),m.partnum
				from assy_wo w,master_data m
				where w.crn like '$crn%' and m.CIM_refnum = w.crn
				group by w.crn";
	    }
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("getallCRN4all report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }

 function getallCRNDetails($crn,$qty,$proc)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $assycrn = substr($crn,2,2);
		if ($proc == 'Manufacture Only')
	    {
			$proc = 'and (w.treatment = "" or w.treatment = "Manufacture Only" or w.treatment is null)';
			 $sql = "select $qty-sum(dl.dispatch_qty)
				from dispatch d,
				     dispatch_line_items dl,
                     work_order w
				where dl.link2dispatch = d.recnum and
				      d.crn='$crn' and
					  w.wonum = dl.wonum and
					  w.condition != 'Cancelled' and w.`condition` != 'Hold' and
                      d.status != 'Cancelled'
					  $proc  and
  					  (w.woclassif = 'Regular' ||w.woclassif = 'Split'||w.woclassif = 'TR'||w.woclassif = 'Rework' || w.woclassif is null || w.woclassif='')
			group by d.crn
				order by d.crn";
        }

        else if($proc=='Assembly')
        {
        //echo $crn;
        if($assycrn!='K-')
        {
          $sql = "select $qty-sum(dl.dispatch_qty)
				from dispatch d,
				     dispatch_line_items dl,assy_wo w
                     left join assywo_li a on a.grn=w.assy_wonum
				where dl.link2dispatch = d.recnum and
				      d.crn='$crn' and
					  w.assy_wonum = dl.wonum and
                                      d.status != 'Cancelled' and
                                      a.grn is null
                      group by d.crn
				      order by d.crn";
				      //echo $sql;
        } else
          {
                  $sql = "select $qty-sum(dl.dispatch_qty)
				from dispatch d,
				     dispatch_line_items dl,
                     assy_wo w
				where dl.link2dispatch = d.recnum and
				      d.crn='$crn' and
					  w.assy_wonum = dl.wonum and
                      d.status != 'Cancelled'
                      group by d.crn
				      order by d.crn";
				      //echo $sql;
          }
        }
        else
        {   //a.grn is null and
             $proc = 'and w.treatment = "With Treatment"';
             $sql = "select $qty-sum(dl.dispatch_qty)
				from dispatch d,
				     dispatch_line_items dl,
                     work_order w
				where dl.link2dispatch = d.recnum and
				      d.crn='$crn' and
					  w.wonum = dl.wonum and
					  w.condition != 'Cancelled' and w.`condition` != 'Hold' and
                      d.status != 'Cancelled'
					  $proc  and
					  (w.woclassif = 'Regular' ||w.woclassif = 'Split'||w.woclassif = 'TR'||w.woclassif = 'Rework' || w.woclassif is null || w.woclassif='')
				group by d.crn
				order by d.crn";
			//	echo $sql;
	    }

		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("getallCRNDetails failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
   function getallGRNDetails($crn,$qty)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select g.grnnum,sum(gli.qty_to_make)-'$qty'
				from grn g,grn_li gli
				where g.recnum = gli.link2grn and g.crn='$crn'
				group by g.crn
				order by g.crn";
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }

 function getallCRN4Details($crn)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
       	$assycrn = substr($crn,2,2);
        if($assycrn == 'A-' || $assycrn == 'K-')
        {
         if($assycrn != 'K-')
         {
           $sql = "select w.assy_wonum,w.assyqty,null,sum(wo_p.rej)
				 from assy_wo w
                 left join assy_part_status wo_p on w.recnum=wo_p.link2assywo
                 and (wo_p.stage='FINAL' || wo_p.stage='FI' || wo_p.stage='final' || wo_p.stage='Fi')
                 left join assywo_li a on a.grn=w.assy_wonum
                     where w.crn='$crn' and
                          (w.actual_ship_date is NULL || w.actual_ship_date = '0000-00-00' || w.actual_ship_date = '')  and
                          a.grn is null
           		          group by w.assy_wonum
				          order by (w.assy_wonum+0)";
         } else
         {
          $sql = "select w.assy_wonum,w.assyqty,null,sum(wo_p.rej)
				 from assy_wo w
                 left join assy_part_status wo_p on w.recnum=wo_p.link2assywo
                 and (wo_p.stage='FINAL' || wo_p.stage='FI' || wo_p.stage='final' || wo_p.stage='Fi')
                     where w.crn='$crn' and
                          (w.actual_ship_date is NULL || w.actual_ship_date = '0000-00-00' || w.actual_ship_date = '')
           		          group by w.assy_wonum
				          order by (w.assy_wonum+0)";
         }

				//echo $sql;
        }
        else
        {

         $sql = "select w.wonum,w.qty,w.treatment,''
	             from work_order w
				      where w.crn_num='$crn' and
                            w.`condition`='Open' 
           		            group by w.wonum
				            order by (w.wonum+0)";
	        //echo "<br>$sql";
	   }

     // echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("getallCRN4details report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }

   function getallDispatch4Details($crn)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $assycrn = substr($crn,2,2);
        if($assycrn == 'A-' || $assycrn == 'K-')
        {
            if($assycrn != 'K-')
            {
              $sql = "select d.relnotenum,sum(dl.dispatch_qty),
		               dl.wonum as wonum, d.type, w.comp_qty,(w.comp_qty-sum(dl.dispatch_qty))
		        from dispatch d,
				     dispatch_line_items dl,
				     assy_wo w
				     left join assywo_li a on a.grn=w.assy_wonum
		        where dl.link2dispatch = d.recnum and
				      d.crn='$crn' and
					  w.assy_wonum = dl.wonum  and
                     d.status != 'Cancelled' and
                     a.grn is null
                     group by w.assy_wonum
					  order by w.assy_wonum";
            }else
            {
                $sql = "select d.relnotenum,sum(dl.dispatch_qty),
		               dl.wonum as wonum, d.type, w.comp_qty,(w.comp_qty-sum(dl.dispatch_qty))
		        from dispatch d,
				     dispatch_line_items dl,
				     assy_wo w
		        where dl.link2dispatch = d.recnum and
				      d.crn='$crn' and
					  w.assy_wonum = dl.wonum  and
                     d.status != 'Cancelled'
                     group by w.assy_wonum
					  order by w.assy_wonum";
            }

		//echo $sql;
        }
        else
        {
        $sql = "(select d.relnotenum,sum(dl.dispatch_qty),
		                dl.wonum as wonum, w.treatment, w.comp_qty,(w.comp_qty-sum(dl.dispatch_qty))
		        from dispatch d,
				     dispatch_line_items dl,
					 work_order w
      		             where dl.link2dispatch = d.recnum and
				           d.crn='$crn' and
					       w.wonum = dl.wonum  and
					       w.`condition` !='Cancelled' and w.`condition` != 'Hold' and
                          (w.treatment = '' || w.treatment = 'Untreated' || w.treatment is null) and
                           d.status != 'Cancelled'  and
                           (w.woclassif = 'Regular' ||w.woclassif = 'Split'||w.woclassif = 'TR'||w.woclassif = 'Rework' || w.woclassif is null || w.woclassif='')
                           group by w.wonum)

				UNION
				(select d.relnotenum,sum(dl.dispatch_qty),
		                dl.wonum as wonum, w.treatment, w.comp_qty,(w.comp_qty-sum(dl.dispatch_qty))
		          from  dispatch d,
				        dispatch_line_items dl,
					    work_order w
		                where  dl.link2dispatch = d.recnum and
				               d.crn='$crn' and
					           w.wonum = dl.wonum  and
					           w.`condition` !='Cancelled' and w.`condition` != 'Hold' and
					           w.treatment = 'Treated' and
                               d.status != 'Cancelled' and
                               (w.woclassif = 'Regular' ||w.woclassif = 'Split'||w.woclassif = 'TR'||w.woclassif = 'Rework' || w.woclassif is null || w.woclassif='')
                                group by w.wonum)
                      order by (wonum+0)";
		  //echo $sql."<br>";
		}
        $result = mysql_query($sql);
		if(!$result) die("getallDispatch4Details report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
/*    function getallDispatch4Details($crn)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $assycrn = substr($crn,2,2);
        if($assycrn == 'A-')
        {
            $sql = "select d.relnotenum,dl.dispatch_qty,
		               dl.wonum as wonum, d.type, w.comp_qty
		        from dispatch d,
				     dispatch_line_items dl,
				     assy_wo w
		        where dl.link2dispatch = d.recnum and
				      d.crn='$crn' and
					  w.assy_wonum = dl.wonum  and
                     d.status != 'Cancelled'
					  order by w.recnum";
		//echo $sql;
        }
        else
        {
        $sql = "(select d.relnotenum,dl.dispatch_qty,
		                dl.wonum as wonum, w.treatment, w.comp_qty
		        from dispatch d,
				     dispatch_line_items dl,
					 work_order w
					 left join assywo_li a on a.grn=w.wonum
		             where dl.link2dispatch = d.recnum and
				           d.crn='$crn' and
					       w.wonum = dl.wonum  and
					       w.`condition` !='Cancelled' and w.`condition` != 'Hold' and
                          (w.treatment = '' || w.treatment = 'Manufacture Only' || w.treatment is null) and
                           d.status != 'Cancelled' and
                           a.grn is null)

				UNION
				(select d.relnotenum,dl.dispatch_qty,
		                dl.wonum as wonum, w.treatment, w.comp_qty
		          from  dispatch d,
				        dispatch_line_items dl,
					    work_order w
					    left join assywo_li a on a.grn=w.wonum
		                where  dl.link2dispatch = d.recnum and
				               d.crn='$crn' and
					           w.wonum = dl.wonum  and
					           w.`condition` !='Cancelled' and w.`condition` != 'Hold' and
					           w.treatment = 'With Treatment' and
                               d.status != 'Cancelled' and
                               a.grn is null)
                      order by (wonum+0)";
		//echo $sql;
		}
        $result = mysql_query($sql);
		if(!$result) die("getallDispatch4Details report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }*/

 function getCRNNo($crn,$type)
   {
        $type == 'Regular'?$type="!= 'Quarantined'":$type="= 'Quarantined'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select g.grnnum,sum(w.qty),g.crn
				from grn g
				left join work_order w on w.grnnum = g.grnnum and w.`condition` != 'WO Cancelled'
				where g.crn='$crn'
                and g.grntype $type and g.status !='Cancelled'
				group by g.grnnum";
	//	echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
   }

function getallGRN4Details($crn,$grn,$qty,$type)
 {
        $type == 'Regular'?$type="!= 'Quarantined'":$type="= 'Quarantined'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select g.grnnum,g.qtm,(g.qtm-g.qty_used+g.qty_ret)
				from grn g
				where g.crn='$crn' and
                g.grnnum='$grn' and 
				g.grntype $type and 
				g.status !='Cancelled'
				group by g.grnnum
				order by g.grnnum";
	//	echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }


 function getCRN($crn,$type)
  {
        $type == 'Regular'?$type="!= 'Quarantined'":$type="= 'Quarantined'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select g.grnnum,sum(w.qty),g.crn
				from grn g
				left join work_order w on w.grnnum = g.grnnum and
				    w.`condition` != 'WO Cancelled'
				where g.crn='$crn'
                and g.grntype $type and g.status !='Cancelled'
				group by g.grnnum";
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("get CRN for stock report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }


 function gettime4mu_eff_tab($mc_name,$cond)
 {
    // echo "----".$cond;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select op.mc_name,op.crn,opmc.stage_num,sum(opmc.qty),
                        sum((opmc.setting_time*60+opmc.setting_time_mins)*
                        ((opmc.setting_time+opmc.setting_time_mins)/(opmc.setting_time+opmc.setting_time_mins))) as master_settime,
                        sum(opmc.setting_time*60 + opmc.setting_time_mins) as oper_settime,
                        sum(((opmc.running_time * 60)+opmc.running_time_mins)+((opmc.markup_time * 60)+opmc.markup_time_mins)-((opmc.markdown_time * 60)+opmc.markdown_time_mins)) as oper_runtime,
                        sum((((opmc.running_time * 60) + opmc.running_time_mins)) * (opmc.qty)) as master_runtime,
                        sum(opmc.qty_rej),
                        sum((opmc.idle_time * 60)+opmc.idle_time_mins),
                        sum((opmc.breakdown_time * 60)+opmc.breakdown_time_mins),
			            sum((opmc.running_time * 60)+opmc.running_time_mins)
                        from operator op,oper_mc_usage opmc,
                             mc_master mc
                             where $cond and op.crn = mc.crn_num and
                                   opmc.link2operator = op.recnum and
                                
                                   op.mc_name = '$mc_name' 
                                  
                                   group by op.crn,opmc.stage_num";
        $result = mysql_query($sql);
        // echo "$sql";
        return $result;
 }
 function get_stockbygrn_excel($cond)
     {
      $wcond = $cond;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select grn.grnnum, grn.recieved_date,
                     grn.raw_mat_type, grn.raw_mat_spec,
                     sum(grn.qtm), grn.crn ,grn.rmbycim,sum(grn.qty_used),sum(grn.qty_ret)
               from grn grn
               where $wcond and
                     grn.rmbycim != '' and
                     grn.rmbycust = '' and
                     grn.`status` !='Cancelled'
               group by grn.grnnum
               order by grn.grnnum ";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }

function get_prod_shift($wonum)
    {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "select op.mc_name,
                        op.st_date,
                        op.shift,
                        op.oper_name,
                        op.crn,
                        op.wo_num,
                        op_mc.qty,
                        op_mc.stage_num,
                        op_mc.setting_time,
                        op_mc.setting_time_mins,
                        op_mc.running_time,
                        op_mc.running_time_mins,
                        op_mc.idle_time,
                        op_mc.idle_time_mins,
                        op.remarks
                FROM operator op, oper_mc_usage op_mc
                        where
                             op.wo_num = '$wonum' and
                             op_mc.link2operator=op.recnum
                        order by op.st_date,op.shift,op.oper_name,op_mc.stage_num";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Get Production Record shift for performance query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }

	 function getprice4crn($crnnum)
     {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select soli.partnum,soli.price,so.currency
                            from sales_order so, so_line_items soli
                                 where
                                      so.recnum = soli.link2so and
                                      soli.crn_num = '$crnnum'
						              order by soli.price desc
						              limit 1";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
    }

   function getrate4crn($crnnum)
   {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select poli.rate,po.currency
                from po po, po_line_items poli
                where  po.recnum = poli.link2po and
                       poli.crn = '$crnnum' and
                       poli.rate != 0 and
                       poli.rate is not NULL and
                       po.`status` != 'Cancelled'
		       order by poli.rate desc
		       limit 1";
        //echo "$sql";
        $result = mysql_query($sql);
        return $result;
   }


  function getqua_rating($cond,$qtr,$m,$year,$supp)
  {
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select sum(no_of_meterages),sum(no_of_lengths),sum(qty_rej)
                        from po po,po_line_items poli
                 where po.recnum=poli.link2po
                 and MONTH(po.podate) = $m
                 and YEAR(podate) = $year
                 and po.link2vendor = $supp
                 and $cond
                 and po.status != 'Closed'
                 group by MONTH(po.podate)";
         $result = mysql_query($sql);
        //echo $sql;
        if(!$result) die("get Quality rating failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }

  function getdel_rating($cond,$qtr,$m,$year,$supp)
  {
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select avg(poli.delivery_time) from po po,po_line_items poli
                     where po.recnum=poli.link2po
                     and MONTH(po.podate) = $m
                     and YEAR(podate) = $year
                     and po.link2vendor = $supp
                     and $cond
                     and po.status != 'Closed'
                 group by MONTH(po.podate)";
         $result = mysql_query($sql);
        //echo $sql;
        if(!$result) die("get Delivery rating failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }

function getSupp($cond)
  {
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select distinct(po.link2vendor),c.name from po po,company c
                        where c.recnum=po.link2vendor
                              and $cond
                 order by c.name";
         $result = mysql_query($sql);
        //echo $sql;
        if(!$result) die("get Supplier  failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }


 function get_com_rating($qtr,$year,$supp)
  {
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select c.name,po.ponum,po.podate,
                        sum(po.communication),MONTH(po.podate)
                        from po po,company c where c.recnum = po.link2vendor
                        and po.link2vendor = $supp
                        and YEAR(po.podate)= $year
                        and QUARTER(po.podate)= $qtr
                      group by c.name,QUARTER(po.podate)
                      order by c.name";
         $result = mysql_query($sql);
        //echo $sql;
        if(!$result) die("get com rating failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }


function get_rating($qtr,$year,$supp)
{
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select c.name,po.ponum,po.podate,sum(poli.no_of_lengths),sum(no_of_meterages),sum(poli.qty_rej),
                        sum(poli.delivery_time),MONTH(poli.duedate),sum(po.communication) from po po,po_line_items poli,company c
                        where c.recnum = po.link2vendor
                        and po.recnum=poli.link2po
                        and po.link2vendor = $supp
                        and YEAR(poli.duedate)= $year
                        and QUARTER(poli.duedate)= $qtr
                        group by c.name,QUARTER(poli.duedate)
                 order by c.name";
         $result = mysql_query($sql);
        //echo $sql;
        if(!$result) die("get Quality rating failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
}

function get_numRows($cur,$year,$supp)
{
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select count(*) as numrows from po po,po_line_items poli,company c
                        where c.recnum = po.link2vendor
                        and po.recnum=poli.link2po
                        and po.link2vendor = $supp
                        and YEAR(poli.duedate) = $year
                        and QUARTER(poli.duedate) = $cur
                        and (poli.delivery_time != 0 && poli.delivery_time is not NULL)";
         $result = mysql_query($sql);
        //echo $sql;
        if(!$result) die("get numrows rating failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
 }

function get_numRows_com($cur,$year,$supp)
{
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select count(*) as numrows from po po,po_line_items poli,company c
                        where c.recnum = po.link2vendor
                        and po.recnum=poli.link2po
                        and po.link2vendor = $supp
                        and YEAR(poli.duedate) = $year
                        and QUARTER(poli.duedate) = $cur";
         $result = mysql_query($sql);
        //echo $sql;
        if(!$result) die("get numrows for com rating failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
}


  function getdeliverDetails($cond,$argoffset,$arglimit) {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $offset= $argoffset;
         $limit= $arglimit;
         $wcond = $cond;
         //echo $wcond;

         $sql = "select d.recnum,
	                d.dnnum,
                        d.deliver_date,
	                d.crn,
	                d.treated_partnum,
	                d.ponum,
                        d.qty,
	                sum(dli.qty_recd),
		       (d.qty-(CASE when sum(dli.qty_recd) is null THEN 0 ELSE sum(dli.qty_recd) END)) as qrem,
                       d.wonum
                  FROM delivery_note d
			  left join delivery_note_li dli on d.recnum = dli.link2Delivery
		  where
			  (d.status='Open' || d.status is null || d.status='') and
                          $wcond
				  group by d.recnum
				  having qrem > 0
                  order by d.deliver_date limit $offset,$limit";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("getdeliverSummary query failed..Please report to Sysadmin. " . mysql_error());
        return $result;

     }

     function getdeliverDetailsCount($cond,$argoffset,$arglimit) {

        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;

         $sql = "select d.recnum,
		           d.dnnum,
                   d.deliver_date,
			       d.crn,
			       d.treated_partnum,
			       d.ponum,
                   d.qty,
			       sum(dli.qty_recd),
				   (d.qty-(CASE when sum(dli.qty_recd) is null THEN 0 ELSE sum(dli.qty_recd) END)) as qrem
                  FROM delivery_note d
				  left join delivery_note_li dli on d.recnum = dli.link2Delivery
				  where
				  (d.status='Open' || d.status is null || d.status='') and
                  $wcond
				  group by d.recnum
				  having qrem > 0
                  order by d.deliver_date";
				 //echo $sql;
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $result  = mysql_query($sql) or die('assypo count query failed');
		$numrows=mysql_num_rows($result);
		//echo "number of rows is : $numrows";
        return $numrows;

    }
    
    function getdeliverDetails_exp($cond) {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $offset= $argoffset;
         $limit= $arglimit;
         $wcond = $cond;
         //echo $wcond;

         $sql = "select d.recnum,
	                d.dnnum,
                        d.deliver_date,
	                d.crn,
	                d.treated_partnum,
	                d.ponum,
                        d.qty,
	                sum(dli.qty_recd),
		       (d.qty-(CASE when sum(dli.qty_recd) is null THEN 0 ELSE sum(dli.qty_recd) END)) as qrem,
                       d.wonum
                  FROM delivery_note d
			  left join delivery_note_li dli on d.recnum = dli.link2Delivery
		  where
			  (d.status='Open' || d.status is null || d.status='') and
                          $wcond
				  group by d.recnum
				  having qrem > 0
                  order by d.deliver_date ";
      //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("getdeliverDetails_exp query failed..Please report to Sysadmin. " . mysql_error());
        return $result;

     }


 function getVendors() {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $offset= $argoffset;
         $limit= $arglimit;
         $wcond = $cond;
         //echo $wcond;

         $sql = "select recnum, name
                 from company where type = 'VEND' order by name";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("getVendors query failed..Please report to Sysadmin. " . mysql_error());
        return $result;

     }
function getcrnstagenumdata($op,$cond)
{
  $newlogin = new userlogin;
  $newlogin->dbconnect();
  $sql = "select op.crn,opmc.stage_num
                from operator op,oper_mc_usage opmc,
                     mc_master mc,mc_stage_master mcsm
                    where op.crn = mc.crn_num and
                          opmc.link2operator = op.recnum and
                          mcsm.link2mc_master = mc.recnum and
                          opmc.stage_num = mcsm.stage_num   and
                          mc.from_date = '2012-08-01' and mc.to_date ='2020-08-31'
                          and $cond
                          and  op.oper_name = '$op'
                          and (((mcsm.setting_time * 60) + mcsm.setting_time_mins)) !=0 and
                       (((mcsm.running_time * 60) + mcsm.running_time_mins)) !=0
                          group by op.crn
                          order by op.crn";
  $result = mysql_query($sql);
 //echo "$sql";
  return $result;
}
function getcrnstagenum_data($op,$cond)
{
  $newlogin = new userlogin;
  $newlogin->dbconnect();
  $sql = "select op.crn,opmc.stage_num
                from operator op,oper_mc_usage opmc,
                     mc_master mc,mc_stage_master mcsm
                    where op.crn = mc.crn_num and
                          opmc.link2operator = op.recnum and
                          mcsm.link2mc_master = mc.recnum and
                          opmc.stage_num = mcsm.stage_num   and
                          mc.from_date = '2012-08-01' and mc.to_date ='2020-08-31'
                          and $cond
                          and  op.oper_name = '$op'
                          and (((mcsm.setting_time * 60) + mcsm.setting_time_mins)) =0 and
                       (((mcsm.running_time * 60) + mcsm.running_time_mins)) =0
                          group by op.crn
                          order by op.crn";
  $result = mysql_query($sql);
 //echo "$sql";
  return $result;
}


function getrev_crn($op,$cond) {
    // echo "----".$cond;mps.mps_revision
	/*select op.crn,op.wo_num,md.mps_rev,md.mps_rev,mc.recnum,wo.link2mps
                    from operator op,mc_master mc,master_data md,work_order wo
                    left join mps mps on (wo.link2mps=mps.recnum)
                    where op.wo_num = wo.wonum
                    and op.crn = md.CIM_refnum
                    and wo.link2masterdata=md.recnum
                    and mc.crn_num = op.crn
                    and (mc.mps_revision=mps.mps_revision OR mc.mps_revision = md.mps_rev OR mc.mps_revision = '00')
                    and  op.oper_name = '$op'
                    and $cond   and
                    mc.from_date = '2012-08-01' and mc.to_date ='2020-08-31'
                 group by op.crn
                 order by op.crn*/
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select op.crn,op.wo_num,md.mps_rev,md.mps_rev,mc.recnum,wo.link2mps
                    from operator op,mc_master mc,master_data md,work_order wo
                    where op.wo_num = wo.wonum
                    and op.crn = md.CIM_refnum
                    and wo.link2masterdata=md.recnum
                    and mc.crn_num = op.crn
                    and  op.oper_name = '$op'
                    and $cond   and
                    mc.from_date = '2012-08-01' and mc.to_date ='2020-08-31'
                 group by op.crn
                 order by op.crn";
        $result = mysql_query($sql);
       //echo "$sql";
        return $result;
     }

 // modified query - please replace
function geteffdetails($operator,$cond,$rec_arr)
{
        $mc_recnum = implode(",",$rec_arr);
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select op.crn,opmc.stage_num,opmc.qty,
       sum((opmc.setting_time * 60)+opmc.setting_time_mins),
       sum((((mcsm.setting_time * 60) + mcsm.setting_time_mins)) * opmc.qty),
       sum(((opmc.running_time * 60)+opmc.running_time_mins)+((opmc.markup_time * 60)+opmc.markup_time_mins)-((opmc.markdown_time * 60)+opmc.markdown_time_mins)),
       sum((((mcsm.running_time * 60) + mcsm.running_time_mins)) * opmc.qty),
       (((mcsm.setting_time * 60) + mcsm.setting_time_mins)),
       (((mcsm.running_time * 60) + mcsm.running_time_mins)),
       sum(((opmc.running_time * 60) + opmc.running_time_mins)),
       sum(opmc.qty),sum(opmc.qty_rej),op.st_date,op.wo_num,mc.crn_num
           from operator op,oper_mc_usage opmc,
       mc_master mc,mc_stage_master mcsm
       where  $cond and op.crn = mc.crn_num and
          opmc.link2operator = op.recnum and
          mcsm.link2mc_master = mc.recnum and
          op.oper_name = '$operator' and
          mc.recnum in ($mc_recnum) and
          opmc.stage_num = mcsm.stage_num   and
          mc.from_date = '2012-08-01' and mc.to_date ='2020-08-31'  and
          ((((mcsm.setting_time * 60) + mcsm.setting_time_mins))
+(((mcsm.running_time * 60) + mcsm.running_time_mins))) !=0
      group by op.st_date,op.crn,op.wo_num,opmc.stage_num
      order by op.st_date,opmc.stage_num";
      $result = mysql_query($sql);
      //echo "$sql";
      return $result;
}
function geteff_details($operator,$cond,$rec_arr)
{
        $mc_recnum = implode(",",$rec_arr);
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select op.crn,opmc.stage_num,opmc.qty,
       sum((opmc.setting_time * 60)+opmc.setting_time_mins),
       sum((((mcsm.setting_time * 60) + mcsm.setting_time_mins)) * opmc.qty),
       sum(((opmc.running_time * 60)+opmc.running_time_mins)+((opmc.markup_time * 60)+opmc.markup_time_mins)-((opmc.markdown_time * 60)+opmc.markdown_time_mins)),
       sum((((mcsm.running_time * 60) + mcsm.running_time_mins)) * opmc.qty),
       (((mcsm.setting_time * 60) + mcsm.setting_time_mins)),
       (((mcsm.running_time * 60) + mcsm.running_time_mins)),
       sum(((opmc.running_time * 60) + opmc.running_time_mins)),
       sum(opmc.qty),sum(opmc.qty_rej),op.st_date,op.wo_num
           from operator op,oper_mc_usage opmc,
       mc_master mc,mc_stage_master mcsm
       where  $cond and op.crn = mc.crn_num and
          opmc.link2operator = op.recnum and
          mcsm.link2mc_master = mc.recnum and
          op.oper_name = '$operator' and
          mc.recnum in ($mc_recnum) and
          opmc.stage_num = mcsm.stage_num   and
          ((((mcsm.setting_time * 60) + mcsm.setting_time_mins))
+(((mcsm.running_time * 60) + mcsm.running_time_mins))) =0 and
          mc.from_date = '2012-08-01' and mc.to_date ='2020-08-31'
      group by op.st_date,op.crn,opmc.stage_num
      order by op.st_date,opmc.stage_num";
      $result = mysql_query($sql);
     // echo "$sql";
      return $result;
}

function geteffdetails4summary($operator,$cond,$rec_arr)
{
        $mc_recnum = implode(",",$rec_arr);
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select op.crn,opmc.stage_num,opmc.qty,
                       sum((opmc.setting_time * 60)+opmc.setting_time_mins),
                       sum((((mcsm.setting_time * 60) + mcsm.setting_time_mins)) * opmc.qty),
                       sum(((opmc.running_time * 60)+opmc.running_time_mins)+((opmc.markup_time * 60)+opmc.markup_time_mins)-((opmc.markdown_time * 60)+opmc.markdown_time_mins)),
                       sum((((mcsm.running_time * 60) + mcsm.running_time_mins)) * opmc.qty),
                       (((mcsm.setting_time * 60) + mcsm.setting_time_mins)),
                       (((mcsm.running_time * 60) + mcsm.running_time_mins)),
                       sum(((opmc.running_time * 60) + opmc.running_time_mins)),
                       sum(opmc.qty),sum(opmc.qty_rej),op.st_date,op.wo_num
                       from operator op,oper_mc_usage opmc,
                            mc_master mc,mc_stage_master mcsm
                            where  $cond and op.crn = mc.crn_num and
                                   opmc.link2operator = op.recnum and
                                   mcsm.link2mc_master = mc.recnum and
                                   op.oper_name = '$operator' and
                                   mc.recnum in ($mc_recnum) and
                                   opmc.stage_num = mcsm.stage_num  and
                                   mc.from_date = '2012-08-01' and mc.to_date ='2020-08-31'
                                   group by op.st_date,op.crn,opmc.stage_num
                                   order by op.st_date,op.crn";
      $result = mysql_query($sql);
     // echo "$sql";
      return $result;
}

function geteffdetails4crn($operator,$cond,$rec_arr)
{
        $mc_recnum = implode(",",$rec_arr);
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select op.crn,opmc.stage_num,opmc.qty,
                       sum((opmc.setting_time * 60)+opmc.setting_time_mins),
                       sum((((mcsm.setting_time * 60) + mcsm.setting_time_mins)) * opmc.qty),
                       sum(((opmc.running_time * 60)+opmc.running_time_mins)+((opmc.markup_time * 60)+opmc.markup_time_mins)-((opmc.markdown_time * 60)+opmc.markdown_time_mins)),
                       sum((((mcsm.running_time * 60) + mcsm.running_time_mins)) * opmc.qty),
                       (((mcsm.setting_time * 60) + mcsm.setting_time_mins)),
                       (((mcsm.running_time * 60) + mcsm.running_time_mins)),
                       sum(((opmc.running_time * 60) + opmc.running_time_mins)),
                       sum(opmc.qty),sum(opmc.qty_rej),op.st_date,op.wo_num
                       from operator op,oper_mc_usage opmc,
                            mc_master mc,mc_stage_master mcsm
                            where  $cond and op.crn = mc.crn_num and
                                   opmc.link2operator = op.recnum and
                                   mcsm.link2mc_master = mc.recnum and
                                   op.oper_name = '$operator' and
                                   mc.recnum in ($mc_recnum) and
                                   opmc.stage_num = mcsm.stage_num and
                                  mc.from_date = '2012-08-01' and mc.to_date ='2020-08-31'
                                   group by op.crn,opmc.stage_num";
      $result = mysql_query($sql);
     // echo "$sql";
      return $result;
}

// new query
function getallops()
{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select fname,lname,empid
                  FROM employee where
					   role='op'
				   order by fname";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
 }

function getNo_of_days($op,$cond) {
    // echo "----".$cond;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select distinct(op.st_date) from operator op
                     where $cond
                     and op.oper_name = '$op'";
      $result  = mysql_query($sql);
      $numrows = mysql_num_rows($result);
      return $numrows;
     }

function getmaster_rejtime($crn,$stagenum,$qty_rej,$rec_arr) {

        $mc_recnum = implode(",",$rec_arr);
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select mc.crn_num,mcsm.stage_num,sum((mcsm.running_time*60) + mcsm.running_time_mins )*$qty_rej
             from mc_master mc,mc_stage_master mcsm
             where mc.crn_num ='$crn'
             and mc.recnum=mcsm.link2mc_master
             and mcsm.stage_num <= $stagenum
             and (mcsm.stage_num % 2 != 0)
             and mc.recnum in ($mc_recnum)
             and mc.from_date='2012-08-01' and mc.to_date='2020-08-31'
             group by mc.crn_num";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }
     /*

     */

 function getsettime4eff($operator,$cond,$rec_arr) {

        //print_r($rec_arr);
        $mc_recnum = implode(",",$rec_arr);
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select sum(mcsm.setting_time*60 + mcsm.setting_time_mins),
                        sum(opmc.setting_time*60 + opmc.setting_time_mins)
             from operator op,oper_mc_usage opmc,mc_stage_master mcsm,mc_master mcm
             where $cond
                   and op.crn=mcm.crn_num
                   and opmc.stage_num=mcsm.stage_num
                   and op.recnum = opmc.link2operator
                   and (opmc.setting_time >0 or opmc.setting_time_mins>0)
                   and mcm.recnum=mcsm.link2mc_master
                   and op.oper_name='$operator'
                   and mcm.recnum in ($mc_recnum)
                   and (opmc.setting_time*60 + opmc.setting_time_mins) >= (0.5*(mcsm.setting_time*60 + mcsm.setting_time_mins))
                   and mcm.from_date = '2012-08-01' and mcm.to_date ='2020-08-31'
                   group by op.oper_name
                   order by op.oper_name ";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }

    function getopdrilldown($op,$cond,$rec_arr)
    {
      //echo '$cond'.$cond;
      $mc_recnum = implode(",",$rec_arr);
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select
                     op.crn,
                     op.st_date,
                     op.shift,
                     sum((oper_mc_usage.running_time*60)+oper_mc_usage.running_time_mins),
                     sum((mc_stage_master.running_time*oper_mc_usage.qty*60)+(mc_stage_master.running_time_mins*oper_mc_usage.qty)),
                     sum((mc_stage_master.running_time*oper_mc_usage.qty*60)+(mc_stage_master.running_time_mins*oper_mc_usage.qty))-sum((oper_mc_usage.running_time*60)+oper_mc_usage.running_time_mins),
                     op.wo_num,
                     sum((oper_mc_usage.setting_time*60)+oper_mc_usage.setting_time_mins),
                     sum((mc_stage_master.setting_time*oper_mc_usage.qty*60)+(mc_stage_master.setting_time_mins*oper_mc_usage.qty)),
                     sum((mc_stage_master.setting_time*oper_mc_usage.qty*60)+(mc_stage_master.setting_time_mins*oper_mc_usage.qty))-sum((oper_mc_usage.setting_time*60)+oper_mc_usage.setting_time_mins),
                     sum(oper_mc_usage.running_time_mins),
                     sum(mc_stage_master.running_time_mins*oper_mc_usage.qty),
                     sum(oper_mc_usage.running_time_mins)-sum(mc_stage_master.running_time_mins*oper_mc_usage.qty),
                     sum(oper_mc_usage.setting_time_mins),
                     sum(mc_stage_master.setting_time_mins*oper_mc_usage.qty),
                     sum(oper_mc_usage.setting_time_mins)-sum(mc_stage_master.setting_time_mins*oper_mc_usage.qty),
                     oper_mc_usage.stage_num,oper_mc_usage.qty, op.mc_name,
                     (oper_mc_usage.idle_time*60+oper_mc_usage.idle_time_mins),
                     oper_mc_usage.qty_rej,
                     sum((oper_mc_usage.markup_time*60)+oper_mc_usage.markup_time_mins),
                     sum((oper_mc_usage.markdown_time*60)+oper_mc_usage.markdown_time_mins)
               from operator op,  mc_master,work_order wo,mc_stage_master
               left outer join oper_mc_usage on oper_mc_usage.stage_num=mc_stage_master.stage_num
               where $cond and
                    op.oper_name='$op' and
                    mc_master.crn_num = op.crn and
                    mc_stage_master.link2mc_master=mc_master.recnum and
                    op.recnum = oper_mc_usage.link2operator and
                    op.wo_num = wo.wonum  and
                    mc_master.recnum in ($mc_recnum) and (oper_mc_usage.qty > 0  || (((oper_mc_usage.setting_time*60)+oper_mc_usage.setting_time_mins)>0))
                    and mc_master.from_date = '2012-08-01' and mc_master.to_date ='2020-08-31'
               group by op.st_date,op.shift,oper_mc_usage.stage_num,op.crn,wo.wonum
               order by op.st_date,op.shift,oper_mc_usage.stage_num";
              //echo $sql;
             // echo'-----';
               $result = mysql_query($sql);
       if(!$result) die("Query failed for Drilldown Operator eff. " . mysql_error());
       return $result;
     }

 function getsettime4row($op,$cond,$rec_arr)
      {
        //echo $cond;
        $mc_recnum = implode(",",$rec_arr);
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select op.st_date,
                     op.crn,
                     op.wo_num,
                     op.shift,
                     sum(mcsm.setting_time*60 + mcsm.setting_time_mins),
                     sum(opmc.setting_time*60 + opmc.setting_time_mins),
                     opmc.stage_num
                from operator op,oper_mc_usage opmc,mc_stage_master mcsm,mc_master mcm
                where $cond
                      and op.crn=mcm.crn_num
                      and opmc.stage_num=mcsm.stage_num
                      and op.recnum = opmc.link2operator
                      and (opmc.setting_time >0 or opmc.setting_time_mins>0)
                      and mcm.recnum=mcsm.link2mc_master
                      and op.oper_name='$op'
                      and mcm.recnum in ($mc_recnum)
               group by op.oper_name,op.st_date, op.shift,opmc.stage_num,op.crn,op.wo_num
               order by op.st_date";
              //echo $sql;
               $result = mysql_query($sql);
       if(!$result) die("Query failed for operator row settime. " . mysql_error());
       return $result;
     }
     //                     grn.rmbycust = '' and
function get_stockbygrn($cond,$argoffset,$arglimit)
    {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $siteid = $_SESSION['siteid'];
      $siteval = "grn.siteid = '".$siteid."'";
      $sql=  "select grn.grnnum, grn.recieved_date,
                     grn.raw_mat_type, grn.raw_mat_spec,
                     sum(grn.qtm), grn.crn ,grn.rmbycim ,sum(grn.qty_used),sum(grn.qty_ret)
               from  grn grn
               where $wcond and
                      grn.grntype != 'Quarantined' and
                     grn.`status` !='Cancelled' and $siteval
               group by grn.grnnum
               order by grn.grnnum
               limit $offset,$limit ";
       // echo $sql;
       $result = mysql_query($sql);
       return $result;
    }
    //GRN Stock for directors (w/o rmbycust)
    function get_stockbygrn4dir($cond,$argoffset,$arglimit)
    {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select grn.grnnum, grn.recieved_date,
                     grn.raw_mat_type, grn.raw_mat_spec,
                     grn.qtm, grn.crn ,grn.rmbycim ,grn.qty_used,grn.qty_ret,
                     rm.rm_unitprize,rm.currency,rm.rm_qty_perbill
               from  grn grn,rmmaster rm
               where $wcond and
                     grn.rmbycim != '' and
                     grn.rmbycust = '' and
                     grn.grntype != 'Quarantined' and
                     grn.`status` !='Cancelled' and
                     rm.rm_status ='Active' and
                     rm.crnnum=grn.crn and 
		     (rm_altrm = 'Primary Spec')
               order by grn.recieved_date,grn.crn,grn.grnnum
               limit $offset,$limit ";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }

	function get_rmstockbycrn($cond,$argoffset,$arglimit)
    {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $siteid = $_SESSION['siteid'];
      $siteval = "grn.siteid = '".$siteid."'";
      $sql=  "select grn.grnnum, grn.recieved_date,
                     grn.raw_mat_type, grn.raw_mat_spec,
                     grn.qtm, grn.crn ,grn.rmbycim ,grn.qty_used,grn.qty_ret,
                     rm.rm_unitprize,rm.currency,rm.rm_qty_perbill
               from  grn grn,rmmaster rm
               where $wcond and
                     grn.rmbycim != '' and
                     grn.rmbycust = '' and
                     grn.grntype != 'Quarantined' and
                     grn.`status` !='Cancelled' and
                     rm.rm_status ='Active' and
                     rm.crnnum=grn.crn 
                     and $siteval
               order by grn.crn
               limit $offset,$limit ";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }
    	function get_rmstockbycrn_export($cond)
    {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select grn.grnnum, grn.recieved_date,
                     grn.raw_mat_type, grn.raw_mat_spec,
                     grn.qtm, grn.crn ,grn.rmbycim ,grn.qty_used,grn.qty_ret,
                     rm.rm_unitprize,rm.currency,rm.rm_qty_perbill
               from  grn grn,rmmaster rm
               where $wcond and
                     grn.rmbycim != '' and
                     grn.rmbycust = '' and
                     grn.grntype != 'Quarantined' and
                     grn.`status` !='Cancelled' and
                     rm.rm_status ='Active' and
                     rm.crnnum=grn.crn and
					 (rm_altrm = 'Primary Spec') 
               order by grn.crn";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }

    function get_stockbygrn4dir_exp($cond)
    {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select grn.grnnum, grn.recieved_date,
                     grn.raw_mat_type, grn.raw_mat_spec,
                     grn.qtm, grn.crn ,grn.rmbycim ,grn.qty_used,grn.qty_ret,
                     rm.rm_unitprize,rm.currency,rm.rm_qty_perbill
               from  grn grn,rmmaster rm
               where $wcond and
                     grn.rmbycim != '' and
                     grn.rmbycust = '' and
                     grn.grntype != 'Quarantined' and
                     grn.`status` !='Cancelled' and
                     rm.rm_status ='Active' and
                     rm.crnnum=grn.crn and
					 (rm_altrm = 'Primary Spec')
               order by grn.grnnum";
       //echo $sql."<br>";
       $result = mysql_query($sql);
       return $result;
    }

    function get_stockbygrn_quar($cond,$argoffset,$arglimit)
     {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select grn.grnnum, grn.recieved_date,
                     grn.raw_mat_type, grn.raw_mat_spec,
                     sum(grnli.qty_to_make), grn.crn ,grn.rmbycim
               from grn_li grnli, grn grn
               where $wcond and
                     grn.recnum = grnli.link2grn and
                     grn.rmbycim != '' and
                     grn.rmbycust = '' and
                     grn.grntype = 'Quarantined' and
                     grn.`status` !='Cancelled'
               group by grn.grnnum
               order by grn.grnnum
               limit $offset,$limit ";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }

    function getstockgrn_count($cond,$argoffset,$arglimit)
    {
     $wcond = $cond;
     $offset = $argoffset;
     $limit = $arglimit;
     $siteid = $_SESSION['siteid'];
     $siteval = "grn.siteid = '".$siteid."'";
      $sql=  "select count(grn.recnum) as
               numrows from grn grn
              where $wcond
              and grn.rmbycim != '' and grn.rmbycust = ''
              and grn.grntype != 'Quarantined' and grn.`status` !='Cancelled' and $siteval";
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     // echo $sql;
     $result  = mysql_query($sql) or die('stockgrn count query failed');
     $row     = mysql_fetch_array($result, MYSQL_ASSOC);
     $numrows = $row['numrows'];
    // echo $numrows;
     return $numrows;
   }
function getDiscrepancy($cond,$offset,$limit){
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select md.rm_type,md.rm_spec,md.cos,md.attachments,md.drg_issue,
                     soli.rmtype,soli.rmspec,soli.cos_iss,soli.partiss,soli.drgiss,soli.crn_num ,so.po_num ,
                     md.CIM_refnum,so.status,so.order_date
                     from master_data md ,so_line_items soli ,sales_order so
                          where md.CIM_refnum=soli.crn_num and
                                soli.link2so=so.recnum and so.`status` ='Open' and $cond
                                order by md.CIM_refnum
                                limit $offset,$limit";
      //echo $sql;
       $result = mysql_query($sql);
         return $result;

   }
    function getDiscrepancycount($cond,$offset,$limit){
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select count(*) as numrows
              from master_data md ,so_line_items soli ,sales_order so
                   where md.CIM_refnum=soli.crn_num and
                         soli.link2so=so.recnum  and so.`status` ='Open' and $cond
                   order by md.CIM_refnum
                  limit $offset,$limit ";
      //echo $sql;
       $result = mysql_query($sql);
      $row     = mysql_fetch_array($result, MYSQL_ASSOC);
       $numrows = $row['numrows'];
    // echo $numrows;
     return $numrows;

   }
//replace method--dn quantity removed the comp_qty null check
//left join assywo_li a on a.grn=w.wonum  a.grn is null and
 function getdn_qty($crn,$proc)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        	if ($proc == 'Treated')
	    {
           $proc = 'and w.treatment = "Treated"';
        }
        $sql = "select  sum(dn_qty_sent) as dn_sent,sum(dn_qty_recd) as dn_recd
				from master_data m, work_order w
    			         where m.CIM_refnum='$crn'
    			         $proc and
				   m.recnum= w.link2masterdata and
				   w.`condition` ='Open' and
				   m.recnum=w.link2masterdata and
                  (w.woclassif = 'Regular' ||w.woclassif = 'Split'||w.woclassif = 'TR'||w.woclassif = 'Rework' || w.woclassif is null || w.woclassif='')
             	group by m.CIM_refnum";
		// echo $sql;
        $result  = mysql_query($sql) or die('getdn_qty failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $dnsent = $row['dn_sent'];
        $dnrecd = $row['dn_recd'];
        return $dnsent.'|'.$dnrecd;
  }

  //Add this method

  function get_rmpotqty($crn)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $i=1;
        $sql = "select li.duedate,po.ponum,
                li.no_of_meterages,li.no_of_lengths,li.delv_by,li.order_qty,li.due_date1,li.due_date2
                from po po,po_line_items li
                     where li.crn = '$crn' and
                           li.link2po = po.recnum and
                           po.`status`='open' and
                           li.accepted_date = '0000-00-00' and
                           (li.`status`='Open' ||li.`status`='' || li.`status` is null)
                order by li.duedate asc limit 1";
		// echo $sql;
        $result  = mysql_query($sql) or die('get_rmpotqty failed');
        return $result;
  }
 	/*
	UNION
       select w.wonum as wonum,w.comp_qty,w.treatment
                from dispatch d,work_order w ,dispatch_line_items dli

                      where dli.wonum=w.wonum and
                            d.status='Cancelled' and
                            dli.link2dispatch=d.recnum and
                            w.`condition`='Closed' and
                            w.crn_num='$crn' and
							(w.woclassif != 'Assembly' && w.woclassif != 'Split Assembly' && w.woclassif != 'TR Assembly')*/

   function getclosedwo_dispatch($crn)
  {
       $newlogin = new userlogin;
        $newlogin->dbconnect();
       $assycrn = substr($crn,2,2);
		//echo "assycrn is $assycrn<br>";
		if ($assycrn == 'A-')
		{
          $sql = "select w.assy_wonum as asywonum,w.comp_qty,'Assembly'
                from assy_wo w
                left join dispatch_line_items dli on dli.wonum=w.assy_wonum
                      where dli.wonum is null  and
                           (w.actual_ship_date != '0000-00-00') and
                            w.crn='$crn'
                            group by w.assy_wonum
                UNION
                select w.assy_wonum as asywonum,w.comp_qty,'Assembly'
                from dispatch d,assy_wo w
                left join dispatch_line_items dli on dli.wonum=w.assy_wonum
                      where d.status='Cancelled' and
                            dli.link2dispatch=d.recnum and
                           (w.actual_ship_date != '0000-00-00') and
                            w.crn='$crn'
                            group by w.assy_wonum
                            order by asywonum";
	//	echo "11111".$sql;
        }
        else
        {  //w.wonum not in (select grn from assywo_li) and   w.wonum not in (select grn from assywo_li) and
        $sql = "select w.wonum as wonum,w.comp_qty,w.treatment,w.dispatch_qty,w.qty
                                       from work_order w
                      where 
                            w.crn_num='$crn' and
							w.comp_qty -(w.dispatch_qty+w.assy_qty) > 0
                             group by w.wonum
                             order by (w.wonum+0)";
                             // echo "222222 $sql";
		}
        $result  = mysql_query($sql) or die('getclosedwo_dispatch failed');
        return $result;
  }

  function getDiscrepancy_master($cond,$offset,$limit)
  {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select md.rm_type,md.rm_spec,md.grainflow,md.rm_dim1,md.rm_dim2,md.rm_dim3,
                     rm.rm_type,rm.rm_spec,rm.length,rm.width,rm.thickness,rm_grainflow,rm.crnnum,md.CIM_refnum
              from master_data md ,rmmaster rm
                   where md.CIM_refnum=rm.crnnum and
                         $cond and
                         md.status='Active' and
                         rm.rm_status='Active'
                   order by md.CIM_refnum
                   limit $offset,$limit";
      //echo $sql;
       $result = mysql_query($sql);
         return $result;

   }
    function getDiscrepancy_mastercount($cond,$offset,$limit)
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select count(*) as numrows
              from master_data md ,rmmaster rm
                   where md.CIM_refnum=rm.crnnum and
                         $cond and
                         md.status='Active' and
                         rm.rm_status='Active'
                   order by md.CIM_refnum
                   limit $offset,$limit";
      //echo $sql;
       $result = mysql_query($sql);
      $row     = mysql_fetch_array($result, MYSQL_ASSOC);
       $numrows = $row['numrows'];
    // echo $numrows;
     return $numrows;
   }

   // Added on Apr 22, 2011 - developed by Namratha

   function getwo_ncdiscrepancy($cond,$offset,$limit)
   {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select w.crn_num,w.wonum,n.recnum,sum(n.qty),n.status,n.inprocess,n.final_insp
              from work_order w,nc4qa n
                   where
                   w.wonum=n.wonum  and
                   $cond and
				   n.status != 'Pending'
                   group by w.wonum
                   order by (w.wonum+0)
                   limit $offset,$limit";
      //echo $sql;
       $result = mysql_query($sql);
         return $result;
   }

  function getwo_rejqty($cond,$wonum)
  {
       $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select w.crn_num,w.wonum,wo_p.rej,wo_p.rework,wo_p.acc,wo_p.stage
              from work_order w,wo_part_status wo_p
                   where
                   wo_p.link2wo=w.recnum  and
                   w.wonum='$wonum' and
                   (wo_p.stage = 'final' or wo_p.stage = 'Final' or
                       wo_p.stage = 'FINAL' or wo_p.stage = 'fi' or
                       wo_p.stage = 'FI' or wo_p.stage = 'Fi') and
                       $cond
                   order by (w.wonum+0)";
      //echo $sql;
       $result = mysql_query($sql);
         return $result;
  }
   function getwo_ncdiscrepancycount($cond,$offset,$limit)
   {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select count(*) as numrows
              from work_order w,nc4qa n
                   where
                   w.wonum=n.wonum and
                   $cond and
                   n.status != 'Pending'
                   group by w.wonum
                   order by (w.wonum+0)";
      //echo $sql;
        $result = mysql_query($sql);

     return $result;
   }

   function getwo_fiQty($cond,$offset,$limit)
   {
     $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select w.crn_num,w.wonum,w.treatment,w.`condition`,w.actual_ship_date,w.qty+0 as wqty,
             (sum(wo_p.acc)+sum(wo_p.rej)+sum(wo_p.ret)+sum(wo_p.rework))AS sum_qty
             from work_order w,wo_part_status wo_p
                  where wo_p.link2wo=w.recnum and
                        (wo_p.stage = 'final' or wo_p.stage = 'Final' or
                        wo_p.stage = 'FINAL' or wo_p.stage = 'fi' or
                        wo_p.stage = 'FI' or wo_p.stage = 'Fi')
                        and (w.actual_ship_date != '0000-00-00') and
						w.`condition` = 'Closed' and
                        $cond
                        group by w.wonum
                        HAVING wqty != sum_qty
                        order by (w.wonum+0)
                        limit $offset,$limit
                        ";
      //echo $sql;
        $result = mysql_query($sql);

     return $result;
   }
   function getwo_fiQty_count($cond,$offset,$limit)
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select count(*) as numrows,w.qty+0 as wqty,
             (sum(wo_p.acc)+sum(wo_p.rej)+sum(wo_p.ret)+sum(wo_p.rework))AS sum_qty
             from work_order w,wo_part_status wo_p
                  where wo_p.link2wo=w.recnum and
                        (wo_p.stage = 'final' or wo_p.stage = 'Final' or
                        wo_p.stage = 'FINAL' or wo_p.stage = 'fi' or
                        wo_p.stage = 'FI' or wo_p.stage = 'Fi')
                        and (w.actual_ship_date != '0000-00-00') and
						w.`condition` = 'Closed' and
                        $cond
                        group by w.wonum
                        HAVING wqty != sum_qty
                        order by (w.wonum+0)
                        ";
      //echo $sql;
        $result = mysql_query($sql);
        return $result;
    }

	function getwo2cofc($cond)
	{
	  $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select w.crn_num,
	                 w.wonum,
					 w.qty,
					 w.comp_qty,
					 w.treatment,
					 w.`condition`,
					 w.actual_ship_date,
	                 d.relnotenum,
	                 sum(dli.dispatch_qty),
                    (w.comp_qty-sum(dli.dispatch_qty)) as wdiff
               from work_order w, dispatch_line_items dli, dispatch d
               where w.wonum = dli.wonum and
			         dli.link2dispatch = d.recnum
               group by w.crn_num,dli.wonum
               order by w.crn_num,(dli.wonum+0)
			  ";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;

    }

   // Added new QA efficiency report - BM - June 8, 2011
	function getqaeff($cond)
	{
	  $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select w.crn_num,
	                 w.wonum,
					 wps.st_date,
				     wps.inspnum,
				     sum(dli.dispatch_qty),
					  w.comp_qty,
					 w.comp_qty,
					 wps.signoff,
					 wps.signoff,
					 wps.signoff,
					 d.relnotenum,
					 d.create_date
               from
			        dispatch_line_items dli,
					dispatch d,
					wo_part_status wps,
					work_order w
               where w.wonum = dli.wonum and
			         dli.link2dispatch = d.recnum and
					 wps.link2wo = w.recnum and
                     (wps.stage = 'final' or wps.stage = 'Final' or
                     wps.stage = 'FINAL' or wps.stage = 'fi' or
                     wps.stage = 'FI' or wps.stage = 'Fi') and
					 w.book_date > '2011-01-01' and
					 $cond
               group by dli.wonum
               order by w.crn_num,(w.wonum+0)
			  ";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;

    }  	function getnc4qaeff($wonum)
	{
	  $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select qty,cust_end,rejected,accepted
	          from nc4qa
			  where wonum = '$wonum' and
			        cust_end = 'yes' and
					accepted != 'yes';
			  ";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
	}

	  function getallDispatchqty4Details($crn)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $assycrn = substr($crn,2,2);
       if($assycrn == 'A-' || $assycrn == 'K-')
       {
         if($assycrn != 'K-')
         {
          $sql = "select d.relnotenum,dl.dispatch_qty,
		               dl.wonum as wonum, d.type, w.comp_qty
		        from dispatch d,
				     dispatch_line_items dl,
				     assy_wo w
				     left join assywo_li a on a.grn=w.assy_wonum
		        where dl.link2dispatch = d.recnum and
				      d.crn='$crn' and
					  w.assy_wonum = dl.wonum  and
                     d.status != 'Cancelled' and
                     a.grn is null
                     order by w.assy_wonum";
         }else
         {
           $sql = "select d.relnotenum,dl.dispatch_qty,
		               dl.wonum as wonum, d.type, w.comp_qty
		        from dispatch d,
				     dispatch_line_items dl,
				     assy_wo w
		        where dl.link2dispatch = d.recnum and
				      d.crn='$crn' and
					  w.assy_wonum = dl.wonum  and
                     d.status != 'Cancelled'
                     order by w.assy_wonum";
        }
     }
        else
        {
        $sql = "(select d.relnotenum,dl.dispatch_qty,
		                dl.wonum as wonum, w.treatment, w.comp_qty
		        from dispatch d,
				     dispatch_line_items dl,
					 work_order w
		             where dl.link2dispatch = d.recnum and
				           d.crn='$crn' and
					       w.wonum = dl.wonum  and
					       w.`condition` !='Cancelled' and w.`condition` != 'Hold' and
                          (w.treatment = '' || w.treatment = 'Manufacture Only' || w.treatment is null) and
                           d.status != 'Cancelled' )

				UNION
				(select d.relnotenum,dl.dispatch_qty,
		                dl.wonum as wonum, w.treatment,w.comp_qty
		          from  dispatch d,
				        dispatch_line_items dl,
					    work_order w
		                where  dl.link2dispatch = d.recnum and
				               d.crn='$crn' and
					           w.wonum = dl.wonum  and
					           w.`condition` !='Cancelled' and w.`condition` != 'Hold' and
					           w.treatment = 'With Treatment' and
                               d.status != 'Cancelled'  )
                      order by (wonum+0)";
		//echo $sql;
		}
        $result = mysql_query($sql);
		if(!$result) die("getallDispatchqty4Details report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }

     function getDispatchDetails4sum($crn,$wonum)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $assycrn = substr($crn,2,2);
        if($assycrn == 'A-' || $assycrn == 'K-')
        {
           if($assycrn !='K-')
           {
             $sql = "select d.relnotenum,dl.dispatch_qty,
		               dl.wonum as wonum, d.type, w.comp_qty,(w.comp_qty-dl.dispatch_qty)
		               from dispatch d,
				            dispatch_line_items dl,
				            assy_wo w
				            left join assywo_li a on a.grn=w.assy_wonum and a.link2assywo=w.recnum
		                    where dl.link2dispatch = d.recnum and
				                  d.crn='$crn' and
					              w.assy_wonum = dl.wonum  and
					              dl.wonum='$wonum' and
                                  d.status != 'Cancelled' and
                                  a.grn is null
                                  order by w.assy_wonum";
           }else
           {

             $sql = "select d.relnotenum,dl.dispatch_qty,
		               dl.wonum as wonum, d.type, w.comp_qty,(w.comp_qty-dl.dispatch_qty)
		               from dispatch d,
				            dispatch_line_items dl,
				            assy_wo w
		                    where dl.link2dispatch = d.recnum and
				                  d.crn='$crn' and
					              w.assy_wonum = dl.wonum  and
					              dl.wonum='$wonum' and
                                  d.status != 'Cancelled'
                                  order by w.assy_wonum";
           }

		//echo $sql;
        }
        else
        {
        $sql = "(select d.relnotenum,dl.dispatch_qty,
		                dl.wonum as wonum, w.treatment, w.comp_qty,(w.comp_qty-dl.dispatch_qty)
		        from dispatch d,
				     dispatch_line_items dl,
					 work_order w
		             where dl.link2dispatch = d.recnum and
				           d.crn='$crn' and
					       w.wonum = dl.wonum  and
					       dl.wonum='$wonum' and
					       w.`condition` !='Cancelled' and w.`condition` != 'Hold' and
                          (w.treatment = '' || w.treatment = 'Untreated' || w.treatment is null) and
                           d.status != 'Cancelled')

				UNION
				(select d.relnotenum,dl.dispatch_qty,
		                dl.wonum as wonum, w.treatment, w.comp_qty,(w.comp_qty-dl.dispatch_qty)
		          from  dispatch d,
				        dispatch_line_items dl,
					    work_order w
                        where  dl.link2dispatch = d.recnum and
				               d.crn='$crn' and
					           w.wonum = dl.wonum  and
					           dl.wonum='$wonum' and
					           w.`condition` !='Cancelled' and w.`condition` != 'Hold' and
					           w.treatment = 'With Treatment' and
                               d.status != 'Cancelled' and
                               (w.woclassif = 'Regular' ||w.woclassif = 'Split'||w.woclassif = 'TR'||w.woclassif = 'Rework' || w.woclassif is null || w.woclassif=''))
                      order by (wonum+0)";
	        //echo $sql."<br>";
		}
        $result = mysql_query($sql);
		if(!$result) die("getDispatchDetails4sum report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }

function getoperdetails($op,$cond)
  {
     $newlogin = new userlogin;
     $newlogin->dbconnect();
      $sql=  "select
                     op.crn,
                     op.st_date as stdate,
                     op.shift as shift,
                     sum((oper_mc_usage.running_time*60)+oper_mc_usage.running_time_mins),
                      op.wo_num,
                     sum((oper_mc_usage.setting_time*60)+oper_mc_usage.setting_time_mins),
                     sum(oper_mc_usage.running_time_mins),
                     sum(oper_mc_usage.setting_time_mins),
                     oper_mc_usage.stage_num as stagenum,
					 oper_mc_usage.qty,
					 op.mc_name,
                     (oper_mc_usage.idle_time*60+oper_mc_usage.idle_time_mins),
                     oper_mc_usage.qty_rej,
                     sum((oper_mc_usage.markup_time*60)+oper_mc_usage.markup_time_mins),
                     sum((oper_mc_usage.markdown_time*60)+oper_mc_usage.markdown_time_mins),
					 wo.crn_num
               from operator op,work_order wo,oper_mc_usage
               where $cond and
                    op.oper_name='$op' and
                    op.crn NOT IN (select mc_master.crn_num from mc_master) and
                    op.recnum = oper_mc_usage.link2operator and
                    op.wo_num = wo.wonum
               group by op.st_date,op.shift,oper_mc_usage.stage_num,op.crn,wo.wonum
               order by op.st_date,op.shift,oper_mc_usage.stage_num";
         //echo $sql;
        $result = mysql_query($sql);
        return $result;
  } //
  // oper_mc_usage.stage_num NOT IN (select mcsm.stage_num from mc_stage_master mcsm) and

  function getdn_qty4storesrecd($crn,$proc)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
       	if ($proc == 'With Treatment')
	    {
           $proc = 'and w.treatment = "With Treatment"';
        }
        $sql = "select  sum(dn_qty_sent) as dn_sent,sum(dn_qty_recd-comp_qty) as dn_recd
				from work_order w
                         left join assywo_li a on a.grn=w.wonum
    			         where w.crn_num='$crn'
    			         $proc and
				   w.`condition` ='Open' and
				   a.grn is null and
                   (w.woclassif = 'Regular' ||w.woclassif = 'Split'||w.woclassif = 'TR'||w.woclassif = 'Rework' || w.woclassif is null || w.woclassif='')
             	group by w.crn_num";
		//echo $sql;
        $result  = mysql_query($sql) or die('getdn_qty4storesrecd failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $dnsent = $row['dn_sent'];
        $dnrecd = $row['dn_recd'];
        return $dnsent.'|'.$dnrecd;
  }





function getcrnfromlob($cond,$crn)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
            $sql = "select w.recnum,d.crnnum,sum(w.qty),
			               d.crnnum,d.partnum
				from delivery_sch d
				left join work_order w on d.crnnum=w.crn_num
				where 
				d.crnnum like '$crn%' and
				d.status = 'Open'
				group by d.crnnum, d.partnum
                order by d.crnnum";

		// echo $sql;
        $result = mysql_query($sql);
        return $result;

	}

function get_rmpotqty4lob ($crn,$fromdate,$todate)
	{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
            $sql = "select li.duedate,sum(li.no_of_meterages+li.no_of_lengths),li.delv_by
				from po_line_items li, po
				where li.crn = '$crn' and
				li.duedate > '$fromdate' and
				li.duedate < '$todate' and
				(li.accepted_date = '0000-00-00' or li.accepted_date = ''
				     or  li.accepted_date is null) and
                po.status = 'Open' and
                po.recnum = li.link2po
				group by li.crn";
		 // print "\n$sql" ."</b>";
        $result = mysql_query($sql);
        return $result;
	}



	function getqanc4excel($cond)
   {
        $offset = $argoffset;
        $limit =  $arglimit;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
     $sql = "select  
		                nc.recnum,
                        nc.wonum,
                        nc.refnum,
                        nc.customer,
                        nc.partnum,
                        nc.create_date,
                        nc.dcdate,
                        nc.description,
                        nc.qty,
                        nc.effectiveness,
                        nc.root_cause,
                        nc.corrective_action,
                        nc.preventive_action,
                        nc.inprocess,
                        nc.final_insp,
                        nc.cust_end,
						nc.status,
						nc.accepted,
						nc.rejected,
						nc.quarantined,
						nc.man,
						nc.machine,
						nc.method,
						nc.dim_deviation,
						nc.mat_deviation,
						nc.other_deviation,
                        nc.oper_name,
						GROUP_CONCAT(distinct o.mc_name),
                        nc.rework,
						nc.wotype,
						nc.dn_num,
						nc.oper_name,
						nc.super_name,
						nc.rm_cost,
						nc.cust_ncdate,
						nc.dcnum,
						nc.dcdate,
						nc.cofcnum,
						nc.customer,
						nc.ponum,
						nc.partname,
						nc.bachnum,
						nc.partnum,
						nc.matl_spec,
						nc.part_sl_num,
						nc.issues_ps,
						nc.remarks,
						w.qty
				from work_order w,nc4qa nc
				left join  operator o on nc.wonum = o.wo_num
                 where
                 $cond and w.wonum=nc.wonum
				 group by nc.recnum
                order by nc.recnum";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Query failed for operator row settime. " . mysql_error());
        return $result;
   }


          function getdn_qty4wo($crn,$proc,$condw)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        	if ($proc == 'With Treatment')
	    {
           $proc = 'and w.treatment = "With Treatment"';
        }
        $sql = "select  sum(dn_qty_sent) as dn_sent,sum(dn_qty_recd) as dn_recd
				from master_data m, work_order w
                         left join assywo_li a on a.grn=w.wonum
    			         where m.CIM_refnum='$crn'
    			         $proc and $condw and
				   m.recnum= w.link2masterdata and
				   w.`condition` ='Open' and
				   m.recnum=w.link2masterdata and
				   a.grn is null and
                  (w.woclassif = 'Regular' ||w.woclassif = 'Split'||w.woclassif = 'TR'||w.woclassif = 'Rework' || w.woclassif is null || w.woclassif='')
             	group by m.CIM_refnum";
	//	echo $sql;
        $result  = mysql_query($sql) or die('getdn_qty failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $dnsent = $row['dn_sent'];
        $dnrecd = $row['dn_recd'];
        return $dnsent.'|'.$dnrecd;
  }
  function getdnrej4wo($crn,$proc)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        	if ($proc == 'With Treatment')
	    {
           $proc = 'and w.treatment = "With Treatment"';
        }
        $sql = "select sum(w.acc4dn) as dnacc,sum(wo_p.rej) as dnrej
	             from work_order w
                 left join wo_part_status wo_p on w.recnum=wo_p.link2wo
                 and (wo_p.stage='DN' || wo_p.stage='dn' || wo_p.stage='Dn')
                 left join assywo_li a on a.grn=w.wonum
				      where w.crn_num='$crn'
                      $proc and
                            w.`condition`='Open' and
                            a.grn is null and
                            (w.woclassif = 'Regular' ||w.woclassif = 'Split'||w.woclassif = 'TR'||w.woclassif = 'Rework' || w.woclassif is null || w.woclassif='')";
	//	echo $sql;
        $result  = mysql_query($sql) or die('getdnrej4wo failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $dnrej = $row['dnrej'];
        $dnacc= $row['dnacc'];
        return $dnrej.'|'.$dnacc;
  }

  function getrejqtydetails($crn,$proc,$wonum)
  {
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $sql = "select sum(wo_p.rej) as drej
	             from work_order w
                 left join wo_part_status wo_p on w.recnum=wo_p.link2wo
                 and (wo_p.stage='PostDN' || wo_p.stage='DN' || wo_p.stage='dn' || wo_p.stage='Dn' )
                 left join assywo_li a on a.grn=w.wonum
				      where w.crn_num='$crn' and w.wonum='$wonum' and
                            w.`condition`='Open' and
                            a.grn is null and
                            w.treatment = 'With Treatment' and
                            (w.woclassif = 'Regular' ||w.woclassif = 'Split'||w.woclassif = 'TR'||w.woclassif = 'Rework' || w.woclassif is null || w.woclassif='')";

        $result  = mysql_query($sql) or die('getrejqtydetails failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $dnrej = $row['drej'];
        return $dnrej;
  }

   function getnc4operators($oper_name,$cond)
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql="select nc.recnum as nc,nc.refnum,nc.qty
                     from nc4qa nc,operator o,oper_mc_usage opmc
                     where  nc.oper_name like '%$oper_name%' and nc.status !='Pending'
                     and (nc.final_insp='yes' || nc.inprocess='yes') and nc.rejected='yes' and $cond
                     and opmc.link2operator=o.recnum and nc.stagenum=opmc.stage_num and nc.wonum=o.wo_num
                     group by nc.recnum";
       // echo $sql;
        $result=mysql_query($sql)or die("getnc4operators failed...Please report to SysAdmin. " . mysql_error());
        return $result;
   }

   function getfinc4operators($oper_name,$cond)
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
       /*$sql="select nc.recnum as nc,nc.refnum,nc.qty
              from nc4qa nc,operator o,oper_mc_usage opmc
              where  nc.oper_name like '%$oper_name%' and nc.status !='Pending'
                     and (nc.final_insp='yes') and nc.rejected='yes' and $cond
                     and opmc.link2operator=o.recnum and nc.stagenum=opmc.stage_num and nc.wonum=o.wo_num
              group by nc.recnum";*/
			  $sql="select nc.recnum as nc,nc.refnum,nc.qty
              from nc4qa nc,operator o,oper_mc_usage opmc
              where  nc.oper_name like '%$oper_name%' and nc.status !='Pending'
                     and (nc.final_insp='yes') and nc.rejected='yes' and $cond
                     and opmc.link2operator=o.recnum and nc.wonum=o.wo_num
              group by nc.recnum";
       // echo $sql.'<br/>';
        $result=mysql_query($sql)or die("getnc4operators failed...Please report to SysAdmin. " . mysql_error());
        return $result;
   }

   function getipnc4operators($oper_name,$cond)
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        /*$sql="select nc.recnum as nc,nc.refnum,nc.qty
                     from nc4qa nc,operator o,oper_mc_usage opmc
                     where  nc.oper_name like '%$oper_name%' and nc.status !='Pending'
                     and (nc.inprocess='yes') and nc.rejected='yes' and $cond
                     and opmc.link2operator=o.recnum and nc.stagenum=opmc.stage_num and 
					 nc.wonum=o.wo_num
                     group by nc.recnum";*/
					 $sql="select nc.recnum as nc,nc.refnum,nc.qty
                     from nc4qa nc,operator o,oper_mc_usage opmc
                     where  nc.oper_name like '%$oper_name%' and nc.status !='Pending'
                     and (nc.inprocess='yes') and nc.rejected='yes' and $cond
                     and opmc.link2operator=o.recnum and 
					 nc.wonum=o.wo_num
                     group by nc.recnum";
       // echo $sql;
        $result=mysql_query($sql)or die("getnc4operators failed...Please report to SysAdmin. " . mysql_error());
        return $result;
   }
   function getnc4operators4drilldown($wonum,$opname,$condnc,$crn,$stagenum)
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql="select nc.recnum as nc,nc.refnum,sum(nc.qty)
                     from nc4qa nc
                     where
                     nc.wonum='$wonum'
                     and nc.oper_name like '%$opname%'
                     and nc.status !='Pending'
                     and (nc.inprocess='yes')
                     and nc.rejected='yes' and nc.refnum='$crn' and $condnc
                     group by nc.refnum ";
        //echo $sql;
        $result=mysql_query($sql)or die("getnc4operators failed...Please report to SysAdmin. " . mysql_error());
        return $result;
   }

      function getfinc4operators4drilldown($wonum,$opname,$condnc,$crn,$stagenum)
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql="select nc.recnum as nc,nc.refnum,sum(nc.qty)
                     from nc4qa nc
                     where
                     nc.wonum='$wonum'
                     and nc.oper_name like '%$opname%'
                     and nc.status !='Pending'
                     and (nc.final_insp='yes')
                     and nc.rejected='yes' and nc.refnum='$crn' and $condnc 
                     group by nc.refnum ";
        //echo $sql;
        $result=mysql_query($sql)or die("getnc4operators failed...Please report to SysAdmin. " . mysql_error());
        return $result;
   }
   function getrmcostdetails($crnnum)
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql="select (rm_unitprize/rm_qty_perbill),crnnum,currency
                     from rmmaster
                     where crnnum='$crnnum' and
					 rm_altrm = 'Primary Spec' and
					 rm_status='Active'";
        //echo $sql;
        $result=mysql_query($sql)or die("getrmcostdetails failed...Please report to SysAdmin. " . mysql_error());
        return $result;
   }


// Replaced the following with new method to accomodate for showing CRNs in "for assy"
//(w.woclassif='Assembly' || w.woclassif='Split Assembly' || w.woclassif='TR Assembly') and
    function getwo4assembly($crn)
  {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $assycrn = substr($crn,2,2);
		//echo "assycrn is $assycrn<br>";
		if ($assycrn == 'A-')
		{
          $sql = "select w.assy_wonum,w.comp_qty,'','','' ,ali.qty_wo
                         from assy_wo w,assywo_li ali
                              where ali.grn=w.assy_wonum and
							              w.assy_qty > 0 and
                                    (w.actual_ship_date != '0000-00-00') and
                                    w.crn like '$crn%'
                                    group by w.assy_wonum 
									order by w.assy_wonum";
	//	echo "11111".$sql;  and  ali.crn_num4li like '$crn%'    (w.woclassif='Assembly' || w.woclassif='Split Assembly' || w.woclassif='TR Assembly') and
        }
        else
        {
           $sql = "(select w.wonum as wonum,w.comp_qty,w.treatment,w.woclassif ,'',ali.qty_wo,a.assy_wonum ,ali.crn_num4li
                          from work_order w,assywo_li ali ,assy_wo a
                                      where (w.`condition`='Closed'||w.`condition`='Open') and
                                     w.crn_num like '$crn%'
                                     and ali.crn_num4li ='$crn'
                                     and ali.grn=w.wonum
                                     and a.recnum=ali.link2assywo)
                  UNION
                         (select w.wonum as wonum,w.comp_qty,w.treatment,w.woclassif ,'',ali.qty_wo,'' ,ali.crn_num4li
                          from work_order w
                          left join assywo_li ali on  ali.grn=w.wonum
                                      where (w.`condition`='Closed'|| w.`condition`='Open') and
                                     w.crn_num like '$crn%' and
                                     (w.woclassif='Assembly' || w.woclassif='Split Assembly' || w.woclassif='TR Assembly') and
                                     ali.grn is null )
                    UNION
                         (select w.wonum as wonum,w.comp_qty,w.treatment,w.woclassif ,'',ali.qty_wo,a.assy_wonum ,ali.crn_num4li
                          from work_order w,assywo_li ali ,assy_wo a
                                      where (w.`condition`='Closed'||w.`condition`='Open') and
                                     w.crn_num like '$crn%'
                                     and ali.grn=w.wonum
                                     and a.recnum=ali.link2assywo)
                                    order by (wonum+0)";
//echo "222222 $sql";
		}
        $result  = mysql_query($sql) or die('getwo4assembly failed');
        return $result;
  }

      function getwo4assembly_old($crn)
  {
       $newlogin = new userlogin;
        $newlogin->dbconnect();
       $assycrn = substr($crn,2,2);
		//echo "assycrn is $assycrn<br>";
		if ($assycrn == 'A-')
		{
          $sql = "select w.assy_wonum,w.comp_qty,'','','' ,ali.qty_wo
                from assy_wo w,assywo_li ali
                       where ali.grn=w.assy_wonum and
                           (w.actual_ship_date != '0000-00-00') and
                            w.crn like '$crn%'
                            group by w.assy_wonum order by w.assy_wonum";
	//	echo "11111".$sql;
        }
        else
        {
        $sql = "select w.wonum as wonum,w.comp_qty,w.treatment,w.woclassif ,'',ali.qty_wo,a.assy_wonum
                from work_order w,assywo_li ali,assy_wo a
                      where ali.grn=w.wonum and
                            w.`condition`='Closed' and
                            (w.woclassif='Assembly' || w.woclassif='Split Assembly' || w.woclassif='TR Assembly') and
                            w.crn_num like '$crn%' and
                            a.recnum=ali.link2assywo
                            order by (wonum+0)";
//echo "222222 $sql";
		}
        $result  = mysql_query($sql) or die('getclosedwo_dispatch failed');
        return $result;
  }

  function geSupnOperNames()
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select concat(fname,' ',lname),fname
                 from employee where role='OP' and status='Active'
                 order by fname";
        $result = mysql_query($sql);
         if(!$result) die("geSupnOperNames for NC report failed. " . mysql_error());
        return $result;

     }

// For WO Milestone report
function getWoapproveStatus($cond,$argoffset,$arglimit)
{
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $offset = $argoffset;
      $limit = $arglimit;

      $sql=  "select wo.wonum,
	             d.stagenum,d.stagename,
		     d.dept,d.completed,
                     d.link2approvedbyowner,
		     wo.crn_num,
		     wo.book_date,
                     wo.priority
                     from   dates d,work_order wo
                     where wo.recnum=d.link2wo and
                           wo.condition='Open' and
                           d.stagenum in (200,210,220,230,245,250,260,270,280)
                     order by wo.crn_num,(wo.wonum+0), d.stagenum
				   ";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
   }
     //op.mc_name = '$mc' and
     function getprod_record($mc,$cond)
     {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "select op.mc_name,
                        op.st_date,
                        op.shift,
                        op.oper_name,
                        op.crn,
                        op.wo_num,
                        op_mc.qty,
                        op_mc.stage_num,
                        op_mc.setting_time,
                        op_mc.setting_time_mins,
                        op_mc.running_time,
                        op_mc.running_time_mins,
                        op_mc.idle_time,
                        op_mc.idle_time_mins,
			            op.remarks,
                        op_mc.qty_rej,
                        w.book_date

                  FROM operator op, oper_mc_usage op_mc,work_order w
                  where $cond and
                        op_mc.link2operator=op.recnum and w.wonum=op.wo_num
                  order by op.st_date,op.shift,op.oper_name,op_mc.stage_num";
       // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Get Production Record query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }

     function getEmp4Prodnrec()
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select fname, lname, empcode
                      from employee where
                      role='OP' order by fname";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;

    }
    
   // -- add methods

   // Methods added for crnreport_new
   function getallCRN4report($cond,$crn)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
		$assycrn = substr($crn,2,2);
		//echo "assycrn is $assycrn<br>";
		if ($assycrn != 'A-' && $assycrn != 'K-')
	    {
            $sql = "select w.recnum,m.CIM_refnum,sum(w.qty),m.partnum
				from master_data m
                     left join work_order w on m.CIM_refnum = w.crn_num
				      where m.CIM_refnum like '$crn%'
                      group by m.CIM_refnum";
		}
 	    else
	    {
            $sql = "select w.recnum,m.CIM_refnum,sum(w.assyqty),m.partnum
				from master_data m
				left join assy_wo w on m.CIM_refnum = w.crn
				where m.CIM_refnum like '$crn%'
				group by m.CIM_refnum";
	    }
		//echo "<br>$sql";
        $result = mysql_query($sql);
		if(!$result) die("getallCRN4report report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }

  function getstock4crnnew($cond,$crn,$proc,$treat)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $assycrn = substr($crn,2,2);

 if($treat == "Untreated")
 {

  $sql = "select w.crn_num as CRN,
                   w.treatment as TYPE,
                   sum(w.comp_qty) as COMPQTY,
                   sum(dispatch_qty) as DISPQTY,
                   '',
                   (sum(w.comp_qty)-sum(w.dispatch_qty)-sum(w.assy_qty)) as FG,
                   (sum(w.qty)-sum(w.comp_qty)-sum(w.rej_qty)-sum(w.rework_qty)-sum(w.ret_qty)) as WIP,
               `condition` as COND ,
                     sum(w.dn_qty_recd) as dn_recd
                   from work_order w  
                        $cond and
            (w.`condition` = 'Open' || w.`condition` = 'Closed')
                   group by w.crn_num, w.treatment,w.`condition`
                   order by CRN, TYPE,COND";
        // echo $sql;
 }
else if($treat == "Treated")
 {
$cond="dn.crn like '".$crn."%'";
  $sql = "select dn.crn as CRN, w.treatment as TYPE,
                 IFNULL(sum(dn.comp_qty),0) as COMPQTY, 
                 sum(dnli.disp_qty) as DISPQTY,
                 sum(dn.qty) as DNBAL, 
                 (IFNULL(sum(dn.comp_qty),0)-sum(dnli.disp_qty)-sum(dnli.assy_qty)) as FG, (sum(dn.qty)-sum(dnli.rej_qty)-sum(dnli.rework_qty)-sum(dnli.ret_qty)) as WIP, 
                 `condition` as COND , sum(w.dn_qty_recd) as dn_recd 
                 from work_order w,delivery_note dn 
                 left join delivery_note_li dnli on 
                 dn.recnum =  dnli.link2delivery
                  where dn.dnnum= w.dnnum and 
                  $cond
                 group by dn.crn, w.treatment,
                 w.`condition` order by CRN, TYPE,COND";
        // echo $sql;exit;
 }

 else 
 {
$cond=" where w.crn like '".$crn."%'";
       $sql="select w.crn as CRN,
             'Assembly' as TYPE,
             sum(w.comp_qty) as COMPQTY,
             sum(dispatch_qty) as DISPQTY,
              '' as DNBAL,
             sum(w.comp_qty-w.dispatch_qty) as FG,
                 sum(w.assyqty),
                  `status` as COND,
                                  '' as dn_recd
                       from assy_wo w
                       left join assywo_li a on a.grn=w.assy_wonum
                                  $cond and
                  (w.`status` = 'Open' || w.`status` = 'Closed'||w.`status` is null)
                  and a.grn is null
                        group by w.crn, w.`status`
                        UNION
                        select w.crn as CRN,
                                  'For Assembly' as TYPE,
                                  sum(w.comp_qty) as COMPQTY,
                                  sum(dispatch_qty) as DISPQTY,
                                  '' as DNBAL,
                                  sum(w.assyqty-a.qty_wo) as FG,
                 '0',
                  `status` as COND,
                                  '' as dn_recd
                       from assy_wo w
                       left join assywo_li a on a.grn=w.assy_wonum
                                  $cond and
                  (w.`status` = 'Open' || w.`status` = 'Closed'||w.`status` is null)
                  and a.grn is null
                        group by w.crn, w.`status`
                        order by CRN, COND";  
// echo $sql;
 }
 // echo $sql;exit;
  $result = mysql_query($sql);
    if(!$result) die("getstock4all report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;

        /*if($proc !='Assembly')
        //{
/*
        $sql = "select w.crn_num as CRN,
                   w.treatment as TYPE,
                   sum(w.comp_qty) as COMPQTY,
                   sum(dispatch_qty) as DISPQTY,
                   sum(w.dn_qty_sent-w.dn_qty_recd) as DNBAL,
                   (sum(w.comp_qty)-sum(w.dispatch_qty)-sum(w.assy_qty)) as FG,
                   (CASE WHEN w.treatment='With Treatment' THEN  
          sum(w.qty)-sum(w.acc4dn)-sum(rej_qty)-sum(rework_qty)-sum(ret_qty) 
                      ELSE sum(w.qty)-sum(w.comp_qty)-sum(rej_qty)-sum(rework_qty)-sum(ret_qty) END ),
               `condition` as COND ,
                     sum(w.dn_qty_recd) as dn_recd
                   from work_order w
                        $cond and
            (w.`condition` = 'Open' || w.`condition` = 'Closed')
                   group by w.crn_num, w.treatment,w.`condition`
                   order by CRN, TYPE,COND";*/
       /* if($assycrn!='A-')
        {
          $sql = "select w.crn_num as CRN,
                   w.treatment as TYPE,
                   sum(w.comp_qty) as COMPQTY,
                   sum(dispatch_qty) as DISPQTY,
                   sum(dn.qty) as DNBAL,
                   (sum(w.comp_qty)-sum(w.dispatch_qty)-sum(w.assy_qty)) as FG,
                   (CASE WHEN w.treatment='Treated' THEN  
		      sum(w.qty)-sum(w.acc4dn)-sum(w.rej_qty)-sum(w.rework_qty)-sum(w.ret_qty) 
                      ELSE sum(w.qty)-sum(w.comp_qty)-sum(w.rej_qty)-sum(w.rework_qty)-sum(w.ret_qty) END ) as WIP,
	             `condition` as COND ,
                     sum(w.dn_qty_recd) as dn_recd
                   from work_order w left join delivery_note dn on w.wonum=dn.wonum 
                        $cond and
					  (w.`condition` = 'Open' || w.`condition` = 'Closed')
                   group by w.crn_num, w.treatment,w.`condition`
                   order by CRN, TYPE,COND";
                    // echo $sql;
        }

        //}  and


        else
        {
           $cond=" where w.crn like '".$crn."%'";
           if($assycrn=='K-')
           {
             $sql="select w.crn as CRN,
                                  'Assembly' as TYPE,
                                  sum(w.comp_qty) as COMPQTY,
                                  sum(dispatch_qty) as DISPQTY,
                                  '' as DNBAL,
                                  sum(w.comp_qty-w.dispatch_qty) as FG,
								 sum(w.assyqty),
								  `status` as COND,
          '' as dn_recd
                       from assy_wo w
                                   $cond and
								  (w.`status` = 'Open' || w.`status` = 'Closed'||w.`status` is null)
                        group by w.crn, w.`status`
                  UNION
                  select w.crn as CRN,
                                  'For Assembly' as TYPE,
                                  sum(w.comp_qty) as COMPQTY,
                                  sum(dispatch_qty) as DISPQTY,
                                  '' as DNBAL,
                                  sum(w.comp_qty-w.dispatch_qty) as FG,
								 sum(w.assyqty-ali.qty_wo),
								  `status` as COND,
          '' as dn_recd
                       from assy_wo w,assywo_li ali
                                   $cond and
								  (w.`status` = 'Open' || w.`status` = 'Closed'||w.`status` is null)  and
								  ali.link2assywo=w.recnum
                        group by w.crn, w.`status`
                        order by CRN, COND";
           }else
           {
             $sql="select w.crn as CRN,
                                  'Assembly' as TYPE,
                                  sum(w.comp_qty) as COMPQTY,
                                  sum(dispatch_qty) as DISPQTY,
                                  '' as DNBAL,
                                  sum(w.comp_qty-w.dispatch_qty) as FG,
								 sum(w.assyqty),
								  `status` as COND,
                                  '' as dn_recd
                       from assy_wo w
                       left join assywo_li a on a.grn=w.assy_wonum
                                  $cond and
								  (w.`status` = 'Open' || w.`status` = 'Closed'||w.`status` is null)
								  and a.grn is null
                        group by w.crn, w.`status`
                        UNION
                        select w.crn as CRN,
                                  'For Assembly' as TYPE,
                                  sum(w.comp_qty) as COMPQTY,
                                  sum(dispatch_qty) as DISPQTY,
                                  '' as DNBAL,
                                  sum(w.assyqty-a.qty_wo) as FG,
								 '0',
								  `status` as COND,
                                  '' as dn_recd
                       from assy_wo w
                       left join assywo_li a on a.grn=w.assy_wonum
                                  $cond and
								  (w.`status` = 'Open' || w.`status` = 'Closed'||w.`status` is null)
								  and a.grn is null
                        group by w.crn, w.`status`
                        order by CRN, COND";
           }
*/

      /*  }*/


	 // echo "<br>$sql---open----<br>";
      
    }
    function gettype4crn($wcond,$crn)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        //echo "<br>crn is $crn<br>";
        $cond=" where w.crn like '".$crn."%'";
        $sql = "select w.recnum,w.crn_num,w.wonum,w.treatment
                       from work_order w $wcond
                       UNION
                       select w.recnum,w.crn,w.assy_wonum,w.assy_type 
                       from assy_wo w $cond";
    // echo $sql;
        $result  = mysql_query($sql) or die('gettype4crn failed');
        $myrow = mysql_fetch_row($result);
        $treatment = $myrow[3];  
        return $treatment;

  }


  function getrmpoqty4crnnew($crn)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $i=1;
		//echo "<br>crn is $crn<br>";
        $sql = "select li.duedate,
		                          po.ponum,
                                  li.no_of_meterages,
								  li.no_of_lengths,
								  li.delv_by,
								  li.order_qty,
								  li.due_date1,
								  li.due_date2,
								  li.crn
                from po po,po_line_items li
                     where li.crn = '$crn' and
                           li.link2po = po.recnum and
                           po.`status`='Open' and
                           li.accepted_date = '0000-00-00' and
                           (li.`status`='Open' || li.`status`='' || li.`status` is null)
                            order by li.crn,li.duedate asc limit 1";
		//echo $sql;
        $result  = mysql_query($sql) or die('get_rmpotqty4crnnew failed');
        return $result;
  }


  function getgrnqty4crnnew($crn)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select sum(g.qtm),
                       sum(g.qty_used),
                       sum(g.qty_quar),
                       g.crn ,
                       sum(g.qty_ret)
                       from grn g
                            where g.crn like '$crn%' and
                                  g.`status`!= 'Cancelled'
				                  group by g.crn
                                  order by g.crn";
		// echo $sql;
        $result  = mysql_query($sql) or die('get_grnqty4crnnew failed');
        return $result;
  }
  
   function getnewfg_goods($cond,$argoffset,$arglimit)
   {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select wo.crn_num,wo.po_num,sum(wo.comp_qty),sum(wo.dispatch_qty)
                      from work_order wo
                      where $wcond  and
                      wo.`condition`='Closed'
                      group by wo.crn_num
             order by wo.crn_num limit $offset,$limit";
      // echo $sql;
       $result = mysql_query($sql);
       return $result;
    }
    
    function get_newfg_goods_totalcost($cond)
     {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select wo.crn_num,wo.po_num,sum(wo.comp_qty),sum(wo.dispatch_qty)
                      from work_order wo
                      where $wcond  and
                      wo.`condition`='Closed'
                      group by wo.crn_num
             order by wo.crn_num ";
      // echo $sql;
       $result = mysql_query($sql);
       return $result;
    }
    
    function get_stockbygrnnew($cond,$argoffset,$arglimit)
    {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select grn.grnnum, grn.recieved_date,
                     grn.raw_mat_type, grn.raw_mat_spec,
                     sum(grn.qtm), grn.crn ,grn.rmbycim,sum(grn.qty_used),sum(grn.qty_ret)
               from grn grn
               where $wcond and
                     grn.rmbycim != '' and
                     grn.rmbycust = '' and
                     grn.grntype != 'Quarantined' and
                     grn.`status` !='Cancelled'
               group by grn.grnnum
               order by grn.grnnum
               limit $offset,$limit ";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }
    
      function getoverallstock4rm($cond,$rmtype)
   {
       //                     $rm_type   and
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      if($rmtype!="Others")
      {
        $rm_type= "grn.raw_mat_type ='".$rmtype."'";
      } else
      {
        $rm_type= "(grn.raw_mat_type !='Aluminium' and grn.raw_mat_type !='Titanium' and grn.raw_mat_type !='Bronze' and grn.raw_mat_type !='Steel')";
      }

      $sql=  "select rm.rm_type,
	                        (replace(rm.rm_unitprize,'$','')/rm.rm_qty_perbill) as Rate,
							rm.rm_bars_plates,
                    sum(grn.qtm)-sum(grn.qty_used)+sum(grn.qty_ret) ,
					rm.crnnum
               from  grn grn,rmmaster rm
               where $cond and
                     grn.rmbycim != '' and
                     grn.rmbycust = '' and
                     grn.grntype != 'Quarantined' and
                     grn.`status` !='Cancelled' and
                     rm.crnnum=grn.crn and
                     rm.rm_status='Active' and
					 rm.rm_altrm = 'Primary Spec'
               group by rm.crnnum,rm.rm_type,rm.rm_bars_plates
			   order by rm.rm_type,rm.rm_bars_plates, rm.crnnum
               ";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
   }
  //and rm.crnnum in('28-043','35-056')
   function getgrnstockreport($cond,$argoffset,$arglimit)
    {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select grn.grnnum, grn.recieved_date,
                     rm.rm_type, grn.raw_mat_spec,
                     sum(grn.qtm), grn.crn ,grn.rmbycim,sum(grn.qty_used),
                     sum(grn.qty_ret),(min(replace(rm.rm_unitprize,'$','')/rm_qty_perbill)) as Rate,
                     grn.grnnum,grn.grnnum,(sum(grn.qtm-grn.qty_used)+sum(grn.qty_ret))
               from  grn grn,rmmaster rm
               where $wcond and
                     grn.rmbycim != '' and
                     grn.rmbycust = '' and
                     grn.grntype != 'Quarantined' and
                     grn.`status` !='Cancelled' and
                     rm.crnnum=grn.crn and
                     rm.rm_status='Active' and
                     rm.rm_unitprize is not null and
                     rm.rm_unitprize !=''
               group by rm.crnnum,rm.rm_type,rm.rm_bars_plates
			   order by rm.rm_type,rm.rm_bars_plates, rm.crnnum
               ";
     // echo $sql;
       $result = mysql_query($sql);
       return $result;
    }
      function getgrnstockreport4export()
    {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select grn.grnnum, grn.recieved_date,
                     rm.rm_type, grn.raw_mat_spec,
                     sum(grn.qtm), grn.crn ,grn.rmbycim,sum(grn.qty_used),
                     sum(grn.qty_ret),(min(replace(rm.rm_unitprize,'$','')/rm_qty_perbill)) as Rate,
                     grn.grnnum,grn.grnnum,(sum(grn.qtm-grn.qty_used)+sum(grn.qty_ret))
               from  grn grn,rmmaster rm
               where
                     grn.rmbycim != '' and
                     grn.rmbycust = '' and
                     grn.grntype != 'Quarantined' and
                     grn.`status` !='Cancelled' and
                     rm.crnnum=grn.crn and
                     rm.rm_status='Active'
               group by rm.crnnum,rm.rm_type,rm.rm_bars_plates
			   order by rm.rm_type,rm.rm_bars_plates, rm.crnnum";
      // echo $sql;
       $result = mysql_query($sql);
       return $result;
    }
    
    function get_rmprice($crnnum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select r.rm_unitprize,r.rm_qty_perbill
                      from rmmaster r
                       where
                        rm_status='Active' and
                        r.crnnum = '$crnnum'
			limit 1";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
   }
   
    function getgrndets4report($cond,$argoffset,$arglimit)
    {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select grn.grnnum, grn.recieved_date,
                    grn.invoice_num,c.name
               from  grn grn,company c
               where $wcond and
                     grn.rmbycim != '' and
                     grn.rmbycust = '' and
                     grn.grntype != 'Quarantined' and
                     grn.`status` !='Cancelled' and
                     c.recnum=grn.link2vendor
               group by grn.grnnum
               order by grn.grnnum
               limit $offset,$limit ";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }

     function getgrndets4reportcount($cond,$argoffset,$arglimit)
    {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select count(*) as numrows
               from  grn grn,company c
               where $wcond and
                     grn.rmbycim != '' and
                     grn.rmbycust = '' and
                     grn.grntype != 'Quarantined' and
                     grn.`status` !='Cancelled' and
                     c.recnum=grn.link2vendor
               group by grn.grnnum
               order by grn.grnnum
               limit $offset,$limit ";
      // echo $sql;
       $result = mysql_query($sql) or die('getgrndets4reportcount query failed');;
       $rows=mysql_fetch_array($result,MYSQL_ASSOC);
       $numrow=$rows['numrows'];
     }
    function getAllVendors()
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select recnum, name, id, type, phone, city, state, zipcode, country
                 from company
				 where type = 'VEND'  and status = 'Active'
				 order by name";
       $result = mysql_query($sql);
       if(!$result) die("Access to Vendor companies didn't work. " . mysql_error());
       return $result;

    }

     function getgrndets4reportexport($cond)
    {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select grn.grnnum, grn.recieved_date,
                    grn.invoice_num,c.name
               from  grn grn,company c
               where $wcond and
                     grn.rmbycim != '' and
                     grn.rmbycust = '' and
                     grn.grntype != 'Quarantined' and
                     grn.`status` !='Cancelled' and
                     c.recnum=grn.link2vendor
               group by grn.grnnum
               order by grn.grnnum";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }
    
     function getboistockbygrn($cond,$argoffset,$arglimit)
    {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select grn.grnnum, grn.recieved_date,
                     grn.raw_mat_type, grn.raw_mat_spec,
                     sum(grn.qtm), grn.crn ,grn.rmbycim,sum(grn.qty_used),sum(grn.qty_ret),grnli.partnum
               from grn_li grnli, grn grn
               where $wcond and
                     grn.recnum = grnli.link2grn and
                     (grnli.amendlinenum = ''  or grnli.amendlinenum is null or grnli.amendlinenum = 0 ) and
                      grn.grntype != 'Quarantined' and
                     grn.`status` !='Cancelled'   and
                     grn.grntype='Boughtout'
               group by grnli.partnum
               order by grn.grnnum
               limit $offset,$limit ";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }

    function getboistockbygrndets($partnum)
    {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select ali.partnum,aw.assy_wonum,
                     ali.qty_wo,grnli.partnum
                     from grn grn,grn_li grnli,assywo_li ali,assy_wo aw
                     where grn.recnum = grnli.link2grn and
                     (grnli.amendlinenum = ''  or grnli.amendlinenum is null or grnli.amendlinenum = 0 ) and
                      grn.grntype != 'Quarantined' and
                     grn.`status` !='Cancelled'   and
                     grn.grntype='Boughtout' and
                     ali.partnum=grnli.partnum and
                     ali.partnum='$partnum' and
                     ali.link2assywo=aw.recnum";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }
     function getassyqty4grn($partnum)
     {
        $newlogin = new userlogin;
           $newlogin->dbconnect();
           $grnnum = trim($inpgrnnum);
           $sql = "select wo.assy_wonum,wo.assydate,sum(ali.qty_acc),sum(ali.qty_rew),
                        sum(ali.qty_rej),sum(ali.qty_ret),sum(ali.qty_wo)
                 from assywo_li ali,assy_wo wo
                 left join assy_part_status wps on wps.link2assywo = wo.recnum
                   and (wps.stage = 'final' or wps.stage = 'Final' or
                       wps.stage = 'FINAL' or wps.stage = 'fi' or
                       wps.stage = 'FI' or wps.stage = 'Fi')
                 where
                       ali.partnum = '$partnum' and
                       ali.link2assywo=wo.recnum
                  group by ali.partnum
                  ";
          //echo "$sql<br>";
          $result = mysql_query($sql);
          if(!$result) die("Get MI details query failed..Please report to Sysadmin. " . mysql_error());
          return $result;
     }
      function getwodetailsinprogress() {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select w.wonum,w.crn_num,w.qty
                   from work_order w
                 where w.`condition`='Open'
                 group by w.wonum";
        // echo $sql;
        $result = mysql_query($sql);
        return $result;
}
     
    function getwipdets($cond)
    {
      //echo '$cond'.$cond; $cond and
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select op.crn,wo.wonum,wo.qty,
                     sum((oper_mc_usage.running_time*60)+oper_mc_usage.running_time_mins)+
                     sum((oper_mc_usage.setting_time*60)+oper_mc_usage.setting_time_mins),
                     sum((mc_stage_master.running_time*60)+(mc_stage_master.running_time_mins))+
                     sum((mc_stage_master.setting_time*60)+(mc_stage_master.setting_time_mins)), op.mc_name
                     from operator op,  mc_master,work_order wo,mc_stage_master
                          left outer join oper_mc_usage on oper_mc_usage.stage_num=mc_stage_master.stage_num
                          where $cond and
                                mc_master.crn_num = op.crn and
                                mc_master.crn_num = wo.crn_num and
                                mc_stage_master.link2mc_master=mc_master.recnum and
                                op.recnum = oper_mc_usage.link2operator and
                                op.wo_num = wo.wonum  and
                                op.st_date between '2012-08-01' and '2020-08-31' and
                                wo.`condition`='Open'
                                group by  op.wo_num
                                order by (wo.crn_num)";
             // echo $sql."<br>";
             // echo'-----';
        $result = mysql_query($sql);
        if(!$result) die("getwipdets failed. " . mysql_error());
        return $result;
     }
     
     function getmc_hrcost($mcname)
     {
     
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select mcname,mccost as mc_cost,currency
                     from mc_cost
                          where mcname='$mcname'";
             // echo $sql."<br>";
             // echo'-----';
        $result = mysql_query($sql);
        if(!$result) die("getwipdets failed. " . mysql_error());
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $mc_cost = $row['mc_cost'];
        return $mc_cost;
     
     }
     
      function getsubcntdets($cond,$offset,$limit)
    {
      //echo '$cond'.$cond; $cond and
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select op.crn,sum(oper_mc_usage.qty),op.mc_name,
                     sum((oper_mc_usage.running_time*60)+oper_mc_usage.running_time_mins)+
                     sum((oper_mc_usage.setting_time*60)+oper_mc_usage.setting_time_mins) as process_hrs
                     from operator op,  mc_master,mc_stage_master
                          left outer join oper_mc_usage on oper_mc_usage.stage_num=mc_stage_master.stage_num
                          where $cond and
                                mc_master.crn_num = op.crn and
                                mc_stage_master.link2mc_master=mc_master.recnum and
                                op.recnum = oper_mc_usage.link2operator and
                                op.st_date between '2012-08-01' and '2020-08-31'
                                group by  op.crn
                                order by (op.crn) limit $offset,$limit";
            //  echo $sql."<br>";
             // echo'-----';
        $result = mysql_query($sql);
        if(!$result) die("getsubcntdets failed. " . mysql_error());
        return $result;
     }
     
       function getsubcntdets_count($cond)
    {
      //echo '$cond'.$cond; $cond and
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select count(*) as numrows
                     from operator op,  mc_master,mc_stage_master
                          left outer join oper_mc_usage on oper_mc_usage.stage_num=mc_stage_master.stage_num
                          where $cond and
                                mc_master.crn_num = op.crn and
                                mc_stage_master.link2mc_master=mc_master.recnum and
                                op.recnum = oper_mc_usage.link2operator and
                                op.st_date between '2012-08-01' and '2020-08-31'
                                group by  op.crn
                                order by (op.crn)";
              //echo $sql."<br>";
             // echo'-----';
        $result = mysql_query($sql);
        if(!$result) die("getsubcntdets failed. " . mysql_error());
         //$row     = mysql_fetch_array($result, MYSQL_ASSOC);
        //$numrows = $row['numrows'];
        return $result;
     }

     
     function getfgstock4wo($cond,$argoffset,$arglimit)
     {  //limit $offset,$limit
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select wo.crn_num,wo.po_num,sum(wo.comp_qty),sum(wo.dispatch_qty),sum(wo.assy_qty)
                     from work_order wo
                      where $wcond and
                      (wo.`condition`='Closed' ||wo.`condition`='Open')
                      group by wo.crn_num
             order by wo.crn_num ";
      // echo $sql;
       $result = mysql_query($sql);
       return $result;
    }
    
    function get_fg_totalcost($cond)
   {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select wo.crn_num,wo.po_num,sum(wo.comp_qty),sum(wo.dispatch_qty),sum(wo.assy_qty)
                     from work_order wo
                      where $wcond and
                      wo.`condition`='Closed'
                      group by wo.crn_num
             order by wo.crn_num";
      // echo $sql;
       $result = mysql_query($sql);
       return $result;
    }
//to consider book_date
    
    function get_woqty_new($grnnum,$cond)
    {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "select w.grnnum,sum(w.qty)
                 from work_order w
                 where
                      w.grnnum = '$grnnum' and w.`condition` !='WO Cancelled' and w.`condition` !='Hold' and $cond
                 group by w.grnnum";
        //echo "$sql<br>";
        $result = mysql_query($sql);
        if(!$result) die("get_woqty_new query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }
//to consider book_date
function get_woretqty_new($grnnum,$cond)
{
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "select w.grnnum,sum(wps.ret)
                       from work_order w
                       left join wo_part_status wps on ((wps.link2wo = w.recnum) and (wps.stage = 'final' or wps.stage = 'Final' or
                       wps.stage = 'FINAL' or wps.stage = 'fi' or
                       wps.stage = 'FI' or wps.stage = 'Fi'))
                       where
                           w.grnnum = '$grnnum'  and w.`condition` !='WO Cancelled'and w.`condition` !='Hold'  and $cond
                 group by w.grnnum";
       // echo "$sql<br>";
        $result = mysql_query($sql);
        if(!$result) die("get_woretqty_new query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
}

 function get_stockbygrn4dir4bo($cond,$argoffset,$arglimit)
    {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $siteid = $_SESSION['siteid'];
      $siteval = "grn.siteid = '".$siteid."'";
      $sql=  "select grn.grnnum, grn.recieved_date,
                     grn.raw_mat_type, grn.raw_mat_spec,
                     grn.qtm, grn.crn ,grn.rmbycim ,grn.qty_used,grn.qty_ret,
                     grn.rm_cost,grn.rm_currency,'',
					 grnli.partnum, 
					 grnli.partdesc
               from  grn grn, grn_li grnli
               where $wcond and
                     grn.rmbycim != '' and
                     grn.rmbycust = '' and
                     (grn.grntype = 'Boughtout' || grn.grntype = 'Consummables')  and
                     grn.`status` !='Cancelled' and
					 grn.recnum = grnli.link2grn and $siteval
               order by grn.crn,grn.grnnum
               limit $offset,$limit ";
       // echo $sql;
       $result = mysql_query($sql);
       return $result;
    }


    function get_stockbygrn4dir4bo_count($cond,$argoffset,$arglimit)
    {
     $wcond = $cond;
     $offset = $argoffset;
     $limit = $arglimit;
     $siteid = $_SESSION['siteid'];
      $siteval = "grn.siteid = '".$siteid."'";
      $sql=  "select grn.grnnum, grn.recieved_date,
                     grn.raw_mat_type, grn.raw_mat_spec,
                     grn.qtm, grn.crn ,grn.rmbycim ,grn.qty_used,grn.qty_ret,
                     grn.rm_cost,grn.rm_currency,'',
					 grnli.partnum, 
					 grnli.partdesc
               from  grn grn, grn_li grnli
               where $wcond and
                     grn.rmbycim != '' and
                     grn.rmbycust = '' and
                     (grn.grntype = 'Boughtout' || grn.grntype = 'Consummables')  and
                     grn.`status` !='Cancelled' and
					 grn.recnum = grnli.link2grn and $siteval
               order by grn.crn,grn.grnnum
             ";
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     //echo $sql;
     $result  = mysql_query($sql) or die('stockgrn for bo count query failed');
     $numrows    = mysql_num_rows($result);
     return $numrows;
   }


    function get_woqty_new4bo($grnnum,$cond)
    {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "select ali.grn,sum(ali.qty_wo)
                 from assywo_li ali,assy_wo w
                 where
                      ali.grn = '$grnnum' and w.status !='Cancelled'  and
                      ali.link2assywo=w.recnum  and $cond
                 group by ali.grn";
        // echo "$sql<br>";
        //and $cond
        $result = mysql_query($sql);
        if(!$result) die("get_woqty_new query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }
     
     function get_woretqty_new4bo($grnnum,$cond)
{
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "select ali.grn,sum(ali.qty_ret)
                       from assywo_li ali,assy_wo wo
                       left join assy_part_status wps on wps.link2assywo = wo.recnum
                   and (wps.stage = 'final' or wps.stage = 'Final' or
                       wps.stage = 'FINAL' or wps.stage = 'fi' or
                       wps.stage = 'FI' or wps.stage = 'Fi')
                       where
                          ali.grn = '$grnnum' and
                       ali.link2assywo=wo.recnum
                  group by wo.assy_wonum
                  order by wo.assy_wonum";
       // echo "$sql<br>";
        $result = mysql_query($sql);
        if(!$result) die("get_woretqty_new query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
}

 function get_stockbygrn4dir4bo_exp($cond)
    {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select grn.grnnum, grn.recieved_date,
                     grn.raw_mat_type, grn.raw_mat_spec,
                     grn.qtm, grn.crn ,grn.rmbycim ,grn.qty_used,grn.qty_ret,
                     grn.rm_cost,grn.rm_currency
               from  grn grn
               where $wcond and
                     grn.rmbycim != '' and
                     grn.rmbycust = '' and
                     (grn.grntype = 'Boughtout' || grn.grntype = 'Consummables')  and
                     grn.`status` !='Cancelled'
               order by grn.crn,grn.grnnum";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }
    
   /*  function get_rmprice4bo($grnrecnum)
    {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "select v.rate,v.partnum
                 from vend_part_master v,grn_li gli
                 where
                      gli.link2grn = $grnrecnum and v.partnum =gli.  and
                      ali.link2assywo=w.recnum  and $cond
                 group by ali.grn";
        //echo "$sql<br>";
        //and $cond
        $result = mysql_query($sql);
        if(!$result) die("get_woqty_new query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     } */

    
function getncdets4opfi($opname,$condnc,$cond)
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql="select nc.refnum,sum(nc.qty),nc.wonum,nc.create_date
                     from nc4qa nc
                     where
                     nc.oper_name like '%$opname%' and 
                     nc.status !='Pending' 
                     and nc.final_insp='yes'
                     and nc.rejected='yes' and $condnc and nc.wonum NOT IN
                    (select op.wo_num from operator op where $cond) 
                     group by nc.refnum";
        //echo $sql."<br>";
        $result=mysql_query($sql)or die("getncdets4opfi failed...Please report to SysAdmin. " . mysql_error());
        return $result;
   }

    function getncdets4opip($opname,$condnc,$cond)
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql="select nc.refnum,sum(nc.qty),nc.wonum,nc.create_date
                     from nc4qa nc
                     where
                     nc.oper_name like '%$opname%' and 
                     nc.status !='Pending' 
                     and nc.inprocess='yes'
                     and nc.rejected='yes' and $condnc and nc.wonum NOT IN
                    (select op.wo_num from operator op where $cond) 
                     group by nc.refnum";
        //echo $sql."<br>";
        $result=mysql_query($sql)or die("getncdets4opip failed...Please report to SysAdmin. " . mysql_error());
        return $result;
   }
    
function getempid($dept)
{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql="select empid  from employee where dept='$dept'";
        //echo $sql."<br>";
        $result=mysql_query($sql)or die("getempid failed...Please report to SysAdmin. " . mysql_error());
        return $result;
}    

function num_nc_check($cond)
{
	 $newlogin = new userlogin;
     $newlogin->dbconnect();

	 $sql="select w.qty,w.comp_qty,w.wonum,nc.qty
           from work_order w,nc4qa nc
         where $cond and w.wonum=nc.wonum and
               w.crn_num=nc.refnum";
			   		//echo $sql."<br>";
        $result=mysql_query($sql)or die("num_nc_check failed...Please report to SysAdmin. " . mysql_error());
        return $result;
}
function check_4_FI_INSP($cond)
{
	 $newlogin = new userlogin;
     $newlogin->dbconnect();

	 $sql="select sum(w.qty),sum(w.comp_qty),w.wonum,
                  sum(case when nc.final_insp='yes' then nc.qty else 0 end) ,
                  sum(case when nc.inprocess='yes' then nc.qty else 0 end),
                  sum(case when nc.cust_end='yes' then nc.qty else 0 end ),w.crn_num,sum(nc.qty)
          from work_order w
		  left join nc4qa nc on w.wonum=nc.wonum and w.crn_num=nc.refnum
          where $cond 
		  group by nc.refnum";
			// echo $sql."<br>";
        $result=mysql_query($sql)or die("check_4_FI_INSP failed...Please report to SysAdmin. " . mysql_error());
        return $result;
}

 function get_thisweekdisp($cond)
{
	 $newlogin = new userlogin;
     $newlogin->dbconnect();

	 $sql="select d.recnum,d.crnnum,d.schedule_date,d.schedule_qty,sum(w.comp_qty),sum(w.dispatch_qty),sum(w.assy_qty)
           FROM delivery_sch d,work_order w
		   where $cond
		   group by d.crnnum,d.schedule_date
		   order by d.crnnum,d.schedule_date";	
		  // echo $sql;exit;   
        $result=mysql_query($sql)or die("get_thisweekdisp failed...Please report to SysAdmin. " . mysql_error());
        return $result;
}
 function getCRN4boi($partnum)
  {  
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select g.grnnum,'',g.crn,sum(g.qtm-g.qty_used+g.qty_ret)				
				from grn g,grn_li gli
				where   g.grntype='Boughtout' and g.status !='Cancelled' and
				g.recnum=gli.link2grn and gli.partnum like '$partnum%'
				group by gli.partnum
				order by gli.partnum";
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("getCRN4boi report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
  function getlob4boi($partnum)
{
   	  $newlogin = new userlogin;
      $newlogin->dbconnect();
	  $qpa=intval($qpa);
      $sql=  "select  bbo.partnum,b.crn,((sch.schedule_qty - sch.disp_qty)*bbo.qpa)
					 ,sch.schedule_date
			  from bom b, bom_bought_items bbo, delivery_sch sch
			  where b.recnum = bbo.link2bom and
                    b.crn = sch.crnnum and b.status='Active' and
                    bbo.partnum like '$partnum%'
              order by bbo.partnum,sch.schedule_date,b.crn";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
}


  function getcount_wo($cond)
{
   	  $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select  `condition`,count(*)
			  from work_order
			  where $cond
			  group by `condition`";
      /* echo $sql;
       exit;*/
        $result = mysql_query($sql);
		if(!$result) die("getcount_wo  report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
}

     
   function getopsummarystats()
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select opmc.oper_name,
                      op.crn,
                      case when sum(opmc.qty) is NULL THEN 0
                           else format(sum(opmc.qty),0)
                      end as QtyP,
                      case when sum(nc.qty) is NULL THEN 0
                           else format(sum(nc.qty),0)
                      end as QtyNC,
                      emp.empcode
                from
				    employee emp,
                    oper_mc_usage opmc,
                    operator op
                left join nc4qa nc on op.wo_num = nc.wonum and
                            nc.rejected = 'yes'
                where opmc.link2operator = op.recnum and
                      op.st_date >= '2012-10-25' and op.st_date <= '2013-09-30' and
					  op.oper_name = concat(emp.fname, ' ',emp.lname)
                group by op.oper_name,op.crn with rollup";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    
    }


function getdeliverReport($cond,$argoffset,$arglimit)
{
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $offset= $argoffset;
         $limit= $arglimit;
         $wcond = $cond;
         //echo $wcond;

         $sql = "select d.recnum,    
						d.dnnum,
						d.sent_treat_to,
						d.treat_deliver_to,
						d.crn,
						d.deliver_date,
						d.ponum,
						d.podate,
						d.poline_num,
						d.wonum,
						d.untreated_partnum,
						d.treated_partnum,
						d.part_iss,
						d.drg_iss,
						d.cos,
						d.mtl_spec,
						d.grn_num,
						d.batch_num,
						d.qty,
						d.status,
						d.type,
						dli.qty_recd,
						dli.qty_acc,
						dli.qty_rej,
						dli.qty_rewqa,
						dli.cofc_num,
						dli.cofc_date
            FROM delivery_note d	
			left join delivery_note_li dli on 
			         dli.link2delivery = d.recnum 
            where $wcond		    
            order by d.recnum limit $offset,$limit";
          //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("getdeliverSummary query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
}

function getdeliverSummaryCount($cond,$argoffset,$arglimit)
{
		$wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;

        $sql = "select count(*) as numrows
		        FROM delivery_note d
                where $wcond
                 order by d.recnum";
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $result  = mysql_query($sql) or die('assypo count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows;
}

function getdeliver4excel($cond)
{
         $newlogin = new userlogin;
         $newlogin->dbconnect();
    
         $wcond = $cond;       

  $sql = "select d.recnum,    
						d.dnnum,
						d.sent_treat_to,
						d.treat_deliver_to,
						d.crn,
						d.deliver_date,
						d.ponum,
						d.podate,
						d.poline_num,
						d.wonum,
						d.untreated_partnum,
						d.treated_partnum,
						d.part_iss,
						d.drg_iss,
						d.cos,
						d.mtl_spec,
						d.grn_num,
						d.batch_num,
						d.qty,
						d.status,
						d.type,
						dli.qty_recd,
						dli.qty_acc,
						dli.qty_rej,
						dli.qty_rewqa,
						dli.cofc_num,
						dli.cofc_date
            FROM delivery_note d	
			left join delivery_note_li dli on 
			         dli.link2delivery = d.recnum 
            where $wcond		    
            order by d.recnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("getdeliver4excel query failed..Please report to Sysadmin. " . mysql_error());
        return $result;

}

    function getwos4qtyupd()
	{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
   
        $sql = "select w.wonum,wps.rej
		        from work_order w, wo_part_status wps 
		        where wps.rej > 0 and w.`condition` = 'Open' and 
				w.treatment = 'With Treatment' and wps.stage = 'DN' and 
				w.recnum = wps.link2wo";
	    //echo "<br>$sql";
        $result = mysql_query($sql);
        if(!$result) die("getwos4qtyupd query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
	}

    function updwos4qty($wonum,$rejqty)
	{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
   
        $sql = "update work_order w set 
		          w.rej_qty = '$rejqty'
				 where w.wonum = '$wonum'";
		// echo "<br>$sql";
        $result = mysql_query($sql);
        if(!$result) die("updwos4qty query failed..Please report to Sysadmin. " . mysql_error());
	}
    
    function getlob($crn)
    {
   	  $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select crnnum,schedule_date,
                   (schedule_qty - disp_qty)
	          from delivery_sch
			  where crnnum like '$crn%' and
			         status = 'Open' and
					 (schedule_qty - disp_qty) > 0
			  order by crnnum,schedule_date asc;
			  ";
        // echo $sql;
        $result = mysql_query($sql);
        return $result;

    }

	function getfgstock($crn)
	{
	    $newlogin = new userlogin;
        $newlogin->dbconnect();
   
        $sql = "select c.id,sum(w.qty),
		               sum(w.comp_qty), 
		               sum(w.dispatch_qty)
				 from work_order w, company c
				 where w.crn_num like '$crn%' and
				       w.wo2customer = c.recnum
			      group by c.id,w.crn_num";
		//echo "<br>$sql";
        $result = mysql_query($sql);
        if(!$result) die("updwos4qty query failed..Please report to Sysadmin. " . mysql_error());
		return $result;
    }
	function getgrnstock($crn)
	{
	    $newlogin = new userlogin;
        $newlogin->dbconnect();
   
        $sql = "select crn,sum(qtm-qty_used)
	             from grn 
				 where crn like '$crn%'";
		//echo "<br>$sql";
        $result = mysql_query($sql);
        if(!$result) die("updwos4qty query failed..Please report to Sysadmin. " . mysql_error());
		return $result;
    }



    function getlob1($crn,$crntype)
{
      $newlogin = new userlogin;
      $newlogin->dbconnect();

      // $assycrn = substr($crn,2,2);
      if($crntype =='Assembly' || $crntype =='Kit' )
      {
      $sql=  "select crnnum, schedule_date,
                   (schedule_qty - disp_qty)
            from delivery_sch
        where crnnum like ('%$crn%') and status ='Open'
        order by crnnum,schedule_date" ;
        // echo $sql;
      }
      else
      {

      $sql=  "select crnnum, schedule_date,
                   (schedule_qty - disp_qty)
            from delivery_sch
        where crnnum like ('$crn%') and status ='Open'
        order by crnnum,schedule_date" ;

      } 
      // echo $sql;
      $result = mysql_query($sql);
      return $result;

}
    function get_machine(){

      $siteid = $_SESSION['siteid'];
      $siteval = "siteid = '".$siteid."'";
    $query = "select distinct mc_name 
                     from mc_capacity_master 
                     where $siteval
                     order by mc_name asc";
                     // echo $query;
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $result = mysql_query($query);
    return $result;


  }

  function getpartnumboughtout1($crn,$partnum)
{
      $newlogin = new userlogin;
      $newlogin->dbconnect(); 

      $sql =" select  distinct(bmi.partnum), bmi.qpa, b.crn  from
               bom b, bom_bought_items bmi
              where b.recnum = bmi.link2bom and 
              b.status ='Active' and
              b.crn = '$crn' and bmi.partnum = '$partnum'" ;
         // echo $sql;
        $result = mysql_query($sql);
        return $result;
}

function getfgforboughtout($partnum)
{
      $newlogin = new userlogin;
      $newlogin->dbconnect(); 

      $sql =" select sum(g.qtm), sum(g.qty_used), sum(g.qty_quar), gli.partnum, sum(g.qty_ret)  
              from grn g, grn_li gli  where
               g.recnum = gli.link2grn and 
               g.`grntype` != 'Quarantined' and 
               gli.partnum ='$partnum' and status ='Open' group by gli.partnum ";
               // echo $sql;
        $result = mysql_query($sql);
        return $result;

}

 function getcrntype($crn)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect(); 

        $sql ="select m.recnum,m.type,m.treat,m.Cim_refnum
                      from master_data m
                      where m.status = 'Active'  and
                            m.Cim_refnum = '$crn' ";
                           // echo $sql;exit;
          $result = mysql_query($sql);
         $myrow = mysql_fetch_row($result);
          $type = $myrow[1];
          return $type;

  }


  function get_grnclbal($cond,$argoffset,$arglimit)
    {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $siteid = $_SESSION['siteid'];
      $siteval = "g.siteid = '".$siteid."'";
      $sql=  "select g.recno,g.iss_date,g.grnnum,g.wonum,g.clbal,g.opbal,g.qty4wo,g.wo_status from grn_issue g 
                        where $wcond and $siteval group by g.iss_date
               limit $offset,$limit ";
       // echo $sql;
       $result = mysql_query($sql);
       return $result;
    }


    function getpendingdelivery_sch($crn,$crecnum)
{
      $newlogin = new userlogin;
      $newlogin->dbconnect();
        
      $sql=  "select dl.crnnum, dl.schedule_date,(dl.schedule_qty - dl.disp_qty),dl.partnum,d.relnotenum,d.schdate,d.disp_date,dl.disp_qty
                from delivery_sch dl left join dispatch d on dl.crnnum = d.crn  and $crecnum
                where dl.crnnum like ('$crn%') and
                (dl.parent_crnnum ='' or dl.parent_crnnum IS NULL) 
                  and dl.crnnum !='' 
                 order by dl.schedule_date" ;
      
      // echo $sql;
       $result = mysql_query($sql);
      return $result;

}


    function getcompany($crn)
{
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $userid = "'".$_SESSION['user']."'";
        
      $sql=  "select c.recnum from company c,contact cont,
                     user u where c.recnum = cont.contact2company 
                     and u.user2contact = cont.recnum and u.userid = $userid" ;
      
      // echo $sql;
       $result = mysql_query($sql);
      return $result;

}


function getpenddelivery_sch4weeks($crn)
{
      $newlogin = new userlogin;
      $newlogin->dbconnect();
        
      $sql=  "select crnnum, schedule_date,(schedule_qty - disp_qty),partnum
                from delivery_sch
                where crnnum like ('$crn%') and
                (parent_crnnum ='' or parent_crnnum IS NULL)  and schedule_date <= DATE_ADD(CURDATE(), INTERVAL 4 WEEK) and (schedule_qty-disp_qty)>0
                  and crnnum !='' 
                 order by crnnum,schedule_date" ;
      
      // echo $sql;
       $result = mysql_query($sql);
      return $result;

}

}// End report class definition
