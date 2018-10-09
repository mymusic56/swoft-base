<?php


namespace App\Aop;

use Swoft\Aop\JoinPoint;
use Swoft\Aop\ProceedingJoinPoint;
use Swoft\Bean\Annotation\After;
use Swoft\Bean\Annotation\AfterReturning;
use Swoft\Bean\Annotation\AfterThrowing;
use Swoft\Bean\Annotation\Around;
use Swoft\Bean\Annotation\Aspect;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Before;
use Swoft\Bean\Annotation\PointExecution;

/**
 * @class AllPointAspect
 * @package App\Aop
 * @version:
 * @author: zhangshengji
 * @datetime: 2018/10/9 14:53
 * @description:
 * @Aspect()
 * @PointExecution(
 *     include={"App\Aop\Test::dd.*"}
 * )
 */
class AllPointAspect
{
    /**
     * @var
     */
    private $test;

    /**
     * @Before()
     */
    public function before()
    {
        var_dump('before1');
        $this->test .= ' before1 ';
    }

    /**
     * @After()
     */
    public function after()
    {
        $this->test .= ' after1 ';
    }

    /**
     * @AfterReturning()
     */
    public function afterReturn(JoinPoint $joinPoint)
    {
        $result = $joinPoint->getReturn();
        return $result.' afterReturn1 ';
    }

    /**
     * @Around()
     * @param ProceedingJoinPoint $proceedingJoinPoint
     * @return mixed
     */
    public function around(ProceedingJoinPoint $proceedingJoinPoint)
    {
        $this->test .= ' around-before1 ';
        $result = $proceedingJoinPoint->proceed();
        $this->test .= ' around-after1 ';
        return $result.$this->test;
    }

    /**
     * @AfterThrowing()
     */
    public function afterThrowing()
    {
        echo "aop=1 afterThrowing !\n";
    }
}