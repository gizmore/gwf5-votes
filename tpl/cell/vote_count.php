<?php $field instanceof GDO_VoteCount; ?>
<?php
$gdo = $field->getVoteObject();
$votesNeeded = $gdo->gdoVotesBeforeOutcome();
$votesHave = $gdo->getVoteCount();
if ($votesHave >= $votesNeeded)
{
    echo GDO_Badge::make()->value($field->getGDOVar())->render();
}
else 
{
	echo GDO_Tooltip::make()->tooltip('tt_gdo_votecount_open', [$votesHave, $votesNeeded]);
}
