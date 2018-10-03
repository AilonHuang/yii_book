;
let user_reset_pwd_ops = {
    init: function () {
        this.eventBind()
    },

    eventBind: function () {
        $('#save').click(function () {

            let btn_target = $(this)

            if(btn_target.hasClass('disabled')) {
                alert('正在处理, 请不要重复点击')
                return false
            }

            let old_password = $('#old_password').val()
            let new_password = $('#new_password').val()
            if (old_password.length < 1) {
                alert('请输入原密码')
                return false
            }

            if (new_password.length < 6) {
                alert('请输入不小于6个字符的新密码')
                return false
            }

            btn_target.addClass('disabled')

            $.ajax({
                url: '/web/user/reset-pwd',
                method: 'POST',
                data: {
                    old_password,
                    new_password
                },
                dataType: 'json',
                success: function (res) {
                    btn_target.removeClass('disable')
                    alert(res.msg)
                    if (res.code === 200) {
                        window.location.reload()
                    }
                }
            })
        })
    }
};

$(document).ready(function () {
    user_reset_pwd_ops.init()
})