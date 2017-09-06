<?php
     
require_once("Rest.inc.php");
require_once("RestApiClass.php");



include_once('../classes/userClass.php');

include('../classes/workorderClass.php');

include_once('../classes/reportClass.php');


include_once('../classes/helperClass.php');


     
class API extends REST {
     
    public $data = "";
    //Enter details of your database
    const DB_SERVER = "localhost";
    const DB_USER = "root";
    const DB_PASSWORD = "";
    const DB = "fluenterp";
     
    private $db = NULL;
 
    public function __construct(){
        parent::__construct();              // Init parent contructor
        $this->dbConnect();                 // Initiate Database connection
}
     
private function dbConnect(){
        $this->db = mysql_connect(self::DB_SERVER,self::DB_USER,self::DB_PASSWORD);
        if($this->db)
            mysql_select_db(self::DB,$this->db);
}
     
    /*
     * Public method for access api.
     * This method dynmically call the method based on the query string
     *
     */
public function processApi(){
        $func = strtolower(trim(str_replace("/","",$_REQUEST['rquest'])));
        // echo "func $func";
        if((int)method_exists($this,$func) > 0)
            $this->$func();
        else
            $this->response('Error code 404, Page not found',404);   // If the method not exist with in this class, response would be "Page not found".
}

public function login($value='')
{

    $newrest = new RestApi;
 

    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $siteid=$_REQUEST['siteid'];

    $result = $newrest->checkuser($username,$password,$siteid);

    if (!empty($result)) 
    {   

       
            $token = $newrest->getToken();
            $newrest->settoken($token[0]);

            $token_det = $newrest->fetchToken($result);

            if (empty($token_det)) 
            {   
                $newrest->insertToken($result);
            }
            else
            {
                $token[0]=$token_det[2];
            }
            
            
           
            $emp = $newrest->getEmpDept($username);
            $res = array('UserName' => $result['username'],'UserType'=>$result['usertype'],'SiteId'=>$result['siteid'],
                        'Company'=>$result['company'],'Employee'=>$result['employee'],'RecNum'=>$result['recnum'],
                        'Token' => $token[0],'UserRole'=>$result['userrole'],"Department"=>$emp['dept'],"Mobile"=>$emp['mobile'],"Lat"=>$result['lat'],"Lon"=>$result['lon'],
                            "SubscriptionType"=>$emp['subscription_type']);

            $param = json_encode($res);

            $this->response($param, 200);
            
        
    }
    else
    {
        $this->response('Username or Password incorrect',401);
    }



}
public function registration()
{
    $newrest = new RestApi;
    if($this->get_request_method() != "POST")
    {
        $this->response('',406);
    }
    $result = $newrest->registeruser($_REQUEST['name'],$_REQUEST['username'],$_REQUEST['password'],$_REQUEST['company'],$_REQUEST['mobile'],$_REQUEST['email']);
    $this->response(json_encode($result), 200);

}
public function getcompanynames()
{
    $newrest = new RestApi;
    $result = $newrest->GetCompanyNames();
    $this->response(json_encode($result), 200);
}
public function CheckTokenExpiry()
{
    $newrest = new RestApi;
    if($this->get_request_method() != "POST")
    {
        $this->response('',406);
    }
    $token_det = $newrest->fetchToken(array('token'=>$_REQUEST['token'],'recnum'=>$_REQUEST['recnum']));

    if (empty($token_det)) 
    {   
        $this->response('Authorization error',401);
    }
    else
    {
        $this->response('OK',200);
    }
}
public function GetCheckInStatus()
{
    $newrest = new RestApi;
    if($this->get_request_method() != "POST")
    {
        $this->response('',406);
    }
    $token_det = $newrest->fetchToken(array('token'=>$_REQUEST['token'],'recnum'=>$_REQUEST['recnum']));

    if (empty($token_det)) 
    {   
        $this->response('Authorization error',401);
    }
    $result = $newrest->LastCheckInStatus($_REQUEST['employeeid'],$_REQUEST['taskid']);
    $this->response(json_encode($result), 200);
}
public function CheckInOut()
{
    $newrest = new RestApi;
    if($this->get_request_method() != "POST")
    {
        $this->response('',406);
    }
    $token_det = $newrest->fetchToken(array('token'=>$_REQUEST['token'],'recnum'=>$_REQUEST['recnum']));

    if (empty($token_det)) 
    {   
        $this->response('Authorization error',401);
    }
    $result = $newrest->CheckInOut($_REQUEST['employeeid'],$_REQUEST['status'],$_REQUEST['siteid'],$_REQUEST['taskid'],$_REQUEST['recnum'],
        $_REQUEST['lat'],$_REQUEST['lon']);
    $this->response(json_encode($result), 200);
}
public function CurrentWorkingHoursOfATask()
{
    $newrest = new RestApi;
    if($this->get_request_method() != "POST")
    {
        $this->response('',406);
    }
    $token_det = $newrest->fetchToken(array('token'=>$_REQUEST['token'],'recnum'=>$_REQUEST['recnum']));

    if (empty($token_det)) 
    {   
        $this->response('Authorization error',401);
    }
    $result = $newrest->CurrentWorkingHoursOfATask($_REQUEST['employeeid'],$_REQUEST['siteid'],$_REQUEST['taskid'],$_REQUEST['recnum']);
    $this->response($result, 200);
}
public function getOutLookReport()
{
    $newrest = new RestApi;
    if($this->get_request_method() != "POST")
    {
        $this->response('',406);
    }
    $token_det = $newrest->fetchToken(array('token'=>$_REQUEST['token'],'recnum'=>$_REQUEST['recnum']));

    if (empty($token_det)) 
    {   
        $this->response('Authorization error',401);
    }
    $newreport = new report;
    $newhelper = new helper;
    $rowsPerPage = 10;
    $crn=$_REQUEST['crn'];
    $ftrigger=$_REQUEST['ftrigger'];
    $userid = $_REQUEST['username'];
    $dept = $_REQUEST['department'];
}
public function UpdateTaskStatus()
{
    $newrest = new RestApi;
    if($this->get_request_method() != "POST")
    {
        $this->response('',406);
    }
    $token_det = $newrest->fetchToken(array('token'=>$_REQUEST['token'],'recnum'=>$_REQUEST['recnum']));

    if (empty($token_det)) 
    {   
        $this->response('Authorization error',401);
    }
    $newrest->UpdateTaskStts($_REQUEST['recnum'],$_REQUEST['status'],$_REQUEST['taskid']);
     $this->response(' error',200);
}
public function GetTasks()
{
    $newrest = new RestApi;
    if($this->get_request_method() != "POST")
    {
        $this->response('',406);
    }
    $token_det = $newrest->fetchToken(array('token'=>$_REQUEST['token'],'recnum'=>$_REQUEST['recnum']));

    if (empty($token_det)) 
    {   
        $this->response('Authorization error',401);
    }
    $result = $newrest->GetTask4Users($_REQUEST['recnum']);
    $this->response(json_encode($result), 200);
}

public function TaskInfoUpdate()
{
    $newrest = new RestApi;
    if($this->get_request_method() != "POST")
    {
        $this->response('',406);
    }
    $token_det = $newrest->fetchToken(array('token'=>$_REQUEST['token'],'recnum'=>$_REQUEST['recnum']));

    if (empty($token_det)) 
    {   
        $this->response('Authorization error',401);
    }

    
    // var_dump($_POST['taskid']);

    if(isset($_FILES['File'])){
      var_dump($_FILES['File']);
      $errors= array();
      $file_name = $_FILES['File']['name'];
      $file_size =$_FILES['File']['size'];
      $file_tmp =$_FILES['File']['tmp_name'];
      $file_type=$_FILES['File']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['File']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
        move_uploaded_file($file_tmp,"uploads/".$_REQUEST['username'].'-'.$file_name);
        $result = "success";
        $this->response(json_encode($result), 200);
      }else{
        $this->response(json_encode($errors), 200);
      }
   }
}


