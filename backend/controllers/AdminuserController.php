<?php
/**
 * User: wangxiaoxiao
 * Description: 管理员管理
 */
namespace backend\controllers;

use backend\models\AuthAssignment;
use backend\models\SignupForm;
use backend\models\AuthItem;
use Yii;
use common\models\AdminUser;
use common\models\AdminuserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminuserSearchController implements the CRUD actions for AdminUser model.
 */
class AdminuserController extends AdminBaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AdminUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminuserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionTest(){
    	echo 1;die;
    }

    public function actionAssignment(){
	    return $this->render('assignment');
    }
    /**
     * Displays a single AdminUser model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AdminUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $Adminuser = $model->signup()) {
            return $this->redirect(['view', 'id' => $Adminuser->admin_user_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AdminUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->admin_user_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AdminUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AdminUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminUser::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	public function actionPrivilege($id)
	{
		//step1. 找出所有权限,提供给checkboxlist
		$allPrivileges = AuthItem::find()->select(['name','description'])
			->where(['type'=>1])->orderBy('description')->all();
		if(empty($allPrivileges)){
			throw new NotFoundHttpException('当前系统无角色存在，请联系开发人员初始化！');
		}
		foreach ($allPrivileges as $pri)
		{
			$allPrivilegesArray[$pri->name]=$pri->description;
		}
		//step2. 当前用户的权限
		
		$AuthAssignments=AuthAssignment::find()->select(['item_name'])
			->where(['user_id'=>$id])->orderBy('item_name')->all();
		
		$AuthAssignmentsArray = array();
		
		foreach ($AuthAssignments as $AuthAssignment)
		{
			array_push($AuthAssignmentsArray,$AuthAssignment->item_name);
		}
		
		//step3. 从表单提交的数据,来更新AuthAssignment表,从而用户的角色发生变化
		if(isset($_POST['newPri']))
		{
			AuthAssignment::deleteAll('user_id=:id',[':id'=>$id]);
			
			$newPri = $_POST['newPri'];
			
			$arrlength = count($newPri);
			
			for($x=0;$x<$arrlength;$x++)
			{
				$aPri = new AuthAssignment();
				$aPri->item_name = $newPri[$x];
				$aPri->user_id = $id;
				$aPri->created_at = time();
				
				$aPri->save();
			}
			return $this->redirect(['index']);
		}
		
		//step4. 渲染checkBoxList表单
		return $this->render('privilege',['id'=>$id,'AuthAssignmentArray'=>$AuthAssignmentsArray,
			'allPrivilegesArray'=>$allPrivilegesArray]);
		
	}
	
}
