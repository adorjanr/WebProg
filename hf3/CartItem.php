<?php


class CartItem
{
    private Product $product;
    private int $quantity;

    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }
        
    public function getProduct(): Product {return $this->product;}

    public function getQuantity(): int {return $this->quantity;}

    public function setProduct(Product $x): void {$this->product = $x;}

    public function setQuantity(int $x): void {$this->quantity = $x;}

    public function increaseQuantity()
    {
        if ($this->quantity < $this->product->getAvailableQuantity()) $this->quantity++;
    }

    public function decreaseQuantity()
    {
        if ($this->quantity > 1) $this->quantity--;
    }
}