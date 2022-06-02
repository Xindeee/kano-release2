<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="favicon.ico">
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
   <style>
        html, body {
            height: 100%;
        }
    </style>

    <div class="container-fluid d-flex h-100 justify-content-center align-items-center p-0">

        <div class="row bg-white shadow-sm">

           <div class="col border rounded p-4">
            <h3 class="text-center mb-4">Kano</h3>
            <form id="loginForm" action="javascript:void(null);" onsubmit="login_me()">
                <input type="hidden" name="action" value="login">
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Логин</label>
                  <input type="text" class="form-control" name="login">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Пароль</label>
                  <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Запомнить</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">Войти</button>
              </form>
           </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
   </body>
</html>
