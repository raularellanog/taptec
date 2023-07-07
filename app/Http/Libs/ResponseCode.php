<?php

namespace App\Http\Libs;

class ResponseCode
{
    public function response($code = 0, $message = null, $data = null, $reponse = null)
    {
        try {
            if ($reponse != null) {
                return response(['code' => $code, 'data' => $data, $reponse], 200);
            }
            if ($message != null && $code == 200) {
                return response(['code' => $code, 'message' => $message, 'data' => $data], 200);
            }
            switch ($code) {
                case '200':
                    return response(['code' => $code, 'message' => 'Proceso realizado', 'data' => $data], 200);
                    break;
                case '201':
                    return response(['code' => $code, 'message' => 'Usuario ya registrado', 'data' => $data], 200);
                    break;
                case '202':
                    return response(['code' => $code, 'message' => 'Token no generado', 'data' => $data], 200);
                    break;
                case '203':
                    return response(['code' => $code, 'message' => 'Código ya activado anteriormente', 'data' => $data], 200);
                    break;
                case '204':
                    return response(['code' => $code, 'message' => 'Código no existe', 'data' => $data], 200);
                    break;
                case '205':
                    return response(['code' => $code, 'message' => 'Usuario no existe.', 'data' => $data], 200);
                    break;
                case '299':
                    return response(['code' => $code, 'message' => 'Falta parametros', 'data' => $data], 200);
                    break;
                default:
                    return response(['code' => $code, 'message' => 'Existe un error', 'data' => $data], 200);
                    break;
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response(['code' => $code, 'message' => 'Existe un error', 'data' => $th], 404);
        }
    }
}
