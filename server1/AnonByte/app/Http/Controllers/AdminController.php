<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
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
            'id' =>$id,
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

    public function saveUser(Request $request, $id)
    {
        // Recuperamos el usuario
        $user = User::find($id);
        // Definimos los campos que editamos
        $user->name = $request->input('name');
        $user->lastname = $request->input('lastname');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        // Guardamos los cambios
        $user->save();

        session()->flash('alert', ['message' => "User $user->name has been updated"]);
        return redirect()->route('admin.users.users-table');
    }

    // Funcion privada para filtrar segun nombre o email
    private function _filter($users)
    {
        // Paginamos y filtramos por o email
        $data = User::where('name', 'like', $users . '%')->orWhere('email', 'like', $users . '%')->paginate(3);
        $data->appends(['users' => $users]);
        return $data;
    }
}
