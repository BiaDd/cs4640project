function rememberUsername () {
  if (document.querySelector('#rememberMe').checked) {
    // set the username into localStorage if rememberMe is checked on submit
    localStorage.setItem("userName", JSON.stringify(document.getElementById("username").value));
  }

}

function rebuild () {
  var savedUser = JSON.parse(localStorage.getItem("userName"));
  if (savedUser != null) {
    document.querySelector('input[id="username"]').value = savedUser; // get username on page load
  }
}


/*
// basic remember me function might change to Jquery later
function rememberUsername () {
  if ($('#rememberMe').is(':checked')) {
    // set the username into localStorage if rememberMe is checked on submit
    localStorage.setItem("userName", JSON.stringify($("#username").val()));
  }
}

function rebuild () {
  var savedUser = JSON.parse(localStorage.getItem("userName"));
  if (savedUser != null) {
    $('input[id="username"]').val(savedUser); // get username on page load
  }
}
*/
