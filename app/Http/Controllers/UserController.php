<?php

    namespace App\Http\Controllers;

    use App\Models\Group;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Log;

    class UserController extends Controller
    {
        public function show(Request $request)
        {
            if ($request->expectsJson()) {
                //if ($request->wantsJson()) {
                //if ($request->ajax()) {
                //if ($request->route()->getPrefix() === 'api') {
                return response()->json(User::with('group')->get());
            } else {
                return view('user-list', [
                    'users' => User::with('group')->get(),
                    'groups' => Group::all()
                ]);
            }
        }

        public function add(Request $request)
        {
            User::create($request->except('_token'));
            return response()->json($request);
        }

        public function remove(Request $request, $id)
        {
            Log::info("wsefiuh");
            $user = User::find($id);
            $rowsAmount = $user?->delete();
            return response()->json([
                'status'       => !is_null($user) ? 'OK' : "no records found for primary value {$id}",
                'affectedRows' => $rowsAmount
            ], !is_null($user) ? 200 : 400);
        }

        public function detail(Request $request, $id)
        {
            $user = User::find($id);
            //$rowsAmount = $user?->delete();
            return response()->json([
                'status' => !is_null($user) ? 'OK' : "no records found for primary value {$id}",
                'record' => $user
            ], !is_null($user) ? 200 : 400);
        }

        public function edit(Request $request, $id)
        {
            $user = User::where('ID', $id);
            $user->update($request->except('_token'));
            //$user->touch();
            //$user->save();

            //$rowsAmount = $user?->delete();
            return response()->json([
                'status' => !is_null($user) ? 'OK' : "no records found for primary value {$id}",
                'record' => $user->get()
            ], !is_null($user) ? 200 : 400);
        }
    }
