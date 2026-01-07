<?php

namespace App\Livewire\Core;

use App\Models\ApiToken;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ApiTokenManager extends Component
{
    public $name = '';
    public $showToken = null;

    public function create()
    {
        $this->validate(['name' => 'required|string|max:255']);

        $token = ApiToken::create([
            'user_id' => Auth::id(),
            'name' => $this->name,
        ]);

        $this->name = '';
        $this->showToken = $token->token;
    }

    public function delete($id)
    {
        ApiToken::where('id', $id)->where('user_id', Auth::id())->delete();
    }

    public function render()
    {
        return view('livewire.core.api-token-manager', [
            'tokens' => ApiToken::where('user_id', Auth::id())->latest()->get()
        ]);
    }
}
