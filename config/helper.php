<?php

if (!function_exists('is_admin')) {
    function is_admin()
    {
        return isset($_SESSION['logged_in']);
    }
}

if (!function_exists('attr')) {
    function attr($str)
    {
        return htmlspecialchars($str, ENT_QUOTES);
    }
}

if (!function_exists('selected')) {
    function selected($current, $needle)
    {
        return $current === $needle?'selected':'';
    }
}

if (!function_exists('pagin_link')) {
    function pagin_link($page)
    {
        $query = !empty($_SERVER['QUERY_STRING'])?'?'.$_SERVER['QUERY_STRING']:'';
        return '/'.$page.$query;
    }
}
