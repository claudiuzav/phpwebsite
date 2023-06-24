// function passwordConfirmation() {
//   var password = document.getElementById("pass").value;
//   var confirmPassword = document.getElementById("confirmpass").value;

//   if (password == "") {
//     alert("Error: The password field is Empty.");
//   } else if (password == confirmPassword) {
//     alert("Logged In");
//   } else {
//     alert("Please make sure your passwords match.");
//   }
// }

document.querySelector("#signUpForm").addEventListener("submit", (event) => {
  const pass1 = document.querySelector("#signUpPass1");
  const pass2 = document.querySelector("#signUpPass2");
  if (pass1.value === pass2.value) {
    return true;
  } else {
    alert("Passwords do not match!");
    event.preventDefault();
  }
});
