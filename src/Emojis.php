<?php
/**
 * Class used to remove emojis from WP
 * Inspired by : https://github.com/futtta/autoptimize/blob/617a2a55d586317db0db178e10d389ed6b79fd58/classes/autoptimizeExtra.php
 */

 namespace MN;

 class Emojis{

    public function initialize(){
        // Removing all actions related to emojis!
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
        
        // Removes TinyMCE emojis.
        add_filter( 'tiny_mce_plugins', array( $this, 'filter_disable_emojis_tinymce' ) );
        
        // Removes emoji dns-preftech.
        add_filter( 'wp_resource_hints', array( $this, 'filter_remove_emoji_dns_prefetch' ), 10, 2 );
    }

    public function filter_disable_emojis_tinymce( $plugins )
    {
        if ( is_array( $plugins ) ) {
            return array_diff( $plugins, array( 'wpemoji' ) );
        } else {
            return array();
        }
    }

    public function filter_remove_emoji_dns_prefetch( $urls, $relation_type )
    {
        $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/' );

        return $this->filter_remove_dns_prefetch( $urls, $relation_type, $emoji_svg_url );
    }

    public function filter_remove_dns_prefetch( $urls, $relation_type, $url_to_remove )
    {
        $url_to_remove = (string) $url_to_remove;

        if ( ! empty( $url_to_remove ) && 'dns-prefetch' === $relation_type ) {
            $cnt = 0;
            foreach ( $urls as $url ) {
                if ( false !== strpos( $url, $url_to_remove ) ) {
                    unset( $urls[ $cnt ] );
                }
                $cnt++;
            }
        }

        return $urls;
    }


 }