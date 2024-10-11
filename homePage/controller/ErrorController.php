<?php


class ErrorController {

	public function errorController() {

		try{
		require_once('./homePage/view/error.php');
	} catch (Exception $e) {
		handleException($e);
	}
	}

}



