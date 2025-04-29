<?php
 namespace App\Models;

 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;
 
 class Product extends Model
 {
     use HasFactory;
 
     protected $fillable = [
         'name', 'price', 'discount', 'description', 'rating', 'reviews'
     ];
 
     // Relationship: A product can have many images
     public function images()
     {
         return $this->hasMany(ProductImage::class);
     }
 
     // Get the primary image
     public function primaryImage()
     {
         return $this->images()->where('is_primary', true)->first();
     }
     public function firstImage()
     {
         return $this->hasOne(ProductImage::class)->oldestOfMany();
     }
     
     

 }
 