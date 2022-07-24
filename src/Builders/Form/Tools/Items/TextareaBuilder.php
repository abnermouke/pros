<?php

namespace Abnermouke\Pros\Builders\Form\Tools\Items;

/**
 * 文本框框构建器
 * Class TextareaBuilder
 * @package Abnermouke\Pros\Builders\Form\Tools\Items
 */
class TextareaBuilder extends BasicBuilder
{
    /**
     * 构造函数
     * TextareaBuilder constructor.
     * @param $field
     * @param $guard_name
     */
    public function __construct($field, $guard_name)
    {
        //引入父级构造
        parent::__construct('textarea', $field, $guard_name);
        //触发默认
        $this->placeholder('请输入'.$guard_name)->row();
    }
    /**
     * 设置占位符信息
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 00:36:02
     * @param string $placeholder
     * @return TextareaBuilder
     */
    public function placeholder($placeholder = '')
    {
        //设置占位符信息
        return $this->setParam('placeholder', $placeholder);
    }

    /**
     * 设置最长字数
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 00:39:40
     * @param int $num 数值
     * @return TextareaBuilder
     */
    public function max_length($num = 200){
        //设置最长字数
        return $this->setParam('max_length', (int)$num);
    }

    /**
     * 设置默认行数
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 01:04:42
     * @param int $row
     * @return TextareaBuilder
     */
    public function row($row = 3)
    {
        //默认显示行数
        return $this->setParam('row', (int)$row);
    }

    /**
     * 设置复制
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 00:41:33
     * @param bool $clip 是否设置
     * @return TextareaBuilder
     */
    public function clipboard($clip = true)
    {
        //设置粘贴触发按钮
        return $clip ? $this->setParam('clipboard', $clip) :  $this;
    }

}
