<?php
function breadcrumbs() {
    global $options;
    $options = get_option( 'gamiphy_settings' );
	$link_EOS = '<a href="';
	$link_CON = '">';
	$link_EOF = '</a>';	
	$sep = " » "; # important to put it between two spaces
	$homelink = $link_EOS . get_bloginfo('url') . $link_CON . 'Home'  . $link_EOF;
	global $post;
	$post_slug=$post->post_name;
	
	# Category archive
	if (is_category()) {
		echo $homelink . $sep; single_cat_title();
	}
	# Tag archive
	elseif (is_tag()) {
		echo $homelink . $sep; single_tag_title();
	}
	# Daily archive
	elseif (is_day()) {
		echo $homelink . $sep . "Archives for"; the_time('F jS, Y');
	}
	# Monthly archive
	elseif (is_month()) {
		echo $homelink . $sep . "Archives for"; the_time('F, Y');
	}
	# Yearly archive
	elseif (is_year()) {
		echo $homelink . $sep . "Archives for "; the_time('Y');
	}
	# Author archive
	elseif (is_author()) {
		echo $homelink . $sep . "Archives "; is_author();
	}
	# Paged archive
	elseif (is_paged()) {
		echo $homelink . $sep . "Archives of the blog";
	}
	# Single post
	// elseif (is_single()) {
	// 	echo $homelink . $sep;
	// 	the_category('title_li=');
	// 	echo $sep;
	// 	the_title();
	// }
	elseif (is_single()) {
		echo $homelink . $sep;
		echo '<a href="'.$options["blog_page_url"].'">Blog</a>';
		echo $sep;
		the_title();
	}
	
	# Single page
	elseif (is_page()) {
		echo $homelink . $sep;
		if ( $post->post_parent != 0) {
			echo $link_EOS . get_page_link($post->post_parent) . $link_CON . $post_slug . $link_EOF . $sep;
		}
		// echo the_title();
		echo $post_slug ;		
	} else {}
}