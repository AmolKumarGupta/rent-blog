<?php 

if (! function_exists('loadStyles')) {
    function loadStyles($style) {
        $config = config('RentBlog\Config\Script');

        $link = $config->style[$style];
        echo '<link rel="stylesheet" href="'. $link .'">';
    }
}

if (! function_exists('loadScripts')) {
    function loadScripts($script) {
        $config = config('RentBlog\Config\Script');

        $link = $config->script[$script];
        echo '<script src="'. $link .'"></script>';
    }
}

?>