<form action="options.php" method="post">
    <?php
        settings_fields('bmwp_login_page_settings_field_group');
        do_settings_sections('bmwp_login_customizer');
        submit_button('Save Settings');
    ?>

</form>