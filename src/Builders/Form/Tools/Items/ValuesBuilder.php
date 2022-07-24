<?php

namespace Abnermouke\Pros\Builders\Form\Tools\Items;

use Abnermouke\EasyBuilder\Module\BaseModel;

/**
 * 多项值表单构建器
 * Class ValuesBuilder
 * @package Abnermouke\Pros\Builders\Form\Tools\Items
 */
class ValuesBuilder extends BasicBuilder
{
    /**
     * 构造函数
     * ValuesBuilder constructor.
     * @param $field
     * @param $guard_name
     */
    public function __construct($field, $guard_name)
    {
        //引入父级构造
        parent::__construct('values', $field, $guard_name);
        //设置默认信息
        $this->builder['columns'] = [];
    }
    /**
     * 添加文本框
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 02:52:34
     * @param $key mixed value字段名
     * @param $guard_name string 显示文字
     * @param string $input_type 输入框类型
     * @param array $extras 额外参数
     * @return ValuesBuilder
     */
    public function addInput($key, $guard_name, $input_type = 'text', $extras = [])
    {
        //设置默认类型
        $type = 'input';
        //添加输入框项
        $this->builder['columns'][] = compact('key', 'guard_name', 'type', 'input_type', 'extras');
        //返回当前实例
        return $this;
    }

    /**
     * 添加选择框项
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 02:50:54
     * @param $key mixed value字段名
     * @param $guard_name string 显示文字
     * @param array $options 选项内容 [key_1 => guard_name_1, key_2 => guard_name_2]
     * @param array $extras 额外参数
     * @return ValuesBuilder
     */
    public function addSelect($key, $guard_name, $options = [], $extras = [])
    {
        //设置默认类型
        $type = 'select';
        //添加选择框项
        $this->builder['columns'][] = compact('key', 'guard_name', 'type', 'options', 'extras');
        //返回当前实例
        return $this;
    }

    /**
     * 添加Switch开关
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-30 12:41:44
     * @param $key mixed value字段名
     * @param $guard_name string 显示文字
     * @param mixed $on_value 开启时值
     * @param mixed $off_value 关闭时值
     * @param array $extras 额外参数
     * @return ValuesBuilder
     */
    public function addSwitch($key, $guard_name, $on_value = BaseModel::SWITCH_ON, $off_value = BaseModel::SWITCH_OFF, $extras = [])
    {
        //设置类型
        $type = 'switch';
        //添加选择框项
        $this->builder['columns'][] = compact('key', 'guard_name', 'type', 'on_value', 'off_value', 'extras');
        //返回当前实例
        return $this;
    }

}
