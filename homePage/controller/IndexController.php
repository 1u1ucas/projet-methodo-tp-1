<?php


class IndexController {


	
	public function index() {

		try{
		require_once('./homePage/view/home.php');
	} catch (Exception $e) {
		handleException($e);
	}
	}

}



