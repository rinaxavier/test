<!DOCTYPE html>
<html lang="en">
<head>
  <title>Invoice</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<form method="post" action="insert.php">
  <h2>Purchase form</h2>
  <table class="table table-striped" id="item_table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Quantity</th>
        <th>Unit Price (in $)</th>
		<th>Tax</th>
		<th>Total</th>
		<th></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><input type="text" name="nme[]" id="nme0" class="form-control" required></td>
        <td><input type="number" name="qty[]" id="qty0" class="form-control" onChange="calc(0)" required></td>
        <td><input type="number" name="price[]" id="price0" class="form-control" onChange="calc(0)" required></td>
		<td><select name="tax[]" id="tax0" class="form-control" onChange="calc(0)" required>
		<option value="0">0%</option>
		<option value="1">1%</option>
		<option value="5">5%</option>
		<option value="10">10%</option>
		</select>
		</td>
		<td><input type="hidden" name="pricetotal" id="pricetotal0" class="form-control pricetotal"><input type="text" name="total" id="total0" class="form-control total" readonly></td>
		<td><button type="button" name="add" class="btn btn-success btn-sm add">+</button></td>
      </tr>
	  </tr>
    </tbody>
	<tfoot style="background: aliceblue;text-align:right">
	<tr>
	<td colspan='4'>Discount</td>
	<td><input type="number" name="discount" id="discount" class="form-control"></td>
	<td><select name="discounttype" id="discounttype"><option>$</option><option>%</option></select></td>
	</tr>	
	<tr>
	<td colspan='4'>Subtotal (with Tax)</td>
	<td><input type="text" name="subtotal" id="subtotal" class="form-control" readonly></td>
	<td></td>
	</tr>
	<tr>
	<td colspan='4'>Subtotal (without Tax)</td>
	<td><input type="text" name="subtotal" id="subtotal1" class="form-control" readonly></td>
	<td></td>
	</tr>
	<tr>
	<td colspan='4'>Total</td>
	<th><input type="text" name="grandtotal" id="grandtotal" class="form-control" readonly></th>
	<td></td>
	</tr>
	<tr>
	<td colspan='6'><button type="submit" name="submit" class="btn btn-warning btn-sm">Generate Invoice</button></td>
	</tr>
	</tfoot>
  </table></form>
</div>
<script src="jquery.js"></script>
<script>
$(document).ready(function(){
 var i=1;
 $(document).on('click', '.add', function(){
	 
  var html = '';
  html += '<tr>';
  html += '<td><input type="text" name="nme[]" id="nme'+i+'" class="form-control" required></td>';
  html += '<td><input type="number" name="qty[]" id="qty'+i+'"  onChange="calc('+i+')" class="form-control" required></td>';
  html += '<td><input type="number" name="price[]" id="price'+i+'" onChange="calc('+i+')" class="form-control" required></td>';
  html += '<td><select name="tax[]" id="tax'+i+'" class="form-control" onChange="calc('+i+')" required><option value="0">0%</option><option value="1">1%</option><option value="5">5%</option><option value="10">10%</option></select></td>';
  html += '<td><input type="hidden" name="pricetotal" id="pricetotal'+i+'" class="form-control pricetotal"><input type="text" name="total" id="total'+i+'" class="form-control total" readonly></td>';
  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove">X</button></td></tr>';
  $('#item_table').append(html);  
  i++;
 });
 
 $(document).on('click', '.remove', function(){
  $(this).closest('tr').remove();
 });
});
</script>
<script>
sum=0;
function calc(t)
{
	$('#discount').val('');	
 	var qty=$('#qty'+t).val();	
	var price=$('#price'+t).val();
	var taxrate=$('#tax'+t).val();	
	var total=price*qty;
	var tax=parseFloat(total*taxrate/100);
	var t1=parseFloat(total)+parseFloat(tax);
	$('#total'+t).val(t1);	
	$('#pricetotal'+t).val(total);	
	fnAlltotal();
}

function fnAlltotal() {
    var total = 0;
	var total1 = 0;
    $(".total").each(function () {
        total += parseFloat($(this).val() || 0);
    });
	$(".pricetotal").each(function () {
        total1 += parseFloat($(this).val() || 0);
    });
    $("#subtotal").val(total);//subtotal with tax
	$("#subtotal1").val(total1);//subtotal without tax
	$("#grandtotal").val(total.toFixed(2));//grandtotal
}
$('#discount').change(function()
{
	discount();
});
$('#discounttype').change(function()
{
	discount();
});
function discount() {
var d=$('#discount').val();	
var t=$('#discounttype').val();
var temp=$("#subtotal").val();
	if(t=='%')
	{		
		var disc=parseFloat(temp*d/100);
		var finaldisc=parseFloat(temp)-parseFloat(disc);
		$("#grandtotal").val(finaldisc);
	}
	else
	{
		var finaldisc=parseFloat(temp)-parseFloat(d);
		$("#grandtotal").val(finaldisc.toFixed(2));
	}
}       

</script>
</body>
</html>
      