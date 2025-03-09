<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function categoryProducts($slug, Request $request)
    {
        $category = Category::where('slug', $slug)->first();
        if (! $category) {
            abort(404);
        }
        // Get the sort_by parameter from the request
        $sortBy = $request->input('sort_by');

        $allCategories = Category::withCount('products')->active()->get();
        $products = $category->products();

        $products = $products->published();

        // if request sort_by then sort products (position, relevance, name_asc, name_desc, price_asc, price_desc, newest, oldest)
        switch ($sortBy) {
            case 'name_asc':
                $products = $products->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $products = $products->orderBy('name', 'desc');
                break;
            case 'price_asc':
                $products = $products->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $products = $products->orderBy('price', 'desc');
                break;
            case 'newest':
                $products = $products->latest();
                break;
            case 'oldest':
                $products = $products->oldest();
                break;
            default:
                $products = $products->orderBy('id', 'desc');
                break;
        }
        // Apply sorting based on the sort_by value
        $products = $products->paginate(12);
        $pageTitle = $category->name;
        $metaDescription = $category->name;
        $metaKeywords = $category->name;
        $metaImage = $category->image ? asset('storage/'.$category->image) : asset('images/logos/logo.png');

        return view('frontend.pages.category-product', compact(
            'category',
            'products',
            'allCategories',
            'pageTitle',
            'metaKeywords',
            'metaDescription',
            'metaImage'
        ));
    }

    public function tagProducts($slug, Request $request)
    {
        $tag = Tag::where('slug', $slug)->first();
        if (! $tag) {
            abort(404);
        }

        // Get the sort_by parameter from the request
        $sortBy = $request->input('sort_by');

        $allCategories = Category::withCount('products')->active()->get();

        $products = $tag->products()->published();
        switch ($sortBy) {
            case 'name_asc':
                $products = $products->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $products = $products->orderBy('name', 'desc');
                break;
            case 'price_asc':
                $products = $products->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $products = $products->orderBy('price', 'desc');
                break;
            case 'newest':
                $products = $products->latest();
                break;
            case 'oldest':
                $products = $products->oldest();
                break;
            default:
                $products = $products->orderBy('id', 'desc');
                break;
        }
        // Apply sorting based on the sort_by value
        $products = $products->paginate(12);

        return view('frontend.pages.tag-products', compact('tag', 'products', 'allCategories'));
    }

    public function productDetail($category_slug, $slug)
    {
        $product = Product::with(['variants', 'categories', 'images'])->published()->where('slug', $slug)->first();
        // if product not found then show 404 page
        if (! $product) {
            abort(404);
        }

        //  get related products by category
        $relatedCategories = $product->categories;
        $relatedProducts = Product::with(['variants', 'categories', 'images'])
            ->whereHas('categories', function ($query) use ($relatedCategories) {
                $query->whereIn('categories.id', $relatedCategories->pluck('id'));
            })
            ->where('id', '!=', $product->id)
            ->published()
            ->take(8)
            ->get();

        $pageTitle = $product->name;
        $metaDescription = ! empty($product->full_description)
    ? substr(preg_replace('/\s+/', ' ', strip_tags($product->full_description)), 0, 160)
    : substr(preg_replace('/\s+/', ' ', strip_tags($product->name)), 0, 160);
        $metaKeywords = $this->generateProductKeywords($product);
        $metaImage = asset('storage/'.$product->featured_image);

        return view('frontend.pages.product-detail', compact(
            'product',
            'relatedProducts',
            'pageTitle',
            'metaKeywords',
            'metaDescription',
            'metaImage'
        ));
    }

    // show product on modal
    public function quickView(Request $request)
    {
        // validate request
        $request->validate([
            'id' => 'required|integer|exists:products,id',
        ]);

        $id = $request->input('id');

        $product = Product::with(['variants', 'categories', 'images'])->published()->where('id', $id)->first();
        if (! $product) {
            abort(404);
        }

        return view('frontend.pages.quick-view', compact('product'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|string|min:2',
        ]);
        $query = $request->input('search');

        $products = Product::with('categories')
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhere('sku', 'LIKE', "%{$query}%")
            ->select('id', 'name', 'slug', 'price', 'discount_price', 'featured_image', 'full_description')
            ->published()
            ->take(30)
            ->orderBy('name')
            ->get();

        return response()->json($products);
    }

    public function searchView(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'LIKE', "%{$query}%")->get();

        // return view('search-results', compact('products', 'query')); // Adjust as necessary for your view
        // redirect to home page
        return redirect()->route('home');
    }

    private function generateProductKeywords($product)
    {

        $keywords = [];
        $keywords[] = $product->name;
        $keywords[] = $product->sku;
        $keywords[] = $product->barcode;
        $keywords[] = $product->meta_title;
        $keywords[] = $product->meta_description;
        $keywords[] = $product->meta_keywords;
        // get all categories
        $categories = $product->categories;
        foreach ($categories as $category) {
            $keywords[] = $category->name;
        }
        // get all tags
        $tags = $product->tags;
        foreach ($tags as $tag) {
            $keywords[] = $tag->name;
        }

        // vendor name
        $vendor = $product->vendor;
        if ($vendor) {
            $keywords[] = $vendor->name;
        }

        // get all variants
        $variants = $product->variants;
        foreach ($variants as $variant) {
            $keywords[] = $variant->name;
            $keywords[] = $variant->sku;
            $keywords[] = $variant->barcode;
        }

        // remove duplicates
        $keywords = array_unique($keywords);

        // remove empty values
        $keywords = array_filter($keywords);

        $keyWordsString = implode(',', $keywords);

        // remove special characters
        $keyWordsString = preg_replace('/[^A-Za-z0-9\-]/', ' ', $keyWordsString);
        // remove multiple spaces
        $keyWordsString = preg_replace('/\s+/', ' ', $keyWordsString);
        // remove leading and trailing spaces
        $keyWordsString = trim($keyWordsString);

        //  remove html tags
        $keyWordsString = strip_tags($keyWordsString);

        // remove single characters
        $keyWordsString = preg_replace('/\b\w\b\s?/', '', $keyWordsString);

        return $keyWordsString;
    }
}
