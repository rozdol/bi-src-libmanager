<?php
echo "ok";
$name=$this->html->readRQ('name');
$content="Helllo, $name";
$out.=$this->html->tag($content,'div','class');
echo $out;

echo $this->html->pre_display($data,"result");