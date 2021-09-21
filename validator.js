function validate_email(){
    var email = document.getElementById("email");
    var terms = document.getElementById("terms");
    var error = document.getElementById("error");
    var submit_button = document.getElementById("submit");

    submit_button.disabled = true;
    if (email.value == 0){
        error.innerHTML = "Email address is required";
        submit_button.style.opacity = 0.3;
    }
    else if (email.value.substr(email.value.length - 3) == ".co"){
        error.innerHTML ="We are not accepting subscriptions from Colombia emails";
        submit_button.style.opacity = 0.3;
    }
    else if (terms.checked == false){
        error.innerHTML ="You must accept the terms and conditions";
        submit_button.style.opacity = 0.3;
    }
    else if (email.value.toLowerCase().match(/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i)){
        error.innerHTML = "";
        submit_button.style.opacity = 1;
    	submit_button.disabled = false;
    }
    else {
        error.innerHTML ="Please provide a valid e-mail address";
        submit_button.style.opacity = 0.3;
    }
    email.addEventListener("keyup", function(event) {
	if (event.keycode === 13){
            event.preventDefault();
	}
    });
}
