<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OngoingQuarterlyReport;
use Carbon\Carbon;

class CloseQuarterlyReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reports:close';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically close quarterly reports when the open_until date is reached';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentDate = Carbon::now()->toDateString();

        OngoingQuarterlyReport::where('open_until', '<=', $currentDate)
        ->where('report_status', 'open')
        ->update(['report_status' => 'closed']);

        $this->info('Expired Quarterly reports closed successfully');
    }
}
