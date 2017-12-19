<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Auth;
use Hash;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Input;
use Barryvdh\Debugbar\Facade as Debugbar;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';
    protected $redirectAfterLogout = '/';


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'password' => 'required|min:6|confirmed',
        ]);
    }


    protected function create(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'password' => 'required|min:6|confirmed',
        ]);
    }


    public function login(Request $request)
    {
        $identifiant = $request->name;
        $password= $request->password;

        $Inputs = Input::all();
        $Rules = [
            'name' => 'required|max:255',
            'password' => 'required|max:255',];
        $Messages = [
            'name.required' => 'Veuillez saisir votre identifiant',
            'password.required' => 'Veuillez saisir votre mot de passe',];
        $validator = Validator::make($Inputs, $Rules, $Messages);

        if ($validator->fails()) {
            return redirect('gestion/login')->withErrors($validator)
                ->withInput(Input::except('password'));

        } else {
            $user = User::where('name', '=', $identifiant)->first();

            if (empty($user)) {
                $validator->errors()->add('name', 'Utilisateur inconnu');
            }
            else {
                if (!Hash::check($password, $user->password))
                    $validator->errors()->add('mdp_utilisateur', 'Mot de passe incorrect');
            }

            if (count($validator->errors()) > 0)
                return redirect('gestion/login')->withErrors($validator)->withInput(Input::except('mdp_utilisateur'));


            //tout est OK
            Auth::loginUsingId($user->id, true);
            return redirect()->route('AdminIndex');
        }
    }


    public function register(Request $request)
    {
        $Inputs = Input::all();
        $Rules = [
            'name' => 'required|max:255',
            'password' => 'required|max:255',
            'password_confirmation' => 'required'];

        $messages = [
            'name.required' => 'Veuillez saisir un identifiant de connexion',
            'password.required' => 'Veuillez saisir votre mot de passe',
            'password_confirmation.required' => 'Veuillez saisir la confimation du mot de passe'];

        $validator = Validator::make($Inputs, $Rules,$messages);
        if ($validator->fails()) {
            return redirect('gestion/register')->withErrors($validator)->withInput(Input::except('password'));
        }
        else{
            if (Input::get('pass')!=Input::get('password_confirmation')){
                $validator->errors()->add('pass','Les mots de passes sont différents!');
            }

            //form OK
            //création du user prof
            $user = new User();
            $user->name = Input::get('name');
            $user->password = Hash::make(Input::get('password'));
            $user->save();
            return redirect()->route('NameLogin');
        }

    }
}
