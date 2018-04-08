const btn_header_registration = document.getElementById("btn_header_registration");
const btn_header_athorization = document.getElementById("btn_header_athorization");

const form_registration = document.getElementById("form_registration");
const form_athorization = document.getElementById("form_athorization");

const btn_form_registration = document.getElementById("btn_form_registration");
const btn_form_athorization = document.getElementById("btn_form_athorization");

const error_box = document.getElementById('response_message');


btn_header_registration.addEventListener("click", function () {
    form_athorization.classList.add("hide");
    btn_header_athorization.classList.remove("active");

    form_registration.classList.remove("hide");
    btn_header_registration.classList.add("active");
});

btn_header_athorization.addEventListener("click", function () {
    form_registration.classList.add("hide");
    btn_header_registration.classList.remove("active");

    form_athorization.classList.remove("hide");
    btn_header_athorization.classList.add("active");
});

const handlerRegistrationForm = function() {
    if (inPasswordsEqual()) {
        let formData = getDataRegistrationForm();
        async_send_form(formData);
    } else {
        console.log("pass not equal");
    }
};

const getDataRegistrationForm = function () {
    return {
        'action': 'REGISTRATION',
        'user_name': document.getElementById('in_user_name').value,
        'login': document.getElementById('in_login').value,
        'email': document.getElementById('in_email').value,
        'password': document.getElementById('in_password').value,
        'confirm_password': document.getElementById('in_confirm_password').value,
    }
};

const handlerAuthorizationForm = function() {
   let formData = getDataAuthorizationForm();
   async_send_form(formData);
};

const getDataAuthorizationForm = function () {
    return {
        'action': 'AUTHORIZATION',
        'login': document.getElementById('in_login_athorization').value,
        'password': document.getElementById('in_password_athorization').value,
    }
};

const inPasswordsEqual = function () {
    return document.getElementById('in_password').value == document.getElementById('in_confirm_password').value;
};

function processing_response(data){
   console.log(data);
   try {
     let response = JSON.parse(data);
     console.log(response);
     handlerResponse(response);
   } catch (err) {
      console.log("ошибка сервера!");
   }

}

//-------- ajax processing form --------
function async_send_form(form_data){
   $.ajax ({
      url: "/test/php/ajax.php",
      type: "POST",
      data: (form_data),
      dataType: "html",
      beforeSend: before_send,
      success: send_form_success,
   });
};

function before_send(){
   btn_form_registration.setAttribute("disabled", "disabled");
   btn_form_athorization.setAttribute("disabled", "disabled");
};

function send_form_success(data){
   btn_form_registration.removeAttribute('disabled');
   btn_form_athorization.removeAttribute('disabled');
   processing_response(data);
};
//-------- end ajax processing form --------

const showErrorMessage = function (response) {
    error_box.innerHTML = response['message'];
    error_box.classList.remove("hide");
}

const processingSuccesResponce = function(response){
   if( response['operation'] == 'authorization' ){
      window.location.href = './profile.php';
   }

   if( response['operation'] == 'registration' ){
      console.log("processingSuccesResponce - registration - success");
      error_box.classList.add("hide");
   }
}

const handlerResponse = function(response){
   // console.log("handlerResponse");
    switch (response['status']){
        case 'success':
            processingSuccesResponce(response);
            break;
        case 'error':
            showErrorMessage(response);
            break;
    }
}
