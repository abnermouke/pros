<?php

namespace Abnermouke\Pros\Builders\Table\Tools\Items;

/**
 * 详细信息构建器
 * Class InfoBuilder
 * @package Abnermouke\Pros\Builders\Table\Tools\Items
 */
class InfoBuilder extends BasicBuilder
{
    /**
     * 构造函数
     * InfoBuilder constructor.
     * @param $field string 构建字段
     * @param $guard_name string 显示名称
     */
    public function __construct($field, $guard_name)
    {
        //引用父级构造
        parent::__construct('info', $field, $guard_name);
        //设置基础配置
        $this->template('{'.$field.'}')->image();
    }

    /**
     * 显示文本模版
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 00:16:55
     * @param string $template 描述文本（可动态获取当前行列表数据，使用{}包裹将动态获取，如{id}将读取当前行id对应值渲染）
     * @return InfoBuilder
     */
    public function template($template)
    {
        //显示文本模版
        return $this->setParam('template', $template);
    }

    /**
     * 设置图片配置信息
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 00:31:37
     * @param string $field
     * @param string[] $bg_themes
     * @return InfoBuilder
     */
    public function image($field = '', $bg_themes = ['primary', 'success', 'info', 'warning', 'danger', 'dark', 'light'])
    {
        //设置图片配置信息
        return $this->setParam('image', $field)->setParam('bg_themes', $bg_themes);
    }

}
