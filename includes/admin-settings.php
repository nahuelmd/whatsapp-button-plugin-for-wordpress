<?php
function whatsapp_button_admin_menu()
{
    add_options_page('WhatsApp Button Settings', 'WhatsApp Button', 'manage_options', 'whatsapp-button', 'whatsapp_button_settings_page');
}
add_action('admin_menu', 'whatsapp_button_admin_menu');

function whatsapp_button_settings_page()
{
?>
<div class="wrap">
    <h2>WhatsApp Button Settings</h2>
    <form method="post" action="options.php">
        <?php settings_fields('whatsapp-button-settings'); ?>
        <?php do_settings_sections('whatsapp-button-settings'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Phone Number</th>
                <td><input type="text" name="whatsapp_button_phone"
                        value="<?php echo esc_attr(get_option('whatsapp_button_phone')); ?>" /></td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>
<?php
}

function whatsapp_button_register_settings()
{
    register_setting('whatsapp-button-settings', 'whatsapp_button_phone');
}
add_action('admin_init', 'whatsapp_button_register_settings');