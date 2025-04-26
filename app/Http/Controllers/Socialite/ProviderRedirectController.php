<?php

namespace App\Http\Controllers\Socialite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Service;

class ProviderRedirectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(String $provider)
    {
        // Verifica se o provedor está ativo na tabela `services`
        $service = Service::where('name', $provider)->where('active', true)->first();

        if (!$service) {
            return redirect(route('login'))->with('error', 'Provedor inválido ou desativado.');
        }

        try {
            // Redireciona para o provedor
            return Socialite::driver($provider)->redirect();
        } catch (\Exception $e) {
            return redirect(route('login'))->with('error', 'Erro ao redirecionar para o provedor.');
        }
    }
}
