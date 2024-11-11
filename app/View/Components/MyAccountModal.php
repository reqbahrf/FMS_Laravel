<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class MyAccountModal extends Component
{

    public $username;
    public $userRole;
    public $email;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $user = Auth::user();
        $this->userRole = $user->role;
        $this->email = $user->email;

        if ($user->role == 'Staff' || $user->role == 'Admin') {
            $this->username = $user->orgUserInfo->prefix . ' ' . $user->orgUserInfo->f_name . ' ' .
                ($user->orgUserInfo->mid_name ? substr($user->orgUserInfo->mid_name, 0, 1) . '.' : '') .
                ' ' . $user->orgUserInfo->l_name . ' ' . $user->orgUserInfo->suffix;
        } else {
            $this->username = $user->coopUserInfo->f_name . ' ' .
                ($user->coopUserInfo->mid_name ? substr($user->coopUserInfo->mid_name, 0, 1) . '.' : '') .
                ' ' . $user->coopUserInfo->l_name;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.my-account-modal');
    }
}
