<?php

/**
 * This is the model class for table "turnos_servicios".
 *
 * The followings are the available columns in table 'turnos_servicios':
 * @property integer $turserv_id
 * @property integer $turserv_tur_id
 * @property integer $turserv_serv_id
 *
 * The followings are the available model relations:
 * @property Turnos $turservTur
 * @property Servicios $turservServ
 */
class TurnosServicios extends CActiveRecord
{
	public $full_turno;
	public $full_servicio;
	public $full_programa;
	public $full_cliente;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'turnos_servicios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('turserv_tur_id, turserv_serv_id', 'numerical', 'integerOnly'=>true),
			array('turserv_tur_id, turserv_serv_id', 'required'),
			array('turserv_tur_id, turserv_serv_id', 'validarHorasTurnoServicio'),
			array('turserv_tur_id, turserv_serv_id', 'validarRelacionTurnoServicio'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('turserv_id, turserv_tur_id, turserv_serv_id, full_turno, full_servicio, full_programa, full_cliente', 'safe', 'on'=>'search'),
		);
	}

	function validarRelacionTurnoServicio($attribute, $param)
	{
		$tur_id = $this->turserv_tur_id;
		$serv_id = $this->turserv_serv_id;

		$criteria=new CDbCriteria;
		$criteria->select = "turserv_id";
		$criteria->condition = "turserv_tur_id='$tur_id' AND turserv_serv_id='$serv_id'";
		$turserv_id = TurnosServicios::model()->find($criteria);

		if($turserv_id)
		{
			$mensaje = "<b>El turno ya fue asignado a dicho servicio</b>.";
			$this->addError('turserv_tur_id',$mensaje);
		}

	}

	function validarHorasTurnoServicio($attribute, $params)
	{

		$horasTurno = $this->calcularHorasTurno($this->turserv_tur_id);
		$horasServicio = $this->calcularHorasServicio($this->turserv_serv_id);

		if(($horasTurno > $horasServicio) and ($attribute=='turserv_tur_id'))
		{
			$mensaje = "<b>La cantidad de horas del turno no pueden ser mayores a las horas del servicio</b>.";
			$this->addError('turserv_tur_id',$mensaje);
		}
	}

	function calcularHorasTurno($id)
	{
		$model=Turnos::model()->findByPk($id);

		$totalHorasLunes = $model->tur_horaFinLunes - $model->tur_horaInicioLunes;
		$totalHorasMartes = $model->tur_horaFinMartes - $model->tur_horaInicioMartes;
		$totalHorasMiercoles = $model->tur_horaFinMiercoles - $model->tur_horaInicioMiercoles;
		$totalHorasJueves = $model->tur_horaFinJueves - $model->tur_horaInicioJueves;
		$totalHorasViernes = $model->tur_horaFinViernes - $model->tur_horaInicioViernes;
		$totalHorasSabado = $model->tur_horaFinSabado - $model->tur_horaInicioSabado;
		$totalHorasDomingo = $model->tur_horaFinDomingo - $model->tur_horaInicioDomingo;

		$totalHorasTurno = $totalHorasLunes + $totalHorasMartes + $totalHorasMiercoles + $totalHorasJueves + $totalHorasViernes + $totalHorasSabado + $totalHorasDomingo;

		return $totalHorasTurno;
	}

	function calcularHorasServicio($id)
	{
		$model=Servicios::model()->findByPk($id);

		$totalHorasLunes = $model->serv_horaFinLunes - $model->serv_horaInicioLunes;
		$totalHorasMartes = $model->serv_horaFinMartes - $model->serv_horaInicioMartes;
		$totalHorasMiercoles = $model->serv_horaFinMiercoles - $model->serv_horaInicioMiercoles;
		$totalHorasJueves = $model->serv_horaFinJueves - $model->serv_horaInicioJueves;
		$totalHorasViernes = $model->serv_horaFinViernes - $model->serv_horaInicioViernes;
		$totalHorasSabado = $model->serv_horaFinSabado - $model->serv_horaInicioSabado;
		$totalHorasDomingo = $model->serv_horaFinDomingo - $model->serv_horaInicioDomingo;

		$totalHorasServicio = $totalHorasLunes + $totalHorasMartes + $totalHorasMiercoles + $totalHorasJueves + $totalHorasViernes + $totalHorasSabado + $totalHorasDomingo;

		return $totalHorasServicio;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'turservTur' => array(self::BELONGS_TO, 'Turnos', 'turserv_tur_id'),
			'turservServ' => array(self::BELONGS_TO, 'Servicios', 'turserv_serv_id'),
			'turservProg' => array(self::BELONGS_TO, 'Programas', array('serv_prog_id'=>'prog_id'),'through'=>'turservServ'),
			'turservCli'=>array(self::BELONGS_TO, 'Clientes', array('prog_cli_id'=>'cli_id'),'through'=>'turservProg'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'turserv_id' => 'Turserv',
			'turserv_tur_id' => 'Turno',
			'turserv_serv_id' => 'Servicio',
			'full_turno' => 'Turno',
			'full_servicio' => 'Servicio',
			'full_programa' => 'Programa',
			'full_cliente' => 'Cliente',
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

		$criteria->with = array('turservTur', 'turservServ', 'turservProg', 'turservCli');
        $criteria->compare('turservTur.tur_nombre', $this->full_turno, true, 'AND');
        $criteria->compare('turservServ.serv_nombre', $this->full_servicio, true, 'AND');
        $criteria->compare('turservProg.prog_nombre', $this->full_programa, true, 'AND');
        $criteria->compare('turservCli.cli_nombre', $this->full_cliente, true, 'AND');

		$criteria->compare('turserv_id',$this->turserv_id);
		$criteria->compare('turserv_tur_id',$this->turserv_tur_id);
		$criteria->compare('turserv_serv_id',$this->turserv_serv_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
		        'attributes'=>array(
		            'full_turno'=>array(
		                'asc'=>'turservTur.tur_nombre ASC',
		                'desc'=>'turservTur.tur_nombre DESC',
		            ),
		            'full_servicio'=>array(
		                'asc'=>'turservServ.serv_nombre ASC',
		                'desc'=>'turservServ.serv_nombre DESC',
		            ),
		            'full_programa'=>array(
		                'asc'=>'turservProg.prog_nombre ASC',
		                'desc'=>'turservProg.prog_nombre DESC',
		            ),
		            'full_cliente'=>array(
		                'asc'=>'turservCli.cli_nombre ASC',
		                'desc'=>'turservCli.cli_nombre DESC',
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
	 * @return TurnosServicios the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
