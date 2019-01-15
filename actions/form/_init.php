<?php 
if($this->data->field_exists($what, 'user_id')) {
	$user_id=$this->data->get_val($what,'user_id',$id);
	if(($user_id!=$GLOBALS[uid])&&(!$GLOBALS[access][main_admin]))$this->html->error('Not allowed');
	//echo $this->html->pre_display($user_id,"user_id");

}else{
  	//$this->html->error('Not allowed');
}