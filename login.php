<?php
$email=$_GET["username"];
$password=$_GET["password"];

$con = mysql_connect("", "", "");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  echo "PHAIL";
  }

mysql_select_db("stock_data", $con);

$sql="SELECT * FROM Users WHERE Email = '$email' and Password = '$password'";
$result = mysql_query($sql);
$row = mysql_num_rows($result);
if(mysql_num_rows($result) > 0) 
{
	while($row = mysql_fetch_assoc($result))
	{
setcookie("username", $row['Username'], time()+3600);
setcookie("account", $row['Account'], time()+3600);
setcookie("password", $row['Password'], time()+3600);	

	}

echo"ok";
}
else
{
echo"fail";
}



mysql_close($con);
?>