<?php 

namespace app\commands;

use yii\console\Controller;
use app\models\Notification;
use app\models\Users;

class DataController extends Controller
{
    public function getRandom($n) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        
        return $randomString;
    }
    
    public function getRandomDate(){
        $start = strtotime('1900-01-01');
        $end = time();
        $timestamp = mt_rand($start, $end);
        return $timestamp;
    }
    
    public function actionAddUser($count = 1){
        for ($i = 0; $i < $count; $i++) {
            $model = new Users();
            $model->username = DataController::getRandom(5);
            $model->email = DataController::getRandom(5).'@gmail.com';
            $model->password = DataController::getRandom(10);
            $model->username = DataController::getRandom(5);
            $model->roll_id = rand(2,5);
            $model->state_id = rand(1,3);
            $model->gender = ((rand()%2) == 0)?'Male':'Female';
            $model->authKey = 'test'.rand(100,999).'key';
            $model->accessToken = rand(100,999).'-token';
            $model->created_by_id = \app\models\Users::ROLE_ADMIN;
            $model->dob = date("Y-m-d",DataController::getRandomDate());
            $model->created_on = date("Y-m-d H:i:m");
            $model->updated_on = date("Y-m-d H:i:m");
            if($model->save(false)){
                $title = 'New '.$model->getRole($model->roll_id);
                $type = Notification::TYPE_NEW;
                $users = Users::findAll([
                    '<=',
                    'roll_id',
                    Users::ROLE_STAFF
                ]);
                foreach ($users as $user){
                    $notification = new Notification();
                    $notification->title = $title;
                    $notification->type_id = $type;
                    $notification->model_id = $model->id;
                    $notification->to_user_id = $user->id;
                    $notification->icon = 'user';
                    $notification->state_id = Notification::STATE_UNREAD;
                    $notification->model = get_class($model);
                    $notification->created_on = date('Y-m-d H:i:s');
                    $notification->created_by_id = !empty(\Yii::$app->user->id) ? \Yii::$app->user->id : Users::ROLE_ADMIN;
                    $notification->save(false);
                }
                echo "New User ".$model->username."\n";
            }
        }
    }
}