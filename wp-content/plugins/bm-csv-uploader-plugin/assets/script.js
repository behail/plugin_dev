jQuery(document).ready(function ($) {
  jQuery("#bmcsv_csv_uploader_form").on("submit", function (event) {
    event.preventDefault();

    var formData = new FormData(this);

    jQuery.ajax({
      url: bmcsv_object.ajax_url,
      data: formData,
      dataType: "json",
      method: "POST",
      processData: false,
      contentType: false,
      success: function (res) {
        if (res.status == "success") {
          jQuery("#show_upload_message").text(res.message).css({
            color: "green",
          });
        }
      },
    });
  });
});
