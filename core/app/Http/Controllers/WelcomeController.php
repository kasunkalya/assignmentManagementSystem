<?php namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Sammy\Assignment\Models\Assignment;

use Sammy\Permissions\Models\Permission;
use Sentinel;
use Response;
class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Sentinel::getUser();
		$hasAcess=0;
		$allpending = Assignment::select()->where('status', 0)->where('assignto', '0')->count();
		$allreject = Assignment::select()->where('writer_reject',1)->count();
		$allcomplete = Assignment::select()->where('status', 3 )->count();
		$allrun = Assignment::select()->where('status', 1 )->count();

		$allassigned = Assignment::select()->where('status', 0 )->where('assignto','>','0')->count();

		$limitpending = Assignment::select()->where('status', 0)->where('assignto', $user->id)->count();
		$limitreject = Assignment::select()->where('writer_reject',1)->where('assignto', $user->id)->count();
		$limitcomplete = Assignment::select()->where('status', 3 )->where('assignto', $user->id)->count();
		$limitrun = Assignment::select()->where('status', 1 )->where('assignto', $user->id)->count();

		//$writercompletelimit = Assignment::select()->where('assignto', $user->id)->where('status', 4 )->where('checking_status',0)->orwhere('checking_status',2)->count();
		$writercompletelimit = Assignment::where('assignto', $user->id)->where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
                $writercomplete =  Assignment::where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
                
                $limitreviewpending = Assignment::select()->Where('checking_status','=', 4)->where(function($q) {$user = Sentinel::getUser();$q->where('checking_writer',$user->id)->orWhere('assignto',$user->id);})->count();
                $reviewpending = Assignment::select()->Where('checking_status','=', 4)->count();
                
                
   
                $limitreviewed = Assignment::where('checking_writer', $user->id)->where(function($q) {$q->where('checking_status',2)->orWhere('checking_status',3);})->count();
                $reviewed = Assignment::select()->Where('checking_status', 3)->orWhere('checking_status', 2)->count();
                

		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$hasAcess=1;
		}

    	return view('dashboard')->with([
			'allpending' => $allpending,
			'allreject'=> $allreject,
			'allcomplete'=>$allcomplete,
			'allrun'=>$allrun,
			'limitpending'=>$limitpending,
			'limitreject'=>$limitreject,
			'limitcomplete'=>$limitcomplete,
                        'limitreviewpending'=>$limitreviewpending,
                        'limitreviewed'=>  $limitreviewed ,
                        'reviewed'=>  $reviewed ,
                        'reviewpending'=>$reviewpending,
			'limitrun'=>$limitrun,
			'allassigned'=>$allassigned,
			'hasAcess'=>$hasAcess,
			'writercomplete'=>$writercomplete,
			'writercompletelimit'=>$writercompletelimit
		]);
		//return $limitpending;
	}

        
        /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function reviewrejectviewview()
	{
		$user = Sentinel::getUser();
		$hasAcess=0;
		$allpending = Assignment::select()->where('status', 0)->where('assignto', '0')->count();
		$allreject = Assignment::select()->where('writer_reject',1)->count();
		$allcomplete = Assignment::select()->where('status', 3 )->count();
		$allrun = Assignment::select()->where('status', 1 )->count();

		$allassigned = Assignment::select()->where('status', 0 )->where('assignto','>','0')->count();

		$limitpending = Assignment::select()->where('status', 0)->where('assignto', $user->id)->count();
		$limitreject = Assignment::select()->where('writer_reject',1)->where('assignto', $user->id)->count();
		$limitcomplete = Assignment::select()->where('status', 3 )->where('assignto', $user->id)->count();
		$limitrun = Assignment::select()->where('status', 1 )->where('assignto', $user->id)->count();

		$writercompletelimit = Assignment::where('assignto', $user->id)->where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
                $writercomplete =  Assignment::where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
               
                $limitreviewpending = Assignment::select()->Where('checking_status','=', 4)->where(function($q) {$user = Sentinel::getUser();$q->where('checking_writer',$user->id)->orWhere('assignto',$user->id);})->count();
                $reviewpending = Assignment::select()->Where('checking_status','=', 4)->count();
                
                 
                
             
                $limitreviewed = Assignment::where('checking_writer', $user->id)->where(function($q) {$q->where('checking_status',2)->orWhere('checking_status',3);})->count();
                $reviewed = Assignment::select()->Where('checking_status', 3)->orWhere('checking_status', 2)->count();
                
  

		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$hasAcess=1;
		}

    	return view('rejectReview')->with([
			'allpending' => $allpending,
			'allreject'=> $allreject,
			'allcomplete'=>$allcomplete,
			'allrun'=>$allrun,
			'limitpending'=>$limitpending,
			'limitreject'=>$limitreject,
			'limitcomplete'=>$limitcomplete,
                        'limitreviewpending'=>$limitreviewpending,
                        'limitreviewed'=>  $limitreviewed ,
                        'reviewed'=>  $reviewed ,
                        'reviewpending'=>$reviewpending,
			'limitrun'=>$limitrun,
			'allassigned'=>$allassigned,
			'hasAcess'=>$hasAcess,
			'writercomplete'=>$writercomplete,
			'writercompletelimit'=>$writercompletelimit
		]);
		//return $limitpending;
	}
    public function writerrejectview()
	{
		$user = Sentinel::getUser();
		$hasAcess=0;
		$allpending = Assignment::select()->where('status', 0)->where('assignto', '0')->count();
		$allreject = Assignment::select()->where('writer_reject',1)->count();
		$allcomplete = Assignment::select()->where('status', 3 )->count();
		$allrun = Assignment::select()->where('status', 1 )->count();

		$allassigned = Assignment::select()->where('status', 0 )->where('assignto','>','0')->count();

		$limitpending = Assignment::select()->where('status', 0)->where('assignto', $user->id)->count();
		$limitreject = Assignment::select()->where('writer_reject',1)->where('assignto', $user->id)->count();
		$limitcomplete = Assignment::select()->where('status', 3 )->where('assignto', $user->id)->count();
		$limitrun = Assignment::select()->where('status', 1 )->where('assignto', $user->id)->count();

		$writercompletelimit = Assignment::where('assignto', $user->id)->where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
                $writercomplete =  Assignment::where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
               
                $limitreviewpending = Assignment::select()->Where('checking_status','=', 4)->where(function($q) {$user = Sentinel::getUser();$q->where('checking_writer',$user->id)->orWhere('assignto',$user->id);})->count();
                $reviewpending = Assignment::select()->Where('checking_status','=', 4)->count();
                
                 
                
               
                $limitreviewed = Assignment::where('checking_writer', $user->id)->where(function($q) {$q->where('checking_status',2)->orWhere('checking_status',3);})->count();
                $reviewed = Assignment::select()->Where('checking_status', 3)->orWhere('checking_status', 2)->count();
                
 

		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$hasAcess=1;
		}

    	return view('writerReject')->with([
			'allpending' => $allpending,
			'allreject'=> $allreject,
			'allcomplete'=>$allcomplete,
			'allrun'=>$allrun,
			'limitpending'=>$limitpending,
			'limitreject'=>$limitreject,
			'limitcomplete'=>$limitcomplete,
                        'limitreviewpending'=>$limitreviewpending,
                        'limitreviewed'=>  $limitreviewed ,
                        'reviewed'=>  $reviewed ,
                        'reviewpending'=>$reviewpending,
			'limitrun'=>$limitrun,
			'allassigned'=>$allassigned,
			'hasAcess'=>$hasAcess,
			'writercomplete'=>$writercomplete,
			'writercompletelimit'=>$writercompletelimit
		]);
		//return $limitpending;
	}
	public function reports()
	{
		$user = DB::table('users')->join('role_users', 'role_users.user_id', '=', 'users.id')->where('role_users.role_id','9')->lists('users.username','users.id');
		$hasAcess=0;
		$allpending = Assignment::select()->where('status', 0)->where('assignto', '0')->count();
		$allreject = Assignment::select()->where('writer_reject',1)->count();
		$allcomplete = Assignment::select()->where('status', 3 )->count();
		$allrun = Assignment::select()->where('status', 1 )->count();
		$allassigned = Assignment::select()->where('status', 0 )->where('assignto','>','0')->count();

                //$writercompletelimit = Assignment::where('assignto', $user->id)->where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
                $writercomplete =  Assignment::where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
               
                //$limitreviewpending = Assignment::select()->Where('checking_writer','!=', 0)->Where('checking_status','=', 0)->Where('checking_writer', $user->id)->count();
                $reviewpending = Assignment::select()->Where('checking_status','=', 4)->count();
                
                
                //$limitreviewed = Assignment::select()->Where('checking_status', 3)->orWhere('checking_status', 2)->Where('checking_writer', $user->id)->count();
                $reviewed = Assignment::select()->Where('checking_status', 3)->orWhere('checking_status', 2)->count();
                
                
		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$hasAcess=1;
		}
		return view('report')->with([
			'userList' => $user,
			'allpending' => $allpending,
			'allreject'=> $allreject,
			'allcomplete'=>$allcomplete,
                        //'limitreviewpending'=>$limitreviewpending,
                        //'limitreviewed'=>  $limitreviewed ,
                        'reviewed'=>  $reviewed ,
                        'reviewpending'=>$reviewpending,
			'allrun'=>$allrun,
			'allassigned'=>$allassigned,
			'hasAcess'=>$hasAcess,
			'writercomplete'=>$writercomplete
		]);
		//return $limitpending;
	}
        
        
        public function revierlist()
	{
		$user = DB::table('users')->join('role_users', 'role_users.user_id', '=', 'users.id')->where('role_users.role_id','9')->lists('users.username','users.id');
		$hasAcess=0;
		$allpending = Assignment::select()->where('status', 0)->where('assignto', '0')->count();
		$allreject = Assignment::select()->where('writer_reject',1)->count();
		$allcomplete = Assignment::select()->where('status', 3 )->count();
		$allrun = Assignment::select()->where('status', 1 )->count();
		$allassigned = Assignment::select()->where('status', 0 )->where('assignto','>','0')->count();

		//$writercompletelimit = Assignment::where('assignto', $user->id)->where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
                $writercomplete =  Assignment::where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
               
                //$limitreviewpending = Assignment::select()->Where('checking_writer','!=', 0)->Where('checking_status','=', 0)->Where('checking_writer', $user->id)->count();
                $reviewpending = Assignment::select()->Where('checking_status','=', 4)->count();
                
                
                //$limitreviewed = Assignment::select()->Where('checking_status', 3)->orWhere('checking_status', 2)->Where('checking_writer', $user->id)->count();
                $reviewed = Assignment::select()->Where('checking_status', 3)->orWhere('checking_status', 2)->count();
                
                
		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$hasAcess=1;
		}
		return view('reviewer')->with([
			'userList' => $user,
			'allpending' => $allpending,
			'allreject'=> $allreject,
			'allcomplete'=>$allcomplete,
                        //'limitreviewpending'=>$limitreviewpending,
                        //'limitreviewed'=>  $limitreviewed ,
                        'reviewed'=>  $reviewed ,
                        'reviewpending'=>$reviewpending,
			'allrun'=>$allrun,
			'allassigned'=>$allassigned,
			'hasAcess'=>$hasAcess,
			'writercomplete'=>$writercomplete
		]);
		//return $limitpending;
	}
        
	public function reportsref()
	{
		$user = DB::table('users')->join('role_users', 'role_users.user_id', '=', 'users.id')->where('role_users.role_id','9')->lists('users.username','users.id');
		$hasAcess=0;
		$allpending = Assignment::select()->where('status', 0)->where('assignto', '0')->count();
		$allreject = Assignment::select()->where('writer_reject',1)->count();
		$allcomplete = Assignment::select()->where('status', 3 )->count();
		$allrun = Assignment::select()->where('status', 1 )->count();
		$allassigned = Assignment::select()->where('status', 0 )->where('assignto','>','0')->count();

                //$limitreviewpending = Assignment::select()->Where('checking_writer','!=', 0)->Where('checking_status','=', 0)->Where('checking_writer', $user->id)->count();
                $reviewpending = Assignment::select()->Where('checking_status','=', 4)->where('checking_status',0)->orwhere('checking_status',2)->count();
                
                
                //$limitreviewed = Assignment::select()->Where('checking_status', 3)->orWhere('checking_status', 2)->Where('checking_writer', $user->id)->count();
                $reviewed = Assignment::select()->Where('checking_status', 3)->orWhere('checking_status', 2)->count();
                
                
               //$writercompletelimit = Assignment::where('assignto', $user->id)->where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
                $writercomplete =  Assignment::where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
               
		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$hasAcess=1;
		}
		return view('reportref')->with([
			'allpending' => $allpending,
			'allreject'=> $allreject,
			'allcomplete'=>$allcomplete,    
                        'reviewed'=>  $reviewed ,
                        'reviewpending'=>$reviewpending,
			'allrun'=>$allrun,
			'allassigned'=>$allassigned,
			'hasAcess'=>$hasAcess,
			'writercomplete'=>$writercomplete
		]);
		//return $limitpending;
	}
        
        
        
        public function reportspayment()
	{
		$user = DB::table('users')->join('role_users', 'role_users.user_id', '=', 'users.id')->where('role_users.role_id','9')->lists('users.username','users.id');
		$hasAcess=0;
		$allpending = Assignment::select()->where('status', 0)->where('assignto', '0')->count();
		$allreject = Assignment::select()->where('writer_reject',1)->count();
		$allcomplete = Assignment::select()->where('status', 3 )->count();
		$allrun = Assignment::select()->where('status', 1 )->count();
		$allassigned = Assignment::select()->where('status', 0 )->where('assignto','>','0')->count();

                //$limitreviewpending = Assignment::select()->Where('checking_writer','!=', 0)->Where('checking_status','=', 0)->Where('checking_writer', $user->id)->count();
                $reviewpending = Assignment::select()->Where('checking_status','=', 4)->where('checking_status',0)->orwhere('checking_status',2)->count();
                
                
                //$limitreviewed = Assignment::select()->Where('checking_status', 3)->orWhere('checking_status', 2)->Where('checking_writer', $user->id)->count();
                $reviewed = Assignment::select()->Where('checking_status', 3)->orWhere('checking_status', 2)->count();
                
                
		//$writercompletelimit = Assignment::where('assignto', $user->id)->where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
                $writercomplete =  Assignment::where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
               
		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$hasAcess=1;
		}
		return view('report_payment')->with([
			'allpending' => $allpending,
			'allreject'=> $allreject,
			'allcomplete'=>$allcomplete,    
                        'reviewed'=>  $reviewed ,
                        'reviewpending'=>$reviewpending,
			'allrun'=>$allrun,
			'allassigned'=>$allassigned,
			'hasAcess'=>$hasAcess,
			'writercomplete'=>$writercomplete
		]);
		//return $limitpending;
	}
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function assigned()
	{
		$user = Sentinel::getUser();
		$hasAcess=0;
		$allpending = Assignment::select()->where('status', 0)->where('assignto', '0')->count();
		$allreject = Assignment::select()->where('writer_reject',1)->count();
		$allcomplete = Assignment::select()->where('status', 3 )->count();
		$allrun = Assignment::select()->where('status', 1 )->count();
		$allassigned = Assignment::select()->where('status', 0 )->where('assignto','>','0')->count();

		$limitpending = Assignment::select()->where('status', 0)->where('assignto', $user->id)->count();
		$limitreject = Assignment::select()->where('writer_reject',1)->where('assignto', $user->id)->count();
		$limitcomplete = Assignment::select()->where('status', 3 )->where('assignto', $user->id)->count();
		$limitrun = Assignment::select()->where('status', 1 )->where('assignto', $user->id)->count();

                $writercompletelimit = Assignment::where('assignto', $user->id)->where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
                $writercomplete =  Assignment::where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
               
                
                 $limitreviewpending = Assignment::select()->Where('checking_status','=', 4)->where(function($q) {$user = Sentinel::getUser();$q->where('checking_writer',$user->id)->orWhere('assignto',$user->id);})->count();
                $reviewpending = Assignment::select()->Where('checking_status','=', 4)->count();
                
                
                
                
                $limitreviewed = Assignment::where('checking_writer', $user->id)->where(function($q) {$q->where('checking_status',2)->orWhere('checking_status',3);})->count();
                $reviewed = Assignment::select()->Where('checking_status', 3)->orWhere('checking_status', 2)->count();
                

                
		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$hasAcess=1;
		}

		return view('assigned')->with([
			'allpending' => $allpending,
			'allreject'=> $allreject,
			'allcomplete'=>$allcomplete,
			'allrun'=>$allrun,
			'limitpending'=>$limitpending,
			'limitreject'=>$limitreject,
			'limitcomplete'=>$limitcomplete,
                        'limitreviewpending'=>$limitreviewpending,
                        'limitreviewed'=>  $limitreviewed ,
                        'reviewed'=>  $reviewed ,
                        'reviewpending'=>$reviewpending,
			'limitrun'=>$limitrun,
			'allassigned'=>$allassigned,
			'hasAcess'=>$hasAcess,
			'writercomplete'=>$writercomplete,
			'writercompletelimit'=>$writercompletelimit
		]);
		//return $limitpending;
	}
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function runing()
	{
		$user = Sentinel::getUser();
		$hasAcess=0;
		$allpending = Assignment::select()->where('status', 0)->where('assignto', '0')->count();
		$allreject = Assignment::select()->where('writer_reject',1)->count();
		$allcomplete = Assignment::select()->where('status', 3 )->count();
		$allrun = Assignment::select()->where('status', 1 )->count();
		$allassigned =Assignment::select()->where('status', 0 )->where('assignto','>','0')->count();

		$limitpending = Assignment::select()->where('status', 0)->where('assignto', $user->id)->count();
		$limitreject = Assignment::select()->where('writer_reject',1)->where('assignto', $user->id)->count();
		$limitcomplete = Assignment::select()->where('status', 3 )->where('assignto', $user->id)->count();
		$limitrun = Assignment::select()->where('status', 1 )->where('assignto', $user->id)->count();

		$writercompletelimit = Assignment::where('assignto', $user->id)->where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
                $writercomplete =  Assignment::where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
               
                $limitreviewpending = Assignment::select()->Where('checking_status','=', 4)->where(function($q) {$user = Sentinel::getUser();$q->where('checking_writer',$user->id)->orWhere('assignto',$user->id);})->count();
                $reviewpending = Assignment::select()->Where('checking_status','=', 4)->count();
                
                 
                
               
                $limitreviewed = Assignment::where('checking_writer', $user->id)->where(function($q) {$q->where('checking_status',2)->orWhere('checking_status',3);})->count();
                $reviewed = Assignment::select()->Where('checking_status', 3)->orWhere('checking_status', 2)->count();
                

                
		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$hasAcess=1;
		}

		return view('runing')->with([
			'allpending' => $allpending,
			'allreject'=> $allreject,
			'allcomplete'=>$allcomplete,
			'allrun'=>$allrun,
			'limitpending'=>$limitpending,
			'limitreject'=>$limitreject,
			'limitcomplete'=>$limitcomplete,
			'limitrun'=>$limitrun,
			'allassigned'=>$allassigned,
			'hasAcess'=>$hasAcess,
			'writercomplete'=>$writercomplete,
                        'limitreviewpending'=>$limitreviewpending,
                        'limitreviewed'=>  $limitreviewed ,
                        'reviewed'=>  $reviewed ,
                        'reviewpending'=>$reviewpending,
			'writercompletelimit'=>$writercompletelimit
		]);
		//return $limitpending;
	}

	/**
		 * Show the application welcome screen to the user.
		 *
		 * @return Response
		 */
		public function complete()
	{
		$user = Sentinel::getUser();
		$hasAcess=0;
		$allpending = Assignment::select()->where('status', 0)->where('assignto', '0')->count();
		$allreject = Assignment::select()->where('writer_reject',1)->count();
		$allcomplete = Assignment::select()->where('status', 3 )->count();
		$allrun = Assignment::select()->where('status', 1 )->count();
		$allassigned = Assignment::select()->where('status', 0 )->where('assignto','>','0')->count();

		$limitpending = Assignment::select()->where('status', 0)->where('assignto', $user->id)->count();
		$limitreject = Assignment::select()->where('writer_reject',1)->where('assignto', $user->id)->count();
		$limitcomplete = Assignment::select()->where('status', 3 )->where('assignto', $user->id)->count();
		$limitrun = Assignment::select()->where('status', 1 )->where('assignto', $user->id)->count();

		$writercompletelimit = Assignment::where('assignto', $user->id)->where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
                $writercomplete =  Assignment::where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
               
                 $limitreviewpending = Assignment::select()->Where('checking_status','=', 4)->where(function($q) {$user = Sentinel::getUser();$q->where('checking_writer',$user->id)->orWhere('assignto',$user->id);})->count();
                $reviewpending = Assignment::select()->Where('checking_status','=', 4)->count();
                
                
                
               
                $limitreviewed = Assignment::where('checking_writer', $user->id)->where(function($q) {$q->where('checking_status',2)->orWhere('checking_status',3);})->count();
                $reviewed = Assignment::select()->Where('checking_status', 3)->orWhere('checking_status', 2)->count();
                

                
		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$hasAcess=1;
		}

		return view('complete')->with([
			'allpending' => $allpending,
			'allreject'=> $allreject,
			'allcomplete'=>$allcomplete,
			'allrun'=>$allrun,
			'limitpending'=>$limitpending,
			'limitreject'=>$limitreject,
			'limitcomplete'=>$limitcomplete,
			'limitrun'=>$limitrun,
			'allassigned'=>$allassigned,
			'hasAcess'=>$hasAcess,
			'writercomplete'=>$writercomplete,
                        'limitreviewpending'=>$limitreviewpending,
                        'limitreviewed'=>  $limitreviewed ,
                        'reviewed'=>  $reviewed ,
                        'reviewpending'=>$reviewpending,
			'writercompletelimit'=>$writercompletelimit
		]);
		//return $limitpending;
	}
	public function rejected()
	{
		$user = Sentinel::getUser();
		$hasAcess=0;
		$allpending = Assignment::select()->where('status', 0)->where('assignto', '0')->count();
		$allreject = Assignment::select()->where('writer_reject',1)->count();
		$allcomplete = Assignment::select()->where('status', 3 )->count();
		$allrun = Assignment::select()->where('status', 1 )->count();
		$allassigned = Assignment::select()->where('status', 0 )->where('assignto','>','0')->count();

		$limitpending = Assignment::select()->where('status', 0)->where('assignto', $user->id)->count();
		$limitreject = Assignment::select()->where('writer_reject',1)->where('assignto', $user->id)->count();
		$limitcomplete = Assignment::select()->where('status', 3 )->where('assignto', $user->id)->count();
		$limitrun = Assignment::select()->where('status', 1 )->where('assignto', $user->id)->count();

		$writercompletelimit = Assignment::where('assignto', $user->id)->where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
                $writercomplete =  Assignment::where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
               
                $limitreviewpending = Assignment::select()->Where('checking_status','=', 4)->where(function($q) {$user = Sentinel::getUser();$q->where('checking_writer',$user->id)->orWhere('assignto',$user->id);})->count();
                $reviewpending = Assignment::select()->Where('checking_status','=', 4)->count();
                
                 
                
                
                $limitreviewed = Assignment::where('checking_writer', $user->id)->where(function($q) {$q->where('checking_status',2)->orWhere('checking_status',3);})->count();
                $reviewed = Assignment::select()->Where('checking_status', 3)->orWhere('checking_status', 2)->count();
                

                
		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$hasAcess=1;
		}

		return view('rejected')->with([
			'allpending' => $allpending,
			'allreject'=> $allreject,
			'allcomplete'=>$allcomplete,
			'allrun'=>$allrun,
			'limitpending'=>$limitpending,
			'limitreject'=>$limitreject,
			'limitcomplete'=>$limitcomplete,
			'limitrun'=>$limitrun,
			'allassigned'=>$allassigned,
                        'limitreviewpending'=>$limitreviewpending,
                        'limitreviewed'=>  $limitreviewed ,
                        'reviewed'=>  $reviewed ,
                        'reviewpending'=>$reviewpending,
			'hasAcess'=>$hasAcess,
			'writercomplete'=>$writercomplete,
			'writercompletelimit'=>$writercompletelimit
		]);
		//return $limitpending;
	}

	public function writercomplete()
	{
		$user = Sentinel::getUser();
		$hasAcess=0;
		$allpending = Assignment::select()->where('status', 0)->where('assignto', '0')->count();
		$allreject = Assignment::select()->where('writer_reject',1)->count();
		$allcomplete = Assignment::select()->where('status', 3 )->count();
		$allrun = Assignment::select()->where('status', 1 )->count();
		$allassigned = Assignment::select()->where('status', 0 )->where('assignto','>','0')->count();

		$limitpending = Assignment::select()->where('status', 0)->where('assignto', $user->id)->count();
		$limitreject = Assignment::select()->where('writer_reject',1)->where('assignto', $user->id)->count();
		$limitcomplete = Assignment::select()->where('status', 3 )->where('assignto', $user->id)->count();
		$limitrun = Assignment::select()->where('status', 1 )->where('assignto', $user->id)->count();

		$writercompletelimit = Assignment::where('assignto', $user->id)->where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
                $writercomplete =  Assignment::where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
               
                $limitreviewpending = Assignment::select()->Where('checking_status','=', 4)->where(function($q) {$user = Sentinel::getUser();$q->where('checking_writer',$user->id)->orWhere('assignto',$user->id);})->count();
                $reviewpending = Assignment::select()->Where('checking_status','=', 4)->count();
                
                  
                
                
                $limitreviewed = Assignment::where('checking_writer', $user->id)->where(function($q) {$q->where('checking_status',2)->orWhere('checking_status',3);})->count();
                $reviewed = Assignment::select()->Where('checking_status', 3)->orWhere('checking_status', 2)->count();
                

                
		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$hasAcess=1;
		}

		return view('writercomplete')->with([
			'allpending' => $allpending,
			'allreject'=> $allreject,
			'allcomplete'=>$allcomplete,
			'allrun'=>$allrun,
			'limitpending'=>$limitpending,
			'limitreject'=>$limitreject,
			'limitcomplete'=>$limitcomplete,
			'limitrun'=>$limitrun,
                        'limitreviewpending'=>$limitreviewpending,
                        'limitreviewed'=>  $limitreviewed ,
                        'reviewed'=>  $reviewed ,
                        'reviewpending'=>$reviewpending,
			'allassigned'=>$allassigned,
			'hasAcess'=>$hasAcess,
			'writercomplete'=>$writercomplete,
			'writercompletelimit'=>$writercompletelimit
		]);
		//return $limitpending;
	}
        
        public function reviewingview()
	{
		$user = Sentinel::getUser();
		$hasAcess=0;
		$allpending = Assignment::select()->where('status', 0)->where('assignto', '0')->count();
		$allreject = Assignment::select()->where('writer_reject',1)->count();
		$allcomplete = Assignment::select()->where('status', 3 )->count();
		$allrun = Assignment::select()->where('status', 1 )->count();
		$allassigned = Assignment::select()->where('status', 0 )->where('assignto','>','0')->count();

		$limitpending = Assignment::select()->where('status', 0)->where('assignto', $user->id)->count();
		$limitreject = Assignment::select()->where('writer_reject',1)->where('assignto', $user->id)->count();
		$limitcomplete = Assignment::select()->where('status', 3 )->where('assignto', $user->id)->count();
		$limitrun = Assignment::select()->where('status', 1 )->where('assignto', $user->id)->count();

		$writercompletelimit = Assignment::where('assignto', $user->id)->where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
                $writercomplete =  Assignment::where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
               
                $limitreviewpending = Assignment::select()->Where('checking_status','=', 4)->where(function($q) {$user = Sentinel::getUser();$q->where('checking_writer',$user->id)->orWhere('assignto',$user->id);})->count();
                $reviewpending = Assignment::select()->Where('checking_status','=', 4)->count();
                
                
               
                $limitreviewed = Assignment::where('checking_writer', $user->id)->where(function($q) {$q->where('checking_status',2)->orWhere('checking_status',3);})->count();
                $reviewed = Assignment::select()->Where('checking_status', 3)->orWhere('checking_status', 2)->count();
                

                
		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$hasAcess=1;
		}

		return view('reviewing')->with([
			'allpending' => $allpending,
			'allreject'=> $allreject,
			'allcomplete'=>$allcomplete,
			'allrun'=>$allrun,
			'limitpending'=>$limitpending,
			'limitreject'=>$limitreject,
			'limitcomplete'=>$limitcomplete,
			'limitrun'=>$limitrun,
                        'limitreviewpending'=>$limitreviewpending,
                        'limitreviewed'=>  $limitreviewed ,
                        'reviewed'=>  $reviewed ,
                        'reviewpending'=>$reviewpending,
			'allassigned'=>$allassigned,
			'hasAcess'=>$hasAcess,
			'writercomplete'=>$writercomplete,
			'writercompletelimit'=>$writercompletelimit
		]);
		//return $limitpending;
	}
        
            public function reviewedview()
	{
		$user = Sentinel::getUser();
		$hasAcess=0;
		$allpending = Assignment::select()->where('status', 0)->where('assignto', '0')->count();
		$allreject = Assignment::select()->where('writer_reject',1)->count();
		$allcomplete = Assignment::select()->where('status', 3 )->count();
		$allrun = Assignment::select()->where('status', 1 )->count();
		$allassigned = Assignment::select()->where('status', 0 )->where('assignto','>','0')->count();

		$limitpending = Assignment::select()->where('status', 0)->where('assignto', $user->id)->count();
		$limitreject = Assignment::select()->where('writer_reject',1)->where('assignto', $user->id)->count();
		$limitcomplete = Assignment::select()->where('status', 3 )->where('assignto', $user->id)->count();
		$limitrun = Assignment::select()->where('status', 1 )->where('assignto', $user->id)->count();

		$writercompletelimit = Assignment::where('assignto', $user->id)->where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
                $writercomplete =  Assignment::where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
               
                 $limitreviewpending = Assignment::select()->Where('checking_status','=', 4)->where(function($q) {$user = Sentinel::getUser();$q->where('checking_writer',$user->id)->orWhere('assignto',$user->id);})->count();
                $reviewpending = Assignment::select()->Where('checking_status','=', 4)->count();
                
                
               
                $limitreviewed = Assignment::where('checking_writer', $user->id)->where(function($q) {$q->where('checking_status',2)->orWhere('checking_status',3);})->count();
                $reviewed = Assignment::select()->Where('checking_status', 3)->orWhere('checking_status', 2)->count();
                

                
		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$hasAcess=1;
		}

		return view('reviewed')->with([
			'allpending' => $allpending,
			'allreject'=> $allreject,
			'allcomplete'=>$allcomplete,
			'allrun'=>$allrun,
			'limitpending'=>$limitpending,
			'limitreject'=>$limitreject,
			'limitcomplete'=>$limitcomplete,
			'limitrun'=>$limitrun,
                        'limitreviewpending'=>$limitreviewpending,
                        'limitreviewed'=>  $limitreviewed ,
                        'reviewed'=>  $reviewed ,
                        'reviewpending'=>$reviewpending,
			'allassigned'=>$allassigned,
			'hasAcess'=>$hasAcess,
			'writercomplete'=>$writercomplete,
			'writercompletelimit'=>$writercompletelimit
		]);
		//return $limitpending;
	}

	public function test()
	{
		return 'Hooray';
		//return Menu::create(['label'=>'Add Menu','link'=>'menu/add','icon'=>'','parent'=>'2','menu_sort'=>2,'level'=>1,'permissions'=>'["menu.add"]']);
		//return Sentinel::registerAndActivate(['username'=>'super.admin','password'=>'123456','email'=>'admin@admin.lk','first_name'=>'Super','last_name'=>'Administrator']);
	}


	public function jsonList()
	{

		$user = Sentinel::getUser();

		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$data = Assignment::select()->where('status', 0 )->where('assignto','0')->orderBy('id', 'desc')->get();
		}
		else{
			$data = Assignment::select()->where('status', 0)->where('assignto', $user->id)->orderBy('id', 'desc')->get();
		}
		$jsonList = array();
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
				array_push($rowData, $i);
				array_push($rowData, $value->id);
				$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
				if (Sentinel::hasAnyAccess($permissions)) {
					array_push($rowData, $value->studentName);
					array_push($rowData, $value->email);
					array_push($rowData, $value->phoneNo);
					array_push($rowData, $value->deadline);
					array_push($rowData, $value->price);			
									
				}
				else {
         	       // array_push($rowData,'<img style=" width:50px;" src="http://www.countries-ofthe-world.com/flags-normal/flag-of-'. str_replace(" ","-",$value->domain).'.png" >');
                                        array_push($rowData, $value->writerDeadLine);
					array_push($rowData, $value->level);
                                        array_push($rowData, $value->topic);
				}

				array_push($rowData, $value->wordcount);
				if($value->studentAttachment !=""){
                                        $studentAttachment=explode(".",$value->studentAttachment);
					array_push($rowData, '<center> <a download="'.'studentAttachment_'.$value->id.'.'.$studentAttachment[1].'" href="' . asset('attachments/' . $value->id . '/' . $value->studentAttachment . '') . '" class="btn btn-primary btn-outline btn-round "><i class="fa fa-download"></i></a></center>');
				}
				else{
					array_push($rowData, '<span> No Attachment</span>');
				}
                                		$country=str_replace(" ","-",$value->domain);
				//	array_push($rowData,'<img style=" width:50px;" src="http://www.countries-ofthe-world.com/flags-normal/flag-of-'. .'.png" >');
			
                                array_push($rowData,'<img style=" width:50px;" src="'. asset('flags/'.$country).'.png" >');				
                                array_push($rowData, ' <a onclick="window.location.href=\'' . url('assignment/edit/' . $value->id) . '\'" class="btn btn-info">View</a>');
				array_push($jsonList, $rowData);
				$i++;


		}
		return Response::json(array('data' => $jsonList));

	}

	public function jsonListwriter($id)
	{

		$data = Assignment::select()->where('assignto', $id)->orderBy('id', 'desc')->get();
		$jsonList = array();
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
			array_push($rowData, $i);
			array_push($rowData, $value->id);
			array_push($rowData, DATE($value->created_at));
			array_push($rowData, $value->studentName);
			array_push($rowData, $value->email);
			array_push($rowData, $value->phoneNo);
			array_push($rowData, $value->wordcount);
			if($value->studentAttachment !=""){
                            $studentAttachment=explode(".",$value->studentAttachment);
                            array_push($rowData, '<center> <a download="'.'studentAttachment_'.$value->id.'.'.$studentAttachment[1].'" href="' . asset('attachments/' . $value->id . '/' . $value->studentAttachment . '') . '" class="btn btn-primary btn-outline btn-round "><i class="fa fa-download"></i></a></center>');
			
				//array_push($rowData, '<center> <a href="' . asset('attachments/' . $value->id . '/' . $value->studentAttachment . '') . '" class="btn btn-primary btn-outline btn-round "><i class="fa fa-download"></i></a></center>');
			}
			else{
				array_push($rowData, '<span> No Attachment</span>');
			}

			array_push($rowData, '<div class="progress" style="width:100px"><div class="progress-bar progress-bar-sm" style="width:' . $value->progress . '%;" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-percent="50"></div></div>');
			if($value->status ==0  && $value->assignto ==0){
				array_push($rowData, '<span style="color: blue;">New Project</span>');
			}
			elseif($value->status ==0 && $value->assignto !=0){
				array_push($rowData, '<span style="color: orangered;">Assigned</span>');
			}
			elseif($value->status ==1){
				array_push($rowData, '<span style="color: purple;">Runing</span>');
			}
			elseif($value->status ==4){
				array_push($rowData, '<span style="color: #ad9a12;">Waiting for Complete</span>');
			}
			elseif($value->status ==3){
				array_push($rowData, '<span style="color: green;">Completed</span>');
			}
			elseif($value->status ==2){
				array_push($rowData, '<span style="color: red;">Rejected</span>');
			}

			array_push($rowData, ' <a onclick="window.location.href=\'' . url('assignment/edit/' . $value->id) . '\'" class="btn btn-info">View</a>');
			array_push($jsonList, $rowData);
			$i++;


		}
		return Response::json(array('data' => $jsonList));

	}
        
        
        public function jsonwriterpayment($id)
	{

		$data = Assignment::select()->where('id', $id)->orderBy('id', 'desc')->get();
		$jsonList = array();
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
			array_push($rowData, $i);
			array_push($rowData, $value->id);
			array_push($rowData, DATE($value->created_at));
			array_push($rowData, $value->studentName);
			array_push($rowData, $value->email);
			array_push($rowData, $value->phoneNo);
			array_push($rowData, $value->wordcount);
			if($value->studentAttachment !=""){
                                $studentAttachment=explode(".",$value->studentAttachment);
				array_push($rowData, '<center> <a download="'.'studentAttachment_'.$value->id.'.'.$studentAttachment[1].'" href="' . asset('attachments/' . $value->id . '/' . $value->studentAttachment . '') . '" class="btn btn-primary btn-outline btn-round "><i class="fa fa-download"></i></a></center>');
			
				//array_push($rowData, '<center> <a href="' . asset('attachments/' . $value->id . '/' . $value->studentAttachment . '') . '" class="btn btn-primary btn-outline btn-round "><i class="fa fa-download"></i></a></center>');
			}
			else{
				array_push($rowData, '<span> No Attachment</span>');
			}

			array_push($rowData, '<div class="progress" style="width:100px"><div class="progress-bar progress-bar-sm" style="width:' . $value->progress . '%;" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-percent="50"></div></div>');
			if($value->status ==0  && $value->assignto ==0){
				array_push($rowData, '<span style="color: blue;">New Project</span>');
			}
			elseif($value->status ==0 && $value->assignto !=0){
				array_push($rowData, '<span style="color: orangered;">Assigned</span>');
			}
			elseif($value->status ==1){
				array_push($rowData, '<span style="color: purple;">Runing</span>');
			}
			elseif($value->status ==4){
				array_push($rowData, '<span style="color: #ad9a12;">Waiting for Complete</span>');
			}
			elseif($value->status ==3){
				array_push($rowData, '<span style="color: green;">Completed</span>');
			}
			elseif($value->status ==2){
				array_push($rowData, '<span style="color: red;">Rejected</span>');
			}

			array_push($rowData, ' <a onclick="window.location.href=\'' . url('assignment/edit/' . $value->id) . '\'" class="btn btn-info">View</a>');
			array_push($jsonList, $rowData);
			$i++;


		}
		return Response::json(array('data' => $jsonList));

	}
        
	public function jsonref($id)
	{

		$data = Assignment::select()->where('id', $id)->orderBy('id', 'desc')->get();
		$jsonList = array();
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
			array_push($rowData, $i);
			array_push($rowData, $value->id);
			array_push($rowData, DATE($value->created_at));
			array_push($rowData, $value->studentName);
			array_push($rowData, $value->email);
			array_push($rowData, $value->phoneNo);
			array_push($rowData, $value->wordcount);
			if($value->studentAttachment !=""){
                                $studentAttachment=explode(".",$value->studentAttachment);
				array_push($rowData, '<center> <a download="'.'studentAttachment_'.$value->id.'.'.$studentAttachment[1].'" href="' . asset('attachments/' . $value->id . '/' . $value->studentAttachment . '') . '" class="btn btn-primary btn-outline btn-round "><i class="fa fa-download"></i></a></center>');
			
				//array_push($rowData, '<center> <a href="' . asset('attachments/' . $value->id . '/' . $value->studentAttachment . '') . '" class="btn btn-primary btn-outline btn-round "><i class="fa fa-download"></i></a></center>');
			}
			else{
				array_push($rowData, '<span> No Attachment</span>');
			}

			array_push($rowData, '<div class="progress" style="width:100px"><div class="progress-bar progress-bar-sm" style="width:' . $value->progress . '%;" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-percent="50"></div></div>');
			if($value->status ==0  && $value->assignto ==0){
				array_push($rowData, '<span style="color: blue;">New Project</span>');
			}
			elseif($value->status ==0 && $value->assignto !=0){
				array_push($rowData, '<span style="color: orangered;">Assigned</span>');
			}
			elseif($value->status ==1){
				array_push($rowData, '<span style="color: purple;">Runing</span>');
			}
			elseif($value->status ==4){
				array_push($rowData, '<span style="color: #ad9a12;">Waiting for Complete</span>');
			}
			elseif($value->status ==3){
				array_push($rowData, '<span style="color: green;">Completed</span>');
			}
			elseif($value->status ==2){
				array_push($rowData, '<span style="color: red;">Rejected</span>');
			}

			array_push($rowData, ' <a onclick="window.location.href=\'' . url('assignment/edit/' . $value->id) . '\'" class="btn btn-info">View</a>');
			array_push($jsonList, $rowData);
			$i++;


		}
		return Response::json(array('data' => $jsonList));

	}
        
	public function jsonListallwriter()
	{

		$data = Assignment::all();
		$jsonList = array();
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
			array_push($rowData, $i);
			array_push($rowData, $value->id);
			array_push($rowData, DATE($value->created_at));
			array_push($rowData, $value->studentName);
			array_push($rowData, $value->email);
			array_push($rowData, $value->phoneNo);
			array_push($rowData, $value->wordcount);
			if($value->studentAttachment !=""){
                                $studentAttachment=explode(".",$value->studentAttachment);
				array_push($rowData, '<center> <a download="'.'studentAttachment_'.$value->id.'.'.$studentAttachment[1].'" href="' . asset('attachments/' . $value->id . '/' . $value->studentAttachment . '') . '" class="btn btn-primary btn-outline btn-round "><i class="fa fa-download"></i></a></center>');
			
				//array_push($rowData, '<center> <a href="' . asset('attachments/' . $value->id . '/' . $value->studentAttachment . '') . '" class="btn btn-primary btn-outline btn-round "><i class="fa fa-download"></i></a></center>');
			}
			else{
				array_push($rowData, '<span> No Attachment</span>');
			}

			array_push($rowData, '<div class="progress" style="width:50px"><div class="progress-bar progress-bar-sm" style="width:' . $value->progress . '%;" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-percent="50"></div></div>');
			if($value->status ==0  && $value->assignto ==0){
				array_push($rowData, '<span style="color: blue;">New Project</span>');
			}
			elseif($value->status ==0 && $value->assignto !=0){
				array_push($rowData, '<span style="color: orangered;">Assigned</span>');
			}
			elseif($value->status ==1){
				array_push($rowData, '<span style="color: purple;">Runing</span>');
			}
			elseif($value->status ==4){
				array_push($rowData, '<span style="color: #ad9a12;">Waiting for Complete</span>');
			}
			elseif($value->status ==3){
				array_push($rowData, '<span style="color: green;">Completed</span>');
			}
			elseif($value->status ==2){
				array_push($rowData, '<span style="color: red;">Rejected</span>');
			}

			array_push($rowData, ' <a onclick="window.location.href=\'' . url('assignment/edit/' . $value->id) . '\'" class="btn btn-info">View</a>');
			array_push($jsonList, $rowData);
			$i++;


		}
		return Response::json(array('data' => $jsonList));

	}

	public function runingprojects()
	{
		$user = Sentinel::getUser();

		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$data = Assignment::select()->where('status',1)->orderBy('id', 'desc')->get();
		}
		else{
			$data =Assignment::select()->where('status', 1 )->where('assignto', $user->id)->orderBy('id', 'desc')->get();
		}

		$jsonList = array();
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
			$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
			if (Sentinel::hasAnyAccess($permissions) || $user->id == $value->assignto ) {
				array_push($rowData, $i);
				array_push($rowData, $value->id);
				array_push($rowData, DATE($value->created_at));

				$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
                                 $writeruser = DB::table('users')->where('id', '=', $value->assignto)->get();
				if (Sentinel::hasAnyAccess($permissions)) {
					array_push($rowData, $value->studentName);
					array_push($rowData, $writeruser[0]->first_name.' '.$writeruser[0]->last_name);
					array_push($rowData, $value->phoneNo);
					array_push($rowData, $value->deadline);
					array_push($rowData, $value->writerDeadLine);
				}
				else {
					array_push($rowData, $value->writerDeadLine);
					array_push($rowData, $value->level);
                                        array_push($rowData, $value->topic);
				}
				array_push($rowData, $value->wordcount);
				if($value->studentAttachment !=""){
                                     $studentAttachment=explode(".",$value->studentAttachment);
					array_push($rowData, '<center> <a download="'.'studentAttachment_'.$value->id.'.'.$studentAttachment[1].'" href="' . asset('attachments/' . $value->id . '/' . $value->studentAttachment . '') . '" class="btn btn-primary btn-outline btn-round "><i class="fa fa-download"></i></a></center>');
			
					//array_push($rowData, '<center> <a href="' . asset('attachments/' . $value->id . '/' . $value->studentAttachment . '') . '" class="btn btn-primary btn-outline btn-round "><i class="fa fa-download"></i></a></center>');
				}
				else{
					array_push($rowData, '<span> No Attachment</span>');
				}
				      if (Sentinel::hasAnyAccess($permissions)) {     
                                             array_push($rowData, $value->price);
                                         }
                                         else{
                                       array_push($rowData, '<div class="progress" style="width:50px"><div class="progress-bar progress-bar-sm" style="width:' . $value->progress . '%;" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-percent="50"></div></div>');
                                      
                                         }
                                $country=str_replace(" ","-",$value->domain);
                                array_push($rowData,'<img style=" width:50px;" src="'. asset('flags/'.$country).'.png" >');
                                array_push($rowData, ' <a onclick="window.location.href=\'' . url('assignment/edit/' . $value->id) . '\'" class="btn btn-info">View</a>');
				array_push($jsonList, $rowData);
				$i++;
			}

		}
		return Response::json(array('data' => $jsonList));

	}

	public function completeprojectlist()
	{
		$user = Sentinel::getUser();
		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$data = Assignment::select()->where('status',3)->orderBy('id', 'desc')->get();
		}
		else{
			$data =Assignment::select()->where('status', 3 )->where('assignto', $user->id)->orderBy('id', 'desc')->get();
		}


		$jsonList = array();
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
			$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
			if (Sentinel::hasAnyAccess($permissions) || $user->id == $value->assignto ) {
				array_push($rowData, $i);
				array_push($rowData, $value->id);
				array_push($rowData, DATE($value->created_at));

				$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
                                 $writeruser = DB::table('users')->where('id', '=', $value->assignto)->get();
				if (Sentinel::hasAnyAccess($permissions)) {
					array_push($rowData, $value->studentName);
					if(isset($writeruser[0]->first_name)){
					array_push($rowData, $writeruser[0]->first_name.' '.$writeruser[0]->last_name);
					}else{
					array_push($rowData, ' ');
					}
					array_push($rowData, $value->phoneNo);					
					array_push($rowData, $value->writerDeadLine);
					array_push($rowData, $value->completeDate);
				}
				else {
					array_push($rowData, $value->writerDeadLine);
                                        array_push($rowData, $value->completeDate);
					array_push($rowData, $value->level);
                                        array_push($rowData, $value->topic);
				}
				array_push($rowData, $value->wordcount);
				if($value->studentAttachment !=""){
                                     $studentAttachment=explode(".",$value->studentAttachment);
					array_push($rowData, '<center> <a download="'.'studentAttachment_'.$value->id.'.'.$studentAttachment[1].'" href="' . asset('attachments/' . $value->id . '/' . $value->studentAttachment . '') . '" class="btn btn-primary btn-outline btn-round "><i class="fa fa-download"></i></a></center>');
			
					//array_push($rowData, ' <center><a href="' . asset('attachments/' . $value->id . '/' . $value->studentAttachment . '') . '" class="btn btn-primary btn-outline btn-round "><i class="fa fa-download"></i></a></center>');
				}
				else{
					array_push($rowData, '<span> No Attachment</span>');
				}
				      if (Sentinel::hasAnyAccess($permissions)) {     
                                             array_push($rowData, $value->price);
                                         }
                                         else{
                                       array_push($rowData, '<div class="progress" style="width:50px"><div class="progress-bar progress-bar-sm" style="width:' . $value->progress . '%;" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-percent="50"></div></div>');
                                      
                                         }  
                                 $country=str_replace(" ","-",$value->domain);
                                array_push($rowData,'<img style=" width:50px;" src="'. asset('flags/'.$country).'.png" >');
                                        
                                array_push($rowData, ' <a onclick="window.location.href=\'' . url('assignment/edit/' . $value->id) . '\'" class="btn btn-info">View</a>');
				array_push($jsonList, $rowData);
				$i++;
			}

		}
		
		return Response::json(array('data' => $jsonList));

	}
