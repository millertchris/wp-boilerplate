<?php

/**
 * Function: get_custom_excerpt
 *
 * This function returns a custom excerpt of a given length for the current post. It takes a 'limit' parameter, which
 * determines the maximum number of words in the excerpt. It first retrieves the full excerpt for the post using the
 * 'get_the_excerpt' function, and then splits it into an array of words using 'explode'. If the number of words in the
 * excerpt is greater than or equal to the limit, the function removes the last word and adds an ellipsis. If the
 * number of words in the excerpt is less than the limit, the function returns the full excerpt. Finally, the function
 * uses 'preg_replace' to remove any shortcodes from the excerpt before returning it.
 *
 * @since 1.0.0
 * @param int $limit - The maximum number of words in the excerpt
 * @return string - A custom excerpt of the given length for the current post
 * @uses get_the_excerpt()
 * @link https://developer.wordpress.org/reference/functions/get_the_excerpt/
 * 
 * @author Chris Miller
 */
function get_custom_excerpt($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt) >= $limit) {
		array_pop($excerpt);
		$excerpt = implode(' ', $excerpt) . '...';
	} else {
		$excerpt = implode(' ', $excerpt);
	}
	$excerpt = preg_replace('`[[^]]*]`', '', $excerpt);
	return $excerpt;
}

/**
 * Function: is_active
 *
 * This function checks if FacetWP plugin is active on the site. It uses the 'function_exists' function to check if the
 * 'facetwp_display' function is available. If it is available, the function returns true. Otherwise, it returns false.
 *
 * @since 1.0.0
 * @return bool - True if FacetWP is active, false otherwise
 * @uses function_exists()
 * 
 * @author Chris Miller
 */
function is_active() {
	if (function_exists('facetwp_display')) {
		return true;
	}
	return false;
}

/**
 * Function: acf_activated
 *
 * This function checks if Advanced Custom Fields (ACF) plugin is active on the site. It uses the 'class_exists'
 * function to check if the 'ACF' class is available. If it is available, the function returns true. Otherwise, it
 * returns false.
 *
 * @since 1.0.0
 * @return bool - True if ACF is active, false otherwise
 * @uses class_exists()
 * 
 * @author Chris Miller
 */
function acf_activated() {
	if (class_exists('ACF')) {
		return true;
	}
	return false;
}


/**
 * Function: get_custom_date
 *
 * This function accepts a date string in a specified format and converts it to another format. It uses the PHP DateTime
 * class to create a new DateTime object and the 'createFromFormat' method to parse the input date string using the specified
 * format. The new format is then applied using the 'format' method and the resulting string is returned.
 *
 * @since 1.0.0
 * @param string $date - The date string to be formatted
 * @param string $old_format - The format of the input date string
 * @param string $new_format - The format to which the date string should be converted
 * @return string - The formatted date string
 * @link https://www.php.net/manual/en/datetime.createfromformat.php
 * 
 * @author Chris Miller
 */
function get_custom_date($date, $old_format, $new_format) {
	// Setup new object.
	$datetime = new DateTime();
	// Pass both the expected format that matches the date format.
	$newDate = $datetime->createFromFormat($old_format, $date);
	// Return a new format
	return $newDate->format($new_format);
};

/**
 * Function: get_custom_time
 *
 * This function accepts a time string in a specified format and converts it to another format. It uses the PHP
 * DateTime class to create a new DateTime object and the 'createFromFormat' method to parse the input time string
 * using the specified format. The new format is then applied using the 'format' method and the resulting string
 * is returned.
 *
 * @since 1.0.0
 * @param string $time - The time string to be formatted
 * @param string $old_format - The format of the input time string
 * @param string $new_format - The format to which the time string should be converted
 * @return string - The formatted time string
 * @link https://www.php.net/manual/en/datetime.createfromformat.php
 * 
 * @author Chris Miller
 */
function get_custom_time($time, $old_format, $new_format) {
	// Setup new object.
	$datetime = new DateTime();
	// Pass both the expected format that matches the time format.
	$newDate = $datetime->createFromFormat($old_format, $time);
	// Return a new format
	return $newDate->format($new_format);
};

/**
 * Retrieve a CSS class based on the value of an ACF field.
 *
 * This function concatenates the value of an ACF field called 'margin_bottom'
 * into a string variable, which is then returned as a CSS class that can be
 * used to apply a margin to an HTML element.
 *
 * @return string The CSS class containing the margin-bottom value.
 * 
 * @author Chris Miller
 */
function setting_classes() {
	$classes = '';

	if (get_field('layout')) {
		$classes .= ' ' . get_field('layout');
	}

	if (get_field('collapse_margin')) {
		$classes .= ' mb-collapse';
	}

	$classes .= ' ' . get_field('margin_top');
	$classes .= ' ' . get_field('margin_bottom');
	$classes .= ' ' . get_field('padding_top');
	$classes .= ' ' . get_field('padding_bottom');

	return $classes;
}

