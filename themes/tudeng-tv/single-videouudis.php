
			<?php get_header(); ?>	


			<hr style="background-color:#11A9A7">
			<div id="news_border">
				<div id="news_news">
					<?php
					/*$queryObject = new WP_Query( 'post_type=videouudis&posts_per_page=1' );
						// The Loop!
							if ($queryObject->have_posts()) {
								$queryObject->the_post();*/
								if (have_posts()) : while (have_posts()) : the_post();
							?>

								<h3><?php the_title(); ?></h3>


<?php


$result = end(explode('=', get_post_meta( get_the_ID(), 'videouudis_link', true )));

?>




<div class="" id="ytplayer"></div>

<script>
  // Load the IFrame Player API code asynchronously.
  var tag = document.createElement('script');
  tag.src = "https://www.youtube.com/player_api";
  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

  // Replace the 'ytplayer' element with an <iframe> and
  // YouTube player after the API code downloads.
  var player;
  function onYouTubePlayerAPIReady() {
    player = new YT.Player('ytplayer', {
      height: '450',
      width: '800',
      videoId: '<?php echo $result; ?>'
    });
  }
</script>




								<?php the_content(); ?>
								<ul>
									<?php
									$meta_filed = get_post_meta( get_the_ID(), 'videouudis_toimetaja', true );
									if (!empty($meta_filed)) {
									?>
										<li>Toimetaja: <?php echo get_post_meta( get_the_ID(), 'videouudis_toimetaja', true ); ?> </li>
									<?php
									}

									$meta_filed = get_post_meta( get_the_ID(), 'videouudis_reporter', true );
									if (!empty($meta_filed)) {
									?>
										<li>Reporter: <?php echo get_post_meta( get_the_ID(), 'videouudis_reporter', true ); ?> </li>
									<?php
									}

									$meta_filed = get_post_meta( get_the_ID(), 'videouudis_operaator', true );
									if (!empty($meta_filed)) {
									?>
										<li>Operaator <?php echo get_post_meta( get_the_ID(), 'videouudis_operaator', true ); ?> </li>
									<?php
									}

									$meta_filed = get_post_meta( get_the_ID(), 'videouudis_monteeria', true );
									if (!empty($meta_filed)) {
									?>
										<li>Monteeria <?php echo get_post_meta( get_the_ID(), 'videouudis_monteeria', true ); ?> </li>
									<?php
									}
									?>
								</ul>
							
							<?php
							endwhile; endif;
							/*} else {
								echo "Ühtegi videouudist ei leitud!";
							}*/
							?>


				</div>
			</div>

				<?php if ( dynamic_sidebar('viimati_lisatud_vid') ) : else : endif; ?>

<!--
				<div id="news_clips" class="clips">
					<p>Viimati lisatud</p>
					<span>Video 1</span>
					<span>Video 2</span>
					<span>Video ...</span>
					<a href="arhiiv.php"><img class="arrow" src="images/arrow.png"></a>
				</div>
				<div id="news_clips" class="clips">
					<p>Populaarsed</p>
					<span>Video 1</span>
					<span>Video 2</span>
					<span>Video ...</span>
					<a href="arhiiv.php"><img class="arrow" src="images/arrow.png"></a>
				</div>
				<div id="news_text" class="clips">
					<p>Tekstuudised</p>
					<span>Pilt 1</span>
					<span>Pilt 2</span>
					<span>Pilt ...</span>
					<a href="arhiiv.php"><img class="arrow" src="images/arrow.png"></a>
				</div>	
-->


		<?php get_footer(); ?>	