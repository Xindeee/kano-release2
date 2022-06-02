<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kano | {$page_title}</title>
    {foreach $stylesheets as %stylesheet}
    <link href="design/css/{%stylesheet}.css" rel="stylesheet">
    {/foreach}
    {foreach $scripts as %script}
    <script src="design/js/{%script}.js"></script>
    {/foreach}
</head>
    <body>
        {$content}
    </body>
</html>