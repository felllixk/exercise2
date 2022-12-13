<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Backend Page</title>
    @vite(['resources/js/app.js','resources/css/app.css'])
    @vite('app/Modules/Backend/Assets/app.js')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
    <div id="backend" class="h-screen"></div>
</body>
</html>