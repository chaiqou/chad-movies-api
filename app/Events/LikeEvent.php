<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LikeEvent implements ShouldBroadcast
{
	use Dispatchable, InteractsWithSockets, SerializesModels;

	public $id;

	public $type;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($id, $type)
	{
		$this->id = $id;
		$this->type = $type;
	}

	/**
	 * Get the channels the event should broadcast on.
	 *
	 * @codeCoverageIgnore
	 */
	public function broadcastOn(): Channel
	{
		return new Channel('like');
	}
}
