<?php

namespace Abnermouke\Pros\Builders\Form\Tools\Items;

/**
 * 联动表单内容项构建器
 * Class linkageBuilder
 * @package Abnermouke\Pros\Builders\Form\Tools\Items
 */
class linkageBuilder extends BasicBuilder
{

    /**
     * 构造函数
     * linkageBuilder constructor.
     * @param $field
     * @param $guard_name
     */
    public function __construct($field, $guard_name)
    {
        //引入父级构造
        parent::__construct('linkage', $field, $guard_name);
        //设置默认参数
        $this->level(2)->placeholder('请选择'.$guard_name)->names()->default_key_value()->json_link('')->create('');
    }

    /**
     * 设置默认联动层级
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 01:25:45
     * @param int $level
     * @return linkageBuilder
     */
    public function level($level = 2)
    {
        //设置联动层级
        return $this->setParam('level', (int)$level)->setParam('item_col', !in_array((int)$level, [2, 3, 4, 6]) ? 4 : 12/$level);
    }

    /**
     * 设置占位符信息
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 00:36:02
     * @param string $placeholder
     * @return linkageBuilder
     */
    public function placeholder($placeholder = '')
    {
        //设置占位符信息
        return $this->setParam('placeholder', $placeholder);
    }

    /**
     * 设置检索字段名集合
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 01:23:02
     * @param string $key_name key条件字段名
     * @param string $text_name 显示字段名
     * @param string $sub_name 下级字段名
     * @return linkageBuilder
     */
    public function names($key_name = 'id', $text_name = 'guard_name', $sub_name = 'subs')
    {
        //设置字段名集合
        return $this->setParam('names', compact('key_name', 'text_name', 'sub_name'));
    }

    /**
     * 设置默认无数据返回值
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 01:27:05
     * @param mixed $default_key_value
     * @return linkageBuilder
     */
    public function default_key_value($default_key_value = '')
    {
        //设置默认无数据返回值
        return $this->setParam('default_key_value', $default_key_value);
    }

    /**
     * 设置json文件访问链接
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-29 15:51:46
     * @param $json_file_link
     * @return linkageBuilder
     */
    public function json_link($json_file_link = '')
    {
        //设置json文件链接
        return $this->setParam('json_link', $json_file_link);
    }

    /**
     * 设置表单创建触发链接
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-30 02:57:24
     * @param $query_url
     * @param string $query_method
     * @param string $modal_size
     * @return linkageBuilder
     */
    public function create($query_url, $query_method = 'post', $modal_size = 'lg')
    {
        //设置创建触发链接
        return $this->setParam('create_form', compact('query_url', 'query_method', 'modal_size'));
    }

}
