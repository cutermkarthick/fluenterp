/*
 * workflow.js
 * validation for aawfstage.php
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam 
 * bmandyam@fluentsoft.com
 */

function check_req_fields(rt)
{
var errmsg = '';
if (document.forms[0].stage.value=='')
{
	errmsg +="Stage should be selected\n";
}
if (document.forms[0].doctype.value=='')
{
	errmsg +="Doctype should be entered\n";
}
if (document.forms[0].dept.value=='')
{
	errmsg +="Department should be entered\n";
}
if (document.forms[0].est_time.value=='')
{
	errmsg +="Estimated time should be entered\n";
}

      if (errmsg == '')
    {
        var aind = document.forms[0].act_status.selectedIndex;
  document.forms[0].activeval.value = document.forms[0].act_status[aind].text;
        return true;      
    }
    else
    {
       alert (errmsg);
       return false;
    }
}

function validate(field)
{
var valid="0,1,2,3,4,5,6,7,8,9";
var ok="yes";
var temp;
for (var i=0;i<field.value.length;i++)
{
temp= "" + field.value.substring(i,i+1);
if(valid.indexOf(temp)== "-1")
	ok="no";
}
 if(ok=="no")
{
	alert("Enter Numbers Only");
	field.value='';
	field.focus();
	field.select();

}
}

