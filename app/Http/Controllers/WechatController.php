<?php

namespace App\Http\Controllers;

use App\Http\Server\TestServer;
use EasyWeChat\Message\Text;
use EasyWeChat\Support\Log;
use Illuminate\Http\Request;
use EasyWeChat\Foundation\Application;

class WechatController extends Controller
{
    //
    public function messages()
    {
        dd(Log::hasLogger());
        $options = [
            'mini_program' => [
                'app_id'   => 'wxb72422fd69462f07',
                'secret'   => '906b20f53e6d206d8dabda783b699c6a',
                // token 和 aes_key 开启消息推送后可见
                'token'    => 'numbersixiaochengxu',
                'aes_key'  => '0LIG32mcr6L82t2NJQs8cXO1TmmXWrcVGU6rBtTiQTf'
            ],
        ];




        $app = new Application($options);
        $miniProgram = $app->mini_program;
        $miniProgram->staff->message();
        $server = $app->server;

        $server->setMessageHandler(function ($message){
            // $message->FromUserName // 用户的 openid
            // $message->MsgType // 消息类型：event, text....
            switch ($message->MsgType) {
                case 'event':
                    return '你好';
                    break;
                case 'text':
                    return '收到文字消息';
                    break;
                case 'image':
                    return '收到图片消息';
                    break;
                case 'voice':
                    return '收到语音消息';
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                // ... 其它消息
                default:
                    return '收到其它消息';
                    break;
            }
        });
return $server->serve();
    }
    public function wechat()
    {
        $options = [
            'debug'     => true,
            'app_id'    => 'wx6b2b1a8cc619de79',
            'secret'    => 'c4212df8b8902783840a4cee8aa42730',
            'token'     => 'weixin',
            'log' => [
                'level' => 'debug',
                'file'  => '/tmp/easywechat.log',
            ],
            // ...
        ];
        $app = new Application($options);

        // 从项目实例中得到服务端应用实例。
        $userApi = $app->user;
        $server = $app->server;
        $server->setMessageHandler(function ($message) use ($userApi){
            // $message->FromUserName // 用户的 openid
            // $message->MsgType // 消息类型：event, text....
            switch ($message->MsgType) {
                case 'event':
                    return '你好'. $userApi->get($message-->FromUserName)->nickname;
                    break;
                case 'text':
                    return '收到文字消息';
                    break;
                case 'image':
                    return '收到图片消息';
                    break;
                case 'voice':
                    return '收到语音消息';
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                // ... 其它消息
                default:
                    return '收到其它消息';
                    break;
            }
        });



        $response = $server->serve();
        return $response; // Laravel 里请使用：return $response;

    }
    public function addMenu(){
        $options = [
            'debug'     => true,
            'app_id'    => 'wx6b2b1a8cc619de79',
            'secret'    => 'c4212df8b8902783840a4cee8aa42730',
            'token'     => 'weixin',
            'log' => [
                'level' => 'debug',
                'file'  => '/tmp/easywechat.log',
            ],
            // ...
        ];
        $app = new Application($options);

        $message = new Text(['content' => 'Hello world!']);
        $result = $app->staff->message($message)->to("oPNmtt-xrda9Ye_jrqch2vSxhIcg")->send();
//...

    }

}
