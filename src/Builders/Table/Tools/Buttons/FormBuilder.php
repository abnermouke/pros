<?php

namespace Abnermouke\Pros\Builders\Table\Tools\Buttons;

/**
 * 表单模态框按钮构建器
 * Class FormBuilder
 * @package Abnermouke\Pros\Builders\Table\Tools\Buttons
 */
class FormBuilder extends BasicBuilder
{

    /**
     * 构造函数
     * FormBuilder constructor.
     * @param $query_url string 请求/条件链接
     * @param $guard_name string 按钮文本
     */
    public function __construct($query_url, $guard_name)
    {
        //引入父级构造
        parent::__construct('form', $query_url, $guard_name);
        //设置基础信息
        $this->query($query_url, 'post')->size()->after_refresh();
    }

    /**
     * 设置模态框尺寸
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 22:59:40
     * @param string $size sm（300px）、lg（800px）、xl(1140px)、fullscreen
     * @return FormBuilder
     */
    public function size($size = 'lg')
    {
        //设置模态框尺寸
        return $this->setParam('size', $size);
    }

    /**
     * 设置关闭Modal后表格刷新
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 22:54:01
     * @return FormBuilder
     */
    public function after_refresh()
    {
        //设置关闭Modal后表格刷新
        return $this->setParam('after', 'refresh');
    }


    /**
     * 设置关闭Modal后不执行任何操作
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 23:03:44
     * @return FormBuilder
     */
    public function after_none()
    {
        //设置关闭Modal后不执行任何操作
        return $this->setParam('after', 'none');
    }

    /**
     * 设置关闭Modal后刷新页面
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 22:55:02
     * @return FormBuilder
     */
    public function after_reload()
    {
        //设置关闭Modal后刷新页面
        return $this->setParam('after', 'reload');
    }

    /**
     * 设置关闭Modal后跳转指定链接
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 22:56:06
     * @param $url
     * @return FormBuilder
     */
    public function after_redirect($url)
    {
        //设置关闭Modal后跳转指定链接
        return $this->setParam('after', $url);
    }


}