/**
 * Generates an HTML image tag with the preview image of a block.
 *
 * @param array $block The block data array.
 * @return string The HTML image tag.
 * 
 * @author Chris Miller
 */
function block_preview($block) {
	// Get the directory path of the current template.
	$directory_path = get_template_directory_uri() . "/blocks/" . basename($block['path']);

	// Get the preview image filename from the block data.
	$preview_image_filename = $block['example']['attributes']['data']['preview_image_help'];

	// Generate the image tag with the preview image source.
	$preview_image = "<img src=\"$directory_path/$preview_image_filename\">";

	echo $preview_image;
}

/**
 * Checks if a block has a preview image.
 *
 * @param array $block The block data array.
 * @return bool Returns true if the block has a preview image, false otherwise.
 * 
 * @author Chris Miller
 */
function block_preview_image($block) {
	// Check if the block data array contains the preview_image_help key.
	return isset($block['data']['preview_image_help']);
}

/**
 * Outputs the background image of a block as an HTML image tag with a specified size.
 *
 * @param string $size The image size to retrieve. Default is 'full'.
 * @return void
 * 
 * @author Chris Miller
 */
function block_background($size = 'full') {
	$attachment_id = get_field('background');
	$background = wp_get_attachment_image($attachment_id, $size);
	if ($background) {
		echo $background;
	}
	return;
}

/**
 * Outputs the image of a block as an HTML image tag with a specified size.
 *
 * @param string $size The image size to retrieve. Default is 'full'.
 * @return void
 * 
 * @author Chris Miller
 */
function block_image($size = 'full') {
	$attachment_id = get_field('image');
	$image = wp_get_attachment_image($attachment_id, $size);
	if ($image) {
		echo $image;
	}
	return;
}

/**
 * Generates an HTML anchor tag with a button link if the button data is provided.
 *
 * @return void
 * 
 * @author Chris Miller
 */
function block_link() {
	$link = get_field('link');

	if ($link) {
		$url = esc_url($link['url']);
		$target = esc_attr($link['target']);
		$title = esc_html($link['title']);
		echo "<a href=\"$url\" target=\"$target\">$title</a>";
	}

	return;
}

/**
 * Outputs the title of a block as an H1 tag with a "title" class.
 *
 * @param string $default_title The default title to use if the block title is not provided. Default is 'Your title here...'.
 * @return void
 * 
 * @author Chris Miller
 */
function block_title($default_title = 'Your title here...') {
	$title = get_field('title');
	if ($title) {
		$output = '<h1 class="title">' . ($title ? $title : $default_title) . '</h1>';
		echo $output;
	}

	return;
}

/**
 * Outputs the headline of a block as an H2 tag with a "headline" class.
 *
 * @param string $default_headline The default headline to use if the block headline is not provided. Default is 'Your headline here...'.
 * @return void
 * 
 * @author Chris Miller
 */
function block_headline($default_headline = 'Your headline here...') {
	$headline = get_field('headline');
	if ($headline) {
		$output = '<h2 class="headline">' . ($headline ? $headline : $default_headline) . '</h2>';
		echo $output;
	}

	return;
}

/**
 * Outputs the content of a block.
 *
 * @param string $default_content The default content to use if the block content is not provided. Default is 'Your content here...'.
 * @return void
 * 
 * @author Chris Miller
 */
function block_content($default_content = 'Your content here...') {
	$content = get_field('content');
	if ($content) {
		echo $content ? $content : $default_content;
	}

	return;
}

/**
 * Determines if all fields in a block are empty or null.
 *
 * @return bool Returns true if all fields in the block are empty or null, false otherwise.
 * 
 * @author Chris Miller
 */
function block_is_empty() {
	$data = '';
	$data .= have_rows('accordions');
	$data .= have_rows('cards');
	$data .= have_rows('carousel');
	$data .= have_rows('features');
	$data .= get_field('gallery');
	$data .= get_field('listing');
	$data .= have_rows('slider');
	$data .= have_rows('stats');
	$data .= have_rows('testimonials');

	$data .= get_field('column_1');
	$data .= get_field('title');
	$data .= get_field('headline');
	$data .= get_field('content');
	$data .= get_field('image');
	$data .= get_field('background');
	$data .= get_field('button');
	$data .= get_field('link');

	if ($data) {
		return false;
	}

	return true;
}

/**
 * Displays accordions with a title and content wrapped in HTML tags.
 * 
 * @author Chris Miller
 */
function the_accordions() {
	if (have_rows('accordions')) {
		while (have_rows('accordions')) {
			the_row();
			echo '<div class="accordion">';
			echo '<h2 class="title">' . get_sub_field('title') . '</h2>';
			echo '<div class="content">' . get_sub_field('content') . '</div>';
			echo '</div>';
		}
	}

	return;
}

