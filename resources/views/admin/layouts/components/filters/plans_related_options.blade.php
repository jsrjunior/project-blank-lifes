<option value=""></option>
@if(!empty($plans))
@foreach ($plans as $plan)
    <option value="{{ $plan->id }}"> {{ $plan->title }} </option>    
@endforeach
@endif