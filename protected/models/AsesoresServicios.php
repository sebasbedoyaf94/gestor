<?php

/**
 * This is the model class for table "asesores_servicios".
 *
 * The followings are the available columns in table 'asesores_servicios':
 * @property integer $aseserv_id
 * @property integer $aseserv_ase_id
 * @property integer $aseserv_serv_id
 *
 * The followings are the available model relations:
 * @property Asesores $aseservAse
 * @property Servicios $aseservServ
 * @property TurnosAsesores[] $turnosAsesores
 */
class AsesoresServicios extends CActiveRecord
{
	public $full_name;
	public $full_servicio;
	public $full_programa;
	public $full_cliente;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'asesores_servicios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('aseserv_ase_id, aseserv_serv_id', 'required'),
			array('aseserv_ase_id, aseserv_serv_id', 'numerical', 'integerOnly'=>true),
			array('aseserv_ase_id, aseserv_serv_id', 'consultarCategoriaAsesor', 'on'=>'insert'),
			array('aseserv_ase_id, aseserv_serv_id', 'validarServiciosLiderUpdate', 'on'=>'update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('aseserv_id, aseserv_ase_id, aseserv_serv_id, full_name, full_servicio, full_programa, full_cliente', 'safe', 'on'=>'search'),
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
			'aseservAse' => array(self::BELONGS_TO, 'Asesores', 'aseserv_ase_id'),
			'aseservServ' => array(self::BELONGS_TO, 'Servicios', 'aseserv_serv_id'),
			'turnosAsesores' => array(self::HAS_MANY, 'TurnosAsesores', 'turase_aseserv_id'),
			'aseservProg'=>array(self::BELONGS_TO, 'Programas', array('serv_prog_id'=>'prog_id'),'through'=>'aseservServ'),
			'aseservCli'=>array(self::BELONGS_TO, 'Clientes', array('prog_cli_id'=>'cli_id'),'through'=>'aseservProg'),
		);
	}

	function consultarCategoriaAsesor($attribute, $param)
	{
		$ase_id = $this->aseserv_ase_id;
		$serv_id = $this->aseserv_serv_id;

		$categoria=Asesores::model()->findByPk($ase_id);

		if($categoria->ase_lider == 'No')
		{
			$this->validarServiciosAsesor($ase_id);
		}
		else
		{
			$this->validarServiciosLider($ase_id, $serv_id);
		}
	}

	function validarServiciosAsesor($id)
	{
		$criteria=new CDbCriteria;
		$criteria->select = "*";
		$criteria->condition = "aseserv_ase_id='$id'";
		$servicio = AsesoresServicios::model()->find($criteria);

		if($servicio)
		{
			$mensaje = "<b>El asesor ya está asociado a un servicio.</b>.";
			$this->addError('aseserv_ase_id',$mensaje);
		}
	}

	function validarServiciosLider($ase_id, $serv_id)
	{
		$criteria=new CDbCriteria;
		$criteria->select = "*";
		$criteria->condition = "aseserv_ase_id='$ase_id' AND aseserv_serv_id = '$serv_id'";

		$servicios=AsesoresServicios::model()->find($criteria);

		if($servicios)
		{
			$mensaje = "<b>El líder ya se encuentra asociado a ese servicio.</b>.";
			$this->addError('aseserv_ase_id',$mensaje);
		}
	}

	function validarServiciosLiderUpdate($attribute, $param)
	{
		$ase_id = $this->aseserv_ase_id;
		$serv_id = $this->aseserv_serv_id;
		$lider=Asesores::model()->findByPk($ase_id);

		if(($lider->ase_lider=='Si') && ($attribute=='aseserv_ase_id'))
		{
			$criteria=new CDbCriteria;
			$criteria->select = "*";
			$criteria->condition = "aseserv_ase_id='$ase_id' AND aseserv_serv_id = '$serv_id'";

			$servicios=AsesoresServicios::model()->find($criteria);

			if($servicios)
			{
				$mensaje = "<b>El líder ya se encuentra asociado a ese servicio.</b>.";
				$this->addError('aseserv_serv_id',$mensaje);
			}
		}
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'aseserv_id' => 'Aseserv',
			'aseserv_ase_id' => 'Asesor',
			'aseserv_serv_id' => 'Servicio',
			'full_name' => 'Asesor',
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


		$criteria->with = array('aseservServ', 'aseservAse', 'aseservProg', 'aseservCli');
        $criteria->compare('aseservAse.ase_nombre', $this->full_name, true, 'OR');
        $criteria->compare('aseservAse.ase_apellidos', $this->full_name, true, 'OR');
        $criteria->compare('aseservServ.serv_nombre', $this->full_servicio, true, 'AND');
        $criteria->compare('aseservProg.prog_nombre', $this->full_programa, true, 'AND');
        $criteria->compare('aseservCli.cli_nombre', $this->full_cliente, true, 'AND');

		$criteria->compare('aseserv_id',$this->aseserv_id);
		$criteria->compare('aseserv_ase_id',$this->aseserv_ase_id);
		$criteria->compare('aseserv_serv_id',$this->aseserv_serv_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			 'sort'=>array(
		        'attributes'=>array(
		            'full_name'=>array(
		                'asc'=>'aseservAse.ase_nombre ASC',
		                'desc'=>'aseservAse.ase_nombre DESC',
		            ),
		            'full_servicio'=>array(
		                'asc'=>'aseservServ.serv_nombre ASC',
		                'desc'=>'aseservServ.serv_nombre DESC',
		            ),
		            'full_programa'=>array(
		                'asc'=>'aseservProg.prog_nombre ASC',
		                'desc'=>'aseservProg.prog_nombre DESC',
		            ),
		            'full_cliente'=>array(
		                'asc'=>'aseservCli.cli_nombre ASC',
		                'desc'=>'aseservCli.cli_nombre DESC',
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
	 * @return AsesoresServicios the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
