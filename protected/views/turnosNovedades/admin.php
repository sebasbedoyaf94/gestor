<?php
$this->pageTitle=Yii::app()->name . ' - Administrar Turnos Novedades';
$this->breadcrumbs=array(
	'Turnos Novedades'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Turnos Novedades','url'=>array('index')),
	array('label'=>'Crear Turno Novedad','url'=>array('create'), 'visible'=>!empty(Yii::app()->session['permisosRol']['TurnosNovedades']['Crear']),),
);
?>

<h1>Administrar Turnos Novedades</h1>


<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'turnos-novedades-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'htmlOptions' => array('style' => 'white-space: nowrap'),
'columns'=>array(
		array(
			'name' => 'full_turno',
			'value' => '$data->turnovTur->tur_nombre',
			// 'filter'=> CHtml::listData(TurnosNovedades::model()->findAll(), 'turnov_tur_id', 'turnov_tur_id'),
		),
		array(
			'name' => 'turnov_nov_id',
			'value' => '$data->turnovNov->nov_nombre',
			'filter'=> CHtml::listData(Novedades::model()->findAll(), 'nov_id', 'nov_nombre'),
		),
		array(
			'name' => 'turnov_dia',
			'value' => '$data->turnov_dia',
			// 'filter'=> CHtml::listData(TurnosNovedades::model()->findAll(), 'turnov_dia', 'turnov_dia'),
		),
		array(
			'name' => 'turnov_horaInicio',
			'value' => '$data->turnov_horaInicio',
			// 'filter'=> CHtml::listData(TurnosNovedades::model()->findAll(), 'turnov_horaInicio', 'turnov_horaInicio'),
		),
		array(
			'name' => 'turnov_horaFin',
			'value' => '$data->turnov_horaFin',
			// 'filter'=> CHtml::listData(TurnosNovedades::model()->findAll(), 'turnov_horaFin', 'turnov_horaFin'),
		),
		array(
			'name' => 'turnov_fecha',
			'value' => '$data->turnov_fecha',
			// 'filter'=> CHtml::listData(TurnosNovedades::model()->findAll(), 'turnov_horaFin', 'turnov_horaFin'),
		),
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
	            	'visible'=>"!empty(Yii::app()->session['permisosRol']['TurnosNovedades']['Modificar'])",
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
