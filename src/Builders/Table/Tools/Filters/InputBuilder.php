<?php

namespace Abnermouke\Pros\Builders\Table\Tools\Filters;

/**
 * 输入框构建器
 * Class InputBuilder
 * @package Abnermouke\Pros\Builders\Table\Tools\Filters
 */
class InputBuilder extends BasicBuilder
{
    /**
     * 构造函数
     * InputBuilder constructor.
     * @param $field string 筛选字段
     * @param $guard_name string 提示文字
     */
    public function __construct($field, $guard_name)
    {
        //引入父级构造
        parent::__construct('input', $field, $guard_name);
        //设置默认信息
        $this->placeholder('请输入'.$guard_name)->col(4)->default_value('');
    }

    /**
     * 设置占位提示文字
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 15:31:54
     * @param string $text
     * @return InputBuilder
     */
    public function placeholder($text = '')
    {
        //设置占位提示文字
        return $this->setParam('placeholder', $text);
    }





}
