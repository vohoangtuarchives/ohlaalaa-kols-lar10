<?php

namespace App\Http\Controllers\Index\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('index.auth.auth-pass-reset-basic');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);


        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::broker("customers")->sendResetLink(
            $request->only('email')
        );

        if($status == Password::RESET_LINK_SENT){
            return back()->with('status', __('password.link-sent'));
        }

        return back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }
}
