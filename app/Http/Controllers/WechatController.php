<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EasyWeChat\Foundation\Application;

class WechatController extends Controller
{
    //
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
    //    $server = $app->server;
       // $server->serve()->send();

// 从项目实例中得到服务端应用实例。
        //$server->serve()->send();
//        $server->setMessageHandler(function ($message) {
//            switch ($message->MsgType) {
//                case 'event':
//                    return '收到事件消息';
//                    break;
//                case 'text':
//                    return '收到文字消息';
//                    break;
//                case 'image':
//                    return '收到图片消息';
//                    break;
//                case 'voice':
//                    return '收到语音消息';
//                    break;
//                case 'video':
//                    return '收到视频消息';
//                    break;
//                case 'location':
//                    return '收到坐标消息';
//                    break;
//                case 'link':
//                    return '收到链接消息';
//                    break;
//                // ... 其它消息
//                default:
//                    return '收到其它消息';
//                    break;}
//        });
//        $response = $server->serve();
//
//        dd($response);
//        $response->send(); // Laravel 里请使用：return $response;

    }
}
