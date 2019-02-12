<?php

global $p,$y,$pagenum,$baseopt,$regularfont, $boldfont,$fontsize,$leading, $left, $right,$pagewidth, $pageheight;
//echo $this->html->pre_display($_POST); exit;
$left = 70;
$right = 530;
$fontsize = 11;
$linefontsize = 8;
$pagewidth = 595;
$pageheight = 842;
$bottom=740;
$documentname="Fianacial satatement";
$issuerid=$this->html->readRQ('issuerid')*1;
if ($issuerid==0) {
    $issuerid=0;
}

$id=$this->html->readRQ('id')*1;
$partnerid=$id;

$allow_access=$this->data->isallowed('partners', $partnerid);
if($allow_access!=1){
    $this->html->notFound("No access");
    exit;
}

$issuerid=$partnerid;//$this->html->readRQ('issuerid')*1;if($issuerid==0)$issuerid=0;

$df=$this->html->readRQd("df");
$dt=$this->html->readRQd("dt", 1);
//$df1=$this->dates->F_dateadd($df,-1);

$currid=($this->html->readRQ('curr'))*1;
if ($currid==0) {
    $currid=$this->db->GetVal("select a_currency from partners where id=$partnerid");
    $_POST[curr]=$currid;
}
$currname=$this->db->GetVal("select name from listitems where id=$currid");
$rate=$this->data->get_rate($currid);
$email=$this->html->readRQ('email');
$ids_exclude=$this->html->readRQ('ids_exclude');
$signed=$this->html->readRQn('signed');
$currency_id=$this->html->readRQn('currency_id');
$sort_by=$this->html->readRQ('sort_by');
$sorting=$this->html->readRQn('sorting');
$sorting=($sorting>0)?'asc':'desc';

if ($currency_id==0) {
    $currency_id=601;
}

$docname=$documentname;


$currency=$this->data->get_name('listitems', $currency_id);
$baseopt =  "ruler        { 0 20 55 330 395 460} " .
"tabalignment { left left left right right right} " .
"hortabmethod ruler fontsize $linefontsize ";
$baseopt2 =  "ruler        { 0 40 85 300 345 395 445} " .
"tabalignment { right right right right right right right} " .
"hortabmethod ruler fontsize $linefontsize ";
$header = sprintf("\tNo\tAcc No\tDescription\tBalance\tDiff\tBalance");
$header2 = sprintf("\t\t\t\t$df\t\t$dt");

/* This is where font/image/PDF input files live. Adjust as necessary. */
$searchpath = DATA_DIR;
$infile  =  DATA_DIR.'/lh/'.$issuerid."_lh.pdf";
if (!file_exists($infile)) {
    $issuerid=0;
    $infile  =  DATA_DIR.'/lh/'.$issuerid."_lh.pdf";
}
//$imagefile = $searchpath."invsign.gif";

