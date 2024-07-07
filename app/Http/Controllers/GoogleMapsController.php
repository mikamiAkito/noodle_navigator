<?php

namespace App\Http\Controllers;

use App\Services\GoogleMapsService;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class GoogleMapsController extends Controller
{
  protected $googlemapsservice;

  public function __construct(GoogleMapsService $googlemapsservice)
  {
    $this->googlemapsservice = $googlemapsservice;
  }

  //お気に入り登録処理
  public function bookMarkEvent(Request $request) {
    $datas = $request->input('params');
    $userId = Auth::id();

    try {
      $this->googlemapsservice->bookMarkEvent($datas, $userId);
    } catch(\Exception $e) {
      return response()->json(['message' => "エラーが発生しました", $e], 500);
    }

    return response()->json(['message' => "登録完了"]);
  }

  //お気に入り登録解除処理
  public function bookMarkDelete(Request $request) {
    $datas = $request->input('params');
    $userId = Auth::id();

    try {
      $this->googlemapsservice->bookMarkDelete($datas, $userId);
    } catch(\Exception $e) {
      return response()->json(['message' => "エラーが発生しました", $e], 500);
    }

    return response()->json(['message' => "解除完了"]);
  }

  //お気に入り登録確認処理
  public function bookMarkCheck() {
    $userId = Auth::id();

    try {
      $sql = $this->googlemapsservice->bookMarkCheck($userId);
      if($sql) {
        $datas = $sql;
      } else {
        $datas = "";
      }
    } catch(\Exception $e) {
      return response()->json(['message' => "エラーが発生しました", $e], 500);
    }

    return response()->json(['datas' => $datas]);
  }

  //お気に入り一覧ページ
  public function bookMarkList() {
    $userId = Auth::id();

    try {
      $sql = $this->googlemapsservice->bookMarkCheck($userId);
      if($sql) {
        $datas = $sql;
      } else {
        $datas = "";
      }
    } catch(\Exception $e) {
      return response()->json(['message' => "エラーが発生しました", $e], 500);
    }

    return Inertia::render('BookMarkList', [
      'bookMarkItems' => $datas
    ]);
  }
}
