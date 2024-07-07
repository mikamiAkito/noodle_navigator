<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class GoogleMapsService
{
	//お気に入り登録処理
	public function bookMarkEvent($datas, $userId) {

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
			throw $e;
		}

	}

	//お気に入り解除処理
	public function bookMarkDelete($datas, $userId) {

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
			throw $e;
    }

	}

	//お気に入り確認処理
	public function bookMarkCheck($userId) {
		try {
      $sql = DB::table('noodle_nav.book_marks')
      ->select('place_id')
      ->where('user_id', '=', $userId)
      ->get();
		} catch(\Exception $e) {
			Log::error($e);
			throw $e;
		}

		return $sql;
	}
}
