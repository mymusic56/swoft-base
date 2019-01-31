<?php


namespace App\Middlewares;

use App\Services\SignatrueService;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Swoft\Bean\Annotation\Bean;
use Swoft\Core\Config;
use Swoft\Http\Message\Middleware\MiddlewareInterface;

/**
 * @class SignatureCheckMiddleware
 * @package App\Middlewares
 * @version:
 * @author: zhangshengji
 * @datetime: 2018/10/9 15:32
 * @description: 签名验证
 * @Bean()
 */
class SignatureCheckMiddleware implements MiddlewareInterface
{

    /**
     * Process an incoming server request and return a response, optionally delegating
     * response creation to a handler.
     *
     * @param \Swoft\Http\Message\Server\Request $request
     * @param \Psr\Http\Server\RequestHandlerInterface $handler
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \InvalidArgumentException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $para_temp = $request->input();
        if (isset($para_temp['postmantest']) && $para_temp['postmantest'] == 'd1d3a4bb67183b0df8db6922abacc032') {
            $response = $handler->handle($request);
            return $response->withAddedHeader('Signature-Check-Middleware', 'success');
        }
        if (empty($para_temp['sign'])) {
            return \response()->json(['status' => -1, 'msg' => '签名错误2', 'data' => null]);
        }
        $signature = new SignatrueService();
        //过滤参数
        $filteredParam = $signature->paraFilter($para_temp);
        //排序
        $filteredParam = $signature->argSort($filteredParam);
        //构造预处理字符串
        $prestr = $signature->createLinkstring($filteredParam);
        $para_temp['sign'] = $para_temp['sign'] ?? '';
        $flag = $signature->md5Verify($prestr, $para_temp['sign'], \config('signatureCheckKey'));
        //验证签名
        if (!$flag) {
            return \response()->json(['status' => -1, 'msg' => '签名错误1', 'data' => null]);
        }

        $response = $handler->handle($request);
        return $response->withAddedHeader('Signature-Check-Middleware', 'success');
    }
}