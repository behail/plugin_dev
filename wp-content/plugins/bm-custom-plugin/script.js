jQuery(document).ready(() => {
  jQuery(".bmcw_dd_option").on("change", function (event) {
    let selectedValue = jQuery(this).val();

    if (selectedValue == "recent_post") {
      jQuery("p#bmcw_display_recent_post").removeClass("hide_element");
      jQuery("p#bmcw_display_static_message").addClass("hide_element");
    } else if (selectedValue == "static_message") {
      jQuery("p#bmcw_display_recent_post").addClass("hide_element");
      jQuery("p#bmcw_display_static_message").removeClass("hide_element");
    }
  });
});
