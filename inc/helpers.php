<?php
//======================================================================
// These are functions that are used throughout the theme’s template
// files to help make the code more readable, and to abstract some of 
// the core WordPress logic out of template files.
//======================================================================

//======================================================================
// CUSTOM EXCERPT
//======================================================================
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

//======================================================================
// CHECK IF FACET WP IS ACTIVE
//======================================================================
function is_active() {
	if (function_exists('facetwp_display')) {
		return true;
	}
	return false;
}

//======================================================================
// CHECK IF ACF IS ACTIVE
//======================================================================
function acf_activated() {
	if (class_exists('ACF')) {
		return true;
	}
	return false;
}

//======================================================================
// ACF Responsive Image
//======================================================================
function acf_responsive_image($image_id, $image_size, $max_width) {

	// check the image ID is not blank
	if ($image_id != '') {

		// set the default src image size
		$image_src = wp_get_attachment_image_url($image_id, $image_size);

		// set the srcset with various image sizes
		$image_srcset = wp_get_attachment_image_srcset($image_id, $image_size);

		// generate the markup for the responsive image
		echo 'src="' . $image_src . '" srcset="' . $image_srcset . '" sizes="(max-width: ' . $max_width . ') 100vw, ' . $max_width . '"';
	}
}

//======================================================================
// RETURNS AN ORDERED LIST OF PARENT/CHILD PAGES
//======================================================================
function get_table_of_contents($post_type) {
	global $post;
	$parent_id = $post->ID;

	if ($post->post_parent) {
		$parent_id = $post->post_parent;
	}

	$args = array(
		'post_parent' => $parent_id,
		'post_type' => $post_type,
		'posts_per_page' => '-1',
		'orderby' => ['menu_order' => 'ASC']
	);

	$parent = get_post($parent_id);
	$children = get_children($args);
	$children_ids = [];

	$table_of_contents = [$parent];

	foreach ($children as $key => $value) {
		array_push($table_of_contents, $value);
	}
	return $table_of_contents;
}

//======================================================================
// RETURNS THE PREVIOUS AND NEXT POSTS BASED ON TABLE OF CONTENTS
//======================================================================
function get_table_of_contents_nav($post_type) {
	global $post;
	$post->ID;

	$table_of_contents = table_of_contents($post_type);

	foreach ($table_of_contents as $key => $value) {
		if ($value->menu_order == $post->menu_order) {

			$current_key = $key;
			$next_item = $current_key;
			$previous_item = $current_key;

			if ($current_key === 0) {
				$nav = [
					'previous' => null,
					'next' => $table_of_contents[++$next_item]->ID
				];
			} elseif (array_key_last($table_of_contents) == $current_key) {
				$nav = [
					'previous' => $table_of_contents[--$previous_item]->ID,
					'next' => null
				];
			} else {
				$nav = [
					'previous' => $table_of_contents[--$previous_item]->ID,
					'next' => $table_of_contents[++$next_item]->ID
				];
			}
			return $nav;
		}
	}

	return null;
}

//======================================================================
// CHECK TO SEE IF THE PAGE HAS CHILDREN
//======================================================================
function has_children() {
	global $post;
	return count(get_posts(array('post_parent' => $post->ID, 'post_type' => $post->post_type)));
}

//======================================================================
// RETURN TERMS. COMMA SEPERATED
//======================================================================
function get_term_names($post_id, $tax) {
	$terms = get_the_terms($post_id, $tax);

	if ($terms) {

		$term_names = [];
		foreach ($terms as $term) {
			array_push($term_names, $term->name);
		};

		$tax_list = implode(', ', $term_names);

		return $tax_list;
	} else {
		return 'no ' . $tax . ' found';
	}
};

//======================================================================
// DISPLAY A LIST OF TERMS
//======================================================================
function the_term_list($post_id, $tax) {
	$terms = get_the_terms($post_id, $tax);
	$term_names = [];
	foreach ($terms as $term) {
		array_push($term_names, $term->name);
	};
	$tax_list = implode(',&nbsp;</li><li>', $term_names);

	echo '<li>' . $tax_list . '</li>';
};

//======================================================================
// RETURN A FORMATED DATE
// https://www.php.net/manual/en/datetime.createfromformat.php
//======================================================================
function get_custom_date($date, $old_format, $new_format) {
	// Setup new object.
	$datetime = new DateTime();
	// Pass both the expected format that matches the date format.
	$newDate = $datetime->createFromFormat($old_format, $date);
	// Return a new format
	return $newDate->format($new_format);
};

//======================================================================
// RETURN A FORMATED TIME
// https://www.php.net/manual/en/datetime.createfromformat.php
//======================================================================
function get_custom_time($time, $old_format, $new_format) {
	// Setup new object.
	$datetime = new DateTime();
	// Pass both the expected format that matches the time format.
	$newDate = $datetime->createFromFormat($old_format, $time);
	// Return a new format
	return $newDate->format($new_format);
};
