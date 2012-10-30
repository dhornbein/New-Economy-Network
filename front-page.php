<?php
/**
 * The front page template file.
 *
 * @package NeN
 * @since NeN 1.0
 */

get_header(); ?>
		<div id="front-page" class="content-area">
			<div id="content" class="site-content" role="main">

				<section class="m-stage">
		      <div class="row">
		        <div id="slider">
							<?php if ( have_posts() ) : ?>

								<?php while ( have_posts() ) : the_post(); ?>

									<?php get_template_part( 'slider', 'page' ); 

									?>

								<?php endwhile; ?>

							<?php endif; ?>
		        </div>
		      </div>
				</section>
				
				<section id="getinvolved">
					<hr class="space">
					<div class="row collapse">
				    <div class="six column">
				      <h1 class="c-red huge">Get Involved</h1>
				    </div>
				    <div class="six column">
				      <form action="">
				      	<div class="row collapse">
				      	  <h4 class="c-red c-dark bold collapse">Join Our Newsletter</h4>
				      	  <div class="eight mobile-three columns">
				      	    <input type="text">
				      	  </div>
				      	  <div class="four mobile-one columns">
				      	    <input type="submit" class="btn alert expand postfix" value="Submit">
				      	  </div>
				      	</div>
				      </form>
				    </div>
				  </div>
				  <div class="row">

						<?php 
							$menu_name = 'get_involved';

						  if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
								$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

								$menu_item_count = $menu->count;

								$menu_items = wp_get_nav_menu_items($menu->term_id);

								$menu_classes = array( 'btn-group', 'even' );

								switch ($menu_item_count) {
									case 1:
										$menu_classes[] = 'one-up';
										break;
									
									case 2:
										$menu_classes[] = 'two-up';
										break;
									
									case 3:
										$menu_classes[] = 'three-up';
										break;
									
									case 4:
										$menu_classes[] = 'four-up';
										break;
									
									default:
										$menu_classes[] = 'one-up';
										break;
								}

								$menu_classes = join( ' ' , apply_filters( 'nav_menu_css_class' , array_filter( $menu_classes ), $menu ) );

								$menu_list = '<ul id="menu-' . $menu_name . '" class="' . $menu_classes . '">';

								foreach ( (array) $menu_items as $key => $menu_item )
								{
								    $title = $menu_item->title;
								    $url = $menu_item->url;
								    $classes = ( ! $menu_item->classes ) ? array () : (array) $menu_item->classes;
								    //default classes
								    if ( ! empty ( $menu_item->description ) )
								    {
								    	$classes[] = 'has-tip';
								    	$description = strip_tags( $menu_item->description ) ;
								    }
								    
								    array_push( $classes, "btn", "large" );
								    $classes = join( ' ' , apply_filters( 'nav_menu_css_class' , array_filter( $classes ), $menu ) );

								    $menu_list .= '<li><a href="' . $url . '" class="' . $classes . '" title="' . $description . '">' . $title . '</a></li>';
								}
								$menu_list .= '</ul>';
					    }

					    //print menu
					    echo $menu_list;
						?>
					</div>
				</section>

				<section id="about" role="inner-page">
				  <div class="row">
				    <div class="eight column">
					    <h1 class="c-green">What is the New Economy?</h1>
				    	<?php $about_id=989; $about_post = get_page($about_id); echo apply_filters('the_content', $about_post->post_content);  ?>
						  <div class="row">
					      <a class="btn" href="<?php echo get_permalink( $about_id ) ?>">
					        <span class="h4">Learn More</span>
					      </a>
					      <a class="btn secondary" href="#getinvolved">
					        <span class="h4">Get Involved</span>
					      </a>
						  </div>
				    </div>

						<div class="four column">
							<?php do_action( 'before_sidebar' ); ?>
							<?php if ( ! dynamic_sidebar( 'home-sidebar' ) ) : ?>

								<aside id="search" class="widget widget_search">
									<?php get_search_form(); ?>
								</aside>

								<aside id="archives" class="widget">
									<h1 class="widget-title"><?php _e( 'Archives', 'nen' ); ?></h1>
									<ul>
										<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
									</ul>
								</aside>

								<aside id="meta" class="widget">
									<h1 class="widget-title"><?php _e( 'Meta', 'nen' ); ?></h1>
									<ul>
										<?php wp_register(); ?>
										<li><?php wp_loginout(); ?></li>
										<?php wp_meta(); ?>
									</ul>
								</aside>

							<?php endif; // end sidebar widget area ?>
						</div>

				  </div>

				</section>

				<section id="blog" role="inner-page">
					<div class="row">
						<h1><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Blog' ) ) ); ?>">Blog</a></h1>
						<div class="eight column m-loop">
							<?php query_posts( 'posts_per_page=12' ); $i = 0 ?>
			        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); $i++ ?>

			        				<article class="lp-post row collapse">
				                <div class="lp-date"><small><?php the_time("F jS, Y"); ?></small></div>
		        						<h4 class="lp-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		        						<?php if($i <= 3) : ?>
				                <div class="lp-content"><?php the_content(); ?></div>
					              <?php else : ?>
				                <div class="lp-excerpt"><?php the_excerpt(); ?></div>
				              	<?php endif; ?>
			        				</article>

			        <?php endwhile; ?>

			        <div class="row text-center"><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Blog' ) ) ); ?>">Read More&hellip;</a></div>

			        <?php else: ?> 
			                <p><small>Nothing here, check back later</small></p>
			        <?php endif; ?>
						</div>
						<div class="four column">
							<div class="panel">
								<h2>The Network</h2>
								<p>
									Lorem <span class="has-tip" title="this is a test">ipsum</span> dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
									quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
									consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
									cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
									proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
								</p>
							</div>
						</div>
					</div>
				</section>

			</div><!-- #content .site-content -->
		</div><!-- #front-page .content-area -->

<?php get_footer(); ?>