$(document).ready(function () {
    $('#email').keyup(function () {
        var email = $('#email').val();
        if(IsEmail(email)==false){
            $('.error-msg').html('Invalid Email Address');
            $('.error-msg').css('color','red');
            $('.error-msg').css('font-weight','600');
            $('.error-msg').css('font-size','12px');
            return false;
        }
        else{
            $('.error-msg').html('');
            return false;
        }
    })
    $('#password').keyup(function(){
        var password = $('#password').val();
        if(IsPassword(password) == false){
            $('#error-password').html('minimum 8 characters password contains combination of uppercase and lowercase letter and numberand special character required.');
            $('#error-password').css('color','red');
            $('#error-password').css('font-weight','600');
            $('#error-password').css('font-size','12px');
            return false;
        }
        else{
            $('#error-password').html('');
            return false;
        }
    });

});
function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!regex.test(email)) {
       return false;
    }else{
       return true;
    }
}
function IsPassword(password) {
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if(!regex.test(password)) {
       return false;
    }else{
       return true;
    }
  }

