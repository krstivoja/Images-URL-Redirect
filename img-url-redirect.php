<?php
/*
Plugin Name: Attachments Redirect Local Images to Live
Description: Redirects local image URLs to the live site.
Version: 1.0
Author: Marko Krstic
*/


add_filter('wp_get_attachment_url', 'replace_attachment_url');
add_filter('wp_calculate_image_srcset', 'replace_srcset_urls', 10, 5);

function replace_attachment_url($url) {
    return replace_local_with_live_url($url);
}

function replace_local_with_live_url($url) {
    // Fetch local URL dynamically
    $local_url = trailingslashit(get_home_url());
    $live_url = 'https://dplugins.com/';

    // Replace the local URL with the live URL
    $new_url = str_replace($local_url, $live_url, $url);

    return $new_url;
}

function replace_srcset_urls($sources, $size_array, $image_src, $image_meta, $attachment_id) {
    foreach ($sources as $key => $source) {
        $sources[$key]['url'] = replace_local_with_live_url($source['url']);
    }

    return $sources;
}
