<?php

namespace App\Http\Controllers;

use App\Classes\enums\RoleEnum;
use App\Role;
use App\Traits\auth\UserRegistrationHelper;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

//TODO: IMPLEMENT SINGLETON INJECTION FOR ORDER SERVICE
class UserController extends Controller
{

    protected $userService;

    use UserRegistrationHelper;

    public function __construct()
    {
        $this->middleware('administrator');
        $this->userService = app()->make('userService');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.crud-users.index')->with('request', $request)->with('users', User::all())->with('roles', $this->loadRolesToFill());
    }

    public function clients(Request $request)
    {
        $users = User::clients()->get();
        return view('admin.crud-users.clients', compact('users'))->with('request', $request)->with('roles', $this->loadRolesToFill());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.crud-users.create')->with('roles', $this->loadRolesToFill());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->getValidator($request->all())->validate();

        event(new Registered($user = User::create($this->getUserData($request->all()))));
        $user->roles()->attach(Role::where("id", $request['role'])->first());

        return back()->with('success', Lang::get('user.saved.message'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.crud-users.edit', compact('user', 'id'))->with('roles', $this->loadRolesToFill());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|exists:roles,id',
        ]);
        if ($request->password) {
            $this->validate(request(), [
                'password' => 'required|confirmed|min:6'
            ]);
            $user->password = bcrypt($request->get('password'));
        }
        $user->name = $request->get('name');
        $user->surname = $request->get('surname');
        $user->email = $request->get('email');
        $user->save();
        $user->roles()->sync([$request->input('role')]);
        return redirect('admin/users')->with('success', Lang::get('custom.information.updated.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('admin/users')->with('success', Lang::get('user.deleted.message'));
    }

    public function search(Request $request)
    {
        $users = $this->userService->search($request);
        return view('admin.crud-users.index')->with('request', $request)->with('users', $users)->with('roles', $this->loadRolesToFill());
    }

    public function searchClient(Request $request)
    {
        $users = User::clients()->findByEmail($request->get('email'))->get();
        return view('admin.crud-users.clients')->with('request', $request)->with('users', $users)->with('roles', $this->loadRolesToFill());
    }
}
