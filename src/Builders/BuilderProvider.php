<?php

namespace Abnermouke\Pros\Builders;

use Abnermouke\EasyBuilder\Module\BaseModel;
use Abnermouke\EasyBuilder\Tools\DocParserTool;
use App\Handler\Cache\Data\Pros\Console\NodeCacheHandler;
use App\Repository\Pros\Console\NodeRepository;
use Illuminate\Support\Facades\Route;

/**
 * 构建器服务提供者
 * Class BuilderProvider
 * @package Abnermouke\Pros\Builders
 */
class BuilderProvider
{

    //主题颜色配置
    public const THEME_COLORS = [
        'theme_alias' => ['primary', 'info', 'success', 'danger', 'warning', 'dark'],
        'theme_names' => ['primary' => '明亮', 'info' => '强调', 'success' => '成功', 'danger' => '错误', 'warning' => '警告', 'dark' => '暗色'],
        'status' => [BaseModel::STATUS_ENABLED => 'success', BaseModel::STATUS_DISABLED => 'warning', BaseModel::STATUS_VERIFYING => 'primary', BaseModel::STATUS_VERIFY_FAILED => 'info', BaseModel::STATUS_DELETED => 'danger'],
        'switch' => [BaseModel::SWITCH_ON => 'success', BaseModel::SWITCH_OFF => 'danger']
    ];

    //配置参数
    private static $configs;

    /**
     * 开始检测节点并自动处理
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-31 17:43:35
     * @param bool|array $configs
     * @return array
     * @throws \ReflectionException
     */
    public static function run($configs = [])
    {
        //配置信息
        self::$configs = $configs ? array_merge(config('pros.nodes', []), $configs) : config('pros.nodes', []);
        //初始化处理标识信息
        $route_aliases = [];
        //获取全部路由信息
        if ($routes = Route::getRoutes()->getRoutesByName()) {
            //循环路由信息
            foreach ($routes as $route_name => $route) {
                //设置路由信息
                if ($node_alias = self::routeInfo($route_name, $route->methods, $route->action)) {
                    //设置处理标识信息
                    $route_aliases[] = $node_alias;
                }
                //释放内存
                unset($routes[$route_name]);
            }
        }
        //判断是否存在处理的别名信息
        if ($route_aliases) {
            //删除已失效的节点信息
            (new NodeRepository())->delete(['alias' => ['not-in', $route_aliases]]);
        }
        //刷新缓存
        return (new NodeCacheHandler())->refresh();
    }

    /**
     * 初始化路由信息
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-31 17:43:35
     * @param $route_name
     * @param $methods
     * @param $action
     * @return false|mixed
     * @throws \ReflectionException
     */
    private static function routeInfo($route_name, $methods, $action)
    {
        //判断路由名是否忽略
        if (in_array($route_name, data_get(self::$configs, 'ignore_route_names', []), true)) {
            //跳过当前信息
            return false;
        }
        //获取请求方式
        $method = $methods ? strtolower(head($methods)) : 'get';
        //获取中间件信息
        $middleware = array_intersect(data_get(self::$configs, 'index_route_middleware', []), $action['middleware']);
        //判断中间件是否被允许
        if (!$middleware || empty($middleware)) {
            //跳出当前信息
            return false;
        }
        //判断命名空间是否允许
        if (!in_array($action['namespace'], data_get(self::$configs, 'index_namespaces', []), true)) {
            //跳过当前信息
            return false;
        }
        //整理节点信息
        $node = ['alias' => $method.'&'.$route_name, 'route_name' => $route_name, 'guard_name' => self::getClassFunctionDescription($action['controller']), 'method' => $method, 'group_name' => self::getClassDescription($action['controller']), 'middleware' => $action['middleware'], 'action' => $action['controller'], 'created_at' => auto_datetime(), 'updated_at' => auto_datetime()];
        //引入Repository
        $repository = new NodeRepository();
        //设置信息
        if (!$repository->updateOrInsert(['alias' => $node['alias']], $node)) {
            //返回失败
            return false;
        }
        //返回路由别名
        return $node['alias'];
    }

    /**
     * 获取类描述
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-31 17:43:35
     * @param $controller
     * @return string|string[]
     * @throws \ReflectionException
     */
    private static function getClassDescription($controller)
    {
        //整理信息
        $class_name = head(explode('@', $controller));
        //分隔符与命名空间相反，需替换
        $class = str_replace(DIRECTORY_SEPARATOR, '\\', $class_name);
        //初始化class
        $class = new \ReflectionClass($class);
        //实例化解析注释类
        $docPsr = new DocParserTool();
        //获取类注释
        $doc = $docPsr->parse($class->getDocComment());
        //整理注释信息
        $description = $doc && isset($doc['description']) ? preg_split("/(\n){1}/", $doc['description'], -1) : '';
        //获取描述
        $description = $description ? head($description) : $class->name;
        //整理信息
        return str_replace(data_get(self::$configs, 'controller_group_name_suffix', '基础控制器'), '', $description);
    }

    /**
     * 获取方法注释
     * @Author Abnermouke <abnermouke@outlook.com>
     * @Originate in Abnermouke's MBP
     * @Time 2022-03-31 17:43:35
     * @param $controller
     * @return mixed
     * @throws \ReflectionException
     */
    private static function getClassFunctionDescription($controller)
    {
        //整理信息
        $class_name = head(explode('@', $controller));
        $function_name = last(explode('@', $controller));
        //分隔符与命名空间相反，需替换
        $class = str_replace(DIRECTORY_SEPARATOR, '\\', $class_name);
        //初始化class
        $class = new \ReflectionClass($class);
        //获取当前class所有方法名
        $public_functions = $class->getMethods(\ReflectionMethod::IS_PUBLIC);
        //判断方法信息
        if ($public_functions) {
            //循环方法信息
            foreach ($public_functions as $k => $function) {
                //判断是否为当前分类
                if ($function->class === $class_name && $function->name === $function_name) {
                    //实例化解析注释类
                    $docPsr = new DocParserTool();
                    //获取注释
                    if ($document = $docPsr->parse($function->getDocComment())) {
                        //设置名称
                        $function_name = data_get($document, 'description', '') ? $document['description'] : $function_name;
                    }
                }
                //释放内存
                unset($public_functions[$k]);
            }
        }
        //返回名称
        return $function_name;
    }


}
