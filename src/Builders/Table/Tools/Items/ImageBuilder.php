<?php

namespace Abnermouke\Pros\Builders\Table\Tools\Items;

/**
 * 图片内容项构建器
 * Class ImageBuilder
 * @package Abnermouke\Pros\Builders\Table\Tools\Items
 */
class ImageBuilder extends BasicBuilder
{

    /**
     * 构造函数
     * ImageBuilder constructor.
     * @param $field string 构建字段
     * @param $guard_name string 显示名称
     */
    public function __construct($field, $guard_name)
    {
        //引用父级构造
        parent::__construct('image', $field, $guard_name);
        //设置基础配置
        $this->size()->circle(false)->bg_themes();
    }

    /**
     * 设置背景随机主题色
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 23:56:31
     * @param string[] $themes
     * @return ImageBuilder
     */
    public function bg_themes($themes = ['primary', 'success', 'info', 'warning', 'danger', 'dark', 'light'])
    {
        //设置背景随机主题色
        return $this->setParam('bg_themes', $themes);
    }

    /**
     * 设置是否圆形展示
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 23:53:20
     * @param bool $circle
     * @return ImageBuilder
     */
    public function circle($circle = true)
    {
        //设置是否圆形展示
        return $this->setParam('circle', $circle);
    }

    /**
     * 设置图片尺寸
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 23:51:59
     * @param int $size
     * @return ImageBuilder
     */
    public function size($size = 50)
    {
        //设置图片尺寸
        return $this->setParam('size', (int)$size);
    }
}