try {
    $p = new PDFlib();

# This means we must check return values of load_font() etc.
    $p->set_parameter("errorpolicy", "return");

    $p->set_parameter("SearchPath", $searchpath);

    /* This line is required to avoid problems on Japanese systems */
    $p->set_parameter("hypertextencoding", "winansi");

    /*  open new PDF file; insert a file name to create the PDF on disk */
    if ($p->begin_document("", "") == 0) {
        die("Error: " . $p->get_errmsg());
    }

    $creator=$this->data->readconfig('owner');
    $p->set_info("Creator", $creator);
    $p->set_info("Author", "IT Dpt.");
    $p->set_info("Title", "$docname");
//$id=$row1[id];
    $res=$this->db->GetRow("select * from partners where id=$partnerid");

    $pagenum=1;
    $total =0;
    $totalqty =0;
    $totalweight =0;
    $i=0;
//Start New Report===============================================================

    $stationery = $p->open_pdi($infile, "", 0);
    if ($stationery == 0) {
        die("Error: " . $p->get_errmsg());
    }

    $page = $p->open_pdi_page($stationery, 1, "");
    if ($page == 0) {
        die("Error: " . $p->get_errmsg());
    }


    $boldfont = $p->load_font("Helvetica-Bold", "winansi", "");
    if ($boldfont == 0) {
        die("Error: " . $p->get_errmsg($p));
    }
    $regularfont = $p->load_font("Helvetica", "winansi", "");
    if ($regularfont == 0) {
        die("Error: " . $p->get_errmsg($p));
    }

    $leading = $fontsize + 2;
    /* Establish coordinates with the origin in the upper left corner. */
    $p->begin_page_ext($pagewidth, $pageheight, "topdown");

    $p->fit_pdi_page($page, 0, $pageheight, "");
    $p->close_pdi_page($page);



    $p->setfont($regularfont, $fontsize);
    $p->set_value("leading", $leading);

    /* print the header and date */


    $y = 130;
    $addtoname=$this->html->readRQ('addtoname');
    $hideopt=$this->html->readRQ('hideopt');
//$gid=0; $userpartnerid=1;
    $allowed=1;
    if ($allowed==1) {
//$p->setfont($regularfont, 3);
//print_grid();
//draw_cross(100,100);
        $p->setfont($boldfont, $fontsize);
        if( $issuerid==0)$p->show_xy($res[name], $left+10, $y-60);
        $p->show_xy("PL Statement", $left+10, $y);
        $time = localtime();
//$date=$time[5]+1900;
        $date=$this->dates->F_date("", 1);

        $dirdt0=strtotime($date);
        $dirsig="_8";
        $dirsigshift=65;
        $searchpath = DATA_DIR;
        $imagefile = $searchpath."/signatures/user-2-sign.png";
        $image = $p->load_image("auto", $imagefile, "");
        if (!$image) {
            die("Error: " . $p->get_errmsg());
        }


//if($sert<>''){$date=$res[rwbdate];}
//$buf = sprintf("%s %d, %d", $months[substr($date,3,2)*1-1], substr($date,0,2)*1, substr($date,6,4)*1);
//$buf=substr($date,6,4)*1;
//$p->fit_textline($buf, $right, $y, "position {100 0}");
        $y += 1*$leading;
        //$p->show_xy("Date: $date", $left+300, $y);


        /* print the address */
        $y = 125;

        $y += 2*$leading;


        $p->setcolor("fillstroke", "rgb", 0.0, 0.0, 0.0, 0.0);
        $p->setlinewidth(1);
        $p->save();


        $p->moveto($left, $y+10);
        $p->lineto($right, $y+10);
        $p->moveto($left, $y+8);
        $p->lineto($right, $y+8);
//$p->moveto($pagewidth/2-5, $y-$leading);
//$p->lineto($pagewidth/2-5, $y-17*$leading);
        $p->stroke();
        $p->restore();



        /* print the document header line */
        $y += 2*$leading+10;
//$y = 380;


        $optlist = sprintf("%s font %d ", $baseopt, $boldfont);
        $textflow = $p->create_textflow($header, $optlist);
        if ($textflow == 0) {
            die("Error: " . $p->get_errmsg());
        }
        $p->fit_textflow($textflow, $left, $y-2*$leading, $right, $y, "");
        $p->delete_textflow($textflow);
        $textflow = $p->create_textflow($header2, $optlist);
        if ($textflow == 0) {
            die("Error: " . $p->get_errmsg());
        }
        $p->fit_textflow($textflow, $left, $y-1*$leading, $right, $y+1*$leading, "");
        $p->delete_textflow($textflow);

        /* Draw lines*/
        $p->setcolor("fillstroke", "rgb", 0.0, 0.0, 0.0, 0.0);
        $p->setlinewidth(1);
        $p->save();
        $p->moveto($left, $y);
        $p->lineto($right, $y);
        $p->stroke();
        $p->restore();

        $cdate=$this->dates->F_USdate($date);
        
        $datafile="";
        $y += 1*$leading;
        $total = 0;
        $optlist = sprintf("%s font %d ", $baseopt, $regularfont);
        $optlist2 = sprintf("%s font %d ", $baseopt2, $regularfont);
        $optlistb = sprintf("%s font %d ", $baseopt, $boldfont);

        $p->setcolor("fillstroke", "rgb", 0.0, 0.0, 0.0, 0.0);
        $p->setlinewidth(0.1);

        $data=array(
        'partnerid'=>$partnerid,
        'df'=>$df,
        'dt'=>$dt,
        );
        $accounting=$this->project->accounting($partnerid, $data);
        //$accounting_data=array_merge($accounting[raw][assets],$accounting[raw][liabilities],$accounting[raw][capital]);
        $accounting_data=array_merge($accounting[raw][income], $accounting[raw][expenses], $accounting[raw][earnings]);
//_________begin of main loop_________________________
        foreach ($accounting_data as $row) {
            $show=true;
            if ((($row[balance0]==0)&&($row[diff]==0)&&($row[balance]==0))) {
                $show=false;
            }
            if ($show) {
                $i+=1;
                /* Draw lines*/
                $y -=$leading;
                $p->setlinewidth(0.1);
                $p->save();
                $p->moveto($left, $y);
                $p->lineto($right, $y);
                $p->stroke();
                $p->restore();
                $y +=$leading;
                $l='';
                for ($j=0; $j < $row[level];
                $j++) {
                    $l.="     ";
                }

                        
                $buf = "\t$i\t$row[number]\t$l$row[name]\t".number_format($row[balance0], 2, '.', ' ')."\t".number_format($row[diff], 2, '.', ' ')."\t".number_format($row[balance], 2, '.', ' ');
                if ($row[header]=='t') {
                    $optlist_row=sprintf("%s font %d ", $baseopt, $boldfont);
                } else {
                    $optlist_row=sprintf("%s font %d ", $baseopt, $regularfont);
                }
                $textflow = $p->create_textflow($buf, $optlist_row);
                if ($textflow == 0) {
                    die("Error: " . $p->get_errmsg());
                }
                $p->fit_textflow($textflow, $left, $y-$leading, $right, $y, "");
                $p->delete_textflow($textflow);

                $y +=$leading;

                $totals[0]+=$balance0;
                $totals[1]+=$tdr;
                $totals[2]+=$tcr;
                $totals[3]+=$balance;
            }

            
            if ($y>$bottom) {
                nextpage();
            }
        }//___________end of main loop____________________
        if ($y<600) {
            $y=600;
        }
        $p->setcolor("fillstroke", "rgb", 0.0, 0.0, 0.0, 0.0);
        $p->setlinewidth(1);
        $p->save();
        $p->moveto($left, $y-$leading);
        $p->lineto($right, $y-$leading);
        $p->stroke();
        $p->restore();
    //$y += $leading;

    //$y += 1*$leading;

        $p->setcolor("fillstroke", "rgb", 0.0, 0.0, 0.0, 0.0);
        $p->setlinewidth(1);
        $p->save();
        $p->moveto($left, $y);
        $p->lineto($right, $y);
        $p->moveto($left, $y+3);
        $p->lineto($right, $y+3);
        $p->stroke();
        $p->restore();




        $y +=10*$leading;

        if (($signed!='')) {
            $p->fit_image($image, $left+270, $y+$dirsigshift, "scale {1}");
        }
        $p->close_image($image);

        $y -=5*$leading;
        if ($dbname=='ldm') {
            $y +=3*$leading;
        }
        $p->setfont($regularfont, $fontsize);
        $p->show_xy("Signature:", $pagewidth/2, $y);


        $y += 2*$leading;
        $p->setcolor("fillstroke", "rgb", 0.0, 0.0, 0.0, 0.0);
        $p->setlinewidth(.2);
        $p->save();
        $p->moveto($pagewidth/2, $y-1.5*$leading);
        $p->lineto($right, $y-1.5*$leading);
        $p->stroke();
        $p->restore();
    } else {
        $p->show_xy("Hacking attempt detected!", $left, $y);
        $y+=$leading;
        $p->show_xy("Your IP is submitted for investigation.", $left, $y);
        $this->data->DB_log("HACK in pdf_accounting partner id=$id");
    }//end of ROLE check

    $p->end_page_ext("");
    //End New Report===============================================================
    $p->end_document("");
    $p->close_pdi($stationery);

    $buf = $p->get_buffer();
    $len = strlen($buf);
    $filename="document-$docname-$buyername";
    $filename=str_ireplace(" ", "_", $filename);
    if ($email<>'') {
        $mailtext="Dear Sirs,\n\nPlease find attached the Report $docname. \n$res[descr]\n\n\n\nBest regards,\n$cmane";
        $file_array = array(
            0=>array('file'=>'document$docname.pdf',
                'mimetype'=>'application/pdf',
                'filename'=>"$filename.pdf",
                'data'=>$buf),
            1=>array('file'=>'document$docname.txt',
                'mimetype'=>'text/plain',
                'filename'=>"document$docname.txt",
                'data'=>$messagebody),
            2=>array('file'=>'data$docname.txt',
                'mimetype'=>'text/plain',
                'filename'=>"data$docname.txt",
                'data'=>$datafile));
        $u_email=$this->db->GetVal("select email from users where id=$uid");
        mail_attached2($email, $u_email, "document No $docname", $mailtext, $file_array);

        print "(document is sent to <b>$email</b>) <a href='?'>Home</a>";
    } else {
        header("Content-type: application/pdf");
        header("Content-Length: $len");
        header("Content-Disposition: inline; filename=$filename.pdf");
        print $buf;
    }
} catch (PDFlibException $e) {
    die("PDFlib exception occurred in document sample:\n" .
        "[" . $e->get_errnum() . "] " . $e->get_apiname() . ": " .
        $e->get_errmsg() . "\n");
} catch (Exception $e) {
    die($e);
}
function nextpage()
{
    global $p,$y,$pagenum,$baseopt,$regularfont, $boldfont,$fontsize,$leading, $left, $right,$pagewidth, $pageheight;
//$y +=$leading;
    $p->setfont($regularfont, $fontsize);
    $p->show_xy("Continuation on the next page.", $left, $y);
    $p->setfont($boldfont, $fontsize);
    $p->continue_text("");

    $y=80;
    $p->end_page_ext("");
    $pagenum+=1;
//Start New Page of current Report===============================================================
    $p->begin_page_ext($pagewidth, $pageheight, "topdown");
    $p->setfont($regularfont, $fontsize);
    $p->show_xy("Page $pagenum", $left, $y-20);
    $buf = $header;
    $optlist = sprintf("%s font %d ", $baseopt, $boldfont);
    $textflow = $p->create_textflow($buf, $optlist);

    if ($textflow == 0) {
        die("Error: " . $p->get_errmsg());
    }

    $p->setcolor("fillstroke", "rgb", 0.0, 0.0, 0.0, 0.0);
    $p->setlinewidth(1);
    $p->save();
    $p->moveto($left, $y-$leading);
    $p->lineto($right, $y-$leading);
    $p->moveto($left, $y-$leading+2);
    $p->lineto($right, $y-$leading+2);
    $p->stroke();
    $p->restore();

    $y += 1*$leading;
    $optlist = sprintf("%s font %d ", $baseopt, $regularfont);
    $p->setcolor("fillstroke", "rgb", 0.0, 0.0, 0.0, 0.0);
    $p->setlinewidth(0.1);
}
function print_addressbox()
{
    global $p,$y,$pagenum,$baseopt,$regularfont, $boldfont,$fontsize,$leading, $left, $right,$pagewidth, $pageheight;
    $p->setcolor("fillstroke", "rgb", 0.5, 0.5, 0.5, 0.0);
    $p->setlinewidth(0.5);
    $p->save();

    $windowwidth=200;
    $windowheight=60;
    $windowleft=$left-10;
    $windowtop=$y;
    $p->moveto($windowleft, $windowtop);
    $p->lineto($windowleft, $windowtop+10);
    $p->moveto($windowleft, $windowtop);
    $p->lineto($windowleft+10, $windowtop);

    $p->moveto($windowleft+$windowwidth, $windowtop);
    $p->lineto($windowleft+$windowwidth, $windowtop+10);
    $p->moveto($windowleft+$windowwidth, $windowtop);
    $p->lineto($windowleft+$windowwidth-10, $windowtop);

    $p->moveto($windowleft+$windowwidth, $windowtop+$windowheight);
    $p->lineto($windowleft+$windowwidth, $windowtop+$windowheight-10);
    $p->moveto($windowleft+$windowwidth, $windowtop+$windowheight);
    $p->lineto($windowleft+$windowwidth-10, $windowtop+$windowheight);

    $p->moveto($windowleft, $windowtop+$windowheight);
    $p->lineto($windowleft, $windowtop+$windowheight-10);
    $p->moveto($windowleft, $windowtop+$windowheight);
    $p->lineto($windowleft+10, $windowtop+$windowheight);

    $p->stroke();
    $p->restore();

    $cmane=$this->db->GetVal("select name||' '||suffix from partners where id=$toid");
    $buyer=$this->db->GetVal("select name||' '||suffix from partners where id=$toid");
    $buyername=$this->db->GetVal("select name  from partners where id=$toid");
    $address=$this->db->GetVal("select address from partners where id=$toid");
    $regno=$this->db->GetVal("select certificate from partners where id=$toid");
    $vatno=$this->db->GetVal("select vatno from partners where id=$toid");
    $openpartner=$this->db->GetVal("select name from partners where id=$toid");

    $issueradr=$this->db->GetVal("select address from partners where id=$issuerid");
    $issuercity=$this->db->GetVal("select city||', '||country from partners where id=$issuerid");
    $optlist = sprintf("%s font %d ", "fontsize 11", $boldfont);

    $textflow = $p->create_textflow($buyer, $optlist);
    if ($textflow == 0) {
        die("Error: " . $p->get_errmsg());
    }
    $p->fit_textflow($textflow, $left, $y, $pagewidth/2-40, $y+2*$leading, "fitmethod=auto");
    $p->delete_textflow($textflow);


    $y += 2*$leading;
    $optlist = sprintf("%s font %d ", "fontsize 11", $regularfont);
    $optlistb = sprintf("%s font %d ", "fontsize 11", $boldfont);

    $textflow = $p->create_textflow($address, $optlist);
    if ($textflow == 0) {
        die("Error: " . $p->get_errmsg());
    }
    $p->fit_textflow($textflow, $left, $y, $pagewidth/2-40, $y+3*$leading, "fitmethod=auto");
    $p->delete_textflow($textflow);
}
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
    $p->setlinewidth(0.1);
    $p->save();
    $p->moveto($x-2, $y);
    $p->lineto($x+2, $y);
    $p->moveto($x, $y-2);
    $p->lineto($x, $y+2);
    $p->stroke();
    $p->restore();
    $x2=$x-$left;
    $p->show_xy("X:$x2", $x, $y);
    $p->show_xy("Y:$y", $x, $y+2);
}
$p = 0;
