<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Login
{
    use SingleResponse;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = null;
        if($request->ajax() && !$request->hasHeader('token')){
           //Obtener el token del header token
            $data = [
                'isOk' => false,
                'mensaje' => 'Por favor de iniciar sesión.'
            ];
            return $this->response($data);
        }

        if(!$request->ajax() && $request->token == null){
            abort(403);
        }

        $token = $request->hasHeader('token') ? $request->header('token') : null;
        $token = $token == null ? $request->token : $token;

        $key = hash('sha256', 'E1qZMl1GM3tmoq$J4rMn');
        $iv = substr(hash('sha256', '101712'), 0, 16);

        $login = openssl_decrypt(base64_decode($token), 'AES-256-CBC', $key, 0, $iv);

        //Buscar en BD si el usuario ya está registrado
        $usuario = User::where('usuario', '=', $login)->get();
        if(count($usuario) < 1){
            $datosUser = DB::connection('CapHumDB')->table('personas')
                            ->selectRaw('clave, CONCAT(nombre, " ", a_paterno, " ", a_materno) AS nombre, usuario, email')
                            ->where('usuario', '=', $login)
                            ->get();
            foreach($datosUser as $itemUser){
                $clave = $itemUser->clave;
                $nombre = $itemUser->nombre;
                $userCH = $itemUser->usuario;
                $correo_institucional = $itemUser->email;
            }
            $userSave = new User();
            $userSave->clave = $clave;
            $userSave->nombre = $nombre;
            $userSave->usuario = $userCH;
            $userSave->correo_institucional = $correo_institucional;
            $userSave->password = bcrypt($login);
            $userSave->save();
        }
        $nombreUser = DB::table('users')
                        ->select('nombre')
                        ->where('usuario', '=', $login)
                        ->get();
        foreach($nombreUser as $itemNomUser){
            $nombre = $itemNomUser->nombre;
        }
        //iniciar session
        Auth::attempt(['usuario' => $login, 'password' => $login]);

        session(['nombre' => $nombre]);
        session(['token' => $token]);
        session(['usuario' => $usuario]);
        return $next($request);
    }
}
