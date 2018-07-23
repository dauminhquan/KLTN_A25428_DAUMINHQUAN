<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 6/27/2018
 * Time: 5:10 PM
 */

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class ApiCheckEnterpriseOrAdmin
{
    public function handle($request, Closure $next)
    {
        $type = Auth::user()->type;
        if($type == 2 || $type == 1)
        {
            return $next($request);
        }
        return response()->json([
            'message' => 'Bạn không đủ quyền'
        ],406);
    }
}