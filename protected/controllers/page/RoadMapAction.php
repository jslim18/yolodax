<?php
class RoadMapAction extends CAction{

	public function run(){
		$controller = $this->getController();
	    $controller->render("road_map");
	}
}