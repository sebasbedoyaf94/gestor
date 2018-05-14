<?php

/**
 * This is the model class for table "asesores".
 *
 * The followings are the available columns in table 'asesores':
 * @property integer $ase_id
 * @property integer $ase_cont_id
 * @property string $ase_usuariored
 * @property string $ase_nombre
 * @property string $ase_apellidos
 * @property string $ase_identificacion
 * @property string $ase_lider
 * @property string $ase_identificacion_lider
 * @property string $ase_horaInicioLunes
 * @property string $ase_horaFinLunes
 * @property string $ase_horaInicioMartes
 * @property string $ase_horaFinMartes
 * @property string $ase_horaInicioMiercoles
 * @property string $ase_horaFinMiercoles
 * @property string $ase_horaInicioJueves
 * @property string $ase_horaFinJueves
 * @property string $ase_horaInicioViernes
 * @property string $ase_horaFinViernes
 * @property string $ase_horaInicioSabado
 * @property string $ase_horaFinSabado
 * @property string $ase_horaInicioDomingo
 * @property string $ase_horaFinDomingo
 * @property string $ase_habilitado
 * @property string $ase_fechacreado
 * @property integer $ase_creadopor
 * @property string $ase_fechamodificado
 * @property integer $ase_modificadopor
 *
 * The followings are the available model relations:
 * @property Contratos $aseCont
 * @property Usuarios $aseCreadopor
 * @property Usuarios $aseModificadopor
 * @property AsesoresServicios[] $asesoresServicioses
 * @property NovedadesAsesores[] $novedadesAsesores
 */
