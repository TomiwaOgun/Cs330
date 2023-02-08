document.getElementById("SignUp").addEventListener("submit", validation, false);
document.getElementById("SignUp").addEventListener("reset", ResetForm, false);

document.getElementById("uname").addEventListener("focus", setMessage);
document.getElementById("email").addEventListener("focus", setMessage);
document.getElementById("pswd").addEventListener("focus", setMessage);
document.getElementById("pswdr").addEventListener("focus", setMessage);

document.getElementById("uname").addEventListener("blur", clearMessage);
document.getElementById("email").addEventListener("blur", clearMessage);
document.getElementById("pswd").addEventListener("blur", clearMessage);
document.getElementById("pswdr").addEventListener("blur", clearMessage);