<?php

namespace App\Http\Controllers\AdminUser;

use App\Application\AdminUser\SearchAdminUserUseCase;
use App\Domains\AdminUser\EmailAddress;
use App\Domains\AdminUser\SearchAdminUserCriteria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

final class AdminUserIndexController extends Controller
{
    public function __construct(
        private SearchAdminUserUseCase $useCase
    ) {}

    public function __invoke(Request $request)
    {
        $criteria = new SearchAdminUserCriteria(
            $request->input('name'),
            $request->input('email')
                ? new EmailAddress(($request->input('email')))
                : null,
            null,
            null,
        );

        $adminUsers = $this->useCase->handle($criteria);

        return view('admin.users.index',[
            'adminUsers' => $adminUsers,
        ]);
    }
}