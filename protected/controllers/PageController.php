<?php

class PageController extends Controller{
		public $layout='//layouts/vcoin';

		public function filters(){

                return array(
                        'accessControl',
                );
        }

        public function accessRules(){
                return array(
						array('allow',
                              'actions'=>array('about','terms',"news","road_map","contact"),
                              'users'=>array('*'),
                              ),
                );
        }

	public function actions(){
		return array(
			"about" 			=> "application.controllers.page.AboutAction",
			"terms" 			=> "application.controllers.page.TermsAction",
			"news" 				=> "application.controllers.page.NewsAction",
		    "road_map"			=> "application.controllers.page.RoadMapAction",
			"contact"			=> "application.controllers.page.ContactAction",
		);
	}

}
