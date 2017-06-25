<?php
final class Module_Votes extends GWF_Module
{
	public $module_priority = 40;
	public function getClasses() { return ['GWF_VoteTable', 'GWF_VotedObject', 'GDO_VoteSelection', 'GDO_VoteCount', 'GDO_VoteRating']; }
	
	public function onIncludeScripts()
	{
		$min = Module_GWF::instance()->cfgMinifyJS() !== 'no' ? '.min' : '';
		$this->addJavascript('js/gwf-vote-ctrl.js');
	}
}
