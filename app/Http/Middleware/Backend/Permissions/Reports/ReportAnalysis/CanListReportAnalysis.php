<?php


namespace App\Http\Middleware\Backend\Permissions\Reports\ReportAnalysis;


use App\Exceptions\Backend\Web\ForbiddenException;
use Closure;

class CanListReportAnalysis
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @throws ForbiddenException
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()->ability('sadmin','report_analysis-list')) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}