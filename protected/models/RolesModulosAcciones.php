<?php

/**
 * This is the model class for table "roles_modulos_acciones".
 *
 * The followings are the available columns in table 'roles_modulos_acciones':
 * @property integer $rolmodac_id
 * @property integer $rolmodac_rol_id
 * @property integer $rolmodac_modac_id
 *
 * The followings are the available model relations:
 * @property ModulosAcciones $rolmodacModac
 * @property Roles $rolmodacRol
 */
class RolesModulosAcciones extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'roles_modulos_acciones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rolmodac_rol_id, rolmodac_modac_id', 'required'),
			array('rolmodac_rol_id, rolmodac_modac_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('rolmodac_id, rolmodac_rol_id, rolmodac_modac_id', 'safe', 'on'=>'search'),
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
			'rolmodacModac' => array(self::BELONGS_TO, 'ModulosAcciones', 'rolmodac_modac_id'),
			'rolmodacRol' => array(self::BELONGS_TO, 'Roles', 'rolmodac_rol_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rolmodac_id' => 'Rolmodac',
			'rolmodac_rol_id' => 'Rolmodac Rol',
			'rolmodac_modac_id' => 'Rolmodac Modac',
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

		$criteria->compare('rolmodac_id',$this->rolmodac_id);
		$criteria->compare('rolmodac_rol_id',$this->rolmodac_rol_id);
		$criteria->compare('rolmodac_modac_id',$this->rolmodac_modac_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RolesModulosAcciones the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
