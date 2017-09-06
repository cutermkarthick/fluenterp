/*
 * salesorder.js
 * validation for quotes
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
 */

function putfocus()
{
   document.forms[0].company.focus();
}

function GetAllCustomers(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getcustomers.php?reasontext=" + rt, "Customers", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetCustomer(customer,custrecnum) {
document.forms[0].company.value = customer;
document.forms[0].companyrecnum.value=custrecnum;
}

function GetQuoteDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "QuoteDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetQuoteDate(duedate) {
document.forms[0].quote_date.value = duedate;
}

function ConfirmDelete() {
     document.forms[0].deleteflag.value = "y";
     return true;
}

function setquotetype()
{
	var aind = document.forms[0].quotetype.selectedIndex;
	document.forms[0].quotetypeval.value = document.forms[0].quotetype[aind].text;
	return true;
}

function addRow(id,index){
var x=index;

item1="item"+index;
qty="quantity"+index;
itemdesc="item_desc"+index;
rate="rate"+index;
amount="amount"+index;
//alert(qty);
var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";

var cell1 = document.createElement("TD");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","10");
inp1.setAttribute("name",item1);
cell1.appendChild(inp1);

var cell2 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","60");
inp2.setAttribute("name",qty);

cell2.appendChild(inp2);
var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","10");
inp3.setAttribute("name",itemdesc);

cell3.appendChild(inp3);
var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","10");
inp4.setAttribute("name",rate);
cell4.appendChild(inp4);
var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","10");
inp5.setAttribute("readonly",'readonly');
inp5.style.backgroundColor = "#DDDDDD";
inp5.setAttribute("name",amount);
cell5.appendChild(inp5);

row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell5);
tbody.appendChild(row);
x++;
//alert("i am here");
document.forms[0].index.value=x;
}

function addRow4edit(id,index){
var x=index;
item1="item"+index;
qty="qty"+index;
itemdesc="item_desc"+index;
rate="rate"+index;
amount="amount"+index;
previtem="previtem"+index;
birecnum="birecnum"+index;
var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.setAttribute("bgcolor","#FFFFFF");
var cell1 = document.createElement("TD");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","10");
inp1.setAttribute("name",item1);

cell1.appendChild(inp1);
var cell2 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","10");
inp2.setAttribute("name",qty);

cell2.appendChild(inp2);
var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","50");
inp3.setAttribute("name",itemdesc);

cell3.appendChild(inp3);
var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","10");
inp4.setAttribute("name",rate);
cell4.appendChild(inp4);
var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","20");
inp5.setAttribute("style","'background-color:#DDDDDD;' readonly='readonly'");
inp5.setAttribute("name",amount);
cell5.appendChild(inp5);

var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","hidden");
inp6.setAttribute("value","");
inp6.setAttribute("name",previtem);

var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","hidden");
inp7.setAttribute("value","");
inp7.setAttribute("name",birecnum);

row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(inp6);
row.appendChild(inp7);

tbody.appendChild(row);
x++;
document.forms[0].index.value=x;
}

function GetDueDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "DueDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetDueDate(due_date) {
document.forms[0].delivarydate.value = due_date;
}

function GetDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getcalendar.php",param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetDate(dateval,fieldname) {
//alert(dateval);
//alert(fieldname);
document.forms[0].elements[fieldname].value = dateval;

}

function GetAllEmps(rt)
		{

		var param = rt;
		var winWidth = 300;
		var winHeight = 300;
		var winLeft = (screen.width-winWidth)/2;
		var winTop = (screen.height-winHeight)/2;
		win1 = window.open("getallemps.php?reasontext=" + rt, "Employees", +
			"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
			",width=" + winWidth + ",height=" + winHeight +
			",top="+winTop+",left="+winLeft);
		}
	function SetEmp(emp,emprecnum)
		{
		document.forms[0].so2employee.value = emp;
		document.forms[0].salespersonrecnum.value = emprecnum;
		}

