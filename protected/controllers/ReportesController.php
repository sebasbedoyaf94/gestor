<?php

class ReportesController extends Controller
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
				'expression'=>"!empty(Yii::app()->session['permisosRol']['Reportes']) || !empty(Yii::app()->session['permisosRol']['Reportes']['Consultas'])",
			),
			array('allow',
				'actions'=>array('create'),
				'users'=>array('@'),
				'expression'=>"!empty(Yii::app()->session['permisosRol']['Reportes']['Crear'])",
			),
			array('allow',
				'actions'=>array('update'),
				'users'=>array('@'),
				'expression'=>"!empty(Yii::app()->session['permisosRol']['Reportes']['Modificar'])",
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function enviarTramaSocket($model)
	{	
		try {
			// Enviar trama al socket en el server principal
			Yii::Import('application.extensions.SocketsHelper');

			$provider = array('strHost' => Yii::app()->params['strHost'], 'intPort' => Yii::app()->params['intPort'], 'bolAutoinit' => Yii::app()->params['bolAutoinit']);

			$trama = "779,000,111,".$model->rep_tipo.",".$model->rep_proy_id.",".$model->rep_fechaInicio." 00:00:00,".$model->rep_fechaFin." 23:59:59,~";

			$SocketsHelper = new SocketsHelper($provider);
			$data = $SocketsHelper->sendAndReceive($trama);
			$this->exportarData($model->rep_tipo, $data);
		} catch (Exception $e) {
			
			//$this->generarLogs($model->attributes,'Trama Socket no enviado al server '.Yii::app()->params['strHost'].'('.$e->getMessage().')');
			print_r("Error enviando al server: " . $e->getMessage());	
			die;
		}
	}

	public function exportarData($tipoRep, $data){
		Yii::Import('application.extensions.ECSVExport');
		$tramaStart = substr($data, 0, 11);

		if($tramaStart == "779,001,000"){
			$dat = substr($data, 12);
			$dat = str_replace("~", "", $dat);
			$registros = explode("||", $dat);
			if($tipoRep == 1){
				for($i=0; $i < count($registros); $i++){
					$datos = explode("##", $registros[$i]);
					$dataProvider[$i] = array(
						'Cliente' => $datos[0],
						'Proyecto' => $datos[1],
						'Nombre Archivo' => $datos[2],
						'Fase' => $datos[3],
						'Descripcion' => $datos[4],
						'Analista' => $datos[5] . " " . $datos[6],
						'Fecha Hora Carga' => $datos[7]
					);
				}
				$nombre = "Reporte_Cargas";
			}
			else {
				for($i=0; $i < count($registros); $i++){
					$datos = explode("##", $registros[$i]);
					$dataProvider[$i] = array(
						'Cliente' => $datos[0],
						'Proyecto' => $datos[1],
						'URL Pruebas' => $datos[2],
						'Ruta Doc Funcional' => $datos[3],
						'Ruta Doc Tecnica' => $datos[4],
						'Observaciones' => $datos[5],
						'Usuario Pruebas' => $datos[6],
						'Contrasena Pruebas' => $datos[7],
						'Analista' => $datos[8] . " " . $datos[9],
						'Fecha Hora Creacion' => $datos[10]
					);
				}
				$nombre = "Reporte_Checklist";
			}

			$csv = new ECSVExport($dataProvider);
			$csv->convertActiveDataProvider=false;
			$output = $csv->toCSV();
			$filename= $nombre.".csv";
			Yii::app()->getRequest()->sendFile($filename, $output, "text/csv", false);
			exit();
		}
		else {
			Yii::app()->user->setFlash('error', "No hay datos sobre la información consultada.");
		}
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
		$model=new Reportes;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Reportes']))
		{
			$model->attributes=$_POST['Reportes'];
			$this->enviarTramaSocket($model);
			if($model->save()){
				//$this->redirect(array('view','id'=>$model->rep_id));
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

		if(isset($_POST['Reportes']))
		{
			$model->attributes=$_POST['Reportes'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->rep_id));
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
		$dataProvider=new CActiveDataProvider('Reportes');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Reportes('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Reportes']))
			$model->attributes=$_GET['Reportes'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Reportes the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Reportes::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Reportes $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='reportes-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
