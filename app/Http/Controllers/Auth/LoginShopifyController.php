<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use App\Models\UserProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socialite;

class LoginShopifyController extends Controller
{
    /**
     * Redirect the user to the Shopify authentication page.
     */
    public function redirectToProvider(Request $request)
    {
        $this->validate($request, [
            'domain' => 'string|required'
        ]);

        $config = new \SocialiteProviders\Manager\Config(
            env('SHOPIFY_API_KEY'),
            env('SHOPIFY_API_SECRET'),
            env('SHOPIFY_REDIRECT_URI'),
            ['subdomain' => $request->get('domain')]
        );

        return Socialite::with('shopify')
            ->setConfig($config)
            ->scopes(['read_products','write_products', 'read_customers'])
            ->redirect();
    }

    /**
     * Obtain the user information from Shopify.
     */
    public function handleProviderCallback()
    {
        $shopifyUser = Socialite::driver('shopify')->stateless()->user();

        // Create user
        $user = User::firstOrCreate([
            'name' => $shopifyUser->nickname,
            'email' => $shopifyUser->email,
            'password' => '',
        ]);

        // Store the OAuth Identity
        UserProvider::firstOrCreate([
            'user_id' => $user->id,
            'provider' => 'shopify',
            'provider_user_id' => $shopifyUser->id,
            'provider_token' => $shopifyUser->token,
        ]);

        // Create shop
        $shop = Store::firstOrCreate([
            'name' => $shopifyUser->name,
            'domain' => $shopifyUser->nickname,
        ]);

        // Attach shop to user
        $shop->users()->syncWithoutDetaching([$user->id]);

        // Login with Laravel's Authentication system
        Auth::login($user, true);

        return redirect('dashboard');
    }
}
