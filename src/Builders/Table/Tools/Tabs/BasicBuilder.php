<?php

namespace Abnermouke\Pros\Builders\Table\Tools\Tabs;

use Illuminate\Support\Str;

/**
 * 列表基础构建器
 * Class BasicBuilder
 * @package Abnermouke\Pros\Builders\Table\Tools\Tabs
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
        'query_url' => '',
        'query_method' => 'post',
        'bind_button_id_suffixes' => [],
    ];

    /**
     * 构造函数
     * BasicBuilder constructor.
     * @param $alias string 唯一标识
     * @param $title string 列表标题
     * @param $query_url string 请求链接
     * @param string $query_method 请求方式
     */
    public function __construct($alias, $title, $query_url, $query_method = 'post')
    {
        //设置基础配置
        $this->alias($alias)->title($title)->query($query_url, $query_method)->count(0, true)->button_suffixes();
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
    public function title($title = '全部')
    {
        //设置标题
        return $this->setParam('title', $title ? $title : '全部');
    }

    /**
     * 设置请求信息
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 16:35:50
     * @param $url
     * @param string $method
     * @return BasicBuilder
     */
    public function query($url, $method = 'post')
    {
        //设置请求信息
        return $this->setParam('query_url', $url)->setParam('query_method', $method);
    }

    /**
     * 设置统计数量
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 16:39:13
     * @param int $count
     * @param bool $auto_hidden
     * @return $this
     */
    public function count($count = 0, $auto_hidden = true)
    {
        //设置统计数量
        return $this->setParam('count', ['number' => (int)$count, 'auto_hidden' => $auto_hidden]);
    }

    /**
     * 绑定当前TAB展示的按钮，默认展示所有表格配置按钮
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 12:49:34
     * @param array|bool $suffixes 为空展示所有表格配置按钮，数组为指定按钮后缀，false表示当前tab不显示任何按钮
     * @return $this
     */
    public function button_suffixes($suffixes = [])
    {
        //绑定展示指定按钮后缀
        return $this->setParam('bind_button_id_suffixes', $suffixes);
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
