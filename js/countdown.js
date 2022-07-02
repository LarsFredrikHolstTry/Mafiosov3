function countdown(seconds, id, parentId) {
  var timeleft = seconds;
  var element = document.getElementById(id);
  var parentId =
    document.getElementById(parentId);

  var downloadTimer = setInterval(function () {
    timeleft--;
    element.textContent = timeleft;
    if (timeleft <= 0) {
      parentId.classList.remove("bg-orange-lt");
      parentId.classList.add("bg-green-lt");
      element.textContent = "Klar";
      clearInterval(downloadTimer);
    }
  }, 1000);
}
