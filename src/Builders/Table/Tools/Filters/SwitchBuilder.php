<?php

namespace Abnermouke\Pros\Builders\Table\Tools\Filters;

use Abnermouke\EasyBuilder\Module\BaseModel;

/**
 * switch构建器
 * Class SwitchBuilder
 * @package Abnermouke\Pros\Builders\Table\Tools\Filters
 */
class SwitchBuilder extends BasicBuilder
{

    /**
     * 构造函数
     * SwitchBuilder constructor.
     * @param $field string 筛选字段
     * @param $guard_name string 提示文字
     */
    public function __construct($field, $guard_name)
    {
        //引入父级构造
        parent::__construct('switch', $field, $guard_name);
        //设置默认信息
        $this->col(2)->default_value(BaseModel::SWITCH_OFF)->on()->off();
    }

    /**
     * 设置开启信息
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 15:54:41
     * @param int $value
     * @return SwitchBuilder
     */
    public function on($value = BaseModel::SWITCH_ON)
    {
        //设置开启信息
        return $this->setParam('on_value', $value);

    }

    /**
     * 设置关闭信息
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 15:54:41
     * @param int $value
     * @return SwitchBuilder
     */
    public function off($value = BaseModel::SWITCH_OFF)
    {
        //设置开启信息
        return $this->setParam('off_value', $value);

    }

}
