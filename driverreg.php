<?php
include 'dbcon.php';
if(!(isset($_SESSION['user_name'])))
{
	header('location:index.php');
}
if(isset($_POST['submit']))
{
$a=$_POST["fname"];
$b=$_POST["lname"];
$l=$_POST["pass"];
$c=$_POST["email"];
$d=$_POST["dob"];
$e=$_POST["phno"];
//$f=$_POST["ufile"];
$g=$_POST["address"];
$h=$_POST["idno"];
$m=$_POST["idno1"];
//$i=$_POST["ufile1"];
$k=$_POST["gender"];

$path= "upload/".$_FILES['photo']['name'];
copy($_FILES['photo']['tmp_name'], $path);
$path1= "upload/".$_FILES['photo2']['name'];
copy($_FILES['photo2']['tmp_name'], $path1);
$path2= "upload/".$_FILES['photo3']['name'];
copy($_FILES['photo3']['tmp_name'], $path2);

$sql="INSERT INTO `registration`(`type_id`, `fname`, `lname`, `password`,`phno`, `photo`, `emailid`, `Dob`, `gender`, `Address`, `idproofno`, `idproof`) VALUES ('3','$a','$b','$l','$e','$path','$c','$d','$k','$g','$h','$path1')";
$result=mysqli_query($con,$sql);

$q = "SELECT `reg_id` FROM `registration` WHERE emailid= '$c' ";
$result = $con->query($q);
$row = $result->fetch_assoc();
$rid=$row["reg_id"];

$sql2="INSERT INTO `licence`(`reg_id`, `l_no`, `l_proof`, `status`) VALUES('$rid','$m','$path2','0')";
$result2=mysqli_query($con,$sql2);

$sql1="INSERT INTO `login`(`reg_id`, `user_name`, `passsword`, `status`) VALUES('$rid','$c','$l','0')";
$result1=mysqli_query($con,$sql1);
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
<span>$a $b</span> </p>
<p>Thank you for registering TaxiGo</p>
<table>
<tr>
<td>Username:<span> $c</span></td>
</tr>
<tr>
<td>password:<span> $p</span></td>
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

mail($c,$subject,"$message",$headers);
header('location:adminhome.php');
}
else
{
	 
	 
	echo "<script>if(confirm('$c allredy exists try with another email id')){document.location.href='adminhome.php#popup'}else{document.location.href='adminhome.php'};</script>";
	 
	 //echo "<script type='text/javascript' 'header('location:index.php')'>if(alert('$c allredy exists try with another email id')){document.location.href='index.php'};</script>";
	
}

?>
