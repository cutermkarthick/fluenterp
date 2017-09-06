<? 

//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: empClass.php
// Maintains the class for Employees
// Revision: v1.0
//====================================

include_once('loginClass.php');
class emp { 

    var $recnum, 
        $empid,
        $salutation, 
        $fname,
        $lname,
        $role, 
        $title,
        $status,
        $phone,
        $email,
        $address1,
        $address2,
        $city,
        $state,
        $country,
        $zipcode,
        $employee2company,
        $department,
        $empcode,
        $shift_group,
        $subscription_type;


    // Constructor definition 
    function emp() { 
        $this->recnum = ''; 
        $this->empid = '';
        $this->fname = '';
        $this->lname = '';
        $this->role = ''; 
        $this->salutation = ''; 
        $this->title = '';
        $this->status = '';
        $this->phone = '';
        $this->email = '';
        $this->address1 = '';
        $this->address2 = '';
        $this->city = '';
        $this->state = '';
        $this->country = '';
        $this->zipcode = '';
        $this->employee2company = '';
        $this->department = '';
        $this->empcode = '';
        $this->shift_group = '';
        $this->subscription_type = '';
    } 

    // Property get and set
    function getempid() {
           return $this->empid;
    }

    function setempid ($reqempid) {
           $this->empid = $reqempid;
    }

    function getfname() {
           return $this->fname;
    }

    function setfname ($reqfname) {
           $this->fname = $reqfname;
    }
    function getrole() {
           return $this->role;
    }

    function setrole ($reqrole) {
           $this->role = $reqrole;
    }
    function getsalutation() {
           return $this->salutation;
    }

    function setsalutation ($reqsalutation) {
           $this->salutation = $reqsalutation;
    }
    function getlname() {
           return $this->lname;
    }
    function setlname ($reqlname) {
           $this->lname = $reqlname;
    }
    function getstatus () {
           return $this->status;
    }
    function setstatus ($reqstatus) {
           $this->status = $reqstatus;
    }

    function gettitle() {
           return $this->title;
    }
    function settitle ($reqtitle) {
           $this->title = $reqtitle;
    }
    function getemail () {
           return $this->email;
    }
    function setemail ($reqemail) {
           $this->email = $reqemail;
    }
    function setaddress1 ($reqaddress1) {
           $this->address1 = $reqaddress1;
    }
    function getaddress1 () {
           return $this->address1;
    }
    function setaddress2 ($reqaddress2) {
           $this->address2 = $reqaddress2;
    }
    function getaddress2 () {
           return $this->address2;
    }
    function getcity () {
           return $this->city;
    }
    function setcity ($reqcity) {
           $this->city = $reqcity;
    }
    function getstate () {
           return $this->state;
    }
    function setstate ($reqstate) {
           $this->state = $reqstate;
    }
    function getcountry () {
           return $this->country;
    }
    function setcountry ($reqcountry) {
           $this->country = $reqcountry;
    }
    function getzip () {
           return $this->zipcode;
    }
    function setzip ($reqzipcode) {
           $this->zipcode = $reqzipcode;
    }


    function getphone () {
           return $this->phone;
    }
    function setphone ($reqphone) {
           $this->phone = $reqphone;
    }

    function getemployee2company() {
           return $this->employee2company;
    }
    function setemployee2company($reqemployee2company) {
           $this->employee2company = $reqemployee2company;
    }

    function getdepartment() {
           return $this->department;
    }
    function setdepartment($reqdepartment) {
           $this->department = $reqdepartment;
    }
     function getempcode() {
           return $this->empcode;
    }

    function setempcode ($reqempcode) {
           $this->empcode = $reqempcode;
    }
    function setshift_group ($shift_group) {
           $this->shift_group = $shift_group;
    }
    function setsubscription_type ($subscription_type) {
           $this->subscription_type = $subscription_type;
    }
     function getEmp($empid) {

       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $siteid = $_SESSION['siteid'];
       $siteval = "e.siteid = '".$siteid."'";
       $emplid = "'" . $empid . "'";
       $sql = "select e.fname, e.lname, e.recnum, e.role,
                      e.empid, e.title, e.phone, e.email,
                      e.address1, e.address2, e.city, e.state, 
                      e.zipcode,e.status, e.country, c.name,
                      e.salutation, e.dept,e.empcode,e.shift_group,
                      e.subscription_type
                  from employee e, company c
                  where empid = $emplid and employee2company = c.recnum and $siteval
                  for update";
       // echo "$sql <br>";
       $result = mysql_query($sql);
       return $result;

     }

