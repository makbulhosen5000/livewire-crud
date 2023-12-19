<form>
    <div class="form-group">
        <label for="exampleFormControlInput1">Title:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Title" wire:model="title">
        @error('title') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput2">Description:</label>
        <textarea class="form-control" id="exampleFormControlInput2" wire:model="description" placeholder="Enter Description"></textarea>
        @error('description') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Image</label>
        <input type="file" class="form-control" id="exampleFormControlInput1"  wire:model="image">
        @if ($image)
        <img src="{{ $image->temporaryUrl() }}" width="200">
        @endif
        @error('image') <span class="text-danger">{{ $message }}</span>@enderror
        
    </div>
    <button wire:click.prevent="store()" class="btn btn-success my-3">Submit</button>
</form>