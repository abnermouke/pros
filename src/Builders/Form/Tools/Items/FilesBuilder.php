<?php

namespace Abnermouke\Pros\Builders\Form\Tools\Items;


use Abnermouke\EasyBuilder\Library\Currency\ValidateLibrary;

/**
 * 文件上传构建器
 * Class FilesBuilder
 * @package Abnermouke\Pros\Builders\Form\Tools\Items
 */
class FilesBuilder extends BasicBuilder
{

    /**
     * 构造函数
     * FilesBuilder constructor.
     * @param $field
     * @param $guard_name
     * @throws \Exception
     */
    public function __construct($field, $guard_name)
    {
        //引入父级构造
        parent::__construct('files', $field, $guard_name);
        //设置基础信息
        $this->uploader()->dictionary()->accept()->multiple();
    }

    /**
     * 设置上传链接
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-20 16:34:57
     * @param string $url
     * @return FilesBuilder
     * @throws \Exception
     */
    public function uploader($url = '')
    {
        //整理链接
        $url = $url && ValidateLibrary::link($url) ? $url : route('pros.console.uploader');
        //设置上传链接
        return $this->setParam('upload_url', $url);
    }

    /**
     * 设置上传目录
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-29 17:45:51
     * @param string $dictionary
     * @return FilesBuilder
     */
    public function dictionary($dictionary = 'pros/uploader/files')
    {
        //设置上传目录
        return $this->setParam('dictionary', $dictionary);
    }


    /**
     * 设置允许的文件类型
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 02:36:51
     * @param string $accept 文件类型
     * @return FilesBuilder
     */
    public function accept($accept = '*/*')
    {
        //设置允许文件类型
        return $this->setParam('accept', $accept);
    }

    /**
     * 是否可多选
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 02:41:03
     * @param bool $multiple
     * @return FilesBuilder
     */
    public function multiple($multiple = true)
    {
        //设置是否为多选
        return $this->setParam('multiple', $multiple);
    }

}
