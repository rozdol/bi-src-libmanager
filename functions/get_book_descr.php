<?php
$doc = new DomDocument;
$doc->validateOnParse = true;
$link=$this->data->get_val('books','link',$id);
$content=file_get_contents($link);
$doc->loadHtml($content);
$desr=$doc->getElementById('full-description');
//echo $this->html->pre_display($desr->textContent,"desr");

return $desr->textContent;