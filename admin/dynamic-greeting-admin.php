<?php

// All your admin specific code will be here

function dynamic_greeting_add_settings_page() {
    add_menu_page('Dynamic Greeting', 'Dynamic Greeting', 'manage_options', 'dynamic-greeting', 'dynamic_greeting_render_plugin_settings_page', '', 6);
}
add_action('admin_menu', 'dynamic_greeting_add_settings_page');

function dynamic_greeting_render_plugin_settings_page() {
    ?>
    <h2>Dynamic Greeting Settings</h2>
    <form action="options.php" method="post">
        <?php 
            settings_fields('dynamic_greeting_plugin_options');
            do_settings_sections('dynamic_greeting'); 
        ?>
        <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e('Save'); ?>" />
    </form>
    <?php
}

function dynamic_greeting_register_settings() {
    register_setting('dynamic_greeting_plugin_options', 'dynamic_greeting_color', 'dynamic_greeting_callback_validate_options');

    add_settings_section('dynamic_greeting_main', 'Main Settings', 'dynamic_greeting_callback_section_main', 'dynamic_greeting');

    add_settings_field('dynamic_greeting_field_color', 'Admin Background Color', 'dynamic_greeting_callback_field_color', 'dynamic_greeting', 'dynamic_greeting_main');
}
add_action('admin_init', 'dynamic_greeting_register_settings');

function dynamic_greeting_callback_section_main() {
    echo '<p>Enter the color value to be used as the background color of the admin panel. Use hexadecimal color values.</p>';
}

function dynamic_greeting_callback_field_color() {
    $options = get_option('dynamic_greeting_color');
    echo "<input id='dynamic_greeting_color' name='dynamic_greeting_color' type='text' value='" . esc_attr($options) . "' />";
}

function dynamic_greeting_callback_validate_options($input) {
    // Here you might want to implement more robust validation for color codes
    return array_map('wp_filter_nohtml_kses', (array)$input);
}

// Use the admin color option to set the background color of the admin area
function dynamic_greeting_change_admin_color() {
    $color = get_option('dynamic_greeting_color');
    echo "<style> body { background-color: $color !important; } </style>";
}
add_action('admin_head', 'dynamic_greeting_change_admin_color');
