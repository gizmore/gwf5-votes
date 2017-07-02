<?php
final class Votes_Like extends GWF_Method
{
	public function execute()
	{
		$user = GWF_User::current();
		
		# Get GWF_LikeTable, e.g. GWF_ProfileLike
		$class = Common::getRequestString('gdo');
		if (!class_exists($class, false))
		{
			return $this->error('err_vote_gdo');
		}
		if (!is_subclass_of($class, 'GWF_LikeTable'))
		{
			return $this->error('err_vote_table');
		}
		$table = GDO::tableFor($class);
		$table instanceof GWF_LikeTable;
		
		# Get GDO table, e.g. GWF_Link
		$objects = $table->gdoLikeObjectTable();
		$objects instanceof GDO;
		
		# Get GDO row, e.g. GWF_Link
		$object = $objects->find(Common::getRequestString('id'));
		
		$count = $table->countWhere(sprintf("like_object=%s AND like_ip='%s'", $object->getID(), GDO_IP::current()));
		
		if ($count === 0)
		{
			# Vote
			$like = $class::blank(array(
				'like_user' => $user->getID(),
				'like_object' => $object->getID(),
				'like_ip' => GDO_IP::current(),
			));
			$like instanceof GWF_LikeTable;
			$like->replace();
			
			# Update cache
			$object->updateLikes();

			return GWF_Response::make(array(
				'object' => $object->toJSON(),
				'message' => t('msg_liked'), 
			));
		}
		
		return $this->error('err_vote_ip');

	}
	
}
