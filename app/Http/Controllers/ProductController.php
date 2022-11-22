<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //list page
    public function list() {
        $pizzas = Product::select('products.*','categories.name as category_name')
            ->when(request('key'), function ($query) {
            $query->where('products.name', 'like', '%' . request('key') . '%');
            })
            ->leftJoin('categories','products.category_id','categories.id')
            ->orderBy('products.created_at', 'desc')
            ->paginate(3);
        // dd($pizzas->toArray());
        $pizzas->appends(request()->all());
        return view('admin.product.pizzaList', compact('pizzas'));
    }

    //direct create page
    public function createPage()
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.product.create', compact('categories'));
    }

    //create pizza
    public function create(Request $request)
    {
        $this->productValidationCheck($request, 'create');
        $data = $this->requestProductInfo($request);

        $fileName = uniqid() . "_" . $request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public', $fileName);
        $data['image'] = $fileName;

        Product::create($data);
        return redirect()->route('product#list');
    }

    //delete pizza
    public function delete($id)
    {
        Product::where('id', $id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess' => 'Data was deleted.']);
    }

    //view page pizza
    public function edit($id)
    {
        $pizza = Product::select('products.*','categories.name as category_name')
                ->leftJoin('categories','products.category_id','categories.id')
                ->where('products.id', $id)->first();
        return view('admin.product.edit', compact('pizza'));
    }

    //direct update page pizza
    public function updatePage($id)
    {
        $pizza = Product::where('id', $id)->first();
        $categories = Category::get();
        return view('admin.product.update', compact('pizza', 'categories'));
    }

    //update pizza
    public function update(Request $request)
    {
        $this->productValidationCheck($request, 'update');
        $data = $this->requestProductInfo($request);
        if ($request->hasFile('pizzaImage')) {
            $oldImageName = Product::where('id', $request->pizzaId)->first();
            $oldImageName = $oldImageName->image;
            if ($oldImageName != null) {
                Storage::delete(['public/' . $oldImageName]);
            }
            $fileName = uniqid() . "_" . $request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }
        Product::where('id', $request->pizzaId)->update($data);
        return redirect()->route('product#list');
    }

    //private function session
    // request data
    private function requestProductInfo($request)
    {
        return [
            'category_id' => $request->pizzaCategory,
            'name' => $request->pizzaName,
            'description' => $request->pizzaDescription,
            'price' => $request->pizzaPrice,
            'waiting_time' => $request->pizzaWaitingTime,
        ];
    }

    //validation check
    private function productValidationCheck($request, $action)
    {
        $validationRules = [
            'pizzaName' => 'required|min:5|unique:products,name,' . $request->pizzaId,
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required|min:10',
            'pizzaPrice' => 'required',
            'pizzaWaitingTime' => 'required',
        ];
        $validationRules['pizzaImage'] = $action == "create" ? 'required|mimes:png,jpg,jpeg,svg,gif|file|image' : 'mimes:png,jpg,jpeg,svg,gif|file|image';
        Validator::make($request->all(), $validationRules)->validate();
    }
}
