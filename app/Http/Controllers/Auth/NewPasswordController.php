<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
<<<<<<< HEAD
use Illuminate\Http\JsonResponse;
=======
use Illuminate\Http\RedirectResponse;
>>>>>>> df2b649759f8f10d745d8689907434d916ad7f10
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
<<<<<<< HEAD
use Illuminate\Validation\ValidationException;
=======
use Illuminate\View\View;
>>>>>>> df2b649759f8f10d745d8689907434d916ad7f10

class NewPasswordController extends Controller
{
    /**
<<<<<<< HEAD
=======
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
>>>>>>> df2b649759f8f10d745d8689907434d916ad7f10
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
<<<<<<< HEAD
    public function store(Request $request): JsonResponse
=======
    public function store(Request $request): RedirectResponse
>>>>>>> df2b649759f8f10d745d8689907434d916ad7f10
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
<<<<<<< HEAD
                    'password' => Hash::make($request->string('password')),
=======
                    'password' => Hash::make($request->password),
>>>>>>> df2b649759f8f10d745d8689907434d916ad7f10
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

<<<<<<< HEAD
        if ($status != Password::PASSWORD_RESET) {
            throw ValidationException::withMessages([
                'email' => [__($status)],
            ]);
        }

        return response()->json(['status' => __($status)]);
=======
        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
>>>>>>> df2b649759f8f10d745d8689907434d916ad7f10
    }
}
