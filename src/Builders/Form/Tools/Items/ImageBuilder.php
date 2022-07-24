<?php

namespace Abnermouke\Pros\Builders\Form\Tools\Items;

use Abnermouke\EasyBuilder\Library\Currency\ValidateLibrary;
use Illuminate\Support\Arr;

/**
 * 图片上传构建器
 * Class ImageBuilder
 * @package Abnermouke\Pros\Builders\Form\Tools\Items
 */
class ImageBuilder extends BasicBuilder
{

    /**
     * 构造函数
     * ImageBuilder constructor.
     * @param $field
     * @param $guard_name
     * @throws \Exception
     */
    public function __construct($field, $guard_name)
    {
        //引入父级构造
        parent::__construct('image', $field, $guard_name);
        //设置基础信息
        $this->uploader()->dictionary()->size('200x200')->accept()->cropper();
    }

    /**
     * 设置上传链接
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-18 17:21:31
     * @param $url
     * @return ImageBuilder
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
     * @return ImageBuilder
     */
    public function dictionary($dictionary = 'pros/uploader/images')
    {
        //设置上传目录
        return $this->setParam('dictionary', $dictionary);
    }

    /**
     * 配置图片显示尺寸
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 02:36:22
     * @param false $size 截取尺寸
     * @return $this|ImageBuilder
     */
    public function size($size = false)
    {
        //设置尺寸信息
        if ($size) {
            //拆分尺寸信息
            $size = explode('x', str_replace('×', 'x', $size));
            //设置宽高信息
            return $this->width(Arr::first($size))->height(Arr::last($size))->setParam('size', implode('x', $size));
        }
        //返回当前实例
        return $this;
    }

    /**
     * 设置允许的图片后缀
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 02:36:51
     * @param string $ext 允许后缀
     * @return ImageBuilder
     */
    public function accept($ext = '*')
    {
        //设置允许图片类型
        return $this->setParam('accept', 'image/'.$ext);
    }

    /**
     * 设置图片限制宽度
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 02:37:05
     * @param int $width
     * @return ImageBuilder
     */
    private function width($width = 0)
    {
        //设置宽度信息
        return (int)$width > 0 ? $this->setParam('width', (int)$width)->setParam('box_width', (int)$width) : $this;
    }

    /**
     * 设置图片限制高度
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-23 02:37:11
     * @param int $height
     * @return ImageBuilder
     */
    private function height($height = 0)
    {
        //设置高度信息
        return (int)$height > 0 ? $this->setParam('height', (int)$height)->setParam('box_height', (int)$height) : $this;
    }

    /**
     * 设置一行多个展示
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-19 12:47:49
     * @param bool $cropper
     * @return ImageBuilder
     */
    public function cropper($cropper = true)
    {
        //设置需要裁剪为指定宽高尺寸
        return $this->setParam('cropper', $cropper);
    }
}
