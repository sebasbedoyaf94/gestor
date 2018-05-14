<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
echo "<?php\n";
$nameColumn = $this->guessNameColumn($this->tableSchema->columns);
$label = $this->class2name($this->modelClass);
echo "\$this->pageTitle=Yii::app()->name . ' - Ver $label';\n";
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->{$nameColumn},
);\n";
?>

$this->menu=array(
array('label'=>'Listar <?php echo $this->modelClass; ?>','url'=>array('index')),
array('label'=>'Crear <?php echo $this->modelClass; ?>','url'=>array('create')),
array('label'=>'Modificar <?php echo $this->modelClass; ?>','url'=>array('update','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>)),
array('label'=>'Eliminar <?php echo $this->modelClass; ?>','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Administrar <?php echo $this->modelClass; ?>','url'=>array('admin')),
);
?>

<h1>Ver <?php echo $this->modelClass . " <?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?></h1>

<div class="col-xs-12 well">
	<div class="col-xs-12">
		<h3 class='subtitulo'>Información del <?php echo $this->modelClass; ?></h3>
	</div>

	<div class="col-xs-12">
		<?php echo "<?php"; ?> $this->widget('booster.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
			<?php
			foreach ($this->tableSchema->columns as $column) {
					echo "\t\t\t\t'" . $column->name . "',\n";
			}
			?>
			),
		)); ?>
	</div>
</div>
