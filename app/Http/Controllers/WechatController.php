<?php

namespace App\Http\Controllers;

use DOMDocument;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\Text;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class WechatController extends Controller
{
    //
    public function messages()
    {
       $FromUserName = \request()->FromUserName;
        $url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=EivLg5dIbHIKVVary_tJRPtZsCSwc68QV079ZRGDUB8u9hPysM0Ak1ZQZyQn2AyRUgeK-aPPHAiwi_OeMSpU5tAP7aQfRwwuWnyGlM0Z4uNSeJ-OToLbZXD9f3PK0ADAZWBiAFAEBG';
        $message = ["touser" => "OPENID",

            "msgtype" => "text",
            "text" => [
                "content" => "Hello World",
            ]
        ];

        $message = json_encode($message);

        $http = new Client;
        $response = $http->post($url, [
            'form_params' => [
                'touser' => $FromUserName,
                'msgtype' => 'text',
                'text' =>["content" => "Hello World"]
            ],
        ]);

        return json_decode((string) $response->getBody(), true);

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
        $FromUserName = \request()->FromUserName;
        $app = new Application($options);

        // 从项目实例中得到服务端应用实例。
        $userApi = $app->user;

        $server = $app->server;
        $server->setMessageHandler(function ($message) use ($userApi,$FromUserName){
            // $message->FromUserName // 用户的 openid
            // $message->MsgType // 消息类型：event, text....
            switch ($message->MsgType) {
                case 'event':
                    return '你好'. $userApi->get($message-->FromUserName)->nickname;
                    break;
                case 'text':
                    return '收到文字消息'.$FromUserName;
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
