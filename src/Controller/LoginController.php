<?php
/**
 * Herms Home (https://theicon.co.nz/)
 *
 * LoginController
 *
 * PHP version 7
 *
 * @category Module
 * @package  HermsHome
 * @author   Don Nuwinda <nuwinda@gmail.com>
 * @license  GPL http://theicon.co.nz
 * @link     http://theicon.co.nz
 */
namespace HermsHome\Controller;

use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Authentication\Result as Result;
use Zend\Authentication\AuthenticationService;
use HermsHome\Form\FormLogin;
use HermsHome\Model\LoginValidation;
use HermsCore\Model\zbeMessage;
use HermsCore\Manager\ConfigurationManager;
use Interop\Container\ContainerInterface;
use HermsCore\Controller\FrontController;

/**
 * LoginController Class
 *
 * @category Controller
 * @package  HermsHome
 * @author   Don Nuwinda <nuwinda@gmail.com>
 * @license  GPL http://theicon.co.nz
 * @link     http://theicon.co.nz
 */
class LoginController extends FrontController
{
	/*
	* @var Zend\ServiceManager\ServiceLocatorInterface
	*/
	protected $services;
	
	/*
	* @var Interop\Container\ContainerInterface
	*/
	protected $container;
	
	protected $authService;
	
	protected $usermanager;
	
	/*
	* @var HermsCore\Manager\ConfigurationManager
	*/
	protected $configurationManager;
	
	public function __construct(
		ConfigurationManager $configurationManager,
		ContainerInterface $container
	) {
		$this->configurationManager = $configurationManager;
		$this->container = $container;
		$this->authService = new AuthenticationService();
		$this->usermanager = $this->container->get('UserManager');
	}
	
    /**
    * Process action
    *
    * @return object
    */
    public function processAction()
    {
        $request = $this->getRequest();
        $message = new zbeMessage();
		if ($request->isPost()){
            $loginForm = new FormLogin();
            $inputFilter = new LoginValidation();
            $loginForm->setInputFilter( $inputFilter->getInputFilter() );
            $loginForm->setData( $request->getPost() );
			
			if ($loginForm->isValid()){
             	$post = $request->getPost();
             	$configdata = $this->container->get('config');
             	$username = sprintf("%s", trim($post['userlogin']));
             	$p = $this->usermanager->getEncryptedPassword($username, $post['pw']);
				
				$adapter = $this->container->get('Zend\Db\Adapter\Adapter');
				$authadapter = new AuthAdapter($adapter);
				$authadapter->setTableName( "administrator" )
				->setIdentityColumn('admin_email')
				->setCredentialColumn('admin_password');
				
				$authadapter->setIdentity($username)->setCredential($p);
				$this->authService->setAdapter($authadapter);
				$result = $this->authService->authenticate();
				
				if ($result->isValid()) {
					return $this->redirect()->toRoute( 'dashboard' );
				} else {
                    switch ($result->getCode()) {
                        case Result::FAILURE_IDENTITY_NOT_FOUND:
                            $msg = 'Incorrect credentials';
                            break;
                
                        case Result::FAILURE_CREDENTIAL_INVALID:
                            $msg = 'Invalid credentials';
                            break;
                
                        case Result::SUCCESS:
                            $msg = 'SUCCESS';
                            break;
                        default:
                            $msg = 'Incorrect credentials';
                            break;
                    }
                    $message->setError( $msg );
                    $this->redirectAdminIndex();
                }
				$configdata = $this->container->get('HermsCore\Service\ConfigurationFactory');
            } else {
                $message->setError("faliure to validate.");
                $this->redirectAdminIndex();
            }
		} else {
			$this->redirectAdminIndex();
		}
		$layout = $this->layout();
		$layout->setTemplate('login/process/layout');
    }
	
	public function logoutAction(){
		$auth = new AuthenticationService();
		if($this->authService->hasIdentity()) {
			$this->authService->clearIdentity();
		}
		$this->redirectAdminIndex();
	}
	
	/**
	 * Reset Password action
	 *
	 * @return object
	 */
	public function resetpasswordAction()
	{
	    return true;
	}
	
    public function redirectAdminIndex(){
        return $this->redirect()->toRoute('home');
    }
}
