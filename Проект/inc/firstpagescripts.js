// Обработчик отправки формы регистрации через AJAX
document
  .getElementById("register_window")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    var login = document.querySelector(
      '#register_window input[name="login-reg"]'
    ).value;
    var email = document.querySelector(
      '#register_window input[name="email-reg"]'
    ).value;
    var password = document.querySelector(
      '#register_window input[name="password-reg"]'
    ).value;
    var passwordConfirm = document.querySelector(
      '#register_window input[name="password-confirm"]'
    ).value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "inc/register.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.send(
      "login-reg=" +
        encodeURIComponent(login) +
        "&email-reg=" +
        encodeURIComponent(email) +
        "&password-reg=" +
        encodeURIComponent(password) +
        "&password-confirm=" +
        encodeURIComponent(passwordConfirm)
    );

    xhr.onload = function () {
      if (xhr.status >= 0 && xhr.status < 600) {
        var response = JSON.parse(xhr.responseText);
        if (response.status === "success") {
          window.location.href = "regpage.php";
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
