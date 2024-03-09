    // "use strict";
	$("#submitContactUs").click(function (e) {
		let fullname = $("#contactUsFullname").val();
		let email = $("#contactUsEmail").val();
		let mobile = $("#contactUsMobile").val();
		let city = $("#contactUsCity").val();
		let subject = $("#contactUsSubject").val();
		let message = $("#contactUsMessage").val();

		let data = [];

		if (fullname == "" || fullname == "undefined") {
			$("#errorFullname").html("Please Enter Full Name");
			data["fullname"] = false;
			$("#contactUsFullname").focus()
		}
		else if(!fullname.match(/^[^-\s][a-zA-Z \s]+$/))
		{
			$("#errorFullname").html("Please Enter Valid Full Name");
			data["fullname"] = false;
			$("#contactUsFullname").focus()
		}
		 else  {
			$("#errorFullname").html("&nbsp");
			data["fullname"] = true;
		}

		if (email == "" || !email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
			$("#errorEmail").html("Please Enter Valid Email");
			data["email"] = false;
			$("#contactUsEmail").focus()
		} else {
			$("#errorEmail").html("&nbsp");
			data["email"] = true;
		}

		if (mobile == "" ||!mobile.match(/^[7|8|9]{1}[0-9]{9}/) ||mobile == "undefined" ||mobile.length != 10
		) {
			$("#errorPhone").html("Please Enter Valid Mobile Number");
			data["mobile"] = false;
			$("#contactUsMobile").focus();
		} else {
			$("#errorPhone").html("&nbsp");
			data["mobile"] = true;
		}
		if (city == "" ||!city.match(/^[^-\s][a-zA-Z \s]+$/) ||city == "undefined"){
			$("#errorCity").html("Please Enter Valid City Name");
			data["city"] = false;
			$("#contactUsCity").focus();
		} else {
			$("#errorCity").html("&nbsp");
			data["city"] = true;
		}
		if (city == "" ||!city.match(/^[^-\s][a-zA-Z \s]+$/) ||city == "undefined"){
			$("#errorCity").html("Please Enter Valid City Name");
			data["city"] = false;
			$("#contactUsCity").focus();
		} else {
			$("#errorCity").html("&nbsp");
			data["city"] = true;
		}
		if (data["fullname"] && data["email"] && data["city"] && data["mobile"]) {
			let contactUsData = {
				fullname: fullname,
				email: email,
				city: city,
				mobile: mobile,
				subject: subject,
				message: message
			};
			var url = URL + "Database_Ctrl/contactUsMessage";
			var request = $.ajax({
				url: url,
				method: "POST",
				data: contactUsData,
				datatype: "json",
			})
			.done(function (response) {
				const obj=JSON.parse(response)
				console.log(obj.status);
				clearInputFields();
				$('.sent-message').show();
				$('.error-message').hide();
				if(obj.status=='Success'){
					var url = URL + "Email/adminEmail";
					var request = $.ajax({
						url: url,
						method: "POST",
						data: contactUsData,
						datatype: "json",
					})
					.done(function (response) {
						console.log(response)
						const emailObj=JSON.parse(response)
						console.log(emailObj.status);
					})
					.fail(function () {
						console.log("email send error Error");
					});
				}

			})
			.fail(function () {
				console.log("lead ajax Error");
				$('.error-message').show();
				$('.sent-message').hide();

			});
		} else {
			console.log("Please insert form fields");
		}
	});

	function clearInputFields()
	{
		$("#contactUsFullname").val('')
		$("#contactUsEmail").val('');
		$("#contactUsMobile").val('');
		$("#contactUsCity").val('');
		$("#contactUsSubject").val('');
		$("#contactUsMessage").val('');
	}
