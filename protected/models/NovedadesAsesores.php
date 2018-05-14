<?php

/**
 * This is the model class for table "novedades_asesores".
 *
 * The followings are the available columns in table 'novedades_asesores':
 * @property integer $novase_id
 * @property integer $novase_ase_id
 * @property integer $novase_nov_id
 * @property string $novase_fecha
 * @property string $novase_horaInicio
 * @property string $novase_horaFin
 * @property string $novase_observaciones
 * @property string $novase_fechacreado
 * @property integer $novase_creadopor
 * @property string $novase_fechamodificado
 * @property integer $novase_modificadopor
 *
 * The followings are the available model relations:
 * @property Usuarios $novaseCreadopor
 * @property Usuarios $novaseModificadopor
 * @property Asesores $novaseAse
 * @property Novedades $novaseNov
 */
class NovedadesAsesores extends CActiveRecord
{
	public $full_name;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'novedades_asesores';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('novase_ase_id, novase_nov_id, novase_fecha, novase_horaInicio, novase_horaFin, novase_observaciones, novase_creadopor, novase_modificadopor', 'required'),
			array('novase_ase_id, novase_nov_id, novase_creadopor, novase_modificadopor', 'numerical', 'integerOnly'=>true),
			array('novase_fechacreado, novase_fechamodificado', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('novase_id, novase_ase_id, novase_nov_id, novase_fecha, novase_horaInicio, novase_horaFin, novase_observaciones, novase_fechacreado, novase_creadopor, novase_fechamodificado, novase_modificadopor, full_name', 'safe', 'on'=>'search'),
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
			'novaseCreadopor' => array(self::BELONGS_TO, 'Usuarios', 'novase_creadopor'),
			'novaseModificadopor' => array(self::BELONGS_TO, 'Usuarios', 'novase_modificadopor'),
			'novaseAse' => array(self::BELONGS_TO, 'Asesores', 'novase_ase_id'),
			'novaseNov' => array(self::BELONGS_TO, 'Novedades', 'novase_nov_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'novase_id' => 'Novase',
			'novase_ase_id' => 'Asesor',
			'novase_nov_id' => 'Novedad',
			'novase_fecha' => 'Fecha',
			'novase_horaInicio' => 'Hora Inicio',
			'novase_horaFin' => 'Hora Fin',
			'novase_observaciones' => 'Observaciones',
			'novase_fechacreado' => 'Fecha creado',
			'novase_creadopor' => 'Creado por',
			'novase_fechamodificado' => 'Fecha modificado',
			'novase_modificadopor' => 'Modificado por',
			'full_name' => 'Asesor',
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

		$criteria->with = array('novaseAse');
        $criteria->compare('novaseAse.ase_nombre', $this->full_name, true, 'OR');
        $criteria->compare('novaseAse.ase_apellidos', $this->full_name, true, 'OR');

		$criteria->compare('novase_id',$this->novase_id);
		$criteria->compare('novase_ase_id',$this->novase_ase_id);
		$criteria->compare('novase_nov_id',$this->novase_nov_id);
		$criteria->compare('novase_fecha',$this->novase_fecha,true);
		$criteria->compare('novase_horaInicio',$this->novase_horaInicio,true);
		$criteria->compare('novase_horaFin',$this->novase_horaFin,true);
		$criteria->compare('novase_observaciones',$this->novase_observaciones,true);
		$criteria->compare('novase_fechacreado',$this->novase_fechacreado,true);
		$criteria->compare('novase_creadopor',$this->novase_creadopor);
		$criteria->compare('novase_fechamodificado',$this->novase_fechamodificado,true);
		$criteria->compare('novase_modificadopor',$this->novase_modificadopor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
		        'attributes'=>array(
		            'full_name'=>array(
		                'asc'=>'novaseAse.ase_nombre ASC',
		                'desc'=>'novaseAse.ase_nombre DESC',
		            ),
		            '*',
		        ),
		    ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NovedadesAsesores the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
