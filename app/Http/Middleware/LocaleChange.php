<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LocaleChange
{
    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::guest() && $request->isMethod('get')) {
            $change = $request->query('updateLocale');
            $locale = LaravelLocalization::getCurrentLocale();
            $user = Auth::user();
            if (!empty($change)) {
                // Changing locale, save the new one
                $user->update(['locale' => $locale]);
                return redirect()->to($request->url());
            } elseif ($user->locale != $locale) {
                // Redirect to the user's normal locale
                return redirect()->to(LaravelLocalization::getLocalizedURL($user->locale));
            }
        }

        return $next($request);
    }
}
