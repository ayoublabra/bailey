@props(['dir'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{$dir ? 'rtl' : 'ltr'}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Bailey | Digitalisation</title>
    @include('partials.dashboard._head')
</head>
<body class="boxed" >
@include('partials.dashboard._body5')
</body>
</html>