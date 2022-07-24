<?php

namespace Abnermouke\Pros\Builders\Form\Tools;

use Abnermouke\Pros\Builders\Form\Tools\Buttons\AjaxBuilder;
use Abnermouke\Pros\Builders\Form\Tools\Buttons\RedirectBuilder;

/**
 * 表单按钮构建器
 * Class FormButtonBuilder
 * @package Abnermouke\Pros\Builders\Form\Tools
 */
class FormButtonBuilder
{

    //表单按钮配置
    public $button = [];

    /**
     * 设置跳转按钮实例对象
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-15 00:53:03
     * @param $url string 跳转链接
     * @param $guard_name string 按钮文本
     * @return RedirectBuilder
     */
    public function redirect($url, $guard_name)
    {
        //设置构建器对象
        $this->button = $builder = new RedirectBuilder($url, $guard_name);
        //返回构建器对象
        return $builder;
    }

    /**
     * 设置Ajax请求按钮实例对象
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-15 00:53:24
     * @param $url string 请求链接
     * @param $guard_name string 按钮文本
     * @return AjaxBuilder
     */
    public function ajax($url, $guard_name)
    {
        //设置构建器对象
        $this->button = $builder = new AjaxBuilder($url, $guard_name);
        //返回构建器对象
        return $builder;
    }
}
