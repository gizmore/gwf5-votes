<?php
class GDO_LikeButton extends GDO_Button
{
	public function defaultLabel() { return $this->label('votes'); }

	public function getLikeObject()
	{
		return $this->gdo;
	}
	
	public function renderCell()
	{
		return GWF_Template::modulePHP('Votes', 'cell/like_button.php', ['field'=>$this]);
	}
	
}
