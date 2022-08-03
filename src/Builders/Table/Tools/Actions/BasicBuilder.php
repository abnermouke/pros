<?php

namespace Abnermouke\Pros\Builders\Table\Tools\Actions;

/**
 * 表格操作基础构建器
 * Class BasicBuilder
 * @package Abnermouke\Pros\Builders\Table\Tools\Actions
 */
class BasicBuilder
{

    //构建器配置
    protected $builder = [
        'type' => '',
        'guard_name' => '',
        'theme' => '',
        'query_url' => '',
        'query_method' => 'get',
        'icon' => '',
        'confirm_tip' => '',
        'conditions' => []
    ];

    /**
     * 构造函数
     * BasicBuilder constructor.
     * @param $type string 操作类型
     * @param $query_url string 请求/条件链接
     * @param $guard_name string 操作文本
     */
    public function __construct($type, $query_url, $guard_name)
    {
        //设置基础信息
        $this->type($type)->query($query_url, 'get')->guard_name($guard_name)->theme();
    }

    /**
     * 设置请求前提示文本
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 22:50:25
     * @param string $text
     * @return $this
     */
    public function confirmed($text = '')
    {
        //设置请求前提示文本
        return $this->setParam('confirm_tip', $text);
    }

    /**
     * 设置字体图标
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 22:48:33
     * @param $icon
     * @return $this
     */
    public function icon($icon)
    {
        //判断字体图标
        if (strlen($icon) > 0) {
            //设置字体图标
            return $this->setParam('icon', $icon);
        }
        //返回当前实例
        return $this;
    }

    /**
     * 设置操作主题
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 22:47:34
     * @param string $theme
     * @return $this
     */
    public function theme($theme = 'primary')
    {
        //设置操作主题
        return $this->setParam('theme', $theme);
    }

    /**
     * 设置操作类型
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 22:46:37
     * @param $type
     * @return $this
     */
    protected function type($type)
    {
        //设置操作类型
        return $this->setParam('type', $type);
    }

    /**
     * 设置操作名称
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 22:44:10
     * @param $guard_name
     * @return $this
     */
    public function guard_name($guard_name)
    {
        //设置操作名称
        return $this->setParam('guard_name', $guard_name);
    }

    /**
     * 设置跳转/链接信息
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 22:43:25
     * @param $url
     * @param string $method
     * @return $this
     */
    public function query($url, $method = 'get')
    {
        //设置跳转/链接信息
        return $this->setParam('query_url', $url)->setParam('query_method', $method);
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
     * 设置显示并且条件
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-25 22:55:58
     * @param $field
     * @param $value array
     * @return $this
     */
    public function condition($field, $value)
    {
        //设置并且条件
        $this->builder['conditions'][$field] = $value;
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
