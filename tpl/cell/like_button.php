<?php $field instanceof GDO_LikeButton;
$user = GWF_User::current();
$gdo = $field->getLikeObject();
$liked = $gdo->hasLiked($user);
$likes = $gdo->getLikes();

$field->icon('plus_one');
?>
<a
 class="md-button primary"
 ng-disabled="<?php echo $liked ? 'true' : 'false'; ?>"
 href="<?php echo $field->href; ?>"><?php echo $likes; ?></a>
