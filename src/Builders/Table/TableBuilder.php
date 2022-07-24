<?php

namespace Abnermouke\Pros\Builders\Table;

use Abnermouke\Pros\Builders\Table\Providers\TableBasicProvider;
use Abnermouke\Pros\Builders\Table\Providers\TableContentProvider;
use Illuminate\Http\Request;

/**
 * 表格构建器
 * Class TableBuilder
 * @package Abnermouke\Pros\Builders\Table
 */
class TableBuilder
{
    /**
     * 创建基础服务提供者构建器
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 00:41:46
     * @return TableBasicProvider
     */
    public static function BASIC()
    {
        //返回表格基础服务提供者
        return (new TableBasicProvider());
    }

    /**
     * 创建内容服务提供者构建器
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 00:41:46
     * @return TableContentProvider
     */
    public static function CONTENT()
    {
        //返回表格内容服务提供者
        return (new TableContentProvider());
    }



}
