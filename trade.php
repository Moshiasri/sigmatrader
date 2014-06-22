<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
       <title>Sigmatrader-Trade</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Make real profits on our simulated exchange, or trade real stock on our leveraged matched liquidity exchange">
    <meta name="author" content="Christopher Reeves, Sigma Trader LLC">
    <meta name="keywords" content="Stock, Trading, Exchange, Sigmatrader, Liquidity, Leverage">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="assets/css/docs.css" rel="stylesheet">
    <link href="assets/js/google-code-prettify/prettify.css" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-35985024-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

    <link type='text/css' href='css/osx.css' rel='stylesheet' media='screen' />
     <link type='text/css' href='css/login.css' rel='stylesheet' media='screen' />


    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

  </head>

<div id="username" style="display:none;">
</div>
<div id="username" style="display:none;">
</div>

 <?php


if (isset($_COOKIE["username"]))
{
	$con = mysql_connect("", "", "");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
$username = $_COOKIE["username"];
$password = $_COOKIE["password"];
mysql_select_db("stock_data", $con);

$result = mysql_query("SELECT * FROM Users where Username = '$username' and Password = '$password'");

while($row = mysql_fetch_array($result))
  {
 setcookie("account",  $row['Account'], time()+3600);
setcookie("country",  $row['Country'], time()+3600);
setcookie("email", $row['Email'], time()+3600);

  
  
   
  }

mysql_close($con);
}

?>


<div id='container' >
 
  <div id='content'>
    <div id='osx-modal'>
     
      <input id = "modes" type='button' style="display:none;" name='osx' value='Demo' class='osx demo'/> 
    </div>
   
    <!-- modal content -->
    <div id="osx-modal-content">

    </div>
  </div>

</div>


<script language="javascript">





function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

var account = 0.0;

if(readCookie("username"))
{
account = readCookie("account");
} 






function eraseCookie(name) {
	createCookie(name,"",-1);
}

