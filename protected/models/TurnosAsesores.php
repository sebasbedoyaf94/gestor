<?php

/**
 * This is the model class for table "turnos_asesores".
 *
 * The followings are the available columns in table 'turnos_asesores':
 * @property integer $turase_id
 * @property integer $turase_tur_id
 * @property integer $turase_aseserv_id
 * @property string $turase_fechaInicio
 * @property string $turase_fechaFin
 * @property string $turase_fechacreado
 * @property integer $turase_creadopor
 * @property string $turase_fechamodificado
 * @property integer $turase_modificadopor
 *
 * The followings are the available model relations:
 * @property AsesoresServicios $turaseAseserv
 * @property Turnos $turaseTur
 * @property Usuarios $turaseCreadopor
 * @property Usuarios $turaseModificadopor
 */
class TurnosAsesores extends CActiveRecord
{
	public $full_name;
	public $full_turno;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'turnos_asesores';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('turase_tur_id, turase_aseserv_id, turase_fechaInicio, turase_fechaFin', 'required'),
			array('turase_tur_id, turase_aseserv_id, turase_creadopor, turase_modificadopor', 'numerical', 'integerOnly'=>true),
			array('turase_fechaInicio, turase_fechaFin', 'validarFechas'),
			array('turase_fechaInicio', 'validarFechaInicio'),
			array('turase_fechaFin', 'validarFechaFin'),
			array('turase_tur_id, turase_aseserv_id, turase_fechaInicio, turase_fechaFin', 'validarTurnoAsesor'),
			array('turase_fechacreado, turase_fechamodificado', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('turase_id, turase_tur_id, turase_aseserv_id, turase_fechaInicio, turase_fechaFin, turase_fechacreado, turase_creadopor, turase_fechamodificado, turase_modificadopor, full_name, full_turno', 'safe', 'on'=>'search'),
		);
	}

	function validarFechas($attribute, $param)
	{
		$fechaInicio = $this->turase_fechaInicio;
		$fechaFin = $this->turase_fechaFin;

		if(($fechaFin <= $fechaInicio) && ($attribute=='turase_fechaFin'))
		{
			$mensaje = "<b>La fecha inicio del turno para el asesor no puede ser superior a la fecha fin.</b>";
			$this->addError('turase_fechaInicio',$mensaje);
		}
	}

	function validarFechaInicio($attribute, $param)
	{
		$fecha_inicio = $this->turase_fechaInicio;
		$fecha = date('l', strtotime($fecha_inicio)); 

		if($fecha != 'Monday')
		{
			$mensaje = "<b>La fecha de inicio del turno debe ser lunes.</b>";
			$this->addError('turase_fechaInicio',$mensaje);
		}
	}

	function validarFechaFin($attribute, $param)
	{
		$fecha_fin = $this->turase_fechaFin;
		$fecha = date('l', strtotime($fecha_fin));

		if($fecha != 'Sunday')
		{
			$mensaje = "<b>La fecha fin del turno debe ser domingo.</b>";
			$this->addError('turase_fechaFin',$mensaje);
		}
	}

	function validarTurnoAsesor($attribute, $param)
	{
		$turno = $this->turase_tur_id;
		$fechaInicio = $this->turase_fechaInicio;
		$fechaFin = $this->turase_fechaFin;
		$asesor = $this->turase_aseserv_id;

		$criteria=new CDbCriteria;
		$criteria->select = "turase_id";
		$criteria->condition = "turase_tur_id='$turno' AND turase_fechaInicio='$fechaInicio' AND turase_fechaFin='$fechaFin' AND turase_aseserv_id='$asesor'";
		$turase = TurnosAsesores::model()->find($criteria);

		if($turase)
		{
			$mensaje = "<b>El asesor ya tiene asignado un turno para esa semana.</b>";
			$this->addError('turase_ase_id',$mensaje);
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
			'turaseAseserv' => array(self::BELONGS_TO, 'AsesoresServicios', 'turase_aseserv_id'),
			'turaseTur' => array(self::BELONGS_TO, 'Turnos', 'turase_tur_id'),
			'turaseCreadopor' => array(self::BELONGS_TO, 'Usuarios', 'turase_creadopor'),
			'turaseModificadopor' => array(self::BELONGS_TO, 'Usuarios', 'turase_modificadopor'),
			'turaseAse'=>array(self::BELONGS_TO, 'Asesores', array('aseserv_ase_id'=>'ase_id'),'through'=>'turaseAseserv'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'turase_id' => 'Turase',
			'turase_tur_id' => 'Turno',
			'turase_aseserv_id' => 'Asesor',
			'turase_fechaInicio' => 'Fecha Inicio',
			'turase_fechaFin' => 'Fecha Fin',
			'turase_fechacreado' => 'Fecha Creación',
			'turase_creadopor' => 'Creado Por',
			'turase_fechamodificado' => 'Fecha Modificación',
			'turase_modificadopor' => 'Modificado Por',
			'full_turno' => 'Turno',
			'full_name' => 'Asesor',
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

		$criteria->with = array('turaseTur', 'turaseAse');
		$criteria->compare('turaseAse.ase_nombre', $this->full_name, true, 'OR');
        $criteria->compare('turaseAse.ase_apellidos', $this->full_name, true, 'OR');
        $criteria->compare('turaseTur.tur_nombre', $this->full_turno, true, 'AND');
        

		$criteria->compare('turase_id',$this->turase_id);
		$criteria->compare('turase_tur_id',$this->turase_tur_id);
		$criteria->compare('turase_aseserv_id',$this->turase_aseserv_id);
		$criteria->compare('turase_fechaInicio',$this->turase_fechaInicio,true);
		$criteria->compare('turase_fechaFin',$this->turase_fechaFin,true);
		$criteria->compare('turase_fechacreado',$this->turase_fechacreado,true);
		$criteria->compare('turase_creadopor',$this->turase_creadopor);
		$criteria->compare('turase_fechamodificado',$this->turase_fechamodificado,true);
		$criteria->compare('turase_modificadopor',$this->turase_modificadopor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
		        'attributes'=>array(
		            'full_name'=>array(
		                'asc'=>'turaseAse.ase_nombre ASC',
		                'desc'=>'turaseAse.ase_nombre DESC',
		            ),
		            'full_turno'=>array(
		                'asc'=>'turaseTur.tur_nombre ASC',
		                'desc'=>'turaseTur.tur_nombre DESC',
		            ),
		            '*',
		        ),
		    ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TurnosAsesores the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
