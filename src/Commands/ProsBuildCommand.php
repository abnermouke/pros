<?php

namespace Abnermouke\Pros\Commands;

use Abnermouke\EasyBuilder\Tools\SentenceTool;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

/**
 * Pros to build
 * Class ProsBuildCommand
 * @package Abnermouke\Pros\Commands
 */
class ProsBuildCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'builder:pros';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pros power by Abnermouke';

    /**
     * Pros to build
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-12 17:03:56
     * @return bool
     */
    public function handle()
    {
        //创建表
        if ($this->createTables()) {
            //打印信息
            $this->output->success('Pros 初始化完成！');
        }
        //返回成功
        return true;
    }

    /**
     * 创建表信息
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-31 23:42:33
     * @return bool
     * @throws \Exception
     */
    private function createTables()
    {
        //确认信息
        if (!$this->confirm('请确认是否已在.env中正确配置DB数据库链接信息？')) {
            //提示信息
            $this->output->warning('等待数据库配置完毕后继续...');
            //返回失败
            return false;
        }
        //确认信息
        if (!$this->confirm('请确认 '.config('app.url').' 为项目访问域名并已配置可访问（错误可能导致默认图片、链接不正确）？')) {
            //提示信息
            $this->output->warning('等待域名访问配置完毕后继续...');
            //返回失败
            return false;
        }
        //打印命令
        $this->output->title('开始创建 Abnermouke/Pros 基础数据库表信息...');
        //整理生成内容
        $tables = [
            ['name' => 'configs',  '--desc' => '配置表', '--dictionary' => 'pros\system'],
            ['name' => 'admins',  '--desc' => '管理员表', '--dictionary' => 'pros\console'],
            ['name' => 'roles',  '--desc' => '管理员角色表', '--dictionary' => 'pros\console'],
            ['name' => 'nodes',  '--desc' => '节点表', '--dictionary' => 'pros\console'],
            ['name' => 'admin_logs',  '--desc' => '管理员操作日志表', '--dictionary' => 'pros\console'],
            ['name' => 'admin_oauth_signatures',  '--desc' => '管理员授权签名表', '--dictionary' => 'pros\console'],
            ['name' => 'temporary_files',  '--desc' => '临时文件记录表', '--dictionary' => 'pros\system'],
            ['name' => 'amap_areas',  '--desc' => '高德地图行政地区表', '--dictionary' => 'pros\system'],
            ['name' => 'sms_logs',  '--desc' => '短信记录表', '--dictionary' => 'pros\system'],
            ['name' => 'help_docs',  '--desc' => '帮助文档表', '--dictionary' => 'pros\system'],
            ['name' => 'statistics',  '--desc' => '全局统计表', '--dictionary' => 'pros\system'],
        ];
        //生成progress
        $bar = $this->output->createProgressBar(count($tables));
        //循环自动生成表
        foreach ($tables as $table_params) {
            //替换模版
            Artisan::call('builder:package', array_merge([
                '--dp' => 'pros_', '--dc' => 'mysql', '--dcs' => 'utf8mb4', '--de' => 'innodb',
                '--cd' => 'file',
                '--migration' => true, '--cache' => true, '--controller' => true, '--fcp' => true,
            ], $table_params));
            //递增进度条
            $bar->advance();
        }
        //设置结束进度条
        $bar->finish();
        //换行命令
        $this->output->newLine(2);
        //打印命令
        $this->output->title('开始同步每日一句...');
        //初始化字句工具
        SentenceTool::run();
        //替换模版
        $this->createTemplate();
        //执行迁移
        Artisan::call('migrate:refresh', ['--path' => '/database/migrations/pros']);
        //打印信息
        $this->output->success('数据库初始表创建成功');
        //清除缓存
        Artisan::call('cache:clear');
        //返回成功
        return true;
    }

    /**
     * 替换模版
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-31 23:15:36
     * @return bool
     * @throws \Exception
     */
    private function createTemplate()
    {
        //打印信息
        $this->output->title('开始创建 Abnermouke/ConsoleBuilder 基础模版信息...');
        //整理模版
        $templates = ['migrations' => []];
        //替换migrations模版
        foreach (File::allFiles(__DIR__.'/../../tpl/migrations') as $migration) {
            //记录信息
            $templates['migrations'][$migration->getFilename().'.php'] = $this->replaceCurrentTemplate($migration->getRealPath());
        }
        //设置直接替换目录
        $tpls = ['interfaces', 'controllers', 'caches', 'models', 'services'];
        //循环替换目录
        foreach ($tpls as $tpl) {
            //替换interface模版
            foreach (File::allFiles(__DIR__.'/../../tpl/'.$tpl) as $file) {
                //设置模版
                $this->setTargetFile($file);
            }
            //打印信息
            $this->output->success($tpl.' 模版创建成功');
        }
        //循环本项目migrations
        foreach (File::allFiles($target_migration_path = database_path('migrations/pros')) as $file) {
            //截取文件名
            $file_name = implode('_', array_slice(explode('_', $file->getFilename()), 4));
            //判断名称
            if (isset($templates['migrations'][$file_name])) {
                //替换内容
                file_put_contents($file->getRealPath(), $templates['migrations'][$file_name]);
            }
        }
        //打印信息
        $this->output->success('migration 模版创建成功');
        //打印信息
        $this->output->success('pros 逻辑与静态文件复制成功');
        //返回成功
        return true;
    }

    /**
     * 设置目标文件
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-25 01:03:32
     * @param $file
     * @return bool
     * @throws \Exception
     */
    private function setTargetFile($file)
    {

        //获取文件名称
        $file_name = Arr::last(explode('@', $file->getFilename())).'.php';
        //获取文件目录
        $dictionary = $this->getTargetDictionary($file->getFilename());
        //获取指定内容
        $content = $this->replaceCurrentTemplate($file->getRealPath());
        //判断目录是否存在
        if (!File::isDirectory($dictionary)) {
            //创建目录
            File::makeDirectory($dictionary, 0777, true);
        }
        //判断文件是否存在
        if (!File::exists(($full_path = $dictionary.'/'.$file_name))) {
            //删除原文件
            File::delete($full_path);
        }
        //替换文件内容
        file_put_contents($full_path, $content);
        //返回成功
        return true;
    }

    /**
     * 获取储存指定目录
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-07-25 00:27:32
     * @param $file_name
     * @return string
     */
    private function getTargetDictionary($file_name)
    {
        //拆分路径
        $path = Arr::first(explode('@', $file_name));
        //截取第一位
        $module_alias = Arr::first(explode('_', $path));
        //判断信息
        switch ($module_alias) {
            default:
                //获取目录
                $dictionary = app_path(str_replace([$module_alias.'_', '_'], ['', '/'], $path));
                break;
        }
        //返回目录
        return $dictionary;
    }

    /**
     * 替换模版通用参数
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-16 14:32:04
     * @param string $path
     * @return string
     * @throws \Exception
     */
    private function replaceCurrentTemplate($path)
    {
        return str_replace(['__TIME__'], [auto_datetime()], file_get_contents($path));
    }

}
