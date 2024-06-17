<?

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all(); // Or use pagination: User::paginate(10);
        return view('admin.index', compact('users'));
    }

    public function assignRole(Request $request, User $user)
    {
      $request->validate([
        'role' => 'required'
      ]);
    
      $user->assignRole($request->role); // Assign the requested role
    
      return redirect()->route('admin.index')->with('success', 'Role assigned successfully');
    }
}    
