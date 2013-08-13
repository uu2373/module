<?php
namespace User\Services;
//use Zend\Authentication;
use Zend\Authentication\Adapter\AdapterInterface;
class Authentication implements AdapterInterface {
        private $username;
        private $password;
        private $db;
        private $identity;

/*        function __construct($username, $password) {
                $this->username = $username;
                $this->password = $password;
        }
*/        
        function authenticate() {
                exit;
                $this->db = Zend_Db_Table_Abstract::getDefaultAdapter();
                //$em = Zend_Registry::get('em');
                $sql="select USERID,FNAME,LNAME,STATUS from SYS\$GETCUST(?,?)";
                
                $stmt = $this->db->query($sql,array($this->username,strtoupper(md5($this->password))));
                $this->identity=$stmt->fetch(); 
                //print_r($this->identity);exit;
                


                switch ($this->identity['STATUS']) {
                  case -1:$statuscode='Учетная запись клиента не найдена';return new Zend_Auth_Result(Zend_Auth_Result::FAILURE, null);break;
                  case -2:$statuscode='Неверный пароль клиента';return new Zend_Auth_Result(Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID, null);break;
                  case  0:$statuscode='Доступ запрещен';return new Zend_Auth_Result(Zend_Auth_Result::FAILURE, null);break;
                  case  1:$this->identity['role']='user';
                          //print_r($this->identity);
                          //exit;

                          return new Zend_Auth_Result(Zend_Auth_Result::SUCCESS, $this->username);break;
                }

                
/*              print_r($res);
                exit;
*/        
                /*$query = $this->db->createQuery('select u from Application\Entities\User u WHERE u.name = :username')
                                        ->setParameter('username', $this->username);*/
                try {
                        $user = $query->getSingleResult();
                        $salt = $user->salt;
                        $hashedPassword = hash_hmac('sha256', $this->password, $salt);
                        if ($hashedPassword == $user->password) {
                                // login success

                                return new Zend_Auth_Result(Zend_Auth_Result::SUCCESS, $user);

                        } else {
                                // wrong password
                                return new Zend_Auth_Result(Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID, null);
                        }
                } catch (NonUniqueResultException $e) {
                        // non unique result
                        return new Zend_Auth_Result(Zend_Auth_Result::FAILURE, null);
                } catch (NoResultException $e) {
                        // no result found
                        return new Zend_Auth_Result(Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND, null);
                } catch (Exception $e) {
                        // exception occured
                        return new Zend_Auth_Result(Zend_Auth_Result::FAILURE, null);
                }
        }
        
   public function getIdentity(){
           $returnObject=new stdClass();
           //$availableColumns = array_keys($this->identity);
           foreach ( (array) $this->identity as $key=>$returnColumn) {
                                //if (in_array($returnColumn, $availableColumns)) {
                                        $returnObject->{$key} = $returnColumn;
                                //}
                        }
//echo $returnObject;exit;
           return $returnObject;
           
           
           //return $this->identity;
   }    
   
 public function hasIdentity(){
    return false;
 }

        
} 

