<?php
$doc = new DomDocument;
$doc->validateOnParse = true;
$content=file_get_contents('https://www.livelib.ru/book/1002326231-garri-potter-i-uznik-azkabana-dzh-k-rouling');
$doc->loadHtml($content);
$desr=$doc->getElementById('full-description');
echo $this->html->pre_display($desr->textContent,"desr");
