<?php

namespace App\Http\Controllers;

use App\Models\Login_model;
use Illuminate\Http\Request;
use Hash;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use DB;


class Login_controller extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('name', 'email', 'password');
        if (Auth::attempt($credentials)) {
           return redirect('liste')->with('success', 'Your login was successful!');
        }else{
            //  echo ("tsy mety");
            $data['error_login'] = "Veuillez vérifier les champs";
             return view('index', compact('data'));
        }

    }
    public function action(Request $request)
    {
        $data = $request->all();

        $query = $data['query'];

        $filter_data = DB::select("SELECT * FROM users")
                        ->Where('email', 'LIKE', '%'.$query.'%')
                        ->orWhere('name', '=', '%'.$query.'%')
                        ->get();

        return response()->json($filter_data);
    }


  public function registration()
    {
        return view('inscription');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
          $categorie = DB::select("SELECT * FROM categorie");
        $liste_article = DB::table('v_article')
         ->orderBy('code_article', 'asc')
        ->paginate(5);
        $data = $request->all();
        $check = $this->create($data);
        return view('liste_article',compact('liste_article','categorie'))->with('success','Utilisateur ajouté');
    }

    public function create(array $data)
    {

        $consignataire = DB::select("SELECT * from v_login ");
      return Login_model::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }

    public function dashboard()
    {
        if(Auth::check()){
            return view('liste_par_categorie');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function signOut() {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}


?>
