<div class="p-4">
    <h1 class="text-3xl">
        {{ $course->name }}
    </h1>
    <p>
        {!! $course->description !!}
    </p>
    <div class="">
        <h1 class="text-md my-2"> Etapas do curso</h1>

        @livewire('studio.steps.show-all',['course_id' => $course->getKey()])
    </div>
</div>
