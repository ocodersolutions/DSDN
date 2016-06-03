<?php
/* Database config */
define('DATABASE_HOST', "localhost");
define('DATABASE_NAME', "ttthdsdn");
define('DATABASE_USER', "root");
define('DATABASE_PASS', "password");

//define('DATABASE_HOST', "localhost");
//define('DATABASE_NAME', "bms_phuanphat");
//define('DATABASE_USER', "root");
//define('DATABASE_PASS', "");

/* URL */
$lang = '';
if(array_shift((explode(".",$_SERVER['HTTP_HOST']))) == "en"){
    $lang = 'en.'; 
} elseif(array_shift((explode(".",$_SERVER['HTTP_HOST']))) == "jp"){
    $lang = 'jp.'; 
}

define('URL_APPLICATION', 'http://' . $lang . 'ttthdsdn.local');
// define('URL_APPLICATION_VI', 'http://phuanphat.com.vn');
// define('URL_APPLICATION_EN', 'http://en.phuanphat.com.vn');
// define('URL_APPLICATION_JP', 'http://jp.phuanphat.com.vn');

define('DEFAULT_LANGUAGE', 'vi');

/* Paginator */
define('ROWS_PER_PAGE', 20);
define('PAGE_RANGE', 10);

define('SERVICE_CATEGORY_ID', 2);
define('CAREER_CATEGORY_ID', 3);
define('COMPANY_INFO_CATEGORY_ID', 4);
define('NEWS_CATEGORY_ID', 5);
define('RECRUITMENT_CATEGORY_ID', 6);