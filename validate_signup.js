function validation(event)
{
  var isValid = true; 
 
  var elements = event.currentTarget;

  var email = elements[0].value;
  var username = elements[1].value;
  var password = elements[2].value;
  var password2 = elements[3].value;

  var regex_email = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
  var regex_uname = /^[a-zA-Z0-9_-]+$/;
  var regex_pswd  = /^(\S*)?\d+(\S*)?$/;

  var msg_email = document.getElementById("msg_email");
  var msg_uname = document.getElementById("msg_uname");
  var msg_pswd = document.getElementById("msg_pswd");
  var msg_pswdr = document.getElementById("msg_pswdr");
  msg_email.innerHTML  = "";
  msg_uname.innerHTML = "";
  msg_pswd.innerHTML = "";
  msg_pswdr.innerHTML = "";

  var textNode;
  var htmlNode;

  if (email == null || email == "" || !regex_email.test(email) || email.length > 60 )
  {
    textNode = document.createTextNode("Email address wrong format. example: username@somewhere.sth");
    msg_email.appendChild(textNode);
		isValid = false;
	}
  

  if (username == null || username == "" || !regex_uname.test(username) || username.length > 40)
  {
    textNode = document.createTextNode("Email address empty.");
    msg_uname.appendChild(textNode);
		isValid = false;
	}


  if (password == null || password == "" || !regex_pswd.test(password) || password.length < 8)
  {
    textNode = document.createTextNode("Password is empty.");
    msg_pswd.appendChild(textNode);
		isValid = false;
	}
  

  if (password !== password2)
  {
    textNode = document.createTextNode("Password and Confirmation Password do not match.");
    msg_pswdr.appendChild(textNode);
		isValid = false;
  }

  var display_info = document.getElementById("display_info");
  display_info.innerHTML = "";

  if(isValid==false)
  {
    event.preventDefault();
    display_info.setAttribute("style", "color: red")
    textNode = document.createTextNode("Invalid data entered");
    display_info.appendChild(textNode);
  }
  else
  {
    display_info.style.color = "green"; 
    
    textNode = document.createTextNode("Email: " + email);
    display_info.appendChild(textNode);
    htmlNode = document.createElement("br");
    display_info.appendChild(htmlNode);
    textNode = document.createTextNode("Username: " + username);
    display_info.appendChild(textNode);
    htmlNode = document.createElement("br");
    display_info.appendChild(htmlNode);


  }
 
}

function ResetForm(event)
{
  var elements = event.currentTarget;

  elements[0].value = "";
  elements[1].value = "";
  elements[2].value = "";
  elements[3].value = "";

 
  msg_email.innerHTML  = "";
  msg_uname.innerHTML = "";
  msg_pswd.innerHTML = "";
  msg_pswdr.innerHTML = "";
  display_info.innerHTML = "";

  msg_email.removeChild(textNode);
  msg_uname.removeChild(textNode);
  msg_pswd.removeChild(textNode);
  msg_pswdr.removeChild(textNode);
  display_info.removeChild(textNode);

}