function GetContact(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
var customerrecnum = document.forms[0].companyrecnum.value;
var customer = document.forms[0].company.value;
if (document.forms[0].company.value == '')
{ alert("Please select a customer before selecting a contact");
  return false;
}
win1 = window.open("contact.php?reasontext=" + customerrecnum + "&customer=" + customer,"Contact", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetContact(contact,contarr) {
document.forms[0].contact.value = contact;
var contdet = contarr.split("|");
document.forms[0].phone.value = contdet[1];
document.forms[0].email.value = contdet[2];
document.forms[0].contactrecnum.value = contdet[0];

}
function GetQuoteNo() {
var winWidth = 575;
var winHeight = 375;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getQuote.php","link", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetQuoteNo(inpquoterecnum,inpquotenum) {
var quoterecnum=inpquoterecnum;
var quotenum=inpquotenum;

document.forms[0].quoterecnum.value= quoterecnum;
document.forms[0].quote_num.value=quotenum;
 //alert(document.forms[0].quoterecnum.value);
}

function GetPONo() {
var winWidth = 575;
var winHeight = 375;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getpo.php","link", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetPONo(inpporecnum,inpponum) {
var porecnum=inpporecnum;
var po_num=inpponum;
document.forms[0].porecnum.value=porecnum;
document.forms[0].po_num.value=po_num;
//alert(document.forms[0].porecnum.value);
}

function onSelectcurrency()
        {
        var aind = document.forms[0].currency1.selectedIndex;
        document.forms[0].currency.value = document.forms[0].currency1[aind].text;
        document.forms[0].salval.value = document.forms[0].currency1[aind].text;

        }
function searchsort_fields()
{
    var ind1 = document.forms[0].salesorder.selectedIndex;
    var ind2 = document.forms[0].salesorder_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].salesorderfl.value = document.forms[0].salesorder[ind1].text;
    document.forms[0].salesorder_oper.value = document.forms[0].salesorder_oper[ind2].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;

}

function checkenter(event)
{
    var ind1 = document.forms[0].salesorder.selectedIndex;
    var ind2 = document.forms[0].salesorder_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].salesorderfl.value = document.forms[0].salesorder[ind1].text;
    document.forms[0].salesorder_oper.value = document.forms[0].salesorder_oper[ind2].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;

}
function check_req_fields1()
{
	//alert ('function working');
	//return false;
    var errmsg = '';
    var liflag = 0;
    var max = document.getElementById('index').value;
    // alert(max);
    if (document.forms[0].company.value.length == 0)
    {
    //alert ('function working inside');
         errmsg += 'Please select customer name \n';
    }

    if (document.forms[0].sales_order.value.length == 0)
    {
         errmsg += 'Please salesorder number\n';
    }
    if (document.forms[0].order_date.value.length == 0)
    {
         errmsg += 'Please enter order date\n';
    }

    if (document.forms[0].due_date.value.length == 0)
    {
         errmsg += 'Please enter due date\n';
    }
    if (document.forms[0].tax.value.length == 0)
    {
         errmsg += 'Please enter tax amount\n';
    }

    if (document.forms[0].shipping.value.length == 0)
    {
         errmsg += 'Please enter shipping charges\n';
    }
    if (document.forms[0].labor.value.length == 0)
    {
         errmsg += 'Please enter labor charges\n';
    }
    i= 1;
    while(i < max)
    {
      
       

        line_num="line_num" + i;
        item_desc="item_desc" +i;
        qty="qty" +i;
        price="price"+i;
        amount="amount"+i;
        partnum="partnum"+i;
        dim1="dim1" +i;
        dim2="dim2" +i;
        dim3="dim3" +i;  
        
        var li = document.getElementById(line_num).value;
        if(li != '')
        {


            if(document.getElementById(partnum).value == '')
            {

              errmsg += 'Please enter Partnum for Line No ' + li+'\n';
            }
            if(document.getElementById(qty).value == '' || document.getElementById(qty).value == 0)
            {
                errmsg += 'Please enter Qty for Line No ' + li+'\n';   
            }
            if(document.getElementById(price).value == '' ||document.getElementById(price).value == 0)
            {
                errmsg += 'Please enter Price for Line No ' + li+'\n';   
            }


            liflag = 1;

        }
        i++;

    }
    if (liflag == 0)
     {
            errmsg += 'At least one line item must be present ' + '\n';
     }


     if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}


function printsoDetails(salesorderrecnum) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printsoDetails.php?salesorderrecnum=" + salesorderrecnum, "PrintSO", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}


function GetCIM(rt) 
{
    var param = rt;
    var winWidth = 500;
    var winHeight = 300;
    var winLeft = (screen.width-winWidth)/2;
    var winTop = (screen.height-winHeight)/2;
    win1 = window.open("getallmaster_data.php?reasontext="+rt, param, +
    "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
    ",width=" + winWidth + ",height=" + winHeight +
    ",top="+winTop+",left="+winLeft);
}

function SetCIM(CIM,fieldname)
{
   var CIMarr = CIM.split('|');
   var id1="partnum"+ fieldname;
   var id2="dim1"+ fieldname;
   var id3="dim2"+ fieldname;
   var id4="dim3"+ fieldname;

    
    document.getElementById(id1).value = CIMarr[2];
    document.getElementById(id2).value = CIMarr[3];
    document.getElementById(id3).value = CIMarr[4];
    document.getElementById(id4).value = CIMarr[5];
  
}