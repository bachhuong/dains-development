<?php

add_action( 'woocommerce_product_write_panel_tabs', 'woo_add_custom_admin_product_tab' );

function woo_add_custom_admin_product_tab() {
    ?>
    <li class="custom_tab"><a href="#thong_tin_hoa_chat"><?php _e('Thông tin hoá chất', 'woocommerce'); ?></a></li>
    <?php
}

// Display Fields
add_action( 'woocommerce_product_data_panels', 'woo_add_custom_general_fields' );

// Save Fields
add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );

function woo_add_custom_general_fields() {

    global $woocommerce, $post;

    echo '<div id="thong_tin_hoa_chat" class="panel woocommerce_options_panel"><div class="options_group">';

    woocommerce_wp_text_input(
        array(
            'id'          => '_ten_hoa_hoc_field',
            'label'       => __( 'Tển hoá học', 'woocommerce' ),
            'placeholder' => 'Calcium Hypochlorite',
            'desc_tip'    => 'true',
            'description' => __( 'Enter the custom value here.', 'woocommerce' )
        )
    );

    woocommerce_wp_textarea_input(
        array(
            'id'          => '_ten_goi_khac_field',
            'label'       => __( 'Các tên gọi khác', 'woocommerce' ),
            'placeholder' => 'Tên gọi 1, Tên gọi 2, Tên gọi 3',
            'desc_tip'    => 'true',
            'description' => __( 'Enter the custom value here.', 'woocommerce' )
        )
    );

    woocommerce_wp_text_input(
        array(
            'id'          => '_cong_thuc_hoa_hoc_field',
            'label'       => __( 'Công thức hoá học', 'woocommerce' ),
            'placeholder' => 'Ca(OCl)2',
            'desc_tip'    => 'true',
            'description' => __( 'Enter the custom value here.', 'woocommerce' )
        )
    );
    woocommerce_wp_text_input(
        array(
            'id'          => '_ham_luong_hoa_chat_field',
            'label'       => __( 'Hàm lượng hoá chất', 'woocommerce' ),
            'placeholder' => '%',
            'desc_tip'    => 'true',
            'description' => __( 'Enter the custom value here.', 'woocommerce' )
        )
    );
    woocommerce_wp_text_input(
        array(
            'id'          => '_xuat_xu_field',
            'label'       => __( 'Xuất xứ', 'woocommerce' ),
            'placeholder' => '',
            'desc_tip'    => 'true',
            'description' => __( 'Enter the custom value here.', 'woocommerce' )
        )
    );
    woocommerce_wp_text_input(
        array(
            'id'          => '_dong_goi_field',
            'label'       => __( 'Đóng gói', 'woocommerce' ),
            'placeholder' => 'Kg/1thùng',
            'desc_tip'    => 'true',
            'description' => __( 'Enter the custom value here.', 'woocommerce' )
        )
    );

    echo '</div></div>';

}

function woo_add_custom_general_fields_save( $post_id ){

    $woocommerce_text_field = $_POST['_ten_hoa_hoc_field'];
    if( !empty( $woocommerce_text_field ) )
        update_post_meta( $post_id, '_ten_hoa_hoc_field', esc_attr( $woocommerce_text_field ) );

    $woocommerce_text_field = $_POST['_ten_goi_khac_field'];
    if( !empty( $woocommerce_text_field ) )
        update_post_meta( $post_id, '_ten_goi_khac_field', esc_attr( $woocommerce_text_field ) );

    $woocommerce_text_field = $_POST['_cong_thuc_hoa_hoc_field'];
    if( !empty( $woocommerce_text_field ) )
        update_post_meta( $post_id, '_cong_thuc_hoa_hoc_field', esc_attr( $woocommerce_text_field ) );

    $woocommerce_text_field = $_POST['_ham_luong_hoa_chat_field'];
    if( !empty( $woocommerce_text_field ) )
        update_post_meta( $post_id, '_ham_luong_hoa_chat_field', esc_attr( $woocommerce_text_field ) );

    $woocommerce_text_field = $_POST['_xuat_xu_field'];
    if( !empty( $woocommerce_text_field ) )
        update_post_meta( $post_id, '_xuat_xu_field', esc_attr( $woocommerce_text_field ) );

    $woocommerce_text_field = $_POST['_dong_goi_field'];
    if( !empty( $woocommerce_text_field ) )
        update_post_meta( $post_id, '_dong_goi_field', esc_attr( $woocommerce_text_field ) );

}