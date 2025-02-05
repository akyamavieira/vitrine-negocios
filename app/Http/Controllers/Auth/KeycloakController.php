<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\DTO\UserDTO;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class KeycloakController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function redirectToKeycloak()
    {
        // Keycloak abaixo da versão 3.2 não requer scopes. Versões posteriores requerem o scope 'openid'.
        return Socialite::driver('keycloak')->redirect();
    }

    /**
     * Callback do Keycloak após autenticação.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleKeycloakCallback()
    {
        // Obtém o usuário autenticado no Keycloak
        /** @var \Laravel\Socialite\Two\AbstractProvider  */
        $driver = Socialite::driver('keycloak');
        // Ignora a verificação SSL
        $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false, ), ));
        $driver->setHttpClient($guzzleClient);
        $socialUser = $driver->stateless()->user(); // Obtém o usuário do Keycloak

        // Criando DTO
        $userDTO = new UserDTO(
            $socialUser->id,
            $socialUser->nickname,
            $socialUser->name,
            $socialUser->email
        );

        try {
            // Tenta encontrar o usuário no banco de dados
            $user = $this->userService->findUserById($socialUser->id);
        } catch (ModelNotFoundException $e) {
            // Se o usuário não for encontrado, cria um novo usuário e redireciona para a rota de onboard
            return redirect()->route('onboard')->with('userDTO', $userDTO);
        }
    
        // Se o usuário já existir, autentica e redireciona para a rota index
        Auth::login($user);
        return redirect()->route('index');
    }
    public function backchannelLogout(Request $request)
    {
        // Remover o usuário da sessão
        Session::forget('user');
        Session::invalidate();
        return response()->json(['message' => 'Logout successful'], 200);
    }
}
