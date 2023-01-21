<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function viewForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        // Recuperamos las credenciales
        $input = $request->only('email', 'password');
        if (Auth::attempt($input) && (Auth::user()->role_id == 2 || Auth::user()->role_id == 3)) {
            // Verificamos si el usuario esta verificado
            if (Auth::user()->email_verified_at == null) {
                return abort(403);
            }

            return redirect()->route('admin.users.users-table');
        } else {
            // Si las credencailes son invalidas devolvemos un mensaje de error
            return redirect()->back()->withErrors(['password' => 'La contraseña es incorrecta']);
        }
    }

    public function viewTable(Request $request)
    {
        // Recuperamos los usuarios, y si se ha filtrado por nombre enseñarlos filtrados
        $name = $request->input('name');
        // Llamamos a la funcion privada para filtrar
        $users = $this->_filter($name);

        return view('admin.home', [
            'users' => $users,
        ]);
    }

    public function createUser()
    {
        return view('admin.home');
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
        // Lo borramos
        $user->delete();
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

        return redirect()->route('admin.users.users-table');
    }

    // Funcion privada para filtrar segun nombre
    private function _filter($name)
    {
        // Paginamos y filtramos por nombre
        $data = User::where('name', 'like', $name . '%')->paginate(10);
        return $data;
    }
}
