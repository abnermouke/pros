<?php

namespace Abnermouke\Pros\Builders\Form\Tools\Items;

/**
 * 选择框构建器
 * Class SelectBuilder
 * @package Abnermouke\Pros\Builders\Form\Tools\Items
 */
class SelectBuilder extends BasicBuilder
{
    /**
     * 构造函数
     * SelectBuilder constructor.
     * @param $field
     * @param $guard_name
     * @throws \Exception
     */
    public function __construct($field, $guard_name)
    {
        //引入父级构造
        parent::__construct('select', $field, $guard_name);
        //触发默认
        $this->placeholder('请选择'.$guard_name)->options();
    }

    /**
     * 设置占位符信息
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 00:36:02
     * @param string $placeholder
     * @return SelectBuilder
     */
    public function placeholder($placeholder = '')
    {
        //设置占位符信息
        return $this->setParam('placeholder', $placeholder);
    }

    /**
     * 设置选择项
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 01:00:36
     * @param array $options 选项内容 [key_1 => guard_name_1, key_2 => guard_name_2]
     * @param int $default_value
     * @return SelectBuilder
     * @throws \Exception
     */
    public function options($options = [], $default_value = '')
    {
        //设置选择项
        return $this->setParam('options', $options)->default_value($default_value);
    }


}
