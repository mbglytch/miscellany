<?php

namespace App;

use App\Scopes\CampaignScope;
use Illuminate\Database\Eloquent\Model;

class CampaignUser extends Model
{
    public $table = 'campaign_user';

    protected $fillable = ['user_id', 'campaign_id', 'role'];

    public function campaign()
    {
        return $this->belongsTo('App\Campaign', 'campaign_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    /**
     * Get the user's roles
     * @return $this
     */
    public function roles()
    {
        return $this->hasManyThrough('App\Models\CampaignRole', 'App\Models\CampaignRoleUser', 'user_id', 'id', 'user_id', 'campaign_role_id')
            ->where('campaign_id', $this->campaign_id);
    }


    /**
     * Determin if the user is part of an admin role
     * @return bool
     */
    public function isAdmin()
    {
        return $this->roles()->where(['is_admin' => true])->count() > 0;
    }
}
