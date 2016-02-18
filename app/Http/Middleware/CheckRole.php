<?php namespace App\Http\Middleware;

use App\Role;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Get the required roles from the route
        $roles = $this->getRequiredRoleForRoute($request->route());
//        dd(Auth::getUser()->role);
//        dd($roles);
        // Check if a role is required for the route, and
        // if so, ensure that the user has that role.
        if (Auth::getUser()->hasRole($roles) || !$roles) {
            return $next($request);
        }
        return response([
            'error' => [
                'code' => 'INSUFFICIENT_ROLE',
                'description' => trans('msg.access_denied')
            ]
        ], 401);
    }

    private function getRequiredRoleForRoute($route)
    {
        $actions = $route->getAction();
        if (isset($actions['roles'])){
            $roles = Role::whereIn('name', $actions['roles'])->get();
        }
//        dd($actions);
//        $roles = new Collection;
//        if (isset($actions['roles'])){
//            $result = $actions['roles'];
//            foreach ($result as $action){
//                $role = Role::where('name', '=', $action)->firstOrFail();
//                $roles->add($role);
//            }
//        }else{
//            $roles = null;
//        }
        return $roles;
    }
}