<?php

namespace V1nk0\PostatPlc;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use V1nk0\PostatPlc\Contracts\RequestContract;
use V1nk0\PostatPlc\Exceptions\PlcException;

abstract class Request implements RequestContract
{
    public string $action;

    protected string $client_id;
    protected string $org_unit_id;
    protected string $org_unit_guid;

    public string $userAgent;

    protected string $endpoint;

    public function __construct(?string $client_id = null, ?string $org_unit_guid = null, ?string $org_unit_id = null, ?string $env = null)
    {
        $this->client_id = $client_id ?? config('services.plc.client_id');
        $this->org_unit_id = $org_unit_id ?? config('services.plc.org_unit_id');
        $this->org_unit_guid = $org_unit_guid ?? config('services.plc.org_unit_guid');

        $this->userAgent = config('app.name') . ' - Laravel HTTP-Client';

        $env = (in_array($env, ['PRODUCTION', 'TEST'])) ? $env : config('services.plc.env');
        $this->endpoint = ($env === 'PRODUCTION') ? 'https://plc.post.at/Post.Webservice/ShippingService.svc/secure' : 'https://abn-plc.post.at/DataService/Post.Webservice/ShippingService.svc/secure';
    }

    /**
     * @throws PlcException
     */
    public function submit(): Response
    {
        $xml = $this->assembleXml($this->getBody());

        try {
            $response = Http::withBody($xml, 'text/xml')
                ->withoutVerifying()
                ->withHeaders([
                    'SOAPAction' => 'http://post.ondot.at/IShippingService/'.$this->action,
                    'User-Agent' => $this->userAgent
                ])
                ->post($this->endpoint);

            $response->throw();
        }
        catch(\Exception $e) {
            Log::error('PLC-Error for action ' . $this->action . ': ' . $e->getMessage());
            throw new PlcException($e->getMessage());
        }

        // Get response
        $xml_response = simplexml_load_string($response->body(), 'SimpleXMLElement', LIBXML_NOCDATA);
        $namespace = 'http://schemas.xmlsoap.org/soap/envelope/';
        $envelope = $xml_response->children($namespace);
        $body = $envelope->Body;
        $response = $body->children('http://post.ondot.at')[0];

        $errorCode = (isset($response->errorCode) && !empty($response->errorCode)) ? (string)$response->errorCode : null;
        $errorMessage = (isset($response->errorMessage) && !empty($response->errorMessage)) ? (string)$response->errorMessage : null;

        if($errorCode) {
            Log::error('PLC-Error in response for action ' . $this->action . ': ' . $errorCode . ' - ' . $errorMessage);
            throw new PlcException($errorCode .': '. $errorMessage);
        }

        return $this->returnResponse($response);
    }

    private function assembleXml(string $body): string
    {
        $xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:post="http://post.ondot.at" xmlns:arr="http://schemas.microsoft.com/2003/10/Serialization/Arrays" xmlns:core="http://Core.Model" xmlns:ser="http://schemas.microsoft.com/2003/10/Serialization/">'."\r\n";
        $xml .= '<soapenv:Header/>'."\r\n";
        $xml .= '<soapenv:Body>'."\r\n";
        $xml .= '   <post:'.$this->action.'>'."\r\n";
        $xml .= '       '.$body . "\r\n";
        $xml .= '   </post:'.$this->action.'>'."\r\n";
        $xml .= '</soapenv:Body>'."\r\n";
        $xml .= '</soapenv:Envelope>';

        $searchFor = [
            '{{CLIENT_ID}}',
            '{{ORG_UNIT_ID}}',
            '{{ORG_UNIT_GUID}}'
        ];

        $replaceWith = [
            $this->client_id,
            $this->org_unit_id,
            $this->org_unit_guid
        ];

        return str_replace($searchFor, $replaceWith, $xml);
    }
}
