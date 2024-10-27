<?php


class Product
{
    private int $id;
    private string $title;
    private float $price;
    private int $availableQuantity;

    public function __construct(int $id, string $title, float $price, int $availableQuantity)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->availableQuantity = $availableQuantity;
    }

    public function getId(): int {return $this->id;}

    public function getTitle(): string {return $this->title;}

    public function getPrice(): float {return $this->price;}

    public function getAvailableQuantity(): int {return $this->availableQuantity;}

    public function setId(int $x): void {$this->id = $x;}

    public function setTitle(string $x): void {$this->title = $x;}
    
    public function setPrice(float $x): void {$this->price = $x;}
    
    public function setAvailableQuantity(int $x): void {$this->availableQuantity = $x;}

    /**
     * Add Product $product into cart. If product already exists inside cart
     * it must update quantity.
     * This must create CartItem and return CartItem from method
     * Bonus: $quantity must not become more than whatever
     * is $availableQuantity of the Product
     *
     * @param Cart $cart
     * @param int $quantity
     * @return CartItem
     */
    public function addToCart(Cart $cart, int $quantity): CartItem
    {
        $itemToAdd = new CartItem($this, $quantity);
        $itemInCart = false;
        foreach ($cart->getItems() as $item) {
            if ($item->getProduct() == $this) {
                $itemInCart = true;

                // quantityLeft = ennyivel lehet növelni maximum
                $quantityLeft = $this->availableQuantity - $item->getQuantity();

                // quantityToAdd = ennyit fogunk hozzáadni
                $quantityToAdd = min($quantity, $quantityLeft);
                
                $item->setQuantity($item->getQuantity() + $quantityToAdd);
            }
        }
        if ($itemInCart === false) $cart->setItems($itemToAdd);
        return $itemToAdd;
    }

    /**
     * Remove product from cart
     *
     * @param Cart $cart
     */
    public function removeFromCart(Cart $cart)
    {
        $items = &$cart->getItems();
        foreach ($items as $index => $item) {
            if ($item->getProduct() == $this) {
                unset($items[$index]);
                break;
            }
        }
        $items = array_values($items);
    }
}