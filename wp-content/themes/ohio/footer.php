		</div>

		<?php if ( !OhioHelper::is_optimized_flow( 'footer' ) && !OhioSettings::is_coming_soon_page() ): ?>
			<?php get_template_part( 'parts/elements/footer' ); ?>
		<?php endif; ?>
	</div>

	<?php get_template_part('parts/elements/notification'); ?>

	<?php if ( OhioOptions::get( 'page_header_menu_style', 'style1' ) == 'style6' ) : ?>
	</div>
	<?php endif; ?>

	<?php if ( OhioOptions::get( 'page_use_boxed_wrapper', false ) ) : ?>
	</div>
	<?php endif; ?>

	<div class="clb-popup container-loading custom-popup">
		<div class="close-bar">
			<div class="btn-round clb-close" tabindex="0">
				<i class="ion ion-md-close"></i>
			</div>
		</div>
		<div class="clb-popup-holder">
			
		</div>
	</div>

	<?php
		$search_position = OhioOptions::get( 'page_header_search_position', 'standard' );
	?>

	<?php if ( $search_position == "fixed" ) : ?>
		<?php get_template_part( 'parts/elements/search' );?>
	<?php endif; ?>

	<?php
		// Some dynamic code place: popups, client JS, snippets...
		OhioLayout::get_footer_buffer_content( true );

		//OhioBuffer::stop_content_bufferization();

		OhioHelper::calculate_custom_fonts_inline();
		OhioLayout::show_shortcodes_inline_css(); // Include collected dynamic CSS to head
		//OhioBuffer::get_content_buffer(); // Return the rest of page code
		wp_footer();

		do_action( 'ohio_additional_page_layout', 10, 0 );
	?>
	</body>
</html>