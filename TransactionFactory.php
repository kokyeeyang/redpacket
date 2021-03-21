<?php

namespace Database\Factories;
use App\Models\RedPacket;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;
    
    public function definition()
    {
        // 'user_id' => User::all()->random()->id,
        return [
            'red_packet_id' => RedPacket::all()->random()->id,
            'sender_id' => User::all()->random()->id,
            'receiver_id' => User::all()->random()->id,
            'sent_date' => now()
        ];
    }
    
}
