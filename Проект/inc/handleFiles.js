var xhr = new XMLHttpRequest();
var formData = new FormData();

function handleFiles(files) {
  var fileList = document.getElementById("fileContainer");
  var imagesContainer = document.getElementById("imageContainer");

  for (var i = 0; i < files.length; i++) {
    (function (i) {
      var file = files[i];
      var reader = new FileReader();

      if (file.type.startsWith("image/")) {
        var img = document.createElement("img");
        img.classList.add("uploaded-image");
        img.name = "uploaded-image";

        var wrapper = document.createElement("div");
        wrapper.classList.add("image-wrapper");
        wrapper.appendChild(img);

        reader.onload = function (e) {
          img.src = e.target.result;
          if (img.width > 600 || img.height > 600) {
            var aspectRatio = img.width / img.height;
            var maxWidth = 600;
            var maxHeight = 600;
            var newWidth, newHeight;
            if (img.width > img.height) {
              newWidth = maxWidth;
              newHeight = Math.floor(newWidth / aspectRatio);
            } else {
              newHeight = maxHeight;
              newWidth = Math.floor(newHeight * aspectRatio);
            }
            img.style.width = newWidth + "px";
            img.style.height = newHeight + "px";
          }
        };

        reader.readAsDataURL(file);

        var removeButton = document.createElement("div");
        removeButton.classList.add("remove-button-file");
        removeButton.innerHTML = "x";

        wrapper.appendChild(removeButton);

        removeButton.addEventListener("click", function () {
          imagesContainer.removeChild(wrapper);
          formData.delete("image_" + i);
        });

        formData.append("image_" + i, file);
        imagesContainer.appendChild(wrapper);
      } else {
        var fileItem = document.createElement("div");
        fileItem.classList.add("file-item");
        fileItem.name = "file-item";

        var fileName = document.createElement("span");
        fileName.innerHTML = "-"; // Имя файла без дефиса

        var fileLink = document.createElement("a");
        fileLink.href = URL.createObjectURL(file);
        fileLink.download = file.name;
        fileLink.innerHTML = file.name;

        var removeButton = document.createElement("div");
        removeButton.classList.add("remove-button-file");
        removeButton.innerHTML = "x";

        fileItem.appendChild(fileName);
        fileItem.appendChild(fileLink);
        fileItem.appendChild(removeButton);

        removeButton.addEventListener("click", function () {
          fileList.removeChild(fileItem);
          formData.delete("file_" + i);
        });

        formData.append("file_" + i, file);
        fileList.appendChild(fileItem);
      }
    })(i);
  }
}

function uploadFiles() {
  xhr.open("POST", "inc/uploadImg.php", true);
  xhr.onload = function () {
    if (xhr.status === 200) {
      console.log("Файлы успешно загружены!");
    } else {
      console.log("Произошла ошибка при загрузке файлов.");
    }
  };
  xhr.send(formData);
}
