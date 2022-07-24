<?php

namespace Abnermouke\Pros\Builders\Table\Tools\Items;

/**
 * 选项内容项构建器
 * Class OptionBuilder
 * @package Abnermouke\Pros\Builders\Table\Tools\Items
 */
class OptionBuilder extends BasicBuilder
{

    /**
     * 构造函数
     * OptionBuilder constructor.
     * @param $field string 构建字段
     * @param $guard_name string 显示名称
     */
    public function __construct($field, $guard_name)
    {
        //引用父级构造
        parent::__construct('option', $field, $guard_name);
        //设置基础配置
        $this->options();
    }

    /**
     * 设置选项内容
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 00:00:26
     * @param array $options [key1 => name1, key2 => name2] 选项内容
     * @param array $themes [key1 => theme1, key2 => theme2] 选项内容主题
     * @return OptionBuilder
     */
    public function options($options = [], $themes = [])
    {
        //设置选项内容
        return $this->setParam('options', $options)->setParam('themes', $themes);
    }


}
