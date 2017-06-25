<?php $field instanceof GDO_VoteRating; ?>
<?php
$gdo = $field->getVoteObject();
$votesNeeded = $gdo->gdoVotesBeforeOutcome();
$votesHave = $gdo->getVoteCount();
if ($votesHave >= $votesNeeded)
{
	printf('%.01f', $field->getGDOVar());
}
else 
{
	echo GDO_Tooltip::make()->tooltip('tt_gdo_votecount_open', [$votesHave, $votesNeeded]);
}
