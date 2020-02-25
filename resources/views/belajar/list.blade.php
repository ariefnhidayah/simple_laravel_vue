<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Test</title>
</head>
<body>
	<ul>
		@foreach($data as $item)
			<li>{{ $item['judul'] }}</li>
		@endforeach
	</ul>
</body>
</html>