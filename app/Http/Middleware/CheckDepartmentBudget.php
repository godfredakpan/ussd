<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\MonthlyBudget;
use App\Office;
use App\Http\Repositories\OfficeRepository;


class CheckDepartmentBudget
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        // Check if Department has budget starts
        $date = Carbon::now();
        // get present month
        $present_month = $date->format('F');
        // Get current user
        $auth = Auth::user();

        $budget_for_this_month = MonthlyBudget::where(
            'dept_id', $auth->department)
            ->where('month', $present_month)
            ->first();

            $budget_not_set = array(
            'message' => "Your department budget has not been set. Please contact admin",
            'alert-type' => 'info'
        );

         // If budget isnt set or empty redirect with an error message
         if (!$budget_for_this_month or $budget_for_this_month->amount ==  0 ) {
             return redirect()->route('dashboard')->with($budget_not_set);
         }else
            return $next($request);

         // Check if Department has budget ends

        //Office not Set

         $office_not_set = array(
            'message' => "There are currently no offices set. Please contact admin",
            'alert-type' => 'info'
        );

        $office_count = Office::count();

        if ($office_count > 0) {
            return redirect()->route('dashboard')->with( $office_not_set);
        }
        else
            return $next($request);
    }
}
