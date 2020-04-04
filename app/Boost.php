<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boost extends Model
{
    protected $primaryKey = 'boost_id';

    public $timestamps = false;

    public function percentage()
    {
        return $this->percentage * 100;
    }

    /**
     * Returns who was referred by the boost
     *
     * @return string
     */
    public function referredWho()
    {
        $who = '';
        $description = (string) $this->description;
        if (!empty($description)) {
            $positionOfSemicolon = strpos($description, ';');
            if ($positionOfSemicolon > 0) {
                $id = substr($description, 0, $positionOfSemicolon);
                $user = User::find($id);
                if (!empty($user) && $user->hide_name) {
                    $who = Referral::DEFAULT_NAME;
                } else {
                    $who = substr($description, $positionOfSemicolon + 1);
                }
            }
        }
        return $who;
    }

    public static function createBetaBoost($user_id)
    {
        $boost = new Boost();
        $boost->heleum_user = $user_id;
        $boost->percentage = 0.1;
        $boost->type = 'beta';
        $boost->save();
        return $boost;
    }

    public static function userHasBetaBoost($user_id)
    {
        $existingBoost = Boost::where('heleum_user', $user_id)
            ->where('type', 'beta')
            ->first();
        return (!empty($existingBoost));
    }
}
