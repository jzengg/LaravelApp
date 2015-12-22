<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $user = $this->create($request->all());

        $previous_session = $user->session_id;

        if ($previous_session) {
            \Session::getHandler()->destroy($previous_session);
            Auth::setUser($user);
            Auth::logout();
        }

        Auth::login($user, $request->has('remember'));

        $user->session_id = \Session::getId();
        $user->save();

        return redirect($this->redirectPath());
    }
}
