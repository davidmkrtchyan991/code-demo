<?php

namespace App\Http\Controllers;

use App\Classes\enums\RoleEnum;
use App\Role;
use App\User;
use App\Utils\AppUtils;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use  Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
//        $this->middleware('auth', ['only' => ['create', 'register']]);
        $this->middleware('checkRole:' . RoleEnum::ROLE_TECHNICAL_MANAGER . ',' . RoleEnum::ROLE_CLIENT. ',' . RoleEnum::ROLE_OPTIMIZER, ['only' => ['edit', 'update']]);
    }

    public function edit($id)
    {
        $loggedUser = AppUtils::getUser();
        $user = User::find($id);
        if ($loggedUser->id == $user->id) {
            return view('profile.edit', compact('user', 'id'));
        } else {
            $this->guard()->logout();
            redirect('HomeController@index');
        }
    }

    public function update(Request $request, $id)
    {
        $loggedUser = AppUtils::getUser();
        $user = User::find($id);

        if ($loggedUser->id == $user->id) {
            $this->validate(request(), [
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
            ]);
            if ($request->password) {
                $this->validate(request(), [
                    'password' => 'required|confirmed|min:6'
                ]);
                $user->password = bcrypt($request->get('password'));
            }
            $user->name = $request->get('name');
            $user->surname = $request->get('surname');
            $user->save();
            return view('profile.show', compact('user', 'id'))->with('success', Lang::get('custom.information.updated.success'));
        } else {
            $this->guard()->logout();
            redirect('HomeController@index');
        }
    }

    public function create()
    {
        return view('profile.create');
    }

    public function register(Request $request)
    {
        $this->getRegistrationValidator($request->all())->validate();

        $user = $this->createUser($request->all());
        $user->roles()->attach(Role::where("name", RoleEnum::ROLE_CLIENT)->first());

        event(new Registered($user));

        $this->guard()->login($user);

        return redirect($this->redirectPath());
    }

    private function getRegistrationValidator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    private function createUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
