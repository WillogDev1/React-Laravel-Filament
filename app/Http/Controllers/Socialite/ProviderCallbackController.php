<?php

namespace App\Http\Controllers\Socialite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ProviderCallbackController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $provider)
    {
        // Verifica se o provedor está ativo na tabela `services`
        $service = Service::where('name', $provider)->where('active', true)->first();

        if (!$service) {
            return redirect(route('login'))->with('error', 'Provedor inválido ou desativado.');
        }

        $socialUser = Socialite::driver($provider)->user();

        $user = User::updateOrCreate(
            [
                'provider_id' => $socialUser->getId(),
                'provider_name' => $provider,
            ],
            [
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'provider_token' => $socialUser->token,
                'provider_refresh_token' => $socialUser->refreshToken,
                'password' => bcrypt(Str::random(32)), // Gera uma senha forte e criptografada
            ]
        );

        Auth::login($user);

        return redirect('/dashboard');
    }
}
