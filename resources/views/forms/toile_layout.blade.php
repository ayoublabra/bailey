
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#7952b3">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@section('title')</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <style>
        body {
            font-family: Arial, sans-serif;
        }

    </style>
</head>
<body> 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

@yield('content')
@include('forms.toile_js')
</body>
</html>