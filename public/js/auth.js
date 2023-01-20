$(document).ready(function () {
    
    $("#login-button").on('click', function(){
            $.ajax({
                url: '/api/login',
                type: "POST",
                data: {
                    email: $('#email').val(),
                    password: $('#password').val(),
                },
                success: function (response) {
                    console.log(response.authorisation.token)
                    $('#error_login').text('Deleted successfully');
                    $('#error_login').css("color", "green");
                    window.location.href = '../';
                    setCookie('access_token', response.authorisation.token, 7)
                    setCookie('token', response.authorisation.token, 7)
                },
                error: function (error) {
                    alert(error.responseJSON.message)
                }
            });
    });

    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        let expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
      }

});