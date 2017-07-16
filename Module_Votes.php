<?php
final class Module_Votes extends GWF_Module
{
	public $module_priority = 25;
	
	public function onLoadLanguage() { $this->loadLanguage('lang/votes'); }
	
	public function getClasses()
	{
		return ['GWF_VoteTable', 'GWF_VotedObject', 'GDO_VoteSelection', 'GDO_VoteCount', 'GDO_VoteRating',
				'GWF_LikeTable', 'GWF_LikedObject', 'GDO_LikeButton', 'GDO_LikeCount'];
	}
	
	public function onIncludeScripts()
	{
		$min = Module_GWF::instance()->cfgMinifyJS() !== 'no' ? '.min' : '';
		$this->addJavascript('js/gwf-vote-ctrl.js');
	}
}
