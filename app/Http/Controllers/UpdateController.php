<?php

namespace App\Http\Controllers;

use App\Application;
use App\Http\Middleware\RedirectIfNoUpdateAvailable;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Install\UpdateRequirement;
use App\Install\Requirement;


class UpdateController extends Controller
{

    public function __construct()
    {
//        Debugbar::disable();
        $this->middleware(RedirectIfNoUpdateAvailable::class);
    }


    public function start(UpdateRequirement $requirement){
        $updateFile = File::get(base_path('update'));
        if ($updateFile) {
            $updateVersion = 'v' . $updateFile;
        } else {
            $updateVersion = null;
        }

        $extensionSatisfied = true;
        foreach ($requirement->extensions() as $label => $satisfied) {
            if (!$satisfied) {
                $extensionSatisfied = false;
                break;
            }
        }

        $permissionSatisfied = true;
        foreach ($requirement->directories() as $label => $satisfied) {
            if (!$satisfied) {
                $permissionSatisfied = false;
                break;
            }
        }


        $account_info = Application::all()->first();
        return view('install.update',[
            'account_info'=>$account_info,
            'updateVersion' => $updateVersion,
            'extensionSatisfied' => $extensionSatisfied,
            'permissionSatisfied' => $permissionSatisfied,
            'requirement' => $requirement,
        ]);
    }

    public function update(Request $request){


        $admin = User::where('id', '1')->first();
        $hashedPassword = $admin->password;

        if (!Hash::check($request->password, $hashedPassword)) {
            return back()->with("MSG","Access Denied, Your Admin password is incorrect")->with("TYPE", "danger");

        }
        else {
            $start_time = microtime(true);
            $start_time2 = microtime(true);
            sleep(15); //manual delay


            Artisan::call('migrate', [
                '--force' => true,
            ]);
            Artisan::call('db:seed');

            Artisan::call('cache:clear');
            Artisan::call('view:clear');

            //delete update file
            unlink(base_path('update'));

            return Redirect::route( "login" );
        }
    }


}
