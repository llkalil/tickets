<?php

namespace App\Http\Livewire\Studio\Steps;

use App\Models\Alternative;
use App\Models\CourseStep;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public int $course_id = 0;

    public $alternatives = [];

    public $video;

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

    public function createdCourse($course_id)
    {
        $this->course_id = $course_id;
    }

    public function createdAlternative($alternative)
    {
        $this->alternatives[] = $alternative;
    }

    public function save($course_id)
    {
        if ($course_id == 0) {
            $this->emitTo('livewire-toast', 'showError', 'Por favor, defina um título para o curso para que ele seja salvo como rascunho.');
        } else {
            //$this->validate();

            $course_step_data = [
                'slug'      => \Str::slug($this->title),
                'course_id' => $course_id,
                'title'     => \Str::title($this->title),
                'subtitle'  => clean($this->subtitle),
                'type'      => $this->type,
                'is_active' => true,
            ];

            $final_data = $this->processType($course_step_data);

            $step = CourseStep::create($final_data);

            $this->emit('stepCreated', $course_id);
            $this->emitTo('livewire-toast', 'show', 'Etapa salva com sucesso!');
            $this->resetExcept('course_id');
        }
    }

    private function processType($course_step_data)
    {
        if ($this->type == CourseStep::TYPE_ACTIVITY) {
            $this->typeActivity();
            $course_step_data['question_title'] = $this->question_title;
        } elseif ($this->type == CourseStep::TYPE_VIDEO) {
            $course_step_data['video_id'] = $this->typeVideo();
            $course_step_data['contents'] = clean($this->contents);
        } elseif ($this->type == CourseStep::TYPE_ARTICLE) {
            $course_step_data['contents'] = clean($this->contents);
        }

        return $course_step_data;
    }

    private function typeActivity(): void
    {
        $data = collect($this->alternatives)->map(function ($item) {
            $item['course_step_id'] = $this->course_id;
            $item['is_correct'] = boolval($item['is_correct']);
            $item['is_active'] = boolval($item['is_active']);

            return $item;
        })->each(function ($item) {
            Alternative::create($item);
        });
    }

    private function typeVideo()
    {
        $path = 'media'.DIRECTORY_SEPARATOR.$this->course_id;
        $file = $this->video->store($path);
        if ($this->video->exists()) {
            return \App\Models\Video::create([
                'uuid'      => \Str::uuid(),
                'url'       => $file,
                'duration'  => 0,
                'file_name' => $this->video->getClientOriginalName(),
                'mime_type' => $this->video->getMimeType(),
                'size'      => $this->video->getSize(),
            ])->id;
        }
    }

    public function render()
    {
        return view('livewire.studio.steps.create');
    }
}