//kasun
	public function writercompleteprojectlist()
	{
            
		//$writercompletelimit = Assignment::where('assignto', $user->id)->where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
                $writercomplete =  Assignment::where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
               
		$user = Sentinel::getUser();
		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$data = Assignment::where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->get();
		}
		else{
			$data =Assignment::where('assignto', $user->id)->where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->get();
		}

		$jsonList = array();
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
			$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
			if (Sentinel::hasAnyAccess($permissions) || $user->id == $value->assignto ) {
				array_push($rowData, $i);
				array_push($rowData, $value->id);
				array_push($rowData, DATE($value->created_at));
				$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
                                 $writeruser = DB::table('users')->where('id', '=', $value->assignto)->get();
				if (Sentinel::hasAnyAccess($permissions)) {
					array_push($rowData, $value->studentName);
					if(isset($writeruser[0]->first_name)){
					array_push($rowData, $writeruser[0]->first_name.' '.$writeruser[0]->last_name);
					}else{
					array_push($rowData, ' ');
					}
					array_push($rowData, $value->phoneNo);
					array_push($rowData, $value->deadline);
					array_push($rowData, $value->writerDeadLine);
				}
				else {
					array_push($rowData, $value->writerDeadLine);
					array_push($rowData, $value->level);
                                        array_push($rowData, $value->topic);
				}
				array_push($rowData, $value->wordcount);
				if($value->studentAttachment !=""){
                                     $studentAttachment=explode(".",$value->studentAttachment);
					array_push($rowData, '<center> <a download="'.'studentAttachment_'.$value->id.'.'.$studentAttachment[1].'" href="' . asset('attachments/' . $value->id . '/' . $value->studentAttachment . '') . '" class="btn btn-primary btn-outline btn-round "><i class="fa fa-download"></i></a></center>');
			
					//array_push($rowData, '<center><a href="' . asset('attachments/' . $value->id . '/' . $value->studentAttachment . '') . '" class="btn btn-primary btn-outline btn-round "><i class="fa fa-download"></i></a></center>');
				}
				else{
					array_push($rowData, '<span> No Attachment</span>');
				}
				                                  
                                      if (Sentinel::hasAnyAccess($permissions)) {     
                                             array_push($rowData, $value->price);
                                         }
                                         else{
                                       array_push($rowData, '<div class="progress" style="width:50px"><div class="progress-bar progress-bar-sm" style="width:' . $value->progress . '%;" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-percent="50"></div></div>');
                                      
                                         }  
                                $country=str_replace(" ","-",$value->domain);
                                array_push($rowData,'<img style=" width:50px;" src="'. asset('flags/'.$country).'.png" >');
                               
                                array_push($rowData, ' <a onclick="window.location.href=\'' . url('assignment/edit/' . $value->id) . '\'" class="btn btn-info">View</a>');
				array_push($jsonList, $rowData);
				$i++;
			}

		}
		return Response::json(array('data' => $jsonList));

	}

        public function reviewingprojectlist()
	{
            
       		$user = Sentinel::getUser();
                
		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$data = Assignment::select()->Where('checking_status','=', 4)->get();
		}
		else{
			$data = Assignment::select()->Where('checking_status','=', 4)->where(function($q) {$user = Sentinel::getUser();$q->where('checking_writer',$user->id)->orWhere('assignto',$user->id);})->get();
		}

		$jsonList = array();
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
			$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
			if (Sentinel::hasAnyAccess($permissions) || $user->id == $value->checking_writer || $user->id == $value->assignto ) {
				array_push($rowData, $i);
				array_push($rowData, $value->id);
				array_push($rowData, DATE($value->created_at));
				$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
                                 $writeruser = DB::table('users')->where('id', '=', $value->assignto)->get();
                                  $rewriteruser = DB::table('users')->where('id', '=', $value->checking_writer)->get();
				if (Sentinel::hasAnyAccess($permissions)) {
					array_push($rowData, $value->studentName);
					if(isset($writeruser[0]->first_name)){
					array_push($rowData, $writeruser[0]->first_name.' '.$writeruser[0]->last_name);
					}else{
					array_push($rowData, ' ');
					}
					array_push($rowData, $value->phoneNo);
					array_push($rowData, $value->deadline);
					array_push($rowData, $value->writerDeadLine);
					if(isset($rewriteruser[0]->first_name)){
					array_push($rowData, $rewriteruser[0]->first_name.' '.$rewriteruser[0]->last_name);
					}else{
					array_push($rowData, ' ');
					}
				}
				else {
					array_push($rowData, $value->writerDeadLine);
					array_push($rowData, $value->level);
                                        array_push($rowData, $value->topic);
				}
				array_push($rowData, $value->wordcount);
				if($value->studentAttachment !=""){
                                     $studentAttachment=explode(".",$value->studentAttachment);
					array_push($rowData, '<center> <a download="'.'studentAttachment_'.$value->id.'.'.$studentAttachment[1].'" href="' . asset('attachments/' . $value->id . '/' . $value->studentAttachment . '') . '" class="btn btn-primary btn-outline btn-round "><i class="fa fa-download"></i></a></center>');
			
					//array_push($rowData, '<center><a href="' . asset('attachments/' . $value->id . '/' . $value->studentAttachment . '') . '" class="btn btn-primary btn-outline btn-round "><i class="fa fa-download"></i></a></center>');
				}
				else{
					array_push($rowData, '<span> No Attachment</span>');
				}
				                                  
                                      if (Sentinel::hasAnyAccess($permissions)) {     
                                             array_push($rowData, $value->price);
                                         }
                                         else{
                                       array_push($rowData, '<div class="progress" style="width:50px"><div class="progress-bar progress-bar-sm" style="width:' . $value->progress . '%;" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-percent="50"></div></div>');
                                      
                                         }      
                                $country=str_replace(" ","-",$value->domain);
                                array_push($rowData,'<img style=" width:50px;" src="'. asset('flags/'.$country).'.png" >');
                                        
                                array_push($rowData, ' <a onclick="window.location.href=\'' . url('assignment/edit/' . $value->id) . '\'" class="btn btn-info">View</a>');
				array_push($jsonList, $rowData);
				$i++;
			}

		}
		return Response::json(array('data' => $jsonList));

	}

         public function reviewedprojectlist()
	{
		$user = Sentinel::getUser();
		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$data = Assignment::select()->where('checking_status',3)->orwhere('checking_status',2)->orderBy('id', 'desc')->get();
		}
		else{
			$data =Assignment::select()->where('checking_status',3)->orwhere('checking_status',2)->where('checking_writer', $user->id)->orderBy('id', 'desc')->get();
		}

		$jsonList = array();
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
			$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
			if (Sentinel::hasAnyAccess($permissions) || $user->id == $value->checking_writer ) {
				array_push($rowData, $i);
				array_push($rowData, $value->id);
				array_push($rowData, DATE($value->created_at));
				$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
                                 $writeruser = DB::table('users')->where('id', '=', $value->assignto)->get();
                                 
                                  $rewriteruser = DB::table('users')->where('id', '=', $value->checking_writer)->get();
				if (Sentinel::hasAnyAccess($permissions)) {
					array_push($rowData, $value->studentName);
					if(isset($writeruser[0]->first_name)){
					array_push($rowData, $writeruser[0]->first_name.' '.$writeruser[0]->last_name);
					}else{
					array_push($rowData, ' ');
					}
					array_push($rowData, $value->phoneNo);
					array_push($rowData, $value->deadline);
					array_push($rowData, $value->writerDeadLine);
						if(isset($rewriteruser[0]->first_name)){
					array_push($rowData, $rewriteruser[0]->first_name.' '.$rewriteruser[0]->last_name);
					}else{
					array_push($rowData, ' ');
					}
				}
				else {
					array_push($rowData, $value->writerDeadLine);
					array_push($rowData, $value->level);
                                        array_push($rowData, $value->topic);
				}
				array_push($rowData, $value->wordcount);
				if($value->studentAttachment !=""){
                                        $studentAttachment=explode(".",$value->studentAttachment);
					array_push($rowData, '<center> <a download="'.'studentAttachment_'.$value->id.'.'.$studentAttachment[1].'" href="' . asset('attachments/' . $value->id . '/' . $value->studentAttachment . '') . '" class="btn btn-primary btn-outline btn-round "><i class="fa fa-download"></i></a></center>');
			
					//array_push($rowData, '<center><a href="' . asset('attachments/' . $value->id . '/' . $value->studentAttachment . '') . '" class="btn btn-primary btn-outline btn-round "><i class="fa fa-download"></i></a></center>');
				}
				else{
					array_push($rowData, '<span> No Attachment</span>');
				}
				                                  
                                      if (Sentinel::hasAnyAccess($permissions)) {     
                                             array_push($rowData, $value->price);
                                         }
                                         else{
                                       array_push($rowData, '<div class="progress" style="width:50px"><div class="progress-bar progress-bar-sm" style="width:' . $value->progress . '%;" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-percent="50"></div></div>');
                                      
                                         }   
                                $country=str_replace(" ","-",$value->domain);
                                array_push($rowData,'<img style=" width:50px;" src="'. asset('flags/'.$country).'.png" >');
                                        
                                array_push($rowData, ' <a onclick="window.location.href=\'' . url('assignment/edit/' . $value->id) . '\'" class="btn btn-info">View</a>');
				array_push($jsonList, $rowData);
				$i++;
			}

		}
		return Response::json(array('data' => $jsonList));

	}
	public function rejectedprojectlist()
	{
		$user = Sentinel::getUser();
		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$data = Assignment::select()->where('status',2)->orderBy('id', 'desc')->get();
		}
		else{
			$data =Assignment::select()->where('status',2)->where('assignto', $user->id)->orderBy('id', 'desc')->get();
		}

		$jsonList = array();
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
			$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
			if (Sentinel::hasAnyAccess($permissions) || $user->id == $value->assignto ) {
				array_push($rowData, $i);
				array_push($rowData, $value->id);
				array_push($rowData, DATE($value->created_at));

				$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
                                $writeruser = DB::table('users')->where('id', '=', $value->assignto)->get();
				if (Sentinel::hasAnyAccess($permissions)) {
					array_push($rowData, $value->studentName);
					if(isset($writeruser[0]->first_name)){
					array_push($rowData, $writeruser[0]->first_name.' '.$writeruser[0]->last_name);
					}else{
					array_push($rowData, ' ');
					}
					array_push($rowData, $value->phoneNo);
					array_push($rowData, $value->deadline);
					array_push($rowData, $value->writerDeadLine);
				}
				else {
					array_push($rowData, $value->writerDeadLine);
					array_push($rowData, $value->level);
                                        array_push($rowData, $value->topic);
				}
				array_push($rowData, $value->wordcount);
				if($value->studentAttachment !=""){
                                        $studentAttachment=explode(".",$value->studentAttachment);
					array_push($rowData, '<center> <a download="'.'studentAttachment_'.$value->id.'.'.$studentAttachment[1].'" href="' . asset('attachments/' . $value->id . '/' . $value->studentAttachment . '') . '" class="btn btn-primary btn-outline btn-round "><i class="fa fa-download"></i></a></center>');
			
					//array_push($rowData, '<center> <a href="' . asset('attachments/' . $value->id . '/' . $value->studentAttachment . '') . '" class="btn btn-primary btn-outline btn-round "><i class="fa fa-download"></i></a></center>');
				}
				else{
					array_push($rowData, '<span> No Attachment</span>');
				}
				                                
                                      if (Sentinel::hasAnyAccess($permissions)) {     
                                             array_push($rowData, $value->price);
                                         }
                                         else{
                                       array_push($rowData, '<div class="progress" style="width:50px"><div class="progress-bar progress-bar-sm" style="width:' . $value->progress . '%;" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-percent="50"></div></div>');
                                      
                                         }      
                                $country=str_replace(" ","-",$value->domain);
                                array_push($rowData,'<img style=" width:50px;" src="'. asset('flags/'.$country).'.png" >');
                                        
                                array_push($rowData, ' <a onclick="window.location.href=\'' . url('assignment/edit/' . $value->id) . '\'" class="btn btn-info">View</a>');
				array_push($jsonList, $rowData);
				$i++;
			}

		}
		return Response::json(array('data' => $jsonList));

	}
        
        public function reviewrejectedprojectlist()
	{
		$user = Sentinel::getUser();
		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$data = Assignment::select()->where('checking_status',2)->orderBy('id', 'desc')->get();
		}
		else{
			$data =Assignment::select()->where('checking_status',2)->where('assignto', $user->id)->orderBy('id', 'desc')->get();
		}

		$jsonList = array();
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
			$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
			if (Sentinel::hasAnyAccess($permissions) || $user->id == $value->assignto ) {
				array_push($rowData, $i);
				array_push($rowData, $value->id);
				array_push($rowData, DATE($value->created_at));

				$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
                                $writeruser = DB::table('users')->where('id', '=', $value->assignto)->get();
				if (Sentinel::hasAnyAccess($permissions)) {
					array_push($rowData, $value->studentName);
					if(isset($writeruser[0]->first_name)){
					array_push($rowData, $writeruser[0]->first_name.' '.$writeruser[0]->last_name);
					}else{
					array_push($rowData, ' ');
					}
					array_push($rowData, $value->phoneNo);
					array_push($rowData, $value->deadline);
					array_push($rowData, $value->writerDeadLine);
				}
				else {
					array_push($rowData, $value->writerDeadLine);
					array_push($rowData, $value->level);
                                        array_push($rowData, $value->topic);
				}
				array_push($rowData, $value->wordcount);
				if($value->studentAttachment !=""){
                                        $studentAttachment=explode(".",$value->studentAttachment);
					array_push($rowData, '<center> <a download="'.'studentAttachment_'.$value->id.'.'.$studentAttachment[1].'" href="' . asset('attachments/' . $value->id . '/' . $value->studentAttachment . '') . '" class="btn btn-primary btn-outline btn-round "><i class="fa fa-download"></i></a></center>');
			
					//array_push($rowData, '<center> <a href="' . asset('attachments/' . $value->id . '/' . $value->studentAttachment . '') . '" class="btn btn-primary btn-outline btn-round "><i class="fa fa-download"></i></a></center>');
				}
				else{
					array_push($rowData, '<span> No Attachment</span>');
				}
				                                
                                      if (Sentinel::hasAnyAccess($permissions)) {     
                                             array_push($rowData, $value->price);
                                         }
                                         else{
                                       array_push($rowData, '<div class="progress" style="width:50px"><div class="progress-bar progress-bar-sm" style="width:' . $value->progress . '%;" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-percent="50"></div></div>');
                                      
                                         }
                                 $country=str_replace(" ","-",$value->domain);
                                array_push($rowData,'<img style=" width:50px;" src="'. asset('flags/'.$country).'.png" >');
                                        
                                array_push($rowData, ' <a onclick="window.location.href=\'' . url('assignment/edit/' . $value->id) . '\'" class="btn btn-info">View</a>');
				array_push($jsonList, $rowData);
				$i++;
			}

		}
		return Response::json(array('data' => $jsonList));

	}

        public function writerrejectedprojectlist()
	{
		$user = Sentinel::getUser();
		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$data = Assignment::select()->where('writer_reject',1)->orderBy('id', 'desc')->get();
		}
		else{
			$data =Assignment::select()->where('writer_reject',1)->where('assignto', $user->id)->orderBy('id', 'desc')->get();
		}

		$jsonList = array();
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
			$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
			if (Sentinel::hasAnyAccess($permissions) || $user->id == $value->assignto ) {
				array_push($rowData, $i);
				array_push($rowData, $value->id);
				array_push($rowData, DATE($value->created_at));

				$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
                                $writeruser = DB::table('users')->where('id', '=', $value->assignto)->get();
				if (Sentinel::hasAnyAccess($permissions)) {
					array_push($rowData, $value->studentName);
					if(isset($writeruser[0]->first_name)){
					array_push($rowData, $writeruser[0]->first_name.' '.$writeruser[0]->last_name);
					}else{
					array_push($rowData, ' ');
					}
					array_push($rowData, $value->phoneNo);
					array_push($rowData, $value->deadline);
					array_push($rowData, $value->writerDeadLine);
				}
				else {
					array_push($rowData, $value->writerDeadLine);
					array_push($rowData, $value->level);
                                        array_push($rowData, $value->topic);
				}
				array_push($rowData, $value->wordcount);
				if($value->studentAttachment !=""){
                                        $studentAttachment=explode(".",$value->studentAttachment);
					array_push($rowData, '<center> <a download="'.'studentAttachment_'.$value->id.'.'.$studentAttachment[1].'" href="' . asset('attachments/' . $value->id . '/' . $value->studentAttachment . '') . '" class="btn btn-primary btn-outline btn-round "><i class="fa fa-download"></i></a></center>');
			
					//array_push($rowData, '<center> <a href="' . asset('attachments/' . $value->id . '/' . $value->studentAttachment . '') . '" class="btn btn-primary btn-outline btn-round "><i class="fa fa-download"></i></a></center>');
				}
				else{
					array_push($rowData, '<span> No Attachment</span>');
				}
				                                
                                      if (Sentinel::hasAnyAccess($permissions)) {     
                                             array_push($rowData, $value->price);
                                         }
                                         else{
                                       array_push($rowData, '<div class="progress" style="width:50px"><div class="progress-bar progress-bar-sm" style="width:' . $value->progress . '%;" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-percent="50"></div></div>');
                                      
                                         }
                                 $country=str_replace(" ","-",$value->domain);
                                array_push($rowData,'<img style=" width:50px;" src="'. asset('flags/'.$country).'.png" >');
                                        
                                array_push($rowData, ' <a onclick="window.location.href=\'' . url('assignment/edit/' . $value->id) . '\'" class="btn btn-info">View</a>');
				array_push($jsonList, $rowData);
				$i++;
			}

		}
		return Response::json(array('data' => $jsonList));

	}
        
	public function assignedprojectlist()
	{
		$user = Sentinel::getUser();
		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$data = Assignment::select()->where('status', 0 )->where('assignto','>','0')->orderBy('id', 'desc')->get();
		}
		else{
			$data = Assignment::select()->where('status', 0 )->where('assignto','>','0')->where('assignto', $user->id)->orderBy('id', 'desc')->get();
		}

		$jsonList = array();
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
			$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
			if (Sentinel::hasAnyAccess($permissions) || $user->id == $value->assignto ) {
				array_push($rowData, $i);
				array_push($rowData, $value->id);
				array_push($rowData, DATE($value->created_at));
                                
                             
                                $writeruser = DB::table('users')->where('id', '=', $value->assignto)->get();
                                
				$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
                               
				if (Sentinel::hasAnyAccess($permissions)) {
					array_push($rowData, $value->studentName);
					if(isset($writeruser[0]->first_name)){
					array_push($rowData, $writeruser[0]->first_name.' '.$writeruser[0]->last_name);
					}else{
					array_push($rowData, ' ');
					}
					array_push($rowData, $value->phoneNo);
					array_push($rowData, $value->deadline);
					array_push($rowData, $value->writerDeadLine);
				}
				else {
					array_push($rowData, $value->writerDeadLine);
					array_push($rowData, $value->level);
                                        array_push($rowData, $value->topic);
				}
				array_push($rowData, $value->wordcount);
				if($value->studentAttachment !=""){
                                        $studentAttachment=explode(".",$value->studentAttachment);
					array_push($rowData, '<center> <a download="'.'studentAttachment_'.$value->id.'.'.$studentAttachment[1].'" href="' . asset('attachments/' . $value->id . '/' . $value->studentAttachment . '') . '" class="btn btn-primary btn-outline btn-round "><i class="fa fa-download"></i></a></center>');
			
					//array_push($rowData, '<center> <a href="' . asset('attachments/' . $value->id . '/' . $value->studentAttachment . '') . '" class="btn btn-primary btn-outline btn-round "><i class="fa fa-download"></i></a></center>');
				}
				else{
					array_push($rowData, '<span> No Attachment</span>');
				}
                                         if (Sentinel::hasAnyAccess($permissions)) {     
                                             array_push($rowData, $value->price);
                                         }
                                         else{
                                            array_push($rowData, '<div class="progress" style="width:50px"><div class="progress-bar progress-bar-sm" style="width:' . $value->progress . '%;" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-percent="50"></div></div>');
                                         }
                                 $country=str_replace(" ","-",$value->domain);
                                array_push($rowData,'<img style=" width:50px;" src="'. asset('flags/'.$country).'.png" >');
                                        
                                array_push($rowData, ' <a onclick="window.location.href=\'' . url('assignment/edit/' . $value->id) . '\'" class="btn btn-info">View</a>');
				array_push($jsonList, $rowData);
				$i++;
			}

		}
		return Response::json(array('data' => $jsonList));

	}

	public function reportdate()
	{


		$user = DB::table('users')->join('role_users', 'role_users.user_id', '=', 'users.id')->where('role_users.role_id','9')->lists('users.username','users.id');
		$hasAcess=0;
		$allpending = Assignment::select()->where('status', 0)->where('assignto', '0')->count();
		$allreject = Assignment::select()->where('status',2)->count();
		$allcomplete = Assignment::select()->where('status', 3 )->count();
		$allrun = Assignment::select()->where('status', 1 )->count();
		$allassigned = Assignment::select()->where('status', 0 )->where('assignto','>','0')->count();

		//$writercompletelimit = Assignment::where('assignto', $user->id)->where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
                $writercomplete =  Assignment::where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
               
                //$limitreviewpending = Assignment::select()->Where('checking_writer','!=', 0)->Where('checking_status','=', 0)->Where('checking_writer', $user->id)->count();
                $reviewpending = Assignment::select()->Where('checking_status','=', 4)->count();
                
                
                //$limitreviewed = Assignment::select()->Where('checking_status', 3)->orWhere('checking_status', 2)->Where('checking_writer', $user->id)->count();
                $reviewed = Assignment::select()->Where('checking_status', 3)->orWhere('checking_status', 2)->count();
                
                
                

		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$hasAcess=1;
		}
		return view('reportDate')->with([
			'userList' => $user,
			'allpending' => $allpending,
			'allreject'=> $allreject,
			'allcomplete'=>$allcomplete,
			'allrun'=>$allrun,
			'allassigned'=>$allassigned,
                        'reviewed'=>  $reviewed ,
                        'reviewpending'=>$reviewpending,
			'hasAcess'=>$hasAcess,
			'writercomplete'=>$writercomplete
		]);
	}

	public function jsondate($id,$from,$to)
	{
	
		if($id=='default'){
			$data = Assignment::select()->where('status', 3)->whereBetween('completeDate', [$from.' 00:00:00', $to.' 23:59:59'])->orderBy('id', 'desc')->get();
		}
		else{
		$data = Assignment::select()->where('assignto', $id)->where('status', 3)->whereBetween('completeDate', [$from.' 00:00:00', $to.' 23:59:59'])->orderBy('id', 'desc')->get();
		}
		$jsonList = array();
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
			
			 $writeruser = DB::table('users')->where('id', '=', $value->assignto)->get();
			
			array_push($rowData, $i);
			array_push($rowData, $value->id);
			if(isset($writeruser[0]->first_name)){
			array_push($rowData, $writeruser[0]->first_name.' '.$writeruser[0]->last_name);
			}else{
			array_push($rowData, ' ');
			}
			array_push($rowData, $value->level);
			array_push($rowData, $value->wordcount);
			array_push($rowData, DATE($value->created_at));
			array_push($rowData, DATE($value->completeDate));
			array_push($rowData, $value->studentName);
			array_push($rowData, $value->email);
                        array_push($rowData, $value->phoneNo);
			array_push($rowData, $value->topic);
			array_push($rowData, $value->price);
			
			

			
			/*if($value->status ==0  && $value->assignto ==0){
				array_push($rowData, '<span style="color: blue;">New Project</span>');
			}
			elseif($value->status ==0 && $value->assignto !=0){
				array_push($rowData, '<span style="color: orangered;">Assigned</span>');
			}
			elseif($value->status ==1){
				array_push($rowData, '<span style="color: purple;">Runing</span>');
			}
			elseif($value->status ==4){
				array_push($rowData, '<span style="color: #ad9a12;">Waiting for Complete</span>');
			}
			elseif($value->status ==3){
				array_push($rowData, '<span style="color: green;">Completed</span>');
			}
			elseif($value->status ==2){
				array_push($rowData, '<span style="color: red;">Rejected</span>');
			}
*/
			array_push($rowData, ' <a onclick="window.location.href=\'' . url('assignment/edit/' . $value->id) . '\'" class="btn btn-info">View</a>');
			array_push($jsonList, $rowData);
			$i++;


		}
		return Response::json(array('data' => $jsonList));

	}
        
        public function jsondateReview($id,$from,$to)
	{
	
		if($id=='default'){
			$data = DB::table('review_writers')->whereBetween('added_date', [$from.' 00:00:00', $to.' 23:59:59'])->orderBy('id', 'desc')->get();
		}
		else{
                        $data = DB::table('review_writers')->where('writer_id', $id)->whereBetween('added_date', [$from.' 00:00:00', $to.' 23:59:59'])->orderBy('id', 'desc')->get();
		}
		$jsonList = array();
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
			
                            $writeruser = DB::table('users')->where('id', '=', $value->writer_id)->get();                         
                            $assignment = DB::table('assignment_request')->where('id', '=', $value->assigmnet_id)->get();
                            $revievedDetail = DB::table('review_history')->where('addedby', '=', $value->writer_id)->where('assignment', '=', $value->assigmnet_id)->get();  
                        
                            if(sizeof($revievedDetail) >0){
                                $redate=$revievedDetail[0]->add_date;
                            }
                            else{
                                 $redate='';
                            }
			array_push($rowData, $i);
			array_push($rowData, $value->id);
			if(isset($writeruser[0]->first_name)){
			array_push($rowData, $writeruser[0]->first_name.' '.$writeruser[0]->last_name);
			}else{
			array_push($rowData, ' ');
			}
                      
                        array_push($rowData, $value->added_date);
			array_push($rowData, $redate);
                        array_push($rowData, $assignment[0]->level);
			array_push($rowData, $assignment[0]->wordcount);
			
			
			

			
			/*if($value->status ==0  && $value->assignto ==0){
				array_push($rowData, '<span style="color: blue;">New Project</span>');
			}
			elseif($value->status ==0 && $value->assignto !=0){
				array_push($rowData, '<span style="color: orangered;">Assigned</span>');
			}
			elseif($value->status ==1){
				array_push($rowData, '<span style="color: purple;">Runing</span>');
			}
			elseif($value->status ==4){
				array_push($rowData, '<span style="color: #ad9a12;">Waiting for Complete</span>');
			}
			elseif($value->status ==3){
				array_push($rowData, '<span style="color: green;">Completed</span>');
			}
			elseif($value->status ==2){
				array_push($rowData, '<span style="color: red;">Rejected</span>');
			}
*/
			array_push($rowData, ' <a onclick="window.location.href=\'' . url('assignment/edit/' . $assignment[0]->id) . '\'" class="btn btn-info">View</a>');
			array_push($jsonList, $rowData);
			$i++;


		}
		return Response::json(array('data' => $jsonList));

	}
        
        
        
	
	 public function payhere()
	{		
            return view('payhere');		
	}
        
         public function oder()	{		
             
                $id=$_GET['id'];	            
		$data = Assignment::select()->where('id', $id)->orderBy('id', 'desc')->get();		
		$jsonList = array();
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
                        
                        $price=$value->price - $value->advance; 
			array_push($rowData, $i);
                        
			array_push($rowData, $value->id);
			array_push($rowData, DATE($value->created_at));
			array_push($rowData, $value->studentName);
			array_push($rowData, $value->email);
			array_push($rowData, $value->phoneNo);
			array_push($rowData, $value->wordcount);
                        array_push($rowData, $value->topic);
                        array_push($rowData, $price);
			array_push($jsonList, $rowData);
			$i++;


		}
		return Response::json($jsonList);
	}
        
        
          public function writerpaymentview()
	{
		$user = Sentinel::getUser();
		$hasAcess=0;
		$allpending = Assignment::select()->where('status', 0)->where('assignto', '0')->count();
		$allreject = Assignment::select()->where('writer_reject',1)->count();
		$allcomplete = Assignment::select()->where('status', 3 )->count();
		$allrun = Assignment::select()->where('status', 1 )->count();

		$allassigned = Assignment::select()->where('status', 0 )->where('assignto','>','0')->count();

		$limitpending = Assignment::select()->where('status', 0)->where('assignto', $user->id)->count();
		$limitreject = Assignment::select()->where('writer_reject',1)->where('assignto', $user->id)->count();
		$limitcomplete = Assignment::select()->where('status', 3 )->where('assignto', $user->id)->count();
		$limitrun = Assignment::select()->where('status', 1 )->where('assignto', $user->id)->count();

		$writercompletelimit = Assignment::where('assignto', $user->id)->where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
                $writercomplete =  Assignment::where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
                 
                $limitreviewpending = Assignment::select()->Where('checking_status','=', 4)->where(function($q) {$user = Sentinel::getUser();$q->where('checking_writer',$user->id)->orWhere('assignto',$user->id);})->count();
                $reviewpending = Assignment::select()->Where('checking_status','=', 4)->count();
                
                
              
                $limitreviewed = Assignment::where('checking_writer', $user->id)->where(function($q) {$q->where('checking_status',2)->orWhere('checking_status',3);})->count();
                $reviewed = Assignment::select()->Where('checking_status', 3)->orWhere('checking_status', 2)->count();
                

		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$hasAcess=1;
		}

    	return view('writerPayment')->with([
			'allpending' => $allpending,
			'allreject'=> $allreject,
			'allcomplete'=>$allcomplete,
			'allrun'=>$allrun,
			'limitpending'=>$limitpending,
			'limitreject'=>$limitreject,
			'limitcomplete'=>$limitcomplete,
                        'limitreviewpending'=>$limitreviewpending,
                        'limitreviewed'=>  $limitreviewed ,
                        'reviewed'=>  $reviewed ,
                        'reviewpending'=>$reviewpending,
			'limitrun'=>$limitrun,
			'allassigned'=>$allassigned,
			'hasAcess'=>$hasAcess,
			'writercomplete'=>$writercomplete,
			'writercompletelimit'=>$writercompletelimit
		]);
		//return $limitpending;
	}
           public function rewriterpaymentview()
	{
		$user = Sentinel::getUser();
		$hasAcess=0;
		$allpending = Assignment::select()->where('status', 0)->where('assignto', '0')->count();
		$allreject = Assignment::select()->where('writer_reject',1)->count();
		$allcomplete = Assignment::select()->where('status', 3 )->count();
		$allrun = Assignment::select()->where('status', 1 )->count();

		$allassigned = Assignment::select()->where('status', 0 )->where('assignto','>','0')->count();

		$limitpending = Assignment::select()->where('status', 0)->where('assignto', $user->id)->count();
		$limitreject = Assignment::select()->where('writer_reject',1)->where('assignto', $user->id)->count();
		$limitcomplete = Assignment::select()->where('status', 3 )->where('assignto', $user->id)->count();
		$limitrun = Assignment::select()->where('status', 1 )->where('assignto', $user->id)->count();

		$writercompletelimit = Assignment::where('assignto', $user->id)->where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
                $writercomplete =  Assignment::where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
                
                 $limitreviewpending = Assignment::select()->Where('checking_status','=', 4)->where(function($q) {$user = Sentinel::getUser();$q->where('checking_writer',$user->id)->orWhere('assignto',$user->id);})->count();
                $reviewpending = Assignment::select()->Where('checking_status','=', 4)->count();
                
                
               
                $limitreviewed = Assignment::where('checking_writer', $user->id)->where(function($q) {$q->where('checking_status',2)->orWhere('checking_status',3);})->count();
                $reviewed = Assignment::select()->Where('checking_status', 3)->orWhere('checking_status', 2)->count();
                
 

		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$hasAcess=1;
		}

    	return view('writerPaymentReviewing')->with([
			'allpending' => $allpending,
			'allreject'=> $allreject,
			'allcomplete'=>$allcomplete,
			'allrun'=>$allrun,
			'limitpending'=>$limitpending,
			'limitreject'=>$limitreject,
			'limitcomplete'=>$limitcomplete,
                        'limitreviewpending'=>$limitreviewpending,
                        'limitreviewed'=>  $limitreviewed ,
                        'reviewed'=>  $reviewed ,
                        'reviewpending'=>$reviewpending,
			'limitrun'=>$limitrun,
			'allassigned'=>$allassigned,
			'hasAcess'=>$hasAcess,
			'writercomplete'=>$writercomplete,
			'writercompletelimit'=>$writercompletelimit
		]);
		//return $limitpending;
	}
        public function studentpaymentview()
	{
		$user = Sentinel::getUser();
		$hasAcess=0;
		$allpending = Assignment::select()->where('status', 0)->where('assignto', '0')->count();
		$allreject = Assignment::select()->where('writer_reject',1)->count();
		$allcomplete = Assignment::select()->where('status', 3 )->count();
		$allrun = Assignment::select()->where('status', 1 )->count();

		$allassigned = Assignment::select()->where('status', 0 )->where('assignto','>','0')->count();

		$limitpending = Assignment::select()->where('status', 0)->where('assignto', $user->id)->count();
		$limitreject = Assignment::select()->where('writer_reject',1)->where('assignto', $user->id)->count();
		$limitcomplete = Assignment::select()->where('status', 3 )->where('assignto', $user->id)->count();
		$limitrun = Assignment::select()->where('status', 1 )->where('assignto', $user->id)->count();

		$writercompletelimit = Assignment::where('assignto', $user->id)->where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
                $writercomplete =  Assignment::where('status', 4 )->where(function($q) {$q->where('checking_status',0)->orWhere('checking_status',2)->orWhere('checking_status',3);})->count();
               
                $limitreviewpending = Assignment::select()->Where('checking_status','=', 4)->where(function($q) {$user = Sentinel::getUser();$q->where('checking_writer',$user->id)->orWhere('assignto',$user->id);})->count();
                $reviewpending = Assignment::select()->Where('checking_status','=', 4)->count();
                
                
                
                $limitreviewed = Assignment::where('checking_writer', $user->id)->where(function($q) {$q->where('checking_status',2)->orWhere('checking_status',3);})->count();
                $reviewed = Assignment::select()->Where('checking_status', 3)->orWhere('checking_status', 2)->count();
                
 

		$permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$hasAcess=1;
		}

    	return view('studentPayments')->with([
			'allpending' => $allpending,
			'allreject'=> $allreject,
			'allcomplete'=>$allcomplete,
			'allrun'=>$allrun,
			'limitpending'=>$limitpending,
			'limitreject'=>$limitreject,
			'limitcomplete'=>$limitcomplete,
                        'limitreviewpending'=>$limitreviewpending,
                        'limitreviewed'=>  $limitreviewed ,
                        'reviewed'=>  $reviewed ,
                        'reviewpending'=>$reviewpending,
			'limitrun'=>$limitrun,
			'allassigned'=>$allassigned,
			'hasAcess'=>$hasAcess,
			'writercomplete'=>$writercomplete,
			'writercompletelimit'=>$writercompletelimit
		]);
		//return $limitpending;
	}
        
        
        public function jsonListwriterpayview($id)
	{
                $users=Sentinel::getUser();     
                $jsonList = array();
                $hasAcess=0;
                $permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$hasAcess=1;
		}
               
                
