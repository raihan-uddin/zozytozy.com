<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Vendor;
use Illuminate\Support\Facades\URL;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::active()->get();
        $products = Product::published()->get();
        $banners = Banner::active()->orderBy('order_column', 'desc')->get();

        $vendors = Vendor::active()->featured()->orderByName()->get();

        $sliders = $banners->where('section', 'slider');
        $featuredBanners = $banners->where('section', 'featured');

        $tags = Tag::all();

        $mostLovedProducts = Product::with([
            'variants:id,product_id,size,color,price,sku,stock',
            'categories',
        ])->published()
            ->where(function ($query) {
                $query->where('stock_quantity', '>', 0)
                    ->orWhere('allow_out_of_stock_orders', 1);
            })
            ->inRandomOrder()
            ->take(4)
            ->get();

        // latest products with variants and categories relationship take 30 products
        $latestProducts = Product::with([
            'variants:id,product_id,size,color,price,sku,stock',
            'categories',
        ])
            ->published()
            ->where(function ($query) {
                $query->where('stock_quantity', '>', 0)
                    ->orWhere('allow_out_of_stock_orders', 1);
            })
            ->latest()
            ->take(24)
            ->get();

        // product has multiple categories so we need to get unique categories
        $latestCategories = Category::with([
            'products' => function ($query) {
                $query->published();
                $query->take(24);
            },
        ])
            ->showOnHome()
            ->whereHas('products', function ($query) {
                $query->published();
            })
            ->take(6)
            ->get();

        $metaDescription = 'Discover the finest selection of beauty and health products at BinBox. Buy the best quality products online at affordable prices. Shop skincare, wellness, and beauty essentials crafted from nature for a healthier, more radiant you. Get the latest products and the best deals. Free shipping on all orders above $200.';
        $metaKeywords = 'beauty, health, skincare, wellness, beauty essentials, nature, radiant, skincare products, wellness products, beauty products, beauty deals, free shipping, BinBox, organic beauty, natural products, affordable beauty, skincare essentials, wellness products, online shopping, best beauty deals';

        return view('frontend.pages.home', compact(
            'categories',
            'products',
            'banners',
            'tags',
            'sliders',
            'featuredBanners',
            'mostLovedProducts',
            'latestProducts',
            'latestCategories',
            'vendors',
            'metaDescription',
            'metaKeywords'
        ));
    }

    public function about()
    {
        return view('frontend.pages.about');
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function deliveryInformation()
    {
        return view('frontend.pages.delivery-information');
    }

    public function privacyPolicy()
    {
        return view('frontend.pages.privacy-policy');
    }

    public function termsOfService()
    {
        return view('frontend.pages.terms-of-service');
    }

    public function returnPolicy()
    {
        return view('frontend.pages.return-policy');
    }

    public function vendors()
    {
        $vendors = Vendor::active()->get();
        $pageTitle = 'Brands';

        return view('frontend.pages.vendors', compact('vendors', 'pageTitle'));
    }

    public function sitemap()
    {
        // Create XML header
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Add the homepage
        $sitemap .= $this->generateUrl(URL::to('/'), now(), '1.0', 'daily');

        // Add static pages (adjust based on your routes)
        $sitemap .= $this->generateUrl(URL::to('/about-us'), now(), '0.8', 'monthly');
        $sitemap .= $this->generateUrl(URL::to('/contact-us'), now(), '0.8', 'monthly');
        $sitemap .= $this->generateUrl(URL::to('/delivery-information'), now(), '0.8', 'monthly');
        $sitemap .= $this->generateUrl(URL::to('/privacy-policy'), now(), '0.8', 'monthly');
        $sitemap .= $this->generateUrl(URL::to('/terms-of-service'), now(), '0.8', 'monthly');
        $sitemap .= $this->generateUrl(URL::to('/return-policy'), now(), '0.8', 'monthly');
        $sitemap .= $this->generateUrl(URL::to('/become-a-wholesaler'), now(), '0.8', 'monthly');

        // Add dynamic product URLs
        $products = Product::with('categories')->get(); // Assuming your product model is set up
        foreach ($products as $product) {
            $productUrl = route('product.detail', [$product->categories->first()->slug, $product->slug]);
            $sitemap .= $this->generateUrl($productUrl, $product->updated_at, '0.9', 'weekly');
        }

        // Add dynamic category URLs
        $categories = Category::all(); // Assuming your category model is set up
        foreach ($categories as $category) {
            $categoryUrl = route('category.products', ['slug' => $category->slug]);
            $sitemap .= $this->generateUrl($categoryUrl, $category->updated_at, '0.7', 'monthly');
        }

        // Close the XML tags
        $sitemap .= '</urlset>';

        // Return the sitemap as an XML response
        return response($sitemap, 200)
            ->header('Content-Type', 'application/xml');
    }

    private function generateUrl($url, $lastModified, $priority, $changeFrequency)
    {
        return "<url>
                    <loc>{$url}</loc>
                    <lastmod>{$lastModified->toAtomString()}</lastmod>
                    <priority>{$priority}</priority>
                    <changefreq>{$changeFrequency}</changefreq>
                </url>";
    }

    public function robots()
    {
        // Define the contents of the robots.txt
        $robotsContent = '
            User-agent: *
            Disallow: /admin/
            Disallow: /cart/
            Disallow: /checkout/
            Disallow: /order/

            Sitemap: '.url('sitemap.xml').'
        ';

        // Return the robots.txt content as a response
        return response($robotsContent, 200)
            ->header('Content-Type', 'text/plain');
    }
}
