//   Created by: Ethan PP Cutting - 3/05/2023
//   modified last: Ethan PP Cutting - 3/05/2023

//
function login() 
{
  var username = document.forms["form-login"]["username"].value;
  var password = document.forms["form-login"]["password"].value;

  if (username === "" || password === "") {
    alert("Please fill in all the required fields.");
  } else {

    localStorage.setItem("username", username);
    localStorage.setItem("password", password);
    
    alert("You have successfully logged in!");
    window.location.href = "unitlist.html";
  }
}

var loginBtn = document.querySelector(".Button-login-account");
loginBtn.addEventListener("click", login);
