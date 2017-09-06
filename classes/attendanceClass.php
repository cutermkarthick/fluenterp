<?php 
include_once('loginClass.php');
class Attendance {

	function Attendance()
	{
		
	}

  	function getattendance_monthly($argoffset,$arglimit,$month,$year,$cond)
  	{
	    $newlogin = new userlogin;
	    $newlogin->dbconnect();

	    $offset= $argoffset;
	    $limit= $arglimit;
	    $siteid = $_SESSION['siteid'];
	    $siteval = "pms.siteid = '".$siteid."'";

   		 $sql = "select pms.id as empid,pms.basic_salary, pms.name,pms.join_date,
                   		am.recnum,am.days_come
	            from payroll_master pms left join attendance_monthly am on pms.id =  am.empid and substr(am.date,6,2) = $month and substr(am.date,1,4) = $year
	            where $siteval  and pms.name like'%' 
	            order by pms.recnum
	            limit $offset, $limit";

	    // echo "$sql <br>";
	    $result = mysql_query($sql);
	    return $result;
  	}

  	public function getAttendance_monthly_details($empid,$month,$year)
  	{
      	$newlogin = new userlogin;
      	$newlogin->dbconnect();

      	$siteid = $_SESSION['siteid'];
      	$siteval = "pms.siteid = '".$siteid."'";

      	$sql = "select a.recnum,
                       a.empid,
                       a.date,
                       a.siteid,
                       a.checkInOut,
                       a.Lat,
                       a.Lon,
                       e.shift_group,
                       ec.start_hour,
                       ec.start_min,
                       ec.end_hour,
                       ec.end_min
                from attendance a, employee e, employee_config ec
                where a.empid = '$empid' and
                	  e.empid = a.empid and 
                	  ec.shift = e.shift_group and
                    substr(a.date,6,2) = $month and substr(a.date,1,4) = $year 
                order by a.recnum asc ";

      	// echo "$sql <br>";
      	$result = mysql_query($sql);
      	return $result;
  	}

  	function getAllEmps4Ams($empid)  
  	{
	    $newlogin = new userlogin;
	    $newlogin->dbconnect();
	    $siteid = $_SESSION['siteid'];
	    $siteval = "e.siteid = '".$siteid."'";
	    $sql =  "select e.fname, e.lname, e.recnum, e.role,
                    e.empid, e.title, e.phone, e.email,
                    e.status,e.shift_group,c.name,e.shift_group,
                    ec.start_hour,ec.start_min,ec.end_hour,ec.end_min,
                    a.days_come,a.date 
              from  company c, employee e
              left join employee_config ec on ec.shift = e.shift_group
              left join attendance_monthly a on a.empid = e.empid
              where
	                  e.employee2company = c.recnum and
	                  e.status = 'Active' and 
	                  e.empid = '$empid' and
	                  $siteval";
	    // echo "$sql <br>";
	    $result = mysql_query($sql);
	    return $result;

  	}

  	public function getAttendanceDaysCount($empid,$month,$year)
  	{
  		$newlogin = new userlogin;
	    $newlogin->dbconnect();

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
  		$newlogin = new userlogin;
	    $newlogin->dbconnect();

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
  		$newlogin = new userlogin;
	    $newlogin->dbconnect();
	    $siteid = $_SESSION['siteid'];
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

}