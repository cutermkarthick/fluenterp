<?php


/**
* 
*/
class RestApi
{
	var $username,
      $password,
      $siteid,
      $user2employee,
      $usertype,
      $user2company,
      $token,
      $userid,
      $userrecnum;
	function RestApi()
	{  
    $this->username = '';
    $this->password = '';
    $this->siteid = '';
    $this->user2employee = '';
    $this->usertype = '';
    $this->user2company = '';
    $this->token = '';
    $this->userid = '';
		$this->userrecnum = '';
	}

  public function setusername($username)
  {
    $this->username = $username;
  }
  public function setpassword($password)
  {
    $this->password = $password;
  }
  public function setsiteid($siteid)
  {
    $this->siteid = $siteid;
  }
  public function setuser2employee($user2employee)
  {
    $this->user2employee = $user2employee;
  }
  public function setusertype($usertype)
  {
    $this->usertype = $usertype;
  }
  public function setuser2company($user2company)
  {
    $this->user2company = $user2company;
  }
  public function settoken($token)
  {
    $this->token = $token;
  }
  public function setuserid($userid)
  {
    $this->userid = $userid;
  }
  public function setuserrecnum($userrecnum)
  {
    $this->userrecnum = $userrecnum;
  }


  function getEmpDept($username)
  {
        $password=$userpassword;

        $sql = "select user2employee from user where userid='$username'";
        $result = mysql_query($sql);
        $myrow=mysql_fetch_row($result);
        $recnum = $myrow[0];
        
       // echo $recnum;
        
        $sql = "select dept,phone,subscription_type 
                from employee 
                where recnum='$recnum'  ";
        $result1 = mysql_query($sql);
        
        $myrow1=mysql_fetch_row($result1);
        $dept = $myrow1[0];
        $phone = $myrow1[1];
        $subscription_type = $myrow1[2];

        $emp_details = array('dept' => $dept, 'mobile'=> $phone,
                            'subscription_type'=> $subscription_type);

        //echo $res;

        return $emp_details;

    }
  public function checkuser($inpuserName, $inpuserPassword, $siteid)
  {

        $username = "'" . $inpuserName . "'";
        $userpwd = "'" . md5($inpuserPassword) . "'";
        // Connect to database


        // Get data
        // $query = "select userid,password,type, user2contact, user2employee from user
        //             where userid = $username and password = md5($userpwd)";
        $query = "select userid,password,type, user2contact, user2employee,recnum from user
                   where userid = $username and password = $userpwd";
        //echo $query;
        $result = mysql_query($query);
        $myrow = mysql_fetch_row($result);

        // Test to make sure query worked
        if(!$result) die("Login failed. " . mysql_error());

        // Get the password from the database
        $actualUserid = $myrow[0];
        $actualPassword = $myrow[1];

        if($myrow[0] == '') return;

        $usertype = $myrow[2];
        $usercompany = $myrow[3];
        $employee = $myrow[4];
        $recnum=$myrow[5];
       

        if ($usertype == 'EMPL' || $usertype=='MOBILE') {
           $query = "select c.id,e.role,c.lat,c.lon 
                      from employee e, company c
                       where e.recnum = $employee and
                             e.employee2company = c.recnum";
                              //echo $query;
        }

        else {
           $query = "select c.siteid from contact cont, company c
                       where cont.recnum = $usercompany and
                             cont.contact2company = c.recnum";
                             // echo $query;exit;
        }

        $result = mysql_query($query);
        $myrow = mysql_fetch_row($result);
        if(!$result) die("Login2 failed. " . mysql_error());

        $userrole='';
        if(count($myrow)>1) $userrole=$myrow[1];

        if ($siteid != $myrow[0]) return;
        $lat = $myrow[2];
        $lon = $myrow[3];
        $token=array('username'=>$username,'usertype'=>$usertype,
                    'siteid'=>$siteid,'company'=>$usercompany,
                    'employee'=>$employee,'recnum'=>$recnum,
                    'userrole'=>$userrole,'lat'=>$lat,'lon'=>$lon);
        return $token;

  }

