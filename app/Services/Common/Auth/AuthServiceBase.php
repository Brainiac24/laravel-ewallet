<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2018
 * Time: 9:45
 */

namespace App\Services\Common\Auth;


use App\Exceptions\Frontend\Api\AccessForbiddenException;
use App\Exceptions\Frontend\Api\LogicException;
use App\Exceptions\Frontend\Api\TimeoutException;
use App\Exceptions\Frontend\Api\UnauthorizedException;
use App\Exceptions\Frontend\Api\WaitingException;
use App\Exceptions\Frontend\Api\ValidationException;
use App\Models\User\User;
use App\Repositories\Frontend\User\UnverifiedUser\UserRepositoryContract;
use App\Services\Common\Helpers\HttpStatusCode;
use App\Services\Common\Helpers\Platform;
use Carbon\Carbon;
use ReallySimpleJWT\TokenBuilder;
use App\Services\Common\Auth\TokenValidator;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

abstract class AuthServiceBase
{
    use AuthServiceBaseTrait;

    /**
     * @param string $token
     * @param array $device
     * @throws UnauthorizedException
     * @throws LogicException
     * @throws \Exception
     */
    protected function checkHashTokenForHello(string $token, array $device)
    {
        if (!isset($device['id']) || !isset($device['platform']))
            throw new LogicException('Payload in hello not found');

        $data = explode('.', $token);

        if (!isset($data[1]) || empty($data[1]))
            throw new UnauthorizedException();

        $timestamp = (int)base64_decode($data[1]);
        if (!is_int($timestamp) || strlen($timestamp) !== 10)
            throw new LogicException('Payload data incorrect');

        $hash = $this->makeHashHello($device['id'], $device['platform'], $timestamp);
        if ($data[0] !== $hash)
            throw new LogicException();
    }

    /**
     * @param string $deviceId
     * @param bool $platform
     * @param int $timestamp
     * @return string
     * @throws \Exception
     */
    protected function makeHashHello(string $deviceId, bool $platform, int $timestamp)
    {
        $key = hash('sha256', $this->getAppKey($platform));

        return base64_encode(hash('sha256', sprintf('%s:%d:%s', $deviceId, $timestamp, $key)));
    }


}