<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package tinfoilcat
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta"> <!-- posted on, date, posted by -->
			<?php tinfoilcat_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">   <!--displays the content-->
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'tinfoilcat' ),
				'after'  => '</div>',
			) );
		?>  <!-- links to additional pages if the page is paginated -->
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php tinfoilcat_entry_footer(); ?> <!--shows meta data posted in and list categories tags and edit link -->
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