//               if($id !=0){
//                
//                $assignement =  Assignment::find($id);
//		$writer=$assignement->assignto;
//                $assignementId=$assignement->id;
//                $jsonList = array();
//		$user = DB::table('users')->where('id','=', $writer)->get(); 
//                    if(sizeof($user) > 0){
//                        $user=$user;
//                    }
//                    else{
//                        $user=array();
//                    }
                if($id !=0){
                    if($hasAcess ==1){
                        $data = DB::table('payment_records')->join('users', 'users.id', '=', 'payment_records.pay_to')->where('payment_records.payment_type','=',1)->where('payment_records.assignment_id','=',$id)->get();
                    }
                    else{
                        $data = DB::table('payment_records')->join('users', 'users.id', '=', 'payment_records.pay_to')->where('payment_records.payment_type','=',1)->where('payment_records.assignment_id','=',$id)->where('users.id','=',$users->id)->get();
                    }
                }else{       
                    
                    if($hasAcess ==1){
                        $data = DB::table('payment_records')->join('users', 'users.id', '=', 'payment_records.pay_to')->where('payment_records.payment_type','=',1)->get();
                    }
                    else{
                       $data = DB::table('payment_records')->join('users', 'users.id', '=', 'payment_records.pay_to')->where('payment_records.payment_type','=',1)->where('users.id','=',$users->id)->get();
                    }
                    
                }
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
			array_push($rowData,$i);
                        array_push($rowData,$value->assignment_id);
			array_push($rowData,$value->username);
			array_push($rowData,$value-> amount );
			array_push($rowData,DATE($value->payment_date));
                        if($value->confermstatus == 1){ 
                            array_push($rowData,'<span style="color:green">confirmed</span>');
                        }
                        else{ 
                            array_push($rowData,'<span style="color:red">not confirmed</span>');
                              
                        }
                        array_push($rowData,DATE($value->confermstatusDate));
                        
                        array_push($jsonList, $rowData);
			$i++;

		}
                return Response::json(array('data' => $jsonList));
               

	}
        
        public function jsonListrewriterpayview($id)
	{
                $users=Sentinel::getUser();     
                $jsonList = array();
                $hasAcess=0;
                $permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$hasAcess=1;
		}
               
                
