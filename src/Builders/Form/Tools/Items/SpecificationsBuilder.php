<?php

namespace Abnermouke\Pros\Builders\Form\Tools\Items;

use Abnermouke\EasyBuilder\Library\Currency\ValidateLibrary;

/**
 * 商品规格内容项构建器
 * Class SpecificationsBuilder
 * @package Abnermouke\Pros\Builders\Form\Tools\Items
 */
class SpecificationsBuilder extends BasicBuilder
{

    /**
     * 构造函数
     * SpecificationsBuilder constructor.
     * @param $field
     * @param $guard_name
     */
    public function __construct($field, $guard_name)
    {
        //引入父级构造
        parent::__construct('specs', $field, $guard_name);
        //设置默认参数
        $this->names()->json_link('')->create('');
        //设置字段信息
        $this->builder['columns'] = [];
    }

    /**
     * 添加文本框
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 02:52:34
     * @param $key mixed value字段名
     * @param $guard_name string 显示文字
     * @param string $input_type 输入框类型
     * @param array $extras 额外参数
     * @return SpecificationsBuilder
     */
    public function addInput($key, $guard_name, $input_type = 'text', $extras = [])
    {
        //设置默认类型
        $type = 'input';
        //添加输入框项
        $this->builder['columns'][] = compact('key', 'guard_name', 'type', 'input_type', 'extras');
        //返回当前实例
        return $this;
    }

    /**
     * 添加图片
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-08-02 15:39:51
     * @param $key
     * @param $guard_name
     * @param $upload_url
     * @param $dictionary
     * @param array $extras
     * @return SpecificationsBuilder
     */
    public function addImage($key, $guard_name, $upload_url = '', $dictionary = 'pros/uploader/files', $extras = [])
    {
        //设置默认类型
        $type = 'image';
        //整理链接
        $upload_url = $upload_url && ValidateLibrary::link($upload_url) ? $upload_url : route('pros.console.uploader');
        //添加图片项
        $this->builder['columns'][] = compact('key', 'guard_name', 'upload_url', 'dictionary', 'type', 'extras');
        //返回当前实例
        return $this;
    }

    /**
     * 设置检索字段名集合
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 01:23:02
     * @param string $key_name key条件字段名
     * @param string $text_name 显示字段名
     * @param string $values_name 属性值字段名
     * @return SpecificationsBuilder
     */
    public function names($key_name = 'id', $text_name = 'guard_name', $values_name = 'values')
    {
        //设置字段名集合
        return $this->setParam('names', compact('key_name', 'text_name', 'values_name'));
    }

    /**
     * 设置json文件访问链接
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-29 15:51:46
     * @param $json_file_link
     * @return SpecificationsBuilder
     */
    public function json_link($json_file_link = '')
    {
        //设置json文件链接
        return $this->setParam('json_file_link', $json_file_link);
    }

    /**
     * 设置表单创建触发链接
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-30 02:57:24
     * @param $query_url
     * @param string $query_method
     * @param string $modal_size
     * @return SpecificationsBuilder
     */
    public function create($query_url, $query_method = 'post', $modal_size = 'xl')
    {
        //设置创建触发链接
        return $this->setParam('create_form', compact('query_url', 'query_method', 'modal_size'));
    }

}
