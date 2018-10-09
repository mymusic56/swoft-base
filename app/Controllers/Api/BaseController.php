<?php


namespace App\Controllers\Api;

use Swoft\Bean\Annotation\Bean;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Server\Bean\Annotation\Controller;

/**
 * @class BaseController
 * @package App\Controllers\Api\V1
 * @version:
 * @author: zhangshengji
 * @datetime: 2018/10/9 10:18
 * @description:
 */
class BaseController
{
    protected function checkSign(Request $request)
    {
        $request->query('sign');
    }
}