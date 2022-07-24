<?php

namespace Abnermouke\Pros\Builders\Table\Tools\Filters;

/**
 * 标签构建器
 * Class TagsBuilder
 * @package Abnermouke\Pros\Builders\Table\Tools\Filters
 */
class TagsBuilder extends BasicBuilder
{

    /**
     * 构造函数
     * TagsBuilder constructor.
     * @param $field string 筛选字段
     * @param $guard_name string 提示文字
     */
    public function __construct($field, $guard_name)
    {
        //引入父级构造
        parent::__construct('tags', $field, $guard_name);
        //设置默认信息
        $this->placeholder('请输入'.$guard_name.'，回车确定添加')->col(6)->default_value('');
    }

    /**
     * 设置占位提示文字
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 15:31:54
     * @param string $text
     * @return TagsBuilder
     */
    public function placeholder($text = '')
    {
        //设置占位提示文字
        return $this->setParam('placeholder', $text);
    }

}