    function getSocketDes()  
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select fname, lname, recnum, role,
                      empid, title, phone, email,
                      address1, address2, city, state, zipcode,
                      status from employee where role = 'DESG_S'
                      and status = 'Active'";
       $result = mysql_query($sql);
       return $result;

    }
    function getBoardDes()  
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select fname, lname, recnum, role,
                      empid, title, phone, email,
                      address1, address2, city, state, zipcode,
                      status from employee where role = 'DESG_B'
                      and status = 'Active'";
       $result = mysql_query($sql);
       return $result;

    }

    function getAllEmps()  
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $siteid = $_SESSION['siteid'];
       $siteval = "siteid = '".$siteid."'";
       $sql =  "select fname, lname, recnum, role,
                      empid, title, phone, email,
                      address1, address2, city, state, zipcode,
                      status,shift_group 
                from employee where
                      status = 'Active' and fname != 'sa' and lname != 'sa' and $siteval";
       $result = mysql_query($sql);
       return $result;

    }

	function getEmp4Prodn()
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select fname, lname, empcode
                      from employee where
                      role='OP' order by empcode";
       // echo $sql;
       $result = mysql_query($sql);
       return $result;

    }
    function getAllUsers()  
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select userid, initials, recnum
                  from user where
                      status = 'Active' and 
                      type = 'EMPL' and
                      userid != 'sa'";
       $result = mysql_query($sql);
       return $result;

    }

    function getEmps4UserLink()  
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $siteid = $_SESSION['siteid'];
       $siteval = "e.siteid = '".$siteid."'";
       $sql = "select e.fname, e.lname, e.recnum, e.role,
                      e.empid, e.title, e.phone, e.email,
                      e.address1, e.address2, e.city,e. state, e.zipcode,
                      e.status, e.dept from employee e
                left join user u on e.recnum = u.user2employee 
                where u.user2employee IS NULL and
                      e.status = 'Active' and 
                      e.fname != 'sa' and 
                      e.lname != 'sa' and $siteval";
       $result = mysql_query($sql);
       return $result;

    }


//Function for search/sort coded by Jerry George 30 Dec -04   
    function getEmps4sa($cond,$argsort1,$argoffset,$arglimit)  
    {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder=$argsort1;
        $sql = "select e.fname, e.lname, e.recnum, e.role,
                       e.empid, e.title, e.phone, e.email,
                       e.address1, e.address2, e.city, e.state, e.zipcode,
                       e.status, e.dept from employee e where  $wcond ORDER by $sortorder limit $offset, $limit";
                       // echo $sql;
       $result = mysql_query($sql);
       return $result;

    }


     function getEmpDept($userpassword)
    {
        $password=$userpassword;

        $sql = "select user2employee from user where password='$password'";
        $result = mysql_query($sql);
        $myrow=mysql_fetch_row($result);
        $recnum = $myrow[0];
        
       // echo $recnum;
        
        $sql = "select dept from employee where recnum='$recnum'";
        $result1 = mysql_query($sql);
        
        $myrow1=mysql_fetch_row($result1);
        $res = $myrow1[0];

        //echo $res;

        return $res;

    }

