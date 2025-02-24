<?php

namespace App\Livewire\Admin\Items;

use App\Models\Category;
use App\Models\Item;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads; 

    public $imagePath,$item_name, $item_image, $item_price, $item_warranty, $item_purchase, $item_qty, $item_description, $category_id, $i_id;

    public function render()
    {
        $items = Item::orderBy('created_at', 'DESC')->get();
        $categories = Category::orderBy('created_at', 'DESC')->get();
        return view('livewire.admin.items.index', compact('categories', 'items'));
    }

    public function saveItem()
    {
        // Validate input fields
        $validatedData = $this->validate([
            'item_name' => 'required|string|max:255',
            'item_description' => 'nullable|string',
            'category_id' => 'required|integer',
            'item_qty' => 'required|integer|min:1',
            'item_purchase' => 'required|date',
            'item_warranty' => 'nullable|date',
            'item_price' => 'required|numeric|min:0',
            'item_image' => 'nullable|image|max:2048', 
        ]);

        // Check if item already exists in the database (prevent duplicates)
        $existingItem = Item::where('name', $this->item_name)
            ->where('category_id', $this->category_id)
            ->first();

        if ($existingItem) {
            $this->dispatch('saveModal', status: 'warning', position: 'top', message: 'Item already exists!.');
            return;
        }

        // Handle image upload
        if ($this->item_image) {
            $imagePath = $this->item_image->store('items', 'public');
        } else {
            $imagePath = null;
        }

        Item::create([
            'name' => $validatedData['item_name'],
            'description' => $validatedData['item_description'], 
            'category_id' => $validatedData['category_id'], 
            'quantity' => $validatedData['item_qty'], 
            'purchase_date' =>$validatedData['item_purchase'], 
            'warranty_expiry' => $validatedData['item_warranty'], 
            'purchase_price' => $validatedData['item_price'], 
            'image_path' => $imagePath,
        ]);

        $this->resetInput();
        $this->dispatch('saveModal', status: 'success',  position: 'top', message: 'Item save successfully.');
    }

    
    public function closeModal()
    {
        $this->resetInput();
        $this->dispatch('closeModal');
    }

    private function resetInput()
    {
        $this->reset(['item_name', 'item_image', 'item_price', 'item_warranty', 'item_purchase', 'item_qty', 'item_description', 'category_id']);
    }

    
}
