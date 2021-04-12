<table class="table table-tranx table-hover">
    <thead>
        <tr class="tb-tnx-head">
            <th scope="col">#</th>
            <th scope="col">Full Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Status</th>
            <th scope="col">Created On</th>
            <th style="text-align: center;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        @foreach($users as $user)
        <tr class="tb-tnx-item">
            <td class="tb-id">{{$no++}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>
            <td>
                @if($user->exitdate==NULL)
                    <span class="badge badge-dot badge-success">Active</span>
                @else
                    <span class="badge badge-dot badge-danger">Inactive</span>
                @endif
            </td>

            <td>{{ date('M d, Y', time()) }}</td>
            <td class="tb-tnx-action">
                <a href="{{ url('employee/'.$user->id.'/edit') }}"><em class="icon ni ni-edit-alt"></em><span>Edit</span></a><br>
                
            
                @if($user->exitdate==NULL)
                <a href="{{url('entry-form/'.$user->id)}}" ><em class="icon ni ni-minus-circle-fill"></em><span>Entry Form</span></a><br>
                @else
                <a href="{{url('exit-form/'.$user->id)}}" ><em class="icon ni ni-minus-circle-fill"></em><span>Exit Form</span></a><br>
                @endif
                <form method="post" action="<?= url('employee/' . $user->id) ?>" id="employee_{{ $user->id }}">
                    @method('DELETE')
                    @csrf
                    
                    <a onClick="deleteUser({{ $user->id }})" href="javascript:void(0)" rel="nofollow" class="text-danger"><em class="icon ni ni-trash"></em><span>Remove</span></a>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>