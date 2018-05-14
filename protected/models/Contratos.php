<?php

/**
 * This is the model class for table "contratos".
 *
 * The followings are the available columns in table 'contratos':
 * @property integer $cont_id
 * @property integer $cont_total_horas_semana
 * @property integer $cont_min_horas_dia
 * @property integer $cont_max_horas_dia
 * @property string $cont_habilitado
 * @property string $cont_fechacreado
 * @property integer $cont_creadopor
 * @property integer $cont_modificadopor
 * @property string $cont_fechamodificado
 *
 * The followings are the available model relations:
 * @property Asesores[] $asesores
 * @property Usuarios $contCreadopor
 * @property Usuarios $contModificadopor
 */
class Contratos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contratos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cont_total_horas_semana, cont_min_horas_dia, cont_max_horas_dia, cont_creadopor, cont_modificadopor', 'required'),
			array('cont_total_horas_semana, cont_min_horas_dia, cont_max_horas_dia, cont_creadopor, cont_modificadopor', 'numerical', 'integerOnly'=>true),
			array('cont_habilitado', 'length', 'max'=>2),
			array('cont_fechacreado, cont_fechamodificado', 'safe'),
			
			array('cont_total_horas_semana', 'unique'),
			array('cont_total_horas_semana, cont_min_horas_dia, cont_max_horas_dia', 'validarCantidadHoras','on'=>'insert, update'),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cont_id, cont_total_horas_semana, cont_min_horas_dia, cont_max_horas_dia, cont_habilitado, cont_fechacreado, cont_creadopor, cont_modificadopor, cont_fechamodificado', 'safe', 'on'=>'search'),
		);
	}

	function validarCantidadHoras($attribute, $params)
	{
		
		$minHorasDia = 4;
		$maxHorasDia = 10;
		$maxHorasSemana = $maxHorasDia * 7;
		$minHorasSemana = $minHorasDia * 7;


		//VALIDACIONES MIN HORAS DIA
		if (($this->cont_min_horas_dia < $minHorasDia) AND ($attribute=='cont_min_horas_dia')) //regla del negocio
		{
			$mensaje = "No puede ser inferior a $minHorasDia horas.";
			$this->addError('cont_min_horas_dia',$mensaje);
		}
		
		if (($this->cont_min_horas_dia > $this->cont_max_horas_dia) AND ($attribute=='cont_min_horas_dia'))//validacion logica
		{
			$mensaje = "No puede ser superior a ".$this->cont_max_horas_dia." horas.";
			$this->addError('cont_min_horas_dia',$mensaje);
		}

		if ($this->cont_min_horas_dia > $this->cont_total_horas_semana) //validacion logica
		{
			$mensaje = "No puede ser superior al valor del campo <b>".$this->getAttributeLabel('cont_total_horas_semana')."</b>";
			$this->addError('cont_min_horas_dia',$mensaje);
		}


		//VALIDACIONES MAX HORAS DIA
		if (($this->cont_max_horas_dia > $maxHorasDia ) AND ($attribute=='cont_max_horas_dia'))//regla del negocio
		{
			$mensaje = "No puede ser superior a $maxHorasDia horas.";
			$this->addError('cont_max_horas_dia',$mensaje);
		}

		if (( $this->cont_max_horas_dia < $this->cont_min_horas_dia) AND ($attribute=='cont_max_horas_dia')) //validacion logica
		{
			$mensaje = "No puede ser inferior a ".$this->cont_min_horas_dia." horas.";
			$this->addError('cont_max_horas_dia',$mensaje);
		}

		//VALIDACIONES TOTAL HORAS SEMANA
		if (($this->cont_total_horas_semana > $maxHorasSemana ) AND ($attribute=='cont_total_horas_semana'))//regla del negocio
		{
			$mensaje = "No puede ser superior a $maxHorasSemana horas.";
			$this->addError('cont_total_horas_semana',$mensaje);
		}

		if (($this->cont_total_horas_semana < $minHorasSemana) AND ($attribute=='cont_total_horas_semana'))// regla del negocio
		{
			$mensaje = "No puede ser inferior a $minHorasSemana horas.";
			$this->addError('cont_total_horas_semana',$mensaje);
		}
	}

	

	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'asesores' => array(self::HAS_MANY, 'Asesores', 'ase_cont_id'),
			'contCreadopor' => array(self::BELONGS_TO, 'Usuarios', 'cont_creadopor'),
			'contModificadopor' => array(self::BELONGS_TO, 'Usuarios', 'cont_modificadopor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cont_id' => 'Cont',
			'cont_total_horas_semana' => 'Total Horas x Semana',
			'cont_min_horas_dia' => 'Minimo Horas x Dia',
			'cont_max_horas_dia' => 'Maximo Horas x Dia',
			'cont_habilitado' => 'Habilitado',
			'cont_fechacreado' => 'Fecha creado',
			'cont_creadopor' => 'Creado por',
			'cont_modificadopor' => 'Modificado por',
			'cont_fechamodificado' => 'Fecha modificado',
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

		$criteria->compare('cont_id',$this->cont_id);
		$criteria->compare('cont_total_horas_semana',$this->cont_total_horas_semana);
		$criteria->compare('cont_min_horas_dia',$this->cont_min_horas_dia);
		$criteria->compare('cont_max_horas_dia',$this->cont_max_horas_dia);
		$criteria->compare('cont_habilitado',$this->cont_habilitado,true);
		$criteria->compare('cont_fechacreado',$this->cont_fechacreado,true);
		$criteria->compare('cont_creadopor',$this->cont_creadopor);
		$criteria->compare('cont_modificadopor',$this->cont_modificadopor);
		$criteria->compare('cont_fechamodificado',$this->cont_fechamodificado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Contratos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
