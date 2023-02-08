function validation(event)
{
  var isValid = true; 
 
  var elements = event.currentTarget;

  var email = document.getElementById("email").value;
  var username = document.getElementById("uname").value;
  var password = document.getElementById("pswd").value;
  var password2 = document.getElementById("pswdr").value;
  var profile = document.getElementById("img").value;

  var regex_email = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/g;
  var regex_uname = /^[a-zA-Z0-9_-]+$/g;
  var regex_pswd  = /^(\S*)?\d+(\S*)?$/g;

  var msg_email = document.getElementById("msg_email");
  var msg_uname = document.getElementById("msg_uname");
  var msg_pswd = document.getElementById("msg_pswd");
  var msg_pswdr = document.getElementById("msg_pswdr");
  var msg_profile = document.getElementById("msg_profile");

  msg_email.innerHTML  = "";
  msg_uname.innerHTML = "";
  msg_pswd.innerHTML = "";
  msg_pswdr.innerHTML = "";
  msg_profile.innerHTML = "";

  var textNode;
  var htmlNode;

  if (email == null || email == "" || !regex_email.test(email))
  {
    textNode = document.createTextNode("Email address wrong format. example: username@somewhere.sth" + !regex_email.test(email) + "  "+ email);
    msg_email.appendChild(textNode);
		isValid = false;
	}
  

  if (username == null || username == "" || !regex_uname.test(username) || username.length > 40)
  {
    textNode = document.createTextNode("Username invalid." + !regex_email.test(email));
    msg_uname.appendChild(textNode);
		isValid = false;
	}


  if (password == null || password == "" || !regex_pswd.test(password) || password.length < 8)
  {
    textNode = document.createTextNode("Password invalid." + regex_pswd.test(password)+ "  "+ password);
    msg_pswd.appendChild(textNode);
		isValid = false;
	}


  if (password !== password2)
  {
    textNode = document.createTextNode("Password and Confirmation Password do not match.");
    msg_pswdr.appendChild(textNode);
		isValid = false;
  }

  if(isValid==false)
  {
    event.preventDefault();
  }
  
 
}

function validation_login(event)
{
    var isValid = true; 
 
    var elements = event.currentTarget;
  
    var username = document.getElementById("uname").value;
    var password = document.getElementById("pswd").value;
    var regex_uname = /^[a-zA-Z0-9_-]+$/;
    var regex_pswd  = /^(\S*)?\d+(\S*)?$/;

    var msg_uname = document.getElementById("msg_uname");
    var msg_pswd = document.getElementById("msg_pswd");

    msg_uname.innerHTML = "";
    msg_pswd.innerHTML = "";

    var textNode;
    var htmlNode;
  
    
  
    if (username == null || username == "")
    {
      textNode = document.createTextNode("Username empty.");
      msg_uname.appendChild(textNode);
      isValid = false;
    }
    else if (regex_uname.test(username) == false) 
    {
      textNode = document.createTextNode("Username entry invalid");
      msg_uname.appendChild(textNode);
      isValid = false;
    }
    else if(username.length > 40)
    {
      textNode = document.createTextNode("Username too long. Maximum is 40 characters.");
      msg_uname.appendChild(textNode);
      isValid = false;
    }
  
    if (password == null || password == "")
    {
      textNode = document.createTextNode("Password is empty.");
      msg_pswd.appendChild(textNode);
      isValid = false;
    }
    else if (regex_pswd.test(password) == false) 
    {
      textNode = document.createTextNode("Password entry invalid");
      msg_pswd.appendChild(textNode);
      isValid = false;
    }
    else if(password.length < 8 )
    {
      textNode = document.createTextNode("Password not the right lenght, has to be at least 8 characters.");
      msg_pswd.appendChild(textNode);
      isValid = false;
    }



    if(isValid==false)
    {
      event.preventDefault();
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

function counter(event)
{
  var char_len = event.currentTarget.value.length; 
  var char_count = document.getElementById("character_count");

  char_count.innerHTML = char_len.toString();
}

function validation_post(event)
{
  var isValid = true; 
 
  var elements = event.currentTarget;
  
  var recipe_name = elements[0].value;
  var ingredients = elements[1].value;
  var instructions = elements[2].value;


  var msg_name = document.getElementById("msg_name");
  var msg_ing = document.getElementById("msg_ing");
  var msg_ins = document.getElementById("msg_ins");

  msg_name.innerHTML = "";
  msg_ing.innerHTML = "";
  msg_ins.innerHTML = "";

  var textNode;
 

  if (recipe_name == null || recipe_name == "")
  {
    textNode = document.createTextNode("Recipe name empty.");
    msg_name.appendChild(textNode);
    isValid = false;
  }
 
  else if(recipe_name.length > 50)
  {
    textNode = document.createTextNode("Name too long. Maximum is 50 characters.");
    msg_name.appendChild(textNode);
    isValid = false;
  }

  if (ingredients == null || ingredients == "")
  {
    textNode = document.createTextNode("Recipe ingredients empty.");
    msg_ing.appendChild(textNode);
    isValid = false;
  }

  if (instructions == null || instructions == "")
  {
    textNode = document.createTextNode("Recipe instructions empty.");
    msg_ins.appendChild(textNode);
    isValid = false;
  }

  if(isValid==false)
  {
    event.preventDefault();
  }
}

var savedMessage = "";

function setMessage(event)
{
  var field = event.currentTarget;
  var adviceBox = document.getElementById("advice");
  
  savedMessage = adviceBox.innerHTML;
   
  if (field.id == "recipe_name") {
    adviceBox.innerHTML = "Enter the name of your recipe, keep it under 50 characters.";
  }

  if (field.id == "ingredients") {
    adviceBox.innerHTML = "Write down the ingredients of the recipe.";
  }

  if (field.id == "instructions") {
    adviceBox.innerHTML = "Write down the instructions for the creation of your recipe.";
  }

  if (field.id == "email") {
    adviceBox.innerHTML = "Enter your email, keep it under 60 characters and in proper format.";
  }

  if (field.id == "uname") {
    adviceBox.innerHTML = "Enter your username, keep it under 40 characters.";
  }

  if (field.id == "pswd") {
    adviceBox.innerHTML = "Write down your password. Make sure its at least 8 characters";
  }

  if (field.id == "pswdr") {
    adviceBox.innerHTML = "Must match password.";
  }

}

function clearMessage(event) {

  var adviceBox = document.getElementById("advice");
  adviceBox.innerHTML = savedMessage;

}