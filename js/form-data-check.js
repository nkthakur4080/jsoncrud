$(document).ready(function () {
    $('#fname').on('input', function () {
        checkuser();
    });
    $('#email').on('input', function () {
        checkemail();
    });
    // $('#mobile').on('input', function () {
    //     checkmobile();
    // });

    $('#submit_form').click(function () {
        if (!checkuser() && !checkemail()) {
            console.log("er1");
            $(".error-msg").html(`<div class="alert alert-warning">Please fill all required field</div>`);
        }else {
            console.log("ok");
            $(".error-msg").html("");
            var form = $('#contact_form')[0];
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "mail.php",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                async: false,

                success: function (data) {
                    $('.error-msg').html(data);
                },
                complete: function () {
                    setTimeout(function () {
                        $('#contact_form').trigger("reset");
                        $('#submit_form').html('Send Now');
                    }, 50000);
                }
            });
        }
    });
});
function checkuser() {
    var pattern = /^[A-Za-z0-9]+$/;
    var user = $('#fname').val();
    var validuser = pattern.test(user);
    if ($('#fname').val().length < 3) {
        $('#fname_err').html('username length is too short');
        return false;
    } else if (!validuser) {
        $('#fname_err').html('username should be a-z, A-Z only');
        return false;
    } else {
        $('#fname_err').html('');
        return true;
    }
}
function checkemail() {
    var pattern1 = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var email = $('#email').val();
    var validemail = pattern1.test(email);
    if (email == "") {
        $('#email_err').html('required field');
        return false;
    } else if (!validemail) {
        $('#email_err').html('invalid email');
        return false;
    } else {
        $('#email_err').html('');
        return true;
    }
}
// function checkmobile() {
//     if (!$.isNumeric($("#mobile").val())) {
//         $("#mobile_err").html("only number is allowed");
//         return false;
//     } else if ($("#mobile").val().length != 10) {
//         $("#mobile_err").html("10 digit required");
//         return false;
//     }
//     else {
//         $("#mobile_err").html("");
//         return true;
//     }
// }