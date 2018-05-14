<?php

/**
 * This is the model class for table "novedades".
 *
 * The followings are the available columns in table 'novedades':
 * @property integer $nov_id
 * @property string $nov_nombre
 * @property string $nov_abreviatura
 * @property string $nov_descripcion
 * @property string $nov_paga
 * @property string $nov_habilitado
 * @property string $nov_fechacreado
 * @property integer $nov_creadopor
 * @property string $nov_fechamodificado
 * @property integer $nov_modificadopor
 *
 * The followings are the available model relations:
 * @property Usuarios $novCreadopor
 * @property Usuarios $novModificadopor
 * @property NovedadesAsesores[] $novedadesAsesores
 * @property TurnosNovedades[] $turnosNovedades
 */
class Novedades extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'novedades';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nov_nombre, nov_descripcion, nov_creadopor, nov_modificadopor, nov_abreviatura', 'required'),
			array('nov_creadopor, nov_modificadopor', 'numerical', 'integerOnly'=>true),
			array('nov_nombre', 'length', 'max'=>50),
			array('nov_abreviatura', 'length', 'max'=>5),
			array('nov_paga, nov_habilitado', 'length', 'max'=>2),
			array('nov_fechacreado, nov_fechamodificado', 'safe'),
			array('nov_nombre, nov_abreviatura', 'unique'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('nov_id, nov_nombre, nov_abreviatura, nov_descripcion, nov_paga, nov_habilitado, nov_fechacreado, nov_creadopor, nov_fechamodificado, nov_modificadopor', 'safe', 'on'=>'search'),
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
			'novCreadopor' => array(self::BELONGS_TO, 'Usuarios', 'nov_creadopor'),
			'novModificadopor' => array(self::BELONGS_TO, 'Usuarios', 'nov_modificadopor'),
			'novedadesAsesores' => array(self::HAS_MANY, 'NovedadesAsesores', 'novase_nov_id'),
			'turnosNovedades' => array(self::HAS_MANY, 'TurnosNovedades', 'turnov_nov_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'nov_id' => 'Nov',
			'nov_nombre' => 'Nombre',
			'nov_abreviatura' => 'Abreviatura',
			'nov_descripcion' => 'Descripción',
			'nov_paga' => 'Paga',
			'nov_habilitado' => 'Habilitado',
			'nov_fechacreado' => 'Fecha creado',
			'nov_creadopor' => 'Creado por',
			'nov_fechamodificado' => 'Fecha modificado',
			'nov_modificadopor' => 'Modificado por',
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

		$criteria->compare('nov_id',$this->nov_id);
		$criteria->compare('nov_nombre',$this->nov_nombre,true);
		$criteria->compare('nov_abreviatura',$this->nov_abreviatura,true);
		$criteria->compare('nov_descripcion',$this->nov_descripcion,true);
		$criteria->compare('nov_paga',$this->nov_paga,true);
		$criteria->compare('nov_habilitado',$this->nov_habilitado,true);
		$criteria->compare('nov_fechacreado',$this->nov_fechacreado,true);
		$criteria->compare('nov_creadopor',$this->nov_creadopor);
		$criteria->compare('nov_fechamodificado',$this->nov_fechamodificado,true);
		$criteria->compare('nov_modificadopor',$this->nov_modificadopor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Novedades the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
