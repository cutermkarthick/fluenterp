<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Login  </title>
<link rel="stylesheet" href="./css/style.css" type="text/css" />
<script type="text/javascript" src="./js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="./js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script language="javascript" src="scripts/crypt.js"></script>
<script language="javascript" src="scripts/login.js"></script>
<script language="javascript" src="scripts/mouseover.js"></script>
<link rel="stylesheet" href="style.css">


<script type="text/javascript">
$(document).ready(function(){
    $('.loginform button').hover(function(){
        $(this).stop().switchClass('default','hover');
    },function(){
        $(this).stop().switchClass('hover','default');
    });
    
    $('#login').submit(function(){
        var u = jQuery(this).find('#username');
        if(u.val() == '') {
            jQuery('.loginerror').slideDown();
            u.focus();
            return false;   
        }
    });
    
    $('#username').keypress(function(){
        jQuery('.loginerror').slideUp();
    });

});


function check_req_fields()
{
    var errmsg = '';
    if (document.forms[0].userName.value.length == 0 || 
        document.forms[0].userPassword.value.length == 0 ||
        document.forms[0].siteid.value.length == 0) 
    {
         errmsg = 'Missing UserName/Password/Site ID\n';
    }
    document.forms[0].userPassword.value = calcMD5(document.forms[0].userPassword.value);
    if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }

}
function putfocus()
{
   document.forms[0].userName.focus();
}



</script>
<!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->


<meta charset="UTF-8"></head>

<body class="login" onload="putfocus()">

<div class="loginbox radius3">
    <div class="loginboxinner radius3">
        <div class="loginheader">
            <div class="logo"><img src="./images/fsi_logo.png" alt="" /></div>

        </div>
        <!--loginheader-->
        <div>
        <p style=" text-align:center;font-family:BebasNeueRegular,Arial,Helvetica,sans-serif; font-size:18px; color:#117493;">Welcome to FluentERP</p>
        </div>
                 <div class="loginform">
            <div class="loginerror"><p>Invalid username or password</p></div>
            <form id="login" action="processLogin.php" method="post">
                <p>
                    <label for="username" class="bebas">Username</label>
                    <input type="text" id="userName" name="userName" class="radius2" />
                </p>
                <p>
                    <label for="password" class="bebas">Password</label>
                    <input type="password" id="userPassword" name="userPassword" class="radius2" />
                </p>
                <p>
                    <label for="username" class="bebas">SiteId</label>
                    <input type="text" id="siteid" name="siteid" class="radius2" />
                </p>
                
                <p>


                    <button onclick="javascript:return check_req_fields()">Sign in</button>

                      <center><a href="signup.php" class="radius2">Sign up</a></center>
                </p>

                 <input type="hidden" name="pagename" id="pagename" value="login"></input>
                <!-- <p><a href="" class="whitelink small">Can't access your account?</a></p> -->
            </form>
        </div><!--loginform-->
    </div><!--loginboxinner-->
</div><!--loginbox-->

</body>
</html>
