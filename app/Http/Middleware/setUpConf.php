<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Services\Mapping\Resource;

class setUpConf
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)

    {
        if (empty($request->input('serviceId'))) {
            return "undefined";
        }
        
        $conf = json_decode(Resource::getResource("Services.json"), true);
        $data = $request->all();
        
        foreach ($conf as $i) {
            if ($data["serviceId"] == $i["serviceId"]) {
                $add = [
                    "serviceId" => $i["serviceId"],
                    "nextRenewalDate" => $i["nextRenewalDate"],
                    "serviceAllowedAccessUntilDate" => $i["serviceAllowedAccessUntilDate"],
                    "partnerId" => $i["partnerId"],
                    "productId" => $i["productId"],
                    "serviceCodeId" => $i["serviceCodeId"],
                    "expirationTime" => $i["expirationTime"],
                    "sms" => $i["sms"]
                ];

                $date = (isset($data["date"])) ? Carbon::parse($data["date"])->toDateTimeString() : Carbon::now()->toDateTimeString();

                $add["formatDate"] = $date;

                $request->request->add($add);
                return $next($request);
            }
        }

        return response("Conf not found", 210)->send();
    }
}
