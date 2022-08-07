function showSpecificInput() {
  var checkBox = document.getElementById(
    "specificCheck"
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
