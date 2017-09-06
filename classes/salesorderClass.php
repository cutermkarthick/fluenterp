<?
//====================================
// Author: FSI
// Date-written = July 05, 2006
// Filename: salesorderClass.php
// Maintains the class for Quotes
// Revision: v1.0
//====================================

include_once('loginClass.php');

class salesorder {

    var
    $recnum,
    $so2customer,
    $so2contact,
    $description,
    $sales_order,
    $order_date,
    $due_date,
    $special_instruction,
    $phone,
    $email,
    $address,
    $city,
    $state,
    $zipcode,
    $country,
    $quote_num,
    $po_num,
    $grosstotal,
    $tax,
    $shipping,
    $labor,
    $salesperson,
    $status,
    $total_due,
    $currency,
    $resellnum;

    // Constructor definition
    function salesorder() {
        $this->recnum = '';
        $this->so2customer = '';
        $this->so2contact = '';
        $this->description = '';
        $this->sales_order = '';
        $this->order_date = '';
        $this->due_date = '';
        $this->special_instruction = '';
        $this->phone = '';
        $this->email = '';
        $this->address = '';
        $this->city= '';
        $this->state= '';
        $this->zipcode= '';
        $this->country= '';
        $this->quote_num= '';
        $this->po_num= '';
        $this->grosstotal= '';
        $this->tax= '';
        $this->shipping= '';
        $this->labor= '';
        $this->total_due= '';
        $this->so2employee='';
        $this->status='';
        $this->currency='';
        $this->resellnum='';
    }



   function getrecnum() {
           return $this->getrecnum;
    }

    function setrecnum ($req_recnum) {
           $this->recnum = $req_recnum;
    }

    function getso2customer() {
           return $this->so2customer;
    }

    function setso2customer ($req_so2customer) {
           $this->so2customer = $req_so2customer;
    }
    function getso2contact() {
           return $this->so2contact;
    }

    function setso2contact ($req_so2contact) {
           $this->so2contact = $req_so2contact;
    }

    function getso2employee() {
           return $this->so2employee;
    }

    function setso2employee ($reqso2employee) {
           $this->so2employee = $reqso2employee;
    }

    function getdescription() {
           return $this->description;
    }

    function setdescription ($reqdescription) {
           $this->description = $reqdescription;
    }

    function getphone() {
           return $this->phone;
    }

    function setphone ($reqphone) {
           $this->phone = $reqphone;
    }

    function getemail() {
           return $this->email;
    }

    function setemail ($reqemail) {
           $this->email = $reqemail;
    }

    function getsales_order() {
           return $this->sales_order;
    }

    function setsales_order ($sales_order) {
           $this->sales_order = $sales_order;
    }
    function getorder_date() {
           return $this->order_date;
    }

    function setorder_date ($reqorder_date) {
           $this->order_date= $reqorder_date;
    }
    function getdue_date() {
           return $this->due_date;
    }

    function setdue_date($due_date) {
           $this->due_date= $due_date;
    }
    function getspecial_instruction() {
           return $this->special_instruction;
    }

    function setspecial_instruction ($special_instruction) {
           $this->special_instruction = $special_instruction;
    }
    function getaddress() {
           return $this->address;
    }

    function setaddress ($address) {
           $this->address = $address;
    }

    function getcity() {
           return $this->city;
    }

    function setcity ($city) {
           $this->city = $city;
    }
     function getstate() {
           return $this->state;
    }

    function setstate ($state) {
           $this->state = $state;
    }

    function getzipcode() {
           return $this->zipcode;
    }

    function setzipcode ($zipcode) {
           $this->zipcode = $zipcode;
    }

    function getcountry() {
           return $this->country;
    }

    function setcountry ($country) {
           $this->country = $country;
    }

    function getquote_num() {
           return $this->quote_num;
    }

    function setquote_num ($quote_num) {
           $this->quote_num = $quote_num;
    }

    function getpo_num() {
           return $this->po_num;
    }

    function setpo_num ($po_num) {
           $this->po_num = $po_num;
    }

    function getgrosstotal() {
           return $this->grosstotal;
    }

    function setgrosstotal ($grosstotal) {
           $this->grosstotal = $grosstotal;
    }

    function gettax() {
           return $this->tax;
    }

    function settax ($tax) {
           $this->tax = $tax;
    }

    function getshipping() {
           return $this->shipping;
    }

    function setshipping ($shipping) {
           $this->shipping = $shipping;
    }

    function getlabor() {
           return $this->labor;
    }

    function setlabor ($labor) {
           $this->labor = $labor;
    }

    function gettotal_due() {
           return $this->total_due;
    }

    function settotal_due ($total_due) {
           $this->total_due = $total_due;
    }
    function getstatus() {
           return $this->status;
    }

