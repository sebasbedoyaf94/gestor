<?php

/**
 * This is the model class for table "carga".
 *
 * The followings are the available columns in table 'carga':
 * @property integer $carga_id
 * @property string $carga_nombre_archivo
 * @property string $carga_ruta_archivo
 * @property integer $carga_proy_id
 * @property string $carga_fase
 * @property string $carga_descripcion
 * @property integer $carga_creadopor
 * @property string $carga_fechacreado
 * @property integer $carga_modificadopor
 * @property string $carga_fechamodificado
 *
 * The followings are the available model relations:
 * @property Proyectos $cargaProy
 * @property Usuarios $cargaCreadopor
 * @property Usuarios $cargaModificadopor
 */
class Carga extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'carga';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('carga_nombre_archivo, carga_ruta_archivo, carga_proy_id, carga_fase, carga_descripcion, carga_creadopor, carga_fechacreado, carga_modificadopor, carga_fechamodificado', 'required'),
			array('carga_id, carga_proy_id, carga_creadopor, carga_modificadopor', 'numerical', 'integerOnly'=>true),
			array('carga_nombre_archivo, carga_ruta_archivo, carga_descripcion', 'length', 'max'=>255),
			array('carga_fase', 'length', 'max'=>50),
			array('carga_nombre_archivo','file','types'=>'jpg, png, xls, xlsx, doc, docx, pdf'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('carga_id, carga_nombre_archivo, carga_ruta_archivo, carga_proy_id, carga_fase, carga_descripcion, carga_creadopor, carga_fechacreado, carga_modificadopor, carga_fechamodificado', 'safe', 'on'=>'search'),
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
			'cargaProy' => array(self::BELONGS_TO, 'Proyectos', 'carga_proy_id'),
			'cargaCreadopor' => array(self::BELONGS_TO, 'Usuarios', 'carga_creadopor'),
			'cargaModificadopor' => array(self::BELONGS_TO, 'Usuarios', 'carga_modificadopor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'carga_id' => 'Carga',
			'carga_nombre_archivo' => 'Archivo',
			'carga_ruta_archivo' => 'Ruta Archivo',
			'carga_proy_id' => 'Proyecto',
			'carga_fase' => 'Fase',
			'carga_descripcion' => 'Descripción',
			'carga_creadopor' => 'Creado por',
			'carga_fechacreado' => 'Fecha creación',
			'carga_modificadopor' => 'Modificado por',
			'carga_fechamodificado' => 'Fecha modificación',
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

		$criteria->compare('carga_id',$this->carga_id);
		$criteria->compare('carga_nombre_archivo',$this->carga_nombre_archivo,true);
		$criteria->compare('carga_ruta_archivo',$this->carga_ruta_archivo,true);
		$criteria->compare('carga_proy_id',$this->carga_proy_id);
		$criteria->compare('carga_fase',$this->carga_fase,true);
		$criteria->compare('carga_descripcion',$this->carga_descripcion,true);
		$criteria->compare('carga_creadopor',$this->carga_creadopor);
		$criteria->compare('carga_fechacreado',$this->carga_fechacreado,true);
		$criteria->compare('carga_modificadopor',$this->carga_modificadopor);
		$criteria->compare('carga_fechamodificado',$this->carga_fechamodificado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Carga the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
