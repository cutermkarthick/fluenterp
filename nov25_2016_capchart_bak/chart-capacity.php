<?php

include('classes/mc_capacityClass.php');
$newlogin = new userlogin;
$newlogin->dbconnect();

$newmc_capacity = new mc_capacity;
$param=$_REQUEST['param'];
$param=explode("|",$param);

$mc_series=$param[0];
$start_date=$param[1];
$end_date=$param[2];

$start_array=explode('-',$start_date);
$start_year=$start_array[0];
$start_month=$start_array[1];
$end_array=explode('-',$end_date);
$end_year=$end_array[0];
$end_month=$end_array[1];

include 'php-ofc-library/open-flash-chart.php';
$datearr=array();
$crn_qty=array();
$y_legend=array();
$disp=array();

if($start_year == $end_year)
{
   for($j=$start_month;$j<=$end_month;$j++)
   {  
        if(intval($j) <=9)
		    $j='0'.intval($j);	
		$datearr[]=($j.'-'.$start_year);
   }
}
if($start_year != $end_year)
{	
  $end_month1=12;
  for($m=$start_year ;$m<=$end_year;$m++)
  {
	  $end_month1=($m==$end_year)?$end_month:12;
      for($n=$start_month;$n<=$end_month1;$n++)
      {
		if(intval($n) <=9)
		   $n='0'.intval($n);
		
		$datearr[]=($n.'-'.$m);	
	  }
	  $start_month=1;
  }
}
$st=date('M,Y',strtotime($start_date));
$et=date('M,Y',strtotime($end_date));
$title = new title( 'Capacity Plan for '.$mc_series.'  '.$st.' - '.$et);
$title->set_style( "{font-size: 20px; color: #F24062; text-align: center;}" );
$bar_stack = new bar_stack();
$crnarr=array();
$data_1=array();
$leg_arr=array();
foreach($datearr as $date)
{
$da=  split('-', $date);
$month=trim($da[0]);
$year=trim($da[1]);
if($mc_series=='all')
$ms='%';	
else
$ms=trim("$mc_series");

$pre_m='';
$pre_y='';

$result=$newmc_capacity->get_mc_capacity($ms,$month,$year); 
if(mysql_num_rows($result)>0)
{		
	  $crn_qty=array();
	  $crnarr=array();
	  $max='';
	  $bal_crn_qty='';
	  $cond="plan_month = '$month' and plan_year='$year' and mc_series ='$ms'";	  	
	  $res1=$newmc_capacity->get_capacity_plan($cond);	 
	  while($myrow=mysql_fetch_assoc($res1))
	  {
			$crn_qty[]=(int)$myrow['crn_qty'];	
			$crnarr[]=$myrow[crn];
			
			if($myrow['plan_month']!=$pre_m && $myrow['plan_year']!=$pre_y)
		    {
				$monthName = date("M", mktime(0, 0, 0, $myrow['plan_month'], 10));
		    	$y_legend[]=($monthName.'-'.$myrow['plan_year']);		
				$pre_m=$myrow['plan_month'];			
			}
			$pre_y=$myrow['plan_year'];		 
	
			$max +=floor($myrow['crn_qty']);
			$bal_crn_qty +=floor($myrow['balance_crn_qty']);
      }
	  $max_val[]=$max;
	  $da=($max-$bal_crn_qty);
	  $data_1[]=$da;
	  $monthName = date("M", mktime(0, 0, 0, $n, 10));
	  $bar_stack->append_stack($crn_qty );	 
}  
}
$max_val=max($max_val);

$bar_stack->set_colours( array( '#C4D318', '#50284A', '#7D7B6A','#0066CC','#ff00ff') );
$cc=array( '#C4D318', '#50284A', '#7D7B6A','#0066CC','#ff00ff');
$min_val=(int)($max_val/4);
$tooltip = new tooltip();
$tooltip->set_hover();

$bar_stack->set_tooltip( 'CRN Qty =#val#<br>Total =#total#' );
$tip = 'Title!<br>Test weird characters:';
$line_1 = new line();
$line_1->set_values( $data_1 );
$line_1->set_colour( '#3D5C56' );
$i=0;

foreach($crnarr as $crn)
{	
	$leg_arr[]=(new bar_stack_key($cc[$i], $crn, 13));
	$i++;
}

$bar_stack->set_keys(
   $leg_arr
    );



$y = new y_axis();
$y->set_range(0,$max_val,$min_val);

$x = new x_axis();
$x->set_labels_from_array($y_legend);

$tooltip = new tooltip();
$tooltip->set_hover();

$chart = new open_flash_chart();
$chart->set_title( $title );
$chart->add_element( $bar_stack );
$chart->set_x_axis( $x );
$chart->add_y_axis( $y );
$chart->add_element( $line_1 );
$chart->bg_colour='#FFFFFF';
echo $chart->toPrettyString();
?>