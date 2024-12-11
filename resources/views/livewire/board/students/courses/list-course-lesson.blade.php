<tr>
    <td> {{ $index }} </td>
    <td> {{ $lesson->lesson?->title }} </td>
    <td> {{ $lesson->user?->name }} </td>
    <td> {{ $lesson->created_at }} <span> {{ $lesson->created_at->difFforHumans() }} </span> </td>
    <td>
        @if ($lesson->allowed)
        <div class="form-check form-switch  mb-2 center-block ">
            <input type="checkbox" wire:click='disallow({{ $lesson->id }})' class="form-check-input " checked>
        </div>
        @else
        <div class="form-check form-switch  mb-2 center-block ">
            <input type="checkbox" wire:click='allow({{ $lesson->id }})' class="form-check-input " >
        </div>
        @endif
    </td>
    <td>
        {{ $lesson->total_views_till_now }} <span class='text-muted'> @lang('courses.views') </span>
        
    </td>
    <td>
        <input type="text" class='form-control'  wire:model.live='allowed_views'>
    </td>
    <td>
        <input type="text" class='form-control'  wire:model.live='remains_views' >
    </td>
    
</tr>
