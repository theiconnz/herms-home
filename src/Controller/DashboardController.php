<?php
/**
 * Herms Home (https://theicon.co.nz/)
 *
 * DashboardController
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

use Zend\Authentication\AuthenticationService;
use Interop\Container\ContainerInterface;

/**
 * DashboardController Class
 *
 * @category Controller
 * @package  HermsHome
 * @author   Don Nuwinda <nuwinda@gmail.com>
 * @license  GPL http://theicon.co.nz
 * @link     http://theicon.co.nz
 */
class DashboardController extends AdminController
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
		parent::__construct($this->container);
	}
	
    /**
    * Process action
    *
    * @return object
    */
    public function indexAction()
    {
		$this->getAdminHeader();
		$this->getAdminSidebarmenu();
//		$this->getAdminFooter();
		$layout = $this->layout();
		$layout->setTemplate('dashboard/index/layout');
    }

}
