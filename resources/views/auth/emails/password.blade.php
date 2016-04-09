{{ trans('auth.go_to_password_reset') }}:<br/> <a href="{{ $link = URL::action('Auth\PasswordController@getReset',$token) }}"> {{ $link }} </a>
