<?php

class RemindersController extends Controller {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		return View::make('password.remind');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
		switch ($response = Password::remind(Input::only('email')))
		{
			case Password::INVALID_USER:
				return Redirect::to('/password')->with('error', Lang::get($response));

			case Password::REMINDER_SENT:
				return Redirect::to('/password')->with('status', 'Your password reset link was sent successfully!');
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) App::abort(404);

		return View::make('password.reset')->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
				return Redirect::back()->with('passwordError', 'Passwords must be at least 6 characters and match the verify password field.')->with('email', $credentials['email']);
			case Password::INVALID_USER:
				return Redirect::back()->with('userError', Lang::get($response))->with('email', $credentials['email']);
			case Password::INVALID_TOKEN:
				return Redirect::back()->with('error', Lang::get($response))->with('email', $credentials['email']);

			case Password::PASSWORD_RESET:
				$user = DB::select('select * from users where email = ?', array($credentials['email']));
				$user = $user[0];
				DB::insert('insert into lastModified (uid, tablename, rowid, columnname) values (?, ?, ?, ?)', array($user->uid, "users", $user->id, "password"));
				return Redirect::to('/login')->with('passwordChange', 'Your password has been successfully changed!')->with('username', $user->uid);
		}
		
	}

}