<?php

/**
 * This is the model class for table "servicios".
 *
 * The followings are the available columns in table 'servicios':
 * @property integer $serv_id
 * @property integer $serv_prog_id
 * @property string $serv_nombre
 * @property string $serv_descripcion
 * @property string $serv_horaInicioLunes
 * @property string $serv_horaFinLunes
 * @property string $serv_horaInicioMartes
 * @property string $serv_horaFinMartes
 * @property string $serv_horaInicioMiercoles
 * @property string $serv_horaFinMiercoles
 * @property string $serv_horaInicioJueves
 * @property string $serv_horaFinJueves
 * @property string $serv_horaInicioViernes
 * @property string $serv_horaFinViernes
 * @property string $serv_horaInicioSabado
 * @property string $serv_horaFinSabado
 * @property string $serv_horaInicioDomingo
 * @property string $serv_horaFinDomingo
 * @property string $serv_habilitado
 * @property string $serv_fechacreado
 * @property integer $serv_creadopor
 * @property string $serv_fechamodificado
 * @property integer $serv_modificadopor
 *
 * The followings are the available model relations:
 * @property AsesoresServicios[] $asesoresServicioses
 * @property Programas $servProg
 * @property Usuarios $serv
 * @property UsuariosServicios[] $usuariosServicioses
 */
