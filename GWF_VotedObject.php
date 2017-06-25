<?php
trait GWF_VotedObject
{
	public function hasVoted(GWF_User $user)
	{
		return !!$this->getVote($user);
	}
	
	public function getVote(GWF_User $user)
	{
		$votes = $this->gdoVoteTable();
		$votes instanceof GWF_VoteTable;
		return $votes->getVote($user, $this);
	}
	
	public function updateVotes()
	{
		$vars = [];
		foreach ($this->gdoColumnsCache() as $gdoType)
		{
			if ($gdoType instanceof GDO_VoteCount)
			{
				$vars[$gdoType->name] = $this->queryVoteCount();
			}
			elseif ($gdoType instanceof GDO_VoteRating)
			{
				$vars[$gdoType->name] = $this->queryVoteRating();
			}
		}
		return $this->saveVars($vars);
	}
	
	public function getVoteCount()
	{
		foreach ($this->gdoColumnsCache() as $gdoType)
		{
			if ($gdoType instanceof GDO_VoteCount)
			{
				return $gdoType->getGDOValue();
			}
		}
		return $this->queryVoteCount();
	}
	
	public function queryVoteCount()
	{
		$votes = $this->gdoVoteTable();
		$votes instanceof GWF_VoteTable;
		return $votes->countWhere('vote_object='.$this->getID());
	}
	
	public function getVoteRating()
	{
		foreach ($this->gdoColumnsCache() as $gdoType)
		{
			if ($gdoType instanceof GDO_VoteRating)
			{
				return $gdoType->getGDOValue();
			}
		}
		return $this->queryVoteRating();
	}
	
	public function queryVoteRating()
	{
		$votes = $this->gdoVoteTable();
		$votes instanceof GWF_VoteTable;
		return (int) $votes->select('AVG(vote_value)')->where('vote_object='.$this->getID())->exec()->fetchValue();
	}
	
}
