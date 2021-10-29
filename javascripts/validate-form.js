const form = document.querySelector(".signup-form");
const submit = document.querySelector(".submit");

const namePattern = /^[A-Z][a-z]{1,15}$/;

form.firstName.addEventListener("keyup", event => {
    //console.log(event.target.value, form.firstName.value);
    if (namePattern.test(event.target.value)){
        form.firstName.setAttribute("class", "valid");
    } else{
        form.firstName.setAttribute("class", "invalid");
    }
});

form.lastName.addEventListener("keyup", event => {
    //console.log(event.target.value, form.lastName.value);
    if (namePattern.test(event.target.value)){
        form.lastName.setAttribute("class", "valid");
    } else{
        form.lastName.setAttribute("class", "invalid");
    }
});

emailPattern = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
form.email.addEventListener("keyup", event => {
    //console.log(event.target.value, form.email.value);
    if (emailPattern.test(event.target.value)){
        form.email.setAttribute("class", "valid");
    } else{
        form.email.setAttribute("class", "invalid");
    }
});

passPattern = /.{8,}/;
form.password.addEventListener("keyup", event => {
    //console.log(event.target.value, form.password.value);
    if (passPattern.test(event.target.value)){
        form.password.setAttribute("class", "valid");
    } else{
        form.password.setAttribute("class", "invalid");
    }
});

const agePattern = /^2[0-4]$/;
form.age.addEventListener("keyup", event => {
    //console.log(event.target.value, form.age.value);
    if (agePattern.test(event.target.value)){
        form.age.setAttribute("class", "valid");
    } else{
        form.age.setAttribute("class", "invalid");
    }
});

const phonePattern = /^07[2-8]\d{7}$/;

form.phoneNumber.addEventListener("keyup", event => {
    //console.log(event.target.value, form.phoneNumber.value);
    if (phonePattern.test(event.target.value)){
        form.phoneNumber.setAttribute("class", "valid");
    } else{
        form.phoneNumber.setAttribute("class", "invalid");
    }
});