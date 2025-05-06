<style>

    .form-check-label{
        font-weight : 500 !important
    }
</style>

@php  
// $isEnable = true;

// if(!is_null(setting('is_gift_disabled')))
// {
    // $isEnable = setting('is_gift_disabled',true);
// }
// dd($isEnable);
@endphp 
<x-core::form.on-off.checkbox
    name="is_gift_disabled"
    :label="trans('plugins/gift::gift.disable')"
    :checked="setting('is_gift_disabled', false)" 
    data-bb-toggle="collapse"
    data-bb-target=".enable-disable-gift"
    class="mb-0"
    :wrapper="false"
/>


<x-core::form.fieldset
    class="enable-disable-gift mt-3"
    data-bb-value="1"
    @style(['display: none' => !setting('is_gift_disabled', false)])
>
    <x-core::form.text-input
        :label="trans('plugins/gift::gift.disable_gift_msg')"
        class="enable-disable-gift mt-3"
        name="disable_gift_msg"  
        :value="setting('disable_gift_msg')"
    >
    </x-core::form.text-input>
</x-core::form.fieldset>
