<?php
trait GWF_LikedObject
{
	public function hasLiked(GWF_User $user)
	{
		return !!$this->getLike($user);
	}
	
	public function getLike(GWF_User $user)
	{
		$likes = $this->gdoLikeTable();
		$likes instanceof GWF_LikeTable;
		return $likes->getLike($user, $this);
	}
	
	public function updateLikes()
	{
		$vars = [];
		foreach ($this->gdoColumnsCache() as $gdoType)
		{
			if ($gdoType instanceof GDO_LikeCount)
			{
				$vars[$gdoType->name] = $this->queryLikeCount()();
			}
		}
		return $this->saveVars($vars);
	}
	
	public function getLikeCount()
	{
		foreach ($this->gdoColumnsCache() as $gdoType)
		{
			if ($gdoType instanceof GDO_LikeCount)
			{
				return $gdoType->getGDOValue();
			}
		}
		return $this->queryLikeCount();
	}
	
	public function queryLikeCount()
	{
		$likes = $this->gdoLikeTable();
		$likes instanceof GWF_LikeTable;
		return $likes->countWhere('like_object='.$this->getID());
	}
	
}
