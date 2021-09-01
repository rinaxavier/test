<!DOCTYPE html>
<html lang="en">
<head>
  <title>Invoice</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
  .table>tfoot>tr>td
  {
	  text-align:right;
  }
  .table>thead
  {
	  background:#3579b6;
	  color:white;
  }
  </style>
</head>
<body>
<div class="container" id="printableId">
  <h2>Invoice</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Quantity</th>
        <th>Unit Price (in $)</th>
		<th>Tax</th>
		<th>Total</th>
      </tr>
    </thead>
    <tbody>
		<?php
	include 'conMod.php';
	$con = OpenConn();
	$t=0;
	$t1=0;
	$sql=mysqli_query($con,"select * from item");
	while($res=mysqli_fetch_array($sql))
	{
		$total=$res['quantity']*$res['price'];
		$discount=$res['discount'];
		$discounttype=$res['discount_type'];		
		$taxrate=$total+($total*$res['tax']/100);
		$t=$t+$total;
		$t1=$t1+$taxrate;
		
	?>      
	  <tr>
        <td><?php echo $res['name'];?></td>
        <td><?php echo $res['quantity'];?></td>
        <td><?php echo $res['price'];?></td>
		<td><?php echo $res['tax'];?></td>
		<td><?php echo $taxrate;?></td>
      </tr>
	<?php }
	if($discounttype=='%')
	{
		$d=$t1*$discount/100;
		$grandtotal=$t1-$d;
	}
	else
	{
		$grandtotal=$t1-$discount;
	}
	?>    
	</tbody>
	<tfoot style="background: aliceblue">
	<tr>
	<td colspan='4'>Discount :</td>
	<th>$<?php echo $discount;?></th>
	</tr>	
	<tr>
	<td colspan='4'>Subtotal with Tax :</td>
	<th>$<?php echo $t1;?></th>
	</tr>
	<tr>
	<td colspan='4'>Subtotal without Tax :</td>
	<th>$<?php echo $t;?></th>
	</tr>
	<tr>
	<td colspan='4'>Total :</td>
	<th>$<?php echo $grandtotal;?></th>
	</tr>	
	</tfoot>
  </table>
</div>
<div class="container">
	<button type="button" name="add" class="btn btn-success btn-sm add" onclick="PrintElem()">PRINT</button>
</div>
 <script type="text/javascript">

  function PrintElem()
    {
	 var printContents = document.getElementById('printableId').innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
</body>
</html>