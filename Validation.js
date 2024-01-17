
function validate_RegistrationForm() {
	  let FirstName = document.forms["RegistrationForm"]["Fname"].value;
	  if (FirstName == "") {
		alert("First Name must be filled out");
	  return false;
	  }
	let LastName = document.forms["RegistrationForm"]["Lname"].value;
	  if ( LastName== "") {
		alert("Last Name must be filled out");
		return false;
		}
	let PhoneNum  = document.forms["RegistrationForm"]["PhoneNum"].value;
	  if (PhoneNum == "") {
		alert("Phone number must be filled out");
		return false;
		}
	let Password  = document.forms["RegistrationForm"]["Password"].value;
	  if (Password == "") {
		alert("Password must be filled out");
		return false;
		}	
	let UnitNUm  = document.forms["RegistrationForm"]["UnitNUm"].value;
	  if (UnitNUm == "") {
		alert("Unit Number must be filled out");
		return false;
		}
	let StreetName  = document.forms["RegistrationForm"]["StreetName"].value;
	  if (StreetName == "") {
		alert("Street Name must be filled out");
		return false
		}
	let Suburb  = document.forms["RegistrationForm"]["Suburb"].value;
	  if (Suburb == "") {
		alert("Suburb must be filled out");
		return false;
		}	
	let City  = document.forms["RegistrationForm"]["City"].value;
	  if (City == "") {
		alert("City must be filled out");
		return false;
		}
		// Email can not be left blank
		let Email = document.forms["RegistrationForm"]["Email"].value;
		if (Email == "") {
		alert("Suburb must be filled out");
		return false;
		}
		var at_sign = Email.indexOf("@");
		var dot = Email.lastIndexOf(".");
	
		//Checking the postion of the dot and at sign
		if ((at_sign != -1) &&
			(at_sign != 0) &&
			(dot != -1) &&
			(dot != 0) &&
			(dotSymbol > atSymbol + 1)) {
			alert("Email address is valid.");
			return true;}
		 else {
			alert("Email address is not valid. Please re-enter it");
		return false;}
}