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

        // Remove Emojis
        $this-> remove_emojis();

    }

    private function remove_emojis(){
        $emojis = new Emojis();
        $emojis->initialize();
    }

}