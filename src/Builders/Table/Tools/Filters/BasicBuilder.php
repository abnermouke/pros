<?php

namespace Abnermouke\Pros\Builders\Table\Tools\Filters;

/**
 * 筛选基础构建器
 * Class BasicBuilder
 * @package Abnermouke\Pros\Builders\Table\Tools\Filters
 */
class BasicBuilder
{
    /**
     * 构建对象
     * @var string[]
     */
    protected $builder = [
        'field' => '',
        'type' => '',
        'guard_name' => '',
        'default_value' => '',
        'col_number' => 2,
        'tabs' => [],
    ];

    /**
     * 构造函数
     * BasicBuilder constructor.
     * @param $type string 筛选类型
     * @param $field string 筛选字段
     * @param $guard_name string 提示文字
     */
    public function __construct($type, $field, $guard_name)
    {
        //设置基础信息
        $this->field($field)->guard_name($guard_name)->type($type)->default_value('')->col(2)->tabs();
    }

    /**
     * 设置筛选类型
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 15:20:33
     * @param $type
     * @return $this
     */
    protected function type($type)
    {
        //设置筛选类型
        return $this->setParam('type', $type);
    }

    /**
     * 设置提示文字
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 15:19:13
     * @param $guard_name
     * @return $this
     */
    protected function guard_name($guard_name)
    {
        //设置提示文字
        return $this->setParam('guard_name', $guard_name);
    }

    /**
     * 设置字段
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 15:18:32
     * @param $field
     * @return $this
     */
    protected function field($field)
    {
        //设置字段
        return $this->setParam('field', $field);
    }

    /**
     * 设置默认值
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 15:25:54
     * @param $value
     * @return $this
     */
    public function default_value($value = '')
    {
        //判断是否为有效值
        if (strlen($value) > 0) {
            //设置默认值
            return $this->setParam('default_value', $value);
        }
        //返回当前实例对象
        return $this;
    }

    /**
     * 设置显示栏数（1-12）
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 15:27:57
     * @param int $number
     * @return $this
     */
    public function col($number = 2)
    {
        //判断是否为有效栏数
        if ((int)$number <= 0) {
            //设置默认栏数
            $number = 2;
        } elseif ((int)$number > 12) {
            //设置最大栏数
            $number = 12;
        }
        //设置显示栏数
        return $this->setParam('col_number', (int)$number);
    }

    /**
     * 设置绑定TAB
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 14:00:16
     * @param array $tabs 绑定的tab标识，为空代表所有tab都显示，不为空代表仅在指定tab选中时显示
     * @return $this
     */
    public function tabs($tabs = [])
    {
        //设置绑定TAB
        return $this->setParam('tabs', $tabs);
    }

    /**
     * 新增/更新构建器参数
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 15:21:55
     * @param $key
     * @param $value
     * @return $this
     */
    protected function setParam($key, $value)
    {
        //设置参数
        $this->builder[$key] = $value;
        //返回当前实例
        return $this;
    }

    /**
     * 获取构建器参数
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 15:22:11
     * @return string[]
     */
    public function get()
    {
        return $this->builder;
    }

}
