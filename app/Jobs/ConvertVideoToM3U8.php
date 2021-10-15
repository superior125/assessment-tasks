<?php

namespace App\Jobs;

use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use FFMpeg\Format\Video\X264;
use Storage;
use FFMpeg;
// use ProtoneMedia\LaravelFFMpeg\Exporters\HLSExporter;

class ConvertVideoToM3U8 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The video instance.
     *
     * @var \App\Models\Video
     */
    protected $video;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $encryptionKey = HLSExporter::generateEncryptionKey();
        //Conversion to m3u8 for HLS
        $lowBitrate = (new X264)->setKiloBitrate(250);
        $midBitrate = (new X264)->setKiloBitrate(500);
        $highBitrate = (new X264)->setKiloBitrate(1000);

        $convertedFile = 'converted_videos/' . $this->video->id . '.m3u8';

        FFMpeg::fromDisk('public')
            ->open($this->video->file)
            ->exportForHLS()
            // ->withEncryptionKey($encryptionKey)
            ->toDisk('public')
            ->addFormat($lowBitrate)
            ->addFormat($midBitrate)
            ->addFormat($highBitrate)
            ->save($convertedFile);

        //Update video conversion status and converted path
        if (true) {
            $this->video->update(['converted_file' => $convertedFile, 'is_converted' => true]);
        }

    }
}
