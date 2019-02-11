<?php
// $df=$this->html->readRQd('df');
// if($df=='')$df=$this->db->getval("SELECT min(valuedate) from transactions");
// $dt=$this->html->readRQd('dt');
// if($dt=='')$dt=$this->dates->F_dateadd_year($df,1);


/*
$persons=$this->data->get_list_array("SELECT id from partners where type=201 and id in (SELECT distinct receiver from transactions where valuedate>='$df' and valuedate<='$dt' and active='t' UNION SELECT distinct sender from transactions where valuedate>='$df' and valuedate<='$dt' and active='t') order by name");
//echo $this->html->pre_display($persons,"persons $df - $dt");exit;
$persons[]=2;
$persons_csv=implode(',',$persons);
$bank_balance1=$this->db->getval("SELECT sum(amount_usd) from transactions where sender=2 and  valuedate<='$df' and receiver in ($persons_csv)");
$bank_balance2=$this->db->getval("SELECT sum(amount_usd) from transactions where sender=2 and  valuedate<='$dt' and receiver in ($persons_csv)");
$bank_balance=$bank_balance2-$bank_balance1;

//$persons=['Alex','Victor','Anna','jack'];


$rows[]=implode(',',['key','value','date']);
$days=$this->dates->F_datediff($df,$dt);
$weeks=round($days/7);

foreach ($persons as $person) {
	$name=$this->data->get_name('partners',$person);;
	$rank=rand(0,99);
	$rank=99;
	$date=$df;
	for ($i=1; $i < $weeks; $i++) {
		$d=sprintf('%02d', $i);

		$in=$this->db->getval("SELECT sum(amount_usd) from transactions where receiver=$person and  valuedate<='$date' and active='t'")*1;
		$out=$this->db->getval("SELECT sum(amount_usd) from transactions where sender=$person and  valuedate<='$date' and active='t'")*1;

		$value=$in-$out;
		if($person==2)$value=$value+$bank_balance;
		//$value=rand(0,99);
		$datejs=$this->dates->F_MDYDate($date,'/',1);

		$rows[]=implode(',',[$name, $value,$datejs]);
		$date=$this->dates->F_dateadd_week($date,1);
	}

}
$JSONData=implode("\n",$rows);
*/

