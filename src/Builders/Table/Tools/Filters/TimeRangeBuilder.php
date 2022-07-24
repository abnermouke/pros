<?php

namespace Abnermouke\Pros\Builders\Table\Tools\Filters;

/**
 * 时间区间构建器
 * Class TimeRangeBuilder
 * @package Abnermouke\Pros\Builders\Table\Tools\Filters
 */
class TimeRangeBuilder extends BasicBuilder
{

    /**
     * 构造函数
     * TimeRangeBuilder constructor.
     * @param $field string 筛选字段
     * @param $guard_name string 提示文字
     */
    public function __construct($field, $guard_name)
    {
        //引入父级构造
        parent::__construct('time_range', $field, $guard_name);
        //设置默认信息
        $this->placeholder('点击选择'.$guard_name)->col(4)->default_value('')->format('Y-m-d H:i:ss');
    }

    /**
     * 设置占位提示文字
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 15:31:54
     * @param string $text
     * @return TimeRangeBuilder
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
     * @return TimeRangeBuilder
     */
    public function format($format = 'Y-m-d H:i:ss')
    {
        //设置时间格式
        return $this->setParam('format', $format ? $format : 'Y-m-d H:i:ss');
    }
}
