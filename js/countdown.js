function countdown(seconds, id, parentId) {
  var timeleft = seconds;
  var element = document.getElementById(id);
  var parentId =
    document.getElementById(parentId);

  var downloadTimer = setInterval(function () {
    timeleft--;
    element.textContent = timeleft;
    if (timeleft <= 0) {
      parentId.classList.remove("text-danger");
      parentId.classList.add("text-success");
      element.textContent = "Klar";
      clearInterval(downloadTimer);
    }
  }, 1000);
}

function simple_cooldown(seconds, id) {
  var timeleft = seconds;
  var element = document.getElementById(id);

  var downloadTimer = setInterval(function () {
    timeleft--;
    element.textContent = timeleft;
    if (timeleft <= 0) {
      element.textContent = "Klar";
      clearInterval(downloadTimer);
    }
  }, 1000);
}
