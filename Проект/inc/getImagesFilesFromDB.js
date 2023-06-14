document.addEventListener("DOMContentLoaded", function () {
  var imageContainer = document.getElementById("imageContainer");
  var fileContainer = document.getElementById("fileContainer");

  fetch("inc/imgOnProfile.php")
    .then((response) => response.text())
    .then((html) => {
      imageContainer.innerHTML = extractImageHTML(html);
      fileContainer.innerHTML = extractFileHTML(html);
      addDeleteButtons();
    })
    .catch((error) => console.log(error));

  function extractImageHTML(html) {
    const tempContainer = document.createElement("div");
    tempContainer.innerHTML = html;

    const imageDivs = tempContainer.querySelectorAll(".project-block img");

    const imageHTML = Array.from(imageDivs)
      .map((div) => {
        const imageContainer = document.createElement("div");
        imageContainer.classList.add("project-block", "image-block");
        imageContainer.innerHTML = `
            <div class="image-wrapper">
              ${div.outerHTML}
              ${createDeleteButtonHTML()}
            </div>
          `;
        return imageContainer.outerHTML;
      })
      .join("");

    return imageHTML;
  }

  function extractFileHTML(html) {
    const tempContainer = document.createElement("div");
    tempContainer.innerHTML = html;

    const fileDivs = tempContainer.querySelectorAll(".project-block a");
    const fileHTML = Array.from(fileDivs)
      .map((div) => {
        const fileContainer = document.createElement("div");
        fileContainer.classList.add("file-block"); // Добавляем класс "file-block" для обертки файла
        fileContainer.innerHTML =
          "-" + div.outerHTML + createDeleteButtonHTML();
        return fileContainer.outerHTML;
      })
      .join("");

    return fileHTML;
  }

  function createDeleteButtonHTML() {
    return '<div class="remove-button-file">x</div>';
  }

  function addDeleteButtons() {
    const deleteButtons = document.querySelectorAll(".remove-button-file");
    deleteButtons.forEach((button) => {
      button.addEventListener("click", () => {
        const fileBlock = button.closest(".file-block, .image-block");
        if (fileBlock.classList.contains("file-block")) {
          const fileLink = fileBlock.querySelector("a");
          const filePath = fileLink.getAttribute("href");
          deleteFile(fileBlock, filePath);
        } else if (fileBlock.classList.contains("image-block")) {
          const image = fileBlock.querySelector("img");
          const imagePath = image.getAttribute("src");
          deleteImage(fileBlock, imagePath);
        }
      });
    });
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
});
