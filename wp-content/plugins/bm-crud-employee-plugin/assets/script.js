jQuery(document).ready(() => {
  // Add Form Validation
  jQuery("#bm-employee-form").validate();

  // form submit

  jQuery("#bm-employee-form").on("submit", function (event) {
    event.preventDefault();

    var formData = new FormData(this);

    jQuery.ajax({
      url: bm_form_object.ajax_url,
      data: formData,
      method: "POST",
      dataType: "json",
      contentType: false,
      processData: false,
      success: function (response) {},
    });
  });
});
