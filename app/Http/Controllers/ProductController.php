<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;
use App\Models\Variant;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Initialize the query
        $query = Product::query();

        // Filters
        if ($request->has('filter')) {
            $filters = $request->get('filter');

            // Filter by name
            if (!empty($filters['name'])) {
                $query->where('name', 'like', '%' . $filters['name'] . '%');
            }

            // Filter by price range (min and max)
            if (!empty($filters['min_price'])) {
                $query->where('price', '>=', $filters['min_price']);
            }

            if (!empty($filters['max_price'])) {
                $query->where('price', '<=', $filters['max_price']);
            }

            // Filter by status
            if (!empty($filters['status'])) {
                $query->where('status', $filters['status']);
            }

            // Filter by category if applicable
            if (!empty($filters['category'])) {
                $query->whereHas('categories', function ($query) use ($filters) {
                    $query->where('id', $filters['category']);
                });
            }
        }

        // Sorting (optional)
        if ($request->has('sort_by') && !empty($request->get('sort_by'))) {
            $validSortColumns = ['name', 'price', 'created_at']; // Define valid columns for sorting
            $sortBy = $request->get('sort_by');

            // Ensure that the sort_by value is valid
            if (in_array($sortBy, $validSortColumns)) {
                $sortDirection = $request->get('sort_direction', 'asc'); // Default to ascending
                $query->orderBy($sortBy, $sortDirection);
            }
        }
        // Get paginated results
        $products = $query->paginate(40);

        $pageTitle = 'Products';

        $categories = Category::active()->orderBy('name')->get();

        // Pass filters to the view to maintain the state
        return view('admin.products.index', [
            'pageTitle' => $pageTitle,
            'products' => $products,
            'categories' => $categories,
            'filter' => $request->get('filter', []),  // To maintain the filter state in the view
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // get the list of tags in alphabetical order
        $tags = Tag::active()->orderBy('name')->get();
        $categories = Category::active()->orderBy('name')->get();
        $vendors = Vendor::orderBy('name')->get();
        $pageTitle = 'Create Product';

        return view('admin.products.create', compact('pageTitle', 'tags', 'categories', 'vendors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        // start a transaction
        DB::beginTransaction();

        try {
            $product = new Product;
            $product->name = $request->name;
            $product->slug = $request->slug;
            $product->sku = $request->sku;
            $product->vendor_id = $request->vendor_id;
            $product->full_description = $request->full_description;
            $product->price = $request->price;
            $product->discount_price = $request->discount_price;
            $product->tax_rate = $request->tax_rate ?? 0;
            $product->is_taxable = $request->is_taxable ?? 0;
            $product->stock_quantity = $request->stock_quantity;
            $product->in_stock = $request->in_stock;
            $product->allow_out_of_stock_orders = $request->allow_out_of_stock_orders;
            $product->min_order_quantity = $request->min_order_quantity;
            $product->max_order_quantity = $request->max_order_quantity;
            $product->barcode = $request->barcode;
            $product->weight = $request->weight;
            $product->weight_unit = $request->weight_unit;
            $product->length = $request->length;
            $product->width = $request->width;
            $product->height = $request->height;
            $product->is_featured = $request->is_featured;
            $product->is_visible = $request->is_visible ?? 1;
            $product->is_digital = $request->is_digital ?? 0;
            $product->status = $request->status;
            if ($request->has('published_at')) {
                $product->published_at = $request->published_at;
            }
            if ($request->hasFile('featured_image')) {
                $product->featured_image = $request->file('featured_image')->store('featured', 'public');
            }
            if (!$product->save()) {
                // Rollback the transaction
                DB::rollBack();
                // Log the error
                Log::error('Error saving product');
                throw new \Exception('Error saving product');
            }

            // Attach categories
            $product->categories()->attach($request->categories);

            // Attach tags
            if ($request->has('tags')) {
                $product->tags()->attach($request->tags);
            }

            // Store additional images
            if ($request->hasFile('additional_images')) {
                foreach ($request->file('additional_images') as $image) {
                    $path = $image->store('product_images', 'public');
                    $product->images()->create(['image_path' => $path]);
                }
            }

            // Store product variants
            if ($request->has('variants')) {
                foreach ($request->variants as $key => $variant) {
                    $variant['weight'] = rtrim(rtrim($variant['weight'], '0'), '.');
                    $productVariant = new Variant;
                    $productVariant->product_id = $product->id;
                    $productVariant->color = $variant['color'];
                    $productVariant->price = $variant['price'];
                    $productVariant->sku = $variant['sku'];
                    $productVariant->stock = $variant['stock'];
                    if ($variant['weight'] > 0 && $variant['weight_unit'] != null) {
                        $productVariant->weight = $variant['weight'];
                        $productVariant->weight_unit = $variant['weight_unit'];
                        $productVariant->size = $productVariant->weight . ' ' . $productVariant->weight_unit;
                    }
                    if (!$productVariant->save()) {
                        // Rollback the transaction
                        DB::rollBack();
                        // Log the error
                        Log::error('Error saving product variant');
                        throw new \Exception('Error saving product variant');
                    }
                }
            }

            // Update the product full text
            $product->full_text = $this->generateFullTextSearchOfProduct($product);
            $product->save();

            // Commit the transaction
            DB::commit();
        } catch (\Exception $e) {
            //TODO:: remove the featured image if it was saved

            //TODO: remove the additional images if they were saved
            info($e->getMessage());

            // Rollback the transaction
            DB::rollBack();
            // Log the error
            Log::error($e->getMessage());

            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }

        return url()->previous()
            ? redirect()->back()->with('success', 'Product created successfully.')
            : redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch the product
        $product = Product::with('tags', 'images', 'tags', 'categories', 'variants', 'vendor')->findOrFail($id);

        $pageTitle = 'Product Details: ' . $product->name;

        return view('admin.products.show', compact('product', 'pageTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Eager load the tags, images, and categories
        $product->load('tags', 'images', 'categories', 'variants', 'vendor');

        // get the list of tags in alphabetical order
        $tags = Tag::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $vendors = Vendor::orderBy('name')->get();

        $pageTitle = 'Edit Product: ' . $product->name;

        return view('admin.products.edit', compact('product', 'pageTitle', 'tags', 'categories', 'vendors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        // start a transaction
        DB::beginTransaction();

        try {
            $product->name = $request->name;
            $product->slug = $request->slug;
            $product->sku = $request->sku;
            $product->vendor_id = $request->vendor_id;
            $product->full_description = $request->full_description;
            $product->price = $request->price;
            $product->discount_price = $request->discount_price;
            $product->tax_rate = $request->tax_rate ?? 0;
            $product->is_taxable = $request->is_taxable ?? 0;
            $product->stock_quantity = $request->stock_quantity;
            $product->in_stock = $request->in_stock;
            $product->allow_out_of_stock_orders = $request->allow_out_of_stock_orders;
            $product->min_order_quantity = $request->min_order_quantity;
            $product->max_order_quantity = $request->max_order_quantity;
            $product->barcode = $request->barcode;
            if ($request->has('weight') && $request->has('weight_unit')) {
                if ($request->weight == 0) {
                    $product->weight = null;
                    $product->weight_unit = null;
                } else {
                    $product->weight = $request->weight;
                    $product->weight_unit = $request->weight_unit;
                }
            }
            $product->weight = $request->weight;
            $product->weight_unit = $request->weight_unit;
            $product->length = $request->length;
            $product->width = $request->width;
            $product->height = $request->height;
            $product->is_featured = $request->is_featured;
            $product->is_visible = $request->is_visible ?? 1;
            $product->is_digital = $request->is_digital ?? 0;
            $product->status = $request->status;
            if ($request->has('published_at')) {
                $product->published_at = $request->published_at;
            }
            if ($request->hasFile('featured_image')) {
                // Delete the old featured image
                Storage::disk('public')->delete($product->featured_image);
                $product->featured_image = $request->file('featured_image')->store('featured', 'public');
            }
            if (!$product->save()) {
                // Rollback the transaction
                DB::rollBack();
                // Log the error
                Log::error('Error saving product');
                throw new \Exception('Error saving product');
            }

            // Sync categories
            $product->categories()->sync($request->categories);

            // Sync tags
            if ($request->has('tags')) {
                $product->tags()->sync($request->tags);
            }
            // Store additional images
            if ($request->hasFile('additional_images')) {
                foreach ($request->file('additional_images') as $image) {
                    $path = $image->store('product_images', 'public');
                    $product->images()->create(['image_path' => $path]);
                }
            }

            // Store product variants
            if ($request->has('variants')) {
                // remove existing variants
                $product->variants()->delete();

                foreach ($request->variants as $key => $variant) {
                    $productVariant = new Variant;
                    $productVariant->product_id = $product->id;
                    $productVariant->color = $variant['color'];
                    $productVariant->price = $variant['price'];
                    $productVariant->sku = $variant['sku'];
                    $productVariant->stock = $variant['stock'];
                    if ($variant['weight'] > 0 && $variant['weight_unit'] != null) {
                        // remove the 0 after the decimal point
                        $variant['weight'] = rtrim(rtrim($variant['weight'], '0'), '.');
                        $productVariant->weight = $variant['weight'];
                        $productVariant->weight_unit = $variant['weight_unit'];
                        $productVariant->size = $productVariant->weight . ' ' . $productVariant->weight_unit;
                    } else {
                        $productVariant->size = null;
                        $productVariant->weight = null;
                        $productVariant->weight_unit = null;
                    }

                    if (!$productVariant->save()) {
                        // Rollback the transaction
                        DB::rollBack();
                        // Log the error
                        Log::error('Error saving product variant');
                        throw new \Exception('Error saving product variant');
                    }
                }
            }

            // Update the product full text
            $product->full_text = $this->generateFullTextSearchOfProduct($product);
            $product->save();

            // Commit the transaction
            DB::commit();

            return url()->previous()
                ? redirect()->back()->with('success', 'Product updated successfully.')
                : redirect()->route('products.index')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            info($e->getMessage());

            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();

            return url()->previous()
                ? redirect()->back()->with('success', 'Product deleted successfully.')
                : redirect()->route('products.index')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function removeGalleryImage(Request $request)
    {
        $request->validate([
            'image_id' => 'required|exists:product_images,id',
        ]);

        $image = ProductImage::find($request->image_id);

        // Delete the image file from storage if necessary
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        // Delete the image record from the database
        $image->delete();

        return response()->json(['success' => true]);
    }

    // product full text will be, product name, vendor, unique (categories, tags), veriants
    public function generateFullTextSearchOfProduct($product)
    {
        $productFullText = $product->name;

        // Handle categories comma separated string
        $categories = $product->categories->pluck('name')->toArray();
        if (!empty($categories)) {
            $productFullText .= ', ' . implode(', ', $categories);
        }

        // if vendor is available
        if ($product->vendor) {
            $productFullText .= ', ' . $product->vendor->name;
        }

        return $productFullText;
    }
}
