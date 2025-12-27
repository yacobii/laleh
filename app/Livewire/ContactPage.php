<?php

namespace App\Livewire;

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;

class ContactPage extends Component
{

    use UsesSpamProtection;


    public HoneypotData $extraFields;

    public function mount()
    {
        $this->extraFields = new HoneypotData();
    }


    public function rules()
    {
        return [
            'mobile' => 'required|ir_mobile',
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'mobile.required' => 'موبایل؟',
            'mobile.ir_mobile' => 'موبایل اشتباه است',
            'name.required' => 'نام؟',
            'email.required' => 'ایمیل؟',
            'email.email' => 'ایمیل؟',
            'message.required' => 'پیام؟',
        ];
    }

    public $name;
    public $mobile;
    public $email;
    public $message;

    public function send()
    {
        $this->validate();
        $this->protectAgainstSpam(); // if is spam, will abort the request

        $data = [
            'name' => $this->name,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'message' => $this->message,
        ];
        Mail::to('#')->send(new ContactMail($data));
        session()->flash('success', 'پیام شما با موفقیت ارسال شد در اسرع وقت پاسخگو خواهیم بود.');

        $this->reset('mobile', 'name', 'email', 'message');
    }

    public function render()
    {
        return view('livewire.contact-page');
    }
}
