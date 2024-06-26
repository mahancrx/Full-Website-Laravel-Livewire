<div wire:poll="pollRefresh">
    <table class="table table-striped table-hover">
        <thead class="thead-light">
        <tr>
            <th class="text-center align-middle text-primary">
                <div class="d-flex items-center">
                    <div class="p-1" wire:click="$toggle('sortId')">
                        @if($sortId)
                            <i class="icon ti-arrow-down"></i>
                        @else
                            <i class="icon ti-arrow-up"></i>
                        @endif
                    </div>
                    <p>ردیف</p>
                </div>
            </th>
            <th class="text-center align-middle text-primary">عکس</th>
            <th class="text-center align-middle text-primary">آیدی</th>
            <th class="text-center align-middle text-primary">نام و نام خانوادگی</th>
            <th class="text-center align-middle text-primary">ایمیل</th>
            <th class="text-center align-middle text-primary">موبایل</th>
            <th class="text-center align-middle text-primary">نقش های کاربر</th>
            <th class="text-center align-middle text-primary"> وضعیت</th>
            <th class="text-center align-middle text-primary">ویرایش</th>
            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
        </tr>
        </thead>
        @foreach($users as $index=>$user)
            <tbody>

            <tr>
                <td class="text-center align-middle">{{$users->firstItem()+$index}}</td>
                <td class="text-center align-middle">
                    @if($user->image)
                    <figure class="avatar avatar">
                        <img src="{{url('img/photos/'.$user->image)}}" class="rounded-circle"
                             alt="image">
                    </figure>
                    @endif
                </td>
                <td class="text-center align-middle">{{$user->id}}</td>
                <td class="text-center align-middle">{{$user->name}}</td>
                <td class="text-center align-middle">{{$user->email}}</td>
                <td class="text-center align-middle">{{$user->mobile}}</td>
                <td class="text-center align-middle">
                    <a class="btn btn-outline-info" href="#">
                        نقش های کاربر
                    </a>
                </td>
                <td class="text-center align-middle">
                    <span class="cursor-pointer badge badge-success">فعال</span>
                </td>
                <td class="text-center align-middle">
                    @if($editUserIndex==$user->id)
                        <a class="btn btn-outline-info" href="#" wire:click="updateRow({{$user->id}})">
                            ذخیره
                        </a>
                    @else
                        <a class="btn btn-outline-info" href="#" wire:click="editRow({{$user->id}})">
                            ویرایش
                        </a>
                    @endif
                </td>
                <td class="text-center align-middle">{{$user->created_at}}</td>
            </tr>
            </tbody>
        @endforeach
    </table>
    <div style="margin: 40px !important;"
         class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
        {{$users->links()}}
    </div>
</div>
