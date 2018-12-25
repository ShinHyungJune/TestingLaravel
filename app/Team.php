<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Team extends Model
{
    protected $fillable = ['name', 'size'];

    public function add($users)
    {
        // guard -> 정석대로라면 policy에 넣는게 낫겠지?
        $this->guardAgainstTooManyMembers($users);

        $method = $users instanceof User ? 'save' : 'saveMany';

        $this->users()->$method($users);
    }

    protected function guardAgainstTooManyMembers($users)
    {
        $numUsersToAdd = ($users instanceof User) ? 1 : $users->count();

        $newTeamCount = $this->count() + $numUsersToAdd;

        if($newTeamCount > $this->size)
            throw new \Exception();
    }

    public function remove($users = null)
    {
        if($users instanceof User){
            return $users->leaveTeam();
            // $this->update([team_id => null]); in User.php
        }

        return $this->removeMany($users);
    }

    public function removeMany($users)
    {
        return $this->users()
            ->whereIn('id', $users->pluck('id'))
            ->update(['team_id' => null]);
    }

    public function refresh()
    {
        return $this->users()->update(['team_id' => null]);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function count()
    {
        return $this->users()->count();
    }

}
