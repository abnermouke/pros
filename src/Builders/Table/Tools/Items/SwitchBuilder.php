<?php

namespace Abnermouke\Pros\Builders\Table\Tools\Items;

use Abnermouke\EasyBuilder\Module\BaseModel;

/**
 * switch构建器
 * Class SwitchBuilder
 * @package Abnermouke\Pros\Builders\Table\Tools\Items
 */
class SwitchBuilder extends BasicBuilder
{

    /**
     * 构造函数
     * SwitchBuilder constructor.
     * @param $field string 构建字段
     * @param $guard_name string 显示名称
     */
    public function __construct($field, $guard_name)
    {
        //引用父级构造
        parent::__construct('switch', $field, $guard_name);
        //设置基础配置
        $this->theme()->on(BaseModel::SWITCH_ON, '', 'post', '开启')->off(BaseModel::SWITCH_OFF, '', 'post', '关闭')->after_none();
    }

    /**
     * 设置主题颜色
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 00:08:18
     * @param string $theme
     * @return SwitchBuilder
     */
    public function theme($theme = 'success')
    {
        //设置主题颜色
        return $this->setParam('theme', $theme);
    }

    /**
     * 设置开启配置
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 00:11:09
     * @param $value mixed 开启对应值
     * @param $query_url string 开启时请求链接（AJAX）
     * @param string $query_method 开启时请求方式
     * @param string $text 开始时提示文字
     * @return SwitchBuilder
     */
    public function on($value, $query_url, $query_method = 'post', $text = '开启')
    {
        //设置开启配置
        return $this->setParam('on', compact('value', 'query_url', 'query_method', 'text'));
    }

    /**
     * 设置关闭配置
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 00:11:09
     * @param $value mixed 关闭对应值
     * @param $query_url string 关闭时请求链接（AJAX）
     * @param string $query_method 关闭时请求方式
     * @param string $text 关闭时提示文字
     * @return SwitchBuilder
     */
    public function off($value, $query_url, $query_method = 'post', $text = '已关闭')
    {
        //设置开启配置
        return $this->setParam('off', compact('value', 'query_url', 'query_method', 'text'));
    }

    /**
     * 设置ajax执行完毕后不执行任何操作
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 23:03:44
     * @return SwitchBuilder
     */
    public function after_none()
    {
        //设置ajax执行完毕后不执行任何操作
        return $this->setParam('after', 'none');
    }

    /**
     * 设置ajax执行完毕后表格刷新
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 22:54:01
     * @return SwitchBuilder
     */
    public function after_refresh()
    {
        //设置ajax执行完毕后表格刷新
        return $this->setParam('after', 'refresh');
    }

    /**
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 22:55:02
     * @return SwitchBuilder
     */
    public function after_reload()
    {
        //设置ajax执行完毕后刷新页面
        return $this->setParam('after', 'reload');
    }

    /**
     * 设置ajax执行完毕后跳转指定链接
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 22:56:06
     * @param $url
     * @return SwitchBuilder
     */
    public function after_redirect($url)
    {
        //设置ajax执行完毕后跳转指定链接
        return $this->setParam('after', $url);
    }
}
