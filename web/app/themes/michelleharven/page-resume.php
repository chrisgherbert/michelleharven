<?php
/**
 *  Template Name: Resume Page
 */

$context = Timber::get_context();
$post = Timber::get_post($post->ID, 'Content\Post');

$context['post'] = $post;

Timber::render( 'page-resume.twig', $context, false, TimberLoader::CACHE_NONE );
