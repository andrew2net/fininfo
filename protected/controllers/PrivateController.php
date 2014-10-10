<?php

/**
 * Description of PrivateController
 *
 */
class PrivateController extends Controller {

	public function filters()
	{
		return array(
      array('application.modules.admin.modules.auth.filters.AuthFilter'),
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

  public function actionIndex() {
    
    $this->render('index');
  }

}
