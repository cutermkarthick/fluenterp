<?
//============================================
// Author: FSI
// Date-written = Jan 29, 2010
// Filename: mc_capacityClass.php
// Maintains the class for wms
// Revision: v1.0  OMS
//============================================
include_once('classes/loginClass.php');
class mc_capacity
{
	 var $mc_id,
         $mc_name,
         $avail_capacity,
		 $mc_series,
	     $dept,
		 $crnnum,
		 $runtime,
		 $operation,

		 $plan_month,
		 $plan_year,
		 $mc_cap_hrs,
		 $mc_avail_hrs,
		 $crn_qty,
		 $runtime_units,
		 $req_crn_hrs,
		 $balance_crn_hrs,
		 $balance_crn_qty,
		 $balance_mc_hrs,
		 $priority,
		 $start_date,
		 $start_time,
		 $end_date,

		 $end_time,
		 $start_time_meridiem,
		 $end_time_meridiem,
		 $partsperblank,
		 $units,
		 $sch_schqty,
		 $schedule_date,
		 $fgqty,
		 $totalfgqty,
		 $grn_qty,
		 $ff_qty,
		 $ff_qty_hrs;

function mc_capacity()
{
    $this->mc_id = '';
    $this->mc_name = '';	
    $this->avail_capacity = '';	
	$this->mc_series = '';	
	$this->dept ='';
	$this->crnnum ='';
	$this->runtime='';
	$this->operation='';

	$this->plan_month='';
	$this->plan_year='';
	$this->mc_cap_hrs='';
	$this->mc_avail_hrs='';
	$this->crn_qty='';
	$this->runtime_units='';
	$this->req_crn_hrs='';
	$this->balance_crn_hrs='';
	$this->balance_crn_qty='';
	$this->balance_mc_hrs='';
	$this->priority='';

	$this->start_date='';
	$this->start_time='';
	$this->end_date='';

	$this->end_time='';
	$this->start_time_meridiem='';
	$this->end_time_meridiem='';
	$this->partsperblank='';
	$this->units='';

	$this->sch_schqty='';
	$this->schedule_date='';
	$this->fgqty='';
	$this->totalfgqty='';
	$this->grn_qty='';
	$this->ff_qty='';
	$this->ff_qty_hrs='';
}
function getmc_id()
{
  return $this->mc_id;
}
function setmc_id($reqmc_id)
{
  $this->mc_id = $reqmc_id;
}
function getmc_name()
{
  return $this->mc_name;
}
function setmc_name($reqmc_name)
{
  $this->mc_name = $reqmc_name;
}

function getavail_capacity()
{
  return $this->avail_capacity;
}
function setavail_capacity($reqavail_capacity)
{
  $this->avail_capacity = $reqavail_capacity;
}

function getmc_series()
{
  return $this->mc_series;
}
function setmc_series($reqmc_series)
{
  $this->mc_series = $reqmc_series;
}
function getdept() 
{
   return $this->dept;
}
function setdept ($req_dept)
{
   $this->dept = $req_dept;
}

function getcrnnum()
{
  return $this->crnnum;
}
function setcrnnum($reqcrnnum)
{
  $this->crnnum = $reqcrnnum;
}

function getruntime()
{
  return $this->runtime;
}
function setruntime($reqruntime)
{
  $this->runtime = $reqruntime;
}

function getoperation()
{
  return $this->operation;
}
function setoperation($reqoperation)
{
  $this->operation = $reqoperation;
}


function getplan_month()
{
  return $this->plan_month;
}
function setplan_month($reqplan_month)
{
  $this->plan_month = $reqplan_month;
}

function getplan_year()
{
  return $this->plan_year;
}
function setplan_year($reqplan_year)
{
  $this->plan_year = $reqplan_year;
}

function getmc_cap_hrs()
{
  return $this->mc_cap_hrs;
}
function setmc_cap_hrs($reqmc_cap_hrs)
{
  $this->mc_cap_hrs = $reqmc_cap_hrs;
}

function getmc_avail_hrs()
{
  return $this->mc_avail_hrs;
}
function setmc_avail_hrs($reqmc_avail_hrs)
{
  $this->mc_avail_hrs = $reqmc_avail_hrs;
}

function getcrn_qty()
{
  return $this->crn_qty;
}
function setcrn_qty($reqcrn_qty)
{
  $this->crn_qty = $reqcrn_qty;
}

function getruntime_units()
{
  return $this->runtime_units;
}
function setruntime_units($reqruntime_units)
{
  $this->runtime_units = $reqruntime_units;
}

function getreq_crn_hrs()
{
  return $this->req_crn_hrs;
}
function setreq_crn_hrs($reqreq_crn_hrs)
{
  $this->req_crn_hrs = $reqreq_crn_hrs;
}

function getbalance_crn_hrs()
{
  return $this->balance_crn_hrs;
}
function setbalance_crn_hrs($reqbalance_crn_hrs)
{
  $this->balance_crn_hrs = $reqbalance_crn_hrs;
}

function getbalance_crn_qty()
{
  return $this->balance_crn_qty;
}
function setbalance_crn_qty($reqbalance_crn_qty)
{
  $this->balance_crn_qty = $reqbalance_crn_qty;
}

function getbalance_mc_hrs()
{
  return $this->balance_mc_hrs;
}
function setbalance_mc_hrs($reqbalance_mc_hrs)
{
  $this->balance_mc_hrs = $reqbalance_mc_hrs;
}

function getpriority()
{
  return $this->priority;
}
function setpriority($priority)
{
  $this->priority = $priority;
}	

function getstart_date()
{
  return $this->start_date;
}
function setstart_date($start_date)
{
  $this->start_date = $start_date;
}

function getstart_time()
{
  return $this->start_time;
}
function setstart_time($start_time)
{
  $this->start_time = $start_time;
}

function getend_date()
{
  return $this->end_date;
}
function setend_date($end_date)
{
  $this->end_date = $end_date;
}	
function getend_time()
{
  return $this->end_time;
}
function setend_time($end_time)
{
  $this->end_time = $end_time;
}

function getstart_time_meridiem()
{
  return $this->start_time_meridiem;
}
function setstart_time_meridiem($start_time_meridiem)
{
  $this->start_time_meridiem = $start_time_meridiem;
}

function getend_time_meridiem()
{
  return $this->end_time_meridiem;
}
function setend_time_meridiem($end_time_meridiem)
{
  $this->end_time_meridiem = $end_time_meridiem;
}

function setpartsperblank($partsperblank)
{
  $this->partsperblank = $partsperblank;
}

function setshift($shift)
{
  $this->shift = $shift;
}
function setunits($units)
{
  $this->units = $units;
}

function setsch_schqty($sch_schqty)
{
  $this->sch_schqty = $sch_schqty;
}

function setschedule_date($schedule_date)
{
  $this->schedule_date = $schedule_date;
}

function setfgqty($fgqty)
{
  $this->fgqty = $fgqty;
}

function settotalfgqty($totalfgqty)
{
  $this->totalfgqty = $totalfgqty;
}

function setgrn_qty($grn_qty)
{
  $this->grn_qty = $grn_qty;
}

function setff_qty($ff_qty)
{
  $this->ff_qty = $ff_qty;
}

function setff_qty_hrs($ff_qty_hrs)
{
  $this->ff_qty_hrs = $ff_qty_hrs;
}

function setrejqty($rejqty)
{
  $this->rejqty = $rejqty;
}


function getmc_capacity_master($cond,$argoffset,$arglimit)
{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $offset = $argoffset;
        $limit =  $arglimit;
        $siteid = $_SESSION['siteid'];
		if ($siteid != 'FSI') 
		{
		  $sid_cond = "siteid = '$siteid' ";
		}
		else
		{
		  $sid_cond = "(siteid = 'FSI' || siteid IS NULL || siteid = '') ";
		}

         $sql = "select recnum,
		                        mc_id,
								mc_name,
								avail_capacity,
								mc_series,
								month,
								year,
								units,
								shift
                  FROM mc_capacity_master
		               $cond and $sid_cond
                  order by year,month,mc_series,mc_name limit $offset,$limit";
				 // echo $sql;
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
}

function getmc_capacity_masterCount($cond,$argoffset,$arglimit)
{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $offset = $argoffset;
        $limit =  $arglimit;

        $siteid = $_SESSION['siteid'];
		if ($siteid != 'FSI') 
		{
		  $sid_cond = "siteid = '$siteid' ";
		}
		else
		{
		  $sid_cond = "(siteid = 'FSI' || siteid IS NULL || siteid = '') ";
		}

		
         $sql = "select count(recnum) as numrows
                  FROM mc_capacity_master
		          $cond and $sid_cond
                  order by recnum limit $offset,$limit";
        $result = mysql_query($sql);
        //echo "$sql";
        $result  = mysql_query($sql) or die('getmc_capacity_masterCount query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
       return $numrows;
}

function addmc_capacity()
{
	   $newlogin = new userlogin;
       $newlogin->dbconnect();
        
       $mc_id ="'" .$this->mc_id . "'";
	   $mc_name ="'" .$this->mc_name . "'";
	   $avail_capacity ="'" .$this->avail_capacity . "'";
	   $mc_series ="'" .$this->mc_series . "'";
	   $dept="'" .$this->dept . "'";
	   $month="'" .$this->plan_month . "'";
	   $year="'" .$this->plan_year . "'";
	   $shift="'" .$this->shift . "'";
	   $units="'" .$this->units . "'";
	   $siteid = "'" .$_SESSION['siteid']. "'";

	   $sql = "select * from mc_capacity_master 
	             where mc_id = $mc_id and 
				 mc_name=$mc_name and
				 month = $month and
				 year = $year and 
				 siteid = $siteid";	
	   //echo $sql;
       $result = mysql_query($sql);
       if (!(mysql_fetch_row($result))) {			

		  $sql = "INSERT INTO mc_capacity_master														
               (mc_id,mc_name,avail_capacity,mc_series,create_date,created_by,month,year,siteid,shift,units)
               VALUES 
			   ($mc_id,$mc_name,$avail_capacity,$mc_series,now(),$dept,$month,$year, $siteid, $shift, $units)";
	     // echo $sql;
	    }
	   else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("Machine:  " . $mc_name ." already exists ");
            echo "</td></tr></table>";
         } 
         $result = mysql_query($sql);
         // Test to make sure query worked
         if(!$result) die("Insert to MC Capacity didn't work..Please report to Sysadmin. " . mysql_error());
}
   function Updatemc_capacity($recnum)
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();  
		
