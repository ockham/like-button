<?php
$heart_icon = file_get_contents( plugin_dir_path( __DIR__ ) . 'public/images/empty-heart.svg' );
?>

<div
	<?php echo get_block_wrapper_attributes(); ?>
>
	<div class="like-button" >
		<?php echo $heart_icon; ?>
		<span>
			<?php _e( 'Like', 'like-button' ); ?>
		</span>
	</div>
</div>
