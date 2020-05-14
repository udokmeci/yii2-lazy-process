<?php

namespace udokmeci\lazy;
use yii\web\Response;
use Yii;

/**
 * This is just an example.
 */
class QueueRunnerBehavior extends \yii\base\Behavior
{

    public function attach($owner)
    {

        $res= parent::attach($owner);
        $owner->on(Response::EVENT_AFTER_SEND, [$this,'runQueue']);

        return $res;
        
    }

    public function runQueue($event)
    {
       $this->closeConnection($event);
       Yii::$app->queue->run(false);
    }

    public function closeConnection($event)
    {

        if (is_callable('fastcgi_finish_request')) {
            session_write_close();
            fastcgi_finish_request();
            return true;
        }
        try {
            if (session_id()) {
                session_write_close();
            }
         
            ignore_user_abort(true);
            ob_end_flush();
            ob_flush();
            flush();
        } catch (\Exception $e) {
            return false;
        }

    }
}
