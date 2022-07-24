<?php

namespace Abnermouke\Pros\Builders\Table\Tools;

use Abnermouke\Pros\Builders\Table\Tools\Filters\DateBuilder;
use Abnermouke\Pros\Builders\Table\Tools\Filters\DialerBuilder;
use Abnermouke\Pros\Builders\Table\Tools\Filters\GroupBuilder;
use Abnermouke\Pros\Builders\Table\Tools\Filters\InputBuilder;
use Abnermouke\Pros\Builders\Table\Tools\Filters\SelectBuilder;
use Abnermouke\Pros\Builders\Table\Tools\Filters\SwitchBuilder;
use Abnermouke\Pros\Builders\Table\Tools\Filters\TagsBuilder;
use Abnermouke\Pros\Builders\Table\Tools\Filters\TimeRangeBuilder;

/**
 * 表格筛选项构建器
 * Class TableFilterBuilder
 * @package Abnermouke\Pros\Builders\Table\Tools
 */
class TableFilterBuilder
{
    /**
     * 筛选项配置
     * @var array
     */
    public $filters = [];

    /**
     * 设置Input构建对象
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 16:00:51
     * @param $field string 筛选字段
     * @param $guard_name string 提示文字
     * @return InputBuilder
     */
    public function input($field, $guard_name)
    {
        //设置构建器对象
        $this->filters[] = $builder =  new InputBuilder($field, $guard_name);
        //返回构建器对象
        return $builder;
    }

    /**
     * 设置日期/时间选择构建对象
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 16:00:51
     * @param $field string 筛选字段
     * @param $guard_name string 提示文字
     * @return DateBuilder
     */
    public function date($field, $guard_name)
    {
        //设置构建器对象
        $this->filters[] = $builder =  new DateBuilder($field, $guard_name);
        //返回构建器对象
        return $builder;
    }

    /**
     * 设置计步器构建对象
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 16:00:51
     * @param $field string 筛选字段
     * @param $guard_name string 提示文字
     * @return DialerBuilder
     */
    public function dialer($field, $guard_name)
    {
        //设置构建器对象
        $this->filters[] = $builder =  new DialerBuilder($field, $guard_name);
        //返回构建器对象
        return $builder;
    }

    /**
     * 设置分组构建对象
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 16:00:51
     * @param $field string 筛选字段
     * @param $guard_name string 提示文字
     * @return GroupBuilder
     */
    public function group($field, $guard_name)
    {
        //设置构建器对象
        $this->filters[] = $builder =  new GroupBuilder($field, $guard_name);
        //返回构建器对象
        return $builder;
    }

    /**
     * 设置选择框构建对象
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 16:00:51
     * @param $field string 筛选字段
     * @param $guard_name string 提示文字
     * @return SelectBuilder
     */
    public function select($field, $guard_name)
    {
        //设置构建器对象
        $this->filters[] = $builder =  new SelectBuilder($field, $guard_name);
        //返回构建器对象
        return $builder;
    }

    /**
     * 设置switch构建对象
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 16:00:51
     * @param $field string 筛选字段
     * @param $guard_name string 提示文字
     * @return SwitchBuilder
     */
    public function switch($field, $guard_name)
    {
        //设置构建器对象
        $this->filters[] = $builder =  new SwitchBuilder($field, $guard_name);
        //返回构建器对象
        return $builder;
    }

    /**
     * 设置标签构建对象
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 16:00:51
     * @param $field string 筛选字段
     * @param $guard_name string 提示文字
     * @return TagsBuilder
     */
    public function tags($field, $guard_name)
    {
        //设置构建器对象
        $this->filters[] = $builder =  new TagsBuilder($field, $guard_name);
        //返回构建器对象
        return $builder;
    }

    /**
     * 设置时间区间构建对象
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 16:00:51
     * @param $field string 筛选字段
     * @param $guard_name string 提示文字
     * @return TimeRangeBuilder
     */
    public function time_range($field, $guard_name)
    {
        //设置构建器对象
        $this->filters[] = $builder =  new TimeRangeBuilder($field, $guard_name);
        //返回构建器对象
        return $builder;
    }

}
