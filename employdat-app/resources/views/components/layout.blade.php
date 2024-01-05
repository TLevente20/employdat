<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')

    <title>Employdat</title>
</head>
<body class="min-w-min m-0 p-0">
    {{$slot}}
@livewireScripts
</body>
</html>
