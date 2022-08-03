<?php

namespace Abnermouke\Pros;

use Abnermouke\Pros\Commands\ProsBuildCommand;
use Illuminate\Support\ServiceProvider;

class ProsServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //引入配置
        $this->app->singleton('command.builder.pros', function () {
            //返回实例
            return new ProsBuildCommand();
        });
    }


    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // 发布配置文件
        $this->publishes([
            __DIR__.'/../configs/pros.php' => config_path('pros.php'),
            __DIR__.'/../configs/pros_menus.php' => config_path('pros_menus.php'),
            __DIR__.'/../configs/easysms.php' => config_path('easysms.php'),
            __DIR__ . '/../data/routes/abnermouke/pros/console' => base_path('routes/abnermouke/pros/console.php'),
            __DIR__.'/../data/assets' => public_path('pros'),
            __DIR__.'/../helpers/pros.php' => app_path('Helpers/pros.php'),
            __DIR__.'/../data/views/pros/console' => resource_path('views/pros/console'),
            __DIR__.'/../data/views/vendor/pros/console' => resource_path('views/vendor/pros/console'),
            __DIR__.'/Commands/Pros/Tasks/TemporaryFileCommand.php' => app_path('Console/Commands/Pros/Tasks/TemporaryFileCommand.php'),
            __DIR__.'/Middlewares/ConsoleBaseMiddleware.php' => app_path('Http/Middleware/Abnermouke/Pros/Console/ConsoleBaseMiddleware.php'),
            __DIR__.'/Implementers/AmapAreaImplementers.php' => app_path('Implementers/AmapAreaImplementers.php'),
            __DIR__.'/Implementers/Sms/SmsImplementers.php' => app_path('Implementers/Sms/SmsImplementers.php'),
        ]);
        // 注册配置
        $this->commands('command.builder.pros');
    }
}
