<?php

namespace Core;

use App\Business\Modules\RoleBasedAccess\ShowAdminDashboard;
use App\Business\Modules\RoleBasedAccess\ShowHomepage;
use App\Business\Modules\RoleBasedAccess\ShowStaffDashboard;

/**
 * Class Controller
 * 
 * BaseController provides helper methods for All Controller classes
 */
abstract class Controller
{
    /**
     * Render a specified view 
     * @param string $view
     * @param array $data
     * @return mixed
     */
    private function render(string $view, array $data = []): mixed
    {
        extract($data);
        return require VIEW_PATH . $view . '.php';
    }

    /**
     * Render a view with a layout
     * 
     * @param string $view
     * @param string $layout_view
     * @param string $title
     * @param array $data
     * @return mixed
     */
    protected function view(string $view, string $layout, array $data = []): mixed
    {
        ob_start();
        $this->render($view, $data);

        $isAuth = isset($_SESSION['user']);

        $view_data = [
            'isAuth' => $isAuth,
            'permission' => $this->checkPermission($_SESSION['user']['role_id'] ?? null),
            'title' => $data['title'] ?? 'Document',
            'content' => ob_get_clean(),
        ];

        return $this->render('layouts/main-layouts/' . $layout, $view_data);
    }

    private function checkPermission(?int $role_id)
    {
        return [
            'canShowHomepage' => ShowHomepage::can($role_id),
            'canShowAdminDashboard' => ShowAdminDashboard::can($role_id),
            'canShowStaffDashboard' => ShowStaffDashboard::can($role_id)
        ];
    }
}
