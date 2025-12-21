<div class="form-group">
    {{ html()->label(modelAttribute($type, 'subfolders'), 'q[subfolders]') }}
    {{ html()->multiselect('q[subfolders]', $subfolders, request()->input('q.subfolders'))
        ->id('subfolders')
        ->class('form-control') }}
    @push('scripts')
        <script>
			$(function() {
				$('#subfolders').select2();
			});
        </script>
    @endpush
</div>
