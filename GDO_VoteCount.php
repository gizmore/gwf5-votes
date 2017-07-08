<?php
class GDO_VoteCount extends  GDO_Int
{
	public $writable = false;
	public $editable = false;
	
	public function defaultLabel() { return $this->label('votes'); }

	public function __construct()
	{
		$this->unsigned = true;
		$this->initial = "0";
	}
	
	public function getVoteObject()
	{
		return $this->gdo;
	}
	
	public function renderCell()
	{
		return GWF_Template::modulePHP('Votes', 'cell/vote_count.php', ['field'=>$this]);
	}
	
}
