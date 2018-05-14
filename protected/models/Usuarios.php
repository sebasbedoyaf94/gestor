<?php

/**
 * This is the model class for table "usuarios".
 *
 * The followings are the available columns in table 'usuarios':
 * @property integer $usua_id
 * @property string $usua_nombre
 * @property string $usua_apellidos
 * @property string $usua_usuariored
 * @property integer $usua_rol_id
 * @property string $usua_habilitado
 * @property string $usua_fechacreado
 * @property integer $usua_creadopor
 * @property string $usua_fechamodificado
 * @property integer $usua_modificadopor
 *
 * The followings are the available model relations:
 * @property Asesores[] $asesores
 * @property Asesores[] $asesores1
 * @property Clientes[] $clientes
 * @property Clientes[] $clientes1
 * @property Contratos[] $contratoses
 * @property Contratos[] $contratoses1
 * @property Novedades[] $novedades
 * @property Novedades[] $novedades1
 * @property NovedadesAsesores[] $novedadesAsesores
 * @property NovedadesAsesores[] $novedadesAsesores1
 * @property Programas[] $programases
 * @property Programas[] $programases1
 * @property Roles[] $roles
 * @property Roles[] $roles1
 * @property Servicios $servicios
 * @property TurnosAsesores[] $turnosAsesores
 * @property TurnosAsesores[] $turnosAsesores1
 * @property Roles $usuaRol
 * @property Usuarios $usuaCreadopor
 * @property Usuarios[] $usuarioses
 * @property Usuarios $usuaModificadopor
 * @property Usuarios[] $usuarioses1
 * @property UsuariosServicios[] $usuariosServicioses
 */
class Usuarios extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuarios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('usua_nombre, usua_apellidos, usua_usuariored, usua_rol_id, usua_creadopor, usua_modificadopor', 'required'),
			array('usua_rol_id, usua_creadopor, usua_modificadopor', 'numerical', 'integerOnly'=>true),
			array('usua_nombre, usua_apellidos, usua_usuariored', 'length', 'max'=>50),
			array('usua_habilitado', 'length', 'max'=>2),
			array('usua_fechacreado, usua_fechamodificado', 'safe'),
			array('usua_usuariored', 'unique'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('usua_id, usua_nombre, usua_apellidos, usua_usuariored, usua_rol_id, usua_habilitado, usua_fechacreado, usua_creadopor, usua_fechamodificado, usua_modificadopor', 'safe', 'on'=>'search'),
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
			'asesores' => array(self::HAS_MANY, 'Asesores', 'ase_creadopor'),
			'asesores1' => array(self::HAS_MANY, 'Asesores', 'ase_modificadopor'),
			'clientes' => array(self::HAS_MANY, 'Clientes', 'cli_creadopor'),
			'clientes1' => array(self::HAS_MANY, 'Clientes', 'cli_modificadopor'),
			'contratoses' => array(self::HAS_MANY, 'Contratos', 'cont_creadopor'),
			'contratoses1' => array(self::HAS_MANY, 'Contratos', 'cont_modificadopor'),
			'novedades' => array(self::HAS_MANY, 'Novedades', 'nov_creadopor'),
			'novedades1' => array(self::HAS_MANY, 'Novedades', 'nov_modificadopor'),
			'novedadesAsesores' => array(self::HAS_MANY, 'NovedadesAsesores', 'novase_creadopor'),
			'novedadesAsesores1' => array(self::HAS_MANY, 'NovedadesAsesores', 'novase_modificadopor'),
			'programases' => array(self::HAS_MANY, 'Programas', 'prog_creadopor'),
			'programases1' => array(self::HAS_MANY, 'Programas', 'prog_modificadopor'),
			'roles' => array(self::HAS_MANY, 'Roles', 'rol_creadopor'),
			'roles1' => array(self::HAS_MANY, 'Roles', 'rol_modificadopor'),
			'servicios' => array(self::HAS_ONE, 'Servicios', 'serv_id'),
			'turnosAsesores' => array(self::HAS_MANY, 'TurnosAsesores', 'turase_creadopor'),
			'turnosAsesores1' => array(self::HAS_MANY, 'TurnosAsesores', 'turase_modificadopor'),
			'usuaRol' => array(self::BELONGS_TO, 'Roles', 'usua_rol_id'),
			'usuaCreadopor' => array(self::BELONGS_TO, 'Usuarios', 'usua_creadopor'),
			'usuarioses' => array(self::HAS_MANY, 'Usuarios', 'usua_creadopor'),
			'usuaModificadopor' => array(self::BELONGS_TO, 'Usuarios', 'usua_modificadopor'),
			'usuarioses1' => array(self::HAS_MANY, 'Usuarios', 'usua_modificadopor'),
			'usuariosServicioses' => array(self::HAS_MANY, 'UsuariosServicios', 'usuaserv_usua_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'usua_id' => 'Usua',
			'usua_nombre' => 'Nombre',
			'usua_apellidos' => 'Apellidos',
			'usua_usuariored' => 'Usuario de red',
			'usua_rol_id' => 'Rol',
			'usua_habilitado' => 'Habilitado',
			'usua_fechacreado' => 'Fecha creado',
			'usua_creadopor' => 'Creado por',
			'usua_fechamodificado' => 'Fecha modificado',
			'usua_modificadopor' => 'Modificado por',
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

		$criteria->compare('usua_id',$this->usua_id);
		$criteria->compare('usua_nombre',$this->usua_nombre,true);
		$criteria->compare('usua_apellidos',$this->usua_apellidos,true);
		$criteria->compare('usua_usuariored',$this->usua_usuariored,true);
		$criteria->compare('usua_rol_id',$this->usua_rol_id);
		$criteria->compare('usua_habilitado',$this->usua_habilitado,true);
		$criteria->compare('usua_fechacreado',$this->usua_fechacreado,true);
		$criteria->compare('usua_creadopor',$this->usua_creadopor);
		$criteria->compare('usua_fechamodificado',$this->usua_fechamodificado,true);
		$criteria->compare('usua_modificadopor',$this->usua_modificadopor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuarios the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
