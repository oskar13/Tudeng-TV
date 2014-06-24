<?php
/*
Template Name: Toetajad
*/
get_header(); ?>	
	<hr style="background-color: #56FF9D;">
		<div id="toetajad_intro">
			Suured tänud kõigile, kes on meid toetanud sell pikkal aal kui me tegutsenud oleme. Suured tänud veel.	
		</div>
			<div id="supporters" style="max-width: 1075px; margin:auto; display: flex; flex-flow: row wrap; justify-content: space-around;justify-content: flex-end;"><!--PEAB KUIDAGI KESKELE SAAMA -->
				<div id="small_supporters" style="max-width: 1000px; margin:0 auto;">
					
					<?php
					/* Näidis puhtast HTML-ist
					<div class="view fourth-effect">  
  						<a href="#" title="Full Image"><img src="images/logo.png" /></a>  
  						<div class="mask"></div>  
					</div>
					*/
					?>


					<?php
					$queryObject = new WP_Query( 'post_type=toetaja&posts_per_page=999' );
						// The Loop!
							while ($queryObject->have_posts()) {
								$queryObject->the_post();
							?>
								<div class="view fourth-effect"> 

									<a href="<?php echo get_post_meta( get_the_ID(), 'toetaja_link', true ); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'toetaja-image' ); ?><?php the_title(); ?></a>  

									<?php
									/*
									$meta_filed = get_post_meta( get_the_ID(), 'videouudis_toimetaja', true );
									if (!empty($meta_filed)) {
									?>
										<li>Toimetaja: <?php echo get_post_meta( get_the_ID(), 'videouudis_toimetaja', true ); ?> </li>
									<?php
									}
									*/


									?>
								</div>
							
							<?php

							}
					?>


				</div>
			</div>
<?php get_footer(); ?>	