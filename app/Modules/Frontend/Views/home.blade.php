<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @vite(['resources/js/app.js','resources/css/app.css'])
    @vite('app/Modules/Frontend/Assets/app.js')
    <title>Frontend Page</title>
</head>
<body>
    <div id="frontend" class="h-screen"></div>
</body>
</html>