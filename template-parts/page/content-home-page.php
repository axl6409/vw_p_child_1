<?php
/**
 * The home page template file
 *
 * This is what will appear for the home page.
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>


<article id="post-<?php the_ID(); ?>" <?php post_class( 'twentyseventeen-panel ' ); ?> >

	<?php
	if ( has_post_thumbnail() ) :
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'twentyseventeen-featured-image' );

		// Calculate aspect ratio: h / w * 100%.
		$ratio = $thumbnail[2] / $thumbnail[1] * 100;
		?>

		<div class="panel-image" style="background-image: url(<?php echo esc_url( $thumbnail[0] ); ?>);">
			<div class="panel-image-prop" style="padding-top: <?php echo esc_attr( $ratio ); ?>%"></div>
		</div><!-- .panel-image -->

	<?php endif; ?>

	<div class="panel-content">
		<div class="wrap">


			<header class="entry-header">
				<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

				<?php twentyseventeen_edit_link( get_the_ID() ); ?>

			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
					/* translators: %s: Name of current post */
					the_content(
						sprintf(
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ),
							get_the_title()
						)
					);
					?>

					<section>
						
						<?php $the_query = new WP_Query( array( 'post_type' => 'services', 'posts_per_page' => '4' ) ); ?>

						<!-- Start The WP Loop -->
						<?php while ( $the_query -> have_posts() ) : 
								$the_query -> the_post(); ?>

						       <!-- Display the post excerpt -->
								<?php $post_display_option = get_theme_mod( 'post_display_option', 'post-excerpt' );
								if ( 'post-excerpt' === $post_display_option ) {
									get_template_part( 'template-parts/content', 'excerpt' );
								} else {
									get_template_part( 'template-parts/content', get_post_format() );
								}
								?>
						<?php endwhile; wp_reset_query(); ?>

					</section>


			</div><!-- .entry-content -->

		</div><!-- .wrap -->
	</div><!-- .panel-content -->

</article><!-- #post-<?php the_ID(); ?> -->