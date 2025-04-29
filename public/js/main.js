// let newEle = document.createElement('h1');
// newEle.setAttribute('class','createdUsingJs');
// newEle.innerText ="Hello Baby";

// document.body.appendChild(newEle);

// password validation for confirmation while sign-in
let singinpassword = document.getElementById('singuppassword');
let csinginpassword = document.getElementById('csinguppassword');
let signupsubmit = document.getElementById('singup-submit');

signupsubmit.addEventListener('click',function(){
    if(singinpassword.value !== csinginpassword.value){
        csinginpassword.setCustomValidity('Password and Confirm password does not match');
    }
});


// password validation for confirmation while change password
let changepassword = document.getElementById('changePassword');
let cchangepassword = document.getElementById('cChangePassword');
let changePassSubmit = document.getElementById('change-pass-submit');

changePassSubmit.addEventListener('click',function(e){
    if(changepassword.value !== cchangepassword.value){
        cchangepassword.setCustomValidity('Password and Confirm password does not match');
    }
});


// Initialize popovers for Bootstrap 5
document.addEventListener('DOMContentLoaded', function() {
    var popoverTriggerList = Array.from(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
});
