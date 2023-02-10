<form wire:submit.prevent="submit">
    {{ $this->form }}
 
    <div class="mt-8">
        <button type="submit" class="btn-primary">
            Submit
        </button>
    </div>
</form>