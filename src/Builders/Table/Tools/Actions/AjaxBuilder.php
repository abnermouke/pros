<?php

namespace Abnermouke\Pros\Builders\Table\Tools\Actions;

/**
 * AJAX请求操作构建器
 * Class AjaxBuilder
 * @package Abnermouke\Pros\Builders\Table\Tools\Actions
 */
class AjaxBuilder extends BasicBuilder
{

    /**
     * 构造函数
     * AjaxBuilder constructor.
     * @param $query_url string 请求/条件链接
     * @param $guard_name string 操作文本
     */
    public function __construct($query_url, $guard_name)
    {
        //引入父级构造
        parent::__construct('ajax', $query_url, $guard_name);
        //设置基础信息
        $this->query($query_url, 'post')->after_refresh();
    }

    /**
     * 设置ajax执行完毕后不执行任何操作
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 23:03:44
     * @return AjaxBuilder
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
     * @return AjaxBuilder
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
     * @return AjaxBuilder
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
     * @return AjaxBuilder
     */
    public function after_redirect($url)
    {
        //设置ajax执行完毕后跳转指定链接
        return $this->setParam('after', $url);
    }

}
