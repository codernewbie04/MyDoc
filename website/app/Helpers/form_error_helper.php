<?php



function form_error($msg = null, $open, $close) 
{
    if($msg)
        return $open.$msg.$close;
}

function link_active($title, $target) {
    if($title == $target)
        return "active";
}