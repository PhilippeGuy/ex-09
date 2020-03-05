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
		    echo '<h1>Évènements</h1><div id="evenements">';
            /* The 3 Query (without global var) */
            $args3 = array(
                "posts_per_page" => 9,
                "category_name" => "évènements",
            );
            $query3 = new WP_Query( $args3 );
        
            // The 3nd Loop
            while ( $query3->have_posts() ) {
                $query3->the_post();
                $j = get_the_date('d');
                $m = get_the_date('m');
                $m%=3+1;
                echo '<p class="evenement" style="grid-area: '. $j .' / '. $m .' / '. ($j+1) .' / '. ($m+1) .'">'.
                        '<b><a href="'.get_permalink().'">' . get_the_title() .'</a></b>'.
                        get_the_date('d m Y').' '. $j .' / '. $m .' / '. ($j+1) .' / '. ($m+1) .'</p>';
            }
        
            echo '</div>';
            // Restore original Post Data
            wp_reset_postdata();
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
