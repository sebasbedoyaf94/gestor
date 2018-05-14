<?php

/**
 * This is the model class for table "proyectos".
 *
 * The followings are the available columns in table 'proyectos':
 * @property integer $proy_id
 * @property string $proy_nombre
 * @property integer $proy_cli_id
 * @property string $proy_fechaInicio
 * @property string $proy_fechaFin
 * @property integer $proy_creadopor
 * @property string $proy_fechacreado
 * @property integer $proy_modificadopor
 * @property string $proy_fechamodificado
 *
 * The followings are the available model relations:
 * @property Clientes $proyCli
 * @property UsuariosProyectos[] $usuariosProyectoses
 */
class Proyectos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'proyectos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('proy_id, proy_nombre, proy_cli_id, proy_fechaInicio, proy_fechaFin, proy_creadopor, proy_fechacreado, proy_modificadopor, proy_fechamodificado', 'required'),
			array('proy_id, proy_cli_id, proy_creadopor, proy_modificadopor', 'numerical', 'integerOnly'=>true),
			array('proy_nombre', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('proy_id, proy_nombre, proy_cli_id, proy_fechaInicio, proy_fechaFin, proy_creadopor, proy_fechacreado, proy_modificadopor, proy_fechamodificado', 'safe', 'on'=>'search'),
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
			'proyCli' => array(self::BELONGS_TO, 'Clientes', 'proy_cli_id'),
			'usuariosProyectoses' => array(self::HAS_MANY, 'UsuariosProyectos', 'usuaproy_proy_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'proy_id' => 'Proy',
			'proy_nombre' => 'Proy Nombre',
			'proy_cli_id' => 'Proy Cli',
			'proy_fechaInicio' => 'Proy Fecha Inicio',
			'proy_fechaFin' => 'Proy Fecha Fin',
			'proy_creadopor' => 'Proy Creadopor',
			'proy_fechacreado' => 'Proy Fechacreado',
			'proy_modificadopor' => 'Proy Modificadopor',
			'proy_fechamodificado' => 'Proy Fechamodificado',
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

		$criteria->compare('proy_id',$this->proy_id);
		$criteria->compare('proy_nombre',$this->proy_nombre,true);
		$criteria->compare('proy_cli_id',$this->proy_cli_id);
		$criteria->compare('proy_fechaInicio',$this->proy_fechaInicio,true);
		$criteria->compare('proy_fechaFin',$this->proy_fechaFin,true);
		$criteria->compare('proy_creadopor',$this->proy_creadopor);
		$criteria->compare('proy_fechacreado',$this->proy_fechacreado,true);
		$criteria->compare('proy_modificadopor',$this->proy_modificadopor);
		$criteria->compare('proy_fechamodificado',$this->proy_fechamodificado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Proyectos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
