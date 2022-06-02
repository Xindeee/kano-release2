function login_me() {
   
   $.ajax({
        async: false,
        type: "POST",
        data: $('#loginForm').serializeArray(),
        success: function(msg){
            
            if (msg == 'error') {
                alert('Проверьте правильность вводимых данных')
            }
            else {
                window.location.reload();
            }
        }
    });

}

