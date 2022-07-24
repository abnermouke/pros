<?php

namespace Abnermouke\Pros\Builders\Form\Tools;

use Abnermouke\Pros\Builders\Form\Tools\Tabs\BasicBuilder;
use Illuminate\Support\Str;

/**
 * 表单选项卡构建器
 * Class FormTabBuilder
 * @package Abnermouke\Pros\Builders\Form\Tools
 */
class FormTabBuilder
{

    /**
     * 选项卡配置
     * @var array
     */
    public $tabs = [];

    /**
     * 创建实例TAB
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-15 00:35:16
     * @param $title
     * @param $alias
     * @return BasicBuilder
     */
    public function create($title, $alias = '')
    {
        //添加选项卡构建器
        $this->tabs[] = $builder = (new BasicBuilder($title, $alias));
        //返回当前实例对象
        return $builder;
    }

}
