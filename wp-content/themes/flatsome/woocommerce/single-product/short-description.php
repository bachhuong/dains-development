<?php
/**
 * Single product short description
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

if ( ! $post->post_excerpt ) :
?>
	<div itemprop="description" class="short-description">

		<?php if (get_post_meta( $post->ID, '_ten_hoa_hoc_field' )) : ?>
			<p><strong style="color:#000"><?php echo get_post_meta( $post->ID, '_ten_hoa_hoc_field' )[0]; ?></strong></p>
			<div class="tx-div small" style="display:block !important"></div>
		<?php endif; ?>
			<p><?php if (get_post_meta( $post->ID, '_cong_thuc_hoa_hoc_field' )) : ?>Công thức: <?php echo get_post_meta( $post->ID, '_cong_thuc_hoa_hoc_field' )[0]; ?><br><?php endif?>
				<?php if (get_post_meta( $post->ID, '_ham_luong_hoa_chat_field' )) : ?>Hàm lượng: <?php echo get_post_meta( $post->ID, '_ham_luong_hoa_chat_field' )[0]; ?><br><?php endif?>
				<?php if (get_post_meta( $post->ID, '_xuat_xu_field' )) : ?>Xuất xứ: <?php echo get_post_meta( $post->ID, '_xuat_xu_field' )[0]; ?><br><?php endif?>
				<?php if (get_post_meta( $post->ID, '_dong_goi_field' )) : ?>Đóng gói: <?php echo get_post_meta( $post->ID, '_dong_goi_field' )[0]; ?><br><?php endif?>
				<?php if (get_post_meta( $post->ID, '_sku' )) : ?>Mã SP: <?php echo get_post_meta( $post->ID, '_sku' )[0]; ?><?php endif?>
			</p>
	</div>
<?php else : ?>
	<div itemprop="description" class="short-description">
		<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>

		<?php if (get_post_meta( $post->ID, '_ten_hoa_hoc_field' )) : ?>
			<p><strong style="color:#000"><?php echo get_post_meta( $post->ID, '_ten_hoa_hoc_field' )[0]; ?></strong></p>
			<div class="tx-div small" style="display:block !important"></div>
		<?php endif; ?>
		<p><?php if (get_post_meta( $post->ID, '_cong_thuc_hoa_hoc_field' )) : ?>Công thức: <?php echo get_post_meta( $post->ID, '_cong_thuc_hoa_hoc_field' )[0]; ?><br><?php endif?>
			<?php if (get_post_meta( $post->ID, '_ham_luong_hoa_chat_field' )) : ?>Hàm lượng: <?php echo get_post_meta( $post->ID, '_ham_luong_hoa_chat_field' )[0]; ?><br><?php endif?>
			<?php if (get_post_meta( $post->ID, '_xuat_xu_field' )) : ?>Xuất xứ: <?php echo get_post_meta( $post->ID, '_xuat_xu_field' )[0]; ?><br><?php endif?>
			<?php if (get_post_meta( $post->ID, '_dong_goi_field' )) : ?>Đóng gói: <?php echo get_post_meta( $post->ID, '_dong_goi_field' )[0]; ?><br><?php endif?>
			<?php if (get_post_meta( $post->ID, '_sku' )) : ?>Mã SP: <?php echo get_post_meta( $post->ID, '_sku' )[0]; ?><?php endif?>
		</p>
	</div>
<?php endif; ?>