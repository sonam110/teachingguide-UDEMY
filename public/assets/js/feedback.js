$("#btnFeedbackSubmit").click(function () {
    //save issue in database ajax and then close
    var fbUserID = $('#fbUser').val();
    var fbPage = $('#fbPage').val();
    var fbTitle = $('#fbTitle').val();
    var fbCategory = $('#fbCategory').val();
    var fbPriority = $('#fbPriority').val();
    var fbDescription = $('#fbDescription').text();

    if (fbTitle == "") {
        showErrorToast("Please enter a title!");
        return;
    }
    if (fbCategory == 0) {
        showErrorToast("Please select a category!");
        return;
    }
    if (fbPriority == 0) {
        showErrorToast("Please select a priority level!");
        return;
    }
    if (fbDescription == "") {
        showErrorToast("Please enter a description!");
        return;
    }

    $.ajax({
        url: "/api/feedback-add",
        type: "get", //send it through get method
        data: {
          user_id: fbUserID,
          page: fbPage,
          title: fbTitle,
          category: fbCategory,
          priority: fbPriority,
          description: fbDescription
        },
        success: function(response) {
          $('#feedback-main').modal('hide');
          //clear value fields
          $('#fbTitle').val("");
          $('#fbCategory').val(0);
          $('#fbPriority').val(0);
          $('#fbDescription').text("");
          showSuccessToast("Thank you for your feedback!");
        },
        error: function(xhr) {
          //Do Something to handle error
          console.log(xhr);
        }
    });

});

function showSuccessToast(message, timeout=2000) {
  toastr.options = {
      closeButton: 1,
      positionClass: 'toast-top-right',
      onclick: null,
      showDuration: 1000,
      hideDuration: 1000,
      timeOut: timeout
  };
  toastr.success(message);
}
function showErrorToast(message, timeout=2000) {
  toastr.options = {
      closeButton: 1,
      positionClass: 'toast-top-right',
      onclick: null,
      showDuration: 1000,
      hideDuration: 1000,
      timeOut: timeout
  };
  toastr.error(message);
}
