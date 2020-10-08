<?php
namespace App\Console\Commands;
use App\User;
use DateTime;
use App\Message;
use Carbon\Carbon;
use App\Mail\Reminder;
use App\Models\Finance;
use App\Jobs\SendMailJob;
use Illuminate\Console\Command;


class RemindOffice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind:officehead';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email to remind for pending request';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = date('d-m-Y');

        $check_date = Finance::where('status', 1)->get();

        $count = Finance::where('status',1)->where('due_date' , $date)->count();

            foreach ($check_date as $checker) {
                $today = date('d-M-Y');
                $request_user = User::where('id', $checker["user_id"])->first();
                $user = User::where('office', $request_user["office"])->where('role_id', 1)->first();
                dispatch(
                new SendMailJob
                (
                    $user->email,
                    new Reminder
                (
                    $user, $checker, $count)
                ));

            }

    }

}
