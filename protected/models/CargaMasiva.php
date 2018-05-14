<?php

/**
 * This is the model class for table "turnos".
 *
 * The followings are the available columns in table 'turnos':
 * @property integer $tur_id
 * @property string $tur_nombre
 * @property string $tur_horaInicioLunes
 * @property string $tur_horaFinLunes
 * @property string $tur_horaInicioMartes
 * @property string $tur_horaFinMartes
 * @property string $tur_horaInicioMiercoles
 * @property string $tur_horaFinMiercoles
 * @property string $tur_horaInicioJueves
 * @property string $tur_horaFinJueves
 * @property string $tur_horaInicioViernes
 * @property string $tur_horaFinViernes
 * @property string $tur_horaInicioSabado
 * @property string $tur_horaFinSabado
 * @property string $tur_horaInicioDomingo
 * @property string $tur_horaFinDomingo
 * @property string $tur_habilitado
 * @property string $tur_fechacreado
 * @property integer $tur_creadopor
 * @property string $tur_fechamodificado
 * @property integer $tur_modificadopor
 *
 * The followings are the available model relations:
 * @property Usuarios $turCreadopor
 * @property Usuarios $turModificadopor
 * @property TurnosAsesores[] $turnosAsesores
 * @property TurnosNovedades[] $turnosNovedades
 */
class CargaMasiva extends CActiveRecord
{
	public $image;
	public $oldImage;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'turnos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('tur_nombre_archivo', 'validarExtensionArchivo'),
			array('tur_nombre, tur_creadopor, tur_modificadopor', 'required'),
			array('tur_creadopor, tur_modificadopor', 'numerical', 'integerOnly'=>true),
			array('tur_nombre', 'length', 'max'=>50),
			array('tur_habilitado', 'length', 'max'=>2),
			array('tur_horaInicioLunes, tur_horaFinLunes, tur_horaInicioMartes, tur_horaFinMartes, tur_horaInicioMiercoles, tur_horaFinMiercoles, tur_horaInicioJueves, tur_horaFinJueves, tur_horaInicioViernes, tur_horaFinViernes, tur_horaInicioSabado, tur_horaFinSabado, tur_horaInicioDomingo, tur_horaFinDomingo, tur_fechacreado, tur_fechamodificado', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('tur_id, tur_nombre, tur_horaInicioLunes, tur_horaFinLunes, tur_horaInicioMartes, tur_horaFinMartes, tur_horaInicioMiercoles, tur_horaFinMiercoles, tur_horaInicioJueves, tur_horaFinJueves, tur_horaInicioViernes, tur_horaFinViernes, tur_horaInicioSabado, tur_horaFinSabado, tur_horaInicioDomingo, tur_horaFinDomingo, tur_habilitado, tur_fechacreado, tur_creadopor, tur_fechamodificado, tur_modificadopor, the_file', 'safe', 'on'=>'search'),
		);
	}

	public function validarExtensionArchivo($attribute, $params)
	{
		$nombre_archivo = $this->tur_nombre_archivo;
		echo $nombre_archivo;die;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'turCreadopor' => array(self::BELONGS_TO, 'Usuarios', 'tur_creadopor'),
			'turModificadopor' => array(self::BELONGS_TO, 'Usuarios', 'tur_modificadopor'),
			'turnosAsesores' => array(self::HAS_MANY, 'TurnosAsesores', 'turase_tur_id'),
			'turnosNovedades' => array(self::HAS_MANY, 'TurnosNovedades', 'turnov_tur_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'tur_id' => 'Turno',
			'tur_nombre' => 'Nombre',
			'tur_horaInicioLunes' => 'Hora Inicio Lunes',
			'tur_horaFinLunes' => 'Hora Fin Lunes',
			'tur_horaInicioMartes' => 'Hora Inicio Martes',
			'tur_horaFinMartes' => 'Hora Fin Martes',
			'tur_horaInicioMiercoles' => 'Hora Inicio Miercoles',
			'tur_horaFinMiercoles' => 'Hora Fin Miercoles',
			'tur_horaInicioJueves' => 'Hora Inicio Jueves',
			'tur_horaFinJueves' => 'Hora Fin Jueves',
			'tur_horaInicioViernes' => 'Hora Inicio Viernes',
			'tur_horaFinViernes' => 'Hora Fin Viernes',
			'tur_horaInicioSabado' => 'Hora Inicio Sabado',
			'tur_horaFinSabado' => 'Hora Fin Sabado',
			'tur_horaInicioDomingo' => 'Hora Inicio Domingo',
			'tur_horaFinDomingo' => 'Hora Fin Domingo',
			'tur_habilitado' => 'Habilitado',
			'tur_fechacreado' => 'Fecha Creación',
			'tur_creadopor' => 'Creado Por',
			'tur_fechamodificado' => 'Fecha Modificación',
			'tur_modificadopor' => 'Modificado Por',
			'tur_nombre_archivo' => 'Archivo a cargar',
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

		$criteria->compare('tur_id',$this->tur_id);
		$criteria->compare('tur_nombre',$this->tur_nombre,true);
		$criteria->compare('tur_horaInicioLunes',$this->tur_horaInicioLunes,true);
		$criteria->compare('tur_horaFinLunes',$this->tur_horaFinLunes,true);
		$criteria->compare('tur_horaInicioMartes',$this->tur_horaInicioMartes,true);
		$criteria->compare('tur_horaFinMartes',$this->tur_horaFinMartes,true);
		$criteria->compare('tur_horaInicioMiercoles',$this->tur_horaInicioMiercoles,true);
		$criteria->compare('tur_horaFinMiercoles',$this->tur_horaFinMiercoles,true);
		$criteria->compare('tur_horaInicioJueves',$this->tur_horaInicioJueves,true);
		$criteria->compare('tur_horaFinJueves',$this->tur_horaFinJueves,true);
		$criteria->compare('tur_horaInicioViernes',$this->tur_horaInicioViernes,true);
		$criteria->compare('tur_horaFinViernes',$this->tur_horaFinViernes,true);
		$criteria->compare('tur_horaInicioSabado',$this->tur_horaInicioSabado,true);
		$criteria->compare('tur_horaFinSabado',$this->tur_horaFinSabado,true);
		$criteria->compare('tur_horaInicioDomingo',$this->tur_horaInicioDomingo,true);
		$criteria->compare('tur_horaFinDomingo',$this->tur_horaFinDomingo,true);
		$criteria->compare('tur_habilitado',$this->tur_habilitado,true);
		$criteria->compare('tur_fechacreado',$this->tur_fechacreado,true);
		$criteria->compare('tur_creadopor',$this->tur_creadopor);
		$criteria->compare('tur_fechamodificado',$this->tur_fechamodificado,true);
		$criteria->compare('tur_modificadopor',$this->tur_modificadopor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/*public function beforeSave()
	{
		$uploadPath = Yii::app()->params['uploadPath'];
		if(is_object($this->image))
		{
			$this->image->setPath($uploadPath);
			$this->image->saveAs();
			if(!empty($this->oldImage))
			{
				$delete = Yii::app()->params['uploadPath'].'/'.$this->oldImage;
				if(file_exists($delete)) unlink($delete);
			}
		}
		if(empty($this->image) && !empty($this->oldImage)) $this->image = $this->oldImage;
		return parent::beforeSave();
	}*/

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CargaMasiva the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
