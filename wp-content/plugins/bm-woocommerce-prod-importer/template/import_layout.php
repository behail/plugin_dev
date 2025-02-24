<h3>Woocommerce Product Importer</h3>

<form action="" method="post" enctype="multipart/form-data">

    <?php wp_nonce_field('bmwpi_handle_form_upload', 'bmwpi_import_csv_nonce_value'); ?>

    <p>
        <label for="bmwpi_import_file">Import CSV</label>
        <input type="file" id="bmwpi_import_file" name="bmwpi_import_file">
    </p>
    <p>
        <?php submit_button('Upload CSV', 'primary', 'bmwpi_import_csv', false); ?>
    </p>
</form>