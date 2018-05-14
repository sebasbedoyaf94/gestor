<?php
$this->pageTitle=Yii::app()->name . ' - Ver Roles';
$this->breadcrumbs=array(
	'Roles'=>array('index'),
	$model->rol_nombre,
);

$this->menu=array(
array('label'=>'Listar Roles','url'=>array('index')),
array('label'=>'Crear Rol','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['Roles']['Crear'])),
array('label'=>'Modificar Rol','url'=>array('update','id'=>$model->rol_id),'visible'=>!empty(Yii::app()->session['permisosRol']['Roles']['Modificar'])),
array('label'=>'Administrar Roles','url'=>array('admin')),
);
?>

<h1>Rol <?php echo $model->rol_nombre; ?></h1>

	<div class="col-xs-12 well">
		<div class="col-xs-12">
			<h3 class='subtitulo'>Información del Rol</h3>
		</div>

		<div class="col-xs-12">
			<?php $this->widget('booster.widgets.TbDetailView',array(
			'data'=>$model,
			'attributes'=>array(
					'rol_nombre',
					'rol_habilitado',
				),
			)); ?>
		</div>
	</div>

	<div class="col-xs-12 col-sm-12 well">
		<div class="col-xs-12 col-sm-12">
			<h3 class='subtitulo'>Acciones permitidas para el rol <?php echo $model->rol_nombre; ?></h3>
		</div>

		<table class="table table-bordered">
		 	<thead>
		 		<tr>
		 			<th></th>
			 		<?php foreach ($titulosAcciones as $key => $accion): ?>
		 				<th><?php echo $accion; ?></th>
			 		<?php endforeach ?>
		 		</tr>
		 	</thead>
		 	<tbody>

		 		<?php foreach ($dataModelosAcciones as $key => $row): ?>
		 			<tr>
		 			<th><?php echo $key; ?></th>
		 			<?php 	
		 				for ($i=0; $i < count($titulosAcciones) ; $i++) 
		 				{
		 					if (!empty($row[$titulosAcciones[$i]])) {

		 						//asignar el valor por default para el dropdown
		 						//Se asigna valor Si cuando ya tiene asginada la accion (osea que ya existe el rol y la accion)
		 						$default='No';
		 						if (!empty($accionesAsignadas[$row[$titulosAcciones[$i]]])) {
		 							$default='Si';
		 						}

		 						echo "<td class='alert alert-success text-center' role='alert'><b>".$default."</b></td>";
		 					}
		 					else{
		 						echo "<td class='alert alert-danger' role='alert'></td>";
		 					}
		 				}
		 			?>
		 			</tr>
		 		<?php endforeach ?>
		 	</tbody>
		</table>
	</div>
