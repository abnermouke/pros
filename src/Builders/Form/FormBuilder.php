<?php

namespace Abnermouke\Pros\Builders\Form;

use Abnermouke\Pros\Builders\Form\Providers\FormDefaultProvider;

/**
 * 表单构建器
 * Class FormBuilder
 * @package Abnermouke\Pros\Builders\Form
 */
class FormBuilder
{
    /**
     * 创建构建对象
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-15 00:23:37
     * @param string $theme
     * @return FormDefaultProvider
     */
    public static function make($theme = 'default')
    {
        //返回服务提供对象
        return (new FormDefaultProvider());
    }

}
