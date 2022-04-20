

// might change this to an anonymous function later?
function validate () {
  const hasNumber = /\d/; // check for a number in password
  const specialChars = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/; // check for special characters
  //const hasCharacters = /[a-zA-Z]/g;
  //const userCheck = /^[a-zA-Z0-9]+$/;
  var user = document.getElementById("username").value;
  var pass = document.getElementById("password").value;

  if (specialChars.test(user)) { // test for symbols
    alert("Username cannot contain special symbols or spaces");
  }
  else if (user.length < 6) { // test lower length of username
    alert("Username is too short");
  }
  else if (user.length > 20) {  // test upper length of username
    alert("Username is too long");
  }
  else if (!hasNumber.test(pass)) { // test for a number in password
    alert("Password must contain at least 1 number");
  }
  /*
  else if (!hasCharacters.test(pass)) {
    alert("Password must contain characters");
  }
  */
  else if (!specialChars.test(pass)) { // test for a special character
    alert("Password must contain at least 1 special character");
  }
  else if (pass != (document.getElementById("password_check").value)) { // test for password and password_check
    alert("Passwords must match");
  }
  else if (pass.length < 8) { // test password length
    alert("Password must be at least 8 characters long");
  }
  else {
    // For some reason the alert for password check and password was triggering even when they matched
    // so I added this lol
  }
}
