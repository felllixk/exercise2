<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @vite(['app/Modules/Frontend/Assets/app.js'])
    <title>Hallo</title>
</head>
<body>
    @csrf
    <div id="app"></div>
</body>
</html>