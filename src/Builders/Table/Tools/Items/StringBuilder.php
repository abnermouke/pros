<?php

namespace Abnermouke\Pros\Builders\Table\Tools\Items;

/**
 * 文本构建器
 * Class StringBuilder
 * @package Abnermouke\Pros\Builders\Table\Tools\Items
 */
class StringBuilder extends BasicBuilder
{

    /**
     * 构造函数
     * StringBuilder constructor.
     * @param $field string 构建字段
     * @param $guard_name string 显示名称
     */
    public function __construct($field, $guard_name)
    {
        //引用父级构造
        parent::__construct('string', $field, $guard_name);
        //配置基础配置
        $this->theme()->template('{'.$field.'}')->formatting()->badge(false);
    }

    /**
     * 设置文本为时间格式
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 00:21:48
     * @param string $format 时间格式化标识（friendly为友好时间提示、其他为正常日期格式标识）
     * @return StringBuilder
     */
    public function date($format = 'Y-m-d H:i')
    {
        //设置时间格式
        return $this->formatting('date')->setParam('format', $format);
    }

    /**
     * 设置文本为价格格式
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 00:25:06
     * @param int $decimal 保留小数点位数
     * @param int $ratio  倍率系数（默认无系数，如金额默认*100，$ratio则需配置为100，系统将自动换算后显示）
     * @return StringBuilder
     */
    public function amount($decimal = 2, $ratio = 0)
    {
        //设置文本为价格格式
        return $this->formatting('amount')->setParam('decimal', (int)$decimal)->setParam('ratio', $ratio);
    }

    /**
     * 设置文本为数字格式
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 00:23:34
     * @return StringBuilder
     */
    public function number()
    {
        //设置文本为数字格式
        return $this->formatting('number');
    }

    /**
     * 设置数据格式
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 00:20:41
     * @param string $formatting
     * @return StringBuilder
     */
    protected function formatting($formatting = 'string')
    {
        //设置数据格式
        return $this->setParam('formatting', $formatting);
    }

    /**
     * 显示文本模版
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 00:16:55
     * @param string $template 描述文本（可动态获取当前行列表数据，使用{}包裹将动态获取，如{id}将读取当前行id对应值渲染）
     * @return StringBuilder
     */
    public function template($template)
    {
        //显示文本模版
        return $this->setParam('template', $template);
    }

    /**
     * 设置主题颜色
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 00:08:18
     * @param string $theme
     * @return StringBuilder
     */
    public function theme($theme = 'dark')
    {
        //设置主题颜色
        return $this->setParam('theme', $theme);
    }

    /**
     * 设置使用badge样式
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-23 12:03:02
     * @param string|bool $theme
     * @return StringBuilder
     */
    public function badge($theme = 'dark')
    {
        //设置使用badge样式
        return $this->setParam('badge', $theme);
    }


}