function postRequest(strURL)
{
  var xmlHttp;
  if(window.XMLHttpRequest)
  { // For Mozilla, Safari, ...
    var xmlHttp = new XMLHttpRequest();
  }
  else if(window.ActiveXObject)
  { // For Internet Explorer
    var xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlHttp.open('GET', strURL, true);
  xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xmlHttp.onreadystatechange = function()
  {
    if (xmlHttp.readyState == 4)
    {
    ajaxloginupdate(xmlHttp.responseText);
  }
  }
xmlHttp.send(strURL);
}

function ajaxloginupdate(str)
{
  if(str=="ok")
  {
     $("#osx-modal-content").html('<div id="osx-modal-title" style="z-index:99999999;">Login</div> <div style="padding-top:20px;"><div style="width:500px; margin-left:20px;" class="alert alert-block alert-info fade in"><button type=button class=close data-dismiss=alert>&times;</button><h4 class=alert-heading>Welcome Back</h4><p>try again or check your email for the password</p></div><form class="form-horizontal" onSubmit="myFunction(); return false;" name="formLogin"  id="formLogin" ><div class="control-group"><label class="control-label"  for="inputEmail">Email</label><div class="controls"><input type="text" id="username" name="username"  placeholder="Email"></div></div><div class="control-group"><label class="control-label" for="inputPassword">Password</label><div class="controls"><input type="password" id="password" name="password" placeholder="Password"></div></div><div class="control-group"><div class="controls"><button  type= "Submit" class="btn">Sign in</button></div></div></form></div>');

     document.location.reload(true);


 
  }
  else
  {
      $("#osx-modal-content").html('<div id="osx-modal-title" style="z-index:99999999;">Login</div> <div style="padding-top:20px;"><div style="width:500px; margin-left:20px;" class="alert alert-block alert-error fade in"><button type=button class=close data-dismiss=alert>&times;</button><h4 class=alert-heading>Oh snap! You got an error!</h4><p>try again or check your email for the password</p></div><form class="form-horizontal" onSubmit="myFunction(); return false;" name="formLogin"  id="formLogin" ><div class="control-group"><label class="control-label"  for="inputEmail">Email</label><div class="controls"><input type="text" id="username" name="username"  placeholder="Email"></div></div><div class="control-group"><label class="control-label" for="inputPassword">Password</label><div class="controls"><input type="password" id="password" name="password" placeholder="Password"></div></div><div class="control-group"><div class="controls"><button  type= "Submit" class="btn">Sign in</button></div></div></form></div>');
  }
}





function registerRequest(strURL)
{
  var xmlHttp;
  if(window.XMLHttpRequest)
  { // For Mozilla, Safari, ...
    var xmlHttp = new XMLHttpRequest();
  }
  else if(window.ActiveXObject)
  { // For Internet Explorer
    var xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlHttp.open('GET', strURL, true);
  xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xmlHttp.onreadystatechange = function()
  {
    if (xmlHttp.readyState == 4)
    {
     

      $("#osx-modal-content").html(xmlHttp.responseText);
      var n=xmlHttp.responseText.search("error");
      if (n== -1)
      {
         document.location.reload(true); 
      }
      
      
    }
  }
xmlHttp.send(strURL);
}


function sendprofitRequest(strURL)
{
  var xmlHttp;
  if(window.XMLHttpRequest)
  { // For Mozilla, Safari, ...
    var xmlHttp = new XMLHttpRequest();
  }
  else if(window.ActiveXObject)
  { // For Internet Explorer
    var xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlHttp.open('GET', strURL, true);
  xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xmlHttp.onreadystatechange = function()
  {
    if (xmlHttp.readyState == 4)
    {
    sendprofitupdate(xmlHttp.responseText);
  }
  }
xmlHttp.send(strURL);
}



function sendprofitupdate(str)
{
  if(str=="ok")
  {
    
      
  }
  else
  {
      
  }
}






function loginajax()
{
  var username = window.document.formLogin.username.value;
  var password = window.document.formLogin.password.value;
  //var url = "login.php?username=" + username + "&password=" +password ;
 
} 
</script>







<script>
function myFunction()
{
var username = window.document.formLogin.username.value;
var password = window.document.formLogin.password.value;
var url = "login.php?username=" + username + "&password=" +password ;
postRequest(url);

}


function registerFunction()
{
    var username = window.document.formregister.username.value;
    var password = window.document.formregister.password.value;
    var country = window.document.formregister.country.value;
    var email = window.document.formregister.email.value;
    var url = "register.php?username=" + username + "&password=" +password + "&country=" +country + "&email=" +email+ "&account=" +account;
    registerRequest(url);
    
}


function sendprofit()
{
    
   username = readCookie("username");
   password = readCookie("password");
    var url = "sendprofit.php?username=" + username + "&password=" +password + "&account=" +account;
    sendprofitRequest(url);
    
}

function del_cookie(name) {
document.cookie = name +
'=; expires=Thu, 01-Jan-70 00:00:01 GMT;';
}

function logout()
{
    
   del_cookie("username");
   del_cookie("password");
   del_cookie("account");
   document.location.reload(true);
    
}

</script>




<div id="savedata" style="display:none;">


</div>

















  <body data-spy="scroll" data-target=".bs-docs-sidebar">



    <!-- Navbar
    ================================================== -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand"  href="./index.html">Current Price: $<span id = "currentprice"></span></a>
          <div class="nav-collapse collapse">
            <ul class="nav">

              
              <li class="">
                <a href="./">Home</a>
              </li>
              <li class="active">
                <a href="trade.php">Trade</a>
              </li>
              <li class="">
                <a href="realmarket.php">Real Market</a>
              </li>
              <li class="">
                <a href="about.php">About</a>
              </li>
               

               
               <?php

                     if (isset($_COOKIE["username"]))
                      {

                        print '<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="profile.php">Profile</a></li>
                  
                 
                  <li class="divider"></li>
                  <li class="nav-header">Actions</li>';

                   print '<li class="">';  
                      print "<a  href = '#' onclick='logout()'>Log Out</a>";
                      print ' </li>';

                 // print'<li><a href="profile.php#reset">Reset Account</a></li></ul></li>';


                      // <li><a href="#">Upgrade</a></li>//



                     
                      }
                      else
                      {
                        print '<li class="">';
                         print "<a  href = '#'' onclick='login()'>Login</a>";
                         print ' </li>';
                      }
                  ?>


             
          
              
            </ul>
          </div>
        </div>
      </div>
    </div>

<!-- Subhead

================================================== -->


<header class="jumbotron " id="overview">
  
  <div class = "trading">
    <div style=" position:absolute; font-size:50px; z-index:1;">
      <div  class="btn-group" data-toggle="buttons-radio">
        <button type="button" style="width:100px;" id = "sell" class="btn btn-danger">Short -100</button>
        <button type="button" style="width:100px;" id = "flat" class="btn btn-info active">Flat 0</button>
        <button type="button" style="width:100px;" id = "buy" class="btn btn-success">Buy +100</button>
      </div>



             
      <div>
        
         <script type="text/javascript"><!--
google_ad_client = "ca-pub-7059043236216083";
/* sigmatrader1 */
google_ad_slot = "8831443599";
google_ad_width = 300;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>


       <div id ="opentrade" class="megatron" style = "width:300px; position:absolute; left:0px;">
            
      </div> 
    </div>




</div>
  <div height="900">

    <canvas id="mycanvas" width = "100%"></canvas>

    </div>
    
    
  </div>
</header>


  <div class="container">

    <!-- Docs nav
    ================================================== 
    <div class="row">
      <div class="span3 bs-docs-sidebar">
        <ul class="nav nav-list bs-docs-sidenav">
          <li><a href="#download-bootstrap"><i class="icon-chevron-right"></i> Download</a></li>
          <li><a href="#file-structure"><i class="icon-chevron-right"></i> File structure</a></li>
          <li><a href="#contents"><i class="icon-chevron-right"></i> What's included</a></li>
          <li><a href="#html-template"><i class="icon-chevron-right"></i> HTML template</a></li>
          <li><a href="#examples"><i class="icon-chevron-right"></i> Examples</a></li>
          <li><a href="#what-next"><i class="icon-chevron-right"></i> What next?</a></li>
        </ul>
      </div>
      <div class="span9">
-->


        <!-- Download
        ================================================== -->
        <section id="download-bootstrap">
          <div class="page-header">
    
          </div>
           <script type="text/javascript" src="smoothie.js"></script>
    

   



<script type="text/javascript">

function save()
{
 $("#osx-modal-content").html('<div id="osx-modal-title" style="z-index:99999999;">Login</div> <div style="padding-top:20px;"><div style="width:500px; margin-left:20px;" class="alert alert-block alert-info fade in"><button type=button class=close data-dismiss=alert>&times;</button><h4 class=alert-heading>Register For SigmaTrader</h4></div><form class="form-horizontal" onSubmit="registerFunction(); return false;" name="formregister"  id="formregister" ><div class="control-group"><label class="control-label"  for="inputusername">Name</label><div class="controls"><input type="text" id="username" name="username"  placeholder="Name"></div></div><div class="control-group"><label class="control-label"  for="inputcountry">Country</label><div class="controls"><select class="span2" name="country" id="country">   <option value="USA" selected>USA</option> <option value="UK">UK</option> <option value="Albania">Albania</option> <option value="Algeria">Algeria</option> <option value="American Samoa">American Samoa</option> <option value="Andorra">Andorra</option> <option value="Angola">Angola</option> <option value="Anguilla">Anguilla</option> <option value="Antigua">Antigua</option> <option value="Argentina">Argentina</option> <option value="Armenia">Armenia</option> <option value="Aruba">Aruba</option> <option value="Australia">Australia</option> <option value="Austria">Austria</option> <option value="Azerbaijan">Azerbaijan</option> <option value="Bahamas">Bahamas</option> <option value="Bahrain">Bahrain</option> <option value="Bangladesh">Bangladesh</option> <option value="Barbados">Barbados</option> <option value="Barbuda">Barbuda</option> <option value="Belgium">Belgium</option> <option value="Belize">Belize</option> <option value="Benin">Benin</option> <option value="Bermuda">Bermuda</option> <option value="Bhutan">Bhutan</option> <option value="Bolivia">Bolivia</option> <option value="Bonaire">Bonaire</option> <option value="Botswana">Botswana</option> <option value="Brazil">Brazil</option> <option value="Virgin islands">British Virgin isl.</option> <option value="Brunei">Brunei</option> <option value="Bulgaria">Bulgaria</option> <option value="Burundi">Burundi</option> <option value="Cambodia">Cambodia</option> <option value="Cameroon">Cameroon</option> <option value="Canada">Canada</option> <option value="Cape Verde">Cape Verde</option> <option value="Cayman isl">Cayman Islands</option> <option value="Central African Rep">Central African Rep.</option> <option value="Chad">Chad</option> <option value="Channel isl">Channel Islands</option> <option value="Chile">Chile</option> <option value="China">China</option> <option value="Colombia">Colombia</option> <option value="Congo">Congo</option> <option value="cook isl">Cook Islands</option> <option value="Costa Rica">Costa Rica</option> <option value="Croatia">Croatia</option> <option value="Curacao">Curacao</option> <option value="Cyprus">Cyprus</option> <option value=" Czech Republic>Czech Republic</option> <option value="Denmark">Denmark</option> <option value="Djibouti">Djibouti</option> <option value="Dominica">Dominica</option> <option value="Dominican Republic">Dominican Republic</option> <option value="Ecuador">Ecuador</option> <option value="Egypt">Egypt</option> <option value="El Salvador">El Salvador</option> <option value="Equatorial Guinea">Equatorial Guinea</option> <option value="Eritrea">Eritrea</option> <option value=" Estonia>Estonia</option> <option value="Ethiopia">Ethiopia</option> <option value="Faeroe isl">Faeroe Islands</option> <option value="Fiji">Fiji</option> <option value="Finland">Finland</option> <option value="France">France</option> <option value="French Guiana">French Guiana</option> <option value="French Polynesia">French Polynesia</option> <option value="Gabon">Gabon</option> <option value="Gambia">Gambia</option> <option value="Georgia">Georgia</option> <option value="Gemany">Germany</option> <option value="Ghana">Ghana</option> <option value="Gibraltar">Gibraltar</option> <option value="GB">Great Britain</option> <option value="Greece">Greece</option> <option value="Greenland">Greenland</option> <option value="Grenada">Grenada</option> <option value="Guadeloupe">Guadeloupe</option> <option value="Guam">Guam</option> <option value="Guatemala">Guatemala</option> <option value="Guinea">Guinea</option> <option value="Guinea Bissau">Guinea Bissau</option> <option value="Guyana">Guyana</option> <option value="Haiti">Haiti</option> <option value="Honduras">Honduras</option> <option value="Hong Kong">Hong Kong</option> <option value="Hungary">Hungary</option> <option value="Iceland">Iceland</option> <option value="India">India</option> <option value="Indonesia">Indonesia</option> <option value="Irak">Irak</option> <option value="Iran">Iran</option> <option value="Ireland">Ireland</option> <option value="Northern Ireland">Ireland, Northern</option> <option value="Israel">Israel</option> <option value="Italy">Italy</option> <option value="Ivory Coast">Ivory Coast</option> <option value="Jamaica">Jamaica</option> <option value="Japan">Japan</option> <option value="Jordan">Jordan</option> <option value="Kazakhstan">Kazakhstan</option> <option value="Kenya">Kenya</option> <option value=Kuwait">Kuwait</option> <option value=Kyrgyzstan">Kyrgyzstan</option> <option value=Latvia">Latvia</option> <option value=Lebanon">Lebanon</option> <option value="Liberia">Liberia</option> <option value="Liechtenstein">Liechtenstein</option> <option value="Lithuania">Lithuania</option> <option value="Luxembourg">Luxembourg</option> <option value="Macau">Macau</option> <option value="Macedonia">Macedonia</option> <option value="Madagascar">Madagascar</option> <option value="Malawi">Malawi</option> <option value="Malaysia">Malaysia</option> <option value="Maldives">Maldives</option> <option value="Mali">Mali</option> <option value="Malta">Malta</option> <option value="Marshall isl">Marshall Islands</option> <option value="Martinique">Martinique</option> <option value="Mauritania">Mauritania</option> <option value="Mauritius">Mauritius</option> <option value="Mexico">Mexico</option> <option value="Micronesia">Micronesia</option> <option value="Moldova">Moldova</option> <option value="Monaco">Monaco</option> <option value="Mongolia">Mongolia</option> <option value="Montserrat">Montserrat</option> <option value="Morocco">Morocco</option> <option value="Mozambique">Mozambique</option> <option value="Myanmar">Myanmar/Burma</option> <option value="Namibia">Namibia</option> <option value="Nepal">Nepal</option> <option value="Netherlands">Netherlands</option> <option value="Netherlands Antilles">Netherlands Antilles</option> <option value="New Caledonia">New Caledonia</option> <option value="New Zealand">New Zealand</option> <option value="Nicaragua">Nicaragua</option> <option value="Niger">Niger</option> <option value="Nigeria">Nigeria</option> <option value="Norway">Norway</option> <option value="Oman">Oman</option> <option value=""Palau>Palau</option> <option value="Panama">Panama</option> <option value="Papua New Guinea">Papua New Guinea</option> <option value="Paraguay">Paraguay</option> <option value="Peru">Peru</option> <option value="Philippines">Philippines</option> <option value="Poland">Poland</option> <option value="Portugal">Portugal</option> <option value="Puerto Rico">Puerto Rico</option> <option value="Qatar">Qatar</option> <option value="Reunion">Reunion</option> <option value="Rwanda">Rwanda</option> <option value="Saba">Saba</option> <option value="Saipan">Saipan</option> <option value="Saudi Arabia">Saudi Arabia</option> <option value="Scotland">Scotland</option> <option value="Senegal">Senegal</option> <option value=""Seychelles>Seychelles</option> <option value="Sierra Leone">Sierra Leone</option> <option value="Singapore">Singapore</option> <option value="Slovac Republic">Slovak Republic</option> <option value="Slovenia">Slovenia</option> <option value="South Africa">South Africa</option> <option value="South Korea">South Korea</option> <option value="Spain">Spain</option> <option value="Sri Lanka">Sri Lanka</option> <option value="Sudan">Sudan</option> <option value="Suriname">Suriname</option> <option value="Swaziland">Swaziland</option> <option value="Sweden">Sweden</option> <option value="Switzerland">Switzerland</option> <option value="Syria">Syria</option> <option value="Taiwan">Taiwan</option> <option value="Tanzania">Tanzania</option> <option value="Thailand">Thailand</option> <option value="Togo">Togo</option> <option value="Trinidad-Tobago">Trinidad-Tobago</option> <option value="Tunesia">Tunisia</option> <option value="Turkey">Turkey</option> <option value="Turkmenistan">Turkmenistan</option> <option value="United Arab Emirates">United Arab Emirates</option> <option value="U.S. Virgin isl">U.S. Virgin Islands</option> <option value="USA">U.S.A.</option> <option value="Uganda">Uganda</option> <option value="United Kingdom">United Kingdom</option> <option value="Urugay">Uruguay</option> <option value="Uzbekistan">Uzbekistan</option> <option value="Vanuatu">Vanuatu</option> <option value="Vatican City">Vatican City</option> <option value="Venezuela">Venezuela</option> <option value="Vietnam">Vietnam</option> <option value="Wales">Wales</option> <option value="Yemen">Yemen</option> <option value="Zaire">Zaire</option> <option value="Zambia">Zambia</option> <option value="Zimbabwe">Zimbabwe</option></select></div></div><div class="control-group"><label class="control-label"  for="inputEmail">Email</label><div class="controls"><input type="text" id="email" name="email"  placeholder="Email"></div></div><div class="control-group"><label class="control-label" for="inputPassword">Password</label><div class="controls"><input type="password" id="password" name="password" placeholder="Password"></div></div><div class="control-group"><div class="controls"><button  type= "Submit" class="btn">Sign in</button></div></div></form></div>');

document.getElementById('modes').click();

}




function login()
{

     $("#osx-modal-content").html('<div id="osx-modal-title" style="z-index:99999999;">Login</div> <div style="padding-top:20px;"><div style="width:500px; margin-left:20px;" class="alert alert-block alert-info fade in"><button type=button class=close data-dismiss=alert>&times;</button><h4 class=alert-heading>enter your username and password</h4><p>An email was sent with your login details</p></div><form class="form-horizontal" onSubmit="myFunction(); return false;" name="formLogin"  id="formLogin" ><div class="control-group"><label class="control-label"  for="inputEmail">Email</label><div class="controls"><input type="text" id="username" name="username"  placeholder="Email"></div></div><div class="control-group"><label class="control-label" for="inputPassword">Password</label><div class="controls"><input type="password" id="password" name="password" placeholder="Password"></div></div><div class="control-group"><div class="controls"><button  type= "Submit" class="btn">Sign in</button></div></div></form></div>');

document.getElementById('modes').click();





}







    var smoothie = new SmoothieChart();
    var currentprice = 0.0;
    var needToConfirm = false;
    var trade = 0.0;
    var execution = 0.0;
    var buy = false;
    var sell = false;
    var flat = true;

    function flatten()
    {
       buy  = false;
      sell = false;
      flat = true;
      account = Number(account) + Number(trade);
      trade = 0.0;

       document.getElementById("opentrade").innerHTML='<div class="well sidebar-nav"> <a class="btn btn-large btn-primary" href="assets/bootstrap.zip">Save Account</a><p>Account: $ <span id="account"></span></p></div>';

       var tmp1 = (Math.round((account)*100)/100).toFixed(2);
       if (tmp1 > 0)
       {
        document.getElementById("account").innerHTML= '<font color = "green">' + String(tmp1) + "</font>";
       }
        if (tmp1 < 0)
       {
        document.getElementById("account").innerHTML= '<font color = "red">' + String(tmp1) + "</font>";
       }
        if (tmp1 == 0)
       {
        document.getElementById("account").innerHTML=  + String(tmp1) ;
       }
        

    }
   
smoothie.streamTo(document.getElementById("mycanvas"));
var canvas = document.getElementsByTagName('canvas')[0];

canvas.width  = document.documentElement.clientWidth;
canvas.height = 280;

var line1 = new TimeSeries();
  var lastVal = 100;
setInterval(function() {
  lastVal += Math.random() < 0.5 ? -0.01 : 0.01;
  line1.append(new Date().getTime(), lastVal);
   
   currentprice = (Math.round(lastVal*100)/100).toFixed(2);
  document.getElementById("currentprice").innerHTML= currentprice;


  if (buy == true )
  {
   
    trade = (Math.round((currentprice-execution)*100)/100).toFixed(2);
    if (trade>0)
    {
        document.getElementById("trade").innerHTML='<font color = "green">' + String(trade) + '</font>' ;
    }
      if (trade<0)
    {
        document.getElementById("trade").innerHTML='<font color = "red">' + String(trade) + '</font>' ;
    }
      if (trade==0)
    {
        document.getElementById("trade").innerHTML= String(trade);
    }
    
   

  }
  if (sell == true )
  {
    trade = (Math.round((execution-currentprice)*100)/100).toFixed(2);
    

       if (trade>0)
    {
        document.getElementById("trade").innerHTML='<font color = "green">' + String(trade) + '</font>' ;
    }
      if (trade<0)
    {
        document.getElementById("trade").innerHTML='<font color = "red">' + String(trade) + '</font>' ;
    }
      if (trade==0)
    {
        document.getElementById("trade").innerHTML= String(trade);
    }

  }
  if(flat == true )
  {
  
  
  
  }


  if(canvas.width  != document.documentElement.clientWidth)
  {
    canvas.width  = document.documentElement.clientWidth; 
  }
  
 
}, 200);

smoothie.addTimeSeries(line1);





    </script>
<!-- File structure
          <div class="row-fluid">
            <div class="span6">
              <h2>Upgrade To Premium</h2>
              <p><strong>More volitility, more profits</strong>Upgrade to premium for only $10.00 and benefit from a 2x and 3x leveraged chart as well as trading on us equities markets.</p>
              <p><a class="btn btn-large btn-primary" href="upgrade.php" >Upgrade Today</a></p>
            </div>
            <div class="span6">
              <h2>Sigma-Trader Live</h2>
              <p>Trade on our live simulated exchange, your orders are matched with other participants who have subscribed and liquidity on other exchanges.</p>
              <p><a class="btn btn-large" href="live.php" >Subscribe to Newsletter</a></p>
            </div>
          </div>
        </section>



        
        ================================================== -->




        <!-- Contents
        ================================================== -->




        <!-- HTML template
        ================================================== -->



        <!-- Examples



        ================================================== -->





        <!-- Next
        ================================================== -->





      </div>
    </div>

  </div>



    <!-- Footer
    ================================================== -->
    <footer class="footer">
      <div class="container">
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>Designed and built by  Chris Reeves</p>
        <ul class="footer-links">
          <li><a href="http://facebook.com/sigmatrader">Our Facebook Page</a></li>
          <li><a href="http://sigmatrader.blogspot.com">our Blog</a></li>
          <li><a href="http://twitter.com/sigmatrader1">Our Twitter</a></li>
        </ul>
      </div>
    </footer>



    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/google-code-prettify/prettify.js"></script>
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>
    <script src="assets/js/bootstrap-affix.js"></script>
    <script src="assets/js/application.js"></script>

    <script>

   $('.btn').click(function(){
    var commandbutton = $(this).attr('id')
    
    
    if(commandbutton == "buy" && buy == false && sell == false)
    {
      execution = currentprice;
      trade = 0.0;  
      buy  = true;
      sell = false;
      flat = false;
         needToConfirm = true;

       document.getElementById("opentrade").innerHTML='<div class="well sidebar-nav"><p> <font color = "green">+100</font> shares @ ' +String(execution) + '</p> <p>Trade: $<span id="trade"></span></p>   <p>Account:       $<span id="account"></span></p></div>';

       
         document.getElementById("trade").innerHTML=0.0;

        var tmp1 = (Math.round((account)*100)/100).toFixed(2);
       if (tmp1 > 0)
       {
        document.getElementById("account").innerHTML= '<font color = "green">' + String(tmp1) + "</font>";
       }
        if (tmp1 < 0)
       {
        document.getElementById("account").innerHTML= '<font color = "red">' + String(tmp1) + "</font>";
       }
        if (tmp1 == 0)
       {
        document.getElementById("account").innerHTML=  + String(tmp1) ;
       }
        
     
    }


     if(commandbutton == "buy" && buy == false && sell == true)
     {
        flatten();
         execution = currentprice;
      trade = 0.0;  
      buy  = true;
      sell = false;
      flat = false;
        needToConfirm = true;

       document.getElementById("opentrade").innerHTML='<div class="well sidebar-nav"><p> <font color = "green">+100</font> shares @ ' +String(execution) + '</p> <p>Trade: $<span id="trade"></span></p>   <p>Account:     $<span id="account"></span></p></div>';

       
         document.getElementById("trade").innerHTML=0.0;

        var tmp1 = (Math.round((account)*100)/100).toFixed(2);
       if (tmp1 > 0)
       {
        document.getElementById("account").innerHTML= '<font color = "green">' + String(tmp1) + "</font>";
       }
        if (tmp1 < 0)
       {
        document.getElementById("account").innerHTML= '<font color = "red">' + String(tmp1) + "</font>";
       }
        if (tmp1 == 0)
       {
        document.getElementById("account").innerHTML=  + String(tmp1) ;
       }
        
        sendprofit(); 

     }

     if(commandbutton == "sell" && sell==false && buy ==false)
    {

      execution = currentprice;
      trade = 0.0;  
      buy  = false;
      sell = true;
      flat = false;
        needToConfirm = true;


      document.getElementById("opentrade").innerHTML='<div class="well sidebar-nav"><p> <font color = "red">-100</font> shares @ ' +String(execution) + '</p> <p>Trade: $ <span id="trade"></span></p>   <p>Account:      $ <span id="account"></span></p></div>';

          trade = 0.0;

       var tmp1 = (Math.round((account)*100)/100).toFixed(2);
       if (tmp1 > 0)
       {
        document.getElementById("account").innerHTML= '<font color = "green">' + String(tmp1) + "</font>";
       }
        if (tmp1 < 0)
       {
        document.getElementById("account").innerHTML= '<font color = "red">' + String(tmp1) + "</font>";
       }
        if (tmp1 == 0)
       {
        document.getElementById("account").innerHTML=  + String(tmp1) ;
       }
        
    }

    if(commandbutton == "sell" && sell == false && buy == true)
    {
      flatten();
       execution = currentprice;
      trade = 0.0;  
      buy  = false;
      sell = true;
      flat = false;
        needToConfirm = true;




      document.getElementById("opentrade").innerHTML='<div class="well sidebar-nav"><p> <font color = "red">-100</font> shares @ ' +String(execution) + '</p> <p>Trade: $ <span id="trade"></span></p>   <p>Account:      $ <span id="account"></span></p></div>';

          trade = 0.0;

       var tmp1 = (Math.round((account)*100)/100).toFixed(2);
       if (tmp1 > 0)
       {
        document.getElementById("account").innerHTML= '<font color = "green">' + String(tmp1) + "</font>";
       }
        if (tmp1 < 0)
       {
        document.getElementById("account").innerHTML= '<font color = "red">' + String(tmp1) + "</font>";
       }
        if (tmp1 == 0)
       {
        document.getElementById("account").innerHTML=  + String(tmp1) ;
       }

       sendprofit(); 
    }

     if(commandbutton == "flat")
    {
      buy  = false;
      sell = false;
       needToConfirm = false;
      flat = true;
      account = Number(account) + Number(trade);
      trade = 0.0;
      
        //document.location.hash = '#contents';

        if (readCookie("username") != null)
        {
           document.getElementById("opentrade").innerHTML='<div class="well "><a class="btn btn-large btn-primary" href="profile.php">View Profile</a><p>Account:    $ <span id="account"></span></p></div>'; 
        
        }
        else
        {
          document.getElementById("opentrade").innerHTML='<div class="well "><a class="btn btn-large btn-primary " onclick="save()">Save Account</a><p>Account:    $ <span id="account"></span></p></div>'; 
        }  
      
       var tmp1 = (Math.round((account)*100)/100).toFixed(2);
       if (tmp1 > 0)
       {
        document.getElementById("account").innerHTML= '<font color = "green">' + String(tmp1) + "</font>";
       }
        if (tmp1 < 0)
       {
        document.getElementById("account").innerHTML= '<font color = "red">' + String(tmp1) + "</font>";
       }
        if (tmp1 == 0)
       {
        document.getElementById("account").innerHTML=  + String(tmp1) ;
       }

       sendprofit(); 
      
    }



    });
   



    </script>




<script language="JavaScript">

jQuery(window).bind('beforeunload', function(event) {
    event.stopPropagation();
    if (needToConfirm)
    {
    flatten(); 
    sendprofit(); 
     event.returnValue = "Your Position has been flattened";
    return event.returnValue;
    }
    else
    {}
 
   
});


</script>


    <!-- OSX Style CSS files -->



<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='js/osx.js'></script>

    


  </body>
</html>

