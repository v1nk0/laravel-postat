<?php

namespace V1nk0\LaravelPostat;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use V1nk0\LaravelPostat\Contracts\RequestContract;
use V1nk0\LaravelPostat\Exceptions\PlcException;

abstract class Request implements RequestContract
{
    private Credentials $credentials;

    public string $action;

    public string $userAgent;

    protected string $endpoint;

    public function __construct(Credentials $credentials, Environment $environment)
    {
        $this->credentials = $credentials;

        $this->userAgent = config('app.name') . ' - Laravel HTTP-Client';

        $this->endpoint = ($environment === Environment::PRODUCTION) ? 'https://plc.post.at/Post.Webservice/ShippingService.svc/secure' : 'https://abn-plc.post.at/DataService/Post.Webservice/ShippingService.svc/secure';
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
                ->timeout(config('services.postat.plc.timeout', 30))
                ->retry(config('services.postat.plc.retry', 3), config('services.postat.plc.retry_backoff', 100))
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
            '{{ORG_UNIT_GUID}}',
            '{{ORG_UNIT_ID}}',
        ];

        $replaceWith = [
            $this->credentials->getClientId(),
            $this->credentials->getOrgUnitGuid(),
            $this->credentials->getOrgUnitId(),
        ];

        return str_replace($searchFor, $replaceWith, $xml);
    }
}
