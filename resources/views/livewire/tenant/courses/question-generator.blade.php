<form action="" wire:submit.prevent="generate">
    {{ $this->form }}

    <div class="flex items-center justify-between pt-4 mt-8 border-t">
        <p class="text-xl font-bold text-emerald-900">AI Question Generator</p>
        <div class="flex gap-2">
            <button x-data x-on:click="$dispatch('cloemodal-ai')" type="button" class="btn-default">Cancel</button>
            <button type="submit" class="btn-primary">Generate</button>
        </div>
    </div>
</form>