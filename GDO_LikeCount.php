<?php
class GDO_LikeCount extends GDO_VoteCount
{
	public $writable = false;
	public $editable = false;
	
	public function defaultLabel() { return $this->label('likes'); }

	public function getLikeObject()
	{
		return $this->gdo;
	}
	
	public function renderCell()
	{
		return GWF_Template::modulePHP('Votes', 'cell/like_count.php', ['field'=>$this]);
	}
	
}
