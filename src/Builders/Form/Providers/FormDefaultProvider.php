<?php

namespace Abnermouke\Pros\Builders\Form\Providers;

use Abnermouke\EasyBuilder\Library\Currency\ValidateLibrary;
use Abnermouke\EasyBuilder\Module\BaseModel;
use Abnermouke\Pros\Builders\BuilderProvider;
use Abnermouke\Pros\Builders\Form\Tools\Buttons\AjaxBuilder;
use Abnermouke\Pros\Builders\Form\Tools\Buttons\RedirectBuilder;
use Abnermouke\Pros\Builders\Form\Tools\FormButtonBuilder;
use Abnermouke\Pros\Builders\Form\Tools\FormItemBuilder;
use Abnermouke\Pros\Builders\Form\Tools\FormTabBuilder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * 表单基础构建器（默认主题）
 * Class FormDefaultProvider
 * @package Abnermouke\Pros\Builders\Form\Providers
 */
class FormDefaultProvider
{
    // 构建参数
    private $builder = [
        'sign' => '',
        'theme' => '',
        'template' => '',
        'items' => [],
        'submit' => [],
        'back' => [],
        'tabs' => [],
        'title' => '',
        'description' => '',
        'triggers' => [],
        'data' => [],
        'panels' => [],
        'colors' => [],
    ];

    /**
     * 构建函数
     * FormDefaultProvider constructor.
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __construct()
    {
        //配置基础信息
        $this->setSign(\request()->get('sign', Str::random(10)))->setTheme(\request()->get('theme', 'default'));
        //设置主题颜色
        $this->builder['colors'] = BuilderProvider::THEME_COLORS;
    }

    /**
     * 设置标题信息
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-15 00:42:50
     * @param $title
     * @return $this
     */
    public function setTitle($title)
    {
        //设置标题信息
        $this->builder['title'] = $title;
        //返回当前实例对象
        return $this;
    }

    /**
     * 设置描述信息
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-15 00:42:44
     * @param $description
     * @return $this
     */
    public function setDescription($description)
    {
        //设置描述信息
        $this->builder['description'] = $description;
        //返回当前实例对象
        return $this;
    }

    /**
     * 添加实例选项卡
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-15 00:33:01
     * @param \Closure $callback
     * @return $this
     */
    public function setTabs(\Closure $callback)
    {
        //整理选项卡对象构造器
        $tabBuilder = new FormTabBuilder();
        //获取标签信息
        $tabs = tap($tabBuilder, $callback)->tabs;
        //循环选项卡对象
        foreach ($tabs as $k => $tab) {
            //获取选项卡内容
            $this->builder['tabs'][] = $tab->get();
        }
        //返回当前实例对象
        return $this;
    }

    /**
     * 设置唯一标识
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-15 00:25:41
     * @param $sign
     * @return $this
     */
    protected function setSign($sign)
    {
        //设置表格唯一标示
        $this->builder['sign'] = $sign;
        //返回当前实例对象
        return $this;
    }

    /**
     * 设置渲染主题
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-15 00:26:27
     * @param $theme
     * @return $this
     */
    public function setTheme($theme)
    {
        //设置渲染对象
        $this->builder['theme'] = strtolower($theme);
        $this->builder['template'] = 'vendor.pros.console.builder.form.'.strtolower($theme).'.master';
        //返回当前实例对象
        return $this;
    }

    /**
     * 设置渲染数据
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-15 00:43:34
     * @param false $data
     * @return $this
     */
    public function data($data = false)
    {
        //判断数据
        if ($data) {
            //设置渲染数据
            $this->builder['data'] = $data;
        }
        //返回当前实例
        return $this;
    }

    /**
     * 设置提交按钮
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-20 23:25:48
     * @param string $query_url 请求地址
     * @param string $confirm_tip 请求前提示
     * @param string $guard_name 按钮文案
     * @param string $query_method 请求方式
     * @param string $theme 按钮主题
     * @return $this
     * @throws \Exception
     */
    public function setSubmit($query_url, $confirm_tip = '信息提交后将立即生效，请确认继续操作？', $guard_name = '立即提交', $after = 'reload', $query_method = 'post', $theme = 'success')
    {
        //判断链接可用性
        if (ValidateLibrary::link($query_url)) {
            //设置按钮信息
            $button = (new AjaxBuilder($query_url, $guard_name))->theme($theme)->confirmed($confirm_tip)->query($query_url, $query_method)->after_redirect($after)->get();
            //整理基础信息
            $params = Arr::except($button, ($keys = ['type', 'theme', 'icon', 'confirm_tip']));
            //设置按钮信息
            $this->builder['submit'] = array_merge($button, ['params' => $params]);
        }
        //返回当前实例对象
        return $this;
    }

    /**
     * 设置返回按钮信息
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-20 23:22:11
     * @param string $query_url 返回链接
     * @param string $guard_name 提示文字
     * @param string $theme 按钮主题
     * @return $this
     * @throws \Exception
     */
    public function setBack($query_url, $guard_name = '返回', $theme = 'default')
    {
        //判断链接可用性
        if (ValidateLibrary::link($query_url)) {
            //设置按钮信息
            $button = (new RedirectBuilder($query_url, $guard_name))->theme($theme)->get();
            //整理基础信息
            $params = Arr::except($button, ($keys = ['type', 'theme', 'icon', 'confirm_tip']));
            //设置按钮信息
            $this->builder['back'] = array_merge($button, ['params' => $params]);
        }
        //返回当前实例对象
        return $this;
    }

