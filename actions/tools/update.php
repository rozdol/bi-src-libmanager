<?php
if (!$access['main_admin']) { //Show error if not admin
    $this->html->error('');
}

// Add initial access items
$this->livestatus('Add access');
echo "<br><br><br><br>";
$access_arr=[

    'main_delete',
    'edit_webcam',
    'edit_dropzone',
    'edit_documents_save',
    'view_countries',
    'report_favorites',
    'edit_shoppingcart',
    'edit_processdata',

    'report_myprofile',
    'edit_myprofile',

    'edit_signups',
    'edit_signup',

    'report_special',
    'report_my_sfuff',

    'edit_special',
    'edit_send_message',



    'view_entities',
    'view_books',
    'view_books_transactions',
    'view_alerts_history',
    'edit_entities',
    'edit_books',
    'edit_books_transactions',
    'edit_alerts_history',

    'report_test',
    'report_active_users',
];

foreach ($access_arr as $access_item) {
    $_POST[item]=$access_item;
    $this->tools('addaccessitems');
    if ($access_item!='main_delete') {
        $accid=$this->db->getval("SELECT id from accessitems where name='$access_item' order by id asc limit 1");
        $sql="UPDATE accesslevel set access='1' where groupid=3 and accessid=$accid";
        //echo "$sql<br>";
        if ($accid>0) {
            $cur= $this->db->GetVal($sql);
        }
    }
    echo "<br>";
}

// Add new users
$new_users[]=['username'=>'alex'];


$new_users[]=[
    'id'=> 3,
    'username'=>'lukyanov',
    'firstname'=>'Andrey',
    'surname'=>'Lukyanov',
    'email'=>'test1@company.com'
];

$new_users[]=[
    'id'=> 4,
    'username'=>'sova',
    'firstname'=>'Iulian',
    'surname'=>'Sova',
    'email'=>'test2@company.com'
];

foreach ($new_users as $vals) {
    unset($user_vals);
    $user_vals=[
        'username'=>$vals[username],
        'email'=>$vals[email],
        'firstname'=>$vals[firstname],
        'surname'=>$vals[surname],
        'regdate'=>$GLOBALS[today],
        'active'=>1,
    ];
    $user_id=$this->db->insert_db('users', $user_vals);
    $this->db->getval("INSERT into user_group (groupid,userid) VALUES (3,$user_id)");
}
$this->db->getval("update users set
password='2b4c7c52a61c494ce05cbef3589eabca',
password_hash='sha256:1000:7LmfqDi7Hdtc3tc6ETYU66CKJN+zkM3u:aGCemxu31vR1PMaR1nBKlI4Q3EHyZnvR',
token_hash='47c4-742d7269' where id>2; --Pass1234");


//To soft reset:
//delete from signups;delete from users where id>3;


//Add initial menue
$this->livestatus('Add Menu');
//========29.07.2017
//$this->data->add_menu('Documents',['All'=>'?act=show&what=documents']);
$this->data->add_menu('Data', ['Business'=>'#']);
$this->data->add_menu('Data', ['Info'=>'#']);
$this->data->add_menu('Tools', ['Search'=>'#']);

$this->data->add_menu('Business', ['Enities'=>'?act=show&what=entities']);
$this->data->add_menu('Business', ['Books'=>'?act=show&what=books']);
$this->data->add_menu('Business', ['Transactions'=>'?act=show&what=books_transactions']);
$this->data->add_menu('Business', ['Alerts'=>'?act=show&what=alerts_history']);

$this->data->add_menu('Info', ['Lists'=>'?act=show&what=lists']);

$this->data->add_menu('Search', ['Entities'=>'?act=search&what=entities']);
$this->data->add_menu('Search', ['Transactions'=>'?act=search&what=books_transactions']);
$this->data->add_menu('Search', ['Books'=>'?act=search&what=books']);

$this->data->add_menu('Reports', ['Books'=>'?act=report&what=books']);

$this->data->add_menu('New', ['Entity'=>'?act=add&what=partners']);
$this->data->add_menu('New', ['Entity Import'=>'?act=add&what=import_partner']);
$this->data->add_menu('New', ['Transaction'=>'?act=add&what=books_transactions']);
$this->data->add_menu('New', ['Book'=>'?act=add&what=books']);
$this->data->add_menu('New', ['Books Import'=>'?act=add&what=import_books']);

$this->livestatus('Copy Data from CSV');
$csv_dir=APP_DIR.DS.'data';

$csv_file=$csv_dir.DS."lists.csv";
if(file_exists($csv_file)){
    $file_content=file_get_contents($csv_file);
    echo $this->html->pre_display($file_content,"lists.csv");

    $sql="COPY lists(id,name,alias)
    FROM '$csv_file' DELIMITER ';' CSV HEADER;";
    echo $this->html->pre_display($sql, "SQL:lists");
    $this->db->getval($sql);
}else{
    $this->html->error("No file $csv_file");
}

$csv_file=$csv_dir.DS."listitems.csv";
if(file_exists($csv_file)){
    $sql="COPY listitems(id,name,alias,list_id,qty,default_value,addinfo,text1,num1)
    FROM '$csv_file' DELIMITER ';' CSV HEADER;";
    echo $this->html->pre_display($sql, "SQL:listitems");
    $this->db->getval($sql);
}else{
    $this->html->error("No file $csv_file");
}


$this->livestatus('Add Entities');
$vals_array[]=[
    'name' => 'Alexander',
    'surname' => 'Titov',
    'type_id' => 202,
    'active' => 1,
    'physical' => 1,
    'email' => 'test@gmail.com',
    'address' => 'Maximos Plaza, Limassol',
    'country_id' => 10018,
    'mobile' => '+35799350000',
    'descr' => 'Test1'
];


$vals_array[]=[
    'name' => 'Andrei',
    'surname' => 'Lukianov',
    'type_id' => 202,
    'active' => 1,
    'physical' => 0,
    'email' => 'test@gmail.com',
    'address' => 'Road Town,Tortola',
    'country_id' => 10010,
    'mobile' => '+35799350000',
    'descr' => 'Test1'
];

$vals_array[]=[
    'name' => 'Julian',
    'surname' => 'Sova',
    'type_id' => 202,
    'active' => 1,
    'physical' => 0,
    'email' => 'test@gmail.com',
    'address' => 'BDO COurt, Limassol',
    'country_id' => 10018,
    'mobile' => '+35799350000',
    'descr' => 'Test1'
];

foreach ($vals_array as $vals) {
    echo "Insert Entities $vals[name]<br>";
    $id=$this->db->insert_db('entities', $vals);
}


// clean up var:
unset($vals_array);

$vals_array[]=[
    'name' => 'Mastering BI 8',
    'isbn' => '978-3-16-148410-0',
    'link' => 'https://www.google.com/search?q=isbn&ie=utf-8&oe=utf-8&client=firefox-b-ab',
];

$vals_array[]=[
    'name' => 'Advance programming BI 8',
    'isbn' => '978-3-16-148411-0',
    'link' => 'https://www.isbn-international.org/content/what-isbn',
];

$vals_array[]=[
    'name' => 'Cookbook BI 8',
    'isbn' => '978-3-16-148412-0',
    'link' => 'https://www.isbn-international.org/content/what-isbn',
];

foreach ($vals_array as $vals) {
    echo "Insert Entities $vals[name]<br>";
    $id=$this->db->insert_db('entities', $vals);
}


//copy access
$_POST[group_id_from]=2;
$_POST[group_id_tos]='3';
// $_POST[group_id_tos]='3,4,7';
//$this->tools('copy_access');

$this->livestatus('DONE');