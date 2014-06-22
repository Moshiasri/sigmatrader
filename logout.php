<?php
$username=$_GET["username"];
$password=$_GET["password"];
$country=$_GET["country"];
$email=$_GET["email"];
$account=$_GET["account"];


$con = mysql_connect("", "", "");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  echo "PHAIL";
  }

mysql_select_db("stock_data", $con);

$sql="INSERT INTO  Users (Username,Password,Country,Email,Account) VALUES ('$username','$password','$country','$email','$account')";
mysql_query($sql);


if (1==1)
{
echo"ok";
session_start();

$_SESSION['username'] = $username;
$_SESSION['password'] = $password;
}
else
{
echo"fail";
}




mysql_close($con);
?>

