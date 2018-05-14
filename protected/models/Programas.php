<?php

/**
 * This is the model class for table "programas".
 *
 * The followings are the available columns in table 'programas':
 * @property integer $prog_id
 * @property integer $prog_cli_id
 * @property string $prog_nombre
 * @property string $prog_descripcion
 * @property string $prog_habilitado
 * @property string $prog_fechacreado
 * @property integer $prog_creadopor
 * @property string $prog_fechamodificado
 * @property integer $prog_modificadopor
 *
 * The followings are the available model relations:
 * @property Clientes $progCli
 * @property Usuarios $progCreadopor
 * @property Usuarios $progModificadopor
 * @property Servicios[] $servicioses
 */
class Programas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'programas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('prog_cli_id, prog_nombre, prog_descripcion, prog_creadopor, prog_modificadopor', 'required'),
			array('prog_cli_id, prog_creadopor, prog_modificadopor', 'numerical', 'integerOnly'=>true),
			array('prog_nombre', 'length', 'max'=>50),
			array('prog_habilitado', 'length', 'max'=>2),
			array('prog_cli_id, prog_nombre', 'length',),
			array('prog_fechacreado, prog_fechamodificado', 'safe'),

			array('prog_cli_id,prog_nombre', 'validarExistencia','on'=>'insert, update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('prog_id, prog_cli_id, prog_nombre, prog_descripcion, prog_habilitado, prog_fechacreado, prog_creadopor, prog_fechamodificado, prog_modificadopor', 'safe', 'on'=>'search'),
		);
	}

	function validarExistencia($attribute, $params)
	{
		
		if (empty($this->prog_id)) {
			$cantidad = Programas::model()->countByAttributes(
				array(
		            'prog_cli_id'=> $this->prog_cli_id,
		            'prog_nombre'=> $this->prog_nombre
	        	)
	        );
		}
		else
		{
			$cantidad = Programas::model()->countByAttributes(
				array(
		            'prog_cli_id'=> $this->prog_cli_id,
		            'prog_nombre'=> $this->prog_nombre
	        	),
        		'prog_id != '.$this->prog_id
	        );
		}

		
		if($cantidad != 0)
		{
            $this->addError($attribute,' Ya existe un programa con el mismo nombre para el cliente seleccionado. ');
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
			'progCli' => array(self::BELONGS_TO, 'Clientes', 'prog_cli_id'),
			'progCreadopor' => array(self::BELONGS_TO, 'Usuarios', 'prog_creadopor'),
			'progModificadopor' => array(self::BELONGS_TO, 'Usuarios', 'prog_modificadopor'),
			'servicioses' => array(self::HAS_MANY, 'Servicios', 'serv_prog_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'prog_id' => 'Prog',
			'prog_cli_id' => 'Cliente',
			'prog_nombre' => 'Nombre',
			'prog_descripcion' => 'Descripción',
			'prog_habilitado' => 'Habilitado',
			'prog_fechacreado' => 'Fecha creado',
			'prog_creadopor' => 'Creado por',
			'prog_fechamodificado' => 'Fecha modificado',
			'prog_modificadopor' => 'Modificado por',
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

		$criteria->with = array('progCli');
        $criteria->compare('progCli.cli_nombre', Yii::app()->request->getParam('progCli_cli_nombre'), true);

		$criteria->compare('prog_id',$this->prog_id);
		$criteria->compare('prog_cli_id',$this->prog_cli_id);
		$criteria->compare('prog_nombre',$this->prog_nombre,true);
		$criteria->compare('prog_descripcion',$this->prog_descripcion,true);
		$criteria->compare('prog_habilitado',$this->prog_habilitado,true);
		$criteria->compare('prog_fechacreado',$this->prog_fechacreado,true);
		$criteria->compare('prog_creadopor',$this->prog_creadopor);
		$criteria->compare('prog_fechamodificado',$this->prog_fechamodificado,true);
		$criteria->compare('prog_modificadopor',$this->prog_modificadopor);

		$sort = new CSort();
        $sort->attributes = array(
            'tableA.name' => array(
                'asc' => 'progCli.cli_nombre ASC',
                'desc' => 'progCli.cli_nombre DESC'
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
	 * @return Programas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