    function setstatus ($status) {
           $this->status = $status;
    }

    function getcurrency() {
           return $this->currency;
    }

    function setcurrency ($reqcurrency) {
           $this->currency = $reqcurrency;
    }

    function getresellnum() {
           return $this->resellnum;
    }

    function setresellnum ($resellnum) {
           $this->resellnum = $resellnum;
    }

     function addSalesorder() {
       //echo "I am here";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
       
        $order_date = "'" . $this->order_date . "'";
        $due_date = "'" . $this->due_date . "'";
        $so2contact = "'" . $this->so2contact . "'";
        $so2customer= "'" . $this->so2customer . "'";
        $so2employee = "'" . $this->so2employee. "'";
        $phone = "'" . $this->phone . "'";
        $email = "'" . $this->email . "'";
        $description = "'" . $this->description . "'";
        $username = "'" . $_SESSION["user"] . "'";
        $sales_order = "'" . $this->sales_order . "'";
        $special_instruction = "'" . $this->special_instruction . "'";
        $address="'" . $this->address . "'";
        $city = "'" . $this->city . "'";
        $state = "'" . $this->state . "'";
        $zipcode = "'" . $this->zipcode . "'";
        $country = "'" . $this->country . "'";
        $quote_num = "'" . $this->quote_num . "'";
        $po_num = "'" . $this->po_num . "'";
        $grosstotal = "'" . $this->grosstotal . "'";
        $tax = "'" . $this->tax . "'";
        $labor = "'" . $this->labor . "'";
        $shipping = "'" . $this->shipping . "'";
        $total_due = "'" . $this->total_due . "'";
        $status = "'" . $this->status . "'";
        $currency = "'" . $this->currency . "'";
        $resellnum = "'" . $this->resellnum . "'";

        $sql = "select * from sales_order where sales_order = $sales_order";

        //echo "here". $quote_num; exit;
        $result = mysql_query($sql);
        if(!mysql_fetch_row($result))
        {
                   $sql = "INSERT INTO
                                sales_order
                                    (
                     so2customer, so2contact, so2employee, description,
                    sales_order, order_date, due_date, special_instruction,
                    phone, email, address, city, state, zipcode, country,
                    quote_num, po_num, grosstotal, tax,shipping,labor,total_due,currency,resellnum
                                    )
                            VALUES
                                    (
                     $so2customer,$so2contact,$so2employee,$description,
                    $sales_order,$order_date,$due_date,$special_instruction,
                    $phone,$email,$address,$city,$state,$zipcode, $country,
                    $quote_num,$po_num,$grosstotal,$tax,$shipping,$labor,$total_due,$currency,$resellnum)";

              // echo "\n" . $sql; 
           $result = mysql_query($sql);

        if(!$result)
        { 

            die("Insert to salesorder didn't work..Please report to Sysadmin. " . mysql_error());
        }
        else
        {
                $sql1="select recnum as link2so from sales_order order by recnum desc limit 1";
            //echo $sql1; exit;
            $result = mysql_query($sql1);
            $myrow=mysql_fetch_row($result);
            return $myrow[0];
        }
   }
   else
   {

       echo "<table border=1><tr><td><font color=#FF0000>";
       die("Sales Order# " . $sales_order . " already exists. ");
        echo "</td></tr></table>";
   }


}

