<?php

namespace Abnermouke\Pros\Builders\Table\Tools\Filters;

/**
 * 选择框构建器
 * Class SelectBuilder
 * @package Abnermouke\Pros\Builders\Table\Tools\Filters
 */
class SelectBuilder extends BasicBuilder
{

    /**
     * 构造函数
     * SelectBuilder constructor.
     * @param $field string 筛选字段
     * @param $guard_name string 提示文字
     */
    public function __construct($field, $guard_name)
    {
        //引入父级构造
        parent::__construct('select', $field, $guard_name);
        //设置默认信息
        $this->col(3)->default_value('')->options([]);
    }

    /**
     * 设置选项
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 15:51:57
     * @param array $options
     * @return SelectBuilder
     */
    public function options($options = [])
    {
        //设置选项
        return $this->setParam('options', $options);
    }

}