        $mc_id ="'" .$this->mc_id . "'";
	    $mc_name ="'" .$this->mc_name . "'";
	    $avail_capacity ="'" .$this->avail_capacity . "'";
	    $mc_series ="'" .$this->mc_series . "'";
		$dept="'" .$this->dept . "'";
		$month="'" .$this->plan_month . "'";
	    $year="'" .$this->plan_year . "'";
	    $shift="'" .$this->shift . "'";
	     $units="'" .$this->units . "'";
	     /*
		$sql = "select * from mc_capacity_master 
		where mc_id = $mc_id and 
		mc_name=$mc_name and 
		recnum!=$recnum";
        $result = mysql_query($sql);
       if (!(mysql_fetch_row($result))) 
	   {
*/	       
		 $sql = "update mc_capacity_master set 		         
				        mc_id=$mc_id,
                        mc_name=$mc_name,
                        avail_capacity=$avail_capacity,
                        mc_series=$mc_series,	
						month=$month,
						year=$year,
						modified_date=now(),
						modified_by=$dept,
						shift = $shift,
						units = $units
			where recnum=$recnum";
/*
	   }
	   else
	   {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("Machine:  " . $mc_name ." already exists ");
            echo "</td></tr></table>";
       } 
*/
		 // echo $sql;  
		$result = mysql_query($sql);
 		// Test to make sure query worked
		if(!$result) die("Update to MC Capacity didn't work..Please report to Sysadmin. " . mysql_error());
    }

    public function getmc_capacitys($cond)
    {
    	$newlogin = new userlogin;
        $newlogin->dbconnect();
        $siteid = $_SESSION['siteid'];

		if ($siteid != 'FSI') 
		{
		  if ($cond != "") 
		  {
		  	$sid_cond = $cond . " and siteid = '$siteid' ";
		  }
		  else
		  {
		  	$sid_cond = "where siteid = '$siteid' ";
		  }
		  
		}
		else
		{
			  if ($cond != "") 
			  {
			  	$sid_cond = $cond . " and (siteid = 'FSI' || siteid IS NULL || siteid = '') ";
			  }
			  else
			  {
			  	$sid_cond = "where (siteid = 'FSI' || siteid IS NULL || siteid = '') ";
			  }

		  
		}


        $sql = "select recnum,
	                        mc_id,
							mc_name,
							avail_capacity,
							mc_series,
							month,
							year,
							shift,
							units
	                FROM mc_capacity_master
					$sid_cond";
		// echo "$sql";
		$result = mysql_query($sql);
        return $result;

    }

	function getmc_capacitys4req($mc,$mm, $yy)
	{
	        $newlogin = new userlogin;
	        $newlogin->dbconnect();
	        // $offset = $argoffset;
	        // $limit =  $arglimit;
	        $siteid = $_SESSION['siteid'];
	        if ($siteid != 'FSI') 
			{
			  $sid_cond = "siteid = '$siteid' ";
			}
			else
			{
			  $sid_cond = "(siteid = 'FSI' || siteid IS NULL || siteid = '') ";
			}
	        $sql = "select recnum,
	                        mc_id,
							mc_name,
							avail_capacity,
							mc_series,
							month,
							year,
							shift,
							units
	                FROM mc_capacity_master
					where mc_name like '$mc%' and
			             month like '$mm%' and
						 year like '$yy%' and 
						 $sid_cond
	                  order by year,month,mc_name ";
			// echo "$sql<br>";
	        $result = mysql_query($sql);
	        return $result;
	}
	function delete_mc_capacity($cond)
	{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $siteid = $_SESSION['siteid'];
		if ($siteid != 'FSI') 
		{
		  $sid_cond = "siteid = '$siteid' ";
		}
		else
		{
		  $sid_cond = "(siteid = 'FSI' || siteid IS NULL || siteid = '') ";
		}
		$sql = "delete from mc_capacity_master
		               $cond and $sid_cond";
				//  echo $sql;
        $result = mysql_query($sql);      
        return $result;
	}

