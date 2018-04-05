<?php
/**
 * Template Name: Work Examples
 */

$context = Timber::get_context();
$post = Timber::get_post($post->ID, 'Content\Post');

$context['post'] = $post;
$context['open_graph'] = $post->get_open_graph_data();

// Get work examples terms
$context['work_sample_types'] = Timber::get_terms(array(
	'taxonomy' => 'work-sample-type',
	'hide_empty' => true,
	'count' => -1
));

Timber::render( array( 'page-' . $post->post_name . '.twig', 'page.twig' ), $context );