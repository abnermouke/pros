<?php

namespace Abnermouke\Pros\Builders\Table\Tools\Actions;

/**
 * 模态框操作构建器
 * Class ModalBuilder
 * @package Abnermouke\Pros\Builders\Table\Tools\Actions
 */
class ModalBuilder extends BasicBuilder
{

    /**
     * 构造函数
     * ModalBuilder constructor.
     * @param $query_url string 请求/条件链接
     * @param $guard_name string 操作文本
     */
    public function __construct($query_url, $guard_name)
    {
        //引入父级构造
        parent::__construct('modal', $query_url, $guard_name);
        //设置基础信息
        $this->query($query_url, 'post')->size()->after_none()->bind_model_id();
    }

    /**
     * 设置模态框尺寸
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 22:59:40
     * @param string $size
     * @return ModalBuilder
     */
    public function size($size = 'lg')
    {
        //设置模态框尺寸
        return $this->setParam('size', $size);
    }

    /**
     * 设置绑定本地modalID
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-14 14:15:47
     * @param string $id
     * @return \Abnermouke\Pros\Builders\Table\Tools\Buttons\ModalBuilder
     */
    public function bind_model_id($id = '')
    {
        //设置绑定本地modalID
        return $this->setParam('bind_modal_id', $id);
    }

    /**
     * 设置关闭Modal后表格刷新
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 22:54:01
     * @return ModalBuilder
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
     * @return ModalBuilder
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
     * @return ModalBuilder
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
     * @return ModalBuilder
     */
    public function after_redirect($url)
    {
        //设置关闭Modal后跳转指定链接
        return $this->setParam('after', $url);
    }


}
