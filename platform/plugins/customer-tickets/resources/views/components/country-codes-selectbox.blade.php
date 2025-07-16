<style>
    /* Container of the plugin */
.iti {
    width: 100%; /* or any custom width */
}
</style>

 
<div class="mb-3">
    <label for="phone" class="form-label">Phone Number</label>
    {{-- <input type="tel" class="form-control" id="phone" name="phone" required>  
    <input type="hidden" name="phone_code" id="dial_code"> --}}

     

    <input type="tel" class="form-control" id="phone" name="phone"
       value="{{ $customer->phone }}" required>

    <input type="hidden" name="phone_code" id="dial_code" value="{{ $customer->phone_code }}">

    <input type="hidden" id="fullPhoneNumber" name="fullPhoneNumber" value="{{ '+'.$customer->phone_code.$customer->phone }}">

</div>
 