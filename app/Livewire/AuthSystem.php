<?php

namespace App\Livewire;

use App\Klass\CartInterface;
use App\Models\User;
use App\Services\SmsService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Random\RandomException;

class AuthSystem extends Component
{


    public $mobile;

    public $msg = '';


    public $email;


    public $melli;


    public $city;

    public $ostan;


    public $verificationCode = null;


    public $postal;

    public $address;

    public $name;

    public $errMsg;

    public $registeration = false;

    public $showMobile = true;

    public $showSMS = false;

    public $kod = null;

    public $sms;

    public function rules()
    {
        return [
            'mobile' => 'required|ir_mobile',
            'sms' => 'required|min:1|max:4',
        ];
    }

    public function messages()
    {
        return [
            'mobile.required' => 'موبایل؟',
            'mobile.ir_mobile' => 'موبایل اشتباه است',
            'sms.required' => 'کد ؟',
        ];
    }


    /**
     * @throws RandomException
     * @throws ConnectionException
     */
    public function checkMobile()
    {

        $this->validateOnly('mobile');
        $result = SmsService::sendVerificationCode($this->mobile);

        if ($result['success']) {
            $this->verificationCode = $result['code'];
            $this->showMobile = false;
            $this->showSMS = true;
        }
    }

    public function changeNumber()
    {
        $this->showMobile = true;
        $this->verificationCode = null;
        $this->reset('mobile', 'kod');
    }

    public function checkCode(CartInterface $cart)
    {
        $this->validateOnly('sms');

        if (strlen($this->sms) == 4) {
            $result = SmsService::verifyCode($this->mobile, $this->verificationCode, $this->sms);

            if (!$result['success']) {
                $this->errMsg = $result['message'];
                return false;
            }

            if ($result['isNewUser']) {
                $this->showSMS = false;
                $this->registeration = true;
            } else {
                return redirect()->intended();
            }

        }

        return $this->errMsg = null;

    }

    public function create_user()
    {
        $this->validate([
            'name' => 'required',
            'address' => 'nullable',
            'postal' => 'nullable|ir_postal_code',
            'city' => 'nullable',
            'melli' => 'nullable|ir_national_id',
            'email' => 'nullable|email|unique:users,email',
        ], [
            'name.required' => "نام و نام خانوادگی؟",
            'city.required' => "شهر؟",
            'ostan.required' => "استان؟",
            'name.address' => "آدرس پستی؟",
            'postal.address' => "کدپستی؟",
            'postal.ir_postal_code' => "کدپستی صحیح؟",
            'email.email' => "ایمیل صحیح",
            'email.unique' => "ایمیل قبلا ثبت شده",
            'melli.ir_national_id' => "کدملی صحیح نیست",
        ]);

        $user = User::create([
            'name' => $this->name,
            'address' => $this->address ?? 'آدرس کامل ثبت شود',
            'postal' => $this->postal ?? 'کدپستی نوشته شود',
            'city' => $this->city ?? 'نام شهر',
            'ostan' => $this->ostan ?? 'نام استان',
            'mobile' => $this->mobile,
            'email' => $this->email ?? fake()->email,
            'melli' => $this->melli ?? 'کد ملی نوشته شود',
            'password' => Hash::make('12345678'),
        ]);
        Auth::login($user, true);
        $user->givePermissionTo('admin');
        $this->redirectIntended(route('home'));
    }

    #[Layout('components.layouts.guest')]
    public function render()
    {
        return view('livewire.auth-system');
    }
}
