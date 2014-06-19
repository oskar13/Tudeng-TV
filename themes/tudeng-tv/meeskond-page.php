<?php
/*
Template Name: Meeskond
*/
get_header(); ?>
	<hr style="background-color: #FF93B4;">

	<h1>Siia tuleb korralik html/CSS mis kuvab meekonna liikmeid:</h1>

	<ul>
		<?php
		$queryObject = new WP_Query( 'post_type=meeskond&posts_per_page=999' );
		// The Loop!
			while ($queryObject->have_posts()) {
				$queryObject->the_post();
		?>





			<a class="popup-with-zoom-anim" href="#small-dialog-<?php echo get_the_ID(); ?>" ><?php the_post_thumbnail( 'liige-image' ); ?></a>


			<div id="small-dialog-<?php echo get_the_ID(); ?>" class="zoom-anim-dialog mfp-hide">
				<?php the_post_thumbnail( 'liige-image' ); ?>

				<div class="about-text">
					<h3><?php the_title(); ?></h3>
					
					<ul>
						<?php
						
						$meta_filed = get_post_meta( get_the_ID(), 'meeskond_link', true );
						if (!empty($meta_filed) ) {
						?>
							<li>Meeskonna liikme link: <?php echo $meta_filed; ?> </li>
						<?php
						}

						$meta_filed = get_post_meta( get_the_ID(), 'meeskond_jobs', true );
						if (!empty($meta_filed)) {
						?>
							<li>Töökohad: <?php echo $meta_filed; ?> </li>
						<?php
						}

						$meta_filed = get_post_meta( get_the_ID(), 'meeskond_desc', true );
						if (!empty($meta_filed)) {
						?>
							<li>Liikme kirjeldus: <?php echo $meta_filed; ?> </li>
						<?php
						}
						?>
					</ul>
					
				</div>
			</div>



		<?php
			}
		?>
	</ul>


<?php
/* Example HTML
<h3>Dialog with CSS animation</h3>
<p>Animations are added with simple CSS transitions, you can make them look however you wish.<br/>More <a href="http://codepen.io/dimsemenov/pen/GAIkt">animation effects on CodePen</a>.</p>
<div class="html-code">
	<a class="popup-with-zoom-anim" href="#small-dialog" >Open with fade-zoom animation</a><br/>

	<!-- dialog itself, mfp-hide class is required to make dialog hidden -->
	<div id="small-dialog" class="zoom-anim-dialog mfp-hide">
		<h1>Dialog example</h1>
		<p>This is dummy copy. It is not meant to be read. It has been placed here solely to demonstrate the look and feel of finished, typeset text. Only for show. He who searches for meaning here will be sorely disappointed.</p>
	</div>
</div>
*/?>

<?php get_footer(); ?>	



<script type="text/javascript">
	$(document).ready(function() {
		$('.popup-with-zoom-anim').magnificPopup({
			type: 'inline',

			fixedContentPos: false,
			fixedBgPos: true,

			overflowY: 'auto',

			closeBtnInside: true,
			preloader: false,

			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in'
		});
	});
</script>

<style type="text/css">
	/* Styles for dialog window */
	.zoom-anim-dialog {
		padding: 20px 30px;
		text-align: center;
		max-width: 400px;
		margin: 40px auto;
		position: relative;
	}

	.zoom-anim-dialog img {
		margin: 0 auto;
	}

	.zoom-anim-dialog > .about-text {
		background: white;
		border-radius: 5px;
		padding: 10px;
	}


	/**
	* Fade-zoom animation for first dialog
	*/

	/* start state */
	.my-mfp-zoom-in .zoom-anim-dialog {
		opacity: 0;

		-webkit-transition: all 0.2s ease-in-out; 
		-moz-transition: all 0.2s ease-in-out; 
		-o-transition: all 0.2s ease-in-out; 
		transition: all 0.2s ease-in-out; 



		-webkit-transform: scale(0.8); 
		-moz-transform: scale(0.8); 
		-ms-transform: scale(0.8); 
		-o-transform: scale(0.8); 
		transform: scale(0.8); 
	}

	/* animate in */
	.my-mfp-zoom-in.mfp-ready .zoom-anim-dialog {
		opacity: 1;

		-webkit-transform: scale(1); 
		-moz-transform: scale(1); 
		-ms-transform: scale(1); 
		-o-transform: scale(1); 
		transform: scale(1); 
	}

	/* animate out */
	.my-mfp-zoom-in.mfp-removing .zoom-anim-dialog {
		-webkit-transform: scale(0.8); 
		-moz-transform: scale(0.8); 
		-ms-transform: scale(0.8); 
		-o-transform: scale(0.8); 
		transform: scale(0.8); 

		opacity: 0;
	}

	/* Dark overlay, start state */
	.my-mfp-zoom-in.mfp-bg {
		opacity: 0.001; /* Chrome opacity transition bug */
		-webkit-transition: opacity 0.3s ease-out; 
		-moz-transition: opacity 0.3s ease-out; 
		-o-transition: opacity 0.3s ease-out; 
		transition: opacity 0.3s ease-out;
	}
	/* animate in */
	.my-mfp-zoom-in.mfp-ready.mfp-bg {
		opacity: 0.8;
	}
	/* animate out */
	.my-mfp-zoom-in.mfp-removing.mfp-bg {
		opacity: 0;
	}


	.mfp-close-btn-in .mfp-close {
	    color: #FFFFFF;
	}


</style>