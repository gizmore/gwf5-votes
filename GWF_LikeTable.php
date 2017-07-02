<?php
class GWF_LikeTable extends GDO
{
	/**
	 * @return GDO
	 */
	public function gdoLikeObjectTable() {}
	
	public function gdoCached() { return false; }
	public function gdoAbstract() { return $this->gdoLikeObjectTable() === null; }
	public function gdoColumns()
	{
		return array(
			GDO_User::make('like_user')->primary(),
			GDO_Object::make('like_object')->table($this->gdoLikeObjectTable())->primary(),
			GDO_IP::make('like_ip')->notNull(),
		);
	}
	
}
