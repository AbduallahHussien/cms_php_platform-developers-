<style>
    /* Container of the plugin */
.iti {
    width: 100%; /* or any custom width */
}
</style>


<div class="mb-3">
    <label for="phone" class="form-label">Phone Number</label>
    <input type="tel" class="form-control" id="phone" name="phone" value="{{ $customer->phone }}" required>  
    <input type="hidden" name="phone_code" id="dial_code">
</div>
 