


function validate () {
  const hasNumber = /\d/; // check for a number in password
  const specialChars = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/; // check for special characters
  //const hasCharacters = /[a-zA-Z]/g;
  //const userCheck = /^[a-zA-Z0-9]+$/;
  var user = document.getElementById("username").value;
  var pass = document.getElementById("password").value;

  if (specialChars.test(user)) {
    alert("Username cannot contain special symbols or spaces");
  }
  else if (user.length < 6) {
    alert("Username is too short");
  }
  else if (user.length > 20) {
    alert("Username is too long");
  }
  else if (!hasNumber.test(pass)) {
    alert("Password must contain at least 1 number");
  }
  /*
  else if (!hasCharacters.test(pass)) {
    alert("Password must contain characters");
  }
  */
  else if (!specialChars.test(pass)) {
    alert("Password must contain at least 1 special character");
  }
  else if (pass != document.getElementById("password_check")) {
    alert("Passwords must match");
  }
  else if (pass.length < 8) {
    alert("Password must be at least 8 characters long");
  }
}
