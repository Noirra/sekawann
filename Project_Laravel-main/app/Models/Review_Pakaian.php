<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Review_Pakaian extends Model
{
    use HasFactory;

    protected $table = 'review';
    protected $primaryKey = 'review_id';
    protected $fillable = [
        'review_id',
        'review_pakaian_id',
        'review_user_id',
        'revies_rating',
        'review_note',
    ];
    protected static function createReview_Pakaian ($data)
    {
        return DB::table('review')->insert($data);
    }
    protected static function readReview_PakaianAll ()
    {
        $data = DB::table('review')->get();
        return $data;
    }
    protected static function readReview_PakaianPaginate ()
    {
        $data = DB::table('review')->paginate(10);
        return $data;
    }
    protected static function readReview_PakaianById ($id)
    {
        $data = DB::table('review')->where('review_id', $id)->first();
        return $data;
    }
    protected static function updateReview_Pakaian ($id, $data)
    {
        $review = DB::table('review')->where('review_id', $id)->first();
        if ($review) {
            DB::table('review')->where('review_id', $id)->update($data);
            return $data;
        }
        return null;
    }
    protected static function deleteReview_Pakaian ($id)
    {
        return DB::table('review')->where('review_id', $id)->delete();
    }
}