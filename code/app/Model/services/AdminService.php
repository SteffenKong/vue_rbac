<?php
/**
 * Created By PHPStorm
 * User: SteffenKong(Konghy)
 * Date: 2020/7/5
 * Time: 20:39
 */

namespace App\Model\services;

use App\Exceptions\AuthorizeException;
use App\Model\AdminInfo;
use App\Model\dao\AdminDao;
use App\Model\data\AdminData;
use App\Model\entity\Admin;
use DB;
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


    /**
     * @param $page
     * @param $pageSize
     * @param array $where
     * @return array
     * 获取管理员列表
     */
    public function getList($page,$pageSize,$where = []) {
        $items = $this->adminData->getList($page,$pageSize,$where);
        $return = [];
        foreach ($items->items() ?? [] as $item) {
            $return[] = [
                'id' => $item->id,
                'account' => $item->account,
                'email' => $item->email,
                'status' => $item->status,
                'phone' => $item->phone,
                'createdAt' => $item->created_at,
                'updatedAt' => $item->updated_at
            ];
        }
        return [$return,$items->total()];
    }


    /**
     * @param $adminId
     * @param $account
     * @param $email
     * @param $phone
     * @param $isCan
     * @return bool
     * @throws \Exception 更新管理员信息
     */
    public function update($adminId,$account,$email,$phone,$isCan) {
        $result = false;
        try {
            DB::beginTransaction();
            $result1 = $this->adminDao->updateAccount($adminId,$account);
            $result2 = $this->adminDao->updateAdminInfo($adminId,$email,$phone,$isCan);
            if ($result1 && $result2) {
                $result = true;
            }
        }catch (\Exception $e) {
            $result = false;
        }

        if (!$result) {
            DB::rollBack();
            return false;
        }

        DB::commit();
        return true;
    }


    /**
     * @param $adminId
     * @param $password
     * @return bool
     * @throws AuthorizeException
     * 修改密码
     */
    public function changePassword($adminId,$password) {
        $rsa = new RSACrypt();
        $rsa->setPrivkey(\config('rbac.jwt.secret'));
        $password = $rsa->decryptByPrivateKey($password);
        if (!$password) {
            throw new AuthorizeException('密码解密失败!');
        }
        $salt = md5(uniqid('salt_',true));
        $enPass = Hash::make(encryptPassword($password,$salt));
        if(!$this->adminDao->changePassword($adminId,$enPass,$salt)) {
            return false;
        }
        return true;
    }


    /**
     * @param Admin $admin
     * @return int
     * 修改管理员状态
     */
    public function changeStatus(Admin $admin) {
        $adminId = $admin->id;
        $status = $admin->status;
        return $this->adminDao->changeStatus($adminId,$status);
    }

    /**
     * @param $adminId
     * @return mixed
     * @throws \Exception
     * 删除管理员
     */
    public function delete($adminId) {
        try {
            DB::beginTransaction();
            $result = false;
            $result1 = $this->adminDao->deleteAdmin($adminId);
            $result2 = $this->adminDao->deleteAdminInfo($adminId);

            if ($result1 && $result2) {
                $result = true;
            }
        }catch (\Exception $e) {
            $result = false;
        }

        if (!$result) {
            DB::rollBack();
            return false;
        }

        DB::commit();
        return true;
    }




    /**
     * @param $account
     * @param $password
     * @param $email
     * @param $phone
     * @param $isCan
     * @return bool
     * @throws \Exception
     * 创建管理员
     */
    public function create($account,$password,$email,$phone,$isCan) {
        $result = false;
        try {
            DB::beginTransaction();
            $rsa = new RSACrypt();
            $rsa->setPrivkey(\config('rbac.jwt.secret'));
            $password = $rsa->decryptByPrivateKey($password);
            if (!$password) {
                throw new AuthorizeException('密码解密失败!');
            }
            $salt = md5(uniqid('salt_',true));
            $enPass = Hash::make(encryptPassword($password,$salt));
            $result1 = $this->adminDao->insertAdmin($account,$enPass,$salt);
            $result2 = $this->adminDao->insertAdminInfo($result1->id,$email,$phone,$isCan);
            if ($result1 && $result2) {
                $result = true;
            }
        }catch (\Exception $e) {
            $result = false;
        }

        if (!$result) {
            DB::rollBack();
            return false;
        }

        DB::commit();
        return true;
    }


    /**
     * @param $adminId
     * @param $account
     * @return bool
     */
    public function checkAccountIsExistsByUpdate($adminId,$account) {
        return Admin::where('account',$account)
            ->where('id','<>',$adminId)
            ->exists();
    }


    /**
     * @param $adminId
     * @param $email
     * @return bool
     */
    public function checkEmailIsExistsByUpdate($adminId,$email) {
        return AdminInfo::where('email',$email)
            ->where('$adminId','<>',$adminId)
            ->exists();
    }


    /**
     * @param $adminId
     * @param $phone
     * @return bool
     */
    public function checkPhoneIsExistsByUpdate($adminId,$phone) {
        return AdminInfo::where('phone',$phone)
            ->where('$adminId','<>',$adminId)
            ->exists();
    }
}
