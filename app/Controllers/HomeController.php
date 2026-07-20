<?php
// app/Controllers/HomeController.php
namespace App\Controllers;
use Core\Http\Request;
use Core\Http\Response;
use App\Services\Farmer_ProfilesService;
use App\Services\UsersService;
use App\Services\CategoriesService;
use App\Services\ProductsService;
class HomeController extends Controller
{
       public function __construct(
           private Farmer_ProfilesService $farmerProfilesService,
           private UsersService $usersService,
           private CategoriesService $categoriesService,
            private ProductsService $productsService

    ) {}

   public function index(): void
    {
        $farmerProfiles = $this->farmerProfilesService->all();
        $farmerProfilesCount = $this->farmerProfilesService->count();
        $usersCount = $this->usersService->count();
        $categories = $this->categoriesService->all();

       $products = $this->productsService->allWithImages(); // array ng Products, may imagePath
        $productsCount = $this->productsService->count();     // int lang, hiwalay

        $this->view('home', [
            'farmerProfiles' => $farmerProfiles,
            'farmerProfilesCount' => $farmerProfilesCount,
            'usersCount' => $usersCount,
            'categories' => $categories,
            'products' => $products,
            'productsCount' => $productsCount,
        ]);
    }
           
    


}
