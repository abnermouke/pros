<?php

namespace Abnermouke\Pros\Builders\Form\Tools\Items;

use Abnermouke\EasyBuilder\Library\Currency\ValidateLibrary;

/**
 * 富文本构建器
 * Class EditorBuilder
 * @package Abnermouke\Pros\Builders\Form\Tools\Items
 */
class EditorBuilder extends BasicBuilder
{

    //编辑器配置名称
    public const CK_EDITOR = 'ck_editor';
    public const UEDITOR = 'ueditor';

    /**
     * 构造函数
     * EditorBuilder constructor.
     * @param $field
     * @param $guard_name
     * @param string $editor
     * @throws \Exception
     */
    public function __construct($field, $guard_name, $editor = self::CK_EDITOR)
    {
        //引入父级构造
        parent::__construct($editor, $field, $guard_name);
        //触发默认
        $this->row()->uploader('');
    }

    /**
     * 设置上传链接
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-18 17:21:31
     * @param $url
     * @return EditorBuilder
     * @throws \Exception
     */
    public function uploader($url)
    {
        //整理链接
        $url = $url && ValidateLibrary::link($url) ? $url : ($this->builder['type'] === self::UEDITOR ? route('pros.console.uploader.ueditor') : route('pros.console.uploader'));
        //设置上传链接
        return $this->setParam('upload_url', $url ? $url : '');
    }

    /**
     * 设置文本域默认行数
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 02:43:38
     * @param int $row
     * @return EditorBuilder
     */
    public function row($row = 3)
    {
        //默认显示行数
        return $this->setParam('row', (int)$row);
    }

}
