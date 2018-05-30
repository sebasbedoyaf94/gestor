<?php

class UsuariosController extends Controller
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
				'expression'=>"!empty(Yii::app()->session['permisosRol']['Usuarios']) || !empty(Yii::app()->session['permisosRol']['Usuarios']['Consultas'])",
			),
			array('allow',
				'actions'=>array('create'),
				'users'=>array('@'),
				'expression'=>"!empty(Yii::app()->session['permisosRol']['Usuarios']['Crear'])",
			),
			array('allow',
				'actions'=>array('update'),
				'users'=>array('@'),
				'expression'=>"!empty(Yii::app()->session['permisosRol']['Usuarios']['Modificar'])",
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

		$modelClientes=Clientes::model()->findAll(array('condition'=>"cli_habilitado='Si'",'order'=>'cli_nombre ASC'));
		$modelProgramas=Programas::model()->findAll(array('condition'=>"prog_habilitado='Si'",'order'=>'prog_nombre ASC'));
		$modelServicios=Servicios::model()->findAll(array('condition'=>"serv_habilitado='Si'",'order'=>'serv_nombre ASC'));


		//obtener los servicios existentes del usuario
		$sql="SELECT usuaserv_serv_id FROM usuarios_servicios WHERE usuaserv_usua_id='$id'";
		$dataUsuServ=Yii::app()->db->createCommand($sql)->queryAll();

		$usuarioServiciosExistentes = array();
		foreach ($dataUsuServ as $key => $serv) {
			$usuarioServiciosExistentes[] = $serv['usuaserv_serv_id'];
		}



		if (Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('view',array(
				'model'=>$this->loadModel($id),
				'modelServicios'=>$modelServicios,
				'modelClientes'=>$modelClientes,
				'modelProgramas'=>$modelProgramas,
				'usuarioServiciosExistentes' =>$usuarioServiciosExistentes
			));
		}
		else{
			$this->render('view',array(
				'model'=>$this->loadModel($id),
				'modelServicios'=>$modelServicios,
				'modelClientes'=>$modelClientes,
				'modelProgramas'=>$modelProgramas,
				'usuarioServiciosExistentes' =>$usuarioServiciosExistentes
			));
		}
	}

	/**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionCreate()
	{
		$model=new Usuarios;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Usuarios']))
		{
			$model->attributes=$_POST['Usuarios'];
			$model->usua_creadopor = Yii::app()->session['login_usuarioid'];
			$model->usua_fechacreado = date('Y-m-d H:i:s');
			$model->usua_modificadopor = Yii::app()->session['login_usuarioid'];
			$model->usua_fechamodificado = date('Y-m-d H:i:s');

			$model->attributes=$_POST['Usuarios'];

			if($model->save())
			{
				Yii::app()->user->setFlash('success', "Creación exitosa.");
				$this->redirect(array('admin'));
			}
		}

		if (Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('create', array(
				'model'=>$model
			), false, true);
		}
		else{
			$this->render('create',array(
				'model'=>$model
			));
		}
	}

	public function crearUsuarioServicios($rowsServicios,$model)
	{
		foreach ($rowsServicios as $key => $servicio) 
		{
			$modelUsuariosServicios = new UsuariosServicios;

			$_POST['UsuariosServicios']['usuaserv_usua_id'] = $model->usua_id;
			$_POST['UsuariosServicios']['usuaserv_serv_id']= $servicio;
			
			$modelUsuariosServicios->attributes=$_POST['UsuariosServicios'];

			//se crean los servicios seleccionadas para el nuevo usuario
			if($modelUsuariosServicios->save())
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
			Yii::app()->user->setFlash('error', "Error al crear los servicios del Usuario.");
		}
	}

	/**
	* Updates a particular model.
	* If update is successful, the browser will be redirected to the 'view' page.
	* @param integer $id the ID of the model to be updated
	*/
	public function actionUpdate($id)
	{
		if ($id == Yii::app()->session['login_usuarioid']) {
			Yii::app()->user->setFlash('error', "<b>Permiso denegado:</b> No puedes modificar tu propio usuario.");
			$this->redirect(array('admin'));
		}


		$model=$this->loadModel($id);

		$modelClientes=Clientes::model()->findAll(array('condition'=>"cli_habilitado='Si'",'order'=>'cli_nombre ASC'));
		$modelProgramas=Programas::model()->findAll(array('condition'=>"prog_habilitado='Si'",'order'=>'prog_nombre ASC'));
		$modelServicios=Servicios::model()->findAll(array('condition'=>"serv_habilitado='Si'",'order'=>'serv_nombre ASC'));


		//obtener los servicios existentes del usuario
		$sql="SELECT usuaserv_serv_id FROM usuarios_servicios WHERE usuaserv_usua_id='$id'";
		$dataUsuServ=Yii::app()->db->createCommand($sql)->queryAll();

		$usuarioServiciosExistentes = array();
		foreach ($dataUsuServ as $key => $serv) {
			$usuarioServiciosExistentes[] = $serv['usuaserv_serv_id'];
		}

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Usuarios']) and isset($_POST['ServiciosSeleccionados']))
		{
			$_POST['Usuarios']['usua_creadopor'] = Yii::app()->session['login_usuarioid'];
			$_POST['Usuarios']['usua_modificadopor'] = Yii::app()->session['login_usuarioid'];

			$model->attributes=$_POST['Usuarios'];
			if($model->save())
			{
				Yii::app()->user->setFlash('success', "Modificación exitosa.");

				$deleteUS=UsuariosServicios::model()->deleteAll(array("condition"=>"usuaserv_usua_id='$model->usua_id'"));

				$crearUS= $this->crearUsuarioServicios($_POST['ServiciosSeleccionados'],$model);

				$this->redirect(array('admin'));
			}
		}

		if (Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('update', array(
				'model'=>$model,
				'modelServicios'=>$modelServicios,
				'modelClientes'=>$modelClientes,
				'modelProgramas'=>$modelProgramas,
				'usuarioServiciosExistentes' =>$usuarioServiciosExistentes
			), false, true);
		}
		else{
			$this->render('update',array(
				'model'=>$model,
				'modelServicios'=>$modelServicios,
				'modelClientes'=>$modelClientes,
				'modelProgramas'=>$modelProgramas,
				'usuarioServiciosExistentes' =>$usuarioServiciosExistentes
			));
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
		$dataProvider=new CActiveDataProvider('Usuarios');

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
		$model=new Usuarios('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['Usuarios']))
		$model->attributes=$_GET['Usuarios'];

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
		$model=Usuarios::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='usuarios-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
