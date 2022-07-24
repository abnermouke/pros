<?php

namespace Abnermouke\Pros\Builders\Form\Tools;


use Abnermouke\Pros\Builders\Form\Tools\Items\CheckboxBuilder;
use Abnermouke\Pros\Builders\Form\Tools\Items\EditorBuilder;
use Abnermouke\Pros\Builders\Form\Tools\Items\FilesBuilder;
use Abnermouke\Pros\Builders\Form\Tools\Items\IconBuilder;
use Abnermouke\Pros\Builders\Form\Tools\Items\ImageBuilder;
use Abnermouke\Pros\Builders\Form\Tools\Items\InputBuilder;
use Abnermouke\Pros\Builders\Form\Tools\Items\PicturesBuilder;
use Abnermouke\Pros\Builders\Form\Tools\Items\RadioBuilder;
use Abnermouke\Pros\Builders\Form\Tools\Items\SelectBuilder;
use Abnermouke\Pros\Builders\Form\Tools\Items\SwitchBuilder;
use Abnermouke\Pros\Builders\Form\Tools\Items\TagsBuilder;
use Abnermouke\Pros\Builders\Form\Tools\Items\TextareaBuilder;
use Abnermouke\Pros\Builders\Form\Tools\Items\ValuesBuilder;

/**
 * 表单内容项构建器
 * Class FormItemBuilder
 * @package Abnermouke\Pros\Builders\Form\Tools
 */
class FormItemBuilder
{
    /**
     * 构建对象
     * @var array
     */
    public $items = [];

    /**
     * 设置输入框内容项构建器
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-18 14:22:46
     * @param $field
     * @param $guard_name
     * @return InputBuilder
     */
      public function input($field, $guard_name)
      {
          //设置构建对象
          $this->items[] = $builder = new InputBuilder($field, $guard_name);
          //返回构建器对象
          return $builder;
      }

    /**
     * 设置icon图标选择内容项构建器
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-18 15:40:09
     * @param $field
     * @param $guard_name
     * @return IconBuilder
     * @throws \Exception
     */
      public function icon($field, $guard_name)
      {
          //设置构建对象
          $this->items[] = $builder = new IconBuilder($field, $guard_name);
          //返回构建器对象
          return $builder;
      }

    /**
     * 设置复选框内容项构建器
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-18 16:07:55
     * @param $field
     * @param $guard_name
     * @return CheckboxBuilder
     * @throws \Exception
     */
      public function checkbox($field, $guard_name)
      {
          //设置构建对象
          $this->items[] = $builder = new CheckboxBuilder($field, $guard_name);
          //返回构建器对象
          return $builder;
      }

    /**
     * 设置富文本内容项构建器
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-18 17:18:59
     * @param $field
     * @param $guard_name
     * @param string $editor
     * @return EditorBuilder
     */
      public function editor($field, $guard_name, $editor = EditorBuilder::CK_EDITOR)
      {
          //设置构建对象
          $this->items[] = $builder = new EditorBuilder($field, $guard_name, $editor);
          //返回构建器对象
          return $builder;
      }

    /**
     * 设置单选框内容项构建器
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-18 23:50:17
     * @param $field
     * @param $guard_name
     * @return RadioBuilder
     * @throws \Exception
     */
      public function radio($field, $guard_name)
      {
          //设置构建对象
          $this->items[] = $builder = new RadioBuilder($field, $guard_name);
          //返回构建器对象
          return $builder;
      }

    /**
     * 设置switch选择器内容项构建器
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-19 00:12:20
     * @param $field
     * @param $guard_name
     * @return SwitchBuilder
     * @throws \Exception
     */
      public function switch($field, $guard_name)
      {
          //设置构建对象
          $this->items[] = $builder = new SwitchBuilder($field, $guard_name);
          //返回构建器对象
          return $builder;
      }

    /**
     * 设置标签输入框内容项构建器
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-19 01:28:04
     * @param $field
     * @param $guard_name
     * @return TagsBuilder
     */
      public function tags($field, $guard_name)
      {
          //设置构建对象
          $this->items[] = $builder = new TagsBuilder($field, $guard_name);
          //返回构建器对象
          return $builder;
      }

    /**
     * 文本框内容项构建器
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-19 01:39:21
     * @param $field
     * @param $guard_name
     * @return TextareaBuilder
     */
      public function textarea($field, $guard_name)
      {
          //设置构建对象
          $this->items[] = $builder = new TextareaBuilder($field, $guard_name);
          //返回构建器对象
          return $builder;
      }

    /**
     * 设置单图上传内容项构建器
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-19 01:54:25
     * @param $field
     * @param $guard_name
     * @return ImageBuilder
     * @throws \Exception
     */
      public function image($field, $guard_name)
      {
          //设置构建对象
          $this->items[] = $builder = new ImageBuilder($field, $guard_name);
          //返回构建器对象
          return $builder;
      }

    /**
     * 设置多图上传内容项构建器
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-19 02:16:14
     * @param $field
     * @param $guard_name
     * @return PicturesBuilder
     * @throws \Exception
     */
      public function pictures($field, $guard_name)
      {
          //设置构建对象
          $this->items[] = $builder = new PicturesBuilder($field, $guard_name);
          //返回构建器对象
          return $builder;
      }

    /**
     * 设置文件上传内容项构建器
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-19 13:28:36
     * @param $field
     * @param $guard_name
     * @return FilesBuilder
     * @throws \Exception
     */
      public function files($field, $guard_name)
      {
          //设置构建对象
          $this->items[] = $builder = new FilesBuilder($field, $guard_name);
          //返回构建器对象
          return $builder;
      }

    /**
     * 设置选择框内容项构建器
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-19 14:22:51
     * @param $field
     * @param $guard_name
     * @return SelectBuilder
     * @throws \Exception
     */
      public function select($field, $guard_name)
      {
          //设置构建对象
          $this->items[] = $builder = new SelectBuilder($field, $guard_name);
          //返回构建器对象
          return $builder;
      }

    /**
     * 设置多项值内容项构建器
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-19 16:17:21
     * @param $field
     * @param $guard_name
     * @return SelectBuilder
     * @throws \Exception
     */
      public function values($field, $guard_name)
      {
          //设置构建对象
          $this->items[] = $builder = new ValuesBuilder($field, $guard_name);
          //返回构建器对象
          return $builder;
      }

}
