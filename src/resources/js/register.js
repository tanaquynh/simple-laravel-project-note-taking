$(function () {
    $("#frm-signup").validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
            },
            password_confirmation: {
                required: true,
                equalTo : "#password"
            }
        },

        messages: {
            email: {
                required: messages.email_required,
                email: messages.email_format,
            },
            name: {
                required: messages.name_required,
            },
            password: {
                required: messages.password_required,
            },
            password_confirmation: {
                required: messages.password_confirmation_required,
                equalTo: messages.password_confirmation_not_match,
            },
        },

        submitHandler: function(form, e) {
            e.preventDefault();
            $.ajax({
                url: variable.route_signup,
                method: 'POST',
                data: {
                    name: $('#name').val(),
                    password: $('#password').val(),
                    password_confirmation: $('#password_confirm').val(),
                    email: $('#email').val(),
                }
            }).done(function () {
                toastr.success('Sign Up success!')
                window.location.href = variable.route_home
            }).always(function () {
                $.unblockUI();
            })
        }
    });

    $("#frm-signup").keypress(function(event) {
        if (event.which === 13) {
            $("#frm-signup").submit()
        }
    })
    $("#btn-signup").click(function () {
        $("#frm-signup").submit();
    });
});
