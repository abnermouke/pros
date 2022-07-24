# pros - 一款高效的Laravel项目启动方案

 Power By Abnermouke <abnermouke@outlook.com>

 此工具包由 Abnermouke <abnermouke@outlook.com> 开发并维护。

----

最后更新时间：2022年07月25日，持续更新中！！！

---


## Requirement - 环境要求

1. PHP >= 7.2（建议安装7.4）
2. **[Composer](https://getcomposer.org/)**
3. abnermouke/easy-builder
4. Laravel Framework 6+



## Installation - 安装方法

```shell
$ composer require "abnermouke/pros"
```

## Configuration - 配置

- 一切就绪之前，请先确保 "abnermouke/easy-builder" 配置已就位

点击 [abnermouke/easy-builder](https://github.com/abnermouke/easy-builder) 查看配置方法


- 在`config/app.php`的`providers`注册服务提供者

```php
Abnermouke\Pros\ProsServiceProvider::class,
```
- 如果你想只在非`production`的模式中使用构建器功能，可在`AppServiceProvider`中进行`register()`配置

```php
public function register()
{
  if ($this->app->environment() !== 'production') {
      $this->app->register(\Abnermouke\Pros\ProsServiceProvider::class);
  }
  // ...
}
```

-  构建工具提供一配置文件帮助开发者自行配置自己的构建配置，导出命令：

```shell
php artisan vendor:publish --provider="Abnermouke\Pros\ProsServiceProvider"
```


- 设置路由 
```php
protected $middlewareGroups = [

        // 其他路由配置

        'abnermouke.pros.console' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],


        'abnermouke.pros.console.auth' => [
            \App\Http\Middleware\Abnermouke\Pros\Console\ConsoleBaseMiddleware::class
        ],
    ];

```
- 注册路由
- 移除 app/Http/Kernel.php 默认中间件：\Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,

设置默认服务注册  app/Providers/AppServiceProvider.php

```

    public function register()
    {
    
        //其他配置
    
        //迁移配置
        Schema::defaultStringLength(191);
        //默认路由条件配置
        Route::pattern('page', '[0-9]+');
        Route::pattern('page_size', '[0-9]+');
        Route::pattern('id', '[0-9]+');
        Route::pattern('status', '[0-9]+');
        Route::pattern('parent_id', '[0-9]+');
        Route::pattern('order_sn', '[A-Z0-9]+');
    }


```

Laravel 6 与 Laravel 7 中配置路由服务 app/Providers/RouteServiceProvider.php

```
  public function map()
    {
        
        // 其他路由配置

        $this->mapAbnermoukeProConsoleRoutes();
    }

    /**
     * Define the "abnermouke/pros" console routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAbnermoukeProConsoleRoutes()
    {
        Route::middleware('abnermouke.pros.console')
            ->namespace('App\Interfaces\Pros\Console\Controllers')
            ->group(base_path('routes/abnermouke/pros/console.php'));
    }
```

Laravel 8 中配置路由服务 app/Providers/RouteServiceProvider.php

```
public function boot()
{
    $this->configureRateLimiting();
    
    $this->routes(function () {
    
         // 其他路由服务注册

        Route::middleware('abnermouke.pros.console')
            ->namespace('App\Interfaces\Pros\Console\Controllers')
            ->group(base_path('routes/abnermouke/pros/console.php'));
    });
}
```

增加Csrf例外 app/Http/Middleware/VerifyCsrfToken.php （处理ueditor或其他插件文件上传无法加入csrf验证）

```
    protected $except = [
        
        //其他例外
    
        'pros/console/uploader/*'
    ];
```

- 添加辅助函数自动加载至 composer.json

```php
     "autoload": {
       
       // 
        
        "files": [
            
            //其他加载文件
            
            "app/Helpers/pros.php"
        ]
    },
```

- 执行 Composer Autoload 以生效辅助函数

```shell
composer dump-autoload
```


### Usage 使用方法

执行命令：
```shell
php artisan builder:pros
```


##### 更新记录

2022.07.26 - 项目发布

- 全新构建结构，帮助开发者快速启动项目

## License

MIT