/**
 * Displays three columns of data, each wrapped in a div tag with a class of "col".
 * 
 * @author Chris Miller
 */
function the_basic_content() {
	if (get_field('column_1')) {
		echo '<div class="col">' . get_field('column_1') . '</div>';
	}
	if (get_field('column_2')) {
		echo '<div class="col">' . get_field('column_2') . '</div>';
	}
	if (get_field('column_3')) {
		echo '<div class="col">' . get_field('column_3') . '</div>';
	}

	return;
}

/**
 * Displays cards with a title and content wrapped in HTML tags.
 * 
 * @author Chris Miller
 */
function the_cards() {
	if (have_rows('cards')) {
		while (have_rows('cards')) {
			the_row();
			echo '<div class="card">';
			echo '<h2 class="title">' . get_sub_field('title') . '</h2>';
			echo '<div class="content">' . get_sub_field('content') . '</div>';
			echo '</div>';
		}
	}

	return;
}

/**
 * Displays items in a carousel with a title and content wrapped in HTML tags.
 * 
 * @author Chris Miller
 */
function the_carousel() {
	if (have_rows('carousel')) {
		while (have_rows('carousel')) {
			the_row();
			echo '<div class="item">';
			echo '<h2 class="title">' . get_sub_field('title') . '</h2>';
			echo '<div class="content">' . get_sub_field('content') . '</div>';
			echo '</div>';
		}
	}

	return;
}

/**
 * Displays features with a title and content wrapped in HTML tags.
 * 
 * @author Chris Miller
 */
function display_features() {
	if (have_rows('features')) {
		while (have_rows('features')) {
			the_row();
			echo '<div class="feature">';
			echo '<h2 class="title">' . get_sub_field('title') . '</h2>';
			echo '<div class="content">' . get_sub_field('content') . '</div>';
			echo '</div>';
		}
	}

	return;
}

/**
 * Displays a gallery with each image wrapped in a div tag with a class of "item".
 * 
 * @author Chris Miller
 */
function the_gallery() {
	$gallery_ids = get_field('gallery');
	$size = 'full';

	if ($gallery_ids) {
		echo '<div class="items">';
		foreach ($gallery_ids as $gallery_id) {
			echo '<div class="item">';
			echo wp_get_attachment_image($gallery_id, $size);
			echo '</div>';
		}
		echo '</div>';
	}

	return;
}

/**
 * Displays a listing of posts with each post wrapped in a div tag with a class of "item".
 * 
 * @author Chris Miller
 */
function the_listing() {
	$listing = get_field('listing');
	if ($listing) {
		echo '<div class="items">';
		foreach ($listing as $post) {
			setup_postdata($post);
			echo '<div class="item">';
			echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
			echo '</div>';
		}
		wp_reset_postdata();
		echo '</div>';
	}

	return;
}

/**
 * Displays a slider with each slide wrapped in a div tag with a class of "slide".
 * 
 * @author Chris Miller
 */
function the_slider() {
	if (have_rows('slider')) {
		echo '<div class="slider">';
		while (have_rows('slider')) {
			the_row();
			echo '<div class="slide">';
			echo '<h2 class="title">' . get_sub_field('title') . '</h2>';
			echo '<div class="content">' . get_sub_field('content') . '</div>';
			$link = get_sub_field('link');
			if ($link) {
				echo '<a href="' . esc_url($link['url']) . '" target="' . esc_attr($link['target']) . '">' . esc_html($link['title']) . '</a>';
			}
			$image = get_sub_field('image');
			$size = 'full';
			if ($image) {
				echo wp_get_attachment_image($image, $size);
			}
			echo '</div>';
		}
		echo '</div>';
	}

	return;
}

/**
 * Displays stats with a title and content wrapped in HTML tags.
 * 
 * @author Chris Miller
 */
function the_stats() {
	if (have_rows('stats')) {
		echo '<div class="stats">';
		while (have_rows('stats')) {
			the_row();
			echo '<div class="stat">';
			echo '<h2 class="title">' . get_sub_field('title') . '</h2>';
			echo '<div class="content">' . get_sub_field('content') . '</div>';
			echo '</div>';
		}
		echo '</div>';
	}

	return;
}

/**
 * Displays testimonials with content, name, title, and company wrapped in HTML tags.
 * 
 * @author Chris Miller
 */
function the_testimonials() {
	if (have_rows('testimonials')) {
		echo '<div class="testimonials">';
		while (have_rows('testimonials')) {
			the_row();
			echo '<div class="testimonial">';
			echo '<div class="content">' . get_sub_field('content') . '</div>';
			echo '<div class="details">';
			echo '<p class="name">' . get_sub_field('name') . '</p>';
			echo '<p class="title">' . get_sub_field('title') . '</p>';
			echo '<p class="company">' . get_sub_field('company') . '</p>';
			echo '</div>';
			echo '</div>';
		}
		echo '</div>';
	}

	return;
}
