@extends('board.layout.master')


@section('breadcrumb')
<a href="{{ route('board.splashes.index') }}" class="breadcrumb-item"> @lang('splashes.splashes') </a>
<span class="breadcrumb-item active">  @lang('splashes.edit splash')  </span>
@endsection

@section('page_content')
<!-- Main charts -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white">
				<h5 class="mb-0">  @lang('splashes.edit splash')  </h5>
			</div>	

			<form method="POST" action="{{ route('board.splashes.update' , $splash ) }}"  enctype="multipart/form-data" >
                <div class="card-body">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <div class="fw-bold border-bottom pb-2 mb-3"> @lang('splashes.splashes details') </div>        

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2"> @lang('splashes.title_ar') <span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <input type="text" name='title_ar' value="{{ $splash->getTranslation('content' , 'ar') }}"  class="form-control " > 
                                @error('title_ar')
                                <p class='text-danger' > {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2"> @lang('splashes.title_en') <span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <input type="text" name='title_en'  value="{{ $splash->getTranslation('content' , 'en') }}" class="form-control " > 
                                @error('title_en')
                                <p class='text-danger' > {{ $message }} </p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2"> @lang('splashes.image') <span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <input type="file" name='image'  class="form-control " > 
                                @error('image')
                                <p class='text-danger' > {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-lg-2 col-form-label "> فعال </label>
                            <div class="col-lg-10">
                                <label class="form-check form-switch">
                                    <input type="checkbox" value='1' class="form-check-input" name="active"  @checked($splash->is_active) >
                                    <span class="form-check-label"> نعم </span>
                                </label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2"> current image </label>
                            <div class="col-lg-10">
                               <img class="img-thumbnail" src="{{ Storage::url('splashes/'.$splash->image) }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a  href='{{ route('board.splashes.index') }}' class="btn btn-light" id="reset"> @lang('dashboard.cancel') </a>
                    <button type="submit" class="btn btn-primary ms-3"> @lang('dashboard.edit') <i class="ph-paper-plane-tilt ms-2"></i></button>
                </div>
            </form>


        </div>
    </div>
</div>

@endsection

@section('scripts')
@endsection