$JSONData='key,value,date
COMAPNY-1 TRADING,0,01/01/04
COMAPNY-1 TRADING,0,01/08/04
COMAPNY-1 TRADING,0,01/15/04
COMAPNY-1 TRADING,0,01/22/04
COMAPNY-1 TRADING,0,01/29/04
COMAPNY-1 TRADING,0,02/05/04
COMAPNY-1 TRADING,0,02/12/04
COMAPNY-1 TRADING,0,02/19/04
COMAPNY-1 TRADING,0,02/26/04
COMAPNY-1 TRADING,0,03/04/04
COMAPNY-1 TRADING,0,03/11/04
COMAPNY-1 TRADING,0,03/18/04
COMAPNY-1 TRADING,0,03/25/04
COMAPNY-1 TRADING,0,04/01/04
COMAPNY-1 TRADING,0,04/08/04
COMAPNY-1 TRADING,0,04/15/04
COMAPNY-1 TRADING,0,04/22/04
COMAPNY-1 TRADING,0,04/29/04
COMAPNY-1 TRADING,0,05/06/04
COMAPNY-1 TRADING,0,05/13/04
COMAPNY-1 TRADING,0,05/20/04
COMAPNY-1 TRADING,0,05/27/04
COMAPNY-1 TRADING,0,06/03/04
COMAPNY-1 TRADING,0,06/10/04
COMAPNY-1 TRADING,0,06/17/04
COMAPNY-1 TRADING,0,06/24/04
COMAPNY-1 TRADING,0,07/01/04
COMAPNY-1 TRADING,0,07/08/04
COMAPNY-1 TRADING,0,07/15/04
COMAPNY-1 TRADING,0,07/22/04
COMAPNY-1 TRADING,0,07/29/04
COMAPNY-1 TRADING,0,08/05/04
COMAPNY-1 TRADING,0,08/12/04
COMAPNY-1 TRADING,0,08/19/04
COMAPNY-1 TRADING,0,08/26/04
COMAPNY-1 TRADING,0,09/02/04
COMAPNY-1 TRADING,0,09/09/04
COMAPNY-1 TRADING,0,09/16/04
COMAPNY-1 TRADING,0,09/23/04
COMAPNY-1 TRADING,0,09/30/04
COMAPNY-1 TRADING,0,10/07/04
COMAPNY-1 TRADING,0,10/14/04
COMAPNY-1 TRADING,0,10/21/04
COMAPNY-1 TRADING,0,10/28/04
COMAPNY-1 TRADING,0,11/04/04
COMAPNY-1 TRADING,0,11/11/04
COMAPNY-1 TRADING,0,11/18/04
COMAPNY-1 TRADING,2000000,11/25/04
COMAPNY-1 TRADING,20171.7,12/02/04
COMAPNY-1 TRADING,20011.7,12/09/04
COMAPNY-1 TRADING,19856.7,12/16/04
COMAPNY-1 TRADING,19856.7,12/23/04
COMAPNY-1 TRADING,19856.7,12/30/04
COMAPNY-1 TRADING,19856.7,01/06/05
COMAPNY-1 TRADING,19856.7,01/13/05
COMAPNY-1 TRADING,19856.7,01/20/05
COMAPNY-2 INC,0,01/01/04
COMAPNY-2 INC,0,01/08/04
COMAPNY-2 INC,0,01/15/04
COMAPNY-2 INC,0,01/22/04
COMAPNY-2 INC,0,01/29/04
COMAPNY-2 INC,0,02/05/04
COMAPNY-2 INC,0,02/12/04
COMAPNY-2 INC,0,02/19/04
COMAPNY-2 INC,0,02/26/04
COMAPNY-2 INC,0,03/04/04
COMAPNY-2 INC,0,03/11/04
COMAPNY-2 INC,0,03/18/04
COMAPNY-2 INC,0,03/25/04
COMAPNY-2 INC,0,04/01/04
COMAPNY-2 INC,0,04/08/04
COMAPNY-2 INC,0,04/15/04
COMAPNY-2 INC,0,04/22/04
COMAPNY-2 INC,0,04/29/04
COMAPNY-2 INC,0,05/06/04
COMAPNY-2 INC,0,05/13/04
COMAPNY-2 INC,0,05/20/04
COMAPNY-2 INC,0,05/27/04
COMAPNY-2 INC,0,06/03/04
COMAPNY-2 INC,0,06/10/04
COMAPNY-2 INC,0,06/17/04
COMAPNY-2 INC,0,06/24/04
COMAPNY-2 INC,0,07/01/04
COMAPNY-2 INC,0,07/08/04
COMAPNY-2 INC,0,07/15/04
COMAPNY-2 INC,0,07/22/04
COMAPNY-2 INC,0,07/29/04
COMAPNY-2 INC,0,08/05/04
COMAPNY-2 INC,0,08/12/04
COMAPNY-2 INC,0,08/19/04
COMAPNY-2 INC,0,08/26/04
COMAPNY-2 INC,0,09/02/04
COMAPNY-2 INC,0,09/09/04
COMAPNY-2 INC,0,09/16/04
COMAPNY-2 INC,0,09/23/04
COMAPNY-2 INC,0,09/30/04
COMAPNY-2 INC,0,10/07/04
COMAPNY-2 INC,0,10/14/04
COMAPNY-2 INC,0,10/21/04
COMAPNY-2 INC,0,10/28/04
COMAPNY-2 INC,0,11/04/04
COMAPNY-2 INC,0,11/11/04
COMAPNY-2 INC,0,11/18/04
COMAPNY-2 INC,44090,11/25/04
COMAPNY-2 INC,44090,12/02/04
COMAPNY-2 INC,44090,12/09/04
COMAPNY-2 INC,44090,12/16/04
COMAPNY-2 INC,44090,12/23/04
COMAPNY-2 INC,43930,12/30/04
COMAPNY-2 INC,43930,01/06/05
COMAPNY-2 INC,47430,01/13/05
COMAPNY-2 INC,47430,01/20/05
COMAPNY-3 ASSOCIATES,0,01/01/04
COMAPNY-3 ASSOCIATES,0,01/08/04
COMAPNY-3 ASSOCIATES,0,01/15/04
COMAPNY-3 ASSOCIATES,0,01/22/04
COMAPNY-3 ASSOCIATES,0,01/29/04
COMAPNY-3 ASSOCIATES,0,02/05/04
COMAPNY-3 ASSOCIATES,0,02/12/04
COMAPNY-3 ASSOCIATES,0,02/19/04
COMAPNY-3 ASSOCIATES,0,02/26/04
COMAPNY-3 ASSOCIATES,0,03/04/04
COMAPNY-3 ASSOCIATES,0,03/11/04
COMAPNY-3 ASSOCIATES,0,03/18/04
COMAPNY-3 ASSOCIATES,0,03/25/04
COMAPNY-3 ASSOCIATES,0,04/01/04
COMAPNY-3 ASSOCIATES,0,04/08/04
COMAPNY-3 ASSOCIATES,0,04/15/04
COMAPNY-3 ASSOCIATES,0,04/22/04
COMAPNY-3 ASSOCIATES,0,04/29/04
COMAPNY-3 ASSOCIATES,0,05/06/04
COMAPNY-3 ASSOCIATES,0,05/13/04
COMAPNY-3 ASSOCIATES,0,05/20/04
COMAPNY-3 ASSOCIATES,0,05/27/04
COMAPNY-3 ASSOCIATES,0,06/03/04
COMAPNY-3 ASSOCIATES,0,06/10/04
COMAPNY-3 ASSOCIATES,0,06/17/04
COMAPNY-3 ASSOCIATES,0,06/24/04
COMAPNY-3 ASSOCIATES,0,07/01/04
COMAPNY-3 ASSOCIATES,0,07/08/04
COMAPNY-3 ASSOCIATES,0,07/15/04
COMAPNY-3 ASSOCIATES,0,07/22/04
COMAPNY-3 ASSOCIATES,0,07/29/04
COMAPNY-3 ASSOCIATES,0,08/05/04
COMAPNY-3 ASSOCIATES,0,08/12/04
COMAPNY-3 ASSOCIATES,0,08/19/04
COMAPNY-3 ASSOCIATES,0,08/26/04
COMAPNY-3 ASSOCIATES,0,09/02/04
COMAPNY-3 ASSOCIATES,0,09/09/04
COMAPNY-3 ASSOCIATES,0,09/16/04
COMAPNY-3 ASSOCIATES,0,09/23/04
COMAPNY-3 ASSOCIATES,0,09/30/04
COMAPNY-3 ASSOCIATES,0,10/07/04
COMAPNY-3 ASSOCIATES,0,10/14/04
COMAPNY-3 ASSOCIATES,0,10/21/04
COMAPNY-3 ASSOCIATES,0,10/28/04
COMAPNY-3 ASSOCIATES,0,11/04/04
COMAPNY-3 ASSOCIATES,0,11/11/04
COMAPNY-3 ASSOCIATES,0,11/18/04
COMAPNY-3 ASSOCIATES,0,11/25/04
COMAPNY-3 ASSOCIATES,0,12/02/04
COMAPNY-3 ASSOCIATES,0,12/09/04
COMAPNY-3 ASSOCIATES,0,12/16/04
COMAPNY-3 ASSOCIATES,0,12/23/04
COMAPNY-3 ASSOCIATES,0,12/30/04
COMAPNY-3 ASSOCIATES,0,01/06/05
COMAPNY-3 ASSOCIATES,0,01/13/05
COMAPNY-3 ASSOCIATES,0,01/20/05
COMAPNY-4 LTD,0,01/01/04
COMAPNY-4 LTD,0,01/08/04
COMAPNY-4 LTD,0,01/15/04
COMAPNY-4 LTD,0,01/22/04
COMAPNY-4 LTD,0,01/29/04
COMAPNY-4 LTD,0,02/05/04
COMAPNY-4 LTD,0,02/12/04
COMAPNY-4 LTD,0,02/19/04
COMAPNY-4 LTD,0,02/26/04
COMAPNY-4 LTD,0,03/04/04
COMAPNY-4 LTD,0,03/11/04
COMAPNY-4 LTD,0,03/18/04
COMAPNY-4 LTD,0,03/25/04
COMAPNY-4 LTD,0,04/01/04
COMAPNY-4 LTD,0,04/08/04
COMAPNY-4 LTD,0,04/15/04
COMAPNY-4 LTD,0,04/22/04
COMAPNY-4 LTD,0,04/29/04
COMAPNY-4 LTD,0,05/06/04
COMAPNY-4 LTD,0,05/13/04
COMAPNY-4 LTD,0,05/20/04
COMAPNY-4 LTD,0,05/27/04
COMAPNY-4 LTD,0,06/03/04
COMAPNY-4 LTD,0,06/10/04
COMAPNY-4 LTD,0,06/17/04
COMAPNY-4 LTD,0,06/24/04
COMAPNY-4 LTD,0,07/01/04
COMAPNY-4 LTD,0,07/08/04
COMAPNY-4 LTD,0,07/15/04
COMAPNY-4 LTD,0,07/22/04
COMAPNY-4 LTD,0,07/29/04
COMAPNY-4 LTD,0,08/05/04
COMAPNY-4 LTD,0,08/12/04
COMAPNY-4 LTD,0,08/19/04
COMAPNY-4 LTD,0,08/26/04
COMAPNY-4 LTD,0,09/02/04
COMAPNY-4 LTD,0,09/09/04
COMAPNY-4 LTD,0,09/16/04
COMAPNY-4 LTD,0,09/23/04
COMAPNY-4 LTD,0,09/30/04
COMAPNY-4 LTD,0,10/07/04
COMAPNY-4 LTD,0,10/14/04
COMAPNY-4 LTD,0,10/21/04
COMAPNY-4 LTD,0,10/28/04
COMAPNY-4 LTD,0,11/04/04
COMAPNY-4 LTD,0,11/11/04
COMAPNY-4 LTD,0,11/18/04
COMAPNY-4 LTD,0,11/25/04
COMAPNY-4 LTD,0,12/02/04
COMAPNY-4 LTD,0,12/09/04
COMAPNY-4 LTD,0,12/16/04
COMAPNY-4 LTD,0,12/23/04
COMAPNY-4 LTD,0,12/30/04
COMAPNY-4 LTD,0,01/06/05
COMAPNY-4 LTD,0,01/13/05
COMAPNY-4 LTD,0,01/20/05
COMAPNY-5 TRADING,0,01/01/04
COMAPNY-5 TRADING,0,01/08/04
COMAPNY-5 TRADING,0,01/15/04
COMAPNY-5 TRADING,0,01/22/04
COMAPNY-5 TRADING,0,01/29/04
COMAPNY-5 TRADING,0,02/05/04
COMAPNY-5 TRADING,0,02/12/04
COMAPNY-5 TRADING,0,02/19/04
COMAPNY-5 TRADING,0,02/26/04
COMAPNY-5 TRADING,0,03/04/04
COMAPNY-5 TRADING,0,03/11/04
COMAPNY-5 TRADING,0,03/18/04
COMAPNY-5 TRADING,0,03/25/04
COMAPNY-5 TRADING,0,04/01/04
COMAPNY-5 TRADING,0,04/08/04
COMAPNY-5 TRADING,0,04/15/04
COMAPNY-5 TRADING,0,04/22/04
COMAPNY-5 TRADING,0,04/29/04
COMAPNY-5 TRADING,0,05/06/04
COMAPNY-5 TRADING,0,05/13/04
COMAPNY-5 TRADING,0,05/20/04
COMAPNY-5 TRADING,0,05/27/04
COMAPNY-5 TRADING,0,06/03/04
COMAPNY-5 TRADING,0,06/10/04
COMAPNY-5 TRADING,0,06/17/04
COMAPNY-5 TRADING,0,06/24/04
COMAPNY-5 TRADING,0,07/01/04
COMAPNY-5 TRADING,0,07/08/04
COMAPNY-5 TRADING,0,07/15/04
COMAPNY-5 TRADING,0,07/22/04
COMAPNY-5 TRADING,0,07/29/04
COMAPNY-5 TRADING,0,08/05/04
COMAPNY-5 TRADING,0,08/12/04
COMAPNY-5 TRADING,0,08/19/04
COMAPNY-5 TRADING,0,08/26/04
COMAPNY-5 TRADING,0,09/02/04
COMAPNY-5 TRADING,0,09/09/04
COMAPNY-5 TRADING,0,09/16/04
COMAPNY-5 TRADING,0,09/23/04
COMAPNY-5 TRADING,0,09/30/04
COMAPNY-5 TRADING,0,10/07/04
COMAPNY-5 TRADING,0,10/14/04
COMAPNY-5 TRADING,9845.82,10/21/04
COMAPNY-5 TRADING,9845.82,10/28/04
COMAPNY-5 TRADING,9845.82,11/04/04
COMAPNY-5 TRADING,9845.82,11/11/04
COMAPNY-5 TRADING,9845.82,11/18/04
COMAPNY-5 TRADING,9845.82,11/25/04
COMAPNY-5 TRADING,9845.82,12/02/04
COMAPNY-5 TRADING,9845.82,12/09/04
COMAPNY-5 TRADING,9845.82,12/16/04
COMAPNY-5 TRADING,9845.82,12/23/04
COMAPNY-5 TRADING,9845.82,12/30/04
COMAPNY-5 TRADING,9845.82,01/06/05
COMAPNY-5 TRADING,9845.82,01/13/05
COMAPNY-5 TRADING,9845.82,01/20/05
COMAPNY-6,0,01/01/04
COMAPNY-6,0,01/08/04
COMAPNY-6,0,01/15/04
COMAPNY-6,0,01/22/04
COMAPNY-6,0,01/29/04
COMAPNY-6,0,02/05/04
COMAPNY-6,0,02/12/04
COMAPNY-6,0,02/19/04
COMAPNY-6,0,02/26/04
COMAPNY-6,0,03/04/04
COMAPNY-6,0,03/11/04
COMAPNY-6,0,03/18/04
COMAPNY-6,0,03/25/04
COMAPNY-6,0,04/01/04
COMAPNY-6,0,04/08/04
COMAPNY-6,0,04/15/04
COMAPNY-6,0,04/22/04
COMAPNY-6,0,04/29/04
COMAPNY-6,0,05/06/04
COMAPNY-6,0,05/13/04
COMAPNY-6,0,05/20/04
COMAPNY-6,0,05/27/04
COMAPNY-6,0,06/03/04
COMAPNY-6,0,06/10/04
COMAPNY-6,0,06/17/04
COMAPNY-6,0,06/24/04
COMAPNY-6,0,07/01/04
COMAPNY-6,0,07/08/04
COMAPNY-6,0,07/15/04
COMAPNY-6,0,07/22/04
COMAPNY-6,0,07/29/04
COMAPNY-6,0,08/05/04
COMAPNY-6,0,08/12/04
COMAPNY-6,0,08/19/04
COMAPNY-6,0,08/26/04
COMAPNY-6,0,09/02/04
COMAPNY-6,0,09/09/04
COMAPNY-6,0,09/16/04
COMAPNY-6,0,09/23/04
COMAPNY-6,0,09/30/04
COMAPNY-6,0,10/07/04
COMAPNY-6,0,10/14/04
COMAPNY-6,0,10/21/04
COMAPNY-6,0,10/28/04
COMAPNY-6,0,11/04/04
COMAPNY-6,0,11/11/04
COMAPNY-6,0,11/18/04
COMAPNY-6,0,11/25/04
COMAPNY-6,0,12/02/04
COMAPNY-6,0,12/09/04
COMAPNY-6,0,12/16/04
COMAPNY-6,0,12/23/04
COMAPNY-6,0,12/30/04
COMAPNY-6,0,01/06/05
COMAPNY-6,0,01/13/05
COMAPNY-6,0,01/20/05
COMAPNY-7 INVESTMENTS,0,01/01/04
COMAPNY-7 INVESTMENTS,0,01/08/04
COMAPNY-7 INVESTMENTS,0,01/15/04
COMAPNY-7 INVESTMENTS,0,01/22/04
COMAPNY-7 INVESTMENTS,0,01/29/04
COMAPNY-7 INVESTMENTS,0,02/05/04
COMAPNY-7 INVESTMENTS,0,02/12/04
COMAPNY-7 INVESTMENTS,0,02/19/04
COMAPNY-7 INVESTMENTS,0,02/26/04
COMAPNY-7 INVESTMENTS,0,03/04/04
COMAPNY-7 INVESTMENTS,0,03/11/04
COMAPNY-7 INVESTMENTS,0,03/18/04
COMAPNY-7 INVESTMENTS,0,03/25/04
COMAPNY-7 INVESTMENTS,0,04/01/04
COMAPNY-7 INVESTMENTS,0,04/08/04
COMAPNY-7 INVESTMENTS,0,04/15/04
COMAPNY-7 INVESTMENTS,0,04/22/04
COMAPNY-7 INVESTMENTS,0,04/29/04
COMAPNY-7 INVESTMENTS,0,05/06/04
COMAPNY-7 INVESTMENTS,0,05/13/04
COMAPNY-7 INVESTMENTS,0,05/20/04
COMAPNY-7 INVESTMENTS,0,05/27/04
COMAPNY-7 INVESTMENTS,0,06/03/04
COMAPNY-7 INVESTMENTS,0,06/10/04
COMAPNY-7 INVESTMENTS,0,06/17/04
COMAPNY-7 INVESTMENTS,0,06/24/04
COMAPNY-7 INVESTMENTS,0,07/01/04
COMAPNY-7 INVESTMENTS,0,07/08/04
COMAPNY-7 INVESTMENTS,0,07/15/04
COMAPNY-7 INVESTMENTS,0,07/22/04
COMAPNY-7 INVESTMENTS,0,07/29/04
COMAPNY-7 INVESTMENTS,0,08/05/04
COMAPNY-7 INVESTMENTS,0,08/12/04
COMAPNY-7 INVESTMENTS,0,08/19/04
COMAPNY-7 INVESTMENTS,0,08/26/04
COMAPNY-7 INVESTMENTS,0,09/02/04
COMAPNY-7 INVESTMENTS,0,09/09/04
COMAPNY-7 INVESTMENTS,0,09/16/04
COMAPNY-7 INVESTMENTS,0,09/23/04
COMAPNY-7 INVESTMENTS,0,09/30/04
COMAPNY-7 INVESTMENTS,0,10/07/04
COMAPNY-7 INVESTMENTS,0,10/14/04
COMAPNY-7 INVESTMENTS,0,10/21/04
COMAPNY-7 INVESTMENTS,0,10/28/04
COMAPNY-7 INVESTMENTS,0,11/04/04
COMAPNY-7 INVESTMENTS,0,11/11/04
COMAPNY-7 INVESTMENTS,0,11/18/04
COMAPNY-7 INVESTMENTS,0,11/25/04
COMAPNY-7 INVESTMENTS,434.62,12/02/04
COMAPNY-7 INVESTMENTS,434.62,12/09/04
COMAPNY-7 INVESTMENTS,434.62,12/16/04
COMAPNY-7 INVESTMENTS,12374.73,12/23/04
COMAPNY-7 INVESTMENTS,12374.73,12/30/04
COMAPNY-7 INVESTMENTS,12374.73,01/06/05
COMAPNY-7 INVESTMENTS,12374.73,01/13/05
COMAPNY-7 INVESTMENTS,12374.73,01/20/05
COMAPNY-8 PARTNERS,0,01/01/04
COMAPNY-8 PARTNERS,0,01/08/04
COMAPNY-8 PARTNERS,0,01/15/04
COMAPNY-8 PARTNERS,0,01/22/04
COMAPNY-8 PARTNERS,0,01/29/04
COMAPNY-8 PARTNERS,0,02/05/04
COMAPNY-8 PARTNERS,114300,02/12/04
COMAPNY-8 PARTNERS,141300,02/19/04
COMAPNY-8 PARTNERS,1339.2000000002,02/26/04
COMAPNY-8 PARTNERS,1339.2000000002,03/04/04
COMAPNY-8 PARTNERS,1339.2000000002,03/11/04
COMAPNY-8 PARTNERS,339.20000000019,03/18/04
COMAPNY-8 PARTNERS,89.200000000186,03/25/04
COMAPNY-8 PARTNERS,489.20000000019,04/01/04
COMAPNY-8 PARTNERS,189.20000000019,04/08/04
COMAPNY-8 PARTNERS,189.20000000019,04/15/04
COMAPNY-8 PARTNERS,123.37000000011,04/22/04
COMAPNY-8 PARTNERS,200108.37,04/29/04
COMAPNY-8 PARTNERS,600108.37,05/06/04
COMAPNY-8 PARTNERS,960108.37,05/13/04
COMAPNY-8 PARTNERS,960108.37,05/20/04
COMAPNY-8 PARTNERS,970108.37,05/27/04
COMAPNY-8 PARTNERS,960073.37,06/03/04
COMAPNY-8 PARTNERS,960073.37,06/10/04
COMAPNY-8 PARTNERS,960073.37,06/17/04
COMAPNY-8 PARTNERS,960073.37,06/24/04
COMAPNY-8 PARTNERS,960073.37,07/01/04
COMAPNY-8 PARTNERS,960063.37,07/08/04
COMAPNY-8 PARTNERS,15107919.37,07/15/04
COMAPNY-8 PARTNERS,15101171.93,07/22/04
COMAPNY-8 PARTNERS,20101171.93,07/29/04
COMAPNY-8 PARTNERS,20088136.93,08/05/04
COMAPNY-8 PARTNERS,19585381.93,08/12/04
COMAPNY-8 PARTNERS,19580046.49,08/19/04
COMAPNY-8 PARTNERS,19379936.49,08/26/04
COMAPNY-8 PARTNERS,17719091.49,09/02/04
COMAPNY-8 PARTNERS,16818771.49,09/09/04
COMAPNY-8 PARTNERS,19081782.75,09/16/04
COMAPNY-8 PARTNERS,21164482.75,09/23/04
COMAPNY-8 PARTNERS,23514714.54,09/30/04
COMAPNY-8 PARTNERS,22944415.15,10/07/04
COMAPNY-8 PARTNERS,22514440.06,10/14/04
COMAPNY-8 PARTNERS,21793518.12,10/21/04
COMAPNY-8 PARTNERS,21632501.12,10/28/04
COMAPNY-8 PARTNERS,21532441.12,11/04/04
COMAPNY-8 PARTNERS,21177423.12,11/11/04
COMAPNY-8 PARTNERS,20781559.56,11/18/04
COMAPNY-8 PARTNERS,12804034.56,11/25/04
COMAPNY-8 PARTNERS,14912266.88,12/02/04
COMAPNY-8 PARTNERS,6497106.88,12/09/04
COMAPNY-8 PARTNERS,6212396.88,12/16/04
COMAPNY-8 PARTNERS,294383.59,12/23/04
COMAPNY-8 PARTNERS,750656.34,12/30/04
COMAPNY-8 PARTNERS,750656.34,01/06/05
COMAPNY-8 PARTNERS,746776.34,01/13/05
COMAPNY-8 PARTNERS,615457.45,01/20/05
COMAPNY-9,0,01/01/04
COMAPNY-9,0,01/08/04
COMAPNY-9,0,01/15/04
COMAPNY-9,0,01/22/04
COMAPNY-9,0,01/29/04
COMAPNY-9,0,02/05/04
COMAPNY-9,0,02/12/04
COMAPNY-9,0,02/19/04
COMAPNY-9,0,02/26/04
COMAPNY-9,0,03/04/04
COMAPNY-9,0,03/11/04
COMAPNY-9,0,03/18/04
COMAPNY-9,0,03/25/04
COMAPNY-9,0,04/01/04
COMAPNY-9,0,04/08/04
COMAPNY-9,0,04/15/04
COMAPNY-9,0,04/22/04
COMAPNY-9,0,04/29/04
COMAPNY-9,0,05/06/04
COMAPNY-9,0,05/13/04
COMAPNY-9,0,05/20/04
COMAPNY-9,0,05/27/04
COMAPNY-9,0,06/03/04
COMAPNY-9,0,06/10/04
COMAPNY-9,0,06/17/04
COMAPNY-9,0,06/24/04
COMAPNY-9,0,07/01/04
COMAPNY-9,0,07/08/04
COMAPNY-9,0,07/15/04
COMAPNY-9,0,07/22/04
COMAPNY-9,0,07/29/04
COMAPNY-9,0,08/05/04
COMAPNY-9,0,08/12/04
COMAPNY-9,0,08/19/04
COMAPNY-9,0,08/26/04
COMAPNY-9,0,09/02/04
COMAPNY-9,0,09/09/04
COMAPNY-9,0,09/16/04
COMAPNY-9,0,09/23/04
COMAPNY-9,0,09/30/04
COMAPNY-9,0,10/07/04
COMAPNY-9,0,10/14/04
COMAPNY-9,0,10/21/04
COMAPNY-9,0,10/28/04
COMAPNY-9,0,11/04/04
COMAPNY-9,0,11/11/04
COMAPNY-9,0,11/18/04
COMAPNY-9,0,11/25/04
COMAPNY-9,2000000,12/02/04
COMAPNY-9,2000000,12/09/04
COMAPNY-9,2000000,12/16/04
COMAPNY-9,2000000,12/23/04
COMAPNY-9,49840,12/30/04
COMAPNY-9,49840,01/06/05
COMAPNY-9,49840,01/13/05
COMAPNY-9,49840,01/20/05
COMAPNY-10 HOLDINGS,0,01/01/04
COMAPNY-10 HOLDINGS,0,01/08/04
COMAPNY-10 HOLDINGS,0,01/15/04
COMAPNY-10 HOLDINGS,0,01/22/04
COMAPNY-10 HOLDINGS,0,01/29/04
COMAPNY-10 HOLDINGS,0,02/05/04
COMAPNY-10 HOLDINGS,480,02/12/04
COMAPNY-10 HOLDINGS,320,02/19/04
COMAPNY-10 HOLDINGS,3200,02/26/04
COMAPNY-10 HOLDINGS,3200,03/04/04
COMAPNY-10 HOLDINGS,3200,03/11/04
COMAPNY-10 HOLDINGS,3700,03/18/04
COMAPNY-10 HOLDINGS,79.660000000149,03/25/04
COMAPNY-10 HOLDINGS,79.660000000149,04/01/04
COMAPNY-10 HOLDINGS,229.66000000015,04/08/04
COMAPNY-10 HOLDINGS,147.45999999996,04/15/04
COMAPNY-10 HOLDINGS,147.45999999996,04/22/04
COMAPNY-10 HOLDINGS,147.45999999996,04/29/04
COMAPNY-10 HOLDINGS,147.45999999996,05/06/04
COMAPNY-10 HOLDINGS,147.45999999996,05/13/04
COMAPNY-10 HOLDINGS,147.45999999996,05/20/04
COMAPNY-10 HOLDINGS,147.45999999996,05/27/04
COMAPNY-10 HOLDINGS,147.45999999996,06/03/04
COMAPNY-10 HOLDINGS,147.45999999996,06/10/04
COMAPNY-10 HOLDINGS,147.45999999996,06/17/04
COMAPNY-10 HOLDINGS,147.45999999996,06/24/04
COMAPNY-10 HOLDINGS,147.45999999996,07/01/04
COMAPNY-10 HOLDINGS,137.45999999996,07/08/04
COMAPNY-10 HOLDINGS,137.45999999996,07/15/04
COMAPNY-10 HOLDINGS,137.45999999996,07/22/04
COMAPNY-10 HOLDINGS,137.45999999996,07/29/04
COMAPNY-10 HOLDINGS,137.45999999996,08/05/04
COMAPNY-10 HOLDINGS,137.45999999996,08/12/04
COMAPNY-10 HOLDINGS,212.6799999997,08/19/04
COMAPNY-10 HOLDINGS,102.45999999996,08/26/04
COMAPNY-10 HOLDINGS,102.45999999996,09/02/04
COMAPNY-10 HOLDINGS,102.45999999996,09/09/04
COMAPNY-10 HOLDINGS,102.45999999996,09/16/04
COMAPNY-10 HOLDINGS,102.45999999996,09/23/04
COMAPNY-10 HOLDINGS,102.45999999996,09/30/04
COMAPNY-10 HOLDINGS,5727428.78,10/07/04
COMAPNY-10 HOLDINGS,5727428.78,10/14/04
COMAPNY-10 HOLDINGS,4727268.78,10/21/04
COMAPNY-10 HOLDINGS,4727268.78,10/28/04
COMAPNY-10 HOLDINGS,4727268.78,11/04/04
COMAPNY-10 HOLDINGS,4727268.78,11/11/04
COMAPNY-10 HOLDINGS,4727268.78,11/18/04
COMAPNY-10 HOLDINGS,4727268.78,11/25/04
COMAPNY-10 HOLDINGS,4727268.78,12/02/04
COMAPNY-10 HOLDINGS,4727268.78,12/09/04
COMAPNY-10 HOLDINGS,4727268.78,12/16/04
COMAPNY-10 HOLDINGS,4727268.78,12/23/04
COMAPNY-10 HOLDINGS,927268.78,12/30/04
COMAPNY-10 HOLDINGS,927268.78,01/06/05
COMAPNY-10 HOLDINGS,927268.78,01/13/05
COMAPNY-10 HOLDINGS,915613.32,01/20/05
COMAPNY-11,0,01/01/04
COMAPNY-11,0,01/08/04
COMAPNY-11,0,01/15/04
COMAPNY-11,0,01/22/04
COMAPNY-11,0,01/29/04
COMAPNY-11,0,02/05/04
COMAPNY-11,0,02/12/04
COMAPNY-11,0,02/19/04
COMAPNY-11,0,02/26/04
COMAPNY-11,0,03/04/04
COMAPNY-11,0,03/11/04
COMAPNY-11,0,03/18/04
COMAPNY-11,0,03/25/04
COMAPNY-11,0,04/01/04
COMAPNY-11,0,04/08/04
COMAPNY-11,0,04/15/04
COMAPNY-11,0,04/22/04
COMAPNY-11,0,04/29/04
COMAPNY-11,0,05/06/04
COMAPNY-11,0,05/13/04
COMAPNY-11,0,05/20/04
COMAPNY-11,0,05/27/04
COMAPNY-11,0,06/03/04
COMAPNY-11,0,06/10/04
COMAPNY-11,0,06/17/04
COMAPNY-11,0,06/24/04
COMAPNY-11,0,07/01/04
COMAPNY-11,0,07/08/04
COMAPNY-11,0,07/15/04
COMAPNY-11,0,07/22/04
COMAPNY-11,0,07/29/04
COMAPNY-11,0,08/05/04
COMAPNY-11,0,08/12/04
COMAPNY-11,0,08/19/04
COMAPNY-11,0,08/26/04
COMAPNY-11,0,09/02/04
COMAPNY-11,0,09/09/04
COMAPNY-11,0,09/16/04
COMAPNY-11,0,09/23/04
COMAPNY-11,0,09/30/04
COMAPNY-11,0,10/07/04
COMAPNY-11,0,10/14/04
COMAPNY-11,0,10/21/04
COMAPNY-11,0,10/28/04
COMAPNY-11,0,11/04/04
COMAPNY-11,0,11/11/04
COMAPNY-11,0,11/18/04
COMAPNY-11,0,11/25/04
COMAPNY-11,1983383.42,12/02/04
COMAPNY-11,1983383.42,12/09/04
COMAPNY-11,1983383.42,12/16/04
COMAPNY-11,1983383.42,12/23/04
COMAPNY-11,1983383.42,12/30/04
COMAPNY-11,1983383.42,01/06/05
COMAPNY-11,1983383.42,01/13/05
COMAPNY-11,1983383.42,01/20/05
COMAPNY-12 INVESTMENTS,0,01/01/04
COMAPNY-12 INVESTMENTS,0,01/08/04
COMAPNY-12 INVESTMENTS,0,01/15/04
COMAPNY-12 INVESTMENTS,0,01/22/04
COMAPNY-12 INVESTMENTS,0,01/29/04
COMAPNY-12 INVESTMENTS,0,02/05/04
COMAPNY-12 INVESTMENTS,0,02/12/04
COMAPNY-12 INVESTMENTS,820,02/19/04
COMAPNY-12 INVESTMENTS,4060.7999999998,02/26/04
COMAPNY-12 INVESTMENTS,4060.7999999998,03/04/04
COMAPNY-12 INVESTMENTS,4060.7999999998,03/11/04
COMAPNY-12 INVESTMENTS,4560.7999999998,03/18/04
COMAPNY-12 INVESTMENTS,147.21999999974,03/25/04
COMAPNY-12 INVESTMENTS,147.21999999974,04/01/04
COMAPNY-12 INVESTMENTS,297.21999999974,04/08/04
COMAPNY-12 INVESTMENTS,215.02000000002,04/15/04
COMAPNY-12 INVESTMENTS,215.02000000002,04/22/04
COMAPNY-12 INVESTMENTS,215.02000000002,04/29/04
COMAPNY-12 INVESTMENTS,215.02000000002,05/06/04
COMAPNY-12 INVESTMENTS,215.02000000002,05/13/04
COMAPNY-12 INVESTMENTS,215.02000000002,05/20/04
COMAPNY-12 INVESTMENTS,215.02000000002,05/27/04
COMAPNY-12 INVESTMENTS,215.02000000002,06/03/04
COMAPNY-12 INVESTMENTS,215.02000000002,06/10/04
COMAPNY-12 INVESTMENTS,215.02000000002,06/17/04
COMAPNY-12 INVESTMENTS,215.02000000002,06/24/04
COMAPNY-12 INVESTMENTS,215.02000000002,07/01/04
COMAPNY-12 INVESTMENTS,205.02000000002,07/08/04
COMAPNY-12 INVESTMENTS,205.02000000002,07/15/04
COMAPNY-12 INVESTMENTS,205.02000000002,07/22/04
COMAPNY-12 INVESTMENTS,205.02000000002,07/29/04
COMAPNY-12 INVESTMENTS,205.02000000002,08/05/04
COMAPNY-12 INVESTMENTS,872.4299999997,08/12/04
COMAPNY-12 INVESTMENTS,947.64999999991,08/19/04
COMAPNY-12 INVESTMENTS,837.43000000017,08/26/04
COMAPNY-12 INVESTMENTS,837.43000000017,09/02/04
COMAPNY-12 INVESTMENTS,837.43000000017,09/09/04
COMAPNY-12 INVESTMENTS,837.43000000017,09/16/04
COMAPNY-12 INVESTMENTS,837.43000000017,09/23/04
COMAPNY-12 INVESTMENTS,837.43000000017,09/30/04
COMAPNY-12 INVESTMENTS,5183415.58,10/07/04
COMAPNY-12 INVESTMENTS,5183415.58,10/14/04
COMAPNY-12 INVESTMENTS,2683255.58,10/21/04
COMAPNY-12 INVESTMENTS,2683255.58,10/28/04
COMAPNY-12 INVESTMENTS,2683255.58,11/04/04
COMAPNY-12 INVESTMENTS,2683255.58,11/11/04
COMAPNY-12 INVESTMENTS,2683255.58,11/18/04
COMAPNY-12 INVESTMENTS,2683255.58,11/25/04
COMAPNY-12 INVESTMENTS,2683255.58,12/02/04
COMAPNY-12 INVESTMENTS,2683255.58,12/09/04
COMAPNY-12 INVESTMENTS,2683255.58,12/16/04
COMAPNY-12 INVESTMENTS,2683255.58,12/23/04
COMAPNY-12 INVESTMENTS,2683255.58,12/30/04
COMAPNY-12 INVESTMENTS,2897255.58,01/06/05
COMAPNY-12 INVESTMENTS,2897255.58,01/13/05
COMAPNY-12 INVESTMENTS,2897255.58,01/20/05
BANK,21445434.64,01/01/04
BANK,21445434.64,01/08/04
BANK,21445434.64,01/15/04
BANK,21445434.64,01/22/04
BANK,21445434.64,01/29/04
BANK,21445434.64,02/05/04
BANK,19541134.64,02/12/04
BANK,19513474.64,02/19/04
BANK,19647314.64,02/26/04
BANK,19647314.64,03/04/04
BANK,19647314.64,03/11/04
BANK,19647314.64,03/18/04
BANK,19655598.56,03/25/04
BANK,19655198.56,04/01/04
BANK,19655198.56,04/08/04
BANK,19655362.96,04/15/04
BANK,19655428.79,04/22/04
BANK,19455443.79,04/29/04
BANK,19055443.79,05/06/04
BANK,18695443.79,05/13/04
BANK,18695443.79,05/20/04
BANK,18685443.79,05/27/04
BANK,18695478.79,06/03/04
BANK,18695478.79,06/10/04
BANK,18695478.79,06/17/04
BANK,18695478.79,06/24/04
BANK,18695478.79,07/01/04
BANK,18695508.79,07/08/04
BANK,4547652.79,07/15/04
BANK,4554400.23,07/22/04
BANK,-445599.77,07/29/04
BANK,-432564.77,08/05/04
BANK,71022.82,08/12/04
BANK,76207.82,08/19/04
BANK,276538.26,08/26/04
BANK,1937383.26,09/02/04
BANK,2837703.26,09/09/04
BANK,574691.99999999,09/16/04
BANK,-1508008,09/23/04
BANK,-3858239.79,09/30/04
BANK,-8470518.55,10/07/04
BANK,-8040543.46,10/14/04
BANK,-4829307.34,10/21/04
BANK,-4668290.34,10/28/04
BANK,-4568230.34,11/04/04
BANK,-4213212.34,11/11/04
BANK,-3817348.78,11/18/04
BANK,2116086.22,11/25/04
BANK,-808207.53000001,12/02/04
BANK,7217118.47,12/09/04
BANK,7231828.47,12/16/04
BANK,8109996.76,12/23/04
BANK,17653894.01,12/30/04
BANK,17653894.01,01/06/05
BANK,17650691.37,01/13/05
BANK,17778130.72,01/20/05';


header('Content-type: application/json');
echo $JSONData; exit;
