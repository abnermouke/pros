<?php

namespace Abnermouke\Pros\Builders\Table\Tools;

use Abnermouke\Pros\Builders\Table\Tools\Filters\TagsBuilder;
use Abnermouke\Pros\Builders\Table\Tools\Items\ImageBuilder;
use Abnermouke\Pros\Builders\Table\Tools\Items\InfoBuilder;
use Abnermouke\Pros\Builders\Table\Tools\Items\OptionBuilder;
use Abnermouke\Pros\Builders\Table\Tools\Items\RatingBuilder;
use Abnermouke\Pros\Builders\Table\Tools\Items\StringBuilder;
use Abnermouke\Pros\Builders\Table\Tools\Items\SwitchBuilder;

/**
 * 表格内容项构建器
 * Class TableItemBuilder
 * @package Abnermouke\Pros\Builders\Table\Tools
 */
class TableItemBuilder
{

    public $items = [];

    /**
     * 设置图片内容项构建器
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 00:33:17
     * @param $field string 构建字段
     * @param $guard_name string 显示名称
     * @return ImageBuilder
     */
    public function image($field, $guard_name)
    {
        //设置构建器对象
        $this->items[] = $builder =  new ImageBuilder($field, $guard_name);
        //返回构建器对象
        return $builder;
    }

    /**
     * 设置详细信息构建器
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 00:34:15
     * @param $field string 构建字段
     * @param $guard_name string 显示名称
     * @return InfoBuilder
     */
    public function info($field, $guard_name)
    {
        //设置构建器对象
        $this->items[] = $builder =  new InfoBuilder($field, $guard_name);
        //返回构建器对象
        return $builder;
    }

    /**
     * 设置选项构建器
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 00:34:44
     * @param $field string 构建字段
     * @param $guard_name string 显示名称
     * @return OptionBuilder
     */
    public function option($field, $guard_name)
    {
        //设置构建器对象
        $this->items[] = $builder =  new OptionBuilder($field, $guard_name);
        //返回构建器对象
        return $builder;
    }

    /**
     * 设置评分构建器
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 00:36:29
     * @param $field string 构建字段
     * @param $guard_name string 显示名称
     * @return RatingBuilder
     */
    public function rating($field, $guard_name)
    {
        //设置构建器对象
        $this->items[] = $builder =  new RatingBuilder($field, $guard_name);
        //返回构建器对象
        return $builder;
    }

    /**
     * 设置文本构建器
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 00:36:52
     * @param $field string 构建字段
     * @param $guard_name string 显示名称
     * @return StringBuilder
     */
    public function string($field, $guard_name)
    {
        //设置构建器对象
        $this->items[] = $builder =  new StringBuilder($field, $guard_name);
        //返回构建器对象
        return $builder;
    }

    /**
     * 设置switch构建器
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 00:37:07
     * @param $field string 构建字段
     * @param $guard_name string 显示名称
     * @return SwitchBuilder
     */
    public function switch($field, $guard_name)
    {
        //设置构建器对象
        $this->items[] = $builder =  new SwitchBuilder($field, $guard_name);
        //返回构建器对象
        return $builder;
    }

}
