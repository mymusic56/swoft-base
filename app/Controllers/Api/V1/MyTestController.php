<?php


namespace App\Controllers\Api\V1;

use App\Aop\Test;
use App\Controllers\Api\BaseController;
use App\Models\Entity\User;
use App\Models\Logic\IndexLogic;
use App\Middlewares\SignatureCheckMiddleware;
use App\Services\SignatrueService;
use GuzzleHttp\Client;
use Swoft\App;
use Swoft\Bean\Annotation\After;
use Swoft\Bean\Annotation\Aspect;
use Swoft\Bean\Annotation\Before;
use Swoft\Bean\Annotation\PointAnnotation;
use Swoft\Bean\Annotation\PointBean;
use Swoft\Bean\BeanFactory;
use Swoft\Core\ApplicationContext;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\View\Bean\Annotation\View;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Inject;
use MongoDb\Client as MongoDBClient;


/**
 * @class MyTestController
 * @package App\Controllers\Api\V1
 * @version:
 * @author: zhangshengji
 * @datetime: 2018/10/8 18:02
 * @description:
 * @Controller(prefix="/api/v1.mytest")
 * @Middleware(class=SignatureCheckMiddleware::class)
 */

class MyTestController extends BaseController
{
    /**
     * @Inject()
     * @var \App\Models\Logic\IndexLogic
     */
    private $indexLogic;

    /**
     * @RequestMapping("mongo")
     */
    public function mongo()
    {

        $client = new MongoDBClient('mongodb://recorder:123456@192.168.88.138:27017/recorder');
        $res = $client->selectDatabase('recorder')->selectCollection('rec_record_lists')->findOne();
        return $res;
    }

    public function httpClient()
    {
        //和guzzle用法类似
        $url = 'http://rec.qm.com/test/test11111111';
        $data = ['name' => 'zhangsan'];
        $client = new \Swoft\HttpClient\Client();
        $response = $client->request('POST', $url, [
            'form_params' => $data,
            'timeout' => 60
        ])->getResponse();

        $body = (string)$response->getBody();
        return $body;
    }

    /**
     * @RequestMapping("guzzle")
     */
    public function guzzle()
    {

        $url = 'http://rec.qm.com/test/test11111111';
        $data = ['name' => 'zhangsan'];
        $client = new Client();

        try {
            $response = $client->request('POST', $url, [
                'form_params' => $data
            ]);
            $this->errorCode = $response->getStatusCode(); // 200
            $this->errorMsg = $response->getReasonPhrase(); //
            $body = $response->getBody();
            $remainingBytes = $body->getContents();
            $result = (string) $body;
        } catch (\Exception $e) {
            $this->errorCode = 0;
            $this->errorMsg = $e->getMessage();
            $result = null;
        }

        return $result;
    }

    /**
     * @RequestMapping("findById")
     * @param Request $request
     * @return array
     */
    public function findById(Request $request)
    {
        $result = User::findById($request->input('id'))->getResult();
        $query = User::findById($request->input('id'));

        /* @var User $user */

        $user = $query->getResult(User::class);

        return [$result, $user->getName(), 'hello'];
    }

    /**
     * @RequestMapping()
     * @View(template="v1/mytest/view")
     */
    public function view()
    {
        $data = [
            'name'   => 'Swoft-base',
            'repo'   => 'https://github.com/swoft-cloud/swoft',
            'doc'    => 'https://doc.swoft.org/',
            'doc1'   => 'https://swoft-cloud.github.io/swoft-doc/',
            'method' => __METHOD__,
        ];

        return $data;
    }

    /**
     */
    public function bean()
    {
        $flag1 = App::getBean(IndexLogic::class);
        $flag2 = ApplicationContext::getBean(IndexLogic::class);
        $flag3 = BeanFactory::getBean(IndexLogic::class);
        $flag4 = BeanFactory::hasBean(IndexLogic::class);
        return [$this->indexLogic->getUser(), $flag4, IndexLogic::class];
    }

    /**
     * @RequestMapping("beforeAction")
     */
    public function beforeAction(Request $request)
    {
        var_dump('beforeAction');
        $m = $request->query("sign", 'none');
        return $m;
    }

    /**
     * @After()
     */
    public function afterAction()
    {
        var_dump(' after1 ');
    }
}