  public function getsiteid($value='')
  {
    $user2employee = "'" . $this->user2employee ."'";
    $usertype =  $this->usertype;
    $user2company = "'" .  $this->user2company ."'";

    if ($usertype == "EMPL") 
    {
      $sql = "select c.id 
              from employee e, company c
              where e.recnum = $user2employee and
                    e.employee2company = c.recnum";
    }
    else
    {
      $sql = "select c.id 
              from contact cont, company c
              where cont.recnum = $user2company and
                    cont.contact2company = c.recnum";
    }

    $result = mysql_query($sql);
    $myrow = mysql_fetch_row($result);
    return $myrow[0];
  }


	public function getallwo($cond,$argoffset,$arglimit, $wotype)
	{
		
		
		$wcond = $cond;
    $offset = $argoffset;
    $limit = $arglimit;

		$sql = "select w.wonum, w.wotype, c.name, w.po_num,w.po_date,
                           w.condition,w.condition, w.wo2type, emp.fname, emp.lname,
                           w.create_date, w.recnum, w.descr, u.initials,
                           date_format(w.sch_due_date,'%d %b %y') as sch_due_date,
                           date_format(w.actual_ship_date,'%d %b %y') as actual_ship_date,
                           date_format(w.book_date,'%d %b %y') as book_date,
                           date_format(w.revised_ship_date,'%d %b %y') as revised_ship_date,
                           reorder,b.bomnum,b.recnum,w.filename1, w.filename2,w.filename3,
                           w.filename4, w.qty, w.po_qty, grnnum, b.bomnum,w.woclassif,
                           mfg.mfg_id,md.CIM_refnum,w.tank_check,
                           w.cust_ref_no,w.fair_type,w.wo2mfg,md.earlist_nxtdue,md.tank_num
                       from work_order w
                           left join bom b on w.wo2bom = b.recnum
                           left join company c on w.wo2customer = c.recnum
                           left join employee emp on w.wo2employee = emp.recnum
                           left join user u on u.user2employee = emp.recnum
                           left join master_data md on md.recnum = w.link2masterdata
               			   left join mfg_order mfg on mfg.recnum = w.wo2mfg
                           $wcond $condwotype
                  order by w.recnum asc
                             limit $offset, $limit";
        // echo "$sql <br>"; exit;
        mysql_query('SET SQL_BIG_SELECTS=1');
        $result = mysql_query($sql);
        return $result;

	}

  public function check_po_exit($ponum, $po_line_num)
  {
      
      $sql = "select s.recnum, 
                     s.po_num,
                     soli.line_num,
                     soli.pin_num,
                     soli.qty,
                    soli.qty_for_grn,
                    s.order_date
              from sales_order s, so_line_items soli
              where s.recnum = soli.link2so and
                    s.po_num = '$ponum' and 
                    soli.line_num = '$po_line_num' ";

      // echo "$sql <br>"; exit;

      $result = mysql_query($sql);
      return $result;

  }

  public function getallso($cond)
  {
    $sql = "SELECT sales_order.recnum as rec, company.name, sales_order.description,
                       sales_order.order_date, sales_order.po_num, sales_order.grosstotal,
                       sales_order.total_due, sales_order.currency, sales_order.contact,
                       sales_order.quote_num, sales_order.order_date, so_line_items.partnum,
                       so_line_items.qty, work_order.qty,work_order.wonum,
                       work_order.comp_qty,so_line_items.amount,so_line_items.price,'' as worec,so_line_items.line_num as ln, sales_order.status,so_line_items.pin_num,so_line_items.disputd
                FROM  company , sales_order, so_line_items
                LEFT JOIN work_order ON so_line_items.po_num = work_order.po_num and
                            work_order.partnum = so_line_items.pin_num and work_order.po_linenum = so_line_items.line_num and (work_order.`condition` = 'Open' || work_order.`condition` = 'Closed')
                where  $cond
                      sales_order.so2customer = company.recnum and
                      sales_order.recnum = so_line_items.link2so
               order by rec,ln,worec";
    // echo "$sql <br>";
    $result = mysql_query($sql);
    return $result;
  }

