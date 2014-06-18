
<?php
/*
Template Name: Meeskond
*/
get_header(); ?>
	<hr style="background-color: #FF93B4;">

	<h1>Siia tuleb korralik html mis kuvab meekonna liikmeid:</h1>

	<ul>
		<?php
		$queryObject = new WP_Query( 'post_type=meeskond&posts_per_page=999' );
		// The Loop!
			while ($queryObject->have_posts()) {
				$queryObject->the_post();
		?>
			<li>Nimi: <?php the_title(); ?></li>

			<li>Pilt: <?php the_post_thumbnail( 'liige-image' ); ?></li>


				<?php
				
				$meta_filed = get_post_meta( get_the_ID(), 'meeskond_link', true );
				if (!empty($meta_filed)) {
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
			</li>
		<?php
			}
		?>
	</ul>
<?php get_footer(); ?>	