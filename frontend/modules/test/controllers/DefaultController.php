<?php

namespace app\modules\test\controllers;

use yii\web\Controller;

/**
 * Default controller for the `test` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
    	//http://ob.com/test/default/index
        return $this->render('index');
    }
}
