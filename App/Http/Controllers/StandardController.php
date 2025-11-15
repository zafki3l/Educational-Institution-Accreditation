<?php 

namespace App\Http\Controllers;

use App\Database\Models\User;
use App\Http\Requests\StandardRequest;
use App\Services\Interfaces\StandardServiceInterface;
use Core\Controller;
use Traits\HttpResponseTrait;

class StandardController extends Controller
{
    use HttpResponseTrait;
    public function __construct(private StandardServiceInterface $standardService,
                                private StandardRequest $standardRequest) {}
    public function index()
    {
        $standards = $this->standardService->listStandards();

        $role = $_SESSION['user']['role_id'];
        $redirect_to = User::isAdmin($role) ? 'admin' : 'staff';
        return $this->view(
            (string) $redirect_to . '/standards/index', 
            (string) $redirect_to .'.layouts', 
            [
                'title' => User::isAdmin($role) ? 'Cập nhật tiêu chuẩn' : 'Danh sách tiêu chuẩn',
                'standards' => $standards
            ]
        );
    }

    public function store(): void
    {
        $request = $this->standardRequest->createRequest();

        $this->standardService->createStandard($request);

        $this->redirect('/admin/standards');
    }

    public function destroy(string $id): void
    {
        $this->standardService->deleteStandard($id);

        $this->redirect('/admin/standards');
    }
}