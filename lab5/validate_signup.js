function validation(event)
{
  var isValid = true; 
  var warnings = "";

  var elements = event.currentTarget;

  var email = elements[0].value;
  var username = elements[1].value;
  var password = elements[2].value;
  var password2 = elements[3].value;

  if (email == null || email == "")
  {
		warnings += "Email is empty. \n";
		isValid = false;
	}
  else if(email.length > 60)
  {
		warnings += "Max length for email is 60 characters.\n";
		isValid = false;
	}

  if (username == null || username == "")
  {
		warnings += "username is empty. \n";
		isValid = false;
	}
  else if(username.length > 40)
  {
		warnings += "Max length for the username is 40 characters.\n";
		isValid = false;
	}

  if (password == null || password == "")
  {
		warnings += "password is empty. \n";
		isValid = false;
	}
  else if(password.length != 8 )
  {
		warnings += "Password must be 8 characters.\n";
		isValid = false;
	}
	

  if (password != password2)
  {
    warnings += "Please confirm password.\n";
		isValid = false;
  }

  if(isValid==false)
  {
    alert(warnings);
    event.preventDefault();
  }
  else
  {
    alert("Signup successful!");
  }
 
}

function ResetForm(event)
{
  var elements = event.currentTarget;

  elements[0].value = "";
  elements[1].value = "";
  elements[2].value = "";
  elements[3].value = "";

}