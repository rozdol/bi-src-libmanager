<?php
//Details entities
    $res=$this->db->GetRow("select * from $what where id=$id");
    $partner=$this->data->detalize('partners', $res[partner_id]);
    $date=$this->html->readRQd('date',1);
    $out.= "<h1>$res[name]</h1>";
    $out.=$this->data->details_bar($what,$id);

    $out.= "<table class='table table-morecondensed table-notfull'>";$out.="<tr><td class='mr'><b>Id: </b></td><td class='mt'>$res[id]</td></tr>";
$out.="<tr><td class='mr'><b>Name: </b></td><td class='mt'>$res[name]</td></tr>";
$out.="<tr><td class='mr'><b>Date: </b></td><td class='mt'>$res[date]</td></tr>";
$out.="<tr><td class='mr'><b>Active: </b></td><td class='mt'>$res[active]</td></tr>";
$out.="<tr><td class='mr'><b>Descr: </b></td><td class='mt'>$res[descr]</td></tr>";
$out.="<tr><td class='mr'><b>Surname: </b></td><td class='mt'>$res[surname]</td></tr>";
$out.="<tr><td class='mr'><b>Salutation: </b></td><td class='mt'>$res[salutation]</td></tr>";
$out.="<tr><td class='mr'><b>Type id: </b></td><td class='mt'>$res[type_id]</td></tr>";
$out.="<tr><td class='mr'><b>Physical: </b></td><td class='mt'>$res[physical]</td></tr>";
$out.="<tr><td class='mr'><b>Email: </b></td><td class='mt'>$res[email]</td></tr>";
$out.="<tr><td class='mr'><b>Mobile: </b></td><td class='mt'>$res[mobile]</td></tr>";
$out.="<tr><td class='mr'><b>Tel: </b></td><td class='mt'>$res[tel]</td></tr>";
$out.="<tr><td class='mr'><b>Address: </b></td><td class='mt'>$res[address]</td></tr>";
$out.="<tr><td class='mr'><b>Passport: </b></td><td class='mt'>$res[passport]</td></tr>";
$out.="<tr><td class='mr'><b>Country id: </b></td><td class='mt'>$res[country_id]</td></tr>";
$out.="<tr><td class='mr'><b>Birth date: </b></td><td class='mt'>$res[birth_date]</td></tr>";
$out.="</table>";

    if($res[descr])$out.= "Description:<br><pre>$res[descr]</pre>";

    $dname=$this->data->docs2obj($id,$what);
    $out.="<b>Documents:</b> $dname<br>";
    $out.=$this->show_docs2obj($id, $what);

    $_POST[tablename]=$what;
    $_POST[refid]=$id;
    $_POST[reffinfo]="&tablename=$what&refid=$id";
    $out.=$this->show('schedules');
    $out.=$this->show('comments');
    $out.=$this->report('posts');
    $out.=$this->report('db_changes');
    $body.=$out;
    