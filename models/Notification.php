<?php
namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_notification".
 *
 * @property int $id
 * @property string $title
 * @property string $type_id
 * @property int $state_id
 * @property int $to_user_id
 * @property string|null $model
 * @property int $model_id
 * @property string|null $icon
 * @property string|null $created_on
 * @property int|null $created_by_id
 */
class Notification extends \yii\db\ActiveRecord
{

    const TYPE_NEW = 1;

    const TYPE_DELETED = 2;

    const TYPE_UPDATED = 3;
    
    const TYPE_SUCCESS = 4;

    const STATE_UNREAD = 1;

    const STATE_READED = 2;

    const STATE_DELETED = 3;

    /**
     *
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_notification';
    }

    /**
     *
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'title',
                    'type_id',
                    'state_id',
                    'to_user_id',
                    'model_id'
                ],
                'required'
            ],
            [
                [
                    'state_id',
                    'to_user_id',
                    'model_id',
                    'created_by_id'
                ],
                'integer'
            ],
            [
                [
                    'created_on'
                ],
                'safe'
            ],
            [
                [
                    'title',
                    'type_id',
                    'model'
                ],
                'string',
                'max' => 25
            ],
            [
                [
                    'icon'
                ],
                'string',
                'max' => 50
            ]
        ];
    }

    /**
     *
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'type_id' => Yii::t('app', 'Type ID'),
            'state_id' => Yii::t('app', 'State ID'),
            'to_user_id' => Yii::t('app', 'To User ID'),
            'model' => Yii::t('app', 'Model'),
            'model_id' => Yii::t('app', 'Model ID'),
            'icon' => Yii::t('app', 'Icon'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by_id' => Yii::t('app', 'Created By ID')
        ];
    }

    public function getColor($type)
    {
        $list = array(
            self::TYPE_NEW => "primary",
            self::TYPE_UPDATED => "warning",
            self::TYPE_DELETED => "danger",
            self::TYPE_SUCCESS => "success"
        );
        return $list[$type];
    }
    
    public function getName($model_name, $model_id){
        $model = $model_name::findOne(['id' => $model_id]);
        $name = $model->getName();
        return $name;
    }
    
    public function getTime() {
        $start = strtotime($this->created_on);
        $end = strtotime('now');
        $time = ($end - $start) / 60;
        $result = (int)($time) . ' mins ago';
        if($time <= 1){
            $time = (int)($time/60);
            $result = 'Just now';
        }
        elseif($time >= 60 && $time <= 60*24){
            $time = (int)($time/60);
            $result = $time.' hrs ago';
        }
        elseif($time >= 60*24 && $time <= 60*24*2){
            $time = (int)($time/60);
            $result = $time.' day ago';
        }
        elseif($time >= 60*24*2 && $time <= 60*24*7){
            $time = (int)($time/(60*24));
            $result = $time.' days ago';
        }
        elseif($time >= 60*24*7 && $time <= 60*24*7*2){
            $time = (int)($time/(60*24*7));
            $result = $time.' week ago';
        }
        elseif($time >= 60*24*7*2 && $time <= 60*24*30){
            $time = (int)($time/(60*24*7));
            $result = $time.' weeks ago';
        }
        elseif($time >= 60*24*30 && $time <= 60*24*30*2){
            $time = (int)($time/(60*24*30));
            $result = $time.' month ago';
        }
        elseif($time >= 60*24*30*2 && $time <= 60*24*365){
            $time = (int)($time/(60*24*30));
            $result = $time.' months ago';
        }
        elseif($time >= 60*24*365 && $time <= 60*24*365*2){
            $time = (int)($time/(60*24*365));
            $result = $time.' year ago';
        }
        elseif($time >= 60*24*365*2){
            $time = (int)($time/(60*24*365));
            $result = $time.' years ago';
        }
        return $result;
    }
    
    public static function createNofication($title, $type, $model, $to_user, $icon){
        $notification = new Notification();
        $notification->title = $title;
        $notification->type_id = $type;
        $notification->model_id = $model->id;
        $notification->to_user_id = $to_user;
        $notification->icon = $icon;
        $notification->state_id = Notification::STATE_UNREAD;
        $notification->model = get_class($model);
        $notification->created_on = date('Y-m-d H:i:s');
        $notification->created_by_id = ! empty(\Yii::$app->user->id) ? \Yii::$app->user->id : Users::ROLE_ADMIN;
        $notification->save(false);
    }
}
