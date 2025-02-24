jQuery(document).ready(() => {
  jQuery("#bmwcp_upload_product_image").click(() => {
    var fileInfo = wp
      .media({
        title: "Select Product Image",
        multiple: false,
      })
      .open()
      .on("select", function () {
        var attachment = fileInfo.state().get("selection").first().toJSON();

        console.log("id->", attachment.id);
        jQuery("#product_image_media_id").val(attachment.id);

        jQuery("#product_image_preview").attr("src", attachment.url);
      });
  });
});