class Servicios extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'servicios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('serv_prog_id, serv_descripcion, serv_creadopor, serv_modificadopor, serv_nombre', 'required'),
			array('serv_prog_id, serv_creadopor, serv_modificadopor', 'numerical', 'integerOnly'=>true),
			array('serv_nombre', 'length', 'max'=>50),
			array('serv_habilitado', 'length', 'max'=>2),
			array('serv_id, serv_horaInicioLunes, serv_horaFinLunes, serv_horaInicioMartes, serv_horaFinMartes, serv_horaInicioMiercoles, serv_horaFinMiercoles, serv_horaInicioJueves, serv_horaFinJueves, serv_horaInicioViernes, serv_horaFinViernes, serv_horaInicioSabado, serv_horaFinSabado, serv_horaInicioDomingo, serv_horaFinDomingo', 'validarTurnoServicio', 'on'=>'update'),
			array('serv_horaInicioLunes, serv_horaFinLunes, serv_horaInicioMartes, serv_horaFinMartes, serv_horaInicioMiercoles, serv_horaFinMiercoles, serv_horaInicioJueves, serv_horaFinJueves, serv_horaInicioViernes, serv_horaFinViernes, serv_horaInicioSabado, serv_horaFinSabado, serv_horaInicioDomingo, serv_horaFinDomingo, serv_fechacreado, serv_fechamodificado', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('serv_id, serv_prog_id, serv_nombre, serv_descripcion, serv_horaInicioLunes, serv_horaFinLunes, serv_horaInicioMartes, serv_horaFinMartes, serv_horaInicioMiercoles, serv_horaFinMiercoles, serv_horaInicioJueves, serv_horaFinJueves, serv_horaInicioViernes, serv_horaFinViernes, serv_horaInicioSabado, serv_horaFinSabado, serv_horaInicioDomingo, serv_horaFinDomingo, serv_habilitado, serv_fechacreado, serv_creadopor, serv_fechamodificado, serv_modificadopor', 'safe', 'on'=>'search'),
		);
	}

	function validarTurnoServicio($attribute, $param)
	{
		$serv_id = $this->serv_id;
		$inicioLunes = $this->serv_horaInicioLunes;
		$finLunes = $this->serv_horaFinLunes;
		$inicioMartes = $this->serv_horaInicioMartes;
		$finMartes = $this->serv_horaFinMartes;
		$inicioMiercoles = $this->serv_horaInicioMiercoles;
		$finMiercoles = $this->serv_horaFinMiercoles;
		$inicioJueves = $this->serv_horaInicioJueves;
		$finJueves = $this->serv_horaFinJueves;
		$inicioViernes = $this->serv_horaInicioViernes;
		$finViernes = $this->serv_horaFinViernes;
		$inicioSabado = $this->serv_horaInicioSabado;
		$finSabado = $this->serv_horaFinSabado;
		$inicioDomingo = $this->serv_horaInicioDomingo;
		$finDomingo = $this->serv_horaFinDomingo;

		$serv_horaInicioLunes = strtotime(sprintf('%s %s:00',date('Y-m-d'),$inicioLunes));
		$serv_horaFinLunes = strtotime(sprintf('%s %s:00',date('Y-m-d'),$finLunes));
		$serv_horaInicioMartes = strtotime(sprintf('%s %s:00',date('Y-m-d'),$inicioMartes));
		$serv_horaFinMartes = strtotime(sprintf('%s %s:00',date('Y-m-d'),$finMartes));
		$serv_horaInicioMiercoles = strtotime(sprintf('%s %s:00',date('Y-m-d'),$inicioMiercoles));
		$serv_horaFinMiercoles = strtotime(sprintf('%s %s:00',date('Y-m-d'),$finMiercoles));
		$serv_horaInicioJueves = strtotime(sprintf('%s %s:00',date('Y-m-d'),$inicioJueves));
		$serv_horaFinJueves = strtotime(sprintf('%s %s:00',date('Y-m-d'),$finJueves));
		$serv_horaInicioViernes = strtotime(sprintf('%s %s:00',date('Y-m-d'),$inicioViernes));
		$serv_horaFinViernes = strtotime(sprintf('%s %s:00',date('Y-m-d'),$finViernes));
		$serv_horaInicioSabado = strtotime(sprintf('%s %s:00',date('Y-m-d'),$inicioSabado));
		$serv_horaFinSabado = strtotime(sprintf('%s %s:00',date('Y-m-d'),$finSabado));
		$serv_horaInicioDomingo = strtotime(sprintf('%s %s:00',date('Y-m-d'),$inicioDomingo));
		$serv_horaFinDomingo = strtotime(sprintf('%s %s:00',date('Y-m-d'),$finDomingo));

		$criteria=new CDbCriteria;
		$criteria->select = "*";
		$criteria->condition = "turserv_serv_id='$serv_id'";

		$turserv = TurnosServicios::model()->find($criteria);

		$tur=Turnos::model()->findByPk($turserv->turserv_tur_id);

		$tur_horaInicioLunes = strtotime(sprintf('%s %s',date('Y-m-d'),$tur->tur_horaInicioLunes));
		$tur_horaFinLunes = strtotime(sprintf('%s %s',date('Y-m-d'),$tur->tur_horaFinLunes));
		$tur_horaInicioMartes = strtotime(sprintf('%s %s',date('Y-m-d'),$tur->tur_horaInicioMartes));
		$tur_horaFinMartes = strtotime(sprintf('%s %s',date('Y-m-d'),$tur->tur_horaFinMartes));
		$tur_horaInicioMiercoles = strtotime(sprintf('%s %s',date('Y-m-d'),$tur->tur_horaInicioMiercoles));
		$tur_horaFinMiercoles = strtotime(sprintf('%s %s',date('Y-m-d'),$tur->tur_horaFinMiercoles));
		$tur_horaInicioJueves = strtotime(sprintf('%s %s',date('Y-m-d'),$tur->tur_horaInicioJueves));
		$tur_horaFinJueves = strtotime(sprintf('%s %s',date('Y-m-d'),$tur->tur_horaFinJueves));
		$tur_horaInicioViernes = strtotime(sprintf('%s %s',date('Y-m-d'),$tur->tur_horaInicioViernes));
		$tur_horaFinViernes = strtotime(sprintf('%s %s',date('Y-m-d'),$tur->tur_horaFinViernes));
		$tur_horaInicioSabado = strtotime(sprintf('%s %s',date('Y-m-d'),$tur->tur_horaInicioSabado));
		$tur_horaFinSabado = strtotime(sprintf('%s %s',date('Y-m-d'),$tur->tur_horaFinSabado));
		$tur_horaInicioDomingo = strtotime(sprintf('%s %s',date('Y-m-d'),$tur->tur_horaInicioDomingo));
		$tur_horaFinDomingo = strtotime(sprintf('%s %s',date('Y-m-d'),$tur->tur_horaFinDomingo));

		// VALIDACION LUNES
		if(($tur_horaInicioLunes < $serv_horaInicioLunes) || ($tur_horaFinLunes > $serv_horaFinLunes) and ($attribute=='serv_horaInicioLunes'))
		{
			$mensaje = "<b>El servicio tiene asignado un turno y el horario del día lunes a actualizar no se encuentra en el rango del horario definido para el turno, por favor modificar el horario del turno para poder realizar esta actualización.</b>";
			$this->addError('serv_horaInicioLunes',$mensaje);
		}
		// VALIDACION MARTES
		if(($tur_horaInicioMartes < $serv_horaInicioMartes) || ($tur_horaFinMartes > $serv_horaFinMartes) and ($attribute=='serv_horaInicioMartes'))
		{
			$mensaje = "<b>El servicio tiene asignado un turno y el horario del día martes a actualizar no se encuentra en el rango del horario definido para el turno, por favor modificar el horario del turno para poder realizar esta actualización.</b>";
			$this->addError('serv_horaInicioMartes',$mensaje);
		}
		// VALIDACION MIERCOLES
		if(($tur_horaInicioMiercoles < $serv_horaInicioMiercoles) || ($tur_horaFinMiercoles > $serv_horaFinMiercoles) and ($attribute=='serv_horaInicioMiercoles'))
		{
			$mensaje = "<b>El servicio tiene asignado un turno y el horario del día miercoles a actualizar no se encuentra en el rango del horario definido para el turno, por favor modificar el horario del turno para poder realizar esta actualización.</b>";
			$this->addError('serv_horaInicioMiercoles',$mensaje);
		}
		// VALIDACION JUEVES
		if(($tur_horaInicioJueves < $serv_horaInicioJueves) || ($tur_horaFinJueves > $serv_horaFinJueves) and ($attribute=='serv_horaInicioJueves'))
		{
			$mensaje = "<b>El servicio tiene asignado un turno y el horario del día jueves a actualizar no se encuentra en el rango del horario definido para el turno, por favor modificar el horario del turno para poder realizar esta actualización.</b>";
			$this->addError('serv_horaInicioJueves',$mensaje);
		}
		// VALIDACION VIERNES
		if(($tur_horaInicioViernes < $serv_horaInicioViernes) || ($tur_horaFinViernes > $serv_horaFinViernes) and ($attribute=='serv_horaInicioViernes'))
		{
			$mensaje = "<b>El servicio tiene asignado un turno y el horario del día viernes a actualizar no se encuentra en el rango del horario definido para el turno, por favor modificar el horario del turno para poder realizar esta actualización.</b>";
			$this->addError('serv_horaInicioViernes',$mensaje);
		}
		// VALIDACION SABADO
		if(($tur_horaInicioSabado < $serv_horaInicioSabado) || ($tur_horaFinSabado > $serv_horaFinSabado) and ($attribute=='serv_horaInicioSabado'))
		{
			$mensaje = "<b>El servicio tiene asignado un turno y el horario del día sabado a actualizar no se encuentra en el rango del horario definido para el turno, por favor modificar el horario del turno para poder realizar esta actualización.</b>";
			$this->addError('serv_horaInicioSabado',$mensaje);
		}
		// VALIDACION DOMINGO
		if(($tur_horaInicioDomingo < $serv_horaInicioDomingo) || ($tur_horaFinDomingo > $serv_horaFinDomingo) and ($attribute=='serv_horaInicioDomingo'))
		{
			$mensaje = "<b>El servicio tiene asignado un turno y el horario del día domingo a actualizar no se encuentra en el rango del horario definido para el turno, por favor modificar el horario del turno para poder realizar esta actualización.</b>";
			$this->addError('serv_horaInicioDomingo',$mensaje);
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
			'asesoresServicioses' => array(self::HAS_MANY, 'AsesoresServicios', 'aseserv_serv_id'),
			'servProg' => array(self::BELONGS_TO, 'Programas', 'serv_prog_id'),
			'serv' => array(self::BELONGS_TO, 'Usuarios', 'serv_id'),
			'usuariosServicioses' => array(self::HAS_MANY, 'UsuariosServicios', 'usuaserv_serv_id'),
			'turnosServicios' => array(self::HAS_MANY, 'TurnosServicios', 'turserv_serv_id'),
			'asesoresServicios' => array(self::BELONGS_TO, 'AsesoresServicios', 'aseserv_serv_id'),
			'servCreadopor' => array(self::BELONGS_TO, 'Usuarios', 'serv_creadopor'),
			'servModificadopor' => array(self::BELONGS_TO, 'Usuarios', 'serv_modificadopor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'serv_id' => 'Servicio',
			'serv_prog_id' => 'Programa',
			'serv_nombre' => 'Nombre',
			'serv_descripcion' => 'Descripción',
			'serv_horaInicioLunes' => 'Hora Inicio Lunes',
			'serv_horaFinLunes' => 'Hora Fin Lunes',
			'serv_horaInicioMartes' => 'Hora Inicio Martes',
			'serv_horaFinMartes' => 'Hora Fin Martes',
			'serv_horaInicioMiercoles' => 'Hora Inicio Miercoles',
			'serv_horaFinMiercoles' => 'Hora Fin Miercoles',
			'serv_horaInicioJueves' => 'Hora Inicio Jueves',
			'serv_horaFinJueves' => 'Hora Fin Jueves',
			'serv_horaInicioViernes' => 'Hora Inicio Viernes',
			'serv_horaFinViernes' => 'Hora Fin Viernes',
			'serv_horaInicioSabado' => 'Hora Inicio Sabado',
			'serv_horaFinSabado' => 'Hora Fin Sabado',
			'serv_horaInicioDomingo' => 'Hora Inicio Domingo',
			'serv_horaFinDomingo' => 'Hora Fin Domingo',
			'serv_habilitado' => 'Habilitado',
			'serv_fechacreado' => 'Fecha creado',
			'serv_creadopor' => 'Creado por',
			'serv_fechamodificado' => 'Fecha modificado',
			'serv_modificadopor' => 'Modificado por',
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

		$criteria->with = array('servProg');
        $criteria->compare('servProg.prog_nombre', Yii::app()->request->getParam('servProg_prog_nombre'), true);

		$criteria->compare('serv_id',$this->serv_id);
		$criteria->compare('serv_prog_id',$this->serv_prog_id);
		$criteria->compare('serv_nombre',$this->serv_nombre,true);
		$criteria->compare('serv_descripcion',$this->serv_descripcion,true);
		$criteria->compare('serv_horaInicioLunes',$this->serv_horaInicioLunes,true);
		$criteria->compare('serv_horaFinLunes',$this->serv_horaFinLunes,true);
		$criteria->compare('serv_horaInicioMartes',$this->serv_horaInicioMartes,true);
		$criteria->compare('serv_horaFinMartes',$this->serv_horaFinMartes,true);
		$criteria->compare('serv_horaInicioMiercoles',$this->serv_horaInicioMiercoles,true);
		$criteria->compare('serv_horaFinMiercoles',$this->serv_horaFinMiercoles,true);
		$criteria->compare('serv_horaInicioJueves',$this->serv_horaInicioJueves,true);
		$criteria->compare('serv_horaFinJueves',$this->serv_horaFinJueves,true);
		$criteria->compare('serv_horaInicioViernes',$this->serv_horaInicioViernes,true);
		$criteria->compare('serv_horaFinViernes',$this->serv_horaFinViernes,true);
		$criteria->compare('serv_horaInicioSabado',$this->serv_horaInicioSabado,true);
		$criteria->compare('serv_horaFinSabado',$this->serv_horaFinSabado,true);
		$criteria->compare('serv_horaInicioDomingo',$this->serv_horaInicioDomingo,true);
		$criteria->compare('serv_horaFinDomingo',$this->serv_horaFinDomingo,true);
		$criteria->compare('serv_habilitado',$this->serv_habilitado,true);
		$criteria->compare('serv_fechacreado',$this->serv_fechacreado,true);
		$criteria->compare('serv_creadopor',$this->serv_creadopor);
		$criteria->compare('serv_fechamodificado',$this->serv_fechamodificado,true);
		$criteria->compare('serv_modificadopor',$this->serv_modificadopor);

		$sort = new CSort();
        $sort->attributes = array(
            'tableA.name' => array(
                'asc' => 'servProg.prog_nombre ASC',
                'desc' => 'servProg.prog_nombre DESC'
            ),
            '*'
        );
        return new CActiveDataProvider($this,array(
            'criteria' => $criteria,
            'sort' => $sort
        ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Servicios the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