public function CheckDevices()
{
    $newrest = new RestApi;
    if($this->get_request_method() != "POST")
    {
        $this->response('',406);
    }
    
    $updatestat = 1;
    $numrows = $newrest->CheckDeviceId($_REQUEST['deviceid'],$_REQUEST['token']);
    if ($numrows == 0) 
    {
        $newrest->InsertDevice($_REQUEST['deviceid'],$_REQUEST['token']);
    }else if($numrows > 0){
        $data['devicetoken'] = $_REQUEST['token'];
        $data['deviceid'] = $_REQUEST['deviceid'];
        $updatestat = $newrest->UpdateDevice($data);
    }
    if ($updatestat < 0){
        $msg = 'Update Device Token Failed';
        $this->response($msg,401);
    }else{
        $msg = "success";
        $this->response(json_encode($msg), 200);
    }
    
}

public function UpdateDeviceDetails()
{
    $newrest = new RestApi;
    if($this->get_request_method() != "POST")
    {
        $this->response('',406);
    }
    $token_det = $newrest->fetchToken(array('token'=>$_REQUEST['token'],'recnum'=>$_REQUEST['recnum']));

    if (empty($token_det)) 
    {   
        $this->response('Authorization error',401);
    }
    
    $data['deviceid'] = $_REQUEST['deviceid'];
    $data['userrecnum'] = $_REQUEST['recnum'];
    $data['mobile'] = $_REQUEST['mobile'];
    $data['status'] = $_REQUEST['status'];
    $updatestat = $newrest->UpdateDeviceDetails($data);
    if ($updatestat < 0){
        $msg = 'Update Device Details Failed';
        $this->response($msg,401);
    }else{
        $msg = "success";
        $this->response(json_encode($msg), 200);
    }
}

