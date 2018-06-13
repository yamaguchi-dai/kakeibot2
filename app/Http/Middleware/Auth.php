<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Description of Auth
 *
 * @author user
 */
class Auth {

    public function handle($request, Closure $next) {
        //ログインしていない場合、ログイン画面へ
        if (session('auth') != true) {
            return redirect('login');
        }
        return $next($request);
    }

}
