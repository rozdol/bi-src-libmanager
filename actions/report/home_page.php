<?php
if ($GLOBALS[uid]<=0) {
    $div.=$this->html->link_button('Sign in', "?act=welcome", "btn", "");
    $div.=$this->html->link_button('Sign up', "?act=form&what=signup", "btn-info", "");
    $out.=$this->html->tag($div, 'div', 'class');
} else {
    $out.=$this->html->tag("Logged in as ".$GLOBALS[username], 'div', 'class');

    if ($GLOBALS[access][main_admin]) {
        $out.=$this->html->link_button('Reset System', "?csrf=$GLOBALS[csrf]&act=tools&what=reset", "btn-error error btn-nano", "The DB will be wiped!!!");

        $test_new=$this->data->get_val('users', 'id', 3)*1;
        if ($test_new!=3) {
            echo "<a href='?act=tools&what=update'>Update System $test_new</a>";
            exit;
        }
    }
    //$out.=$this->show('instances');
}


$body.="$out";
