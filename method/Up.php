<?php
final class Votes_Up extends GWF_Method
{
	public function execute()
	{
		$user = GWF_User::current();
		
		# Get GWF_VoteTable, e.g. GWF_LinkVote
		$class= Common::getRequestString('gdo');
		if (!class_exists($class, false))
		{
			return $this->error('err_vote_gdo');
		}
		if (!is_subclass_of($class, 'GWF_VoteTable'))
		{
			return $this->error('err_vote_table');
		}
		$table = GDO::tableFor($class);
		$table instanceof GWF_VoteTable;
		
		# Get GDO table, e.g. GWF_Link
		$objects = $table->gdoVoteObjectTable();
		$objects instanceof GDO;
		
		# Get GDO row, e.g. GWF_Link
		$object = $objects->find(Common::getRequestString('id'));
		
		# Check rate value
		if ( (!($value = Common::getRequestInt('rate'))) ||
			 (($value < 1) || ($value > $object->gdoVoteMax())) )
		{
			return $this->error('err_rate_param_between', [1, $object->gdoVoteMax()]);
		}
		
		$count = $table->countWhere(sprintf("vote_object=%s AND vote_ip='%s' AND vote_user!=%s", $object->getID(), GDO_IP::current(), $user->getID()));
		
		if ($count === 0)
		{
			# Vote
			$vote = $class::blank(array(
				'vote_user' => $user->getID(),
				'vote_object' => $object->getID(),
				'vote_ip' => GDO_IP::current(),
				'vote_value' => $value,
			));
			$vote instanceof GWF_VoteTable;
			$vote->replace();
			
			# Update cache
			$object->setVar('own_vote', $value);
			$object->updateVotes();

			return GWF_Response::make(array(
				'object' => $object->toJSON(),
				'message' => t('msg_voted'), 
			));
		}
		
		return $this->error('err_vote_ip');

	}
	
}
