<?php


namespace App\Http\Controllers;


use App\Http\Services\JavbusService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class WebController extends Controller
{
    /**
     * @param  Request  $request
     * @param  JavbusService  $service
     * @return Application|ResponseFactory|Response
     * @throws Exception
     */
    public function query(Request $request, JavbusService $service)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|alpha_dash'
        ]);

        if ($validator->fails()) {
            return response($validator->errors());
        }

        $code = $request->get('code');

        return response($service->get_info($code));
    }

    /**
     * @param  JavbusService  $service
     * @return Application|ResponseFactory|Response
     * @throws Exception
     */
    public function rand(JavbusService $service)
    {
        return response($service->rand());
    }
}
