<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Aulab post</title>
</head>
<body>
    <x-navbar/>
    @if (session('message'))
        <div class="alert alert-success">
            <p class="m-0">{{session('message')}}</p>
        </div>
    @endif
    <div class="min-vh-100">
        {{$slot}}
    </div>

    

    <x-footer/>
</body>
</html>