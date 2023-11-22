<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Models\User;
use App\Helpers\AuthHelper;
// use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Redirect;
use App\Models\Role;
use App\Models\Operator;
use App\Models\RoleUser;
use App\Models\RoleFinal;
use Carbon\Carbon;
use App\Models\OperateurAcces;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        $pageTitle = trans('global-message.list_form_title',['form' => trans('users.title')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table'];
        $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add User</a>';
        return $dataTable->render('global.datatable', compact('pageTitle','auth_user','assets', 'headerAction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('status',1)->get()->pluck('title', 'id');

        return view('users.form', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  

        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN'; 
           
         $request['password'] = bcrypt($request->password);

         $request['username'] = $request->username ?? stristr($request->email, "@", true) . rand(100,1000);
         ;
      
         $createD= date("Y-m-d H:i:s");
         $currentTimestamp = now()->timestamp;
        //  dd($currentTimestamp);        
        //  User::create(['username'=>$request['username'],'email'=>$request['email'],'status'=>10,'password_hash'=>$request['password'],'created_at'=> $currentTimestamp,'registration_ip'=>$ipaddress]);
        
         $user = new User();
            $user->username =$request['username'];
            $user->email = $request['email'];
            $user->password_hash = $request['password'];
            $user->status = 10;
            $user->registration_ip=$ipaddress;
            $user->created_at = $currentTimestamp;
            $user->updated_at = $currentTimestamp;
            $user->auth_key=null;
            $user->save();
            $user = DB::table('bailey_user')->latest('id')->first();

            $currentTimestamp = now()->timestamp;

            if ($request['role_user']==1 || $request['role_user']==3 || $request['role_user']==2) {
                $operator=new Operator();
                $operator->status_id=1;
                $operator->last_name=$request['prenom_op'];
                $operator->first_name=$request['nom_op'];
                $operator->phone=$request['phone_conseiller'];
                $operator->date_of_creation=date('Y-m-d');
                $operator->created_by=Auth()->user()->id;
                $operator->updated_by=NULL;
                $operator->created_at=NULL;
                $operator->updated_at=NULL;
                $operator->user_id=$user->id;
                $operator->save();
            }
            $roleF=RoleFinal::where('id',$request['role_user'])->get();
            $role=new Role();
            $role->item_name =$roleF[0]->nomRole;
            $role->user_id=$user->id;
            $role->created_at=NULL;
            $role->updated_at = NULL;
            $role->save();
            if ($request['role_user']==1 ||$request['role_user']==2 || $request['role_user']==4 ) {
                $role=new Role();
                $role->item_name ='conseiller';
                $role->user_id=$user->id;
                $role->created_at=NULL;
                $role->updated_at = NULL;
                $role->save();            
            }
            $roleuser = new RoleUser();
            $roleuser->user_id =$user->id;
            $roleuser->role_id = $request['role_user'];
            $roleuser->created_at = NULL;
            $roleuser->updated_at = NULL;
            $roleuser->save();
            $elementsSelectionnes = $request->input('affect', []);
            for ($i=0; $i <count($elementsSelectionnes)  ; $i++) {
                $operateurAcces=new OperateurAcces();
                $operateurAcces->user_id=$user->id;
                $operateurAcces->company_id=$elementsSelectionnes[$i];
                $operateurAcces->created_at = NULL;
                $operateurAcces->updated_at = NULL;
                $operateurAcces->save();
            }
         return Redirect::route('getUsers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idss
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::with('userProfile','roles')->findOrFail($id);

        $profileImage = getSingleMedia($data, 'profile_image');

        return view('users.profile', compact('data', 'profileImage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::with('userProfile','roles')->findOrFail($id);

        $data['user_type'] = $data->roles->pluck('id')[0] ?? null;

        $roles = Role::where('status',1)->get()->pluck('title', 'id');

        $profileImage = getSingleMedia($data, 'profile_image');

        return view('users.form', compact('data','id', 'roles', 'profileImage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $request['password'] = bcrypt($request->password);

 

        //     $currentTimestamp = now()->timestamp;

        //     $user= User::find($id);

        //     $user->username=$request['username'];

        //     $user->email=$request['email'];

        //     $user->password_hash=$request['password'];

        //     $user->updated_at= $currentTimestamp;

        //     $user->update();

        //      return Redirect::route('getUsers');
        $roles  = DB::table('bailey_role')
                                    ->join('bailey_role_user', 'bailey_role_user.role_id', '=', 'bailey_role.id')
                                    ->where('bailey_role_user.user_id', '=', $id)
                                    ->get();
            
        $item = $roles->first();
     
        // dd($request['role_user_update']);
        if ($item->role_id==$request['role_user_update'] ) {//non changement du role
             

            // $currentTimestamp = Carbon::now();
            $currentTimestamp = now()->timestamp;
            $user = User::find($id);
            $user->username = $request['username'];
            $user->email = $request['email'];
            $request['password'] = bcrypt($request->password);
            $user->password_hash = $request['password'];
            // $user->updated_at = $currentTimestamp;
            $user->update();
           
            // dd(  $request['password'],$user);

            // User::where('id', $id)->update(['username' => $request['username']]);
            
            $operator = Operator::where('user_id', $user->id)->first();
            $operator->last_name = $request['prenom_op_update'];
            $operator->first_name = $request['nom_op_update'];
            $operator->created_by = Auth()->user()->id;
            $operator->updated_by = Auth()->user()->id;
             $operator->user_id = $user->id;
			$operator->phone = $request['phone'];
            $operator->updated_by=Auth()->user()->id;
            $operator->created_at=$currentTimestamp;
            $operator->updated_at=$currentTimestamp;
            $operator->update();
            // $elementsSelectionnes2 = $request->input('affect2', []); 
            // for ($i=0; $i <count($elementsSelectionnes2)  ; $i++) { 
            //     $operateurAcces=new OperateurAcces();
            //     $operateurAcces->user_id=$id;
            //     $operateurAcces->company_id=$elementsSelectionnes2[$i];
            //     $operateurAcces->created_at = NULL;
            //     $operateurAcces->updated_at = NULL;
            //     $operateurAcces->save();
            // }
            return Redirect::route('getUsers');


            // return Redirect::route('getUsers');
        }
        else{       
                   
                if ($request['role_user_update']==3) { //changement au conseiller
                    // dd('conss');
                    $request['password'] = bcrypt($request->password);
                    $currentTimestamp = now()->timestamp;
                    $user= User::find($id);
                    $user->username=$request['username'];
                    $user->email=$request['email'];
                    $user->password_hash=$request['password'];
                    $user->updated_at= $currentTimestamp;
                    $user->update();
                   	$operator = Operator::where('user_id',$user->id)->first();
						
							if ($operator == null) {
								$carbonInstance = Carbon::now();
								$timestamp = $carbonInstance->timestamp;
								$operator = new Operator();
								$operator->last_name = $request['prenom_op_update'];
								$operator->first_name = $request['nom_op_update'];
								$operator->phone = $request['phone'];
								$operator->created_by = Auth()->user()->id;
								$operator->updated_by = Auth()->user()->id;
								$operator->user_id = $user->id;
								$operator->updated_by = Auth()->user()->id;
								$operator->created_at = $timestamp; // Use the `time()` function to get the current timestamp as an integer
								$operator->updated_at = $timestamp; // Use the `time()` function to get the current timestamp as an integer
								$operator->save();
							} else {
								$carbonInstance = Carbon::now();
								$timestamp = $carbonInstance->timestamp;
								$operator->last_name = $request['prenom_op_update'];
								$operator->first_name = $request['nom_op_update'];
								$operator->created_by = Auth()->user()->id;
								$operator->updated_by = Auth()->user()->id;
								$operator->user_id = $user->id;
								$operator->phone = $request['phone'];
								$operator->created_at = $timestamp; // Assign the current timestamp as an integer
								$operator->updated_at = $timestamp; // Assign the current timestamp as an integer
								$operator->save();
							}
                            
                       
                    OperateurAcces::where('user_id',$id)->delete();
                    Role::where('user_id',$id)->Delete();
                    $roleF=RoleFinal::where('id',$request['role_user_update'])->get();
                    // dd($roleF);
                    $role=new Role();
                    $role->item_name =$roleF[0]->nomRole;
                    $role->user_id=$user->id;
                    $role->created_at=NULL;
                    $role->updated_at = NULL;
                    $role->save();
                     RoleUser::where('user_id',$id)->delete();
                    $roleuser2 = new RoleUser();
                    $roleuser2->role_id=$request['role_user_update'];
                    $roleuser2->user_id =$id;
                    $roleuser2->created_at = NULL;
                    $roleuser2->updated_at = NULL;
                    $roleuser2->save();
                    $elementsSelectionnes2 = $request->input('affect2', []);
                    for ($i=0; $i <count($elementsSelectionnes2)  ; $i++) { 
                        $operateurAcces=new OperateurAcces();
                        $operateurAcces->user_id=$id;
                        $operateurAcces->company_id=$elementsSelectionnes2[$i];
                        $operateurAcces->created_at = NULL;
                        $operateurAcces->updated_at = NULL;
                        $operateurAcces->save();
                    }
                    return Redirect::route('getUsers');

                }else {//autre
                //    dd('different conss');
                        $request['password'] = bcrypt($request->password);
                        OperateurAcces::where('user_id',$id)->delete();
                        RoleUser::where('user_id',$id)->delete();


                        $currentTimestamp = now()->timestamp;
                       $user= User::find($id);
                       $user->username=$request['username'];
                       $user->email=$request['email'];
                       $user->password_hash=$request['password'];
                       $user->updated_at= $currentTimestamp;
                       $user->update();
					
                       if ($request['role_user_update']==1) {
						   	$operator = Operator::where('user_id',$user->id)->first();
						   if($operator==null){
							   	$operator = new Operator();
								$operator->last_name = $request['prenom_op_update'];
								$operator->first_name = $request['nom_op_update'];
							   	$operator->phone = $request['phone'];
								$operator->created_by = Auth()->user()->id;
								$operator->updated_by = Auth()->user()->id;
								$operator->user_id = $user->id;
								$operator->updated_by=Auth()->user()->id;
								$operator->created_at=null;
								$operator->updated_at=null;
								$operator->save();
						   }else{
						   		$operator->last_name = $request['prenom_op_update'];
								$operator->first_name = $request['nom_op_update'];
								$operator->created_by = Auth()->user()->id;
								$operator->updated_by = Auth()->user()->id;
								$operator->user_id = $user->id;
							   	$operator->phone = $request['phone'];
								$operator->updated_by=Auth()->user()->id;
								$operator->created_at=null;
								$operator->updated_at=null;
								$operator->update();
						   }
                            
                       }
                       Role::where('user_id',$id)->delete();
                       $roleF=RoleFinal::where('id',$request['role_user_update'])->get();
                        $role=new Role();
                       $role->item_name =$roleF[0]->nomRole;
                       $role->user_id=$user->id;
                       $role->created_at=NULL;
                       $role->updated_at = NULL;
                       $role->save();
                        //    if ($request['role_user_update']==1 ||$request['role_user_update']==2 || $request['role_user_update']==4 ) {
                                $role=new Role();
                                $role->item_name ='conseiller';
                                $role->user_id=$user->id;
                                $role->created_at=NULL;
                                $role->updated_at = NULL;
                                $role->save();            
                        // } 
                     
                   
                       OperateurAcces::where('user_id',$id)->delete();

                        // Operator::where('user_id',$id)->delete();
                        $roleuser2 = new RoleUser();
                        $roleuser2->role_id=$request['role_user_update'];
                        $roleuser2->user_id =$id;
                        $roleuser2->created_at = NULL;
                        $roleuser2->updated_at = NULL;
                        $roleuser2->save();
                        return Redirect::route('getUsers');



                }

                
                // return Redirect::route('getUsers');
        } 
       
      
        


        // OperateurAcces::where('user_id',$id)->delete();
        
        // $op_ac=OperateurAcces::where('user_id',$id)->get()->toArray();
        // dd($op_ac);
        // $elementsSelectionnes2 = $request->input('affect2', []);
            
           
            // $operateurAcces=new OperateurAcces();
            // $operateurAcces->user_id=$id;
            // $operateurAcces->company_id=$elementsSelectionnes2[$i];
            // $operateurAcces->created_at = NULL;
            // $operateurAcces->updated_at = NULL;
            // $operateurAcces->save();
        
        // dd($newarray);
        // return Redirect::route('getUsers');

        
             


        
        // $user = User::with('userProfile')->findOrFail($id);

        // $role = Role::find($request->user_role);
        // if(env('IS_DEMO')) {
        //     if($role->name === 'admin'&& $user->user_type === 'admin') {
        //         return redirect()->back()->with('error', 'Permission denied');
        //     }
        // }
        // $user->assignRole($role->name);

        // $request['password'] = $request->password != '' ? bcrypt($request->password) : $user->password;

        // // User user data...
        // $user->fill($request->all())->update();

        // // Save user image...
        // if (isset($request->profile_image) && $request->profile_image != null) {
        //     $user->clearMediaCollection('profile_image');
        //     $user->addMediaFromRequest('profile_image')->toMediaCollection('profile_image');
        // }

        // // user profile data....
        // $user->userProfile->fill($request->userProfile)->update();

        // if(auth()->check()){
        //     return redirect()->route('users.index')->withSuccess(__('message.msg_updated',['name' => __('message.user')]));
        // }
        // return redirect()->back()->withSuccess(__('message.msg_updated',['name' => 'My Profile']));

    }
    public function block($id)  {
        $currentTimestamp = now()->timestamp;
        $user = User::find($id);
        $user->is_blocked=1;
        $user->blocked_at=$currentTimestamp;
        $user->update();
        return Redirect::route('getUsers');



    }
    public function deblock(Request $request, $id)  {
        // $request->headers->set('X-CSRF-Token', csrf_token());

        $user = User::find($id);
        $user->is_blocked=null;
        $user->blocked_at=null;
        $user->update();
        return Redirect::route('getUsers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::where('user_id',$id)->forceDelete();
        RoleUser::where('user_id',$id)->forceDelete();
        OperateurAcces::where('user_id',$id)->delete();
        Operator::where('user_id',$id)->delete();
        User::where('id', $id)->forceDelete();
        return Redirect::route('getUsers');
        // $user = User::findOrFail($id);
        // $status = 'errors';
        // $message= __('global-message.delete_form', ['form' => __('users.title')]);

        // if($user!='') {
        //     $user->delete();
        //     $status = 'success';
        //     $message= __('global-message.delete_form', ['form' => __('users.title')]);
        // }

        // if(request()->ajax()) {
        //     return response()->json(['status' => true, 'message' => $message, 'datatable_reload' => 'dataTable_wrapper']);
        // }

        // return redirect()->back()->with($status,$message);

    }
    function getUsers(){
        $users=User::orderBy('created_at', 'desc')->get();
        $roles = DB::table('bailey_role')->get();
        $companys = DB::table('bailey_company')->get();

        // dd($roles);
        return view('users.list',compact('users','roles','companys'));
    }
    
    
}
