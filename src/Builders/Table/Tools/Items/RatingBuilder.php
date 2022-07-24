<?php

namespace Abnermouke\Pros\Builders\Table\Tools\Items;

/**
 * 评分构建器
 * Class RatingBuilder
 * @package Abnermouke\Pros\Builders\Table\Tools\Items
 */
class RatingBuilder extends BasicBuilder
{

    /**
     * 构造函数
     * RatingBuilder constructor.
     * @param $field string 构建字段
     * @param $guard_name string 显示名称
     */
    public function __construct($field, $guard_name)
    {
        //引用父级构造
        parent::__construct('rating', $field, $guard_name);
        //设置基础配置
        $this->description('{'.$field.'}');
    }

}
