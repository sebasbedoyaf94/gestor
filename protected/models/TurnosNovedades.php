<?php

/**
 * This is the model class for table "turnos_novedades".
 *
 * The followings are the available columns in table 'turnos_novedades':
 * @property integer $turnov_id
 * @property integer $turnov_tur_id
 * @property integer $turnov_nov_id
 * @property string $turnov_dia
 * @property string $turnov_horaInicio
 * @property string $turnov_horaFin
 *
 * The followings are the available model relations:
 * @property Turnos $turnovTur
 * @property Novedades $turnovNov
 */
class TurnosNovedades extends CActiveRecord
{
	public $full_turno;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'turnos_novedades';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('turnov_tur_id, turnov_nov_id, turnov_dia, turnov_horaInicio, turnov_horaFin', 'required'),
			array('turnov_tur_id, turnov_nov_id', 'numerical', 'integerOnly'=>true),
			array('turnov_dia', 'length', 'max'=>9),
			array('turnov_horaInicio, turnov_horaFin', 'validarRangoHorasNovedad'),
			array('turnov_tur_id, turnov_nov_id, turnov_dia, turnov_horaInicio, turnov_horaFin', 'validarRelacionTurnoNovedad'),
			array('turnov_tur_id, turnov_nov_id, turnov_dia, turnov_horaInicio, turnov_horaFin', 'validarNovedadEnTurno'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('turnov_id, turnov_tur_id, turnov_nov_id, turnov_dia, turnov_horaInicio, turnov_horaFin, full_turno', 'safe', 'on'=>'search'),
		);
	}

	function validarRangoHorasNovedad($attribute, $param)
	{
		$horaInicioNov = $this->turnov_horaInicio;
		$horaFinNov = $this->turnov_horaFin;

		$bandera = $this->hourDifference($horaFinNov, $horaInicioNov);

		if(($bandera==0) AND ($attribute=='turnov_horaFin')) 
		{
			$mensaje = "<b>La hora fin de la novedad no puede ser inferior a la hora inicio</b>.";
			$this->addError('turnov_horaFin',$mensaje);
		}
	}

	function hourDifference($date_1, $date_2)
	{
	    $datetime1 = date_create($date_1);
	    $datetime2 = date_create($date_2);
	    
	    $interval = date_diff($datetime1, $datetime2);
	    
	    if ($interval->invert)
	    {
	    	return 1; // Si la hora fin es mayor a la hora inicio
	    }
	    else
	    {
	    	return 0; // Si la hora fin es menor a la hora inicio 
	    }	     
	}

	function validarRelacionTurnoNovedad($attribute, $param)
	{
		$tur_id = $this->turnov_tur_id;
		$nov_id = $this->turnov_nov_id;
		$dia = $this->turnov_dia;
		$horaInicio = $this->turnov_horaInicio;
		$horaFin = $this->turnov_horaFin;

		$criteria=new CDbCriteria;
		$criteria->select = "turnov_id";
		$criteria->condition = "turnov_tur_id='$tur_id' AND turnov_nov_id='$nov_id' AND turnov_dia='$dia' AND turnov_horaInicio='$horaInicio' AND turnov_horaFin='$horaFin'";
		$turnov_id = TurnosNovedades::model()->find($criteria);

		if($turnov_id)
		{
			$mensaje = "<b>El turno ya tiene registrada dicha novedad</b>.";
			$this->addError('turnov_tur_id',$mensaje);
		}
	}

	function validarNovedadEnTurno($attribute, $param)
	{
		$tur_id = $this->turnov_tur_id;
		$dia = $this->turnov_dia;
		$horaInicio = $this->turnov_horaInicio;
		$horaFin = $this->turnov_horaFin;

		$criteria=new CDbCriteria;
		if($dia == 'Lunes')
		{
			$criteria->select = "tur_horaInicioLunes, tur_horaFinLunes";
		}
		else
		{
			if($dia == 'Martes')
			{
				$criteria->select = "tur_horaInicioMartes, tur_horaFinMartes";
			}
			else
			{
				if($dia == 'Miercoles')
				{
					$criteria->select = "tur_horaInicioMiercoles, tur_horaFinMiercoles";
				}
				else
				{
					if($dia == 'Jueves')
					{
						$criteria->select = "tur_horaInicioJueves, tur_horaFinJueves";
					}
					else
					{
						if($dia == 'Viernes')
						{
						    $criteria->select = "tur_horaInicioViernes, tur_horaFinViernes";
						}
						else
						{
							if($dia == 'Sabado')
							{
								$criteria->select = "tur_horaInicioSabado, tur_horaFinSabado";
							}
							else
							{
								if($dia == 'Domingo')
								{
									$criteria->select = "tur_horaInicioDomingo, tur_horaFinDomingo";
								}
							}
						}
					}
				}
			}
		}

		$criteria->condition = "tur_id='$tur_id'";
		$horas_turno = Turnos::model()->find($criteria);

		//VALIDACION DIA LUNES
		if((($horas_turno['tur_horaInicioLunes'] > $horaInicio) || ($horas_turno['tur_horaFinLunes'] < $horaFin)) and ($dia == 'Lunes'))
		{
			$mensaje = "<b>El horario de la novedad debe estar dentro del horario del turno del dia Lunes </b>.";
			$this->addError('turnov_tur_id',$mensaje);
		}

		//VALIDACION DIA MARTES		
		if((($horas_turno['tur_horaInicioMartes'] > $horaInicio) || ($horas_turno['tur_horaFinMartes'] < $horaFin)) and ($dia == 'Martes'))
		{
			$mensaje = "<b>El horario de la novedad debe estar dentro del horario del turno del dia Martes </b>.";
			$this->addError('turnov_tur_id',$mensaje);
		}

		//VALIDACION DIA MIERCOLES
		if((($horas_turno['tur_horaInicioMiercoles'] > $horaInicio) || ($horas_turno['tur_horaFinMiercoles'] < $horaFin)) and ($dia == 'Miercoles'))
		{
			$mensaje = "<b>El horario de la novedad debe estar dentro del horario del turno del dia Miercoles </b>.";
			$this->addError('turnov_tur_id',$mensaje);
		}

		//VALIDACION DIA JUEVES
		if((($horas_turno['tur_horaInicioJueves'] > $horaInicio) || ($horas_turno['tur_horaFinJueves'] < $horaFin)) and ($dia == 'Jueves'))
		{
			$mensaje = "<b>El horario de la novedad debe estar dentro del horario del turno del dia Jueves </b>.";
			$this->addError('turnov_tur_id',$mensaje);
		}

		//VALIDACION DIA VIERNES
		if((($horas_turno['tur_horaInicioViernes'] > $horaInicio) || ($horas_turno['tur_horaFinViernes'] < $horaFin)) and ($dia == 'Viernes'))
		{
			$mensaje = "<b>El horario de la novedad debe estar dentro del horario del turno del dia Viernes </b>.";
			$this->addError('turnov_tur_id',$mensaje);
		}

		//VALIDACION DIA SABADO
		if((($horas_turno['tur_horaInicioSabado'] > $horaInicio) || ($horas_turno['tur_horaFinSabado'] < $horaFin)) and ($dia == 'Sabado'))
		{
			$mensaje = "<b>El horario de la novedad debe estar dentro del horario del turno del dia Sabado </b>.";
			$this->addError('turnov_tur_id',$mensaje);
		}

		//VALIDACION DIA DOMINGO
		if((($horas_turno['tur_horaInicioDomingo'] > $horaInicio) || ($horas_turno['tur_horaFinDomingo'] < $horaFin)) and ($dia == 'Domingo'))
		{
			$mensaje = "<b>El horario de la novedad debe estar dentro del horario del turno del dia Domingo </b>.";
			$this->addError('turnov_tur_id',$mensaje);
		}

		unset($horas_turno);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'turnovTur' => array(self::BELONGS_TO, 'Turnos', 'turnov_tur_id'),
			'turnovNov' => array(self::BELONGS_TO, 'Novedades', 'turnov_nov_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'turnov_id' => 'Turnov',
			'turnov_tur_id' => 'Turno',
			'turnov_nov_id' => 'Novedad',
			'turnov_dia' => 'Dia',
			'turnov_horaInicio' => 'Hora Inicio',
			'turnov_horaFin' => 'Hora Fin',
			'turnov_fecha' => 'Fecha',
			'full_turno' => 'Turno',
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

		$criteria->with = array('turnovTur');
        $criteria->compare('turnovTur.tur_nombre', $this->full_turno, true);

		$criteria->compare('turnov_id',$this->turnov_id);
		$criteria->compare('turnov_tur_id',$this->turnov_tur_id);
		$criteria->compare('turnov_nov_id',$this->turnov_nov_id);
		$criteria->compare('turnov_dia',$this->turnov_dia,true);
		$criteria->compare('turnov_horaInicio',$this->turnov_horaInicio,true);
		$criteria->compare('turnov_horaFin',$this->turnov_horaFin,true);
		$criteria->compare('turnov_fecha',$this->turnov_fecha,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
		        'attributes'=>array(
		            'full_turno'=>array(
		                'asc'=>'turnovTur.tur_nombre ASC',
		                'desc'=>'turnovTur.tur_nombre DESC',
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
	 * @return TurnosNovedades the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
