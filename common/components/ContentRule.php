<?php

namespace common\components;

use yii\rbac\Rule;
use common\models\User;
use common\models\Content;
use Yii;
 
class ContentRule extends Rule{
    public $name = 'isContent';
     
    public function execute($user, $item, $params) { //abstract method implement
         $id= Yii::$app->request->get('id');
         //ตรวจสอบว่า  Requestที่ร้องขอมี id ของ content ตรงกับ id ของ content ของ Userที่สร้าง content นั้นขึ้นหรือไม่
         //ถ้ามี ให้ User คนดังกล่าว เข้าถึงเนื้อหาดังกล่าวได้
         $user = User::findOne($user);
         $has_content = false;
         foreach($user->contents as $ucon){
             if($ucon->id == $id){
                 $has_content = true;
             }
         }
         
         //ตรวจสอบว่าสิทธิ์ของ User คนดังกล่าวเป็น Admin หรือไม่
        $role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        $access =false;
        foreach($role as $r){
            if($r->name == "Admin Position")
            {
                $access =true;
            }
        }
        //ถ้าเป็น Admin ให้มีสิทธิ์เข้าถึงได้ทุก Content
        if($has_content ||$access){
            return true;
        }
        else{
            return false;
        }
 
    }
 
}