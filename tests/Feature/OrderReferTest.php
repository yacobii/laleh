<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderReferTest extends TestCase
{
    use RefreshDatabase;

    public function test_order_can_store_google_refer(): void
    {
        $user = User::factory()->create();

        $order = Order::create([
            'user_id' => $user->id,
            'coupon_id' => null,
            'total' => 1000,
            'total_with_coupon' => 1000,
            'refer' => 'google',
        ]);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'refer' => 'google',
        ]);
    }

    public function test_order_can_store_internal_refer(): void
    {
        $user = User::factory()->create();

        $order = Order::create([
            'user_id' => $user->id,
            'coupon_id' => null,
            'total' => 2000,
            'total_with_coupon' => 2000,
            'refer' => 'internal',
        ]);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'refer' => 'internal',
        ]);
    }
}
