<?php
/**
 * Created By PHPStorm
 * User: SteffenKong(Konghy)
 * Date: 2020/7/5
 * Time: 20:39
 */

namespace App\Model\services;

use App\Exceptions\AuthorizeException;
use App\Model\dao\AdminDao;
use App\Model\data\AdminData;
use Tools\Core\Loader;
use Hash;
use Tools\Rsa\RSACrypt;

/**
 * Class AdminService
 * @package App\Model\services
 * 管理员服务层
 */
class AdminService {

    /* @var AdminDao $adminDao*/
    protected $adminDao;

    /* @var AdminData $adminData*/
    protected $adminData;

    public function __construct()
    {
        $this->adminData = Loader::data(AdminData::class);
        $this->adminDao = Loader::dao(AdminDao::class);
    }


    /**
     * @param $account
     * @param $password
     * @return array|bool
     * @throws AuthorizeException
     * 登录逻辑
     */
    public function login($account,$password) {
        // 解密
        $rsa = new RSACrypt();
        $rsa->setPrivkey(\config('rbac.privateKey'));
        $password = $rsa->decryptByPrivateKey($password);
        if (!$password) {
            throw new AuthorizeException('解密失败!');
        }
        $admin = $this->adminData->getByAccount($account);
        if (!$admin) {
            return false;
        }

        if (!Hash::check(encryptPassword($password,$admin->salt),$admin->password)) {
            return false;
        }

        if (Hash::needsRehash($admin->password)) {
            $newPassword = Hash::make(encryptPassword($password,$admin->salt));
            $this->adminDao->refreshPassword($admin->id,$newPassword);
        }
        // 返回常用数据
        return [
            'id' => $admin->id,
            'account' => $admin->account,
            'status' => $admin->status,
            'email' => optional($admin->adminInfo)->email,
            'phone' => optional($admin->adminInfo)->phone,
            'isCan' => optional($admin->adminInfo)->is_can
        ];
    }


    /**
     * @param $adminId
     * @return mixed
     */
    public function find($adminId) {
        return $this->adminData->find($adminId);
    }
}