    /**
     * 设置内容项信息
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-15 01:06:53
     * @param \Closure $callback
     * @return $this
     */
    public function setItems(\Closure $callback)
    {
        //整理内容项构建器
        $itemBuilder = new FormItemBuilder();
        //设置构建器内容相
        $this->builder['items'] = tap($itemBuilder, $callback)->items;
        //循环内容项
        foreach ($this->builder['items'] as $k => $item) {
            //获取内容项
            $this->builder['items'][$k] = $item->get();
        }
        //返回当前实例对象
        return $this;
    }

    /**
     * 设置默认数据
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-21 18:05:15
     * @param $data
     * @return $this
     */
    public function setData($data)
    {
        //判断信息
        if ($data) {
            //设置数据
            $this->builder['data'] = $data;
        }
        //返回当前实例对象
        return $this;
    }

    /**
     * 渲染前置操作
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-23 14:31:08
     * @return array
     */
    private function beforeRender()
    {
        //判断是否设置分栏
        if ($this->builder['tabs']) {
            //循环分栏设置面板信息
            foreach ($this->builder['tabs'] as $tab) {
                //设置面板信息
                $this->builder['panels'][$tab['alias']] = $tab['groups'];
            }
        } else {
            //设置默认面板信息
            $this->builder['panels'][Str::random(10)] = [
                ['fields' => array_column($this->builder['items'], 'field')]
            ];
        }
        //整理信息
        $this->builder['items'] = array_column($this->builder['items'], null, 'field');
        //循环所有字段
        foreach ($this->builder['items'] as $field => $config) {
            //根据类型处理
            switch ($config['type']) {
                case 'checkbox':
                case 'image_checkbox':
                case 'normal_checkbox':
                case 'files':
                case 'tags':
                case 'values':
                    //判断内容是否存在
                    if ($data = data_get($this->builder['data'], $field, false)) {
                        //设置默认值
                        $config['default_value'] = object_2_array($data);
                    }
                    break;
                case 'dynamic':
                case 'select':
                    //设置默认信息
                    $config['default_value'] = data_get($this->builder['data'], $field, $config['default_value']);
                    //判断是否多选
                    if ($config['multiple']) {
                        //设置默认值
                        $config['default_value'] = object_2_array($config['default_value']);
                    }
                    break;
                case 'input':
                    //设置默认值信息
                    $default_value = data_get($this->builder['data'], $field, $config['default_value']);;
                    //判断是否为金额
                    if ($config['input_mode'] === 'price' && data_get($config, 'ratio', 0) > 0 && (int)$default_value > 0) {
                        //设置默认信息
                        $default_value = $default_value/(int)$config['ratio'];
                    }
                    //设置默认信息
                    $config['default_value'] = $default_value;
                    break;
                case 'pictures':
                    //判断宽度是否大于200
                    if ((int)$config['width'] > 200) {
                        //更改box宽度
                        $config['box_width'] = 200;
                        //更改高度
                        $config['box_height'] = (int)((int)$config['height'] * (200/(int)$config['width']));
                    }
                    //判断内容是否存在
                    if ($data = data_get($this->builder['data'], $field, false)) {
                        //设置默认值
                        $config['default_value'] = object_2_array($data);
                    }
                    break;
                case 'image':
                    //判断宽度是否大于200
                    if ((int)$config['width'] > 200) {
                        //更改box宽度
                        $config['box_width'] = 200;
                        //更改高度
                        $config['box_height'] = (int)((int)$config['height'] * (200/(int)$config['width']));
                    }
                    //设置默认信息
                    $config['default_value'] = data_get($this->builder['data'], $field, $config['default_value']);
                    //判断是否设置描述
                    if (!$config['description'] && $config['cropper']) {
                        //设置默认提示
                        $config['description'] = '建议尺寸：'.$config['width'].' x '.$config['height'].' 及其等比例放大/缩小尺寸，允许文件类型：'.$config['accept'].'，预览图片将进行压缩，如显示较模糊请忽略。';
                    }
                    break;
                default:
                    //设置默认信息
                    $config['default_value'] = data_get($this->builder['data'], $field, $config['default_value']);
                    break;
            }
            //设置信息
            $this->builder['items'][$field] = $config;
        }
        //返回构建器信息
        return $this->builder;
    }

    /**
     * 初始化触发字段显示与隐藏
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-21 20:13:55
     * @return bool
     */
    private function initTriggerFileds()
    {
        //循环所有字段
        foreach ($this->builder['items'] as $field => $config) {
            //判断是否为radio或者switch
            if (isset($config['triggers']) && in_array($config['type'], ['radio', 'normal_radio', 'image_radio', 'switch']) && $config['triggers']) {
                //循环触发
                foreach ($config['triggers'] as $value => $rules) {
                    //判断存在规则
                    if ($rules) {
                        //判断当前的值
                        if ($value == $config['default_value']) {
                            //循环显示字段
                            foreach ($rules as $show_field) {
                                //设置显示
                                data_set($this->builder, 'items.'.$show_field.'.hidden', false);
                            }
                        } else {
                            //循环显示字段
                            foreach ($rules as $show_field) {
                                //设置隐藏
                                data_set($this->builder, 'items.'.$show_field.'.hidden', true);
                            }
                        }
                    }
                }
            }
        }
        //返回成功
        return true;
    }

    /**
     * 渲染页面
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-15 01:33:34
     * @return string
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function render()
    {
        //执行前置操作
        $this->beforeRender();
        $this->initTriggerFileds();
        //判断是否debug
        if ((int)\request()->get('__PROS_DEBUG__', 0) === 1) {
            //打印配置
            dd($this->builder);
        }
        //渲染页面
        return view()->make($this->builder['template'], $this->builder)->render();
    }

}
