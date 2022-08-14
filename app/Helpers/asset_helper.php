<?php
if( !function_exists('asset') ){
    function asset(string $path):string
    {
        return base_url('public/assets'). '/' . $path;
    }
}
?>