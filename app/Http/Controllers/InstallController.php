<?php

namespace App\Http\Controllers;


use App\Http\Middleware\RedirectIfInstalled;
use App\Http\Requests\InstallRequest;
use App\Install\AdminAccount;
use App\Install\App;
use App\Install\ApplicationInfo;
use App\Install\Database;
use App\Install\Requirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Support\Facades\DB;
use Exception;

class InstallController extends Controller
{
    public function __construct()
    {
//        Debugbar::disable();
        $this->middleware(RedirectIfInstalled::class);
    }

    public function install(Requirement $requirement)
    {
        return view('install.installation', compact('requirement'));
    }



    public function dbsettings(Requirement $requirement){
        if (!$requirement->satisfied()) {
            return redirect('install/installation');
        }

        return view('install.dbsettings', compact('requirement'));
    }


    public function postDatabase(
        InstallRequest $request,
        AdminAccount $admin,
        ApplicationInfo $appinfo,
        Database $database,
        App $app,
        Factory $cache
    ) {
        set_time_limit(3000);

        try {

            try {
                $database->setup($request->db);

            } catch (\PDOException $pe) {
                return back()->withInput()
                    ->with('error', $pe->getMessage());
            }

            $admin->setup($request->admin);
            $appinfo->setup($request->appinfo, $cache);
            $app->setup();
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with(['message' => $e->getMessage()]);
        }
        return redirect('install/completed');
    }


}
