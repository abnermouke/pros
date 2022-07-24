<?php


namespace Abnermouke\Pros\Builders\Table\Tools\Items;

/**
 * 表格内容项基础构建器
 * Class BasicBuilder
 * @package Abnermouke\Pros\Builders\Table\Tools\Items
 */
class BasicBuilder
{

    //构建器配置
    protected $builder = [
        'type' => '',
        'field' => '',
        'guard_name' => '',
        'empty_text' => '---',
        'bold' => false,
        'description' => '',
        'show' => true,
        'sorting' => false,
        'sort_table_name' => '',
    ];

    /**
     * 构造函数
     * BasicBuilder constructor.
     * @param $type string 构建类型
     * @param $field string 构建字段
     * @param $guard_name string 显示名称
     */
    public function __construct($type, $field, $guard_name)
    {
        //设置基础信息
        $this->type($type)->field($field)->guard_name($guard_name)->empty()->show()->sorting(false);
    }

    /**
     * 设置内容描述
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 00:04:51
     * @param string $template 描述文本（可动态获取当前行列表数据，使用{}包裹将动态获取，如{id}将读取当前行id对应值渲染）
     * @return $this
     */
    public function description($template = '')
    {
        //设置内容描述
        return $this->setParam('description', $template);
    }

    /**
     * 设置筛选类型
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 15:20:33
     * @param $type
     * @return $this
     */
    protected function type($type)
    {
        //设置筛选类型
        return $this->setParam('type', $type);
    }

    /**
     * 设置提示文字
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 15:19:13
     * @param $guard_name
     * @return $this
     */
    protected function guard_name($guard_name)
    {
        //设置提示文字
        return $this->setParam('guard_name', $guard_name);
    }

    /**
     * 设置字段
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 15:18:32
     * @param $field
     * @return $this
     */
    protected function field($field)
    {
        //设置字段
        return $this->setParam('field', $field);
    }

    /**
     * 设置为空/不存在时显示文本
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 23:30:30
     * @param string $text
     * @return $this
     */
    public function empty($text = '---')
    {
        //设置为空/不存在时显示文本
        return $this->setParam('empty_text', $text);
    }

    /**
     * 设置是否默认显示
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 00:38:21
     * @param bool $show
     * @return $this
     */
    public function show($show = true)
    {
        //设置默认显示
        return $this->setParam('show', $show);
    }

    /**
     * 设置加粗显示
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 23:32:42
     * @param bool $bold
     * @return $this
     */
    public function bold($bold = true)
    {
        //设置加粗显示
        return $this->setParam('bold', $bold);
    }

    /**
     * 设置字段可排序
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-24 14:11:40
     * @param bool $sort
     * @param string $table_name 排序表名
     * @return $this
     */
    public function sorting($sort = true, $table_name = '')
    {
        //设置该字段可排序
        return $this->setParam('sorting', $sort)->setParam('sort_table_name', $table_name);
    }

    /**
     * 新增/更新构建器参数
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 15:21:55
     * @param $key
     * @param $value
     * @return $this
     */
    protected function setParam($key, $value)
    {
        //设置参数
        $this->builder[$key] = $value;
        //返回当前实例
        return $this;
    }

    /**
     * 获取构建器参数
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-06-23 15:22:11
     * @return string[]
     */
    public function get()
    {
        return $this->builder;
    }


}