public function GeoAttendance()
{
    $newrest = new RestApi;
    if($this->get_request_method() != "POST")
    {
        $this->response('',406);
    }
    $token_det = $newrest->fetchToken(array('token'=>$_REQUEST['token'],'recnum'=>$_REQUEST['recnum']));

    if (empty($token_det)) 
    {   
        $this->response('Authorization error',401);
    }

    $data['userrecnum'] = $_REQUEST['recnum'];
    $data['mobile'] = $_REQUEST['mobile'];
    $data['empid'] = $_REQUEST['employeeid'];
    $data['stage'] = $_REQUEST['stage'];
    $data['type'] = $_REQUEST['type'];
    $data['lat'] = $_REQUEST['lat'];
    $data['lon'] = $_REQUEST['lon'];
    $data['status'] = $_REQUEST['status'];
    $data['siteid'] = $_REQUEST['siteid'];

    $result_shift = $newrest->GetShiftHours4Emp($data);
    $data['start_hour'] = $result_shift['start_hour'];
    $data['start_min'] = $result_shift['start_min'];
    $data['end_hour'] = $result_shift['end_hour'];
    $data['end_min'] = $result_shift['end_min'];

    $date = date("Y-m-d");
    $date_split = explode("-", $date);
    $year = $date_split[0];
    $month = $date_split[1];
    $empid = $_REQUEST['employeeid'];

    // $resultAttendance = $newrest->getMonthlyAttendance($empid,$month,$year);
    
    $id = $newrest->InsertAttendance($data);
    if ($id == ""){
        
        $msg = 'Attendance Insert is failed';
        $this->response($msg,401);
    }else{

        $result = $newrest->getAttendanceDaysCount($empid,$month,$year);
        $attendance_cnt = mysql_num_rows($result);

        $numrows = $newrest->CheckMonthlyAttendance($empid,$month,$year);
        if ($numrows == 0) {
            $newrest->InsertMonthlyAttendance($empid,$month,$year,$attendance_cnt);   
        }
        else{
            $newrest->UpdateMonthlyAttendance($empid,$month,$year,$attendance_cnt);
        }



        $msg = "success";
        $this->response(json_encode($msg), 200);
    }
}
    
 
     
    /*
     *  Encode array into JSON
    */
    private function json($data){
        if(is_array($data)){
            return json_encode($data);
        }
    }
}
 
    // Initiiate Library
     
    $api = new API;
    $api->processApi();


?>