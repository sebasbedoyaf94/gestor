<?php

/**
 * This is the model class for table "turnos".
 *
 * The followings are the available columns in table 'turnos':
 * @property integer $tur_id
 * @property string $tur_nombre
 * @property string $tur_horaInicioLunes
 * @property string $tur_horaFinLunes
 * @property string $tur_horaInicioMartes
 * @property string $tur_horaFinMartes
 * @property string $tur_horaInicioMiercoles
 * @property string $tur_horaFinMiercoles
 * @property string $tur_horaInicioJueves
 * @property string $tur_horaFinJueves
 * @property string $tur_horaInicioViernes
 * @property string $tur_horaFinViernes
 * @property string $tur_horaInicioSabado
 * @property string $tur_horaFinSabado
 * @property string $tur_horaInicioDomingo
 * @property string $tur_horaFinDomingo
 * @property string $tur_habilitado
 * @property string $tur_fechacreado
 * @property integer $tur_creadopor
 * @property string $tur_fechamodificado
 * @property integer $tur_modificadopor
 *
 * The followings are the available model relations:
 * @property Usuarios $turCreadopor
 * @property Usuarios $turModificadopor
 * @property TurnosAsesores[] $turnosAsesores
 * @property TurnosNovedades[] $turnosNovedades
 */
