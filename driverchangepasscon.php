<?php
include 'dbcon.php';

$tp=$_SESSION['utype'];
if(!(isset($_SESSION['user_name']))||$tp!=2)
{	
	//header('location:index.php');
}
if(isset($_POST['submit']))
{
$a=$_SESSION['user_name'];
$b=$_POST["pass"];
$c=$_POST["pass1"];
$d=$_POST["pass2"];
//echo($a);
}
$sql="SELECT * FROM `login` WHERE user_name='$a'";
$result=mysqli_query($con,$sql);
r=mysqli_fetch_array($result)


	if($a==  $row['user_name']&&$b==$row['passsword'])
	{
			
				$sql2="update `login` set password='$c' WHERE user_name='$a'";
				$result=mysqli_query($con,$sql2) ;
					$subject = "TaxiGo";
	$message = "
<html>
<head>
<title>TaxiGo</title>
</head>
<body>
<div style='background-color:white;
border:2px solid black;;
width:50%;
height:50%;
border-radius:4px;'>

<div style='position:relative;
background-color:#545472;
margin-top:-50%;
width:100%;
height:20%;'>
<h1 style='font-family:Lucida Calligraphy; color:white;'>taxigo</h1>
</div>
<div style='background-color:white;

margin-left:10%;
width:80%;
height:60%;'>
<p>Hi, 
<span>$a</span> </p>
<p>Your password is changed and your new password is:</p>
<table>
<tr>
<td>Username:<span> $a</span></td>
</tr>
<tr>
<td>password:<span> $c</span></td>
</tr>
<p>Please use this username and password to login to your account from here:http://localhost:81/taxigo/login.php</p>
</table>
</div>
</div>
</body>
</html>
	";

	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	$headers .= 'From: <webmaster@example.com>' . "\r\n";
	$headers .= 'Cc: myboss@example.com' . "\r\n";

	        mail($a,$subject,"$message",$headers);
			$id=$_SESSION["id"];
			$sql1="UPDATE `login` SET `status`='0' WHERE `login_id`='$id'";
			$result=mysqli_query($con,$sql1);
			//header('location:index.php');
			
			unset($_SESSION["user_name"]);
			unset($_SESSION['passsword']);
			unset($_SESSION['utype']);
			unset($_SESSION['id']);
			session_destroy();
	header('location:login.php');

}
else
{
	echo "<script>if(confirm('username and password are enterd incorrect!!')){document.location.href='driverchangepass.php'}else{document.location.href='driverhome.php'};</script>";
	
}
}
else
{
	echo "<script>if(confirm('new password are mismatch!!')){document.location.href='driverchangepass.php'}else{document.location.href='driverhome.php'};</script>";
	
}
?> 
	
