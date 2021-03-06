<?php

class ProyectosController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('index','view','admin'),
				'users'=>array('@'),
				'expression'=>"!empty(Yii::app()->session['permisosRol']['Proyectos']) || !empty(Yii::app()->session['permisosRol']['Proyectos']['Consultas'])",
			),
			array('allow',
				'actions'=>array('create'),
				'users'=>array('@'),
				'expression'=>"!empty(Yii::app()->session['permisosRol']['Proyectos']['Crear'])",
			),
			array('allow',
				'actions'=>array('update'),
				'users'=>array('@'),
				'expression'=>"!empty(Yii::app()->session['permisosRol']['Proyectos']['Modificar'])",
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Proyectos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Proyectos']))
		{
			$model->attributes=$_POST['Proyectos'];
			$model->proy_creadopor = Yii::app()->session['login_usuarioid'];
			$model->proy_fechacreado = date('Y-m-d H:i:s');
			$model->proy_modificadopor = Yii::app()->session['login_usuarioid'];
			$model->proy_fechamodificado = date('Y-m-d H:i:s');

			if($model->save()){
				Yii::app()->user->setFlash('success', "Creación exitosa.");
				$this->redirect(array('view','id'=>$model->proy_id));
			}
		}

		if (Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('create', array('model'=>$model), false, true);
		}
		else{
			$this->render('create',array('model'=>$model));
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Proyectos']))
		{
			$model->attributes=$_POST['Proyectos'];
			if($model->save()){
				Yii::app()->user->setFlash('success', "Registro modificado exitosamente.");
				$this->redirect(array('view','id'=>$model->proy_id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Proyectos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Proyectos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Proyectos']))
			$model->attributes=$_GET['Proyectos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Proyectos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Proyectos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Proyectos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='proyectos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
