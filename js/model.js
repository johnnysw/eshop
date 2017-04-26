var model = (function () {
    return {
        show: function (success) {
            $('#myModal').modal('show');
            $('#btn-ok').on('click', function () {
                $.post('welcome/login', {
                    username: $('#username').val(),
                    password: $('#password').val()
                }, function (data) {
                    if(data == 'success'){
                        success();
                        $('#myModal').modal('hide');
                    }else{
                        alert('用户名或密码不正确!');
                    }
                }, 'text');
            });
        },
        hide: function () {

        }
    };
})();