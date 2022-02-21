<?php

namespace App\Http\Livewire\Studio\Steps;

use App\Jobs\ProcessVideo;
use App\Models\Alternative;
use App\Models\CourseStep;
use App\Models\Video;
use Imtigger\LaravelJobStatus\JobStatus;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public int $course_id = 0;

    public $alternatives = [];

    public $video_processing_job_status_id;

    public $video_processing_job_status;

    public $video;

    public $thumbnail;

    public $title;

    public $type = 'activity';

    public $subtitle;

    public $contents;

    public $question_title;

    protected $listeners = [
        'createdCourse'      => 'createdCourse',
        'createdAlternative' => 'createdAlternative',
    ];

    private $video_id;

    /**
     * @param $course_id
     */
    public function createdCourse($course_id)
    {
        $this->course_id = $course_id;
    }

    /**
     * @param $alternative
     */
    public function createdAlternative($alternative)
    {
        $this->alternatives[] = $alternative;
    }

    /**
     * @param $course_id
     */
    public function save($course_id)
    {
        if ($course_id == 0) {
            $this->emitTo('livewire-toast',
                'showError',
                'Por favor, defina um título para o curso para que ele seja salvo como rascunho.');
        } elseif ($this->type == CourseStep::TYPE_VIDEO && $this->video_processing_job_status) {
            $this->emitTo('livewire-toast',
                'showWarning',
                'Por favor, aguarde seu video ser processado antes de adicionar um novo.');
        } else {
            //$this->validate();
            CourseStep::create($this->mountDataForStepCreation($course_id));

            $this->emit('stepCreated', $course_id);
            $this->emitTo('livewire-toast', 'show', 'Etapa salva com sucesso!');
            $this->resetExcept('course_id', 'video_processing_job_status', 'video_processing_job_status_id');
        }
    }

    /**
     * @param $course_id
     * @return mixed
     */
    private function mountDataForStepCreation($course_id)
    {
        $course_step_data = [
            'slug'      => \Str::slug($this->title),
            'course_id' => $course_id,
            'title'     => \Str::title($this->title),
            'subtitle'  => clean($this->subtitle),
            'type'      => $this->type,
            'is_active' => true,
        ];

        return array_merge($course_step_data, $this->processType());
    }

    /**
     * @return array
     */
    private function processType(): array
    {
        $return = [];
        switch ($this->type) {
            case CourseStep::TYPE_ACTIVITY:
                $this->createAlternatives();
                $return['question_title'] = $this->question_title;
                break;
            case CourseStep::TYPE_VIDEO:
                $return['video_id'] = $this->createAndStoreVideo();
                $return['contents'] = clean($this->contents);
                break;
            case CourseStep::TYPE_ARTICLE:
                $return['contents'] = clean($this->contents);
                break;
        }

        return $return;
    }

    private function createAlternatives(): void
    {
        $data = collect($this->alternatives)->map(function ($item) {
            $item['course_step_id'] = $this->course_id;
            $item['is_correct'] = boolval($item['is_correct']);
            $item['is_active'] = boolval($item['is_active']);

            return $item;
        });
        Alternative::insert($data);
    }

    /**
     * @return null
     */
    public function createAndStoreVideo()
    {
        $file = $this->video->store('/', 'streamable_videos_public');
        $thumb_path = $this->storeThumbnail();

        if ($this->video->exists()) {
            $video = \App\Models\Video::create([
                'uuid'          => \Str::uuid(),
                'path'          => $file,
                'disk'          => 'streamable_videos_public',
                'original_name' => $this->video->getClientOriginalName(),
                'mime_type'     => $this->video->getMimeType(),
                'size'          => $this->video->getSize(),
                'thumb_path'    => $thumb_path,
            ]);

            $this->dispatchVideoProcessingJob($video, $thumb_path);
        }

        return optional($video)->getKey() ?? null;
    }

    private function storeThumbnail()
    {
        if ($this->thumbnail instanceof TemporaryUploadedFile) {
            return $this->thumbnail->store('/tmp', 'thumbnails');
        }
    }

    /**
     * @param Video $video
     */
    public function dispatchVideoProcessingJob(Video $video, $thumb_path): void
    {
        dispatch(new ProcessVideo($video, $thumb_path));

        $this->video_processing_job_status_id = $video->uuid->serialize();

        $this->getVideoProcessingJobStatus($video->uuid->serialize());
    }

    /**
     * @param $job_status_id
     */
    public function getVideoProcessingJobStatus($job_status_id)
    {
        $this->video_processing_job_status = JobStatus::where('key', $job_status_id)->first();

        $this->checkVideoProcessingJobStatus();
    }

    /**
     * void
     */
    private function checkVideoProcessingJobStatus(): void
    {
        if ($this->video_processing_job_status->status === JobStatus::STATUS_FINISHED) {
            $this->video_processing_job_status = null;
            $this->emitTo('livewire-toast', 'show', 'Seu video foi processado com sucesso!');
        }
    }

    public function render()
    {
        return view('livewire.studio.steps.create');
    }
}
