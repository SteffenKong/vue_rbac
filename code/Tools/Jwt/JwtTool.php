<?php
/**
 * Created By PHPStorm
 * User: SteffenKong(Konghy)
 * Date: 2020/6/27
 * Time: 16:02
 */

namespace Tools\Jwt;

use Carbon\Carbon;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Parser;

/**
 * Class JwtTool
 * @package App\Until
 * JWT 令牌工具
 */
class JwtTool {


    private $secrt;


    private static $instance = null;


    private function __clone() {}

    /**
     * JwtTool constructor.
     * @param $secrt
     */
    private function __construct($secrt)
    {
        $this->secrt = $secrt;
    }


    /**
     * @param $secrt
     * @return JwtTool|null
     */
    public static function getInstance($secrt) {
        if (!self::$instance instanceof self) {
            self::$instance = new self($secrt);
        }
        return self::$instance;
    }


    /**
     * @param $info
     * @return string
     * 生成token
     */
    public function makeToken($info) {

        $builder = new Builder();
        $signer = new Sha256();

        $builder->setIssuedAt(Carbon::now()->timestamp);
        $builder->setAudience('api.rbac.com');
        $builder->setSubject('www.rbac.com');
        $builder->setId('userId',$info['id']);
        $builder->setExpiration(Carbon::now()->addHours(5)->timestamp);
        $builder->setNotBefore(Carbon::now()->addSeconds(5)->timestamp);
        $builder->set('userInfo',$info);

        $builder->sign($signer,$this->secrt);
        return (string) $builder->getToken();
    }


    /**
     * @param $token
     * @return bool|mixed
     * 校验token
     */
    public function checkToken($token) {
        if (empty($token)) {
            return false;
        }

        $signer = new Sha256();
        $parser = new Parser();

        $res = $parser->parse($token);

        // 是否非法
        if (!$res->verify($signer,$this->secrt)) {
            return false;
        }

        // 是否过期
        if ($res->isExpired()) {
            return false;
        }

        $token = $res->getClaims();

        $tokenStr = json_encode($token);

        return json_decode($tokenStr);
    }
}
