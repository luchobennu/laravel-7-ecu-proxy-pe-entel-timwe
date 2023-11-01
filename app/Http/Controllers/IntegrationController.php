<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Clients\HttpClient;
use App\Services\CoreApi;
use App\Managers\HeadersManager;

use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class IntegrationController extends Controller
{
    private $headersManager;

    public function __construct()
    {
        $this->headersManager = new HeadersManager();
    }

    public function checkSubscription(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'msisdn' => 'required',
            'serviceId' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $headers = $this->headersManager->getHeaders('CORE');
        $core = new CoreApi(new HttpClient($headers, env('CORE')));
        $response = $core->checkSubscription($request->all());
        return response()->json($response['info'], $response['code']);
    }

    public function checkSubscriptionV2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'msisdn' => 'required',
            'serviceId' => 'array',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $headers = $this->headersManager->getHeaders('CORE');
        $core = new CoreApi(new HttpClient($headers, env('CORE')));
        $response = $core->checkSubscriptionV2($request->all());
        return response()->json($response['info'], $response['code']);
    }

    public function Create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'msisdn' => 'required',
            'serviceId' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->all();
        $headers = $this->headersManager->getHeaders('CORE');
        $core = new CoreApi(new HttpClient($headers, env('CORE')));
        $response = $core->checkSubscription($request->all());

        if ($response['code'] == 200) {
            foreach($response["info"]["items"] as $i){
                if($i["service_id"] == $data["serviceId"]){

                    $data["subscriptionId"] = $i["subscription_id"];
                    $data["userId"] = $data["msisdn"];
                    $data["serviceOfferKey"] = $i["service_offer_key"];
                    $response = $core->create($data);

                    if(is_object($response)){exit();}
                    if($response["code"] == 201){
                        return response()->json($response['info'], 200);
                    }else{
                        return response(["status" => "ERROR", "message" => "No valid subscriptions"],210);
                    }
                }
            }
        }
        return response(["ERROR" => "Subscription not found"], 210);
    }

    public function CustomCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'msisdn' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->all();
        $headers = $this->headersManager->getHeaders('CORE');
        $core = new CoreApi(new HttpClient($headers, env('CORE')));
        $response = $core->customCreate($data);
  
        if($response != false && $response["code"] == 201){

            return response()->json($response['info'], 200);

        }
        return response(["status" => "ERROR", "response" => "Cant Create"],210);

        
    }

    public function refresh(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->all();
        $headers = $this->headersManager->getHeaders('CORE');
        $core = new CoreApi(new HttpClient($headers, env('CORE')));
        $response = $core->validateToken($data);
  
        if($response != false && $response["code"] == 201){

            return response()->json($response['info'], 200);

        }
        return response(["status" => "ERROR", "response" => "INVALID_TOKEN"],210);
    }

    public function customRefresh(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->all();
        $headers = $this->headersManager->getHeaders('CORE');
        $core = new CoreApi(new HttpClient($headers, env('CORE')));
        $response = $core->validateCustomToken($data);
  
        if($response != false && $response["code"] == 201){

            return response()->json($response['info'], 200);

        }
        return response(["status" => "ERROR", "response" => "INVALID_TOKEN"],210);
    }
}
