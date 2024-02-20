<?php
if (!function_exists('settings')) {
    function settings()
    {
        $root = "http://localhost/r-57/PHP/quiz_wars_20022024/quiz_wars/";
        return [
            'root'  => $root,
            'companyname' => 'TIGER QUIZ',
            'sitename' => 'Quiz Wars',
            'logo' => $root . "admin/assets/img/logo.svg",
            'homepage' => $root,
            'adminpage' => $root . 'admin/',
            'hostname' => 'localhost',
            'user' => 'root',
            'password' => '',
            'database' => 'quiz_app'
        ];
    }
}
if (!function_exists('testfunc')) {
    function testfunc()
    {
        return "<h3>testing common functions</h3>";
    }
}
if (!function_exists('config')) {
    function config($param)
    {
        $parts = explode(".", $param);
        $inc = include(__DIR__ . "/../config/" . $parts[0] . ".php");
        return $inc[$parts[1]];
    }
}
