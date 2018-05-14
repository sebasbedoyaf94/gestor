<?php

class CargaMasivaController extends Controller
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
				'actions'=>array('index','view','admin','turnos','asesores'),
				'users'=>array('@'),
			),
			array('allow',
				'actions'=>array('create','update'),
				// 'expression'=>"'Si'=='Si'",
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
		$model=new CargaMasiva;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['CargaMasiva']))
		{
			$model->attributes=$_POST['CargaMasiva'];
			if($model->save())
			$this->redirect(array('view','id'=>$model->tur_id));
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
		$this->performAjaxValidation($model);

		if(isset($_POST['CargaMasiva']))
		{
			$model->attributes=$_POST['CargaMasiva'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->tur_id));
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
		$dataProvider=new CActiveDataProvider('CargaMasiva');

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
		$model=new CargaMasiva('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['CargaMasiva']))
		$model->attributes=$_GET['CargaMasiva'];

		if (Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('admin',array('model'=>$model), false, true);
		}
		else{
			$this->render('admin',array('model'=>$model));
		}
	}

	/**
	*Realizar lectura del archivo de carga masiva y enviar los datos al modelo de turnos.
	*/
	public function actionTurnos()
	{
		$model=new CargaMasiva;
		$model_servicios=new Servicios;

		$this->performAjaxValidation($model);

		if(isset($_FILES['CargaMasiva']))
		{
			// Obtenemos el archivo y su ruta
			$ruta_archivo = $_FILES['CargaMasiva']['tmp_name'];
			$archivo = $ruta_archivo['fileField']; 
			ini_set('max_execution_time', 300); //tiempo de ejecution del php para la carga del archivo, ya que en el php.ini esta definido en 30 segundos nada más. Acá le damos un tiempo de 5 minutos.

			// se captura el id del servicio para realizar la validación con el modelo de turnos servicios
			$id_servicio = $_POST['Servicios']['serv_id'];

			// Cargamos el archivo 
			$lineas = file($archivo);

			// Capturar fecha y hora actual
			date_default_timezone_set('America/Bogota');
			$fecha = date('Y-m-d H:i:s');

			//print_r(date('Y-m-d H:i:s')); 

			// Inicializamos variable a 0, esto nos ayudará a inidicarle que no lea la primera línea
			$i = 0;
			$j = 1;
			$m = 0;

			$usuario =  Yii::app()->session['login_usuarioid']; // capturar el id del usuario logeado
			$registros = array(); // arreglo para guardar los registros del archivo de carga masiva
			$limite = 5; // limite definido para realizar insert de los datos del archivo de registros
			$errores = array(); // arreglo para almacenar los errores que pueda tener alguno de los datos de los archivos
			$turnos = array(); // arreglo para almacenar la informacion del turno de cada registro del archivo
			$turnos_id = array(); // arreglo para almacenar los id de los turnos registrados
			$nombre_turnos = array(); // arreglo para almacenar los nombres de los turnos
			$turno_servicios = array(); // arreglo para almacenar los id de los turnos y los servicios
			$turno_novedades = array(); // arreglo para almacenar los id de los turnos y sus respectivas novedades
			$error_novedad = array('Error' => 'La novedad no se encuentra registrada.');

			// Recorremos el archivo para leer línea por línea
			foreach ($lineas as $key => $linea) 
			{	
				if(!empty($registros[$limite]['id']))
				{ // se envia el arreglo para hacer el multi insert
					while($j <= $limite)
					{
						$turnos[$j] = $registros[$j]['turno']; // arreglo que contiene toda la información de los turnos
						$nombre_turnos[$j] = $turnos[$j]['tur_nombre']; // arreglo que contiene los nombres de los turnos
						$j++;
					}

					$builder=Yii::app()->db->schema->commandBuilder;
					$command=$builder->createMultipleInsertCommand('turnos', $turnos);
					$command->execute();

					if($id_servicio)
					{
						// ciclo para validar turno servicio
						for($k = 1; $k < $j; $k++)
						{
							$posicion = $registros[$k]['id'];
							$turnos_id[$k] = $this->consultarIdTurnos($nombre_turnos[$k]);
							$turno_servicio = array('turserv_serv_id' => $id_servicio, 'turserv_tur_id' => $turnos_id[$k]);

							$model_turserv=new TurnosServicios;
							$model_turserv->attributes = $turno_servicio;

							if($model_turserv->validate())
							{
								$turno_servicios[$k] = $turno_servicio;
							}
							else 
							{
								$errores[$posicion]['turno_servicio'] = $model_turserv->getErrors();
							}
						}

						$builder=Yii::app()->db->schema->commandBuilder;
						$command=$builder->createMultipleInsertCommand('turnos_servicios', $turno_servicios);
						$command->execute();
					}

					for($k=1; $k < $j; $k++)
					{ // ciclo para ingresar la informacion de turno novedades
						$posicion = $registros[$k]['id'];
						$error = $errores[$posicion]['novedad'];
						if(!empty($error))
						{   // Si la novedad no existe
							print_r("Error");
							die();
						}
						else 
						{	// Si la novedad existe, entonces se realiza el registro en turno novedades
							$m++;

							$turnos_id[$k] = $this->consultarIdTurnos($nombre_turnos[$k]);

							$novedades = array('turnov_tur_id' => $turnos_id[$k], 'turnov_nov_id' => $novedad[$k]['nov_id'], 'turnov_dia' => $novedad[$k]['dia'], 'turnov_horaInicio' => $novedad[$k]['horaInicio'], 'turnov_horaFin' => $novedad[$k]['horaFin']);

							$model_turnov=new TurnosNovedades;
							$model_turnov->attributes = $novedades;

							if($model_turnov->validate())
							{
								$turno_novedades[$m] = $novedades;
							}
							else
							{
								$errores[$posicion]['turno_novedad'] = $model_turnov->getErrors();
							}
							
						}

					}

					$builder=Yii::app()->db->schema->commandBuilder;
					$command=$builder->createMultipleInsertCommand('turnos_novedades', $turno_novedades);
					$command->execute();

					unset($registros);
					unset($turnos);
					unset($nombre_turnos);
					unset($turnos_id);
					unset($turno_servicios);
					unset($novedades);
					unset($turno_novedades);
					$i=0;
					$j=1;
					$m=0;
				}			
				if($key > 0)
				{
					$i++;
					$datos = explode(";", $linea);
					$dato = array('tur_nombre' => $datos[0], 'tur_horaInicioLunes' => $datos[1], 'tur_horaFinLunes' => $datos[2], 'tur_horaInicioMartes' => $datos[3], 'tur_horaFinMartes' => $datos[4], 'tur_horaInicioMiercoles' => $datos[5], 'tur_horaFinMiercoles' => $datos[6], 'tur_horaInicioJueves' => $datos[7], 'tur_horaFinJueves' => $datos[8], 'tur_horaInicioViernes' => $datos[9], 'tur_horaFinViernes' => $datos[10], 'tur_horaInicioSabado' => $datos[11], 'tur_horaFinSabado' => $datos[12], 'tur_horaInicioDomingo' => $datos[13], 'tur_horaFinDomingo' => $datos[14], 'tur_habilitado' => $datos[15], 'tur_fechacreado' => $fecha, 'tur_fechamodificado' => $fecha, 'tur_creadopor' => $usuario, 'tur_modificadopor' => $usuario);

					$model=new Turnos;
					$model->attributes = $dato;

					if($model->validate())
					{   // Si el turno cumple las condiciones, se guarda el registro y se valida la novedad
						$registros[$i]['id'] = $key;
						$registros[$i]['turno'] = $dato;

						$abreviatura = $datos[16];

						$id_novedad= $this->validarExistenciaNovedad($abreviatura);

						if($id_novedad)
						{		
							$novedad[$i]['nov_id'] = $id_novedad;
							$novedad[$i]['dia'] = $datos[17];
							$novedad[$i]['horaInicio'] = $datos[18];
							$novedad[$i]['horaFin'] = $datos[19];
							$errores[$key]['novedad'] = '';
						}
						else
						{
							$errores[$key]['novedad'] = $error_novedad;
						}
					}
					else
					{   // Si hay error con el turno, no se guarda en el arreglo registros 
						$errores[$key]['id'] = $key;
						$errores[$key]['turno'] = $model->getErrors();
						$i--;
					}

					unset($datos);
					unset($dato);
					unset($model);
				}
			}

			$j = 1;
			$m = 0;
			if(!empty($registros))
			{
				while($j <= $i)
				{ 
					$turnos[$j] = $registros[$j]['turno'];
					$nombre_turnos[$j] = $turnos[$j]['tur_nombre'];
					$j++;
				}

				$builder=Yii::app()->db->schema->commandBuilder;
				$command=$builder->createMultipleInsertCommand('turnos', $turnos);
				$command->execute();

				if($id_servicio)
				{
					// ciclo para validar turno servicio
					for($k = 1; $k < $j; $k++)
					{
						$posicion = $registros[$k]['id'];
						$turnos_id[$k] = $this->consultarIdTurnos($nombre_turnos[$k]);
						$turno_servicio = array('turserv_serv_id' => $id_servicio, 'turserv_tur_id' => $turnos_id[$k]);

						$model_turserv=new TurnosServicios;
						$model_turserv->attributes = $turno_servicio;

						if($model_turserv->validate())
						{
							$turno_servicios[$k] = $turno_servicio;
						}
						else 
						{
							$errores[$posicion]['turno_servicio'] = $model_turserv->getErrors();
							//print_r("Error en turno servicio");
							//die();
						}
					}

					$builder=Yii::app()->db->schema->commandBuilder;
					$command=$builder->createMultipleInsertCommand('turnos_servicios', $turno_servicios);
					$command->execute();
				}

				for($k=1; $k < $j; $k++)
				{ // ciclo para ingresar la informacion de turno novedades
					$posicion = $registros[$k]['id'];
					$error = $errores[$posicion]['novedad'];
					if(!empty($error))
					{
						print_r("Error");
						die();
					}
					else 
					{	
						$m++;

						$turnos_id[$k] = $this->consultarIdTurnos($nombre_turnos[$k]);

						$novedades = array('turnov_tur_id' => $turnos_id[$k], 'turnov_nov_id' => $novedad[$k]['nov_id'], 'turnov_dia' => $novedad[$k]['dia'], 'turnov_horaInicio' => $novedad[$k]['horaInicio'], 'turnov_horaFin' => $novedad[$k]['horaFin']);

						$model_turnov=new TurnosNovedades;
						$model_turnov->attributes = $novedades;

						if($model_turnov->validate())
						{
							$turno_novedades[$m] = $novedades;
						}
						else
						{
							$errores[$posicion]['turno_novedad'] = $model_turnov->getErrors();
						}
						
					}
				}

				$builder=Yii::app()->db->schema->commandBuilder;
				$command=$builder->createMultipleInsertCommand('turnos_novedades', $turno_novedades);
				$command->execute();

				unset($registros);
				unset($turnos);
				unset($nombre_turnos);
				unset($turnos_id);
				unset($turno_servicios);
				unset($novedades);
				unset($turno_novedades);
			}

			//unset($errores);

			echo "<pre>";
			print_r($errores);
			echo "</pre><br>";
			die();
		}
		
		if (Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('turnos',array('model'=>$model, 'model_servicios'=>$model_servicios), false, true);
		}
		else{
			$this->render('turnos',array('model'=>$model, 'model_servicios'=>$model_servicios));
		}
	}

	/**
	*Realizar lectura del archivo de carga masiva y enviar los datos al modelo de asesores.
	*/
	public function actionAsesores()
	{
		$model=new Asesores;

		$this->performAjaxValidation($model);

		if(isset($_FILES['CargaMasiva']))
		{
			// Obtenemos el archivo y su ruta
			$ruta_archivo = $_FILES['CargaMasiva']['tmp_name'];
			$archivo = $ruta_archivo['fileField']; 
			ini_set('max_execution_time', 300); //tiempo de ejecution del php para la carga del archivo, ya que en el php.ini esta definido en 30 segundos nada más. Acá le damos un tiempo de 5 minutos.

			// Cargamos el archivo 
			$lineas = file($archivo);

			// Capturar fecha y hora actual
			date_default_timezone_set('America/Bogota');
			$fecha = date('Y-m-d H:i:s');

			//print_r(date('Y-m-d H:i:s')); 

			// Inicializamos variable a 0, esto nos ayudará a inidicarle que no lea la primera línea
			$i = 0;
			$j = 1;
			$m = 0;

			$usuario =  Yii::app()->session['login_usuarioid']; // capturar el id del usuario logeado
			$registros = array(); // arreglo para guardar los registros del archivo de carga masiva
			$limite = 5; // limite definido para realizar insert de los datos del archivo de registros
			$errores = array(); // arreglo para almacenar los errores que pueda tener alguno de los datos de los archivos

			foreach ($lineas as $key => $linea) 
			{
				if(!empty($registros[$limite]['id']))
				{ // se envia el arreglo para hacer el multi insert
				}
				if($key > 0)
				{
					$i++;
					$datos = explode(";", $linea);
					$dato = array('ase_identificacion' => $datos[0], 'ase_nombre' => $datos[1], 'ase_apellidos' => $datos[2], 'ase_usuariored' => $datos[3], 'ase_lider' => $datos[4], 'ase_identificacion_lider' => $datos[5], 'ase_horaInicioLunes' => $datos[6], 'ase_horaFinLunes' => $datos[7], 'ase_horaInicioMartes' => $datos[8], 'ase_horaFinMartes' => $datos[9], 'ase_horaInicioMiercoles' => $datos[10], 'ase_horaFinMiercoles' => $datos[11], 'ase_horaInicioJueves' => $datos[12], 'ase_horaFinJueves' => $datos[13], 'ase_horaInicioViernes' => $datos[14], 'ase_horaFinViernes' => $datos[15], 'ase_horaInicioSabado' => $datos[16], 'ase_horaFinSabado' => $datos[17], 'ase_horaInicioDomingo' => $datos[18], 'ase_horaFinDomingo' => $datos[19], 'ase_cont_id' => $datos[20], 'ase_habilitado' => $datos[21]);
				}
			}
		}

		if (Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('asesores',array('model'=>$model), false, true);
		}
		else{
			$this->render('asesores',array('model'=>$model));
		}

	}

	/**
	*Función para validar que la novedad existe y este habilitada
	*/
	public function validarExistenciaNovedad($nov_abreviatura)
	{
		$criteria=new CDbCriteria;
		$criteria->select = "nov_id";
		$criteria->condition = "nov_abreviatura = '$nov_abreviatura' AND nov_habilitado='Si'";
		$novedad = Novedades::model()->find($criteria);

		if($novedad)
		{
			return $novedad->nov_id;
		}
		else 
		{
			return false;
		}
	}

	public function consultarIdTurnos($nombre_turno)
	{
		$criteria=new CDbCriteria;
		$criteria->select = "tur_id";
		$criteria->condition = "tur_nombre = '$nombre_turno' AND tur_habilitado='Si'";
		$turno_id = Turnos::model()->find($criteria);

		return $turno_id->tur_id;
	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer the ID of the model to be loaded
	*/
	public function loadModel($id)
	{
		$model=CargaMasiva::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='upload-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
