function countdown(seconds, id) {
  var element = document.getElementById(id);

  var downloadTimer = setInterval(function () {
    seconds--;
    element.textContent = seconds;
    if (seconds <= 0) {
      element.classList.remove("text-danger");
      element.classList.add("text-success");
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
