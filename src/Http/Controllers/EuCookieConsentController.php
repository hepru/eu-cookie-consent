<?php


namespace the42coders\EuCookieConsent\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cookie;
use the42coders\EuCookieConsent\EuCookieConsent;

class EuCookieConsentController extends Controller
{
    public function setCookie(Request $request)
    {
        $cookieName = config('eu-cookie-consent.cookie_name', 'eu_cookie_consent');
        $cookieValue = json_encode($request->all());
        $lifetime = config('eu-cookie-consent.cookie_lifetime', 60 * 24 * 30);
        
        $cookie = Cookie::make(
            $cookieName,
            $cookieValue,
            $lifetime,
            '/',
            null,
            request()->secure(),
            false,
            false,
            'lax'
        );
        
        return redirect()->back()->withCookie($cookie);
    }

    public function getUpdatePopup(Request $request)
    {
        return EuCookieConsent::getPopup(true);
    }
}
