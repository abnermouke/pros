<?php

namespace App\Console\Commands\Application;

use Abnermouke\Pros\Builders\BuilderProvider;
use App\Handler\Cache\Data\Pros\System\ConfigCacheHandler;
use App\Implementers\AmapAreaImplementers;
use App\Repository\Pros\System\AmapAreaRepository;
use App\Repository\Pros\System\ConfigRepository;
use App\Services\Pros\System\AmapAreaService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class UpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'application:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '应用刷新';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 开始处理
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2023-02-28 13:34:39
     * @return null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \ReflectionException
     */
    public function handle()
    {
        //初始化信息
        set_time_limit(0);
        ini_set('memory_limit', '5124M');
        //清空非必要缓存
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        //刷新migration
        Artisan::call('migrate:refresh', ['--path' => '/database/migrations/fillings', '--force' => true]);
        //刷新节点
        BuilderProvider::run();
        //刷新缓存
        Artisan::call('config:cache');
        //判断是否正式环境
        if (config('app.env', 'dev') === 'production') {
            //设置路由与视图缓存
            Artisan::call('route:cache');
            Artisan::call('view:cache');
        }
        //执行后置操作
        $this->beforeHandle();
        //返回成功
        return $this->output->success('刷新成功');
    }

    /**
     * 后置操作
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2023-02-27 22:47:55
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function beforeHandle()
    {

        //TODO：后置操作

        //返回成功
        return true;
    }
}
