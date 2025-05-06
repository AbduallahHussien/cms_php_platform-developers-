<style>

    .form-check-label{
        font-weight : 500 !important
    }
</style>
<x-core::form.on-off.checkbox
    name="is_enabled"
    :label="trans('plugins/gift::gift.disable')"
    :checked="setting('is_enabled', false)" 
    data-bb-toggle="collapse"
    data-bb-target=".enable-disable-gift"
    class="mb-0"
    :wrapper="false"
/>


<x-core::form.fieldset
    class="enable-disable-gift mt-3"
    data-bb-value="1"
    @style(['display: none' => !setting('is_enabled', true)])
>
    <x-core::form.text-input
        :label="trans('plugins/gift::gift.disable_msg')"
        class="enable-disable-gift mt-3"
        name="disable_msg"  
        :value="setting('disable_msg')"
    >
    </x-core::form.text-input>
</x-core::form.fieldset>
