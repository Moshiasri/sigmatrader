<?php
$username=$_GET["username"];
$password=$_GET["password"];
$account=$_GET["account"];

setcookie("account", $account, time()+3600);


$con = mysql_connect("", "", "");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  echo "PHAIL";
  }

mysql_select_db("stock_data", $con);

$sql="Update  Users set Account = '$account' where Username = '$username' AND Password = '$password'";
mysql_query($sql);


if (1==1)
{
echo"ok";

}
else
{
echo"fail";
}




mysql_close($con);
?>

