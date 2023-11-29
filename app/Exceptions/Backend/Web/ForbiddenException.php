<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 17.09.2018
 * Time: 10:40
 */

namespace App\Exceptions\Backend\Web;


class ForbiddenException extends \Exception
{
    public function render()
    {
        return redirect(route('admin.errors.index'));

//        return response()->view('backend.errors.403', [], 403);
    }
}