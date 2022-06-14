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
      $("#feedback-success").show();
      $("#feedback-success-text").text(
        feedbackText
      );
      break;
    case "danger":
      $("#feedback-danger").show();
      $("#feedback-danger-text").text(
        feedbackText
      );
      break;
    case "warning":
      $("#feedback-warning").show();
      $("#feedback-warning-text").text(
        feedbackText
      );
      break;
    case "info":
      $("#feedback-info").show();
      $("#feedback-info-text").text(feedbackText);
      break;
    default:
      $("#feedback-warning").show();
      $("#feedback-warning-text").text(
        "Det oppsto en uventet feil. Ta konktakt med ledelsen dersom dette gjentar seg."
      );
  }
};
