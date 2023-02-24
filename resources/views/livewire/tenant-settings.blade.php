

<div>
    <header class="flex justify-between px-8 py-6 bg-white">
        <h1 class="text-4xl font-bold leading-7 text-emerald-900 sm:leading-9">Settings</h1>
        <div class="flex gap-6">
            
        </div>
    </header>
    
    <div class="px-8 py-12 space-y-8 bg-gray-100">
        
        <div class="grid grid-cols-3 gap-10">
            <section>
                <h3 class="text-xl font-bold text-emerald-800">Logo</h3>
                <p class="text-gray-700">Upload your institution / company logo</p>

                <div class="p-6 mt-8 bg-white border rounded-md">
                    <div class="p-8 border border-gray-300 border-dashed">
                        {{ $this->logoForm }}
                    </div>
                </div>
            </section>

            <section class="col-span-3">
                <h3 class="text-xl font-bold text-emerald-800">Course Library Management</h3>
                <p class="text-gray-700">Select the Course Libraries you want to be visible in your accounts template library</p>

                <div class="p-6 mt-8 bg-white border rounded-md">
                    {{ $this->libraryForm }}
                </div>
            </section>

            <section class="col-span-3">
                <h3 class="text-xl font-bold text-emerald-800">Allow Full Content Library Access</h3>
                <p class="text-gray-700">Select the Course Libraries you want to be visible in your accounts template library</p>

                <div class="p-6 mt-8 bg-white border rounded-md">
                    {{ $this->permissionForm }}
                </div>
            </section>
        </div>

    </div>
</div>
