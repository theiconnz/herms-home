<?php
/**
 * Zend Backend (http://forge.co.nz/)
 *
 * IndexControllerFactory
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
use HermsHome\Controller\IndexController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


/**
 * IndexControllerFactory Class
 *
 * @category Factory
 * @package  HermsHome
 * @author   Don Nuwinda <nuwinda@gmail.com>
 * @license  GPL http://forge.co.nz
 * @link     http://forge.co.nz
 */
class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null)
    {
        return new IndexController($container);
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
		return $this($serviceLocator, 'HermsHome\Factory\IndexControllerFactory');
     }
}