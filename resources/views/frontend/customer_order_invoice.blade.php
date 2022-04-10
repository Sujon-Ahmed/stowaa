<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>INVOICE</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="UTF-8">
	<style media="all">
        * {
			margin: 0;
			padding:0;
			box-sizing: border-box
		}
		body{
			font-size: 0.875rem;
            font-family: sans-serif;
            font-weight: normal;
			padding:0;
			margin:0; 
		}
		.gry-color *,
		.gry-color{
			color:#000;
		}
		table{
			width: 100%;
		}
		table th{
			font-weight: normal;
		}
		table.padding th{
			padding: .25rem .7rem;
		}
		table.padding td{
			padding: .25rem .7rem;
		}
		table.sm-padding td{
			padding: .1rem .7rem;
		}
		.border-bottom td,
		.border-bottom th{
			border-bottom:1px solid #eceff4;
		}
		.text-left{
			text-align: left;
		}
		.text-right{
			text-align: right;
		}
	</style>
</head>
<body>
	<div>
		<div style="background: #eceff4;padding: 1rem;">
			<table>
				<tr>
					<td>						
						<h3>Stowaa</h3>
					</td>
					<td style="font-size: 1.5rem; right:0;" class="text-right strong">INVOICE</td>
				</tr>
			</table>
			<table>
				<tr>
					<td style="font-size: 1rem;" class="strong">stowaa.com</td>
					<td class="text-right"></td>
				</tr>
				<tr>
					<td class="gry-color small">Dhaka, Bangladesh</td>
					<td class="text-right"></td>
				</tr>
				<tr>
					<td class="gry-color small">Email : info@stowaa.com</td>
					<td class="text-right small"><span class="gry-color small">Order ID:</span> <span class="strong">{{ $order->id }}</span></td>
				</tr>
				<tr>
					<td class="gry-color small">Phone : ++88017 4340 5982</td>
					<td class="text-right small"><span class="gry-color small">Order Date :</span> <span class="strong">{{ date('M-d-Y h:i A', strtotime($order->created_at)) }}</span></td>
				</tr>
			</table>

		</div>

		<div style="padding: 1rem;padding-bottom: 0">
            <table>
				@foreach ($billingDetails as $item)					
				<tr><td class="strong small gry-color">Bill to:</td></tr>
				<tr><td class="strong">{{ $item->name }}</td></tr>
				<tr><td class="gry-color small">{{ $item->address }}, {{ $item->rel_to_city->name }}, {{ $item->rel_to_country->name }}</td></tr>
				<tr><td class="gry-color small">Email: {{ $item->email }}</td></tr>
				<tr><td class="gry-color small">Phone: {{ $item->phone }}</td></tr>
				@endforeach
			</table>
		</div> 

	    <div style="padding: 1rem;">
			<table class="padding text-left small border-bottom">
				<thead>
	                <tr class="gry-color" style="background: #eceff4;">
	                    <th width="35%" class="text-left">Product Name</th>
						<th width="15%" class="text-left">Delivery Type</th>
	                    <th width="10%" class="text-left">Qty</th>
	                    <th width="15%" class="text-left">Unit Price</th>
	                    <th width="10%" class="text-left">Tax</th>
	                    <th width="15%" class="text-right">Total</th>
	                </tr>
				</thead>
				<tbody class="strong">
	                @foreach ($orderProducts as $product)
		               <tr>
						   <td>{{ $product->rel_to_product->product_name }}</td>
						   <td>
							   @if ($order->payment_method == 1)
								   <p>Home Delivery</p>
								   @else 
								   <p>Others Method</p>
							   @endif
						   </td>
						   <td>{{ $product->quantity }}</td>
						   <td>{{ $product->price }}</td>
						   <td>0</td>
						   <td>{{ $product->price * $product->quantity }}</td>
					   </tr>
					@endforeach
	            </tbody>
			</table>
		</div>

	    <div style="padding:0 1.5rem;">
	        <table class="text-right sm-padding small strong">
	        	<thead>
	        		<tr>
	        			<th width="60%"></th>
	        			<th width="40%"></th>
	        		</tr>
	        	</thead>
		        <tbody>
			        <tr>
						<td class="text-left">
                            {{ QrCode::size(200)->generate($order->id) }}
			            </td>					
			            <td>
					        <table class="text-right sm-padding small strong">
						        <tbody>
							        <tr>
							            <th class="gry-color text-left">Sub Total</th>							           
										<td>{{ $order->sub_total }}</td>
							        </tr>
							        <tr>
							            <th class="gry-color text-left">Shipping Cost</th>
							            <td class="currency">{{ $order->delivery_charge }}</td>
							        </tr>
							        <tr class="border-bottom">
							            <th class="gry-color text-left">Total Tax</th>
							            <td class="currency">0</td>
							        </tr>
				                    <tr class="border-bottom">
							            <th class="gry-color text-left">Coupon Discount</th>
							            <td class="currency">{{ $order->discount }}</td>
							        </tr>
							        <tr>
							            <th class="text-left strong">Grand Total</th>
							            <td class="currency">{{ $order->sub_total + $order->delivery_charge +  $order->discount }}</td>
							        </tr>
						        </tbody>
						    </table>
			            </td>
			        </tr>
		        </tbody>
		    </table>
	    </div> 

	</div>
</body>
</html>
