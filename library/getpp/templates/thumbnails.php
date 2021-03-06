<?php

require_once('utils/utils.php');

/**
 * This template shows thumbnails with titles per http://getbootstrap.com/components/#thumbnails
 * @param  [type] $posts the posts returned by WordPress
 * @param  [type] $args the original arguments specified in the shortcode
 * @return [type] returns the html output
 */
function getpp_template_thumbnails($posts, $args){
	$output = '';
	$format = '<div class="col-xs-6 col-md-3"><a class="thumbnail" href="%2$s">%3$s<div class="text-center">%1$s</div></a></div>';
	global $post;
	$urlid = get_the_ID();
	foreach( $posts as $post ) : setup_postdata($post); 
		if(getpp_depth_permitted($args['depth'],getpp_depth($urlid,$post->ID))){
			$excerpt = get_the_excerpt();
			$vars['title'] = $post->post_title;
			$vars['href'] = get_permalink($post->ID);
			$vars['img'] = get_the_post_thumbnail($post->ID, 'thumbnail', array('alt'	=> $excerpt,'title'=> $vars['title']));
			$output .= vsprintf($format,$vars);
		}
	endforeach; wp_reset_postdata();
	return '<div class="row">' . $output . '</div>';
}
add_filter('getpp_template_thumbnails','getpp_template_thumbnails',10,2); 
