const input = document.getElementById("pictureFile");
const form = document.getElementById("update-picture-form");

input.addEventListener("change", () => {
  if (input.files && input.files.length > 0) {
    form.submit();
  }
});
