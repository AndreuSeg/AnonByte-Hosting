<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class AdminController extends Controller
{
    // Funcion para mostrar la respuesta 404 en vez de el 405
    public function show404()
    {
        return abort(404);
    }

    public function viewForm()
    {
        return view('admin.login');
    }

    public function login(LoginUserRequest $request)
    {
        $request->validated();

        // Recuperamos las credenciales
        $input = $request->only('email', 'password');
        if (Auth::attempt($input) && (Auth::user()->role_id == 2 || Auth::user()->role_id == 3)) {
            // Verificamos si el usuario esta verificado
            if (Auth::user()->email_verified_at == null) {
                return abort(403);
            }

            return redirect()->route('admin.users.users-table');
        } else {
            session()->flash('error', ['message' => "Credenciales Incorrectas"]);
            return redirect()->back();
        }
    }

    public function viewTable(Request $request)
    {
        // Recuperamos los usuarios, y si se ha filtrado por nombre enseñarlos filtrados
        $users = $request->input('users');
        // Llamamos a la funcion privada para filtrar
        $users = $this->_filter($users);

        return view('admin.home', [
            'users' => $users,
        ]);
    }

    public function editUser($id)
    {
        // Recuperamos el usuario que queremos editar
        $user = User::find($id);

        return view('admin.form', [
            'id' => $id,
            'user' => $user,
        ]);
    }

    public function deleteUser($id)
    {
        // Recuperamos el usuario a eliminar
        $user = User::where('id', $id)->firstOrFail();
        $user->delete();

        session()->flash('alert', ['message' => "User $user->name has been deleted"]);
        return redirect()->route('admin.users.users-table');
    }

    public function saveUser(EditUserRequest $request, $id)
    {
        // Recuperamos los datos pasados por el formulario, y los validamos.
        $request->validated();

        // Recuperamos el usuario
        $user = User::find($id);

        // Definimos los campos que editamos
        $user->name = $request->input('name');
        $user->lastname = $request->input('lastname');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->role_id = $request->input('role_id');
        $user->stack_created = $request->input('stack_created');
        // Guardamos los cambios
        $user->save();

        session()->flash('alert', ['message' => "User $user->name has been updated"]);
        return redirect()->route('admin.users.users-table');
    }

    // Funcion privada para filtrar segun nombre o email
    private function _filter($users)
    {
        // Paginamos y filtramos por o email
        $data = User::where('name', 'like', $users . '%')->orWhere('email', 'like', $users . '%')->paginate(8);
        $data->appends(['users' => $users]);
        return $data;
    }
}
