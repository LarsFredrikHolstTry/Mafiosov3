const feedbackReturn = function (
  feedbackText,
  feedbackType
) {
  $("#feedback-success").hide();
  $("#feedback-danger").hide();
  $("#feedback-warning").hide();
  $("#feedback-info").hide();

  switch (feedbackType) {
    case "success":
      $("#feedback-success")
        .show()
        .delay(5000)
        .fadeOut();
      $("#feedback-success-text").text(
        feedbackText
      );
      break;
    case "danger":
      $("#feedback-danger")
        .show()
        .delay(5000)
        .fadeOut();
      $("#feedback-danger-text").text(
        feedbackText
      );
      break;
    case "warning":
      $("#feedback-warning")
        .show()
        .delay(5000)
        .fadeOut();
      $("#feedback-warning-text").text(
        feedbackText
      );
      break;
    case "info":
      $("#feedback-info")
        .show()
        .delay(5000)
        .fadeOut();
      $("#feedback-info-text").text(feedbackText);
      break;
    default:
      $("#feedback-warning").show();
      $("#feedback-warning-text").text(
        "Det oppsto en uventet feil. Ta konktakt med moderator dersom dette gjentar seg."
      );
  }
};
