<?php

function whatsapp_button_admin_menu()
{
    add_menu_page(
        __('WhatsApp Button Settings', 'whatsapp-button'),
        __('WhatsApp Button', 'whatsapp-button'),
        'manage_options',
        'whatsapp-button',
        'whatsapp_button_settings_page',
        'dashicons-whatsapp',
        5
    );
}
add_action('admin_menu', 'whatsapp_button_admin_menu');

function whatsapp_button_settings_page()
{
    if (!current_user_can('manage_options')) {
        return;
    }

    settings_errors();
?>
    <div class="wrap">
        <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
        <form method="post" action="options.php">
            <?php
            settings_fields('whatsapp-button-settings');
            do_settings_sections('whatsapp-button-settings');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e('Phone Number', 'whatsapp-button'); ?></th>
                    <td>
                        <input type="text" name="whatsapp_button_phone" value="<?php echo esc_attr(get_option('whatsapp_button_phone')); ?>" />
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
}

function whatsapp_button_register_settings()
{
    register_setting(
        'whatsapp-button-settings',
        'whatsapp_button_phone',
        array(
            'type' => 'string',
            'sanitize_callback' => 'whatsapp_button_sanitize_phone_number',
            'default' => ''
        )
    );
}

add_action('admin_init', 'whatsapp_button_register_settings');

function whatsapp_button_sanitize_phone_number($input)
{
    $sanitized_input = sanitize_text_field($input);
    if (preg_match('/^\+?\d{9,15}$/', $sanitized_input)) {
        return $sanitized_input;
    } else {
        add_settings_error(
            'whatsapp_button_phone',
            'whatsapp_button_invalid_phone',
            __('The phone number appears to be invalid. Please enter a number that includes only digits and, if necessary, a leading +.', 'whatsapp-button'),
            'error'
        );
        return get_option('whatsapp_button_phone');
    }
}

function whatsapp_button_load_textdomain()
{
    load_plugin_textdomain('whatsapp-button', false, dirname(plugin_basename(__FILE__)) . '/languages');
}

add_action('plugins_loaded', 'whatsapp_button_load_textdomain');
