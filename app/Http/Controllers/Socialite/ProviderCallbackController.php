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

        // Obtém os dados do usuário do provedor
        $socialUser = Socialite::driver($provider)->user();

        // Verifica se o e-mail já existe no banco de dados
        $user = User::where('email', $socialUser->getEmail())->first();

        if ($user) {
            // Se o usuário já existir, atualiza os dados do provedor
            $user->update([
                'provider_id' => $socialUser->getId(),
                'provider_name' => $provider,
                'provider_token' => $socialUser->token,
                'provider_refresh_token' => $socialUser->refreshToken,
            ]);
        } else {
            // Se o usuário não existir, cria um novo registro
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'provider_id' => $socialUser->getId(),
                'provider_name' => $provider,
                'provider_token' => $socialUser->token,
                'provider_refresh_token' => $socialUser->refreshToken,
                'password' => bcrypt(Str::random(32)), // Gera uma senha forte e criptografada
            ]);
        }

        // Autentica o usuário
        Auth::login($user);

        // Redireciona para o painel
        return redirect('/dashboard');
    }
}
