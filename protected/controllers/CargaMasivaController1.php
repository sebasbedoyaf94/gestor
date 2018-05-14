<?php

class CargaMasivaController extends Controller
{
	/**
	* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	* using two-column layout. See 'protected/views/layouts/column2.php'.
	*/
	public $layout='//layouts/column2';

	/**
	* @return array action filters
	*/
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	* Specifies the access control rules.
	* This method is used by the 'accessControl' filter.
	* @return array access control rules
	*/
	public function accessRules()
	{
		return array(
            );
	}

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionTurnos()
	{
		/*$model=new CargaMasiva;
		$name=new CargaMasiva;
		$model->unsetAttributes();  // clear any default values
			$newFile = CUploadedFile::getInstance($model, 'sourceCode');
			if (is_object($newFile) && get_class($newFile)==='CU
		
		if(isset($_GET['CargaMasiva']))
		{
			$model->attributes=$_GET['CargaMasiva'];ploadedFile')
              $model->the_file = $newFile;
          	if($model->save())
          		$this->redirect(array('view','id'=>$model->the_file));
			//$name = $newFile->getName();
			//$this->redirect(array('turnos',array('name'=>$name)));
			//$this->render('turnos',array('name'=>$name));
		}

		if (Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('turnos',array('model'=>$model), false, true);
		}
		else{
			$this->render('turnos',array('model'=>$model));
		}*/
		
		$model=new CargaMasiva;
		print_r($model->tur_nombre."<br>");
		//print_r($this->horasServicio("1"));
		die();
		if(isset($_POST['CargaMasiva']))
		{
			$model->attributes=$_POST['CargaMasiva'];

			$model->image=CUploadedFile::getInstance($model,'image');
			if($model->validate())
			{
				$model->save();
				Yii::app()->user->setFlash('success', 'Upload success.');
				$this->redirect(array('turnos'));
			}
			/*if($model->save())
			{
				$model->image->saveAs('uploads');
			}*/
		}
		if (Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('turnos',array('model'=>$model), false, true);
		}
		else{
			$this->render('turnos',array('model'=>$model));
		}
	}

	public function actionUpload() {
        Yii::import("ext.EAjaxUpload.qqFileUploader");

        $folder = 'uploads/'; // folder for uploaded files
        $allowedExtensions = array("xls", "csv", "xlsx"); 
        $sizeLimit = 1 * 1024 * 1024 * 100; // maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);

        $fileSize = filesize($folder . $result['filename']); //GETTING FILE SIZE
        $fileName = $result['filename']; //GETTING FILE NAME

        echo $return; // it's array 
    }

}