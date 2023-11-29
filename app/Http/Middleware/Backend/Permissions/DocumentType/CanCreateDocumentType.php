<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 31.07.2019
 * Time: 18:30
 */

namespace App\Http\Middleware\Backend\Permissions\DocumentType;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanCreateDocumentType
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin', 'documentType-create')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}