<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 31.07.2019
 * Time: 18:29
 */

namespace App\Http\Middleware\Backend\Permissions\DocumentType;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListDocumentType
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'documentType-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}