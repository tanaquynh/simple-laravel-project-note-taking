$(function () {
    $("#frm-login").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
            }
        },

        messages: {
            email: {
                required: messages.email_required,
                email: messages.email_format,
            },
            password: {
                required: messages.password_required,
            }
        },

        submitHandler: function(form, e) {
            e.preventDefault();
            $.ajax({
                url: variable.route_login,
                method: 'POST',
                data: {
                    password: $('#password').val(),
                    email: $('#email').val(),
                }
            }).done(function () {
                toastr.success('Login success')
                window.location.href = variable.route_home
            }).always(function () {
                $.unblockUI();
            })
        }
    });

    $("#frm-login").keypress(function(event) {
        if (event.which === 13) {
            $("#frm-login").submit()
        }
    })
    $("#btn-signin").click(function () {
        $("#frm-login").submit();
    });
});
