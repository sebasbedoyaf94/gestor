<?php

/**
 * This is the model class for table "checklist".
 *
 * The followings are the available columns in table 'checklist':
 * @property integer $check_id
 * @property integer $check_proy_id
 * @property string $check_url_pruebas
 * @property string $check_ruta_doc_funcional
 * @property string $check_ruta_doc_tecnica
 * @property string $check_observaciones
 * @property string $check_usuario_pruebas
 * @property string $check_contrasena_pruebas
 * @property integer $check_creadopor
 * @property string $check_fechacreado
 * @property integer $check_modificadopor
 * @property string $check_fechamodificado
 *
 * The followings are the available model relations:
 * @property Usuarios $checkCreadopor
 * @property Usuarios $checkModificadopor
 * @property Proyectos $checkProy
 */
class Checklist extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'checklist';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('check_url_pruebas, check_ruta_doc_funcional, check_ruta_doc_tecnica, check_usuario_pruebas, check_contrasena_pruebas, check_creadopor, check_fechacreado, check_modificadopor, check_fechamodificado', 'required'),
			array('check_proy_id, check_creadopor, check_modificadopor', 'numerical', 'integerOnly'=>true),
			array('check_url_pruebas, check_ruta_doc_funcional, check_ruta_doc_tecnica, check_observaciones, check_usuario_pruebas, check_contrasena_pruebas', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('check_id, check_proy_id, check_url_pruebas, check_ruta_doc_funcional, check_ruta_doc_tecnica, check_observaciones, check_usuario_pruebas, check_contrasena_pruebas, check_creadopor, check_fechacreado, check_modificadopor, check_fechamodificado', 'safe', 'on'=>'search'),
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
			'checkCreadopor' => array(self::BELONGS_TO, 'Usuarios', 'check_creadopor'),
			'checkModificadopor' => array(self::BELONGS_TO, 'Usuarios', 'check_modificadopor'),
			'checkProy' => array(self::BELONGS_TO, 'Proyectos', 'check_proy_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'check_id' => 'Check',
			'check_proy_id' => 'Proyecto',
			'check_url_pruebas' => 'Url Pruebas',
			'check_ruta_doc_funcional' => 'Ruta Documentación Funcional',
			'check_ruta_doc_tecnica' => 'Ruta Documentación Técnica',
			'check_observaciones' => 'Observaciones',
			'check_usuario_pruebas' => 'Usuario Pruebas',
			'check_contrasena_pruebas' => 'Contraseña Pruebas',
			'check_creadopor' => 'Creado por',
			'check_fechacreado' => 'Fecha Creación',
			'check_modificadopor' => 'Modificado por',
			'check_fechamodificado' => 'Fecha Modificación',
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

		$criteria->compare('check_id',$this->check_id);
		$criteria->compare('check_proy_id',$this->check_proy_id);
		$criteria->compare('check_url_pruebas',$this->check_url_pruebas,true);
		$criteria->compare('check_ruta_doc_funcional',$this->check_ruta_doc_funcional,true);
		$criteria->compare('check_ruta_doc_tecnica',$this->check_ruta_doc_tecnica,true);
		$criteria->compare('check_observaciones',$this->check_observaciones,true);
		$criteria->compare('check_usuario_pruebas',$this->check_usuario_pruebas,true);
		$criteria->compare('check_contrasena_pruebas',$this->check_contrasena_pruebas,true);
		$criteria->compare('check_creadopor',$this->check_creadopor);
		$criteria->compare('check_fechacreado',$this->check_fechacreado,true);
		$criteria->compare('check_modificadopor',$this->check_modificadopor);
		$criteria->compare('check_fechamodificado',$this->check_fechamodificado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Checklist the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
