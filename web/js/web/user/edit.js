;
let user_edit_ops = {
    init: function () {
        this.eventBind()
    },

    eventBind: function () {
        $('.save').click(function () {

            let btn_target = $(this)

            if(btn_target.hasClass('disabled')) {
                alert('正在处理, 请不要重复点击')
                return false
            }

            let nickname = $('.user_edit_wrap input[name=nickname]').val()
            let email = $('.user_edit_wrap input[name=email]').val()
            if (nickname.length < 1) {
                alert('请输入合法的姓名')
                return false
            }

            if (email.length < 1) {
                alert('请输入合法的邮箱地址')
                return false
            }

            btn_target.addClass('disabled')

            $.ajax({
                url: '/web/user/edit',
                method: 'POST',
                data: {
                    nickname,
                    email
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
    user_edit_ops.init()
})