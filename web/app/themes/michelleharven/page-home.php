<?php
/**
 *  Template Name: Home Page
 */

$context = Timber::get_context();
$post = Timber::get_post($post->ID, 'Content\Post');

$context['post'] = $post;

// Set special OG tags for the home page
$context['open_graph'] = array(
	array(
		'key' => 'og:title',
		'value' => get_option('blogname'),
	),
	array(
		'key' => 'og:url',
		'value' => get_option('home'),
	),
	array(
		'key' => 'og:description',
		'value' => get_option('blogdescription'),
	),
);

Timber::render( 'page-home.twig', $context, false, TimberLoader::CACHE_NONE );
