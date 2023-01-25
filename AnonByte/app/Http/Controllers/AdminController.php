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
            return redirect()->back()->withErrors(['credentials' => 'Las credenciales son incorrectas']);
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
        // Lo borramos
        $user->delete();
        return redirect()->route('admin.users.users-table')->with('message', 'Usuario eliminado correctamte');
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

        return redirect()->route('admin.users.users-table')->with('message', 'Usuario modificado correctamente');
    }

    // Funcion privada para filtrar segun nombre
    private function _filter($users)
    {
        // Paginamos y filtramos por o email
        $data = User::where('name', 'like', $users . '%')->orWhere('email', 'like', $users . '%')->paginate(12);
        $data->appends(['users' => $users]);
        return $data;
    }
}
