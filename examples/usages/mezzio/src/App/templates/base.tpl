<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        {block name=title}
            Welcome!
        {/block}
    </title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 128 128%22><text y=%221.2em%22 font-size=%2296%22>⚫️</text></svg>">
</head>
<body>
    {block name=content}
        <h1>{$title|escape}</h1>
    {/block}
</body>
</html>
