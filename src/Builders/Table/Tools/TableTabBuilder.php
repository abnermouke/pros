<?php

namespace Abnermouke\Pros\Builders\Table\Tools;

use Abnermouke\Pros\Builders\Table\Tools\Tabs\BasicBuilder;

/**
 * 表格选项卡构建器
 * Class TableTabBuilder
 * @package Abnermouke\Pros\Builders\Table\Tools
 */
class TableTabBuilder
{
    /**
     * 选项卡配置
     * @var array
     */
    public $tabs = [];

    /**
     * 创建选项卡构建对象
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 16:32:00
     * @param $alias string 选项卡唯一标识
     * @param $title string 选项卡显示标题
     * @param $query_url string 选项卡请求链接
     * @param string $query_method 请求方式
     * @return BasicBuilder
     */
    public function create($alias, $title, $query_url, $query_method = 'post')
    {
        //添加选项卡构建器
        $this->tabs[] = $builder = (new BasicBuilder($alias, $title, $query_url, $query_method));
        //返回当前实例对象
        return $builder;
    }


}
