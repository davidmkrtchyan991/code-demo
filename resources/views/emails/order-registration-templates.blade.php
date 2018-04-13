<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<div style="margin: 20px; padding:0px;
	width:95%;
	box-shadow: 0 0 13px rgba(0,0,0,0.5);">
    <table style="border-collapse: collapse;
							    border-spacing: 0;
								width:100%;
								height:100%;
								margin:0px;padding:0px;
								text-align:center">
        <thead>
        <tr>
            <th>@lang("order.domain.label")</th>
            <th>@lang("order.tariff.label")</th>
            <th>@lang("order.registrationDate.label")</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{$order->domain}}</td>
            <td>{{$order->tariff->name}}</td>
            <td>{{$order->created_at->timezone('Europe/Moscow')->format('d/m/Y H:i:s')}}</td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>