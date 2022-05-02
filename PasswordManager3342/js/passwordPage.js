var PassState = 0;
$("#newPasswordBtn").click(function (e) {
    event.preventDefault(e);
    PassState = 1;
    // Get form data items
    var formData = {
        'newPassword': $('input[id=newPassword]').val(),
        'validationNewPassword': $('input[id=validationNewPassword]').val(),
        'validationNewName': $('input[id=validationNewName]').val(),
        'validationNewUserName': $('input[id=validationNewUserName]').val(),
        'validationNewURL': $('input[id=validationNewURL]').val(),
        'validationNewCatagory': $('input[id=validationNewCatagory]').val()
    };

    alert("register Ajax. newPassword[" + $('input[id=newPassword]').val() + "]");
    alert("register Ajax. validationNewPassword[" + $('input[id=validationNewPassword]').val() + "]");
    alert("register Ajax. validationNewName[" + $('input[id=validationNewName]').val() + "]");
    alert("register Ajax. validationNewUserName[" + $('input[id=validationNewUserName]').val() + "]");
    alert("register Ajax. validationNewURL[" + $('input[id=validationNewURL]').val() + "]");
    alert("register Ajax. validationNewCatagory[" + $('input[id=validationNewCatagory]').val() + "]");

    /*        $.ajax({
                type: 'POST',
                url: 'php/managerNewPassword.php',
                async: false,
                dataType: 'json',
                encode: true
            }).always(function (data) {
                console.log(data);
                return;
            });*/
    return;
});

$("#updatePassBtn").click(function (e) {
    event.preventDefault(e);
    PassState = 2;
    var formData = {
        'Password': $('input[id=validationNewPassword]').val(),
        'ServiceName': $('input[id=validationNewName]').val(),
        'Username': $('input[id=validationNewUserName]').val(),
        'WebsiteURL': $('input[id=validationNewURL]').val(),
        'Catagory': $('input[id=validationNewCatagory]').val()
    };
    alert("register Ajax. Password[" + $('input[id=validationNewPassword]').val() + "]");
    alert("register Ajax. ServiceName[" + $('input[id=validationNewName]').val() + "]");
    alert("register Ajax. Username[" + $('input[id=validationNewUserName]').val() + "]");
    alert("register Ajax. WebsiteURL[" + $('input[id=validationNewURL]').val() + "]");
    alert("register Ajax. Catagory[" + $('input[id=validationNewCatagory]').val() + "]");

    $.ajax({
        type: 'POST',
        url: 'php/updatePassword.php',
        async: true,
        data: formData,
        dataType: 'json',
        encode: true
    })
});


$("#deletePassBtn").click(function () {
    PassState = 3;
});

