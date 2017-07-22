<?php $field instanceof GDO_VoteRating; ?>
<?php
$gdo = $field->getVoteObject();
$votesNeeded = $gdo->gdoVotesBeforeOutcome();
$votesHave = $gdo->getVoteCount();
if ($votesHave >= $votesNeeded)
{
    $value = sprintf('%.01f', $field->getGDOVar());
    echo GDO_Badge::make()->value($field->getGDOVar())->render();
}
else 
{
	echo GDO_Tooltip::make()->tooltip('tt_gdo_votecount_open', [$votesHave, $votesNeeded]);
}
