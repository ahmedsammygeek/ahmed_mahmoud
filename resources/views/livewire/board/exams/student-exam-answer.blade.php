<tr>
    <td> {{ $index }} </td>
    <td> {{ $student_exam_answer->question?->content }} -- {{ $student_exam_answer->question_id }} </td>
    <td>
        @switch($student_exam_answer->question?->answer_type)
        @case(1)
        {{ $student_exam_answer->answer?->content }}
        @break
        @case(2)
        {{ $student_exam_answer->answer_content }}
        @break
        @endswitch
    </td>
    <td>
        {{ $student_exam_answer->correct_answer?->content }}
    </td>
    <td> 
        {{ $student_exam_answer->degree }}        
    </td>
    <td> 
        @if ($student_exam_answer->is_marked == 0 )
        <div class="btn-group">
            <button type="button" class="btn btn-primary" wire:click='markAsTrue()' > <i class='icon-checkmark3' > </i> </button>
            <button type="button" class="btn btn-danger" wire:click='markAsFalse()' > <i class='icon-cross3' > </i> </button>
        </div>
        @endif
    </td>

</tr>