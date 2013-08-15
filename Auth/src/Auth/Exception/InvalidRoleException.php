<?php
/**
 * User Module 
 *
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User\Exception;

/**
 * Invalid role exception for BjyAuthorize
 */
class InvalidRoleException extends InvalidArgumentException
{
    /**
     * @param mixed $role
     *
     * @return self
     */
    public static function invalidRoleInstance($role)
    {
        return new self(
            sprintf('Invalid role of type "%s" provided', is_object($role) ? get_class($role) : gettype($role))
        );
    }
}