  function getdispatch_qty($wonum,$partnum)
  {

    $sql = "SELECT wo_no,sum(qty)
            FROM cofc
            where wo_no = '$wonum'
            and part_no='$partnum' group by wo_no";

    $result = mysql_query($sql);
    return $result;
 }

  function getToken() {
    $length=32;
    $count=1;
    $characters="lower_case,numbers";
    // $length - the length of the generated password
    // $count - number of passwords to be generated
    // $characters - types of characters to be used in the password
     
    // define variables used within the function    
    $symbols = array();
    $token = array();
    $used_symbols = '';
    $pass = '';
 
  // an array of different character types    
    $symbols["lower_case"] = 'abcdefghijklmnopqrstuvwxyz';
    // $symbols["upper_case"] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $symbols["numbers"] = '1234567890';
    // $symbols["special_symbols"] = '!?@#-_';
 
    $characters = split(",",$characters); // get characters types to be used for the passsword
    foreach ($characters as $key=>$value) {
        $used_symbols .= $symbols[$value]; // build a string with all characters
    }
    $symbols_length = strlen($used_symbols) - 1; //strlen starts from 0 so to get number of characters deduct 1
     
    for ($p = 0; $p < $count; $p++) {
        $pass = '';
        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, $symbols_length); // get a random character from the string with all characters
            $pass .= $used_symbols[$n]; // add the character to the password string
        }
        $token[] = $pass;
    }
     
    return $token; // return the generated password
  }

  public function insertToken($res)
  {
      $link2user = "'". $res['recnum'] ."'";
      $token = "'". $this->token ."'";
      $expires_in = "'". 3600*24 ."'";

      $sql = "insert into token (link2user,token,expires_in,creation_time) values($link2user,$token,$expires_in,UTC_TIMESTAMP())";
      $result = mysql_query($sql);
      return $result;
  }

  public function fetchToken($res)
  {
    $link2user = "'". $res['recnum'] ."'";

    $sql = "select recnum,link2user,token,expires_in ,creation_time
            from token 
            where link2user = $link2user";

    $result = mysql_query($sql);
    $myrow = mysql_fetch_row($result);

    if(!empty($myrow) )
    {
      if(!empty($res['token']))
      {
        if($myrow[2]!=$res['token']) return;
      }
      $exptime=new DateTime($myrow[4],new DateTimeZone("UTC"));
      
      $actial_exp_time = $exptime->getTimestamp();  

      $now = new DateTime(null, new DateTimeZone("UTC"));
      $now_unix=$now->getTimestamp();

      if($now_unix-$actial_exp_time>3600*24)
      {
        $qry = "delete
            from token 
            where link2user = $link2user";

         mysql_query($qry);
         return;
      }
      else
      {
         $up_query = "update
            token set creation_time=UTC_TIMESTAMP()
            where link2user = $link2user";

         mysql_query($up_query);
      }
    }
    return $myrow;

  }

  public function updateToken($res)
  {

    $link2user = "'". $res['recnum'] ."'";
    $token = "'". $this->token ."'";

    $sql = "update token set token = $token,$expires_in=NOW()
            where link2user = $link2user";

    $result = mysql_query($sql);
    return $result;
  }

  public function getapi_accesstoken($token)
  {
    $sql = "select recnum,link2user,token,expires_in 
            from token 
            where token = '$token'";

    $result = mysql_query($sql);
    $myrow = mysql_fetch_row($result);
    return $myrow[2];
  }
  public function LastCheckInStatus($empid,$taskid)
  {
    //1 for check in and 0 for checkout
    $sql = "select * from payroll_trans where empid='$empid' and date>=CURDATE() and TaskId = '$taskid'order by date desc,recnum desc limit 1";
    $result = mysql_query($sql);
    
    if(empty($result) )
    {
      return array("Status"=>0,"Time"=>"");
    }
    $myrow = mysql_fetch_row($result);
    return array("Status"=>$myrow[4],"Time"=>$myrow[2]);
  }

  public function CheckInOut($empid,$status,$siteid,$taskid,$emprecnum,$lat,$lon)
  {
      $sql = "insert into payroll_trans(empid,date,siteid,CheckInOut,TaskId,Lat,Lon) values('$empid',NOW(),'$siteid',$status,'$taskid','$lat','$lon') ";
      mysql_query($sql);
      $check_stts="";
      $task_started = "";
      if($status==0)$check_stts="Checkout";
      else if($status==1)$check_stts="Checkin";
      else if($status==2)$check_stts="Break";
      else return;
      
      $sql1 = "select status from tasks where task_id = '$taskid' and userrecnum='$emprecnum'";
      $result = mysql_query($sql1);
      $rows = mysql_fetch_row($result);
      if ($rows[0] == "Created" || $rows[0] == "Accepted") 
      {
       $task_started=",started_date=NOW()";
      }

      $tsk_update = "update tasks set status='$check_stts'  where task_id = '$taskid' and userrecnum='$emprecnum' ";
        
      mysql_query($tsk_update);
      
      return $this->LastCheckInStatus($empid,$taskid);
  }
  public function GetCompanyNames()
  {
      $sql = "select name from company ";
      $result = mysql_query($sql);
      $result_array=array();
      while($myrow = mysql_fetch_array($result))
      {
        $result_array[]=$myrow[0];
      }
      return ($result_array);
  }
  public function registeruser($name,$username,$password,$company,$mobile,$email)
  {
    $sql = "select nxtnum from seqnum where tablename='employee' ";
    $nxresult = mysql_query($sql);
    $nxrow=mysql_fetch_row($nxresult);
    $cur_id=$nxrow[0]+1;
    $emp_id = 'E'.$cur_id;

    $companyselect="select recnum,id from company where name='$company'";
    $cmpresult = mysql_query($companyselect);
    $cmprow=mysql_fetch_row($cmpresult);
    $linek2cmp=$cmprow[0];
    $siteid = $cmprow[1];
    $insertSql="insert into employee(recnum,empid,fname,lname,role,employee2company,phone,email,siteid) value($cur_id,'$emp_id','$name','$name','mobile',$linek2cmp,'$mobile','$email','$siteid')";
    mysql_query($insertSql);

    $updatesql = "update seqnum set nxtnum=$cur_id where tablename='employee' ";
    mysql_query($updatesql);

    $nextusersql="select nxtnum from seqnum where tablename='user' ";
    $nextuserresult=mysql_query($nextusersql);
    $nxuserrow=mysql_fetch_row($nextuserresult);
    $cur_user_id=$nxuserrow[0]+1;

    $updatesql = "insert into user(recnum,initials,userid,password,type,user2employee,creation_date,siteid) 
    values($cur_user_id,'$name','$username',MD5('$password'),'MOBILE','$cur_id',NOW(),'$siteid') ";
    mysql_query($updatesql);

    $updateusql = "update seqnum set nxtnum=$cur_user_id where tablename='user' ";
    mysql_query($updateusql);

  }

  public function GetTask4Users($userrecnum)
  {   
    $yesterday = date("Y-m-d", strtotime("-1 day"));
    $sql = "select * 
            from tasks 
            where userrecnum=$userrecnum and 
                  finish_date >= '$yesterday'";
    //echo $sql;
    $result = mysql_query($sql);
    $result_arr = array();
    while ($myrow = mysql_fetch_assoc($result)) {
      $result_arr[] = $myrow;
    }
    return $result_arr;

  }
  public function UpdateTaskStts($recnum,$status,$taskid)
  {
    $st_dt="";
    if($status=="Completed") {
      $st_dt=" ,act_complete_date = NOW() ";
    }else if($status=="Accepted") {
      $st_dt=" ,started_date = NOW() ";
    }
    $tsk_update = "update tasks set 
                          status='$status' $st_dt
                    where task_id = '$taskid' and userrecnum='$recnum' ";
    mysql_query($tsk_update);
  }
  public function CurrentWorkingHoursOfATask($employeeid,$siteid,$taskid,$recnum)
  {
    
      date_default_timezone_set("Asia/Kolkata");
      $sql="select * from payroll_trans where empid='$employeeid' and TaskId='$taskid' order by date";

      $result=mysql_query($sql);
      $prev_checkin_date_time="";
      $LastCheckSatus="";

      $total_sec=0;
      if(!$result) return 0;
      while ($row = mysql_fetch_assoc($result)) 
      {
        if($row['checkInOut']==1) 
        {
          $prev_checkin_date_time=$row['date'];
        }
        else if($row['checkInOut']==2 || $row['checkInOut']==0)
        {
            if($LastCheckSatus==1)
            {
              $current_date_time=$row['date'];

              $current_date_time_obj=new DateTime($current_date_time);
              $prev_checkin_date_time_obj=new DateTime($prev_checkin_date_time);

              $current_date_time_in_sec = $current_date_time_obj->getTimestamp();
              $prev_checkin_date_time_in_sec=$prev_checkin_date_time_obj->getTimestamp();
              $total_spent_seconds = $current_date_time_in_sec-$prev_checkin_date_time_in_sec;

              $total_sec+=$total_spent_seconds;
            }
        }
        $LastCheckSatus = $row['checkInOut'];
      }

      if ($LastCheckSatus == 1) {
        $now=new DateTime(null);
        $nowinsecs =  $now->getTimestamp();

        $prev_obj=new DateTime($prev_checkin_date_time);
        $prev_checkin=$prev_obj->getTimestamp();
        $total_spent = ($nowinsecs - $prev_checkin);
        $total_sec += $total_spent;
        
      }
      return $total_sec;
  }

  public function CheckDeviceId($deviceid,$devicetoken)
  {
    $sql = "select DeviceId,DeviceToken,Link2User,Mobile,Status
            from devices
            where DeviceId = '$deviceid'";
    $result = mysql_query($sql);
    $numrows = mysql_num_rows($result);
    return $numrows;
  }

  public function InsertDevice($deviceid,$devicetoken)
  {
    $sql = "insert into devices(
                        DeviceId,
                        DeviceToken)
                  values(
                        '$deviceid',
                        '$devicetoken'
                        )";
    $result = mysql_query($sql);
    return $result;
  }

  public function UpdateDevice($value)
  {
    $sql = "update devices set
                    DeviceToken = '".$value['devicetoken']."'
            where DeviceId = '".$value['deviceid']."'";

    $result = mysql_query($sql);
    $numrows = mysql_affected_rows($result);
    return $numrows;

  }

  public function UpdateDeviceDetails($value)
  {
    $sql = "update devices set
                    Link2User = '".$value['userrecnum']."',
                    Mobile = '".$value['mobile']."',
                    Status = '".$value['status']."'
            where DeviceId = '".$value['deviceid']."'";

    $result = mysql_query($sql);
    $numrows = mysql_affected_rows($result);
    return $numrows;

  }

  public function InsertAttendance($value)
  {

    $empid = $value['empid'];
    $mobile = $value['mobile'];
    $checkInOut = $value['stage'];
    $lat = $value['lat'];
    $lon = $value['lon'];
    $type = $value['type'];
    $status = $value['status'];
    $link2user = $value['userrecnum'];
    $siteid = $value['siteid'];
    $start_hour = $value['start_hour'];
    $start_min = $value['start_min'];
    $end_hour = $value['end_hour'];
    $end_min = $value['end_min'];

    $sql = "insert into attendance(
                      empid,
                      mobile,
                      checkInOut,
                      date,
                      lat,
                      lon,
                      type,
                      status,
                      link2user,
                      siteid,
                      start_hour,
                      start_min,
                      end_hour,
                      end_min
                      )
                    values(
                      '$empid',
                      '$mobile',
                      '$checkInOut',
                       NOW(),
                      '$lat',
                      '$lon',
                      '$type',
                      '$status',
                       '$link2user',
                       '$siteid',
                       '$start_hour',
                       '$start_min',
                       '$end_hour',
                       '$end_min'
                      )";
    // echo "$sql <br>";
    $result = mysql_query($sql);
    $insertid = mysql_insert_id();
    return $insertid;
  }

  public function GetShiftHours4Emp($value)
  {
    $empid = $value['empid'];
    $siteid = $value['siteid'];

    $sql = "select e.empid,
                   ec.start_hour,
                   ec.start_min,
                   ec.end_hour,
                   ec.end_min,
                   e.shift_group,
                   ec.link2company,
                   ec.siteid
            from employee e
            left join employee_config ec on ec.shift = e.shift_group  and 
                  ec.siteid = '$siteid'
            where e.empid = '$empid'";
    $result = mysql_query($sql);
    $myrow = mysql_fetch_assoc($result);
    return $myrow;
  }

  public function getAttendanceDaysCount($empid,$month,$year)
    {
      

      $sql = "select a.recnum,a.empid,a.date,
                substr(a.date,9,2)as start_date,
                substr(a.date,6,2)as month,
                substr(a.date,1,4) as year 
             from attendance a
             where empid = '$empid' and
                 substr(a.date,6,2) = $month and substr(a.date,1,4) = $year
              group by a.empid, year, month, start_date ";
      
      $result = mysql_query($sql);
      return $result;
    }

    public function CheckMonthlyAttendance($empid,$month,$year)
    {
      

      $sql ="select recnum,empid,mobile,date,
              days_come,month,year
          from attendance_monthly
          where empid = '$empid' and
              substr(date,6,2) = $month and substr(date,1,4) = $year";
      $result = mysql_query($sql);
      $numrows = mysql_num_rows($result);
      return $numrows;

    }

    public function InsertMonthlyAttendance($empid,$month,$year,$count)
    {
      
      $siteid = "FSI";
      $sql = "insert into attendance_monthly(
                empid,
                date,
                month,
                year,
                siteid,
                days_come)
          values(
              '$empid',
              NOW(),
              '$month',
              '$year',
              '$siteid',
              $count
              )";

      $result = mysql_query($sql);
      return $result;
    }

    public function UpdateMonthlyAttendance($empid,$month,$year,$count)
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect();

      $sql = "update attendance_monthly set
              days_come = $count
          where empid = '$empid' and
              substr(date,6,2) = $month and substr(date,1,4) = $year";
      $result = mysql_query($sql);
      return $result;
    }

    public function getMonthlyAttendance($empid,$month,$year)
    {
      

      $sql = "select a.recnum,a.empid,a.date,
                substr(a.date,9,2)as start_date,
                substr(a.date,6,2)as month,
                substr(a.date,1,4) as year,
                a.checkInOut,
                a.start_hour,
                a.start_min,
                a.end_hour,
                a.end_min 
             from attendance a
             where empid = '$empid' and
                 substr(a.date,6,2) = $month and substr(a.date,1,4) = $year";
      
      $result = mysql_query($sql);
      $details = array();
      $i = 1;
      $j = 1;
      $prev_time = '';
      while($myrow = mysql_fetch_assoc($result));
      {
        $date_split = explode(" ", $myrow['date']);
        $split_time = $date_split[1];
        $dates = $date_split[0];
       
        if ($myrow['checkInOut'] == 1) {
          $checkInOut = 'In';
        }else if ($myrow['checkInOut'] == 0) {
            $checkInOut = 'Out';
        }else if ($myrow['checkInOut'] == 2) {
            $checkInOut = 'Break';
        }

        if ($prev_time != "") {
          if ($checkInOut == "Out") {
              $datetime1 = new DateTime($prev_time);
              $datetime2 = new DateTime($myrow['date']);
              $interval = $datetime1->diff($datetime2);
              $elapsed = $interval->format('%h:%i:%s');
          }
          else{
              $elapsed = "";
          }
          
        }
        else{
          $elapsed = "0:0:0";
        }

        $details[$dates][] = array('seqnum' => $i,
                                'empid' => $myrow['empid'],
                                'date' => $myrow['date'],
                                'stage' => $checkInOut,
                                'elapsed' => $elapsed);

        $prev_time = $myrow['date'];

      }

      // foreach ($details as $key => $value) 
      // {
            
      // }
      echo "<pre>";
      print_r($details); exit;
      return $result;
    }


}



?>