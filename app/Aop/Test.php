<?php


namespace App\Aop;


use Swoft\Bean\Annotation\Bean;

/**
 * @class Test
 * @package App\Aop
 * @version:
 * @author: zhangshengji
 * @datetime: 2018/10/9 14:52
 * @description:
 *
 * @Bean()
 */
class Test
{
    public function dd()
    {
        var_dump('AOP-TEST');
        return "AOP-TEST";
    }
}