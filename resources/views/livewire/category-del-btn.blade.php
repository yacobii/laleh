<?php

use Livewire\Volt\Component;

new class extends Component {

    public $child;

    public function del() {
        $this->child->delete();
        $this->dispatch('refresh');
    }

}

?>

<div>
    <button
        onclick="return confirm('مطمئن هستید؟!!! تمام محصولات زیر مجموعه نیز حذف میشوند ؟؟؟!!!!!!') || event.stopImmediatePropagation()"
        wire:click="del" class="text-red-500 focus:outline-none">x</button>
</div>
