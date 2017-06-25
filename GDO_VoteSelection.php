<?php
final class GDO_VoteSelection extends GDOType
{
	public function defaultLabel()
	{
		return $this->label('vote');
	}
	
	/**
	 * @return GWF_VoteTable
	 */
	public function voteTable()
	{
		return $this->gdo->gdoVoteTable();
	}
	
	public function voteCount()
	{
		return $this->gdo->getVoteCount();
	}
	
	public function voteRating()
	{
		return $this->gdo->getVoteRating();
	}
	
	public function initJSON()
	{
		return json_encode(array(
			'rating' => $this->voteRating(),
			'own_vote' => $this->gdo->getVar('own_vote'),
			'count' => $this->voteCount(),
			'voteurl' => href('Votes', 'Up', '&gdo='.$this->voteTable()->gdoClassName().'&id='.$this->gdo->getID()),
		));
	}
	
	public function renderCell()
	{
		return GWF_Template::modulePHP('Votes', 'cell/vote_selection.php', ['field'=>$this]);
	}
}
