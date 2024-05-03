<!-- begin::main content -->
<main class="main-content">

    <div class="card">
        <div>
            <div class="card-body">
                <div class="table overflow-auto" tabindex="8">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">عنوان جستجو</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control text-left" dir="rtl" wire:model.live="search">
                        </div>
                        <div class="col-sm-1 d-flex align-center">
                            <a class="btn btn-success text-white" wire:click="$set('search','')">
                                پاک کردن
                            </a>
                        </div>
                        <div class="col-sm-1 d-flex align-center">
                            <a class="btn btn-success text-white" wire:click="$refresh">
                                 بروزرسانی
                            </a>
                        </div>
                        <div class="col-sm-1 d-flex align-center">
                            <a class="btn btn-success text-white" wire:click="resetSearch">
                                hybrid
                            </a>
                        </div>
                    </div>
                    <livewire:admin.user.user-create :image="$image" :editUserIndex="$editUserIndex"/>
                    <livewire:admin.user.users lazy/>
                </div>
            </div>
        </div>
    </div>
</main>


