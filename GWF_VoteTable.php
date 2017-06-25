<?php
class GWF_VoteTable extends GDO
{
	/**
	 * @return GDO
	 */
	public function gdoVoteObjectTable() {}
	
	public function gdoCached() { return false; }
	public function gdoAbstract() { return $this->gdoVoteObjectTable() === null; }
	public function gdoColumns()
	{
		return array(
			GDO_User::make('vote_user')->primary(),
			GDO_Object::make('vote_object')->table($this->gdoVoteObjectTable())->primary(),
			GDO_IP::make('vote_ip')->notNull(),
			GDO_Int::make('vote_value')->notNull()->unsigned()->bytes(1),
		);
	}
	
}