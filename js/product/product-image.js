function previewImage(input) {
  const file = input.files[0];
  const reader = new FileReader();
  reader.onload = function (e) {
    const img = document.getElementById("preview");
    img.src = e.target.result;
  };
  reader.readAsDataURL(file);
}
