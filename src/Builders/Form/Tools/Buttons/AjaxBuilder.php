<?php

namespace Abnermouke\Pros\Builders\Form\Tools\Buttons;

/**
 * AJAX请求按钮构建器
 * Class AjaxBuilder
 * @package Abnermouke\Pros\Builders\Form\Tools\Buttons
 */
class AjaxBuilder extends BasicBuilder
{

    /**
     * 构造函数
     * AjaxBuilder constructor.
     * @param $query_url string 请求/条件链接
     * @param $guard_name string 按钮文本
     */
    public function __construct($query_url, $guard_name)
    {
        //引入父级构造
        parent::__construct('ajax', $query_url, $guard_name);
        //设置基础信息
        $this->query($query_url, 'post')->after_reload();
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
