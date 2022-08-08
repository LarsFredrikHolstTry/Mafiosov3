function showSpecificInput() {
  var checkBox = document.getElementById(
    "specificPlayer"
  );
  var input = document.getElementById(
    "specificPlayerInput"
  );

  if (checkBox.checked == true) {
    input.style.display = "block";
  } else {
    input.style.display = "none";
  }
}
