document.addEventListener("DOMContentLoaded", function () {
  const avatarInput = document.getElementById("avatarInput");
  const avatarCanvas = document.getElementById("avatarCanvas");
  const canvasContext = avatarCanvas.getContext("2d");

  // При выборе файла аватара
  avatarInput.addEventListener("change", function (event) {
    const file = event.target.files[0];
    renderAvatar(file);
  });

  // Функция для отрисовки аватара на холсте
  function renderAvatar(file) {
    const reader = new FileReader();
    reader.onload = function (event) {
      const img = new Image();
      img.onload = function () {
        // Очищаем холст
        canvasContext.clearRect(0, 0, avatarCanvas.width, avatarCanvas.height);
        // Масштабируем и отрисовываем загруженное изображение на холсте
        const aspectRatio = img.width / img.height;
        const maxSize = Math.max(avatarCanvas.width, avatarCanvas.height);
        const width = aspectRatio >= 1 ? maxSize : maxSize * aspectRatio;
        const height = aspectRatio >= 1 ? maxSize / aspectRatio : maxSize;
        const x = (avatarCanvas.width - width) / 2;
        const y = (avatarCanvas.height - height) / 2;
        canvasContext.drawImage(img, x, y, width, height);

        // Отображаем холст после загрузки изображения
        avatarCanvas.style.display = "block";
      };
      img.src = event.target.result;
    };
    reader.readAsDataURL(file);
  }
});

var menuItems = document.querySelectorAll(
  '#specialization-menu div[name="specialization"]'
);
var specialization = "";

for (var i = 0; i < menuItems.length; i++) {
  var menuItem = menuItems[i];
  // Обработчик события клика
  menuItem.addEventListener("click", function () {
    // Сбрасываем цвет всех элементов меню
    for (var j = 0; j < menuItems.length; j++) {
      menuItems[j].style.backgroundColor = "";
    }

    // Устанавливаем новый цвет текущему элементу меню
    this.style.backgroundColor = "#c29e68";
    specialization = this.querySelector(
      'div[name="specialization"] p[class="specialization-text"]'
    ).textContent;
  });
}

// Обработчик отправки формы регистрации через AJAX
document
  .getElementById("main_info")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Отменяем обычное поведение отправки формы

    // Получаем значения полей формы
    var pictrue = document.getElementById("avatarCanvas").toDataURL();
    var name = document.querySelector('#main_info input[name="name"]').value;
    var surname = document.querySelector(
      '#main_info input[name="surname"]'
    ).value;
    var country = document.querySelector(
      '#main_info input[name="country"]'
    ).value;
    var town = document.querySelector('#main_info input[name="town"]').value;
    var number = document.querySelector(
      '#main_info input[name="number"]'
    ).value;
    var tg = document.querySelector('#main_info input[name="tg"]').value;
    var vk = document.querySelector('#main_info input[name="vk"]').value;
    var wa = document.querySelector('#main_info input[name="wa"]').value;
    var birthday = document.querySelector(
      '#main_info input[name="birthday"]'
    ).value;
    var about = document.querySelector(
      '#main_info textarea[name="about"]'
    ).value;

    var specialization = checkSpecializationOnLoad();

    // Создаем AJAX-запрос
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "inc/register2.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Отправляем данные формы на сервер
    xhr.send(
      "avatarCanvas=" +
        encodeURIComponent(pictrue) +
        "&name=" +
        encodeURIComponent(name) +
        "&surname=" +
        encodeURIComponent(surname) +
        "&country=" +
        encodeURIComponent(country) +
        "&town=" +
        encodeURIComponent(town) +
        "&number=" +
        encodeURIComponent(number) +
        "&tg=" +
        encodeURIComponent(tg) +
        "&vk=" +
        encodeURIComponent(vk) +
        "&wa=" +
        encodeURIComponent(wa) +
        "&birthday=" +
        encodeURIComponent(birthday) +
        "&specialization=" +
        encodeURIComponent(specialization) +
        "&about=" +
        encodeURIComponent(about)
    );

    // Обработчик события загрузки данных
    xhr.onload = function () {
      if (xhr.status >= 0 && xhr.status < 600) {
        var response = JSON.parse(xhr.responseText);
        if (response.status === "success") {
          window.location.href = "profile.php";
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

function checkSpecializationOnLoad() {
  var menuItems = document.querySelectorAll(
    '#specialization-menu div[name="specialization"]'
  );
  var specialization = "";

  for (var i = 0; i < menuItems.length; i++) {
    var menuItem = menuItems[i];

    // Проверяем, имеет ли элемент уже нужный цвет
    if (menuItem.style.backgroundColor === "rgb(194, 158, 104)") {
      specialization = menuItem.querySelector(
        'p[class="specialization-text"]'
      ).textContent;
      return specialization;
    }
  }
  return specialization;
}
