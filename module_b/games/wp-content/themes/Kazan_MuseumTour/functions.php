<?php

add_action('login_enqueue_scripts', function() {
    wp_enqueue_style('login-custom-style', get_stylesheet_directory_uri().'/css/login.css');
});

add_action('init', function() {
    $post = get_post_type_object('post');
    foreach ($post->labels as $key => $value) {
        $value = str_replace('Post', 'News Post', $value);
        $value = str_replace('post', 'news post', $value);
        $post->labels->{$key} = $value;
    }

    $page = get_post_type_object('page');
    foreach ($page->labels as $key => $value) {
        $value = str_replace('Page', 'Museum', $value);
        $value = str_replace('page', 'museum', $value);
        $page->labels->{$key} = $value;
    }
});