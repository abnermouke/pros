<?php


namespace Abnermouke\Pros\Builders\Form\Tools\Buttons;

/**
 * 跳转按钮构建器
 * Class RedirectBuilder
 * @package Abnermouke\Pros\Builders\Form\Tools\Buttons
 */
class RedirectBuilder extends BasicBuilder
{

    /**
     * 构造函数
     * RedirectBuilder constructor.
     * @param $query_url string 请求/条件链接
     * @param $guard_name string 按钮文本
     */
    public function __construct($query_url, $guard_name)
    {
        //引入父级构造
        parent::__construct('redirect', $query_url, $guard_name);
        //设置基础信息
        $this->target(false);
    }

    /**
     * 设置新开窗口打开链接
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 23:06:28
     * @param bool $target
     * @return RedirectBuilder
     */
    public function target($target = true)
    {
        //设置新开窗口打开链接
        return $this->setParam('target', $target);
    }

}
