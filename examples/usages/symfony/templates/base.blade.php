<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>
            @section('title')
                Welcome!
            @show
        </title>
        <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 128 128%22><text y=%221.2em%22 font-size=%2296%22>⚫️</text></svg>">
    </head>
    <body>
        @section('content')
            <h1>{{ $title }}</h1>
        @show
    </body>
</html>