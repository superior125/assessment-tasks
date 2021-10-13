<?php

namespace App\Listeners;

use App\Events\VideoUploaded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\ConvertVideoToM3U8;

class VideoConversion
{
    /**
     * The number of times the queued listener may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  VideoUploaded  $event
     * @return void
     */
    public function handle(VideoUploaded $event)
    {
        //Dispatch conversion to M3U8 job
        ConvertVideoToM3U8::dispatch($event->video);
    }

}
