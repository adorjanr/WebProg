<?php


class Cart
{
    /**
     * @var CartItem[]
     */
    private array $items = [];

    public function getItems(): array {return $this->items;}

    public function setItems(CartItem $x): void {$this->items[count($this->items)] = $x;}

    /**
     * Add Product $product into cart. If product already exists inside cart
     * it must update quantity.
     * This must create CartItem and return CartItem from method
     * Bonus: $quantity must not become more than whatever
     * is $availableQuantity of the Product
     *
     * @param Product $product
     * @param int $quantity
     * @return CartItem
     */
    public function addProduct(Product $product, int $quantity): CartItem
    {
        $itemToAdd = new CartItem($product, $quantity);
        
        $itemInCart = false;
        foreach ($this->items as $item) {
            if ($item->getProduct() == $product) {
                $itemInCart = true;

                // quantityLeft = ennyivel lehet növelni maximum
                $quantityLeft = $product->getAvailableQuantity()  - $item->getQuantity();

                // quantityToAdd = ennyit fogunk hozzáadni
                $quantityToAdd = min($quantity, $quantityLeft);

                $item->setQuantity($item->getQuantity() + $quantityToAdd);
                break;
            }
        }
        if ($itemInCart === false) array_push($this->items, $itemToAdd);
        return $itemToAdd;
    }

    /**
     * Remove product from cart
     *
     * @param Product $product
     */
    public function removeProduct(Product $product)
    {
        foreach ($this->items as $index => $item) {
            if ($item->getProduct() == $product) {
                unset($this->items[$index]);
                break;
            }
        }
        $this->items = array_values($this->items);
    }

    /**
     * This returns total number of products added in cart
     *
     * @return int
     */
    public function getTotalQuantity(): int
    {
        $sum = 0;
        foreach ($this->items as $item) {
            $sum += $item->getQuantity();
        }
        return $sum;
    }

    /**
     * This returns total price of products added in cart
     *
     * @return float
     */
    public function getTotalSum(): float
    {
        $sum = 0;
        foreach ($this->items as $item) {
            $sum += $item->getQuantity() * $item->getProduct()->getPrice();
        }
        return $sum;
    }
}