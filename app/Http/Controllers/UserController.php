<?php

namespace App\Http\Controllers;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function updateFavorites(Request $request) {
        $user = Auth::user();
        $used_column = "";
        $favorites = DB::select('select favorite_1, favorite_2, favorite_3, favorite_4, favorite_5 from users where id=' . $user->id);
        if(empty($favorites[0]->favorite_1)) {
            $used_column = "favorite_1";
        } else if (empty($favorites[0]->favorite_2)) {
            $used_column = "favorite_2";
        } else if (empty($favorites[0]->favorite_3)) {
            $used_column = "favorite_3";
        } else if (empty($favorites[0]->favorite_4)) {
            $used_column = "favorite_4";
        } else if (empty($favorites[0]->favorite_5)) {
            $used_column = "favorite_5";
        }
        if ($used_column == "") {
            print_r("g");
            return Redirect::back()->withErrors(['msg' => 'You have reached the maximum amount of favorites! Please remove one first before adding one']);
        } else {
            DB::table('users')
                ->where('id', $user->id)
                ->update([$used_column => $request->get('symbol')]);
            return redirect("/");
            /*return redirect()->back();*/
        }
    }

    public function removeFavorite(Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        $used_column = "";
        $favorites = DB::select('select favorite_1, favorite_2, favorite_3, favorite_4, favorite_5 from users where id=' . $user->id);
        if($favorites[0]->favorite_1 == $request->get('symbol')) {
            $used_column = "favorite_1";
        } else if ($favorites[0]->favorite_2 == $request->get('symbol')) {
            $used_column = "favorite_2";
        } else if ($favorites[0]->favorite_3 == $request->get('symbol')) {
            $used_column = "favorite_3";
        } else if ($favorites[0]->favorite_4 == $request->get('symbol')) {
            $used_column = "favorite_4";
        } else if ($favorites[0]->favorite_5 == $request->get('symbol')) {
            $used_column = "favorite_5";
        }
        DB::table('users')
            ->where('id', $user->id)
            ->update([$used_column => ""]);
        return redirect("/");
        /*return redirect()->back()
            ->with('favorites', );*/


    }
}
