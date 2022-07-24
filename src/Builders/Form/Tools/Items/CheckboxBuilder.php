<?php

namespace Abnermouke\Pros\Builders\Form\Tools\Items;


/**
 * 复选框构建器
 * Class CheckboxBuilder
 * @package Abnermouke\Pros\Builders\Form\Tools\Items
 */
class CheckboxBuilder extends BasicBuilder
{
    /**
     * 构造函数
     * CheckboxBuilder constructor.
     * @param $field
     * @param $guard_name
     * @throws \Exception
     */
    public function __construct($field, $guard_name)
    {
        //引入父级构造
        parent::__construct('checkbox', $field, $guard_name);
        //设置基础信息
        $this->options();
    }

    /**
     * 设置选项（单选项）
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 02:20:45
     * @param array $options 选项内容 [key_1 => guard_name_1, key_2 => guard_name_2]
     * @param mixed $default_value 默认选中值
     * @return CheckboxBuilder
     * @throws \Exception
     */
    public function options($options = [], $default_value = [])
    {
        //设置选择项
        return $this->setParam('type', 'checkbox')->setParam('options', $options)->default_value(is_array($default_value) ? $default_value : explode(',', $default_value));
    }

    /**
     * 设置选项（分组展示）
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-04-02 14:32:24
     * @param array $options
     * @param mixed $default_value
     * @return CheckboxBuilder
     * @throws \Exception
     */
    public function options_with_groups($options = [], $default_value = [])
    {
        //设置选择项
        return $this->setParam('type', 'group_checkbox')->setParam('options', $options)->default_value(is_array($default_value) ? $default_value : explode(',', $default_value));
    }

    /**
     * 设置选项（带描述）
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 02:27:31
     * @param array $options 选项内容 [key_1 => guard_name_1, key_2 => guard_name_2]
     * @param array $descriptions  描述内容 [key_1 => description_1, key_2 => description_2]
     * @param mixed $default_value 默认选中值
     * @return CheckboxBuilder
     * @throws \Exception
     */
    public function options_with_descriptions($options = [], $descriptions = [], $default_value = [])
    {
        //设置选择项
        return $this->setParam('type', 'normal_checkbox')->setParam('options', $options)->setParam('option_descriptions', $descriptions)->default_value(is_array($default_value) ? $default_value : explode(',', $default_value));
    }

    /**
     * 设置选项（带描述、图片）
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 02:27:51
     * @param array $options 选项内容 [key_1 => guard_name_1, key_2 => guard_name_2]
     * @param array $descriptions  描述内容 [key_1 => description_1, key_2 => description_2]
     * @param array $images 图片链接内容 [key_1 => link_1, key_2 => link_1] (link为空时将使用guard_name的首字母大写做为图片)
     * @param mixed $default_value 默认选中值
     * @return CheckboxBuilder
     * @throws \Exception
     */
    public function options_with_images($options = [], $descriptions = [], $images = [], $default_value = [])
    {
        //设置选择项
        return $this->setParam('type', 'image_checkbox')->setParam('options', $options)->setParam('option_descriptions', $descriptions)->setParam('option_images', $images)->default_value(is_array($default_value) ? $default_value : explode(',', $default_value));
    }

}
