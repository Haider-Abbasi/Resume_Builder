@props(['disabled' => false])

<div class="relative">
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}>

    <button type="button" class="absolute top-1/2 right-3 transform -translate-y-1/2 text-gray-500" onclick="togglePasswordVisibility(this)">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.4 4.6a9 9 0 1 0-12.73 12.73L12 17.47l2.73-2.74A9 9 0 0 0 19.4 4.6z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9a3 3 0 0 1 0 6 3 3 0 0 1 0-6z"/>
        </svg>
    </button>
</div>

<script>
    function togglePasswordVisibility(button) {
        var input = button.previousElementSibling;
        if (input.type === "password") {
            input.type = "text";
            button.classList.add("text-indigo-500");
        } else {
            input.type = "password";
            button.classList.remove("text-indigo-500");
        }
    }
</script> 