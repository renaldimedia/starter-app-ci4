<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseAdminController extends Controller
{
    public $baseadminthemepath;
    public $settings;
    public $data;
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        $this->data['theme_path'] = base_url('xmsth/assets');
        $this->data['menus'] = $this->buildmenu();
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }

    private function buildmenu($data = null)
    {
        return [
            array(
                'group_display_name' => 'Main Navigation',
                'group_menus' =>  [
                    array(
                        'id' => '',
                        'class' => '',
                        'icon_class' => 'icon icon-account_box light-green-text s-18',
                        'url' => '#',
                        'display_name' => 'Users',
                        'submenu' => [
                            array(
                                'id' => '',
                                'class' => '',
                                'icon_class' => 'icon icon-circle-o',
                                'url' => base_url('admin/users'),
                                'display_name' => 'Daftar User'
                            ),
                            array(
                                'id' => '',
                                'class' => '',
                                'icon_class' => 'icon icon-add',
                                'url' => base_url('admin/users/add'),
                                'display_name' => 'Tambah User'
                            )
                        ]
                    )
                ]
            )
           
        ];
    }
}
