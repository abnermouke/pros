<?php

namespace Abnermouke\Pros\Builders\Form\Tools\Tabs;

use Illuminate\Support\Str;

/**
 * 表单基础构建器
 * Class BasicBuilder
 * @package Abnermouke\Pros\Builders\Form\Tools\Tabs
 */
class BasicBuilder
{

    /**
     * 构建器配置
     * @var array
     */
    protected $builder = [
        'alias' => '',
        'title' => '',
        'groups' => [],
    ];

    /**
     * 构造函数
     * BasicBuilder constructor.
     * @param $title string 选项卡名称
     * @param $alias string 唯一标识
     */
    public function __construct($title, $alias)
    {
        //设置基础配置
        $this->alias($alias)->title($title);
    }

    /**
     * 设置唯一标识
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 14:03:37
     * @param string $alias
     * @return $this
     */
    public function alias($alias = '')
    {
        //设置唯一标识
        return $this->setParam('alias', $alias ? $alias : Str::random(10));
    }

    /**
     * 设置标题
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 16:34:42
     * @param string $title
     * @return $this
     */
    public function title($title = '基本信息')
    {
        //设置标题
        return $this->setParam('title', $title ? $title : '基本信息');
    }

    /**
     * 设置分组信息
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-15 00:41:28
     * @param $fields
     * @param string $title
     * @param string $alert_text
     * @param string $alert_theme
     * @return $this
     */
    public function group($fields, $title = '', $alert_text = '', $alert_theme = 'primary')
    {
        //设置分组信息
        $this->builder['groups'][] = compact('fields', 'title', 'alert_text', 'alert_theme');
        //返回当前实例
        return $this;
    }

    /**
     * 新增/更新构建器参数
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 15:21:55
     * @param $key
     * @param $value
     * @return $this
     */
    protected function setParam($key, $value)
    {
        //设置参数
        $this->builder[$key] = $value;
        //返回当前实例
        return $this;
    }

    /**
     * 获取构建器参数
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 15:22:11
     * @return string[]
     */
    public function get()
    {
        return $this->builder;
    }

}
