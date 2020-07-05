<?php

namespace App\Http\Middleware;

use App\Exceptions\AuthorizeException;
use App\Model\services\AdminService;
use Closure;
use Tools\Core\Loader;
use Tools\Jwt\JwtTool;

/**
 * Class CheckLogin
 * @package App\Http\Middleware
 */
class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     * @throws AuthorizeException
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('Authorize');
        if (!$token) {
            throw new AuthorizeException('未登录!');
        }

        $admin = JwtTool::getInstance(\config('rbac.jwt.secret'))->checkToken($token);
        if(!$admin) {
            throw new AuthorizeException('token非法!');
        }

        /* @var AdminService $adminService*/
        $adminService = Loader::service(AdminService::class);
        if(!$adminService->find($admin->userInfo->id)) {
            throw new AuthorizeException('token非法!');
        }
        return $next($request);
    }
}