function addcrn_mc()
{
	   $newlogin = new userlogin;
       $newlogin->dbconnect();
        
       $mc_id ="'" .$this->mc_id . "'";
	   $mc_name ="'" .$this->mc_name . "'";
	   $crnnum ="'" .$this->crnnum . "'";
	   $mc_series ="'" .$this->mc_series . "'";
	   $dept="'" .$this->dept . "'";

	   $runtime="'" .$this->runtime . "'";
	   $operation="'" .$this->operation . "'";

	   $month="'" .$this->plan_month . "'";
	   $year="'" .$this->plan_year . "'";
	   $partsperblank="'" .$this->partsperblank . "'";

	   $siteid="'" .$_SESSION['siteid'] . "'";

	   $sql = "select * from crn_mc where mc_name=$mc_name and crn=$crnnum and month=$month and year=$year and operation=$operation and siteid = $siteid";	
       $result = mysql_query($sql);
       if (!(mysql_fetch_row($result))) {			

		  $sql = "INSERT INTO crn_mc														
               (mc_id,mc_name,crn,mc_series,create_date,created_by,runtime_hrs,operation,month,year,siteid,blank)
               VALUES 
			   ($mc_id,$mc_name,$crnnum,$mc_series,now(),$dept,$runtime,$operation,$month,$year,$siteid, $partsperblank)";
	      //echo $sql;
	    }
	   else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("Machine:  " . $mc_name ." already exists ");
            echo "</td></tr></table>";
         } 
         $result = mysql_query($sql);
         // Test to make sure query worked
         if(!$result) die("Insert to CRN MC didn't work..Please report to Sysadmin. " . mysql_error());
}

