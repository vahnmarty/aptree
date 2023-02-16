@push('head-scripts')
<script src="https://unpkg.com/@api.video/video-uploader" defer></script>
@endpush

<form action="" wire:submit.prevent="submit">
    <div class="grid grid-cols-2 gap-6">
        <div>
            {{ $this->form }}
        </div>
        <div>
            <div class="p-6 bg-gray-200 rounded-lg">
                <label for="video" class="block p-4 bg-gray-100 rounded-lg cursor-pointer">
                    <div class="flex items-center justify-center">
                        <x-heroicon-o-upload class="mr-4 w-7 h-7"/>
                        <h3 class="font-bold">Upload Video File</h3>
                    </div>
                    <input type="file" id="video" accept="video/mp4,video/x-m4v,video/*" class="hidden" onchange="uploadFile(this.files)">
                    <p class="mt-2 text-sm text-center">Video types acceptable: .mp4, .mov, .mpeg</p>
                </label>
                
                <script type="text/javascript">
                    function uploadFile(files) {
                        const uploader = new VideoUploader({
                            file: files[0],
                            uploadToken: "{{ config('services.apivideo.upload_token') }}"
                        });

                        uploader.upload()
                            .then((video) => {
                            @this.saveApiVideo(video);
                        });
                    }
                </script>
                <div class="py-6 text-center">
                    <p>or</p>
                </div>
                <div class="flex items-center justify-center">
                    <x-heroicon-s-play class="mr-4 w-7 h-7"/>
                    <h3 class="font-bold">Paste Video Source URL</h3>
                </div>
                <div class="flex gap-2 mt-4">
                    <input wire:model.defer="video_url" type="text" class="w-full border border-gray-300 rounded-md" placeholder="Copy and paste your video link">
                    <button type="button" class="btn-primary">Insert</button>
                </div>
            </div>
        </div>
    </div>

    <div class="flex items-center justify-between pt-4 mt-8 border-t">
        <p class="text-xl font-bold text-emerald-900">Add Video</p>
        <div class="flex gap-2">
            <button type="button" class="btn-default">Cancel</button>
            @if($action == \App\Enums\ActionType::Update)
            <button type="submit" class="btn-warning">Update</button>
            @else
                @if($ready_for_upload)
                <button type="submit" class="btn-primary">Save</button>
                @else
                <button type="submit" class="btn-primary btn-disabled">Save</button>
                @endif
            @endif
        </div>
    </div>
</form>