class Asesores extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'asesores';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ase_cont_id, ase_usuariored, ase_nombre, ase_apellidos, ase_identificacion, ase_creadopor, ase_modificadopor', 'required'),
			array('ase_cont_id, ase_creadopor, ase_modificadopor, ase_identificacion', 'numerical', 'integerOnly'=>true),
			array('ase_usuariored, ase_nombre, ase_apellidos', 'length', 'max'=>50),
			array('ase_identificacion', 'length', 'max'=>15),
			array('ase_lider, ase_habilitado', 'length', 'max'=>2),
			array('ase_horaInicioLunes, ase_horaFinLunes, ase_horaInicioMartes, ase_horaFinMartes, ase_horaInicioMiercoles, ase_horaFinMiercoles, ase_horaInicioJueves, ase_horaFinJueves, ase_horaInicioViernes, ase_horaFinViernes, ase_horaInicioSabado, ase_horaFinSabado, ase_horaInicioDomingo, ase_horaFinDomingo, ase_fechacreado, ase_fechamodificado', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			// 
			array('ase_usuariored, ase_identificacion', 'unique'),
			array('ase_horaInicioLunes, ase_horaFinLunes, ase_horaInicioMartes, ase_horaFinMartes, ase_horaInicioMiercoles, ase_horaFinMiercoles, ase_horaInicioJueves, ase_horaFinJueves, ase_horaInicioViernes, ase_horaFinViernes, ase_horaInicioSabado, ase_horaFinSabado, ase_horaInicioDomingo, ase_horaFinDomingo', 'validarHorario'),
			
			array('ase_lider, ase_identificacion_lider', 'validarLider'),
			array('ase_id, ase_cont_id, ase_usuariored, ase_nombre, ase_apellidos, ase_identificacion, ase_lider, ase_identificacion_lider, ase_horaInicioLunes, ase_horaFinLunes, ase_horaInicioMartes, ase_horaFinMartes, ase_horaInicioMiercoles, ase_horaFinMiercoles, ase_horaInicioJueves, ase_horaFinJueves, ase_horaInicioViernes, ase_horaFinViernes, ase_horaInicioSabado, ase_horaFinSabado, ase_horaInicioDomingo, ase_horaFinDomingo, ase_habilitado, ase_fechacreado, ase_creadopor, ase_fechamodificado, ase_modificadopor', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'aseCont' => array(self::BELONGS_TO, 'Contratos', 'ase_cont_id'),
			'aseCreadopor' => array(self::BELONGS_TO, 'Usuarios', 'ase_creadopor'),
			'aseModificadopor' => array(self::BELONGS_TO, 'Usuarios', 'ase_modificadopor'),
			'novedadesAsesores' => array(self::HAS_MANY, 'NovedadesAsesores', 'novase_ase_id'),
			'asesoresServicios' => array(self::BELONGS_TO, 'AsesoresServicios', 'aseserv_ase_id'),
		);
	}

	function validarHorario($attribute, $params)
	{
		$totalHorasLunes = $this->ase_horaFinLunes - $this->ase_horaInicioLunes;
		$totalHorasMartes = $this->ase_horaFinMartes - $this->ase_horaInicioMartes;
		$totalHorasMiercoles = $this->ase_horaFinMiercoles - $this->ase_horaInicioMiercoles;
		$totalHorasJueves = $this->ase_horaFinJueves - $this->ase_horaInicioJueves;
		$totalHorasViernes = $this->ase_horaFinViernes - $this->ase_horaInicioViernes;
		$totalHorasSabado = $this->ase_horaFinSabado - $this->ase_horaInicioSabado;
		$totalHorasDomingo = $this->ase_horaFinDomingo - $this->ase_horaInicioDomingo;

		//VALIDACION DIA LUNES
		if ($totalHorasLunes < 0)
		{
		   	$mensaje = "<b>Error</b> al ingresar el horario del dia <b>Lunes.</b>";
			$this->addError('ase_horaFinLunes',$mensaje);
		}

		//VALIDACION DIA MARTES
		if ($totalHorasMartes < 0)
		{
		   	$mensaje = "<b>Error</b> al ingresar el horario del dia <b>Martes.</b>";
			$this->addError('ase_horaFinMartes',$mensaje);
		}
		
		//VALIDACION DIA MIERCOLES
		if ($totalHorasMiercoles < 0)
		{
		   	$mensaje = "<b>Error</b> al ingresar el horario del dia <b>Miercoles.</b>";
			$this->addError('ase_horaFinMiercoles',$mensaje);
		}
		
		//VALIDACION DIA JUEVES
		if ($totalHorasJueves < 0)
		{
		   	$mensaje = "<b>Error</b> al ingresar el horario del dia <b>Jueves.</b>";
			$this->addError('ase_horaFinJueves',$mensaje);
		}
		
		//VALIDACION DIA VIERNES
		if ($totalHorasViernes < 0)
		{
		   	$mensaje = "<b>Error</b> al ingresar el horario del dia <b>Viernes.</b>";
			$this->addError('ase_horaFinViernes',$mensaje);
		}
		
		//VALIDACION DIA SABADO
		if ($totalHorasSabado < 0)
		{
		   	$mensaje = "<b>Error</b> al ingresar el horario del dia <b>Sabado.</b>";
			$this->addError('ase_horaFinSabado',$mensaje);
		}

		//VALIDACION DIA DOMINGO
		if ($totalHorasDomingo < 0)
		{
		   	$mensaje = "<b>Error</b> al ingresar el horario del dia <b>Domingo.</b>";
			$this->addError('ase_horaFinDomingo',$mensaje);
		}
	}

	function validarLider($attribute, $params)
	{	
		$ase_lider = $this->ase_lider;
		$ase_identificacion_lider = $this->ase_identificacion_lider;

		//VALIDACION LIDER
		if ($ase_lider != 'Si' && $ase_identificacion_lider == '')
		{
		   	$mensaje = "<b>Error</b> debe ingresar la identificación del lider.</b>";
			$this->addError('ase_identificacion_lider',$mensaje);
		}
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ase_id' => 'Ase',
			'ase_cont_id' => 'Contrato',
			'ase_usuariored' => 'Usuario de red',
			'ase_nombre' => 'Nombre',
			'ase_apellidos' => 'Apellidos',
			'ase_identificacion' => 'Identificación',
			'ase_lider' => 'Lider',
			'ase_identificacion_lider' => 'Identificación Lider',
			'ase_horaInicioLunes' => 'Hora Inicio Lunes',
			'ase_horaFinLunes' => 'Hora Fin Lunes',
			'ase_horaInicioMartes' => 'Hora Inicio Martes',
			'ase_horaFinMartes' => 'Hora Fin Martes',
			'ase_horaInicioMiercoles' => 'Hora Inicio Miercoles',
			'ase_horaFinMiercoles' => 'Hora Fin Miercoles',
			'ase_horaInicioJueves' => 'Hora Inicio Jueves',
			'ase_horaFinJueves' => 'Hora Fin Jueves',
			'ase_horaInicioViernes' => 'Hora Inicio Viernes',
			'ase_horaFinViernes' => 'Hora Fin Viernes',
			'ase_horaInicioSabado' => 'Hora Inicio Sabado',
			'ase_horaFinSabado' => 'Hora Fin Sabado',
			'ase_horaInicioDomingo' => 'Hora Inicio Domingo',
			'ase_horaFinDomingo' => 'Hora Fin Domingo',
			'ase_habilitado' => 'Habilitado',
			'ase_fechacreado' => 'Fecha creado',
			'ase_creadopor' => 'Creado por',
			'ase_fechamodificado' => 'Fecha modificado',
			'ase_modificadopor' => 'Modificado por',
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

		$criteria->compare('ase_id',$this->ase_id);
		$criteria->compare('ase_cont_id',$this->ase_cont_id);
		$criteria->compare('ase_usuariored',$this->ase_usuariored,true);
		$criteria->compare('ase_nombre',$this->ase_nombre,true);
		$criteria->compare('ase_apellidos',$this->ase_apellidos,true);
		$criteria->compare('ase_identificacion',$this->ase_identificacion,true);
		$criteria->compare('ase_lider',$this->ase_lider,true);
		$criteria->compare('ase_identificacion_lider',$this->ase_identificacion_lider,true);
		$criteria->compare('ase_horaInicioLunes',$this->ase_horaInicioLunes,true);
		$criteria->compare('ase_horaFinLunes',$this->ase_horaFinLunes,true);
		$criteria->compare('ase_horaInicioMartes',$this->ase_horaInicioMartes,true);
		$criteria->compare('ase_horaFinMartes',$this->ase_horaFinMartes,true);
		$criteria->compare('ase_horaInicioMiercoles',$this->ase_horaInicioMiercoles,true);
		$criteria->compare('ase_horaFinMiercoles',$this->ase_horaFinMiercoles,true);
		$criteria->compare('ase_horaInicioJueves',$this->ase_horaInicioJueves,true);
		$criteria->compare('ase_horaFinJueves',$this->ase_horaFinJueves,true);
		$criteria->compare('ase_horaInicioViernes',$this->ase_horaInicioViernes,true);
		$criteria->compare('ase_horaFinViernes',$this->ase_horaFinViernes,true);
		$criteria->compare('ase_horaInicioSabado',$this->ase_horaInicioSabado,true);
		$criteria->compare('ase_horaFinSabado',$this->ase_horaFinSabado,true);
		$criteria->compare('ase_horaInicioDomingo',$this->ase_horaInicioDomingo,true);
		$criteria->compare('ase_horaFinDomingo',$this->ase_horaFinDomingo,true);
		$criteria->compare('ase_habilitado',$this->ase_habilitado,true);
		$criteria->compare('ase_fechacreado',$this->ase_fechacreado,true);
		$criteria->compare('ase_creadopor',$this->ase_creadopor);
		$criteria->compare('ase_fechamodificado',$this->ase_fechamodificado,true);
		$criteria->compare('ase_modificadopor',$this->ase_modificadopor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Asesores the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
