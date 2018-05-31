<?php

/**
 * This is the model class for table "reportes".
 *
 * The followings are the available columns in table 'reportes':
 * @property integer $rep_id
 * @property string $rep_fechaInicio
 * @property string $rep_fechaFin
 * @property string $rep_fase
 * @property integer $rep_proy_id
 * @property integer $rep_tipo
 *
 * The followings are the available model relations:
 * @property Proyectos $repProy
 */
class Reportes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reportes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rep_id, rep_fechaInicio, rep_fechaFin, rep_fase, rep_proy_id, rep_tipo', 'required'),
			array('rep_id, rep_proy_id, rep_tipo', 'numerical', 'integerOnly'=>true),
			array('rep_fase', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('rep_id, rep_fechaInicio, rep_fechaFin, rep_fase, rep_proy_id, rep_tipo', 'safe', 'on'=>'search'),
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
			'repProy' => array(self::BELONGS_TO, 'Proyectos', 'rep_proy_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rep_id' => 'Rep',
			'rep_fechaInicio' => 'Fecha Inicio',
			'rep_fechaFin' => 'Fecha Fin',
			'rep_fase' => 'Fase',
			'rep_proy_id' => 'Proyecto',
			'rep_tipo' => 'Tipo Reporte',
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

		$criteria->compare('rep_id',$this->rep_id);
		$criteria->compare('rep_fechaInicio',$this->rep_fechaInicio,true);
		$criteria->compare('rep_fechaFin',$this->rep_fechaFin,true);
		$criteria->compare('rep_fase',$this->rep_fase,true);
		$criteria->compare('rep_proy_id',$this->rep_proy_id);
		$criteria->compare('rep_tipo',$this->rep_tipo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Reportes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
