

var RegState = 0;
$(document).ready(function(){
    // call readRegState here
    // No input parameters
    // Set Default view
    $("#loginForm").show();
    $("#registerForm").hide();
    $("#authenticationForm").hide();
    $("#setPasswordForm").hide();
    $("#resetPasswordForm").hide();
    $("#authenticationForm2").hide();
    // AJAX call
    $.ajax({
        type: 'GET',
        url: 'php/readRegState.php',
        async: false,
        dataType: 'json',
        encode: true
    }).always(function(data){
        // log data to the console so we can see
        console.log(data);
        // alert("Ajax return = ["+data.RegState+"]");
        RegState = parseInt(data.RegState);
        //UI routing here
		if (RegState == 4) {
			window.location.href="passwordManagment.html";
		}
        if (RegState <= 0){
            $("#loginForm").show();
            $("#registerForm").hide();
            $("#authenticationForm").hide();
            $("#setPasswordForm").hide();
            $("#resetPasswordForm").hide();
            $("#authenticationForm2").hide();
            return;
        }
        if (RegState == 1){
            $("#loginForm").hide();
            $("#registerForm").show();
            $("#authenticationForm").show();
            $("#setPasswordForm").hide();
            $("#resetPasswordForm").hide();
            $("#authenticationForm2").hide();
            return;
        }
        if (RegState == 2){
            $("#loginForm").hide();
            $("#registerForm").hide();
            $("#authenticationForm").hide();
            $("#setPasswordForm").show();
            $("#resetPasswordForm").hide();
            $("#authenticationForm2").hide();
            return;
        }
        if (RegState == 5){
            $("#loginForm").hide();
            $("#registerForm").hide();
            $("#authenticationForm").hide();
            $("#setPasswordForm").hide();
            $("#resetPasswordForm").show();
            $("#authenticationForm2").show();
            return;
        }
        //RegState has unexpected value here
        //Show LoginForm
        $("#loginForm").show();
        $("#loginMessage").html(data.RegState);
        $("#registerForm").hide();
        $("#authenticationForm").hide();
        $("#setPasswordForm").hide();
        $("#resetPasswordForm").hide();
        $("#authenticationForm2").hide();
        return;
    });
    $("#registerBtn").click(function(e){ 
        event.preventDefault(e);
        // Get form data items
        var formData = {
            'FirstName' : $('input[name=FirstName]').val(),
            'LastName' : $('input[name=LastName]').val(),
            'Email' : $('input[name=Email]').val()
        };
		// alert("register Ajax. FirstName["+$('input[name=FirstName]').val()+"]");
		// alert("register Ajax. LastName["+$('input[name=LastName]').val()+"]");
		// alert("register Ajax. Email["+$('input[name=Email]').val()+"]"); 
        $.ajax({
            type: 'GET',
            url: 'php/register.php',
            async: true,
            data: formData,
            dataType: 'json',
            encode: true
        }).always(function(data){
            // log data to the console so we can see
            console.log(data);
            // Post processing all session vars
            // Decide forms show/hide
            $("#loginForm").hide();
            $("#registerForm").show();
            $("#registerMessage").html(data.Message);
            $("#authenticationForm").show();
            $("#setPasswordForm").hide();
            $("#resetPasswordForm").hide();
            $("#authenticationForm2").hide();
        });
        return;
    })
    $("#registerClick").click(function(){
        $("#loginForm").hide();
        $("#registerForm").show();
        $("#authenticationForm").show();
        $("#setPasswordForm").hide();
        $("#resetPasswordForm").hide();
        $("#authenticationForm2").hide(); 
    })
    $("#forgetClick").click(function(){
        $("#loginForm").hide();
        $("#registerForm").hide();
        $("#authenticationForm").hide();
        $("#setPasswordForm").hide();
        $("#resetPasswordForm").show();
        $("#authenticationForm2").show(); 
    })
    $(".backClick").click(function(){
        $("#loginForm").show();
        $("#registerForm").hide();
        $("#authenticationForm").hide();
        $("#setPasswordForm").hide();
        $("#resetPasswordForm").hide();
        $("#authenticationForm2").hide();
    })
    //authBtn
    $("#authBtn").click(function(e){
		event.preventDefault(e);
		// Get form data items
		var formData = {
		  'Acode': $('input[name=Acode]').val()
		};
		$.ajax({
			type: 'GET',
            url: 'php/authenticate.php', 
			async: true,
			data: formData,
			dataType: 'json',
			encode: true
		}).always(function(data){
			//log data to the console so we can see
			console.log(data);
			RegState = parseInt(data.RegState);
            if (RegState == 2){
                $("#loginForm").hide();
			    $("#registerForm").hide();
                $("#authenticationForm").hide();
                $("#setPasswordForm").show();
                $("#setPasswordMessage").html(data.Message);
                $("#resetPasswordForm").hide();
                $("#authenticationForm2").hide();
                return;
            }
			// Stay on Same form
			$("#loginForm").hide();
			$("#registerForm").show();
			$("#authenticateMessage").html(data.Message);
			$("#authenticationForm").show();
			$("#setPasswordForm").hide();
			$("#resetPasswordForm").hide();
			$("#authenticationForm2").hide();
		})
        return;
	})
    // Set Password page 
	$("#setPasswordBtn").click(function(e){
		event.preventDefault(e);
		// Get form data items
		var formData = {
		  'Password1': $('input[name=Password1]').val(),
		  'Password2': $('input[name=Password2]').val()
		};
		$.ajax({
			type: 'POST',
			url: 'php/setPassword.php',
			async: true,       // Shi said that you always want to use false when already logged in, true is instant response, false is when we want to wait.
			data: formData,
			dataType: 'json',
			encode: true
		}).always(function(data){
			//log data to the console so we can see
			console.log(data);
            RegState = parseInt(data.RegState);
			// Decide forms show/hide
            if(RegState == 0){
                $("#loginForm").show();
                $("#loginMessage").html(data.Message);
                $("#registerForm").hide();
                $("#authenticationForm").hide();
                $("#setPasswordForm").hide();
                $("#resetPasswordForm").hide();
                $("#authenticationForm2").hide();
            } else {    // else if error
                $("#loginForm").hide();
                $("#registerForm").hide();
                $("#authenticationForm").hide();
                $("#setPasswordForm").show();
                $("#setPasswordMessage").html(data.Message);
                $("#resetPasswordForm").hide();
                $("#authenticationForm2").hide();
            }
			return;
		})
	})
    $("#loginBtn").click(function(e){
        event.preventDefault(e);
        // Get form data items
        var formData = {
            'Email' : $('input[name=loginEmail').val(),
            'Password' : $('input[name=Password').val(),
            'RememberMe' : $('input[name=RememberMe]:checked').val()
        };
        $.ajax({
            type: 'POST',
            url: 'php/login.php', 
            async: false,
            data: formData,
            dataType: 'json',
            encode: true
        }).always(function(data){
            // log data to the console so we can see
            console.log(data);
            RegState = parseInt(data.RegState);
            if(RegState == 4){
                // redirect to protected.html
                window.location.href ="passwordManagment.html";
                return;
            }
            // Post processing all session vars
            // Decide forms show/hide
            $("#loginForm").show();
            $("#registerForm").hide();
            $("#loginMessage").html(data.Message);
            $("#authenticationForm").hide();
            $("#setPasswordForm").hide();
            $("#resetPasswordForm").hide();
            $("#authenticationForm2").hide();
        });
        return;
    })
    /*
    // Reset Password Page
	$("#resetPasswordBtn").click(function(e){
		event.preventDefault(e);
		// Get form data items
		var formData = {
		  'Password1': $('input[name=Password1]').val(),
		  'Password2': $('input[name=Password2]').val()
		};
		$.ajax({
			type: 'POST',
			url: 'php/setPassword.php',
			async: false,       
			data: formData,
			dataType: 'json',
			encode: true
		}).always(function(data){
			//log data to the console so we can see
			console.log(data);
            RegState = parseInt(data.RegState);
			// Decide forms show/hide
            if(RegState == 0){
                $("#loginForm").hide();
                $("#loginMessage").html(data.Message);
                $("#registerForm").hide();
                $("#authenticationForm").hide();
                $("#setPasswordForm").hide();
                $("#resetPasswordForm").hide();
                $("#authenticationForm2").hide();
            } else {    // else if error
                $("#loginForm").hide();
                $("#registerForm").hide();
                $("#authenticationForm").hide();
                $("#setPasswordForm").show();
                $("#setPasswordMessage").html(data.Message);
                $("#resetPasswordForm").hide();
                $("#authenticationForm2").hide();
            }
			return;
		})
	})
    */
    //ResetPassword Page
    $("#checkEmailBtn").click(function(e){
		event.preventDefault(e);
		// Get form data items
		var formData = {
		  'regedEmail': $('input[name=regedEmail').val()
		};
		$.ajax({
			type: 'GET',
			url: 'php/emailCheck.php',
			async: true,
			data: formData,
			dataType: 'json',
			encode: true
		}).always(function(data){
			//log data to the console so we can see
			console.log(data);
			RegState = parseInt(data.RegState);
            if (RegState == 5){
                $("#loginForm").hide();
			    $("#registerForm").hide();
                $("#authenticationForm").hide();
                $("#setPasswordForm").hide();
                $("#resetPasswordMessage").html(data.Message);
                $("#resetPasswordForm").show();
                $("#authenticationForm2").show();
                return;
            }
			// Stay on Same form
			$("#loginForm").hide();
			$("#registerForm").hide();
			$("#authenticateMessage").html(data.Message);
			$("#authenticationForm").hide();
			$("#setPasswordForm").hide();
			$("#resetPasswordForm").show();
			$("#authenticationForm2").show();
		})
        return;
	})
    $("#authBtn2").click(function(e){
		event.preventDefault(e);
		// Get form data items
		var formData = {
		  'Acode': $('input[name=Acode2]').val()
		};
		$.ajax({
			type: 'GET',
			url: 'php/authenticate.php',
			async: true,
			data: formData,
			dataType: 'json',
			encode: true
		}).always(function(data){
			//log data to the console so we can see
			console.log(data);
			RegState = parseInt(data.RegState);
            if (RegState == 2){
                $("#loginForm").hide();
			    $("#registerForm").hide();
                $("#authenticationForm").hide();
                $("#setPasswordForm").show();
                $("#setPasswordMessage").html(data.Message);
                $("#resetPasswordForm").hide();
                $("#authenticationForm2").hide();
                return;
            }
			// Stay on Same form
			$("#loginForm").hide();
			$("#registerForm").show();
			$("#authenticateMessage").html(data.Message);
			$("#authenticationForm").show();
			$("#setPasswordForm").hide();
			$("#resetPasswordForm").hide();
			$("#authenticationForm2").hide();
		})
        return;
	})
    
})