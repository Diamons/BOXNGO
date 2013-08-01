<!DOCTYPE HTML>
<html>
<head>
<style>
	body{
		font-family: "Arial", sans-serif;
		font-size:11pt;
	}

	#logo{
		display: block;
	}

	#payments{
		width: 100%;
		border: 1px solid #DDD;
	}

	span.subtext{
		display: block;
		font-size: 8pt;
	}

	tr.header > th{
		border-bottom: 1px solid #DDD;
	}
	td{
		text-align: center;
	}
	img.listingPic{
		width: 100px;
		display: block;
	}


</style>
</head>

<body>
	<img id="logo" src="http://theboxngo.com/logo.png" />
	<table id="payments">
		<tr class="header">
			<th></th>
			<th>Item Sold</th>
			<th>Date of Sale</th>
			<th>Purchase Amount</th>
			<th>Profit <span class="subtext">(amount minus BOX'NGO fees)</span></th>
		</tr>
		<tr>
			<td><?php echo $this->Html->image($order['Shop']['image']['Image']['url'], array('class' => 'listingPic')); ?></td>
			<td><?php echo $order['Shop']['name']; ?></td>
			<td><?php echo date('Y-m-d', strtotime($order['Order']['created'])); ?></td>
			<td><?php echo $order['Order']['totalPrice']; ?></td>
		</tr>
	</table>

</body>
</html>