function getcrn_mc_summary($cond)
{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        // $offset = $argoffset;
        // $limit =  $arglimit;

        $siteid = $_SESSION['siteid'];
		if ($siteid != 'FSI') 
		{
		  $sid_cond = "siteid = '$siteid' ";
		}
		else
		{
		  $sid_cond = "(siteid = 'FSI' || siteid IS NULL || siteid = '') ";
		}

         $sql = "select recnum,
		                mc_id,
						mc_name,
						mc_series,
						crn,
						runtime_hrs,
						operation,
						month,
						year,
						blank
                  FROM crn_mc
		          $cond and $sid_cond
				   order by mc_series,mc_name,crn";
	 	// echo $sql;
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
}
function getcrn_mc($recnum)
	{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        // $offset = $argoffset;
        // $limit =  $arglimit;
        $siteid = $_SESSION['siteid'];
		if ($siteid != 'FSI') 
		{
		  $sid_cond = "siteid = '$siteid' ";
		}
		else
		{
		  $sid_cond = "(siteid = 'FSI' || siteid IS NULL || siteid = '') ";
		}

		

         $sql = "select recnum,
		                mc_id,
						mc_name,
						mc_series,
						crn,
						runtime_hrs,
						operation,
						month,
						year,
						blank
                  FROM crn_mc
		          where recnum=$recnum and 
		          		$sid_cond";
				 // echo $sql;
        $result = mysql_query($sql);      
        return $result;
	}
	function Updatecrn_mc($recnum)
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();  
		
        $mc_id ="'" .$this->mc_id . "'";
	    $mc_name ="'" .$this->mc_name . "'";
	    $mc_series ="'" .$this->mc_series . "'";
		$crnnum ="'" .$this->crnnum . "'";
		$dept="'" .$this->dept . "'";

		$runtime="'" .$this->runtime . "'";
	    $operation="'" .$this->operation . "'";

		$month="'" .$this->plan_month . "'";
	    $year="'" .$this->plan_year . "'";
	    $partsperblank="'" .$this->partsperblank . "'";

		 $sql = "select * from crn_mc 
		         where mc_name=$mc_name and crn=$crnnum 
				        and month=$month and year=$year 
						and operation=$operation and recnum!=$recnum";	
		
       $result = mysql_query($sql);
       if (!(mysql_fetch_row($result))) 
	   {	       
		$sql = "update crn_mc set 		         
				        mc_id=$mc_id,
                        mc_name=$mc_name,
                        crn=$crnnum,
                        mc_series=$mc_series,					
						modified_date=now(),
						modified_by=$dept,
						runtime_hrs=$runtime,
						operation=$operation,
						month=$month,
						year=$year,
						blank=$partsperblank
			     where recnum=$recnum";
		 //echo $sql;      
		  }
	   else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("Machine:  " . $mc_name ." already exists ");
            echo "</td></tr></table>";
         } 

		$result = mysql_query($sql);

		if(!$result) die("Update to CRN MC didn't work..Please report to Sysadmin. " . mysql_error());
    }
	function get_all_mc()
	{
        $newlogin = new userlogin;
        $newlogin->dbconnect(); 
        $siteid = $_SESSION['siteid'];
		if ($siteid != 'FSI') 
		{
		  $sid_cond = "siteid = '$siteid' ";
		}
		else
		{
		  $sid_cond = "(siteid = 'FSI' || siteid IS NULL || siteid = '') ";
		}

	

		$sql = "select distinct mc_name from  mc_capacity_master where $sid_cond";
		// echo $sql;
		   
		$result = mysql_query($sql);
 	
		if(!$result) die("get_all_mc didn't work..Please report to Sysadmin. " . mysql_error());
		return $result;
	}
	function get_all_crn($mc_name,$crnnum)
	{
		$newlogin = new userlogin;
        $newlogin->dbconnect(); 

		$sql ="select *
					   from crn_mc  
					  where  mc_name='$mc_name' and
					         crn like '$crnnum%'
					  order by mc_series,crn,operation";
		// echo $sql;      
		$result = mysql_query($sql); 		
		if(!$result) die("get_all_crn didn't work..Please report to Sysadmin. " . mysql_error());
		return $result;
	}

	function addcapacity_plan()
	{
        $newlogin = new userlogin;
        $newlogin->dbconnect();

	    $month ="'" .$this->plan_month . "'";
	    $year ="'" .$this->plan_year . "'";
	    $mc_series ="'" .$this->mc_series . "'";
		$mc_id ="'" .$this->mc_id . "'";
		$dept="'" .$this->dept . "'";

		$mc_name="'" .$this->mc_name . "'";
	    $crn="'" .$this->crnnum . "'";
		$req_crn_hrs="'" .$this->req_crn_hrs . "'";
		$mc_cap_hrs="'" .$this->mc_cap_hrs . "'";
		$mc_avail_hrs="'" .$this->mc_avail_hrs . "'";
		$crn_qty="'" .$this->crn_qty . "'";
		$runtime_units="'" .$this->runtime_units . "'";
		$balance_crn_hrs="'" .$this->balance_crn_hrs . "'";
		$balance_crn_qty="'" .$this->balance_crn_qty . "'";
		$balance_mc_hrs="'" .$this->balance_mc_hrs . "'";	
		$operation="'" .$this->operation . "'";

		$start_date="'" .$this->start_date . "'";
		$start_time="'" .$this->start_time . "'";
		$end_date="'" .$this->end_date . "'";
		$end_time="'" .$this->end_time . "'";
		$start_time_meridiem="'" .$this->start_time_meridiem . "'";
		$end_time_meridiem="'" .$this->end_time_meridiem . "'";
		$partsperblank="'" .$this->partsperblank . "'";
		$units="'" .$this->units . "'";
		$shift="'" .$this->shift . "'";

		$sch_schqty = "'" .$this->sch_schqty . "'";
		$schedule_date = "'" .$this->schedule_date . "'";
		$fgqty = "'" .$this->fgqty . "'";
		$totalfgqty = "'" .$this->totalfgqty . "'";
		$grn_qty = "'" .$this->grn_qty . "'";

		$ff_qty = "'" .$this->ff_qty . "'";
		$ff_qty_hrs = "'" .$this->ff_qty_hrs . "'";

		$siteid = "'" .$_SESSION['siteid'] . "'";

        
	   $sql_2 = "select * from mc_capacity_plan
	             where plan_month = $month and plan_year=$year and
				 mc_series=$mc_series and mc_name=$mc_name and
				 crn=$crn and schedule_date= $schedule_date and operation=$operation and 
				 siteid = $siteid";
	   // echo $sql_2;exit;
	   $result = mysql_query($sql_2);
        if (mysql_num_rows($result) == 0)
	    {
		  $sql1 = "INSERT INTO mc_capacity_plan												
               (mc_id,mc_name,crn,plan_month,create_date,created_by,req_crn_hrs,mc_series,plan_year,mc_cap_hrs,mc_avail_hrs,crn_qty,runtime_units,balance_crn_hrs,balance_crn_qty,balance_mc_hrs,operation,start_date,end_date,start_time,
			   start_meridiem,end_meridiem,end_time, siteid, blank, units, shift, sch_qty, schedule_date, fgqty, totalfgqty, grn_qty, ff_qty, ff_qty_hrs)
               VALUES 
			   ($mc_id,$mc_name,$crn,$month,now(),$dept,$req_crn_hrs,$mc_series,$year,$mc_cap_hrs,$mc_avail_hrs,$crn_qty,$runtime_units,$balance_crn_hrs,$balance_crn_qty,$balance_mc_hrs,$operation,$start_date,$end_date,$start_time,$start_time_meridiem,$end_time_meridiem,$end_time, $siteid, $partsperblank, $units, $shift, $sch_schqty, $schedule_date, $fgqty, $totalfgqty, $grn_qty, $ff_qty, $ff_qty_hrs)";
	     // echo $sql1;exit;
		  $result_1 = mysql_query($sql1);
		   if(!$result_1) die("Insert toCapacity Plan didn't work..Please report to Sysadmin. " . mysql_error());
		   $result=1;
	    }
		else
		{
			$row=mysql_fetch_row($result);
			$sql="update mc_capacity_plan
					       set mc_id=$mc_id,
						   mc_name=$mc_name,
						   crn=$crn,
						   plan_month=$month,
						   modified_date=now(),
						   modified_by=$dept,
						   req_crn_hrs=$req_crn_hrs,
						   mc_series=$mc_series,
						   plan_year=$year,
						   mc_cap_hrs=$mc_cap_hrs,
						   mc_avail_hrs=$mc_avail_hrs,
						   crn_qty=$crn_qty,
						   runtime_units=$runtime_units,
						   balance_crn_hrs=$balance_crn_hrs,
						   balance_crn_qty=$balance_crn_qty,
						   balance_mc_hrs=$balance_mc_hrs,
						   operation=$operation,
						   start_date= $start_date ,
						   end_date= $end_date ,
						   start_time= $start_time ,
						   start_meridiem= $start_time_meridiem ,
						   end_time= $end_time ,
						   end_meridiem= $end_time_meridiem,
						   blank= $partsperblank,
						   sch_qty = $sch_schqty,
						   schedule_date = $schedule_date,
						   fgqty = $fgqty,
						   totalfgqty = $totalfgqty,
						   grn_qty = $grn_qty,
						   ff_qty = $ff_qty,
						   ff_qty_hrs = $ff_qty_hrs
				   where recnum=$row[0]";
				 // echo $sql;exit;
			$result_2 = mysql_query($sql);
		   if(!$result_2) die("Update toCapacity Plan didn't work..Please report to Sysadmin. " . mysql_error());
		   $result=2;
		}
		return $result;
	}

    function get_mc_capacity($mc_name,$month,$year)
	{
	   $newlogin = new userlogin;
       $newlogin->dbconnect();
       $siteid = $_SESSION['siteid'];


		if ($siteid != 'FSI') 
		{
		  $sid_cond = "siteid = '$siteid' ";
		}
		else
		{
		  $sid_cond = "(siteid = 'FSI' || siteid IS NULL || siteid = '') ";
		}

		

	   $sql = "select recnum,
		               mc_id,
					   mc_name,
					   mc_series,
					   avail_capacity,
					   month,
					   year
		         from mc_capacity_master 
				 where mc_name like trim('$mc_name') and 
				 	   month=trim('$month') and 
				 	   year=trim('$year') and 
				       $sid_cond
		         order by mc_name,year,month";	

		       /*   $sql =  "select recnum,
		               mc_id,
					   mc_name,
					   mc_series,
					   avail_capacity,
					   month,
					   year
		         from mc_capacity_master 
				 where mc_series like '$mc_series'
				 and month='$month ' and year='$year'
				      order by mc_series, mc_name,create_date desc limit 1";*/	
        // echo $sql."<br>";
		$result = mysql_query($sql); 		
		if(!$result) die("get machine capacity didn't work..Please report to Sysadmin. " . mysql_error());
		return $result;
	}

	function get_capacity_planchart($cond)
	{
		$newlogin = new userlogin;
        $newlogin->dbconnect();
        $siteid = $_SESSION['siteid'];
		if ($siteid != 'FSI') 
		{
		  $sid_cond = "siteid = '$siteid' ";
		}
		else
		{
		  $sid_cond = "(siteid = 'FSI' || siteid IS NULL || siteid = '') ";
		}

		
		$sql = "select * 
				from mc_capacity_plan 
				where $cond and 
						$sid_cond 
				order by  mc_name, crn";	

		// echo "$sql";
		$result = mysql_query($sql); 		
		if(!$result) die("get_capacity_plan didn't work..Please report to Sysadmin. " . mysql_error());
		return $result;
	}

	function get_crn_schedule($date)
	{
		$newlogin = new userlogin;
       $newlogin->dbconnect();

		$sql = "select (d.schedule_qty),d.crnnum,
		             c.operation, d.custcode
		        from delivery_sch d, 
				     crn_mc c
		        where d.schedule_date like '$date' and
				      d.crnnum=c.crn
				group by d.custcode, d.crnnum,c.operation";	
		// echo $sql;
		$result = mysql_query($sql); 		
		if(!$result) die("get_capacity_plan didn't work..Please report to Sysadmin. " . mysql_error());
		return $result;

	}

	function delete_capacity_plan($month,$year)
	{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $siteid = $_SESSION['siteid'];
		if ($siteid != 'FSI') 
		{
		  $sid_cond = "siteid = '$siteid' ";
		}
		else
		{
		  $sid_cond = "(siteid = 'FSI' || siteid IS NULL || siteid = '') ";
		}

		$sql = "delete from mc_capacity_plan where plan_month='$month' and plan_year='$year' and $sid_cond";		
		$result = mysql_query($sql); 		
		if(!$result) die("delete_capacity_plan didn't work..Please report to Sysadmin. " . mysql_error());
		return 1;
	}

	function get_capacity_plan4chart($cond)
	{
		$newlogin = new userlogin;
        $newlogin->dbconnect();

        $siteid = $_SESSION['siteid'];
		if ($siteid != 'FSI') 
		{
		  $sid_cond = "siteid = '$siteid' ";
		}
		else
		{
		  $sid_cond = "(siteid = 'FSI' || siteid IS NULL || siteid = '') ";
		}


		$sql = "select sum(crn_qty),
					   crn,
					   plan_month,
					   plan_year,
					   balance_crn_qty,
					   mc_name 
				from mc_capacity_plan 
				where $cond and 
					  $sid_cond";	
		// echo $sql;
		$result = mysql_query($sql); 		
		if(!$result) die("get_capacity_plan4chart didn't work..Please report to Sysadmin. " . mysql_error());
		return $result;
	}
	/*function getallmc_series($mc_name)
	{
	   $newlogin = new userlogin;
       $newlogin->dbconnect();

		$sql = "select mc_series from mc_capacity_master where mc_name='$mc_name' group by mc_series";	
		//echo $sql;
		$result = mysql_query($sql); 		
		if(!$result) die("getmc_series didn't work..Please report to Sysadmin. " . mysql_error());
		return $result;
	}*/




	function get_all_series($cond,$mc_name)
	{
		$newlogin = new userlogin;
        $newlogin->dbconnect();

        $siteid = $_SESSION['siteid'];
		if ($siteid != 'FSI') 
		{
		  $sid_cond = "siteid = '$siteid' ";
		}
		else
		{
		  $sid_cond = "(siteid = 'FSI' || siteid IS NULL || siteid = '') ";
		}

		$sql = "select mc_series,plan_month,plan_year,mc_name,crn
					from mc_capacity_plan 
					where  $cond and 
				          	mc_name like '$mc_name' and 
				          	$sid_cond
					group by  mc_name
					order by crn";	
		// echo "$sql <br>";
		$result = mysql_query($sql); 		
		if(!$result) die("get_all_series didn't work..Please report to Sysadmin. " . mysql_error());
		return $result;
	}

	function get_capacity_plan4reqcrnhrs($cond)
	{
		$newlogin = new userlogin;
        $newlogin->dbconnect();
        $siteid = $_SESSION['siteid'];

		if ($siteid != 'FSI') 
		{
		  $sid_cond = "siteid = '$siteid' ";
		}
		else
		{
		  $sid_cond = "(siteid = 'FSI' || siteid IS NULL || siteid = '') ";
		}


	
		$sql = "select  mc_id,mc_name,crn,plan_month,create_date,created_by,
		                     sum(FLOOR(req_crn_hrs)) as req_crn_hrs,mc_series,plan_year,mc_cap_hrs,mc_avail_hrs,crn_qty,
		                     runtime_units,(balance_crn_hrs),balance_crn_qty,balance_mc_hrs,operation,
		                     start_date,end_date,start_time,
					         start_meridiem,end_meridiem,plan_year,
							 crn,ff_qty_hrs
		           from mc_capacity_plan
				   where $cond and $sid_cond
                   group by mc_name,crn,plan_month,plan_year
				   ";	
		// echo $sql;
		$result = mysql_query($sql); 		
		if(!$result) die("get_capacity_plan didn't work..Please report to Sysadmin. " . mysql_error());
		return $result;
	}

