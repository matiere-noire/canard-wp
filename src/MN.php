<?php

namespace MN;

class MN{
    private $basename;
    private $path;
    private $url;
    private $slug;

    public function __construct(){}

    public function initialize( $file ){
        
        $this->basename = plugin_basename($file);
        $this->path     = plugin_dir_path($file);
        $this->url      = plugin_dir_url($file);
        $this->slug     = dirname($this->basename);

        // Remove version of Wordpress
        $this->remove_version();

        // Remove Emojis
        $this->remove_emojis();

    }

    private function remove_version(){
        remove_action('wp_head', 'wp_generator');

        // Remove from RSS feed
        add_filter('the_generator', function(){
            return '';
        });
    }

    private function remove_emojis(){
        $emojis = new Emojis();
        $emojis->initialize();
    }

}