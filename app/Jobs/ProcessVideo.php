<?php

namespace App\Jobs;

use App\Models\Video;
use Carbon\Carbon;
use FFMpeg\Format\Video\Ogg;
use FFMpeg\Format\Video\WebM;
use FFMpeg\Format\Video\WMV;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Imtigger\LaravelJobStatus\Trackable;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class ProcessVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Trackable;

    private Video $video;
    private ?string $thumb_path;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Video $video,$thumb_path)
    {
        $this->prepareStatus(['key' => $video->uuid->serialize()]);
        $this->video = $video;
        $this->thumb_path = $thumb_path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->setProgressMax(7);
        $formats_filename = [
            'wmv'  => $this->getFilenameFromFormat('wmv'),
            'x264' => $this->getFilenameFromFormat('mkv'),
            'webm' => $this->getFilenameFromFormat('webm'),
            'ogg' => $this->getFilenameFromFormat('ogv'),
        ];


        /*$video = FFMpeg::fromDisk($this->video->disk)
            ->open($this->video->path);
        $this->setProgressNow(1);
        $video->export()
            ->toDisk('converted_videos')
            ->inFormat(new WMV)
            ->save($formats_filename['wmv']);

        $this->setProgressNow(2);
        $video->export()
            ->toDisk('converted_videos')
            ->inFormat(new X264)
            ->save($formats_filename['x264']);

        $this->setProgressNow(4);
        $video->export()
            ->toDisk('converted_videos')
            ->inFormat(new WebM)
            ->save($formats_filename['webm']);
        $this->setProgressNow(5);

        $video->export()
        ->toDisk('converted_videos')
        ->inFormat(new Ogg)
        ->save($formats_filename['ogg']);*/

        $this->setProgressNow(6);
        $thumb = $this->generateThumbnail($video);

        $this->video->update([
            'converted_at'     => Carbon::now(),
            'conversions'      => array_values($formats_filename),
            'conversions_disk' => 'converted_videos',
            'duration'         => null,
            'thumb_path'       => $thumb,
        ]);

        $this->setProgressNow(7);
    }

    private function getFilenameFromFormat($format)
    {
        return 'converted_' . \Str::random(20) . '.' . $format;
    }

    /**
     * @param \ProtoneMedia\LaravelFFMpeg\MediaOpener $video
     */
    private function generateThumbnail(\ProtoneMedia\LaravelFFMpeg\MediaOpener $video): string
    {
        $thumb_path = 'thumb_' . \Str::random(20) . '.png';

        if (Storage::disk('thumbnails')->exists($this->thumb_path)) {
            Storage::disk('thumbnails')->rename($this->thumb_path,$thumb_path);
        }else{
            $video->getFrameFromSeconds(5)
                ->export()
                ->toDisk('thumbnails')
                ->save($thumb_path);
        }
        return $thumb_path;
    }
}
