<?php

/**
 * Plugin Name: WhatsApp Button
 * Description: Adds a floating WhatsApp button to your WordPress site.
 * Version: 1.0
 * Author: <a href="https://www.qubicks.com" target="_blank">Qubicks</a>
 */

include_once plugin_dir_path(__FILE__) . 'includes/admin-settings.php';

function whatsapp_button_enqueue_scripts()
{
    wp_enqueue_style('whatsapp-button-style', plugin_dir_url(__FILE__) . 'assets/css/style.css');
}
add_action('wp_enqueue_scripts', 'whatsapp_button_enqueue_scripts');

function whatsapp_button_display()
{
    $phone_number = get_option('whatsapp_button_phone');
    if (!empty($phone_number)) {
        echo '<a href="https://wa.me/' . esc_attr($phone_number) . '" class="whatsapp-button-link" target="_blank">';
        echo '<img src="' . plugin_dir_url(__FILE__) . 'assets/img/whatsapp-icon.png" alt="WhatsApp"/>';
        echo '</a>';
    }
}
add_action('wp_footer', 'whatsapp_button_display');
