<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseStep extends Model
{
    use HasFactory;

    const TYPE_VIDEO = 'video';

    const TYPE_ACTIVITY = 'activity';

    const TYPE_ARTICLE = 'article';

    const ICON_TYPE_VIDEO = 'la-video';

    const ICON_TYPE_ACTIVITY = 'la-clipboard-check';

    const ICON_TYPE_ARTICLE = 'la-file-alt';

    protected $fillable = [
        'course_id',
        'slug',
        'title', // AC V AR
        'subtitle', // AC V AR
        'type', // AC V AR

        'video_id', // V
        'contents', // AC V AR
        'question_title', // AC
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
