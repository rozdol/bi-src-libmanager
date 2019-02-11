<?php
$ticks=$this->html->readRQn('ticks', 0, 60);
$span=$this->html->readRQ('span', 'month');
$df=$this->html->readRQd('df', 6);

$chart=array(
    'caption' => 'Events',
    'subCaption' => "Last $ticks $span\s analysis",
    'captionFontSize' => 14,
    'subcaptionFontSize' => 14,
    'subcaptionFontBold' => 0,
    'paletteColors' => '',
    'bgcolor' => '#ffffff',
    'showBorder' => 0,
    'showShadow' => 0,
    'showCanvasBorder' => 0,
    'usePlotGradientColor' => 0,
    'legendBorderAlpha' => 0,
    'legendShadow' => 0,
    'showAxisLines' => 0,
    'showAlternateHGridColor' => 0,
    'divlineThickness' => 1,
    'divLineIsDashed' => 1,
    'divLineDashLen' => 1,
    'divLineGapLen' => 1,
    'xAxisName' => $span,
    'showValues' => 0
);

//Use SQL ro generate months as categories for
$category=array();
$sql="SELECT date_trunc('$span',date_trunc('$span', $df::date) - (interval '1' $span * generate_series(0,$ticks)))::date as date order by date";

if (!($cur = pg_query($sql))) {
    $this->html->SQL_error($sql);
}
while ($row = pg_fetch_array($cur)) {
    array_push($category, array("label" => $row["date"]));
}

$categories=array(
    '0' => array(
        'category' => $category
    )
);


//Select data for 1st chart series
$data0=array();
$sql="SELECT COALESCE(count(tbl.id), 0) as amount, date_trunc( '$span', d.date )::date as date FROM (select date_trunc('$span',date_trunc('$span', $df::date) - (interval '1' $span * generate_series(0,$ticks)))::date as date) d
LEFT OUTER JOIN books_transactions tbl
ON (d.date=date_trunc('$span', tbl.date)::date) and type_id in (1,2)
GROUP BY d.date order by d.date;";

if (!($cur = pg_query($sql))) {
    $this->html->SQL_error($sql);
}
while ($row = pg_fetch_array($cur)) {
    array_push($data0, array("value" => $row["amount"]));
}

//Select data for 2nd chart series
$data1=array();
$sql="SELECT COALESCE(count(tbl.id), 0) as amount, date_trunc( '$span', d.date )::date as date FROM (select date_trunc('$span',date_trunc('$span', $df::date) - (interval '1' $span * generate_series(0,$ticks)))::date as date) d
LEFT OUTER JOIN books_transactions tbl
ON (d.date=date_trunc('$span', tbl.date)::date) and type_id in (3,4)
GROUP BY d.date order by d.date;";

if (!($cur = pg_query($sql))) {
    $this->html->SQL_error($sql);
}
while ($row = pg_fetch_array($cur)) {
    array_push($data1, array("value" => $row["amount"]));
}


$dataset=array(
    '0' => array(
        'seriesname' => 'Ins',
        'data' => $data0
        ),
    '1' => array(
        'seriesname' => 'Outs',
        'data' => $data1
        ),

);

$FC_array=array(
    'chart' => $chart,
    'categories' => $categories,
    'dataset' => $dataset
    );
$jsonEncodedData = json_encode($FC_array);
$out.= $this->utils->chart_js_new('msline', 1200, 400, 'eventschart', $jsonEncodedData);
$body.=$out;