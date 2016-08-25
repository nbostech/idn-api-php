<?php
/**
 * Created by PhpStorm.
 * User: nbmac4
 * Date: 7/21/16
 * Time: 10:45 AM
 */

namespace Nbos\Modules\Oauth;
use Nbos\Api\NetworkApi;


class OAuthApi extends NetworkApi  {
    public function __construct(){
        parent::__construct();
        $this->setHost("http://api.qa1.nbos.in");
        $this->setModuleName("oauth");
        $this->setRemoteApiClass("OAuthRemoteApi");
    }

} 