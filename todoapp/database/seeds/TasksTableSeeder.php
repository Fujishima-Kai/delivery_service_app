<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Task;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            'folder_id' => 1,
            'title' => "プログラミング",
            'detail' => "laravelにてストレージアプリ作成",
            'due_date' => Carbon::now()->addDay(),
            'status' => 1,
            'assigning_date' => Carbon::now(),
            'start_date' => null,
            'end_date' => null,
            'pending_time' => null,
            'work_time' => null,
            'assigner_id' => 1,
            'assigning_id' => 1,
        ]);
    }
}
