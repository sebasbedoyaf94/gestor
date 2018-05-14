<?php
$this->pageTitle=Yii::app()->name . ' - Administrar Asesores';
$this->breadcrumbs=array(
	'Asesores'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Asesores','url'=>array('index')),
	array('label'=>'Crear Asesor','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['Asesores']['Crear'])),
	array('label'=>'Ver Asesor','url'=>array('view','id'=>$model->ase_id)),
	array('label'=>'Administrar Asesores','url'=>array('admin')),
);

?>

<h1>Administrar Asesores</h1>


<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'asesores-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'htmlOptions' => array('style' => 'white-space: nowrap'),
'columns'=>array(
		array(
			'name' => 'ase_cont_id',
			'value' => '$data->aseCont->cont_total_horas_semana',
			'filter'=> CHtml::listData(Contratos::model()->findAll(), 'cont_id', 'cont_total_horas_semana'),
		),
		array(
			'name' => 'ase_usuariored',
			'value' => '$data->ase_usuariored',
			// 'filter'=> CHtml::listData(Asesores::model()->findAll(), 'ase_usuariored', 'ase_usuariored'),
		),
		array(
			'name' => 'ase_nombre',
			'value' => '$data->ase_nombre',
			// 'filter'=> CHtml::listData(Asesores::model()->findAll(), 'ase_nombre', 'ase_nombre'),
		),
		array(
			'name' => 'ase_apellidos',
			'value' => '$data->ase_apellidos',
			// 'filter'=> CHtml::listData(Asesores::model()->findAll(), 'ase_apellidos', 'ase_apellidos'),
		),
		array(
			'name' => 'ase_identificacion',
			'value' => '$data->ase_identificacion',
			// 'filter'=> CHtml::listData(Asesores::model()->findAll(), 'ase_identificacion', 'ase_identificacion'),
		),
		array(
			'name' => 'ase_identificacion_lider',
			'value' => '$data->ase_identificacion_lider',
		),
		/*
		array(
			'name' => 'ase_lider',
			'value' => '$data->ase_lider',
			// 'filter'=> CHtml::listData(Asesores::model()->findAll(), 'ase_lider', 'ase_lider'),
		),
		array(
			'name' => 'ase_horaInicioLunes',
			'value' => '$data->ase_horaInicioLunes',
			// 'filter'=> CHtml::listData(Asesores::model()->findAll(), 'ase_horaInicioLunes', 'ase_horaInicioLunes'),
		),
		array(
			'name' => 'ase_horaFinLunes',
			'value' => '$data->ase_horaFinLunes',
			// 'filter'=> CHtml::listData(Asesores::model()->findAll(), 'ase_horaFinLunes', 'ase_horaFinLunes'),
		),
		array(
			'name' => 'ase_horaInicioMartes',
			'value' => '$data->ase_horaInicioMartes',
			// 'filter'=> CHtml::listData(Asesores::model()->findAll(), 'ase_horaInicioMartes', 'ase_horaInicioMartes'),
		),
		array(
			'name' => 'ase_horaFinMartes',
			'value' => '$data->ase_horaFinMartes',
			// 'filter'=> CHtml::listData(Asesores::model()->findAll(), 'ase_horaFinMartes', 'ase_horaFinMartes'),
		),
		array(
			'name' => 'ase_horaInicioMiercoles',
			'value' => '$data->ase_horaInicioMiercoles',
			// 'filter'=> CHtml::listData(Asesores::model()->findAll(), 'ase_horaInicioMiercoles', 'ase_horaInicioMiercoles'),
		),
		array(
			'name' => 'ase_horaFinMiercoles',
			'value' => '$data->ase_horaFinMiercoles',
			// 'filter'=> CHtml::listData(Asesores::model()->findAll(), 'ase_horaFinMiercoles', 'ase_horaFinMiercoles'),
		),
		array(
			'name' => 'ase_horaInicioJueves',
			'value' => '$data->ase_horaInicioJueves',
			// 'filter'=> CHtml::listData(Asesores::model()->findAll(), 'ase_horaInicioJueves', 'ase_horaInicioJueves'),
		),
		array(
			'name' => 'ase_horaFinJueves',
			'value' => '$data->ase_horaFinJueves',
			// 'filter'=> CHtml::listData(Asesores::model()->findAll(), 'ase_horaFinJueves', 'ase_horaFinJueves'),
		),
		array(
			'name' => 'ase_horaInicioViernes',
			'value' => '$data->ase_horaInicioViernes',
			// 'filter'=> CHtml::listData(Asesores::model()->findAll(), 'ase_horaInicioViernes', 'ase_horaInicioViernes'),
		),
		array(
			'name' => 'ase_horaFinViernes',
			'value' => '$data->ase_horaFinViernes',
			// 'filter'=> CHtml::listData(Asesores::model()->findAll(), 'ase_horaFinViernes', 'ase_horaFinViernes'),
		),
		array(
			'name' => 'ase_horaInicioSabado',
			'value' => '$data->ase_horaInicioSabado',
			// 'filter'=> CHtml::listData(Asesores::model()->findAll(), 'ase_horaInicioSabado', 'ase_horaInicioSabado'),
		),
		array(
			'name' => 'ase_horaFinSabado',
			'value' => '$data->ase_horaFinSabado',
			// 'filter'=> CHtml::listData(Asesores::model()->findAll(), 'ase_horaFinSabado', 'ase_horaFinSabado'),
		),
		array(
			'name' => 'ase_horaInicioDomingo',
			'value' => '$data->ase_horaInicioDomingo',
			// 'filter'=> CHtml::listData(Asesores::model()->findAll(), 'ase_horaInicioDomingo', 'ase_horaInicioDomingo'),
		),
		array(
			'name' => 'ase_horaFinDomingo',
			'value' => '$data->ase_horaFinDomingo',
			// 'filter'=> CHtml::listData(Asesores::model()->findAll(), 'ase_horaFinDomingo', 'ase_horaFinDomingo'),
		),
		array(
			'name' => 'ase_habilitado',
			'value' => '$data->ase_habilitado',
			// 'filter'=> CHtml::listData(Asesores::model()->findAll(), 'ase_habilitado', 'ase_habilitado'),
		),
		array(
			'name' => 'ase_fechacreado',
			'value' => '$data->ase_fechacreado',
			// 'filter'=> CHtml::listData(Asesores::model()->findAll(), 'ase_fechacreado', 'ase_fechacreado'),
		),
		array(
			'name' => 'ase_creadopor',
			'value' => '$data->ase_creadopor',
			// 'filter'=> CHtml::listData(Asesores::model()->findAll(), 'ase_creadopor', 'ase_creadopor'),
		),
		array(
			'name' => 'ase_fechamodificado',
			'value' => '$data->ase_fechamodificado',
			// 'filter'=> CHtml::listData(Asesores::model()->findAll(), 'ase_fechamodificado', 'ase_fechamodificado'),
		),
		array(
			'name' => 'ase_modificadopor',
			'value' => '$data->ase_modificadopor',
			// 'filter'=> CHtml::listData(Asesores::model()->findAll(), 'ase_modificadopor', 'ase_modificadopor'),
		),
		*/
		array(
			'htmlOptions' => array('nowrap'=>'nowrap'),
			'class'=>'booster.widgets.TbButtonColumn',
			'template' => '{view} {update}',
			'buttons' => array(
	            'view' => array(
	                'options' => array(
	                	'title' => Yii::t('app', 'Ver'),
	                	// 'ajax'=>array(
                  //           'type'=>'POST',
                  //           'url'=>"js:$(this).attr('href')",
                  //           'success'=>'function(data) { 
                  //           	$("#viewModal .modal-body").html(data); 
                  //           	$("#viewModal").modal(); 
                  //           }'
                  //       ),
	                ),
	            ),
	            'update' => array(
	            	'visible' => '!empty(Yii::app()->session["permisosRol"]["Asesores"]["Modificar"])',
	                'options' => array(
	                	'title' => Yii::t('app', 'Modificar'),
	                	// 'ajax'=>array(
                  //           'type'=>'POST',
                  //           'url'=>"js:$(this).attr('href')",
                  //           'success'=>'function(data) { 
                  //           	$("#viewModal .modal-body").html(data); 
                  //           	$("#viewModal").modal();
                  //           }'
                  //       ),
	                ),
	            ),            
	        ),
		),
),
)); ?>

