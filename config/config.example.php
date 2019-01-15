<?php
$GLOBALS['settings']['wipfile']=DATA_DIR.'/wiplist.txt'; //list of allowed IPs
$GLOBALS['settings']['use_wip']=1; //white IP list
$GLOBALS['settings']['use_block_on_edit']=0; //Block records on edit
$GLOBALS['settings']['use_xls_export']=1; //Use export-import with xls support
$GLOBALS['settings']['use_csv_export']=1; //Use CSV for export
$GLOBALS['settings']['use_tbl2csv']=1; //use converter
$GLOBALS['settings']['use_cache']=0; //use cache
$GLOBALS['settings']['csrf']=''; //reset csrf
$GLOBALS['settings']['no_csrf']=0; //disable csrf guard
$GLOBALS['settings']['session_time']=1800; //users session time in seconds (1800sec=30min)
$GLOBALS['settings']['rnd']=rand();
$GLOBALS['settings']['limit']=50;
$GLOBALS['settings']['fast_menu']=0; //use cached menu instead of generating it
$GLOBALS['settings']['no_menu']=0;
$GLOBALS['settings']['no_auth']=1; //Open for everyone
$GLOBALS['settings']['no_search']=1;
$GLOBALS['settings']['scrable_key']='OPCTIVRXEJKLNMABQGZDUFWHYS123456opctivrxejklnmabqgzdufwhys';
$GLOBALS['settings']['system_email']='email@example.com';
$GLOBALS['settings']['admin_email']='email@example.com';
$GLOBALS['settings']['brand_email']='email@example.com';
$GLOBALS['settings']['brand_name']='Brand';
$GLOBALS['settings']['currency_id']=601;
$GLOBALS['access']=array(); //init ACL
$GLOBALS['settings']['hide_menu']=0;
$GLOBALS['settings']['hide_footer_info']=1;
$GLOBALS['force_access']['main_access']=1;

$GLOBALS['force_access']['report_home_page']=1;
$GLOBALS['force_access']['edit_signups']=1;
$GLOBALS['force_access']['edit_signup']=1;
$GLOBALS['force_access']['report_wizard_consents']=1;


$GLOBALS['force_access']['view_my_sessions']=1;

$GLOBALS['settings']['simple_profile']=1;
$GLOBALS['settings']['use_mfa']=0;
$GLOBALS['settings']['price']=1;
$GLOBALS['settings']['initial_balance']=$GLOBALS['settings']['price']*20;
$GLOBALS['settings']['use_local_rates']=0;
$GLOBALS['settings']['no_nenu_rates']=1;
$GLOBALS['settings']['no_nenu_alerts']=1;
$GLOBALS['settings']['no_cart']=1;
$GLOBALS['settings']['no_export']=1;
$GLOBALS['topbar']['login']=1;



if (!$GLOBALS['settings']['dev_mode']) {
    $GLOBALS['settings']['supress_warnings']=1;
    // $GLOBALS['force_access']['report_myprofile']=1;
    // $GLOBALS['force_access']['edit_profile']=1;
} else {
    $GLOBALS['settings']['message']='<span style="font-size:18px;"><span style="color:#ff0000;">System is in developing mode. (DATA IS INCONSISTENT!)</span></span>';
}
$GLOBALS['settings']['app_loogo']='<span style="font-size:26px;"><span style="color:#ff0000;"><strong>Nice</strong></span><span style="color:#dedede;">Logo</span><span style="color:#ff0000;">☯︎</span></span>';
