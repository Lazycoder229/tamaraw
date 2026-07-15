<?php
// app/Controllers/HomeController.php
namespace App\Controllers;

// walang use statement na kailangan — same namespace na
class HomeController extends Controller
{
    public function index(): never
    {
        $this->view('home');
    }

   public function products(): never
{
    $listings = [
        ['id'=>1,'name'=>'Ampalaya (Bitter Melon)','farm'=>'Dela Cruz Family Farm','barangay'=>'Brgy. Batangan, Baco','category'=>'Vegetables','price'=>45,'unit'=>'per kg','minOrder'=>'5 kg','stock'=>120,'certified'=>true,'badge'=>'In Season','img'=>'https://images.unsplash.com/photo-1590779033100-9f60a05a013d?w=600&h=680&fit=crop&auto=format'],
        ['id'=>2,'name'=>'Pechay Baguio','farm'=>'Santos Organic Produce','barangay'=>'Brgy. San Andres, Baco','category'=>'Vegetables','price'=>60,'unit'=>'per kg','minOrder'=>'3 kg','stock'=>85,'certified'=>true,'badge'=>'Organic','img'=>'https://images.unsplash.com/photo-1566385101042-1a0aa0c1268c?w=600&h=680&fit=crop&auto=format'],
        ['id'=>3,'name'=>'Saging na Saba','farm'=>'Mendoza Tropical Farms','barangay'=>'Brgy. Calubian, Baco','category'=>'Fruits','price'=>35,'unit'=>'per kg','minOrder'=>'10 kg','stock'=>200,'certified'=>false,'badge'=>'Bulk Available','img'=>'https://images.unsplash.com/photo-1518843875459-f738682238a6?w=600&h=680&fit=crop&auto=format'],
        ['id'=>4,'name'=>'Kamatis (Tomato)','farm'=>'Baco Agri Cooperative','barangay'=>'Brgy. Poblacion, Baco','category'=>'Vegetables','price'=>75,'unit'=>'per kg','minOrder'=>'2 kg','stock'=>60,'certified'=>true,'badge'=>'Best Seller','img'=>'https://images.unsplash.com/photo-1504472685735-9bd4075b3779?w=600&h=680&fit=crop&auto=format'],
        ['id'=>5,'name'=>'Sitaw (Long Beans)','farm'=>'Reyes Highland Farm','barangay'=>'Brgy. Lumangbayan, Baco','category'=>'Vegetables','price'=>55,'unit'=>'per kg','minOrder'=>'3 kg','stock'=>95,'certified'=>false,'badge'=>null,'img'=>'https://images.unsplash.com/photo-1597362925123-77861d3fbac7?w=600&h=680&fit=crop&auto=format'],
        ['id'=>6,'name'=>'Palay (Unmilled Rice)','farm'=>'Baco Rice Growers Assoc.','barangay'=>'Brgy. San Ignacio, Baco','category'=>'Grains','price'=>22,'unit'=>'per kg','minOrder'=>'50 kg','stock'=>2000,'certified'=>false,'badge'=>'Wholesale','img'=>'https://images.unsplash.com/photo-1579113800032-c38bd7635818?w=600&h=680&fit=crop&auto=format'],
    ];

    $this->view('products.products', compact('listings'));
}
    public function cart(): never
    {
        $this->view('products.cart');
    }

    public function checkout(): never
    {
        $this->view('products.checkout');
    }

  
}