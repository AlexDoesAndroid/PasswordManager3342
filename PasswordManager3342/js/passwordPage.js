

//New Password Btn
$("#newPasswordBtn").click(function (e) {
    event.preventDefault(e);
    // Get form data items
    var formData = {
        'Password': $('input[id=newPassword]').val(),
        'validationPassword': $('input[id=validationNewPassword]').val(),
        'ServiceName': $('input[id=validationNewName]').val(),
        'UserName': $('input[id=validationNewUserName]').val(),
        'WebsiteURL': $('input[id=validationNewURL]').val(),
        'Catagory': $('input[id=validationNewCatagory]').val()
    };

    alert("register Ajax. Password[" + $('input[id=newPassword]').val() + "]");
    alert("register Ajax. validationPassword[" + $('input[id=validationNewPassword]').val() + "]");
    alert("register Ajax. NewName[" + $('input[id=validationNewName]').val() + "]");
    alert("register Ajax. UserName[" + $('input[id=validationNewUserName]').val() + "]");
    alert("register Ajax. WebsiteURL[" + $('input[id=validationNewURL]').val() + "]");
    alert("register Ajax. Catagory[" + $('input[id=validationNewCatagory]').val() + "]");

        $.ajax({
            type: 'GET',
            url: 'php/managerNewPassword.php',
            async: false,
            dataType: 'json',
            encode: true
        }).always(function (data) {
            console.log(data);
            return;
         });
    return;
});

//New Password Btn
$("#newPasswordBtn").click(function (e) {
    event.preventDefault(e);
    // Get form data items
    var formData = {
        'PreviousPassword': $('input[id=validationPreviousPassword]').val(),
        'NewPassword': $('input[id=validationNewPassword]').val(),
        'ServiceName': $('input[id=validationName]').val(),
        'UserName': $('input[id=validationUserName]').val(),
        'WebsiteURL': $('input[id=validationURL]').val(),
        'Catagory': $('input[id=validationCatagory]').val()
    };

    alert("register Ajax. PreviousPassword[" + $('input[id=validationPreviousPassword]').val() + "]");
    alert("register Ajax. NewPassword[" + $('input[id=validationNewPassword]').val() + "]");
    alert("register Ajax. NewName[" + $('input[id=validationName]').val() + "]");
    alert("register Ajax. UserName[" + $('input[id=validationUserName]').val() + "]");
    alert("register Ajax. WebsiteURL[" + $('input[id=validationURL]').val() + "]");
    alert("register Ajax. Catagory[" + $('input[id=validationCatagory]').val() + "]");

    $.ajax({
        type: 'POST',
        url: 'php/managerEditPassword.php',
        async: true,
        dataType: 'json',
        encode: true
    }).always(function (data) {
        console.log(data);
        return;
    });
    return;
});
