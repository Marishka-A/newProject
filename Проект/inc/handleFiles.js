function handleFiles(files) {
  var fileList = document.getElementById("fileContainer");
  var imagesContainer = document.getElementById("imageContainer");
  var formData = new FormData();

  for (var i = 0; i < files.length; i++) {
    var file = files[i];
    var reader = new FileReader();

    if (file.type.startsWith("image/")) {
      var img = document.createElement("img");
      img.classList.add("uploaded-image");
      img.name = "uploaded-image";

      var wrapper = document.createElement("div");
      wrapper.classList.add("image-wrapper");
      wrapper.appendChild(img);

      reader.onload = (function (image) {
        return function (e) {
          image.src = e.target.result;
          image.maxWidth = 600 + "px";
          image.maxHeigth = 600 + "px";
          imagesContainer.appendChild(wrapper);
        };
      })(img);
      var removeButton = document.createElement("div");
      removeButton.classList.add("remove-button-file");
      removeButton.innerHTML = "x";

      wrapper.appendChild(removeButton);

      formData.append("image_" + i, file);
      reader.readAsDataURL(file);
    } else {
      var fileItem = document.createElement("div");
      fileItem.classList.add("file-item");
      fileItem.name = "file-item";

      var fileLink = document.createElement("a");
      fileLink.innerHTML = file.name;
      fileLink.href = URL.createObjectURL(file);
      fileLink.download = file.name;

      var removeButton = document.createElement("div");
      removeButton.classList.add("remove-button-file");
      removeButton.innerHTML = "x";

      fileItem.appendChild(fileLink);
      fileItem.appendChild(removeButton);

      formData.append("file_" + i, file);
      fileList.appendChild(fileItem);
    }
    removeButton.addEventListener("click", function () {
      const fileBlock = button.closest(".imageContainer");
      if (fileBlock.classList.contains("fileContainer")) {
        const fileLink = fileBlock.querySelector("a");
        const filePath = fileLink.getAttribute("href");
        deleteFile(fileBlock, filePath);
      } else if (fileBlock.classList.contains("image-block")) {
        const image = fileBlock.querySelector("img");
        const imagePath = image.getAttribute("src");
        deleteImage(fileBlock, imagePath);
      }
    });
  }
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "inc/uploadImg.php", true);
  xhr.onload = function () {
    if (xhr.status === 200) {
      console.log("Файлы успешно загружены!");
    } else {
      console.log("Произошла ошибка при загрузке файлов.");
    }
  };
  xhr.onreadystatechange = function () {
    if (formData.has("file_0") || formData.has("image_0")) {
      console.log("Файлы есть");
    } else {
      console.log("Файлов нет");
    }
  };
  xhr.send(formData);
}

function deleteImage(imageBlock, imagePath) {
  imageBlock.remove();
  fetch("inc/delete_file.php", {
    method: "POST",
    body: JSON.stringify({ filePath: imagePath }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        console.log("Файл успешно удален:", filePath);
      } else {
        console.log("Не удалось удалить файл:", filePath);
      }
    })
    .catch((error) => console.log(error));
}

function deleteFile(fileBlock, filePath) {
  fileBlock.remove();
  fetch("inc/delete_file.php", {
    method: "POST",
    body: JSON.stringify({ filePath: filePath }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        console.log("Файл успешно удален:", filePath);
      } else {
        console.log("Не удалось удалить файл:", filePath);
      }
    })
    .catch((error) => console.log(error));
}
