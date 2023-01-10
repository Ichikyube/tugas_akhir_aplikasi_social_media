<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class TwoFactorAuthentication extends Component
{
        /**
     * @var
     */
    public $code;

    /**
     * @param  Request  $request
     *
     * @return mixed
     */
    public function validateCode()
    {
        $this->validate([
            'code' => 'required|min:6',
        ]);

        if ($this->user()->confirmTwoFactorAuth($this->code)) {
            $this->resetErrorBag();

            session()->flash('flash_success', __('Two Factor Authentication Successfully Enabled'));

            return redirect()->route('frontend.auth.account.2fa.show');
        }

        $this->addError('code', __('Your authorization code was invalid. Please try again.'));

        return false;
    }

    public function render()
    {
        return view('livewire.auth.two-factor-authentication');
    }
}
