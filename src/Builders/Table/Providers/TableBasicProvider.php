<?php

namespace Abnermouke\Pros\Builders\Table\Providers;

use Abnermouke\EasyBuilder\Library\Currency\ValidateLibrary;
use Abnermouke\Pros\Builders\BuilderProvider;
use Abnermouke\Pros\Builders\Table\Tools\TableActionBuilder;
use Abnermouke\Pros\Builders\Table\Tools\TableButtonBuilder;
use Abnermouke\Pros\Builders\Table\Tools\TableFilterBuilder;
use Abnermouke\Pros\Builders\Table\Tools\TableItemBuilder;
use Abnermouke\Pros\Builders\Table\Tools\TableTabBuilder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

/**
 * 基础表格构建服务提供者
 * Class TableBasicProvider
 * @package Abnermouke\Pros\Builders\Table\Providers
 */
class TableBasicProvider
{

    //构建参数
    private $builder = [
        'alerts' => [],
        'sign' => '',
        'theme' => '',
        'template' => '',
        'query_url' => '',
        'query_method' => 'post',
        'filters' => [],
        'tabs' => [],
        'buttons' => [],
        'items' => [],
        'pagination' => false,
        'export' => true,
        'checkbox' => false,
        'heads' => [],
        'sorts' => [],
        'sort_fields' => [],
        'actions' => false,
        'append' => false,
        'column_count' => 0,
        'colors' => [],
    ];

    /**
     * 构造函数
     * TableBasicProvider constructor.
     */
    public function __construct()
    {
        //设置基础信息
        $this->setSign(\request()->get('sign', Str::random(10)))->setTheme(\request()->get('theme', 'default'));
        //设置主题颜色
        $this->builder['colors'] = BuilderProvider::THEME_COLORS;
    }

