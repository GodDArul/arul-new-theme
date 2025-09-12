<?php
function arul_new_theme_customize_register( $wp_customize ) {

    /* -------------------------------------------------------------------------
 *  Location Setting
 * ---------------------------------------------------------------------- */
    // Tambah Section
    $wp_customize->add_section('Location_Setting',[
        'title'        => 'Location Setting',
        'description'  => 'Pengaturan Lokasi',
        'priority'     => 2 ,
    ]);

    // Tambah Setting Google Maps
    $wp_customize->add_setting('google-maps', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    // Tambah Control Google Maps
    $wp_customize->add_control('google-maps', [
        'label'   => 'Google Maps',
        'section' => 'Location_Setting',
        'type'    => 'url',
    ]);

    /* -------------------------------------------------------------------------
 *  General Setting
 * ---------------------------------------------------------------------- */
    // Tambah Section
    $wp_customize->add_section('General_Setting', [
        'title'       => 'General Setting',
        'description' => 'Pengaturan Umum Website',
        'priority'    => 1 ,
    ]);

    // Tambah Setting Nomor WA
    $wp_customize->add_setting('nomor_wa', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    // Tambah Control Nomor WA
    $wp_customize->add_control('nomor_wa', [
        'label'   => 'WhatsApp',
        'section' => 'General_Setting',
        'type'    => 'text',
    ]);

    // Tambah Setting Instagram
    $wp_customize->add_setting('instagram', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    // Tambah Control Instagram
    $wp_customize->add_control('instagram', [
        'label'   => 'Instagram',
        'section' => 'General_Setting',
        'type'    => 'text',
    ]);

    // Tambah Setting Facebook
    $wp_customize->add_setting('facebook', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    // Tambah Control Facebook
    $wp_customize->add_control('facebook', [
        'label'   => 'Facebook',
        'section' => 'General_Setting',
        'type'    => 'text',
    ]);

}
add_action('customize_register', 'arul_new_theme_customize_register');
?>