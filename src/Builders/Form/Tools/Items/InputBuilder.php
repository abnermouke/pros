<?php

namespace Abnermouke\Pros\Builders\Form\Tools\Items;

/**
 * 输入框构建器
 * Class InputBuilder
 * @package Abnermouke\Pros\Builders\Form\Tools\Items
 */
class InputBuilder extends BasicBuilder
{
    /**
     * 构造函数
     * InputBuilder constructor.
     * @param $field
     * @param $guard_name
     */
    public function __construct($field, $guard_name)
    {
        //引入父级构造
        parent::__construct('input', $field, $guard_name);
        //触发默认
        $this->placeholder('请输入'.$guard_name)->setParam('input_mode', 'text')->input_type()->clipboard(false)->target(false);
    }

    /**
     * 设置输入框类型
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-21 16:26:16
     * @param string $type text\password\email\number等
     * @return InputBuilder
     */
    public function input_type($type = 'text')
    {
        //设置输入框类型
        return $this->setParam('input_type', $type);
    }

    /**
     * 设置日期格式
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-19 01:27:19
     * @param string $format
     * @param false $range
     * @return InputBuilder
     * @throws \Exception
     */
    public function date_format($format = 'Y-m-d', $range = false) {
        //设置日期输入框（包含range）时默认时间格式
        return $this->setParam('format', $format)->setParam('range', $range)->setParam('input_mode', 'datetime')->append('', 'la la-calendar-alt')->readonly();
    }

    /**
     * 设置金额格式
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-15 14:53:09
     * @param int $decimal
     * @param int $ratio
     * @param string $prefix
     * @param string $suffix
     * @return InputBuilder
     */
    public function price($decimal = 2, $ratio = 0, $prefix = '¥', $suffix = '元')
    {
        //更改类型
        return $this->setParam('input_mode', 'price')->input_type('number')->min(0)->setParam('decimal', (int)$decimal)->setParam('ratio', (int)$ratio)->append($suffix)->prepend($prefix);
    }

    /**
     * 设置数字输入框
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-18 14:24:23
     * @return InputBuilder
     */
    public function number()
    {
        //更改类型
        return $this->setParam('input_mode', 'number')->input_type('number');
    }

    /**
     * 设置占位符信息
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-15 14:53:19
     * @param string $placeholder
     * @return InputBuilder
     */
    public function placeholder($placeholder = '')
    {
        //设置占位符信息
        return $this->setParam('placeholder', $placeholder);
    }

    /**
     * 设置前置信息
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-15 14:53:25
     * @param $content
     * @param string $icon
     * @return InputBuilder
     */
    public function prepend($content, $icon = '')
    {
        //设置前置信息
        return $this->setParam('prepend', compact('content', 'icon'));
    }

    /**
     * 设置后置信息
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-15 14:53:57
     * @param $content string 显示/提示信息（icon不为空做为tooltip提示）
     * @param string $icon 图标
     * @return InputBuilder
     */
    public function append($content, $icon = '')
    {
        //设置前置信息
        return $this->setParam('append', compact('content', 'icon'));
    }

    /**
     * 设置最长字数
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-15 14:54:13
     * @param int $num
     * @return InputBuilder
     */
    public function max_length($num = 200){
        //设置最长字数
        return $this->setParam('max_length', (int)$num);
    }

    /**
     * 设置数值最小值
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-15 14:54:19
     * @param int $num
     * @return InputBuilder
     */
    public function min($num = 0){
        //设置数值最小值
        return $this->setParam('min', (int)$num);
    }

    /**
     * 设置数值最大值
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-15 14:54:26
     * @param int $num
     * @return InputBuilder
     */
    public function max($num = 0){
        //设置数值最大值
        return $this->setParam('max', (int)$num);
    }

    /**
     * 设置复制按钮
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-15 14:54:32
     * @param bool $clip
     * @return InputBuilder
     */
    public function clipboard($clip = true)
    {
        //设置粘贴触发按钮
        return $this->setParam('clipboard', $clip);
    }

    /**
     * 设置链接跳转链接
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-15 14:54:32
     * @param bool $target
     * @return InputBuilder
     */
    public function target($target = true)
    {
        //设置粘贴触发按钮
        return $this->setParam('target', $target);
    }

}
