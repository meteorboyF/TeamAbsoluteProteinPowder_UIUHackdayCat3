<?php

namespace App\Livewire\Features;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Database\Eloquent\Model;
use App\Models\Media;

class FileUploader extends Component
{
    use WithFileUploads;

    public $model;
    public $photos = []; // Supports multiple files
    public $uploads = []; // Existing uploads

    public function mount(Model $model)
    {
        $this->model = $model;
        $this->refreshUploads();
    }

    public function refreshUploads()
    {
        $this->uploads = Media::where('mediable_id', $this->model->id)
            ->where('mediable_type', get_class($this->model))
            ->latest()
            ->get();
    }

    public function updatedPhotos()
    {
        $this->validate([
            'photos.*' => 'image|max:10240', // 10MB Max (mock validation, generic file support in real app)
        ]);

        foreach ($this->photos as $photo) {
            // In a real app, store to S3/Disk. For Hackathon/Demo without storage linking, we simulate or store to public.
            // Using store() requires generic filesystem config.
            // We'll simulate a path for the generic skeleton.

            $path = $photo->store('uploads', 'public');

            Media::create([
                'user_id' => auth()->id() ?? 1,
                'file_path' => $path,
                'file_name' => $photo->getClientOriginalName(),
                'mime_type' => $photo->getMimeType(),
                'size' => $photo->getSize(),
                'mediable_id' => $this->model->id,
                'mediable_type' => get_class($this->model),
            ]);
        }

        $this->photos = [];
        $this->refreshUploads();

        $this->dispatch('close-modal', 'upload-modal-' . $this->model->id);
        $this->dispatch('notify', type: 'success', message: 'Files uploaded successfully!');
    }

    public function deleteUpload($id)
    {
        Media::find($id)->delete();
        $this->refreshUploads();
    }

    public function render()
    {
        return view('livewire.features.file-uploader');
    }
}
