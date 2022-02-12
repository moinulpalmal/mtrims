<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Buyer extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public static function getActiveBuyerListForSelect()
    {
        return DB::table('buyers')
            ->select('id', 'name')
            ->where('status', '!=', 'D')
            ->orderBy('name')
            ->get();
    }

    public static function getAllNotDeletedBuyers()
    {
        return DB::table('buyers')
            ->select('*')
            ->where('status', '!=', 'D')
            ->orderBy('name')
            ->get();
    }

    public static function insertBuyer($request)
    {
        $buyer = new Buyer();
        $buyer->name = $request->get('name');
        $buyer->short_name = $request->get('short_name');
        $buyer->status = 'A';
        $buyer->inserted_by = Auth::id();
        if($buyer->save())
        {
            return '1';
        }
        return '0';

    }

    public static function updateBuyer($request)
    {
        $buyer = Buyer::find($request->id);
        if($buyer != null){
            $buyer->name = $request->get('name');
            $buyer->short_name = $request->get('short_name');
            $buyer->last_updated_by = Auth::id();
            if($buyer->save())
            {
                return '2';
            }
            return '0';
        }
        return '0';
    }

    public static function getBuyerDetail($request)
    {
        $buyer = Buyer::find($request->id);
        if($buyer != null){
            $buyerData = array(
                'name' => $buyer->name,
                 'short_name' => $buyer->short_name,
                 'status' => $buyer->status,
                'id' => $buyer->id
            );
            return $buyerData;
        }
        return 'something wrong';
    }


    public static function inActivateBuyer($request)
    {
        $buyer = Buyer::find($request->id);
        if($buyer != null){
            $buyer->status = 'I';
            $buyer->last_updated_by = Auth::id();
            if($buyer->save()){
                return '2';
            }
            return '0';
        }
        return '0';
    }

    public static function activateBuyer($request)
    {
        $buyer = Buyer::find($request->id);
        if($buyer != null){
            $buyer->status = 'A';
            $buyer->last_updated_by = Auth::id();
            if($buyer->save()){
                return '2';
            }
            return '0';
        }

        return '0';
    }

    public static function deleteBuyer($request)
    {
        $buyer = Buyer::find($request->id);
        if($buyer != null){
            $buyer->status = 'D';
            $buyer->last_updated_by = Auth::id();
            if($buyer->save()){
                return '2';
            }
            return '0';
        }

        return '0';
    }



}
