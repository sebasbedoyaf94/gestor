<?php

class TurnosAsesoresController extends Controller
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
				'expression'=>"!empty(Yii::app()->session['permisosRol']['TurnosAsesores']) || !empty(Yii::app()->session['permisosRol']['TurnosAsesores']['Consultas'])",
			),
			array('allow',
				'actions'=>array('create'),
				'users'=>array('@'),
				'expression'=>"!empty(Yii::app()->session['permisosRol']['TurnosAsesores']['Crear'])",
			),
			array('allow',
				'actions'=>array('update'),
				'users'=>array('@'),
				'expression'=>"!empty(Yii::app()->session['permisosRol']['TurnosAsesores']['Modificar'])",
			),
			array('deny',
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
		if (Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('view',array('model'=>$this->loadModel($id),));
		}
		else{
			$this->render('view',array('model'=>$this->loadModel($id),));
		}
	}

	/**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionCreate()
	{
		$model=new TurnosAsesores;
		$model_aseserv=new AsesoresServicios;

		$modelAsesores = Asesores::model()->findAll(array('condition'=>"ase_habilitado='Si'",'order'=>'ase_apellidos ASC'));
		$modelServicios = Servicios::model()->findAll(array('condition'=>"serv_habilitado='Si'",'order'=>'serv_nombre ASC'));
		$modelTurnoServicio = TurnosServicios::model()->findAll();
		$modelAsesorServicio = AsesoresServicios::model()->findAll();

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['TurnosAsesores']) and isset($_POST['AsesoresSeleccionados']))
		{
			$_POST['TurnosAsesores']['turase_creadopor'] = Yii::app()->session['login_usuarioid'];
			$_POST['TurnosAsesores']['turase_modificadopor'] = Yii::app()->session['login_usuarioid'];
			
			$crearTA = $this->crearTurnosAsesores($_POST['AsesoresSeleccionados'], $_POST['TurnosAsesores']);
			//$model->attributes=$_POST['TurnosAsesores'];
			//if($model->save())
			//$this->redirect(array('view','id'=>$model->turase_id));
			$this->redirect(array('admin'));
		}

		if (Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('create', array(
				'model'=>$model, 
				'model_aseserv'=>$model_aseserv,
				'modelAsesores'=>$modelAsesores,
				'modelServicios'=>$modelServicios,
				'modelTurnoServicio'=>$modelTurnoServicio,
				'modelAsesorServicio'=>$modelAsesorServicio,
			), false, true);
		}
		else{
			$this->render('create',array(
				'model'=>$model, 
				'model_aseserv'=>$model_aseserv,
				'modelAsesores'=>$modelAsesores,
				'modelServicios'=>$modelServicios,
				'modelTurnoServicio'=>$modelTurnoServicio,
				'modelAsesorServicio'=>$modelAsesorServicio,
			));
		}
	}

	public function crearTurnosAsesores($rowsAsesores, $turnosAsesores)
	{
		$fechaInicio = date('Y-m-d', strtotime("next Monday"));
		$fechaFin = date('Y-m-d', strtotime("next Monday")+518400);

		foreach ($rowsAsesores as $key => $asesor) {
			$_POST['TurnosAsesores']['turase_aseserv_id'] = $asesor;
			$_POST['TurnosAsesores']['turase_fechaInicio'] = $fechaInicio;
			$_POST['TurnosAsesores']['turase_fechaFin'] = $fechaFin;

			$model=new TurnosAsesores;
			$model->attributes = $_POST['TurnosAsesores'];

			if($model->save())
			{
				if (!empty($ok) and !$ok) {
					$ok=false;
				}
				else{
					$ok = true;
				}
			}
			else{
				$ok = false;
			}
		}
		
		if(!$ok){
			Yii::app()->user->setFlash('error', "Error al asignar el turno a los asesores.");
		}
		else
		{
			Yii::app()->user->setFlash('success', "Creación exitosa.");
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
		$this->performAjaxValidation($model);

		if(isset($_POST['TurnosAsesores']))
		{
			$model->attributes=$_POST['TurnosAsesores'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->turase_id));
		}

		if (Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('update', array('model'=>$model), false, true);
		}
		else{
			$this->render('update',array('model'=>$model));
		}
	}

	/**
	* Deletes a particular model.
	* If deletion is successful, the browser will be redirected to the 'admin' page.
	* @param integer $id the ID of the model to be deleted
	*/
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	* Lists all models.
	*/
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('TurnosAsesores');

		if (Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('index',array('dataProvider'=>$dataProvider), false, true);
		}
		else{
			$this->render('index',array('dataProvider'=>$dataProvider));
		}
	}

	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$model=new TurnosAsesores('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['TurnosAsesores']))
		$model->attributes=$_GET['TurnosAsesores'];

		if (Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('admin',array('model'=>$model), false, true);
		}
		else{
			$this->render('admin',array('model'=>$model));
		}
	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer the ID of the model to be loaded
	*/
	public function loadModel($id)
	{
		$model=TurnosAsesores::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	* Performs the AJAX validation.
	* @param CModel the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='turnos-asesores-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
