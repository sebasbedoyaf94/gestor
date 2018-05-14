<?php

/**
 * This is the model class for table "roles".
 *
 * The followings are the available columns in table 'roles':
 * @property integer $rol_id
 * @property string $rol_nombre
 * @property string $rol_descripcion
 * @property string $rol_habilitado
 * @property string $rol_fechacreado
 * @property integer $rol_creadopor
 * @property string $rol_fechamodificado
 * @property integer $rol_modificadopor
 *
 * The followings are the available model relations:
 * @property Usuarios $rolCreadopor
 * @property Usuarios $rolModificadopor
 * @property RolesModulosAcciones[] $rolesModulosAcciones
 * @property Usuarios[] $usuarioses
 */
class Roles extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'roles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rol_nombre, rol_descripcion, rol_creadopor, rol_modificadopor', 'required'),
			array('rol_creadopor, rol_modificadopor', 'numerical', 'integerOnly'=>true),
			array('rol_nombre', 'length', 'max'=>50),
			array('rol_nombre', 'unique'),
			array('rol_habilitado', 'length', 'max'=>2),
			array('rol_fechacreado, rol_fechamodificado', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('rol_id, rol_nombre, rol_descripcion, rol_habilitado, rol_fechacreado, rol_creadopor, rol_fechamodificado, rol_modificadopor', 'safe', 'on'=>'search'),
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
			'rolCreadopor' => array(self::BELONGS_TO, 'Usuarios', 'rol_creadopor'),
			'rolModificadopor' => array(self::BELONGS_TO, 'Usuarios', 'rol_modificadopor'),
			'rolesModulosAcciones' => array(self::HAS_MANY, 'RolesModulosAcciones', 'rolmodac_rol_id'),
			'usuarioses' => array(self::HAS_MANY, 'Usuarios', 'usua_rol_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rol_id' => 'Rol',
			'rol_nombre' => 'Nombre',
			'rol_habilitado' => 'Habilitado',
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

		$criteria->compare('rol_id',$this->rol_id);
		$criteria->compare('rol_nombre',$this->rol_nombre,true);
		$criteria->compare('rol_habilitado',$this->rol_habilitado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Roles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
