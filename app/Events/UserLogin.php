<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\User;
use Uphold\Model\User as UpholdUser;

class UserLogin
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Application's user object
     *
     * @var App\User
     */
    public $user;

    /**
     * Uphold's user object
     *
     * @var Uphold\Model\User
     */
    public $upholdUser;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, UpholdUser $upholdUser)
    {
        $this->user = $user;
        $this->upholdUser = $upholdUser;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