function getlob($crn, $frm, $to)
{
   	  $newlogin = new userlogin;
      $newlogin->dbconnect();

      	$siteid = $_SESSION['siteid'];
		if ($siteid != 'FSI') 
		{
		  $sid_cond = "siteid = '$siteid' ";
		}
		else
		{
		  $sid_cond = "(siteid = 'FSI' || siteid IS NULL || siteid = '') ";
		}
// $sql=  "select crnnum, schedule_date,
//                    sum(schedule_qty - disp_qty)
// 	          from delivery_sch
// 			  where crnnum like '$crn%' and 
// 			              status ='Open' and
// 						   (schedule_qty - disp_qty) > 0 and
// 						   (to_days(schedule_date) >= to_days('$frm') and 
// 						   to_days(schedule_date) <= to_days('$to')) and 
// 						   $sid_cond
// 			   group by crnnum,substr(schedule_date, 6,2)
// 			  order by crnnum,substr(schedule_date, 6,2)" ;
	  
		

      $sql=  "select crnnum, schedule_date,
                   schedule_qty - disp_qty
	          from delivery_sch
			  where crnnum like '$crn%' and 
			              status ='Open' and
						   (schedule_qty - disp_qty) > 0 and
						   (to_days(schedule_date) >= to_days('$frm') and 
						   to_days(schedule_date) <= to_days('$to')) and 
						   $sid_cond
			   	  order by crnnum,schedule_date" ;
	  	// echo "$sql<br>";
       	$result = mysql_query($sql);
        return $result;

 }