class Turnos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'turnos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tur_nombre, tur_creadopor, tur_modificadopor', 'required'),
			array('tur_creadopor, tur_modificadopor', 'numerical', 'integerOnly'=>true),
			array('tur_nombre', 'length', 'max'=>50),
			array('tur_habilitado', 'length', 'max'=>2),
			array('tur_horaInicioLunes, tur_horaFinLunes, tur_horaInicioMartes, tur_horaFinMartes, tur_horaInicioMiercoles, tur_horaFinMiercoles, tur_horaInicioJueves, tur_horaFinJueves, tur_horaInicioViernes, tur_horaFinViernes, tur_horaInicioSabado, tur_horaFinSabado, tur_horaInicioDomingo, tur_horaFinDomingo, tur_fechacreado, tur_fechamodificado', 'safe'),
			array('tur_id, tur_horaInicioLunes, tur_horaFinLunes, tur_horaInicioMartes, tur_horaFinMartes, tur_horaInicioMiercoles, tur_horaFinMiercoles, tur_horaInicioJueves, tur_horaFinJueves, tur_horaInicioViernes, tur_horaFinViernes, tur_horaInicioSabado, tur_horaFinSabado, tur_horaInicioDomingo, tur_horaFinDomingo', 'validarTurnoServicio','on'=>'update'),
			array('tur_nombre', 'unique'),
			//array('tur_nombre_archivo', 'validarArchivo'),
			// array('tur_horaInicioLunes, tur_horaFinLunes, tur_horaInicioMartes, tur_horaFinMartes, tur_horaInicioMiercoles, tur_horaFinMiercoles, tur_horaInicioJueves, tur_horaFinJueves, tur_horaInicioViernes, tur_horaFinViernes, tur_horaInicioSabado, tur_horaFinSabado, tur_horaInicioDomingo, tur_horaFinDomingo', 'validarHoras'),


			array('tur_horaInicioLunes, tur_horaFinLunes, tur_horaInicioMartes, tur_horaFinMartes, tur_horaInicioMiercoles, tur_horaFinMiercoles, tur_horaInicioJueves, tur_horaFinJueves, tur_horaInicioViernes, tur_horaFinViernes, tur_horaInicioSabado, tur_horaFinSabado, tur_horaInicioDomingo, tur_horaFinDomingo', 'validarHoras'),


			array('tur_horaInicioLunes, tur_horaFinLunes, tur_horaInicioMartes, tur_horaFinMartes, tur_horaInicioMiercoles, tur_horaFinMiercoles, tur_horaInicioJueves, tur_horaFinJueves, tur_horaInicioViernes, tur_horaFinViernes, tur_horaInicioSabado, tur_horaFinSabado, tur_horaInicioDomingo, tur_horaFinDomingo', 'validarCantidadHoras','on'=>'insert, update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('tur_id, tur_nombre, tur_horaInicioLunes, tur_horaFinLunes, tur_horaInicioMartes, tur_horaFinMartes, tur_horaInicioMiercoles, tur_horaFinMiercoles, tur_horaInicioJueves, tur_horaFinJueves, tur_horaInicioViernes, tur_horaFinViernes, tur_horaInicioSabado, tur_horaFinSabado, tur_horaInicioDomingo, tur_horaFinDomingo, tur_habilitado, tur_fechacreado, tur_creadopor, tur_fechamodificado, tur_modificadopor', 'safe', 'on'=>'search'),
		);
	}

	function validarCantidadHoras($attribute, $params)
	{
		$minHorasDia = 4;
		$maxHorasDia = 10;
		$nombreTurno = $this->tur_nombre;

		$totalHorasLunes = $this->tur_horaFinLunes - $this->tur_horaInicioLunes;
		$totalHorasMartes = $this->tur_horaFinMartes - $this->tur_horaInicioMartes;
		$totalHorasMiercoles = $this->tur_horaFinMiercoles - $this->tur_horaInicioMiercoles;
		$totalHorasJueves = $this->tur_horaFinJueves - $this->tur_horaInicioJueves;
		$totalHorasViernes = $this->tur_horaFinViernes - $this->tur_horaInicioViernes;
		$totalHorasSabado = $this->tur_horaFinSabado - $this->tur_horaInicioSabado;
		$totalHorasDomingo = $this->tur_horaFinDomingo - $this->tur_horaInicioDomingo;

		//VALIDACION DIA LUNES
		if ($totalHorasLunes !=0 and ($totalHorasLunes < $minHorasDia ||  $totalHorasLunes > $maxHorasDia) and $attribute=='tur_horaInicioLunes') //regla del negocio
		{
		   	$mensaje = "La jornada del dia Lunes del turno ".$nombreTurno." no puede ser superior a <b>".$maxHorasDia." horas</b> ni inferior a <b>".$minHorasDia." horas</b>.";
			$this->addError('tur_horaInicioLunes',$mensaje);
		}


		//VALIDACION DIA MARTES
		if ($totalHorasMartes !=0 and ($totalHorasMartes < $minHorasDia ||  $totalHorasMartes > $maxHorasDia) and $attribute=='tur_horaInicioMartes') //regla del negocio
		{
		   	$mensaje = "La jornada del dia Martes del turno ".$nombreTurno." no puede ser superior a <b>".$maxHorasDia." horas</b> ni inferior a <b>".$minHorasDia." horas</b>.";
			$this->addError('tur_horaInicioMartes',$mensaje);
		}

		//VALIDACION DIA MIERCOLES
		if ($totalHorasMiercoles !=0 and ($totalHorasMiercoles < $minHorasDia ||  $totalHorasMiercoles > $maxHorasDia) and $attribute=='tur_horaInicioMiercoles') //regla del negocio
		{
		   	$mensaje = "La jornada del dia Miercoles del turno ".$nombreTurno." no puede ser superior a <b>".$maxHorasDia." horas</b> ni inferior a <b>".$minHorasDia." horas</b>.";
			$this->addError('tur_horaInicioMiercoles',$mensaje);
		}

		//VALIDACION DIA JUEVES
		if ($totalHorasJueves !=0 and ($totalHorasJueves < $minHorasDia ||  $totalHorasJueves > $maxHorasDia) and $attribute=='tur_horaInicioJueves') //regla del negocio
		{
		   	$mensaje = "La jornada del dia Jueves del turno ".$nombreTurno." no puede ser superior a <b>".$maxHorasDia." horas</b> ni inferior a <b>".$minHorasDia." horas</b>.";
			$this->addError('tur_horaInicioJueves',$mensaje);
		}

		//VALIDACION DIA VIERNES
		if ($totalHorasViernes !=0 and ($totalHorasViernes < $minHorasDia ||  $totalHorasViernes > $maxHorasDia) and $attribute=='tur_horaInicioViernes') //regla del negocio
		{
		   	$mensaje = "La jornada del dia Viernes del turno ".$nombreTurno." no puede ser superior a <b>".$maxHorasDia." horas</b> ni inferior a <b>".$minHorasDia." horas</b>.";
			$this->addError('tur_horaInicioViernes',$mensaje);
		}

		//VALIDACION DIA SABADO
		if ($totalHorasSabado !=0 and ($totalHorasSabado < $minHorasDia ||  $totalHorasSabado > $maxHorasDia) and $attribute=='tur_horaInicioSabado') //regla del negocio
		{
		   	$mensaje = "La jornada del dia Sabado del turno ".$nombreTurno." no puede ser superior a <b>".$maxHorasDia." horas</b> ni inferior a <b>".$minHorasDia." horas</b>.";
			$this->addError('tur_horaInicioSabado',$mensaje);
		}

		//VALIDACION DIA DOMINGO
		if ($totalHorasDomingo !=0 and ($totalHorasDomingo < $minHorasDia ||  $totalHorasDomingo > $maxHorasDia) and $attribute=='tur_horaInicioDomingo') //regla del negocio
		{
		   	$mensaje = "La jornada del dia Domingo del turno ".$nombreTurno." no puede ser superior a <b>".$maxHorasDia." horas</b> ni inferior a <b>".$minHorasDia." horas</b>.";
			$this->addError('tur_horaInicioDomingo',$mensaje);
		}

	}

	function validarArchivo($attribute, $param)
	{
		$nombre_archivo = $this->tur_nombre_archivo;
		$ext = explode(".", $nombre_archivo);

		echo $ext;die();
	}

	function validarHoras($attribute, $param)
	{
		 
		$inicioLunes = $this->tur_horaInicioLunes;
		$finLunes = $this->tur_horaFinLunes;
		$inicioMartes = $this->tur_horaInicioMartes;
		$finMartes = $this->tur_horaFinMartes;
		$inicioMiercoles = $this->tur_horaInicioMiercoles;
		$finMiercoles = $this->tur_horaFinMiercoles;
		$inicioJueves = $this->tur_horaInicioJueves;
		$finJueves = $this->tur_horaFinJueves;
		$inicioViernes = $this->tur_horaInicioViernes;
		$finViernes = $this->tur_horaFinViernes;
		$inicioSabado = $this->tur_horaInicioSabado;
		$finSabado = $this->tur_horaFinSabado;
		$inicioDomingo = $this->tur_horaInicioDomingo;
		$finDomingo = $this->tur_horaFinDomingo;

		$horaInicioLunes = strtotime(sprintf('%s %s:00',date('Y-m-d'),$inicioLunes));
		$horaFinLunes = strtotime(sprintf('%s %s:00',date('Y-m-d'),$finLunes));
		$horaInicioMartes = strtotime(sprintf('%s %s:00',date('Y-m-d'),$inicioMartes));
		$horaFinMartes = strtotime(sprintf('%s %s:00',date('Y-m-d'),$finMartes));
		$horaInicioMiercoles = strtotime(sprintf('%s %s:00',date('Y-m-d'),$inicioMiercoles));
		$horaFinMiercoles = strtotime(sprintf('%s %s:00',date('Y-m-d'),$finMiercoles));
		$horaInicioJueves = strtotime(sprintf('%s %s:00',date('Y-m-d'),$inicioJueves));
		$horaFinJueves = strtotime(sprintf('%s %s:00',date('Y-m-d'),$finJueves));
		$horaInicioViernes = strtotime(sprintf('%s %s:00',date('Y-m-d'),$inicioViernes));
		$horaFinViernes = strtotime(sprintf('%s %s:00',date('Y-m-d'),$finViernes));
		$horaInicioSabado = strtotime(sprintf('%s %s:00',date('Y-m-d'),$inicioSabado));
		$horaFinSabado = strtotime(sprintf('%s %s:00',date('Y-m-d'),$finSabado));
		$horaInicioDomingo = strtotime(sprintf('%s %s:00',date('Y-m-d'),$inicioDomingo));
		$horaFinDomingo = strtotime(sprintf('%s %s:00',date('Y-m-d'),$finDomingo));
		
		if($horaInicioLunes > $horaFinLunes and $attribute=='tur_horaInicioLunes')
		{ // Validacion para el día lunes
			$mensaje = "La hora inicio del día lunes no puede ser superior a la hora fin.";
			$campo = "tur_horaInicioLunes";
			$this->addError('tur_horaInicioLunes',$mensaje);

		}
		else 
		{
			if($horaInicioMartes > $horaFinMartes and $attribute=='tur_horaInicioMartes')
			{ // Validación para el día martes
				$mensaje = "La hora inicio del día martes no puede ser superior a la hora fin.";
				$this->addError('tur_horaInicioMartes',$mensaje);
			}
			else
			{
				if($horaInicioMiercoles > $horaFinMiercoles and $attribute=='tur_horaInicioMiercoles')
				{ // Validación para el día miércoles
					$mensaje = "La hora inicio del día miercoles no puede ser superior a la hora fin.";
					$this->addError('tur_horaInicioMiercoles',$mensaje);
				}
				else
				{
					if($horaInicioJueves > $horaFinJueves and $attribute=='tur_horaInicioJueves')
					{ // Vdlidación para el día jueves
						$mensaje = "La hora inicio del día jueves no puede ser superior a la hora fin.";
						$this->addError('tur_horaInicioJueves',$mensaje);
					}
					else
					{
						if($horaInicioViernes > $horaFinViernes and $attribute=='tur_horaInicioViernes')
						{ // Validación para el día viernes
							$mensaje = "La hora inicio del día viernes no puede ser superior a la hora fin.";
							$this->addError('tur_horaInicioViernes',$mensaje);
						}
						else
						{
							if($horaInicioSabado > $horaFinSabado and $attribute=='tur_horaInicioSabado')
							{ // Validación para el día sábado
								$mensaje = "La hora inicio del día sabado no puede ser superior a la hora fin.";
								$this->addError('tur_horaInicioSabado',$mensaje);
							}
							else
							{
								if($horaInicioDomingo > $horaFinDomingo and $attribute=='tur_horaInicioDomingo')
								{ // Validación para el día domingo
									$mensaje = "La hora inicio del día domingo no puede ser superior a la hora fin.";
									$this->addError('tur_horaInicioDomingo',$mensaje);
								}
							}
						}
					}
				}
			}
		}
	}

	function validarTurnoServicio($attribute, $param)
	{
		$tur_id = $this->tur_id;
		$inicioLunes = $this->tur_horaInicioLunes;
		$finLunes = $this->tur_horaFinLunes;
		$inicioMartes = $this->tur_horaInicioMartes;
		$finMartes = $this->tur_horaFinMartes;
		$inicioMiercoles = $this->tur_horaInicioMiercoles;
		$finMiercoles = $this->tur_horaFinMiercoles;
		$inicioJueves = $this->tur_horaInicioJueves;
		$finJueves = $this->tur_horaFinJueves;
		$inicioViernes = $this->tur_horaInicioViernes;
		$finViernes = $this->tur_horaFinViernes;
		$inicioSabado = $this->tur_horaInicioSabado;
		$finSabado = $this->tur_horaFinSabado;
		$inicioDomingo = $this->tur_horaInicioDomingo;
		$finDomingo = $this->tur_horaFinDomingo;

		$tur_horaInicioLunes = strtotime(sprintf('%s %s:00',date('Y-m-d'),$inicioLunes));
		$tur_horaFinLunes = strtotime(sprintf('%s %s:00',date('Y-m-d'),$finLunes));
		$tur_horaInicioMartes = strtotime(sprintf('%s %s:00',date('Y-m-d'),$inicioMartes));
		$tur_horaFinMartes = strtotime(sprintf('%s %s:00',date('Y-m-d'),$finMartes));
		$tur_horaInicioMiercoles = strtotime(sprintf('%s %s:00',date('Y-m-d'),$inicioMiercoles));
		$tur_horaFinMiercoles = strtotime(sprintf('%s %s:00',date('Y-m-d'),$finMiercoles));
		$tur_horaInicioJueves = strtotime(sprintf('%s %s:00',date('Y-m-d'),$inicioJueves));
		$tur_horaFinJueves = strtotime(sprintf('%s %s:00',date('Y-m-d'),$finJueves));
		$tur_horaInicioViernes = strtotime(sprintf('%s %s:00',date('Y-m-d'),$inicioViernes));
		$tur_horaFinViernes = strtotime(sprintf('%s %s:00',date('Y-m-d'),$finViernes));
		$tur_horaInicioSabado = strtotime(sprintf('%s %s:00',date('Y-m-d'),$inicioSabado));
		$tur_horaFinSabado = strtotime(sprintf('%s %s:00',date('Y-m-d'),$finSabado));
		$tur_horaInicioDomingo = strtotime(sprintf('%s %s:00',date('Y-m-d'),$inicioDomingo));
		$tur_horaFinDomingo = strtotime(sprintf('%s %s:00',date('Y-m-d'),$finDomingo));

		$criteria=new CDbCriteria;
		$criteria->select = "*";
		$criteria->condition = "turserv_tur_id='$tur_id'";

		$turserv = TurnosServicios::model()->find($criteria);

		if($turserv)
		{
			$serv=Servicios::model()->findByPk($turserv->turserv_serv_id);

			$serv_horaInicioLunes = strtotime(sprintf('%s %s',date('Y-m-d'),$serv->serv_horaInicioLunes));
			$serv_horaFinLunes = strtotime(sprintf('%s %s',date('Y-m-d'),$serv->serv_horaFinLunes));
			$serv_horaInicioMartes = strtotime(sprintf('%s %s',date('Y-m-d'),$serv->serv_horaInicioMartes));
			$serv_horaFinMartes = strtotime(sprintf('%s %s',date('Y-m-d'),$serv->serv_horaFinMartes));
			$serv_horaInicioMiercoles = strtotime(sprintf('%s %s',date('Y-m-d'),$serv->serv_horaInicioMiercoles));
			$serv_horaFinMiercoles = strtotime(sprintf('%s %s',date('Y-m-d'),$serv->serv_horaFinMiercoles));
			$serv_horaInicioJueves = strtotime(sprintf('%s %s',date('Y-m-d'),$serv->serv_horaInicioJueves));
			$serv_horaFinJueves = strtotime(sprintf('%s %s',date('Y-m-d'),$serv->serv_horaFinJueves));
			$serv_horaInicioViernes = strtotime(sprintf('%s %s',date('Y-m-d'),$serv->serv_horaInicioViernes));
			$serv_horaFinViernes = strtotime(sprintf('%s %s',date('Y-m-d'),$serv->serv_horaFinViernes));
			$serv_horaInicioSabado = strtotime(sprintf('%s %s',date('Y-m-d'),$serv->serv_horaInicioSabado));
			$serv_horaFinSabado = strtotime(sprintf('%s %s',date('Y-m-d'),$serv->serv_horaFinSabado));
			$serv_horaInicioDomingo = strtotime(sprintf('%s %s',date('Y-m-d'),$serv->serv_horaInicioDomingo));
			$serv_horaFinDomingo = strtotime(sprintf('%s %s',date('Y-m-d'),$serv->serv_horaFinDomingo));

			// VALIDACION LUNES
			if(($tur_horaInicioLunes < $serv_horaInicioLunes) || ($tur_horaFinLunes > $serv_horaFinLunes) and ($attribute=='tur_horaInicioLunes'))
			{
				$mensaje = "<b>El turno esta asignado a un servicio y el horario del día lunes a actualizar no se encuentra en el rango del horario definido para el servicio, por favor modificar el horario del servicio para poder realizar esta actualización.</b>";
				$this->addError('tur_horaInicioLunes',$mensaje);
			}
			// VALIDACION MARTES
			if(($tur_horaInicioMartes < $serv_horaInicioMartes) || ($tur_horaFinMartes > $serv_horaFinMartes) and ($attribute=='tur_horaInicioMartes'))
			{
				$mensaje = "<b>El turno esta asignado a un servicio y el horario del día martes a actualizar no se encuentra en el rango del horario definido para el servicio, por favor modificar el horario del servicio para poder realizar esta actualización.</b>";
				$this->addError('tur_horaInicioMartes',$mensaje);
			}
			// VALIDACION MIERCOLES
			if(($tur_horaInicioMiercoles < $serv_horaInicioMiercoles) || ($tur_horaFinMiercoles > $serv_horaFinMiercoles) and ($attribute=='tur_horaInicioMiercoles'))
			{
				$mensaje = "<b>El turno esta asignado a un servicio y el horario del día miércoles a actualizar no se encuentra en el rango del horario definido para el servicio, por favor modificar el horario del servicio para poder realizar esta actualización.</b>";
				$this->addError('tur_horaInicioMiercoles',$mensaje);
			}
			// VALIDACION JUEVES
			if(($tur_horaInicioJueves < $serv_horaInicioJueves) || ($tur_horaFinJueves > $serv_horaFinJueves) and ($attribute=='tur_horaInicioJueves'))
			{
				$mensaje = "<b>El turno esta asignado a un servicio y el horario del día jueves a actualizar no se encuentra en el rango del horario definido para el servicio, por favor modificar el horario del servicio para poder realizar esta actualización.</b>";
				$this->addError('tur_horaInicioJueves',$mensaje);
			}
			// VALIDACION VIERNES
			if(($tur_horaInicioViernes < $serv_horaInicioViernes) || ($tur_horaFinViernes > $serv_horaFinViernes) and ($attribute=='tur_horaInicioViernes'))
			{
				$mensaje = "<b>El turno esta asignado a un servicio y el horario del día viernes a actualizar no se encuentra en el rango del horario definido para el servicio, por favor modificar el horario del servicio para poder realizar esta actualización.</b>";
				$this->addError('tur_horaInicioViernes',$mensaje);
			}
			// VALIDACION SABADO
			if(($tur_horaInicioSabado < $serv_horaInicioSabado) || ($tur_horaFinSabado > $serv_horaFinSabado) and ($attribute=='tur_horaInicioSabado'))
			{
				$mensaje = "<b>El turno esta asignado a un servicio y el horario del día sabado a actualizar no se encuentra en el rango del horario definido para el servicio, por favor modificar el horario del servicio para poder realizar esta actualización.</b>";
				$this->addError('tur_horaInicioSabado',$mensaje);
			}
			// VALIDACION DOMINGO
			if(($tur_horaInicioDomingo < $serv_horaInicioDomingo) || ($tur_horaFinDomingo > $serv_horaFinDomingo) and ($attribute=='tur_horaInicioDomingo'))
			{
				$mensaje = "<b>El turno esta asignado a un servicio y el horario del día domingo a actualizar no se encuentra en el rango del horario definido para el servicio, por favor modificar el horario del servicio para poder realizar esta actualización.</b>";
				$this->addError('tur_horaInicioDomingo',$mensaje);
			}
		}
		
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'turCreadopor' => array(self::BELONGS_TO, 'Usuarios', 'tur_creadopor'),
			'turModificadopor' => array(self::BELONGS_TO, 'Usuarios', 'tur_modificadopor'),
			'turnosAsesores' => array(self::HAS_MANY, 'TurnosAsesores', 'turase_tur_id'),
			'turnosNovedades' => array(self::BELONGS_TO, 'TurnosNovedades', 'tur_id'),
			'turnosServicios' => array(self::BELONGS_TO, 'TurnosServicios', 'tur_id'),
			'turnosAsesores' => array(self::BELONGS_TO, 'TurnosAsesores', 'turase_tur_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'tur_id' => 'Tur',
			'tur_nombre' => 'Nombre',
			'tur_horaInicioLunes' => 'Hora Inicio Lunes',
			'tur_horaFinLunes' => 'Hora Fin Lunes',
			'tur_horaInicioMartes' => 'Hora Inicio Martes',
			'tur_horaFinMartes' => 'Hora Fin Martes',
			'tur_horaInicioMiercoles' => 'Hora Inicio Miercoles',
			'tur_horaFinMiercoles' => 'Hora Fin Miercoles',
			'tur_horaInicioJueves' => 'Hora Inicio Jueves',
			'tur_horaFinJueves' => 'Hora Fin Jueves',
			'tur_horaInicioViernes' => 'Hora Inicio Viernes',
			'tur_horaFinViernes' => 'Hora Fin Viernes',
			'tur_horaInicioSabado' => 'Hora Inicio Sabado',
			'tur_horaFinSabado' => 'Hora Fin Sabado',
			'tur_horaInicioDomingo' => 'Hora Inicio Domingo',
			'tur_horaFinDomingo' => 'Hora Fin Domingo',
			'tur_habilitado' => 'Habilitado',
			'tur_fechacreado' => 'Fecha creado',
			'tur_creadopor' => 'Creado por',
			'tur_fechamodificado' => 'Fecha modificado',
			'tur_modificadopor' => 'Modificado por',
			'tur_nombre_archivo' => 'Archivo a cargar',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('tur_id',$this->tur_id);
		$criteria->compare('tur_nombre',$this->tur_nombre,true);
		$criteria->compare('tur_horaInicioLunes',$this->tur_horaInicioLunes,true);
		$criteria->compare('tur_horaFinLunes',$this->tur_horaFinLunes,true);
		$criteria->compare('tur_horaInicioMartes',$this->tur_horaInicioMartes,true);
		$criteria->compare('tur_horaFinMartes',$this->tur_horaFinMartes,true);
		$criteria->compare('tur_horaInicioMiercoles',$this->tur_horaInicioMiercoles,true);
		$criteria->compare('tur_horaFinMiercoles',$this->tur_horaFinMiercoles,true);
		$criteria->compare('tur_horaInicioJueves',$this->tur_horaInicioJueves,true);
		$criteria->compare('tur_horaFinJueves',$this->tur_horaFinJueves,true);
		$criteria->compare('tur_horaInicioViernes',$this->tur_horaInicioViernes,true);
		$criteria->compare('tur_horaFinViernes',$this->tur_horaFinViernes,true);
		$criteria->compare('tur_horaInicioSabado',$this->tur_horaInicioSabado,true);
		$criteria->compare('tur_horaFinSabado',$this->tur_horaFinSabado,true);
		$criteria->compare('tur_horaInicioDomingo',$this->tur_horaInicioDomingo,true);
		$criteria->compare('tur_horaFinDomingo',$this->tur_horaFinDomingo,true);
		$criteria->compare('tur_habilitado',$this->tur_habilitado,true);
		$criteria->compare('tur_fechacreado',$this->tur_fechacreado,true);
		$criteria->compare('tur_creadopor',$this->tur_creadopor);
		$criteria->compare('tur_fechamodificado',$this->tur_fechamodificado,true);
		$criteria->compare('tur_modificadopor',$this->tur_modificadopor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Turnos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
