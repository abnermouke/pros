<?php

namespace Abnermouke\Pros\Builders\Form\Tools\Items;


use Abnermouke\EasyBuilder\Module\BaseModel;

/**
 * switch选择器构建器
 * Class SwitchBuilder
 * @package Abnermouke\Pros\Builders\Form\Tools\Items
 */
class SwitchBuilder extends BasicBuilder
{
    /**
     * 构造函数
     * SwitchBuilder constructor.
     * @param $field
     * @param $guard_name
     * @throws \Exception
     */
    public function __construct($field, $guard_name)
    {
        //引入父级构造
        parent::__construct('switch', $field, $guard_name);
        //设置基础信息
        $this->on(BaseModel::SWITCH_ON)->off(BaseModel::SWITCH_OFF)->allow_text()->default_value(BaseModel::SWITCH_OFF);
    }

    /**
     * 设置开关提示文案
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 01:10:56
     * @param string $text
     * @return SwitchBuilder
     */
    public function allow_text($text = '允许') {
        //设置switch开关提示文案
        return $this->setParam('allow_text', $text);
    }

    /**
     * 设置开启时值与触发规则
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 01:16:49
     * @param $value mixed 对应值
     * @param array $trigger_show_fields 选中时显示字段
     * @return $this
     */
    public function on($value, $trigger_show_fields = [])
    {
        //设置开启时值
        return $this->setParam('on', $value)->addTrigger($value, $trigger_show_fields);
    }

    /**
     * 设置关闭时值与触发规则
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 01:16:49
     * @param $value mixed 对应值
     * @param array $trigger_show_fields 选中时显示字段
     * @return $this
     */
    public function off($value, $trigger_show_fields = [])
    {
        //设置开启时值
        return $this->setParam('off', $value)->addTrigger($value, $trigger_show_fields);
    }


    /**
     * 设置触发
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-18 23:49:44
     * @param $value mixed 触发值
     * @param array $trigger_show_fields 显示字段
     * @return SwitchBuilder
     */
    private function trigger($value, $trigger_show_fields = [])
    {
        //设置触发
        return $this->addTrigger($value, $trigger_show_fields);
    }

}
