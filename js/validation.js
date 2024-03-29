$(document).ready(function () {
    $('#username').on('input', function () {
        checkuser();
    });
    $('#email').on('input', function () {
        checkemail();
    });
    $('#password').on('input', function () {
        checkpass();
    });
    $('#cpassword').on('input', function () {
        checkcpass();
    });
    $('#mobile').on('input', function () {
        checkmobile();
    });

    $('#submitbtn').click(function () {


        if (!checkuser() && !checkemail() && !checkmobile() && !checkpass() && !checkcpass()) {
            console.log("er1");
            $("#message").html(`<div class="alert alert-warning">Please fill all required field</div>`);
        } else if (!checkuser() || !checkemail() || !checkmobile() || !checkpass() || !checkcpass()) {
            $("#message").html(`<div class="alert alert-warning">Please fill all required field</div>`);
            console.log("er");
        }
        else {
            console.log("ok");
            $("#message").html("");
            var form = $('#myform')[0];
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "process.php",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                beforeSend: function () {
                    $('#submitbtn').html('<i class="fa-solid fa-spinner fa-spin"></i>');
                    $('#submitbtn').attr("disabled", true);
                    $('#submitbtn').css({ "border-radius": "50%" });
                },

                success: function (data) {
                    $('#message').html(data);
                },
                complete: function () {
                    setTimeout(function () {
                        $('#myform').trigger("reset");
                        $('#submitbtn').html('Submit');
                        $('#submitbtn').attr("disabled", false);
                        $('#submitbtn').css({ "border-radius": "4px" });
                    }, 50000);
                }
            });
        }
    });
});


function checkuser() {
    var pattern = /^[A-Za-z0-9]+$/;
    var user = $('#username').val();
    var validuser = pattern.test(user);
    if ($('#username').val().length < 4) {
        $('#username_err').html('username length is too short');
        return false;
    } else if (!validuser) {
        $('#username_err').html('username should be a-z ,A-Z only');
        return false;
    } else {
        $('#username_err').html('');
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
function checkpass() {
    console.log("sass");
    var pattern2 = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    var pass = $('#password').val();
    var validpass = pattern2.test(pass);

    if (pass == "") {
        $('#password_err').html('password can not be empty');
        return false;
    } else if (!validpass) {
        $('#password_err').html('Minimum 5 and upto 15 characters, at least one uppercase letter, one lowercase letter, one number and one special character:');
        return false;

    } else {
        $('#password_err').html("");
        return true;
    }
}
function checkcpass() {
    var pass = $('#password').val();
    var cpass = $('#cpassword').val();
    if (cpass == "") {
        $('#cpassword_err').html('confirm password cannot be empty');
        return false;
    } else if (pass !== cpass) {
        $('#cpassword_err').html('confirm password did not match');
        return false;
    } else {
        $('#cpassword_err').html('');
        return true;
    }
}

function checkmobile() {
    if (!$.isNumeric($("#mobile").val())) {
        $("#mobile_err").html("only number is allowed");
        return false;
    } else if ($("#mobile").val().length != 10) {
        $("#mobile_err").html("10 digit required");
        return false;
    }
    else {
        $("#mobile_err").html("");
        return true;
    }
}

function password_show_hide() {
    console.log('ok');
    var x = document.getElementById("password");
    var show_eye = document.getElementById("show_eye");
    var hide_eye = document.getElementById("hide_eye");
    hide_eye.classList.remove("d-none");
    if (x.type === "password") {
        x.type = "text";
        show_eye.style.display = "none";
        hide_eye.style.display = "block";
    } else {
        x.type = "password";
        show_eye.style.display = "block";
        hide_eye.style.display = "none";
    }
}