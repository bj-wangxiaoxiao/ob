<?php

namespace app\modules\test\testson\controllers;

use yii\web\Controller;

/**
 * Default controller for the `testson` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
    	//http://ob.com/test/testson/default/index
        return $this->render('index');
    }
}
