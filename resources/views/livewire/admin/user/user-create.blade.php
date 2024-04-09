<div>
        @if(session()->has('message'))
            <div class="alert alert-info">
                {{session('message')}}
            </div>
        @endif
        <h5 class="mb-3">ایجاد کاربر</h5>
        <form wire:submit="saveUser">
            <div class="row">
                <div class="col-md-4 mt-1">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">نام و نام خانوادگی</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control text-left" dir="rtl"
                                   wire:model="name">
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-1">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">ایمیل</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control text-left" dir="rtl"
                                   wire:model="email">
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-1">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">موبایل</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control text-left" dir="rtl"
                                   wire:model="mobile">
                            @error('mobile')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-1">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">پسورد</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control text-left" dir="rtl"
                                   wire:model="password">
                            @error('password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-1">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="file"> آپلود عکس </label>
                        <input class="col-sm-9" type="file" class="form-control-file" id="file"
                               wire:model="image">
                        @if($image)
                            <figure class="avatar avatar col-2">
                                <img src="{{$image->temporaryUrl()}}" class="rounded-circle"
                                     alt="image">
                            </figure>
                        @endif
                        <div wire:loading wire:target="image" class="spinner-border text-primary"
                             role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        @error('image')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 mt-1">
                    <div class="form-group row">
                        @if($editUserIndex==null)
                            <button type="submit" class="btn btn-success btn-uppercase">
                                <i class="ti-check-box m-r-5"></i> کاربر جدید
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </form>
</div>

