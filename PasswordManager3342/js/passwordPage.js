$("#newPasswordBtn").click(function (e) {
    event.preventDefault(e);
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
                type: 'GET',
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
