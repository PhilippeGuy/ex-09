<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package underscore
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.

		endwhile; // End of the loop.

        echo '<h1>Conférences</h1>';
        // The Query
        $args = array(
            "category_name" => "conferences",
            "posts_per_page" => 4,
            'orderby' => 'title',
            'order'   => 'DESC'
        );
        $query1 = new WP_Query( $args );

        // The Loop
        while ( $query1->have_posts() ) {
            $query1->the_post();
            echo '<div class="articleGauche"><span>' .get_the_post_thumbnail().'</span>';
            echo '<div><h4><a href="'.get_permalink().'">' . get_the_title() .' '.get_the_date(). '</a></h4>';
            echo '<p>'.get_the_excerpt().'</p></div></div>';
        }

        /* Restore original Post Data 
         * NB: Because we are using new WP_Query we aren't stomping on the 
         * original $wp_query and it does not need to be reset with 
         * wp_reset_query(). We just need to set the post data back up with
         * wp_reset_postdata().
         */
        wp_reset_postdata();

        echo '<h1>Nouvelles</h1>
              <div class="nouvelles">';
        // The 2nd Query
        $args2 = array(
            "posts_per_page" => 4,
            "category_name" => "nouvelles",
            'orderby' => 'title',
            'order'   => 'DESC'
        );
        $query2 = new WP_Query( $args2 );

        // The 2nd Loop
        while ( $query2->have_posts() ) {
            $query2->the_post();
            echo '<div class="articleCentre"><h4><a href="'.get_permalink().'">' . get_the_title() .'</a></h4>';
            echo '<span>' .get_the_post_thumbnail().'</span></div>';
        }
        echo '</div>';

        /* Restore original Post Data 
         * NB: Because we are using new WP_Query we aren't stomping on the 
         * original $wp_query and it does not need to be reset with 
         * wp_reset_query(). We just need to set the post data back up with
         * wp_reset_postdata().
         */
        wp_reset_postdata();

        echo '<h1>Évènements</h1>';
        /* The 3 Query (without global var) */
        $args3 = array(
            "posts_per_page" => 4,
            "category_name" => "évènements",
        );
        $query3 = new WP_Query( $args3 );

        // The 3nd Loop
        while ( $query3->have_posts() ) {
            $query3->the_post();
            echo '<span>' .get_the_post_thumbnail().'</span>';
            echo '<h4><a href="'.get_permalink().'">' . get_the_title() .' '.get_the_date(). '</a></h4>'; 
        }

        // Restore original Post Data
        wp_reset_postdata();

        ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();