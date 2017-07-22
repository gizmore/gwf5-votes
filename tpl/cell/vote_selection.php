<?php $field instanceof GDO_VoteSelection; ?>
<div
 class="gwf-vote-selection"
 ng-controller="GWFVoteCtrl"
 ng-init='voteInit(<?php echo $field->initJSON(); ?>);'>
 <jk-rating-stars
 max-rating="5"
 rating="rating"
 read-only="false"
 on-rating="onVote(rating)" >
</jk-rating-stars>
</div>
