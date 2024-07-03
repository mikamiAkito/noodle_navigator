<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class GoogleMapsController extends Controller
{
  //お気に入り登録処理
  public function bookMarkEvent(Request $request) {
    $datas = $request->input('params');
    $userId = Auth::id();

    DB::beginTransaction();
    try {
      DB::table('noodle_nav.book_marks')->insert([
        'place_id' => $datas['place_id'],
        'name' => $datas['name'],
        'user_id' => $userId
      ]);
      DB::commit();
    } catch(\Exception $e) {
      Log::error($e);
      DB::rollBack();
      return response()->json(['message' => "エラーが発生しました", $e], 500);
    }

    return response()->json(['message' => "登録完了"]);
  }

  //お気に入り登録解除処理
  public function bookMarkDelete(Request $request) {
    $datas = $request->input('params');
    $userId = Auth::id();

    DB::beginTransaction();
    try {
      DB::table('noodle_nav.book_marks')
      ->where([
        ['user_id', '=', $userId],
        ['place_id', '=', $datas['place_id']],
      ])->delete();
      DB::commit();
    } catch(\Exception $e) {
      Log::error($e);
      DB::rollBack();
      return response()->json(['message' => "エラーが発生しました", $e], 500);
    }

    return response()->json(['message' => "解除完了"]);
  }

  //お気に入り登録確認処理
  public function bookMarkCheck() {
    $userId = Auth::id();

    try {
      $sql = DB::table('noodle_nav.book_marks')
      ->select('place_id')
      ->where('user_id', '=', $userId)
      ->get();
      if($sql) {
        $datas = $sql;
      } else {
        $datas = "";
      }
    } catch(\Exception $e) {
      Log::error($e);
      return response()->json(['message' => "エラーが発生しました", $e], 500);
    }

    return response()->json(['datas' => $datas]);
  }

  //お気に入り一覧ページ
  public function bookMarkList() {
    return Inertia::render('BookMarkList');
  }
}
