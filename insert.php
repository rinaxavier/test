<?php
include 'conMod.php';
$con = OpenConn();
if(isset($_POST['submit']))
{
	$name=$_POST['nme'];
	$qty=$_POST['qty'];
	$price=$_POST['price'];
	$tax=$_POST['tax'];
	$discount=$_POST['discount'];
	$discounttype=$_POST['discounttype'];
	mysqli_query($con,"truncate table item");
	for($i=0;$i<count($name);$i++)
	{
		mysqli_query($con,"insert into item (`name`,`quantity`,`price`,`tax`,`discount`,`discount_type`)
						VALUES('$name[$i]','$qty[$i]','$price[$i]','$tax[$i]','$discount','$discounttype')");
	}
	header("location:invoice.php");
	
}
?>