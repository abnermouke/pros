<?php

namespace Abnermouke\Pros\Builders\Table\Tools\Filters;

/**
 * 日期/时间构建器
 * Class DateBuilder
 * @package Abnermouke\Pros\Builders\Table\Tools\Filters
 */
class DateBuilder extends BasicBuilder
{

    /**
     * 构造函数
     * DateBuilder constructor.
     * @param $field string 筛选字段
     * @param $guard_name string 提示文字
     */
    public function __construct($field, $guard_name)
    {
        //引入父级构造
        parent::__construct('date', $field, $guard_name);
        //设置默认信息
        $this->placeholder('点击选择'.$guard_name)->col(3)->default_value('')->format('Y-m-d');
    }

    /**
     * 设置占位提示文字
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 15:31:54
     * @param string $text
     * @return DateBuilder
     */
    public function placeholder($text = '')
    {
        //设置占位提示文字
        return $this->setParam('placeholder', $text);
    }

    /**
     * 设置时间格式
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 15:35:25
     * @param string $format
     * @return DateBuilder
     */
    public function format($format = 'Y-m-d')
    {
        //设置时间格式
        return $this->setParam('format', $format ? $format : 'Y-m-d');
    }

}
