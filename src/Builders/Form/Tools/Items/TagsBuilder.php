<?php

namespace Abnermouke\Pros\Builders\Form\Tools\Items;

/**
 * 标签框构建器
 * Class TagsBuilder
 * @package Abnermouke\Pros\Builders\Form\Tools\Items
 */
class TagsBuilder extends BasicBuilder
{
    /**
     * 构造函数
     * TagsBuilder constructor.
     * @param $field
     * @param $guard_name
     */
    public function __construct($field, $guard_name)
    {
        //引入父级构造
        parent::__construct('tags', $field, $guard_name);
        //触发默认
        $this->placeholder('输入（标签/关键词）后回车确认以生成（标签/关键词）信息')->description('输入（标签/关键词）后回车确认以生成（标签/关键词）信息')->tip('标签/关键词将进行自动过滤，如存在违禁词将在提交后自动删除')->whitelist();
    }

    /**
     * 设置占位符信息
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-15 14:53:19
     * @param string $placeholder
     * @return TagsBuilder
     */
    public function placeholder($placeholder = '')
    {
        //设置占位符信息
        return $this->setParam('placeholder', $placeholder);
    }

    /**
     * 设置白名单
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-19 01:27:42
     * @param array $lists
     * @return TagsBuilder
     */
    public function whitelist($lists = [])
    {
        //设置白名单
        return $this->setParam('whitelist', $lists);
    }

}
