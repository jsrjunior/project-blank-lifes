
@section('form')

    @php(html()->model($instance))

    @php($permission_keys = array_slice(trans('permissions'), 1))
    @php($category_size =  empty(intval(count($permission_keys) / 2)) ? 1 : intval(count($permission_keys)) )
    @php($count_to_split = 0)

    <div class="row">
        <div class="col-lg-12">
            @component('admin.layouts.components.card')
                @slot('title', __('Dados básicos'))

                @component('admin.layouts.components.form.input_text')
                    @slot('type', $type)
                    @slot('name', 'name')
                @endcomponent


            @endcomponent
        </div>

        <div class="col-3">
            @component('admin.layouts.components.card')
                @slot('title', __('Papéis'))

                <div class="row">
                    @foreach ($permission_keys as $category_key => $category)
                        @if($count_to_split % $category_size == 0) 
                            <div class="col-12"> 
                        @endif

                        @foreach ($category as $permission_key => $permission_names)
                            @if ($permission_key === '_')
                                <p class="mt-3 pointer" onClick="hideAllContains('div_roles_'), toogleDivById('div_roles_{{$category_key}}')">
                                    <strong>{{ $permission_names }}</strong>
                                </p>
                            @endif
                        @endforeach

                        @php(++$count_to_split)
                        @if( ($count_to_split % $category_size == 0) || ($count_to_split % ($category_size * 2) == 0))
                            </div>
                        @endif
                    @endforeach
                </div>
            @endcomponent
        </div>

        <div class="col-9">
            @component('admin.layouts.components.card')
                @slot('title', __('Permissões'))

                <div class="row">
                    @foreach ($permission_keys as $category_key => $category)
                        @if($count_to_split % $category_size == 0)
                            <div class="col-12">
                        @endif

                        <div id="div_roles_{{$category_key}}" style="display:none">
                            @foreach ($category as $permission_key => $permission_names)
                                @if ($permission_key === '_')
                                    <h4 class="mt-3">{{ $permission_names }}</h4>
                                @elseif ($permission_key === 'icon')
                                @else
                                    @foreach ($permission_names as $item_type_key => $item_name)
                                        @php($permission = $permissions->where('name', $item_type_key.' '.$permission_key)->first())
                                        @if($permission)
                                            <div class="custom-control custom-checkbox align-items-center ml-3 {{ (str_contains($permission->name, 'manage ')) ? ' mt-4 font-weight-bold' : ' ml-5'}}">
                                                <input type="checkbox" name="permissions[]" id="permission_{{$permission->getKey()}}" class="custom-control-input" value="{{$permission->getKey()}}" {{ $instance->permissions->find($permission->getKey()) ? 'checked' : '' }}>
                                                <label class="custom-control-label text-small" for="permission_{{$permission->getKey()}}">{{$item_name}}</label>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </div>

                        @php(++$count_to_split)
                        @if( ($count_to_split % $category_size == 0) || ($count_to_split % ($category_size * 2) == 0))
                            </div>
                        @endif
                    @endforeach
                
                </div>

            @endcomponent
        </div>

        <div class="form-group">
            {{ html()->submit(modelAction($type, 'save'))->class('btn btn-primary btn-lg') }}
        </div>
    </div>

    @php(html()->endModel())

@endsection
