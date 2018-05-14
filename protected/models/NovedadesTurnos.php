<?php

/**
 * This is the model class for table "novedades_turnos".
 *
 * The followings are the available columns in table 'novedades_turnos':
 * @property integer $novtur_id
 * @property integer $novtur_tur_id
 * @property integer $novtur_nov_id
 * @property string $novtur_fecha
 * @property string $novtur_horaInicio
 * @property string $novtur_horaFin
 * @property string $novtur_observaciones
 * @property string $novtur_fechacreado
 * @property integer $novtur_creadopor
 * @property string $novtur_fechamodificado
 * @property integer $novtur_modificadopor
 */
class NovedadesTurnos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'novedades_turnos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('novtur_tur_id, novtur_nov_id, novtur_fecha, novtur_horaInicio, novtur_horaFin, novtur_observaciones, novtur_creadopor, novtur_modificadopor', 'required'),
			array('novtur_tur_id, novtur_nov_id, novtur_creadopor, novtur_modificadopor', 'numerical', 'integerOnly'=>true),
			array('novtur_fechacreado, novtur_fechamodificado', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('novtur_id, novtur_tur_id, novtur_nov_id, novtur_fecha, novtur_horaInicio, novtur_horaFin, novtur_observaciones, novtur_fechacreado, novtur_creadopor, novtur_fechamodificado, novtur_modificadopor', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'novtur_id' => 'Novtur',
			'novtur_tur_id' => 'Novtur Tur',
			'novtur_nov_id' => 'Novtur Nov',
			'novtur_fecha' => 'Novtur Fecha',
			'novtur_horaInicio' => 'Novtur Hora Inicio',
			'novtur_horaFin' => 'Novtur Hora Fin',
			'novtur_observaciones' => 'Novtur Observaciones',
			'novtur_fechacreado' => 'Novtur Fechacreado',
			'novtur_creadopor' => 'Novtur Creadopor',
			'novtur_fechamodificado' => 'Novtur Fechamodificado',
			'novtur_modificadopor' => 'Novtur Modificadopor',
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

		$criteria->compare('novtur_id',$this->novtur_id);
		$criteria->compare('novtur_tur_id',$this->novtur_tur_id);
		$criteria->compare('novtur_nov_id',$this->novtur_nov_id);
		$criteria->compare('novtur_fecha',$this->novtur_fecha,true);
		$criteria->compare('novtur_horaInicio',$this->novtur_horaInicio,true);
		$criteria->compare('novtur_horaFin',$this->novtur_horaFin,true);
		$criteria->compare('novtur_observaciones',$this->novtur_observaciones,true);
		$criteria->compare('novtur_fechacreado',$this->novtur_fechacreado,true);
		$criteria->compare('novtur_creadopor',$this->novtur_creadopor);
		$criteria->compare('novtur_fechamodificado',$this->novtur_fechamodificado,true);
		$criteria->compare('novtur_modificadopor',$this->novtur_modificadopor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NovedadesTurnos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
