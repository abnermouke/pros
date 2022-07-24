<?php


namespace Abnermouke\Pros\Builders\Table\Tools;

use Abnermouke\Pros\Builders\Table\Tools\Actions\AjaxBuilder;
use Abnermouke\Pros\Builders\Table\Tools\Actions\FormBuilder;
use Abnermouke\Pros\Builders\Table\Tools\Actions\ModalBuilder;
use Abnermouke\Pros\Builders\Table\Tools\Actions\RedirectBuilder;

/**
 * 表格内容项操作构建器
 * Class TableActionBuilder
 * @package Abnermouke\Pros\Builders\Table\Tools
 */
class TableActionBuilder
{
    //表格操作配置
    public $actions = [];

    /**
     * 设置跳转操作实例对象
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 23:09:35
     * @param $url string 跳转链接
     * @param $guard_name string 操作文本
     * @return RedirectBuilder
     */
    public function redirect($url, $guard_name)
    {
        //设置构建器对象
        $this->actions[] = $builder =  new RedirectBuilder($url, $guard_name);
        //返回构建器对象
        return $builder;
    }

    /**
     * 设置Ajax请求操作实例对象
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 23:09:35
     * @param $url string 请求链接
     * @param $guard_name string 操作文本
     * @return AjaxBuilder
     */
    public function ajax($url, $guard_name)
    {
        //设置构建器对象
        $this->actions[] = $builder =  new AjaxBuilder($url, $guard_name);
        //返回构建器对象
        return $builder;
    }

    /**
     * 设置模态框操作实例对象
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 23:09:35
     * @param $url string modal内容请求链接
     * @param $guard_name string 操作文本
     * @return ModalBuilder
     */
    public function modal($url, $guard_name)
    {
        //设置构建器对象
        $this->actions[] = $builder = new ModalBuilder($url, $guard_name);
        //返回构建器对象
        return $builder;
    }

    /**
     * 设置表单模态框操作实例对象
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 23:09:35
     * @param $url string modal内表单实例化请求链接
     * @param $guard_name string 操作文本
     * @return FormBuilder
     */
    public function form($url, $guard_name)
    {
        //设置构建器对象
        $this->actions[] = $builder = new FormBuilder($url, $guard_name);
        //返回构建器对象
        return $builder;
    }
}
