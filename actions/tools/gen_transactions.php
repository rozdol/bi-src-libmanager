<?php

if (!$access['main_admin']) { //Show error if not admin
    $this->html->error('');
}
$args=['year'=>2017, 'qty'=>60];

$res= $this->project->gen_transactions($args);
$count=count($res[output][ids]);
echo $this->html->message("$count transactions inserted in ".$res[input][year]);

echo $this->html->pre_display($res,"result");
exit;

 ?>