

 <div >
    {{-- x-data={show:false} --}}
    <div  class="rounded-sm">
        <div  id="headingOne" style="background-color: rgb(244, 237, 237);padding: 10px">
            {{-- <button @click="show=!show" class="btn btn-primary" type="button"> --}}
                <h2 style="color: green">{{ isset($title) ? Str::slug($title) : 'Override Permissions' }} {!! isset($user) ? '<span class="">(' . $user->getDirectPermissions()->count() . ')</span>' : '' !!}</h2>
            {{-- </button> --}}
        </div>
        <br>
        <div x-show="show" >
            <div class="row ">
   
            @foreach($permissions as $perm)
            <?php
                $per_found = null;

                if( isset($role) ) {
                    $per_found = $role->hasPermissionTo($perm->name);
                }

                if( isset($user)) {
                    $per_found = $user->hasDirectPermission($perm->name);
                }
            
            ?>
            
           
                    <div  class="col-sm-1 col-md-4 ">
                        <label class="{{ Str::contains($perm->name, 'supprimer') ? 'text-red-800' : '' }}">
                            <?php $status = $per_found == true ? "checked" : "" ?>
                            <?php $status2 = $options == true ? "disabled" : "" ?>
                            <input type="checkbox"   value="{{$perm->id}}"  wire:click="checkClick({{$perm->id}},{{$role_id}})" name="permission"  class="form-checkbox h-5 w-5 text-gray-600" {{$status}}  {{$status2}}   >
                            &nbsp;
                            {{$perm->name}}
                         
                        </label>
                   </div>
            
            @endforeach
          </div>
          <br><br>
          @can('modifier_roles')
            <button type="submit" class="btn btn-success float-right">
                Enregister {{$role->name}}
            </button>
          @endcan
        </div>
    </div>
</div>


@push('script')
       
@endpush
