<?php

namespace App\Http\Requests\Admin;


use App\Events\Admin\UserEdited;
use App\Exceptions\RequestException;
use App\Log;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

class ChangeBasicInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
//            'username' => 'unique:users'
        ];
    }

    public function messages(){
        return [
//            'username.unique' => 'User with that username already exists'
        ];
    }

    public function persist(User $user){
        $this->updateUsername($user);
        $this->updateReferralCode($user);
        $this->updateImportedFeedbacks($user);
        session()->flash('success', 'Successfully updated ' . $user->username . '\'s basic info');
    }

    public function updateUsername(User $user){

        if ($this->username !== null && $this->username !== $user->username){
            // check if user with username already exist
            $userCheck = User::where('username',$this->username)->first();
            if ($userCheck !== null)
                throw new RequestException('User with that username already exists');
            $oldUser = User::find($user->id);
            $user->username = $this->username;
            $user->save();
            event(new UserEdited($oldUser,$user,auth()->user()));

        }
    }

    public function updateReferralCode(User $user){
        if ($this->referral_code !== null && $this->referral_code !== $user->referral_code){
            // check if user with that code already exists
            $userCheck = User::where('referral_code',$this->referral_code)->first();
            if ($userCheck !== null)
                throw new RequestException('User with that referral code already exists');
            $oldUser = User::find($user->id);
            $user->referral_code = $this->referral_code;
            $user->save();
            event(new UserEdited($oldUser,$user,auth()->user()));
        }
    }
	
	public function updateImportedFeedbacks(User $user){
        if ($this->empire !== null || $this->whm !== null || $this->dream !== null || $this->darkmarket !== null || $this->versus !== null || $this->berlusconi !== null || $this->darkfox !== null || $this->darkode !== null || $this->othermarkets !== null){
            
			$oldUser = User::find($user->id);
			
            $user->empire_feedback = $this->empire;
            $user->whm_feedback = $this->whm;
            $user->dream_feedback = $this->dream;
            $user->darkmarket_feedback = $this->darkmarket;
            $user->versus_feedback = $this->versus;
            $user->berlusconi_feedback = $this->berlusconi;
            $user->darkfox_feedback = $this->darkfox;
            $user->darkode_feedback = $this->darkode;
            $user->othermarkets_feedback = $this->othermarkets;
            
            $user->save();
            event(new UserEdited($oldUser,$user,auth()->user()));
        }
    }
}
