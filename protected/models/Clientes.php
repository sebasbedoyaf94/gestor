<?php

/**
 * This is the model class for table "clientes".
 *
 * The followings are the available columns in table 'clientes':
 * @property integer $cli_id
 * @property string $cli_nombre
 * @property string $cli_habilitado
 *
 * The followings are the available model relations:
 * @property Programas[] $programases
 * @property Proyectos[] $proyectoses
 */
class Clientes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'clientes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cli_nombre', 'required'),
			array('cli_nombre', 'length', 'max'=>50),
			array('cli_habilitado', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cli_id, cli_nombre, cli_habilitado', 'safe', 'on'=>'search'),
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
			'programases' => array(self::HAS_MANY, 'Programas', 'prog_cli_id'),
			'proyectoses' => array(self::HAS_MANY, 'Proyectos', 'proy_cli_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cli_id' => 'Cli',
			'cli_nombre' => 'Nombre',
			'cli_habilitado' => 'Habilitado',
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

		$criteria->compare('cli_id',$this->cli_id);
		$criteria->compare('cli_nombre',$this->cli_nombre,true);
		$criteria->compare('cli_habilitado',$this->cli_habilitado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Clientes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
