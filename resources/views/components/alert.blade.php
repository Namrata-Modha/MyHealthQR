@if(session($type))
    <div class="bg-{{ $type === 'success' ? 'green-500' : 'red-500' }} text-white text-sm px-4 py-2 rounded-md mt-4 shadow-md">
        ✅ {{ session($type) }}
    </div>
@endif
