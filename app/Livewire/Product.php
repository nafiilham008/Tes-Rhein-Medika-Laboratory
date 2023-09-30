<?php

namespace App\Livewire;

use App\Models\Product as ModelsProduct;
use Livewire\Component;

class Product extends Component
{
    public $products, $name, $price, $stock, $product_id;
    public $isModalOpen = 0;

    public function render()
    {
        $this->products = ModelsProduct::all();
        return view('livewire.product')->layout('layouts.app');
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    private function resetCreateForm()
    {
        $this->name = '';
        $this->price = '';
        $this->stock = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|min:3|max:255',
            'price' => 'required|numeric|min:0|max:9999999999.99|regex:/^\d{1,10}(\.\d{1,2})?$/',
            'stock' => 'required|integer|min:0'
        ]);

        try {
            ModelsProduct::updateOrCreate(['id' => $this->product_id], [
                'name' => $this->name,
                'price' => $this->price,
                'stock' => $this->stock
            ]);

            session()->flash(
                'message',
                $this->product_id ? 'Produk diperbarui.' : 'Produk dibuat.'
            );
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menyimpan produk.');
        }

        $this->closeModal();
        $this->resetCreateForm();
    }


    public function edit($id)
    {
        $product = ModelsProduct::findOrFail($id);
        $this->product_id = $id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->stock = $product->stock;

        $this->openModal();
    }

    public function delete($id)
    {
        ModelsProduct::find($id)->delete();
        session()->flash('message', 'Produk dihapus.');
    }
}
