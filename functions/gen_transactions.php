<?php
$result[input] = $args; //['year'=>$year, 'qty'=>$qty];

$this->db->getval("DELETE from books_transactions where id>1");
for ($i=0; $i < $args[qty]; $i++)
{


	$date_start = "01.01.$args[year]";

	$date = $this->dates->F_dateadd($date_start,rand(1,365));
	$date_from = $this->dates->F_date($date,1);
	$date_to = $this->dates->F_dateadd($date_from,rand(10,14));

	$name = $this->data->get_new_name('books_transactions', $date,'','BTR-');

	$max_entity_id=$this->db->getval("SELECT max(id) from entities where active='1'");
	$entity_id=rand(1,$max_entity_id);

	$max_book_id=$this->db->getval("SELECT id from books where active='1' order by id desc limit 1");
	$book_id=rand(1,$max_book_id);

	$type_id=rand(1,4);

	if($type_id==2)$rating=rand(1,5); else $rating=0;
	$vals=[
	    'name' => $name,
	    'date' => $date,
	    'user_id' => $GLOBALS[uid],
	    'entity_id' => $entity_id,
	    'type_id' => $type_id,
	    'book_id' => $book_id,
	    'date_from' => $date_from,
	    'date_to' => $date_to,
	    'rating' => $rating,

	];

	//echo $this->html->pre_display($vals,"Insert Transactions $vals[name]");
	$id=$this->db->insert_db('books_transactions', $vals);
	$result[output][ids][]=$id;
	//echo "NEW ID:$id<br>";

}


return $result;