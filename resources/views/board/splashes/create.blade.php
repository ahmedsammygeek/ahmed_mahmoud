@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.splashes.index') }}" class="breadcrumb-item"> @lang('splashes.splashes') </a>
<span class="breadcrumb-item active">  @lang('splashes.add new splash')  </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0">  @lang('splashes.add new splash')  </h5>
			</div>	

			<form method="POST" action="{{ route('board.splashes.store') }}"  enctype="multipart/form-data" >
    <div class="card-body">
        @csrf
        <div class="mb-4">
            <div class="fw-bold border-bottom pb-2 mb-3"> @lang('splashes.splashes details') </div>

 
            
          
            <div class="row mb-3">
                <label class="col-form-label col-lg-2"> @lang('splashes.title_ar') <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" name='title_ar' wire:model.live='title_ar' class="form-control " > 
                    @error('title_ar')
                    <p class='text-danger' > {{ $message }} </p>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label col-lg-2"> @lang('splashes.title_en') <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text" name='title_en' wire:model.live='title_en' class="form-control " > 
                    @error('title_en')
                    <p class='text-danger' > {{ $message }} </p>
                    @enderror
                </div>
            </div>

             <div class="row mb-3">
                <label class="col-form-label col-lg-2"> @lang('splashes.image') <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="file" name='image' wire:model.live='image' class="form-control " > 
                    @error('image')
                    <p class='text-danger' > {{ $message }} </p>
                    @enderror
                </div>
                
            </div>










            

        </div>

    </div>

    <div class="card-footer d-flex justify-content-end">
        <a  href='{{ route('board.splashes.index') }}' class="btn btn-light" id="reset"> @lang('dashboard.cancel') </a>
        <button type="submit" class="btn btn-primary ms-3"> @lang('dashboard.add') <i class="ph-paper-plane-tilt ms-2"></i></button>
    </div>
</form>


		</div>
	</div>
</div>

@endsection

@section('scripts')
	<script src="{{ asset('board_assets/js/vendor/forms/selects/select2.min.js') }}"></script>
	<script src="{{ asset('board_assets/js/vendor/ui/moment/moment.min.js') }}"></script>
	<script src="{{ asset('board_assets/js/vendor/pickers/daterangepicker.js') }}"></script>
	<script src="{{ asset('board_assets/js/vendor/pickers/datepicker.min.js') }}"></script>
	<script src="{{ asset('board_assets/demo/pages/picker_date.js') }}"></script>
	<script src="{{ asset('board_assets/js/vendor/forms/inputs/dual_listbox.min.js') }}"></script>
	<script src="{{ asset('board_assets/demo/pages/form_dual_listboxes.js') }}"></script>
	<script>
		$(function() {
			 // $('.select').select2();
		});
	</script>
@endsection