<?php
/**
 * User Module 
 *
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User\Provider\Identity;

use User\Exception\InvalidRoleException;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Sql;
use Zend\Permissions\Acl\Role\RoleInterface;
//use ZfcUser\Service\User;

/**
 * Identity provider - поставщик  личных данных based on {@see \Zend\Db\Adapter\Adapter}
 *
 * @author 
 */
class UserIdentityProvider implements ProviderInterface
{
    /**
     * @var User
     */
    protected $userService;

    /**
     * @var string|\Zend\Permissions\Acl\Role\RoleInterface
     */
    protected $defaultRole;

    /**
     * @var string
     */
    protected $tableName = 'user_role_linker';

    /**
     * @param \Zend\Db\Adapter\Adapter $adapter
     * @param \ZfcUser\Service\User    $userService
     */
    public function __construct(Adapter $adapter, User $userService)
    {
        $this->adapter     = $adapter;
        $this->userService = $userService;
    }

    /**
     * Получение ролей для учетной записи
     */
    public function getIdentityRoles()
    {
        $authService = $this->userService->getAuthService();

        if (! $authService->hasIdentity()) {
            return array($this->getDefaultRole());
        }

        // get roles associated with the logged in user
        $sql    = new Sql($this->adapter);
        $select = $sql->select()->from($this->tableName);
        $where  = new Where();

        $where->equalTo('user_id', $authService->getIdentity()->getId());

        $results = $sql->prepareStatementForSqlObject($select->where($where))->execute();
        $roles     = array();

        foreach ($results as $i) {
            $roles[] = $i['role_id'];
        }

        return $roles;
    }

    /**
     * @return string|\Zend\Permissions\Acl\Role\RoleInterface
     */
    public function getDefaultRole()
    {
        return $this->defaultRole;
    }

    /**
     * @param string|\Zend\Permissions\Acl\Role\RoleInterface $defaultRole
     *
     * @throws \User\Exception\InvalidRoleException
     */
    public function setDefaultRole($defaultRole)
    {
        if (! ($defaultRole instanceof RoleInterface || is_string($defaultRole))) {
            throw InvalidRoleException::invalidRoleInstance($defaultRole);
        }

        $this->defaultRole = $defaultRole;
    }
}
