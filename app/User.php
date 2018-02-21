<?php

namespace App;

use App\Campaign;
use App\CampaignUser;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DateTime;
use Exception;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_campaign_id', 'provider', 'provider_id', 'newsletter', 'locale', 'timezone',
        'campaign_role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the user's campaign
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function campaign()
    {
        $campaign = $this->campaigns()->whereCampaignId($this->last_campaign_id)->first();
        if (empty($campaign)) {
            $campaign = $this->campaigns->first();
            $this->last_campaign_id = $campaign->id;
            $this->update(['last_campaign_id']);
        }
        return $campaign;
        // return $this->belongsTo(Campaign::class, 'last_campaign_id', 'id');
    }

    /**
     * Get the user's campaigns
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function campaigns()
    {
        return $this->hasManyThrough(Campaign::class, CampaignUser::class, 'user_id', 'id', 'id', 'campaign_id');
    }

    /**
     * Get the user's campaign
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dashboardSetting()
    {
        return $this->hasOne('App\Models\UserDashboardSetting', 'user_id', 'id');
    }

    /**
     * Get the user's campaign
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
//    public function campaignRole()
//    {
//        return $this->belongsTo(CampaignUser::class, 'id', 'last_campaign_id');
//    }

    /**
     * @param string $field
     * @param bool $full
     * @return string
     */
    public function elapsed($field = 'updated_at', $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($this->$field);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . trans('datetime.' . ($v . ($diff->$k > 1 ? 's' : '')));
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) {
            $string = array_slice($string, 0, 1);
        }
        // Formatting
        if ($string) {
            return  trans('datetime.elapsed_ago', ['duration' => implode(', ', $string)]);
        }
        return trans('datetime.just_now');
    }

    /**
     * @return string
     */
    public function getAvatarUrl()
    {
        if (!empty($this->avatar) && $this->avatar != 'users/default.png') {
            return '/storage/' . $this->avatar;
        } else {
            return '/images/defaults/user.svg';
        }
    }

    /**
     * Get campaign if it's a campaign you have access to, otherwise return false
     * If $guaranteeReturn == true, return the most recently created campaign for this user
     *
     * @author Dick van Viegen
     * @param  int  $campaign_id
     * @param bool  $guaranteeReturn
     * @return Campaign || boolean
     */
    public function getCampaign($campaign_id, $guaranteeReturn = false)
    {
        try {
            if (!$guaranteeReturn) {
                return $this->campaigns()->whereCampaignId($campaign_id)->firstOrFail();
            } else {
                return $this->campaigns()->latest()->firstOrFail();
            }
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Determine if the user is currently viewing a campaign as a viewer
     * @return bool
     */
    public function viewer()
    {
        return $this->campaign_role == 'viewer';
    }

    /**
     * Determine if the user is currently viewing a campaign as an owner
     * @return bool
     */
    public function owner()
    {
        return $this->campaign_role == 'owner';
    }

    /**
     * Determine if the user is currently viewer a campaign as a member or owner
     * @param bool $strict
     * @return bool
     */
    public function member($strict = false)
    {
        if ($strict) {
            return $this->campaign_role == 'member';
        }
        return in_array($this->campaign_role, ['member', 'owner']);
    }

    public function logs()
    {
        return $this->hasMany('App\Models\UserLog', 'user_id', 'id');
    }
}
