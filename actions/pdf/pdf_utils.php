<?php
function print_grid()
{
    global $p,$regularfont, $pagewidth, $pageheight;
    for ($y=0; $y <= $pageheight; $y+=10) {
        for ($x=0; $x <= $pagewidth; $x+=10) {
            draw_cross($x, $y);
        }
    }
}
function draw_cross($x, $y)
{
    global $p,$regularfont, $pagewidth, $pageheight, $left;
    $p->setcolor("fillstroke", "rgb", 0.0, 0.0, 0.0, 0.0);
    $width=0.1;
    $len=2;

    if(($x % 50 == 0)&&($y % 50 == 0)) {
        $width=0.1;
        $len=50;
    }
    if(($x % 100 == 0)&&($y % 100 == 0)) {
        $width=0.5;
        $len=50;
    }
    $p->setlinewidth($width);
    $p->save();
    $p->moveto($x-$len, $y);
    $p->lineto($x+$len, $y);
    $p->moveto($x, $y-$len);
    $p->lineto($x, $y+$len);
    $p->stroke();
    $p->restore();
    $x2=$x;
    if(($x % 100 == 0)&&($y % 100 == 0)) {

    $p->show_xy("X:$x2", $x, $y);
    $p->show_xy("Y:$y", $x, $y+2);
    }
}

function printpair($var, $value)
{
    global $p,$y,$pagenum,$baseopt,$regularfont, $boldfont, $italicfont, $bolditalicfont,$fontsize,$leading, $left, $right,$pagewidth, $pageheight,$tab;
    $p->setfont($boldfont, $fontsize);
    $p->show_xy($var, $left, $y);
    $optlist = "alignment=justify leading=120% fontsize 11 font $regularfont ";
    $textflow = $p->create_textflow($value, $optlist);
    if ($textflow == 0) {
        die("Error: " . $p->get_errmsg());
    }
    $p->fit_textflow($textflow, $left+$tab, $y-12, $right, $y+60, "");
    $p->delete_textflow($textflow);
}

function printbox($text = '', $x = 10, $y = 10, $w = 200, $h = 22, $size = 11, $justify = 'justify', $leading = '110', $font = '')
{
    global $p,$pagenum,$baseopt,$leading, $left, $right,$pagewidth, $pageheight,$tab;
    if (($x+$w)>=$right) {
        $w=$right-$x;
    }
    $optlist = "alignment=$justify fontsize $size font $font ";
    //$optlist = "alignment=$justify leading=$leading% fontsize $size font $font ";
    $textflow = $p->create_textflow("$text", $optlist);
    if ($textflow == 0) {
        die("Error: " . $p->get_errmsg());
    }
    $p->fit_textflow($textflow, $x, $y, $x+$w, $y+$h, "");
    $p->delete_textflow($textflow);
}

function nextpage()
{
    global $p,$y,$pagenum,$baseopt,$regularfont, $boldfont, $italicfont, $bolditalicfont,$fontsize,$leading, $left, $right,$pagewidth, $pageheight;
    $y=80;
    $p->end_page_ext("");
    $pagenum+=1;
    //Start New Page of current Report===============================================================
    $p->begin_page_ext($pagewidth, $pageheight, "topdown");
}

function maketf($txt, $size = 9, $alignment = 'center', $style = 'bold')
{
    global $p,$y,$db,$pagenum,$baseopt,$regularfont, $boldfont, $italicfont, $bolditalicfont,$fontsize,$leading, $left, $right,$pagewidth, $pageheight,$tab;
    $font=$regularfont;
    switch ($style) {
        case 'bold':
            $font=$boldfont;
            break;
        case 'norm':
            $font=$regularfont;
            break;
        case 'italic':
            $font=$italicfont;
            break;
        case 'bolditalic':
            $font=$bolditalicfont;
            break;

        default:
            $font=$boldfont;
            break;
    }

    $txtoptlist = "charref alignment=$alignment leading=120% fontsize $size font $font ";
    $tf = $p->create_textflow($txt, $txtoptlist);
    if ($tf == 0) {
        die("Error TF: " . $p->get_errmsg());
    }
    return $tf;
}