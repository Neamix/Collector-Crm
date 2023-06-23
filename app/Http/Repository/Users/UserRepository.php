<?php 

namespace App\Http\Repository\Users;

use App\Http\Services\ResponseService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepository  extends BaseRepository {
    use ResponseService;

    /*** Attach Repo To Model */
    public function model() 
    {
        return User::class;
    }

    /*** Authunticate User */
    public function login($request)
    {
        // Get User Under Action
        $token =  Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if ($token) {
            // Success Login
            return $token;
        } 

        // Failed Login
        return $token;
    }

    /*** Update/Create Operator */
    public function upsertOperator($request) 
    {
        return $this->updateOrCreate(
        [
            'id'   => $request->id,
            'type' => OPERATOR
        ],
        [
            'name'  => $request->name,
            'email' => $request->email,
            'password' => password_hash($request->password,PASSWORD_BCRYPT),
            'type' => OPERATOR
        ]);
    }

    /*** Get Operator Details */
    public function findOne($operator_id)
    {
        $operator = $this->where(['id' => $operator_id,'type' => OPERATOR])->first();

        if ( ! $operator ) {
            abort(404,__('validation.cant_fetch_user_data'));
        }

        return $operator;
    }

    /** Delete Operator */
    public function deleteOperator($operator_id) {
        // Delete Related Relations 

        // Delete Operator 
        $this->where(['id' => $operator_id,'type' => OPERATOR])->delete();
    }

    /*** Filter User Data */
    public function filter($request)
    {
        return User::filter($request->all());
    }
}