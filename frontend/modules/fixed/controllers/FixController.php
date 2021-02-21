<?php

namespace frontend\modules\fixed\controllers;

use Yii;
use common\models\Fix;
use common\models\Equipment;
use frontend\modules\fixed\models\FixSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Url;
/**
 * FixController implements the CRUD actions for Fix model.
 */
class FixController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Fix models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FixSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Fix model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Fix model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Fix();

        if ($model->load(Yii::$app->request->post())) {

            $model->request_by = Yii::$app->user->getId();
            $model->request_at = time();
            $model->fix_status_id = 1;
            $model->fix_photo = "No-image.png";
            $model->location = $model->equipmentDepartment->getRoomsName();

            if($model->validate() && $model->save()){
                Yii::$app->session->setFlash('success', 'บันทึกการแจ้งปัญหาสำเร็จ');
                $file = UploadedFile::getInstance($model, 'fix_photo'); //ติดบัคตอนบันทึกแบบไม่มีรูป
                if($file!=null){
                    if($file->size!=0){
                        $model->fix_photo = $model->fix_id.'.'.$file->extension;
                        $file->saveAs('uploads/fix/'.$model->fix_id.'.'.$file->extension);
                    }
                }elseif($file==null){
                    $model->fix_photo = "No-image.png";
                }
                $model->save();
                //$this->sendLine($model);
                return $this->redirect(['view', 'id' => $model->fix_id]);
            }else{
                Yii::$app->session->setFlash('error', 'บันทึกการแจ้งปัญหาไม่สำเร็จ');
                return $this->redirect(['index']);
            }
            //return $this->redirect(['view', 'id' => $model->fix_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);

        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->fix_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);*/
    }

    /**
     * Updates an existing Fix model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'fix_photo');
            if($file!=null){
                if($file->size!=0){
                    $model->fix_photo = $model->fix_id.'.'.$file->extension;
                    $file->saveAs('uploads/fix/'.$model->fix_id.'.'.$file->extension);
                }
            }
            elseif($file==null){
                $model->fix_photo = "No-image.png";
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->fix_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Fix model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {   
        Yii::$app->session->setFlash('success', 'ลบรายการสำเร็จ');
        //$this->findModel($id)->delete();
        $model = $this->findModel($id);
        //@unlink(Yii::getAlias('@webroot').'/uploads/fix/'.$model->fix_photo);
        $model->delete();

        return $this->redirect(['index']);
    }

    public function actionCancel($id)
    {
        Yii::$app->session->setFlash('success', 'ยกเลิกการแจ้งปัญหาสำเร็จ');
        $model = $this->findModel($id);
        $model->fix_status_id = 4;
        $model->save();
        return $this->redirect(['view', 'id' => $model->fix_id]);
        
        /*return $this->render('cancel', [
            'model' => $model,
        ]);*/
    }

    public function actionProgress($id)
    {
        Yii::$app->session->setFlash('success', 'รับเรื่องสำเร็จ');
        $model = $this->findModel($id);
        $model->fix_status_id = 2;
        $model->save();
        return $this->redirect(['view', 'id' => $model->fix_id]);
    }

    public function actionSuccess($id)
    {
        Yii::$app->session->setFlash('success', 'ดำเนินการแก้ปัญหาสำเร็จ');
        $model = $this->findModel($id);
        $model->repair_by = Yii::$app->user->getId();
        $model->repair_at = time();
        $model->fix_status_id = 3;
        $model->save();
        return $this->redirect(['view', 'id' => $model->fix_id]);
    }

    /**
     * Finds the Fix model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Fix the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fix::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function sendLine($model)
    {
        $line_token = 'o7a6gqGhfNRfff0ZRFVoNCzsMrfroARBaC8IErCfGGB';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://notify-api.line.me/api/notify");
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, null);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "message="."\nแจ้งปัญหาเรื่อง : ".$model->content."\nสถานที่ : ".$model->equipmentDepartment->rooms_name."\nรหัสครุภัณฑ์ : ".$model->equipment_department."\nประเภท : ".$model->equipmentDepartment->type_name."\nแจ้งโดย : ".$model->requestBy->person->getFullname());

        // follow redirects
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-type: application/x-www-form-urlencoded',
            'Authorization: Bearer '.$line_token,
        ]);
        // receive server response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);

        curl_close ($ch);
    }

}