//Function for search/sort coded by Jerry George 30 Dec -04   
    function getEmpcount($cond,$argoffset,$arglimit)
    {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $siteid = $_SESSION['siteid'];
        $siteval = "e.siteid = '".$siteid."'";
             $sql = "select count(*) as numrows
                       from employee e where $wcond 
                                          and $siteval
                                  limit $offset, $limit"; 
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $result  = mysql_query($sql) or die('Emp count query failed'); 
       $row     = mysql_fetch_array($result, MYSQL_ASSOC); 
       $numrows = $row['numrows']; 
       return $numrows;
    }


    function addEmp() { 
        $userid = "'" . $_SESSION['user'] . "'";
        $siteid = "'" . $_SESSION['siteid'] . "'";
        $sql = "select nxtnum from seqnum where tablename = 'employee' for update";

        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $crdate = "'" . date("y-m-d") . "'";
        $empid = "'" . "E" . $objid . "'";
        $status = "'" . $this->status . "'";
        $fname = "'" . $this->fname . "'";
        $lname = "'" . $this->lname . "'";
        $salutation = "'" . $this->salutation . "'";
        $role = "'" . $this->role . "'";
        $title = "'" . $this->title . "'";
        $phone = "'" . $this->phone . "'";
        $email = "'" . $this->email . "'";
        $state = "'" . $this->state . "'";
        $zipcode = "'" . $this->zipcode . "'";
        $country = "'" . $this->country . "'";
        $address1 = "'" . $this->address1 . "'";
        $address2 = "'" . $this->address2 . "'";
        $city = "'" . $this->city . "'";
        $state = "'" . $this->state . "'";
        $zipcode = "'" . $this->zipcode . "'";
        $country = "'" . $this->country . "'";
        $department = "'" . $this->department . "'";
       $empcode = "'" . $this->empcode . "'";
        $employee2company = $this->employee2company;
        $sql = "select * from employee where empid = $empid";

        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO employee 
                     (recnum, empid, salutation, fname, lname, 
                      role, title, phone, email,
                      address1, address2, city, state, zipcode,
                      country, status, employee2company,create_date, dept,empcode,siteid)
                   VALUES ($objid, $empid, $salutation, $fname, $lname, 
                          $role, $title, $phone, $email,
                          $address1, $address2, $city, $state, $zipcode,
                          $country, $status, $employee2company,$crdate, $department,$empcode,$siteid)";
                          // echo $sql;exit;
           $result = mysql_query($sql);
           // Test to make sure query worked 
           if(!$result) die("Insert to Employee didn't work. " . mysql_error()); 
         }           
         else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("Emp ID " . $empid . " already exists. ");
            echo "</td></tr></table>";
         }

           $sql = "update seqnum set nxtnum = $objid where tablename = 'employee'";
           $result = mysql_query($sql);
           // Test to make sure query worked 
           if(!$result) die("Seqnum insert query for employee didn't work. " . mysql_error()); 
 
     } 

    function updateEmp($empid) { 
        $userid = "'" . $_SESSION['user'] . "'";
        $emplid = "'" . $empid . "'";
        $status = "'" . $this->status . "'";
        $fname = "'" . $this->fname . "'";
        $lname = "'" . $this->lname . "'";
        $salutation = "'" . $this->salutation . "'";
        $role = "'" . $this->role . "'";
        $title = "'" . $this->title . "'";
        $phone = "'" . $this->phone . "'";
        $email = "'" . $this->email . "'";
        $state = "'" . $this->state . "'";
        $zipcode = "'" . $this->zipcode . "'";
        $country = "'" . $this->country . "'";
        $address1 = "'" . $this->address1 . "'";
        $address2 = "'" . $this->address2 . "'";
        $city = "'" . $this->city . "'";
        $state = "'" . $this->state . "'";
        $zipcode = "'" . $this->zipcode . "'";
        $country = "'" . $this->country . "'";
        $department = "'" . $this->department . "'";
        $empcode = "'" . $this->empcode . "'";
        $shift_group = "'" . $this->shift_group . "'";
        $subscription_type = "'" . $this->subscription_type . "'";

        $employee2company = $this->employee2company;

        $sql = "update employee set
                                fname = $fname, 
                                lname = $lname,
                                salutation = $salutation,
                                role = $role,
                                status = $status,
                                title = $title,
                                phone = $phone,
                                email = $email,
                                address1 = $address1,
                                address2 = $address2,
                                city = $city,
                                state = $state, 
                                zipcode = $zipcode,
                                country = $country,
                                dept = $department,
                                empcode = $empcode,
                                shift_group=$shift_group,
                                subscription_type=$subscription_type
                        where empid = $emplid";

           $result = mysql_query($sql);
           // Test to make sure query worked 
           if(!$result) die("Update to Employee didn't work. " . mysql_error()); 
     } 


      function getEmployee4Payroll() 
  {
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $siteid = $_SESSION['siteid'];
    $siteval = "e.siteid = '".$siteid."'";
    $emplid = "'" . $empid . "'";

    $sql = "select e.recnum,
                   e.empid,
                   e.fname,
                   e.lname,
                   e.status,
                   e.employee2company
            from employee e
            where e.status = 'Active' and
                  (e.empid != '' || e.empid != 'NULL') and
                  $siteval";
    
    $result = mysql_query($sql);
    return $result;
  }


  function getAllEmps4Ams()  
  {
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $siteid = $_SESSION['siteid'];
    $siteval = "e.siteid = '".$siteid."'";
    $sql =  "select e.fname, e.lname, e.recnum, e.role,
                    e.empid, e.title, e.phone, e.email,
                    e.status,e.shift_group,c.name,e.shift_group,
                    ec.start_hour,ec.start_min,ec.end_hour,ec.end_min 
              from  company c, employee e
              left join employee_config ec on ec.shift = e.shift_group
              where
                  e.employee2company = c.recnum and
                  e.status = 'Active' and 
                  fname != 'sa' and lname != 'sa' and 
                  $siteval";
    // echo "$sql <br>";
    $result = mysql_query($sql);
    return $result;

  }

} // End Employee class definition 


