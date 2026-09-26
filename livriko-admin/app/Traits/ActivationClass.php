<?php
namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ActivationClass
{
    public function dmvf($request)
    {
        // Local activation path: store credentials in session and continue installer
        session()->put(base64_decode('cHVyY2hhc2Vfa2V5'), $request[base64_decode('cHVyY2hhc2Vfa2V5')]);//pk
        session()->put(base64_decode('dXNlcm5hbWU='), $request[base64_decode('dXNlcm5hbWU=')]);//un
        return base64_decode('c3RlcDM=');//s3
    }

    public function actch(): JsonResponse
    {
        return response()->json([
            'active' => 1
        ]);
    }

    public function isLocal(): bool
    {
        $whitelist = array(
            '127.0.0.1',
            '::1'
        );

        if(!in_array(request()->ip(), $whitelist)){
            return false;
        }

        return true;
    }
}
