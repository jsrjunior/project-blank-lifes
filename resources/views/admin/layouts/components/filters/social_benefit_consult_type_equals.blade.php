@php(asort($socialBenefictsConsultType))

<div class="form-group">
    {{ html()->label(__($label ?? 'Tipo de Beneficio Social'), 'q[social_benefit_consult_type_id]') }}
    {{ html()->select('q[social_benefit_consult_type_id]', $socialBenefictsConsultType, request()->input('q.social_benefit_consult_type_id'))->placeholder('')->class('form-control') }}
</div>
