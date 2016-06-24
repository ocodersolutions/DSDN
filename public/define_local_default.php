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

define('URL_APPLICATION', 'http://ttthdsdn.local');
define('URL_APPLICATION_VI', 'http://ttthdsdn.local');
define('URL_APPLICATION_EN', 'http://ttthdsdn.local');
define('URL_APPLICATION_JP', 'http://ttthdsdn.local');

define('DEFAULT_LANGUAGE', 'vi');

/* Paginator */
define('ROWS_PER_PAGE', 20);
define('PAGE_RANGE', 10);

define('SERVICE_CATEGORY_ID', 2);
define('CAREER_CATEGORY_ID', 3);
define('COMPANY_INFO_CATEGORY_ID', 4);
define('NEWS_CATEGORY_ID', 5);
define('RELATENEWS_CATEGORY_ID', 7);
define('INTERNALNEWS_CATEGORY_ID', 8);
define('RECRUITMENT_CATEGORY_ID', 9);
define('SHAREHOLDER_CATEGORY_ID', 11);
define('NOTIFICATION_CATEGORY_ID', 12);
define('FINANCIAL_CATEGORY_ID', 13);
define('SHAREHOLDER_MEET_CATEGORY_ID', 14);
define('SHAREINFO_CATEGORY_ID', 15);
define('ANNUALREPORT_CATEGORY_ID', 16);
define('BOARDREPORT_CATEGORY_ID', 17);
define('GOVERNANCERULE_CATEGORY_ID', 18);
define('PROSPECTUSREPORT_CATEGORY_ID', 19);
define('CHARTERED_CATEGORY_ID', 20);