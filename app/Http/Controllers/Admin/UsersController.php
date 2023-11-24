<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UsersController extends Controller
{
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function index(Request $request) {  // 11.23
        $all_users = $this->user->withTrashed()->latest()->paginate(5); // 表示数調整！
        // withTrashed() to include the soft deleted records in query result
        // $all_users = $this->user->where('name', 'like', '%'.$request->search.'%')->withTrashed()->paginate(5);
    if ($request->search){
        //$all_users = $this->user->where('name', 'like', '%'.$request->search.'%')->get();
        $all_users = $this->user->where('name', 'like', '%'.$request->search.'%')->withTrashed()->paginate(5)->appends(['search' => $request->search]);
    }

        return view('admin.users.index')->with('all_users', $all_users)
                                        ->with('search', $request->search);
    }

    // PAGINATION - is the process of dividing a large set of data into pages
    // paginate() method to automatically handles the 'limit' and "offset" parameters based on the users current page

    // SOFT DELETE 11.16 - does not remove the model from the database; instead it adds a timestamps value to 'deleted_at' column データベースは消さない。表面上から隠される。

    public function deactivate($id) {
        $this->user->destroy($id);
        return redirect()->back();
    }

    public function activate($id) {
        $this->user->onlyTrashed()->findOrFail($id)->restore();
        // onlyTrashed() to retrieve soft-deleted records
        // restore() to 'un-delete' a soft deleted model. You can use the restore(). To set the 'deleted_at' column to NULL.

        return redirect()->back();
        
    }
}
