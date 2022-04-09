<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>INVOICE</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&family=Montserrat&display=swap" rel="stylesheet">
	<style media="all">
    * {
			margin: 0;
			padding:0;
		}
		body{
			font-size: 0.875rem;
      font-family: 'Lato', sans-serif;
      font-family: 'Montserrat', sans-serif;
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
            <img src="{{ asset('frontend_assets/images/logo/logo_1x.png') }}" alt="">
					</td>
					<td style="font-size: 1.5rem;" class="text-right strong">INVOICE</td>
				</tr>
			</table>
			<table>
				<tr>
					<td style="font-size: 1rem;" class="strong">stowaa.com</td>
					<td class="text-right"></td>
				</tr>
				<tr>
					{{-- <td class="gry-color small">{{ get_setting('contact_address') }}</td> --}}
					<td class="text-right"></td>
				</tr>
				<tr>
					<td class="gry-color small">Email: info@stowaa.com</td>
					<td class="text-right small"><span class="gry-color small">Order ID:</span> <span class="strong">{{ $order->id }}</span></td>
				</tr>
				<tr>
					<td class="gry-color small">Phone: ++8801743405982</td>
					<td class="text-right small"><span class="gry-color small">Order Date:</span> <span class=" strong">{{  date('M-d-Y h:i A', strtotime($order->created_at)) }}</span></td>
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

	  <div style="padding: 1rem; display:flex" >
			<table class="padding text-left small border-bottom">
				<thead>
					<tr class="gry-color" style="background: #eceff4;">
						<th width="10%" class="text-left">Product Name</th>
						<th width="5%" class="text-left">Price</th>
						<th width="5%" class="text-left">Qty</th>
					</tr>
				</thead>
				<tbody class="strong">
					@foreach ($orderProducts as $item)
						<tr>
							<td> 
								{{ $item->rel_to_product->product_name }}
							</td>
							<td>৳ {{ $item->rel_to_product->product_price }}</td>
							<td>{{ $item->quantity }}</td>

						</tr>
					@endforeach
				</tbody>
			</table>
		</div>

	</div>
</body>
</html>
