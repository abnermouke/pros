<?php

namespace App\Console\Commands\Pros\Tasks;

use App\Handler\Cache\Data\Pros\System\ConfigCacheHandler;
use App\Implementers\AmapAreaImplementers;
use App\Repository\Pros\System\AmapAreaRepository;
use App\Services\Pros\System\AmapAreaService;
use Illuminate\Console\Command;

class QueryAmapAreaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'amap:query';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '高德行政地图请求';

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
     * @Time 2023-02-28 13:38:31
     * @return null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle()
    {
        //判断是否配备高德密钥
        if ($amap_key = (new ConfigCacheHandler())->get('AMAP_WEB_SERVER_API_KEY') && (new AmapAreaRepository())->count() <= 0) {
            //执行同步
            AmapAreaImplementers::run($amap_key);
        }
        //刷新JSOn文件
        (new AmapAreaService())->refreshJson();
        //返回成功
        return $this->output->success('查询完成');
    }
}
