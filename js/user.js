var user = (function () {
    return {
        checkLogin: function (success, fail) {
            $.get("welcome/check_login", function (data) {
                if(data == 'logined'){
                    //登录成功后的操作
                    success();
                }else{
                    fail();
                }
            }, 'text');
        }
    };
})();