    /**
     * 设置请求信息
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-28 14:44:56
     * @param $url
     * @param string $method
     * @return $this
     * @throws \Exception
     */
    public function setQuery($url, $method = 'post')
    {
        //判断链接是否有效
        if (ValidateLibrary::link($url)) {
            //设置请求信息
            $this->builder['query_url'] = $url;
            $this->builder['query_method'] = $method;
        }
        //返回当前实例对象
        return $this;
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
     * 添加提示信息
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 00:39:15
     * @param $text
     * @param string $theme
     * @return $this
     */
    public function addAlert($text, $theme = 'primary')
    {
        //判断文本
        if ($text = trim($text)) {
            //添加提示信息
            $this->builder['alerts'][] = compact('text', 'theme');
        }
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
        $this->builder['template'] = 'vendor.pros.console.builder.table.'.strtolower($theme).'.master';
        //返回当前实例对象
        return $this;
    }

    /**
     * 设置筛选条件
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 00:45:12
     * @param \Closure $callback
     * @return $this
     */
    public function setFilters(\Closure $callback)
    {
        //整理筛选对象构造器
        $filterBuilder = new TableFilterBuilder;
        //设置构建器筛选项目
        $this->builder['filters'] = tap($filterBuilder, $callback)->filters;
        //循环筛选对象
        foreach ($this->builder['filters'] as $k => $filter) {
            //获取筛选内容
            $this->builder['filters'][$k] = $filter->get();
        }
        //返回当前实例对象
        return $this;
    }

    /**
     * 添加实例选项卡
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-28 14:47:03
     * @param \Closure $callback
     * @return $this
     * @throws \Exception
     */
    public function setTabs(\Closure $callback)
    {
        //整理选项卡对象构造器
        $tabBuilder = new TableTabBuilder();
        //获取标签信息
        $tabs = tap($tabBuilder, $callback)->tabs;
        //循环选项卡对象
        foreach ($tabs as $k => $tab) {
            //获取标签信息
            $tab = $tab->get();
            //判断请求信息是否有效
            if (ValidateLibrary::link($tab['query_url'])) {
                //获取选项卡内容
                $this->builder['tabs'][] = $tab;
            }
        }
        //排序信息
        sort($this->builder['sorts']);
        //返回当前实例对象
        return $this;
    }

    /**
     * 设置按钮信息
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 00:45:12
     * @param \Closure $callback
     * @return $this
     */
    public function setButtons(\Closure $callback)
    {
        //整理按钮构造器
        $buttonBuilder = new TableButtonBuilder();
        //设置构建器按钮
        $this->builder['buttons'] = tap($buttonBuilder, $callback)->buttons;
        //循环按钮
        foreach ($this->builder['buttons'] as $k => $button) {
            //获取按钮
            $button = $button->get();
            //整理基础信息
            $params = Arr::except($button, ($keys = ['type', 'theme', 'icon', 'id_suffix', 'confirm_tip']));
            //设置按钮信息
            $this->builder['buttons'][$k] = array_merge($button, ['params' => $params]);
        }
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
     * 设置页码信息（不配置不显示页码）
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 21:57:01
     * @param int $page
     * @param int $page_size
     * @param int[] $allow_page_sizes
     * @return $this
     */
    public function pagination($page = 1, $page_size = 20, $allow_page_sizes = [10, 20, 30, 40, 50, 100])
    {
        //设置页码信息
        $this->builder['pagination'] = compact('page', 'page_size', 'allow_page_sizes');
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
     * 设置是否可导出列表内容
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 23:15:14
     * @param bool $export
     * @return $this
     */
    public function export($export = true)
    {
        //设置可打印列表数据
        $this->builder['export'] = $export;
        //返回当前实例对象
        return $this;
    }

    /**
     * 设置表格复选框配置
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 23:19:33
     * @param $field
     * @param array $trigger_button_id_suffix
     * @return $this
     */
    public function checkbox($field, $trigger_button_id_suffix = [])
    {
        //判断字段名
        if (strlen($field) > 0) {
            //设置列表复选框
            $this->builder['checkbox'] = compact('field', 'trigger_button_id_suffix');
        } else {
            //设置不显示复选框
            $this->builder['checkbox'] = false;
        }
        //返回当前实例对象
        return $this;
    }

    /**
     * 不显示表格头部
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 01:02:28
     * @return $this
     */
    public function withoutHead()
    {
        //不显示头部(thead)
        $this->builder['heads'] = false;
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
     * 渲染前置处理
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 14:17:18
     * @return array
     * @throws \Exception
     */
    private function beforeRender()
    {
        //整理头部字段以及排序字段
        $heads = $sorts = $sort_fields = [];
        //循环字段信息
        foreach ($this->builder['items'] as $k => $item) {
            //判断是否显示
            if ($item['show']) {
                //设置头部字段
                $heads[$item['field']] = $item['guard_name'];
                //增加可显示字段数量
                $this->builder['column_count'] += 1;
            }
            //判断是否开启排序
            if ($item['sorting']) {
                //设置排序
                $sorts[] = $item['field'];
                //设置排序字段名称
                $sort_fields[$item['field']] = (!empty($item['sort_table_name'])) ? ($item['sort_table_name'].'.'.$item['field']) : $item['field'];
            }
        }
        //设置排序信息
        $this->builder['sorts'] = $sorts;
        $this->builder['sort_fields'] = $sort_fields;
        //判断是否显示
        if (is_array($this->builder['heads'])) {
            //设置头部字段
            $this->builder['heads'] = $heads;
        }
        //判断是否存在隐藏
        if (count($heads) < count($this->builder['items']) && !$this->builder['append']) {
            //设置更多触发
            $this->append();
        }
        //设置表格显示字段数量
        $this->builder['column_count'] += ($this->builder['append'] ? 1 : 0) + ($this->builder['checkbox'] ? 1 : 0) + ($this->builder['actions'] ? 1 : 0);
        //判断存在tab是否存在
        if ($this->builder['tabs']) {
            //设置全局默认请求
            $this->builder['query_url'] = $this->builder['tabs'][0]['query_url'];
            $this->builder['query_method'] = $this->builder['tabs'][0]['query_method'];
        }
        //返回构建器数据
        return $this->builder;
    }

    /**
     * 渲染页面
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 17:01:56
     * @return string
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function render()
    {
        //执行前置操作
        $this->beforeRender();
        //生成签名
        $this->builder['signature'] = Crypt::encrypt(Arr::only($this->builder, ['sign', 'theme', 'append', 'export', 'checkbox', 'items', 'pagination', 'column_count', 'actions']));
        //判断是否debug
        if ((int)\request()->get('__PROS_DEBUG__', 0) === 1) {
            //打印配置
            dd($this->builder);
        }
        //渲染页面
        return view()->make($this->builder['template'], $this->builder)->render();
    }

}
