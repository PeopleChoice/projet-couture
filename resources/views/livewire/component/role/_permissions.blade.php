

 <div class="w-full my-4">
    <div x-data={show:false} class="rounded-sm">
        <div class="border border-b-0 bg-gray-100 px-10 py-6" id="headingOne">
            <button @click="show=!show" class="underline text-blue-500 hover:text-blue-700 focus:outline-none" type="button">
                {{ isset($title) ? Str::slug($title) : 'Override Permissions' }} {!! isset($user) ? '<span class="">(' . $user->getDirectPermissions()->count() . ')</span>' : '' !!}
            </button>
        </div>
        <div x-show="show" class="border border-b-0 px-10 py-6">
            <div class="grid  md:grid-cols-4 sm:grid-cols-2">
   
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
            
           
                    <div >
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
            <button type="submit" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Enregister {{$role->name}}
            </button>
          @endcan
        </div>
    </div>
</div>


@push('script')
       
@endpush
