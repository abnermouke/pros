<?php

namespace Abnermouke\Pros\Builders\Table\Providers;

use Abnermouke\EasyBuilder\Library\Currency\ValidateLibrary;
use Abnermouke\Pros\Builders\Table\Tools\TableActionBuilder;
use Abnermouke\Pros\Builders\Table\Tools\TableItemBuilder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

/**
 * 表格构建器内容服务提供者
 * Class TableContentProvider
 * @package Abnermouke\Pros\Builders\Table\Providers
 */
class TableContentProvider
{

    //构建参数
    private $builder = [
        'sign' => '',
        'theme' => '',
        'template' => '',
        'export' => true,
        'checkbox' => false,
        'pagination' => false,
        'items' => [],
        'append' => false,
        'lists' => [],
        'actions' => false,
        'column_count' => 0,
        'target' => false,
        'trigger' => false,
    ];

    /**
     * 构造函数
     * TableContentProvider constructor.
     */
    public function __construct()
    {
        //设置基础信息
        $this->setSign(Str::random(10))->setTheme();
    }

    /**
     * 设置表格唯一标识
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 00:37:30
     * @param $sign
     * @return $this
     */
    public function setSign($sign)
    {
        //设置表格唯一标识
        $this->builder['sign'] = $sign;
        //返回当前实例对象
        return $this;
    }

    /**
     * 设置渲染主题
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 00:43:08
     * @param string $theme
     * @return $this
     */
    public function setTheme($theme = 'default')
    {
        //设置渲染对象
        $this->builder['theme'] = $theme;
        $this->builder['template'] = 'vendor.pros.console.builder.table.'.strtolower($theme).'.content';
        $this->builder['pagination'] = $this->builder['pagination'] ? 'vendor.pros.console.builder.table.'.strtolower($theme).'.pagination' : false;
        //返回当前实例对象
        return $this;
    }

    /**
     * 设置自定义实例触发对象
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-14 00:40:57
     * @param $sign string 父级表格标识
     * @param $column_count int 占用表格字段项
     * @param $target string 被触发class名
     * @param $trigger_alias string 父级触发对象唯一标识
     * @return $this
     */
    public function target($sign, $column_count, $target, $trigger_alias)
    {
        //设置签名
        $this->builder['sign'] = $sign;
        //设置被触发对象
        $this->builder['target'] = $target;
        //设置触发对象唯一标识
        $this->builder['trigger'] = $trigger_alias;
        //设置字段数量
        $this->builder['column_count'] = (int)$column_count;
        //返回当前实例对象
        return $this;
    }

    /**
     * 集成基础表格签名
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 21:50:21
     * @param $signature
     * @return $this
     */
    public function signature($signature)
    {
        //解密签名
        if ($decrypt = Crypt::decrypt($signature)) {
            //覆盖基础配置
            $this->builder = array_merge($this->builder, $decrypt);
            //单独配置信息
            $this->setSign(data_get($decrypt, 'sign', $this->builder['sign']))->setTheme(data_get($decrypt, 'theme', $this->builder['theme']));
        }
        //返回当前实例对象
        return $this;
    }

    /**
     * 设置列表数据
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 15:22:36
     * @param $lists
     * @return $this
     */
    public function setLists($lists)
    {
        //设置数据
        $this->builder['lists'] = $lists;
        //返回当前实例对象
        return $this;
    }

    /**
     * 设置表单项操作信息
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 00:45:12
     * @param \Closure $callback
     * @return $this
     */
    public function setActions(\Closure $callback)
    {
        //整理操作构造器
        $actionBuilder = new TableActionBuilder();
        //设置构建器操作
        $this->builder['actions'] = tap($actionBuilder, $callback)->actions;
        //循环操作
        foreach ($this->builder['actions'] as $k => $action) {
            //获取操作
            $action = $action->get();
            //整理基础信息
            $params = Arr::except($action, ($keys = ['type', 'theme', 'icon', 'id_suffix', 'confirm_tip']));
            //设置操作信息
            $this->builder['actions'][$k] = array_merge($action, ['params' => $params]);
        }
        //返回当前实例对象
        return $this;
    }

    /**
     * 设置追加显示配置
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 14:28:12
     * @param string $trigger  字符串为指定唯一判断字段，链接为触发请求链接
     * @param string $trigger_method 触发请求链接时请求方式
     * @return $this
     * @throws \Exception
     */
    public function append($trigger = 'id', $trigger_method = 'post')
    {
        //整理追加显示基本配置
        $append = ['method' => 'more', 'trigger' => $trigger];
        //判断触发是否为链接
        if (ValidateLibrary::link($trigger)) {
            //设置为追加子列表显示触发
            $append = ['method' => $trigger_method, 'trigger' => $trigger];
        } else {
            //设置信息
            $append['trigger'] = strstr($trigger, '__') ? $trigger : '__'.strtoupper($trigger).'__';
        }
        //设置追加显示配置
        $this->builder['append'] = $append;
        //返回当前实例对象
        return $this;
    }

    /**
     * 设置内容项信息
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 23:25:40
     * @param \Closure $callback
     * @return $this
     */
    public function setItems(\Closure $callback)
    {
        //整理内容项构建器
        $itemBuilder = new TableItemBuilder();
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
     * 渲染前置操作
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 15:44:56
     * @return array
     */
    private function beforeRender()
    {
        //循环字段信息
        foreach ($this->builder['items'] as $k => $item) {

        }
        //返回构建器数据
        return $this->builder;
    }

    /**
     * 渲染页面
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 15:38:18
     * @param bool $onlyContent 是否只返回内容
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function render($onlyContent = false)
    {
        //执行前置操作
        $this->beforeRender();
        //判断是否debug
        if ((int)\request()->get('__PROS_DEBUG__', 0) === 1) {
            //打印配置
            dd($this->builder);
        }
        //判断是否只返回内容
        if (!$onlyContent) {
            //配置页码信息
            $pagination = $this->builder['pagination'] ? view()->make($this->builder['pagination'], $this->builder['lists'])->render() : '';
        }
        //获取总数量
        $total_match_count = (int)data_get($this->builder['lists'], 'matched_count', 0);
        //配置内容信息
        $content = view()->make($this->builder['template'], $this->builder)->render();
        //渲染页面
        return $onlyContent ? $content : compact('pagination', 'content', 'total_match_count');
    }

}
