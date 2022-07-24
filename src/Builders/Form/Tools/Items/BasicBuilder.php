<?php

namespace Abnermouke\Pros\Builders\Form\Tools\Items;

/**
 * 表单内容项基础构建器
 * Class BasicBuilder
 * @package Abnermouke\Pros\Builders\Form\Tools\Items
 */
class BasicBuilder
{

    //构建器配置
    protected $builder = [
        'type' => '',
        'field' => '',
        'guard_name' => '',
        'description' => '',
        'tip' => '',
        'required' => false,
        'default_value' => '',
        'readonly' => false,
        'disabled' => false,
        'hidden' => false,
        'cols' => [
            'md' => 12,
            'xs' => 12,
            'sm' => 12,
            'lg' => 12
        ],
    ];

    /**
     * 构造函数
     * BasicBuilder constructor.
     * @param $type string 构建类型
     * @param $field string 构建字段
     * @param $guard_name string 显示名称
     */
    public function __construct($type, $field, $guard_name)
    {
        //设置基础信息
        $this->type($type)->field($field)->guard_name($guard_name)->cols();
    }

    /**
     * 设置内容描述
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-15 01:11:50
     * @param string $description
     * @return $this
     */
    public function description($description = '')
    {
        //设置内容描述
        return $this->setParam('description', $description);
    }

    /**
     * 设置bootstrap显示栅格系统尺寸（最大12）
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-18 23:38:30
     * @param int $lg 大屏幕占比
     * @param int $md 中等屏幕占比
     * @param int $sm 小屏幕占比
     * @param int $xs 超小屏幕占比
     * @return $this
     */
    public function cols($lg = 12, $md = 12, $sm = 12, $xs = 12)
    {
        //设置bootstrap显示栅格系统尺寸
        return $this->setParam('cols', compact('lg', 'md', 'sm', 'xs'));
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
     * 设置只读
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 00:28:59
     * @param bool $readonly 是否只读
     * @return $this
     * @throws \Exception
     */
    public function readonly($readonly = true)
    {
        //设置只读
        return $this->setParam('readonly', $readonly);
    }

    /**
     * 设置禁用
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 00:28:59
     * @param bool $disabled 是否禁用
     * @return $this
     * @throws \Exception
     */
    public function disabled($disabled = true)
    {
        //设置禁用
        return $this->setParam('disabled', $disabled);
    }

    /**
     * 设置是否必选
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 00:28:59
     * @param bool $required 是否必选
     * @return $this
     * @throws \Exception
     */
    public function required($required = true)
    {
        //设置是否必选
        return $this->setParam('required', $required);
    }

    /**
     * 设置显示提示
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-15 01:13:58
     * @param $tip
     * @return $this
     */
    public function tip($tip)
    {
        //设置显示名称
        return $this->setParam('tip', $tip);
    }

    /**
     * 设置默认值
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-15 01:13:52
     * @param $value
     * @return $this
     */
    public function default_value($value)
    {
        //设置默认值
        return $this->setParam('default_value', $value);
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
     * 添加触发规则
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 01:15:04
     * @param $value mixed 触发值
     * @param array $trigger_show_fields 显示字段
     * @return $this
     */
    protected function addTrigger($value, $trigger_show_fields = [])
    {
        //添加触发
        $this->builder['triggers'][$value] = $trigger_show_fields;
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