     function getSalesorders() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "SELECT sales_order .recnum, company.name, so2contact,
                so2employee, description, sales_order, order_date,
                due_date, special_instruction,company.phone, company.email,
                company.addr1, company.city, company.state, company.zipcode,
                company.country, quote.id, po_num, sales_order.grosstotal,
                sales_order.tax,sales_order.shipping,sales_order.labor,sales_order.total_due,
                employee.fname,employee.lname,sales_order .currency,quote.recnum,resellnum
        FROM sales_order
            LEFT OUTER JOIN employee ON (sales_order.so2employee = employee.recnum)
            LEFT OUTER JOIN company ON (sales_order.so2customer = company.recnum)
            LEFT OUTER JOIN contact ON (sales_order.so2contact = contact.recnum)
            LEFT OUTER JOIN quote ON (sales_order.quote_num = quote.recnum)
           ORDER BY sales_order.recnum
            ";

// echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;

     }


 function getSalesorder($salesorderrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "SELECT sales_order .recnum, company.name, so2contact,
               description, sales_order, order_date,
               due_date, special_instruction,company.phone, company.email,
               company.addr1, company.city, company.state, company.zipcode,
               company.country, sales_order.quote_num, po.ponum, sales_order.grosstotal, sales_order.tax,sales_order.shipping,
               sales_order.labor,sales_order.total_due,employee.fname,employee.lname ,so2customer,so2employee,sales_order.quote_num,
               contact.fname,contact.lname, contact.email,sales_order .currency ,sales_order.po_num,contact.recnum,resellnum
       FROM sales_order  LEFT OUTER JOIN company ON (sales_order.so2customer = company.recnum)
                            LEFT OUTER JOIN employee ON(sales_order.so2employee = employee.recnum)
                            LEFT OUTER JOIN quote ON(sales_order.quote_num = quote.recnum)
                            LEFT OUTER JOIN po ON(sales_order.po_num = po.recnum)
                            LEFT OUTER JOIN contact ON(sales_order.so2contact = contact.recnum)
               where  sales_order.recnum = $salesorderrecnum";
//echo $sql;
        $result = mysql_query($sql);

        return $result;

     }


     function updateSalesorder($salesorderrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $so2customer = "'" . $this->so2customer . "'";
        $so2employee = "'" . $this->so2employee . "'";
        $so2contact = "'" . $this->so2contact . "'";
        $phone = "'" . $this->phone . "'";
        $email = "'" . $this->email . "'";
        $description = "'" . $this->description . "'";
        $username = "'" . $_SESSION["user"] . "'";
        $sales_order = "'" . $this->sales_order . "'";
        $order_date = "'" . $this->order_date . "'";
        $due_date = "'" . $this->due_date . "'";
        $quote_num=$this->quote_num;
        $po_num=$this->po_num;
        $grosstotal = "'" . $this->grosstotal. "'";
        $tax = "'". $this->tax . "'";
        $total_due = "'" . $this->total_due . "'";
        $shipping = "'" . $this->shipping . "'";
        $labor = "'" . $this->labor . "'";
        $special_instruction = "'" . $this->special_instruction . "'";
        $address = "'" . $this->address . "'";
        $currency = "'" . $this->currency . "'";
        $resellnum = "'". $this->resellnum . "'";

       $sql = "UPDATE sales_order SET
                    so2customer = $so2customer,
                    so2contact = $so2contact,
                    so2employee = $so2employee,
            	    description=$description,
            	    phone =$phone ,
            	    email=$email,
            	    sales_order=$sales_order,
                    order_date = $order_date ,
                    due_date = $due_date,
                    special_instruction= $special_instruction ,
                    address=$address,
                    quote_num=$quote_num,
                    po_num=$po_num,
                    grosstotal = $grosstotal,
                    tax  = $tax,
                    total_due = $total_due,
                    shipping = $shipping,
                    labor = $labor,
                    resellnum = $resellnum

        	WHERE
                    recnum = $salesorderrecnum ";
 // echo $sql;
        $result = mysql_query($sql);

        if(!$result) die("Sales Oreder update failed...Please report to SysAdmin. " . mysql_error());
        }


     function deleteSalesorder($salesorderrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from sales_order where recnum = $salesorderrecnum";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Salesorder failed...Please report to SysAdmin. " . mysql_error());
      }

     //Function for search/sort coded by Jerry George 30 Dec -04
function getso($cond,$argsort1,$argoffset,$arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder=$argsort1;
       $sql = "SELECT sales_order .recnum, company.name, so2contact,
                so2employee, description, sales_order, order_date,
                due_date, special_instruction,company.phone, company.email,
                company.addr1, company.city, company.state, company.zipcode,
                company.country, quote.id, po_num, grosstotal,
                tax,shipping,labor,total_due,employee.fname,employee.lname,sales_order .currency ,resellnum
        FROM sales_order
            LEFT OUTER JOIN employee ON (sales_order.so2employee = employee.recnum)
            LEFT OUTER JOIN company ON (sales_order.so2customer = company.recnum)
            LEFT OUTER JOIN contact ON (sales_order.so2contact = contact.recnum)
            LEFT OUTER JOIN quote ON (sales_order.quote_num = quote.recnum
                   where  $wcond ORDER by $sortorder limit $offset, $limit";
//echo "$sql";
       $result = mysql_query($sql);
       return $result;
}

//Function for pagination coded by Jerry George 30 Dec -04
function getsoCount($cond,$argoffset,$arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
             $sql = "select count(*) as numrows
                     from sales_order where  $wcond limit $offset, $limit";
       $newlogin = new userlogin;
       $newlogin->dbconnect();
//echo "$sql";
$result  = mysql_query($sql) or die('Emp count query failed');
$row     = mysql_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];
//echo $numrows;
return $numrows;
}


function getallmaster_data()
{
  $newlogin = new userlogin;
  $newlogin->dbconnect();

  $sql = "select  recnum,CIM_refnum,partnum,
                  rm_dim1,rm_dim2,rm_dim3
           from   master_data 
           where  status = 'Active'";
    
//echo "$sql";
$result  = mysql_query($sql) or die('Get all Master Data query failed');
//echo $numrows;
return $result;
}



} // End salesorder class definition
