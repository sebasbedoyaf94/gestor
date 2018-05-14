<?php

class RolesController extends Controller
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
				'expression'=>"!empty(Yii::app()->session['permisosRol']['Roles']) || !empty(Yii::app()->session['permisosRol']['Roles']['Consultas'])",
			),
			array('allow',
				'actions'=>array('create'),
				'users'=>array('@'),
				'expression'=>"!empty(Yii::app()->session['permisosRol']['Roles']['Crear'])",
			),
			array('allow',
				'actions'=>array('update'),
				'users'=>array('@'),
				'expression'=>"!empty(Yii::app()->session['permisosRol']['Roles']['Modificar'])",
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
		$obtener = $this->obtenerRolesModulosAcciones($this->loadModel($id));

		$dataModelosAcciones =$obtener['dataModelosAcciones'];
		$titulosAcciones =$obtener['titulosAcciones'];
		$accionesAsignadas =$obtener['accionesAsignadas'];
		$dataRolesModulosAcciones =$obtener['dataRolesModulosAcciones'];

		if (Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('view',array(
				'model'=>$this->loadModel($id),
				'dataModelosAcciones'=>$dataModelosAcciones,
				'titulosAcciones'=>$titulosAcciones,
				'accionesAsignadas'=>$accionesAsignadas
			));
		}
		else{
			$this->render('view',array(
				'model'=>$this->loadModel($id),
				'dataModelosAcciones'=>$dataModelosAcciones,
				'titulosAcciones'=>$titulosAcciones,
				'accionesAsignadas'=>$accionesAsignadas
			));
		}
	}

	/**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionCreate()
	{
		$model=new Roles;

		$obtener = $this->obtenerRolesModulosAcciones($model);

		$dataModelosAcciones =$obtener['dataModelosAcciones'];
		$titulosAcciones =$obtener['titulosAcciones'];
		$accionesAsignadas =$obtener['accionesAsignadas'];

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Roles']) and isset($_POST['ModulosAcciones']))
		{
			$model->attributes=$_POST['Roles'];
			//se crea el rol
			if($model->save())
			{
				Yii::app()->user->setFlash('success', "Creación exitosa.");

				$crearRMA= $this->crearRolesModulosAcciones($_POST['ModulosAcciones'],$model);

				$this->redirect(array('admin'));
			}
		}

		if (Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('create', array(
				'model'=>$model,
				'dataModelosAcciones'=>$dataModelosAcciones,
				'titulosAcciones'=>$titulosAcciones,
				'accionesAsignadas'=>$accionesAsignadas
			), false, true);
		}
		else{
			$this->render('create',array(
				'model'=>$model,
				'dataModelosAcciones'=>$dataModelosAcciones,
				'titulosAcciones'=>$titulosAcciones,
				'accionesAsignadas'=>$accionesAsignadas
			));
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

		if ($model->rol_id == Yii::app()->session['login_rolid']) {
			Yii::app()->user->setFlash('error', "<b>Permiso denegado:</b> No puedes modificar tu propio rol.");
			$this->redirect(array('admin'));
		}

		$obtener = $this->obtenerRolesModulosAcciones($model);

		$dataModelosAcciones =$obtener['dataModelosAcciones'];
		$titulosAcciones =$obtener['titulosAcciones'];
		$accionesAsignadas =$obtener['accionesAsignadas'];
		$dataRolesModulosAcciones =$obtener['dataRolesModulosAcciones'];

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Roles']))
		{

			$_POST['Roles']['rol_creadopor'] = Yii::app()->session['login_usuarioid'];
			$_POST['Roles']['rol_modificadopor'] = Yii::app()->session['login_usuarioid'];

			$model->attributes=$_POST['Roles'];
			if($model->save())
			{
				Yii::app()->user->setFlash('success', "Modificación exitosa.");


				//se deben eliminar las acciones permitidas anteriores, para poder agregar los nuevos cambios
				//es la opcion mas rapida para crear los nuevos permisos del rol, eliminando todos y volviendolos a crear
				//aunque no es la mas optima.
				$deleteRMA=RolesModulosAcciones::model()->deleteAll(array("condition"=>"rolmodac_rol_id='$model->rol_id'"));

				$crearRMA= $this->crearRolesModulosAcciones($_POST['ModulosAcciones'],$model);

				$this->redirect(array('admin'));
			}
		}

		if (Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('update', array(
				'model'=>$model,
				'dataModelosAcciones'=>$dataModelosAcciones,
				'titulosAcciones'=>$titulosAcciones,
				'accionesAsignadas'=>$accionesAsignadas
			), false, true);
		}
		else{
			$this->render('update',array(
				'model'=>$model,
				'dataModelosAcciones'=>$dataModelosAcciones,
				'titulosAcciones'=>$titulosAcciones,
				'accionesAsignadas'=>$accionesAsignadas
			));
		}
	}

	public function crearRolesModulosAcciones($rowsModulosAcciones,$model)
	{
		//se termina de construir los objetos para crear los RolesModulosAcciones
		//para lo cual se necesita que previamente se haya creado el rol y obtener su id
		foreach ($rowsModulosAcciones as $key => $value) 
		{
			if ($value == 'Si') 
			{
				$modelRolesModulosAcciones = new RolesModulosAcciones;

				$_POST['RolesModulosAcciones']['rolmodac_rol_id'] = $model->rol_id;
				$_POST['RolesModulosAcciones']['rolmodac_modac_id']= $key;

				$modelRolesModulosAcciones->attributes=$_POST['RolesModulosAcciones'];

				//se crean las acciones seleccionadas para el nuevo rol
				if($modelRolesModulosAcciones->save())
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
		}

		if(!$ok){
			Yii::app()->user->setFlash('error', "Error al crear los permisos.");
		}
	}

	public function obtenerRolesModulosAcciones($model)
	{
		//*****************************************************************************************************************************************************//
		//*****************************************************************************************************************************************************//
		//*****************************************************************************************************************************************************//		

		// Se obtienen todas las acciones de todos los modulos, (solo modulos que tienen minimo 1 accion)
		$modelModulosAcciones =ModulosAcciones::model()->findAll();

		$titulosAcciones = array();
		$titulosModulos = array();
		$accionesAsignadas = array();

		foreach ($modelModulosAcciones as $key => $accion) 
		{
			//obtenemos todos los nombres de los modulos existentes, los nombres se usaran para los titulos del form
			$titulosModulos[$accion->modacModu->modu_id] = $accion->modacModu->modu_nombre;
			//obtenemos todos los nombres de las acciones existentes (sin repetir nombre), los nombres se usaran para los titulos del form
			$titulosAcciones[] = $accion->modac_nombre;
		}

			//eliminados datos repetidos(array_unique) y reiniciamos los key(array_values)
			$titulosModulos = array_values(array_unique($titulosModulos));
			$titulosAcciones = array_values(array_unique($titulosAcciones));
			
		//base para cargar las diferentes acciones de los modulos
		//por defecto todas se cargan con valor NULL, pero en el paso siguiente
		//se sobreescribe por el id correspondiente al dato que se encuentra en ModulosAcciones.
		//Si el valor persiste en NULL, significa que dicho modulo no tiene la accion
		$dataModelosAcciones = array();
		for ($x=0; $x < count($titulosModulos); $x++) 
		{ 
			for ($y=0; $y < count($titulosAcciones); $y++) 
			{ 
				$dataModelosAcciones[$titulosModulos[$x]][$titulosAcciones[$y]] = NULL;
			}
		}

		//identificar las acciones de los diferentes modulos
		//por lo tanto sobreescribe con el id correspondiente
		foreach ($modelModulosAcciones as $key => $value) 
		{
			$dataModelosAcciones[$value->modacModu->modu_nombre][$value->modac_nombre] = $value->modac_id;
		}

		//obtener las acciones a las cuales el rol tiene permisos
		//esto para marcarlas como SI en la vista.
		foreach ($model->rolesModulosAcciones as $key => $value) {
			$accionesAsignadas[$value->rolmodac_modac_id] = $value->rolmodac_modac_id;
		}

		$data = [
			'dataModelosAcciones'=>$dataModelosAcciones,
			'titulosAcciones'=>$titulosAcciones,
			'accionesAsignadas'=>$accionesAsignadas,
			'dataRolesModulosAcciones'=>$model->rolesModulosAcciones
		];

		return $data;
		//*****************************************************************************************************************************************************//
		//*****************************************************************************************************************************************************//
		//*****************************************************************************************************************************************************//
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
		$dataProvider=new CActiveDataProvider('Roles');

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
		$model=new Roles('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['Roles']))
		$model->attributes=$_GET['Roles'];

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
		$model=Roles::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='roles-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
