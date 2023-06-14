document
  .getElementById("input_window")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    var email = document.querySelector(
      '#input_window input[name="email"]'
    ).value;
    var password = document.querySelector(
      '#input_window input[name="password"]'
    ).value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "inc/signup.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.send(
      "email=" +
        encodeURIComponent(email) +
        "&password=" +
        encodeURIComponent(password)
    );

    xhr.onload = function () {
      if (xhr.status >= 0 && xhr.status < 600) {
        var response = JSON.parse(xhr.responseText);
        if (response.status === "success1") {
          window.location.href = "../profile.php";
        } else if (response.status === "error") {
          var errorMessage = document.getElementById("error-message");
          var errorMessageContent = document.querySelector(
            "#error-message .error-message-content"
          );
          errorMessageContent.textContent = response.message;
          errorMessage.style.display = "block";
        }
      } else {
        alert("Ошибка сервера. Повторите попытку позже.");
      }
    };
  });

function del() {
  var errorMessage = document.getElementById("error-message");
  var errorMessageContent = document.querySelector(
    "#error-message .error-message-content"
  );
  errorMessageContent.textContent = "";
  errorMessage.style.display = "none";
}