//               if($id !=0){
//                
//                $assignement =  Assignment::find($id);
//		$writer=$assignement->assignto;
//                $assignementId=$assignement->id;
//                $jsonList = array();
//		$user = DB::table('users')->where('id','=', $writer)->get(); 
//                    if(sizeof($user) > 0){
//                        $user=$user;
//                    }
//                    else{
//                        $user=array();
//                    }
                if($id !=0){
                    if($hasAcess ==1){
                        $data = DB::table('payment_records')->join('users', 'users.id', '=', 'payment_records.pay_to')->where('payment_records.payment_type','=',2)->where('payment_records.assignment_id','=',$id)->get();
                    }
                    else{
                        $data = DB::table('payment_records')->join('users', 'users.id', '=', 'payment_records.pay_to')->where('payment_records.payment_type','=',2)->where('payment_records.assignment_id','=',$id)->where('users.id','=',$users->id)->get();
                    }
                }else{       
                    
                    if($hasAcess ==1){
                        $data = DB::table('payment_records')->join('users', 'users.id', '=', 'payment_records.pay_to')->where('payment_records.payment_type','=',2)->get();
                    }
                    else{
                       $data = DB::table('payment_records')->join('users', 'users.id', '=', 'payment_records.pay_to')->where('payment_records.payment_type','=',2)->where('users.id','=',$users->id)->get();
                    }
                    
                }
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
			array_push($rowData,$i);
                        array_push($rowData,$value->assignment_id);
			array_push($rowData,$value->username);
			array_push($rowData,$value-> amount );
			array_push($rowData,DATE($value->payment_date));
                        if($value->confermstatus == 1){ 
                            array_push($rowData,'<span style="color:green">confirmed</span>');
                        }
                        else{ 
                            array_push($rowData,'<span style="color:red">not confirmed</span>');
                              
                        }
                        array_push($rowData,DATE($value->confermstatusDate));
                        
                        array_push($jsonList, $rowData);
			$i++;

		}
                return Response::json(array('data' => $jsonList));
               

	}
        
              public function jsonListstudentpayview($id)
	{
                $users=Sentinel::getUser();     
                $jsonList = array();
                $hasAcess=0;
                $permissions = Permission::whereIn('name', ['all.assignment.access'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions)){
			$hasAcess=1;
		}
               
                
//               if($id !=0){
//                
//                $assignement =  Assignment::find($id);
//		$writer=$assignement->assignto;
//                $assignementId=$assignement->id;
//                $jsonList = array();
//		$user = DB::table('users')->where('id','=', $writer)->get(); 
//                    if(sizeof($user) > 0){
//                        $user=$user;
//                    }
//                    else{
//                        $user=array();
//                    }
                if($id !=0){
                    $data = DB::table('student_payment_records')->where('student_payment_records.assignment_id','=',$id)->get();
            
                }else{     
                    $data = DB::table('student_payment_records')->get();               
                }
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
			array_push($rowData,$i);
                        array_push($rowData,$value->assignment_id);			
			array_push($rowData,$value-> amount );
			array_push($rowData,DATE($value->payment_date));
                    
                        
                        array_push($jsonList, $rowData);
			$i++;

		}
                return Response::json(array('data' => $jsonList));
               

	}

}
