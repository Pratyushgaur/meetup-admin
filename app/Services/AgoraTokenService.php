<?php

namespace App\Services;

use phpseclib\Crypt\AES;
use App\Services\RtcTokenBuilder;
class AgoraTokenService
{
    private $appId;
    private $appCertificate;

    public function __construct()
    {
        $this->appId = env('AGORA_APP_ID');
        $this->appCertificate = env('AGORA_APP_CERTIFICATE');
    }

    public function generateToken($channelName, $uid, $role, $expireTimeInSeconds = 3600)
    {
        $currentTimestamp = time();
        $privilegeExpireTs = $currentTimestamp + $expireTimeInSeconds;

        // Token generation logic (for example, using AES encryption)
        return $this->generateRtcToken($channelName, $uid, $role, $privilegeExpireTs,$expireTimeInSeconds);


        
    }

    private function generateRtcToken($channelName, $uid, $role, $privilegeExpireTs,$expireTimeInSeconds)
    {
        $currentTimestamp = time();
        $privilegeExpireTs = $currentTimestamp + $expireTimeInSeconds;

        // Generate the token using Agora's RtcTokenBuilder
        return RtcTokenBuilder::buildTokenWithUid($this->appId, $this->appCertificate, $channelName, $uid, $role, $privilegeExpireTs);
    }
}
