<?php

/**
 * This is the model class for table "modulos_acciones".
 *
 * The followings are the available columns in table 'modulos_acciones':
 * @property integer $modac_id
 * @property integer $modac_modu_id
 * @property string $modac_nombre
 *
 * The followings are the available model relations:
 * @property Modulos $modacModu
 * @property RolesModulosAcciones[] $rolesModulosAcciones
 */
class ModulosAcciones extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'modulos_acciones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('modac_modu_id', 'numerical', 'integerOnly'=>true),
			array('modac_nombre', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('modac_id, modac_modu_id, modac_nombre', 'safe', 'on'=>'search'),
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
			'modacModu' => array(self::BELONGS_TO, 'Modulos', 'modac_modu_id'),
			'rolesModulosAcciones' => array(self::HAS_MANY, 'RolesModulosAcciones', 'rolmodac_modac_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'modac_id' => 'Modac',
			'modac_modu_id' => 'Modulo',
			'modac_nombre' => 'Nombre',
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

		$criteria->compare('modac_id',$this->modac_id);
		$criteria->compare('modac_modu_id',$this->modac_modu_id);
		$criteria->compare('modac_nombre',$this->modac_nombre,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ModulosAcciones the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
