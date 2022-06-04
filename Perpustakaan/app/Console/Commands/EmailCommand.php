<?php

namespace App\Console\Commands;

use App\Mail\RemainderEmailDigest;
use Illuminate\Console\Command;
use App\Models\Borrow;
use SebastianBergmann\CodeUnit\FunctionUnit;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
class EmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email mengingatkan pengembalian buku';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $borrows=Borrow::where('tanggal_kembali',now()->format('Y-m-d'))
        ->orderBy('user_id')
        ->get();
        $data =[];
        foreach($borrows as $borrow){
            $data[$borrow->user_id][] = $borrow;
        }
         foreach ($data as $userId=>$borrows){
             $this->sendEmailToUser($userId,$borrows);
         }
    }
    private function sendEmailToUser($userId, $reminders){
        $user = User::find($userId);
        Mail::to($user)->send(new RemainderEmailDigest($reminders));
    }
}
    