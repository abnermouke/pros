<?php

namespace Abnermouke\Pros\Builders\Table\Tools\Filters;


/**
 * 分组构建器
 * Class GroupBuilder
 * @package Abnermouke\Pros\Builders\Table\Tools\Filters
 */
class GroupBuilder extends BasicBuilder
{

    /**
     * 构造函数
     * GroupBuilder constructor.
     * @param $field string 筛选字段
     * @param $guard_name string 提示文字
     */
    public function __construct($field, $guard_name)
    {
        //引入父级构造
        parent::__construct('group', $field, $guard_name);
        //设置默认信息
        $this->col(4)->default_value('')->options();
    }

    /**
     * 设置选项
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 15:51:57
     * @param array $options
     * @return GroupBuilder
     */
    public function options($options = [])
    {
        //设置选项
        return $this->setParam('options', $options);
    }

}
