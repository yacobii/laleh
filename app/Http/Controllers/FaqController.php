<?php

namespace App\Http\Controllers;

use App\Http\Resources\BranchResource;
use App\Http\Resources\FaqResource;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    public function faqs()
    {
        return FaqResource::collection(Faq::query()->get());
    }

    public function faq(Faq $branch)
    {
        return new FaqResource($branch);
    }

}
