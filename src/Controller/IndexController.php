<?php
/**
 * Herms Home (https://theicon.co.nz/)
 *
 * IndexController
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

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Authentication\Result as Result;
use HermsHome\Form\FormLogin;
use Zend\view\Model\ViewModel;
use HermsHome\Model\LoginValidation;
use HermsCore\Model\zbeMessage;
use Interop\Container\ContainerInterface;

/**
 * Index Controller Class
 *
 * @category Controller
 * @package  HermsHome
 * @author   Don Nuwinda <nuwinda@gmail.com>
 * @license  GPL http://theicon.co.nz
 * @link     http://theicon.co.nz
 */
class IndexController extends AbstractActionController
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
	/*
	* @var HermsCore\Manager\ConfigurationManager
	*/
	protected $configurationManager;
	
	public function __construct(
		ContainerInterface $container
	) {
		$this->container = $container;
		$this->authService = new AuthenticationService();
	}
	
    /**
    * Index action
    *
    * @return object
    */
    public function indexAction()
    {
        if( $this->authService->hasIdentity() ){
            return $this->redirect()->toRoute( 'dashboard' );
        }
        $form = new FormLogin();
        return array('form' => $form );
    }
}
