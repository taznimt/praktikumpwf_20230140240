<form action="{{ $url }}" method="POST" class="inline-block"
      onsubmit="return confirm('Yakin hapus {{ $name }} ini?')">
    @csrf
    @method('DELETE')

    <button type="submit"
        class="inline-flex items-center gap-2 px-4 py-2 border border-red-500 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition duration-150">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h8" />
        </svg>
        Delete {{ $name }}
    </button>
</form>