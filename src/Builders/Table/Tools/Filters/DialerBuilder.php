<?php

namespace Abnermouke\Pros\Builders\Table\Tools\Filters;

/**
 * 记步构建器
 * Class DialerBuilder
 * @package Abnermouke\Pros\Builders\Table\Tools\Filters
 */
class DialerBuilder extends BasicBuilder
{

    /**
     * 构造函数
     * DialerBuilder constructor.
     * @param $field string 筛选字段
     * @param $guard_name string 提示文字
     */
    public function __construct($field, $guard_name)
    {
        //引入父级构造
        parent::__construct('dialer', $field, $guard_name);
        //设置默认信息
        $this->col(2)->default_value('')->min(0)->max(9999999999)->step(1)->decimals(0);
    }

    /**
     * 设置最小数值
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 15:42:05
     * @param int $min
     * @return DialerBuilder
     */
    public function min($min = 0)
    {
        //设置最小数值
        return $this->setParam('min', $min);
    }

    /**
     * 设置最大数值
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 15:42:40
     * @param int $max
     * @return DialerBuilder
     */
    public function max($max = 100)
    {
        //设置最大数值
        return $this->setParam('max', $max);
    }

    /**
     * 设置步长
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 15:45:34
     * @param int $step
     * @return DialerBuilder
     */
    public function step($step = 1)
    {
        //设置步长
        return $this->setParam('step', $step);
    }

    /**
     * 设置保留小数长度
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 15:46:19
     * @param int $decimals
     * @return DialerBuilder
     */
    public function decimals($decimals = 0)
    {
        //设置保留小数长度
        return $this->setParam('decimals', $decimals);
    }


}
