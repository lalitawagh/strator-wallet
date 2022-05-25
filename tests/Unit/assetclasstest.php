<?php

namespace Kanexy\LedgerFoundation\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Kanexy\Cms\CmsServiceProvider;
use Kanexy\LedgerFoundation\LedgerFoundationServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Asset;

class TestCase extends Asset
{
  public function index()
    {
        $products = Product::latest()->paginate(5);
    
        return view('products.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
     
   
    public function create()
    {
        return view('products.create');
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
    
        Product::create($request->all());
     
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }
     
    
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    } 
     
  
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }
    
    
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
    
        $product->update($request->all());
    
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }
    
    public function destroy(Product $product)
    {
        $product->delete();
    
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}


    public function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Kanexy\\
            LedgerFoundation\\Database\\Factories\\' . class_basename($modelName) . 'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            PartnerFoundationServiceProvider::class,
            LivewireServiceProvider::class,
            CmsServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {

        $app['config']->set('view.paths', [
            __DIR__.'/views',
            resource_path('views'),
        ]);

        $app['config']->set('app.key', 'base64:Hupx3yAySikrM2/edkZQNQHslgDWYfiBfCuSThJ5SK8=');

        $app['config']->set('database.connections.mysql', [
            'driver'   => 'mysql',
            'database' => 'kanexyv1',
            'prefix'   => '',
            'host' => '127.0.0.1',
            'username'=> 'root',
            'password' => ''
        ]);
    }
}
