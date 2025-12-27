<?php

namespace App\Livewire;

use App\Klass\CartInterface;
use App\Models\Color;
use App\Models\Coupon;
use App\Models\Item;
use App\Models\Order;
use App\Models\Size;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Kart extends Component
{


    #[Validate('nullable')]
    public $code;
    public $coupon;

    public $discount_percent;

    public $coupon_message = null;

    public function getCartProperty(CartInterface $cart)
    {
        return $cart;
    }

    #[Computed]
    public function discountedTotal()
    {
        $total = $this->cart->total();
        $discount = ($total * $this->discount_percent) / 100;

        return $total - $discount;
    }

    #[Computed]
    public function total_order()
    {
        return $this->cart->total();
    }

    public function add_coupon()
    {
        $this->coupon_message = "";
        $coupon = Coupon::query()->where('code', $this->code)->first();
        $this->coupon = $coupon;
        if ($coupon) {
            $this->discount_percent = $coupon->percentage;
        } else {
            $this->coupon_message = "کوپن تخفیف معتبر نیست";
        }


    }




    public function add_order(CartInterface $cart): null
    {
        $referHeader = request()->headers->get('referer');
        $refer = null;

        if (empty($referHeader)) {
            $refer = 'internal';
        } else {
            try {
                $host = parse_url($referHeader, PHP_URL_HOST);
                if ($host && str_contains($host, 'google')) {
                    $refer = 'google';
                } else {
                    // If referer host matches this app host, consider internal
                    $appHost = request()->getHost();
                    if ($host === $appHost) {
                        $refer = 'internal';
                    } else {
                        $refer = 'external';
                    }
                }
            } catch (\Throwable $e) {
                $refer = 'external';
            }
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'coupon_id' => $this->coupon->id ?? null,
            'total' => $this->total_order(),
            'total_with_coupon' => $this->discountedTotal(),
            'refer' => $refer,
        ]);

        foreach ($cart->contents() as $item) {
            $itemSubtotal = $item->product->price * $item->qty;
            $itemTotal = $itemSubtotal;

            if ($this->coupon) {
                $discount = ($itemSubtotal * $this->coupon->percentage) / 100;
                $itemTotal = $itemSubtotal - $discount;
            }

            Item::create([
                'order_id' => $order->id,
                'product_id' => $item->product->id,
                'price' => $item->product->price,
                'qty' => $item->qty,
                'total' => $itemTotal,
                'color' => Color::findorFail($item->data['color'])?->title ?? 'تک رنگ',
                'size' => Size::findorFail($item->data['size'])?->title ?? 'تک سایز',
            ]);
        }

        return $this->redirect(route('checkout', $order));
    }


    public function render()
    {
        return view('livewire.kart');
    }
}
