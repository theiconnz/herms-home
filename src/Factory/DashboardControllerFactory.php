<?php
/**
 * Zend Backend (http://forge.co.nz/)
 *
 * DashboardControllerFactory
 *
 * PHP version 5
 *
 * @category Module
 * @package  HermsHome
 * @author   Don Nuwinda <nuwinda@gmail.com>
 * @license  GPL http://forge.co.nz
 * @link     http://forge.co.nz
 */
namespace HermsHome\Factory;

use Interop\Container\ContainerInterface;
use HermsHome\Controller\DashboardController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


/**
 * DashboardControllerFactory Class
 *
 * @category Factory
 * @package  HermsHome
 * @author   Don Nuwinda <nuwinda@gmail.com>
 * @license  GPL http://forge.co.nz
 * @link     http://forge.co.nz
 */
class DashboardControllerFactory implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null)
    {
        return new DashboardController($container);
    }
	
	/**
	* Create service
	*
	* @param ServiceLocatorInterface $serviceLocator
	*
	* @return mixed
	*/
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		return $this($serviceLocator, 'HermsHome\Factory\DashboardControllerFactory');
     }
}