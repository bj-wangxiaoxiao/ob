<?php

namespace app\modules\test;

/**
 * test module definition class
 */
class Test extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\test\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
		$this->modules=[
			'testson' => [
				'class' => 'app\modules\test\testson\Testson',
			],
		];
        // custom initialization code goes here
    }
}
