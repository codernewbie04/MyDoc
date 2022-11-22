<?php



function form_error($msg = null, $open, $close) 
{
    if($msg)
        return $open.$msg.$close;
}