function getlob_crnmc($crn,$mc,$month,$year)
{	

   	    $newlogin = new userlogin;
        $newlogin->dbconnect();

        $siteid = $_SESSION['siteid'];
		if ($siteid != 'FSI') 
		{
			$sid_cond = "sch.siteid = '$siteid' and crnmc.siteid = '$siteid'";
		}
		else
		{
			$sid_cond = "(sch.siteid = 'FSI' || sch.siteid IS NULL || sch.siteid = '') and (crnmc.siteid = 'FSI' || crnmc.siteid IS NULL || crnmc.siteid = '') ";
		}

 // $sql="select sch.crnnum, 
	// 					crnmc.runtime_hrs, 
	// 					crnmc.operation, 
	// 					crnmc.mc_name, 
	// 					sch. schedule_date, 
	// 					sum(sch.schedule_qty - sch.disp_qty), 
	// 					sum((sch.schedule_qty - sch.disp_qty) * crnmc.runtime_hrs) as crnhrs, 
	// 					substr(schedule_date, 6,2),
	// 					crnmc.blank 
	// 			from delivery_sch sch,crn_mc crnmc 
	// 			where sch.crnnum like '$crn%' and 
	// 					sch.status ='Open' and 
	// 					(sch.schedule_qty - sch.disp_qty) > 0 and 
	// 					substr(sch.schedule_date, 6,2) = '$month' and 
	// 					substr(sch.schedule_date, 1,4) = '$year' and 
	// 					crnmc.month = '$month' and 
	// 					crnmc.year = '$year' and 
	// 					mc_name like '$mc%' and 
	// 					sch.crnnum = crnmc.crn and 
	// 					$sid_cond
	// 			group by crnmc.mc_name,substr(sch.schedule_date, 6,2),crnmc.crn,crnmc.operation 
	// 			order by crnmc.mc_name,substr(sch.schedule_date, 6,2),sch.crnnum,crnmc.operation";

        $sql="select sch.crnnum, 
						crnmc.runtime_hrs, 
						crnmc.operation, 
						crnmc.mc_name, 
						sch. schedule_date, 
						sch.schedule_qty - sch.disp_qty, 
						((sch.schedule_qty - sch.disp_qty) * crnmc.runtime_hrs) as crnhrs, 
						schedule_date,
						crnmc.blank 
				from delivery_sch sch,crn_mc crnmc 
				where sch.crnnum like '$crn%' and 
						sch.status ='Open' and 
						(sch.schedule_qty - sch.disp_qty) > 0 and 
						substr(sch.schedule_date, 6,2) = '$month' and 
						substr(sch.schedule_date, 1,4) = '$year' and 
						crnmc.month = '$month' and 
						crnmc.year = '$year' and 
						mc_name like '$mc%' and 
						sch.crnnum = crnmc.crn and 
						$sid_cond
				order by crnmc.mc_name,sch.schedule_date,sch.crnnum,crnmc.operation";

	  	 // echo "<br>$sql";
        $result = mysql_query($sql);
        return $result;

 }

 function getmc_capacity($mc,$mm, $yy)
{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $offset = $argoffset;
        $limit =  $arglimit;
         $sql = "select recnum,
                        mc_id,
						mc_name,
						avail_capacity,
						mc_series,
						month,
						year
                  FROM mc_capacity_master
				  where mc_name like '$mc%' and
			             month like '$mm%' and
						 year like '$yy%'
                  order by year,month,mc_name ";
		// echo "$sql<br>";
        $result = mysql_query($sql);
        return $result;
}


 function getfg_qty1($crnnum)
{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
  
         $sql = "select sum(w.comp_qty)-sum(w.dispatch_qty)-sum(w.assy_qty) 
                        as FG                      
						from work_order w
						     where w.crn_num = '$crnnum'
						     group by w.crn_num";
		// echo "$sql<br>";
        $result = mysql_query($sql);
        $row = mysql_fetch_row($result);
        return $row[0];
}


	function getlob_crnmc_cnt($crn,$mc,$month,$year)
	{	

   	    $newlogin = new userlogin;
        $newlogin->dbconnect();

        $siteid = $_SESSION['siteid'];
		if ($siteid != 'FSI') 
		{
		  $sid_cond = "sch.siteid = '$siteid' and crnmc.siteid = '$siteid'";
		}
		else
		{
		  $sid_cond = "(sch.siteid = 'FSI' || sch.siteid IS NULL || sch.siteid = '') and (crnmc.siteid = 'FSI' || crnmc.siteid IS NULL || crnmc.siteid = '') ";
		}

        $sql="select count(*) as numrows 
				from delivery_sch sch,crn_mc crnmc 
				where sch.crnnum like '$crn%' and 
						sch.status ='Open' and 
						(sch.schedule_qty - sch.disp_qty) > 0 and 
						SUBSTRING(sch.schedule_date, 6,2) = '$month' and 
						SUBSTRING(sch.schedule_date, 1,4) = '$year' and 
						crnmc.month = '$month' and 
						crnmc.year = '$year' and 
						mc_name like '$mc%' and 
						sch.crnnum = crnmc.crn and $sid_cond";

	  	// echo "<br>$sql";
        $result = mysql_query($sql);
        $myrow = mysql_fetch_assoc($result);
        return $myrow['numrows'];

	}


	function get_capacity_plan_cnt($crn,$mc,$month,$year)
	{
		$newlogin = new userlogin;
        $newlogin->dbconnect();
        $siteid = $_SESSION['siteid'];
		if ($siteid != 'FSI') 
		{
		  $sid_cond = "siteid = '$siteid' ";
		}
		else
		{
		  $sid_cond = "(siteid = 'FSI' || siteid IS NULL || siteid = '') ";
		}

		$sql = "select count(*) as count
				from mc_capacity_plan 
		        where mc_name like '$mc%' and
		        	  plan_month ='$month' and
		        	  plan_year = '$year' and
		        	  crn like '$crn%' and 
		        	  $sid_cond";

		// echo $sql;
		$result = mysql_query($sql); 
		$myrow = mysql_fetch_assoc($result);
		return $myrow['count'];

		
	}

	function get_capacity_plan($crn,$mc,$month,$year)
	{
		$newlogin = new userlogin;
        $newlogin->dbconnect();
        $siteid = $_SESSION['siteid'];
		if ($siteid != 'FSI') 
		{
		  $sid_cond = "siteid = '$siteid' ";
		}
		else
		{
		  $sid_cond = "(siteid = 'FSI' || siteid IS NULL || siteid = '') ";
		}

		// echo "cond $cond <br>";

		// $sql = "select * 
		// 		from mc_capacity_plan 
		//         where $cond and
		//         	  $sid_cond
		//         group by mc_name,crn,operation 
		//         order by mc_name,crn,operation,priority";

		$sql = "select * 
				from mc_capacity_plan 
		        where mc_name like '$mc%' and
		        	  plan_month ='$month' and
		        	  plan_year = '$year' and
		        	  crn like '$crn%' and 
		        	  $sid_cond
		        group by mc_name,crn,schedule_date,operation 
		        order by mc_name,schedule_date,operation,priority";

		// echo "$sql";
		$result = mysql_query($sql); 		
		if(!$result) die("get_capacity_plan didn't work..Please report to Sysadmin. " . mysql_error());
		return $result;
	}

	 function getgrnbal_qty($crnnum)
	{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
  
     	$sql = "select sum(qtm)-sum(qty_used) as grnbal                      
				from grn
		     	where crn = '$crnnum'
		     	group by crn";

        $result = mysql_query($sql);
        $row = mysql_fetch_row($result);
        return $row[0];
	}

	function getfg_qty()
	{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
  
     	$sql = "select recnum,crn,sum(fg_qty) as fg_qty,status                      
				from crn_fg
		     	group by crn";
		// echo "$sql<br>";
        $result = mysql_query($sql);
        return $result;
	}

	function get_capacity_plan_chartcap($cond)
	{
		$newlogin = new userlogin;
        $newlogin->dbconnect();
        $siteid = $_SESSION['siteid'];
		if ($siteid != 'FSI') 
		{
		  $sid_cond = "siteid = '$siteid' ";
		}
		else
		{
		  $sid_cond = "(siteid = 'FSI' || siteid IS NULL || siteid = '') ";
		}

		// echo "cond $cond <br>";

		$sql = "select * 
				from mc_capacity_plan 
		        where $cond and
		        	  $sid_cond
		        group by mc_name,crn,operation 
		        order by mc_name,crn,operation,priority";

		// echo "$sql";
		$result = mysql_query($sql); 		
		if(!$result) die("get_capacity_plan didn't work..Please report to Sysadmin. " . mysql_error());
		return $result;
	}

	public function check_in_range($start_date, $end_date, $date_from_user)
    {
	    // Convert to timestamp
	    $start_ts = strtotime($start_date);
	    $end_ts = strtotime($end_date);
	    $user_ts = strtotime($date_from_user);

	    // Check that user date is between start & end
  		return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
	}


}


