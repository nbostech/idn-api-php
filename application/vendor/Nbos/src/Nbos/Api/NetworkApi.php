<?php namespace Nbos\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Normalizer;

class NetworkApi
{
    protected   $moduleName;
    protected   $host;
    protected   $sw;
    protected   $apiContext;


    /**
     * The HTTP Client
     *
     * @var GuzzleHttp\Client
     */
    protected $client;

    /**
     * Create a new Connection instance
     *
     * @param string $key
     * @param string $subdomain
     * @return void
     */
    public function __construct()
    {
        //$this->host = $host;
        //$this->remoteApiClass = $remoteApiClass;
    }

    public function setHost($host) {
        $this->host = trim($host,"/");
    }
    public function getHost(){
        return $this->host;
    }
    public function setModuleName($moduleName) {
        $this->moduleName = $moduleName;
    }
    public function getModuleName(){
        return $this->moduleName;
    }
    public function   getSw() {
        return $this->sw;
    }

    public function setSw($sw) {
        $this->sw = $sw;
    }
    public function getRemoteApiClass() {
        return $this->remoteApiClass;
    }

    public function setRemoteApiClass($remoteApiClass) {
        $this->remoteApiClass = $remoteApiClass;
    }
    public function setApiContext(ApiContext $apiContext) {
        $this->apiContext = $apiContext;
    }
/**
     * Send a GET request
     *
     * @param string $url
     * @param array $params
     * @return Guzzle\Http\Message\Response
     */
    public function get($url, $body, $authorization = false, $bodyType='', $moduleName="app", $moduleKey=false)
    {
        $requestBody =  $this->prepareRequestBody($body, $authorization, $bodyType,$moduleName,$moduleKey);

        try{
            $response = $this->client()->request('GET', $url, $requestBody);
            return $this->sendResponse($response->getStatusCode(), $response);
        }catch (\GuzzleHttp\Exception\ClientException $e){

            return $this->sendResponse($e->getCode(), $e->getResponse());
        }
    }

    /**
     * Send a POST request
     *
     * @param string $url
     * @param string $body
     * @return Guzzle\Http\Message\Response
     */
    public function post($url, $body, $authorization = false, $bodyType='form_params', $moduleName="app", $moduleKey=false)
    {

        $requestBody =  $this->prepareRequestBody($body, $authorization, $bodyType, $moduleName, $moduleKey);
        try{

            $response = $this->client()->request('POST', $url, $requestBody);
            return $this->sendResponse($response->getStatusCode(), $response);
        }catch (\GuzzleHttp\Exception\ClientException $e){

           return $this->sendResponse($e->getCode(), $e->getResponse());
        }


    }

    private function prepareRequestBody($body, $authorization = false, $bodyType, $moduleName, $moduleKey) {
        $requestBody = array();
        switch($bodyType){
            case 'form_params':
                $requestBody['form_params'] =  $body;
                break;
            case 'json':
                $requestBody['body'] =  json_encode($body);
                break;
        }
        if($authorization == true) {
            $apiContext =  \Nbos\Storage\StorageApiContext::get($moduleName);
            $clientToken = $apiContext->getClientToken();

            $bearerToken = $clientToken->getAccess_token();

            $requestBody['headers'] = [
                'Authorization' => "Bearer $bearerToken"
            ];
            if($moduleKey !== false){
                $requestBody['headers']['X-N-ModuleKey'] =  $moduleKey;
            }
        }
        return $requestBody;
    }
    /**
     * Send a PUT request
     *
     * @return Guzzle\Http\Message\Response
     */
    public function put($url, $body)
    {
        return $this->sendResponse($this->client()->put($url, ['body' => $body]));
    }

    /**
     * Send a DELETE request
     *
     * @return Guzzle\Http\Message\Response
     */
    public function delete($url)
    {
        return $this->sendResponse($this->client()->delete($url));
    }
    public function getRemoteApi()
    {
        return $this->getRemoteApiClass();
    }
    /**
     * Return an HTTP client instance
     *
     * @return GuzzleHttp\Client
     */
    public function client()
    {
        if($this->client) return $this->client;

        return new Client([
            'base_uri' => $this->getHost()

        ]);
    }
    /**
     * Return the id of the new entity
     *
     * @param Response $response
     * @return int
     */
    private function processPostResponse(Response $response)
    {
        if (isset($response->getHeaders()['Location']))
        {
            preg_match('/\/(?<id>\d+)$/', $response->getHeaders()['Location'][0], $matches, PREG_OFFSET_CAPTURE);

            return (int) $matches['id'][0];
        }

        return true;
    }
    private function sendResponse($code, $response){
        //echo $responseString;

        switch($code){
            case 200:
                $responseObject = new SuccessResponse();
                $responseObject->setMessage($response->getBody()->getContents());
                break;
            case 400:
                $responseObject = new ValidationErrorResponse();
                $responseObject->setErrors($response->getBody()->getContents());
                break;
            case 404:
                $responseObject = new NotFoundResponse();

                $responseObject->setMessage($response->getReasonPhrase());
                break;
            case 500:
                $responseObject = new InternalErrorResponse();
                $responseObject->setMessage($response->getBody()->getContents());
                break;
            default:
                $responseObject = new ValidationErrorResponse();
                $responseObject->setMessage($response->getBody()->getContents());
                break;
        }
        return $responseObject;

    }
}