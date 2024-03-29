<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationEvent implements ShouldBroadcast
{
	use Dispatchable, InteractsWithSockets, SerializesModels;

	public $comment;

	public $quote;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($comment, $quote)
	{
		$this->comment = $comment;
		$this->quote = $quote;
		$this->dontBroadcastToCurrentUser();
	}

	public function broadcastWith()
	{
		return  ['message' => $this->comment, 'user' => $this->comment->user->id, 'commentBy' => $this->comment->user->name];
	}

	/**
	 * Get the channels the event should broadcast on.
	 *
	 * @return \Illuminate\Broadcasting\Channel|array
	 */
	public function broadcastOn()
	{
		return new PrivateChannel('notification.' . $this->quote->user_id);
	}
}
