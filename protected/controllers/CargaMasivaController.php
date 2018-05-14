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
				'expression'=>"!empty(Yii::app()->session['permisosRol']['CargaMasiva'])",
			),
			array('allow',
				'actions'=>array('turnos', 'asesores'),
				'users'=>array('@'),
				'expression'=>"!empty(Yii::app()->session['permisosRol']['CargaMasiva']['Crear'])",
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
		$band=0;

		if(isset($_FILES['CargaMasiva']))
		{
			// Obtenemos el archivo y su ruta
			$ruta_archivo = $_FILES['CargaMasiva']['tmp_name'];
			$archivo = $ruta_archivo['tur_nombre_archivo'];
			
			//ini_set('max_execution_time', 300); // Tiempo de ejecucion del php se define para 5 minutos

			// Se captura el id del servicio 
			$id_servicio = $_POST['Servicios']['serv_id'];

			// Cargamos el archivo
			$lineas = file($archivo);

			// Capturar fecha y hora actual
			date_default_timezone_set('America/Bogota');
			$fecha = date('Y-m-d H:i:s');
			$lunes = date('Y-m-d', strtotime("next Monday"));
			$martes = date('Y-m-d', strtotime("next Monday")+86400);
			$miercoles = date('Y-m-d', strtotime("next Monday")+172800);
			$jueves = date('Y-m-d', strtotime("next Monday")+259200);
			$viernes = date('Y-m-d', strtotime("next Monday")+345600);
			$sabado = date('Y-m-d', strtotime("next Monday")+432000);
			$domingo = date('Y-m-d', strtotime("next Monday")+518400);

			$i = 0;
			$j = 0;
			$k = 1;
			$c = 1;
			$n = -1;
			$e = -1;

			$minHorasDia = 4;
			$maxHorasDia = 10;

			$band_turno=0;
			$contTurno=0;
			$contErrores=0;

			$usuario = Yii::app()->session['login_usuarioid']; 
			$registros = array();
			$limite = 50;
			$errores = array();
			$nov_errores = '';
			$mensaje_turnos='';
			$dato = array();
			$turnos = array();
			$nombre_turnos = array();
			$turnos_id = array();
			$turno_servicios = array();
			$novedades = array();
			$turno_novedades = array();

			foreach ($lineas as $key => $linea) {
				if(!empty($registros[$limite]['id']))
				{
					while($k <= $limite)
					{
						$turnos[$k] = $registros[$k]['turno'];
						$nombre_turnos[$k] = $turnos[$k]['tur_nombre'];
						$k++;	
					}
					
					$builder=Yii::app()->db->schema->commandBuilder;
					$command=$builder->createMultipleInsertCommand('turnos', $turnos);
					$command->execute();

					while($c < $k)
					{
						$turnos_id[$c] = $this->consultarIdTurnos($nombre_turnos[$c]);
						$c++;
					}

					if($id_servicio)
					{
						for($m = 1; $m < $c; $m++)
						{
							$turno_servicio = array('turserv_serv_id' => $id_servicio, 'turserv_tur_id' => $turnos_id[$m]);

							$model_turserv=new TurnosServicios;
							$model_turserv->attributes = $turno_servicio;

							if($model_turserv->validate())
							{
								$turno_servicios[$m] = $turno_servicio;
							}
							else
							{
								//echo "<pre>";
								//print_r($model_turserv->getErrors());
								//echo "</pre><br>";
								//die();
							}
						}

						$builder=Yii::app()->db->schema->commandBuilder;
						$command=$builder->createMultipleInsertCommand('turnos_servicios', $turno_servicios);
						$command->execute();
					}

					for($m = 0; $m < $n; $m++)
					{
						for($p = 1; $p < $c; $p++)
						{
							if($novedades[$m]['turno'] == $nombre_turnos[$p])
							{
								$turno_novedad = array('turnov_tur_id' => $turnos_id[$p], 'turnov_nov_id' => $novedades[$m]['nov_id'], 'turnov_dia' => $novedades[$m]['nov_dia'], 'turnov_horaInicio' => $novedades[$m]['nov_horaInicio'], 'turnov_horaFin' => $novedades[$m]['nov_horaFin'], 'turnov_fecha' => $novedades[$m]['nov_fecha']);

								$model_turnov=new TurnosNovedades;
								$model_turnov->attributes = $turno_novedad;

								if($model_turnov->validate())
								{
									$turnos_novedades[$m] = $turno_novedad;
								}
								else
								{
									// Errores en turnos novedades
									//echo "<pre>";
									//print_r($model_turnov->getErrors());
									//echo "</pre><br>";
									//die();
								}
							}
						}
					}

					$builder=Yii::app()->db->schema->commandBuilder;
					$command=$builder->createMultipleInsertCommand('turnos_novedades', $turnos_novedades);
					$command->execute();

					unset($registros);
					unset($turnos);
					unset($nombre_turnos);
					unset($turnos_id);
					unset($turno_servicio);
					unset($turno_servicios);
					unset($turno_novedad);
					unset($turnos_novedades);
					$i=0;
					$j=0;
					$k=1;
					$c=1;
					$band_turno=0;
				}

				if($key > 0)
				{	
					$linea_archivo = $key+1;
					$datos = explode(";", $linea);

					$datos[0] = utf8_encode($datos[0]);

					if(($i == 0) && ($datos[0] != ''))
					{
						$nombre_turno = $datos[0];

						$band_nomturno = $this->validarNombreTurno($nombre_turno);

						if($band_nomturno != '')
						{
							$nov_errores .= "<div class='flash-error'>Ya existe un turno creado con el nombre " .$nombre_turno. ".</div><br>";
							$band_turno=1;
							$contErrores++;
						}
						else
						{
							$dato['tur_nombre'] = $nombre_turno;
							$dato['tur_fechacreado'] = $fecha;
							$dato['tur_creadopor'] = $usuario;
							$dato['tur_fechamodificado'] = $fecha;
							$dato['tur_modificadopor'] = $usuario;
						}

						if($datos[1] == 'Lunes')
						{	
							if($datos[2] != '' && $datos[3] != '')
							{
								$dato['tur_horaInicioLunes'] = $datos[2]; 
								$dato['tur_horaFinLunes'] = $datos[3];
							}
							else
							{
								if($datos[2] != '' && $datos[3] == '')
								{
									$nov_errores .= "<div class='flash-error'>La hora fin del turno del día lunes del turno " .$nombre_turno. " en la línea " .$linea_archivo. " del archivo no puede ser vacía.</div><br>";
									$band_turno=1;
									$contErrores++;
								}
								else
								{
									if($datos[2] == '' && $datos[3] != '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del turno del día lunes del turno " .$nombre_turno. " en la línea " .$linea_archivo. " del archivo no puede ser vacía.</div><br>";
										$band_turno=1;
										$contErrores++;
									}
								}
							}

							// Novedad Reunion
							if($datos[5] != '' && $datos[6] != '')
							{
								$n++;
								$novedades[$n]['id'] = $key;
								$novedades[$n]['turno'] = $nombre_turno; 
								$novedades[$n]['nov_id'] = 5;
								$novedades[$n]['nov_dia'] = 'Lunes';
								$novedades[$n]['nov_horaInicio'] = $datos[5];
								$novedades[$n]['nov_horaFin'] = $datos[6];
								$novedades[$n]['nov_fecha'] = $lunes;
							} 
							else 
							{
								if($datos[5] != '' && $datos[6] == '')
								{
									$nov_errores .= "<div class='flash-error'>La hora fin de la reunión del día lunes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
									$contErrores++;
								}
								else 
								{
									if($datos[5] == '' && $datos[6] != '')
									{
										$nov_errores .= "<div class='flash-error'>La hora inicio de la reunión del día lunes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
										$contErrores++;
									}									
								}
								 
							}
							
							// Novedad Almuerzo
							if($datos[7] != '' && $datos[8] != '')
							{
								$n++;
								$novedades[$n]['id'] = $key;
								$novedades[$n]['turno'] = $nombre_turno;
								$novedades[$n]['nov_id'] = 2;
								$novedades[$n]['nov_dia'] = 'Lunes';
								$novedades[$n]['nov_horaInicio'] = $datos[7];
								$novedades[$n]['nov_horaFin'] = $datos[8];
								$novedades[$n]['nov_fecha'] = $lunes;

								// Validacion cantidad horas nomina
								if($datos[2] != '' && $datos[3] != '')
								{
									$horasTurno = $this->dateDifference($datos[3], $datos[2]);
									$horasAlmuerzo = $this->dateDifference($datos[8], $datos[7]);
									$totalHoras = $this->dateDifference($horasTurno, $horasAlmuerzo);

									if($totalHoras < $minHorasDia || $totalHoras > $maxHorasDia)
									{
										$band_turno=1;
										$nov_errores .= "<div class='flash-error'>La jornada del día lunes del turno " .$nombre_turno. " no puede ser superior a 10 horas ni inferior a 4 horas.</div><br>";
										$contErrores++;
									}
								}
							} 
							else 
							{
								if($datos[7] != '' && $datos[8] == '')
								{
									$nov_errores .= "<div class='flash-error'>La hora fin del almuerzo del día lunes del turno " .$nombre_turno. " en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
									$contErrores++; 
								} 
								else
								{
									if($datos[7] == '' && $datos[8] != '')
									{
										$nov_errores .= "<div class='flash-error'>La hora inicio del almuerzo del día lunes del turno " .$nombre_turno. " en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
										$contErrores++;
									}
								}
							}

							// Novedad Capacitacion
							if($datos[9] != '' && $datos[10] != '')
							{
								$n++;
								$novedades[$n]['id'] = $key;
								$novedades[$n]['turno'] = $nombre_turno;
								$novedades[$n]['nov_id'] = 7;
								$novedades[$n]['nov_dia'] = 'Lunes';
								$novedades[$n]['nov_horaInicio'] = $datos[9];
								$novedades[$n]['nov_horaFin'] = $datos[10];
								$novedades[$n]['nov_fecha'] = $lunes;
							} 
							else 
							{
								if($datos[9] != '' && $datos[10] == '')
								{
									$nov_errores .= "<div class='flash-error'>La hora fin de la capacitación del día lunes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div>"; 
									$contErrores++;
								}
								else
								{
									if($datos[9] == '' && $datos[10] != '')
									{
										$nov_errores .= "<div class='flash-error'>La hora inicio de la capacitación del día lunes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
										$contErrores++;
									}
								}
								 
							}
							
							// Novedad Descanso 1
							if($datos[11] != '' && $datos[12] != '')
							{
								$n++;
								$novedades[$n]['id'] = $key;
								$novedades[$n]['turno'] = $nombre_turno;
								$novedades[$n]['nov_id'] = 3;
								$novedades[$n]['nov_dia'] = 'Lunes';
								$novedades[$n]['nov_horaInicio'] = $datos[11];
								$novedades[$n]['nov_horaFin'] = $datos[12];
								$novedades[$n]['nov_fecha'] = $lunes;
							} 
							else 
							{
								if($datos[11] != '' && $datos[12] == '')
								{
									$nov_errores .= "<div class='flash-error'>La hora fin del descanso 1 del día lunes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
									$contErrores++;
								}
								else
								{
									if($datos[11] == '' && $datos[12] != '')
									{
										$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 1 del día lunes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
										$contErrores++;
									}
								}
							}
							
							// Novedad Descanso 2
							if($datos[13] != '' && $datos[14] != '')
							{
								$n++;
								$novedades[$n]['id'] = $key;
								$novedades[$n]['turno'] = $nombre_turno;
								$novedades[$n]['nov_id'] = 3;
								$novedades[$n]['nov_dia'] = 'Lunes';
								$novedades[$n]['nov_horaInicio'] = $datos[13];
								$novedades[$n]['nov_horaFin'] = $datos[14];
								$novedades[$n]['nov_fecha'] = $lunes;
							} 
							else
							{
								if($datos[13] != '' && $datos[14] == '')
								{
									$nov_errores .= "<div class='flash-error'>La hora fin del descanso 2 del día lunes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
									$contErrores++;
								}
								else
								{
									if($datos[13] == '' && $datos[14] != '')
									{
										$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 2 del día lunes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
										$contErrores++; 
									}
								}
							}
							
							// Novedad Descanso 3
							if($datos[15] != '' && $datos[16] != '')
							{
								$n++;
								$novedades[$n]['id'] = $key;
								$novedades[$n]['turno'] = $nombre_turno;
								$novedades[$n]['nov_id'] = 3;
								$novedades[$n]['nov_dia'] = 'Lunes';
								$novedades[$n]['nov_horaInicio'] = $datos[15];
								$novedades[$n]['nov_horaFin'] = $datos[16];
								$novedades[$n]['nov_fecha'] = $lunes;
							} 
							else 
							{
								if($datos[15] != '' && $datos[16] == '')
								{
									$nov_errores .= "<div class='flash-error'>La hora fin del descanso 3 del día lunes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
									$contErrores++;
								}  
								else
								{
									if($datos[15] == '' && $datos[16] != '')
									{
										$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 3 del día lunes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
										$contErrores++;
									}
								}
							}
							
							// Novedad Descanso 4
							if($datos[17] != '' && $datos[18] != '')
							{
								$n++;
								$novedades[$n]['id'] = $key;
								$novedades[$n]['turno'] = $nombre_turno;
								$novedades[$n]['nov_id'] = 3;
								$novedades[$n]['nov_dia'] = 'Lunes';
								$novedades[$n]['nov_horaInicio'] = $datos[17];
								$novedades[$n]['nov_horaFin'] = $datos[18];
								$novedades[$n]['nov_fecha'] = $lunes;
							} 
							else
							{
								if($datos[17] != '' && $datos[18] == '')
								{
									$nov_errores .= "<div class='flash-error'>La hora fin del descanso 4 del día lunes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
									$contErrores++;
								}
								else
								{
									if($datos[17] == '' && $datos[18] != '')
									{
										$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 4 del día lunes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
										$contErrores++;
									}
								}	
							}
							
						}
						else 
						{
							$dato['tur_horaInicioLunes'] = ''; 
							$dato['tur_horaFinLunes'] = '';
							// Error en la linea $key
						}
						$i++;
					}
					else
					{
						$aux = $nombre_turno;

						$nombre_turno = $datos[0];

						if(($nombre_turno == $aux) && ($datos[0] != ''))
						{
							if ($datos[1] == 'Martes') 
							{
								if($datos[2] != '' && $datos[3])
								{
									$dato['tur_horaInicioMartes'] = $datos[2]; 
									$dato['tur_horaFinMartes'] = $datos[3];
								}
								else
								{
									if($datos[2] != '' && $datos[3] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del turno del día martes del turno " .$nombre_turno. " en la línea " .$linea_archivo. " del archivo no puede ser vacía.</div><br>";
										$band_turno=1;
										$contErrores++;
									}
									else
									{
										if($datos[2] == '' && $datos[3] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora fin del turno del día martes del turno " .$nombre_turno. " en la línea " .$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$band_turno=1;
											$contErrores++;
										}
									}
								}

								// Novedad Reunion
								if($datos[5] != '' && $datos[6] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 5;
									$novedades[$n]['nov_dia'] = 'Martes';
									$novedades[$n]['nov_horaInicio'] = $datos[5];
									$novedades[$n]['nov_horaFin'] = $datos[6];
									$novedades[$n]['nov_fecha'] = $martes;
								}
								else 
								{
									if($datos[5] != '' && $datos[6] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin de la reunión del día martes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
										$contErrores++;
									}
									else 
									{
										if($datos[5] == '' && $datos[6] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio de la reunión del día martes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
											$contErrores++;
										}									
									}
									 
								}
								
								// Novedad Almuerzo
								if($datos[7] != '' && $datos[8] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 2;
									$novedades[$n]['nov_dia'] = 'Martes';
									$novedades[$n]['nov_horaInicio'] = $datos[7];
									$novedades[$n]['nov_horaFin'] = $datos[8];
									$novedades[$n]['nov_fecha'] = $martes;

									// Validacion cantidad horas nomina
									if($datos[2] != '' && $datos[3] != '')
									{
										$horasTurno = $this->dateDifference($datos[3], $datos[2]);
										$horasAlmuerzo = $this->dateDifference($datos[8], $datos[7]);
										$totalHoras = $this->dateDifference($horasTurno, $horasAlmuerzo);
										if($totalHoras < $minHorasDia || $totalHoras > $maxHorasDia)
										{
											$band_turno=1;
											$nov_errores .= "<div class='flash-error'>La jornada del día martes
											 del turno " .$nombre_turno. " no puede ser superior a 10 horas ni inferior a 4 horas.</div><br>";
											$contErrores++;
										}
										
									}
								}
								else 
								{
									if($datos[7] != '' && $datos[8] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del almuerzo del día martes del turno " .$nombre_turno. " en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";  
										$contErrores++;
									} 
									else
									{
										if($datos[7] == '' && $datos[8] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del almuerzo del día martes del turno " .$nombre_turno. " en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
											$contErrores++;
										}
									}
								}
								
								// Novedad Capacitacion
								if($datos[9] != '' && $datos[10] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 7;
									$novedades[$n]['nov_dia'] = 'Martes';
									$novedades[$n]['nov_horaInicio'] = $datos[9];
									$novedades[$n]['nov_horaFin'] = $datos[10];
									$novedades[$n]['nov_fecha'] = $martes;
								}
								else 
								{
									if($datos[9] != '' && $datos[10] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin de la capacitación del día martes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
										$contErrores++;
									}
									else
									{
										if($datos[9] == '' && $datos[10] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio de la capacitación del día martes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
											$contErrores++;
										}
									}
									 
								}
								
								// Novedad Descanso 1
								if($datos[11] != '' && $datos[12] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 3;
									$novedades[$n]['nov_dia'] = 'Martes';
									$novedades[$n]['nov_horaInicio'] = $datos[11];
									$novedades[$n]['nov_horaFin'] = $datos[12];
									$novedades[$n]['nov_fecha'] = $martes;
								}
								else 
								{
									if($datos[11] != '' && $datos[12] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del descanso 1 del día martes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
										$contErrores++;
									}
									else
									{
										if($datos[11] == '' && $datos[12] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 1 del día martes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
											$contErrores++;
										}
									}
								}
								
								// Novedad Descanso 2
								if($datos[13] != '' && $datos[14] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 3;
									$novedades[$n]['nov_dia'] = 'Martes';
									$novedades[$n]['nov_horaInicio'] = $datos[13];
									$novedades[$n]['nov_horaFin'] = $datos[14];
									$novedades[$n]['nov_fecha'] = $martes;
								}
								else
								{
									if($datos[13] != '' && $datos[14] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del descanso 2 del día martes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
										$contErrores++;
									}
									else
									{
										if($datos[13] == '' && $datos[14] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 2 del día martes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
											$contErrores++;
										}
									}
								}
								
								// Novedad Descanso 3
								if($datos[15] != '' && $datos[16] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 3;
									$novedades[$n]['nov_dia'] = 'Martes';
									$novedades[$n]['nov_horaInicio'] = $datos[15];
									$novedades[$n]['nov_horaFin'] = $datos[16];
									$novedades[$n]['nov_fecha'] = $martes;
								}
								else 
								{
									if($datos[15] != '' && $datos[16] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del descanso 3 del día martes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
										$contErrores++;
									}  
									else
									{
										if($datos[15] == '' && $datos[16] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 3 del día martes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$contErrores++;
										}
									}
								}
								
								// Novedad Descanso 4
								if($datos[17] != '' && $datos[18] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 3;
									$novedades[$n]['nov_dia'] = 'Martes';
									$novedades[$n]['nov_horaInicio'] = $datos[17];
									$novedades[$n]['nov_horaFin'] = $datos[18];
									$novedades[$n]['nov_fecha'] = $martes;
								}
								else
								{
									if($datos[17] != '' && $datos[18] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del descanso 4 del día martes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
										$contErrores++;
									}
									else
									{
										if($datos[17] == '' && $datos[18] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 4 del día martes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$contErrores++;
										}
									}	
								}
								
							}

							if($datos[1] == 'Miercoles')
							{
								if($datos[2] != '' && $datos[3])
								{
									$dato['tur_horaInicioMiercoles'] = $datos[2]; 
									$dato['tur_horaFinMiercoles'] = $datos[3];
								}
								else
								{
									if($datos[2] != '' && $datos[3] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del turno del día miercoles del turno " .$nombre_turno. " en la línea " .$linea_archivo. " del archivo no puede ser vacía.</div><br>";
										$band_turno=1;
										$contErrores++;
									}
									else
									{
										if($datos[2] == '' && $datos[3] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora fin del turno del día miercoles del turno " .$nombre_turno. " en la línea " .$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$band_turno=1;
											$contErrores++;
										}
									}
								}

								// Novedad Reunion
								if($datos[5] != '' && $datos[6] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 5;
									$novedades[$n]['nov_dia'] = 'Miercoles';
									$novedades[$n]['nov_horaInicio'] = $datos[5];
									$novedades[$n]['nov_horaFin'] = $datos[6];
									$novedades[$n]['nov_fecha'] = $miercoles;
								}
								else 
								{
									if($datos[5] != '' && $datos[6] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin de la reunión del día miercoles del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
										$contErrores++;
									}
									else 
									{
										if($datos[5] == '' && $datos[6] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio de la reunión del día miercoles del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
											$contErrores++;
										}									
									}
									 
								}
								
								// Novedad Almuerzo
								if($datos[7] != '' && $datos[8] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 2;
									$novedades[$n]['nov_dia'] = 'Miercoles';
									$novedades[$n]['nov_horaInicio'] = $datos[7];
									$novedades[$n]['nov_horaFin'] = $datos[8];
									$novedades[$n]['nov_fecha'] = $miercoles;

									// Validacion cantidad horas nomina
									if($datos[2] != '' && $datos[3] != '')
									{
										$horasTurno = $this->dateDifference($datos[3], $datos[2]);
										$horasAlmuerzo = $this->dateDifference($datos[8], $datos[7]);
										$totalHoras = $this->dateDifference($horasTurno, $horasAlmuerzo);

										if($totalHoras < $minHorasDia || $totalHoras > $maxHorasDia)
										{
											$band_turno=1;
											$nov_errores .= "<div class='flash-error'>La jornada del día miercoles del turno " .$nombre_turno. " no puede ser superior a 10 horas ni inferior a 4 horas.</div><br>";
											$contErrores++;
										}
										
									}
								}
								else 
								{
									if($datos[7] != '' && $datos[8] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del almuerzo del día miercoles del turno " .$nombre_turno. " en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
										$contErrores++; 
									} 
									else
									{
										if($datos[7] == '' && $datos[8] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del almuerzo del día miercoles del turno " .$nombre_turno. " en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
											$contErrores++;
										}
									}
								}
								
								// Novedad Capacitacion
								if($datos[9] != '' && $datos[10] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 7;
									$novedades[$n]['nov_dia'] = 'Miercoles';
									$novedades[$n]['nov_horaInicio'] = $datos[9];
									$novedades[$n]['nov_horaFin'] = $datos[10];
									$novedades[$n]['nov_fecha'] = $miercoles;
								}
								else 
								{
									if($datos[9] != '' && $datos[10] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin de la capacitación del día miercoles del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
										$contErrores++;
									}
									else
									{
										if($datos[9] == '' && $datos[10] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio de la capacitación del día miercoles del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$contErrores++; 
										}
									}
									 
								}
								
								// Novedad Descanso 1
								if($datos[11] != '' && $datos[12] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 3;
									$novedades[$n]['nov_dia'] = 'Miercoles';
									$novedades[$n]['nov_horaInicio'] = $datos[11];
									$novedades[$n]['nov_horaFin'] = $datos[12];
									$novedades[$n]['nov_fecha'] = $miercoles;
								}
								else 
								{
									if($datos[11] != '' && $datos[12] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del descanso 1 del día miercoles del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
										$contErrores++;
									}
									else
									{
										if($datos[11] == '' && $datos[12] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 1 del día miercoles del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
											$contErrores++;
										}
									}
								}
								
								// Novedad Descanso 2
								if($datos[13] != '' && $datos[14] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 3;
									$novedades[$n]['nov_dia'] = 'Miercoles';
									$novedades[$n]['nov_horaInicio'] = $datos[13];
									$novedades[$n]['nov_horaFin'] = $datos[14];
									$novedades[$n]['nov_fecha'] = $miercoles;
								}
								else
								{
									if($datos[13] != '' && $datos[14] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del descanso 2 del día miercoles del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
										$contErrores++;
									}
									else
									{
										if($datos[13] == '' && $datos[14] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 2 del día miercoles del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
											$contErrores++;
										}
									}
								}

								// Novedad Descanso 3
								if($datos[15] != '' && $datos[16] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 3;
									$novedades[$n]['nov_dia'] = 'Miercoles';
									$novedades[$n]['nov_horaInicio'] = $datos[15];
									$novedades[$n]['nov_horaFin'] = $datos[16];
									$novedades[$n]['nov_fecha'] = $miercoles;
								}
								else 
								{
									if($datos[15] != '' && $datos[16] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del descanso 3 del día miercoles del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
										$contErrores++;
									}  
									else
									{
										if($datos[15] == '' && $datos[16] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 3 del día miercoles del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$contErrores++;
										}
									}
								}

								// Novedad Descanso 4
								if($datos[17] != '' && $datos[18] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 3;
									$novedades[$n]['nov_dia'] = 'Miercoles';
									$novedades[$n]['nov_horaInicio'] = $datos[17];
									$novedades[$n]['nov_horaFin'] = $datos[18];
									$novedades[$n]['nov_fecha'] = $miercoles;
								}
								else
								{
									if($datos[17] != '' && $datos[18] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del descanso 4 del día miercoles del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
										$contErrores++;
									}
									else
									{
										if($datos[17] == '' && $datos[18] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 4 del día miercoles del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$contErrores++;
										}
									}	
								}
								
							}

							if($datos[1] == 'Jueves')
							{
								if($datos[2] != '' && $datos[3])
								{
									$dato['tur_horaInicioJueves'] = $datos[2]; 
									$dato['tur_horaFinJueves'] = $datos[3];
								}
								else
								{
									if($datos[2] != '' && $datos[3] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del turno del día jueves del turno " .$nombre_turno. " en la línea " .$linea_archivo. " del archivo no puede ser vacía.</div><br>";
										$band_turno=1;
										$contErrores++;
									}
									else
									{
										if($datos[2] == '' && $datos[3] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del turno del día jueves del turno " .$nombre_turno. " en la línea " .$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$band_turno=1;
											$contErrores++;
										}
									}
								}

								// Novedad Reunion
								if($datos[5] != '' && $datos[6] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 5;
									$novedades[$n]['nov_dia'] = 'Jueves';
									$novedades[$n]['nov_horaInicio'] = $datos[5];
									$novedades[$n]['nov_horaFin'] = $datos[6];
									$novedades[$n]['nov_fecha'] = $jueves;
								}
								else 
								{
									if($datos[5] != '' && $datos[6] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin de la reunión del día jueves del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
										$contErrores++;
									}
									else 
									{
										if($datos[5] == '' && $datos[6] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio de la reunión del día jueves del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
											$contErrores++;
										}									
									}
									 
								}
								
								// Novedad Almuerzo
								if($datos[7] != '' && $datos[8] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 2;
									$novedades[$n]['nov_dia'] = 'Jueves';
									$novedades[$n]['nov_horaInicio'] = $datos[7];
									$novedades[$n]['nov_horaFin'] = $datos[8];
									$novedades[$n]['nov_fecha'] = $jueves;

									// Validacion cantidad horas nomina
									if($datos[2] != '' && $datos[3] != '')
									{
										$horasTurno = $this->dateDifference($datos[3], $datos[2]);
										$horasAlmuerzo = $this->dateDifference($datos[8], $datos[7]);
										$totalHoras = $this->dateDifference($horasTurno, $horasAlmuerzo);

										if($totalHoras < $minHorasDia || $totalHoras > $maxHorasDia)
										{
											$band_turno=1;
											$nov_errores .= "<div class='flash-error'>La jornada del día jueves
											 del turno " .$nombre_turno. " no puede ser superior a 10 horas ni inferior a 4 horas.</div><br>";
											 $contErrores++;
										}
										
									}
								}
								else 
								{
									if($datos[7] != '' && $datos[8] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del almuerzo del día jueves del turno " .$nombre_turno. " en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";  
										$contErrores++;
									} 
									else
									{
										if($datos[7] == '' && $datos[8] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del almuerzo del día jueves del turno " .$nombre_turno. " en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
											$contErrores++;
										}
									}
								}
								
								// Novedad Capacitacion
								if($datos[9] != '' && $datos[10] != '')
								{
									$n++; 
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 7;
									$novedades[$n]['nov_dia'] = 'Jueves';
									$novedades[$n]['nov_horaInicio'] = $datos[9];
									$novedades[$n]['nov_horaFin'] = $datos[10];
									$novedades[$n]['nov_fecha'] = $jueves;
								}
								else 
								{
									if($datos[9] != '' && $datos[10] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin de la capacitación del día jueves del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
										$contErrores++;
									}
									else
									{
										if($datos[9] == '' && $datos[10] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio de la capacitación del día jueves del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$contErrores++; 
										}
									}
									 
								}
								
								// Novedad Descanso 1
								if($datos[11] != '' && $datos[12] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 3;
									$novedades[$n]['nov_dia'] = 'Jueves';
									$novedades[$n]['nov_horaInicio'] = $datos[11];
									$novedades[$n]['nov_horaFin'] = $datos[12];
									$novedades[$n]['nov_fecha'] = $jueves;
								}
								else 
								{
									if($datos[11] != '' && $datos[12] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del descanso 1 del día jueves del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
										$contErrores++;
									}
									else
									{
										if($datos[11] == '' && $datos[12] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 1 del día jueves del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
											$contErrores++;
										}
									}
								}
								
								// Novedad Descanso 2
								if($datos[13] != '' && $datos[14] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 3;
									$novedades[$n]['nov_dia'] = 'Jueves';
									$novedades[$n]['nov_horaInicio'] = $datos[13];
									$novedades[$n]['nov_horaFin'] = $datos[14];
									$novedades[$n]['nov_fecha'] = $jueves;
								}
								else
								{
									if($datos[13] != '' && $datos[14] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del descanso 2  del día jueves del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
										$contErrores++;
									}
									else
									{
										if($datos[13] == '' && $datos[14] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 2 del día jueves del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
											$contErrores++;
										}
									}
								}
								
								// Novedad Descanso 3
								if($datos[15] != '' && $datos[16] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 3;
									$novedades[$n]['nov_dia'] = 'Jueves';
									$novedades[$n]['nov_horaInicio'] = $datos[15];
									$novedades[$n]['nov_horaFin'] = $datos[16];
									$novedades[$n]['nov_fecha'] = $jueves;
								}
								else 
								{
									if($datos[15] != '' && $datos[16] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del descanso 3 del día jueves del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
										$contErrores++;
									}  
									else
									{
										if($datos[15] == '' && $datos[16] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 3 del día jueves del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$contErrores++;
										}
									}
								}
								
								// Novedad Descanso 4
								if($datos[17] != '' && $datos[18] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 3;
									$novedades[$n]['nov_dia'] = 'Jueves';
									$novedades[$n]['nov_horaInicio'] = $datos[17];
									$novedades[$n]['nov_horaFin'] = $datos[18];
									$novedades[$n]['nov_fecha'] = $jueves;
								}
								else
								{
									if($datos[17] != '' && $datos[18] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del descanso 4 del día jueves del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
										$contErrores++;
									}
									else
									{
										if($datos[17] == '' && $datos[18] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 4 del día jueves del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$contErrores++;
										}
									}	
								}
								
							}

							if($datos[1] == 'Viernes')
							{
								if($datos[2] != '' && $datos[3])
								{
									$dato['tur_horaInicioViernes'] = $datos[2]; 
									$dato['tur_horaFinViernes'] = $datos[3];
								}
								else
								{
									if($datos[2] != '' && $datos[3] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del turno del día viernes del turno " .$nombre_turno. " en la línea " .$linea_archivo. " del archivo no puede ser vacía.</div><br>";
										$band_turno=1;
										$contErrores++;
									}
									else
									{
										if($datos[2] == '' && $datos[3] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora fin del turno del día viernes del turno " .$nombre_turno. " en la línea " .$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$band_turno=1;
											$contErrores++;
										}
									}
								}

								// Novedad Reunion
								if($datos[5] != '' && $datos[6] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 5;
									$novedades[$n]['nov_dia'] = 'Viernes';
									$novedades[$n]['nov_horaInicio'] = $datos[5];
									$novedades[$n]['nov_horaFin'] = $datos[6];
									$novedades[$n]['nov_fecha'] = $viernes;
								}
								else 
								{
									if($datos[5] != '' && $datos[6] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin de la reunión del día viernes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
										$contErrores++;
									}
									else 
									{
										if($datos[5] == '' && $datos[6] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio de la reunión del día viernes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$contErrores++; 
										}									
									}
									 
								}
								
								// Novedad Almuerzo
								if($datos[7] != '' && $datos[8] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 2;
									$novedades[$n]['nov_dia'] = 'Viernes';
									$novedades[$n]['nov_horaInicio'] = $datos[7];
									$novedades[$n]['nov_horaFin'] = $datos[8];
									$novedades[$n]['nov_fecha'] = $viernes;

									// Validacion cantidad horas nomina
									if($datos[2] != '' && $datos[3] != '')
									{
										$horasTurno = $this->dateDifference($datos[3], $datos[2]);
										$horasAlmuerzo = $this->dateDifference($datos[8], $datos[7]);
										$totalHoras = $this->dateDifference($horasTurno, $horasAlmuerzo);

										if($totalHoras < $minHorasDia || $totalHoras > $maxHorasDia)
										{
											$band_turno=1;
											$nov_errores .= "<div class='flash-error'>La jornada del día viernes
											 del turno " .$nombre_turno. " no puede ser superior a 10 horas ni inferior a 4 horas.</div><br>";
											 $contErrores++;
										}
										
									}
								}
								else 
								{
									if($datos[7] != '' && $datos[8] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del almuerzo del día viernes del turno " .$nombre_turno. " en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";  
										$contErrores++;
									} 
									else
									{
										if($datos[7] == '' && $datos[8] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del almuerzo del día viernes del turno " .$nombre_turno. " en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
											$contErrores++;
										}
									}
								}
								
								// Novedad Capacitacion
								if($datos[9] != '' && $datos[10] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 7;
									$novedades[$n]['nov_dia'] = 'Viernes';
									$novedades[$n]['nov_horaInicio'] = $datos[9];
									$novedades[$n]['nov_horaFin'] = $datos[10];
									$novedades[$n]['nov_fecha'] = $viernes;
								}
								else 
								{
									if($datos[9] != '' && $datos[10] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin de la capacitación del día viernes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
										$contErrores++;
									}
									else
									{
										if($datos[9] == '' && $datos[10] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio de la capacitación del día viernes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$contErrores++; 
										}
									}
									 
								}
								
								// Novedad Descanso 1
								if($datos[11] != '' && $datos[12] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 3;
									$novedades[$n]['nov_dia'] = 'Viernes';
									$novedades[$n]['nov_horaInicio'] = $datos[11];
									$novedades[$n]['nov_horaFin'] = $datos[12];
									$novedades[$n]['nov_fecha'] = $viernes;
								}
								else 
								{
									if($datos[11] != '' && $datos[12] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del descanso 1 del día viernes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
										$contErrores++;
									}
									else
									{
										if($datos[11] == '' && $datos[12] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 1 del día viernes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$contErrores++; 
										}
									}
								}
								
								// Novedad Descanso 2
								if($datos[13] != '' && $datos[14] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 3;
									$novedades[$n]['nov_dia'] = 'Viernes';
									$novedades[$n]['nov_horaInicio'] = $datos[13];
									$novedades[$n]['nov_horaFin'] = $datos[14];
									$novedades[$n]['nov_fecha'] = $viernes;
								}
								else
								{
									if($datos[13] != '' && $datos[14] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del descanso 2 del día viernes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
										$contErrores++;
									}
									else
									{
										if($datos[13] == '' && $datos[14] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 2 del día viernes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$contErrores++; 
										}
									}
								}
								
								// Novedad Descanso 3
								if($datos[15] != '' && $datos[16] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 3;
									$novedades[$n]['nov_dia'] = 'Viernes';
									$novedades[$n]['nov_horaInicio'] = $datos[15];
									$novedades[$n]['nov_horaFin'] = $datos[16];
									$novedades[$n]['nov_fecha'] = $viernes;
								}
								else 
								{
									if($datos[15] != '' && $datos[16] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del descanso 3 del día viernes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
										$contErrores++;
									}  
									else
									{
										if($datos[15] == '' && $datos[16] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 3 del día viernes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$contErrores++;
										}
									}
								}
								
								// Novedad Descanso 4
								if($datos[17] != '' && $datos[18] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 3;
									$novedades[$n]['nov_dia'] = 'Viernes';
									$novedades[$n]['nov_horaInicio'] = $datos[17];
									$novedades[$n]['nov_horaFin'] = $datos[18];
									$novedades[$n]['nov_fecha'] = $viernes;
								} 
								else
								{
									if($datos[17] != '' && $datos[18] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del descanso 4 del día viernes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
										$contErrores++;
									}
									else
									{
										if($datos[17] == '' && $datos[18] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 4 del día viernes del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$contErrores++;
										}
									}	
								}
								
							}

							if($datos[1] == 'Sabado')
							{
								if($datos[2] != '' && $datos[3])
								{
									$dato['tur_horaInicioSabado'] = $datos[2]; 
									$dato['tur_horaFinSabado'] = $datos[3];
								}
								else
								{
									if($datos[2] != '' && $datos[3] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del turno del día sabado del turno " .$nombre_turno. " en la línea " .$linea_archivo. " del archivo no puede ser vacía.</div><br>";
										$band_turno=1;
										$contErrores++;
									}
									else
									{
										if($datos[2] == '' && $datos[3] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora fin del turno del día sabado del turno " .$nombre_turno. " en la línea " .$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$band_turno=1;
											$contErrores++;
										}
									}
								}

								// Novedad Reunion
								if($datos[5] != '' && $datos[6] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 5;
									$novedades[$n]['nov_dia'] = 'Sabado';
									$novedades[$n]['nov_horaInicio'] = $datos[5];
									$novedades[$n]['nov_horaFin'] = $datos[6];
									$novedades[$n]['nov_fecha'] = $sabado;
								}
								else 
								{
									if($datos[5] != '' && $datos[6] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin de la reunión del día sabado del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
										$contErrores++;
									}
									else 
									{
										if($datos[5] == '' && $datos[6] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio de la reunión del día sabado del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$contErrores++; 
										}									
									}
									 
								}
								
								// Novedad Almuerzo
								if($datos[7] != '' && $datos[8] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 2;
									$novedades[$n]['nov_dia'] = 'Sabado';
									$novedades[$n]['nov_horaInicio'] = $datos[7];
									$novedades[$n]['nov_horaFin'] = $datos[8];
									$novedades[$n]['nov_fecha'] = $sabado;

									// Validacion cantidad horas nomina
									if($datos[2] != '' && $datos[3] != '')
									{
										$horasTurno = $this->dateDifference($datos[3], $datos[2]);
										$horasAlmuerzo = $this->dateDifference($datos[8], $datos[7]);
										$totalHoras = $this->dateDifference($horasTurno, $horasAlmuerzo);

										if($totalHoras < $minHorasDia || $totalHoras > $maxHorasDia)
										{
											$band_turno=1;
											$nov_errores .= "<div class='flash-error'>La jornada del día sabado
											 del turno " .$nombre_turno. " no puede ser superior a 10 horas ni inferior a 4 horas.</div><br>";
											 $contErrores++;
										}
										
									}
								}
								else 
								{
									if($datos[7] != '' && $datos[8] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del almuerzo del día sabado del turno " .$nombre_turno. " en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";  
										$contErrores++;
									} 
									else
									{
										if($datos[7] == '' && $datos[8] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del almuerzo del día sabado del turno " .$nombre_turno. " en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
											$contErrores++;
										}
									}
								}
								
								// Novedad Capacitacion
								if($datos[9] != '' && $datos[10] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 7;
									$novedades[$n]['nov_dia'] = 'Sabado';
									$novedades[$n]['nov_horaInicio'] = $datos[9];
									$novedades[$n]['nov_horaFin'] = $datos[10];
									$novedades[$n]['nov_fecha'] = $sabado;
								}
								else 
								{
									if($datos[9] != '' && $datos[10] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin de la capacitación del día sabado del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
										$contErrores++;
									}
									else
									{
										if($datos[9] == '' && $datos[10] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio de la capacitación del día sabado del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
											$contErrores++;
										}
									}
									 
								}
								
								// Novedad Descanso 1
								if($datos[11] != '' && $datos[12] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 3;
									$novedades[$n]['nov_dia'] = 'Sabado';
									$novedades[$n]['nov_horaInicio'] = $datos[11];
									$novedades[$n]['nov_horaFin'] = $datos[12];
									$novedades[$n]['nov_fecha'] = $sabado;
								}
								else 
								{
									if($datos[11] != '' && $datos[12] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del descanso 1 del día sabado del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
										$contErrores++;
									}
									else
									{
										if($datos[11] == '' && $datos[12] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 1 del día sabado del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$contErrores++; 
										}
									}
								}
								
								// Novedad Descanso 2
								if($datos[13] != '' && $datos[14] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 3;
									$novedades[$n]['nov_dia'] = 'Sabado';
									$novedades[$n]['nov_horaInicio'] = $datos[13];
									$novedades[$n]['nov_horaFin'] = $datos[14];
									$novedades[$n]['nov_fecha'] = $sabado;
								}
								else
								{
									if($datos[13] != '' && $datos[14] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del descanso 2 del día sabado del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
										$contErrores++;
									}
									else
									{
										if($datos[13] == '' && $datos[14] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 2 del día sabado del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$contErrores++; 
										}
									}
								}
								
								// Novedad Descanso 3
								if($datos[15] != '' && $datos[16] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 3;
									$novedades[$n]['nov_dia'] = 'Sabado';
									$novedades[$n]['nov_horaInicio'] = $datos[15];
									$novedades[$n]['nov_horaFin'] = $datos[16];
									$novedades[$n]['nov_fecha'] = $sabado;
								}
								else 
								{
									if($datos[15] != '' && $datos[16] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del descanso 3 del día sabado del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
										$contErrores++;
									}  
									else
									{
										if($datos[15] == '' && $datos[16] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 3 del día sabado del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$contErrores++;
										}
									}
								}
								
								// Novedad Descanso 4
								if($datos[17] != '' && $datos[18] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 3;
									$novedades[$n]['nov_dia'] = 'Sabado';
									$novedades[$n]['nov_horaInicio'] = $datos[17];
									$novedades[$n]['nov_horaFin'] = $datos[18];
									$novedades[$n]['nov_fecha'] = $sabado;
								}
								else
								{
									if($datos[17] != '' && $datos[18] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del descanso 4 del día sabado del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
										$contErrores++;
									}
									else
									{
										if($datos[17] == '' && $datos[18] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 4 del día sabado del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$contErrores++;
										}
									}	
								}
								
							}

							if($datos[1] == 'Domingo')
							{
								if($datos[2] != '' && $datos[3])
								{
									$dato['tur_horaInicioDomingo'] = $datos[2]; 
									$dato['tur_horaFinDomingo'] = $datos[3];
								}
								else
								{
									if($datos[2] != '' && $datos[3] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del turno del día domingo del turno " .$nombre_turno. " en la línea " .$linea_archivo. " del archivo no puede ser vacía.</div><br>";
										$band_turno=1;
										$contErrores++;
									}
									else
									{
										if($datos[2] == '' && $datos[3] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora fin del turno del día domingo del turno " .$nombre_turno. " en la línea " .$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$band_turno=1;
											$contErrores++;
										}
									}
								}

								// Novedad Reunion
								if($datos[5] != '' && $datos[6] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 5;
									$novedades[$n]['nov_dia'] = 'Domingo';
									$novedades[$n]['nov_horaInicio'] = $datos[5];
									$novedades[$n]['nov_horaFin'] = $datos[6];
									$novedades[$n]['nov_fecha'] = $domingo;
								}
								else 
								{
									if($datos[5] != '' && $datos[6] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin de la reunión del día domingo del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
										$contErrores++;
									}
									else 
									{
										if($datos[5] == '' && $datos[6] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio de la reunión del día domingo del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
											$contErrores++;
										}									
									}
									 
								}
								
								// Novedad Almuerzo
								if($datos[7] != '' && $datos[8] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 2;
									$novedades[$n]['nov_dia'] = 'Domingo';
									$novedades[$n]['nov_horaInicio'] = $datos[7];
									$novedades[$n]['nov_horaFin'] = $datos[8];
									$novedades[$n]['nov_fecha'] = $domingo;

									// Validacion cantidad horas nomina
									if($datos[2] != '' && $datos[3] != '')
									{
										$horasTurno = $this->dateDifference($datos[3], $datos[2]);
										$horasAlmuerzo = $this->dateDifference($datos[8], $datos[7]);
										$totalHoras = $this->dateDifference($horasTurno, $horasAlmuerzo);

										if($totalHoras < $minHorasDia || $totalHoras > $maxHorasDia)
										{
											$band_turno=1;
											$nov_errores .= "<div class='flash-error'>La jornada del día domingo
											 del turno " .$nombre_turno. " no puede ser superior a 10 horas ni inferior a 4 horas.</div><br>";
											 $contErrores++;
										}
										
									}
								}
								else 
								{
									if($datos[7] != '' && $datos[8] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del almuerzo del día domingo del turno " .$nombre_turno. " en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
										$contErrores++;  
									} 
									else
									{
										if($datos[7] == '' && $datos[8] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del almuerzo del día domingo del turno " .$nombre_turno. " en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
											$contErrores++;
										}
									}
								}
								
								// Novedad Capacitacion
								if($datos[9] != '' && $datos[10] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 7;
									$novedades[$n]['nov_dia'] = 'Domingo';
									$novedades[$n]['nov_horaInicio'] = $datos[9];
									$novedades[$n]['nov_horaFin'] = $datos[10];
									$novedades[$n]['nov_fecha'] = $domingo;
								}
								else 
								{
									if($datos[9] != '' && $datos[10] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin de la capacitación del día domingo del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
										$contErrores++; 
									}
									else
									{
										if($datos[9] == '' && $datos[10] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio de la capacitación del día domingo del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$contErrores++; 
										}
									}
									 
								}
								
								// Novedad Descanso 1
								if($datos[11] != '' && $datos[12] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 3;
									$novedades[$n]['nov_dia'] = 'Domingo';
									$novedades[$n]['nov_horaInicio'] = $datos[11];
									$novedades[$n]['nov_horaFin'] = $datos[12];
									$novedades[$n]['nov_fecha'] = $domingo;
								}
								else 
								{
									if($datos[11] != '' && $datos[12] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del descanso 1 del día domingo del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
										$contErrores++;
									}
									else
									{
										if($datos[11] == '' && $datos[12] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 1 del día domingo del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>"; 
											$contErrores++;
										}
									}
								}
								
								// Novedad Descanso 2
								if($datos[13] != '' && $datos[14] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 3;
									$novedades[$n]['nov_dia'] = 'Domingo';
									$novedades[$n]['nov_horaInicio'] = $datos[13];
									$novedades[$n]['nov_horaFin'] = $datos[14];
									$novedades[$n]['nov_fecha'] = $domingo;
								}
								else
								{
									if($datos[13] != '' && $datos[14] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del descanso 2 del día domingo del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
										$contErrores++; 
									}
									else
									{
										if($datos[13] == '' && $datos[14] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 2 del día domingo del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$contErrores++; 
										}
									}
								}
								
								// Novedad Descanso 3
								if($datos[15] != '' && $datos[16] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 3;
									$novedades[$n]['nov_dia'] = 'Domingo';
									$novedades[$n]['nov_horaInicio'] = $datos[15];
									$novedades[$n]['nov_horaFin'] = $datos[16];
									$novedades[$n]['nov_fecha'] = $domingo;
								}
								else 
								{
									if($datos[15] != '' && $datos[16] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del descanso 3 del día domingo del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
										$contErrores++;
									}  
									else
									{
										if($datos[15] == '' && $datos[16] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 3 del día domingo del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$contErrores++;
										}
									}
								}
								
								// Novedad Descanso 4
								if($datos[17] != '' && $datos[18] != '')
								{
									$n++;
									$novedades[$n]['id'] = $key;
									$novedades[$n]['turno'] = $nombre_turno;
									$novedades[$n]['nov_id'] = 3;
									$novedades[$n]['nov_dia'] = 'Domingo';
									$novedades[$n]['nov_horaInicio'] = $datos[17];
									$novedades[$n]['nov_horaFin'] = $datos[18];
									$novedades[$n]['nov_fecha'] = $domingo;
								}
								else
								{
									if($datos[17] != '' && $datos[18] == '')
									{
										$nov_errores .= "<div class='flash-error'>La hora fin del descanso 4 del día domingo del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
										$contErrores++;
									}
									else
									{
										if($datos[17] == '' && $datos[18] != '')
										{
											$nov_errores .= "<div class='flash-error'>La hora inicio del descanso 4 del día domingo del turno " .$nombre_turno." en la línea ".$linea_archivo. " del archivo no puede ser vacía.</div><br>";
											$contErrores++;
										}
									}	
								}
							}
							$i++;
						}	
					}

					if(($i == 7) && ($band_turno == 0))
					{
						$model_turnos=new Turnos;
						$model_turnos->attributes = $dato;

						$band_ts = $this->validarTurnoServicio($dato, $id_servicio);

						if($band_ts == 1)
						{
							$nov_errores .= "<div class='flash-error'>El horario del turno " .$nombre_turno." se debe encontrar dentro del horario definido del servicio seleccionado.</div><br>";
							$contErrores++;
						}
						else
						{
							if($model_turnos->validate())
							{
								$j++;
								$registros[$j]['id'] = $j;
								$registros[$j]['turno'] = $dato;
								$contTurno++;
								$mensaje_turnos .= "<div class='flash-success'>El turno " .$nombre_turno. " ha sido creado correctamente.</div><br>";
								unset($dato);
							}
							else
							{
								// Errores del turno
							}
						}
						$i=0;	
					} else 
					{
						if(($i == 7) && ($band_turno == 1))
						{
							$i=0;
							$band_turno=0;
						}
					}
				}
			}

			$k=1;
			$c=1;
			if(!empty($registros))
			{
				while($k <= $j)
				{	
					$turnos[$k] = $registros[$k]['turno'];
					$nombre_turnos[$k] = $turnos[$k]['tur_nombre'];
					$k++;
				}
					
				$builder=Yii::app()->db->schema->commandBuilder;
				$command=$builder->createMultipleInsertCommand('turnos', $turnos);
				$command->execute();
				

				while($c < $k)
				{
					$turnos_id[$c] = $this->consultarIdTurnos($nombre_turnos[$c]);
					$c++;
				}

				if($id_servicio)
				{
					for($m = 1; $m < $k; $m++)
					{
						$turnos_id[$m] = $this->consultarIdTurnos($nombre_turnos[$m]);
						$turno_servicio = array('turserv_serv_id' => $id_servicio, 'turserv_tur_id' => $turnos_id[$m]);

						$model_turserv=new TurnosServicios;
						$model_turserv->attributes = $turno_servicio;

						if($model_turserv->validate())
						{
							$turno_servicios[$m] = $turno_servicio;
						}
						else
						{
							// Error en turno servicio
							/*echo "<pre>";
							print_r($model_turserv->getErrors());
							echo "</pre><br>";
							die();*/
						}
					}

					$builder=Yii::app()->db->schema->commandBuilder;
					$command=$builder->createMultipleInsertCommand('turnos_servicios', $turno_servicios);
					$command->execute();
				}

				/*echo "<pre>";
				print_r($novedades);
				die;*/

				for($m = 0; $m < $n; $m++)
				{
					for($p = 1; $p < $c; $p++)
					{
						if($novedades[$m]['turno'] == $nombre_turnos[$p])
						{
							$turno_novedad = array('turnov_tur_id' => $turnos_id[$p], 'turnov_nov_id' => $novedades[$m]['nov_id'], 'turnov_dia' => $novedades[$m]['nov_dia'], 'turnov_horaInicio' => $novedades[$m]['nov_horaInicio'], 'turnov_horaFin' => $novedades[$m]['nov_horaFin'], 'turnov_fecha' => $novedades[$m]['nov_fecha']);

							$model_turnov=new TurnosNovedades;
							$model_turnov->attributes = $turno_novedad;

							if($model_turnov->validate())
							{
								$turnos_novedades[$m] = $turno_novedad;
							}
							else
							{
								// Errores en turnos novedades
								echo "<pre>";
								print_r($model_turnov->getErrors());die;
							}
						}
					}
				}
				//echo "<pre>";
				//print_r($turnos_novedades);
				//die;

				if(!empty($turnos_novedades))
				{
					$builder=Yii::app()->db->schema->commandBuilder;
					$command=$builder->createMultipleInsertCommand('turnos_novedades', $turnos_novedades);
					$command->execute();
				}

		    	$this->render('_form2', array('error'=>$nov_errores, 'turnos'=>$contTurno, 'errores'=>$contErrores, 'turno'=>$mensaje_turnos), false, true);
				$band=1;
			}
			else
			{
				if(!empty($nov_errores))
				{
					$this->render('_form2', array('error'=>$nov_errores, 'turnos'=>$contTurno, 'errores'=>$contErrores, 'turno'=>$mensaje_turnos), false, true);
					$band=1;
				}
			}
		}

		if (Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('turnos', array('model'=>$model), false, true);
		}
		else{
			if($band!=1)
			{
				$this->render('turnos',array('model'=>$model, 'model_servicios'=>$model_servicios));
			}
		}
	}

	/**
	*Realizar lectura del archivo de carga masiva y enviar los datos al modelo de asesores.
	*/
	public function actionAsesores()
	{
		$model=new CargaMasiva;
		$model_servicios=new Servicios;

		$this->performAjaxValidation($model);
		$band=0;

		if(isset($_FILES['CargaMasiva']))
		{
			// Obtenemos el archivo y su ruta
			$ruta_archivo = $_FILES['CargaMasiva']['tmp_name'];
			$archivo = $ruta_archivo['tur_nombre_archivo']; 
			ini_set('max_execution_time', 300); //tiempo de ejecution del php para la carga del archivo, ya que en el php.ini esta definido en 30 segundos nada más. Acá le damos un tiempo de 5 minutos.

			$id_servicio = $_POST['Servicios']['serv_id'];

			// Cargamos el archivo 
			$lineas = file($archivo);

			// Capturar fecha y hora actual
			date_default_timezone_set('America/Bogota');
			$fecha = date('Y-m-d H:i:s');

			// Inicializamos variable a 0, esto nos ayudará a inidicarle que no lea la primera línea
			$i = 0;
			$j = 1;  
			$k = 1;
			$m = 0;
			$n=0;
			$p=0;
			$a=0;

			$band_asesor = 0;
			$error = '';
			$mensaje_act='';
			$mensaje_asesor='';

			$contAsesores = 0;
			$contAsesoresAct = 0;
			$contErrores = 0;

			$usuario =  Yii::app()->session['login_usuarioid']; // capturar el id del usuario logeado
			$registros = array(); // arreglo para guardar los registros del archivo de carga masiva
			$asesores = array();
			$asesores_id = array();
			$asesores_act = array(); // arreglo para guardar los registros del archivo de carga masiva que ya estan registrados en la aplicaciòn
			$asesores_servicios = array();
			$limite = 5; // limite definido para realizar insert de los datos del archivo de registros
			$errores = array(); // arreglo para almacenar los errores que pueda tener alguno de los datos de los archivos

			foreach ($lineas as $key => $linea) 
			{

				if(!empty($registros[$limite]['id']))
				{ // se envia el arreglo para hacer el multi insert
					while($j <= $limite)
					{
						$asesores[$j] = $registros[$j]['asesor'];
						$asesores_id[$j] = $asesores[$j]['ase_identificacion'];
						$j++;
					}
			
					$builder=Yii::app()->db->schema->commandBuilder;
					$command=$builder->createMultipleInsertCommand('asesores', $asesores);
					$command->execute();

					while($k < $j)
					{
						$id_asesores[$k] = $this->consultarIdAsesores($asesores_id[$k]);
						$k++;
					}

					if($id_servicio)
					{
						for($m = 1; $m < $k; $m++)
						{
							$asesor_servicio = array('aseserv_ase_id'=> $id_asesores[$m], 'aseserv_serv_id' => $id_servicio);

							$model_aseserv=new AsesoresServicios;
							$model_aseserv->attributes = $asesor_servicio;

							if($model_aseserv->validate())
							{
								$asesores_servicios[$m] = $asesor_servicio; 
								unset($asesor_servicio);
							}
							else
							{
								//echo "<pre>";
								//print_r($model_aseserv->getErrors());
								//echo "</pre>";
							}
						}
					}

					$builder=Yii::app()->db->schema->commandBuilder;
					$command=$builder->createMultipleInsertCommand('asesores_servicios', $asesores_servicios);
					$command->execute();

					if(!empty($registros_si))
					{
						$builder=Yii::app()->db->schema->commandBuilder;
						$command=$builder->createMultipleInsertCommand('asesores_servicios', $registros_si);
						$command->execute();
						//echo "bien";
						//die();
					}

					unset($registros);
					unset($asesores);
					unset($asesores_id);
					unset($asesores_servicios);
					unset($registros_si);
					$i=0;
					$j=1;
					$k=1;
					$p=0;
				}
				
				if($key > 0)
				{
					$linea_archivo = $key+1;
					$datos = explode(";", $linea);

					$datos[1] = utf8_encode($datos[1]);
					$datos[2] = utf8_encode($datos[2]);
				

					
					if(!empty($datos[0]))
					{
						if($datos[21] == 1)
						{
							$habilitado = 'Si';
						}
						else
						{
							if($datos[21] == 0)
							{
								$habilitado = 'No';
							}	
							else 
							{
								$habilitado = $datos[21];
							}
						}

						$cont_id = $this->consultarIdContrato($datos[20]);

						if($datos[0] == '')
						{
							$error .= "<div class='flash-error'>La identificación del asesor en la línea ".$linea_archivo." del archivo no puede ser vacía.</div><br>";
							$contErrores++;
							$band_asesor=1;
						}

						if($datos[1] == '')
						{
							$error .= "<div class='flash-error'>El nombre del asesor en la línea ".$linea_archivo." del archivo no puede ser vacía.</div><br>";
							$contErrores++;
							$band_asesor=1;
						}

						if($datos[2] == '')
						{
							$error .= "<div class='flash-error'>Los apellidos del asesor en la línea ".$linea_archivo." del archivo no puede ser vacía.</div><br>";
							$contErrores++;
							$band_asesor=1;
						}

						if($datos[3] == '')
						{
							$error .= "<div class='flash-error'>El usuario de red del asesor en la línea ".$linea_archivo." del archivo no puede ser vacía.</div><br>";
							$contErrores++;
							$band_asesor=1;
						}

						if((($datos[4] == '') || ($datos[4] == 'No')) && ($datos[5] == ''))
						{
							$error .= "<div class='flash-error'>La identificación del líder en la línea ".$linea_archivo." del archivo no puede ser vacía.</div><br>";
							$contErrores++;
							$band_asesor=1;
						}

						if($datos[6] == '')
						{
							$error .= "<div class='flash-error'>La hora inicio del día lunes en la línea ".$linea_archivo." del archivo no puede ser vacía.</div><br>";
							$contErrores++;
							$band_asesor=1;
						}

						if($datos[7] == '')
						{
							$error .= "<div class='flash-error'>La hora fin del día lunes en la línea ".$linea_archivo." del archivo no puede ser vacía.</div><br>";
							$contErrores++;
							$band_asesor=1;
						}

						if($datos[8] == '')
						{
							$error .= "<div class='flash-error'>La hora inicio del día martes en la línea ".$linea_archivo." del archivo no puede ser vacía.</div><br>";
							$contErrores++;
							$band_asesor=1;
						}

						if($datos[9] == '')
						{
							$error .= "<div class='flash-error'>La hora fin del día martes en la línea ".$linea_archivo." del archivo no puede ser vacía.</div><br>";
							$contErrores++;
							$band_asesor=1;
						}

						if($datos[10] == '')
						{
							$error .= "<div class='flash-error'>La hora inicio del día miércoles en la línea ".$linea_archivo." del archivo no puede ser vacía.</div><br>";
							$contErrores++;
							$band_asesor=1;
						}

						if($datos[11] == '')
						{
							$error .= "<div class='flash-error'>La hora fin del día miércoles en la línea ".$linea_archivo." del archivo no puede ser vacía.</div><br>";
							$contErrores++;
							$band_asesor=1;
						}

						if($datos[12] == '')
						{
							$error .= "<div class='flash-error'>La hora inicio del día jueves en la línea ".$linea_archivo." del archivo no puede ser vacía.</div><br>";
							$contErrores++;
							$band_asesor=1;
						}

						if($datos[13] == '')
						{
							$error .= "<div class='flash-error'>La hora fin del día jueves en la línea ".$linea_archivo." del archivo no puede ser vacía.</div><br>";
							$contErrores++;
							$band_asesor=1;
						}

						if($datos[14] == '')
						{
							$error .= "<div class='flash-error'>La hora inicio del día viernes en la línea ".$linea_archivo." del archivo no puede ser vacía.</div><br>";
							$contErrores++;
							$band_asesor=1;
						}

						if($datos[15] == '')
						{
							$error .= "<div class='flash-error'>La hora fin del día viernes en la línea ".$linea_archivo." del archivo no puede ser vacía.</div><br>";
							$contErrores++;
							$band_asesor=1;
						}

						if($datos[16] == '')
						{
							$error .= "<div class='flash-error'>La hora inicio del día sábado en la línea ".$linea_archivo." del archivo no puede ser vacía.</div><br>";
							$contErrores++;
							$band_asesor=1;
						}

						if($datos[17] == '')
						{
							$error .= "<div class='flash-error'>La hora fin del día sábado en la línea ".$linea_archivo." del archivo no puede ser vacía.</div><br>";
							$contErrores++;
							$band_asesor=1;
						}

						if($datos[18] == '')
						{
							$error .= "<div class='flash-error'>La hora inicio del día domingo en la línea ".$linea_archivo." del archivo no puede ser vacía.</div><br>";
							$contErrores++;
							$band_asesor=1;
						}

						if($datos[19] == '')
						{
							$error .= "<div class='flash-error'>La hora fin del día domingo en la línea ".$linea_archivo." del archivo no puede ser vacía.</div><br>";
							$contErrores++;
							$band_asesor=1;
						}

						if($cont_id == '')
						{
							$error .= "<div class='flash-error'>El contrato en la línea ".$linea_archivo." del archivo no existe o no puede estar vacío.</div><br>";
							$contErrores++;
							$band_asesor=1;
						}

						$dato = array('ase_identificacion' => $datos[0], 'ase_nombre' => $datos[1], 'ase_apellidos' => $datos[2], 'ase_usuariored' => $datos[3], 'ase_lider' => $datos[4], 'ase_identificacion_lider' => $datos[5], 'ase_horaInicioLunes' => $datos[6], 'ase_horaFinLunes' => $datos[7], 'ase_horaInicioMartes' => $datos[8], 'ase_horaFinMartes' => $datos[9], 'ase_horaInicioMiercoles' => $datos[10], 'ase_horaFinMiercoles' => $datos[11], 'ase_horaInicioJueves' => $datos[12], 'ase_horaFinJueves' => $datos[13], 'ase_horaInicioViernes' => $datos[14], 'ase_horaFinViernes' => $datos[15], 'ase_horaInicioSabado' => $datos[16], 'ase_horaFinSabado' => $datos[17], 'ase_horaInicioDomingo' => $datos[18], 'ase_horaFinDomingo' => $datos[19], 'ase_cont_id' => $cont_id, 'ase_habilitado' => $habilitado, 'ase_creadopor' => $usuario, 'ase_fechacreado' => $fecha, 'ase_modificadopor' => $usuario, 'ase_fechamodificado' => $fecha);
						
						$asesor = $this->consultarIdAsesores($datos[0]);

						if(($asesor != '') && ($band_asesor == 0))
						{
							$dato['ase_nombre'] = utf8_encode($dato['ase_nombre']);
							$dato['ase_apellidos'] = utf8_encode($dato['ase_apellidos']);

							$model_actualizar=Asesores::model()->findByPk($asesor);
							$model_actualizar->attributes = $dato;
							$model_actualizar->save();

							$mensaje_act.="<div class='flash-success'>El asesor " .$dato['ase_nombre']. " " .$dato['ase_apellidos']." ha sido actualizado correctamente.</div><br>";

							if($dato['ase_lider']=='No')
							{
								$band_aseserv = $this->actualizarAsesorServicio($asesor, $id_servicio);
								if($band_aseserv == '')
								{
									$asesor_servicio = array('aseserv_ase_id'=> $asesor, 'aseserv_serv_id' => $id_servicio);
									$registros_si[$p] = $asesor_servicio;
									//$registros_si[$p]['aseserv_ase_id'] = $asesor;
									//$registros_si[$p]['aseserv_serv_id'] = $id_servicio;
									$p++;
									unset($asesor_servicio);
								}
								else
								{
									$band_asesor=1;
								}
							} 
							else 
							{
								if($dato['ase_lider']=='Si')
								{
									$band_lider = $this->validarServiciosLider($asesor, $id_servicio);
									if($band_lider=='')
									{
										$asesor_servicio = array('aseserv_ase_id'=> $asesor, 'aseserv_serv_id' => $id_servicio);
										$registros_si[$p] = $asesor_servicio;
										//$registros_si[$p]['aseserv_ase_id'] = $asesor;
										//$registros_si[$p]['aseserv_serv_id'] = $id_servicio;
										$p++;
										unset($asesor_servicio);
									}	
								}
							}

							$contAsesoresAct++;
							unset($asesor);
						}

						if($band_asesor==0)
						{
							$model_asesores=new Asesores;
							$model_asesores->attributes = $dato;

							if($model_asesores->validate())
							{
								$i++;
								$registros[$i]['id'] = $i;
								$registros[$i]['asesor'] = $dato;
								$mensaje_asesor.="<div class='flash-success'>El asesor " .$dato['ase_nombre']. " " .$dato['ase_apellidos']." ha sido creado correctamente.</div><br>";
								$contAsesores++;
								unset($dato);
							}
							else
							{
								//echo "<pre>";
								//print_r($model_asesores->getErrors());
								//echo "</pre><br>";
							}
						}
						else 
						{
							if($band_asesor==1)
							{
								$band_asesor=0;
							}
						}
					}
					else
					{
						$error .= "<div class='flash-error'>La identificación del asesor en la línea ".$linea_archivo." del archivo no puede ser vacía.</div><br>";
						$contErrores++;
					}
				}
			}
			
			
			$j=1;
			$k=1;
			if(!empty($registros_si))
			{
				$builder=Yii::app()->db->schema->commandBuilder;
				$command=$builder->createMultipleInsertCommand('asesores_servicios', $registros_si);
				$command->execute();
				//echo "bien";
				//die();
			}

			if(!empty($registros))
			{					
				while($j <= $i)
				{
					$asesores[$j] = $registros[$j]['asesor'];
					$asesores_id[$j] = $asesores[$j]['ase_identificacion'];
					$j++;
				}

				$builder=Yii::app()->db->schema->commandBuilder;
				$command=$builder->createMultipleInsertCommand('asesores', $asesores);
				$command->execute();

				while($k < $j)
				{
					$id_asesores[$k] = $this->consultarIdAsesores($asesores_id[$k]);
					$k++;
				}

				if($id_servicio)
				{
					for($m = 1; $m < $k; $m++)
					{
						$asesor_servicio = array('aseserv_ase_id'=> $id_asesores[$m], 'aseserv_serv_id' => $id_servicio);

						$model_aseserv=new AsesoresServicios;
						$model_aseserv->attributes = $asesor_servicio;

						if($model_aseserv->validate())
						{
							$asesores_servicios[$m] = $asesor_servicio;
							unset($asesor_servicio);
						}
						else
						{
							//echo "<pre>";
							//print_r($model_aseserv->getErrors());
							//echo "</pre>";
						}
					}
				}

				$builder=Yii::app()->db->schema->commandBuilder;
				$command=$builder->createMultipleInsertCommand('asesores_servicios', $asesores_servicios);
				$command->execute();

				unset($registros);
				$i=0;

				$this->render('_form3', array('error'=>$error, 'asesores'=>$contAsesores, 'errores'=>$contErrores, 'asesores_act'=>$contAsesoresAct, 'mensaje_asesor'=>$mensaje_asesor, 'mensaje_act'=>$mensaje_act), false, true);
				$band=1;
			}
			else
			{
				$this->render('_form3', array('error'=>$error, 'asesores'=>$contAsesores, 'errores'=>$contErrores, 'asesores_act'=>$contAsesoresAct, 'mensaje_asesor'=>$mensaje_asesor, 'mensaje_act'=>$mensaje_act), false, true);
				$band=1;
			}
		}

		if (Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('asesores',array('model'=>$model), false, true);
		}
		else{
			if($band!=1)
			{
				$this->render('asesores',array('model'=>$model, 'model_servicios'=>$model_servicios));
			}	
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

	public function validarTurnoServicio($turno, $serv_id)
	{
		$criteria=new CDbCriteria;
		$criteria->select = "*";
		$criteria->condition = "serv_id = '$serv_id' and serv_habilitado='Si'";
		$servicio = Servicios::model()->find($criteria);

		$cont = 0;

		$inicioLunes = $this->hourDifference($servicio->serv_horaInicioLunes, $turno['tur_horaInicioLunes']);
		$finLunes = $this->hourDifference($turno['tur_horaFinLunes'], $servicio->serv_horaFinLunes);
		$inicioMartes = $this->hourDifference($servicio->serv_horaInicioMartes, $turno['tur_horaInicioMartes']);
		$finMartes = $this->hourDifference($turno['tur_horaFinMartes'], $servicio->serv_horaFinMartes);
		$inicioMiercoles = $this->hourDifference($servicio->serv_horaInicioMiercoles, $turno['tur_horaInicioMiercoles']);
		$finMiercoles = $this->hourDifference($turno['tur_horaFinMiercoles'], $servicio->serv_horaFinMiercoles);
		$inicioJueves = $this->hourDifference($servicio->serv_horaInicioJueves, $turno['tur_horaInicioJueves']);
		$finJueves = $this->hourDifference($turno['tur_horaFinJueves'], $servicio->serv_horaFinJueves);
		$inicioViernes = $this->hourDifference($servicio->serv_horaInicioViernes, $turno['tur_horaInicioViernes']);
		$finViernes = $this->hourDifference($turno['tur_horaFinViernes'], $servicio->serv_horaFinViernes);
		$inicioSabado = $this->hourDifference($servicio->serv_horaInicioSabado, $turno['tur_horaInicioSabado']);
		$finSabado = $this->hourDifference($turno['tur_horaFinSabado'], $servicio->serv_horaFinSabado);
		$inicioDomingo = $this->hourDifference($servicio->serv_horaInicioDomingo, $turno['tur_horaInicioDomingo']);
		$finDomingo = $this->hourDifference($turno['tur_horaFinDomingo'], $servicio->serv_horaFinDomingo);

		if(($inicioLunes == 1) || ($finLunes == 1) || ($inicioMartes == 1) || ($finMartes == 1) || ($inicioMiercoles == 1) || ($finMiercoles == 1) || ($inicioJueves == 1) || ($finJueves == 1) || ($inicioViernes == 1) || ($finViernes == 1) || ($inicioSabado == 1) || ($finSabado == 1) || ($inicioDomingo == 1) || ($finDomingo))
			$cont++;

		if($cont > 0)
			return 1;
		else
			return 0;
	}

	public function validarServiciosLider($ase_id, $serv_id)
	{
		$criteria=new CDbCriteria;
		$criteria->select = "*";
		$criteria->condition = "aseserv_ase_id='$ase_id' AND aseserv_serv_id = '$serv_id'";

		$servicios=AsesoresServicios::model()->find($criteria);

		if($servicios)
		{
			return $servicios->aseserv_id;
		}
		else
		{
			return false;
		}
	}

	public function actualizarAsesorServicio($id_asesor, $id_servicio)
	{
		$criteria=new CDbCriteria;
		$criteria->select = "aseserv_id";
		$criteria->condition = "aseserv_ase_id = '$id_asesor'";
		$aseserv = AsesoresServicios::model()->find($criteria);

		$datos_aseserv = array('aseserv_ase_id'=>$id_asesor, 'aseserv_serv_id'=>$id_servicio);

		if($aseserv)
		{
			$model_aseserv_act=AsesoresServicios::model()->findByPk($aseserv->aseserv_id);
			$model_aseserv_act->attributes = $datos_aseserv;
			$model_aseserv_act->save();

			return $aseserv->aseserv_id;
		}
		else
		{
			return false;
		}
	}

	public function dateDifference($date_1, $date_2)
	{
	    $datetime1 = date_create($date_1);
	    $datetime2 = date_create($date_2);
	    
	    $interval = date_diff($datetime1, $datetime2);
	    
	    return $interval->format('%H:%i:%s');    
	}

	public function hourDifference($date_1, $date_2)
	{
	    $datetime1 = date_create($date_1);
	    $datetime2 = date_create($date_2);
	    
	    $interval = date_diff($datetime1, $datetime2);
	    
	    if ($interval->invert)
	    {
	    	return 1;
	    }
	    else
	    {
	    	return 0;   
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

	public function validarNombreTurno($nombre_turno)
	{
		$criteria=new CDbCriteria;
		$criteria->select = "tur_id";
		$criteria->condition = "tur_nombre = '$nombre_turno' AND tur_habilitado='Si'";
		$turno_id = Turnos::model()->find($criteria);

		if($turno_id)
		{
			return $turno_id->tur_id;
		}
		else
		{
			return false;
		}
		
	}

	public function consultarIdAsesores($id_asesor)
	{
		$criteria=new CDbCriteria;
		$criteria->select = "ase_id";
		$criteria->condition = "ase_identificacion = '$id_asesor' AND ase_habilitado='Si'";
		$ase_id = Asesores::model()->find($criteria);

		if($ase_id)
		{
			return $ase_id->ase_id;
		}
		else
		{
			return false;
		}
	}

	public function consultarIdContrato($cont_horas)
	{
		$criteria=new CDbCriteria;
		$criteria->select = "cont_id";
		$criteria->condition = "cont_total_horas_semana = '$cont_horas' AND cont_habilitado='Si'";
		$cont_id = Contratos::model()->find($criteria);

		if($cont_id)
		{
			return $cont_id->cont_id;
		}
		else
		{
			return false;
		}
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
