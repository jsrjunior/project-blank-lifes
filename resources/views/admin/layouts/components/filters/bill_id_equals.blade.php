<div class="form-group">
    {{ html()->label(__('Fatura'), 'q[bill_id][equals]') }}
    {{ html()->text('q[bill_id][equals]', request()->input('q.bill_id.equals'))->class('form-control mask-integer') }}
</div>
