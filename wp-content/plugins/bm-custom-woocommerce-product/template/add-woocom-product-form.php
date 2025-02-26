
<div class="container">
    <h2>Product Form</h2>
    <form action="#" method="post" enctype="multipart/form-data">

        <?php wp_nonce_field('bmwcp_create_product', 'bmwcp_create_product_nonce'); ?>

        <label for="name">Name:</label>
        <input type="text" required id="name" name="bmwcp_name" required>

        <label for="regular_price">Regular Price:</label>
        <input type="number" required id="regular_price" name="bmwcp_regular_price" required>

        <label for="sale_price">Sale Price:</label>
        <input type="number" required id="sale_price" name="bmwcp_sale_price">

        <label for="sku">SKU:</label>
        <input type="text" required id="sku" name="bmwcp_sku" required>

        <label for="short_description">Short Description:</label>
        <textarea id="short_description" name="bmwcp_short_description" rows="2"></textarea>

        <label for="description">Description:</label>
        <textarea id="description" required name="bmwcp_description" rows="4"></textarea>

        <label for="product_image">Product Image:</label>
        <button type="button" id="bmwcp_upload_product_image">Upload Image</button>
        <input type="hidden" name="product_image_media_id" id="product_image_media_id"  />
        <img src="" id="product_image_preview" style="width: 100px; height: 100px;" />
        <br />
        <button type="submit" name="bmwcp_submit">Submit</button>
    </form>
</div>

