<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Storage;
use Auth;
use Alert;
use Validator;
//use App\Helpers\Animate;

use App\User;

class ManageuserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
       if (Auth::user()->userType !== 'ADMINISTRATOR') {

        Alert::error('El usuario no esta autorizado para ingresar a este modulo');
        return redirect()->route('home');
       }


        
       $users = User::where('username','!=','admin')->orderBy('id', 'DESC')->paginate(10);

       return view('admin.manageusers.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.manageusers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        
       /* if ($request->input('name') == ''  || $request->input('username') == '' || $request->input('email') == '') 
        {
            //Alert::error('Faltas datos para dar de alta el Usuario');
            return back()->with('danger', 'Complete todos los datos del usuario')->withInput();
        }


        if (User::where('username', $request->input('username'))->first()) 
        {
            return back()->with('danger', 'Este username ya esta en uso')->withInput();
        }

        if (User::where('email', $request->input('email'))->first()) 
        {
            return back()->with('danger', 'Este email ya esta en uso')->withInput();
        }
    */


        $user = User::create($request->all());


        $user->password = bcrypt('123456');
        $user->save();

        Alert::success('Contraseña inicial: 123456', 'Usuario creado con exito')->persistent("Cerrar");
        return redirect()->route('manageusers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        $image  = Animate::image();  

        return view('admin.manageusers.show', compact('user', 'image'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);


        return view('admin.manageusers.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function update(UserUpdateRequest $request, $id)
    public function update(Request $request, $id)
    {
        
        if ($request->input('name') == ''  || $request->input('username') == '' || $request->input('email') == '') 
        {
            //Alert::error('Faltas datos para dar de alta el Usuario');
            return back()->with('danger', 'Complete todos los datos del usuario')->withInput();
        }


        if (User::where('username', $request->input('username'))->where('id', '!=', $id)->first()) 
        {
            return back()->with('danger', 'Este username ya esta en uso')->withInput();
        }

        if (User::where('email', $request->input('email'))->where('id', '!=',  $id)->first()) 
        {
            return back()->with('danger', 'Este email ya esta en uso')->withInput();
        }
    

        $user = User::find($id);

        $user->fill($request->all())->save();

        if($request->input('resetpass') == 'on') $user->fill(['password' => bcrypt('123456')])->save();
        

        if($request->input('resetpass') == 'on')
        {
            Alert::success('La contraseña reseteada es: 123456','Usuario actualizado con exito')->persistent("Cerrar");
        }else {
            Alert::success('Usuario actualizado con exito')->persistent('Cerrar');
        }    
        
        return redirect()->route('manageusers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        

        User::find($id)->delete();

        Alert::success('Eliminado correctamente')->persistent('Cerrar');
        return back();
    }


    public function showSetting($id)
    {

        $user = User::find($id);

        $image  = Animate::image(); 

        //return $user;
        return view('admin.manageusers.setting', compact('user', 'image'));
    }


    public function setting(Request $request, $id)
    {

        if ($request->input('password') !== $request->input('password2')){
            return back()->with('danger', 'Las contraseñas deben coincidir')->withInput();
        }

        

        if($request->file('image')){

            $input  = array('image' => $request->file('image'));

            $rules = array('image' => 'mimes:jpg,jpeg,png');

            $validator = Validator::make($input,  $rules);

            if ($validator->fails())
            {
                return back()->with('danger', 'La imagen no posee un formato valido')->withInput();
            }
        } 


        // contraseña
        $user = User::find($id);

        if ($request->input('password2')){
            $user->fill(['password' => bcrypt($request->input('password2'))])->save();
        }  

         //IMAGE 
        if($request->file('image')){
            $path = Storage::disk('public')->put('image',  $request->file('image'));
            //$user->fill(['file' => asset($path)])->save();
            $user->fill(['file' =>  $path])->save();
        }

        $image  = Animate::image(); 

        Alert::success('Usuario actualizado con exito')->persistent('Cerrar');
        return view('admin.manageusers.setting', compact('user', 'image'));

    }
}
