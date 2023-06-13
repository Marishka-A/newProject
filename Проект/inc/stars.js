document.addEventListener("DOMContentLoaded", function () {
  var stars = document.querySelectorAll(".star-row img");
  var selectedStars = 0;

  var starFullImage = new Image();
  starFullImage.src = "img/star-full.png";

  var starEmptyImage = new Image();
  starEmptyImage.src = "img/star.png";

  stars.forEach(function (star, index) {
    star.addEventListener("mouseover", function () {
      if (selectedStars === 0) {
        for (var i = 0; i <= index; i++) {
          stars[i].src = starFullImage.src;
        }
      }
    });

    star.addEventListener("mouseout", function () {
      if (selectedStars === 0) {
        stars.forEach(function (star) {
          star.src = starEmptyImage.src;
        });
      }
    });

    star.addEventListener("click", function () {
      if (selectedStars === 0) {
        selectedStars = index + 1;
        for (var i = 0; i <= index; i++) {
          stars[i].src = starFullImage.src;
        }
      } else {
        selectedStars = 0;
        stars.forEach(function (star) {
          star.src = starEmptyImage.src;
        });
      }

      var urlParams = new URLSearchParams(window.location.search);
      var userId = urlParams.get("id");

      var score = document.getElementById("score");

      var xhr = new XMLHttpRequest();
      xhr.open("POST", "inc/starsInDB.php?id=" + userId, true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          // var scoreValue = response.score;
          // score.textContent = scoreValue;
        }
      };
      var data = "selectedStars=" + selectedStars;
      xhr.send(data);
      console.log("Выбрано звезд: " + selectedStars);
    });
  });
});
